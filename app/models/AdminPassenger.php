<?php
class AdminPassenger {
    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    public function findAllPassengers() {
        $this->db->query('SELECT a.*, u.email FROM passenger a INNER JOIN users u ON a.userid=u.userid');

        $results = $this->db->resultSet();

        return $results;
    }

    /*public function getAdmins()
    {
        $this->db->query('SELECT a.*, u.email FROM passenger a INNER JOIN users u ON a.userid=u.userid'SELECT * FROM passenger ORDER BY reg_date ASC);
        $results=$this->db->resultSet();
        return $results;
    }*/

    public function delete($id)
        {
            $this->db->query('DELETE FROM users WHERE userid=:userid');
            $this->db->bind(":userid", $id);
            if($this->db->execute()){
                return true;
            }else{
                return false;   
            }
        }

    public function getPassengerFields(){

        $this->db->query("SELECT DISTINCT column_name AS columns FROM INFORMATION_SCHEMA.columns WHERE TABLE_NAME IN('passenger', 'users') AND
         column_name IN('nic','firstname','lastname','email','mobileno','city','country','reg_date','reg_time')");
        $results=$this->db->resultSet();
        return $results;
    }

    public function searchPassengers($searchterm, $searchfield)
        {
            if($searchterm==''){
                $this->db->query('SELECT p.*,u.email FROM passenger p
                      INNER JOIN users u ON p.userId=u.userId');
            }else{
                switch ($searchfield) {
                    // case 'userid':
                    //     $this->db->query('SELECT p.*,u.email FROM passenger p
                    //     INNER JOIN users u ON p.userId=p.userId WHERE p.userId = :searchTerm');
                    //     break;
                    case 'nic':
                        $this->db->query('SELECT p.*,u.email FROM passenger p
                        INNER JOIN users u ON u.userId=p.userId WHERE p.nic = :searchTerm');
                        break;
                    case 'firstname':
                        $this->db->query('SELECT p.*,u.email FROM passenger p
                        INNER JOIN users u ON u.userId=p.userId WHERE p.firstname = :searchTerm');
                        break;
                    case 'lastname':
                        $this->db->query('SELECT p.*,u.email FROM passenger p
                        INNER JOIN users u ON u.userId=p.userId WHERE p.lastname = :searchTerm');
                        break;
                    case 'email':
                        $this->db->query('SELECT p.*,u.email FROM passenger p
                        INNER JOIN users u ON u.userId=p.userId WHERE p.email = :searchTerm');
                        break;
                    case 'city':
                        $this->db->query('SELECT p.*,u.email FROM passenger p
                        INNER JOIN users u ON u.userId=p.userId WHERE p.city = :searchTerm');
                        break;
                    case 'country':
                        $this->db->query('SELECT p.*,u.email FROM passenger p
                        INNER JOIN users u ON u.userId=p.userId WHERE p.country = :searchTerm');
                        break;
                    case 'reg_date':
                        $this->db->query('SELECT p.*,u.email FROM passenger p
                        INNER JOIN users u ON u.userId=p.userId WHERE p.reg_date = :searchTerm');
                        break;
                    
                    
                    
                }
            }
            
            $this->db->bind(':searchTerm',$searchterm);
            $results=$this->db->resultSet();
            return $results;
            
        }

}