---
title: Light Table, The New Emacs
date: 2013-11-07
tags:
    - blog
---
The title may be misleading so I'm gonna make it clear right now. I couldn't come up with anything better. It's gonna stay like that, so you can make suggestions for a better title but I won't change the title.

So let me explain why I chose this title. That's what this post is about.

There is a popular saying that Vim users love to use against Emacs users in the holy editor wars. That saying is "Emacs would make a great OS, if only it had a good text editor." or something along those lines.

And I can sort of agree with that. Emacs' editor is not superior to Vim's in almost any front. But let's look at the bright side of that saying.

They're criticizing the text editor. But they're acknowledging it as an OS. In other words it apparently can be extended immensely. And it has proven to be able to do just that. It has just about anything that can be done in text. Email reader, news reader, chat, calendar, you name it. And if it isn't already implemented, you can do it yourself! ;)

And of course, it can be extended immensely towards developing. Debuggers, the CLI, automatic compiling functionality, people have made it an IDE as well. So its limits are practically none. Oh and let's not forget about the language you use to customize it. Emacs Lisp, A.K.A. Elisp; Its own dialect of Lisp. You can't get a lot more customizable than that.

Except you can... Enter Light Table!

[Light Table](http://www.lighttable.com/) is one of the new kids on the block. It is coded in [ClojureScript](http://clojure.org/clojurescript), a Lisp dialect that essentially compiles to JS. The other new kid is [Lime](https://github.com/limetext/lime), but he still hasn't got a working frontend (at the time of writing).

[Chris Granger](http://www.chris-granger.com/) (the main dev of Light Table) has created a unique architecture with Light Table. (As I understand it) you can add or remove anything and everything. Well maybe not everything since you'll always want some stuff there but you know what I mean. Think about the ECS ([Entity Component System](http://en.wikipedia.org/wiki/Entity_component_system)), that's almost *exactly* what Light Table has as an architecture. It is the first text editor of its kind in this sense.

He has created a very interesting system with Light Table where the basic text editor is loaded by default. All of the text editor you get by default are just behaviours. These behaviours can be added, removed, disabled, enabled. I'm sure you get where I'm going with this.

It could be anything and everything with due time! It could be the first real competitor for Emacs as well in terms of customizability. Think about it, it's written in ClojureScript, a Lisp dialect, you can add or remove behaviours, to the point where you can make it a NotePad or a browser if you liked.

One thing to note is that it is using [node-webkit](https://github.com/rogerwang/node-webkit) as it's platform. It allows you to call Node.js from the DOM. That's right, Light Table the text editor with almost no limits is technically a web browser.

That means JS is its limit. If you can't do it with JS (and [Node.js](http://nodejs.org/)) you can't do it in Light Table. But if you can do it in JS you can do it in Light Table. JS is quickly becoming the one language to write. JS is found almost everywhere nowadays. So I think Chris has made a smart decision when he decided to write it in ClojureScript.

The main point is, it's got (almost) no limit on what can be added *and* no limit on what can be removed, something Emacs is missing.

Oh and one more thing. Emacs is millions of lines of Elisp plus the C code it uses. Light Table is only around twelve thousand lines of ClojureScript, at the time of writing (v0.5.18).

So yeah. My point is, it'll possibly be *the* text editor once a couple of years pass after it's full release and it is more mature.

If there's something you think could be said better in this post feel free to [modify it](https://github.com/Greduan/eduantech.docpad/blob/master/src/render/posts/light-table-the-new-emacs.html.md) and make a pull request for it!

Thank you for reading! You can share your thoughts with me through email at <eduanlavaque@gmail.com>. :)
