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


	
	public function addSchedule($data){
		$flag;
		$this->db->query('INSERT INTO route (trainId) VALUES (:trainId)');
		$this->db->bind(':trainId', $data['trainId']);

		if($this->db->execute()){
			$this->db->query('SELECT LAST_INSERT_ID() AS routeId');
			$row=$this->db->single();
			$routeId=$row->routeId;

			foreach ($data['schedules'] as $schedule) {
				$this->db->query('INSERT INTO route_station (routeId, stationID, stopNo, arrivaltime, departuretime, date, distance)
				 VALUES (:routeId, :stationID, :stopNo, :arrivaltime, :departuretime, :date, :distance )');

				$this->db->bind(':routeId', $routeId);
				$this->db->bind(':stationID', $schedule->stationId);		
				$this->db->bind(':stopNo', $schedule->stopNo);
				$this->db->bind(':arrivaltime', $schedule->arrivaltime);
				$this->db->bind(':departuretime', $schedule->departuretime);
				$this->db->bind(':date', $schedule->date);
				$this->db->bind(':distance', $schedule->distance);

				if($this->db->execute()){
					 $flag=true;
				}else{
					$flag=false;
				}
			}

			if($flag){
				return true;
			}else{
				return false;
			}
				
			
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

    public function getStationID(){
        $this->db->query("SELECT stationID,name FROM station");
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
		$this->db->query('UPDATE route_station SET routeId=:routeId, stationID=:stationID, stopNo=:stopNo, arrivaltime=:arrivaltime, departuretime=:departuretime, date=:date, distance=:distance WHERE stationID=:stationID');

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

	public function getSchedule($routeId, $stationID)
	{
		$this->db->query('SELECT * FROM route_station WHERE routeId=:routeId AND stationID=:stationID');

		$this->db->bind(':routeId', $routeId);
		$this->db->bind(':stationID', $stationID);

		$row = $this->db->single();
		return $row;
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

	public function delete($stationID){
		$this->db->query('DELETE FROM route_station WHERE stationID=:stationID');

		$this->db->bind(':stationID',$stationID);

        if($this->db->execute()){
			return true;
		}else{
			return false;
		}
	}

    public function findTrain2($trainId){
		$this->db->query('SELECT * FROM route WHERE trainId=:trainId');

		$this->db->bind(':trainId', $trainId);

		$row = $this->db->single();
		return $row;
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

	public function getRouteId($trainId){
           $this->db->query('SELECT * FROM route WHERE trainId=:tid');

           $this->db->bind(':tid', $trainId);

           $results = $this->db->single();
		   return $results;
	}

	public function addNewStops($trainId,$routeId,$data){
           $flag;
			foreach ($data['schedules'] as $schedule) {
				$this->db->query('INSERT INTO route_station (routeId, stationID, stopNo, arrivaltime, departuretime, date, distance)
				 VALUES (:routeId, :stationID, :stopNo, :arrivaltime, :departuretime, :date, :distance )');

				$this->db->bind(':routeId', $routeId);
				$this->db->bind(':stationID', $schedule->stationId);		
				$this->db->bind(':stopNo', $schedule->stopNo);
				$this->db->bind(':arrivaltime', $schedule->arrivaltime);
				$this->db->bind(':departuretime', $schedule->departuretime);
				$this->db->bind(':date', $schedule->date);
				$this->db->bind(':distance', $schedule->distance);		

				
				if($this->db->execute()){
					 $flag=true;
				}else{
					$flag=false;
				}
			
            }

            if($flag){
				return true;
			}else{
				return false;
		    }

	}

	public function getRoutes($routeId){
		$this->db->query('SELECT * FROM route_station WHERE routeId=:routeId');

		$this->db->bind(':routeId', $routeId);

           $results = $this->db->resultSet();
		   return $results;
	}

	public function getRate ($trainId)
    {
        $this->db->query('SELECT f.* FROM fare f INNER JOIN train t ON f.rateID=f.rateID WHERE t.trainId=:trainId');
        $this->db->bind(":trainId", $trainId);
        $row=$this->db->single();
        return $row;
    }
}		