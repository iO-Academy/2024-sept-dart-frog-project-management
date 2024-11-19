<?php

require_once 'src/Services/DatabaseService.php';
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
    public function selectTaskById(int $id): TaskEntity
    {
        $query = $this->db->prepare('SELECT * FROM `tasks` WHERE `id` = :id;');
        $query->setFetchMode(PDO::FETCH_CLASS, TaskEntity::class);
        $query->execute(['id' => $id]);
        return $query->fetch();
    }
}