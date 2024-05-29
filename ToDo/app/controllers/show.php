<?php
require "../app/models/Show.php";

$showModel = new ShowModel();

if (isset($_GET['id'])) {
    $taskId = $_GET['id'];
    $task = $showModel->getTaskById($taskId);
} else {
    $task = null;
}

$title = "Show";
require "../app/views/show.view.php";