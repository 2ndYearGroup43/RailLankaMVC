<?php 
	class ResofficerManageSeat {
		private $db;

		public function __construct() {
			$this->db = new Database;
		}

    public function getStations()
    {
        $this->db->query('SELECT * FROM station');
        $result=$this->db->resultSet();
        return $result;
    }

    public function checkStation($station){
        $this->db->query('SELECT COUNT(*) AS count FROM station WHERE stationID=:station');
        $this->db->bind(':station', $station);
        $row=$this->db->single();
        if ($row->count>0){
            return true;
        }else{
            return false;
        }
    }

    public function searchSrcOnly($data)
    {
        $this->db->query('SELECT t.*, s1.name AS src_name, s2.name AS dest_name FROM train t
        INNER JOIN (SELECT r.trainId FROM route r INNER JOIN route_station rs ON r.routeId=rs.routeId WHERE rs.stationID=:srcStation AND rs.departuretime>=cast(:time AS time)) t1 ON t.trainId=t1.trainId
        INNER JOIN station s1 ON t.src_station=s1.stationID
        INNER JOIN station s2 ON t.dest_station=s2.stationID
        WHERE t.dest_station <> :srcStation
        ');
        $this->db->bind(':time', $data['time']);
        $this->db->bind(':srcStation', $data['srcStation']);

        $trains=$this->db->resultSet();
        return $trains;
    }

    public function searchSrcDate($data)
    {
        switch ($data['date']) {
            case 'Monday':
                $this->db->query('SELECT t.*, s1.name AS src_name, s2.name AS dest_name FROM train t
                INNER JOIN (SELECT r.trainId FROM route r INNER JOIN route_station rs ON r.routeId=rs.routeId WHERE rs.stationID=:srcStation AND rs.departuretime>=cast(:time AS time)) t1 ON t.trainId=t1.trainId
                INNER JOIN station s1 ON t.src_station=s1.stationID
                INNER JOIN station s2 ON t.dest_station=s2.stationID
                INNER JOIN availabledays a ON a.trainId=t.trainId WHERE a.monday="Yes" AND t.dest_station <> :srcStation
                ');
                break;
            case 'Tuesday':
                $this->db->query('SELECT t.*, s1.name AS src_name, s2.name AS dest_name FROM train t
                INNER JOIN (SELECT r.trainId FROM route r INNER JOIN route_station rs ON r.routeId=rs.routeId WHERE rs.stationID=:srcStation AND rs.departuretime>=cast(:time AS time)) t1 ON t.trainId=t1.trainId
                INNER JOIN station s1 ON t.src_station=s1.stationID
                INNER JOIN station s2 ON t.dest_station=s2.stationID
                INNER JOIN availabledays a ON a.trainId=t.trainId WHERE a.tuesday="Yes" AND t.dest_station <> :srcStation
                ');
                break;
            case 'Wednesday':
                $this->db->query('SELECT t.*, s1.name AS src_name, s2.name AS dest_name FROM train t
                INNER JOIN (SELECT r.trainId FROM route r INNER JOIN route_station rs ON r.routeId=rs.routeId WHERE rs.stationID=:srcStation AND rs.departuretime>=cast(:time AS time)) t1 ON t.trainId=t1.trainId
                INNER JOIN station s1 ON t.src_station=s1.stationID
                INNER JOIN station s2 ON t.dest_station=s2.stationID
                INNER JOIN availabledays a ON a.trainId=t.trainId WHERE a.wednesday="Yes" AND t.dest_station <> :srcStation
                ');
                break;
            case 'Thursday':
                $this->db->query('SELECT t.*, s1.name AS src_name, s2.name AS dest_name FROM train t
                INNER JOIN (SELECT r.trainId FROM route r INNER JOIN route_station rs ON r.routeId=rs.routeId WHERE rs.stationID=:srcStation AND rs.departuretime>=cast(:time AS time)) t1 ON t.trainId=t1.trainId
                INNER JOIN station s1 ON t.src_station=s1.stationID
                INNER JOIN station s2 ON t.dest_station=s2.stationID
                INNER JOIN availabledays a ON a.trainId=t.trainId WHERE a.thursday="Yes" AND t.dest_station <> :srcStation
                ');
                break;
            case 'Friday':
                $this->db->query('SELECT t.*, s1.name AS src_name, s2.name AS dest_name FROM train t
                INNER JOIN (SELECT r.trainId FROM route r INNER JOIN route_station rs ON r.routeId=rs.routeId WHERE rs.stationID=:srcStation AND rs.departuretime>=cast(:time AS time)) t1 ON t.trainId=t1.trainId
                INNER JOIN station s1 ON t.src_station=s1.stationID
                INNER JOIN station s2 ON t.dest_station=s2.stationID
                INNER JOIN availabledays a ON a.trainId=t.trainId WHERE a.friday="Yes" AND t.dest_station <> :srcStation
                ');
                break;
            case 'Saturday':
                $this->db->query('SELECT t.*, s1.name AS src_name, s2.name AS dest_name FROM train t
                INNER JOIN (SELECT r.trainId FROM route r INNER JOIN route_station rs ON r.routeId=rs.routeId WHERE rs.stationID=:srcStation AND rs.departuretime>=cast(:time AS time)) t1 ON t.trainId=t1.trainId
                INNER JOIN station s1 ON t.src_station=s1.stationID
                INNER JOIN station s2 ON t.dest_station=s2.stationID
                INNER JOIN availabledays a ON a.trainId=t.trainId WHERE a.saturday="Yes" AND t.dest_station <> :srcStation
                ');
                break;
            case 'Sunday':
                $this->db->query('SELECT t.*, s1.name AS src_name, s2.name AS dest_name FROM train t
                INNER JOIN (SELECT r.trainId FROM route r INNER JOIN route_station rs ON r.routeId=rs.routeId WHERE rs.stationID=:srcStation AND rs.departuretime>=cast(:time AS time)) t1 ON t.trainId=t1.trainId
                INNER JOIN station s1 ON t.src_station=s1.stationID
                INNER JOIN station s2 ON t.dest_station=s2.stationID
                INNER JOIN availabledays a ON a.trainId=t.trainId WHERE a.sunday="Yes" AND t.dest_station <> :srcStation
                ');
        }

        $this->db->bind(':srcStation', $data['srcStation']);
        $this->db->bind(':time', $data['time']);
        $trains=$this->db->resultSet();
        return $trains;
    }


    public function searchDestOnly($data)
    {
        $this->db->query('SELECT t.*, s1.name AS src_name, s2.name AS dest_name FROM train t
        INNER JOIN (SELECT r.trainId FROM route r INNER JOIN route_station rs ON r.routeId=rs.routeId WHERE rs.stationID=:destStation AND rs.departuretime>=cast(:time AS time)) t1 ON t.trainId=t1.trainId
        INNER JOIN station s1 ON t.src_station=s1.stationID
        INNER JOIN station s2 ON t.dest_station=s2.stationID
        WHERE t.src_station <> :destStation
        ');
        $this->db->bind(':destStation', $data['destStation']);
        $this->db->bind(':time', $data['time']);
        $trains = $this->db->resultSet();
        return $trains;
    }

    public function searchDestDate($data)
    {
        switch ($data['date']) {
            case 'Monday':
                $this->db->query('SELECT t.*, s1.name AS src_name, s2.name AS dest_name FROM train t
                INNER JOIN (SELECT r.trainId FROM route r INNER JOIN route_station rs ON r.routeId=rs.routeId WHERE rs.stationID=:destStation AND rs.departuretime>=cast(:time AS time)) t1 ON t.trainId=t1.trainId
                INNER JOIN station s1 ON t.src_station=s1.stationID
                INNER JOIN station s2 ON t.dest_station=s2.stationID
                INNER JOIN availabledays a ON a.trainId=t.trainId WHERE a.monday="Yes" AND t.src_station <> :destStation
                ');
                break;
            case 'Tuesday':
                $this->db->query('SELECT t.*, s1.name AS src_name, s2.name AS dest_name FROM train t
                INNER JOIN (SELECT r.trainId FROM route r INNER JOIN route_station rs ON r.routeId=rs.routeId WHERE rs.stationID=:destStation AND rs.departuretime>=cast(:time AS time)) t1 ON t.trainId=t1.trainId
                INNER JOIN station s1 ON t.src_station=s1.stationID
                INNER JOIN station s2 ON t.dest_station=s2.stationID
                INNER JOIN availabledays a ON a.trainId=t.trainId WHERE a.tuesday="Yes" AND t.src_station <> :destStation
                ');
            case 'Wednesday':
                $this->db->query('SELECT t.*, s1.name AS src_name, s2.name AS dest_name FROM train t
                INNER JOIN (SELECT r.trainId FROM route r INNER JOIN route_station rs ON r.routeId=rs.routeId WHERE rs.stationID=:destStation AND rs.departuretime>=cast(:time AS time)) t1 ON t.trainId=t1.trainId
                INNER JOIN station s1 ON t.src_station=s1.stationID
                INNER JOIN station s2 ON t.dest_station=s2.stationID
                INNER JOIN availabledays a ON a.trainId=t.trainId WHERE a.wednesday="Yes" AND t.src_station <> :destStation
                ');
                break;
            case 'Thursday':
                $this->db->query('SELECT t.*, s1.name AS src_name, s2.name AS dest_name FROM train t
                INNER JOIN (SELECT r.trainId FROM route r INNER JOIN route_station rs ON r.routeId=rs.routeId WHERE rs.stationID=:destStation AND rs.departuretime>=cast(:time AS time)) t1 ON t.trainId=t1.trainId
                INNER JOIN station s1 ON t.src_station=s1.stationID
                INNER JOIN station s2 ON t.dest_station=s2.stationID
                INNER JOIN availabledays a ON a.trainId=t.trainId WHERE a.thursday="Yes" AND t.src_station <> :destStation
                ');
                break;
            case 'Friday':
                $this->db->query('SELECT t.*, s1.name AS src_name, s2.name AS dest_name FROM train t
                INNER JOIN (SELECT r.trainId FROM route r INNER JOIN route_station rs ON r.routeId=rs.routeId WHERE rs.stationID=:destStation AND rs.departuretime>=cast(:time AS time)) t1 ON t.trainId=t1.trainId
                INNER JOIN station s1 ON t.src_station=s1.stationID
                INNER JOIN station s2 ON t.dest_station=s2.stationID
                INNER JOIN availabledays a ON a.trainId=t.trainId WHERE a.friday="Yes" AND t.src_station <> :destStation
                ');
                break;
            case 'Saturday':
                $this->db->query('SELECT t.*, s1.name AS src_name, s2.name AS dest_name FROM train t
                INNER JOIN (SELECT r.trainId FROM route r INNER JOIN route_station rs ON r.routeId=rs.routeId WHERE rs.stationID=:destStation AND rs.departuretime>=cast(:time AS time)) t1 ON t.trainId=t1.trainId
                INNER JOIN station s1 ON t.src_station=s1.stationID
                INNER JOIN station s2 ON t.dest_station=s2.stationID
                INNER JOIN availabledays a ON a.trainId=t.trainId WHERE a.saturday="Yes" AND t.src_station <> :destStation
                ');
                break;
            case 'Sunday':
                $this->db->query('SELECT t.*, s1.name AS src_name, s2.name AS dest_name FROM train t
                INNER JOIN (SELECT r.trainId FROM route r INNER JOIN route_station rs ON r.routeId=rs.routeId WHERE rs.stationID=:destStation AND rs.departuretime>=cast(:time AS time)) t1 ON t.trainId=t1.trainId
                INNER JOIN station s1 ON t.src_station=s1.stationID
                INNER JOIN station s2 ON t.dest_station=s2.stationID
                INNER JOIN availabledays a ON a.trainId=t.trainId WHERE a.sunday="Yes" AND t.src_station <> :destStation
                ');
                break;
        }

        $this->db->bind(':destStation', $data['destStation']);
        $this->db->bind(':time', $data['time']);
        $trains=$this->db->resultSet();
        return $trains;
    }


    public function searchSrcDestOnly($data){
        $this->db->query('SELECT t.*, s1.name AS src_name, s2.name AS dest_name  FROM train t
            INNER JOIN (SELECT t1.trainId FROM
                                (SELECT r.trainId, rs.stopNo, rs.departuretime FROM route r INNER JOIN route_station rs ON r.routeId=rs.routeId WHERE rs.stationID=:srcStation)
                                 t1 INNER JOIN (SELECT r.trainId, rs.stopNo FROM route r INNER JOIN route_station rs ON r.routeId=rs.routeId WHERE rs.stationID=:destStation)
                                 t2 ON t1.trainId=t2.trainId WHERE t1.stopNo<t2.stopNo and t1.departuretime>=cast(:time AS time)) 
            t3 ON t.trainId=t3.trainId
            INNER JOIN station s1 ON s1.stationID=t.src_station
            INNER JOIN station s2 ON s2.stationID=t.dest_station
            ');

        $this->db->bind(':srcStation', $data['srcStation']);
        $this->db->bind(':destStation', $data['destStation']);
        $this->db->bind(':time', $data['time']);

        $trains=$this->db->resultSet();
        return $trains;

    }

    public function searchSrcDestDate($data){
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

        public function getTrain($trainId){
        $this->db->query('SELECT t1.*, ss.name AS src_name FROM
                (SELECT t.*, sd.name AS dest_name FROM train t INNER JOIN station sd ON t.dest_station=sd.stationID WHERE t.trainId=:trainId)
                t1 INNER JOIN station ss ON t1.src_station=ss.stationID');
        $this->db->bind(':trainId', $trainId);
        $row=$this->db->single();
        return $row;
    }

        public function getCompartments($id){

            $this->db->query('SELECT c.* FROM compartment c INNER JOIN train t ON c.trainId=t.trainId INNER JOIN compartment_type ct ON c.type=ct.typeNo WHERE t.trainId=:id ORDER BY c.compartmentNo');
            $this->db->bind(':id',$id);
            $results = $this->db->resultSet();
            return $results;
        }

        public function getCompartmentDetails($id,$compNo){

            $this->db->query('SELECT * FROM compartment WHERE trainId=:id AND compartmentNo=:compNo');
            $this->db->bind(':id',$id);
            $this->db->bind(':compNo',$compNo);
            $results = $this->db->single();
            return $results;
        }


        //Function to get the stop No of a station in a route????
        public function getStopNo($id,$stationid){

            $this->db->query('SELECT rs.stopNo, s.name FROM train t INNER JOIN route r ON r.trainId=t.trainId INNER JOIN route_station rs ON r.routeId=rs.routeId INNER JOIN station s ON s.stationID=rs.stationId WHERE t.trainId=:id AND rs.stationId=:stationid');
            $this->db->bind(':id',$id);
            $this->db->bind(':stationid',$stationid);
            $results = $this->db->single();
            return $results;
        }

        //Function to check if the selected seat(train, compartment, seat, date) is already selected
        // public function checkSeat($date, $trainId, $compNo, $seatNo){

        //  $this->db->query('SELECT COUNT(*) AS count FROM seat WHERE trainid=:trainId AND compartmentNo=:compNo AND seatNo=:seatNo AND journeyDate=:journeyDate');
        //  $this->db->bind(':trainId',$trainId);
        //  $this->db->bind(':compNo',$compNo);
        //  $this->db->bind(':seatNo',$seatNo);
        //  $this->db->bind(':journeyDate',$date);
        //  $results=array();
        //  $results=$this->db->resultSet();
        //  $count = (int) $results[0]->count;

        //  if($count > 0){
        //      return false;
        //  }else{
        //      return true;
        //  }
            
        // }

        public function addDisabled($data){

            $this->db->query('INSERT INTO disabled_seat ( disabledNo, trainId, officerId) VALUES (:disabledNo , :trainId, :officerId)');

            //bind values
            $this->db->bind(':disabledNo', $data['disabledNo']);
            $this->db->bind(':trainId', $data['trainId']);
            $this->db->bind(':officerId', $data['officerId']);          

            //Execute function
            if ($this->db->execute()) {
                $this->db->query('SELECT LAST_INSERT_ID() As resNo');
                $result = [];
                $result = $this->db->resultSet();
                return $result[0]->resNo;       
            } else {
                return false;
            }
        }

        public function checkSeat($date, $trainId, $compNo, $seatNo){

            $this->db->query('SELECT r.reservationNo, s.seatId, s.status, r.res_time, TIMESTAMPDIFF(SECOND,r.res_time, NOW()) AS dif FROM seat s INNER JOIN reservation r ON r.reservationNo=s.reservationNo WHERE s.trainid=:trainId AND s.compartmentNo=:compNo AND s.seatNo=:seatNo AND r.journeyDate=:journeyDate');
            $this->db->bind(':trainId',$trainId);
            $this->db->bind(':compNo',$compNo);
            $this->db->bind(':seatNo',$seatNo);
            $this->db->bind(':journeyDate',$date);
            
            $results=$this->db->single();
            return $results;
            
        }

        //Function to add a selected seat 
        public function addSeat($data){

            $this->db->query('INSERT INTO disabled_seat_mark (disabledNo, trainId, compartmentNo, seatNo, seatId) VALUES (:resNo, :trainId, :compNo, :label, :id)');

            //bind values
            $this->db->bind(':resNo', $data['resno']);
            $this->db->bind(':trainId', $data['trainId']);
            $this->db->bind(':compNo', $data['compartment']);
            $this->db->bind(':label', $data['label']);
            $this->db->bind(':id', $data['id']);
 
            //Execute function
            if ($this->db->execute()) {
                return true;                
            } else {
                return false;
            }
        }

        public function findResofficerById($oid){
            $this->db->query('SELECT m.*, u.email FROM reservation_officer m INNER JOIN users u ON m.userId=u.userId WHERE m.userId=:userId');
            $this->db->bind(":userId",$oid);
            $row=$this->db->single();
            return $row; 
        }

        public function getDisabledSeatDetails(){
            $this->db->query('SELECT ds.*, dsm.* 
                FROM disabled_seat ds 
                INNER JOIN disabled_seat_mark dsm 
                ON ds.disabledNo=dsm.disabledNo');

            $results=$this->db->resultSet();
            return $results;
        }

        public function delete($disabledId){
            $this->db->query('DELETE FROM disabled_seat_mark WHERE disabledId=:disabledId');

            $this->db->bind(':disabledId', $disabledId);

            if($this->db->execute()){
                return true;
            }else{
                return false;
            }
        }
    }
