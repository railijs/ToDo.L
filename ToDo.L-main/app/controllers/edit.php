<?php
// Include necessary files and configurations
require_once "../config.php";
require_once "../app/core/Database.php"; // Adjust the path as needed

// Fetch the task to be edited
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['task_id'])) {
    $task_id = $_GET['task_id'];
    // Fetch task from the database using your preferred method (PDO, ORM, etc.)
    // Example:
    // $task = fetchTaskFromDatabase($config, $task_id);
    // Ensure $task is properly sanitized to prevent SQL injection
}

// Handle form submission to update task
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['task_id']) && isset($_POST['title']) && isset($_POST['description']) && isset($_POST['deadline'])) {
    $task_id = $_POST['task_id'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $deadline = $_POST['deadline'];

    // Create a new instance of the Database class
    $database = new Database();

    // Update the task in the database
    $success = $database->query("UPDATE tasks SET title = ?, description = ?, deadline = ? WHERE id = ?");
    $success = $database->bind(1, $title);
    $success = $database->bind(2, $description);
    $success = $database->bind(3, $deadline);
    $success = $database->bind(4, $task_id);
    $success = $database->execute();
    
    // Ensure proper error handling

    // Redirect to clear the form data
    header("Location: /"); // Redirect to the homepage or wherever appropriate
    exit();
}

// TaskModel.php

class TaskModel {
    private $database;

    public function __construct($database) {
        $this->database = $database;
    }

    public function getTaskById($task_id) {
        // Implement fetching task from the database by ID
        // Example:
        $this->database->query("SELECT * FROM tasks WHERE id = ?");
        $this->database->bind(1, $task_id);
        return $this->database->single();
    }

    public function updateTask($task_id, $title, $description) {
        // Implement updating task in the database
        // Example:
        $this->database->query("UPDATE tasks SET title = ?, description = ? WHERE id = ?");
        $this->database->bind(1, $title);
        $this->database->bind(2, $description);
        $this->database->bind(3, $task_id);
        return $this->database->execute();
    }
}


// Include the view file to render the page
require "../app/views/edit.view.php";
?>
