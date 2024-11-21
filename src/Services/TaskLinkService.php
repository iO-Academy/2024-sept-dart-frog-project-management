<?php

require_once 'src/Services/DatabaseService.php';
$db = DatabaseService::connect();

$tasksModel = new TasksModel($db);

if (isset($_GET['task']))
{
    $taskIdLink = $_GET['task'];
} else
{
    $taskIdLink = 1;
}