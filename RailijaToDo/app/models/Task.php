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
            $this->db->query('INSERT INTO tasks (title, user_id, description, deadline) VALUES (:title, :user_id, :description, :deadline)');
            $this->db->bind(':title', $title);
            $this->db->bind(':user_id', $user_id);
            $this->db->bind(':description', $description);
            $this->db->bind(':deadline', $deadline);
            return $this->db->execute();
        }

    public function getTasksByUserId($user_id) {
        $this->db->query('SELECT * FROM tasks WHERE user_id = :user_id');
        $this->db->bind(':user_id', $user_id);
        return $this->db->resultSet();
    }
    public function searchItems($query){
        $sql = "SELECT * FROM tasks WHERE title LIKE :query OR description LIKE :query";
        $this->db->query($sql);
        $this->db->bind(':query', '%' . $query . '%');
        return $this->db->resultSet();
    }
}