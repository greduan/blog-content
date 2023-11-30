---
title: Basic security in Python Litestar projects (bonus HTMX CSRF config)
layout: blogpost
date: 2023-12-01
---
In Litestar projects, while the batteries for security features come in the package, you still have to insert them yourself. You need to configure security things yourself.

I'll walk you quickly through the basics:

- CSRF
- CORS
- Allowed hosts

## CSRF

https://docs.litestar.dev/2/usage/middleware/builtin-middleware.html#csrf

How I do it is as follows:

1. I configure a `CSRF_SECRET` env var
2. I load those env vars using dotenv (`python-dotenv` pip package)
3. Check during application initialization if `CSRF_SECRET` has been defined or not, if it hasn't then I exit immediately
4. Configure a `CSRFConfig` middleware for Litestar
5. Use that middleware in Litestar
6. (Bonus) Configure HTMX to include the CSRF token in all of its requests in a header using the `csrf_token()` template function, which injects the token for the current request into the template when called

```python
csrf_secret = os.environ.get('CSRF_SECRET', None)  
if csrf_secret is None:  
    raise ValueError('CSRF_SECRET environment variable must be set.')    
# The default cookie name is 'csrftoken', but we want to use 'x-csrftoken' to  
# avoid conflicts with something else (don't know what)
csrf_config = CSRFConfig(secret=csrf_secret, cookie_name='x-csrftoken')

app = Litestar(
	# ...
    csrf_config=csrf_config,
	# ...
)
```

```html
<script>
  document.body.addEventListener('htmx:configRequest', function(evt) {
    evt.detail.headers['x-csrftoken'] = '{{ csrf_token() }}';
  });
</script>
```

Note that `CSRFConfig` actually allows you to configure what header it should look at to check if the front end is properly sending a CSRF token. Take a look at the docs linked above for more details on that.

## CORS

https://docs.litestar.dev/2/usage/middleware/builtin-middleware.html#cors

To include CORS security measures it is much simpler.

1. Configure an `ALLOW_ORIGIN` variable (domain URLs, separated by comma), e.g. `"https://greduan.com"`
2. Configure a `CORSConfig` middleware
3. Use that middleware in Litestar

```python
allow_origin = os.environ.get('ALLOW_ORIGIN', None)
if allow_origin is None:
    raise ValueError('ALLOW_ORIGIN environment variable must be set.')
cors_config = CORSConfig(allow_origins=allow_origin.split(','))

app = Litestar(
	# ...
    cors_config=cors_config,
	# ...
)
```

## Allowed hosts

https://docs.litestar.dev/2/usage/middleware/builtin-middleware.html#allowed-hosts

Once again very simple, Almost the same as with CORS.

1. Configure an `ALLOWED_HOSTS` env var with domains (no ports!), separated by comma, e.g. `"127.0.0.1,localhost"`
2. Set up the middleware with the allowed hosts
3. And use that in Litestar

```python
allowed_hosts = os.environ.get('ALLOWED_HOSTS', None)
if allowed_hosts is None:
    raise ValueError('ALLOWED_HOSTS environment variable must be set.')
allowed_hosts = allowed_hosts.split(',')

app = Litestar(
	# ...
    allowed_hosts=AllowedHostsConfig(allowed_hosts=allowed_hosts),
	# ...
)
```

## Putting it all together

The environment variables, as an example for localhost running on port 8000:

```env
ALLOW_ORIGIN='127.0.0.1:8000'
CSRF_SECRET="boom boom boom boom, I want you in my room, let's spend the night together, tonight until forever!"
ALLOWED_HOSTS='127.0.0.1,localhost'
```

And all of the Python code:

```python
allow_origin = os.environ.get('ALLOW_ORIGIN', None)
if allow_origin is None:
    raise ValueError('ALLOW_ORIGIN environment variable must be set.')
cors_config = CORSConfig(allow_origins=allow_origin.split(','))

csrf_secret = os.environ.get('CSRF_SECRET', None)
if csrf_secret is None:
    raise ValueError('CSRF_SECRET environment variable must be set.')
# The default cookie name is 'csrftoken', but we want to use 'x-csrftoken' to
# avoid conflicts with something else (don't know what)
csrf_config = CSRFConfig(secret=csrf_secret, cookie_name='x-csrftoken')

allowed_hosts = os.environ.get('ALLOWED_HOSTS', None)
if allowed_hosts is None:
    raise ValueError('ALLOWED_HOSTS environment variable must be set.')
allowed_hosts = allowed_hosts.split(',')

app = Litestar(
	# ...
    cors_config=cors_config,
    csrf_config=csrf_config,
    allowed_hosts=AllowedHostsConfig(allowed_hosts=allowed_hosts),
	# ...
)
```

