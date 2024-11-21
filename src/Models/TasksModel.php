<?php

require_once 'src/Entities/TaskEntity.php';
require_once 'src/Entities/UserEntity.php';

class TasksModel
{
    private PDO $db;
    public function __construct(PDO $db)
    {
        $this->db = $db;
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
    /**
     * @return UserEntity[]
     */
    public function getUsersByProjectId(int $projectID): array
    {
        $query = $this->db->prepare("SELECT `users`.`name` AS 'username',`avatar`,`users`.`id` AS `userID`,`project_users`.`project_id`
                                            FROM `users`
                                            INNER JOIN `project_users`
                                            ON `users`.`id`=`project_users`.`user_id` 
                                            WHERE `project_users`.`project_id` = :projectID;");
        $query->fetchAll(PDO::FETCH_CLASS, UserEntity::class);
        $query->execute(['projectID' => $projectID]);
        return $query->fetchAll();
    }
}