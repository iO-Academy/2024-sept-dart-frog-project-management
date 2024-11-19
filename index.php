<?php

require_once 'src/Services/DatabaseService.php';
require_once 'src/Models/UsersModel.php';
require_once 'src/Models/ProjectsModel.php';
require_once 'src/Models/ClientsModel.php';
require_once 'src/Models/TasksModel.php';
require_once 'src/Services/ProjectDisplayServices.php';

$db = DatabaseService::connect();


$clientsModel = new ClientsModel($db);
$allClients = $clientsModel->getAllClients();
$singleClient = $clientsModel->getClientById(13);

echo '<pre>';
var_dump($singleClient);
var_dump($allClients);

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