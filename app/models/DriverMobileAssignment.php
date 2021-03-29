<?php


class DriverMobileAssignment
{
    private $db;
    public function __construct()
    {
        $this->db=new Database;
    }

    public function checkCurrentAssignments($driverId, $date){
        $this->db->query("SELECT src.name AS src_station_name, dest.name AS dest_station_name ,t.*, da.*, j.* FROM driver_assignment da
			INNER JOIN journey j ON j.journeyId=da.journeyId  
            INNER JOIN train t ON j.trainId=t.trainId
            INNER JOIN station src ON t.src_station=src.stationID
            INNER JOIN station dest ON t.dest_station=dest.stationID
            WHERE da.driverId=:driverId AND j.journey_status <> 'Ended' AND j.date=:date 
        ");
        $this->db->bind(':driverId', $driverId);
        $this->db->bind(":date", $date);
        $row=$this->db->single();
        return $row;
    }

//considering night mail trains
    public function checkCurrentOverNightAssignments($driverId, $date, $prevDate){
        $this->db->query("SELECT src.name AS src_station_name, dest.name AS dest_station_name ,t.*, da.*, j.* FROM driver_assignment da
			INNER JOIN journey j ON j.journeyId=da.journeyId  
            INNER JOIN train t ON j.trainId=t.trainId
            INNER JOIN station src ON t.src_station=src.stationID
            INNER JOIN station dest ON t.dest_station=dest.stationID
            WHERE da.driverId=:driverId AND j.journey_status <> 'Ended' AND (j.date=:date OR j.date =:prevDate)
        ");
        $this->db->bind(':driverId', $driverId);
        $this->db->bind(":date", $date);
        $this->db->bind(":prevDate", $prevDate);
        $row=$this->db->single();
        return $row;
    }

    public function getPastAssignments($driverId){
        $this->db->query('SELECT src.name AS src_name, dest.name AS dest_name, da.*, j.*, t.* FROM driver_assignment da INNER JOIN journey j ON j.journeyId=da.journeyId
        INNER JOIN train t ON j.trainId=t.trainId
        INNER JOIN station src ON t.src_station=src.stationID
        INNER JOIN station dest ON dest.stationID=t.dest_station
        WHERE j.journey_status="Ended" AND da.driverId=:driverId ORDER BY j.ended_date DESC, j.ended_time DESC');
        $this->db->bind(":driverId", $driverId);
        $results=$this->db->resultSet();
        return $results;
    }

    public function getAssignedTrain($driverId){
        $this->db->query("SELECT t.*, da.*, j.* FROM driver_assignment da
			INNER JOIN journey j ON j.journeyId=da.journeyId  
            INNER JOIN train t ON j.trainId=t.trainId
            WHERE da.driverId=:driverId AND j.journey_status <> 'Ended'");
        $this->db->bind(':driverId', $driverId);
        $row=$this->db->single();
        return $row;
    }

}