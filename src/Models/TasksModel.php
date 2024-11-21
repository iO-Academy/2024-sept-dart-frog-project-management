<?php

require_once 'src/Entities/TaskEntity.php';

class TasksModel
{
    private PDO $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }
    public function selectTaskById(int $taskId): TaskEntity|false
    {
        $query=$this->db->prepare('SELECT `id`,`project_id`,`user_id`,
                                        CONCAT(UPPER(SUBSTRING(name,1,1)), LOWER(SUBSTRING(name,2)))
                                        AS name,`description`,`estimate`,`deadline`
                                        FROM `tasks` WHERE `id` = :id;');
        $query->setFetchMode(PDO::FETCH_CLASS, TaskEntity::class);
        $query->execute(['id' => $taskId]);
        return $query->fetch();
    }
    public function selectTaskUser(int $id): TaskEntity|false
    {
        $query = $this->db->prepare("SELECT `users`.`name`,`avatar`, `tasks`.`id`
                                            FROM `users` 
                                            INNER JOIN `tasks` ON `tasks`.`user_id` = `users`.`id`
                                            WHERE `tasks`.`id` = :id;");
        $query->setFetchMode(PDO::FETCH_CLASS, TaskEntity::class);
        $query->execute([':id' => $id]);
        return $query->fetch();
    }

    /**
     * @return TaskEntity[]
     */
    public function getTasksByUserAndProject(int $projectId, int $userId): array
    {
        $query = $this->db->prepare("SELECT `id` AS 'taskID',`name` AS 'task_name',`estimate`,`deadline` AS 'task_deadline' 
                                            FROM `tasks` 
                                            WHERE `project_id` = :projectId
                                            AND `user_id` = :userId;");
        $query->fetchAll(PDO::FETCH_CLASS, TaskEntity::class);
        $query->execute(['projectId' => $projectId, 'userId' => $userId]);
        return $query->fetchAll();
    }

}