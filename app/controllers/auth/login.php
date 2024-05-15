<?php
guest();
require "../app/core/Validator.php";
require "../app/core/Database.php";
require "../app/models/User.php";
$config = require("../config.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $db = new Database($config);

    $errors = [];

    if (!Validator::email($_POST["email"])) {
        $errors["email"] = "Nepareizi ievadits email";
    }

    if (empty($errors)) {
        // Create a new instance of the User model
        $userModel = new User();

        // Attempt to log in the user
        $loggedInUser = $userModel->login($_POST["email"], $_POST["password"]);

        if ($loggedInUser) {
            // Set session variables
            $_SESSION["user"] = true;
            $_SESSION["email"] = $_POST["email"];

            // Login successful
            header("Location: /");
            exit();
        } else {
            // Login failed
            $errors["email"] = "Parole vai E-mail nesakrit";
        }
    }
}

unset($_SESSION["message"]);

$title = "Login";
require "../app/views/auth/login.view.php";
?>