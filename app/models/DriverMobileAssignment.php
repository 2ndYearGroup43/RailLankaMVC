<?php


class DriverMobileAssignment
{
    private $db;
    public function __construct()
    {
        $this->db=new Database;
    }

    public function checkCurrentAssignments($driverId){
        $this->db->query("SELECT src.name AS src_station_name, dest.name AS dest_station_name ,t.*, da.*, j.* FROM driver_assignment da
			INNER JOIN journey j ON j.journeyId=da.journeyId  
            INNER JOIN train t ON j.trainId=t.trainId
            INNER JOIN station src ON t.src_station=src.stationID
            INNER JOIN station dest ON t.dest_station=dest.stationID
            WHERE da.driverId=:driverId AND j.journey_status <> 'Ended'
        ");
        $this->db->bind(':driverId', $driverId);
        $row=$this->db->single();
        return $row;
    }

    public function getPastAssignments($driverId){
        $this->db->query('SELECT src.name AS src_name, dest.name AS dest_name, da.*, j.*, t.* FROM driver_assignment da INNER JOIN journey j ON j.journeyId=da.journeyId
        INNER JOIN train t ON j.trainId=t.trainId
        INNER JOIN station src ON t.src_station=src.stationID
        INNER JOIN station dest ON dest.stationID=t.dest_station
        WHERE j.journey_status="Ended" AND da.driverId=:driverId');
        $this->db->bind(":driverId", $driverId);
        $results=$this->db->resultSet();
        return $results;
    }

}