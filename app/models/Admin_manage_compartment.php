<?php
class Admin_manage_compartment {
	private $db;

	public function __construct(){
		$this->db = new Database;
	}

	public function create_compartment($data){
		$flag;

		foreach ($data['compartments'] as $comp) {
			$this->db->query('INSERT INTO compartment (trainId, compartmentNo, class, type) VALUES (:trainId, :compartmentNo, :class, :type)');

			$this->db->bind(':trainId', $data['trainId']);
			$this->db->bind(':compartmentNo', $comp->compartmentNo);		
			$this->db->bind(':class', $comp->trainClass);
			$this->db->bind(':type', $comp->type);

			if($this->db->execute()){
				$flag= true;
			}else{
				$flag= false;
			}

		}

			

		if($flag){
			return true;
		}else{
			return false;
		}
        
	}

	    public function findCompartmentByCompartmentNo($trainId,$cno)
    {
        //this is an preapared statement
        $this->db->query('SELECT COUNT(*) as count FROM compartment WHERE compartmentNo = :cno AND trainId=:trainId');

        //Email param will be binded by the email variable

        $this->db->bind(':cno', $cno);
        $this->db->bind(':trainId', $trainId);

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

    public function getMax(){
        $this->db->query("SELECT max FROM compartment_type");
        $results=$this->db->resultSet();
        return $results;
    }

	public function edit($data){
		$this->db->query('UPDATE compartment SET trainId=:trainId, compartmentNo=:compartmentNo, class=:class, type=:type WHERE trainId=:trainId');

		$this->db->bind(':trainId', $data['trainId']);
		$this->db->bind(':compartmentNo', $data['compartmentNo']);
		$this->db->bind(':class', $data['class']);
		$this->db->bind(':type', $data['type']);

		if($this->db->execute()){
			return true;
		}else{
			return false;
		}
	}

		public function views($data){
		$this->db->query('SELECT compartment SET trainId=:trainId, compartmentNo=:compartmentNo, class=:class, type=:type WHERE trainId=:trainId');

		$this->db->bind(':trainId', $data['trainId']);
		$this->db->bind(':compartmentNo', $data['compartmentNo']);
		$this->db->bind(':class', $data['class']);
		$this->db->bind(':type', $data['type']);

		if($this->db->execute()){
			return true;
		}else{
			return false;
		}
	}

	public function delete($compartmentNo, $trainId){
		$this->db->query('DELETE FROM compartment WHERE trainId=:trainId AND compartmentNo=:compartmentNo');

		$this->db->bind(':trainId',$trainId);
		$this->db->bind(':compartmentNo',$compartmentNo);

        if($this->db->execute()){
			return true;
		}else{
			return false;
		}
	}


	

	public function findTrain2($trainId){
		$this->db->query('SELECT t1.*,s1.name AS dest FROM 
		(SELECT t.*, s.name AS src FROM train t JOIN station s ON  t.src_station=s.stationID WHERE trainId=:trainId) t1 
		JOIN station s1 ON t1.dest_station=s1.stationID WHERE trainId=:trainId');

		$this->db->bind(':trainId', $trainId);

		$row = $this->db->single();
		return $row;
	}

	public function getScheduleDetails($trainId)
	{
		$this->db->query('SELECT t1.*,s1.name AS station FROM
		 (SELECT r.trainId,s.* FROM route r INNER JOIN route_station s ON r.routeId=s.routeId WHERE r.trainId=:trainId) t1 
		 INNER JOIN station s1 ON t1.stationid=s1.stationID');

		 $this->db->bind(':trainId', $trainId);

		 $results=$this->db->resultSet();

		 return $results;
	}

	public function getAvailableDays($trainId)
	{
		$this->db->query('SELECT a.* FROM availabledays a INNER JOIN train t ON t.trainId=a.trainId WHERE a.trainId=:trainId');

		$this->db->bind(':trainId', $trainId);

		$row = $this->db->single();
		return $row;
	}


	public function getCompartments($trainId)
	{
		$this->db->query('SELECT c.*, ct.imageDir FROM compartment c INNER JOIN compartment_type ct ON ct.typeno=c.type WHERE c.trainId=:trainId');

		$this->db->bind(':trainId', $trainId);

		$results = $this->db->resultSet();
		return $results;
	}


	public function getCompartment($trainId, $cno)
	{
		$this->db->query('SELECT * FROM compartment WHERE trainId=:trainId AND compartmentNo=:cno');

		$this->db->bind(':trainId', $trainId);
		$this->db->bind(':cno', $cno);
		

		$row = $this->db->single();
		return $row;
	}

	public function editSingle($data)	
	{
		$this->db->query('UPDATE compartment SET trainId=:trainId, compartmentNo=:compartmentNo, class=:class, type=:type WHERE trainId=:trainId AND compartmentNo=:cno');

		$this->db->bind(':trainId', $data['trainId']);
		$this->db->bind(':compartmentNo', $data['compartmentNo']);
		$this->db->bind(':cno', $data['compartment']->compartmentNo);
		$this->db->bind(':class', $data['class']);
		$this->db->bind(':type', $data['type']);

		if($this->db->execute()){
			return true;
		}else{
			return false;
		}
	}

	public function getNoofSeats($typeNo)
	{
		$this->db->query('SELECT * FROM compartment_type WHERE typeNo=:typeNo');

		$this->db->bind(':typeNo', $typeNo);

		$row = $this->db->single();
		return $row;
	}
}