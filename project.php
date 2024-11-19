<?php

require_once 'src/Services/DatabaseService.php';
require_once 'src/Entities/ProjectEntity.php';
require_once 'src/Services/ProjectDisplayServices.php';
require_once 'src/Models/ProjectsModel.php';

$db = DatabaseService::connect();

//    private PDO $db;
//    public function __construct(PDO $db)
//    {
//        $this->db = $db;
//    }

$projectsModel = new ProjectsModel($db);

    $project = $projectsModel->getProjectById(12);

    echo ProjectDisplayService::displayProject($project);
