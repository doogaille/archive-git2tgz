archive-git2tgz
===============

Archive creator that pull from a set of git repository and produce a directory tree of tar.gz files

Tested under : Debian 6, 7.1 and 8.

Install
-------

Setup environnement

    apt-get install php5-cli git tar

Get source

    cd /opt/
    git clone https://github.com/doogaille/archive-git2tgz.git

Setup system link

    chmod -x archive-git2tgz/main.php
    ln -s archive-git2tgz/main.php /usr/local/sbin/archive_git2tgz

Configure
---------

Edit config

    cp /opt/archive-git2tgz/config.php.dist /opt/archive-git2tgz/config.php
    vim /opt/archive-git2tgz/config.php

Setup variables (according to your environnement) `$tmp_dir`, `$final_dir`, and add repository to `$repos` array.

Run
---

    archive_git2tgz

Result
------

This script produce a directory tree like this:

    Final_dir
        |-> gitproject1/
        |      |-> gitproject1-git-HASHGIT.tar.gz
        |      |-> gitproject1-git-HASHGIT.tar.gz
        |      \-> gitproject1-latest.tar.gz (symlink on last tar.gz)
        |
        |-> gitproject2/
               |-> gitproject2-git-HASHGIT.tar.gz
               \-> gitproject2-latest.tar.gz (symlink on last tar.gz)

TODO
----

* Documentation for other Plateform setup (Gentoo, BSD, OSX, Win).
* Try => issue => try => issue => try ;-)
