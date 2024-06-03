<?php

class CalendarModel {
    // Method to get the database connection
    private function getDatabaseConnection() {
        $host = 'localhost';
        $dbname = 'MarselaToDo';
        $username = 'root';
        $password = 'root';

        $dsn = "mysql:host=$host;dbname=$dbname;charset=utf8mb4";

        try {
            $db = new PDO($dsn, $username, $password);
            // Set PDO to throw exceptions on errors
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $db;
        } catch(PDOException $e) {
            // Handle connection errors gracefully
            echo "Connection failed: " . $e->getMessage();
            exit;
        }
    }

    // Method to get tasks by user ID, sorted by deadline
    public function getTasksByUserId($userId) {
        $db = $this->getDatabaseConnection();

        try {
            $query = $db->prepare("SELECT * FROM tasks WHERE user_id = :user_id ORDER BY deadline ASC");
            $query->bindParam(':user_id', $userId, PDO::PARAM_INT);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_OBJ);
        } catch(PDOException $e) {
            // Handle query errors gracefully
            echo "Query failed: " . $e->getMessage();
            return [];
        }
    }
}