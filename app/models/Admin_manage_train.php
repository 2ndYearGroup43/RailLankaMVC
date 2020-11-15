<?php
class Admin_manage_train {
	private $db;

	public function __construct(){
		$this->db = new Database;
	}

	public function create_train($data){
		$this->db->query('INSERT INTO train (trainId, name, reservable_status, type, src_station, starttime, dest_station, endtime, rateId, entered_date, entered_time ) VALUES (:trainId, :name, :reservable_status, :type, :src_station, :starttime, :dest_station, :endtime, :rateId, :entered_date, :entered_time)');

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

    public function findTrainByTrainId($tid)
    {
        //this is an preapared statement
        $this->db->query('SELECT COUNT(*) as count FROM train WHERE trainId = :tid');

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
		$this->db->query('SELECT * FROM train ORDER BY trainId ASC');
		$results = $this->db->resultSet();
		return $results;
	}

	public function findTrain($trainId){
		$this->db->query('SELECT * FROM train WHERE trainId=:trainId');

		$this->db->bind(':trainId', $trainId);

		$row = $this->db->single();
		return $row;
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