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
        $result = $this->report->Statistics->pastDay();
        $randomStatement = $result->getRandomStatement(); //Getting a random statement because we just need one here.
        $actorName = $randomStatement->getActorName();
        $actorValues = Report::actorValues($randomStatement->statement->actor);

        // Assert
        if($actorValues->name){
            $this->assertEquals($actorValues->name, $actorName);
        }else{
            $this->assertEquals($actorValues->id, $actorName);
        }

    }

    public function testGetVerbName(){
        // Act
        $result = $this->report->Statistics->pastDay();
        $randomStatement = $result->getRandomStatement(); //Getting a random statement because we just need one here.
        $verbName = $randomStatement->getVerbName();

        // Assert
        if(isset($randomStatement->statement->verb->display->{'en-US'})){
            $this->assertEquals($randomStatement->statement->verb->display->{'en-US'}, $verbName);
        }else{
            $this->assertEquals($randomStatement->statement->verb->id, $verbName);
        }
    }

    public function testGetActivityName(){
        // Act
        $result = $this->report->Statistics->pastDay();
        //Getting a random statement because we just need one here.
        $randomStatement = $result->getRandomStatement(); 
        $activityName = $randomStatement->getactivityName();

        // Assert
        if(isset($randomStatement->statement->object->definition->name->{'en-US'})){
            $this->assertEquals($randomStatement->statement->object->definition->name->{'en-US'}, $activityName);
        }else{
            $this->assertEquals($randomStatement->statement->object->id, $activityName);
        }
    }

    public function testGetTimeElapsedString(){
        // Act
        $statement = new stdClass();

        // Making sure the timestamp is at the same location as a tin can statement
        $statement->timestamp = "2014-05-16T14:43:17+02:00";
        // Initializing a new statement class
        $statement = new Statement($statement);
        // Finally retrieving the timestamp we just set with the method
        $timeFormat = $statement->getTimeElapsedString();
        $timeFormatFull = $statement->getTimeElapsedString(true);

        $test1 = false;
        if(strpos($timeFormat, "ago") !== false){
            $test1 = true;
        }
        $test2 = false;
        if(strpos($timeFormatFull, "seconds")){
            $test2 = true;
        }

        // Assert
        $this->assertTrue($test1);
        $this->assertTrue($test2);
    }
}
?>