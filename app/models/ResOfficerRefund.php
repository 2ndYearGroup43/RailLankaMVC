<?php 
	class ResOfficerRefund {
		private $db;

		public function __construct() {
			$this->db = new Database;
		}

	public function refund($data){
		$this->db->query('INSERT INTO refund (refundNo, refundDate, refundTime, ticketId, officerId) VALUES (:refundNo, :refundDate, :refundTime, :ticketId, :officerId)');

		$this->db->bind(':refundNo', $data['refundNo']);
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
        $this->db->query("SELECT ticketId FROM ticket ORDER BY ticketId ASC");
        $results=$this->db->resultSet();
        return $results;
    }

    public function checkDate($ticketId){
            $this->db->query('SELECT t.ticketId, t.trainId, t.seatNo, r.JourneyDate AS seat_date, a.alertId, a.cancelled_date, c.alertId AS cancelled_alertId 
			FROM ticket t 
			INNER JOIN seat s 
			ON t.trainId=s.trainId 
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
            $this->db->query('SELECT t.ticketId, t.nic, p.userid, u.email 
			FROM ticket t 
			INNER JOIN passenger p 
			ON t.nic=p.nic 
			INNER JOIN  users u 
			ON p.userid=u.userid 
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

	}
