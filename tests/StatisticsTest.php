<?php 
/** 
 *@todo Guide to connect to your own LRS here.
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

    public function testAll(){
        // Act: get all statistics
        $test = $this->report->Statistics->all();

        // Assert
        $this->assertTrue(isset($test)); // Check if query was a success.
        $this->assertTrue($test->response->success); // Second check
        $this->assertGreaterThan(0, $test->getCount()); // Check if at least 1 statement is being returned.
    }

    public function testMonthly(){
        // Act: get monthly statistics
        $test = $this->report->Statistics->monthly();

        // Assert
        $this->assertTrue(isset($test)); // Check if query was a success.
        $this->assertTrue($test->response->success); // Second check
        $this->assertGreaterThan(0, $test->getCount()); // Check if at least 1 statement is being returned.
    }

    public function testWeekly(){
        // Act: get weekly statistics
        $test = $this->report->Statistics->weekly();

        // Assert
        $this->assertTrue(isset($test)); // Check if query was a success.
        $this->assertTrue($test->response->success); // Second check
        $this->assertGreaterThan(0, $test->getCount()); // Check if at least 1 statement is being returned.
    }

    public function testDaily(){
        // Act: get daily statistics
        $test = $this->report->Statistics->daily();

        // Assert
        $this->assertTrue(isset($test)); // Check if query was a success.
        $this->assertTrue($test->response->success); // Second check
    }

    /**
     * @todo
     * Check for all 3 if it actually returns the specific function. Right now it just checks if the array is correctly filtered.
     */
    public function testActors(){
        // Act
        $test = $this->report->Statistics->monthly()->actors();
        $number = $test->getCount();

        // Assert
        $this->assertEquals($number, count(array_filter($test->response->actors)));
    }

        public function testVerbs(){
        // Act
        $test= $this->report->Statistics->monthly()->verbs();
        $number = $test->getCount();

        // Assert
        $this->assertEquals($number, count(array_filter($test->response->verbs)));
    }

        public function testActivities(){
        // Act
        $test= $this->report->Statistics->monthly()->activities();
        $number = $test->getCount();

        // Assert
        $this->assertEquals($number, count(array_filter($test->response->activities)));
    }

    public function testGetTimeElapsedString(){
        // Act

        // Assert

    }

    public function testGetRandom(){
        // Act

        // Assert

    }
}

?>