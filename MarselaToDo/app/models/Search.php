<?php

require_once "../app/core/Database.php";

class SearchModel {
    private $db;

    public function __construct() {
        $this->db = new Database(); 
    }

    public function searchItems($query) {
        $sql = "SELECT * FROM tasks WHERE title LIKE :query OR description LIKE :query";
        $this->db->query($sql);
        $this->db->bind(':query', '%' . $query . '%');
        return $this->db->resultSet();
    }
}