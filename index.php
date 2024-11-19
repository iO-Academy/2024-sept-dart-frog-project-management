<?php

require_once 'src/Services/DatabaseService.php';
require_once 'src/Models/UsersModel.php';
require_once 'src/Models/ProjectsModel.php';
require_once 'src/Models/TasksModel.php';

$db = DatabaseService::connect();

$usersModel = new UsersModel($db);
$projectsModel = new ProjectsModel($db);
$taskModel = new TasksModel($db);

$testProjectbyID = $projectsModel->getProject(4);
$testUsers = $usersModel->getAllUsers();
$testUsersByID = $usersModel->getUserById(12);
$taskTest = $taskModel->selectTask();

echo '<pre>';
var_dump($testProjectbyID);
var_dump($taskTest);

