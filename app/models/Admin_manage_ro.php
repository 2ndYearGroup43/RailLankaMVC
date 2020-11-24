<?php
class Admin_manage_ro {
	private $db;

	public function __construct(){
		$this->db = new Database;
	}

	public function create_ro($data){
		$this->db->query('INSERT INTO reservation_officer (officerId, employeeId, firstname, lastname, email, mobileno, password, reg_date, reg_time ) VALUES (:officerId, :employeeId,  :firstname, :lastname, :email, :mobileno, :password, :reg_date, :reg_time )');

		$this->db->bind(':officerId', $data['officerId']);
		$this->db->bind(':employeeId', $data['employeeId']);		
		$this->db->bind(':firstname', $data['firstname']);
		$this->db->bind(':lastname', $data['lastname']);
		$this->db->bind(':email', $data['email']);
		$this->db->bind(':mobileno', $data['mobileno']);
		$this->db->bind(':password', $data['password']);
		$this->db->bind(':reg_date', $data['reg_date']);
        $this->db->bind(':reg_time', $data['reg_time']);

		if($this->db->execute()){
			return true;
		}else{
			return false;
		}
        
	}

	    public function findOfficerByEmail($email)
    {
        //this is an preapared statement
        $this->db->query('SELECT COUNT(*) as count FROM reservation_officer WHERE email = :email');

        //Email param will be binded by the email variable

        $this->db->bind(':email', $email);

        //check if the email is already registsered;
        $results=array();
        $results=$this->db->resultSet();
        $count=$results[0]->count;
        if($count>0){
            return true;
        }else{
            return false;
        }
    }

    public function findOfficerByOfficerId($rodid)
    {
        //this is an preapared statement
        $this->db->query('SELECT COUNT(*) as count FROM reservation_officer WHERE officerId = :rodid');

        //Email param will be binded by the email variable

        $this->db->bind(':rodid', $rodid);

        //check if the email is already registsered;
        $results=array();
        $results=$this->db->resultSet();
        $count=$results[0]->count;
        if($count>0){
            return true;
        }else{
            return false;
        }
    }

    public function findOfficerByEmployeeId($empid)
    {
        //this is an preapared statement
        $this->db->query('SELECT COUNT(*) as count FROM reservation_officer WHERE employeeId = :empid');

        //Email param will be binded by the email variable

        $this->db->bind(':empid', $empid);

        //check if the email is already registsered;
        $results=array();
        $results=$this->db->resultSet();
        $count=$results[0]->count;
        if($count>0){
            return true;
        }else{
            return false;
        }
    }

	public function get(){
		$this->db->query('SELECT * FROM reservation_officer ORDER BY officerId ASC');
		$results = $this->db->resultSet();
		return $results;
	}

	public function findEmployee($officerId){
		$this->db->query('SELECT * FROM reservation_officer WHERE officerId=:officerId');

		$this->db->bind(':officerId', $officerId);

		$row = $this->db->single();
		return $row;
	}

	public function edit($data){
		$this->db->query('UPDATE reservation_officer SET employeeId=:employeeId, password=:password, email=:email, firstname=:firstname, lastname=:lastname, mobileno=:mobileno WHERE officerId=:officerId');

		$this->db->bind(':officerId', $data['officerId']);
		$this->db->bind(':employeeId', $data['employeeId']);
		$this->db->bind(':password', $data['password']);
		$this->db->bind(':email', $data['email']);
		$this->db->bind(':firstname', $data['firstname']);
		$this->db->bind(':lastname', $data['lastname']);
		$this->db->bind(':mobileno', $data['mobileno']);

		if($this->db->execute()){
			return true;
		}else{
			return false;
		}
	}

		public function views($data){
		$this->db->query('SELECT reservation_officer SET employeeId=:employeeId, password=:password, email=:email, firstname=:firstname, lastname=:lastname, mobileno=:mobileno, reg_date=:reg_date, reg_time=:reg_time WHERE officerId=:officerId');

		$this->db->bind(':officerId', $data['officerId']);
		$this->db->bind(':employeeId', $data['employeeId']);
		$this->db->bind(':password', $data['password']);
		$this->db->bind(':email', $data['email']);
		$this->db->bind(':firstname', $data['firstname']);
		$this->db->bind(':lastname', $data['lastname']);
		$this->db->bind(':mobileno', $data['mobileno']);
		$this->db->bind(':reg_date', $data['reg_date']);
		$this->db->bind(':reg_time', $data['reg_time']);

		if($this->db->execute()){
			return true;
		}else{
			return false;
		}
	}

	public function delete($officerId){
		$this->db->query('DELETE FROM reservation_officer WHERE officerId=:officerId');

		$this->db->bind(':officerId',$officerId);

        if($this->db->execute()){
			return true;
		}else{
			return false;
		}
	}
}