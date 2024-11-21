<?php

require_once 'src/Entities/UserEntity.php';

class UsersModel {
    private PDO $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
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