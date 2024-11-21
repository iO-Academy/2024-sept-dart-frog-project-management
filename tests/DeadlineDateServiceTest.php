<?php

require_once 'src/Services/DeadlineDateService.php';

class DeadlineDateServiceTest extends \PHPUnit\Framework\TestCase
{
    public function testOverdueNull ()
    {
        $deadlineDate = NULL;
        $actual = DeadlineDateService::checkDeadlineOverdue($deadlineDate);
        $this->assertFalse($actual);
    }

    public function testOverdueTrue()
    {
        $deadlineDate = '2023-04-08';
        $actual = DeadlineDateService::checkDeadlineOverdue($deadlineDate);
        $this->assertTrue($actual);
    }

    public function testOverdueFalse()
    {
        $deadlineDate = '2025-10-17';
        $actual = DeadlineDateService::checkDeadlineOverdue($deadlineDate);
        $this->assertFalse($actual);
    }

    public function testReformatDateUKnull()
{
    $input = NULL;
    $actual = DeadlineDateService::reformatDateUK($input);
    $expected = 'N/A';
    $this->assertEquals($expected, $actual);
}

    public function testReformatDateUK_WithDate()
    {
        $input = '2023-04-08';
        $actual = DeadlineDateService::reformatDateUK($input);
        $expected = '08/04/23';
        $this->assertEquals($expected, $actual);
    }



}
