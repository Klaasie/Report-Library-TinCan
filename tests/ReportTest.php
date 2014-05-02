<?php

class ReportTest extends PHPUnit_Framework_TestCase {

    public function testConnectLrs(){
        // Arrange
        $report = new Report();

        // Assert
        $this->assertTrue($report->connectLrs('http://learninglocker.banetworks.nl/data/xAPI/','6e4cd6f48be6114142e4f480ba79831aef335f27','dd45015eedb66a514a2ce566ab3af8e11f656da7'));
    }

}
?>