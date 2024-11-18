<?php

require_once 'src/Services/DatabaseService.php';
require_once 'src/Entities/UserEntity.php';

class UsersModel {
    private PDO $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }
    public function getAllUsers() {
        $query = $this->db->prepare("SELECT * FROM `users`");
        $query->fetchAll(PDO::FETCH_CLASS, UserEntity::class);
        $query->execute();
        return $query->fetchAll();
    }
    public function getUserById($id) {
        $query = $this->db->prepare("SELECT * FROM `users` WHERE `id` = :id");
        $query->fetchAll(PDO::FETCH_CLASS, UserEntity::class);
        $query->execute(['id' => $id]);
        return $query->fetch();
    }


}

