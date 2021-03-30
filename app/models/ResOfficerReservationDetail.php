<?php 
	class ResOfficerReservationDetail {
		private $db;

		public function __construct() {
			$this->db = new Database;
		}

	public function getStations()
    {
        $this->db->query('SELECT * FROM station'); // get station details
        $result=$this->db->resultSet();
        return $result;
    }

    public function checkStation($station){ //check station is already inserted
        $this->db->query('SELECT COUNT(*) AS count FROM station WHERE stationID=:station');
        $this->db->bind(':station', $station);
        $row=$this->db->single();
        if ($row->count>0){
            return true;
        }else{
            return false;
        }
    }

    public function searchSrcDestDate($data){ // search with source, destination, date
        switch ($data['date']){
            case 'Monday':
                $this->db->query('SELECT t.*, s1.name AS src_name, s2.name AS dest_name  FROM train t
                    INNER JOIN (SELECT t1.trainId FROM
                                        (SELECT r.trainId, rs.stopNo, rs.departuretime FROM route r INNER JOIN route_station rs ON r.routeId=rs.routeId WHERE rs.stationID=:srcStation)
                                         t1 INNER JOIN (SELECT r.trainId, rs.stopNo FROM route r INNER JOIN route_station rs ON r.routeId=rs.routeId WHERE rs.stationID=:destStation)
                                         t2 ON t1.trainId=t2.trainId WHERE t1.stopNo<t2.stopNo and t1.departuretime>=cast(:time AS time)) 
                    t3 ON t.trainId=t3.trainId
                    INNER JOIN station s1 ON s1.stationID=t.src_station
                    INNER JOIN station s2 ON s2.stationID=t.dest_station
                    INNER JOIN availabledays a ON a.trainId=t.trainId WHERE a.monday="Yes"
                ');
                break;
            case 'Tuesday':
                $this->db->query('SELECT t.*, s1.name AS src_name, s2.name AS dest_name  FROM train t
                    INNER JOIN (SELECT t1.trainId FROM
                                        (SELECT r.trainId, rs.stopNo, rs.departuretime FROM route r INNER JOIN route_station rs ON r.routeId=rs.routeId WHERE rs.stationID=:srcStation)
                                         t1 INNER JOIN (SELECT r.trainId, rs.stopNo FROM route r INNER JOIN route_station rs ON r.routeId=rs.routeId WHERE rs.stationID=:destStation)
                                         t2 ON t1.trainId=t2.trainId WHERE t1.stopNo<t2.stopNo and t1.departuretime>=cast(:time AS time)) 
                    t3 ON t.trainId=t3.trainId
                    INNER JOIN station s1 ON s1.stationID=t.src_station
                    INNER JOIN station s2 ON s2.stationID=t.dest_station
                    INNER JOIN availabledays a ON a.trainId=t.trainId WHERE a.tuesday="Yes"
                ');
                break;
            case 'Wednesday':
                $this->db->query('SELECT t.*, s1.name AS src_name, s2.name AS dest_name  FROM train t
                    INNER JOIN (SELECT t1.trainId FROM
                                        (SELECT r.trainId, rs.stopNo, rs.departuretime FROM route r INNER JOIN route_station rs ON r.routeId=rs.routeId WHERE rs.stationID=:srcStation)
                                         t1 INNER JOIN (SELECT r.trainId, rs.stopNo FROM route r INNER JOIN route_station rs ON r.routeId=rs.routeId WHERE rs.stationID=:destStation)
                                         t2 ON t1.trainId=t2.trainId WHERE t1.stopNo<t2.stopNo and t1.departuretime>=cast(:time AS time)) 
                    t3 ON t.trainId=t3.trainId
                    INNER JOIN station s1 ON s1.stationID=t.src_station
                    INNER JOIN station s2 ON s2.stationID=t.dest_station
                    INNER JOIN availabledays a ON a.trainId=t.trainId WHERE a.wednesday="Yes"
                ');
                break;
            case 'Thursday':
                $this->db->query('SELECT t.*, s1.name AS src_name, s2.name AS dest_name  FROM train t
                    INNER JOIN (SELECT t1.trainId FROM
                                        (SELECT r.trainId, rs.stopNo, rs.departuretime FROM route r INNER JOIN route_station rs ON r.routeId=rs.routeId WHERE rs.stationID=:srcStation)
                                         t1 INNER JOIN (SELECT r.trainId, rs.stopNo FROM route r INNER JOIN route_station rs ON r.routeId=rs.routeId WHERE rs.stationID=:destStation)
                                         t2 ON t1.trainId=t2.trainId WHERE t1.stopNo<t2.stopNo and t1.departuretime>=cast(:time AS time)) 
                    t3 ON t.trainId=t3.trainId
                    INNER JOIN station s1 ON s1.stationID=t.src_station
                    INNER JOIN station s2 ON s2.stationID=t.dest_station
                    INNER JOIN availabledays a ON a.trainId=t.trainId WHERE a.thursday="Yes"
                ');
                break;
            case 'Friday':
                $this->db->query('SELECT t.*, s1.name AS src_name, s2.name AS dest_name  FROM train t
                    INNER JOIN (SELECT t1.trainId FROM
                                        (SELECT r.trainId, rs.stopNo, rs.departuretime FROM route r INNER JOIN route_station rs ON r.routeId=rs.routeId WHERE rs.stationID=:srcStation)
                                         t1 INNER JOIN (SELECT r.trainId, rs.stopNo FROM route r INNER JOIN route_station rs ON r.routeId=rs.routeId WHERE rs.stationID=:destStation)
                                         t2 ON t1.trainId=t2.trainId WHERE t1.stopNo<t2.stopNo and t1.departuretime>=cast(:time AS time)) 
                    t3 ON t.trainId=t3.trainId
                    INNER JOIN station s1 ON s1.stationID=t.src_station
                    INNER JOIN station s2 ON s2.stationID=t.dest_station
                    INNER JOIN availabledays a ON a.trainId=t.trainId WHERE a.friday="Yes"
                ');
                break;
            case 'Saturday':
                $this->db->query('SELECT t.*, s1.name AS src_name, s2.name AS dest_name  FROM train t
                    INNER JOIN (SELECT t1.trainId FROM
                                        (SELECT r.trainId, rs.stopNo, rs.departuretime FROM route r INNER JOIN route_station rs ON r.routeId=rs.routeId WHERE rs.stationID=:srcStation)
                                         t1 INNER JOIN (SELECT r.trainId, rs.stopNo FROM route r INNER JOIN route_station rs ON r.routeId=rs.routeId WHERE rs.stationID=:destStation)
                                         t2 ON t1.trainId=t2.trainId WHERE t1.stopNo<t2.stopNo and t1.departuretime>=cast(:time AS time)) 
                    t3 ON t.trainId=t3.trainId
                    INNER JOIN station s1 ON s1.stationID=t.src_station
                    INNER JOIN station s2 ON s2.stationID=t.dest_station
                    INNER JOIN availabledays a ON a.trainId=t.trainId WHERE a.saturday="Yes"
                ');
                break;
            case 'Sunday':
                $this->db->query('SELECT t.*, s1.name AS src_name, s2.name AS dest_name  FROM train t
                    INNER JOIN (SELECT t1.trainId FROM
                                        (SELECT r.trainId, rs.stopNo, rs.departuretime FROM route r INNER JOIN route_station rs ON r.routeId=rs.routeId WHERE rs.stationID=:srcStation)
                                         t1 INNER JOIN (SELECT r.trainId, rs.stopNo FROM route r INNER JOIN route_station rs ON r.routeId=rs.routeId WHERE rs.stationID=:destStation)
                                         t2 ON t1.trainId=t2.trainId WHERE t1.stopNo<t2.stopNo and t1.departuretime>=cast(:time AS time)) 
                    t3 ON t.trainId=t3.trainId
                    INNER JOIN station s1 ON s1.stationID=t.src_station
                    INNER JOIN station s2 ON s2.stationID=t.dest_station
                    INNER JOIN availabledays a ON a.trainId=t.trainId WHERE a.sunday="Yes"
                ');
                break;

        }
        $this->db->bind(':srcStation', $data['srcStation']);
        $this->db->bind(':destStation', $data['destStation']);
        $this->db->bind(':time', $data['time']);

        $trains=$this->db->resultSet();
        return $trains;

    }

    public function getTrain($trainId){ // get train details
        $this->db->query('
    SELECT t1.*, ss.name AS src_name FROM
    (SELECT t.*, sd.name AS dest_name FROM train t INNER JOIN station sd ON t.dest_station=sd.stationID WHERE t.trainId=:trainId)
    t1 INNER JOIN station ss ON t1.src_station=ss.stationID');
        $this->db->bind(':trainId', $trainId);
        $row=$this->db->single();
        return $row;
    }

    public function getSchedule($trainId){ // get schedule details
        $this->db->query('SELECT t1.*,s.name FROM (SELECT rs.* FROM (SELECT * FROM route WHERE trainId=:trainId) rt INNER JOIN route_station rs ON rs.routeId=rt.routeId) t1 INNER JOIN station s on s.stationId=t1.stationId');
        $this->db->bind(':trainId', $trainId);
        $results=$this->db->resultSet();
        return $results;
    }

    public function getDays($trainId){ // get available days
        $this->db->query('SELECT * FROM availabledays WHERE trainId=:trainId');
        $this->db->bind(':trainId', $trainId);
        $row=$this->db->single();
        return $row;
    }

    public function getRate ($trainId) // get rates
    {
        $this->db->query('SELECT f.* FROM fare f INNER JOIN train t ON f.rateID=f.rateID WHERE t.trainId=:trainId');
        $this->db->bind(":trainId", $trainId);
        $row=$this->db->single();
        return $row;
    }

    public function findTrain($trainId, $nic){ // get ticket details
        $this->db->query('SELECT * FROM ticket WHERE trainId=:trainId AND nic=:nic');

        $this->db->bind(':trainId', $trainId);
        $this->db->bind(':nic', $nic);

        $row = $this->db->single();
        return $row;
    }

    public function findTrainName($trainId){ // get train name
        $this->db->query('SELECT name FROM train WHERE trainId=:trainId');

        $this->db->bind(':trainId', $trainId);

        $row = $this->db->single();
        return $row;
    }

    public function findPassengerDetails($nic){ // get passenger details
        $this->db->query('SELECT * FROM passenger WHERE nic=:nic');

        $this->db->bind(':nic', $nic);

        $row = $this->db->single();
        return $row;
    }

    public function findSeatDetails($nic){ // get seat details
        $this->db->query('SELECT * FROM seat WHERE nic=:nic');

        $this->db->bind(':nic', $nic);

        $row = $this->db->single();
        return $row;
    }

    public function getReservationDetails($trainId, $searchDate){ // get reservation details
        $this->db->query('SELECT t.trainId, t.name, ti.ticketId, ti.price, ti.reservationType, s.compartmentNo, s.seatNo, ti.nic, s.classType, s.status, ti.journeyDate
        FROM train t 
        INNER JOIN ticket ti 
        ON t.trainId=ti.trainId
        INNER JOIN  seat s 
        ON ti.ticketId=s.reservationNo
        WHERE t.trainId=:trainId AND ti.journeyDate=:searchDate ORDER BY s.compartmentNo, s.seatNo ASC');

        $this->db->bind(":trainId",$trainId);
        $this->db->bind(":searchDate", $searchDate);
        $results=$this->db->resultSet();
        return $results;

    }

    public function getUnregisteredPassengerDetails($trainId, $ticketId){ // get unregistered passenger details
        $this->db->query('SELECT up.*, t.trainId, t.name, ti.ticketId, ti.price, s.classtype, ti.journeyDate, s1.name as sname, s2.name as dname
        FROM train t
        INNER JOIN ticket ti 
        ON t.trainId=ti.trainId
        INNER JOIN  seat s 
        ON ti.ticketId=s.reservationNo
        INNER JOIN station s1
        ON s1.stationId=t.src_station
        INNER JOIN station s2
        ON s2.stationId=t.dest_station
        INNER JOIN unregistered_passenger up
        ON up.uPassenger_id=ti.uPassenger_id
        WHERE t.trainId=:trainId AND ti.ticketId=:ticketId');

        $this->db->bind(":trainId",$trainId);
        $this->db->bind(':ticketId', $ticketId);

        $row = $this->db->single();
        return $row;
    }

    public function getRegisteredPassengerDetails($trainId, $ticketId){ //get registered passenger details
        $this->db->query('SELECT rp.*, t.trainId, t.name, ti.ticketId, ti.price, s.classtype, ti.journeyDate, s1.name as sname, s2.name as dname
        FROM train t
        INNER JOIN ticket ti 
        ON t.trainId=ti.trainId
        INNER JOIN  seat s 
        ON ti.ticketId=s.reservationNo
        INNER JOIN station s1
        ON s1.stationId=t.src_station
        INNER JOIN station s2
        ON s2.stationId=t.dest_station
        INNER JOIN passenger rp
        ON rp.passengerId =rp.passengerId 
        WHERE t.trainId=:trainId AND ti.ticketId=:ticketId');

        $this->db->bind(":trainId",$trainId);
        $this->db->bind(':ticketId', $ticketId);

        $row = $this->db->single();
        return $row;
    }

    public function getCompSeatDetails($ticketId){ // get comaprtment details
        $this->db->query('SELECT s.seatNo, s.compartmentNo, s.classtype
            FROM seat s 
            INNER JOIN ticket t
            ON t.ticketId=s.reservationNo 
            WHERE t.ticketId=:ticketId');

        $this->db->bind(':ticketId', $ticketId);

       $results=$this->db->resultSet();
        return $results;
    }

    public function checkUnregisteredPassenger($ticketId){ // check unregistered passenger
        $this->db->query('SELECT passengerId FROM ticket WHERE ticketId=:ticketId');

        $this->db->bind(':ticketId', $ticketId);

        $row = $this->db->single();
        return $row;

    }

    public function getOldPassengerDetails($trainId, $ticketId){ // get old passenger details
        $this->db->query('SELECT t.trainId, t.name, ti.ticketId, ti.price, s.classtype, ti.journeyDate, ti.nic, s1.name as sname, s2.name as dname
        FROM train t
        INNER JOIN ticket ti 
        ON t.trainId=ti.trainId
        INNER JOIN  seat s 
        ON ti.ticketId=s.reservationNo
        INNER JOIN station s1
        ON s1.stationId=t.src_station
        INNER JOIN station s2
        ON s2.stationId=t.dest_station
        WHERE t.trainId=:trainId AND ti.ticketId=:ticketId');

        $this->db->bind(":trainId",$trainId);
        $this->db->bind(':ticketId', $ticketId);

        $row = $this->db->single();
        return $row;
    }

	}
