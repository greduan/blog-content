---
title: Using pyenv on DigitalOcean Ubuntu 22.04
layout: blogpost
date: 2023-12-02
---
If you're running Python on Ubuntu, you might install pyenv with the following command:

```sh
curl https://pyenv.run | bash
```

And then you might run `pyenv install 3.11.4` to install the Python version you need.

And you might run into an error like the following!:

```
Downloading Python-3.11.4.tar.xz...
-> https://www.python.org/ftp/python/3.11.4/Python-3.11.4.tar.xz
Installing Python-3.11.4...
Traceback (most recent call last):
  File "<string>", line 1, in <module>
  File "/home/demo/.pyenv/versions/3.11.4/lib/python3.11/bz2.py", line 17, in <module>
    from _bz2 import BZ2Compressor, BZ2Decompressor
ModuleNotFoundError: No module named '_bz2'
WARNING: The Python bz2 extension was not compiled. Missing the bzip2 lib?
Traceback (most recent call last):
  File "<string>", line 1, in <module>
  File "/home/demo/.pyenv/versions/3.11.4/lib/python3.11/curses/__init__.py", line 13, in <module>
    from _curses import *
ModuleNotFoundError: No module named '_curses'
WARNING: The Python curses extension was not compiled. Missing the ncurses lib?
Traceback (most recent call last):
  File "<string>", line 1, in <module>
  File "/home/demo/.pyenv/versions/3.11.4/lib/python3.11/ctypes/__init__.py", line 8, in <module>
    from _ctypes import Union, Structure, Array
ModuleNotFoundError: No module named '_ctypes'
WARNING: The Python ctypes extension was not compiled. Missing the libffi lib?
Traceback (most recent call last):
  File "<string>", line 1, in <module>
ModuleNotFoundError: No module named 'readline'
WARNING: The Python readline extension was not compiled. Missing the GNU readline lib?
Traceback (most recent call last):
  File "<string>", line 1, in <module>
  File "/home/demo/.pyenv/versions/3.11.4/lib/python3.11/ssl.py", line 100, in <module>
    import _ssl             # if we can't import it, let the error propagate
    ^^^^^^^^^^^
ModuleNotFoundError: No module named '_ssl'
ERROR: The Python ssl extension was not compiled. Missing the OpenSSL lib?

Please consult to the Wiki page to fix the problem.
https://github.com/pyenv/pyenv/wiki/Common-build-problems


BUILD FAILED (Ubuntu 22.04 using python-build 2.3.24)

Inspect or clean up the working tree at /tmp/python-build.20230812213442.20196
Results logged to /tmp/python-build.20230812213442.20196.log

Last 10 log lines:
        LD_LIBRARY_PATH=/tmp/python-build.20230812213442.20196/Python-3.11.4 ./python -E -m ensurepip \
                $ensurepip --root=/ ; \
fi
Looking in links: /tmp/tmph5_fnlth
Processing /tmp/tmph5_fnlth/setuptools-65.5.0-py3-none-any.whl
Processing /tmp/tmph5_fnlth/pip-23.1.2-py3-none-any.whl
Installing collected packages: setuptools, pip
  WARNING: The scripts pip3 and pip3.11 are installed in '/home/demo/.pyenv/versions/3.11.4/bin' which is not on PATH.
  Consider adding this directory to PATH or, if you prefer to suppress this warning, use --no-warn-script-location.
Successfully installed pip-23.1.2 setuptools-65.5.0
```

If you manage to fix that one, you'll be bothered with the next one, and the next one.

So here we go, I will share with you all the libraries you need to install.

```
sudo apt-get install libbz2-dev libncurses5-dev libncursesw5-dev libffi-dev libreadline-dev libssl-dev libsqlite3-dev liblzma-dev
```

But then in that case you might run into the following errors when you run `sudo apt-get update`, because you're using an older version of Ubuntu!

```
Hit:1 http://old-releases.ubuntu.com/ubuntu hirsute-security InRelease
Get:2 https://download.docker.com/linux/ubuntu hirsute InRelease [48.9 kB]                                                               
Ign:3 http://mirrors.digitalocean.com/ubuntu hirsute InRelease                                                                           
Ign:4 http://mirrors.digitalocean.com/ubuntu hirsute-updates InRelease
Hit:5 https://repos-droplet.digitalocean.com/apt/droplet-agent main InRelease
Ign:6 http://mirrors.digitalocean.com/ubuntu hirsute-backports InRelease
Err:7 http://mirrors.digitalocean.com/ubuntu hirsute Release
  404  Not Found [IP: 172.67.148.71 80]
Err:8 http://mirrors.digitalocean.com/ubuntu hirsute-updates Release
  404  Not Found [IP: 172.67.148.71 80]
Err:9 http://mirrors.digitalocean.com/ubuntu hirsute-backports Release
  404  Not Found [IP: 172.67.148.71 80]
Reading package lists... Done
E: The repository 'http://mirrors.digitalocean.com/ubuntu hirsute Release' no longer has a Release file.
N: Updating from such a repository can't be done securely, and is therefore disabled by default.
N: See apt-secure(8) manpage for repository creation and user configuration details.
E: The repository 'http://mirrors.digitalocean.com/ubuntu hirsute-updates Release' no longer has a Release file.
N: Updating from such a repository can't be done securely, and is therefore disabled by default.
N: See apt-secure(8) manpage for repository creation and user configuration details.
E: The repository 'http://mirrors.digitalocean.com/ubuntu hirsute-backports Release' no longer has a Release file.
N: Updating from such a repository can't be done securely, and is therefore disabled by default.
N: See apt-secure(8) manpage for repository creation and user configuration details.
```

To fix that, you update all of your sources list to use https://old-releases.ubuntu.com/ubuntu/:

```sh
sudo vi /etc/apt/sources.list
```

The reference to that fix is: https://www.digitalocean.com/community/questions/apt-update-not-working-on-ubuntu-21-04

Hope this saves you some time as it would've for me.