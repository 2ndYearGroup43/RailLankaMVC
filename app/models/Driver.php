<?php
class Driver{
    private $db;

    public function __construct()
    {
        $this->db= new Database;
    }

    public function registerDriver($data)
    {
        $this->db->query('INSERT INTO users(email, password, role) VALUES(:email, :password, 4)');
        $this->db->bind(':password', $data['password']);
        $this->db->bind(':email', $data['email']);

        if($this->db->execute()){
            $this->db->query('SELECT LAST_INSERT_ID() AS userId');
            $resultId=[];
            $resultId=$this->db->resultSet();

            $this->db->query('INSERT INTO driver (driverId, userId, employeeId, firstname, lastname, mobileno, reg_date, reg_time)
                VALUES(:driverId, :userId, :employeeId, :firstName, :lastName, :mobileNo, :regDate, :regTime )');

            //bind values
            $this->db->bind(':driverId', $data['driverId']);
            $this->db->bind(':userId', $resultId[0]->userId);
            $this->db->bind(':employeeId', $data['employeeId']);
            $this->db->bind(':firstName', $data['firstName']);
            $this->db->bind(':lastName', $data['lastName']);
            $this->db->bind(':mobileNo', $data['mobileNo']);
            $this->db->bind(':regDate', $data['regDate']);
            $this->db->bind(':regTime', $data['regTime']);

            //execute

            if($this->db->execute()){
                return true;
            }else{
                return false;
            }
        }else{
            return false;
        }

    }

    public function findDriverByEmail($email)
    {
        //this is an preapared statement
        $this->db->query('SELECT COUNT(*) AS count FROM driver d INNER JOIN users u ON u.userId=d.userId WHERE u.email = :email');

        //Email param will be binded by the email variable

        $this->db->bind(':email', $email);


        //check if the email is already registsered;
        $results=array();
        $results=$this->db->resultSet();
        $count=$results[0]->count;
        
        //check if the email is already registsered;
        if($count>0){
            return true;
        }else{
            return false;
        }
    }

    public function findDriverByDriverId($drivid)
    {
        //this is an preapared statement
        $this->db->query('SELECT COUNT(*) AS count FROM driver WHERE driverId = :drivid');

        //Email param will be binded by the email variable

        $this->db->bind(':drivid', $drivid);
        $results=array();
        $results=$this->db->resultSet();
        $count=$results[0]->count;

        //check if the email is already registsered;
        if($count>0){
            return true;
        }else{
            return false;
        }
    }

    public function findDriverByEmployeeId($empid)
    {
        //this is an preapared statement
        $this->db->query('SELECT COUNT(*) AS count FROM driver WHERE employeeId = :empid');

        //Email param will be binded by the email variable

        $this->db->bind(':empid', $empid);

        //check if the email is already registsered;
        $results=array();
        $results=$this->db->resultSet();
        $count=$results[0]->count;
        
        //check if the email is already registsered;
        if($count>0){
            return true;
        }else{
            return false;
        }
    }


    public function getDrivers()
    {
        $this->db->query('SELECT d.*, u.email FROM driver d INNER JOIN users u ON d.userid=u.userid');
        $results=$this->db->resultSet();
        return $results;
    }

    public function getDriverFields(){
        $this->db->query("SELECT DISTINCT column_name AS columns FROM INFORMATION_SCHEMA.columns WHERE TABLE_NAME IN('driver', 'users') AND
         column_name IN('driverId','userid','employeeId','email','firstname','lastname','mobileno','reg_date','reg_time')");
        $results=$this->db->resultSet();
        return $results;
    }

    public function searchDrivers($searchterm, $searchfield)
        {
            if($searchterm==''){
                $this->db->query('SELECT d.*,u.email FROM driver d
                      INNER JOIN users u ON d.userId=u.userId');
            }else{
                switch ($searchfield) {
                    case 'userid':
                        $this->db->query('SELECT d.*,u.email FROM driver d
                        INNER JOIN users u ON u.userId=d.userId WHERE d.userId = :searchTerm');
                        break;
                    case 'driverId':
                        $this->db->query('SELECT d.*,u.email FROM driver d
                        INNER JOIN users u ON u.userId=d.userId WHERE d.driverId = :searchTerm');
                        break;
                    case 'employeeId':
                        $this->db->query('SELECT d.*,u.email FROM driver d
                        INNER JOIN users u ON u.userId=d.userId WHERE d.employeeId = :searchTerm');
                        break;
                    case 'firstname':
                        $this->db->query('SELECT d.*,u.email FROM driver d
                        INNER JOIN users u ON u.userId=d.userId WHERE d.firstname = :searchTerm');
                        break;
                    case 'lastname':
                        $this->db->query('SELECT d.*,u.email FROM driver d
                        INNER JOIN users u ON u.userId=d.userId WHERE d.lastname = :searchTerm');
                        break;
                    case 'email':
                        $this->db->query('SELECT d.*,u.email FROM driver d
                        INNER JOIN users u ON u.userId=d.userId WHERE u.email = :searchTerm');
                        break;
                    case 'mobileno':
                        $this->db->query('SELECT d.*,u.email FROM driver d
                        INNER JOIN users u ON u.userId=d.userId WHERE d.mobileno = :searchTerm');
                        break;
                    
                    
                }
            }
            
            $this->db->bind(':searchTerm',$searchterm);
            $results=$this->db->resultSet();
            return $results;
            
        }

        public function findDriverById($id)
        {
            $this->db->query('SELECT d.*, u.email FROM driver d INNER JOIN users u ON d.userId=u.userId WHERE d.userId=:userId');
            $this->db->bind(":userId",$id);
            $row=$this->db->single();
            return $row; 
        }

        public function updateDriver($data)
        {
            $this->db->query("UPDATE users SET email=:email WHERE userId=:userId");
            $this->db->bind(":userId", $data['userId']);
            $this->db->bind(":email", $data['email']);
            if($this->db->execute()){
                $this->db->query('UPDATE driver SET employeeId=:employeeId, firstname=:firstName, lastname=:lastName,
                mobileno=:mobileNo WHERE userId=:userId');
                $this->db->bind(":userId", $data['userId']);
                $this->db->bind(":employeeId", $data['employeeId']);
                $this->db->bind(":firstName", $data['firstName']);
                $this->db->bind(":lastName", $data['lastName']);
                $this->db->bind(":mobileNo", $data['mobileNo']);  
                if ($this->db->execute()) {
                    return true;
                } else {
                    return false;
                }
                return false;              
            }
        }

        public function deleteUser($id)
        {
            $this->db->query('DELETE FROM users WHERE userId=:userId');
            $this->db->bind(":userId", $id);
            if($this->db->execute()){
                return true;
            }else{
                return false;   
            }
        }
              
    



    public function login($username, $password)
    {
        $this->db->query('SELECT * FROM driver d INNER JOIN users u ON d.userId=u.userId WHERE u.email = :username');

        //Find value in the db
        //bind it with variables
        $this->db->bind(':username', $username);

        $row=$this->db->single();
        $hashedPassword = $row->password;
        if(password_verify($password, $hashedPassword)){
            return $row;
        }else{
            return false;
        }
    }


    public function requestReset($email, $code){

        $this->db->query('INSERT INTO resetpasswords (email,code) VALUES (:email, :code)');

        //bind values
        $this->db->bind(':email', $email);
        $this->db->bind(':code', $code);

        //Execute function
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }


    
		public function updatePassword($email, $password) {

			$this->db->query('UPDATE users SET password = :password WHERE email = :email');

			//bind values
			$this->db->bind(':email', $email);
			$this->db->bind(':password', $password);

			//Execute function
			if ($this->db->execute()) {
				return true;				
			} else {
				return false;
			}
		}

		public function deleteCode($code){

			$this->db->query('DELETE FROM resetpasswords WHERE code = :code');

			//bind values
			$this->db->bind(':code', $code);

			//execute function
			if ($this->db->execute()){
				return true;
			} else {
				return false;
			}
		}
    



}