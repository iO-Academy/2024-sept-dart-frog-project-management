<?php

require_once 'src/Services/DatabaseService.php';
class ProjectsModel {

    private PDO $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }
    public function selectProject()
    {
        $query = $this->db->prepare('SELECT * FROM `projects`;');
        $query->execute();
        return $query->fetchAll();
    }
}