<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Project Manager</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
<header class="p-3 bg-teal-50 flex justify-between">
    <h1 class="sm:text-5xl text-4xl"><a href="index.php">Project Manager</a></h1>
</header>
<main class='p-3'>

<?php

require_once 'src/Services/DatabaseService.php';
require_once 'src/Models/UsersModel.php';
require_once 'src/Models/ProjectsModel.php';
require_once 'src/Models/ClientsModel.php';
require_once 'src/Models/TasksModel.php';
require_once 'src/Services/ProjectDisplayServices.php';
require_once 'src/Services/ProjectLinkService.php';

$db = DatabaseService::connect();
$projectsModel = new ProjectsModel($db);
$displayProjects = $projectsModel->getAllProjects();



echo "<h2 class='text-4xl font-bold mb-2'>Projects</h2>";
    echo "<section class='grid grid-cols-1 md:grid-cols-4 gap-5 mt-3'>";
        foreach ($displayProjects as $project)
            {
                $projectID = $project['id'];
                $linkProject = "project.php?project={$projectID}";

                $deadlineDate = $project['deadline'];
                if($deadlineDate) {
                    $deadline = strtotime($deadlineDate);
                    $today = date('Y-m-d H:i:s');
                    $todayDate = strtotime($today);
                    if  ($deadline < $todayDate) {
                        echo "<a href='{$linkProject}' class='hover:underline rounded-lg border border-red-600 p-4 py-6 text-4xl font-bold w-full bg-red-300'>{$project['name']}</a>";
                    } else {
                        echo "<a href='{$linkProject}' class='hover:underline rounded-lg border p-4 py-6 text-4xl font-bold w-full bg-slate-300'>{$project['name']}</a>";
                    }
                } else {
                    echo "<a href='{$linkProject}' class='hover:underline rounded-lg border p-4 py-6 text-4xl font-bold w-full bg-slate-300'>{$project['name']}</a>";
                }
            }
        echo "</section>";
?>

</main>

<footer class="border-t border-slate-300 mt-3 mx-3 p-3 pt-5">
    <p>&copy; Copyright iO Academy 2024</p>
</footer>
</body>
</html>
