<?php

require_once 'src/Services/DatabaseService.php';
require_once 'src/Models/UsersModel.php';

$db = DatabaseService::connect();

$usersModel = new UsersModel($db);

$test = $usersModel->getAllUsers();
$testByID = $usersModel->getUserById(10);

echo '<pre>';
var_dump($testByID);

