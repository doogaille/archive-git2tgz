archive-git2tgz
===============

Archive creator that pull from a set of git repository and produce a directory tree of tar.gz files

Compatibility (Debian)

Install
---------

* Install php5 client :
 apt-get install php5-cli

* Git clone :
 cd /opt/
 git clone https://github.com/doogaille/archive-git2tgz.git
 chmod -x archive-git2tgz/main.php
 ln -s archive-git2tgz/main.php /usr/local/sbin/archive_git2tgz

Configure
---------

* Edit config
 vim /opt/archive-git2tgz/main.php

Setup $dirTemp, $dirFinal

Run
----------

 just run cmd : archive_git2tgz


TODO
---------

* Documentation for other Plateform setup (Gentoo, BSD, OSX, Win).
* 
