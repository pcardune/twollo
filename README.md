Twollo
======

Twollo is a simple website that allows people to look up shared twitter
connections between each other.

Development
-----------

You can fork the branch on github at http://github.com/pcardune/twollo or just
grab a clone:

    git clone git://github.com/pcardune/twollo.git

You will need to install dependencies using PEAR:

    pear install Log

You should also have memcached (and the php client library) installed and running:

    apt-get install memcached php5-memcache

Symlink the src directory to some place where Apache can serve it up.  On
Ubuntu this would typically be:

    ln -s `pwd`/twollo/src /var/www/twollo

You must have mod_rewrite enabled and the following in the relevant
configuration file (on ubuntu this is /etc/apache2/sites-enabled/000-default):

    AllowOverride All

Twollo currently uses Smarty templates and you must create the template cache
directory and make it writable by the webserver user.  On Ubuntu this would be:

    mkdir twollo/src/templates_c
    sudo chown :www-data twollo/src/templates_c
    chmod g+w twollo/src/templates_c

Now you should be able to restart apache and go to http://localhost/twollo/ to
see twollo up and running.
