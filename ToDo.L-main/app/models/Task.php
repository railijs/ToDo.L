<?php

require "../app/core/Database.php";

class TaskModel {
    private $db;

    public function __construct() {
        $this->db = new Database(); 
    }

    public function getAllTasks() {
        $query = $this->db->query("SELECT * FROM tasks");
        return $this->db->resultSet();
    }

    public function createTask($title, $user_id, $description, $deadline) {
        $sql = "INSERT INTO tasks (title, user_id, description, deadline) VALUES (:title, :user_id, :taskDescription, :deadline)";
        $this->db->query($sql);
        $this->db->bind(':title', $title);
        $this->db->bind(':user_id', $user_id);
        $this->db->bind(':taskDescription', $description);
        $this->db->bind(':deadline', $deadline);
        return $this->db->execute();
    }
}