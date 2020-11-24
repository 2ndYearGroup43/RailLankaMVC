<?php
    class ModeratorJourney{
        private $db;

        public function __construct()
        {
            $this->db=new Database;

        }

        public function findTrainById($trainid)
        {
            $this->db->query('SELECT COUNT(*) AS count FROM train WHERE trainId=:trainId');
            $this->db->bind(':trainId',$trainid);

            $results=array();
            $results=$this->db->resultSet();
            $count=$results[0]->count;

            if($count>0){
                return true;
            }else{
                return false;
            }
        }

        public function findDriverById($driverid)
        {
            $this->db->query('SELECT COUNT(*) AS count FROM driver WHERE driverId=:driverId');
            $this->db->bind(':driverId',$driverid);

            $results=array();
            $results=$this->db->resultSet();
            $count=$results[0]->count;

            if($count>0){
                return true;
            }else{
                return false;
            }
        }

        public function addJourneyAssignment($data)
        { 
            $this->db->query('INSERT INTO journey (date, journey_status, trainId) VALUES(:insDate, :journey_status, :trainId)');
            $this->db->bind(':insDate', $data['date']);
            $this->db->bind(':journey_status', $data['jstatus']);
            $this->db->bind(':trainId', $data['trainId']);

            if($this->db->execute()){
                $this->db->query('SELECT LAST_INSERT_ID() AS journeyId');
                $resultId=[];
                $resultId=$this->db->resultSet();
                $this->db->query('INSERT INTO driver_assignment (driverId, journeyId, moderatorId, assignment_date, assignment_time) VALUES(:driverId, :journeyId, :moderatorId, :insertedDate, :insertedTime)');
                $this->db->bind(':journeyId', $resultId[0]->journeyId);
                $this->db->bind(':driverId', $data['driverId']);
                $this->db->bind(':moderatorId', $data['moderatorId']);
                $this->db->bind(':insertedDate', $data['insertedDate']);
                 $this->db->bind(':insertedTime', $data['insertedTime']);
                if($this->db->execute()){
                    return true;
                }else{
                    return false;
                }
            }else{
                return false;
            }   
        }

        public function displayJourneyAssignments()
        {
            $this->db->query('SELECT d.*,j.trainId, j.journey_status, j.date FROM journey j INNER JOIN driver_assignment d ON j.journeyId=d.journeyId');
            $results=$this->db->resultSet();
            return $results;
        }

        public function getTrains()
        {
            $this->db->query("SELECT DISTINCT t.trainId AS trainId1, t.name, j.* FROM train t LEFT JOIN journey j  ON t.trainId=j.trainId WHERE j.journeyid IS NULL OR j.journey_status='ended'");
            $results=$this->db->resultSet();
            return $results;
        }

        public function getDrivers()
        {
            $this->db->query("SELECT DISTINCT t.driverId, j.* FROM (SELECT d.*, a.journeyId FROM driver d LEFT join driver_assignment a ON d.driverId=a.driverId) t LEFT JOIN journey j  ON t.journeyid=j.journeyId WHERE t.journeyid IS NULL OR j.journey_status='ended'");
            $results=$this->db->resultSet();
            return $results;
        }

        public function checkDriver($driverId)
        {
            $this->db->query("SELECT COUNT(*) AS count FROM (SELECT d.*, a.journeyId FROM driver d 
            LEFT join driver_assignment a ON d.driverId=a.driverId where a.driverId=:driverId)
             t LEFT JOIN journey j  ON t.journeyid=j.journeyId WHERE t.journeyid IS NULL OR (j.journey_status='live' OR j.journey_status='off-line')");
            $this->db->bind(':driverId', $driverId);
            $row=$this->db->single();
            if($row->count>0){
                return true;
            }else{
                return false;
            }
        }

        public function checkTrain($trainid)
        {
            $this->db->query("SELECT COUNT(*) AS count  FROM train t LEFT JOIN
             journey j  ON t.trainId=j.trainId WHERE (j.journeyid IS NULL OR j.journey_status='ended') AND t.trainId=:trainId");
            $this->db->bind(':trainId', $trainid);
            $row=$this->db->single();
            if($row->count>0){
                return false;
            }else{
                return true;
            }
        }




        public function getJourneyDetails($journeyId,  $driverid)
        {
            $this->db->query('SELECT * FROM journey j INNER JOIN driver_assignment a ON j.journeyId=a.journeyId WHERE j.journeyId=:journeyId');
            $this->db->bind(':journeyId', $journeyId);
            $row=$this->db->single();
            return $row;
        }

        public function updateJourneyAssignment($data)
        {        
            $this->db->query('UPDATE journey SET trainId=:trainid, date=:date, journey_status=:jstatus WHERE journeyId=:journeyId');
            $this->db->bind(":trainid", $data['trainId']);
            $this->db->bind(":jstatus", $data['jstatus']);
            $this->db->bind(':date', $data['date']);
            $this->db->bind(':journeyId', $data['journeyId']);

            if($this->db->execute()){
                $this->db->query('UPDATE driver_assignment SET driverId=:driverIdnew WHERE journeyId=:journeyId AND driverId=:driverId');
                $this->db->bind(":driverIdnew", $data['driverId']);
                $this->db->bind(":driverId", $data['driver']);
                $this->db->bind(":journeyId", $data['journeyId']);

                if ($this->db->execute()) {
                    return true;
                }else{
                    return false;
                }
            }else{
                return false;
            }
            
        }

    }





            
        
