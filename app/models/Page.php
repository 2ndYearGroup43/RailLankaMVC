<?php
class Page{
    private $db;

    public function __construct()
    {
        $this->db= new Database;
    }


    //Function to get the latest 3 notices
    public function getNotices(){
        $this->db->query('SELECT * FROM notice ORDER BY entered_date DESC, entered_time DESC LIMIT 3');
        $results = $this->db->resultSet();
        return $results;
    }


    //function to get all the notices(latest first)
    public function getAllNotices(){
        $this->db->query('SELECT * FROM notice ORDER BY entered_date DESC, entered_time DESC');
        $results = $this->db->resultSet();
        return $results;
    }


    //Function to get all the station names and ids
    public function getStations(){

        $this->db->query('SELECT stationID AS stationId, name AS stationName FROM station');
        $results = $this->db->resultSet();
        return $results;
    }


    //function to get details about a single notice
    public function getNoticeDetails($noticeid){

        $this->db->query('SELECT * FROM notice WHERE noticeId=:noticeId');
        $this->db->bind(':noticeId',$noticeid);
        $result = $this->db->single();
        return $result;

    }


}