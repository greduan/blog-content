---
title: Experience upgrading OpenBSD to 5.7
layout: blogpost
date: 2015-04-30
---

In short, it was way way way way simpler than I expected it to be.  It took less
than 10 mins to update OpenBSD from 5.6 to 5.7.  And then another half an hour
to update all my packages with `# pkg_add -u`.

The reason I was scared is because I am unfamiliar with this sort of upgrade
procedure, I am used to rolling distros where to update you just run one command
every once in a while and you're up-to-date.  I never used Debian or Ubuntu
extensively so I didn't get to experience freeze periods, OS version numbers
etc.

I mean there's not much more to say about that.  Just so that it's not a really
short post I'll lay out the steps I took:

- Downloaded the `install57.fs`
- `dd if=install57.fs of=/dev/sd0c bs=4M` (`of=` may vary for you)
- Booted into USB
- Chose `(U)pgrade` instead of `(I)nstall` or `(A)uto Install`
- Went through procedure
- Rebooted
- Read mail (just reports)
- `# sysmerge`
- `# pkg_add -u`

And that was it.  It was way simpler than I expected.

I will be upgrading to -current soon enough so I can write about the experience,
also I need the latest `sort` to have the `nvm` bug fixed.

EDIT:

Today is May 2nd.  I just realised there is an
[upgrade guide for 5.6 to 5.7][g].  I just read that today and I ran the steps,
I missed this part of the upgrade earlier.  Oops.

[g]: http://www.openbsd.org/faq/upgrade57.html
