<?php

class ReportTest extends PHPUnit_Framework_TestCase {

    private $report;

    public function setUp(){
        $this->report = new Report();
    }

    public function tearDown(){
        //Closing down report class.
        $this->report = null;
    }

    public function testConnectLrs(){
        // Set up
        $endpoint = 'http://learninglocker.banetworks.nl/data/xAPI/';
        $username = '6e4cd6f48be6114142e4f480ba79831aef335f27';
        $password = 'dd45015eedb66a514a2ce566ab3af8e11f656da7';
        $auth = 'Basic ' . base64_encode($username . ':' . $password);
        $version = '1.0.1';

        // Act: Everything here in preperation and then to check if the TinCan Library is still working as expected.
        $result = $this->report->connectLrs($endpoint,$username,$password);

        // Assert
        $this->assertTrue($result);
        $this->assertEquals($auth, $this->report->lrs->getAuth());
        $this->assertEquals($version, $this->report->lrs->getVersion());
        $this->assertEquals($endpoint, $this->report->lrs->getEndpoint());
    }

    public function testAddAgent(){
        // Set up
        $email = 'tincanjs-github@tincanapi.com';
        $name = 'Tin Can';

        // Act
        // Email is the only required variable here, having name set is more elegant in the output of the statement.
        // Case 1:
        $result = $this->report->addAgent($email, $name);

        // Case 2:
        $result2 = $this->report->addAgent($email);

        // Assert
        // Case 1: 
        $this->assertTrue($result);
        $this->assertEquals($email, $result->agent->getMbox());
        $this->assertEquals($name, $result->agent->getName());

        // Case 2:
        $this->assertTrue($result2);
        $this->assertEquals($email, $result2->agent->getMbox());
        $this->assertNull($result2->agent->getName()); // Should return NULL since $name was not set.
    }

}
?>