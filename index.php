<?php

require_once 'src/Services/DatabaseService.php';
require_once 'src/Models/ProjectsModel.php';
require_once 'src/Models/TasksModel.php';

$db = DatabaseService::connect();

$projectModel = new ProjectsModel($db);

$taskModel = new TasksModel($db);

$test = $projectModel->selectProject();

$taskTest = $taskModel->selectTask();

echo '<pre>';
var_dump($taskTest);