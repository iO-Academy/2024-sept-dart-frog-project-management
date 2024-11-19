<?php

require_once 'src/Services/DatabaseService.php';
require_once 'src/Models/ProjectsModel.php';
require_once 'src/Services/ProjectDisplayServices.php';

$db = DatabaseService::connect();
$projectsModel = new ProjectsModel($db);

$idLink = $_GET['project'] ?? 1;

$showProjectByID = $projectsModel->getProjectById(4);

$projectID = $projectsModel->getProjectById($idLink);