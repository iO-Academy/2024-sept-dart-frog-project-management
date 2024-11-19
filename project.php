<?php

require_once 'src/Services/DatabaseService.php';
require_once 'src/Entities/ProjectEntity.php';
require_once 'src/Services/ProjectDisplayServices.php';
require_once 'src/Models/ProjectsModel.php';
require_once 'src/Services/ClientDisplayService.php';
require_once 'src/Models/ClientsModel.php';
require_once 'src/Services/ProjectLinkService.php';

$db = DatabaseService::connect();

//    private PDO $db;
//    public function __construct(PDO $db)
//    {
//        $this->db = $db;
//    }

$projectsModel = new ProjectsModel($db);
$project = $projectsModel->getProjectById($idLink);
$projectTitle = ProjectDisplayService::displayProject($project);
$clientID = $project->client_id;
$ClientsModel = new ClientsModel($db);

$client = $ClientsModel->getClientById($clientID);

$clientLogo = $client->logo;

$clientTitle = ClientDisplayService::displayClient($client);

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
        <a href="project.html" class="p-3 bg-slate-300 rounded-l-lg border-y border-l">🇬🇧</a>
        <a href="project-us.html" class="p-3 rounded-r-lg border-y border-r">🇺🇸</a>
    </div>
</header>
<main class="p-3">
    <div class="flex justify-between mb-3">
         <h2 class="text-4xl font-bold mb-2"><?php echo $projectTitle ?>
            <a href="index.html" class="text-base text-blue-600 hover:underline ms-3">Return to all projects</a>
        </h2>

        <div class="flex items-center gap-3">
            <h3 class="text-3xl font-bold"><?php echo $clientTitle ?> </h3>
            <img class="w-[50px]" src="<?php echo $clientLogo ?>" alt="client logo" />
        </div>
    </div>

    <section class="flex gap-5 flex-nowrap h-[70vh] pb-5 overflow-x-auto">
        <div class="shrink-0 w-full sm:w-1/2 lg:w-1/4 h-100">
            <div class="overflow-y-auto border rounded p-3 pb-0 h-full">
                <h4 class="border-b pb-2 mb-3 text-2xl font-bold">
                    <a href="user.html">Lamond Teather</a>
                    <img
                        src="https://robohash.org/explicaboautodit.png?size=50x50&set=set1" alt="Project Avatar"
                        class="float-right">
                </h4>
                <div class="w-full">
                    <a class="block border rounded border-red-600 hover:underline mb-3 p-3 bg-red-200 border-red-600 text-2xl" href="task.html">
                        <h3 class="mb-0 text-red-800 font-bold">mattis
                            <span class="bg-teal-400 px-2 rounded text-white font-bold float-right">3</span>
                        </h3>
                    </a>
                    <a class="block border rounded border-slate-600 hover:underline mb-3 p-3 bg-slate-300 text-2xl" href="task.html">
                        <h3 class="mb-0 font-bold">curae
                            <span class="bg-teal-400 px-2 rounded text-white font-bold float-right">2</span>
                        </h3>
                    </a>
                    <a class="block border rounded border-slate-600 hover:underline mb-3 p-3 bg-slate-300 text-2xl" href="task.html">
                        <h3 class="mb-0 font-bold">curae<span class="badge badge-info float-right"></span></h3>
                    </a>
                </div>
            </div>
        </div>
        <div class="shrink-0 w-full sm:w-1/2 lg:w-1/4 h-100">
            <div class="overflow-y-auto border rounded p-3 pb-0 h-full">
                <h4 class="border-b pb-2 mb-3 text-2xl font-bold">
                    <a href="user.html">Lamond Teather</a>
                    <img
                        src="https://robohash.org/explicaboautodit.png?size=50x50&set=set1" alt="User Avatar"
                        class="float-right">
                </h4>
                <div class="w-full">
                    <a class="block border rounded border-red-600 hover:underline mb-3 p-3 bg-red-200 border-red-600 text-2xl" href="task.html">
                        <h3 class="mb-0 text-red-800 font-bold">mattis
                            <span class="bg-teal-400 px-2 rounded text-white font-bold float-right">3</span>
                        </h3>
                    </a>
                    <a class="block border rounded border-slate-600 hover:underline mb-3 p-3 bg-slate-300 text-2xl" href="task.html">
                        <h3 class="mb-0 font-bold">curae<span class="badge badge-info float-right"></span></h3>
                    </a>
                    <a class="block border rounded border-slate-600 hover:underline mb-3 p-3 bg-slate-300 text-2xl" href="task.html">
                        <h3 class="mb-0 font-bold">curae<span class="badge badge-info float-right"></span></h3>
                    </a>
                </div>
            </div>
        </div>
        <div class="shrink-0 w-full sm:w-1/2 lg:w-1/4 h-100">
            <div class="overflow-y-auto border rounded p-3 pb-0 h-full">
                <h4 class="border-b pb-2 mb-3 text-2xl font-bold">
                    <a href="user.html">Lamond Teather</a>
                    <img
                        src="https://robohash.org/explicaboautodit.png?size=50x50&set=set1" alt="User Avatar"
                        class="float-right">
                </h4>
                <div class="w-full">
                    <a class="block border rounded border-red-600 hover:underline mb-3 p-3 bg-red-200 border-red-600 text-2xl" href="task.html">
                        <h3 class="mb-0 text-red-800 font-bold">mattis
                            <span class="bg-teal-400 px-2 rounded text-white font-bold float-right">3</span>
                        </h3>
                    </a>
                    <a class="block border rounded border-slate-600 hover:underline mb-3 p-3 bg-slate-300 text-2xl" href="task.html">
                        <h3 class="mb-0 font-bold">curae<span class="badge badge-info float-right"></span></h3>
                    </a>
                    <a class="block border rounded border-slate-600 hover:underline mb-3 p-3 bg-slate-300 text-2xl" href="task.html">
                        <h3 class="mb-0 font-bold">curae<span class="badge badge-info float-right"></span></h3>
                    </a>
                </div>
            </div>
        </div>
        <div class="shrink-0 w-full sm:w-1/2 lg:w-1/4 h-100">
            <div class="overflow-y-auto border rounded p-3 pb-0 h-full">
                <h4 class="border-b pb-2 mb-3 text-2xl font-bold">
                    <a href="user.html">Lamond Teather</a>
                    <img
                        src="https://robohash.org/explicaboautodit.png?size=50x50&set=set1" alt="User Avatar"
                        class="float-right">
                </h4>
                <div class="w-full">
                    <a class="block border rounded border-red-600 hover:underline mb-3 p-3 bg-red-200 border-red-600 text-2xl" href="task.html">
                        <h3 class="mb-0 text-red-800 font-bold">mattis
                            <span class="bg-teal-400 px-2 rounded text-white font-bold float-right">3</span>
                        </h3>
                    </a>
                    <a class="block border rounded border-slate-600 hover:underline mb-3 p-3 bg-slate-300 text-2xl" href="task.html">
                        <h3 class="mb-0 font-bold">curae<span class="badge badge-info float-right"></span></h3>
                    </a>
                    <a class="block border rounded border-slate-600 hover:underline mb-3 p-3 bg-slate-300 text-2xl" href="task.html">
                        <h3 class="mb-0 font-bold">curae<span class="badge badge-info float-right"></span></h3>
                    </a>
                </div>
            </div>
        </div>
        <div class="shrink-0 w-full sm:w-1/2 lg:w-1/4 h-100">
            <div class="overflow-y-auto border rounded p-3 pb-0 h-full">
                <h4 class="border-b pb-2 mb-3 text-2xl font-bold">
                    <a href="user.html">Lamond Teather</a>
                    <img
                        src="https://robohash.org/explicaboautodit.png?size=50x50&set=set1" alt="User Avatar"
                        class="float-right">
                </h4>
                <div class="w-full">
                    <a class="block border rounded border-red-600 hover:underline mb-3 p-3 bg-red-200 border-red-600 text-2xl" href="task.html">
                        <h3 class="mb-0 text-red-800 font-bold">mattis
                            <span class="bg-teal-400 px-2 rounded text-white font-bold float-right">3</span>
                        </h3>
                    </a>
                    <a class="block border rounded border-slate-600 hover:underline mb-3 p-3 bg-slate-300 text-2xl" href="task.html">
                        <h3 class="mb-0 font-bold">curae<span class="badge badge-info float-right"></span></h3>
                    </a>
                    <a class="block border rounded border-slate-600 hover:underline mb-3 p-3 bg-slate-300 text-2xl" href="task.html">
                        <h3 class="mb-0 font-bold">curae<span class="badge badge-info float-right"></span></h3>
                    </a>
                </div>
            </div>
        </div>
        <div class="shrink-0 w-full sm:w-1/2 lg:w-1/4 h-100">
            <div class="overflow-y-auto border rounded p-3 pb-0 h-full">
                <h4 class="border-b pb-2 mb-3 text-2xl font-bold">
                    <a href="user.html">Lamond Teather</a>
                    <img
                        src="https://robohash.org/explicaboautodit.png?size=50x50&set=set1" alt="User Avatar"
                        class="float-right">
                </h4>
                <div class="w-full">
                    <a class="block border rounded border-red-600 hover:underline mb-3 p-3 bg-red-200 border-red-600 text-2xl" href="task.html">
                        <h3 class="mb-0 text-red-800 font-bold">mattis
                            <span class="bg-teal-400 px-2 rounded text-white font-bold float-right">3</span>
                        </h3>
                    </a>
                    <a class="block border rounded border-slate-600 hover:underline mb-3 p-3 bg-slate-300 text-2xl" href="task.html">
                        <h3 class="mb-0 font-bold">curae<span class="badge badge-info float-right"></span></h3>
                    </a>
                    <a class="block border rounded border-slate-600 hover:underline mb-3 p-3 bg-slate-300 text-2xl" href="task.html">
                        <h3 class="mb-0 font-bold">curae<span class="badge badge-info float-right"></span></h3>
                    </a>
                </div>
            </div>
        </div>
        <div class="shrink-0 w-full sm:w-1/2 lg:w-1/4 h-100">
            <div class="overflow-y-auto border rounded p-3 pb-0 h-full">
                <h4 class="border-b pb-2 mb-3 text-2xl font-bold">
                    <a href="user.html">Lamond Teather</a>
                    <img
                        src="https://robohash.org/explicaboautodit.png?size=50x50&set=set1" alt="User Avatar"
                        class="float-right">
                </h4>
                <div class="w-full">
                    <a class="block border rounded border-red-600 hover:underline mb-3 p-3 bg-red-200 border-red-600 text-2xl" href="task.html">
                        <h3 class="mb-0 text-red-800 font-bold">mattis
                            <span class="bg-teal-400 px-2 rounded text-white font-bold float-right">3</span>
                        </h3>
                    </a>
                    <a class="block border rounded border-slate-600 hover:underline mb-3 p-3 bg-slate-300 text-2xl" href="task.html">
                        <h3 class="mb-0 font-bold">curae<span class="badge badge-info float-right"></span></h3>
                    </a>
                    <a class="block border rounded border-slate-600 hover:underline mb-3 p-3 bg-slate-300 text-2xl" href="task.html">
                        <h3 class="mb-0 font-bold">curae<span class="badge badge-info float-right"></span></h3>
                    </a>
                </div>
            </div>
        </div>

    </section>
</main>
<div style="right: 0px; top: 150px; height: 300px;" class="fixed">→</div>
<footer class="border-t border-slate-300 mt-3 mx-3 p-3 pt-5">
    <p>&copy; Copyright iO Academy 2024</p>
</footer>
</body>
</html>

