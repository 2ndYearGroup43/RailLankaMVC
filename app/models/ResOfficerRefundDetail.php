<?php 
	class ResOfficerRefundDetail {
		private $db;

		public function __construct() {
			$this->db = new Database;
		}

    public function views(){
		$this->db->query('SELECT * FROM refund');

		$results=$this->db->resultSet();
        return $results;
	}

	public function getRefundDetails($ticketId){
        $this->db->query('SELECT * FROM ticket WHERE ticketId=:ticketId');

        $this->db->bind(':ticketId', $ticketId);

        $row = $this->db->single();
        return $row;
    }
		
	}	