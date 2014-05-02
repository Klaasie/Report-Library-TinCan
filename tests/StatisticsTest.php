<?php 

class StatisticsTest extends PHPUnit_Framework_TestCase {

    // Arrange
    private $report;

    public function setUp(){
        //Set up the report class here.
        $this->report = new Report();
        $this->report->connectLrs('http://learninglocker.banetworks.nl/data/xAPI/','6e4cd6f48be6114142e4f480ba79831aef335f27','dd45015eedb66a514a2ce566ab3af8e11f656da7');
    }

    public function tearDown(){
        //Closing down report class.
        $this->report = null;
    }

    public function testAll(){
        // Act
        $test = $this->report->Statistics->all();

        // Assert
        $this->assertTrue($test->success);
    }

    public function testMonthly(){
        // Act
        $test = $this->report->Statistics->monthly();
        $date = new DateTime('-1 month');

        // Assert
        $this->assertTrue($test->success); //Check if query was a success.
        $this->assertGreaterThan(0, count($test->statements)); //Check if at least 1 statement is being returned.
    }

    public function testWeekly(){
        // Act
        //$test = $this->report->Statistics->weekly();

        // Assert
        //$this->assertTrue($test->success);
    }

    public function testDaily(){
        // Act
        //$test = $this->report->Statistics->daily();

        // Assert
        // $this->assertTrue($test->success);
    }

    /**
        @todo
        Check for all 3 if it actually returns the specific function. Right now it just checks if the array is correctly filtered.
    */
    public function testEmployees(){
        // Act
        $test= $this->report->Statistics->monthly();
        $employees = $this->report->Statistics->employees($test->statements);
        $number = count($employees);

        // Assert
        $this->assertEquals($number, count(array_filter($employees)));
        $this->

    }

        public function testVerbs(){
        // Act
        $test= $this->report->Statistics->monthly();
        $verbs = $this->report->Statistics->verbs($test->statements);
        $number = count($verbs);

        // Assert
        $this->assertEquals($number, count(array_filter($verbs)));

    }

        public function testActivities(){
        // Act
        $test= $this->report->Statistics->monthly();
        $activities = $this->report->Statistics->activities($test->statements);
        $number = count($activities);

        // Assert
        $this->assertEquals($number, count(array_filter($activities)));

    }
}

?>