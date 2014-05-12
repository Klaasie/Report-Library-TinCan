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
        $email = 'klaas.poortinga@brightalley.nl';
        $name = 'Klaas Poortinga';

        // Act
        $result = $this->report->addAgent($email, $name);
        $result2 = $this->report-.addAgent($email);

        // Assert
        $this->assertTrue($result);
        $this->assertTrue($result2);
        $this->assertEquals($email, $this->report->agent->getMbox()); //MOOORE

    }

}
?>