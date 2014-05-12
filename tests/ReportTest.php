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
        $this->assertEquals($auth, Report::$lrs->getAuth());
        $this->assertEquals($version, Report::$lrs->getVersion());
        $this->assertEquals($endpoint, Report::$lrs->getEndpoint());
    }

    public function testAddAgent(){
        // Set up
        $email = 'tincanjs-github@tincanapi.com';
        $name = 'Tin Can';

        // Case 1:
        // Act
        // Email is the only required variable here, having name set is more elegant in the output of the statement.
        $result = $this->report->addAgent($email, $name);

        // Case 1:
        // Assert
        $this->assertTrue($result);
        $this->assertEquals('mailto:' . $email, Report::$agent->getMbox());
        $this->assertEquals($name, Report::$agent->getName());

        // Case 2:
        // Act
        $result = $this->report->addAgent($email);

        // Case 2:
        // Assert
        $this->assertTrue($result);
        $this->assertEquals('mailto:' . $email, Report::$agent->getMbox());
        $this->assertNull(Report::$agent->getName()); // Should return NULL since $name was not set.

        // Case 3:
        // Set up
        $email = 'mailto:tincanjs-github@tincanapi.com';

        // Case 3:
        // Act
        $result = $this->report->addAgent($email);

        // Case 3:
        // Assert
        $this->assertTrue($result);
        $this->assertEquals($email, Report::$agent->getMbox()); // Checking if it doesn't add 'mailto:' to the string again.
        $this->assertNull(Report::$agent->getName()); // Should return NULL since $name was not set.
    }

}
?>