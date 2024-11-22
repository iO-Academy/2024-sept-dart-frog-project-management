<?php

require_once 'src/Services/EstimateService.php';

class EstimateServiceTest extends \PHPUnit\Framework\TestCase
{
    public function testConvertEstimate()
    {
        $estimate = 13;
        $actual = EstimateService::convertEstimate($estimate);
        $expected = "80 hrs / 10 days";
        $this->assertEquals($expected, $actual);
    }

    public function testEstimate_null()
    {
        $estimate = null;
        $actual = EstimateService::convertEstimate($estimate);
        $expected = null;
        $this->assertEquals($expected, $actual);
    }
}