<?php 
    require '../vendor/autoload.php';

    $report = new Report();

    $report->connectLrs('http://learninglocker.banetworks.nl/data/xAPI/','6e4cd6f48be6114142e4f480ba79831aef335f27','dd45015eedb66a514a2ce566ab3af8e11f656da7');
    $response = $report->Statistics->monthly();

    var_dump($report->Statistics->actors($response->statements));

    //var_dump($response->httpResponse);

    // $dateTime = DateTime::createFromFormat(
    //     DateTime::ISO8601,
    //     '2009-04-16T12:07:23.596Z'
    // );

    // $objDate = new DateTime('-1 month');
    // var_dump($objDate);
    // echo $objDate->format(DateTime::ISO8601);
    // echo "<br />2013-05-18T05:32:34.804Z"
    //var_dump($objDate);

    //$response = $report->Statistics->all();
    //var_dump($response->success);
?>


<html>
<head>
    <title>
        First draft report tool.
    </title>
    <style type="text/css">
        body {
            background-color: #E9EAEE;
        }
        .wrapper {
            width: 1024px;
            margin: 0 auto;
            font-family: Helvetica;
        }

        .statistics {

        }
        .statistics-title {
            float: left;
            width: 999px;
            padding: 5px 0 5px 25px;
            background: #373737;
            color: #fff;
            border: 1px solid;
            border-color: #e5e6e9 #dfe0e4 #d0d1d5;
            -webkit-border-radius: 3px;
            margin-bottom: 5px;
        }

        .green {
            background: #5EF46B;
            text-shadow: 1px 1px 1px rgba(150, 253, 159, 1);
        }

        .blue {
            background: #5E75F4;
            text-shadow: 1px 1px 1px rgba(136, 155, 225, 1);
        }

        .orange {
            background: #F4C05E;
            text-shadow: 1px 1px 1px rgba(255, 220, 153, 1);
        }

        .red {
            background: #F45E5E;
            text-shadow: 1px 1px 1px rgba(255, 141, 141, 1);
        }

        .statistics-block {
            margin: 0 1% 10px 0;
            width: 20%;
            float: left;
            padding: 25px 0 25px 25px;
            border: 1px solid;
            border-color: #e5e6e9 #dfe0e4 #d0d1d5;
            -webkit-border-radius: 3px;
        }

        .statstistics-block-value {
            float: left;
            font-size: 54px;
            font-weight: 900;
            width: 30%;
        }

        .statistics-block-title {
            float: left;
            font-size: 18px;
            font-weight: bold;
            width: 70%;
            text-transform: uppercase;
            margin-top: 10px;
        }

        .statement-block {
            width: 75%;
            float: left;
            padding: 25px 0 25px 25px;
            margin-bottom: 10px;
            background: #fff;
            border: 1px solid;
            border-color: #e5e6e9 #dfe0e4 #d0d1d5;
            -webkit-border-radius: 3px;
        }
    </style>
<body>
    <div class="wrapper" style="">

        <div class="statistics">
            <div class="statistics-title">
                Statistics
            </div>
            <div class="statistics-block green">
                <div class="statstistics-block-value">
                    <?php echo $response->count; ?>
                </div>
                <div class="statistics-block-title">Monthly Statements</div>
            </div>

            <div class="statistics-block blue">
                <div class="statstistics-block-value">
                    <?php echo count($report->Statistics->actors($response->statements)); ?>
                </div>
                <div class="statistics-block-title">Monthly Actors</div>
            </div>

            <div class="statistics-block orange">
                <div class="statstistics-block-value">
                    <?php echo $response->count; ?>
                </div>
                <div class="statistics-block-title">Monthly verbs</div>
            </div>

            <div class="statistics-block red">
                <div class="statstistics-block-value">
                    <?php echo $response->count; ?>
                </div>
                <div class="statistics-block-title">Monthly activities</div>
            </div>
        </div>

        <?php
            /*
            List of all the statements
            */
            foreach( $response->statements as $statement):
                // var_dump($statement); exit;
                // echo '<br /><br />';
        ?>
            <div class="statement-block">
        <?php
                if(isset($statement->actor->name)):
                    echo $statement->actor->name . ' ';
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
            </div>
        <?php
            endforeach;
        ?>
    </div>
</body>
</html>

