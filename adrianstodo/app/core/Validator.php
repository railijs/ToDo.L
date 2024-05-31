<?php

class Validator {
    // Validate string length
    static public function string($data, $min = 0, $max = INF) {
        $data = trim($data);
        return is_string($data) 
            && strlen($data) >= $min 
            && strlen($data) <= $max;
    }

    // Validate number within range
    static public function number($data, $min = 0, $max = INF) {
        $data = trim($data);
        return is_numeric($data) 
            && $data >= $min 
            && $data <= $max;
    }

    // Validate email format
    static public function email($data) {
        return filter_var($data, FILTER_VALIDATE_EMAIL);
    }

    // Validate password strength
    static public function password($data) {
        $min_length = 8;
        $allowed_special_chars = '$&+,:;=?@#|\'<>.^*()%!-';

        $has_uppercase = '/[A-Z]/';
        $has_lowercase = '/[a-z]/';
        $has_number = '/[0-9]/';
        $has_special = '/[' . preg_quote($allowed_special_chars, '/') . ']/';

        return strlen($data) >= $min_length &&
               preg_match($has_uppercase, $data) &&
               preg_match($has_lowercase, $data) &&
               preg_match($has_number, $data) &&
               preg_match($has_special, $data) &&
               !preg_match('/(.)\1{2,}/', $data); // No more than 2 repeating characters
    }

    // Validate date is not in the past
    static public function dateNotInPast($date) {
        $currentDate = date('Y-m-d');
        return $date >= $currentDate;
    }

    // Validate non-empty string
    static public function emptyString($data, $min = 1, $max = INF) {
        $data = trim($data);
        return is_string($data) && strlen($data) >= $min && strlen($data) <= $max && !empty($data);
    }

    // Check if email exists in the database
    static public function emailExists($email) {
        $db = new Database();
        $db->query("SELECT COUNT(*) FROM users WHERE email = :email");
        $db->bind(':email', $email);
        $db->execute();
        $count = $db->fetchColumn();
        return $count > 0;
    }
}