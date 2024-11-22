<?php

require_once 'src/Services/DatabaseService.php';
require_once 'src/Entities/ProjectEntity.php';
class ProjectsModel {

    private PDO $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }
    public function getProjectById(int $id): ProjectEntity
    {
        $query = $this->db->prepare("SELECT `id`, `name`, `client_id`, `description`, `deadline` FROM `projects` WHERE `id` = :id;");
        $query->setFetchMode(PDO::FETCH_CLASS, ProjectEntity::class);
        $query->execute(['id' => $id]);
        return $query->fetch();
    }

    public function getAllProjects()
    {
        $query = $this->db->prepare('SELECT `id`, `name`, `client_id`, `description`, `deadline` FROM `projects`  ORDER BY `name`;');
        $query->fetchAll(PDO::FETCH_CLASS, ProjectEntity::class);
        $query->execute();
        return $query->fetchAll();
    }
}