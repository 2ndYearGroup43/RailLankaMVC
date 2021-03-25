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

    public function checkIfStarted($journeyId){//location exists
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
        $this->db->bind(':loc_status', 'Live');
        if($this->db->execute()){
            $this->db->query('UPDATE journey SET journey_status=:j_status, started_date=:date, started_time=:time WHERE journeyId=:journeyIdcl');
            $this->db->bind(':j_status', 'Live');
            $this->db->bind(':journeyIdcl', $journeyId);
            $this->db->bind(':date', $date);
            $this->db->bind(':time', $time);
            if($this->db->execute()){
                return true;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }

    public function updateLocation($journeyId, $lat, $lng){
        $date=date('Y-m-d');
        $time=date('H:i:s');
        $this->db->query('UPDATE location SET latitude=:lat, longtitude=:lng, journeyId=:journeyId, date=:date, time=:time, location_status=:loc_status WHERE journeyId=:journeyIdcl');
        $this->db->bind(':lat', $lat);
        $this->db->bind(':lng', $lng);
        $this->db->bind(':journeyId', $journeyId);
        $this->db->bind(':date', $date);
        $this->db->bind(':time', $time);
        $this->db->bind(':loc_status', 'Live');
        $this->db->bind(':journeyIdcl', $journeyId);
        if($this->db->execute()){
            $this->db->query('UPDATE journey SET journey_status=:j_status WHERE journeyId=:journeyIdcl');
            $this->db->bind(':j_status', 'Live');
            $this->db->bind(':journeyIdcl', $journeyId);
            if($this->db->execute()){
                return true;
            }else{
                return false;
            }
        }else{
            return false;
        }

    }

    public function stopJourney($journeyId){
        $date=date('Y-m-d');
        $time=date('H:i:s');
        $this->db->query('UPDATE location SET date=:date, time=:time, location_status=:loc_status WHERE journeyId=:journeyIdcl');
        $this->db->bind(':date', $date);
        $this->db->bind(':time', $time);
        $this->db->bind(':loc_status', 'Stopped');
        $this->db->bind(':journeyIdcl', $journeyId);
        if ($this->db->execute()){
            $this->db->query('UPDATE journey SET journey_status=:j_status WHERE journeyId=:journeyIdcl');
            $this->db->bind(':j_status', 'Off-Line');
            $this->db->bind(':journeyIdcl', $journeyId);
            if($this->db->execute()){
                return true;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }

    public function endJourney($journeyId){
        $date=date('Y-m-d');
        $time=date('H:i:s');
        $this->db->query('UPDATE location SET date=:date, time=:time, location_status=:loc_status WHERE journeyId=:journeyIdcl');
        $this->db->bind(':date', $date);
        $this->db->bind(':time', $time);
        $this->db->bind(':loc_status', 'Ended');
        $this->db->bind(':journeyIdcl', $journeyId);
        if ($this->db->execute()){
            $this->db->query('UPDATE journey SET journey_status=:j_status, ended_date=:date, ended_time=:time WHERE journeyId=:journeyIdcl');
            $this->db->bind(':j_status', 'Ended');
            $this->db->bind(':journeyIdcl', $journeyId);
            $this->db->bind(':date', $date);
            $this->db->bind(':time', $time);
            if($this->db->execute()){
                return true;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }



}