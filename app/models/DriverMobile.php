<?php
class DriverMobile{
    private $db;

    public function __construct()
    {
        $this->db= new Database;
    }


    public function checkEmail($email)
    {
        $this->db->query('SELECT  COUNT(*) AS count FROM users WHERE email=:email');
        $this->db->bind(':email', $email);
        $row=$this->db->single();

        if($row->count>0){
            return true;
        }else{
            return false;
        }

    }



    public function getDriverDetails($email)
    {
        $this->db->query('SELECT u.*,d.* FROM users u INNER JOIN driver d ON u.userId=d.userId 
        WHERE u.email=:email');
        $this->db->bind(':email', $email);
        $row=$this->db->single();
        return $row;
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