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

    /**
     * @return ProjectEntity[]
     */
    public function getAllProjects(): array
    {
        $query = $this->db->prepare('SELECT * FROM `projects`;');
        $query->fetchAll(PDO::FETCH_CLASS, ProjectEntity::class);
        $query->execute();
        return $query->fetchAll();
    }
}