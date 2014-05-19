<?php 
include 'header.php';
$view = 'actor view';

/*
 * Picked this email address since it's a pretty common one.
 */
$response = $report->Statistics->GetActor('tincanjs-github@tincanapi.com');
?>
<div class="container-fluid">
        <div class="row">
            <div class="col-sm-3 col-md-2 sidebar">
                <ul class="nav nav-sidebar">
                    <li class="active"><a href="#">Overview</a></li>
                </ul>
            </div>
            <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
                <h1 class="page-header">Dashboard / <?php echo $view; ?></h1>
                <div class="col-md-12"><div id="collapsible"></div></div>
                <div class="page-header">
                    <h2 class="">Timeline</h2>
                </div>
                    <?php foreach($response->getStatements() as $statement): ?>
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <p>
                                    <a href="<?php if($statement->getActivityUrl()): echo $statement->getActivityUrl(); else: echo '#'; endif; ?>">
                                    <?php
                                        echo $statement->getBasicStatement();
                                    ?>
                                </a></p>
                                <i>
                                    <?php
                                        if(isset($statement->statement->timestamp)):
                                            echo $statement->getTimeElapsedString();
                                        endif;
                                    ?>
                                </i>
                                <div class="star-rating"></div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                </div>
            </div>
        </div>
    </div>
<?php include 'footer.php'; ?>