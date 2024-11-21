<?php

require_once 'src/Services/ClientDisplayService.php';
require_once 'src/Entities/ClientEntity.php';

class ClientDisplayServiceTest extends \PHPUnit\Framework\TestCase{

public function testDisplayClient(){
    $mockClient = $this->createMock(ClientEntity::class);
    $mockClient->name = 'test';
    $actual = ClientDisplayService::displayClient($mockClient);
    $expected = "<h3>test</h3>";
    $this->assertEquals($expected, $actual);
    }

}
