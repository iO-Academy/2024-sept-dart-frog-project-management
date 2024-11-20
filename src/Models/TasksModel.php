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

    /**
     * @return TaskEntity[]
     */
    public function getTasksByUserAndProject(int $projectId, int $userId): array
    {
        $query = $this->db->prepare("SELECT `id`,`name` as 'task_name',`estimate`,`deadline` as 'task_deadline' FROM `tasks` 
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
        $query = $this->db->prepare("SELECT `users`.`name` as 'username',`avatar`, `project_users`.`project_id`
                                            FROM `users`
                                            INNER JOIN `project_users`
                                            ON `users`.`id`=`project_users`.`user_id` 
                                            WHERE `project_users`.`project_id` = :projectID;");
        $query->fetchAll(PDO::FETCH_CLASS, UserEntity::class);
        $query->execute(['projectID' => $projectID]);
        return $query->fetchAll();
    }
}