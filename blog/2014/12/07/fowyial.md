---
title: Figuring out when you installed Arch Linux
layout: blogpost
date: 2014-12-07
---

I just figured out a cool trick to check when you installed your current Arch
Linux install.

All you have to do is check the logs for pacman which can be found at
`/var/log/pacman.log`.  Go to the top of the file and look at the date.

Looks like my current install was installed at `2014-04-16 15:48`.  Longest
running install yet.

Of course this trick depends on the fact that the logs still exist.  If you
cleared those logs then you can't really use this trick.  Although IMO this is
one log you shouldn't delete, considering how valuable its data could be.
