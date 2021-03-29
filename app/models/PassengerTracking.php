<?php 
	class PassengerTracking {
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

			$this->db->query("SELECT t.*, s1.name AS srcName, s2.name AS destName, 
			j.journeyId, j.journey_status FROM train t 
				INNER JOIN (SELECT DISTINCT r.trainId FROM route r INNER JOIN route_station rs ON r.routeId=rs.routeId WHERE rs.stationId=:src) t1 ON t.trainId=t1.trainId 
				INNER JOIN station s1 ON s1.stationID=t.src_station 
				INNER JOIN station s2 ON s2.stationID=t.dest_station
				INNER JOIN journey j ON j.trainId=t.trainId
					WHERE :src!=t.dest_station AND j.journey_status='Live'");
			$this->db->bind(':src',$data['src']);
			$results = $this->db->resultSet();
			return $results;
		}

		public function searchSrcDate($data){

			switch($data['date']){
				case 'Monday':
					$this->db->query("SELECT t.*, s1.name AS srcName, s2.name AS destName, j.journeyId, j.journey_status FROM train t 
					INNER JOIN (SELECT DISTINCT r.trainId FROM route r INNER JOIN route_station rs ON r.routeId=rs.routeId WHERE rs.stationId=:src) t1 ON t.trainId=t1.trainId 
					INNER JOIN station s1 ON s1.stationID=t.src_station 
					INNER JOIN station s2 ON s2.stationID=t.dest_station
					INNER JOIN availabledays a ON a.trainId=t.trainId
					INNER JOIN journey j ON j.trainId=t.trainId
						WHERE :src!=t.dest_station AND a.Monday='Yes' AND j.journey_status='Live'");
					break;
				case 'Tuesday':
					$this->db->query("SELECT t.*, s1.name AS srcName, s2.name AS destName, j.journeyId, j.journey_status FROM train t 
					INNER JOIN (SELECT DISTINCT r.trainId FROM route r INNER JOIN route_station rs ON r.routeId=rs.routeId WHERE rs.stationId=:src) t1 ON t.trainId=t1.trainId 
					INNER JOIN station s1 ON s1.stationID=t.src_station 
					INNER JOIN station s2 ON s2.stationID=t.dest_station
					INNER JOIN availabledays a ON a.trainId=t.trainId
					INNER JOIN journey j ON j.trainId=t.trainId
						WHERE :src!=t.dest_station AND a.Tuesday='Yes' AND j.journey_status='Live'");
					break;
				case 'Wednesday':
					$this->db->query("SELECT t.*, s1.name AS srcName, s2.name AS destName, j.journeyId, j.journey_status FROM train t 
					INNER JOIN (SELECT DISTINCT r.trainId FROM route r INNER JOIN route_station rs ON r.routeId=rs.routeId WHERE rs.stationId=:src) t1 ON t.trainId=t1.trainId 
					INNER JOIN station s1 ON s1.stationID=t.src_station 
					INNER JOIN station s2 ON s2.stationID=t.dest_station
					INNER JOIN availabledays a ON a.trainId=t.trainId
					INNER JOIN journey j ON j.trainId=t.trainId
						WHERE :src!=t.dest_station AND a.Wednesday='Yes' AND j.journey_status='Live'");
					break;
				case 'Thursday':
					$this->db->query("SELECT t.*, s1.name AS srcName, s2.name AS destName, j.journeyId, j.journey_status FROM train t 
					INNER JOIN (SELECT DISTINCT r.trainId FROM route r INNER JOIN route_station rs ON r.routeId=rs.routeId WHERE rs.stationId=:src) t1 ON t.trainId=t1.trainId 
					INNER JOIN station s1 ON s1.stationID=t.src_station 
					INNER JOIN station s2 ON s2.stationID=t.dest_station
					INNER JOIN availabledays a ON a.trainId=t.trainId
					INNER JOIN journey j ON j.trainId=t.trainId
						WHERE :src!=t.dest_station AND a.Thursday='Yes' AND j.journey_status='Live'");
					break;
				case 'Friday':
					$this->db->query("SELECT t.*, s1.name AS srcName, s2.name AS destName, j.journeyId, j.journey_status FROM train t 
					INNER JOIN (SELECT DISTINCT r.trainId FROM route r INNER JOIN route_station rs ON r.routeId=rs.routeId WHERE rs.stationId=:src) t1 ON t.trainId=t1.trainId 
					INNER JOIN station s1 ON s1.stationID=t.src_station 
					INNER JOIN station s2 ON s2.stationID=t.dest_station
					INNER JOIN availabledays a ON a.trainId=t.trainId
					INNER JOIN journey j ON j.trainId=t.trainId
						WHERE :src!=t.dest_station AND a.Friday='Yes' AND j.journey_status='Live'");
					break;
				case 'Saturday':
					$this->db->query("SELECT t.*, s1.name AS srcName, s2.name AS destName, j.journeyId, j.journey_status FROM train t 
					INNER JOIN (SELECT DISTINCT r.trainId FROM route r INNER JOIN route_station rs ON r.routeId=rs.routeId WHERE rs.stationId=:src) t1 ON t.trainId=t1.trainId 
					INNER JOIN station s1 ON s1.stationID=t.src_station 
					INNER JOIN station s2 ON s2.stationID=t.dest_station
					INNER JOIN availabledays a ON a.trainId=t.trainId
					INNER JOIN journey j ON j.trainId=t.trainId
						WHERE :src!=t.dest_station AND a.Saturday='Yes' AND j.journey_status='Live'");
					break;
				case 'Sunday':
					$this->db->query("SELECT t.*, s1.name AS srcName, s2.name AS destName, j.journeyId, j.journey_status FROM train t 
					INNER JOIN (SELECT DISTINCT r.trainId FROM route r INNER JOIN route_station rs ON r.routeId=rs.routeId WHERE rs.stationId=:src) t1 ON t.trainId=t1.trainId 
					INNER JOIN station s1 ON s1.stationID=t.src_station 
					INNER JOIN station s2 ON s2.stationID=t.dest_station
					INNER JOIN availabledays a ON a.trainId=t.trainId
					INNER JOIN journey j ON j.trainId=t.trainId
						WHERE :src!=t.dest_station AND a.Sunday='Yes' AND j.journey_status='Live'");
					break;

			}

			$this->db->bind(':src',$data['src']);
			$results = $this->db->resultSet();
			return $results;
			
		}

		public function searchSrcTime($data){

			$this->db->query("SELECT t.*, s1.name AS srcName, s2.name AS destName, j.journeyId, j.journey_status FROM train t 
				INNER JOIN (SELECT DISTINCT r.trainId FROM route r INNER JOIN route_station rs ON r.routeId=rs.routeId WHERE rs.stationId=:src AND rs.departuretime>=:deptTime) t1 ON t.trainId=t1.trainId 
				INNER JOIN station s1 ON s1.stationID=t.src_station 
				INNER JOIN station s2 ON s2.stationID=t.dest_station
				INNER JOIN journey j ON j.trainId=t.trainId
					WHERE :src!=t.dest_station AND j.journey_status='Live'");
			$this->db->bind(':src',$data['src']);
			$this->db->bind(':deptTime',$data['deptTime']);
			$results = $this->db->resultSet();
			return $results;
			
		}

		public function searchSrcDateTime($data){

			switch($data['date']){
				case 'Monday':
					$this->db->query("SELECT t.*, s1.name AS srcName, s2.name AS destName, j.journeyId, j.journey_status FROM train t 
					INNER JOIN (SELECT DISTINCT r.trainId FROM route r INNER JOIN route_station rs ON r.routeId=rs.routeId WHERE rs.stationId=:src AND rs.departuretime>=:deptTime) t1 ON t.trainId=t1.trainId 
					INNER JOIN station s1 ON s1.stationID=t.src_station 
					INNER JOIN station s2 ON s2.stationID=t.dest_station
					INNER JOIN availabledays a ON a.trainId=t.trainId
					INNER JOIN journey j ON j.trainId=t.trainId
						WHERE :src!=t.dest_station AND a.monday='Yes' AND j.journey_status='Live'");
					break;
				case 'Tuesday':
					$this->db->query("SELECT t.*, s1.name AS srcName, s2.name AS destName, j.journeyId, j.journey_status FROM train t 
					INNER JOIN (SELECT DISTINCT r.trainId FROM route r INNER JOIN route_station rs ON r.routeId=rs.routeId WHERE rs.stationId=:src AND rs.departuretime>=:deptTime) t1 ON t.trainId=t1.trainId 
					INNER JOIN station s1 ON s1.stationID=t.src_station 
					INNER JOIN station s2 ON s2.stationID=t.dest_station
					INNER JOIN availabledays a ON a.trainId=t.trainId
					INNER JOIN journey j ON j.trainId=t.trainId
						WHERE :src!=t.dest_station AND a.tuesday='Yes' AND j.journey_status='Live'");
					break;
				case 'Wednesday':
					$this->db->query("SELECT t.*, s1.name AS srcName, s2.name AS destName, j.journeyId, j.journey_status FROM train t 
					INNER JOIN (SELECT DISTINCT r.trainId FROM route r INNER JOIN route_station rs ON r.routeId=rs.routeId WHERE rs.stationId=:src AND rs.departuretime>=:deptTime) t1 ON t.trainId=t1.trainId 
					INNER JOIN station s1 ON s1.stationID=t.src_station 
					INNER JOIN station s2 ON s2.stationID=t.dest_station
					INNER JOIN availabledays a ON a.trainId=t.trainId
					INNER JOIN journey j ON j.trainId=t.trainId
						WHERE :src!=t.dest_station AND a.wednesday='Yes' AND j.journey_status='Live'");
					break;
				case 'Thursday':
					$this->db->query("SELECT t.*, s1.name AS srcName, s2.name AS destName, j.journeyId, j.journey_status FROM train t 
					INNER JOIN (SELECT DISTINCT r.trainId FROM route r INNER JOIN route_station rs ON r.routeId=rs.routeId WHERE rs.stationId=:src AND rs.departuretime>=:deptTime) t1 ON t.trainId=t1.trainId 
					INNER JOIN station s1 ON s1.stationID=t.src_station 
					INNER JOIN station s2 ON s2.stationID=t.dest_station
					INNER JOIN availabledays a ON a.trainId=t.trainId
					INNER JOIN journey j ON j.trainId=t.trainId
						WHERE :src!=t.dest_station AND a.thursday='Yes' AND j.journey_status='Live'");
					break;
				case 'Friday':
					$this->db->query("SELECT t.*, s1.name AS srcName, s2.name AS destName, j.journeyId, j.journey_status FROM train t 
					INNER JOIN (SELECT DISTINCT r.trainId FROM route r INNER JOIN route_station rs ON r.routeId=rs.routeId WHERE rs.stationId=:src AND rs.departuretime>=:deptTime) t1 ON t.trainId=t1.trainId 
					INNER JOIN station s1 ON s1.stationID=t.src_station 
					INNER JOIN station s2 ON s2.stationID=t.dest_station
					INNER JOIN availabledays a ON a.trainId=t.trainId
					INNER JOIN journey j ON j.trainId=t.trainId
						WHERE :src!=t.dest_station AND a.friday='Yes' AND j.journey_status='Live'");
					break;
				case 'Saturday':
					$this->db->query("SELECT t.*, s1.name AS srcName, s2.name AS destName, j.journeyId, j.journey_status FROM train t 
					INNER JOIN (SELECT DISTINCT r.trainId FROM route r INNER JOIN route_station rs ON r.routeId=rs.routeId WHERE rs.stationId=:src AND rs.departuretime>=:deptTime) t1 ON t.trainId=t1.trainId 
					INNER JOIN station s1 ON s1.stationID=t.src_station 
					INNER JOIN station s2 ON s2.stationID=t.dest_station
					INNER JOIN availabledays a ON a.trainId=t.trainId
					INNER JOIN journey j ON j.trainId=t.trainId
						WHERE :src!=t.dest_station AND a.saturday='Yes' AND j.journey_status='Live'");
					break;
				case 'Sunday':
					$this->db->query("SELECT t.*, s1.name AS srcName, s2.name AS destName, j.journeyId, j.journey_status FROM train t 
					INNER JOIN (SELECT DISTINCT r.trainId FROM route r INNER JOIN route_station rs ON r.routeId=rs.routeId WHERE rs.stationId=:src AND rs.departuretime>=:deptTime) t1 ON t.trainId=t1.trainId 
					INNER JOIN station s1 ON s1.stationID=t.src_station 
					INNER JOIN station s2 ON s2.stationID=t.dest_station
					INNER JOIN availabledays a ON a.trainId=t.trainId
					INNER JOIN journey j ON j.trainId=t.trainId
						WHERE :src!=t.dest_station AND a.sunday='Yes' AND j.journey_status='Live'");
					break;

			}

			$this->db->bind(':src',$data['src']);
			$this->db->bind(':deptTime',$data['deptTime']);
			$results = $this->db->resultSet();
			return $results;
		}

		public function searchSrcDest($data){

			$this->db->query("SELECT t.*, s1.name AS srcName, s2.name AS destName, j.journeyId, j.journey_status FROM train t 
				INNER JOIN (SELECT DISTINCT r1.trainId FROM (SELECT r.trainId, rs.stopNo FROM route r INNER JOIN route_station rs ON r.routeId=rs.routeId WHERE rs.stationId=:src ) r1 INNER JOIN (SELECT r.trainId, rs.stopNo FROM route r INNER JOIN route_station rs ON r.routeId=rs.routeId WHERE rs.stationId=:dest) r2 ON r1.trainId=r2.trainId WHERE r1.stopNo<r2.stopNo) t1 ON t.trainId=t1.trainId  
				INNER JOIN station s1 ON s1.stationID=t.src_station 
				INNER JOIN station s2 ON s2.stationID=t.dest_station
				INNER JOIN journey j ON j.trainId=t.trainId
					WHERE :src!=t.dest_station AND j.journey_status='Live'");
			$this->db->bind(':src',$data['src']);
			$this->db->bind(':dest',$data['dest']);
			$results = $this->db->resultSet();
			return $results;
			
		}

		public function searchSrcDestDate($data){

			switch($data['date']){
				case 'Monday':
					$this->db->query("SELECT t.*, s1.name AS srcName, s2.name AS destName, j.journeyId, j.journey_status FROM train t 
					INNER JOIN (SELECT DISTINCT r1.trainId FROM (SELECT r.trainId, rs.stopNo FROM route r INNER JOIN route_station rs ON r.routeId=rs.routeId WHERE rs.stationId=:src ) r1 INNER JOIN (SELECT r.trainId, rs.stopNo FROM route r INNER JOIN route_station rs ON r.routeId=rs.routeId WHERE rs.stationId=:dest) r2 ON r1.trainId=r2.trainId WHERE r1.stopNo<r2.stopNo) t1 ON t.trainId=t1.trainId  
					INNER JOIN station s1 ON s1.stationID=t.src_station 
					INNER JOIN station s2 ON s2.stationID=t.dest_station
					INNER JOIN availabledays a ON a.trainId=t.trainId
					INNER JOIN journey j ON j.trainId=t.trainId
						WHERE :src!=t.dest_station AND a.monday='Yes' AND j.journey_status='Live'");
					break;
				case 'Tuesday':
					$this->db->query("SELECT t.*, s1.name AS srcName, s2.name AS destName, j.journeyId, j.journey_status FROM train t 
					INNER JOIN (SELECT DISTINCT r1.trainId FROM (SELECT r.trainId, rs.stopNo FROM route r INNER JOIN route_station rs ON r.routeId=rs.routeId WHERE rs.stationId=:src ) r1 INNER JOIN (SELECT r.trainId, rs.stopNo FROM route r INNER JOIN route_station rs ON r.routeId=rs.routeId WHERE rs.stationId=:dest) r2 ON r1.trainId=r2.trainId WHERE r1.stopNo<r2.stopNo) t1 ON t.trainId=t1.trainId  
					INNER JOIN station s1 ON s1.stationID=t.src_station 
					INNER JOIN station s2 ON s2.stationID=t.dest_station
					INNER JOIN availabledays a ON a.trainId=t.trainId
					INNER JOIN journey j ON j.trainId=t.trainId
						WHERE :src!=t.dest_station AND a.tuesday='Yes' AND j.journey_status='Live'");
					break;
				case 'Wednesday':
					$this->db->query("SELECT t.*, s1.name AS srcName, s2.name AS destName, j.journeyId, j.journey_status FROM train t 
					INNER JOIN (SELECT DISTINCT r1.trainId FROM (SELECT r.trainId, rs.stopNo FROM route r INNER JOIN route_station rs ON r.routeId=rs.routeId WHERE rs.stationId=:src ) r1 INNER JOIN (SELECT r.trainId, rs.stopNo FROM route r INNER JOIN route_station rs ON r.routeId=rs.routeId WHERE rs.stationId=:dest) r2 ON r1.trainId=r2.trainId WHERE r1.stopNo<r2.stopNo) t1 ON t.trainId=t1.trainId  
					INNER JOIN station s1 ON s1.stationID=t.src_station 
					INNER JOIN station s2 ON s2.stationID=t.dest_station
					INNER JOIN availabledays a ON a.trainId=t.trainId
					INNER JOIN journey j ON j.trainId=t.trainId
						WHERE :src!=t.dest_station AND a.wednesday='Yes' AND j.journey_status='Live'");
					break;
				case 'Thursday':
					$this->db->query("SELECT t.*, s1.name AS srcName, s2.name AS destName, j.journeyId, j.journey_status FROM train t 
					INNER JOIN (SELECT DISTINCT r1.trainId FROM (SELECT r.trainId, rs.stopNo FROM route r INNER JOIN route_station rs ON r.routeId=rs.routeId WHERE rs.stationId=:src ) r1 INNER JOIN (SELECT r.trainId, rs.stopNo FROM route r INNER JOIN route_station rs ON r.routeId=rs.routeId WHERE rs.stationId=:dest) r2 ON r1.trainId=r2.trainId WHERE r1.stopNo<r2.stopNo) t1 ON t.trainId=t1.trainId  
					INNER JOIN station s1 ON s1.stationID=t.src_station 
					INNER JOIN station s2 ON s2.stationID=t.dest_station
					INNER JOIN availabledays a ON a.trainId=t.trainId
					INNER JOIN journey j ON j.trainId=t.trainId
						WHERE :src!=t.dest_station AND a.thursday='Yes' AND j.journey_status='Live'");
					break;
				case 'Friday':
					$this->db->query("SELECT t.*, s1.name AS srcName, s2.name AS destName, j.journeyId, j.journey_status FROM train t 
					INNER JOIN (SELECT DISTINCT r1.trainId FROM (SELECT r.trainId, rs.stopNo FROM route r INNER JOIN route_station rs ON r.routeId=rs.routeId WHERE rs.stationId=:src ) r1 INNER JOIN (SELECT r.trainId, rs.stopNo FROM route r INNER JOIN route_station rs ON r.routeId=rs.routeId WHERE rs.stationId=:dest) r2 ON r1.trainId=r2.trainId WHERE r1.stopNo<r2.stopNo) t1 ON t.trainId=t1.trainId  
					INNER JOIN station s1 ON s1.stationID=t.src_station 
					INNER JOIN station s2 ON s2.stationID=t.dest_station
					INNER JOIN availabledays a ON a.trainId=t.trainId
					INNER JOIN journey j ON j.trainId=t.trainId
						WHERE :src!=t.dest_station AND a.friday='Yes' AND j.journey_status='Live'");
					break;
				case 'Saturday':
					$this->db->query("SELECT t.*, s1.name AS srcName, s2.name AS destName, j.journeyId, j.journey_status FROM train t 
					INNER JOIN (SELECT DISTINCT r1.trainId FROM (SELECT r.trainId, rs.stopNo FROM route r INNER JOIN route_station rs ON r.routeId=rs.routeId WHERE rs.stationId=:src ) r1 INNER JOIN (SELECT r.trainId, rs.stopNo FROM route r INNER JOIN route_station rs ON r.routeId=rs.routeId WHERE rs.stationId=:dest) r2 ON r1.trainId=r2.trainId WHERE r1.stopNo<r2.stopNo) t1 ON t.trainId=t1.trainId  
					INNER JOIN station s1 ON s1.stationID=t.src_station 
					INNER JOIN station s2 ON s2.stationID=t.dest_station
					INNER JOIN availabledays a ON a.trainId=t.trainId
					INNER JOIN journey j ON j.trainId=t.trainId
						WHERE :src!=t.dest_station AND a.saturday='Yes' AND j.journey_status='Live'");
					break;
				case 'Sunday':
					$this->db->query("SELECT t.*, s1.name AS srcName, s2.name AS destName, j.journeyId, j.journey_status FROM train t 
					INNER JOIN (SELECT DISTINCT r1.trainId FROM (SELECT r.trainId, rs.stopNo FROM route r INNER JOIN route_station rs ON r.routeId=rs.routeId WHERE rs.stationId=:src ) r1 INNER JOIN (SELECT r.trainId, rs.stopNo FROM route r INNER JOIN route_station rs ON r.routeId=rs.routeId WHERE rs.stationId=:dest) r2 ON r1.trainId=r2.trainId WHERE r1.stopNo<r2.stopNo) t1 ON t.trainId=t1.trainId  
					INNER JOIN station s1 ON s1.stationID=t.src_station 
					INNER JOIN station s2 ON s2.stationID=t.dest_station
					INNER JOIN availabledays a ON a.trainId=t.trainId
					INNER JOIN journey j ON j.trainId=t.trainId
						WHERE :src!=t.dest_station AND a.sunday='Yes' AND j.journey_status='Live'");
					break;

			}

			$this->db->bind(':src',$data['src']);
			$this->db->bind(':dest',$data['dest']);
			$results = $this->db->resultSet();
			return $results;
			
		}

		public function searchSrcDestTime($data){

			$this->db->query("SELECT t.*, s1.name AS srcName, s2.name AS destName, j.journeyId, j.journey_status FROM train t 
				INNER JOIN (SELECT DISTINCT r1.trainId FROM (SELECT r.trainId, rs.stopNo FROM route r INNER JOIN route_station rs ON r.routeId=rs.routeId WHERE rs.stationId=:src AND rs.departuretime>=:deptTime) r1 INNER JOIN (SELECT r.trainId, rs.stopNo FROM route r INNER JOIN route_station rs ON r.routeId=rs.routeId WHERE rs.stationId=:dest) r2 ON r1.trainId=r2.trainId WHERE r1.stopNo<r2.stopNo) t1 ON t.trainId=t1.trainId  
				INNER JOIN station s1 ON s1.stationID=t.src_station 
				INNER JOIN station s2 ON s2.stationID=t.dest_station
				INNER JOIN journey j ON j.trainId=t.trainId
					WHERE :src!=t.dest_station AND j.journey_status='Live'");
			$this->db->bind(':src',$data['src']);
			$this->db->bind(':dest',$data['dest']);
			$this->db->bind(':deptTime',$data['deptTime']);
			$results = $this->db->resultSet();
			return $results;
		}


		public function searchAll($data){

			switch($data['date']){
				case 'Monday':
					$this->db->query("SELECT t.*, s1.name AS srcName, s2.name AS destName, j.journeyId, j.journey_status FROM train t 
					INNER JOIN (SELECT DISTINCT r1.trainId FROM (SELECT r.trainId, rs.stopNo FROM route r INNER JOIN route_station rs ON r.routeId=rs.routeId WHERE rs.stationId=:src AND rs.departuretime>=:deptTime) r1 INNER JOIN (SELECT r.trainId, rs.stopNo FROM route r INNER JOIN route_station rs ON r.routeId=rs.routeId WHERE rs.stationId=:dest) r2 ON r1.trainId=r2.trainId WHERE r1.stopNo<r2.stopNo) t1 ON t.trainId=t1.trainId  
					INNER JOIN station s1 ON s1.stationID=t.src_station 
					INNER JOIN station s2 ON s2.stationID=t.dest_station
					INNER JOIN availabledays a ON a.trainId=t.trainId
					INNER JOIN journey j ON j.trainId=t.trainId
						WHERE :src!=t.dest_station AND a.monday='Yes' AND j.journey_status='Live'");
					break;
				case 'Tuesday':
					$this->db->query("SELECT t.*, s1.name AS srcName, s2.name AS destName, j.journeyId, j.journey_status FROM train t 
					INNER JOIN (SELECT DISTINCT r1.trainId FROM (SELECT r.trainId, rs.stopNo FROM route r INNER JOIN route_station rs ON r.routeId=rs.routeId WHERE rs.stationId=:src AND rs.departuretime>=:deptTime) r1 INNER JOIN (SELECT r.trainId, rs.stopNo FROM route r INNER JOIN route_station rs ON r.routeId=rs.routeId WHERE rs.stationId=:dest) r2 ON r1.trainId=r2.trainId WHERE r1.stopNo<r2.stopNo) t1 ON t.trainId=t1.trainId  
					INNER JOIN station s1 ON s1.stationID=t.src_station 
					INNER JOIN station s2 ON s2.stationID=t.dest_station
					INNER JOIN availabledays a ON a.trainId=t.trainId
					INNER JOIN journey j ON j.trainId=t.trainId
						WHERE :src!=t.dest_station AND a.tuesday='Yes' AND j.journey_status='Live'");
					break;
				case 'Wednesday':
					$this->db->query("SELECT t.*, s1.name AS srcName, s2.name AS destName, j.journeyId, j.journey_status FROM train t 
					INNER JOIN (SELECT DISTINCT r1.trainId FROM (SELECT r.trainId, rs.stopNo FROM route r INNER JOIN route_station rs ON r.routeId=rs.routeId WHERE rs.stationId=:src AND rs.departuretime>=:deptTime) r1 INNER JOIN (SELECT r.trainId, rs.stopNo FROM route r INNER JOIN route_station rs ON r.routeId=rs.routeId WHERE rs.stationId=:dest) r2 ON r1.trainId=r2.trainId WHERE r1.stopNo<r2.stopNo) t1 ON t.trainId=t1.trainId  
					INNER JOIN station s1 ON s1.stationID=t.src_station 
					INNER JOIN station s2 ON s2.stationID=t.dest_station
					INNER JOIN availabledays a ON a.trainId=t.trainId
					INNER JOIN journey j ON j.trainId=t.trainId
						WHERE :src!=t.dest_station AND a.wednesday='Yes' AND j.journey_status='Live'");
					break;
				case 'Thursday':
					$this->db->query("SELECT t.*, s1.name AS srcName, s2.name AS destName FROM train t 
					INNER JOIN (SELECT DISTINCT r1.trainId FROM (SELECT r.trainId, rs.stopNo FROM route r INNER JOIN route_station rs ON r.routeId=rs.routeId WHERE rs.stationId=:src AND rs.departuretime>=:deptTime) r1 INNER JOIN (SELECT r.trainId, rs.stopNo FROM route r INNER JOIN route_station rs ON r.routeId=rs.routeId WHERE rs.stationId=:dest) r2 ON r1.trainId=r2.trainId WHERE r1.stopNo<r2.stopNo) t1 ON t.trainId=t1.trainId  
					INNER JOIN station s1 ON s1.stationID=t.src_station 
					INNER JOIN station s2 ON s2.stationID=t.dest_station
					INNER JOIN availabledays a ON a.trainId=t.trainId
					INNER JOIN journey j ON j.trainId=t.trainId
						WHERE :src!=t.dest_station AND a.thursday='Yes' AND j.journey_status='Live'");
					break;
				case 'Friday':
					$this->db->query("SELECT t.*, s1.name AS srcName, s2.name AS destName, j.journeyId, j.journey_status FROM train t 
					INNER JOIN (SELECT DISTINCT r1.trainId FROM (SELECT r.trainId, rs.stopNo FROM route r INNER JOIN route_station rs ON r.routeId=rs.routeId WHERE rs.stationId=:src AND rs.departuretime>=:deptTime) r1 INNER JOIN (SELECT r.trainId, rs.stopNo FROM route r INNER JOIN route_station rs ON r.routeId=rs.routeId WHERE rs.stationId=:dest) r2 ON r1.trainId=r2.trainId WHERE r1.stopNo<r2.stopNo) t1 ON t.trainId=t1.trainId  
					INNER JOIN station s1 ON s1.stationID=t.src_station 
					INNER JOIN station s2 ON s2.stationID=t.dest_station
					INNER JOIN availabledays a ON a.trainId=t.trainId
					INNER JOIN journey j ON j.trainId=t.trainId
						WHERE :src!=t.dest_station AND a.friday='Yes' AND j.journey_status='Live'");
					break;
				case 'Saturday':
					$this->db->query("SELECT t.*, s1.name AS srcName, s2.name AS destName, j.journeyId, j.journey_status FROM train t 
					INNER JOIN (SELECT DISTINCT r1.trainId FROM (SELECT r.trainId, rs.stopNo FROM route r INNER JOIN route_station rs ON r.routeId=rs.routeId WHERE rs.stationId=:src AND rs.departuretime>=:deptTime) r1 INNER JOIN (SELECT r.trainId, rs.stopNo FROM route r INNER JOIN route_station rs ON r.routeId=rs.routeId WHERE rs.stationId=:dest) r2 ON r1.trainId=r2.trainId WHERE r1.stopNo<r2.stopNo) t1 ON t.trainId=t1.trainId  
					INNER JOIN station s1 ON s1.stationID=t.src_station 
					INNER JOIN station s2 ON s2.stationID=t.dest_station
					INNER JOIN availabledays a ON a.trainId=t.trainId
					INNER JOIN journey j ON j.trainId=t.trainId
						WHERE :src!=t.dest_station AND a.saturday='Yes' AND j.journey_status='Live'");
					break;
				case 'Sunday':
					$this->db->query("SELECT t.*, s1.name AS srcName, s2.name AS destName, j.journeyId, j.journey_status FROM train t 
					INNER JOIN (SELECT DISTINCT r1.trainId FROM (SELECT r.trainId, rs.stopNo FROM route r INNER JOIN route_station rs ON r.routeId=rs.routeId WHERE rs.stationId=:src AND rs.departuretime>=:deptTime) r1 INNER JOIN (SELECT r.trainId, rs.stopNo FROM route r INNER JOIN route_station rs ON r.routeId=rs.routeId WHERE rs.stationId=:dest) r2 ON r1.trainId=r2.trainId WHERE r1.stopNo<r2.stopNo) t1 ON t.trainId=t1.trainId  
					INNER JOIN station s1 ON s1.stationID=t.src_station 
					INNER JOIN station s2 ON s2.stationID=t.dest_station
					INNER JOIN availabledays a ON a.trainId=t.trainId
					INNER JOIN journey j ON j.trainId=t.trainId
						WHERE :src!=t.dest_station AND a.sunday='Yes' AND j.journey_status='Live'");
					break;

			}

			$this->db->bind(':src',$data['src']);
			$this->db->bind(':dest',$data['dest']);
			$this->db->bind(':deptTime',$data['deptTime']);
			$results = $this->db->resultSet();
			return $results;
		}

		public function checkStation($station){

			$this->db->query('SELECT COUNT(*) AS count FROM station WHERE name=:station');
	        $this->db->bind(':station', $station);
	        $row=$this->db->single();
	        if ($row->count>0){
	            return true;
	        }else{
	            return false;
	        }
		}

		public function  getTrain($trainId){
	        $this->db->query('SELECT t.*, src.name AS src_name, dest.name AS dest_name FROM train t
	                INNER JOIN station src ON src.stationId=t.src_station
	                INNER  JOIN station dest ON dest.stationId=t.dest_Station
	    WHERE t.trainId=:trainId');
	        $this->db->bind(":trainId", $trainId);
	        $row=$this->db->single();
	        return $row;
	    }

	    public function getJourney($journeyId){
	        $this->db->query("SELECT * FROM journey WHERE journeyId=:journeyId AND journey_status<>'Ended'");
	        $this->db->bind(":journeyId", $journeyId);
	        $journey=$this->db->single();
	        return $journey;
	    }

	    //appandtrackrelated
	    public function getJourneyLocation($journeyId){
	        $this->db->query("SELECT * FROM location l 
	        INNER JOIN journey j on j.journeyId=l.journeyId 
	        INNER JOIN train t on j.trainId=t.trainId 
	    WHERE l.journeyId=:journeyId and j.journey_status<>'Ended'");
	        $this->db->bind(':journeyId', $journeyId);
	        $results=$this->db->resultSet();
	        return $results;
	    }

	    public function stopJourney($journeyId){
	        $date=date('Y-m-d');
	        $time=date('H:i:s');
	        $this->db->query('UPDATE location SET date=:date, time=:time, location_status=:loc_status WHERE journeyId=:journeyIdcl');
	        $this->db->bind(':date', $date);
	        $this->db->bind(':time', $time);
	        $this->db->bind(':loc_status', 'Stopped');
	        $this->db->bind(':journeyIdcl', $journeyId);
	        if ($this->db->execute()){
	            $this->db->query('UPDATE journey SET journey_status=:j_status WHERE journeyId=:journeyIdcl');
	            $this->db->bind(':j_status', 'Off-Line');
	            $this->db->bind(':journeyIdcl', $journeyId);
	            if($this->db->execute()){
	                return true;
	            }else{
	                return false;
	            }
	        }else{
	            return false;
	        }
	    }



	}