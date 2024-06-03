<?php

auth();

require "../app/models/Calendar.php";
require "../app/models/Search.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: /login");
    exit();
}

$taskModel = new CalendarModel();
$tasks = $taskModel->getTasksByUserId($_SESSION['user_id']);

if (isset($_GET["query"]) && !empty(trim($_GET["query"]))) {
    $searchModel = new SearchModel();
    if (strlen($_GET["query"]) === 1) {
        $searchResults = $searchModel->searchItemsByFirstLetter($_GET["query"], $_SESSION['user_id']);
    } else {
        $searchResults = $searchModel->searchItems($_GET["query"]);
    }
}

$title = "Tasks";
require "../app/views/calendar.view.php";