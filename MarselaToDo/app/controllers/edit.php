<?php
// Include necessary files and configurations
require_once "../app/models/Task.php"; 

// Custom validation functions
function dateNotInPast($date) {
    $currentDate = date('Y-m-d');
    return $date >= $currentDate;
}

function nonEmptyString($data, $min = 1, $max = INF) {
    $data = trim($data);
    return is_string($data) && strlen($data) >= $min && strlen($data) <= $max && !empty($data);
}

// Create an instance of TaskModel class
$taskModel = new TaskModel();

$errors = []; // Initialize an empty array for errors

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['task_id'])) {
    $task_id = $_GET['task_id'];

    // Validate task ID
    if (filter_var($task_id, FILTER_VALIDATE_INT, ["options" => ["min_range" => 1]])) {
        // Get task details by ID
        $taskDetails = $taskModel->getTaskById($task_id);
    } else {
        $errors['task_id'] = "Invalid task ID.";
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['task_id'], $_POST['title'], $_POST['description'], $_POST['deadline'], $_POST['priority'])) {
    $task_id = $_POST['task_id'];
    $title = trim($_POST['title']);
    $description = trim($_POST['description']);
    $deadline = $_POST['deadline'];
    $priority = $_POST['priority'];

    // Validate inputs
    if (!filter_var($task_id, FILTER_VALIDATE_INT, ["options" => ["min_range" => 1]])) {
        $errors['task_id'] = "Invalid task ID.";
    }
    if (!nonEmptyString($title, 1, 255)) {
        $errors['title'] = "Title must be between 1 and 255 characters.";
    }
    if (!nonEmptyString($description, 1, 1000)) {
        $errors['description'] = "Description must be between 1 and 1000 characters.";
    }
    if (!dateNotInPast($deadline)) {
        $errors['deadline'] = "Deadline cannot be in the past.";
    }
    if (!filter_var($priority, FILTER_VALIDATE_INT, ["options" => ["min_range" => 1, "max_range" => 5]])) {
        $errors['priority'] = "Priority must be between 1 and 5.";
    }

    if (empty($errors)) {
        // Update task details
        $success = $taskModel->updateTask($task_id, $title, $description, $deadline, $priority);

        if ($success) {
            header("Location: /"); // Redirect to the homepage or wherever appropriate
            exit();
        } else {
            $errors['general'] = "Error updating task.";
        }
    } else {
        // Ensure taskDetails contains the submitted data to preserve input values on error
        $taskDetails = (object)[
            'id' => $task_id,
            'title' => $title,
            'description' => $description,
            'deadline' => $deadline,
            'priority' => $priority
        ];
    }
}

// Include the view file to render the page
require "../app/views/edit.view.php";