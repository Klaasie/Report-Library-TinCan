<?php
require '../../vendor/autoload.php';

$report = new Report();

/*
 * Add your LRS here (or use the public LRS)
 */
$report->connectLrs('https://cloud.scorm.com/ScormEngineInterface/TCAPI/public/','username','VGVzdFVzZXI6cGFzc3dvcmQ=');
$report->addAgent('tincanjava-github@tincanapi.com', 'Test User');

?>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!--<link rel="shortcut icon" href="../../assets/ico/favicon.ico">-->

    <title>Dashboard</title>
    <!-- Star rating system css -->
    <link href="../css/labs.css" media="screen" rel="stylesheet" type="text/css">

    <!-- Bootstrap core CSS -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="../css/dashboard.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Star Rating system js -->
    <script src="../js/jquery.js"></script>
    <script src="../js/jquery.raty.js"></script>
    <script src="../js/labs.js" type="text/javascript"></script>

</head>

<body>

    <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">Report Library</a>
            </div>
            <div class="navbar-collapse collapse">
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="index.php">Manager</a></li>
                    <!--<li><a href="trainer.php">Trainer</a></li>-->
                    <li><a href="actor.php">Actor</a></li>
                    <li><a href="help.php">Help</a></li>
            </div>
        </div>
    </div>
