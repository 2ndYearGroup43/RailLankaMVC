<?php 
	class PassengerSchedule {
		private $db;

		public function __construct() {
			$this->db = new Database;
		}

		public function getStations(){

			$this->db->query('SELECT stationID AS stationId, name AS stationName FROM station');
			$results = $this->db->resultSet();
			return $results;
		}

		public function getStationId($staionName){
			$this->db->query('SELECT stationID AS stationId FROM station WHERE name=:src');
			$this->db->bind(':src',$staionName);
			$results = $this->db->single();
			return $results;
		}

		public function searchSrc($data){

			$this->db->query('SELECT t.*, s1.name AS srcName, s2.name AS destName FROM train t 
				INNER JOIN (SELECT DISTINCT r.trainId FROM route r INNER JOIN route_station rs ON r.routeId=rs.routeId WHERE rs.stationId=:src) t1 ON t.trainId=t1.trainId 
				INNER JOIN station s1 ON s1.stationID=t.src_station 
				INNER JOIN station s2 ON s2.stationID=t.dest_station
					WHERE :src!=t.dest_station');
			$this->db->bind(':src',$data['src']);
			$results = $this->db->resultSet();
			return $results;
		}

		public function searchSrcDate($data){

			switch($data['date']){
				case 'Monday':
					$this->db->query("SELECT t.*, s1.name AS srcName, s2.name AS destName FROM train t 
					INNER JOIN (SELECT DISTINCT r.trainId FROM route r INNER JOIN route_station rs ON r.routeId=rs.routeId WHERE rs.stationId=:src) t1 ON t.trainId=t1.trainId 
					INNER JOIN station s1 ON s1.stationID=t.src_station 
					INNER JOIN station s2 ON s2.stationID=t.dest_station
					INNER JOIN availabledays a ON a.trainId=t.trainId
						WHERE :src!=t.dest_station AND a.Monday='Yes'");
					break;
				case 'Tuesday':
					$this->db->query("SELECT t.*, s1.name AS srcName, s2.name AS destName FROM train t 
					INNER JOIN (SELECT DISTINCT r.trainId FROM route r INNER JOIN route_station rs ON r.routeId=rs.routeId WHERE rs.stationId=:src) t1 ON t.trainId=t1.trainId 
					INNER JOIN station s1 ON s1.stationID=t.src_station 
					INNER JOIN station s2 ON s2.stationID=t.dest_station
					INNER JOIN availabledays a ON a.trainId=t.trainId
						WHERE :src!=t.dest_station AND a.Tuesday='Yes'");
					break;
				case 'Wednesday':
					$this->db->query("SELECT t.*, s1.name AS srcName, s2.name AS destName FROM train t 
					INNER JOIN (SELECT DISTINCT r.trainId FROM route r INNER JOIN route_station rs ON r.routeId=rs.routeId WHERE rs.stationId=:src) t1 ON t.trainId=t1.trainId 
					INNER JOIN station s1 ON s1.stationID=t.src_station 
					INNER JOIN station s2 ON s2.stationID=t.dest_station
					INNER JOIN availabledays a ON a.trainId=t.trainId
						WHERE :src!=t.dest_station AND a.Wednesday='Yes'");
					break;
				case 'Thursday':
					$this->db->query("SELECT t.*, s1.name AS srcName, s2.name AS destName FROM train t 
					INNER JOIN (SELECT DISTINCT r.trainId FROM route r INNER JOIN route_station rs ON r.routeId=rs.routeId WHERE rs.stationId=:src) t1 ON t.trainId=t1.trainId 
					INNER JOIN station s1 ON s1.stationID=t.src_station 
					INNER JOIN station s2 ON s2.stationID=t.dest_station
					INNER JOIN availabledays a ON a.trainId=t.trainId
						WHERE :src!=t.dest_station AND a.Thursday='Yes'");
					break;
				case 'Friday':
					$this->db->query("SELECT t.*, s1.name AS srcName, s2.name AS destName FROM train t 
					INNER JOIN (SELECT DISTINCT r.trainId FROM route r INNER JOIN route_station rs ON r.routeId=rs.routeId WHERE rs.stationId=:src) t1 ON t.trainId=t1.trainId 
					INNER JOIN station s1 ON s1.stationID=t.src_station 
					INNER JOIN station s2 ON s2.stationID=t.dest_station
					INNER JOIN availabledays a ON a.trainId=t.trainId
						WHERE :src!=t.dest_station AND a.Friday='Yes'");
					break;
				case 'Saturday':
					$this->db->query("SELECT t.*, s1.name AS srcName, s2.name AS destName FROM train t 
					INNER JOIN (SELECT DISTINCT r.trainId FROM route r INNER JOIN route_station rs ON r.routeId=rs.routeId WHERE rs.stationId=:src) t1 ON t.trainId=t1.trainId 
					INNER JOIN station s1 ON s1.stationID=t.src_station 
					INNER JOIN station s2 ON s2.stationID=t.dest_station
					INNER JOIN availabledays a ON a.trainId=t.trainId
						WHERE :src!=t.dest_station AND a.Saturday='Yes'");
					break;
				case 'Sunday':
					$this->db->query("SELECT t.*, s1.name AS srcName, s2.name AS destName FROM train t 
					INNER JOIN (SELECT DISTINCT r.trainId FROM route r INNER JOIN route_station rs ON r.routeId=rs.routeId WHERE rs.stationId=:src) t1 ON t.trainId=t1.trainId 
					INNER JOIN station s1 ON s1.stationID=t.src_station 
					INNER JOIN station s2 ON s2.stationID=t.dest_station
					INNER JOIN availabledays a ON a.trainId=t.trainId
						WHERE :src!=t.dest_station AND a.Sunday='Yes'");
					break;

			}

			$this->db->bind(':src',$data['src']);
			$results = $this->db->resultSet();
			return $results;
			
		}

		public function searchSrcTime($data){

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

		public function searchSrcDateTime($data){

			switch($data['date']){
				case 'Monday':
					$this->db->query("SELECT t.*, s1.name AS srcName, s2.name AS destName FROM train t 
					INNER JOIN (SELECT DISTINCT r.trainId FROM route r INNER JOIN route_station rs ON r.routeId=rs.routeId WHERE rs.stationId=:src AND rs.departuretime>=:deptTime) t1 ON t.trainId=t1.trainId 
					INNER JOIN station s1 ON s1.stationID=t.src_station 
					INNER JOIN station s2 ON s2.stationID=t.dest_station
					INNER JOIN availabledays a ON a.trainId=t.trainId
						WHERE :src!=t.dest_station AND a.monday='Yes'");
					break;
				case 'Tuesday':
					$this->db->query("SELECT t.*, s1.name AS srcName, s2.name AS destName FROM train t 
					INNER JOIN (SELECT DISTINCT r.trainId FROM route r INNER JOIN route_station rs ON r.routeId=rs.routeId WHERE rs.stationId=:src AND rs.departuretime>=:deptTime) t1 ON t.trainId=t1.trainId 
					INNER JOIN station s1 ON s1.stationID=t.src_station 
					INNER JOIN station s2 ON s2.stationID=t.dest_station
					INNER JOIN availabledays a ON a.trainId=t.trainId
						WHERE :src!=t.dest_station AND a.tuesday='Yes'");
					break;
				case 'Wednesday':
					$this->db->query("SELECT t.*, s1.name AS srcName, s2.name AS destName FROM train t 
					INNER JOIN (SELECT DISTINCT r.trainId FROM route r INNER JOIN route_station rs ON r.routeId=rs.routeId WHERE rs.stationId=:src AND rs.departuretime>=:deptTime) t1 ON t.trainId=t1.trainId 
					INNER JOIN station s1 ON s1.stationID=t.src_station 
					INNER JOIN station s2 ON s2.stationID=t.dest_station
					INNER JOIN availabledays a ON a.trainId=t.trainId
						WHERE :src!=t.dest_station AND a.wednesday='Yes'");
					break;
				case 'Thursday':
					$this->db->query("SELECT t.*, s1.name AS srcName, s2.name AS destName FROM train t 
					INNER JOIN (SELECT DISTINCT r.trainId FROM route r INNER JOIN route_station rs ON r.routeId=rs.routeId WHERE rs.stationId=:src AND rs.departuretime>=:deptTime) t1 ON t.trainId=t1.trainId 
					INNER JOIN station s1 ON s1.stationID=t.src_station 
					INNER JOIN station s2 ON s2.stationID=t.dest_station
					INNER JOIN availabledays a ON a.trainId=t.trainId
						WHERE :src!=t.dest_station AND a.thursday='Yes'");
					break;
				case 'Friday':
					$this->db->query("SELECT t.*, s1.name AS srcName, s2.name AS destName FROM train t 
					INNER JOIN (SELECT DISTINCT r.trainId FROM route r INNER JOIN route_station rs ON r.routeId=rs.routeId WHERE rs.stationId=:src AND rs.departuretime>=:deptTime) t1 ON t.trainId=t1.trainId 
					INNER JOIN station s1 ON s1.stationID=t.src_station 
					INNER JOIN station s2 ON s2.stationID=t.dest_station
					INNER JOIN availabledays a ON a.trainId=t.trainId
						WHERE :src!=t.dest_station AND a.friday='Yes'");
					break;
				case 'Saturday':
					$this->db->query("SELECT t.*, s1.name AS srcName, s2.name AS destName FROM train t 
					INNER JOIN (SELECT DISTINCT r.trainId FROM route r INNER JOIN route_station rs ON r.routeId=rs.routeId WHERE rs.stationId=:src AND rs.departuretime>=:deptTime) t1 ON t.trainId=t1.trainId 
					INNER JOIN station s1 ON s1.stationID=t.src_station 
					INNER JOIN station s2 ON s2.stationID=t.dest_station
					INNER JOIN availabledays a ON a.trainId=t.trainId
						WHERE :src!=t.dest_station AND a.saturday='Yes'");
					break;
				case 'Sunday':
					$this->db->query("SELECT t.*, s1.name AS srcName, s2.name AS destName FROM train t 
					INNER JOIN (SELECT DISTINCT r.trainId FROM route r INNER JOIN route_station rs ON r.routeId=rs.routeId WHERE rs.stationId=:src AND rs.departuretime>=:deptTime) t1 ON t.trainId=t1.trainId 
					INNER JOIN station s1 ON s1.stationID=t.src_station 
					INNER JOIN station s2 ON s2.stationID=t.dest_station
					INNER JOIN availabledays a ON a.trainId=t.trainId
						WHERE :src!=t.dest_station AND a.sunday='Yes'");
					break;

			}

			$this->db->bind(':src',$data['src']);
			$this->db->bind(':deptTime',$data['deptTime']);
			$results = $this->db->resultSet();
			return $results;
		}

		public function searchSrcDest($data){

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

		public function searchSrcDestDate($data){

			switch($data['date']){
				case 'Monday':
					$this->db->query("SELECT t.*, s1.name AS srcName, s2.name AS destName FROM train t 
					INNER JOIN (SELECT DISTINCT r1.trainId FROM (SELECT r.trainId, rs.stopNo FROM route r INNER JOIN route_station rs ON r.routeId=rs.routeId WHERE rs.stationId=:src ) r1 INNER JOIN (SELECT r.trainId, rs.stopNo FROM route r INNER JOIN route_station rs ON r.routeId=rs.routeId WHERE rs.stationId=:dest) r2 ON r1.trainId=r2.trainId WHERE r1.stopNo<r2.stopNo) t1 ON t.trainId=t1.trainId  
					INNER JOIN station s1 ON s1.stationID=t.src_station 
					INNER JOIN station s2 ON s2.stationID=t.dest_station
					INNER JOIN availabledays a ON a.trainId=t.trainId
						WHERE :src!=t.dest_station AND a.monday='Yes'");
					break;
				case 'Tuesday':
					$this->db->query("SELECT t.*, s1.name AS srcName, s2.name AS destName FROM train t 
					INNER JOIN (SELECT DISTINCT r1.trainId FROM (SELECT r.trainId, rs.stopNo FROM route r INNER JOIN route_station rs ON r.routeId=rs.routeId WHERE rs.stationId=:src ) r1 INNER JOIN (SELECT r.trainId, rs.stopNo FROM route r INNER JOIN route_station rs ON r.routeId=rs.routeId WHERE rs.stationId=:dest) r2 ON r1.trainId=r2.trainId WHERE r1.stopNo<r2.stopNo) t1 ON t.trainId=t1.trainId  
					INNER JOIN station s1 ON s1.stationID=t.src_station 
					INNER JOIN station s2 ON s2.stationID=t.dest_station
					INNER JOIN availabledays a ON a.trainId=t.trainId
						WHERE :src!=t.dest_station AND a.tuesday='Yes'");
					break;
				case 'Wednesday':
					$this->db->query("SELECT t.*, s1.name AS srcName, s2.name AS destName FROM train t 
					INNER JOIN (SELECT DISTINCT r1.trainId FROM (SELECT r.trainId, rs.stopNo FROM route r INNER JOIN route_station rs ON r.routeId=rs.routeId WHERE rs.stationId=:src ) r1 INNER JOIN (SELECT r.trainId, rs.stopNo FROM route r INNER JOIN route_station rs ON r.routeId=rs.routeId WHERE rs.stationId=:dest) r2 ON r1.trainId=r2.trainId WHERE r1.stopNo<r2.stopNo) t1 ON t.trainId=t1.trainId  
					INNER JOIN station s1 ON s1.stationID=t.src_station 
					INNER JOIN station s2 ON s2.stationID=t.dest_station
					INNER JOIN availabledays a ON a.trainId=t.trainId
						WHERE :src!=t.dest_station AND a.wednesday='Yes'");
					break;
				case 'Thursday':
					$this->db->query("SELECT t.*, s1.name AS srcName, s2.name AS destName FROM train t 
					INNER JOIN (SELECT DISTINCT r1.trainId FROM (SELECT r.trainId, rs.stopNo FROM route r INNER JOIN route_station rs ON r.routeId=rs.routeId WHERE rs.stationId=:src ) r1 INNER JOIN (SELECT r.trainId, rs.stopNo FROM route r INNER JOIN route_station rs ON r.routeId=rs.routeId WHERE rs.stationId=:dest) r2 ON r1.trainId=r2.trainId WHERE r1.stopNo<r2.stopNo) t1 ON t.trainId=t1.trainId  
					INNER JOIN station s1 ON s1.stationID=t.src_station 
					INNER JOIN station s2 ON s2.stationID=t.dest_station
					INNER JOIN availabledays a ON a.trainId=t.trainId
						WHERE :src!=t.dest_station AND a.thursday='Yes'");
					break;
				case 'Friday':
					$this->db->query("SELECT t.*, s1.name AS srcName, s2.name AS destName FROM train t 
					INNER JOIN (SELECT DISTINCT r1.trainId FROM (SELECT r.trainId, rs.stopNo FROM route r INNER JOIN route_station rs ON r.routeId=rs.routeId WHERE rs.stationId=:src ) r1 INNER JOIN (SELECT r.trainId, rs.stopNo FROM route r INNER JOIN route_station rs ON r.routeId=rs.routeId WHERE rs.stationId=:dest) r2 ON r1.trainId=r2.trainId WHERE r1.stopNo<r2.stopNo) t1 ON t.trainId=t1.trainId  
					INNER JOIN station s1 ON s1.stationID=t.src_station 
					INNER JOIN station s2 ON s2.stationID=t.dest_station
					INNER JOIN availabledays a ON a.trainId=t.trainId
						WHERE :src!=t.dest_station AND a.friday='Yes'");
					break;
				case 'Saturday':
					$this->db->query("SELECT t.*, s1.name AS srcName, s2.name AS destName FROM train t 
					INNER JOIN (SELECT DISTINCT r1.trainId FROM (SELECT r.trainId, rs.stopNo FROM route r INNER JOIN route_station rs ON r.routeId=rs.routeId WHERE rs.stationId=:src ) r1 INNER JOIN (SELECT r.trainId, rs.stopNo FROM route r INNER JOIN route_station rs ON r.routeId=rs.routeId WHERE rs.stationId=:dest) r2 ON r1.trainId=r2.trainId WHERE r1.stopNo<r2.stopNo) t1 ON t.trainId=t1.trainId  
					INNER JOIN station s1 ON s1.stationID=t.src_station 
					INNER JOIN station s2 ON s2.stationID=t.dest_station
					INNER JOIN availabledays a ON a.trainId=t.trainId
						WHERE :src!=t.dest_station AND a.saturday='Yes'");
					break;
				case 'Sunday':
					$this->db->query("SELECT t.*, s1.name AS srcName, s2.name AS destName FROM train t 
					INNER JOIN (SELECT DISTINCT r1.trainId FROM (SELECT r.trainId, rs.stopNo FROM route r INNER JOIN route_station rs ON r.routeId=rs.routeId WHERE rs.stationId=:src ) r1 INNER JOIN (SELECT r.trainId, rs.stopNo FROM route r INNER JOIN route_station rs ON r.routeId=rs.routeId WHERE rs.stationId=:dest) r2 ON r1.trainId=r2.trainId WHERE r1.stopNo<r2.stopNo) t1 ON t.trainId=t1.trainId  
					INNER JOIN station s1 ON s1.stationID=t.src_station 
					INNER JOIN station s2 ON s2.stationID=t.dest_station
					INNER JOIN availabledays a ON a.trainId=t.trainId
						WHERE :src!=t.dest_station AND a.sunday='Yes'");
					break;

			}

			$this->db->bind(':src',$data['src']);
			$this->db->bind(':dest',$data['dest']);
			$results = $this->db->resultSet();
			return $results;
			
		}

		public function searchSrcDestTime($data){

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


		public function searchAll($data){

			switch($data['date']){
				case 'Monday':
					$this->db->query("SELECT t.*, s1.name AS srcName, s2.name AS destName FROM train t 
					INNER JOIN (SELECT DISTINCT r1.trainId FROM (SELECT r.trainId, rs.stopNo FROM route r INNER JOIN route_station rs ON r.routeId=rs.routeId WHERE rs.stationId=:src AND rs.departuretime>=:deptTime) r1 INNER JOIN (SELECT r.trainId, rs.stopNo FROM route r INNER JOIN route_station rs ON r.routeId=rs.routeId WHERE rs.stationId=:dest) r2 ON r1.trainId=r2.trainId WHERE r1.stopNo<r2.stopNo) t1 ON t.trainId=t1.trainId  
					INNER JOIN station s1 ON s1.stationID=t.src_station 
					INNER JOIN station s2 ON s2.stationID=t.dest_station
					INNER JOIN availabledays a ON a.trainId=t.trainId
						WHERE :src!=t.dest_station AND a.monday='Yes'");
					break;
				case 'Tuesday':
					$this->db->query("SELECT t.*, s1.name AS srcName, s2.name AS destName FROM train t 
					INNER JOIN (SELECT DISTINCT r1.trainId FROM (SELECT r.trainId, rs.stopNo FROM route r INNER JOIN route_station rs ON r.routeId=rs.routeId WHERE rs.stationId=:src AND rs.departuretime>=:deptTime) r1 INNER JOIN (SELECT r.trainId, rs.stopNo FROM route r INNER JOIN route_station rs ON r.routeId=rs.routeId WHERE rs.stationId=:dest) r2 ON r1.trainId=r2.trainId WHERE r1.stopNo<r2.stopNo) t1 ON t.trainId=t1.trainId  
					INNER JOIN station s1 ON s1.stationID=t.src_station 
					INNER JOIN station s2 ON s2.stationID=t.dest_station
					INNER JOIN availabledays a ON a.trainId=t.trainId
						WHERE :src!=t.dest_station AND a.tuesday='Yes'");
					break;
				case 'Wednesday':
					$this->db->query("SELECT t.*, s1.name AS srcName, s2.name AS destName FROM train t 
					INNER JOIN (SELECT DISTINCT r1.trainId FROM (SELECT r.trainId, rs.stopNo FROM route r INNER JOIN route_station rs ON r.routeId=rs.routeId WHERE rs.stationId=:src AND rs.departuretime>=:deptTime) r1 INNER JOIN (SELECT r.trainId, rs.stopNo FROM route r INNER JOIN route_station rs ON r.routeId=rs.routeId WHERE rs.stationId=:dest) r2 ON r1.trainId=r2.trainId WHERE r1.stopNo<r2.stopNo) t1 ON t.trainId=t1.trainId  
					INNER JOIN station s1 ON s1.stationID=t.src_station 
					INNER JOIN station s2 ON s2.stationID=t.dest_station
					INNER JOIN availabledays a ON a.trainId=t.trainId
						WHERE :src!=t.dest_station AND a.wednesday='Yes'");
					break;
				case 'Thursday':
					$this->db->query("SELECT t.*, s1.name AS srcName, s2.name AS destName FROM train t 
					INNER JOIN (SELECT DISTINCT r1.trainId FROM (SELECT r.trainId, rs.stopNo FROM route r INNER JOIN route_station rs ON r.routeId=rs.routeId WHERE rs.stationId=:src AND rs.departuretime>=:deptTime) r1 INNER JOIN (SELECT r.trainId, rs.stopNo FROM route r INNER JOIN route_station rs ON r.routeId=rs.routeId WHERE rs.stationId=:dest) r2 ON r1.trainId=r2.trainId WHERE r1.stopNo<r2.stopNo) t1 ON t.trainId=t1.trainId  
					INNER JOIN station s1 ON s1.stationID=t.src_station 
					INNER JOIN station s2 ON s2.stationID=t.dest_station
					INNER JOIN availabledays a ON a.trainId=t.trainId
						WHERE :src!=t.dest_station AND a.thursday='Yes'");
					break;
				case 'Friday':
					$this->db->query("SELECT t.*, s1.name AS srcName, s2.name AS destName FROM train t 
					INNER JOIN (SELECT DISTINCT r1.trainId FROM (SELECT r.trainId, rs.stopNo FROM route r INNER JOIN route_station rs ON r.routeId=rs.routeId WHERE rs.stationId=:src AND rs.departuretime>=:deptTime) r1 INNER JOIN (SELECT r.trainId, rs.stopNo FROM route r INNER JOIN route_station rs ON r.routeId=rs.routeId WHERE rs.stationId=:dest) r2 ON r1.trainId=r2.trainId WHERE r1.stopNo<r2.stopNo) t1 ON t.trainId=t1.trainId  
					INNER JOIN station s1 ON s1.stationID=t.src_station 
					INNER JOIN station s2 ON s2.stationID=t.dest_station
					INNER JOIN availabledays a ON a.trainId=t.trainId
						WHERE :src!=t.dest_station AND a.friday='Yes'");
					break;
				case 'Saturday':
					$this->db->query("SELECT t.*, s1.name AS srcName, s2.name AS destName FROM train t 
					INNER JOIN (SELECT DISTINCT r1.trainId FROM (SELECT r.trainId, rs.stopNo FROM route r INNER JOIN route_station rs ON r.routeId=rs.routeId WHERE rs.stationId=:src AND rs.departuretime>=:deptTime) r1 INNER JOIN (SELECT r.trainId, rs.stopNo FROM route r INNER JOIN route_station rs ON r.routeId=rs.routeId WHERE rs.stationId=:dest) r2 ON r1.trainId=r2.trainId WHERE r1.stopNo<r2.stopNo) t1 ON t.trainId=t1.trainId  
					INNER JOIN station s1 ON s1.stationID=t.src_station 
					INNER JOIN station s2 ON s2.stationID=t.dest_station
					INNER JOIN availabledays a ON a.trainId=t.trainId
						WHERE :src!=t.dest_station AND a.saturday='Yes'");
					break;
				case 'Sunday':
					$this->db->query("SELECT t.*, s1.name AS srcName, s2.name AS destName FROM train t 
					INNER JOIN (SELECT DISTINCT r1.trainId FROM (SELECT r.trainId, rs.stopNo FROM route r INNER JOIN route_station rs ON r.routeId=rs.routeId WHERE rs.stationId=:src AND rs.departuretime>=:deptTime) r1 INNER JOIN (SELECT r.trainId, rs.stopNo FROM route r INNER JOIN route_station rs ON r.routeId=rs.routeId WHERE rs.stationId=:dest) r2 ON r1.trainId=r2.trainId WHERE r1.stopNo<r2.stopNo) t1 ON t.trainId=t1.trainId  
					INNER JOIN station s1 ON s1.stationID=t.src_station 
					INNER JOIN station s2 ON s2.stationID=t.dest_station
					INNER JOIN availabledays a ON a.trainId=t.trainId
						WHERE :src!=t.dest_station AND a.sunday='Yes'");
					break;

			}

			$this->db->bind(':src',$data['src']);
			$this->db->bind(':dest',$data['dest']);
			$this->db->bind(':deptTime',$data['deptTime']);
			$results = $this->db->resultSet();
			return $results;
		}


		public function getTrainDetails($id){

			$this->db->query('SELECT t.*, r.*, a.*, f.*, s1.name AS srcName, s2.name AS destName FROM train t INNER JOIN route r ON t.trainId=r.trainId INNER JOIN availabledays a ON t.trainId=a.trainId INNER JOIN fare f ON t.rateId=f.rateID INNER JOIN station s1 ON s1.stationID=t.src_station INNER JOIN station s2 ON s2.stationID=t.dest_station WHERE t.trainId=:id');
			$this->db->bind(':id',$id);
			$results = $this->db->resultSet();
			return $results;
		}

		public function getRouteDetails($id){

			$this->db->query('SELECT rs.*, s.name AS stationName FROM route_station rs INNER JOIN station s ON s.stationID=rs.stationId WHERE rs.routeId=(SELECT r.routeId FROM route r INNER JOIN train t ON t.trainId=r.routeId WHERE t.trainId=:id) ORDER BY rs.stopNo');
			$this->db->bind(':id',$id);
			$results = $this->db->resultSet();
			return $results;
		}


	}
