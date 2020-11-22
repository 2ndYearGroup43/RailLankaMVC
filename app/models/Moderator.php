<?php
class Moderator{
    private $db;

    public function __construct()
    {
        $this->db= new Database;
    }

    public function registerModerator($data)
    {
        $this->db->query('INSERT INTO users(email, password, role)
        VALUES(:email, :password, 3)');
        $this->db->bind(':password', $data['password']);
        $this->db->bind(':email', $data['email']);

        if($this->db->execute()){
            $this->db->query('SELECT LAST_INSERT_ID() AS userId');
            $resultId=[];
            $resultId=$this->db->resultSet();

            $this->db->query('INSERT INTO moderator (moderatorId, userId, employeeId, firstname, lastname, mobileno, reg_date, reg_time)
                VALUES(:moderatorId, :userId, :employeeId, :firstName, :lastName, :mobileNo, :regDate, :regTime )');

            //bind values
            $this->db->bind(':moderatorId', $data['moderatorId']);
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

    public function findModeratorByEmail($email)
    {
        //this is an preapared statement
        $this->db->query('SELECT COUNT(*) AS count FROM moderator m INNER JOIN users u ON u.userId=m.userId WHERE u.email = :email');

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

    public function findModeratorByModeratorId($modid)
    {
        //this is an preapared statement
        $this->db->query('SELECT COUNT(*) AS count FROM moderator WHERE moderatorId = :modid');

        //Email param will be binded by the email variable

        $this->db->bind(':modid', $modid);
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

    public function findModeratorByEmployeeId($empid)
    {
        //this is an preapared statement
        $this->db->query('SELECT COUNT(*) AS count FROM moderator WHERE employeeId = :empid');

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


    public function getModerators()
    {
        $this->db->query('SELECT m.*, u.email FROM moderator m INNER JOIN users u ON m.userid=u.userid');
        $results=$this->db->resultSet();
        return $results;
    }

    public function getModeratorFields(){
        $this->db->query("SELECT DISTINCT column_name AS columns FROM INFORMATION_SCHEMA.columns WHERE TABLE_NAME IN('moderator', 'users') AND
         column_name IN('moderatorId','userid','employeeId','email','firstname','lastname','mobileno','reg_date','reg_time')");
        $results=$this->db->resultSet();
        return $results;
    }

    public function searchModerators($searchterm, $searchfield)
        {
            if($searchterm==''){
                $this->db->query('SELECT m.*,u.email FROM moderators m
                      INNER JOIN users u ON m.userId=u.userId');
            }else{
                switch ($searchfield) {
                    case 'userid':
                        $this->db->query('SELECT m.*,u.email FROM moderator m
                        INNER JOIN users u ON u.userId=m.userId WHERE m.userId = :searchTerm');
                        break;
                    case 'moderatorId':
                        $this->db->query('SELECT m.*,u.email FROM moderator m
                        INNER JOIN users u ON u.userId=m.userId WHERE m.moderatorId = :searchTerm');
                        break;
                    case 'employeeId':
                        $this->db->query('SELECT m.*,u.email FROM moderator m
                        INNER JOIN users u ON u.userId=m.userId WHERE m.employeeId = :searchTerm');
                        break;
                    case 'firstname':
                        $this->db->query('SELECT m.*,u.email FROM moderator m
                        INNER JOIN users u ON u.userId=m.userId WHERE m.firstname = :searchTerm');
                        break;
                    case 'lastname':
                        $this->db->query('SELECT m.*,u.email FROM moderator m
                        INNER JOIN users u ON u.userId=m.userId WHERE m.lastname = :searchTerm');
                        break;
                    case 'email':
                        $this->db->query('SELECT m.*,u.email FROM moderator m
                        INNER JOIN users u ON u.userId=m.userId WHERE u.email = :searchTerm');
                        break;
                    case 'mobileno':
                        $this->db->query('SELECT m.*,u.email FROM moderator m
                        INNER JOIN users u ON u.userId=m.userId WHERE m.mobileno = :searchTerm');
                        break;
                    
                    
                }
            }
            
            $this->db->bind(':searchTerm',$searchterm);
            $results=$this->db->resultSet();
            return $results;
            
        }

        public function findModeratorById($id)
        {
            $this->db->query('SELECT m.*, u.email FROM moderator m INNER JOIN users u ON m.userId=u.userId WHERE m.userId=:userId');
            $this->db->bind(":userId",$id);
            $row=$this->db->single();
            return $row; 
        }

        public function updateModerator($data)
        {
            $this->db->query("UPDATE users SET email=:email WHERE userId=:userId");
            $this->db->bind(":userId", $data['userId']);
            $this->db->bind(":email", $data['email']);
            if($this->db->execute()){
                $this->db->query('UPDATE moderator SET employeeId=:employeeId, firstname=:firstName, lastname=:lastName,
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
        $this->db->query('SELECT * FROM moderator m INNER JOIN users u ON m.userId=u.userId WHERE moderatorId = :username');

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





}