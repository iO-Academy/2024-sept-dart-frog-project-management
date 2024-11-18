<?php

require_once 'src/Services/DatabaseService.php';

class UsersModel {
    private PDO $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }
    public function getAllUsers() {
        $query = $this->db->prepare("SELECT * FROM `users`");
        $query->execute();
        return $query->fetchAll();
    }
    public function getUserById($id) {
        $query = $this->db->prepare("SELECT * FROM `users` WHERE `id` = :id");
        $query->execute(['id' => $id]);
        return $query->fetch();
    }


}

