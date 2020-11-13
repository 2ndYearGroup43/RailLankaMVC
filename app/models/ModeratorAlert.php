<?php
    class ModeratorAlert{
        private $db;

        public function __construct()
        {
            $this->db=new Database;

        }

        public function findAllAlerts()
        {
            $this->db->query('SELECT * FROM alerts ORDER BY date ASC');
            $results = $this->db->resultSet();
            return $results;
        }

        public function addCancellationAlert($data)
        { 
            $this->db->query('INSERT INTO alerts (date, time, trainId, moderatorId) VALUES(:insDate, :insTime, :trainId, :modId)');
            $this->db->bind(':insDate', $data['insertedDate']);
            $this->db->bind(':insTime', $data['insertedTime']);
            $this->db->bind(':trainId', $data['trainId']);
            $this->db->bind(':modId', $data['moderatorId']);

            if($this->db->execute()){
                $this->db->query('SELECT LAST_INSERT_ID() AS alertId');
                $resultId=[];
                $resultId=$this->db->resultSet();
                $this->db->query('INSERT INTO cancelled_alerts (alertId, cancellation_cause) VALUES(:alertId, :cancelcause)');
                $this->db->bind(':alertId', $resultId[0]->alertId);
                $this->db->bind(':cancelcause', $data['cancelCause']);
                if($this->db->execute()){
                    return true;
                }else{
                    return false;
                }
            }else{
                return false;
            }   
        }

        

        public function addDelayAlert($data)
        { 
            $this->db->query('INSERT INTO alerts (date, time, trainId, moderatorId) VALUES(:insDate, :insTime, :trainId, :modId)');
            $this->db->bind(':insDate', $data['insertedDate']);
            $this->db->bind(':insTime', $data['insertedTime']);
            $this->db->bind(':trainId', $data['trainId']);
            $this->db->bind(':modId', $data['moderatorId']);

            if($this->db->execute()){
                $this->db->query('SELECT LAST_INSERT_ID() AS alertId');
                $resultId=[];
                $resultId=$this->db->resultSet();
                $this->db->query('INSERT INTO delayed_alerts (alertId, delaytime, delay_cause) VALUES(:alertId, :delaytime, :delaycause)');
                $this->db->bind(':alertId', $resultId[0]->alertId);
                $this->db->bind(':delaytime', $data['delayTime']);
                $this->db->bind(':delaycause', $data['delayCause']);
                if($this->db->execute()){
                    return true;
                }else{
                    return false;
                }
            }else{
                return false;
            }   
        }


        public function addRescheduledAlert($data)
        { 
            $this->db->query('INSERT INTO alerts (date, time, trainId, moderatorId) VALUES(:insDate, :insTime, :trainId, :modId)');
            $this->db->bind(':insDate', $data['insertedDate']);
            $this->db->bind(':insTime', $data['insertedTime']);
            $this->db->bind(':trainId', $data['trainId']);
            $this->db->bind(':modId', $data['moderatorId']);

            if($this->db->execute()){
                $this->db->query('SELECT LAST_INSERT_ID() AS alertId');
                $resultId=[];
                $resultId=$this->db->resultSet();
                $this->db->query('INSERT INTO rescheduled_alerts (alertId, newdate, newtime, reschedulement_cause)
                 VALUES(:alertId, :newdate, :newtime, :rescheduledcause)');
                $this->db->bind(':alertId', $resultId[0]->alertId);
                $this->db->bind(':newdate', $data['newDate']);
                $this->db->bind(':newtime', $data['newTime']);
                $this->db->bind(':rescheduledcause', $data['reschedulementCause']);
                if($this->db->execute()){
                    return true;
                }else{
                    return false;
                }
            }else{
                return false;
            }   
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

        public function displayCancellations()
        {
            $this->db->query('SELECT a.*,c.cancellation_cause FROM cancelled_alerts c INNER JOIN alerts a ON c.alertId=a.alertId');
            $results=$this->db->resultSet();
            return $results;
        }

        public function getCancellationFields()
        {
            $this->db->query("SELECT DISTINCT column_name AS columns FROM INFORMATION_SCHEMA.columns WHERE TABLE_NAME IN('cancelled_alerts', 'alerts')");
            $results=$this->db->resultSet();
            return $results;
        }

        public function searchCancellations($searchterm, $searchfield)
        {
            if($searchterm==''){
                $this->db->query('SELECT a.*,c.cancellation_cause FROM cancelled_alerts c
                      INNER JOIN alerts a ON c.alertId=a.alertId');
            }else{
                switch ($searchfield) {
                    case 'alertId':
                        $this->db->query('SELECT a.*,c.cancellation_cause FROM cancelled_alerts c
                        INNER JOIN alerts a ON c.alertId=a.alertId WHERE a.alertId = :searchTerm');
                        break;
                    case 'trainId':
                        $this->db->query('SELECT a.*,c.cancellation_cause FROM cancelled_alerts c
                        INNER JOIN alerts a ON c.alertId=a.alertId WHERE a.trainId = :searchTerm');
                        break;
                    case 'moderatorId':
                        $this->db->query('SELECT a.*,c.cancellation_cause FROM cancelled_alerts c
                        INNER JOIN alerts a ON c.alertId=a.alertId WHERE a.moderatorId = :searchTerm');
                        break;
                    case 'date':
                        $this->db->query('SELECT a.*,c.cancellation_cause FROM cancelled_alerts c
                        INNER JOIN alerts a ON c.alertId=a.alertId WHERE a.date = :searchTerm');
                        break;
                    case 'time':
                        $this->db->query('SELECT a.*,c.cancellation_cause FROM cancelled_alerts c
                        INNER JOIN alerts a ON c.alertId=a.alertId WHERE a.time = :searchTerm');
                        break;
                }
            }
                         
            
            
            $this->db->bind(':searchTerm',$searchterm);
            $results=$this->db->resultSet();
            return $results;
            
        }

        public function findCancellationById($id) 
        {
            $this->db->query('SELECT a.*, c.cancellation_cause FROM cancelled_alerts c
             INNER JOIN alerts a ON a.alertId=c.alertId WHERE a.alertId=:alertId');
            $this->db->bind(":alertId",$id);
            $row=$this->db->single();
            return $row;

        }

        public function updateCancellationAlert($data)
        {
            $this->db->query('UPDATE alerts SET trainId=:trainid WHERE alertid=:id');
            $this->db->bind(":trainid", $data['trainId']);
            $this->db->bind(":id", $data['alertId']);

            if($this->db->execute()){
                $this->db->query('UPDATE cancelled_alerts SET cancellation_cause=:cancelCause WHERE alertid=:id');
                $this->db->bind(":cancelCause", $data['cancelCause']);
                $this->db->bind(":id", $data['alertId']);

                if ($this->db->execute()) {
                    return true;
                }else{
                    return false;
                }
            }else{
                return false;
            }

        }



        public function displayDelays()
        {
            $this->db->query('SELECT a.*,d.delay_cause, d.delaytime FROM delayed_alerts d INNER JOIN alerts a ON d.alertId=a.alertId');
            $results=$this->db->resultSet();
            return $results;
        }

        public function getDelayFields()
        {
            $this->db->query("SELECT DISTINCT column_name AS columns FROM INFORMATION_SCHEMA.columns WHERE TABLE_NAME IN('delayed_alerts', 'alerts')");
            $results=$this->db->resultSet();
            return $results;
        }

        public function searchDelays($searchterm, $searchfield)
        {
            if($searchterm==''){
                $this->db->query('SELECT a.*, d.delay_cause, d.delaytime FROM delayed_alerts d
                      INNER JOIN alerts a ON d.alertId=a.alertId');
            }else{
                switch ($searchfield) {
                    case 'alertId':
                        $this->db->query('SELECT a.*, d.delay_cause, d.delaytime FROM delayed_alerts d
                        INNER JOIN alerts a ON d.alertId=a.alertId WHERE a.alertId = :searchTerm');
                        break;
                    case 'trainId':
                        $this->db->query('SELECT a.*, d.delay_cause, d.delaytime FROM delayed_alerts d
                        INNER JOIN alerts a ON d.alertId=a.alertId WHERE a.trainId = :searchTerm');
                        break;
                    case 'moderatorId':
                        $this->db->query('SELECT a.*, d.delay_cause, d.delaytime FROM delayed_alerts d
                        INNER JOIN alerts a ON d.alertId=a.alertId WHERE a.moderatorId = :searchTerm');
                        break;
                    case 'date':
                        $this->db->query('SELECT a.*,d.delay_cause, d.delaytime FROM delayed_alerts d
                        INNER JOIN alerts a ON d.alertId=a.alertId WHERE a.date = :searchTerm');
                        break;
                    case 'time':
                        $this->db->query('SELECT a.*,d.delay_cause, d.delaytime FROM delayed_alerts d
                        INNER JOIN alerts a ON d.alertId=a.alertId WHERE a.time = :searchTerm');
                        break;
                    case 'delaytime':
                        $this->db->query('SELECT a.*,d.delay_cause, d.delaytime FROM delayed_alerts d
                        INNER JOIN alerts a ON d.alertId=a.alertId WHERE d.newtime = :searchTerm');
                        break;
                }
            }
                         
            $this->db->bind(':searchTerm',$searchterm);
            $results=$this->db->resultSet();
            return $results;
            
        }


        

        public function findDelayById($id) 
        {
            $this->db->query('SELECT a.*, d.delay_cause FROM delayed_alerts d
             INNER JOIN alerts a ON a.alertId=d.alertId WHERE a.alertId=:alertId');
            $this->db->bind(":alertId",$id);
            $row=$this->db->single();
            return $row;

        }

        public function updateDelayAlert($data)
        {
            $this->db->query('UPDATE alerts SET trainId=:trainid WHERE alertid=:id');
            $this->db->bind(":trainid", $data['trainId']);
            $this->db->bind(":id", $data['alertId']);

            if($this->db->execute()){
                $this->db->query('UPDATE delayed_alerts SET delay_cause=:delayCause, delaytime=:delayTime WHERE alertid=:id');
                $this->db->bind(":delayCause", $data['delayCause']);
                $this->db->bind(":delayTime", $data['delayTime']);
                $this->db->bind(":id", $data['alertId']);

                if ($this->db->execute()) {
                    return true;
                }else{
                    return false;
                }
            }else{
                return false;
            }

        }





        public function displayReschedulements()
        {
            $this->db->query('SELECT a.*,r.reschedulement_cause, r.newtime,  r.newdate FROM rescheduled_alerts r INNER JOIN alerts a ON r.alertId=a.alertId');
            $results=$this->db->resultSet();
            return $results;
        }

        public function getReschedulementFields()
        {
            $this->db->query("SELECT DISTINCT column_name AS columns FROM INFORMATION_SCHEMA.columns WHERE TABLE_NAME IN('rescheduled_alerts', 'alerts')");
            $results=$this->db->resultSet();
            return $results;
        }

        public function searchReschedulements($searchterm, $searchfield)
        {
            if($searchterm==''){
                $this->db->query('SELECT a.*, r.reschedulement_cause, r.newdate, r.newtime FROM rescheduled_alerts r
                      INNER JOIN alerts a ON r.alertId=a.alertId');
            }else{
                switch ($searchfield) {
                    case 'alertId':
                        $this->db->query('SELECT a.*, r.reschedulement_cause, r.newdate, r.newtime FROM rescheduled_alerts r
                        INNER JOIN alerts a ON r.alertId=a.alertId WHERE a.alertId = :searchTerm');
                        break;
                    case 'trainId':
                        $this->db->query('SELECT a.*, r.reschedulement_cause, r.newdate, r.newtime FROM rescheduled_alerts r
                        INNER JOIN alerts a ON r.alertId=a.alertId WHERE a.trainId = :searchTerm');
                        break;
                    case 'moderatorId':
                        $this->db->query('SELECT a.*, r.reschedulement_cause, r.newdate, r.newtime FROM rescheduled_alerts r
                        INNER JOIN alerts a ON r.alertId=a.alertId WHERE a.moderatorId = :searchTerm');
                        break;
                    case 'date':
                        $this->db->query('SELECT a.*, r.reschedulement_cause, r.newdate, r.newtime FROM rescheduled_alerts r
                        INNER JOIN alerts a ON r.alertId=a.alertId WHERE a.date = :searchTerm');
                        break;
                    case 'time':
                        $this->db->query('SELECT a.*, r.reschedulement_cause, r.newdate, r.newtime FROM rescheduled_alerts r
                        INNER JOIN alerts a ON r.alertId=a.alertId WHERE a.time = :searchTerm');
                        break;
                    case 'newtime':
                        $this->db->query('SELECT a.*, r.reschedulement_cause, r.newdate, r.newtime FROM rescheduled_alerts r
                        INNER JOIN alerts a ON r.alertId=a.alertId WHERE r.newdate = :searchTerm');
                        break;
                    case 'newdate':
                        $this->db->query('SELECT a.*, r.reschedulement_cause, r.newdate, r.newtime FROM rescheduled_alerts r
                        INNER JOIN alerts a ON r.alertId=a.alertId WHERE r.newtime = :searchTerm');
                        break;
                }
            }
                         
            $this->db->bind(':searchTerm',$searchterm);
            $results=$this->db->resultSet();
            return $results;
            
        }
        

        public function findReschedulementById($id) 
        {
            $this->db->query('SELECT a.*, r.reschedulement_cause FROM rescheduled_alerts r
             INNER JOIN alerts a ON a.alertId=r.alertId WHERE a.alertId=:alertId');
            $this->db->bind(":alertId",$id);
            $row=$this->db->single();
            return $row;

        }

        public function updateRescheduledAlert($data)
        {
            $this->db->query('UPDATE alerts SET trainId=:trainid WHERE alertid=:id');
            $this->db->bind(":trainid", $data['trainId']);
            $this->db->bind(":id", $data['alertId']);

            if($this->db->execute()){
                $this->db->query('UPDATE rescheduled_alerts SET reschedulement_cause=:rescheduledCause, newDate=:newDate, newtime=:newTime WHERE alertid=:id');
                $this->db->bind(":rescheduledCause", $data['rescheduledCause']);
                $this->db->bind(":newDate", $data['newDate']);
                $this->db->bind(":newTime", $data['newTime']);
                $this->db->bind(":id", $data['alertId']);

                if ($this->db->execute()) {
                    return true;
                }else{
                    return false;
                }
            }else{
                return false;
            }

        }

        public function deleteAlert($id)
        {
            $this->db->query("DELETE FROM alerts WHERE alertId=:id");
            $this->db->bind(":id",$id);
            if($this->db->execute()){
                return true;
            }else{
                return false;
            }

        }

        
    }