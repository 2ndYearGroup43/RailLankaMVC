<?php
class Admin_manage_compartment_type {
	private $db;

	public function __construct(){
		$this->db = new Database;
	}

	public function create_compartment_type($data){ // add compartment types details
		//this is an preapared statement
		$this->db->query('INSERT INTO compartment_type (typeNo, imageDir) VALUES (:typeNo, :imageDir)');
        //bind values
		$this->db->bind(':typeNo', $data['typeNo']);
		$this->db->bind(':imageDir', $data['imageDir']);
        //execute
		if($this->db->execute()){
			return true;
		}else{
			return false;
		}
        
	}

	    public function findCompartmentTypeByTypeNo($tno) // find compartment by compartment no
    {

        $this->db->query('SELECT COUNT(*) as count FROM compartment_type WHERE typeNo = :tno');

        $this->db->bind(':tno', $tno);

        $results=array();
        $results=$this->db->resultSet();
        $count=$results[0]->count;
        if($count>0){
            return true;
        }else{
            return false;
        }
    }

	public function get(){ // get comaprtment type details
		$this->db->query('SELECT * FROM compartment_type ORDER BY typeNo ASC');
		$results = $this->db->resultSet();
		return $results;
	}

	public function findCompartmentType($typeNo){ // find compartment types
		$this->db->query('SELECT * FROM compartment_type WHERE typeNo=:typeNo');

		$this->db->bind(':typeNo', $typeNo);

		$row = $this->db->single();
		return $row;
	}

	public function views($data){ // view compartment types
		$this->db->query('SELECT compartment_type SET (typeNo=:typeNo, imageDir=:imageDir, noofseats=:noofseats) WHERE typeNo=:typeNo');

		$this->db->bind(':typeNo', $data['typeNo']);
		$this->db->bind(':imageDir', $data['imageDir']);
		$this->db->bind(':noofseats', $data['noofseats']);

		if($this->db->execute()){
			return true;
		}else{
			return false;
		}
	}
}