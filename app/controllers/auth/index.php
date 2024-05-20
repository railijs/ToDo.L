<?php
auth();
require "../app/models/TaskModel.php";



$tasksModel = new TaskModel();
$tasks = $tasksModel->getAllTasks();

$title = "home";
require "../app/views/auth/index.view.php";