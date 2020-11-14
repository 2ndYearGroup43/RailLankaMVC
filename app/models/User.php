<?php 
	class User {
		private $db;

		public function __construct() {
			$this->db = new Database;
		}


		public function register($data) {
			$this->db->query('INSERT INTO users (email,password,role) VALUES (:email, :password, :role)');

			//bind values
			// $this->db->bind(':username', $data['username']);
			$this->db->bind(':email', $data['email']);
			$this->db->bind(':password', $data['password']);
			$this->db->bind(':role', $data['role']);

			//Execute function
			if ($this->db->execute()) {

				$this->db->query('SELECT LAST_INSERT_ID() As userid');
				$result = [];
				$result = $this->db->resultSet();
				$this->db->query('INSERT INTO passenger (userid, nic, reg_date, reg_time) VALUES (:userid, :nic, :reg_date, :reg_time)');

				//bind values
				$this->db->bind(':userid', $result[0]->userid);
				$this->db->bind(':nic', $data['nic']);
				$this->db->bind(':reg_date', $data['reg_date']);
				$this->db->bind(':reg_time', $data['reg_time']);

				//execute function
				if ($this->db->execute()){
					return true;
				} else {
					return false;
				}
				
			} else {
				return false;
			}
		}

		
		public function login($email, $password) {
			$this->db->query('SELECT * FROM users WHERE email = :email'); //changed users to passenger

			//bind values
			$this->db->bind(':email', $email);

			$row = $this->db->single();

			if(!empty($row)){

				$hashedPassword = $row->password;

				// //Checking if the user is a passenger
				// if($row->isPassenger==0)
				// 	return false;

				if (password_verify($password, $hashedPassword)) {
					return $row;
				} else {
					return false;
				}
			} else {
				return false;
			}
			
		}

		public function getRole($userid){
			$this->db->query('SELECT * FROM users WHERE userid = :userid');

			//bind values
			$this->db->bind(':userid',$userid);

			$row = $this->db->single();
			
			if(!empty($row)) {
				return $row;
			} else {
				return false;
			}
		}


		//find user email
		public function findUserByEmail($email) {
			//prepared statemnet
			var_dump($email);
			$this->db->query('SELECT * FROM users WHERE email = :email'); //check all tables!!!!

			//Email param will be binded with the email variable
			$this->db->bind(':email', $email);

			$row = $this->db->single();

			//check if email is already registered
			if(!empty($row)) {
				return true;
			} else {
				return false;
			}

		}

		public function findEmailByCode($code) {

			$this->db->query('SELECT * FROM resetpasswords WHERE code = :code'); 

			//code param will be binded with the code variable
			$this->db->bind(':code', $code);

			$row = $this->db->single();
			
			//check if their is a valid registered email for the code 
			if(!empty($row)){
				return $row;
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

		// public function getUsers() {
		// 	$this->db->query("SELECT * FROM users");
		// 	$result = $this->db->resultSet();
		// 	return $result;
		// }
	}