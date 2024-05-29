<?php

class CalendarController {
    private $taskService;

    public function __construct($dbConnection) {
        $this->taskService = new TaskService($dbConnection); // Izveidojam TaskService objektu ar datu bāzes savienojumu
    }

    public function getMonthlyTasks($year, $month) {
        try {
            $tasks = $this->taskService->getTasksByMonth($year, $month);
            return $tasks;
        } catch (Exception $e) {
            error_log("Error fetching monthly tasks: " . $e->getMessage());
            throw $e;
        }
    }
}

class TaskService {
    private $dbConnection;

    public function __construct($dbConnection) {
        $this->dbConnection = $dbConnection;
    }

    public function getTasksByMonth($year, $month) {
        $startDate = "$year-$month-01";
        $endDate = date("Y-m-t", strtotime($startDate));

        $query = $this->dbConnection->prepare("SELECT * FROM tasks WHERE deadline BETWEEN :startDate AND :endDate");
        $query->bindParam(':startDate', $startDate);
        $query->bindParam(':endDate', $endDate);
        $query->execute();

        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
}
$title = "Calendar";
require "../app/views/calendar.view.php";