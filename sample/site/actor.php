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
                <h2>Timeline</h2>
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
                                            echo $statement->getBasicStatement($statement);
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
<?php include 'footer.php'; ?>