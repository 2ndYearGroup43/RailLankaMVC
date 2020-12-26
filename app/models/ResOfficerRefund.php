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
        $this->db->query("SELECT ticketId FROM ticket");
        $results=$this->db->resultSet();
        return $results;
    }	

	}
