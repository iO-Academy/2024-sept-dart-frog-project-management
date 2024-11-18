<?php

require_once 'src/Services/DatabaseService.php';
require_once 'src/Models/ProjectsModel.php';

$db = DatabaseService::connect();

$projectModel = new ProjectsModel($db);

$test = $projectModel->selectProject();

echo '<pre>';
var_dump($test);