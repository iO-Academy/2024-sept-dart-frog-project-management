<?php

require_once 'src/Entities/TaskEntity.php';

class TasksModel
{
    private PDO $db;
    public function __construct(PDO $db)
    {
        $this->db = $db;
    }
    public function selectTask()
    {
        $query = $this->db->prepare('SELECT * FROM `tasks`;');
        $query->execute();
        return $query->fetchAll();
    }
    public function selectTaskById(int $taskId): TaskEntity
    {
        $query = $this->db->prepare('SELECT * FROM `tasks` WHERE `id` = :id;');
        $query->setFetchMode(PDO::FETCH_CLASS, TaskEntity::class);
        $query->execute(['id' => $taskId]);
        return $query->fetch();
    }
    public function displayTaskUser(int $id): TaskEntity
    {
        $query = $this->db->prepare("SELECT `users`.`name`,`avatar`, `tasks`.`id`
                                            FROM `users` 
                                            INNER JOIN `tasks` ON `tasks`.`user_id` = `users`.`id`
                                            WHERE `tasks`.`id` = :id;");
        $query->setFetchMode(PDO::FETCH_CLASS, TaskEntity::class);
        $query->execute([':id' => $id]);
        return $query->fetch();
    }

    public function getTasksByProjectID(int $projectId)
    {
        $query = $this->db->prepare('SELECT * FROM `tasks` WHERE `project_id` = :projectId;');
        $query->execute(['projectId' => $projectId]);
        return $query->fetchAll();
    }
}