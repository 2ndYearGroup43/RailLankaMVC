<?php
class Admin_manage_compartment_type {
	private $db;

	public function __construct(){
		$this->db = new Database;
	}

	public function create_compartment_type($data){
		$this->db->query('INSERT INTO compartment_type (typeNo, imageDir) VALUES (:typeNo, :imageDir)');

		$this->db->bind(':typeNo', $data['typeNo']);
		$this->db->bind(':imageDir', $data['imageDir']);

		if($this->db->execute()){
			return true;
		}else{
			return false;
		}
        
	}

	    public function findCompartmentTypeByTypeNo($tno)
    {
        //this is an preapared statement
        $this->db->query('SELECT COUNT(*) as count FROM compartment_type WHERE typeNo = :tno');

        //Email param will be binded by the email variable

        $this->db->bind(':tno', $tno);

        //check if the email is already registsered;
        $results=array();
        $results=$this->db->resultSet();
        $count=$results[0]->count;
        if($count>0){
            return true;
        }else{
            return false;
        }
    }

	public function get(){
		$this->db->query('SELECT * FROM compartment_type ORDER BY typeNo ASC');
		$results = $this->db->resultSet();
		return $results;
	}

	public function findCompartmentType($typeNo){
		$this->db->query('SELECT * FROM compartment_type WHERE typeNo=:typeNo');

		$this->db->bind(':typeNo', $typeNo);

		$row = $this->db->single();
		return $row;
	}

	public function views($data){
		$this->db->query('SELECT compartment_type SET (typeNo=:typeNo, imageDir=:imageDir) WHERE typeNo=:typeNo');

		$this->db->bind(':typeNo', $data['typeNo']);
		$this->db->bind(':imageDir', $data['imageDir']);

		if($this->db->execute()){
			return true;
		}else{
			return false;
		}
	}
}