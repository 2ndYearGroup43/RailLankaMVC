<?php
class Admin_manage_train {
	private $db;

	public function __construct(){
		$this->db = new Database;
	}

	public function create_train($data){
		//this is an preapared statement
		$this->db->query('INSERT INTO train (trainId, name, reservable_status, type, src_station, starttime, dest_station, endtime, rateId, entered_date, entered_time ) VALUES (:trainId, :name, :reservable_status, :type, :src_station, :starttime, :dest_station, :endtime, :rateId, :entered_date, :entered_time)');
        //bind values
		$this->db->bind(':trainId', $data['trainId']);
		$this->db->bind(':name', $data['name']);		
		$this->db->bind(':reservable_status', (int)$data['reservable_status']);
		$this->db->bind(':type', $data['type']);
		$this->db->bind(':src_station', $data['src_station']);
		$this->db->bind(':starttime', $data['starttime']);
		$this->db->bind(':dest_station', $data['dest_station']);
		$this->db->bind(':endtime', $data['endtime']);
        $this->db->bind(':rateId', $data['rateId']);
        $this->db->bind(':entered_date', $data['entered_date']);
        $this->db->bind(':entered_time', $data['entered_time']);
        //execute
		if($this->db->execute()){
			return true;
		}else{
			return false;
		}
	}

    public function findTrainByTrainId($tid)
    {

        $this->db->query('SELECT COUNT(*) as count FROM train WHERE trainId = :tid');

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

	public function get(){
		$this->db->query('SELECT * FROM train ORDER BY trainId ASC');
		$results = $this->db->resultSet();
		return $results;
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



	public function getRateId(){
        $this->db->query("SELECT rateId FROM fare");
        $results=$this->db->resultSet();
        return $results;
    }

    public function getStationID(){
        $this->db->query("SELECT stationID, name FROM station");
        $results=$this->db->resultSet();
        return $results;
    }

	public function edit($data){
		$this->db->query('UPDATE train SET trainId=:trainId, name=:name, reservable_status=:reservable_status, type=:type, src_station=:src_station, starttime=:starttime, dest_station=:dest_station, endtime=:endtime, rateId=:rateId WHERE trainId=:trainId');

		$this->db->bind(':trainId', $data['trainId']);
		$this->db->bind(':name', $data['name']);		
		$this->db->bind(':reservable_status', $data['reservable_status']);
		$this->db->bind(':type', $data['type']);
		$this->db->bind(':src_station', $data['src_station']);
		$this->db->bind(':starttime', $data['starttime']);
		$this->db->bind(':dest_station', $data['dest_station']);
		$this->db->bind(':endtime', $data['endtime']);
        $this->db->bind(':rateId', $data['rateId']);

		if($this->db->execute()){
			return true;
		}else{
			return false;
		}
	}

		public function views($data){
		$this->db->query('SELECT train SET trainId=:trainId, name=:name, reservable_status=:reservable_status, type=:type, src_station=:src_station, starttime=:starttime, dest_station=:dest_station, endtime=:endtime, rateId=:rateId, entered_date=:entered_date, entered_time=:entered_time WHERE trainId=:trainId');

		$this->db->bind(':trainId', $data['trainId']);
		$this->db->bind(':name', $data['name']);		
		$this->db->bind(':reservable_status', $data['reservable_status']);
		$this->db->bind(':type', $data['type']);
		$this->db->bind(':src_station', $data['src_station']);
		$this->db->bind(':starttime', $data['starttime']);
		$this->db->bind(':dest_station', $data['dest_station']);
		$this->db->bind(':endtime', $data['endtime']);
        $this->db->bind(':rateId', $data['rateId']);
        $this->db->bind(':entered_date', $data['entered_date']);
        $this->db->bind(':entered_time', $data['entered_time']);

		if($this->db->execute()){
			return true;
		}else{
			return false;
		}
	}

    public function findStationById($stationID) {
        $this->db->query('SELECT COUNT(*) AS count FROM station WHERE stationID = :stationID');

        $this->db->bind(':stationID', $stationID);

        $row = $this->db->single();
        if($row->count>0){
            return true;
        }else{
            return false;
        }

    }

	public function delete($trainId){
		$this->db->query('DELETE FROM train WHERE trainId=:trainId');

		$this->db->bind(':trainId',$trainId);

        if($this->db->execute()){
			return true;
		}else{
			return false;
		}
	}
}