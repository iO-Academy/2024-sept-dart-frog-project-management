<?php

require_once 'src/Services/DateService.php';

class DateServiceTest extends \PHPUnit\Framework\TestCase
{
    public function testOverdueNull ()
    {
        $deadlineDate = NULL;
        $actual = DateService::checkDeadlineOverdue($deadlineDate);
        $this->assertFalse($actual);
    }

    public function testOverdueTrue()
    {
        $deadlineDate = '2023-04-08';
        $actual = DateService::checkDeadlineOverdue($deadlineDate);
        $this->assertTrue($actual);
    }

    public function testOverdueFalse()
    {
        $deadlineDate = '2025-10-17';
        $actual = DateService::checkDeadlineOverdue($deadlineDate);
        $this->assertFalse($actual);
    }

    public function testReformatDateUKnull()
{
    $input = NULL;
    $actual = DateService::reformatDateUK($input);
    $expected = 'N/A';
    $this->assertEquals($expected, $actual);
}

    public function testReformatDateUK_WithDate()
    {
        $input = '2023-04-08';
        $actual = DateService::reformatDateUK($input);
        $expected = '08/04/23';
        $this->assertEquals($expected, $actual);
    }
}