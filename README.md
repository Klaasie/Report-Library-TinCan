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

Retrieving statistics is as easy as:

```php
$response = $lrs->Statistics->pastMonth(); //Get monthly statistics
$response = $lrs->Statistics->pastMonth()->filterActors(); //Retrieves amount of monthly actors
```

Or use the Analyse class to get suggestions or compare actors!

```php
$response = $lrs->Analyse->getSuggestions(5); //Retrieves the 5 most popular activities
$response = $lrs->Analyse->compareActors(array(actor1, actor2, ..)) //Retrieves the activities these actors have in common
```

#### Information

For a demo go to http://report.klaasweb.nl

Documentation: http://report.klaasweb.nl/phpdoc/classes/Report.html
