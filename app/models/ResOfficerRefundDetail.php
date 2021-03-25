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

    public function getJourneyDetails($ticketId){
        $this->db->query('SELECT r.JourneyDate, s1.name as srcName, s2.name as destName 
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

    public function getCompSeatDetails($ticketId){
        $this->db->query('SELECT s.seatNo, s.compartmentNo
            FROM seat s 
            INNER JOIN ticket t
            ON t.ticketId=s.reservationNo 
            WHERE t.ticketId=:ticketId');

        $this->db->bind(':ticketId', $ticketId);

       $results=$this->db->resultSet();
        return $results;
    }
		
	}	