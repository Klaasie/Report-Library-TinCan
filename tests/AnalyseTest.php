<?php 
/**
 * These tests should be more meaningfull.
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

    public function testGetSuggestions(){
        // Act: get all statistics
        $activities = $this->report->Analyse->getSuggestions();

        // Assert
        $this->assertTrue(isset($activities));
    }

    public function testCompareActors(){
        // Act: get all statistics
        $activities = $this->report->Analyse->compareActors(array('test@beta.projecttincan.com','tincanjs-github@tincanapi.com'));

        // Assert
        $this->assertTrue(isset($activities));
    }

}
?>