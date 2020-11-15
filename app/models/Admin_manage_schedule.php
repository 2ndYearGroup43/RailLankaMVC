<?php
class Admin_manage_schedule {
	private $db;

	public function __construct(){
		$this->db = new Database;
	}

	public function create_schedule($data){
		$this->db->query('INSERT INTO route_station (routeId, stationID, stopNo, arrivaltime, departuretime, date, distance) VALUES (:routeId, :stationID, :stopNo, :arrivaltime, :departuretime, :date, :distance )');

		$this->db->bind(':routeId', $data['routeId']);
		$this->db->bind(':stationID', $data['stationID']);		
		$this->db->bind(':stopNo', $data['stopNo']);
		$this->db->bind(':arrivaltime', $data['arrivaltime']);
		$this->db->bind(':departuretime', $data['departuretime']);
		$this->db->bind(':date', $data['date']);
		$this->db->bind(':distance', $data['distance']);

		if($this->db->execute()){
			return true;
		}else{
			return false;
		}
        
	}

	    public function findRouteByRouteId($rid)
    {
        //this is an preapared statement
        $this->db->query('SELECT COUNT(*) as count FROM route_station WHERE routeId = :rid');

        //Email param will be binded by the email variable

        $this->db->bind(':rid', $rid);

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

    public function findRouteByStationID($sid)
    {
        //this is an preapared statement
        $this->db->query('SELECT COUNT(*) as count FROM route_station WHERE stationID = :sid');

        //Email param will be binded by the email variable

        $this->db->bind(':sid', $sid);

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
		$this->db->query('SELECT * FROM route_station ORDER BY routeId ASC');
		$results = $this->db->resultSet();
		return $results;
	}

	public function getRouteId(){
        $this->db->query("SELECT routeId FROM route");
        $results=$this->db->resultSet();
        return $results;
    }

    public function getStationID(){
        $this->db->query("SELECT stationID FROM station");
        $results=$this->db->resultSet();
        return $results;
    }

	public function findRoute($routeId){
		$this->db->query('SELECT * FROM route_station WHERE routeId=:routeId');

		$this->db->bind(':routeId', $routeId);

		$row = $this->db->single();
		return $row;
	}

	public function edit($data){
		$this->db->query('UPDATE route_station SET routeId=:routeId, stationID=:stationID, stopNo=:stopNo, arrivaltime=:arrivaltime, departuretime=:departuretime, date=:date, distance=:distance WHERE routeId=:routeId');

		$this->db->bind(':routeId', $data['routeId']);
		$this->db->bind(':stationID', $data['stationID']);		
		$this->db->bind(':stopNo', $data['stopNo']);
		$this->db->bind(':arrivaltime', $data['arrivaltime']);
		$this->db->bind(':departuretime', $data['departuretime']);
		$this->db->bind(':date', $data['date']);
		$this->db->bind(':distance', $data['distance']);

		if($this->db->execute()){
			return true;
		}else{
			return false;
		}
	}

		public function views($data){
		$this->db->query('SELECT route_station SET routeId=:routeId, stationID=:stationID, stopNo=:stopNo, arrivaltime=:arrivaltime, departuretime=:departuretime, date=:date, distance=:distance WHERE routeId=:routeId');

		$this->db->bind(':routeId', $data['routeId']);
		$this->db->bind(':stationID', $data['stationID']);		
		$this->db->bind(':stopNo', $data['stopNo']);
		$this->db->bind(':arrivaltime', $data['arrivaltime']);
		$this->db->bind(':departuretime', $data['departuretime']);
		$this->db->bind(':date', $data['date']);
		$this->db->bind(':distance', $data['distance']);

		if($this->db->execute()){
			return true;
		}else{
			return false;
		}
	}

	public function delete($routeId){
		$this->db->query('DELETE FROM route_station WHERE routeId=:routeId');

		$this->db->bind(':routeId',$routeId);

        if($this->db->execute()){
			return true;
		}else{
			return false;
		}
	}
}