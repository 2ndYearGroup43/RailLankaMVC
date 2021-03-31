<?php
    class ModeratorJourney{
        private $db;

        public function __construct()
        {
            $this->db=new Database;

        }

        public function findTrainById($trainid)
        {
            $this->db->query('SELECT COUNT(*) AS count FROM train WHERE trainId=:trainId AND isDeleted=0');
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

        public function displayJourneyAssignments($start, $limit)
        {
            $this->db->query('SELECT d.*,j.trainId, j.journey_status, j.date, j.started_date, j.started_time, j.ended_date, j.ended_time
                FROM journey j INNER JOIN driver_assignment d ON j.journeyId=d.journeyId ORDER BY d.assignment_date DESC LIMIT :start, :limit ');
            $this->db->bind(':start', $start);
            $this->db->bind(':limit', $limit);
            $results=$this->db->resultSet();
            return $results;
        }

        public function countJourneyAssignments()
        {
            $this->db->query('SELECT COUNT(*) AS count FROM journey j INNER JOIN driver_assignment d ON j.journeyId=d.journeyId');
            $result=$this->db->single();
            return $result->count;
        }

        public function getTrains()
        {
            $this->db->query("SELECT DISTINCT t.trainId AS trainId1, t.name, t1.* FROM train t LEFT JOIN (SELECT * FROM journey WHERE journey_status <>'Ended') t1  ON t.trainId=t1.trainId WHERE t1.journeyId IS NULL AND t.isDeleted=0");
            $results=$this->db->resultSet();
            return $results;
        }

        public function getDrivers()
        {
            $this->db->query("SELECT d.driverId FROM (SELECT da.driverId, j.* FROM journey j INNER JOIN driver_assignment da ON j.journeyId=da.journeyId WHERE j.journey_status<>'Ended') t1 RIGHT JOIN driver d ON d.driverId=t1.driverId where t1.journeyid IS NULL");
            $results=$this->db->resultSet();
            return $results;
        }

        public function checkDriver($driverId)
        {
            $this->db->query("SELECT COUNT(*) AS count FROM journey j INNER JOIN driver_assignment da ON j.journeyId=da.journeyId WHERE j.journey_status<>'Ended' AND da.driverId=:driverId");
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
            $this->db->query("SELECT COUNT(*) AS count FROM journey WHERE journey_status <>'Ended' AND trainId=:trainId");
            $this->db->bind(':trainId', $trainid);
            $row=$this->db->single();
            var_dump($row);
            if($row->count>0){
                return true;
            }else{
                return false;
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

        public function getJourneyFields(){
            $this->db->query("SELECT DISTINCT column_name AS columns FROM INFORMATION_SCHEMA.columns WHERE TABLE_NAME IN('driver_assignment', 'journey')");
            $results=$this->db->resultSet();
            return $results;
        }

        public function searchJourneys($searchterm, $searchby, $start, $limit){
            if($searchterm==''){
                $this->db->query('SELECT d.*,j.trainId, j.journey_status, j.date, j.started_date, j.started_time, j.ended_date, j.ended_time
                FROM journey j INNER JOIN driver_assignment d ON j.journeyId=d.journeyId ORDER BY d.assignment_date DESC LIMIT :start, :limit');
                $this->db->bind(':start', $start);
                $this->db->bind(':limit', $limit);
                $results=$this->db->resultSet();
                return $results;
            }else{
                switch ($searchby){
                    case 'driverId':
                        $this->db->query('SELECT d.*,j.trainId, j.journey_status, j.date, j.started_date, j.started_time, j.ended_date, j.ended_time
                    FROM journey j INNER JOIN driver_assignment d ON j.journeyId=d.journeyId WHERE d.driverId=:searchTerm ORDER BY d.assignment_date DESC LIMIT :start, :limit');
                        break;
                    case 'journeyId':
                        $this->db->query('SELECT d.*,j.trainId, j.journey_status, j.date, j.started_date, j.started_time, j.ended_date, j.ended_time
                    FROM journey j INNER JOIN driver_assignment d ON j.journeyId=d.journeyId WHERE d.journeyId=:searchTerm ORDER BY d.assignment_date DESC LIMIT :start, :limit');
                        break;
                    case 'moderatorId':
                        $this->db->query('SELECT d.*,j.trainId, j.journey_status, j.date, j.started_date, j.started_time, j.ended_date, j.ended_time
                    FROM journey j INNER JOIN driver_assignment d ON j.journeyId=d.journeyId WHERE d.moderatorId=:searchTerm ORDER BY d.assignment_date DESC LIMIT :start, :limit');
                        break;
                    case 'assignment_date':
                        $this->db->query('SELECT d.*,j.trainId, j.journey_status, j.date, j.started_date, j.started_time, j.ended_date, j.ended_time
                    FROM journey j INNER JOIN driver_assignment d ON j.journeyId=d.journeyId WHERE d.assignment_date=:searchTerm ORDER BY d.assignment_date DESC LIMIT :start, :limit');
                        break;
                    case 'assignment_time':
                        $this->db->query('SELECT d.*,j.trainId, j.journey_status, j.date, j.started_date, j.started_time, j.ended_date, j.ended_time
                    FROM journey j INNER JOIN driver_assignment d ON j.journeyId=d.journeyId WHERE d.assignment_time=:searchTerm ORDER BY d.assignment_date DESC LIMIT :start, :limit');
                        break;
                    case 'date':
                        $this->db->query('SELECT d.*,j.trainId, j.journey_status, j.date, j.started_date, j.started_time, j.ended_date, j.ended_time
                    FROM journey j INNER JOIN driver_assignment d ON j.journeyId=d.journeyId WHERE j.date=:searchTerm ORDER BY d.assignment_date DESC LIMIT :start, :limit');
                        break;
                    case 'journey_status':
                        $this->db->query('SELECT d.*,j.trainId, j.journey_status, j.date, j.started_date, j.started_time, j.ended_date, j.ended_time
                    FROM journey j INNER JOIN driver_assignment d ON j.journeyId=d.journeyId WHERE j.journey_status=:searchTerm ORDER BY d.assignment_date DESC LIMIT :start, :limit');
                        break;
                    case 'trainId':
                        $this->db->query('SELECT d.*,j.trainId, j.journey_status, j.date, j.started_date, j.started_time, j.ended_date, j.ended_time
                    FROM journey j INNER JOIN driver_assignment d ON j.journeyId=d.journeyId WHERE j.trainId=:searchTerm ORDER BY d.assignment_date DESC LIMIT :start, :limit');
                        break;
                    case 'started_date':
                        $this->db->query('SELECT d.*,j.trainId, j.journey_status, j.date, j.started_date, j.started_time, j.ended_date, j.ended_time
                    FROM journey j INNER JOIN driver_assignment d ON j.journeyId=d.journeyId WHERE j.started_date=:searchTerm ORDER BY d.assignment_date DESC LIMIT :start, :limit');
                        break;
                    case 'started_time':
                        $this->db->query('SELECT d.*,j.trainId, j.journey_status, j.date, j.started_date, j.started_time, j.ended_date, j.ended_time
                    FROM journey j INNER JOIN driver_assignment d ON j.journeyId=d.journeyId WHERE j.started_time=:searchTerm ORDER BY d.assignment_date DESC LIMIT :start, :limit');
                        break;
                    case 'ended_date':
                        $this->db->query('SELECT d.*,j.trainId, j.journey_status, j.date, j.started_date, j.started_time, j.ended_date, j.ended_time
                    FROM journey j INNER JOIN driver_assignment d ON j.journeyId=d.journeyId WHERE j.ended_date=:searchTerm ORDER BY d.assignment_date DESC LIMIT :start, :limit');
                        break;
                    case 'ended_time':
                        $this->db->query('SELECT d.*,j.trainId, j.journey_status, j.date, j.started_date, j.started_time, j.ended_date, j.ended_time
                    FROM journey j INNER JOIN driver_assignment d ON j.journeyId=d.journeyId WHERE j.ended_time=:searchTerm ORDER BY d.assignment_date DESC LIMIT :start, :limit');
                        break;
                }
            }
            $this->db->bind(':searchTerm', $searchterm);
            $this->db->bind(':start', $start);
            $this->db->bind(':limit', $limit);
            $results=$this->db->resultSet();
            return $results;
        }

        public function countSearchJourneys($searchterm, $searchby){
            if($searchterm==''){
                $this->db->query('SELECT COUNT(*) AS count FROM journey j INNER JOIN driver_assignment d ON j.journeyId=d.journeyId');
            }else{
                switch ($searchby){
                    case 'driverId':
                        $this->db->query('SELECT COUNT(*) AS count FROM journey j INNER JOIN 
            driver_assignment d ON j.journeyId=d.journeyId WHERE d.driverId=:searchTerm');
                        break;
                    case 'journeyId':
                        $this->db->query('SELECT COUNT(*) AS count FROM journey j INNER JOIN 
            driver_assignment d ON j.journeyId=d.journeyId WHERE d.journeyId=:searchTerm');
                        break;
                    case 'moderatorId':
                        $this->db->query('SELECT COUNT(*) AS count FROM journey j INNER JOIN 
            driver_assignment d ON j.journeyId=d.journeyId WHERE d.moderatorId=:searchTerm');
                        break;
                    case 'assignment_date':
                        $this->db->query('SELECT COUNT(*) AS count FROM journey j INNER JOIN 
            driver_assignment d ON j.journeyId=d.journeyId WHERE d.assignment_date=:searchTerm');
                        break;
                    case 'assignment_time':
                        $this->db->query('SELECT COUNT(*) AS count FROM journey j INNER JOIN 
            driver_assignment d ON j.journeyId=d.journeyId WHERE d.assignment_time=:searchTerm');
                        break;
                    case 'date':
                        $this->db->query('SELECT COUNT(*) AS count FROM journey j INNER JOIN 
            driver_assignment d ON j.journeyId=d.journeyId WHERE j.date=:searchTerm');
                        break;
                    case 'journey_status':
                        $this->db->query('SELECT COUNT(*) AS count FROM journey j INNER JOIN 
            driver_assignment d ON j.journeyId=d.journeyId WHERE j.journey_status=:searchTerm');
                        break;
                    case 'trainId':
                        $this->db->query('SELECT COUNT(*) AS count FROM journey j INNER JOIN 
            driver_assignment d ON j.journeyId=d.journeyId WHERE j.trainId=:searchTerm');
                        break;
                    case 'started_date':
                        $this->db->query('SELECT COUNT(*) AS count FROM journey j INNER JOIN 
            driver_assignment d ON j.journeyId=d.journeyId WHERE j.started_date=:searchTerm');
                        break;
                    case 'started_time':
                        $this->db->query('SELECT COUNT(*) AS count FROM journey j INNER JOIN 
            driver_assignment d ON j.journeyId=d.journeyId WHERE j.started_time=:searchTerm');
                        break;
                    case 'ended_date':
                        $this->db->query('SELECT COUNT(*) AS count FROM journey j INNER JOIN 
            driver_assignment d ON j.journeyId=d.journeyId WHERE j.ended_date=:searchTerm');
                        break;
                    case 'ended_time':
                        $this->db->query('SELECT COUNT(*) AS count FROM journey j INNER JOIN 
            driver_assignment d ON j.journeyId=d.journeyId WHERE j.ended_time=:searchTerm');
                        break;
                }
            }
            $this->db->bind(':searchTerm', $searchterm);
            $result=$this->db->single();
            return $result->count;

        }

        public function displayFilteredJourneyAssignments($jStatus, $start, $limit)
        {
            $this->db->query('SELECT d.*,j.trainId, j.journey_status, j.date, j.started_date, j.started_time, j.ended_date, j.ended_time FROM journey j INNER JOIN 
    driver_assignment d ON j.journeyId=d.journeyId WHERE j.journey_status=:jstatus ORDER BY d.assignment_date DESC LIMIT :start, :limit');
            $this->db->bind(':jstatus', $jStatus);
            $this->db->bind(':start', $start);
            $this->db->bind(':limit', $limit);
            $results=$this->db->resultSet();
            return $results;
        }

        public function countFilteredJourneyAssignments($jStatus)
        {
            $this->db->query('SELECT COUNT(*) AS count FROM journey j INNER JOIN driver_assignment d ON j.journeyId=d.journeyId WHERE j.journey_status=:jstatus ORDER BY d.assignment_date DESC ');
            $this->db->bind(':jstatus', $jStatus);
            $result=$this->db->single();
            return $result->count;
        }




        public function searchFilteredJourneys($searchterm, $searchby, $jstatus, $start, $limit){
            if($searchterm==''){
                $this->db->query('SELECT d.*,j.trainId, j.journey_status, j.date, j.started_date, j.started_time, j.ended_date, j.ended_time FROM journey j INNER JOIN
    driver_assignment d ON j.journeyId=d.journeyId WHERE j.journey_status=:jstatus ORDER BY d.assignment_date DESC LIMIT :start, :limit ');
                $this->db->bind(':jstatus', $jstatus);
                $this->db->bind(':start', $start);
                $this->db->bind(':limit', $limit);
                $results=$this->db->resultSet();
                return $results;
            }else{
                switch ($searchby){
                    case 'driverId':
                        $this->db->query('SELECT d.*,j.trainId, j.journey_status, j.date, j.started_date, j.started_time, j.ended_date, j.ended_time
                    FROM journey j INNER JOIN driver_assignment d ON j.journeyId=d.journeyId WHERE d.driverId=:searchTerm AND j.journey_status=:jstatus ORDER BY d.assignment_date DESC LIMIT :start, :limit ');
                        break;
                    case 'journeyId':
                        $this->db->query('SELECT d.*,j.trainId, j.journey_status, j.date, j.started_date, j.started_time, j.ended_date, j.ended_time
                    FROM journey j INNER JOIN driver_assignment d ON j.journeyId=d.journeyId WHERE d.journeyId=:searchTerm AND j.journey_status=:jstatus ORDER BY d.assignment_date DESC LIMIT :start, :limit ');
                        break;
                    case 'moderatorId':
                        $this->db->query('SELECT d.*,j.trainId, j.journey_status, j.date, j.started_date, j.started_time, j.ended_date, j.ended_time
                    FROM journey j INNER JOIN driver_assignment d ON j.journeyId=d.journeyId WHERE d.moderatorId=:searchTerm AND j.journey_status=:jstatus ORDER BY d.assignment_date DESC LIMIT :start, :limit ');
                        break;
                    case 'assignment_date':
                        $this->db->query('SELECT d.*,j.trainId, j.journey_status, j.date, j.started_date, j.started_time, j.ended_date, j.ended_time
                    FROM journey j INNER JOIN driver_assignment d ON j.journeyId=d.journeyId WHERE d.assignment_date=:searchTerm AND j.journey_status=:jstatus ORDER BY d.assignment_date DESC LIMIT :start, :limit ');
                        break;
                    case 'assignment_time':
                        $this->db->query('SELECT d.*,j.trainId, j.journey_status, j.date, j.started_date, j.started_time, j.ended_date, j.ended_time
                    FROM journey j INNER JOIN driver_assignment d ON j.journeyId=d.journeyId WHERE d.assignment_time=:searchTerm AND j.journey_status=:jstatus ORDER BY d.assignment_date DESC LIMIT :start, :limit ');
                        break;
                    case 'date':
                        $this->db->query('SELECT d.*,j.trainId, j.journey_status, j.date, j.started_date, j.started_time, j.ended_date, j.ended_time
                    FROM journey j INNER JOIN driver_assignment d ON j.journeyId=d.journeyId WHERE j.date=:searchTerm AND j.journey_status=:jstatus ORDER BY d.assignment_date DESC LIMIT :start, :limit ');
                        break;
                    case 'journey_status':
                        $this->db->query('SELECT d.*,j.trainId, j.journey_status, j.date, j.started_date, j.started_time, j.ended_date, j.ended_time
                    FROM journey j INNER JOIN driver_assignment d ON j.journeyId=d.journeyId WHERE j.journey_status=:searchTerm AND j.journey_status=:jstatus ORDER BY d.assignment_date DESC LIMIT :start, :limit ');
                        break;
                    case 'trainId':
                        $this->db->query('SELECT d.*,j.trainId, j.journey_status, j.date, j.started_date, j.started_time, j.ended_date, j.ended_time
                    FROM journey j INNER JOIN driver_assignment d ON j.journeyId=d.journeyId WHERE j.trainId=:searchTerm AND j.journey_status=:jstatus ORDER BY d.assignment_date DESC LIMIT :start, :limit ');
                        break;
                    case 'started_date':
                        $this->db->query('SELECT d.*,j.trainId, j.journey_status, j.date, j.started_date, j.started_time, j.ended_date, j.ended_time
                    FROM journey j INNER JOIN driver_assignment d ON j.journeyId=d.journeyId WHERE j.started_date=:searchTerm AND j.journey_status=:jstatus ORDER BY d.assignment_date DESC LIMIT :start, :limit ');
                        break;
                    case 'started_time':
                        $this->db->query('SELECT d.*,j.trainId, j.journey_status, j.date, j.started_date, j.started_time, j.ended_date, j.ended_time
                    FROM journey j INNER JOIN driver_assignment d ON j.journeyId=d.journeyId WHERE j.started_time=:searchTerm AND j.journey_status=:jstatus ORDER BY d.assignment_date DESC LIMIT :start, :limit ');
                        break;
                    case 'ended_date':
                        $this->db->query('SELECT d.*,j.trainId, j.journey_status, j.date, j.started_date, j.started_time, j.ended_date, j.ended_time
                    FROM journey j INNER JOIN driver_assignment d ON j.journeyId=d.journeyId WHERE j.ended_date=:searchTerm AND j.journey_status=:jstatus ORDER BY d.assignment_date DESC LIMIT :start, :limit ');
                        break;
                    case 'ended_time':
                        $this->db->query('SELECT d.*,j.trainId, j.journey_status, j.date, j.started_date, j.started_time, j.ended_date, j.ended_time
                    FROM journey j INNER JOIN driver_assignment d ON j.journeyId=d.journeyId WHERE j.ended_time=:searchTerm AND j.journey_status=:jstatus ORDER BY d.assignment_date DESC LIMIT :start, :limit ');
                        break;
                }
            }
            $this->db->bind(':searchTerm', $searchterm);
            $this->db->bind(':jstatus', $jstatus);
            $this->db->bind(':start', $start);
            $this->db->bind(':limit', $limit);
            $results=$this->db->resultSet();
            return $results;
        }

        public function countSearchFilteredJourneys($searchterm, $searchby, $jstatus){
            if($searchterm==''){
                $this->db->query('SELECT COUNT(*) AS count FROM journey j INNER JOIN
    driver_assignment d ON j.journeyId=d.journeyId WHERE j.journey_status=:jstatus ');
                $this->db->bind(':jstatus', $jstatus);
                $result=$this->db->single();
                return $result->count;
            }else{
                switch ($searchby){
                    case 'driverId':
                        $this->db->query('SELECT COUNT(*) AS count FROM journey j INNER JOIN 
            driver_assignment d ON j.journeyId=d.journeyId WHERE d.driverId=:searchTerm AND j.journey_status=:jstatus ');
                        break;
                    case 'journeyId':
                        $this->db->query('SELECT COUNT(*) AS count FROM journey j INNER JOIN 
            driver_assignment d ON j.journeyId=d.journeyId WHERE d.journeyId=:searchTerm AND j.journey_status=:jstatus ');
                        break;
                    case 'moderatorId':
                        $this->db->query('SELECT COUNT(*) AS count FROM journey j INNER JOIN 
            driver_assignment d ON j.journeyId=d.journeyId WHERE d.moderatorId=:searchTerm AND j.journey_status=:jstatus ');
                        break;
                    case 'assignment_date':
                        $this->db->query('SELECT COUNT(*) AS count FROM journey j INNER JOIN 
            driver_assignment d ON j.journeyId=d.journeyId WHERE d.assignment_date=:searchTerm AND j.journey_status=:jstatus ');
                        break;
                    case 'assignment_time':
                        $this->db->query('SELECT COUNT(*) AS count FROM journey j INNER JOIN 
            driver_assignment d ON j.journeyId=d.journeyId WHERE d.assignment_time=:searchTerm AND j.journey_status=:jstatus ');
                        break;
                    case 'date':
                        $this->db->query('SELECT COUNT(*) AS count FROM journey j INNER JOIN 
            driver_assignment d ON j.journeyId=d.journeyId WHERE j.date=:searchTerm AND j.journey_status=:jstatus ');
                        break;
                    case 'journey_status':
                        $this->db->query('SELECT COUNT(*) AS count FROM journey j INNER JOIN 
            driver_assignment d ON j.journeyId=d.journeyId WHERE j.journey_status=:searchTerm AND j.journey_status=:jstatus ');
                        break;
                    case 'trainId':
                        $this->db->query('SELECT COUNT(*) AS count FROM journey j INNER JOIN 
            driver_assignment d ON j.journeyId=d.journeyId WHERE j.trainId=:searchTerm AND j.journey_status=:jstatus ');
                        break;
                    case 'started_date':
                        $this->db->query('SELECT COUNT(*) AS count FROM journey j INNER JOIN 
            driver_assignment d ON j.journeyId=d.journeyId WHERE j.started_date=:searchTerm AND j.journey_status=:jstatus ');
                        break;
                    case 'started_time':
                        $this->db->query('SELECT COUNT(*) AS count FROM journey j INNER JOIN 
            driver_assignment d ON j.journeyId=d.journeyId WHERE j.started_time=:searchTerm AND j.journey_status=:jstatus ');
                        break;
                    case 'ended_date':
                        $this->db->query('SELECT COUNT(*) AS count FROM journey j INNER JOIN 
            driver_assignment d ON j.journeyId=d.journeyId WHERE j.ended_date=:searchTerm AND j.journey_status=:jstatus ');
                        break;
                    case 'ended_time':
                        $this->db->query('SELECT COUNT(*) AS count FROM journey j INNER JOIN 
            driver_assignment d ON j.journeyId=d.journeyId WHERE j.ended_time=:searchTerm AND j.journey_status=:jstatus ');
                        break;
                }
            }
            $this->db->bind(':searchTerm', $searchterm);
            $this->db->bind(':jstatus', $jstatus);
            $result=$this->db->single();
            return $result->count;
        }


        public function deleteJourney($id){
            $this->db->query('DELETE FROM journey WHERE journeyId=:journeyId');
            $this->db->bind(':journeyId', $id);
            if($this->db->execute()){
                return true;
            }else{
                return false;
            }
        }


        public function getDays($trainId){
            $this->db->query('SELECT * FROM availabledays WHERE trainid=:trainId');
            $this->db->bind(':trainId', $trainId);
            $row=$this->db->single();
            return $row;
        }



    }





            
        
