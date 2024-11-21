<?php

require_once 'src/Entities/ClientEntity.php';
class ClientsModel {
    private PDO $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    public function getAllClients()
    {
        $query = $this->db->prepare('SELECT `id`, `name`, `logo` FROM `clients`;');
        $query->fetchAll(PDO::FETCH_CLASS, ClientEntity::class);
        $query->execute();
        return $query->fetchAll();
    }

    public function getClientById($id)
    {
        $query = $this->db->prepare("SELECT `id`, `name`, `logo` FROM `clients` WHERE `id` = :id;");
        $query->setFetchMode(PDO::FETCH_CLASS, ClientEntity::class);
        $query->execute([
            'id' => $id
        ]);
        return $query->fetch();
    }

}