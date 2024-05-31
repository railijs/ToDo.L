<?php
require "../app/models/Task.php";
require "../app/core/Validator.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $errors = [];

    if (!Validator::string($_POST["title"], min: 1, max: 255)) {
        $errors["title"] = "Title cannot be empty or too long!";
    }
    if (!Validator::string($_POST["description"], min: 1, max: 255)) {
        $errors["description"] = "Description cannot be empty or too long!";
    }
    if (empty($errors)) {
        $title = $_POST['title'];
        $user_id = 1;
        $description = $_POST['description'];
        $deadline = $_POST['deadline'];

        // Create an instance of the TaskModel
        $task = new TaskModel();

        // Call the createTask method to insert the task into the database
        $taskCreated = $task->createTask($title, $user_id, $description, $deadline); // Change $taskModel to $task

        if ($taskCreated) {
            // Redirect to the home page or a success page
            header("Location: /");
            exit();
        } else {
            // Handle error if task creation failed
            // You can display an error message or log the error
        }
    }
}


$title = "Create a task";
require "../app/views/create.view.php";