---
title: HTMX Kills Most Single Page Applications
layout: blogpost
date: 2023-06-17
---

Language in the title is bait, let's get that out there right away.

But.

It is true that for a significant amount of cases where you see SPAs used, HTMX
could easily replace whole framework, leading to a simpler project, but
maintaining the snappy, responsive experience we know from SPAs.

I've had the pleasure of working with [htmx](https://htmx.org/) in some recent
projects, and indeed it removes any need for a front end SPA.

It's basically a rather expressive jQuery, especially when mixed with
[hyperscript](https://hyperscript.org/).

A lot of times we implement a SPA just because we need an interactive
experience and we don't want to write jQuery and keep track of state in a weird
way.

htmx+hyperscript gets rid of that need.  The interactivity and state tracking
can be done with the back end.  In the end you have a situation where the
source of truth, the back end, is also the one that gets to dictate what gets
rendered.

Overall it leads to a much simpler application.

Of course if you have the real need for a VERY interactive experience,
difficult application-wide state tracking, then a SPA _is_ the correct solution.

If you just need some interactivity while developing your app, a SPA is
overkill and overcomplicated.
