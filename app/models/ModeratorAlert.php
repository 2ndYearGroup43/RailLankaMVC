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
            $this->db->query("INSERT INTO alerts (date, time, trainId, issueType, moderatorId, type) VALUES(:insDate, :insTime, :trainId, :issueType, :modId, 'c')");
            $this->db->bind(':insDate', $data['insertedDate']);
            $this->db->bind(':insTime', $data['insertedTime']);
            $this->db->bind(':trainId', $data['trainId']);
            $this->db->bind(':modId', $data['moderatorId']);
            $this->db->bind(':issueType', $data['issueType']);
            

            if($this->db->execute()){
                $this->db->query('SELECT LAST_INSERT_ID() AS alertId');
                $resultId=[];
                $resultId=$this->db->resultSet();
                $this->db->query('INSERT INTO cancelled_alerts (alertId, cancellation_date, cancellation_cause) VALUES(:alertId, :cancelDate, :cancelcause)');
                $this->db->bind(':alertId', $resultId[0]->alertId);
                $this->db->bind(':cancelcause', $data['cancelCause']);
                $this->db->bind(':cancelDate', $data['cancelDate']);
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
            $this->db->query("INSERT INTO alerts (date, time, trainId, moderatorId, issueType, type) VALUES(:insDate, :insTime, :trainId, :modId, :issueType, 'd')");
            $this->db->bind(':insDate', $data['insertedDate']);
            $this->db->bind(':insTime', $data['insertedTime']);
            $this->db->bind(':trainId', $data['trainId']);
            $this->db->bind(':modId', $data['moderatorId']);
            $this->db->bind(':issueType', $data['issueType']);

            if($this->db->execute()){
                $this->db->query('SELECT LAST_INSERT_ID() AS alertId');
                $resultId=[];
                $resultId=$this->db->resultSet();
                $this->db->query('INSERT INTO delayed_alerts (alertId, delaydate, delaytime, delay_cause) VALUES(:alertId, :delaydate, :delaytime, :delaycause)');
                $this->db->bind(':alertId', $resultId[0]->alertId);
                $this->db->bind(':delaydate', $data['delayDate']);
                $this->db->bind(':delaydate', $data['delayDate']);
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
            $this->db->query("INSERT INTO alerts (date, time, trainId, moderatorId, issueType, type) VALUES(:insDate, :insTime, :trainId, :modId, :issueType, 'r')");
            $this->db->bind(':insDate', $data['insertedDate']);
            $this->db->bind(':insTime', $data['insertedTime']);
            $this->db->bind(':trainId', $data['trainId']);
            $this->db->bind(':modId', $data['moderatorId']);
            $this->db->bind(':issueType', $data['issueType']);

            if($this->db->execute()){
                $this->db->query('SELECT LAST_INSERT_ID() AS alertId');
                $resultId=[];
                $resultId=$this->db->resultSet();
                $this->db->query('INSERT INTO rescheduled_alerts (alertId, olddate, newdate, newtime, reschedulement_cause)
                 VALUES(:alertId, :olddate, :newdate, :newtime, :rescheduledcause)');
                $this->db->bind(':alertId', $resultId[0]->alertId);
                $this->db->bind(':olddate', $data['oldDate']);
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

        public function countCancellations(){
            $this->db->query('SELECT COUNT(*) AS count FROM cancelled_alerts c INNER JOIN alerts a ON c.alertId=a.alertId');
            $result=$this->db->single();
            return $result->count;
        }

        public function displayCancellations($start, $limit)
        {
            $this->db->query('SELECT a.*,c.cancellation_cause, c.cancellation_date FROM cancelled_alerts c INNER JOIN alerts a ON c.alertId=a.alertId ORDER BY a.date DESC, a.time DESC LIMIT :start, :limit');
            $this->db->bind(':start', $start);
            $this->db->bind(':limit', $limit);
            $results=$this->db->resultSet();
            return $results;
        }

        public function getCancellationFields()
        {
            $this->db->query("SELECT DISTINCT column_name AS columns FROM INFORMATION_SCHEMA.columns WHERE TABLE_NAME IN('cancelled_alerts', 'alerts')");
            $results=$this->db->resultSet();
            return $results;
        }

        public function countFilteredCancellations($searchterm, $searchfield){
            if($searchterm==''){
                $this->db->query('SELECT COUNT(*) AS count FROM cancelled_alerts c
                      INNER JOIN alerts a ON c.alertId=a.alertId');
            }else{
                switch ($searchfield) {
                    case 'alertId':
                        $this->db->query('SELECT COUNT(*) AS count FROM cancelled_alerts c
                        INNER JOIN alerts a ON c.alertId=a.alertId WHERE a.alertId = :searchTerm');
                        break;
                    case 'trainId':
                        $this->db->query('SELECT COUNT(*) AS count FROM cancelled_alerts c
                        INNER JOIN alerts a ON c.alertId=a.alertId WHERE a.trainId = :searchTerm');
                        break;
                    case 'issuetype':
                        $this->db->query('SELECT COUNT(*) AS count FROM cancelled_alerts c
                        INNER JOIN alerts a ON c.alertId=a.alertId WHERE a.issueType = :searchTerm');
                        break;
                    case 'moderatorId':
                        $this->db->query('SELECT COUNT(*) AS count FROM cancelled_alerts c
                        INNER JOIN alerts a ON c.alertId=a.alertId WHERE a.moderatorId = :searchTerm');
                        break;
                    case 'cancellation_date':
                        $this->db->query('SELECT COUNT(*) AS count FROM cancelled_alerts c
                        INNER JOIN alerts a ON c.alertId=a.alertId WHERE c.cancellation_date = :searchTerm');
                        break;
                    case 'date':
                        $this->db->query('SELECT COUNT(*) AS count FROM cancelled_alerts c
                        INNER JOIN alerts a ON c.alertId=a.alertId WHERE a.date = :searchTerm');
                        break;
                    case 'time':
                        $this->db->query('SELECT COUNT(*) AS count FROM cancelled_alerts c
                        INNER JOIN alerts a ON c.alertId=a.alertId WHERE a.time = :searchTerm');
                        break;
                }
            }



            $this->db->bind(':searchTerm',$searchterm);
            $result=$this->db->single();
            return $result->count;

        }

        public function searchCancellations($searchterm, $searchfield , $start, $limit)
        {
            if($searchterm==''){
                $this->db->query('SELECT a.*, c.cancellation_date, c.cancellation_cause FROM cancelled_alerts c
                      INNER JOIN alerts a ON c.alertId=a.alertId ORDER BY a.date DESC, a.time DESC LIMIT :start, :limit');
                $this->db->bind(':start', $start);
                $this->db->bind(':limit', $limit);
                $results=$this->db->resultSet();
                return $results;

            }else{
                switch ($searchfield) {
                    case 'alertId':
                        $this->db->query('SELECT a.*, c.cancellation_date, c.cancellation_cause FROM cancelled_alerts c
                        INNER JOIN alerts a ON c.alertId=a.alertId WHERE a.alertId = :searchTerm ORDER BY a.date DESC, a.time DESC LIMIT :start, :limit');
                        break;
                    case 'trainId':
                        $this->db->query('SELECT a.*, c.cancellation_date, c.cancellation_cause FROM cancelled_alerts c
                        INNER JOIN alerts a ON c.alertId=a.alertId WHERE a.trainId = :searchTerm ORDER BY a.date DESC, a.time DESC LIMIT :start, :limit');
                        break;
                    case 'issuetype':
                        $this->db->query('SELECT a.*, c.cancellation_date, c.cancellation_cause FROM cancelled_alerts c
                        INNER JOIN alerts a ON c.alertId=a.alertId WHERE a.issueType = :searchTerm ORDER BY a.date DESC, a.time DESC LIMIT :start, :limit');
                        break;
                    case 'moderatorId':
                        $this->db->query('SELECT a.*, c.cancellation_date, c.cancellation_cause FROM cancelled_alerts c
                        INNER JOIN alerts a ON c.alertId=a.alertId WHERE a.moderatorId = :searchTerm ORDER BY a.date DESC, a.time DESC LIMIT :start, :limit');
                        break;
                    case 'cancellation_date':
                        $this->db->query('SELECT a.*, c.cancellation_date, c.cancellation_cause FROM cancelled_alerts c
                        INNER JOIN alerts a ON c.alertId=a.alertId WHERE c.cancellation_date = :searchTerm ORDER BY a.date DESC, a.time DESC LIMIT :start, :limit');
                        break;
                    case 'date':
                        $this->db->query('SELECT a.*, c.cancellation_date, c.cancellation_cause FROM cancelled_alerts c
                        INNER JOIN alerts a ON c.alertId=a.alertId WHERE a.date = :searchTerm ORDER BY a.date DESC, a.time DESC LIMIT :start, :limit');
                        break;
                    case 'time':
                        $this->db->query('SELECT a.*, c.cancellation_date, c.cancellation_cause FROM cancelled_alerts c
                        INNER JOIN alerts a ON c.alertId=a.alertId WHERE a.time = :searchTerm ORDER BY a.date DESC, a.time DESC LIMIT :start, :limit');
                        break;
                }
            }
                         
            
            
            $this->db->bind(':searchTerm',$searchterm);
            $this->db->bind(':start', $start);
            $this->db->bind(':limit', $limit);
            $results=$this->db->resultSet();
            return $results;
            
        }

        public function findCancellationById($id) 
        {
            $this->db->query('SELECT a.*, c.cancellation_cause, c.cancellation_date FROM cancelled_alerts c
             INNER JOIN alerts a ON a.alertId=c.alertId WHERE a.alertId=:alertId');
            $this->db->bind(":alertId",$id);
            $row=$this->db->single();
            return $row;

        }

        public function updateCancellationAlert($data)
        {
            $this->db->query('UPDATE alerts SET trainId=:trainid, issueType=:issueType WHERE alertid=:id');
            $this->db->bind(":trainid", $data['trainId']);
            $this->db->bind(":id", $data['alertId']);
            $this->db->bind(':issueType', $data['issueType']);

            if($this->db->execute()){
                $this->db->query('UPDATE cancelled_alerts SET cancellation_cause=:cancelCause, cancellation_date=:cancelDate WHERE alertid=:id');
                $this->db->bind(":cancelCause", $data['cancelCause']);
                $this->db->bind("cancelDate", $data['cancelDate']);
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



        public function displayDelays($start, $limit)
        {
            $this->db->query('SELECT a.*,d.delay_cause, d.delaytime, d.delaydate FROM delayed_alerts d INNER JOIN
    alerts a ON d.alertId=a.alertId ORDER BY a.date DESC, a.time DESC LIMIT :start, :limit');
            $this->db->bind(':start', $start);
            $this->db->bind(':limit', $limit);
            $results=$this->db->resultSet();
            return $results;
        }

        public function countDelays(){
            $this->db->query('SELECT COUNT(*) AS count FROM delayed_alerts d INNER JOIN alerts a ON d.alertId=a.alertId');
            $result=$this->db->single();
            return $result->count;
        }

        public function getDelayFields()
        {
            $this->db->query("SELECT DISTINCT column_name AS columns FROM INFORMATION_SCHEMA.columns WHERE TABLE_NAME IN('delayed_alerts', 'alerts')");
            $results=$this->db->resultSet();
            return $results;
        }

        public function searchDelays($searchterm, $searchfield, $start, $limit)
        {
            if($searchterm==''){
                $this->db->query('SELECT a.*, d.delay_cause, d.delaytime, d.delaydate FROM delayed_alerts d
                      INNER JOIN alerts a ON d.alertId=a.alertId ORDER BY a.date DESC, a.time DESC LIMIT :start, :limit');

                $this->db->bind(':start', $start);
                $this->db->bind(':limit', $limit);
                $results=$this->db->resultSet();
                return $results;
            }else{
                switch ($searchfield) {
                    case 'alertId':
                        $this->db->query('SELECT a.*, d.delay_cause, d.delaydate, d.delaytime FROM delayed_alerts d
                        INNER JOIN alerts a ON d.alertId=a.alertId WHERE a.alertId = :searchTerm ORDER BY a.date DESC, a.time DESC LIMIT :start, :limit');
                        break;
                    case 'trainId':
                        $this->db->query('SELECT a.*, d.delay_cause, d.delaydate, d.delaytime FROM delayed_alerts d
                        INNER JOIN alerts a ON d.alertId=a.alertId WHERE a.trainId = :searchTerm ORDER BY a.date DESC, a.time DESC LIMIT :start, :limit');
                        break;
                    case 'issuetype':
                        $this->db->query('SELECT a.*, d.delay_cause, d.delaydate, d.delaytime FROM delayed_alerts d
                        INNER JOIN alerts a ON d.alertId=a.alertId WHERE a.issueType = :searchTerm ORDER BY a.date DESC, a.time DESC LIMIT :start, :limit');
                        break;
                    case 'moderatorId':
                        $this->db->query('SELECT a.*, d.delay_cause, d.delaydate, d.delaytime FROM delayed_alerts d
                        INNER JOIN alerts a ON d.alertId=a.alertId WHERE a.moderatorId = :searchTerm ORDER BY a.date DESC, a.time DESC LIMIT :start, :limit');
                        break;
                    case 'date':
                        $this->db->query('SELECT a.*,d.delay_cause, d.delaydate, d.delaytime FROM delayed_alerts d
                        INNER JOIN alerts a ON d.alertId=a.alertId WHERE a.date = :searchTerm ORDER BY a.date DESC, a.time DESC LIMIT :start, :limit');
                        break;
                    case 'time':
                        $this->db->query('SELECT a.*,d.delay_cause, d.delaydate, d.delaytime FROM delayed_alerts d
                        INNER JOIN alerts a ON d.alertId=a.alertId WHERE a.time = :searchTerm ORDER BY a.date DESC, a.time DESC LIMIT :start, :limit');
                        break;
                    case 'delaydate':
                        $this->db->query('SELECT a.*,d.delay_cause, d.delaydate, d.delaytime FROM delayed_alerts d
                        INNER JOIN alerts a ON d.alertId=a.alertId WHERE d.delaydate = :searchTerm ORDER BY a.date DESC, a.time DESC LIMIT :start, :limit');
                        break;
                    case 'delaytime':
                        $this->db->query('SELECT a.*,d.delay_cause, d.delaydate, d.delaytime FROM delayed_alerts d
                        INNER JOIN alerts a ON d.alertId=a.alertId WHERE d.delaytime = :searchTerm ORDER BY a.date DESC, a.time DESC LIMIT :start, :limit');
                        break;
                }
            }
                         
            $this->db->bind(':searchTerm',$searchterm);
            $this->db->bind(':start', $start);
            $this->db->bind(':limit', $limit);
            $results=$this->db->resultSet();
            return $results;
            
        }
        public function countFilteredDelays($searchterm, $searchfield){
            if($searchterm==''){
                $this->db->query("SELECT COUNT(*) AS count FROM delayed_alerts d INNER JOIN alerts a ON d.alertId=a.alertId");
            }else{
                switch ($searchfield) {
                    case 'alertId':
                        $this->db->query('SELECT COUNT(*) AS count FROM delayed_alerts d
                        INNER JOIN alerts a ON d.alertId=a.alertId WHERE a.alertId = :searchTerm');
                        break;
                    case 'trainId':
                        $this->db->query('SELECT COUNT(*) AS count FROM delayed_alerts d
                        INNER JOIN alerts a ON d.alertId=a.alertId WHERE a.trainId = :searchTerm');
                        break;
                    case 'issuetype':
                        $this->db->query('SELECT COUNT(*) AS count FROM delayed_alerts d
                        INNER JOIN alerts a ON d.alertId=a.alertId WHERE a.issueType = :searchTerm');
                        break;
                    case 'moderatorId':
                        $this->db->query('SELECT COUNT(*) AS count FROM delayed_alerts d
                        INNER JOIN alerts a ON d.alertId=a.alertId WHERE a.moderatorId = :searchTerm');
                        break;
                    case 'date':
                        $this->db->query('SELECT COUNT(*) AS count FROM delayed_alerts d
                        INNER JOIN alerts a ON d.alertId=a.alertId WHERE a.date = :searchTerm');
                        break;
                    case 'time':
                        $this->db->query('SELECT COUNT(*) AS count FROM delayed_alerts d
                        INNER JOIN alerts a ON d.alertId=a.alertId WHERE a.time = :searchTerm');
                        break;
                    case 'delaydate':
                        $this->db->query('SELECT COUNT(*) AS count FROM delayed_alerts d
                        INNER JOIN alerts a ON d.alertId=a.alertId WHERE d.delaydate = :searchTerm');
                        break;
                    case 'delaytime':
                        $this->db->query('SELECT COUNT(*) AS count FROM delayed_alerts d
                        INNER JOIN alerts a ON d.alertId=a.alertId WHERE d.delaytime = :searchTerm');
                        break;
                }
            }

            $this->db->bind(':searchTerm',$searchterm);
            $result=$this->db->single();
            return $result->count;
        }


        

        public function findDelayById($id) 
        {
            $this->db->query('SELECT a.*, d.delay_cause, d.delaydate, d.delaytime FROM delayed_alerts d
             INNER JOIN alerts a ON a.alertId=d.alertId WHERE a.alertId=:alertId');
            $this->db->bind(":alertId",$id);
            $row=$this->db->single();
            return $row;

        }

        public function updateDelayAlert($data)
        {
            $this->db->query('UPDATE alerts SET trainId=:trainid, issueType=:issueType WHERE alertid=:id');
            $this->db->bind(":trainid", $data['trainId']);
            $this->db->bind(":id", $data['alertId']);
            $this->db->bind(':issueType', $data['issueType']);


            if($this->db->execute()){
                $this->db->query('UPDATE delayed_alerts SET delay_cause=:delayCause, delaydate=:delayDate, delaytime=:delayTime WHERE alertid=:id');
                $this->db->bind(":delayCause", $data['delayCause']);
                $this->db->bind(':delayDate', $data['delayDate']);
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





        public function displayReschedulements($start, $limit)
        {
            $this->db->query('SELECT a.*,r.reschedulement_cause, r.olddate, r.newtime,  r.newdate FROM rescheduled_alerts r INNER JOIN alerts a ON r.alertId=a.alertId ORDER BY a.date DESC, a.time DESC LIMIT :start, :limit');
            $this->db->bind(':start', $start);
            $this->db->bind(':limit', $limit);
            $results=$this->db->resultSet();
            return $results;
        }

        public function countReshedulements(){
            $this->db->query('SELECT COUNT(*) AS count FROM rescheduled_alerts r INNER JOIN alerts a ON r.alertId=a.alertId');
            $result=$this->db->single();
            return $result->count;
        }

        public function getReschedulementFields()
        {
            $this->db->query("SELECT DISTINCT column_name AS columns FROM INFORMATION_SCHEMA.columns WHERE TABLE_NAME IN('rescheduled_alerts', 'alerts')");
            $results=$this->db->resultSet();
            return $results;
        }

        public function searchReschedulements($searchterm, $searchfield, $start, $limit)
        {
            if($searchterm==''){
                $this->db->query('SELECT a.*, r.reschedulement_cause, r.olddate, r.newdate, r.newtime FROM rescheduled_alerts r
                      INNER JOIN alerts a ON r.alertId=a.alertId ORDER BY a.date DESC LIMIT :start, :limit');
                $this->db->bind(':start', $start);
                $this->db->bind(':limit', $limit);
                $results=$this->db->resultSet();
                return $results;
            }else{
                switch ($searchfield) {
                    case 'alertId':
                        $this->db->query('SELECT a.*, r.reschedulement_cause, r.olddate, r.newdate, r.newtime FROM rescheduled_alerts r
                        INNER JOIN alerts a ON r.alertId=a.alertId WHERE a.alertId = :searchTerm ORDER BY a.date DESC, a.time DESC LIMIT :start, :limit');
                        break;
                    case 'trainId':
                        $this->db->query('SELECT a.*, r.reschedulement_cause, r.olddate, r.newdate, r.newtime FROM rescheduled_alerts r
                        INNER JOIN alerts a ON r.alertId=a.alertId WHERE a.trainId = :searchTerm ORDER BY a.date DESC, a.time DESC LIMIT :start, :limit');
                        break;
                    case 'issuetype':
                        $this->db->query('SELECT a.*, r.reschedulement_cause, r.olddate, r.newdate, r.newtime FROM rescheduled_alerts r
                        INNER JOIN alerts a ON r.alertId=a.alertId WHERE a.issueType = :searchTerm ORDER BY a.date DESC, a.time DESC LIMIT :start, :limit');
                        break;
                    case 'moderatorId':
                        $this->db->query('SELECT a.*, r.reschedulement_cause, r.olddate, r.newdate, r.newtime FROM rescheduled_alerts r
                        INNER JOIN alerts a ON r.alertId=a.alertId WHERE a.moderatorId = :searchTerm ORDER BY a.date DESC, a.time DESC LIMIT :start, :limit');
                        break;
                    case 'date':
                        $this->db->query('SELECT a.*, r.reschedulement_cause, r.olddate, r.newdate, r.newtime FROM rescheduled_alerts r
                        INNER JOIN alerts a ON r.alertId=a.alertId WHERE a.date = :searchTerm ORDER BY a.date DESC, a.time DESC LIMIT :start, :limit');
                        break;
                    case 'time':
                        $this->db->query('SELECT a.*, r.reschedulement_cause, r.olddate, r.newdate, r.newtime FROM rescheduled_alerts r
                        INNER JOIN alerts a ON r.alertId=a.alertId WHERE a.time = :searchTerm ORDER BY a.date DESC, a.time DESC LIMIT :start, :limit');
                        break;
                    case 'olddate':
                        $this->db->query('SELECT a.*, r.reschedulement_cause, r.olddate, r.newdate, r.newtime FROM rescheduled_alerts r
                        INNER JOIN alerts a ON r.alertId=a.alertId WHERE r.olddate = :searchTerm ORDER BY a.date DESC, a.time DESC LIMIT :start, :limit');
                        break;
                    case 'newdate':
                        $this->db->query('SELECT a.*, r.reschedulement_cause, r.olddate, r.newdate, r.newtime FROM rescheduled_alerts r
                        INNER JOIN alerts a ON r.alertId=a.alertId WHERE r.newdate = :searchTerm ORDER BY a.date DESC, a.time DESC LIMIT :start, :limit');
                        break;
                    case 'newtime':
                        $this->db->query('SELECT a.*, r.reschedulement_cause, r.olddate, r.newdate, r.newtime FROM rescheduled_alerts r
                        INNER JOIN alerts a ON r.alertId=a.alertId WHERE r.newtime = :searchTerm ORDER BY a.date DESC, a.time DESC LIMIT :start, :limit');
                        break;
                }
            }
                         
            $this->db->bind(':searchTerm',$searchterm);
            $this->db->bind(':start', $start);
            $this->db->bind(':limit', $limit);
            $results=$this->db->resultSet();
            return $results;
            
        }

        public function countFilteredReshedulements($searchterm, $searchfield){
            if($searchterm==''){
                $this->db->query('SELECT COUNT(*) AS count FROM rescheduled_alerts r
                      INNER JOIN alerts a ON r.alertId=a.alertId');
            }else{
                switch ($searchfield) {
                    case 'alertId':
                        $this->db->query('SELECT COUNT(*) AS count FROM rescheduled_alerts r
                        INNER JOIN alerts a ON r.alertId=a.alertId WHERE a.alertId = :searchTerm');
                        break;
                    case 'trainId':
                        $this->db->query('SELECT COUNT(*) AS count FROM rescheduled_alerts r
                        INNER JOIN alerts a ON r.alertId=a.alertId WHERE a.trainId = :searchTerm');
                        break;
                    case 'issuetype':
                        $this->db->query('SELECT COUNT(*) AS count FROM rescheduled_alerts r
                        INNER JOIN alerts a ON r.alertId=a.alertId WHERE a.issueType = :searchTerm');
                        break;
                    case 'moderatorId':
                        $this->db->query('SELECT COUNT(*) AS count FROM rescheduled_alerts r
                        INNER JOIN alerts a ON r.alertId=a.alertId WHERE a.moderatorId = :searchTerm');
                        break;
                    case 'date':
                        $this->db->query('SELECT COUNT(*) AS count FROM rescheduled_alerts r
                        INNER JOIN alerts a ON r.alertId=a.alertId WHERE a.date = :searchTerm');
                        break;
                    case 'time':
                        $this->db->query('SELECT COUNT(*) AS count FROM rescheduled_alerts r
                        INNER JOIN alerts a ON r.alertId=a.alertId WHERE a.time = :searchTerm');
                        break;
                    case 'olddate':
                        $this->db->query('SELECT COUNT(*) AS count FROM rescheduled_alerts r
                        INNER JOIN alerts a ON r.alertId=a.alertId WHERE r.olddate = :searchTerm');
                        break;
                    case 'newtime':
                        $this->db->query('SELECT COUNT(*) AS count FROM rescheduled_alerts r
                        INNER JOIN alerts a ON r.alertId=a.alertId WHERE r.newdate = :searchTerm');
                        break;
                    case 'newdate':
                        $this->db->query('SELECT COUNT(*) AS count FROM rescheduled_alerts r
                        INNER JOIN alerts a ON r.alertId=a.alertId WHERE r.newtime = :searchTerm');
                        break;
                }
            }

            $this->db->bind(':searchTerm',$searchterm);
            $result=$this->db->single();
            return $result->count;

        }
        

        public function findReschedulementById($id) 
        {
            $this->db->query('SELECT a.*, r.reschedulement_cause, r.olddate, r.newdate, r.newtime FROM rescheduled_alerts r
             INNER JOIN alerts a ON a.alertId=r.alertId WHERE a.alertId=:alertId');
            $this->db->bind(":alertId",$id);
            $row=$this->db->single();
            return $row;

        }

        public function updateRescheduledAlert($data)
        {
            $this->db->query('UPDATE alerts SET trainId=:trainid, issueType=:issueType WHERE alertid=:id');
            $this->db->bind(":trainid", $data['trainId']);
            $this->db->bind(":id", $data['alertId']);
            $this->db->bind(':issueType', $data['issueType']);

            if($this->db->execute()){
                $this->db->query('UPDATE rescheduled_alerts SET reschedulement_cause=:rescheduledCause, olddate=:oldDate, newdate=:newDate, newtime=:newTime WHERE alertid=:id');
                $this->db->bind(":rescheduledCause", $data['reschedulementCause']);;
                $this->db->bind(":oldDate", $data['oldDate']);
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


        public function getTrains()
        {
            $this->db->query('SELECT trainId, name FROM train');
            $results=$this->db->resultSet();
            return $results;
        }

        public function getCancelCount($date=0){
            if($date==0){
                $date=date("Y-m-d");
            }
            $this->db->query('SELECT COUNT(*) AS count FROM cancelled_alerts c 
    INNER JOIN alerts a ON a.alertId=c.alertId
    WHERE c.cancellation_date=:date');
            $this->db->bind(':date', $date);
            $row=$this->db->single();
            return $row->count;
        }

        public function getDelayCount($date=0){
            if($date==0){
                $date=date("Y-m-d");
            }
            $this->db->query('SELECT COUNT(*) AS count FROM delayed_alerts d 
    INNER JOIN alerts a ON a.alertId=d.alertId
    WHERE d.delaydate=:date');
            $this->db->bind(':date', $date);
            $row=$this->db->single();
            return $row->count;
        }

        public function getReschCount($date=0){
            if($date==0){
                $date=date("Y-m-d");
            }
            $this->db->query('SELECT COUNT(*) AS count FROM rescheduled_alerts r
    INNER JOIN alerts a ON a.alertId=r.alertId
    WHERE r.olddate=:date');
            $this->db->bind(':date', $date);
            $row=$this->db->single();
            return $row->count;
        }

        public function getIssueCounts($date=0){
            if($date==0){
                $date=date("Y-m-d");
            }
            $issueCounts=[
                'environmental'=>'',
                'technical'=>'',
                'railroad'=>'',
                'unspecified'=>'',
                'other'=>''
            ];
            $this->db->query("SELECT COUNT(*) AS count FROM alerts a INNER JOIN cancelled_alerts c ON a.alertId=c.alertId 
            WHERE a.issuetype='Environmental' AND c.cancellation_date=:date");
            $this->db->bind(':date', $date);
            $cEnv=$this->db->single()->count;
            $this->db->query("SELECT COUNT(*) AS count FROM alerts a INNER JOIN delayed_alerts d ON a.alertId=d.alertId 
            WHERE a.issuetype='Environmental' AND d.delaydate=:date");
            $this->db->bind(':date', $date);
            $dEnv=$this->db->single()->count;
            $this->db->query("SELECT COUNT(*) AS count FROM alerts a INNER JOIN rescheduled_alerts r ON a.alertId=r.alertId 
            WHERE a.issuetype='Environmental' AND r.olddate=:date");
            $this->db->bind(':date', $date);
            $rEnv=$this->db->single()->count;
            $issueCounts['environmental']=$cEnv+$dEnv+$rEnv;


            $this->db->query("SELECT COUNT(*) AS count FROM alerts a INNER JOIN cancelled_alerts c ON a.alertId=c.alertId
            WHERE a.issuetype='Technical' AND c.cancellation_date=:date");
            $this->db->bind(':date', $date);
            $cTech=$this->db->single()->count;
            $this->db->query("SELECT COUNT(*) AS count FROM alerts a INNER JOIN delayed_alerts d ON a.alertId=d.alertId
            WHERE a.issuetype='Technical' AND d.delaydate=:date");
            $this->db->bind(':date', $date);
            $dTech=$this->db->single()->count;
            $this->db->query("SELECT COUNT(*) AS count FROM alerts a INNER JOIN rescheduled_alerts r ON a.alertId=r.alertId
            WHERE a.issuetype='Technical' AND r.olddate=:date");
            $this->db->bind(':date', $date);
            $rTech=$this->db->single()->count;
            $issueCounts['technical']=$cTech+$dTech+$rTech;

            $this->db->query("SELECT COUNT(*) AS count FROM alerts a INNER JOIN cancelled_alerts c ON a.alertId=c.alertId
            WHERE a.issuetype='Rail Road' AND c.cancellation_date=:date");
            $this->db->bind(':date', $date);
            $cRRoad=$this->db->single()->count;
            $this->db->query("SELECT COUNT(*) AS count FROM alerts a INNER JOIN delayed_alerts d ON a.alertId=d.alertId
            WHERE a.issuetype='Rail Road' AND d.delaydate=:date");
            $this->db->bind(':date', $date);
            $dRRoad=$this->db->single()->count;
            $this->db->query("SELECT COUNT(*) AS count FROM alerts a INNER JOIN rescheduled_alerts r ON a.alertId=r.alertId
            WHERE a.issuetype='Rail Road' AND r.olddate=:date");
            $this->db->bind(':date', $date);
            $rRRoad=$this->db->single()->count;
            $issueCounts['railroad']=$cRRoad+$dRRoad+$rRRoad;

            $this->db->query("SELECT COUNT(*) AS count FROM alerts a INNER JOIN cancelled_alerts c ON a.alertId=c.alertId
            WHERE a.issuetype='Unspecified' AND c.cancellation_date=:date");
            $this->db->bind(':date', $date);
            $cUnspec=$this->db->single()->count;
            $this->db->query("SELECT COUNT(*) AS count FROM alerts a INNER JOIN delayed_alerts d ON a.alertId=d.alertId
            WHERE a.issuetype='Unspecified' AND d.delaydate=:date");
            $this->db->bind(':date', $date);
            $dUnspec=$this->db->single()->count;
            $this->db->query("SELECT COUNT(*) AS count FROM alerts a INNER JOIN rescheduled_alerts r ON a.alertId=r.alertId
            WHERE a.issuetype='Unspecified' AND r.olddate=:date");
            $this->db->bind(':date', $date);
            $rUnspec=$this->db->single()->count;
            $issueCounts['unspecified']=$cUnspec+$dUnspec+$rUnspec;


            $this->db->query("SELECT COUNT(*) AS count FROM alerts a INNER JOIN cancelled_alerts c ON a.alertId=c.alertId
            WHERE a.issuetype='Other' AND c.cancellation_date=:date");
            $this->db->bind(':date', $date);
            $cOther=$this->db->single()->count;
            $this->db->query("SELECT COUNT(*) AS count FROM alerts a INNER JOIN delayed_alerts d ON a.alertId=d.alertId
            WHERE a.issuetype='Other' AND d.delaydate=:date");
            $this->db->bind(':date', $date);
            $dOther=$this->db->single()->count;
            $this->db->query("SELECT COUNT(*) AS count FROM alerts a INNER JOIN rescheduled_alerts r ON a.alertId=r.alertId
            WHERE a.issuetype='Other' AND r.olddate=:date");
            $this->db->bind(':date', $date);
            $rOther=$this->db->single()->count;
            $issueCounts['other']=$cOther+$rOther+$dOther;

            return $issueCounts;

        }

        public function getDays($trainId){
            $this->db->query('SELECT * FROM availabledays WHERE trainid=:trainId');
            $this->db->bind(':trainId', $trainId);
            $row=$this->db->single();
            return $row;
        }


        //subscriptions

        public function  getSubscriptionList($trainId){
            $this->db->query('SELECT u.email, p.*, s.trainId FROM users u 
    INNER JOIN passenger p ON u.userId=p.userid 
    INNER JOIN subscriptions s
    ON s.passengerId=p.passengerId WHERE s.trainId=:trainId');
            $this->db->bind(':trainId', $trainId);
            $results=$this->db->resultSet();
            return $results;
        }

        public  function getTrainDetails($trainId){
            $this->db->query('SELECT t.*, src.name AS src_name, dest.name AS dest_name FROM train t 
    INNER JOIN station src ON src.stationID=t.src_station
    INNER JOIN station dest ON dest.stationID=t.dest_station WHERE t.trainId=:trainId');
            $this->db->bind(':trainId', $trainId);
            $train=$this->db->single();
            return $train;
        }


        
    }