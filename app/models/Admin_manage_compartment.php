<?php
class Admin_manage_compartment {
	private $db;

	public function __construct(){
		$this->db = new Database;
	}

	public function create_compartment($data){
		$this->db->query('INSERT INTO compartment (trainId, compartmentNo, class, noofseats, type) VALUES (:trainId, :compartmentNo, :class, :noofseats, :type)');

		$this->db->bind(':trainId', $data['trainId']);
		$this->db->bind(':compartmentNo', $data['compartmentNo']);		
		$this->db->bind(':class', $data['class']);
		$this->db->bind(':noofseats', $data['noofseats']);
		$this->db->bind(':type', $data['type']);

		if($this->db->execute()){
			return true;
		}else{
			return false;
		}
        
	}

	    public function findCompartmentByCompartmentNo($cno)
    {
        //this is an preapared statement
        $this->db->query('SELECT COUNT(*) as count FROM compartment WHERE compartmentNo = :cno');

        //Email param will be binded by the email variable

        $this->db->bind(':cno', $cno);

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

    public function findTrainByTrainId($tid)
    {
        //this is an preapared statement
        $this->db->query('SELECT COUNT(*) as count FROM compartment WHERE trainId = :tid');

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

    public function findCompartmentByType($tid)
    {
        //this is an preapared statement
        $this->db->query('SELECT COUNT(*) as count FROM compartment WHERE type = :tid');

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
		$this->db->query('SELECT * FROM compartment ORDER BY trainId ASC');
		$results = $this->db->resultSet();
		return $results;
	}

	public function findTrain($trainId){
		$this->db->query('SELECT * FROM compartment WHERE trainId=:trainId');

		$this->db->bind(':trainId', $trainId);

		$row = $this->db->single();
		return $row;
	}

	public function getTrainId(){
        $this->db->query("SELECT trainId FROM train");
        $results=$this->db->resultSet();
        return $results;
    }

    public function getType(){
        $this->db->query("SELECT typeNo FROM compartment_type");
        $results=$this->db->resultSet();
        return $results;
    }

	public function edit($data){
		$this->db->query('UPDATE compartment SET trainId=:trainId, compartmentNo=:compartmentNo, class=:class, noofseats=:noofseats, type=:type WHERE trainId=:trainId');

		$this->db->bind(':trainId', $data['trainId']);
		$this->db->bind(':compartmentNo', $data['compartmentNo']);
		$this->db->bind(':class', $data['class']);
		$this->db->bind(':noofseats', $data['noofseats']);
		$this->db->bind(':type', $data['type']);

		if($this->db->execute()){
			return true;
		}else{
			return false;
		}
	}

		public function views($data){
		$this->db->query('SELECT compartment SET trainId=:trainId, compartmentNo=:compartmentNo, class=:class, noofseats=:noofseats, type=:type WHERE trainId=:trainId');

		$this->db->bind(':trainId', $data['trainId']);
		$this->db->bind(':compartmentNo', $data['compartmentNo']);
		$this->db->bind(':class', $data['class']);
		$this->db->bind(':noofseats', $data['noofseats']);
		$this->db->bind(':type', $data['type']);

		if($this->db->execute()){
			return true;
		}else{
			return false;
		}
	}

	public function delete($trainId){
		$this->db->query('DELETE FROM compartment WHERE trainId=:trainId');

		$this->db->bind(':trainId',$trainId);

        if($this->db->execute()){
			return true;
		}else{
			return false;
		}
	}
}