<?php
require_once '../app/core/Database.php';

class User {
    private $db;

    public function __construct(){
        $this->db = new Database();
    }

    // Register User
    public function register($email, $password){
        // Hash the password before storing it in the database
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);

        // Check if the user already exists
        if ($this->findUserByEmail($email)) {
            return false; // User already exists
        }

        // Insert the user into the database
        $this->db->query('INSERT INTO users (email, password) VALUES (:email, :password)');
        $this->db->bind(':email', $email);
        $this->db->bind(':password', $hashed_password);

        // Execute the query
        if ($this->db->execute()) {
            return true; // User registered successfully
        } else {
            // Log error or provide meaningful message
            return false; // Registration failed
        }
    }

    // Find user by email
    public function findUserByEmail($email){
        $this->db->query('SELECT * FROM users WHERE email = :email');
        $this->db->bind(':email', $email);
    
        $row = $this->db->single();
    
        // Check if user exists
        return ($row) ? $row : false; // Return user object or false
    }

    // Login user
    public function login($email, $password) {
        // Find the user by email
        $user = $this->findUserByEmail($email);
    
        // Check if the user exists
        if (!$user) {
            return false; // User not found
        }
    
        // Verify the password
        $hashed_password = $user->password; // Assuming 'password' is the column name in the users table
        if (password_verify($password, $hashed_password)) {
            return $user; // Login successful, return user data
        } else {
            return false; // Password incorrect
        }
    }
}
?>