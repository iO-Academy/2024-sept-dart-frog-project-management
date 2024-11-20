<?php

require_once 'src/Services/DeadlineDateService.php';

class DeadlineDateServiceTest extends \PHPUnit\Framework\TestCase
{
    public function testOverdueNull ()
    {
        $deadlineDate = NULL;
        $actual = DeadlineDateService::checkDeadlineOverdue($deadlineDate);
        $expected = false;
        $this->assertEquals($expected, $actual);
    }

    public function testOverdueTrue()
    {
        $deadlineDate = '2023-04-08';
        $actual = DeadlineDateService::checkDeadlineOverdue($deadlineDate);
        $expected = true;
        $this->assertEquals($expected, $actual);
    }

    public function testOverdueFalse()
    {
        $deadlineDate = '2025-10-17';
        $actual = DeadlineDateService::checkDeadlineOverdue($deadlineDate);
        $expected = false;
        $this->assertEquals($expected, $actual);
    }
}