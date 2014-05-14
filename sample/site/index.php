<?php
include('header.php');
$view = "manager view";

/*
 * Getting daily statements to reduce page load.
 */
$response = $report->Statistics->pastMonth();
?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-3 col-md-2 sidebar">
                <ul class="nav nav-sidebar">
                    <li class="active"><a href="index.php">Overview</a></li>
                    <!--<li><a href="manager-analyse.php">Analyse</a></li>-->
                </ul>
            </div>
            <div class="col-sm-9 col-sm-offset-3 col-md-8 col-md-offset-2">
                <h1 class="page-header">Dashboard / <?php echo $view; ?></h1>
                <div class="col-md-12"><div id="collapsible"></div></div>
                <div class="row placeholders">
                    <div class="col-xs-6 col-sm-3 placeholder">
                        <div class="panel panel-success">
                            <!-- Default panel contents -->
                            <div class="panel-heading">
                                <h4><?php echo $response->getCount(); ?> </h4>
                                <span class="">Monthly Statements</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-6 col-sm-3 placeholder">
                         <div class="panel panel-info">
                            <!-- Default panel contents -->
                            <div class="panel-heading">
                                <h4><?php echo $response->filterActors()->getCount(); ?> </h4>
                                <span class="">Monthly Actors</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-6 col-sm-3 placeholder">
                         <div class="panel panel-warning">
                            <!-- Default panel contents -->
                            <div class="panel-heading">
                                <h4><?php echo $response->filterVerbs()->getCount(); ?> </h4>
                                <span class="">Monthly Verbs</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-6 col-sm-3 placeholder">
                         <div class="panel panel-danger">
                            <!-- Default panel contents -->
                            <div class="panel-heading">
                                <h4><?php echo $response->filterActivities()->getCount(); ?> </h4>
                                <span class="">Monthly activities</span>
                            </div>
                        </div>
                    </div>
                </div>
                <?php $statement = $response->getRandomStatement(); ?>
                <a href="<?php if($statement->getActivityUrl()): echo $statement->getActivityUrl(); else: echo '#'; endif; ?>">
                    <div class="alert alert-info">
                        <b>Random Suggestion: </b><br />
                        <?php
                            echo $statement->getBasicStatement();
                        ?>
                    </div>
                </a>
                <div class="page-header">
                    <h2 class="">Newsfeed</h2>
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
                                        if(isset($statement->timestamp)):
                                            echo $response->getTimeElapsedString($statement->timestamp);
                                        endif;
                                    ?>
                                </i>
                                <div class="star-rating"></div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="col-sm-3 col-md-2 sidebar-right">
                <?php if(Report::$agent): ?>
                    <h4>Hello <?php echo Report::$agent->getName(); ?>!</h4>
                    <hr />
                <?php endif; ?>
                <div class="panel panel-primary">
                    <div class="panel-heading">Suggestions</div>
                    <ul class="list-group">
                        <?php foreach($report->Analyse->getSuggestions(5) as $suggestion => $value): ?>
                            <li class="list-group-item"><a href="<?php echo $suggestion; ?>"><?php echo $value['title']; ?></a></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
<?php include('footer.php'); ?>