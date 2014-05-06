# Tin Can PHP Report Library

This is an very early draft of a Tin Can Report Library. Goal of this library is to make it easy to query and analyse Tin Can statements.

#### Getting started

Clone the repository.

Add the autoloader to the page.

    require '/vendor/autoload.php';

Connect to your LRS using:

    $lrs = new Report();
    $lrs->connectLrs('lrs_endpoint','lrs_username','lrs_password');

Retrieving statements is as easy as:

    $response = $lrs->Statistics->monthly(); //Get monthly statistics
    $response = $lrs->Statistics->monthly()->actors(); //Retrieves amount of monthly actors

#### Information

For a demo go to http://report.klaasweb.nl

Documentation: http://report.klaasweb.nl/phpdoc/classes/Report.html

#### Troubleshooting

This library uses DateTime, make sure it is set.