---
title: Python project setup
layout: blogpost
date: 2023-11-03
---

I've been playing around with my Python project setup a little bit, and I have found the following setup to be quite convenient and comfortable.

I make use of the Makefile as a sort of script runner (not what it's meant for btw).

I use a Django project as an example, that's using Tailwind and Svelte as well.

(Please note that for Makefiles, you need to indent with tabs, spaces are not syntactically valid.)

## Setup script, dependency management with `pip-tools`

I have a `make setup` script, which I only run once, or when I delete the `venv/` directory.

Then for dependency management I make use of [pip-tools][pip-tools] which is basically `pip-compile`+`pip-sync`.

[pip-tools]: https://github.com/jazzband/pip-tools

You use `pip-compile` to take in a requirements file with the dependencies you INTEND to have, which it then figures out what the dependencies you actually need, are, in order to fulfill that intention.

Then you use `pip-sync` to make the virtualenv only contain the libraries that you originally intended.

For `pip-compile` I use a `requirements.in` file (like `requirements.txt` but much smaller and stable).

That generates a `requirements.txt` that reflects what the `requirements.in` actually needs.

This is useful when you want to uninstall dependencies. Because then you just remove them from the `requirements.in`, you run `pip-compile` and then `pip-sync` and boom, you only have what you need.

In the Makefile I use `make update` for `pip-compile` and `make install` for `pip-sync`.

## `make run` script

This depending on the project I may or may not have it.

For this particular project you can see how it turned out below. I actually implement a trick so that I can run multiple commands at once, and then when I Ctrl-c it actually exits all the commands at once.

## The Makefile and helper scripts

Finally here's how the Makefile looks and the extra helper scripts.

```Makefile
# Only meant to be run once when setting up the project locally
.PHONY: setup
setup:
	pyenv exec python -m venv venv && . venv/bin/activate && pip install --upgrade pip && python -m pip install pip-tools
	chmod +x ./python ./manage

# Run every time the requirements.in changes
.PHONY: update
update:
	. venv/bin/activate && pip-compile --generate-hashes requirements.in

# Run every time the requirements.txt changes
.PHONY: install
install:
	. venv/bin/activate && pip-sync --pip-args '--no-deps' && ./manage tailwind install
	cd svelte && pnpm install

# Runs all the build and run processes in parallel
.PHONY: run
run:
	# Trick to run multiple commands in parallel and kill them all at once
	(trap 'kill 0' SIGINT; make runserver & make svelte & make tailwind & wait)

.PHONY: runserver
runserver:
	./manage runserver

.PHONY: svelte
svelte:
	cd svelte && pnpm run watch

.PHONY: tailwind
tailwind:
	./manage tailwind start
```

`python` file:
```sh
#!/usr/bin/env sh  
  
set -e  
  
. venv/bin/activate  
  
if [ $1 = 'sh' ]; then  
    # if the first arg is sh, like in our supervisorctl conf file, skip it  
    shift 1  
fi  
  
python $@
```

`manage` file:
```sh
#!/usr/bin/env bash  
  
set -e  
  
. venv/bin/activate  
  
python manage.py $@
```