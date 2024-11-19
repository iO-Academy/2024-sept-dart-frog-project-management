<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Project Manager</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
<header class="p-3 bg-teal-50 flex justify-between">
    <h1 class="sm:text-5xl text-4xl"><a href="index.html">Project Manager</a></h1>
</header>
<?php

require_once 'src/Services/DatabaseService.php';
require_once 'src/Models/UsersModel.php';
require_once 'src/Models/ProjectsModel.php';
require_once 'src/Models/ClientsModel.php';
require_once 'src/Models/TasksModel.php';

$db = DatabaseService::connect();

$projectsModel = new ProjectsModel($db);

$testProjectbyID = $projectsModel->getProject(4);
$displayProjects = $projectsModel->getAllProjects();

$displayProjectName = $projectsModel->displayProjectName(1);

echo '<pre>';
//var_dump($testProjects);
//var_dump($displayProjectName['name']);

echo "<main class='p-3'>";
echo "<h2 class='text-4xl font-bold mb-2'>Projects</h2>";
echo "<section class='flex justify-start gap-5 mt-3 flex-wrap md:flex-nowrap'>";

            foreach ($displayProjects as $project)
            {

                // if $project['deadline'] > $today
                echo "<a href='project.html' class='hover:underline rounded-lg border p-4 py-6 text-4xl font-bold w-full md:w-1/4 bg-slate-300'>{$project['name']}</a>";

                //else
                //echo <a href="project.html" class="hover:underline rounded-lg border border-red-600 p-4 py-6 text-4xl font-bold w-full md:w-1/4 bg-red-300">{$project['name']}</a>
            }

echo "</section>";
echo "</main>";

?>
<footer class="border-t border-slate-300 mt-3 mx-3 p-3 pt-5">
    <p>&copy; Copyright iO Academy 2024</p>
</footer>
</body>
</html>
