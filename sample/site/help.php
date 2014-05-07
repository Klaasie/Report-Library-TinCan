<?php include 'header.php'; ?>
<?php $view = 'actor view'; ?>
<div class="container-fluid">
        <div class="row">
            <div class="col-sm-3 col-md-2 sidebar">
                <ul class="nav nav-sidebar">
                    <li class="active"><a href="#">Overview</a></li>
                </ul>
            </div>
            <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
                <h1 class="page-header">Help</h1>
                <div class="col-md-12"><div id="collapsible"></div>
                    <h3>Tin Can PHP Report Library</h3>

                    <p>This is an very early draft of a Tin Can Report Library. Goal of this library is to make it easy to query and analyse Tin Can statements.</p>

                    <h4>Getting started</h4>

                    <p>
                        Clone the repository <a href="https://github.com/Klaasie/Report-Library-TinCan">here</a>.<br /><br />

                        Add the autoloader to the page. <br />

                            <div class="well"> require '/vendor/autoload.php';</div>

                        Connect to your LRS using:<br />

                            <div class="well">
                                $lrs = new Report();<br />
                                $lrs->connectLrs('lrs_endpoint','lrs_username','lrs_password');
                            </div>

                        Retrieving statements is as easy as:<br />

                            <div class="well">
                                $response = $lrs->Statistics->monthly(); //Get monthly statistics <br />
                                $response = $lrs->Statistics->monthly()->actors(); //Retrieves amount of monthly actors
                            </div>
                    </p>
                    
                    <h4>Information</h4>

                    <p>
                        For a demo go to <a href="http://report.klaasweb.nl/sample/site/">http://report.klaasweb.nl</a><br />

                        Documentation: <a href="http://report.klaasweb.nl/phpdoc/classes/Report.html">http://report.klaasweb.nl/phpdoc/classes/Report.html</a>
                    </p>

                </div>
            </div>
        </div>
    </div>
<?php include 'footer.php'; ?>