<?php 
/** 
 *
 */
class StatisticsTest extends PHPUnit_Framework_TestCase {

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

    public function testAllTime(){
        // Act: get all statistics
        $test = $this->report->Statistics->allTime();

        // Assert
        $this->assertTrue(isset($test)); // Check if query was a success.
        $this->assertTrue($test->response->success); // Second check
        $this->assertGreaterThan(0, $test->getCount()); // Check if at least 1 statement is being returned.
    }

    public function testPastMonth(){
        // Act: get monthly statistics
        $test = $this->report->Statistics->pastMonth();

        // Assert
        $this->assertTrue(isset($test)); // Check if query was a success.
        $this->assertTrue($test->response->success); // Second check
        $this->assertGreaterThan(0, $test->getCount()); // Check if at least 1 statement is being returned.
    }

    public function testPastWeek(){
        // Act: get weekly statistics
        $test = $this->report->Statistics->pastWeek();

        // Assert
        $this->assertTrue(isset($test)); // Check if query was a success.
        $this->assertTrue($test->response->success); // Second check
        $this->assertGreaterThan(0, $test->getCount()); // Check if at least 1 statement is being returned.
    }

    public function testPastDay(){
        // Act: get daily statistics
        $test = $this->report->Statistics->pastDay();

        // Assert
        $this->assertTrue(isset($test)); // Check if query was a success.
        $this->assertTrue($test->response->success); // Second check
    }

    public function testGetMonth(){
        // Act

        // Assert

    }

    /**
    * @todo Check for all 3 if it actually returns the specific function. Right now it just checks if the array is correctly filtered.
    */
    public function testFilterActors(){
        // Act
        $test = $this->report->Statistics->pastMonth()->filterActors();
        $number = $test->getCount();

        // Assert
        $this->assertEquals($number, count(array_filter($test->response->actors)));
    }

        public function testFilterVerbs(){
        // Act
        $test= $this->report->Statistics->pastMonth()->filterVerbs();
        $number = $test->getCount();

        // Assert
        $this->assertEquals($number, count(array_filter($test->response->verbs)));
    }

        public function testFilterActivities(){
        // Act
        $test= $this->report->Statistics->pastMonth()->filterActivities();
        $number = $test->getCount();

        // Assert
        $this->assertEquals($number, count(array_filter($test->response->activities)));
    }

    public function testGetActor(){
        // Act

        // Assert

    }

    public function testGetVerb(){
        // Act

        // Assert

    }

    public function testGetActivity(){
        // Act

        // Assert

    }

    public function testGetCount(){
        // Act

        // Assert

    }

    public function testGetStatements(){
        // Act

        // Assert

    }

    public function testGetRandomStatement(){
        // Act

        // Assert

    }
}

?>