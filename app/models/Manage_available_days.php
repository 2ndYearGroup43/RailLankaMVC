<?php
class Manage_available_days {
	private $db;

	public function __construct(){
		$this->db = new Database;
	}

	public function create_available_day($data){
		$this->db->query('INSERT INTO availabledays (trainId, sunday, monday, tuesday, wednesday, thursday, friday, saturday) VALUES (:trainId, :sunday, :monday, :tuesday, :wednesday, :thursday, :friday, :saturday)');

		$this->db->bind(':trainId', $data['trainId']);
		$this->db->bind(':sunday', $data['sunday']);
		$this->db->bind(':monday', $data['monday']);
		$this->db->bind(':tuesday', $data['tuesday']);
		$this->db->bind(':wednesday', $data['wednesday']);
		$this->db->bind(':thursday', $data['thursday']);
		$this->db->bind(':friday', $data['friday']);
		$this->db->bind(':saturday', $data['saturday']);

		if($this->db->execute()){
			return true;
		}else{
			return false;
		}
        
	}

	    public function findTrainTypeByTrainId($tid)
    {
        //this is an preapared statement
        $this->db->query('SELECT COUNT(*) as count FROM availabledays WHERE trainId = :tid');

        //Email param will be binded by the email variable

        $this->db->bind(':tid', $tid);

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
		$this->db->query('SELECT * FROM availabledays ORDER BY trainId ASC');
		$results = $this->db->resultSet();
		return $results;
	}

	public function findTrainId($trainId){
		$this->db->query('SELECT * FROM availabledays WHERE trainId=:trainId');

		$this->db->bind(':trainId', $trainId);

		$row = $this->db->single();
		return $row;
	}

	public function edit($data){
		$this->db->query('UPDATE availabledays SET trainId=:trainId, sunday=:sunday, monday=:monday, tuesday=:tuesday, wednesday=:wednesday, thursday=:thursday, friday=:friday, saturday=:saturday WHERE trainId=:trainId');

		$this->db->bind(':trainId', $data['trainId']);
		$this->db->bind(':sunday', $data['sunday']);
		$this->db->bind(':monday', $data['monday']);
		$this->db->bind(':tuesday', $data['tuesday']);
		$this->db->bind(':wednesday', $data['wednesday']);
		$this->db->bind(':thursday', $data['thursday']);
		$this->db->bind(':friday', $data['friday']);
		$this->db->bind(':saturday', $data['saturday']);

		if($this->db->execute()){
			return true;
		}else{
			return false;
		}
	}

		public function views($data){
		$this->db->query('SELECT availabledays SET trainId=:trainId, sunday=:sunday, monday=:monday, tuesday=:tuesday, wednesday=:wednesday, thursday=:thursday, friday=:friday, saturday=:saturday WHERE trainId=:trainId');

		$this->db->bind(':trainId', $data['trainId']);
		$this->db->bind(':sunday', $data['sunday']);
		$this->db->bind(':monday', $data['monday']);
		$this->db->bind(':tuesday', $data['tuesday']);
		$this->db->bind(':wednesday', $data['wednesday']);
		$this->db->bind(':thursday', $data['thursday']);
		$this->db->bind(':friday', $data['friday']);
		$this->db->bind(':saturday', $data['saturday']);

		if($this->db->execute()){
			return true;
		}else{
			return false;
		}
	}

	public function delete($trainId){
		$this->db->query('DELETE FROM availabledays WHERE trainId=:trainId');

		$this->db->bind(':trainId',$trainId);

        if($this->db->execute()){
			return true;
		}else{
			return false;
		}
	}
}