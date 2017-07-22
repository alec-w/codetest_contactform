Code Test - Contact Page
========================

This is a code test to demonstrate a contact page.

Frameworks
----------

  * Backend - [**Symfony**][3] framework. Whilst this might be
    considered overkill for simply a contact page, a contact page would usually
    be part of a larger site where it would then be only practical to use some
    sort of MVC framework. By using Symfony things like routing, request
    handling, and creation of forms with CSRF tokens become much quicker to
    create. It also has many open-source plugins, which meant that implementing
    Recaptcha on the contact page was significantly simpler. Symfony also
    incorporates Doctrine and the Twig template engine, which means that
    properly escaping sql query parameters and escaping html characters is
    already handled correctly (provided the frameworks are used correctly).

  * Frontend - [**Bootstrap**][4] framework. This made creating a
    user-friendly interface much simpler and it also makes it easy to
    adjust the web page to work on a a variety of device sizes if that was
    later needed.

Third party plugins
-------------------

The  [**EWZRecaptchaBundle**][1] was used to add in Recaptcha functionality to
the contact page form.

Requirements
------------

Before you can use this repository you will need:

  1. WAMP (or similar stack) installed and running PHP 7.x.

  2. Composer installed.

  3. An email service (the simplest way is to create a gmail account and
     then choose gmail for your mailer_transport and provide your gmail
     username/password when prompted during the installation - be sure to
     turn on "allow less secure apps" for your gmail account to allow
     emails to be sent from it through this app).

  4. A Google recaptcha public/private key pair. Go to the
     [**Google Recaptcha Admin**][2] page and then add localhost to the
     list of domains. Save your public and private keys (visible under
     the client/server side integration dropdowns).

Installation
------------

These instructions were tested on WAMP, for other setups minor adjustments may
be needed.

  * Clone the repository to your desired directory.

  * Inside the root directory of the repository run `composer install`. This
    will bring in Symfony and its dependencies along with the
    EWCRecaptchaBundle.
  
  * Once all the dependencies are installed you wil be asked to provide the
    details for the parameters file. The details you will need are your
    database host and port, your chosen database name, login credentials for
    the database, your chosen mailer transport and host, login credentials
    for the mailer service, a secret key (used for CSRF token generation)
    and the public/private keys for your recaptcha.

  * Now run the command `php bin/console doctrine:database:create` to
    create the database with the name you just chose.

  * Now run the command `php bin/console doctrine:schema:create` to create
    the tables (only 1 actually).
  
  * Finally, run `php bin/console server:run` to start the built-in server
    in Symfony.

If you ensure WAMP is running (for the database) and point your browser to
`localhost:8000` you should see the contact page.

The above instructions will setup the app in a dev environment (so the Symfony
profiler will also be running). To deploy as if in a production environment
(assuming you have just cloned the repositroy) run the following sequence
of commands:

```
export SYMFONY_ENV=prod
# Ignore the error that comes up about unknown database with the next command
composer install --no-dev --optimize-autoloader
php bin/console doctrine:database:create
php bin/console doctrine:schema:create
# Run composer again to finish it off now we have the database
composer install --no-dev --optimize-autoloader
php bin/console cache:clear --env=prod --no-debug --no-warmup
php bin/console cache:warmup --env=prod
```

You will need to use .htaccess or other redirect methods to redirect users
into the application as appropriate for your production environment.

[1]:  https://github.com/excelwebzone/EWZRecaptchaBundle
[2]:  https://www.google.com/recaptcha/admin
[3]:  http://symfony.com/
[4]:  http://getbootstrap.com/