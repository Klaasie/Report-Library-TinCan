<?php

class ReportTest extends PHPUnit_Framework_TestCase {
    public function testTest()
    {
        // Arrange
        $report = new Report();

        // Act
        $test = $report->test();

        // Assert
        $this->assertEquals("test", $test);
    }
}
?>