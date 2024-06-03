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
    
    public function createTask($title, $user_id, $description, $deadline, $priority) {
        $sql = "INSERT INTO tasks (title, user_id, description, deadline, priority) VALUES (:title, :user_id, :description, :deadline, :priority)";
        
        $this->db->query($sql);
        $this->db->bind(':title', $title);
        $this->db->bind(':user_id', $user_id);
        $this->db->bind(':description', $description);
        $this->db->bind(':deadline', $deadline);
        $this->db->bind(':priority', $priority);

        return $this->db->execute();
    }

    public function getTasksByUserId($user_id) {
        $this->db->query('SELECT * FROM tasks WHERE user_id = :user_id');
        $this->db->bind(':user_id', $user_id);
        return $this->db->resultSet();
    }

    public function getTaskById($task_id) {
        $this->db->query("SELECT * FROM tasks WHERE id = ?");
        $this->db->bind(1, $task_id);
        return $this->db->single();
    }

    public function searchItems($query){
        $sql = "SELECT * FROM tasks WHERE title LIKE :query OR description LIKE :query";
        $this->db->query($sql);
        $this->db->bind(':query', '%' . $query . '%');
        return $this->db->resultSet();
    }

    public function editTask($title, $user_id, $description, $deadline) {
        $sql = "INSERT INTO tasks (title, user_id, description, deadline) VALUES (:title, :user_id, :taskDescription, :deadline)";
        $this->db->query($sql);
        $this->db->bind(':title', $title);
        $this->db->bind(':user_id', $user_id);
        $this->db->bind(':taskDescription', $description);
        $this->db->bind(':deadline', $deadline);
        return $this->db->execute();
    }

    public function updateTask($task_id, $title, $description, $deadline, $priority) {
        $sql = "UPDATE tasks SET title = :title, description = :description, deadline = :deadline, priority = :priority WHERE id = :task_id";
        $this->db->query($sql);
        $this->db->bind(':title', $title);
        $this->db->bind(':description', $description);
        $this->db->bind(':deadline', $deadline);
        $this->db->bind(':priority', $priority);
        $this->db->bind(':task_id', $task_id);
        return $this->db->execute();
    }

    public function getTasksSortedByPriority() {
        $this->db->query('SELECT * FROM tasks ORDER BY priority DESC');
        return $this->db->resultSet();
    }
}