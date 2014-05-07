# Tin Can PHP Report Library

This is an very early draft of a Tin Can Report Library. Goal of this library is to make it easy to query and analyse Tin Can statements.

#### Getting started

Tin Can Report Library is available via [Composer](http://getcomposer.org).

```
php composer.phar require klaaspoortinga/tin-can-report-library:dev-master
```

With the package installed require the Composer autoloader:

```php
require 'vendor/autoload.php';
```

Connect to your LRS using:

```php
$lrs = new Report();
$lrs->connectLrs('lrs_endpoint','lrs_username','lrs_password');
```

Retrieving statements is as easy as:

```php
$response = $lrs->Statistics->monthly(); //Get monthly statistics
$response = $lrs->Statistics->monthly()->actors(); //Retrieves amount of monthly actors
```

#### Information

For a demo go to http://report.klaasweb.nl

Documentation: http://report.klaasweb.nl/phpdoc/classes/Report.html
