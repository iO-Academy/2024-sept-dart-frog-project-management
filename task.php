<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Project Manager - Project Name</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="h-full">
<header class="p-3 bg-teal-50 flex justify-between">
    <h1 class="sm:text-5xl text-4xl"><a href="index.php">Project Manager</a></h1>
    <div class="pr-3 flex">
        <a href="task.php" class="p-3 bg-slate-300 rounded-l-lg border-y border-l">🇬🇧</a>
    </div>
</header>
<main class="p-3">

<?php

require_once 'src/Services/DatabaseService.php';
require_once 'src/Models/TasksModel.php';
require_once 'src/Entities/TaskEntity.php';
require_once 'src/Services/DateService.php';

$db = DatabaseService::connect();
$tasksModel = new TasksModel($db);

if (isset($_GET['task']))
{
    $taskIdLink = $_GET['task'];
} else
{
    $taskIdLink = 1;
}

$displayTask = $tasksModel->selectTaskById($taskIdLink);
$displayTaskName = $displayTask->name;
$displayTaskDescription = $displayTask->description;
$displayTaskEstimate = $displayTask->estimate;
$displayTaskDeadline = $displayTask->deadline;
$displayTaskUser = $tasksModel->displayTaskUser($taskIdLink);
$displayTaskUserName = $displayTaskUser->name;
$displayTaskUserAvatar = $displayTaskUser->avatar;
$dateNewFormat = DateService::reformatDateUK($displayTaskDeadline);

?>

    <div class="flex justify-between mb-3">
        <h2 class="text-4xl font-bold mb-2"><?php echo $displayTaskName?>
            <a href="project.php" class="text-base text-blue-600 hover:underline ms-3">Return to project</a>
        </h2>
        <div class="flex items-center gap-3">
            <h3 class="text-3xl font-bold"><?php echo $displayTaskUserName?></h3>
            <img class="w-[50px]" src=<?php echo $displayTaskUserAvatar?> alt="profile pic" />
        </div>
    </div>
    <section class="flex flex-wrap p-4">
        <div class="w-1/2">
            <h5 class="text-lg font-bold">Task Estimate:</h5>
            <p><?php echo $displayTaskEstimate?></p>
        </div>
        <div class="w-1/2">
            <h5 class="text-lg font-bold">Task Deadline:</h5>
            <?php  if (DateService::checkDeadlineOverdue($displayTaskDeadline)){
                echo "<p class=\"text-red-500\">$dateNewFormat</p>";
            } else {
                echo "<p class=\"text-black\">$dateNewFormat</p>";
            }
            ?>
        </div>
        <div class="w-full my-3">
            <h5 class="text-lg font-bold">Task Description:</h5>
            <p><?php echo $displayTaskDescription?></p>
        </div>
    </section>
</main>

<footer class="border-t border-slate-300 mt-3 mx-3 p-3 pt-5">
    <p>&copy; Copyright iO Academy 2024</p>
</footer>
</body>
</html>