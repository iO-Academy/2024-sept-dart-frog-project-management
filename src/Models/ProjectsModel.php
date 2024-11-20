<?php

require_once 'src/Services/DatabaseService.php';
require_once 'src/Entities/ProjectEntity.php';
class ProjectsModel {

    private PDO $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }
    public function getProjectById(int $id): ProjectEntity
    {
        $query = $this->db->prepare("SELECT * FROM `projects` WHERE `id` = :id;");
        $query->setFetchMode(PDO::FETCH_CLASS, ProjectEntity::class);
        $query->execute(['id' => $id]);
        return $query->fetch();
    }

    public function getAllProjects()
    {
        $query = $this->db->prepare('SELECT * FROM `projects`;');
        $query->fetchAll(PDO::FETCH_CLASS, ProjectEntity::class);
        $query->execute();
        return $query->fetchAll();
    }

    public function getProjectTasksByUser(int $projectID): array
    {
        $query = $this->db->prepare("SELECT
`users`.`name` as 'username', `tasks`.`name` as 'taskName', `tasks`.`id` as 'taskID', `tasks`.`estimate`, `tasks`.`user_id`, `project_users`.`project_id`
FROM `tasks`
JOIN `users`
ON `tasks`.`user_id`=`users`.`id`
JOIN `project_users`
ON `users`.`id`=`project_users`.`user_id` 
WHERE `project_users`.`project_id` = :projectID;");
        $query->execute([':projectID' => $projectID]);
        return $query->fetch();
    }
}