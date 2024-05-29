<?php
// Include necessary files and configurations
require_once "../config.php";
require_once "../app/core/Database.php"; // Adjust the path as needed

// Create a new instance of the TaskModel class
$taskModel = new App\Models\TaskModel(); // Fully qualified class name with namespace

// Get all tasks from the database
$tasks = $taskModel->getAllTasks();

// Load the view file to render the page
require "../app/views/index.view.php";
?>
