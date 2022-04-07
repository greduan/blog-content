---
title: Kubernetes RabbitMQ Certificate Revocation List
layout: blogpost
date: 2022-02-02
---

## The problem

You have your Kubernetes (k8s) cluster, and you have your RabbitMQ charts.  You're protecting access to them via key pair certificates.  You now need to revoke access to one of the certificates.

In Kubernetes there is no support for CRLs or anything similar.

RabbitMQ _does_, however, support them. And it's actually relatively straightforward.  But it's very poorly documented.  Hopefully this helps out a poor soul.

## Requirements

This post assumes you:

- Have a RabbitMQ setup in your k8s cluster via [Bitnami's Helm charts][bitnami].
- You already figured out how to revoke a certificate and generate the CRL .pem file.

For reference you can check the following pages:

- https://jamielinux.com/docs/openssl-certificate-authority/certificate-revocation-lists.html
- https://blog.cadena-it.com/linux-tips-how-to/how-to-generate-a-certificate-revocation-list-crl-and-revoke-certificates/
- https://access.redhat.com/documentation/en-us/red_hat_update_infrastructure/2.1/html/administration_guide/chap-red_hat_update_infrastructure-administration_guide-certification_revocation_list_crl

That means you also have an `openssl.cnf` file, which has config lines resembling the following:

```
dir = ca
certificate = $dir/ca-cert.pem
private_key = $dir/ca-key.pem
database = $dir/index.txt
new_certs_dir = $dir/certs
serial = $dir/ca-cert.srl
```

And your `index.txt` does indeed mark your certificate as revoked.

Just to get the basics out of the way :)

## How to

### `crl/` folder

```shell
$ mkdir crl
$ mv crl.pem crl
$ c_rehash crl
$ ls crl
b0a7999f.r0  crl.pem
```

We will explain later what this step is for, just know the files `b0a7999f.r0` and `crl.pem` are the same, only the filename differs.

This folder should now be available to the RabbitMQ charts, so it should live under `rabbitmq/crl`.  **Note** we removed the `crl.pem` file from that copy of the folder, honestly not sure if that's necessary.

**Expiration**

Note, a CRL file has a built-in expiration.  This means you need to refresh it regularly.  Or, with the `-crldays` flag, extending that expiration date into the far future.  For example:

```shell
# extended 100 years into the future
openssl ca -gencrl -crldays 36500 -keyfile ca/ca-key.pem -cert ca/ca-cert.pem -out crl/crl.pem -config openssl.cnf
```

If you don't do this, when it expires RabbitMQ will have trouble connecting ANY clients as the CRL file is considered then invalid or broken.

### Mounting the `crl/` folder

In the RabbitMQ charts values config, you can use the following:

```yaml
extraVolumes:
  - name: crl-volume
    secret:
      secretName: rabbitmq-crl

extraVolumeMounts:
  - name: crl-volume
    readOnly: true
    mountPath: "/etc/crl"

extraSecrets:
  rabbitmq-crl:
    b0a7999f.r0: |-
      -----BEGIN X509 CRL-----
      b3JpZXMgbHRkLiBDQRcNMjIwMjAyMTMwNjQ3WhcNMjIwMjA5MTMwNjQ3WjAcMBoC
      daGBapUlbRujU5++5w0bhSmU3+gTNctNTlzpuCklf0an9XCP48DIF8659+apXN6e
      MIIBiTBzMA0GCSqGSIb3DQEBCwUAMCYxJDAiBgNVBAMMG3RyaWFyYyBsYWJvcmF0
      F+9w+IF2iNPfp346kMZuE97ywtlp6LJmeZszd7HxClfU8eDSyj/FMwuerooVzkxQ
      CQC7NRZnlyVLlhcNMjExMjEzMTEwNjM2WjANBgkqhkiG9w0BAQsFAAOCAQEAbqas
      FPUuitY76A8Gt09+GTmayOkQMkgRpBXX/LOkjDdJ2rgjjtgklZsYq/Q6rMUYxj0B
      HP2FasmBULDuAuDPBzDcta3Ih5x6lxE+gkBkm07hE39TV5DH+N99ZrKdz0oiUGeD
      YfYd6Udu313BXjEGuHnItvbsw1JKZdGRclbdMBBEUURV5jB4lu4D8dIkjcjAi8oC
      DvlsMVdazm9A0Ju1BQ==
      -----END X509 CRL-----
```

Note here I show how it should end up after templating.  (Because actually we had trouble doing it through templating so we hardcoded it for now, feel free to do it with templating.)

What you should end up with is that your RabbitMQ pods will now have under `/etc/crl` the file `b0a7999f.r0` available to them.

We have to do it this way because that's how RabbitMQ works with CRLs.

### Configuring RabbitMQ

Once again in the RabbitMQ charts values file, you must add the following:

```yaml
advancedConfiguration: |-
  [
    {rabbit, [
       {ssl_options, [{cacertfile,"/opt/bitnami/rabbitmq/certs/ca_certificate.pem"},
                      {certfile,"/opt/bitnami/rabbitmq/certs/server_certificate.pem"},
                      {keyfile,"/opt/bitnami/rabbitmq/certs/server_key.pem"},
                      {verify,verify_peer},
                      {fail_if_no_peer_cert,false},
                      {crl_check, false},
                      {crl_cache, {ssl_crl_hash_dir, {internal, [{dir, "/etc/crl/"}]}}}]}
     ]}
  ].
```

Let's walk through that.  First, this is basically the config you have available under `configuration`, so why are we repeating ourselves?

There are some things that cannot be specified via that format, but that we do need to specify.  However according to this mailing list post, [these are not merged cleanly][mailing-list], the normal config and the advanced config, so we need to specify the `ssl_options` in full in the advanced config. 

We copy the values from the normal config, and then at the end we add the two important config values for us.

`{crl_check, true}`, when true, enables checking certificates against the CRL we setup above.  You can quickly disable this feature by changing it to `false`.  Of course note that that would make all the revoked certificates, valid again.

`{crl_cache, {ssl_crl_hash_dir, {internal, [{dir, "/etc/crl/"}]}}}` here we're basically just saying "look in `/etc/crl` for the CRL".

## In conclusion

Actually it's very straightforward!  You just need to scour the internet for bits and bobs of information and put it all together into one whole package.  This post attempts to provide that.

If you know any of this information to be wrong, or find something that could be improved, shoot me an email at <a href="mailto:me@greduan.com">me@greduan.com</a>, help another poor soul.

References:

- For a reference `openssl.cnf`, see: https://docs.pivotal.io/tanzu-rabbitmq/1-0/ssl.html
- For the official RabbitMQ instructions related to this (but not about this), which hint at how to configure the advanced configuration, see: https://www.rabbitmq.com/ssl.html
- For the configuration you need in the advanced configuration, see: https://serverfault.com/a/769738/183068
- You can also find out about `ssl_crl_hash_dir` via this GitHub issue: https://github.com/rabbitmq/rabbitmq-server/issues/2338
- The documentation for `ssl_crl_hash_dir` can be found at: https://www.erlang.org/doc/man/ssl.html#type-crl_cache_opts
  - Note it describes the funky `crl/` folder that you need to setup, and tells you about `c_rehash`.

[bitnami]: https://github.com/bitnami/charts/tree/master/bitnami/rabbitmq
[mailing-list]: https://groups.google.com/g/rabbitmq-users/c/axRy_eeB7xk
