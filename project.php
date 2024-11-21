<?php
require_once 'src/Services/DatabaseService.php';
require_once 'src/Entities/ProjectEntity.php';
require_once 'src/Services/ProjectDisplayServices.php';
require_once 'src/Models/ProjectsModel.php';
require_once 'src/Services/ClientDisplayService.php';
require_once 'src/Models/ClientsModel.php';
require_once 'src/Services/DateService.php';
require_once 'src/Models/TasksModel.php';
require_once 'src/Models/UsersModel.php';
require_once 'src/Services/EstimateService.php';

$db = DatabaseService::connect();

$pageLocale = $_GET['location'] ?? 'uk';

$projectsModel = new ProjectsModel($db);
$tasksModel = new TasksModel($db);
$clientsModel = new ClientsModel($db);
$usersModel = new UsersModel($db);

$idLink = $_GET['project'] ?? 1;
$project = $projectsModel->getProjectById($idLink);
$projectTitle = ProjectDisplayService::displayProject($project);
$projectDeadline = DateService::reformatDateUK($project->deadline);

$client = $clientsModel->getClientById($project->client_id);
$clientTitle = ClientDisplayService::displayClient($client);
$displayUserNameByProjectId = $usersModel->getUsersByProjectId($idLink);

?>

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
        <?php
        if ($pageLocale == 'uk') {
            echo "<a href = 'project.php?project=$idLink&location=uk' class='p-3 bg-slate-300 rounded-l-lg border-y border-l' > 🇬🇧</a >";
            echo "<a href = 'project.php?project=$idLink&location=us' class='p-3 rounded-r-lg border-y border-r' > 🇺🇸</a >";
        } else {
            echo "<a href = 'project.php?project=$idLink&location=uk' class='p-3  rounded-l-lg border-y border-l' > 🇬🇧</a >";
            echo "<a href = 'project.php?project=$idLink&location=us' class='p-3 bg-slate-300 rounded-r-lg border-y border-r' > 🇺🇸</a >";
        }
        ?>
    </div>
</header>
<main class="p-3">


            <div class="flex justify-between mb-3">
                <h2 class="text-4xl font-bold mb-2"><?php echo $projectTitle.$projectDeadline ?>
                    <a href="index.php" class="text-base text-blue-600 hover:underline ms-3">Return to all projects</a>
                </h2>
                <div class="flex items-center gap-3">
                    <h3 class="text-3xl font-bold"><?php echo $clientTitle ?></h3>
                    <img class="w-[50px]" src=<?php echo $client->logo ?> alt="client logo" />
                </div>
            </div>
        <section class="flex gap-5 flex-nowrap h-[70vh] pb-5 overflow-x-auto">
    <?php
        foreach($displayUserNameByProjectId as $taskAndUser){
            $displayUserName = $taskAndUser['username'];
            $displayUserAvatar = $taskAndUser['avatar'];
            $userID = $taskAndUser['userID'];
            echo "<div class=\"shrink-0 w-full sm:w-1/2 lg:w-1/4 h-100\">
                  <div class=\"overflow-y-auto border rounded p-3 pb-0 h-full\">
                  <h4 class=\"border-b pb-2 mb-3 text-2xl font-bold\">
                      <a href=\"\">$displayUserName</a>
                      <img
                          src=$displayUserAvatar alt=\"Project Avatar\"
                          class=\"float-right\">
                  </h4>
                ";
            $displayTasksByUser = $tasksModel->getTasksByUserAndProject($idLink, $userID);
                foreach ($displayTasksByUser as $task) {
                    $deadlineDate = $task['task_deadline'];
                    $overDeadline = DateService::checkDeadlineOverdue($deadlineDate);

                    $displayTaskName = $task['task_name'];
                    $displayTaskEstimate = $task['estimate'];
                    $estimate_us = EstimateService::convertEstimate($displayTaskEstimate);

                    if ($pageLocale == 'us') {
                        $displayTaskEstimate = $estimate_us;
                    }


                    $taskID = $task['taskID'];
                    $linkTask = "task.php?task={$taskID}";


                    if($overDeadline) {
                        echo "<div class=\"w-full\">
                                <a class=\"block border rounded border-red-600 hover:underline mb-3 p-3 bg-red-200 border-red-600 text-2xl\" href=\"$linkTask\">
                                    <h3 class=\"mb-0 text-red-800 font-bold\">$displayTaskName
                                        <span class=\"bg-teal-400 px-2 rounded text-white font-bold float-right\">$displayTaskEstimate</span>
                                    </h3>
                                </a>
                              </div>";
                    } else {
                        echo "<div class=\"w-full\">
                                  <a class=\"block border rounded border-slate-600 hover:underline mb-3 p-3 bg-slate-300 text-2xl\" href=\"$linkTask\">
                                    <h3 class=\"mb-0 font-bold\">$displayTaskName
                                        <span class=\"bg-teal-400 px-2 rounded text-white font-bold float-right\">$displayTaskEstimate</span>
                                    </h3>
                                  </a>
                                  </div>";
                    }
                }
                    echo "
                        </div>
                    </div>
                ";
        }
        ?>
    </section>
</main>
<footer class="border-t border-slate-300 mt-3 mx-3 p-3 pt-5">
    <p>&copy; Copyright iO Academy 2024</p>
</footer>
</body>
</html>