<?php 
/** 
 *
 */
class StatisticsTest extends PHPUnit_Framework_TestCase {
    // Arrange
    private $report;

    public function setUp(){
        // Set up the report class.
        $this->report = new Report();
        // Connecting to public LRS.
        $this->report->connectLrs('https://cloud.scorm.com/ScormEngineInterface/TCAPI/public/','username','VGVzdFVzZXI6cGFzc3dvcmQ=');
    }

    public function tearDown(){
        // Closing down report class.
        $this->report = null;
    }

    public function TestGetBasicStatement(){
        // Act

        // Assert

    }

    public function TestGetActorName(){
        // Act

        // Assert

    }

    public function TestGetVerbName(){
        // Act

        // Assert

    }

    public function TestGetActivityName(){
        // Act

        // Assert

    }

    public function TestGetActivityUrl(){
        // Act

        // Assert

    }

}
?>