<?php 
	class ResOfficerRefund {
		private $db;

		public function __construct() {
			$this->db = new Database;
		}

	public function refund($data){
		$this->db->query('INSERT INTO refund (refundDate, refundTime, ticketId, officerId) VALUES (:refundDate, :refundTime, :ticketId, :officerId)');

		$this->db->bind(':refundDate', $data['refundDate']);		
		$this->db->bind(':refundTime', $data['refundTime']);
		$this->db->bind(':ticketId', $data['ticketId']);
		$this->db->bind(':officerId', $data['officerId']);

		if($this->db->execute()){
			return true;
		}else{
			return false;
		}
	}

	public function findResofficerById($id){
            $this->db->query('SELECT m.*, u.email FROM reservation_officer m INNER JOIN users u ON m.userId=u.userId WHERE m.userId=:userId');
            $this->db->bind(":userId",$id);
            $row=$this->db->single();
            return $row; 
    }

    public function getTicketId(){
        $this->db->query("SELECT DISTINCT ticketId FROM ticket ORDER BY ticketId ASC");
        $results=$this->db->resultSet();
        return $results;
    }

    public function checkDate($ticketId){
            $this->db->query('SELECT t.ticketId, r.journeyDate AS seat_date, c.cancellation_date as cancelled_date, c.alertId AS cancelled_alertId 
			FROM ticket t 
			INNER JOIN seat s 
			ON t.ticketId=s.reservationNo 
			INNER JOIN  alerts a 
			ON t.trainId=a.trainId 
			INNER JOIN  cancelled_alerts c 
			ON a.alertId=c.alertId 
            INNER JOIN reservation r
            ON r.reservationNo=s.reservationNo WHERE t.ticketId=:ticketId');

            $this->db->bind(":ticketId",$ticketId);
            $row=$this->db->single();
            return $row; 

    }

    public function getPassengerEmail($ticketId){
            $this->db->query('SELECT u.email
			FROM ticket t 
			INNER JOIN passenger p 
			ON t.passengerId=p.passengerId 
			INNER JOIN  users u 
			ON p.userid=u.userid 
            WHERE t.ticketId=:ticketId');

            $this->db->bind(":ticketId",$ticketId);
            $row=$this->db->single();
            return $row; 

    }

    public function getUnregisteredPassengerEmail($ticketId){
            $this->db->query('SELECT up.email
            FROM ticket t 
            INNER JOIN unregistered_passenger up 
            ON t.uPassenger_id =up.uPassenger_id  
            WHERE t.ticketId=:ticketId');

            $this->db->bind(":ticketId",$ticketId);
            $row=$this->db->single();
            return $row; 

    }

    public function getTicketDetails($ticketId){
            $this->db->query('SELECT * FROM ticket WHERE ticketId=:ticketId');

            $this->db->bind(":ticketId",$ticketId);
            $row=$this->db->single();
            return $row; 

    }

    public function getRefundDetails($ticketId){
        $this->db->query('SELECT * FROM ticket WHERE ticketId=:ticketId');

        $this->db->bind(':ticketId', $ticketId);

        $row = $this->db->single();
        return $row;
    }
    
    public function checkUnregisteredPassenger($ticketId){
        $this->db->query('SELECT passengerId FROM ticket WHERE ticketId=:ticketId');

        $this->db->bind(':ticketId', $ticketId);

        $row = $this->db->single();
        return $row;

	}

    public function getJourneyDetails($ticketId){
        $this->db->query('SELECT r.journeyDate, s1.name as srcName, s2.name as destName 
            FROM ticket ti 
            INNER JOIN reservation r 
            ON ti.trainId=r.trainId
            INNER JOIN train tr
            ON tr.trainId=ti.trainId
            INNER JOIN station s1
            ON s1.stationID=tr.src_station 
            INNER JOIN station s2
            ON s2.stationID=tr.dest_station 
            WHERE ti.ticketId=:ticketId');

        $this->db->bind(':ticketId', $ticketId);

        $row = $this->db->single();
        return $row;
    }

    public function getTrainDetails($ticketId){
        $this->db->query('SELECT tr.name
            FROM ticket t 
            INNER JOIN train tr
            ON t.trainId=tr.trainId 
            WHERE t.ticketId=:ticketId');

        $this->db->bind(':ticketId', $ticketId);

        $row = $this->db->single();
        return $row;
    }

    public function checkTicketId($ticketId){

        $this->db->query('SELECT COUNT(*) as count FROM refund WHERE ticketId = :ticketId');

        $this->db->bind(':ticketId', $ticketId);

        $results=array();
        $results=$this->db->resultSet();
        $count=$results[0]->count;
        if($count>0){
            return true;
        }else{
            return false;
        }
    }

    public function checkRescheduledAlertDate($ticketId){
            $this->db->query('SELECT t.ticketId, r.journeyDate AS seat_date, rs.olddate as rescheduled_date, rs.alertId AS rescheduled_alertId 
            FROM ticket t 
            INNER JOIN seat s 
            ON t.ticketId=s.reservationNo 
            INNER JOIN  alerts a 
            ON t.trainId=a.trainId 
            INNER JOIN   rescheduled_alerts rs 
            ON a.alertId=rs.alertId 
            INNER JOIN reservation r
            ON r.reservationNo=s.reservationNo WHERE t.ticketId=:ticketId');

            $this->db->bind(":ticketId",$ticketId);
            $row=$this->db->single();
            return $row; 

    }
}
