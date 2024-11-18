<?php

require_once 'src/Services/DatabaseService.php';
require_once 'src/Models/ProjectsModel.php';
require_once 'src/Models/ClientsModel.php';

$db = DatabaseService::connect();

//$projectModel = new ProjectsModel($db);
//$test = $projectModel->selectProject();
//echo '<pre>';
//var_dump($test);

$clientsModel = new ClientsModel($db);
$allClients = $clientsModel->getAllClients();
$singleClient = $clientsModel->getClientById(13);

echo '<pre>';
var_dump($singleClient);
var_dump($allClients);