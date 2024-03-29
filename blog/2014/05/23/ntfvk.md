---
title: Neat trick for Vim keybindings
layout: blogpost
date: 2014-05-23
---

I actually found this out while looking at another person's vimrc while looking
for some good Unite config, cause I'm not really comfortable with advanced VimL,
which Unite for sure uses.

The specific lines are these:
<https://github.com/bling/dotvim/blob/0c9b4e7183/vimrc#L565-L580>

This gave me an awesome hint, which is that you can actually set a key blank so
that by itself it does nothing but with an extra key it does something.  In this
case it's the space key.  And also that you could alias a key to another value.

So now I use it like this in my vimrc (changes I haven't pushed yet though, at
the time of writing):

```vim
nm <space> [space]
nn [space] <NOP>
```

And a lot of my filesystem and buffer plugins use these keybinds.  I may even
set it up eventually so that it completely replaces my leader key, which I
honestly don't use much anyway, nowadays.

EDIT:

Posted a question on StackOverflow and it seems it's nothing too special.  Still
a neat trick though: <http://stackoverflow.com/q/23839528/1622940>
