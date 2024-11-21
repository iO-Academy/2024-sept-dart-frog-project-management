<?php

use PHPUnit\Framework\TestCase;

require_once 'src/Entities/ProjectEntity.php';
require_once 'src/Services/ProjectDisplayServices.php';

class ProjectDisplayServicesTest extends TestCase
{
    public function testProjectDisplayServices()
    {
        $mockProject = $this->createMock(ProjectEntity::class);
        $mockProject->name = 'test';
        $actual = ProjectDisplayService::displayProject($mockProject);
        $expected = "<div>test</div>";
        $this->assertEquals($expected, $actual);
    }
}