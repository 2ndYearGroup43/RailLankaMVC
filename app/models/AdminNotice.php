<?php
class AdminNotice {
    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    /*public function findAllNotices() {
        $this->db->query('SELECT * FROM notice ');

        $results = $this->db->resultSet();

        return $results;
    }*/
}
