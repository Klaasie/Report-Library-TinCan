<?php 
/** 
 * @todo Define tests
 */
class StatementTest extends PHPUnit_Framework_TestCase {
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

    public function testGetBasicStatement(){
        // Act
        $test = true;
        // Assert
        $this->assertTrue($test);
    }

    public function testGetActorName(){
        // Act

        // Assert

    }

    public function testGetVerbName(){
        // Act

        // Assert

    }

    public function testGetActivityName(){
        // Act

        // Assert

    }

    public function testGetTimeElapsedString(){
        // Act

        // Assert

    }
}
?>