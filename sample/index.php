<?php 
    require '../vendor/autoload.php';

    $test = new Report();

    $test->connect_lrs('http://learninglocker.banetworks.nl/data/xAPI/','6e4cd6f48be6114142e4f480ba79831aef335f27','dd45015eedb66a514a2ce566ab3af8e11f656da7');
    $test->Statistics = new Statistics();

    echo $test->Statistics->test();


?>