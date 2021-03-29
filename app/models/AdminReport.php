<?php
class AdminReport {
    private $db;

    public function __construct() {
        $this->db = new Database;
    }

public function findAllRefunds() {
       $this->db->query('SELECT r.*, t.* ,tr.*
            FROM ticket t
            INNER JOIN refund r 
            ON r.ticketId=t.ticketId
            INNER JOIN train tr 
            ON t.trainId=tr.trainId
            Order By refundDate ASC');

        $results = $this->db->resultSet();

        return $results;
        
    }

    
    public function findAdminById($id)
        {
            $this->db->query('SELECT a.*, u.email FROM admin a INNER JOIN users u ON a.userid=u.userid WHERE a.userid=:userid');
            $this->db->bind(":userid",$id);
            $row=$this->db->single();
            return $row; 
        }

    public function findTrains()
    {

         $this->db->query('SELECT name,trainId FROM train');
           
            $row=$this->db->resultSet();
            return $row; 
    }

    // public function findRefundsSum(){

    //      $this->db->query('SELECT SUM(price) FROM train');
           
    //         $row=$this->db->resultSet();
    //         return $row; 
    // }

    public function getTrainDetails($id){

        $this->db->query('SELECT t.*, s1.name AS srcName, s2.name AS destName FROM train t INNER JOIN station s1 ON s1.stationID=t.src_station INNER JOIN station s2 ON s2.stationID=t.dest_station WHERE t.trainId=:id');
        $this->db->bind(':id',$id);
        $results = $this->db->single();
        return $results;
    }


    public function createRefunds($name, $from, $to) {
      
        $this->db->query('SELECT r.*, t.ticketId, t.issueDate, t.issueTime, t.price, tr.name
                    FROM ticket t
                    INNER JOIN refund r 
                    ON r.ticketId=t.ticketId
                    INNER JOIN train tr 
                    ON t.trainId=tr.trainId
                    WHERE tr.trainId=:name AND r.refundDate BETWEEN :fromDate AND :toDate     
                    Order By refundDate ASC');
        $this->db->bind(":name",$name);
        $this->db->bind(":fromDate",$from);
        $this->db->bind(":toDate",$to);
        $results = $this->db->resultSet();

        return $results;  

    }

    public function createCancellationAlerts($name, $from, $to) {
      
        $this->db->query('SELECT al.*, tr.name, cal.*
                    FROM alerts al
                    INNER JOIN train tr
                    ON al.trainId=tr.trainId
                    INNER JOIN cancelled_alerts cal 
                    ON al.alertId=cal.alertId
                    WHERE tr.trainId=:name AND cal.cancellation_date BETWEEN :fromDate AND :toDate     
                    Order By cancellation_date ASC');
        $this->db->bind(":name",$name);
        $this->db->bind(":fromDate",$from);
        $this->db->bind(":toDate",$to);
        $results = $this->db->resultSet();

        return $results;  

    }

    public function createDelayAlerts($name, $from, $to) {
      
        $this->db->query('SELECT al.*, tr.name, dal.*
                    FROM alerts al
                    INNER JOIN train tr
                    ON al.trainId=tr.trainId
                    INNER JOIN delayed_alerts dal 
                    ON al.alertId=dal.alertId
                    WHERE tr.trainId=:name AND dal.delaydate BETWEEN :fromDate AND :toDate     
                    Order By delaydate ASC');
        $this->db->bind(":name",$name);
        $this->db->bind(":fromDate",$from);
        $this->db->bind(":toDate",$to);
        $results = $this->db->resultSet();

        return $results;  

    }

    public function createReschedulementAlerts($name, $from, $to) {
      
        $this->db->query('SELECT al.*, tr.name, ral.*
                    FROM alerts al
                    INNER JOIN train tr
                    ON al.trainId=tr.trainId
                    INNER JOIN rescheduled_alerts ral 
                    ON al.alertId=ral.alertId
                    WHERE tr.trainId=:name AND ral.newdate BETWEEN :fromDate AND :toDate     
                    Order By al.date ASC');
        $this->db->bind(":name",$name);
        $this->db->bind(":fromDate",$from);
        $this->db->bind(":toDate",$to);
        $results = $this->db->resultSet();

        return $results;  

    }


    public function createAllAlerts($name, $from, $to) {
      
        $this->db->query('SELECT al.*, tr.name, ral.*
                    FROM alerts al
                    FULL OUTER JOIN train tr
                    ON al.trainId=tr.trainId
                    RIGHT JOIN cancelled_alerts cal 
                    ON al.alertId=cal.alertId
                    RIGHT JOIN delayed_alerts dal 
                    ON al.alertId=dal.alertId
                    RIGHT JOIN rescheduled_alerts ral 
                    ON al.alertId=ral.alertId
                    WHERE tr.trainId=:name AND al.date BETWEEN :fromDate AND :toDate     
                    Order By al.date ASC');
        $this->db->bind(":name",$name);
        $this->db->bind(":fromDate",$from);
        $this->db->bind(":toDate",$to);
        $results = $this->db->resultSet();

        return $results;  

    }


    public function createOnlineRevenue($id, $from, $to) {
      
        $this->db->query("SELECT t.* FROM ticket t
                    WHERE t.reservationType='online' AND t.trainId=:id  AND t.journeyDate BETWEEN :fromDate AND :toDate     
                    Order By t.journeyDate ASC");
        $this->db->bind(":id",$id);
        $this->db->bind(":fromDate",$from);
        $this->db->bind(":toDate",$to);
        $results = $this->db->resultSet();

        return $results;  

    }
    public function createCounterRevenue($id, $from, $to) {
      
        $this->db->query("SELECT t.* FROM ticket t
                    WHERE t.reservationType='counter' AND t.trainId=:id  AND t.journeyDate BETWEEN :fromDate AND :toDate     
                    Order By t.journeyDate ASC");
        $this->db->bind(":id",$id);
        $this->db->bind(":fromDate",$from);
        $this->db->bind(":toDate",$to);
        $results = $this->db->resultSet();

        return $results;  

    }

    public function createAllRevenue($id, $from, $to) {
      
        $this->db->query("SELECT t.* FROM ticket t
                    WHERE AND t.trainId=:id  AND t.journeyDate BETWEEN :fromDate AND :toDate     
                    Order By t.journeyDate ASC");
        $this->db->bind(":id",$id);
        $this->db->bind(":fromDate",$from);
        $this->db->bind(":toDate",$to);
        $results = $this->db->resultSet();

        return $results;  

    }

 
}