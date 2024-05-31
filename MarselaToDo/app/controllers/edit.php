<?php
// Include necessary files and configurations

require_once "../app/models/Task.php"; // Include the file containing the TaskModel class

// Create an instance of TaskModel class
$taskModel = new TaskModel();

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['task_id'])) {
    $task_id = $_GET['task_id'];
    // Assuming you have a method to get task details by ID in the TaskModel class
    $taskDetails = $taskModel->getTaskById($task_id);
}


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['task_id'], $_POST['title'], $_POST['description'], $_POST['deadline'], $_POST['priority'])) {
    $task_id = $_POST['task_id'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $deadline = $_POST['deadline'];
    $priority = $_POST['priority'];

    // Assuming you have a method to update task details in the TaskModel class
    $success = $taskModel->updateTask($task_id, $title, $description, $deadline, $priority);

    if ($success) {
        header("Location: /"); // Redirect to the homepage or wherever appropriate
        exit();
    } else {
        echo "Error updating task.";
    }
}

// Include the view file to render the page
require "../app/views/edit.view.php";