---
title: Barebones file navigation in Vim
layout: blogpost
date: 2014-08-24
---

This post is mainly a rip-off of this talk that happened on a Vim London meetup
titled "Bare Bones Navigation, by Kris Jenkins": <http://vimeo.com/65250028>

You can find the slides here: <https://github.com/krisajenkins/bare-bones-vim>

He ends the talk with a slide that has the following:

``` vim
" :find
set path=**
set suffixesadd=.java,.py

" :find gets better more
set nocompatible
set wildmode=full
set wildmenu
set wildignore=*.class,*.pyc

" :ls & :<number>b

" :Explore
" :e scp://host/some/where/file.txt
```

So I'll just quickly explain those.  This post is mainly for reference for
myself but I still hope it helps you. :)

Also I've challenged myself to use only these built-in commands for a while
instead of some fancy FZF or Unite.vim or anything of the sort.

Let's start with `:find`.  This command just finds whatever filename you give
it, no auto-completion just give it a filename and it'll find it.  It needs for
`path` to be set to `**` for it to just find any file in the current directory.

The definition of `path` can get very detailed and complex, so go ahead and go
nuts on your definition.  It can also be comma separted, in case you have
specific paths you like.

`suffixesadd` is for `:find`, it allows you to skip the file extension and allow
`:find` to still find the right files.  Set it up so you can save on some
typing.  Comma separated.

`nocompatible` don't need to explain this one, if you're using Vim just use it.

`wildmode` that sets up the kind of auto-completion that Vim has for the `:`.
While he sets it to `full` I always set it to `list:longest`, this is
preference though.

`wildmenu` from what I understand makes it so that the auto-completion isn't all
on one line, so that it uses several lines to show the auto-completion.

`wildignore` is to define files to ignore.  Set it to the files you mostly never
want to edit because only the language uses them, not the programmer.

Then he talks about switching buffers with `:ls` and `:b[uffer]`.  Use `:ls` to
list your buffers and use `:b[uffer]` to switch to a buffer by buffer number.
While he uses the buffer number before the `b`, you can also use it afterwards.

Then it's `:Ex[plore]` (which includes `:Sex[plore]` and `:Vex[plore]`) and
`:e[dit]`.  The `:{E,Ve,Se}x[plore]` commands open up the built-in netrw file
explorer which is a built-in plugin, which means it is not included if you use
`vim -u NONE` in order to not load any config or plugins.

VimCasts has a blog post about this that I suggest reading so you get familiar
with this plugin and how to use it:
<http://vimcasts.org/blog/2013/01/oil-and-vinegar-split-windows-and-project-drawer/>

And finally `:e[dit]` is a built-in Vim command and all that there is to it is
to give it the full path of the file you want to edit.  The path you give it is
relative to the current directory.

That is all on that subject.  While I'm on it though, I would suggest that if
you are in a setup where you can have a couple of plugins, I really suggest
you install the following plugins by Tim Pope:

- <https://github.com/tpope/vim-sensible>
- <https://github.com/tpope/vim-vinegar>

That is all, hope this helps.  :)
