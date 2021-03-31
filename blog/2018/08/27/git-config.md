---
title: Git config
layout: blogpost
date: 2018-08-27
---

Here's something I do every time I get a new computer, it's important enough
that I have a script for it in my dotfiles.  You can find the [latest version
of that script][git.sh] in my dotfiles.

[git.sh]: https://gitlab.com/greduan/dotfiles/blob/master/scripts/git.sh

I thought I'd explain each line in this blog post, should make for somewhat
interesting material.  But all of these you can find explained in the [Git
config man page][git-config-man-page].

[git-config-man-page]: https://git-scm.com/docs/git-config

---

All of my commands I run using `git config --global`, and then the command, so
I will omit hat from my settings since it's for literally all of them.  Please
be aware of if you wanna use `--global` or not.

    user.name "greduan"
    user.email "me@greduan"
    github.user greduan

These are basics, actually you need at least this to be able to run Git.  I
believe this is in every Git "getting started" guide or something like that.

Though the `github.user` used to be recommended by GitHub some years ago, I
think it's no longer necessary or relevant.

    commit.gpgsign true

In some setups I use this, in others not.  At the time of writing this, this
is commented out in the script.

Be aware that if you want to use this, you need to invoke
`user.signingkey <key>` first.  [Here's the Git book][git-book-gpg] on the
subject of signing with GPG.

[git-book-gpg]: https://git-scm.com/book/en/v2/Git-Tools-Signing-Your-Work

    commit.verbose true

Basically makes sure that the diff that you're committing is put in the commit
file passed to your editor when you run `git commit`.

This is basically the same as passing the `-v`/`--verbose` option to your
`git commit`.

    core.editor nvim

Self-explanatory.  Which editor to use when editing the commit messages or
running an interactive rebase.

    core.excludesFile ~/.gitignore

This one is one of my favorites, and a really easy one to apply.  Allows you to
setup a `.gitignore` file that will be active on all your projects.  Very useful
for system files and editor files, stuff to do with your environment, as opposed
to your project.

For example it'd include stuff like `.DS_Store`, or Emacs backup files and so
on.

    core.pager "less -R"

The pager is what your Git uses when you ask for example for `git log` or
`git diff`, it's what shows more than one page of text in the terminal.

This has to do with how `less` handles colors, that's what the `-R` option is
for.  It's some fix I needed at some point and it's stayed there since then.

    core.ignorecase false

This is one strategy to work around the macOS problem that he default file
system isn't case-sensitive, this causes problems with Git.  I don't remember
having this trouble recently at all so it probably worked.

    help.autocorrect 1

Automatically execute a typo-ed command if it recognizes that there's no
alternative.  Actually `-1` would do it immediately while `0` would not do
anything and `>0` would be tenths of a second to wait before executing it.

    color.ui true

Colors stuff like `git log` and so on when outputted to the terminal.  If set
to `always` it'd be always, even if not on a terminal.

    core.eol lf
    core autocrlf input

To do with the line ending format.  I like my Unix, so I set it to `lf`.

I set `autocrlf` to `input` so that it doesn't mess around with the files.

    merge.conflictstyle diff3
    merge.tool vimdiff
    mergetool.prompt false
    diff.algorithm patience
    diff.compactionHeuristic true

Just some settings on how to handle diffs.  I don't remember the details on
these, and they may not even be relevant now.

They simply set some settings on with which editor to handle the diffs and
(potentially) improve the algorithm with which to run the diff to produce
smaller diffs and/or some more specific diffs.  This is up to your preferences,
really.  Read up on it.

    push.default simple

You'll have to read the details in the man page, but this is just how I expect
my Git push to behave.

---

And that's the end of that blog post.  Longest etchnical one in a while, hope
you got some good tips out of this one.

BTW, this was written while listening to seiyuu radio shows.  Very enjoyable
pastime nowadays.
