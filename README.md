archive-git2tgz
===============

Archive creator that pull from a set of git repository and produce a directory tree of tar.gz files

Tested under : Debian 6 and 7.1

Install
---------

* Install php5 client :
    apt-get install php5-cli git tar

* Git clone :
    cd /opt/
    git clone https://github.com/doogaille/archive-git2tgz.git
    chmod -x archive-git2tgz/main.php
    ln -s archive-git2tgz/main.php /usr/local/sbin/archive_git2tgz

Configure
---------

* Edit config
    vim /opt/archive-git2tgz/main.php

 * Setup variables (according to your environnement) $dirTemp, $dirFinal

Run
----------

 * Run :
    archive_git2tgz


TODO
---------

* Documentation for other Plateform setup (Gentoo, BSD, OSX, Win).
* Try => issue => try => issue => try ;-)
