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
    }