<?php 
	class PassengerAlert {
		private $db;

		public function __construct() {
			$this->db = new Database;
		}

		public function countAllAlerts(){

			$this->db->query('SELECT COUNT(alertId) AS count FROM alerts');
			$results=array();
			$results=$this->db->resultSet();
			$count = (int) $results[0]->count;
			return $count;
			
		}

		public function countAlerts($searchfield,$searchval){

			if($searchval==''){
				$this->db->query('SELECT COUNT(alertId) AS count FROM alerts');
				
			} else {
				switch($searchfield) {
					case 'alertId':
						$this->db->query('SELECT COUNT(alertId) AS count FROM alerts WHERE alertId=:searchVal');
						break;

					case 'trainId':
						$this->db->query('SELECT COUNT(alertId) AS count FROM alerts WHERE trainId=:searchVal');
						break;

					case 'date':
						$this->db->query('SELECT COUNT(a.alertId) AS count FROM alerts a WHERE a.date=:searchVal');
						break;

					case 'type':
						$this->db->query('SELECT COUNT(alertId) AS count FROM alerts WHERE type=:searchVal');
						break;
				}
			}

			$this->db->bind(':searchVal',$searchval);	
			$results=array();
			$results=$this->db->resultSet();
			$count = (int) $results[0]->count;
			return $count;
		}


		public function searchAlerts($searchfield,$searchval,$start,$limit){

			if($searchval==''){
				$this->db->query('SELECT a.*, c.cancellation_cause, d.delay_cause, d.delaytime, r.reschedulement_cause, r.newtime, r.newdate FROM alerts a LEFT JOIN cancelled_alerts c ON a.alertId=c.alertId LEFT JOIN delayed_alerts d ON a.alertId=d.alertId LEFT JOIN rescheduled_alerts r ON a.alertId=r.alertId LIMIT :start , :noPerPage');
				
			} else {
				switch($searchfield) {
					case 'alertId':
						$this->db->query('SELECT type FROM alerts WHERE alertId=:searchVal');
						$this->db->bind(':searchVal',$searchval);
						$result=$this->db->single();
						if($result->type=='cancelled'){
							$this->db->query('SELECT a.*, c.cancellation_cause FROM alerts a INNER JOIN cancelled_alerts c ON a.alertId=c.alertId WHERE a.alertId=:searchVal LIMIT :start , :noPerPage');
							$this->db->bind(':searchVal',$searchval);
						}elseif ($result->type=="delayed") {
							$this->db->query('SELECT a.*, d.delay_cause, d.delaytime FROM alerts a INNER JOIN delayed_alerts d ON a.alertId=d.alertId WHERE a.alertId=:searchVal LIMIT :start , :noPerPage');
							$this->db->bind(':searchVal',$searchval);
						}elseif ($result->type=="rescheduled") {
							$this->db->query('SELECT a.*, r.reschedulement_cause, r.newtime, r.newdate FROM alerts a INNER JOIN rescheduled_alerts r ON a.alertId=r.alertId WHERE a.alertId=:searchVal LIMIT :start , :noPerPage');
							$this->db->bind(':searchVal',$searchval);
						}
						break;
					case 'trainId':
						$this->db->query('SELECT type FROM alerts WHERE trainId=:searchVal');
						$this->db->bind(':searchVal',$searchval);
						$result=$this->db->single();
						if($result->type=='cancelled'){
							$this->db->query('SELECT a.*, c.cancellation_cause FROM alerts a INNER JOIN cancelled_alerts c ON a.alertId=c.alertId WHERE a.trainId=:searchVal LIMIT :start , :noPerPage');
							$this->db->bind(':searchVal',$searchval);
						}elseif ($result->type=="delayed") {
							$this->db->query('SELECT a.*, d.delay_cause, d.delaytime FROM alerts a INNER JOIN delayed_alerts d ON a.alertId=d.alertId WHERE a.trainId=:searchVal LIMIT :start , :noPerPage');
							$this->db->bind(':searchVal',$searchval);
						}elseif ($result->type=="rescheduled") {
							$this->db->query('SELECT a.*, r.reschedulement_cause, r.newtime, r.newdate FROM alerts a INNER JOIN rescheduled_alerts r ON a.trainId=r.alertId WHERE a.alertId=:searchVal LIMIT :start , :noPerPage');
							$this->db->bind(':searchVal',$searchval);
						}
						break;
					case 'date':
						$this->db->query('SELECT a.*, c.cancellation_cause, d.delay_cause, d.delaytime, r.reschedulement_cause, r.newtime, r.newdate FROM alerts a LEFT JOIN cancelled_alerts c ON a.alertId=c.alertId LEFT JOIN delayed_alerts d ON a.alertId=d.alertId LEFT JOIN rescheduled_alerts r ON a.alertId=r.alertId WHERE a.date=:searchVal LIMIT :start , :noPerPage');
						$this->db->bind(':searchVal',$searchval);
						break;
					case 'type':
						if($searchval=='cancelled'){
							$this->db->query('SELECT a.*, c.cancellation_cause FROM alerts a INNER JOIN cancelled_alerts c ON a.alertId=c.alertId LIMIT :start , :noPerPage');
						}elseif ($searchval=="delayed") {
							$this->db->query('SELECT a.*, d.delay_cause, d.delaytime FROM alerts a INNER JOIN delayed_alerts d ON a.alertId=d.alertId LIMIT :start , :noPerPage');
						}elseif ($searchval=="rescheduled") {
							$this->db->query('SELECT a.*, r.reschedulement_cause, r.newtime, r.newdate FROM alerts a INNER JOIN rescheduled_alerts r ON a.alertId=r.alertId LIMIT :start , :noPerPage');
						}
						break;
				}
			}
			
			$this->db->bind(":start", $start);
			$this->db->bind(":noPerPage", $limit);
			$results=$this->db->resultSet();
			return $results;
		}

		public function displayAll($start,$limit){

			$this->db->query('SELECT a.*, c.cancellation_cause, d.delay_cause, d.delaytime, r.reschedulement_cause, r.newtime, r.newdate FROM alerts a LEFT JOIN cancelled_alerts c ON a.alertId=c.alertId LEFT JOIN delayed_alerts d ON a.alertId=d.alertId LEFT JOIN rescheduled_alerts r ON a.alertId=r.alertId LIMIT :start , :noPerPage');
			$this->db->bind(":start", $start);
			$this->db->bind(":noPerPage", $limit);
			$results=$this->db->resultSet();
			return $results;
		}

		public function displayCancelled(){

			$this->db->query('SELECT a.*, c.cancellation_cause FROM cancelled_alerts c INNER JOIN alerts a ON c.alertId=a.alertId');
			$results=$this->db->resultSet();
			return $results;
		}

		public function displayDelayed(){

			$this->db->query('SELECT a.*, d.delay_cause, d.delaytime FROM delayed_alerts d INNER JOIN alerts a ON d.alertId=a.alertId');
			$results=$this->db->resultSet();
			return $results;
		}

		public function displayRescheduled(){

			$this->db->query('SELECT a.*, r.reschedulement_cause, r.newtime, r.newdate FROM rescheduled_alerts r INNER JOIN alerts a ON r.alertId=a.alertId');
			$results=$this->db->resultSet();
			return $results;
		}

		public function getAlertFields(){

			$this->db->query("SELECT DISTINCT column_name AS columns FROM INFORMATION_SCHEMA.columns WHERE TABLE_NAME IN ('alerts')");
			$results=$this->db->resultSet();
			return $results;
		}

		public function getAlertType($alertid){
			$this->db->query("SELECT type FROM alerts WHERE alertid=:alertid");
			$this->db->bind(":alertid", $alertid);
			$results=$this->db->single();
			return $results;
		}

		public function getCancelledAlert($alertid){
			$this->db->query("SELECT * FROM cancelled_alerts WHERE alertid=:alertid");
			$this->db->bind(":alertid", $alertid);
			$results=$this->db->single();
			return $results;
		}

		public function getDelayedAlert($alertid){
			$this->db->query("SELECT * FROM delayed_alerts WHERE alertid=:alertid");
			$this->db->bind(":alertid", $alertid);
			$results=$this->db->single();
			return $results;
		}

		public function getRescheduledAlert($alertid){
			$this->db->query("SELECT * FROM rescheduled_alerts WHERE alertid=:alertid");
			$this->db->bind(":alertid", $alertid);
			$results=$this->db->single();
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


		public function getStations(){

			$this->db->query('SELECT stationID AS stationId, name AS stationName FROM station');
			$results = $this->db->resultSet();
			return $results;
		}


		public function addSubscription($trainid, $id){

			$this->db->query('INSERT INTO subscriptions (passengerId,trainId) VALUES (:id, :trainid)');

			//bind values
			$this->db->bind(':id', $id);
			$this->db->bind(':trainid', $trainid);

			//Execute function
			if ($this->db->execute()) {
				return true;				
			} else {
				return false;
			}
		}

	}
