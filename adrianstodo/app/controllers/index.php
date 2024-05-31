<?php

auth();


require "../app/models/Task.php";
require "../app/models/Search.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: /login");
    exit();
}

$taskModel = new TaskModel();
$tasks = $taskModel->getTasksByUserId($_SESSION['user_id']);

if(isset($_GET["query"]) && !empty(trim($_GET["query"]))) {
    $searchModel = new SearchModel();
    // Check if the search query has only one letter
    if(strlen($_GET["query"]) === 1) {
        // Search only tasks of the current user by one letter
        $searchResults = $searchModel->searchItemsByFirstLetter($_GET["query"], $_SESSION['user_id']);
    } else {
        // Perform regular search
        $searchResults = $searchModel->searchItems($_GET["query"]);
    }
}

$task = new TaskModel();

// Get all tasks from the database
$tasks = $task->getAllTasks();


$title = "Tasks";
require "../app/views/index.view.php";