<?php
class Admin{
    private $db;

    public function __construct()
    {
        $this->db= new Database;
    }

    public function registerAdmin($data)
    {
        $this->db->query('INSERT INTO users(email, password, role)
        VALUES(:email, :password, :role)');
        $this->db->bind(':password', $data['password']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':role', $data['role']);

        if($this->db->execute()){
            $this->db->query('SELECT LAST_INSERT_ID() AS userid');
            $resultId=[];
            $resultId=$this->db->resultSet();

            $this->db->query('INSERT INTO admin (adminId, userid, employeeId, firstname, lastname, mobileno, reg_date, reg_time)
                VALUES(:adminId, :userid, :employeeId, :firstname, :lastname, :mobileno, :reg_date, :reg_time )');

            //bind values
            $this->db->bind(':adminId', $data['adminId']);
            $this->db->bind(':userid', $resultId[0]->userid);
            $this->db->bind(':employeeId', $data['employeeId']);
            $this->db->bind(':firstname', $data['firstname']);
            $this->db->bind(':lastname', $data['lastname']);
            $this->db->bind(':mobileno', $data['mobileno']);
            $this->db->bind(':reg_date', $data['reg_date']);
            $this->db->bind(':reg_time', $data['reg_time']);

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

    public function findAdminByEmail($email)
    {
        //this is an preapared statement
        $this->db->query('SELECT COUNT(*) AS count FROM admin a INNER JOIN users u ON u.userid=a.userid WHERE u.email = :email');

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

    public function findAdminByAdminId($adid)
    {
        //this is an preapared statement
        $this->db->query('SELECT COUNT(*) AS count FROM admin WHERE adminId = :adid');

        //Email param will be binded by the email variable

        $this->db->bind(':adid', $adid);
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

    public function findAdminByEmployeeId($empid)
    {
        //this is an preapared statement
        $this->db->query('SELECT COUNT(*) AS count FROM admin WHERE employeeId = :empid');

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


    public function getAdmins()
    {
        $this->db->query('SELECT a.*, u.email FROM admin a INNER JOIN users u ON a.userid=u.userid');
        $results=$this->db->resultSet();
        return $results;
    }

    public function getAdminFields(){
        $this->db->query("SELECT DISTINCT column_name AS columns FROM INFORMATION_SCHEMA.columns WHERE TABLE_NAME IN('admin', 'users') AND
         column_name IN('adminId','userid','employeeId','email','firstname','lastname','mobileno','reg_date','reg_time')");
        $results=$this->db->resultSet();
        return $results;
    }

    public function searchAdmins($searchterm, $searchfield)
        {
            if($searchterm==''){
                $this->db->query('SELECT a.*,u.email FROM admin a
                      INNER JOIN users u ON a.userId=u.userId');
            }else{
                switch ($searchfield) {
                    case 'userid':
                        $this->db->query('SELECT a.*,u.email FROM admin a
                        INNER JOIN users u ON u.userId=a.userId WHERE a.userId = :searchTerm');
                        break;
                    case 'adminId':
                        $this->db->query('SELECT a.*,u.email FROM admin a
                        INNER JOIN users u ON u.userId=a.userId WHERE a.adminId = :searchTerm');
                        break;
                    case 'employeeId':
                        $this->db->query('SELECT a.*,u.email FROM admin a
                        INNER JOIN users u ON u.userId=a.userId WHERE a.employeeId = :searchTerm');
                        break;
                    case 'firstname':
                        $this->db->query('SELECT a.*,u.email FROM admin a
                        INNER JOIN users u ON u.userId=a.userId WHERE a.firstname = :searchTerm');
                        break;
                    case 'lastname':
                        $this->db->query('SELECT a.*,u.email FROM admin a
                        INNER JOIN users u ON u.userId=a.userId WHERE a.lastname = :searchTerm');
                        break;
                    case 'email':
                        $this->db->query('SELECT a.*,u.email FROM admin a
                        INNER JOIN users u ON u.userId=a.userId WHERE u.email = :searchTerm');
                        break;
                    case 'mobileno':
                        $this->db->query('SELECT a.*,u.email FROM admin a
                        INNER JOIN users u ON u.userId=a.userId WHERE a.mobileno = :searchTerm');
                        break;
                    
                    
                }
            }
            
            $this->db->bind(':searchTerm',$searchterm);
            $results=$this->db->resultSet();
            return $results;
            
        }

        public function findAdminById($id)
        {
            $this->db->query('SELECT a.*, u.email FROM admin a INNER JOIN users u ON a.userid=u.userid WHERE a.userid=:userid');
            $this->db->bind(":userid",$id);
            $row=$this->db->single();
            return $row; 
        }

        public function updateAdmin($data)
        {
            $this->db->query("UPDATE users SET email=:email WHERE userid=:userid");
            $this->db->bind(":userid", $data['userid']);
            $this->db->bind(":email", $data['email']);
            if($this->db->execute()){
                $this->db->query('UPDATE admin SET employeeId=:employeeId, firstname=:firstname, lastname=:lastname,
                mobileno=:mobileno WHERE userid=:userid');
                $this->db->bind(":userid", $data['userid']);
                $this->db->bind(":employeeId", $data['employeeId']);
                $this->db->bind(":firstname", $data['firstname']);
                $this->db->bind(":lastname", $data['lastname']);
                $this->db->bind(":mobileno", $data['mobileno']);  
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
            $this->db->query('DELETE FROM users WHERE userid=:userid');
            $this->db->bind(":userid", $id);
            if($this->db->execute()){
                return true;
            }else{
                return false;   
            }
        }
              
    



    public function login($username, $password)
    {
        $this->db->query('SELECT * FROM admin a INNER JOIN users u ON a.userId=u.userId WHERE adminId = :username');

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