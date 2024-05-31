<?php
guest();
require_once "../app/core/Validator.php";
require_once "../app/core/Database.php";
require_once "../app/models/User.php";
$config = require("../app/config.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $db = new Database($config);

    $errors = [];

    // Validate email format
    if (!Validator::email($_POST["email"])) {
        $errors["email"] = "Invalid email format.";
    }

    // Check if email exists
    if (empty($errors) && !Validator::emailExists($_POST["email"])) {
        $errors["email"] = "Email does not exist.";
    }

    // Validate password format
    if (!Validator::password($_POST["password"])) {
        $errors["password"] = "Invalid password format.";
    }

    // Attempt to log in the user if there are no validation errors
    if (empty($errors)) {
        $userModel = new User();
        $loggedInUser = $userModel->login($_POST["email"], $_POST["password"]);

        if ($loggedInUser) {
            // Set session variables
            $_SESSION["user"] = true;
            $_SESSION["email"] = $_POST["email"];
            $_SESSION["user_id"] = $loggedInUser->id;

            // Login successful
            header("Location: /");
            exit();
        } else {
            // Login failed
            $errors["email"] = "Password or email does not match.";
        }
    }
}

unset($_SESSION["message"]);

$title = "Login";
require "../app/views/auth/login.view.php";