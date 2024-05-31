<?php
// Include necessary files and configurations
require_once "../config.php";
require_once "../app/core/Database.php"; 
require_once "../app/models/Task.php"; 

// Create an instance of Task class
$task = new TaskModel();

// Get all tasks from the database
$tasks = $task->getAllTasks();

// Load the view file to render the page
require "../app/views/index.view.php";
