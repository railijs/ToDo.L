<?php
require "../app/models/Task.php";
require "../app/core/Validator.php";

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: /login");
    exit();
}

$taskModel = new TaskModel();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $errors = [];

    if (!Validator::string($_POST["title"], 1, 255)) {
        $errors["title"] = "Title cannot be empty or too long!";
    }
    if (!Validator::string($_POST["description"], 1, 255)) {
        $errors["description"] = "Description cannot be empty or too long!";
    }
    if (empty($errors)) {
        $title = $_POST['title'];
        $description = $_POST['description'];
        $deadline = $_POST['deadline'];
        $user_id = $_SESSION['user_id'];

        $taskModel->createTask($title, $user_id, $description, $deadline);
    }
    header("Location: /");
}

// Fetch tasks for the logged-in user
$tasks = $taskModel->getTasksByUserId($_SESSION['user_id']);

$title = "Create a task";
require "../app/views/create.view.php";