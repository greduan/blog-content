---
title: Enable `pass` auto-completion in Zsh
layout: blogpost
date: 2014-06-18
---

Just thought I would share this tip with you since it would have saved me some
of my time if I had this.

Add the following to your `.zshrc` file or whatever file it is that you want,
just make sure it's loaded by Zsh:

    autoload -U compinit
    compinit

That enables auto-completion and loads it up.  I'm not sure why I never had it
enabled, but now it is.

You don't really need to do anything special anywhere else I don't think, that's
the only thing I had to fix for it to work on my computer.

Hope that helps. :)
