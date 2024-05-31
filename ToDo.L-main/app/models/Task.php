<?php
require_once "../app/core/Database.php"; // Include the Database class file

class TaskModel {
    private $database;

    public function __construct() {
        $this->database = new Database(); // Instantiate the Database class
    }

    public function getAllTasks() {
        try {
            $this->database->query("SELECT * FROM tasks");
            return $this->database->resultSet();
        } catch (\PDOException $e) {
            echo "Error fetching tasks: " . $e->getMessage();
            return [];
        }
    }

    public function getTaskById($task_id) {
        $this->database->query("SELECT * FROM tasks WHERE id = ?");
        $this->database->bind(1, $task_id);
        return $this->database->single();
    }

    public function updateTask($task_id, $title, $description, $deadline) {
        $this->database->query("UPDATE tasks SET title = ?, description = ?, deadline = ? WHERE id = ?");
        $this->database->bind(1, $title);
        $this->database->bind(2, $description);
        $this->database->bind(3, $deadline);
        $this->database->bind(4, $task_id);
        return $this->database->execute();
    }

    public function createTask($title, $user_id, $description, $deadline) {
        $sql = "INSERT INTO tasks (title, user_id, description, deadline) VALUES (:title, :user_id, :taskDescription, :deadline)";
        $this->database->query($sql);
        $this->database->bind(':title', $title);
        $this->database->bind(':user_id', $user_id);
        $this->database->bind(':taskDescription', $description);
        $this->database->bind(':deadline', $deadline);
        return $this->database->execute();
    }

    public function editTask($title, $user_id, $description, $deadline) {
        $sql = "INSERT INTO tasks (title, user_id, description, deadline) VALUES (:title, :user_id, :taskDescription, :deadline)";
        $this->database->query($sql);
        $this->database->bind(':title', $title);
        $this->database->bind(':user_id', $user_id);
        $this->database->bind(':taskDescription', $description);
        $this->database->bind(':deadline', $deadline);
        return $this->database->execute();
    }
}
