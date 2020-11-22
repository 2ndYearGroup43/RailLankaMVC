<?php
class Employee{ 
    private $db;

    public function __contruct()
    {
        $this->db=new Database;
    }

    public function getUserById($id)
    {
        $this->db->query('SELECT * FROM users WHERE userId=:userId');
        $this->db->bind(':userId', $id);

        $user=$this->db->single();
        return $user;

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




}