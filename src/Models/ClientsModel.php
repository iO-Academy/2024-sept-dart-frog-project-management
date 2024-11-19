<?php

include_once 'src/Services/DatabaseService.php';

class ClientsModel {
    private PDO $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    public function getAllClients()
    {
        $query = $this->db->prepare('SELECT * FROM `clients`;');
        $query->execute();
        return $query->fetchAll();
    }

    public function getClientById($id)
    {
        $query = $this->db->prepare("SELECT * FROM `clients` WHERE `id` = :id;");
        $query->execute([
            'id' => $id
        ]);
        return $query->fetch();
    }

}