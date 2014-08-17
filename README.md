archive-git2tgz
===============

Archive creator that pull from a set of git repository and produce a directory tree of tar.gz files

Tested under : Debian 6 and 7.1

Install
---------

* Setup environnement

<pre>
apt-get install php5-cli git tar
</pre>

* Get source

<pre>
cd /opt/
git clone https://github.com/doogaille/archive-git2tgz.git
</pre>

* Setup system link

<pre>
chmod -x archive-git2tgz/main.php
ln -s archive-git2tgz/main.php /usr/local/sbin/archive_git2tgz
</pre>

Configure
---------

* Edit config

<pre>vim /opt/archive-git2tgz/main.php</pre>

 * Setup variables (according to your environnement) $dirTemp, $dirFinal

Run
----------

 * Run :

<pre>
archive_git2tgz
</pre>

TODO
---------

* Documentation for other Plateform setup (Gentoo, BSD, OSX, Win).
* Try => issue => try => issue => try ;-)
