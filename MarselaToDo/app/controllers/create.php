<?php
// No need to start session as it's already started elsewhere

require "../app/models/Task.php";
require "../app/core/Validator.php";

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: /login");
    exit();
}

$taskModel = new TaskModel();
$errors = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate form fields
    if (empty($_POST["title"]) || empty($_POST["description"]) || empty($_POST["deadline"]) || empty($_POST["priority"])) {
        $errors["form"] = "All form fields are required.";
    } else {
        // Validate title
        if (!Validator::string($_POST["title"], 1, 255)) {
            $errors["title"] = "Title must be between 1 and 255 characters.";
        }
        
        // Validate description
        if (!Validator::string($_POST["description"], 1, 1000)) {
            $errors["description"] = "Description must be between 1 and 1000 characters.";
        }
        
        // Validate deadline
        if (!Validator::dateNotInPast($_POST["deadline"])) {
            $errors["deadline"] = "Deadline must be today or a future date.";
        }
        
        // Validate priority
        if (!Validator::number($_POST["priority"], 1, 5)) {
            $errors["priority"] = "Priority must be a number between 1 and 5.";
        }
    }

    // If no errors, proceed with creating the task
    if (empty($errors)) {
        $title = $_POST['title'];
        $description = $_POST['description'];
        $deadline = $_POST['deadline'];
        $priority = $_POST['priority'];
        $user_id = $_SESSION['user_id'];

        $taskModel->createTask($title, $user_id, $description, $deadline, $priority);
        header("Location: /");
        exit();
    }
}

// Fetch tasks for the logged-in user
$tasks = $taskModel->getTasksByUserId($_SESSION['user_id']);

$title = "Create a task";
require "../app/views/create.view.php";