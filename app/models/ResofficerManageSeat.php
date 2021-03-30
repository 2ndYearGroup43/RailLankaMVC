<?php 
	class ResofficerManageSeat {
		private $db;

		public function __construct() {
			$this->db = new Database;
		}

        public function getStations(){ // get station id and names

            $this->db->query('SELECT stationID AS stationId, name AS stationName FROM station');
            $results = $this->db->resultSet();
            return $results;
        }

        public function getStationId($staionName){ // find station by name
            $this->db->query('SELECT stationID AS stationId FROM station WHERE name=:src');
            $this->db->bind(':src',$staionName);
            $results = $this->db->single();
            return $results;
        }


        public function searchSrc($data){ // search only with source

            $this->db->query('SELECT t.*, s1.name AS srcName, s2.name AS destName FROM train t 
                INNER JOIN (SELECT DISTINCT r.trainId FROM route r INNER JOIN route_station rs ON r.routeId=rs.routeId WHERE rs.stationId=:src) t1 ON t.trainId=t1.trainId 
                INNER JOIN station s1 ON s1.stationID=t.src_station 
                INNER JOIN station s2 ON s2.stationID=t.dest_station
                    WHERE :src!=t.dest_station AND t.reservable_status!=0');
            $this->db->bind(':src',$data['src']);
            $results = $this->db->resultSet();
            return $results;
        }

        public function searchSrcDate($data){ // search only with source and date

            switch($data['date']){
                case 'Monday':
                    $this->db->query("SELECT t.*, s1.name AS srcName, s2.name AS destName FROM train t 
                    INNER JOIN (SELECT DISTINCT r.trainId FROM route r INNER JOIN route_station rs ON r.routeId=rs.routeId WHERE rs.stationId=:src) t1 ON t.trainId=t1.trainId 
                    INNER JOIN station s1 ON s1.stationID=t.src_station 
                    INNER JOIN station s2 ON s2.stationID=t.dest_station
                    INNER JOIN availabledays a ON a.trainId=t.trainId
                        WHERE :src!=t.dest_station AND a.Monday='Yes' AND t.reservable_status!=0");
                    break;
                case 'Tuesday':
                    $this->db->query("SELECT t.*, s1.name AS srcName, s2.name AS destName FROM train t 
                    INNER JOIN (SELECT DISTINCT r.trainId FROM route r INNER JOIN route_station rs ON r.routeId=rs.routeId WHERE rs.stationId=:src) t1 ON t.trainId=t1.trainId 
                    INNER JOIN station s1 ON s1.stationID=t.src_station 
                    INNER JOIN station s2 ON s2.stationID=t.dest_station
                    INNER JOIN availabledays a ON a.trainId=t.trainId
                        WHERE :src!=t.dest_station AND a.Tuesday='Yes' AND t.reservable_status!=0");
                    break;
                case 'Wednesday':
                    $this->db->query("SELECT t.*, s1.name AS srcName, s2.name AS destName FROM train t 
                    INNER JOIN (SELECT DISTINCT r.trainId FROM route r INNER JOIN route_station rs ON r.routeId=rs.routeId WHERE rs.stationId=:src) t1 ON t.trainId=t1.trainId 
                    INNER JOIN station s1 ON s1.stationID=t.src_station 
                    INNER JOIN station s2 ON s2.stationID=t.dest_station
                    INNER JOIN availabledays a ON a.trainId=t.trainId
                        WHERE :src!=t.dest_station AND a.Wednesday='Yes' AND t.reservable_status!=0");
                    break;
                case 'Thursday':
                    $this->db->query("SELECT t.*, s1.name AS srcName, s2.name AS destName FROM train t 
                    INNER JOIN (SELECT DISTINCT r.trainId FROM route r INNER JOIN route_station rs ON r.routeId=rs.routeId WHERE rs.stationId=:src) t1 ON t.trainId=t1.trainId 
                    INNER JOIN station s1 ON s1.stationID=t.src_station 
                    INNER JOIN station s2 ON s2.stationID=t.dest_station
                    INNER JOIN availabledays a ON a.trainId=t.trainId
                        WHERE :src!=t.dest_station AND a.Thursday='Yes' AND t.reservable_status!=0");
                    break;
                case 'Friday':
                    $this->db->query("SELECT t.*, s1.name AS srcName, s2.name AS destName FROM train t 
                    INNER JOIN (SELECT DISTINCT r.trainId FROM route r INNER JOIN route_station rs ON r.routeId=rs.routeId WHERE rs.stationId=:src) t1 ON t.trainId=t1.trainId 
                    INNER JOIN station s1 ON s1.stationID=t.src_station 
                    INNER JOIN station s2 ON s2.stationID=t.dest_station
                    INNER JOIN availabledays a ON a.trainId=t.trainId
                        WHERE :src!=t.dest_station AND a.Friday='Yes' AND t.reservable_status!=0");
                    break;
                case 'Saturday':
                    $this->db->query("SELECT t.*, s1.name AS srcName, s2.name AS destName FROM train t 
                    INNER JOIN (SELECT DISTINCT r.trainId FROM route r INNER JOIN route_station rs ON r.routeId=rs.routeId WHERE rs.stationId=:src) t1 ON t.trainId=t1.trainId 
                    INNER JOIN station s1 ON s1.stationID=t.src_station 
                    INNER JOIN station s2 ON s2.stationID=t.dest_station
                    INNER JOIN availabledays a ON a.trainId=t.trainId
                        WHERE :src!=t.dest_station AND a.Saturday='Yes' AND t.reservable_status!=0");
                    break;
                case 'Sunday':
                    $this->db->query("SELECT t.*, s1.name AS srcName, s2.name AS destName FROM train t 
                    INNER JOIN (SELECT DISTINCT r.trainId FROM route r INNER JOIN route_station rs ON r.routeId=rs.routeId WHERE rs.stationId=:src) t1 ON t.trainId=t1.trainId 
                    INNER JOIN station s1 ON s1.stationID=t.src_station 
                    INNER JOIN station s2 ON s2.stationID=t.dest_station
                    INNER JOIN availabledays a ON a.trainId=t.trainId
                        WHERE :src!=t.dest_station AND a.Sunday='Yes' AND t.reservable_status!=0");
                    break;

            }

            $this->db->bind(':src',$data['src']);
            $results = $this->db->resultSet();
            return $results;
            
        }


        public function searchSrcTime($data){ //search only with source and time

            $this->db->query('SELECT t.*, s1.name AS srcName, s2.name AS destName FROM train t 
                INNER JOIN (SELECT DISTINCT r.trainId FROM route r INNER JOIN route_station rs ON r.routeId=rs.routeId WHERE rs.stationId=:src AND rs.departuretime>=:deptTime) t1 ON t.trainId=t1.trainId 
                INNER JOIN station s1 ON s1.stationID=t.src_station 
                INNER JOIN station s2 ON s2.stationID=t.dest_station
                    WHERE :src!=t.dest_station');
            $this->db->bind(':src',$data['src']);
            $this->db->bind(':deptTime',$data['deptTime']);
            $results = $this->db->resultSet();
            return $results;
            
        }


        public function searchSrcDateTime($data){ //search only with source, date and time

            switch($data['date']){
                case 'Monday':
                    $this->db->query("SELECT t.*, s1.name AS srcName, s2.name AS destName FROM train t 
                    INNER JOIN (SELECT DISTINCT r.trainId FROM route r INNER JOIN route_station rs ON r.routeId=rs.routeId WHERE rs.stationId=:src AND rs.departuretime>=:deptTime) t1 ON t.trainId=t1.trainId 
                    INNER JOIN station s1 ON s1.stationID=t.src_station 
                    INNER JOIN station s2 ON s2.stationID=t.dest_station
                    INNER JOIN availabledays a ON a.trainId=t.trainId
                        WHERE :src!=t.dest_station AND a.monday='Yes' AND t.reservable_status!=0");
                    break;
                case 'Tuesday':
                    $this->db->query("SELECT t.*, s1.name AS srcName, s2.name AS destName FROM train t 
                    INNER JOIN (SELECT DISTINCT r.trainId FROM route r INNER JOIN route_station rs ON r.routeId=rs.routeId WHERE rs.stationId=:src AND rs.departuretime>=:deptTime) t1 ON t.trainId=t1.trainId 
                    INNER JOIN station s1 ON s1.stationID=t.src_station 
                    INNER JOIN station s2 ON s2.stationID=t.dest_station
                    INNER JOIN availabledays a ON a.trainId=t.trainId
                        WHERE :src!=t.dest_station AND a.tuesday='Yes' AND t.reservable_status!=0");
                    break;
                case 'Wednesday':
                    $this->db->query("SELECT t.*, s1.name AS srcName, s2.name AS destName FROM train t 
                    INNER JOIN (SELECT DISTINCT r.trainId FROM route r INNER JOIN route_station rs ON r.routeId=rs.routeId WHERE rs.stationId=:src AND rs.departuretime>=:deptTime) t1 ON t.trainId=t1.trainId 
                    INNER JOIN station s1 ON s1.stationID=t.src_station 
                    INNER JOIN station s2 ON s2.stationID=t.dest_station
                    INNER JOIN availabledays a ON a.trainId=t.trainId
                        WHERE :src!=t.dest_station AND a.wednesday='Yes' AND t.reservable_status!=0");
                    break;
                case 'Thursday':
                    $this->db->query("SELECT t.*, s1.name AS srcName, s2.name AS destName FROM train t 
                    INNER JOIN (SELECT DISTINCT r.trainId FROM route r INNER JOIN route_station rs ON r.routeId=rs.routeId WHERE rs.stationId=:src AND rs.departuretime>=:deptTime) t1 ON t.trainId=t1.trainId 
                    INNER JOIN station s1 ON s1.stationID=t.src_station 
                    INNER JOIN station s2 ON s2.stationID=t.dest_station
                    INNER JOIN availabledays a ON a.trainId=t.trainId
                        WHERE :src!=t.dest_station AND a.thursday='Yes' AND t.reservable_status!=0");
                    break;
                case 'Friday':
                    $this->db->query("SELECT t.*, s1.name AS srcName, s2.name AS destName FROM train t 
                    INNER JOIN (SELECT DISTINCT r.trainId FROM route r INNER JOIN route_station rs ON r.routeId=rs.routeId WHERE rs.stationId=:src AND rs.departuretime>=:deptTime) t1 ON t.trainId=t1.trainId 
                    INNER JOIN station s1 ON s1.stationID=t.src_station 
                    INNER JOIN station s2 ON s2.stationID=t.dest_station
                    INNER JOIN availabledays a ON a.trainId=t.trainId
                        WHERE :src!=t.dest_station AND a.friday='Yes' AND t.reservable_status!=0");
                    break;
                case 'Saturday':
                    $this->db->query("SELECT t.*, s1.name AS srcName, s2.name AS destName FROM train t 
                    INNER JOIN (SELECT DISTINCT r.trainId FROM route r INNER JOIN route_station rs ON r.routeId=rs.routeId WHERE rs.stationId=:src AND rs.departuretime>=:deptTime) t1 ON t.trainId=t1.trainId 
                    INNER JOIN station s1 ON s1.stationID=t.src_station 
                    INNER JOIN station s2 ON s2.stationID=t.dest_station
                    INNER JOIN availabledays a ON a.trainId=t.trainId
                        WHERE :src!=t.dest_station AND a.saturday='Yes' AND t.reservable_status!=0");
                    break;
                case 'Sunday':
                    $this->db->query("SELECT t.*, s1.name AS srcName, s2.name AS destName FROM train t 
                    INNER JOIN (SELECT DISTINCT r.trainId FROM route r INNER JOIN route_station rs ON r.routeId=rs.routeId WHERE rs.stationId=:src AND rs.departuretime>=:deptTime) t1 ON t.trainId=t1.trainId 
                    INNER JOIN station s1 ON s1.stationID=t.src_station 
                    INNER JOIN station s2 ON s2.stationID=t.dest_station
                    INNER JOIN availabledays a ON a.trainId=t.trainId
                        WHERE :src!=t.dest_station AND a.sunday='Yes' AND t.reservable_status!=0");
                    break;

            }

            $this->db->bind(':src',$data['src']);
            $this->db->bind(':deptTime',$data['deptTime']);
            $results = $this->db->resultSet();
            return $results;
        }

 
        public function searchSrcDest($data){ // search only with source and destination

            $this->db->query('SELECT t.*, s1.name AS srcName, s2.name AS destName FROM train t 
                INNER JOIN (SELECT DISTINCT r1.trainId FROM (SELECT r.trainId, rs.stopNo FROM route r INNER JOIN route_station rs ON r.routeId=rs.routeId WHERE rs.stationId=:src ) r1 INNER JOIN (SELECT r.trainId, rs.stopNo FROM route r INNER JOIN route_station rs ON r.routeId=rs.routeId WHERE rs.stationId=:dest) r2 ON r1.trainId=r2.trainId WHERE r1.stopNo<r2.stopNo) t1 ON t.trainId=t1.trainId  
                INNER JOIN station s1 ON s1.stationID=t.src_station 
                INNER JOIN station s2 ON s2.stationID=t.dest_station
                    WHERE :src!=t.dest_station');
            $this->db->bind(':src',$data['src']);
            $this->db->bind(':dest',$data['dest']);
            $results = $this->db->resultSet();
            return $results;
            
        }

        public function searchSrcDestDate($data){ //search only with source, destination and date

            switch($data['date']){
                case 'Monday':
                    $this->db->query("SELECT t.*, s1.name AS srcName, s2.name AS destName FROM train t 
                    INNER JOIN (SELECT DISTINCT r1.trainId FROM (SELECT r.trainId, rs.stopNo FROM route r INNER JOIN route_station rs ON r.routeId=rs.routeId WHERE rs.stationId=:src ) r1 INNER JOIN (SELECT r.trainId, rs.stopNo FROM route r INNER JOIN route_station rs ON r.routeId=rs.routeId WHERE rs.stationId=:dest) r2 ON r1.trainId=r2.trainId WHERE r1.stopNo<r2.stopNo) t1 ON t.trainId=t1.trainId  
                    INNER JOIN station s1 ON s1.stationID=t.src_station 
                    INNER JOIN station s2 ON s2.stationID=t.dest_station
                    INNER JOIN availabledays a ON a.trainId=t.trainId
                        WHERE :src!=t.dest_station AND a.monday='Yes' AND t.reservable_status!=0");
                    break;
                case 'Tuesday':
                    $this->db->query("SELECT t.*, s1.name AS srcName, s2.name AS destName FROM train t 
                    INNER JOIN (SELECT DISTINCT r1.trainId FROM (SELECT r.trainId, rs.stopNo FROM route r INNER JOIN route_station rs ON r.routeId=rs.routeId WHERE rs.stationId=:src ) r1 INNER JOIN (SELECT r.trainId, rs.stopNo FROM route r INNER JOIN route_station rs ON r.routeId=rs.routeId WHERE rs.stationId=:dest) r2 ON r1.trainId=r2.trainId WHERE r1.stopNo<r2.stopNo) t1 ON t.trainId=t1.trainId  
                    INNER JOIN station s1 ON s1.stationID=t.src_station 
                    INNER JOIN station s2 ON s2.stationID=t.dest_station
                    INNER JOIN availabledays a ON a.trainId=t.trainId
                        WHERE :src!=t.dest_station AND a.tuesday='Yes' AND t.reservable_status!=0");
                    break;
                case 'Wednesday':
                    $this->db->query("SELECT t.*, s1.name AS srcName, s2.name AS destName FROM train t 
                    INNER JOIN (SELECT DISTINCT r1.trainId FROM (SELECT r.trainId, rs.stopNo FROM route r INNER JOIN route_station rs ON r.routeId=rs.routeId WHERE rs.stationId=:src ) r1 INNER JOIN (SELECT r.trainId, rs.stopNo FROM route r INNER JOIN route_station rs ON r.routeId=rs.routeId WHERE rs.stationId=:dest) r2 ON r1.trainId=r2.trainId WHERE r1.stopNo<r2.stopNo) t1 ON t.trainId=t1.trainId  
                    INNER JOIN station s1 ON s1.stationID=t.src_station 
                    INNER JOIN station s2 ON s2.stationID=t.dest_station
                    INNER JOIN availabledays a ON a.trainId=t.trainId
                        WHERE :src!=t.dest_station AND a.wednesday='Yes' AND t.reservable_status!=0");
                    break;
                case 'Thursday':
                    $this->db->query("SELECT t.*, s1.name AS srcName, s2.name AS destName FROM train t 
                    INNER JOIN (SELECT DISTINCT r1.trainId FROM (SELECT r.trainId, rs.stopNo FROM route r INNER JOIN route_station rs ON r.routeId=rs.routeId WHERE rs.stationId=:src ) r1 INNER JOIN (SELECT r.trainId, rs.stopNo FROM route r INNER JOIN route_station rs ON r.routeId=rs.routeId WHERE rs.stationId=:dest) r2 ON r1.trainId=r2.trainId WHERE r1.stopNo<r2.stopNo) t1 ON t.trainId=t1.trainId  
                    INNER JOIN station s1 ON s1.stationID=t.src_station 
                    INNER JOIN station s2 ON s2.stationID=t.dest_station
                    INNER JOIN availabledays a ON a.trainId=t.trainId
                        WHERE :src!=t.dest_station AND a.thursday='Yes' AND t.reservable_status!=0");
                    break;
                case 'Friday':
                    $this->db->query("SELECT t.*, s1.name AS srcName, s2.name AS destName FROM train t 
                    INNER JOIN (SELECT DISTINCT r1.trainId FROM (SELECT r.trainId, rs.stopNo FROM route r INNER JOIN route_station rs ON r.routeId=rs.routeId WHERE rs.stationId=:src ) r1 INNER JOIN (SELECT r.trainId, rs.stopNo FROM route r INNER JOIN route_station rs ON r.routeId=rs.routeId WHERE rs.stationId=:dest) r2 ON r1.trainId=r2.trainId WHERE r1.stopNo<r2.stopNo) t1 ON t.trainId=t1.trainId  
                    INNER JOIN station s1 ON s1.stationID=t.src_station 
                    INNER JOIN station s2 ON s2.stationID=t.dest_station
                    INNER JOIN availabledays a ON a.trainId=t.trainId
                        WHERE :src!=t.dest_station AND a.friday='Yes' AND t.reservable_status!=0");
                    break;
                case 'Saturday':
                    $this->db->query("SELECT t.*, s1.name AS srcName, s2.name AS destName FROM train t 
                    INNER JOIN (SELECT DISTINCT r1.trainId FROM (SELECT r.trainId, rs.stopNo FROM route r INNER JOIN route_station rs ON r.routeId=rs.routeId WHERE rs.stationId=:src ) r1 INNER JOIN (SELECT r.trainId, rs.stopNo FROM route r INNER JOIN route_station rs ON r.routeId=rs.routeId WHERE rs.stationId=:dest) r2 ON r1.trainId=r2.trainId WHERE r1.stopNo<r2.stopNo) t1 ON t.trainId=t1.trainId  
                    INNER JOIN station s1 ON s1.stationID=t.src_station 
                    INNER JOIN station s2 ON s2.stationID=t.dest_station
                    INNER JOIN availabledays a ON a.trainId=t.trainId
                        WHERE :src!=t.dest_station AND a.saturday='Yes' AND t.reservable_status!=0");
                    break;
                case 'Sunday':
                    $this->db->query("SELECT t.*, s1.name AS srcName, s2.name AS destName FROM train t 
                    INNER JOIN (SELECT DISTINCT r1.trainId FROM (SELECT r.trainId, rs.stopNo FROM route r INNER JOIN route_station rs ON r.routeId=rs.routeId WHERE rs.stationId=:src ) r1 INNER JOIN (SELECT r.trainId, rs.stopNo FROM route r INNER JOIN route_station rs ON r.routeId=rs.routeId WHERE rs.stationId=:dest) r2 ON r1.trainId=r2.trainId WHERE r1.stopNo<r2.stopNo) t1 ON t.trainId=t1.trainId  
                    INNER JOIN station s1 ON s1.stationID=t.src_station 
                    INNER JOIN station s2 ON s2.stationID=t.dest_station
                    INNER JOIN availabledays a ON a.trainId=t.trainId
                        WHERE :src!=t.dest_station AND a.sunday='Yes' AND t.reservable_status!=0");
                    break;

            }

            $this->db->bind(':src',$data['src']);
            $this->db->bind(':dest',$data['dest']);
            $results = $this->db->resultSet();
            return $results;
            
        }

    
        public function searchSrcDestTime($data){ //search only with source, destination, time

            $this->db->query('SELECT t.*, s1.name AS srcName, s2.name AS destName FROM train t 
                INNER JOIN (SELECT DISTINCT r1.trainId FROM (SELECT r.trainId, rs.stopNo FROM route r INNER JOIN route_station rs ON r.routeId=rs.routeId WHERE rs.stationId=:src AND rs.departuretime>=:deptTime) r1 INNER JOIN (SELECT r.trainId, rs.stopNo FROM route r INNER JOIN route_station rs ON r.routeId=rs.routeId WHERE rs.stationId=:dest) r2 ON r1.trainId=r2.trainId WHERE r1.stopNo<r2.stopNo) t1 ON t.trainId=t1.trainId  
                INNER JOIN station s1 ON s1.stationID=t.src_station 
                INNER JOIN station s2 ON s2.stationID=t.dest_station
                    WHERE :src!=t.dest_station');
            $this->db->bind(':src',$data['src']);
            $this->db->bind(':dest',$data['dest']);
            $this->db->bind(':deptTime',$data['deptTime']);
            $results = $this->db->resultSet();
            return $results;
        }


        public function searchAll($data){ //search with all four fields

            switch($data['date']){
                case 'Monday':
                    $this->db->query("SELECT t.*, s1.name AS srcName, s2.name AS destName FROM train t 
                    INNER JOIN (SELECT DISTINCT r1.trainId FROM (SELECT r.trainId, rs.stopNo FROM route r INNER JOIN route_station rs ON r.routeId=rs.routeId WHERE rs.stationId=:src AND rs.departuretime>=:deptTime) r1 INNER JOIN (SELECT r.trainId, rs.stopNo FROM route r INNER JOIN route_station rs ON r.routeId=rs.routeId WHERE rs.stationId=:dest) r2 ON r1.trainId=r2.trainId WHERE r1.stopNo<r2.stopNo) t1 ON t.trainId=t1.trainId  
                    INNER JOIN station s1 ON s1.stationID=t.src_station 
                    INNER JOIN station s2 ON s2.stationID=t.dest_station
                    INNER JOIN availabledays a ON a.trainId=t.trainId
                        WHERE :src!=t.dest_station AND a.monday='Yes' AND t.reservable_status!=0");
                    break;
                case 'Tuesday':
                    $this->db->query("SELECT t.*, s1.name AS srcName, s2.name AS destName FROM train t 
                    INNER JOIN (SELECT DISTINCT r1.trainId FROM (SELECT r.trainId, rs.stopNo FROM route r INNER JOIN route_station rs ON r.routeId=rs.routeId WHERE rs.stationId=:src AND rs.departuretime>=:deptTime) r1 INNER JOIN (SELECT r.trainId, rs.stopNo FROM route r INNER JOIN route_station rs ON r.routeId=rs.routeId WHERE rs.stationId=:dest) r2 ON r1.trainId=r2.trainId WHERE r1.stopNo<r2.stopNo) t1 ON t.trainId=t1.trainId  
                    INNER JOIN station s1 ON s1.stationID=t.src_station 
                    INNER JOIN station s2 ON s2.stationID=t.dest_station
                    INNER JOIN availabledays a ON a.trainId=t.trainId
                        WHERE :src!=t.dest_station AND a.tuesday='Yes' AND t.reservable_status!=0");
                    break;
                case 'Wednesday':
                    $this->db->query("SELECT t.*, s1.name AS srcName, s2.name AS destName FROM train t 
                    INNER JOIN (SELECT DISTINCT r1.trainId FROM (SELECT r.trainId, rs.stopNo FROM route r INNER JOIN route_station rs ON r.routeId=rs.routeId WHERE rs.stationId=:src AND rs.departuretime>=:deptTime) r1 INNER JOIN (SELECT r.trainId, rs.stopNo FROM route r INNER JOIN route_station rs ON r.routeId=rs.routeId WHERE rs.stationId=:dest) r2 ON r1.trainId=r2.trainId WHERE r1.stopNo<r2.stopNo) t1 ON t.trainId=t1.trainId  
                    INNER JOIN station s1 ON s1.stationID=t.src_station 
                    INNER JOIN station s2 ON s2.stationID=t.dest_station
                    INNER JOIN availabledays a ON a.trainId=t.trainId
                        WHERE :src!=t.dest_station AND a.wednesday='Yes' AND t.reservable_status!=0");
                    break;
                case 'Thursday':
                    $this->db->query("SELECT t.*, s1.name AS srcName, s2.name AS destName FROM train t 
                    INNER JOIN (SELECT DISTINCT r1.trainId FROM (SELECT r.trainId, rs.stopNo FROM route r INNER JOIN route_station rs ON r.routeId=rs.routeId WHERE rs.stationId=:src AND rs.departuretime>=:deptTime) r1 INNER JOIN (SELECT r.trainId, rs.stopNo FROM route r INNER JOIN route_station rs ON r.routeId=rs.routeId WHERE rs.stationId=:dest) r2 ON r1.trainId=r2.trainId WHERE r1.stopNo<r2.stopNo) t1 ON t.trainId=t1.trainId  
                    INNER JOIN station s1 ON s1.stationID=t.src_station 
                    INNER JOIN station s2 ON s2.stationID=t.dest_station
                    INNER JOIN availabledays a ON a.trainId=t.trainId
                        WHERE :src!=t.dest_station AND a.thursday='Yes' AND t.reservable_status!=0");
                    break;
                case 'Friday':
                    $this->db->query("SELECT t.*, s1.name AS srcName, s2.name AS destName FROM train t 
                    INNER JOIN (SELECT DISTINCT r1.trainId FROM (SELECT r.trainId, rs.stopNo FROM route r INNER JOIN route_station rs ON r.routeId=rs.routeId WHERE rs.stationId=:src AND rs.departuretime>=:deptTime) r1 INNER JOIN (SELECT r.trainId, rs.stopNo FROM route r INNER JOIN route_station rs ON r.routeId=rs.routeId WHERE rs.stationId=:dest) r2 ON r1.trainId=r2.trainId WHERE r1.stopNo<r2.stopNo) t1 ON t.trainId=t1.trainId  
                    INNER JOIN station s1 ON s1.stationID=t.src_station 
                    INNER JOIN station s2 ON s2.stationID=t.dest_station
                    INNER JOIN availabledays a ON a.trainId=t.trainId
                        WHERE :src!=t.dest_station AND a.friday='Yes' AND t.reservable_status!=0");
                    break;
                case 'Saturday':
                    $this->db->query("SELECT t.*, s1.name AS srcName, s2.name AS destName FROM train t 
                    INNER JOIN (SELECT DISTINCT r1.trainId FROM (SELECT r.trainId, rs.stopNo FROM route r INNER JOIN route_station rs ON r.routeId=rs.routeId WHERE rs.stationId=:src AND rs.departuretime>=:deptTime) r1 INNER JOIN (SELECT r.trainId, rs.stopNo FROM route r INNER JOIN route_station rs ON r.routeId=rs.routeId WHERE rs.stationId=:dest) r2 ON r1.trainId=r2.trainId WHERE r1.stopNo<r2.stopNo) t1 ON t.trainId=t1.trainId  
                    INNER JOIN station s1 ON s1.stationID=t.src_station 
                    INNER JOIN station s2 ON s2.stationID=t.dest_station
                    INNER JOIN availabledays a ON a.trainId=t.trainId
                        WHERE :src!=t.dest_station AND a.saturday='Yes' AND t.reservable_status!=0");
                    break;
                case 'Sunday':
                    $this->db->query("SELECT t.*, s1.name AS srcName, s2.name AS destName FROM train t 
                    INNER JOIN (SELECT DISTINCT r1.trainId FROM (SELECT r.trainId, rs.stopNo FROM route r INNER JOIN route_station rs ON r.routeId=rs.routeId WHERE rs.stationId=:src AND rs.departuretime>=:deptTime) r1 INNER JOIN (SELECT r.trainId, rs.stopNo FROM route r INNER JOIN route_station rs ON r.routeId=rs.routeId WHERE rs.stationId=:dest) r2 ON r1.trainId=r2.trainId WHERE r1.stopNo<r2.stopNo) t1 ON t.trainId=t1.trainId  
                    INNER JOIN station s1 ON s1.stationID=t.src_station 
                    INNER JOIN station s2 ON s2.stationID=t.dest_station
                    INNER JOIN availabledays a ON a.trainId=t.trainId
                        WHERE :src!=t.dest_station AND a.sunday='Yes' AND t.reservable_status!=0");
                    break;

            }

            $this->db->bind(':src',$data['src']);
            $this->db->bind(':dest',$data['dest']);
            $this->db->bind(':deptTime',$data['deptTime']);
            $results = $this->db->resultSet();
            return $results;
        }


        public function checkStation($station){ // check station already inserted

            $this->db->query('SELECT COUNT(*) AS count FROM station WHERE name=:station');
            $this->db->bind(':station', $station);
            $row=$this->db->single();
            if ($row->count>0){
                return true;
            }else{
                return false;
            }
        }

        public function getTrain($trainId){ // get train details
        $this->db->query('SELECT t1.*, ss.name AS src_name FROM
                (SELECT t.*, sd.name AS dest_name FROM train t INNER JOIN station sd ON t.dest_station=sd.stationID WHERE t.trainId=:trainId)
                t1 INNER JOIN station ss ON t1.src_station=ss.stationID');
        $this->db->bind(':trainId', $trainId);
        $row=$this->db->single();
        return $row;
    }

        public function getCompartments($id){ // get compartment details

            $this->db->query('SELECT c.* FROM compartment c INNER JOIN train t ON c.trainId=t.trainId INNER JOIN compartment_type ct ON c.type=ct.typeNo WHERE t.trainId=:id ORDER BY c.compartmentNo');
            $this->db->bind(':id',$id);
            $results = $this->db->resultSet();
            return $results;
        }

        public function getCompartmentDetails($id,$compNo){ // get compartment details

            $this->db->query('SELECT * FROM compartment WHERE trainId=:id AND compartmentNo=:compNo');
            $this->db->bind(':id',$id);
            $this->db->bind(':compNo',$compNo);
            $results = $this->db->single();
            return $results;
        }


        
        public function getStopNo($id,$stationid){ //Function to get the stop No of a station in a route

            $this->db->query('SELECT rs.stopNo, s.name FROM train t INNER JOIN route r ON r.trainId=t.trainId INNER JOIN route_station rs ON r.routeId=rs.routeId INNER JOIN station s ON s.stationID=rs.stationId WHERE t.trainId=:id AND rs.stationId=:stationid');
            $this->db->bind(':id',$id);
            $this->db->bind(':stationid',$stationid);
            $results = $this->db->single();
            return $results;
        }

        public function addDisabled($data){ // add seat to desabled_seat table

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

        public function checkSeat($date, $trainId, $compNo, $seatNo){ // check seats

            $this->db->query('SELECT r.reservationNo, s.seatId, s.status, r.res_time, TIMESTAMPDIFF(SECOND,r.res_time, NOW()) AS dif FROM seat s INNER JOIN reservation r ON r.reservationNo=s.reservationNo WHERE s.trainid=:trainId AND s.compartmentNo=:compNo AND s.seatNo=:seatNo AND r.journeyDate=:journeyDate');
            $this->db->bind(':trainId',$trainId);
            $this->db->bind(':compNo',$compNo);
            $this->db->bind(':seatNo',$seatNo);
            $this->db->bind(':journeyDate',$date);
            
            $results=$this->db->single();
            return $results;
            
        }

        
        public function addSeat($data){ //Function to add a selected seat 

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

        public function findResofficerById($oid){ // find resofficer details
            $this->db->query('SELECT m.*, u.email FROM reservation_officer m INNER JOIN users u ON m.userId=u.userId WHERE m.userId=:userId');
            $this->db->bind(":userId",$oid);
            $row=$this->db->single();
            return $row; 
        }

        public function getDisabledSeatDetails(){ // get disabled seat details
            $this->db->query('SELECT ds.*, dsm.* 
                FROM disabled_seat ds 
                INNER JOIN disabled_seat_mark dsm 
                ON ds.disabledNo=dsm.disabledNo');

            $results=$this->db->resultSet();
            return $results;
        }

        public function delete($disabledId){ // delete disabled seats
            $this->db->query('DELETE FROM disabled_seat_mark WHERE disabledId=:disabledId');

            $this->db->bind(':disabledId', $disabledId);

            if($this->db->execute()){
                return true;
            }else{
                return false;
            }
        }

        public function deletePendingReservations($currentDate){ // delete pending reservations 
            $this->db->query('DELETE FROM reservation WHERE status="P" AND journeyDate<:currentDate ');

            $this->db->bind(':currentDate', $currentDate);
            if($this->db->execute()){
                return true;
            }else{
                return false;
            }
        }
    }
