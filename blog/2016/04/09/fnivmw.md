---
title: File navigation in Vim (my way)
layout: blogpost
date: 2016-04-09
---

I'm going to talk about a flow I've developed recently, for myself, for
navigating files within Vim.

Note I say Vim in the post title but I use Neovim, I just felt like saying that,
because it makes no real difference to this post's content.

Let's just start with saying that I use [fzf][fzf] for finding files in a fuzzy
matching manner.  This is incredibly convenient.  You can of course use
[CtrlP][ctrlp] or whatever you prefer, but I use fzf.

[fzf]: https://github.com/junegunn/fzf
[ctrlp]: https://github.com/ctrlpvim/ctrlp.vim

So that's one way I navigate them, another way that, in combination with the
above, is actually quite powerful, is with netrw-like or netrw enhancing
plugins.

Namely [vim-vinegar][vinegar] and [vim-dirvish][dirvish].

[vinegar]: https://github.com/tpope/vim-vinegar
[dirvish]: https://github.com/justinmk/vim-dirvish

Why do I use two conflicting-looking plugins?

I use Vinegar because Vinegar provides a map of `-` to open the current folder
in netrw, or go up one folder if already in netrw. But netrw isn't Dirvish,
don't worry, cause Dirvish hijacks netrw so when you open netrw, Dirvish opens
instead.

Dirvish is what makes this setup cool for me, so if you haven't already, read
its [README file][dirvish-readme].

[dirvish-readme]: https://github.com/justinmk/vim-dirvish#readme

Anyway, I wanted to document that.  I'll also share my related rc config stuff
so that you and I can reproduce this behaviour easily:

```
Plug 'junegunn/fzf', { 'dir': '~/.fzf', 'do': './install --no-update-rc' }
Plug 'junegunn/fzf.vim'
Plug 'tpope/vim-vinegar'
Plug 'justinmk/vim-dirvish'

" Relative line numbers in a Dirvish buffer
autocmd! FileType dirvish setlocal relativenumber
```

## Update 2016-06-14

Somebody on Twitter actually let me know that you don't need vim-vinegar to have
the usage of the `-` keybind, vim-dirvish added it to itself now, which is
great.

So you can just have vim-dirvish installed now and that'll work out great. :)
