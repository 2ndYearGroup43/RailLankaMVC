<?php
class AdminAccount {
    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    public function findAdminById($id)
        {
            $this->db->query('SELECT a.*, u.email FROM admin a INNER JOIN users u ON a.userid=u.userid WHERE a.userid=:userid');
            $this->db->bind(":userid",$id);
            $row=$this->db->single();
            return $row; 
        }

        public function getSuperAdminDetails($id){
            $this->db->query('SELECT a.*, u.email FROM super_admin a INNER JOIN users u ON a.userid=u.userid WHERE a.userid=:userid');
            $this->db->bind(":userid",$id);
            $row=$this->db->single();
            return $row;;
        }

}    