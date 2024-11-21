<?php

require_once 'src/Services/ClientDisplayService.php';
require_once 'src/Entities/ClientEntity.php';

class displayClientTest extends \PHPUnit\Framework\TestCase {
    public function testDisplayClient_returnString()
    {
        $clientMock = $this->createMock(ClientEntity::class);
        $clientMock->name = "bananas";

        $actual = ClientDisplayService::displayClient($clientMock);
        $expected= "<h3>$clientMock->name</h3>";

        $this->assertEquals($expected, $actual);
    }
}