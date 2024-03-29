---
title: Two months of OpenBSD
layout: blogpost
date: 2015-06-18
---

**September 1st: This blog post was originally written back in June 18th, and it
was a draft so I didn't publish it, but it's been here for so long I decided to
publish it.**

If you haven't already, read my previous blog post about OpenBSD where I shared
[my experience of switching to OpenBSD][sto].

[sto]: https://greduan.com/blog/2015/04/19/mstobfi

OK, in this blog post I am going to share my experience of using OpenBSD on my
main rig for 2 whole months, and why I switched back to Linux (gasp!).  I am
writing this in Arch Linux which I just installed today, in case you're
wondering.

Let's start off by saying, it has probably been my favorite experience from an
OS.  It is certainly the first OS (after the CRUX distro) that I did not feel
dirty installing or using.  With Arch I always have this itch in the back of my
head which makes me uncomfortable using the OS.

The lack of GNU in my coreutils and ksh being the default shell was a very nice
feeling.

It certainly felt weird to not be using a rolling-release OS, and I never
installed any patches or `-current` so I probably missed out on a whole
experience.

All I'm saying is, I didn't leave OpenBSD because I didn't like it.  I loved it!
I am leaving OpenBSD because the Node.js support on it is weak.  And I know the
guy maintaining the `node` package is doing his dangdest, but sadly without
[`nvm`][nvm] or something similar one can't have a good Node.js dev environment,
and `nvm` depends on the prebuilt binaries Node.js offers, which do not have
BSD versions. :/

[nvm]: https://github.com/creationix/nvm

For those unaware, when working with Node.js one often has to work with several
versions of Node.  0.10 being stable, 0.12 being the stable but sorta new
Node.js, and io.js being the absolute newest and least stable.  Because you work
with different versions depending on your client or your project, you need to
switch between these versions.  `nvm` offers a cool feature where you can do
`nvm use 0.10` and boom, your path now has Node 0.10 in the PATH instead of 0.12
or whatever.

The lack of a tool like `nvm` is incredibly inconvenient, and that is why I'm
switching back to Linux.  So it's nothing personal, it's just Node.js is my job
and I need `nvm`.

<!--
> TODO: Add link to blog post I haven't written yet. :P

Back to OpenBSD, I have written a blog post that will surely be of interest to
any Linux person thinking about switching or that are in the process of
switching.  It covers some of the questions that I myself had when switching.
-->

In the future I will definitely be switching back to OpenBSD if the situation
with Node.js improves, get on it devs! :)
