---
title: My switch to OpenBSD, first impressions
layout: blogpost
date: 2015-04-19
---

So I switched to OpenBSD, and this blog post is here to talk about my first
impressions.  This probably won't be my last blog post on the subject.

So that you can understand how I use my distros, "ricer" is usually a term used
to refer to people that change the look of their setup to make it look very
attractive, outside of the defaults of whatever environment they have.  Take a
look at [/r/unixporn][r] for many good examples of ricing.

[r]: http://www.reddit.com/r/unixporn

An under-the-bonnet ricer means the ricer only looks to improve the workflow or
the commands and stuff they have available to them, not the looks.  I am an
under-the-bonnet ricer to the core.

Because of my nature I've had to reinstall Arch 3 times because I broke it and
have been using CRUX for a while, cause that's a fun distro to play with.

OK, on with BSD.

## Why?

Why OpenBSD?  Why not FreeBSD or NetBSD or DragonflyBSD or any other BSD?  Why
BSD in the first place?

I've been a Linux user for several years, and more recently I've been getting
into being all POSIX-compliant and stuff and GNU's coreutils have been grinding
on my nerves with that stuff.

So even though Linux is awesome, and compiling it is fun, the OS on top of it I
don't like, so I wanted to switch to something better, that something was BSD.

_Sidenote: Why does the GNU `sort` command have an `-R` flag which *randomises*
the result?  You can't sort something into being random.  That's an oxymoron
(with a particular choice of definitions)._

Now, why OpenBSD instead of another BSD?  First of all because my friends at
[Nixers.net][n] prefer OpenBSD (those that use a BSD).  It's good to switch to a
system where you know several people that know it.  Makes the switch much more
fun.

[n]: http://nixers.net/

Secondly, in December I did try to switch to FreeBSD.  It was a chance I had to
switch, but I had trouble getting X to work and at that point I really needed a
working OS.  This time I didn't want to deal with the X stuff so I just went
ahead and installed OpenBSD which I had heard had excellent X support out of the
box, and holy crap it does.

And thirdly because of the security orientation that the whole project has.
That is a really attractive feature for me.

## First impressions

Short version: I'm lovin it.

Keep reading for the long version.

### The install

Getting the USB stick ready was unique.  I downloaded the `install56.iso` but
that didn't work when I `dd`'d it into the USB stick.  So then I read the
`INSTALL.amd64` file and it uses the `.fs` file for the USB stick, not the
`.iso` file, so I downloaded that and `dd`'d it and it worked.  So that was new.

The install was certainly "weird" for me, coming from more manual Linux distros
where I format the harddrives, mount the partitions, write the `fstab`, etc. all
manually.  It was pleasant though, somehow I don't feel dirty with a clean
install of OpenBSD as I do with a clean install of any Linux.  Probably the lack
of GNU.  lol

But yeah, I was expecting a slightly more graphical install, since I already
experienced the FreeBSD install, but I'm fine with text prompts.  It's still
simple enough.

### X and hardware support

The X support was incredible, simply incredible.  I enabled xdm to start with
but quickly disabled it cause I've my own `.xinitrc` file.  Simply put, if I
don't mention it it's because it worked perfectly.

The only thing that isn't supported is my wifi card.  A dreaded BCM4315.  That
would have been a deal breaker some months ago but now I have an extra long
ethernet cable so it's fine.  This is a laptop though so I need to buy that wifi
dongle...

I am having a bit of trouble with the lid though.  Closing it suspends, which is
fine but then when I open it it's all black.  I pressed butons and stuff and it
didn't turn on again so I'm guessing for some reason my monitor doesn't wake up.
Dunno what's up with that.

_Sidenote: I've a Dell Vostro 1500 from 2007, with an Intel Core 2 Duo 2.0GHz._

### Ports/packages system

The ports/packages system is something I really like in OpenBSD.  Kinda sad CVS
is still used over Git for the ports, but that ain't gonna stop me from liking
it.  Seriously though y u no Git?

I like how it's decentralised.  A ton of mirrors counts as decentralised for me.
lol

I like how the `$PKG_PATH` variable works.  I'd be fine with this setup if it
was in some Linux distro.

The `pkg_add` command works very well as well.  It lets me know of the all the
stuff it's installing, and when it installs dependencies it lets me know what
package requires that dependency.  Makes it easy to tell what piece of software
is installing a ton of dependencies you don't want.  :P

### Being productive again

First of all, thank you to [BSD Now][b] and their tutorials, especially this
one: http://www.bsdnow.tv/tutorials/the-desktop-obsd

[b]: http://www.bsdnow.tv/

As a Node.js dev it can be a little hard to get started if you're used to using
[`nvm`][nv] because of a little bug which I [already reported][gi].  By the time
you read this it'll already be fixed most probably.

[nv]: https://github.com/creationix/nvm
[gi]: https://github.com/creationix/nvm/issues/733

Though Node v0.10 is included in the packages so I can still work, just not with
the latest and greatest.  I expect that to get updated to v0.11 or v0.12 in
OpenBSD v5.7 though.

Other than that, everything has been very smooth so far.  Some software I like
isn't in the packages but I can compile that myself so there's no issue, and it
may even be in the next release so I'm not too worried.

The first day I installed OpenBSD in the evening.  The next day I spent some
time figuring out how stuff worked, basics here and there etc. Getting up to a
working productive state again.  The next day I was completely productive again.
So the downtime was really just the evening while I was installing it and
figuring out basics.

I'd say that from the moment you plug in the USB to when you get back to work
again is like less than half an hour, honestly.

## Final verdict

If you're considering switching to OpenBSD, totally go for it.  There is nothing
stopping you but yourself, like seriously.

However, definitely to make sure your hardware is supported.  I spent an hour
trying to figure out why the wifi didn't work because I assumed it worked like
in Linux.
