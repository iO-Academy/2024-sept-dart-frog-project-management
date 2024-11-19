<?php

require_once 'src/Services/DatabaseService.php';
require_once 'src/Entities/ProjectEntity.php';
class ProjectsModel {

    private PDO $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }
    public function getProject(int $id): ProjectEntity
    {
        $query = $this->db->prepare("SELECT * FROM `projects` WHERE `id` = :id;");
        $query->setFetchMode(PDO::FETCH_CLASS, ProjectEntity::class);
        $query->execute(['id' => $id]);
        return $query->fetch();
    }
    
    public function getAllProjects()
    {
        $query = $this->db->prepare('SELECT * FROM `projects`;');
        $query->fetchAll(PDO::FETCH_CLASS, ProjectEntity::class);
        $query->execute();
        return $query->fetchAll();
    }

    public function displayProjectName(int $id)
    {
        $query = $this->db->prepare("SELECT `name` FROM `projects` WHERE `id` = :id;");
        $query->execute(['id' => $id]);
        return $query->fetch();
    }
}