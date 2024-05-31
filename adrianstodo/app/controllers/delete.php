<?php
auth();
require "../app/config.php";
require "../app/core/Database.php";

// Create a new instance of the Database class
$db = new Database();

// Check if the request method is POST and the id is set
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["id"])) {
    try {
        // Define the DELETE query
        $query = "DELETE FROM tasks WHERE id = :id";
        
        // Prepare the query
        $db->query($query);
        // Bind the id parameter
        $db->bind(':id', $_POST["id"]);
        // Execute the query
        $db->execute();
        
        // Redirect back to the tasks page after successful deletion
        header("Location: /");
        exit(); // Stop further execution
    } catch (PDOException $e) {
        // Handle database errors
        echo "Error: " . $e->getMessage();
        exit(); // Stop further execution
    }
} else {
    // Redirect to the tasks page if id is not set or request method is not POST
    header("Location: /");
    exit(); // Stop further execution
}