<?php

class Validator {

        // pure method, tapec static
    static public function string($data, $min = 0,  $max = INF) {
        $data = trim($data);

        return is_string($data) 
        && strlen($data) >= $min
        && strlen($data) <= $max;  
    }

    static public function number($data, $min = 0,  $max = INF) {
        $data = trim($data);

        return is_numeric($data) 
        && $data >= $min
        && $data <= $max;  
    }

    static public function email($data) {
        return filter_var($data, FILTER_VALIDATE_EMAIL);
    }

    static public function password($data) {
        $min_length = 8;

        $has_uppercase = '/[A-Z]/';
        $has_lowercase = '/[a-z]/';
        $has_number = '/[0-9]/';
        $has_special = '/[$&+,:;=?@#|\'<>.^*()%!-]/';

        return strlen($data) >=  $min_length &&
        preg_match($has_uppercase, $data) &&
        preg_match($has_lowercase, $data) &&
        preg_match( $has_number, $data) &&
        preg_match($has_special, $data);
    } 
}   