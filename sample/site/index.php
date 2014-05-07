<?php
include('header.php');
$view = "manager view";

$response = $report->Statistics->daily();
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
                <div class="row placeholders">
                    <div class="col-xs-6 col-sm-3 placeholder">
                        <div class="panel panel-success">
                            <!-- Default panel contents -->
                            <div class="panel-heading">
                                <h4><?php echo $response->getCount(); ?> </h4>
                                <span class="">Daily Statements</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-6 col-sm-3 placeholder">
                         <div class="panel panel-info">
                            <!-- Default panel contents -->
                            <div class="panel-heading">
                                <h4><?php echo $response->actors()->getCount(); ?> </h4>
                                <span class="">Daily Actors</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-6 col-sm-3 placeholder">
                         <div class="panel panel-warning">
                            <!-- Default panel contents -->
                            <div class="panel-heading">
                                <h4><?php echo $response->verbs()->getCount(); ?> </h4>
                                <span class="">Daily Verbs</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-6 col-sm-3 placeholder">
                         <div class="panel panel-danger">
                            <!-- Default panel contents -->
                            <div class="panel-heading">
                                <h4><?php echo $response->activities()->getCount(); ?> </h4>
                                <span class="">Monthly activities</span>
                            </div>
                        </div>
                    </div>
                </div>

                <h2>Newsfeed</h2>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($response->getStatements() as $statement): ?>
                                <tr>
                                    <td class="first">
                                        <?php
                                            if(isset($statement->actor->name)):
                                                echo $statement->actor->name . ' ';
                                            elseif(isset($statement->actor->account)):
                                                if(isset($statement->actor->account->name)):
                                                    echo $statement->actor->account->name . ' ';
                                                else:
                                                    echo $statement->actor->account->homePage . ' ';
                                                endif;
                                            else:
                                                echo $statement->actor->mbox . ' ';
                                            endif;

                                            if(isset($statement->verb->display->{"en-US"})):
                                                echo $statement->verb->display->{'en-US'} .' ';
                                            else:
                                                echo $statement->verb->id . ' ';
                                            endif;

                                            if(isset($statement->object->definition->name->{"en-US"})):
                                                echo $statement->object->definition->name->{"en-US"};
                                            else:
                                                echo $statement->object->id;
                                            endif;
                                        ?>
                                    </td>
                                    <td>
                                        <i>
                                            <?php
                                                if(isset($statement->timestamp)):
                                                    echo $response->getTimeElapsedString($statement->timestamp);
                                                endif;
                                            ?>
                                        </i>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
<?php include('footer.php'); ?>