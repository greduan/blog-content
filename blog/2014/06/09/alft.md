---
title: Arch Linux font tip(s)
layout: blogpost
date: 2014-06-09
---

Just thought I would share something that has been very useful to me recently,
and that is some Arch Linux font stuff.

First let's talk about the [Infinality-bundle+fonts][ibf].  This is SO useful!
It's basically some pre-configured font settings and fonts that make your Arch
Linux font rendering so nice.  If you want a real quick plug-and-play font
config you can use this.

[ibf]: https://wiki.archlinux.org/index.php/Infinality-bundle%2Bfonts

It was nice and all but I didn't like how many downloads I had to make in each
`pacman -Syu`, granted I don't think they were too many but my internet is not
so fast that I don't care about the size of my downloads.

To uninstall it I had to, IIRC remove the 'infinality-bundle' repository from my
`pacman.conf` file, then I had to manually uninstall all the fonts and stuff
from this bundle.  There's probably an easy way to do this but I am not aware of
it.

OK so that's one solution.  There is another one which I really like since it
works quite well which can be found in this blog post: [From the mind of a nerd:
Font Configuration in Arch Linux][blog-post]

[blog-post]: http://jaysonrowe.blogspot.mx/2013/04/font-configuration-in-arch-linux.html

I followed his steps and it works quite well.  Some websites for some reason
don't have font smoothing but they are not many.  I did not follow the settings
he has on XFCE, because I don't have XFCE installed but if I did that it would
probably work flawlessly.

This solution allows me to not install anything extra and still have nice fonts
so I like it.

Hope these tips help you out someday. :)
