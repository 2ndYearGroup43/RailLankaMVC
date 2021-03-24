<?php
class AdminNotice {
    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    
    public function findAllNotices() {
        $this->db->query('SELECT a.*, n.adminId FROM notice a INNER JOIN admin n ON a.adminId=n.adminId');

        $results = $this->db->resultSet();

        return $results;
    }

    public function findNoticeById($noticeId) {
       
        $this->db->query('SELECT * FROM notice WHERE noticeId = :noticeId');

        //Email param will be binded by the email variable

        $this->db->bind(':noticeId', $noticeId);
        $result=$this->db->single();

        //check if the email is already registsered;
        return $result;

    }


    public function addNotice($data) {


        $this->db->query('INSERT INTO notice (adminId, description, entered_date, entered_time, type) VALUES (:adminId, :description, :entered_date, :entered_time, :type)');

        $this->db->bind(':adminId', $data['adminId']);
        $this->db->bind(':description', $data['description']);
        $this->db->bind(':entered_date', $data['entered_date']);
        $this->db->bind(':entered_time', $data['entered_time']);
        //$this->db->bind(':adminId', $data['adminId']);
        $this->db->bind(':type', $data['type']);
       
        //$this->db->bind(':entered_date', $data['entered_date']);
        

     
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }

       /* if($this->db->execute()){
                return true;
            }else{
                return false;
            }
        }else{
            return false;
        }*/
    }

    public function updateNotice($data) {
        $this->db->query('UPDATE notice SET description = :description, type = :type WHERE noticeId = :noticeId');

        $this->db->bind(':noticeId', $data['noticeId']);
        $this->db->bind(':description', $data['description']);
        $this->db->bind(':type', $data['type']);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }

       
    }


    public function delete($noticeId)
        {
            $this->db->query('DELETE FROM notice WHERE noticeId=:noticeId');
            $this->db->bind(":noticeId", $noticeId);
            if($this->db->execute()){
                return true;
            }else{
                return false;   
            }
        }
   
    public function getNoticesFields(){

        $this->db->query("SELECT DISTINCT column_name AS columns FROM INFORMATION_SCHEMA.columns WHERE TABLE_NAME IN('notice', 'admin') AND
         column_name IN('noticeId','type','adminId','entered_date','entered_time')");
        $results=$this->db->resultSet();
        return $results;
    }

    public function searchnotices($searchterm, $searchfield)
        {
            if($searchterm==''){
                $this->db->query('SELECT n.*,a.adminId FROM notice n
                      INNER JOIN admin a ON n.adminId=a.adminId');
            }else{
                switch ($searchfield) {
                    
                    case 'noticeId':
                        $this->db->query('SELECT n.*,a.adminId FROM notice n
                        INNER JOIN admin a ON a.adminId=n.adminId WHERE n.noticeId = :searchTerm');
                        break;
                    case 'adminId':
                        $this->db->query('SELECT n.*,a.adminId FROM notice n
                        INNER JOIN admin a ON a.adminId=n.adminId WHERE n.adminId = :searchTerm');
                        break;
                    case 'type':
                        $this->db->query('SELECT n.*,a.adminId FROM notice n
                        INNER JOIN admin a ON a.adminId=n.adminId WHERE n.type = :searchTerm');
                        break;
                    case 'entered_date':
                        $this->db->query('SELECT n.*,a.adminId FROM notice n
                        INNER JOIN admin a ON a.adminId=n.adminId WHERE n.entered_date = :searchTerm');
                        break;
                    case 'entered_time':
                        $this->db->query('SELECT n.*,a.adminId FROM notice n
                        INNER JOIN admin a ON a.adminId=n.adminId WHERE n.entered_time = :searchTerm');
                        break;
                    
                }
            }
            
            $this->db->bind(':searchTerm',$searchterm);
            $results=$this->db->resultSet();
            return $results;
            
        }
}
