---
title: Indentation and hooks in Emacs
layout: blogpost
date: 2015-05-29
---

I've been using Emacs on and off for around half a year, maybe a little bit
more, more recently I've been using it daily because I've been using Org-mode
more and I've been editing code with it.

Something that has always bothered me about Emacs is how dang difficult it is to
manage indentation configs and stuff like that.  I've never been able to have a
nice clean way to have a per-filetype based indentation config.

This is coming from the perspective of an adept Vim user, as it isn't actually
*that* hard in Emacs, it's just tedious, while in Vim it's [just one line][v].

[v]: http://stackoverflow.com/a/1562645

For a while I was just using the [editorconfig][ec] Emacs plugin, but it doesn't
work right, since it only checks the config for a file *once*, and that is when
the file is opened.  If the `.editorconfig` file changes you need to close/open
the file or close Emacs and open the file again.

[ec]: http://editorconfig.org/

BTW if you don't use editorconfig in your projects, this is a great chance to
start now.  It only makes sense to use it.

After a bit I started playing around with hooks.

Now for me the problem with hooks is that they're a bit verbose.  That's not
really a problem, it's just me not used to how verbose Lisp can get sometimes.

<!--
Another problem is that sometimes a mode doesn't offer a hook for some reason.
Those can be a bit annoying to deal with, also I had trouble finding what the
name of the hook is.
-->

I am here to help you out with Emacs hooks.

## Searching for mode hooks

This is quite simple, if you're not familiar with Emacs' built-in help system,
you really should look into it (`C-h C-h`).

Do `C-h v` to look for a variable, then start typing the name of the mode, let's
say `shell-script` and then press tab, or `?` works as well.  Probably one of
the last results you'll get is `shell-script-mode-hook`.  Try it for other modes
you're interested in, you'll probably be able to find them this way.

Now there are some caveats, apparently not all hooks are made equal.  For
example, `javascript-mode-hook` doesn't do anything, but `js-mode-hook` does,
even though the major mode is called `javascript-mode`.

## My indentation strategy

Now it took me a bit, but I deviced a system that works pretty nicely and is not
very verbose for my tastes, it is a bit tedious though if you don't have
[Lispy][l] or Paredit.

[l]: https://github.com/abo-abo/lispy

Anyway, the strategy I have is simple.  First I define a default indentation
setup:

``` elisp
;; default
(setq-default tab-width 4)
(setq-default tab-stop-list (number-sequence 4 100 4))
(setq-default indent-tabs-mode 1)
```

You can find out what `tab-width`, `tab-stop-list` and `indent-tabs-mode` do
with `C-h v`, and about what `number-sequence` does with `C-h f`.

Those are some defaults that I want to have on every file for which I haven't
defined something else.

Next I define a utility function:

``` elisp
(defun my-tabs-stuff (tabs length)
  (setq indent-tabs-mode tabs)
  (setq tab-width length)
  (setq tab-stop-list (number-sequence length 100 length)))
```

What this function does is it just tells the buffer in which it is being run if
we should use real tabs or fake/space tabs (`indent-tabs-mode`), then it goes on
to tell it how long a real tab should look (`tab-width`) and what Emacs should
treat as a tab when dealing with spaces (`tab-stop-list`).  That's all our
function does.

Then we go on to define hook functions, these are the functions we are going to
refer to as the function that gets called when the hook is triggered.

``` elisp
(defun my-emacs-lisp-hook ()
  (my-tabs-stuff nil 2))
(defun my-shell-script-hook ()
  (my-tabs-stuff 1 4))
(defun my-js-hook ()
  (my-tabs-stuff 1 2))
```

So we are just defining one function per mode, which in my case only call one
function each, the function being `my-tabs-stuff` and passing it the arguments
for what I want as indentation settings in that mode.

Now all that's left is to add these functions to the hooks:

``` elisp
(add-hook 'emacs-lisp-mode-hook 'my-emacs-lisp-hook)
(add-hook 'shell-script-mode-hook 'my-shell-script-hook)
(add-hook 'js-mode-hook 'my-js-hook)
;(setq js2-mode-hook js-mode-hook)
```

Note the last one, you can basically alias one mode's hooks to another's by
using something like what you see in the last line.

Hopefully that helps you out, I've wasted too much time with Emacs figuring this
out, or not figuring it out and suffering the consequences.  So hopefully this
saves you some time. :)
