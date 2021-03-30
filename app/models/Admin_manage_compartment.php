<?php
class Admin_manage_compartment {
	private $db;

	public function __construct(){
		$this->db = new Database;
	}

	public function create_compartment($data){ // add compartment details
		$flag;

		foreach ($data['compartments'] as $comp) {
			//this is an preapared statement
			$this->db->query('INSERT INTO compartment (trainId, compartmentNo, class, type) VALUES (:trainId, :compartmentNo, :class, :type)');
            //bind values
			$this->db->bind(':trainId', $data['trainId']);
			$this->db->bind(':compartmentNo', $comp->compartmentNo);		
			$this->db->bind(':class', $comp->trainClass);
			$this->db->bind(':type', $comp->type);
            //execute
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

	    public function findCompartmentByCompartmentNo($trainId,$cno) // find compartment by compartment number
    {

        $this->db->query('SELECT COUNT(*) as count FROM compartment WHERE compartmentNo = :cno AND trainId=:trainId');

        $this->db->bind(':cno', $cno);
        $this->db->bind(':trainId', $trainId);

        $results=array();
        $results=$this->db->resultSet();
        $count=$results[0]->count;
        if($count>0){
            return true;
        }else{
            return false;
        }
    }

    public function findTrainByTrainId($tid) // find train by train id
    {

        $this->db->query('SELECT COUNT(*) as count FROM compartment WHERE trainId = :tid');

        $this->db->bind(':tid', $tid);

        $results=array();
        $results=$this->db->resultSet();
        $count=$results[0]->count;
        if($count>0){
            return true;
        }else{
            return false;
        }
    }

    public function findCompartmentByType($tid) // find compartment by compartment type
    {

        $this->db->query('SELECT COUNT(*) as count FROM compartment WHERE type = :tid');

        $this->db->bind(':tid', $tid);

        $results=array();
        $results=$this->db->resultSet();
        $count=$results[0]->count;
        if($count>0){
            return true;
        }else{
            return false;
        }
    }

	public function get(){ // get compartment numbers
		$this->db->query('SELECT * FROM compartment ORDER BY trainId ASC');
		$results = $this->db->resultSet();
		return $results;
	}

	public function findTrain($trainId){ // get all from compartment
		$this->db->query('SELECT * FROM compartment WHERE trainId=:trainId');

		$this->db->bind(':trainId', $trainId);

		$row = $this->db->single();
		return $row;
	}

	public function getTrainId(){ // get train id from train
        $this->db->query("SELECT trainId FROM train");
        $results=$this->db->resultSet();
        return $results;
    }

    public function getType(){ // get type no from compartment type
        $this->db->query("SELECT typeNo FROM compartment_type");
        $results=$this->db->resultSet();
        return $results;
    }

    public function getMax(){ // get max seats from compartment type
        $this->db->query("SELECT max FROM compartment_type");
        $results=$this->db->resultSet();
        return $results;
    }

	public function edit($data){ // edit data of compartment
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

		public function views($data){ // view data from compartment
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

	public function delete($compartmentNo, $trainId){ // delete data from compartment
		$this->db->query('DELETE FROM compartment WHERE trainId=:trainId AND compartmentNo=:compartmentNo');

		$this->db->bind(':trainId',$trainId);
		$this->db->bind(':compartmentNo',$compartmentNo);

        if($this->db->execute()){
			return true;
		}else{
			return false;
		}
	}

	public function findTrain2($trainId){ // find station name
		$this->db->query('SELECT t1.*,s1.name AS dest FROM 
		(SELECT t.*, s.name AS src FROM train t JOIN station s ON  t.src_station=s.stationID WHERE trainId=:trainId) t1 
		JOIN station s1 ON t1.dest_station=s1.stationID WHERE trainId=:trainId');

		$this->db->bind(':trainId', $trainId);

		$row = $this->db->single();
		return $row;
	}

	public function getScheduleDetails($trainId) // get schedule details
	{
		$this->db->query('SELECT t1.*,s1.name AS station FROM
		 (SELECT r.trainId,s.* FROM route r INNER JOIN route_station s ON r.routeId=s.routeId WHERE r.trainId=:trainId) t1 
		 INNER JOIN station s1 ON t1.stationid=s1.stationID');

		 $this->db->bind(':trainId', $trainId);

		 $results=$this->db->resultSet();

		 return $results;
	}

	public function getAvailableDays($trainId) // get available days
	{
		$this->db->query('SELECT a.* FROM availabledays a INNER JOIN train t ON t.trainId=a.trainId WHERE a.trainId=:trainId');

		$this->db->bind(':trainId', $trainId);

		$row = $this->db->single();
		return $row;
	}


	public function getCompartments($trainId) // get compartment details
	{
		$this->db->query('SELECT c.*, ct.imageDir FROM compartment c INNER JOIN compartment_type ct ON ct.typeno=c.type WHERE c.trainId=:trainId ORDER BY c.compartmentNo');

		$this->db->bind(':trainId', $trainId);

		$results = $this->db->resultSet();
		return $results;
	}


	public function getCompartment($trainId, $cno) // get compartment details
	{
		$this->db->query('SELECT * FROM compartment WHERE trainId=:trainId AND compartmentNo=:cno');

		$this->db->bind(':trainId', $trainId);
		$this->db->bind(':cno', $cno);
		

		$row = $this->db->single();
		return $row;
	}

	public function editSingle($data)	// edit compartment details
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

	public function getNoofSeats($typeNo) //get number of seats
	{
		$this->db->query('SELECT * FROM compartment_type WHERE typeNo=:typeNo');

		$this->db->bind(':typeNo', $typeNo);

		$row = $this->db->single();
		return $row;
	}
}