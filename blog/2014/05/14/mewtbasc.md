---
title: My experience with the BSPWM and Sxhkd
layout: blogpost
date: 2014-05-14
---

**Notice from 2015: While I don't use bspwm as my main WM, I do sometimes use
it.  But I use sxhkd daily as I tend to use minimal WMs that need it.**

In this post I'm going to, as you might have guessed, talk about the [bspwm][b]
window manager along with its partner tool that's almost impossible to live
without, [sxhkd][s] a simple X hotkey daemon.

[b]: https://github.com/baskerville/bspwm
[s]: https://github.com/baskerville/sxhkd

Some people may have trouble understanding the concept of a tree structure for
the windows in a window manager, but basically, every window is inside
a container, that container can act as a window or as a container of two other
containers, each of which can act like a window or as a container of two other
containers, each of which... etc.

This allows for very complex, advanced and simple to do organization of your
windows.

Right now, TBH I can only work with these kinds of WMs because they're the only
ones that make sense for my workflow, in which almost no virtual desktop is used
for the same thing every time.  The idea of a master window doesn't really work
for me TBH.

However because of this tree like structure for organizing the windows it only
has two templates, monospaced, which basically only has one window on the screen
no mater how many there are on the desktop or tiled, which allows you to take
advantage of all of this crazyness that is a tree structure.

i3 has a similiar structure, i3 describes its structure as a tree, BSPWM
describes its own as a binary space, actually its description is "A tiling
window manager based on binary space partitioning".

Anyway, my experience with it, super nice for everything except setting up
Dzen2, my preferred program to use as a bar with my window managers.  Had to
spend quite a bit of time with this.

If you have experience with the shell you'll probably notice right away why
sxhkd is more powerful than something like xmodmap.

Here's a nice GIF by windelicato about why BSPWM:
<https://raw.githubusercontent.com/windelicato/dotfiles/master/why_bspwm.gif>

Final verdict, it's nice but still in the trial stage, may go back to i3...
