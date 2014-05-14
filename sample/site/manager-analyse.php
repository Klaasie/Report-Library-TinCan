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
                    <li><a href="index.php">Overview</a></li>
                    <!--<li class="active"><a href="manager-analyse.php">Analyse</a></li>-->
                </ul>
            </div>
            <div class="col-sm-9 col-sm-offset-3 col-md-8 col-md-offset-2">
                <h1 class="page-header">Analyse</h1>
                <div class="col-md-12"><div id="collapsible"></div></div>

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