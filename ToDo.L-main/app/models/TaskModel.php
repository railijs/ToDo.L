<?php
// TaskModel.php
require_once "../app/core/Database.php";

namespace App\Models;

class TaskModel {
    private $database;

    public function __construct($database) {
        $this->database = $database;
    }

    public function getAllTasks() {
        try {
            // Query to fetch all tasks
            $this->database->query("SELECT * FROM tasks");
            $tasks = $this->database->resultSet();
            return $tasks;
        } catch (PDOException $e) {
            // Handle database errors
            echo "Error fetching tasks: " . $e->getMessage();
            return []; // Return an empty array in case of error
        }
    }

    // Add more methods as needed
}

