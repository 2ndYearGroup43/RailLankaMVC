<?php
class Admin_manage_available_day {
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

	public function getTrainId(){
        $this->db->query("SELECT trainId FROM train");
        $results=$this->db->resultSet();
        return $results;
    }

	public function findTrainId($trainId){
		$this->db->query('SELECT * FROM availabledays WHERE trainId=:trainId');

		$this->db->bind(':trainId', $trainId);

		$row = $this->db->single();
		return $row;
	}

	public function getReservableStatus($trainId){
		$this->db->query('SELECT reservable_status FROM train WHERE trainId=:trainId');
		$this->db->bind(':trainId', $trainId);
		$results=$this->db->single();
        return $results->reservable_status;
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


	

	public function findTrain($trainId){
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
}