<?php

require_once '../app/models/Search.php';
class SearchController {
    private $pdo;

    public function __construct($config) {
        $dsn = "mysql:host={$config['host']};dbname={$config['dbname']};charset={$config['charset']}";
        $username = $config['user'];
        $password = $config['password'];
        $this->pdo = new PDO($dsn, $username, $password);
    }

    public function searchAction() {
        session_start();
        if (!isset($_SESSION['user_id'])) {
            // Redirect or handle unauthorized access
            exit("Unauthorized access.");
        }

        $userId = $_SESSION['user_id'];
        $searchModel = new SearchModel($this->pdo);

        // Fetch tasks from the database based on user_id and search query
        $filteredTasks = [];
        if (isset($_GET['query']) && !empty($_GET['query'])) {
            $query = $_GET['query'];
            $filteredTasks = $searchModel->searchTasks($userId, $query);
        }

        // Load the view and pass the filtered tasks
        include '../app/views/index.view.php';
    }
}
