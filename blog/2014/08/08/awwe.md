---
title: A week with Emacs
layout: blogpost
date: 2014-08-08
---

I have begun writing this in the 5th day of my one week with Emacs.  Since a
friend of mine was making the switch to Emacs, or at least seriously attempting
I decided to take a challenge with him where we would only use Emacs.

The agreement was I would only use Emacs, for everything, with or without Evil
mode.  While he would use Emacs for anything that wasn't coding, as using Emacs
would be a serious dent to his prductivity and he basically wouldn't be
productive for a whole week.

We agreed to keep a journal of our experience with Emacs.  I haven't read his so
I'm not sure how detailed he is with his, or how dedicated, but I don't think
mine will be as detailed as his, in any case.

So I decided to share my experience in my blog and sharing my journal in it,
along with a more detailed version of the journal I suppose.

I put the whole journal in a file named `emacs-journal.txt` in my home
directory.  I won't pose the whole thing here, since it would just be a screen
hog, so I'll put it in a Gist, here it can be found:
<https://gist.github.com/greduan/2f555993c1a537d8e7a5>

After you read that, come back here for a more detailed version, or just skip
the journal altogether if that's what you prefer.

Be warned, if you came here for a review or a workflow blog post you may not
find what you are looking for here.  I say "may" because I am just now writing
this post and I don't know what'll come out of it.

In this post I think I will mainly share differences I have noted between
Emacs and Vim, its users, the workflows found in both, how the experience was
for me, a 1-2 year only-Vim user, etc.

Let us begin!

## Why Emacs?

So a Vim user that can fluently think in motions and text objects, why the hell
would he want to be a traitor and switch to Emacs?

Well one, as I said earlier, it was a challenge in order to help my friend
switch to Emacs so that he wouldn't be alone and all of that, because being
the only one that uses a certain tool is kinda sad, I should know, I'm the only
one in my team that uses Vim, everyone else uses some IDE like PhpStorm (yuck!).
Also one of the two that uses Linux as the OS instead of OS X.

Two, I am naturally interested in Emacs, seeing how I am the user of the
archrival editor.

I also recently found [this font package][fp], but I can't really use it very
effectively in Vim so I thought I'd check out Emacs.  For the record I haven't
done anything with this yet.

[fp]: http://input.fontbureau.com/

OK let's get to the meat of this blog post.

## My observations

About what?  Everything.

### The users

The most glaring observation for me is the different kinds of users that use
Emacs and Vim.  Let me explain.

I feel like in Vim the user makes the changes fast, while in Emacs the user
takes a bit of time in order to code some kind of solution for Emacs to do it
for him.  In Emacs that piece of code forever remains in your `init.el` file
if you want and you can use it whenever, while in Vim if you want to make the
change again you just do the motion of keystrokes again, or record a macro and
save that somewhere.

Note: Do remember that I've only seriously used Emacs for 5 days at this point,
so I definitely don't know the workflow of a 10 year Emacs user.

In Emacs you can customize I think pretty much literally anything.  I don't mean
the figurative literally BTW, I mean the literal literally.

In Vim you can customize to a great extent your text editing experience, but you
can only customize your environment experience to the limits imposed by Vim's
options and settings.  Of course you can probably get very clever and do some
very interesting stuff to customize Vim.

[Note: Now the next day, the 6th day.]

So the users have very dfferent mindsets.  While in Emacs it is "how can I
automate this?" in Vim it's "how many keystrokes can I find a way to skip?".
This is brought about by the differences between Emacs and Vim, IMO.

### The ergonomics

I'm just going to go ahead and say it.  In my opinion, Emacs' default
keybindings **suck**.  Being a Vim user I found it super uncomfortable to have
to go and find the Ctrl and Alt keys constantly.  Maybe it has to do with how I
press the keys, maybe not, I press Ctrl using my left pinky and Alt using my
left thumb.  I don't feel like those keys are very strange but maybe they are.

And no, I did not switch Caps lock and Ctrl, neither will I do it.  I think I
tried doing it at some point for Tmux, as I heard suggestions to do that, and
remap the prefix to `Ctrl-a`.  I did not like it, felt unnatural.

Instead I decided to use something like [God-mode][g], which feels like less of
a hack, however I haven't gotten used to using it every time I can so I haven't
gotten much benefit from it yet.

[g]: https://github.com/chrisdone/god-mode

So yes.  Ergonomics.  Freakin' work on them please, at least make the keys more
natural.  `M-b` is exceptionally unnatural to press when you use your thumb to
press Alt, again that may be my own fault though.

### The damn tabs

Why is it SO HARD to configure how tabs work?

I had tabs sorta figured out, just make everything be a hard tab and you'll be
fine, but that doesn't work when you're working with Lisp, because Lisp and
hard tabs are the bane of good code formatting.  But IMO tabs work everywhere
else better than spaces.

I'm not going to go through what I've tried, it wasn't a pleasant experience.
In Vim it's not pleasant either but at least it's straightforward.

**Notice from 2015: I [figured it out][bp]. :3**

[bp]: https://greduan.com/blog/2015/04/29/iahie

### Elisp

Elisp is cool.  Configuring an entire editor with it is a concept I enjoy
thinking about.

While Emacs is a HUGE piece of software, compared to Vim that is, it has a TON
of code, Elisp and C code, all to give you a great piece of software that you
can configure as much as you want without a second thought.

### Light Table is not the next Emacs

This is a reference to a post I did previously, I was very excited about Light
Table and ClojureScript and all that jazz back then and I didn't really know all
that much about Emacs except what I had heard about it.

Yeah, Light Table is not the next Emacs, not even remotely close, it doesn't
even work inside the CLI so that already makes it very different. lol

### The package management

I won't write a lot about it, I just want to say it's not an ideal situation.

There is already a [really great post about this subject][pm].

[pm]: http://batsov.com/articles/2012/02/19/package-management-in-emacs-the-good-the-bad-and-the-ugly/

**Notice from 2015: I am informed that that blog post is now very out of date,
and I myself can confirm.**

I have spent time with both `package.el` and El-get, I personally prefer
El-get so far, but `package.el` is still really great.

## Afterthought

This blog post probably doesn't have a lot of flow, maybe.  It was written over
several days and it was basically just a rant, i.e. "say whatever you have on
your mind".

I think it's quite noticeably I quickly ran out of stuff to say. lol

Oh yeah, there was no Evil-mode mentioned huh?

Also, since the 6th day I started using Vim for coding again, becaues Emacs was
too slow.
