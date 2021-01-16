<?php


class DriverMobileLocation
{
    private $db;
    public function __construct()
    {
        $this->db=new Database();
    }

    public function checkJourney($journeyId){
        $this->db->query("SELECT COUNT(*) AS count FROM journey WHERE journey_status <> 'ENDED' AND journeyId=:journeyId");
        $this->db->bind(':journeyId', $journeyId);
        $result=$this->db->single();
        if($result->count>0){
            return true;
        }else{
            return false;
        }
    }

    public function checkIfStarted($journeyId){
        $this->db->query("SELECT COUNT(*) AS count FROM location WHERE journeyId=:journeyId");
        $this->db->bind(':journeyId', $journeyId);
        $result=$this->db->single();
        if($result->count>0){
            return true;
        }else{
            return false;
        }
    }

    public function createLocation($journeyId, $lat, $lng){
        $date=date('Y-m-d');
        $time=date('H:i:s');
        $this->db->query("INSERT INTO location (latitude, longtitude, journeyId, date, time, location_status) 
        VALUES(:lat, :lng, :journeyId, :date, :time, :loc_status)");
        $this->db->bind(':lat', $lat);
        $this->db->bind(':lng', $lng);
        $this->db->bind(':journeyId', $journeyId);
        $this->db->bind(':date', $date);
        $this->db->bind(':time', $time);
        $this->db->bind(':loc_status', 'Started');
        if($this->db->execute()){
            return true;
        }else{
            return false;
        }

    }



}