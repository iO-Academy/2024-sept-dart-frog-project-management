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
        $query=$this->db->prepare('SELECT `id`,`project_id`,`user_id`,
                                        CONCAT(UPPER(SUBSTRING(name,1,1)), LOWER(SUBSTRING(name,2)))
                                        AS name,`description`,`estimate`,`deadline`
                                        FROM `tasks` WHERE `id` = :id;');
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

}