<?php 
	class PassengerAccount {
		private $db;

		public function __construct() {
			$this->db = new Database;
		}

		public function findPassengerById($id)
        {
            $this->db->query('SELECT p.*, u.email FROM passenger p INNER JOIN users u ON p.userid=u.userid WHERE p.userid=:userid');
            $this->db->bind(":userid",$id);
            $row=$this->db->resultSet();
            return $row; 
        }

        public function updatePassenger($data)
        {
        	$this->db->query("UPDATE passenger SET firstname=:firstname, lastname=:lastname, mobileno=:mobileno, address_number=:address_number, street=:street, city=:city, country=:country WHERE userid=:userid");
        	$this->db->bind(":userid", $data['userId']);
        	$this->db->bind(":firstname", $data['firstName']);
        	$this->db->bind(":lastname", $data['lastName']);
        	$this->db->bind(":mobileno", $data['mobileNo']);
        	$this->db->bind(":address_number", $data['addressNo']);
        	$this->db->bind(":street", $data['street']);
        	$this->db->bind(":city", $data['city']);
        	$this->db->bind(":country", $data['country']);

        	if($this->db->execute()) {
        		return true;
        	} else {
        		return false;
        	}
        }

        public function checkPassword($userid,$password) {

            $this->db->query('SELECT * FROM users WHERE userid = :userid'); //changed users to passenger

            //bind values
            $this->db->bind(':userid', $userid);

            $row = $this->db->single();

            if(!empty($row)){

                $hashedPassword = $row->password;

                if (password_verify($password, $hashedPassword)) {
                    return true;
                } else {
                    return false;
                }
            } else {
                return false;
            }
            
        }

        public function updatePassword($userid, $password) {

            $this->db->query('UPDATE users SET password = :password WHERE userid = :userid');

            //bind values
            $this->db->bind(':userid', $userid);
            $this->db->bind(':password', $password);

            //Execute function
            if ($this->db->execute()) {
                return true;                
            } else {
                return false;
            }
        }


        //find passenger NIC
		public function findPassengerByNIC($nic) {
			//prepared statemnet
			var_dump($nic);
			$this->db->query('SELECT * FROM passenger WHERE nic = :nic'); //check all tables!!!!

			//Email param will be binded with the email variable
			$this->db->bind(':nic', $nic);

			$row = $this->db->single();

			//check if nic is already registered
			if(!empty($row)) {
				return true;
			} else {
				return false;
			}

		}

        public function getTickets($id){

            $this->db->query("SELECT r.*, s1.name AS srcName, s2.name AS destName FROM reservation r INNER JOIN station s1 ON s1.stationID=r.start_station INNER JOIN station s2 ON s2.stationID=r.dest_station WHERE r.nic=:id AND r.status='S'");

            //Email param will be binded with the email variable
            $this->db->bind(':id', $id);

            $results = $this->db->resultSet();

            //check if nic is already registered
            return $results;
        }


        //Get the reservation details of the relevant reservation 
        public function getReservationDetails($resNo){

            $this->db->query('SELECT r.*, s1.name AS srcName, s2.name AS destName FROM reservation r INNER JOIN station s1 ON s1.stationID=r.start_station INNER JOIN station s2 ON s2.stationID=r.dest_station WHERE r.reservationNo=:resNo');

            //bind values
            $this->db->bind(":resNo",$resNo);
            $row=$this->db->single();

            return $row; 
        }


        //Get the account details of the relevant customer - BOOKING REVIEW
        public function getAccountDetails($nic){

            $this->db->query('SELECT p.*, u.email FROM passenger p INNER JOIN users u ON p.userid=u.userid WHERE p.nic=:nic');

            //bind values
            $this->db->bind(":nic",$nic);
            $row=$this->db->single();

            return $row; 
        }

        //Function to get the seats of a relevant booking
        public function getBookedSeats($resNo){

            $this->db->query("SELECT s.seatNo, s.compartmentNo, s.classtype, s.price FROM seet s INNER JOIN reservation r ON s.reservationNo=r.reservationNo WHERE s.reservationNo=:resNo AND s.status='booked'");
            // $this->db->bind(':id',$id);
            // $this->db->bind(':nic',$nic);
            // $this->db->bind(':jdate',$date);
            $this->db->bind(':resNo',$resNo);
            $results = $this->db->resultSet();
            return $results;
        }

        public function getTrainDetails($id){

            $this->db->query('SELECT t.*, f.*, s1.name AS srcName, s2.name AS destName FROM train t INNER JOIN fare f ON t.rateId=f.rateID INNER JOIN station s1 ON s1.stationID=t.src_station INNER JOIN station s2 ON s2.stationID=t.dest_station WHERE t.trainId=:id');
            $this->db->bind(':id',$id);
            $results = $this->db->single();
            return $results;
        }



	}
