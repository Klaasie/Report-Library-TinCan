<?php 
/** 
 *@todo Guide to connect to your own LRS here.
 */
class AnalyseTest extends PHPUnit_Framework_TestCase {

    // Arrange
    private $report;

    public function setUp(){
        //Set up the report class.
        $this->report = new Report();
        // Connecting to public LRS.
        $this->report->connectLrs('https://cloud.scorm.com/ScormEngineInterface/TCAPI/public/','username','VGVzdFVzZXI6cGFzc3dvcmQ=');
    }

    public function tearDown(){
        //Closing down report class.
        $this->report = null;
    }

    public function testSuggestion(){
        // Act: get all statistics
        //$test = $this->report->Statistics->all();

        // Assert
        //$this->assertTrue(isset($test)); // Check if query was a success.
    }

}

?>