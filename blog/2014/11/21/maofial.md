---
title: Minimal amount of fonts in Arch Linux
layout: blogpost
date: 2014-11-21
---

Thought I'd document this here.

Some weeks ago I decided I'd find the smallest font packages I could find but
that would still cover the biggest amount of Unicode.

After [consulting with Reddit][reddit] I came up with the following list:

[reddit]: https://www.reddit.com/r/archlinux/comments/2l2cr7/what_fonts_do_you_install_for_most_coverage_with/

- `ttf-dejavu` because some programs just need it and it's a pretty global
  "default" font in open source.
- `ttf-liberation` an extremely good looking alternative to some MS fonts.
  Excellent for default `serif`, `sans-serif` and `monospace` fonts.
- `adobe-source-han-sans-otc-fonts` for full CJK support.
- `ttf-noto-nockj` for big coverage of Unicode that isn't CJK.

Just thought I should share that, considering some other people may be looking
for the same thing some time in the future. :)
