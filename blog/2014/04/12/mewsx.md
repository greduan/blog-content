---
title: My experience with SolydXK (X)
layout: blogpost
date: 2014-04-12
---

Here I'll share my experience with [SolydXK](http://solydxk.com/), a Debian
based semi-rolling release.  I'll just try to keep it short but still providing
enough info for you to have learned something from this.  I think I've spent
almost 2 weeks with this distro.

This is my first taste of Debian in general, so if I point out SolydXK has
something, although it's obvious because it's a Debian distro, please excuse me.

So let's get started! First the installation...

## The installation

I put the [SolydXK Multi DVD][smd] ISO into an 8GB USB using [this guide][cb]
(which is my favorite guide BTW, as it's just a reference).

[smd]: http://solydxk.com/homeedition/solydxk-multi-dvd/
[cb]: http://crunchbang.org/forums/viewtopic.php?id=23267

The installation was the most pleasant installation I've had of any Linux
distro, even something like Ubuntu. Besides the fact it was clear on the
choices' purpose, it looked nice and other things, most importantly of all for
me is that it supported the dreaded [`b43`][b43] wireless card drivers, which is
a huge plus for me cause I don't have Ethernet readily available.  I had
Ethernet while doing this though, and the fact it recognized it needed to
install it was nice.

[b43]: http://wireless.kernel.org/en/users/Drivers/b43

If I don't have Ethernet though I have on my USB some firmware files readily
available to copy them where they need to go. :P

Kinda sad that it doesn't have a super
[minimalistic version](http://forums.solydxk.com/viewtopic.php?f=14&t=3464),
which my Arch Linux in me cries about, but I'm willing to live with it.

Here is a HUGE con with this one though, maybe will get fixed in the future, but
it doesn't figure out there's other distros installed on the same HDD, and
deletes the Grub entries for those (although the data is untouched).

## The general experience

I would give this a very good rating. Nothing posed any problems really, yet.

To switch to the [i3 window manager][i3] I just all I had to do was install it
with `# apt-get install i3` and choose it from the list of setups (at the screen
where you're asked your password, one of top right icons).  Very enjoyable.

[i3]: http://i3wm.org/

It comes pre-installed with some stuff, Firefox, Thunderbird, Flash, Libre
Office and some other stuff.  Which is fine with me since I use all of those, it
does have some other stuff I don't think I'll ever use though, probably.

The update manager is very nice.  It just updated today (as I'm writing this)
and it's nicer now, since the update manager got an update. :)

## Final thoughts

Very nice.  If you want a rolling release Debian, I'd go with this if I couldn't
use Arch for whatever reason, granted I haven't tried other Debian distros.

BTW, I did not explain core mechanics that you've probably already read about,
this is just to share my experience, not really a review or anything.

<!--
Notice from 2015: as I read that I notice I put the review tag on this post. lol
-->
