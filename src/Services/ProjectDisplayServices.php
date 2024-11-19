<?php

require_once 'src/Entities/ProjectEntity.php';

class ProjectDisplayService
{
    public static function displayProject(ProjectEntity $project): string
    {
        return "<div>$project->name</div>";
    }
}