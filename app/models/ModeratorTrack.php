<?php
class ModeratorTrack{
    private $db;

    public function __construct()
    {
        $this->db= new Database;
    }

    //search
    public function getStations()
    {
        $this->db->query('SELECT * FROM station');
        $result=$this->db->resultSet();
        return $result;
    }

    public function checkStation($station){
        $this->db->query('SELECT COUNT(*) AS count FROM station WHERE stationID=:station');
        $this->db->bind(':station', $station);
        $row=$this->db->single();
        if ($row->count>0){
            return true;
        }else{
            return false;
        }
    }

    public function searchSrcOnly($data)
    {
        $this->db->query('SELECT t.*, s1.name AS src_name, s2.name AS dest_name, j.journeyId, j.journey_status FROM train t
        INNER JOIN (SELECT r.trainId FROM route r INNER JOIN route_station rs ON r.routeId=rs.routeId WHERE rs.stationID=:srcStation AND rs.departuretime>=cast(:time AS time)) t1 ON t.trainId=t1.trainId
        INNER JOIN station s1 ON t.src_station=s1.stationID
        INNER JOIN station s2 ON t.dest_station=s2.stationID
        INNER JOIN journey j ON t.trainId=j.trainId
        WHERE t.dest_station <> :srcStation
        AND j.journey_status="Live"
      	');
        $this->db->bind(':time', $data['time']);
        $this->db->bind(':srcStation', $data['srcStation']);
        $trains=$this->db->resultSet();
        return $trains;
    }

    public function searchSrcDate($data)
    {
        switch ($data['date']) {
            case 'Monday':
                $this->db->query('SELECT t.*, s1.name AS src_name, s2.name AS dest_name, j.journeyId, j.journey_status FROM train t
                INNER JOIN (SELECT r.trainId FROM route r INNER JOIN route_station rs ON r.routeId=rs.routeId WHERE rs.stationID=:srcStation AND rs.departuretime>=cast(:time AS time)) t1 ON t.trainId=t1.trainId
                INNER JOIN station s1 ON t.src_station=s1.stationID
                INNER JOIN station s2 ON t.dest_station=s2.stationID
                INNER JOIN journey j ON t.trainId=j.trainId
                INNER JOIN availabledays a ON a.trainId=t.trainId WHERE a.monday="Yes" AND t.dest_station <> :srcStation
                AND j.journey_status="Live"
                ');
                break;
            case 'Tuesday':
                $this->db->query('SELECT t.*, s1.name AS src_name, s2.name AS dest_name, j.journeyId, j.journey_status FROM train t
                INNER JOIN (SELECT r.trainId FROM route r INNER JOIN route_station rs ON r.routeId=rs.routeId WHERE rs.stationID=:srcStation AND rs.departuretime>=cast(:time AS time)) t1 ON t.trainId=t1.trainId
                INNER JOIN station s1 ON t.src_station=s1.stationID
                INNER JOIN station s2 ON t.dest_station=s2.stationID
                INNER JOIN journey j ON t.trainId=j.trainId
                INNER JOIN availabledays a ON a.trainId=t.trainId WHERE a.tuesday="Yes" AND t.dest_station <> :srcStation
                AND j.journey_status="Live"
                ');
                break;
            case 'Wednesday':
                $this->db->query('SELECT t.*, s1.name AS src_name, s2.name AS dest_name, j.journeyId, j.journey_status FROM train t
                INNER JOIN (SELECT r.trainId FROM route r INNER JOIN route_station rs ON r.routeId=rs.routeId WHERE rs.stationID=:srcStation AND rs.departuretime>=cast(:time AS time)) t1 ON t.trainId=t1.trainId
                INNER JOIN station s1 ON t.src_station=s1.stationID
                INNER JOIN station s2 ON t.dest_station=s2.stationID
                INNER JOIN journey j ON t.trainId=j.trainId
                INNER JOIN availabledays a ON a.trainId=t.trainId WHERE a.wednesday="Yes" AND t.dest_station <> :srcStation
                AND j.journey_status="Live"
                ');
                break;
            case 'Thursday':
                $this->db->query('SELECT t.*, s1.name AS src_name, s2.name AS dest_name, j.journeyId, j.journey_status FROM train t
                INNER JOIN (SELECT r.trainId FROM route r INNER JOIN route_station rs ON r.routeId=rs.routeId WHERE rs.stationID=:srcStation AND rs.departuretime>=cast(:time AS time)) t1 ON t.trainId=t1.trainId
                INNER JOIN station s1 ON t.src_station=s1.stationID
                INNER JOIN station s2 ON t.dest_station=s2.stationID
                INNER JOIN journey j ON t.trainId=j.trainId
                INNER JOIN availabledays a ON a.trainId=t.trainId WHERE a.thursday="Yes" AND t.dest_station <> :srcStation
                AND j.journey_status="Live"
                ');
                break;
            case 'Friday':
                $this->db->query('SELECT t.*, s1.name AS src_name, s2.name AS dest_name, j.journeyId, j.journey_status FROM train t
                INNER JOIN (SELECT r.trainId FROM route r INNER JOIN route_station rs ON r.routeId=rs.routeId WHERE rs.stationID=:srcStation AND rs.departuretime>=cast(:time AS time)) t1 ON t.trainId=t1.trainId
                INNER JOIN station s1 ON t.src_station=s1.stationID
                INNER JOIN station s2 ON t.dest_station=s2.stationID
                INNER JOIN journey j ON t.trainId=j.trainId
                INNER JOIN availabledays a ON a.trainId=t.trainId WHERE a.friday="Yes" AND t.dest_station <> :srcStation
                AND j.journey_status="Live"
                ');
                break;
            case 'Saturday':
                $this->db->query('SELECT t.*, s1.name AS src_name, s2.name AS dest_name, j.journeyId, j.journey_status FROM train t
                INNER JOIN (SELECT r.trainId FROM route r INNER JOIN route_station rs ON r.routeId=rs.routeId WHERE rs.stationID=:srcStation AND rs.departuretime>=cast(:time AS time)) t1 ON t.trainId=t1.trainId
                INNER JOIN station s1 ON t.src_station=s1.stationID
                INNER JOIN station s2 ON t.dest_station=s2.stationID
                INNER JOIN journey j ON t.trainId=j.trainId
                INNER JOIN availabledays a ON a.trainId=t.trainId WHERE a.saturday="Yes" AND t.dest_station <> :srcStation
                AND j.journey_status="Live"
                ');
                break;
            case 'Sunday':
                $this->db->query('SELECT t.*, s1.name AS src_name, s2.name AS dest_name, j.journeyId, j.journey_status FROM train t
                INNER JOIN (SELECT r.trainId FROM route r INNER JOIN route_station rs ON r.routeId=rs.routeId WHERE rs.stationID=:srcStation AND rs.departuretime>=cast(:time AS time)) t1 ON t.trainId=t1.trainId
                INNER JOIN station s1 ON t.src_station=s1.stationID
                INNER JOIN station s2 ON t.dest_station=s2.stationID
                INNER JOIN journey j ON t.trainId=j.trainId
                INNER JOIN availabledays a ON a.trainId=t.trainId WHERE a.sunday="Yes" AND t.dest_station <> :srcStation
                AND j.journey_status="Live"
                ');
        }

        $this->db->bind(':srcStation', $data['srcStation']);
        $this->db->bind(':time', $data['time']);
        $trains=$this->db->resultSet();
        return $trains;
    }


    public function searchDestOnly($data)
    {
        $this->db->query('SELECT t.*, s1.name AS src_name, s2.name AS dest_name, j.journeyId, j.journey_status FROM train t
        INNER JOIN (SELECT r.trainId FROM route r INNER JOIN route_station rs ON r.routeId=rs.routeId WHERE rs.stationID=:destStation AND rs.departuretime>=cast(:time AS time)) t1 ON t.trainId=t1.trainId
        INNER JOIN station s1 ON t.src_station=s1.stationID
        INNER JOIN station s2 ON t.dest_station=s2.stationID
        INNER JOIN journey j ON t.trainId=j.trainId
        WHERE t.src_station <> :destStation
        AND j.journey_status="Live"
      	');
        $this->db->bind(':destStation', $data['destStation']);
        $this->db->bind(':time', $data['time']);
        $trains = $this->db->resultSet();
        return $trains;
    }

    public function searchDestDate($data)
    {
        switch ($data['date']) {
            case 'Monday':
                $this->db->query('SELECT t.*, s1.name AS src_name, s2.name AS dest_name, j.journeyId, j.journey_status FROM train t
                INNER JOIN (SELECT r.trainId FROM route r INNER JOIN route_station rs ON r.routeId=rs.routeId WHERE rs.stationID=:destStation AND rs.departuretime>=cast(:time AS time)) t1 ON t.trainId=t1.trainId
                INNER JOIN station s1 ON t.src_station=s1.stationID
                INNER JOIN station s2 ON t.dest_station=s2.stationID
                INNER JOIN journey j ON t.trainId=j.trainId
                INNER JOIN availabledays a ON a.trainId=t.trainId WHERE a.monday="Yes" AND t.src_station <> :destStation
                AND j.journey_status="Live"
                ');
                break;
            case 'Tuesday':
                $this->db->query('SELECT t.*, s1.name AS src_name, s2.name AS dest_name, j.journeyId, j.journey_status FROM train t
                INNER JOIN (SELECT r.trainId FROM route r INNER JOIN route_station rs ON r.routeId=rs.routeId WHERE rs.stationID=:destStation AND rs.departuretime>=cast(:time AS time)) t1 ON t.trainId=t1.trainId
                INNER JOIN station s1 ON t.src_station=s1.stationID
                INNER JOIN station s2 ON t.dest_station=s2.stationID
                INNER JOIN journey j ON t.trainId=j.trainId
                INNER JOIN availabledays a ON a.trainId=t.trainId WHERE a.tuesday="Yes" AND t.src_station <> :destStation
                AND j.journey_status="Live"
                ');
            case 'Wednesday':
                $this->db->query('SELECT t.*, s1.name AS src_name, s2.name AS dest_name, j.journeyId, j.journey_status FROM train t
                INNER JOIN (SELECT r.trainId FROM route r INNER JOIN route_station rs ON r.routeId=rs.routeId WHERE rs.stationID=:destStation AND rs.departuretime>=cast(:time AS time)) t1 ON t.trainId=t1.trainId
                INNER JOIN station s1 ON t.src_station=s1.stationID
                INNER JOIN station s2 ON t.dest_station=s2.stationID
                INNER JOIN journey j ON t.trainId=j.trainId
                INNER JOIN availabledays a ON a.trainId=t.trainId WHERE a.wednesday="Yes" AND t.src_station <> :destStation
                AND j.journey_status="Live"
                ');
                break;
            case 'Thursday':
                $this->db->query('SELECT t.*, s1.name AS src_name, s2.name AS dest_name, j.journeyId, j.journey_status FROM train t
                INNER JOIN (SELECT r.trainId FROM route r INNER JOIN route_station rs ON r.routeId=rs.routeId WHERE rs.stationID=:destStation AND rs.departuretime>=cast(:time AS time)) t1 ON t.trainId=t1.trainId
                INNER JOIN station s1 ON t.src_station=s1.stationID
                INNER JOIN station s2 ON t.dest_station=s2.stationID
                INNER JOIN journey j ON t.trainId=j.trainId
                INNER JOIN availabledays a ON a.trainId=t.trainId WHERE a.thursday="Yes" AND t.src_station <> :destStation
                AND j.journey_status="Live"
                ');
                break;
            case 'Friday':
                $this->db->query('SELECT t.*, s1.name AS src_name, s2.name AS dest_name, j.journeyId, j.journey_status FROM train t
                INNER JOIN (SELECT r.trainId FROM route r INNER JOIN route_station rs ON r.routeId=rs.routeId WHERE rs.stationID=:destStation AND rs.departuretime>=cast(:time AS time)) t1 ON t.trainId=t1.trainId
                INNER JOIN station s1 ON t.src_station=s1.stationID
                INNER JOIN station s2 ON t.dest_station=s2.stationID
                INNER JOIN journey j ON t.trainId=j.trainId
                INNER JOIN availabledays a ON a.trainId=t.trainId WHERE a.friday="Yes" AND t.src_station <> :destStation
                AND j.journey_status="Live"
                ');
                break;
            case 'Saturday':
                $this->db->query('SELECT t.*, s1.name AS src_name, s2.name AS dest_name, j.journeyId, j.journey_status FROM train t
                INNER JOIN (SELECT r.trainId FROM route r INNER JOIN route_station rs ON r.routeId=rs.routeId WHERE rs.stationID=:destStation AND rs.departuretime>=cast(:time AS time)) t1 ON t.trainId=t1.trainId
                INNER JOIN station s1 ON t.src_station=s1.stationID
                INNER JOIN station s2 ON t.dest_station=s2.stationID
                INNER JOIN availabledays a ON a.trainId=t.trainId WHERE a.saturday="Yes" AND t.src_station <> :destStation
                AND j.journey_status="Live"
                ');
                break;
            case 'Sunday':
                $this->db->query('SELECT t.*, s1.name AS src_name, s2.name AS dest_name, j.journeyId, j.journey_status FROM train t
                INNER JOIN (SELECT r.trainId FROM route r INNER JOIN route_station rs ON r.routeId=rs.routeId WHERE rs.stationID=:destStation AND rs.departuretime>=cast(:time AS time)) t1 ON t.trainId=t1.trainId
                INNER JOIN station s1 ON t.src_station=s1.stationID
                INNER JOIN station s2 ON t.dest_station=s2.stationID
                INNER JOIN journey j ON t.trainId=j.trainId
                INNER JOIN availabledays a ON a.trainId=t.trainId WHERE a.sunday="Yes" AND t.src_station <> :destStation
                AND j.journey_status="Live"
                ');
                break;
        }

        $this->db->bind(':destStation', $data['destStation']);
        $this->db->bind(':time', $data['time']);
        $trains=$this->db->resultSet();
        return $trains;
    }


    public function searchSrcDestOnly($data){
        $this->db->query('SELECT t.*, s1.name AS src_name, s2.name AS dest_name, j.journeyId, j.journey_status  FROM train t
            INNER JOIN (SELECT t1.trainId FROM
                                (SELECT r.trainId, rs.stopNo, rs.departuretime FROM route r INNER JOIN route_station rs ON r.routeId=rs.routeId WHERE rs.stationID=:srcStation)
                                 t1 INNER JOIN (SELECT r.trainId, rs.stopNo FROM route r INNER JOIN route_station rs ON r.routeId=rs.routeId WHERE rs.stationID=:destStation)
                                 t2 ON t1.trainId=t2.trainId WHERE t1.stopNo<t2.stopNo and t1.departuretime>=cast(:time AS time)) 
            t3 ON t.trainId=t3.trainId
            INNER JOIN station s1 ON s1.stationID=t.src_station
            INNER JOIN journey j ON t.trainId=j.trainId
            INNER JOIN station s2 ON s2.stationID=t.dest_station
            WHERE j.journey_status="Live"
            ');

        $this->db->bind(':srcStation', $data['srcStation']);
        $this->db->bind(':destStation', $data['destStation']);
        $this->db->bind(':time', $data['time']);

        $trains=$this->db->resultSet();
        return $trains;

    }

    public function searchSrcDestDate($data){
        switch ($data['date']){
            case 'Monday':
                $this->db->query('SELECT t.*, s1.name AS src_name, s2.name AS dest_name, j.journeyId, j.journey_status  FROM train t
                    INNER JOIN (SELECT t1.trainId FROM
                                        (SELECT r.trainId, rs.stopNo, rs.departuretime FROM route r INNER JOIN route_station rs ON r.routeId=rs.routeId WHERE rs.stationID=:srcStation)
                                         t1 INNER JOIN (SELECT r.trainId, rs.stopNo FROM route r INNER JOIN route_station rs ON r.routeId=rs.routeId WHERE rs.stationID=:destStation)
                                         t2 ON t1.trainId=t2.trainId WHERE t1.stopNo<t2.stopNo and t1.departuretime>=cast(:time AS time)) 
                    t3 ON t.trainId=t3.trainId
                    INNER JOIN station s1 ON s1.stationID=t.src_station
                    INNER JOIN station s2 ON s2.stationID=t.dest_station
                    INNER JOIN journey j ON t.trainId=j.trainId
                    INNER JOIN availabledays a ON a.trainId=t.trainId WHERE a.monday="Yes"
                AND j.journey_status="Live"
                ');
                break;
            case 'Tuesday':
                $this->db->query('SELECT t.*, s1.name AS src_name, s2.name AS dest_name, j.journeyId, j.journey_status  FROM train t
                    INNER JOIN (SELECT t1.trainId FROM
                                        (SELECT r.trainId, rs.stopNo, rs.departuretime FROM route r INNER JOIN route_station rs ON r.routeId=rs.routeId WHERE rs.stationID=:srcStation)
                                         t1 INNER JOIN (SELECT r.trainId, rs.stopNo FROM route r INNER JOIN route_station rs ON r.routeId=rs.routeId WHERE rs.stationID=:destStation)
                                         t2 ON t1.trainId=t2.trainId WHERE t1.stopNo<t2.stopNo and t1.departuretime>=cast(:time AS time)) 
                    t3 ON t.trainId=t3.trainId
                    INNER JOIN station s1 ON s1.stationID=t.src_station
                    INNER JOIN station s2 ON s2.stationID=t.dest_station
                    INNER JOIN journey j ON t.trainId=j.trainId
                    INNER JOIN availabledays a ON a.trainId=t.trainId WHERE a.tuesday="Yes"
                AND j.journey_status="Live"
                ');
                break;
            case 'Wednesday':
                $this->db->query('SELECT t.*, s1.name AS src_name, s2.name AS dest_name, j.journeyId, j.journey_status  FROM train t
                    INNER JOIN (SELECT t1.trainId FROM
                                        (SELECT r.trainId, rs.stopNo, rs.departuretime FROM route r INNER JOIN route_station rs ON r.routeId=rs.routeId WHERE rs.stationID=:srcStation)
                                         t1 INNER JOIN (SELECT r.trainId, rs.stopNo FROM route r INNER JOIN route_station rs ON r.routeId=rs.routeId WHERE rs.stationID=:destStation)
                                         t2 ON t1.trainId=t2.trainId WHERE t1.stopNo<t2.stopNo and t1.departuretime>=cast(:time AS time)) 
                    t3 ON t.trainId=t3.trainId
                    INNER JOIN station s1 ON s1.stationID=t.src_station
                    INNER JOIN station s2 ON s2.stationID=t.dest_station
                    INNER JOIN journey j ON t.trainId=j.trainId
                    INNER JOIN availabledays a ON a.trainId=t.trainId WHERE a.wednesday="Yes"
                AND j.journey_status="Live"
                ');
                break;
            case 'Thursday':
                $this->db->query('SELECT t.*, s1.name AS src_name, s2.name AS dest_name, j.journeyId, j.journey_status  FROM train t
                    INNER JOIN (SELECT t1.trainId FROM
                                        (SELECT r.trainId, rs.stopNo, rs.departuretime FROM route r INNER JOIN route_station rs ON r.routeId=rs.routeId WHERE rs.stationID=:srcStation)
                                         t1 INNER JOIN (SELECT r.trainId, rs.stopNo FROM route r INNER JOIN route_station rs ON r.routeId=rs.routeId WHERE rs.stationID=:destStation)
                                         t2 ON t1.trainId=t2.trainId WHERE t1.stopNo<t2.stopNo and t1.departuretime>=cast(:time AS time)) 
                    t3 ON t.trainId=t3.trainId
                    INNER JOIN station s1 ON s1.stationID=t.src_station
                    INNER JOIN station s2 ON s2.stationID=t.dest_station
                    INNER JOIN journey j ON t.trainId=j.trainId
                    INNER JOIN availabledays a ON a.trainId=t.trainId WHERE a.thursday="Yes"
                AND j.journey_status="Live"
                ');
                break;
            case 'Friday':
                $this->db->query('SELECT t.*, s1.name AS src_name, s2.name AS dest_name, j.journeyId, j.journey_status  FROM train t
                    INNER JOIN (SELECT t1.trainId FROM
                                        (SELECT r.trainId, rs.stopNo, rs.departuretime FROM route r INNER JOIN route_station rs ON r.routeId=rs.routeId WHERE rs.stationID=:srcStation)
                                         t1 INNER JOIN (SELECT r.trainId, rs.stopNo FROM route r INNER JOIN route_station rs ON r.routeId=rs.routeId WHERE rs.stationID=:destStation)
                                         t2 ON t1.trainId=t2.trainId WHERE t1.stopNo<t2.stopNo and t1.departuretime>=cast(:time AS time)) 
                    t3 ON t.trainId=t3.trainId
                    INNER JOIN station s1 ON s1.stationID=t.src_station
                    INNER JOIN station s2 ON s2.stationID=t.dest_station
                    INNER JOIN journey j ON t.trainId=j.trainId
                    INNER JOIN availabledays a ON a.trainId=t.trainId WHERE a.friday="Yes"
                AND j.journey_status="Live"
                ');
                break;
            case 'Saturday':
                $this->db->query('SELECT t.*, s1.name AS src_name, s2.name AS dest_name, j.journeyId, j.journey_status  FROM train t
                    INNER JOIN (SELECT t1.trainId FROM
                                        (SELECT r.trainId, rs.stopNo, rs.departuretime FROM route r INNER JOIN route_station rs ON r.routeId=rs.routeId WHERE rs.stationID=:srcStation)
                                         t1 INNER JOIN (SELECT r.trainId, rs.stopNo FROM route r INNER JOIN route_station rs ON r.routeId=rs.routeId WHERE rs.stationID=:destStation)
                                         t2 ON t1.trainId=t2.trainId WHERE t1.stopNo<t2.stopNo and t1.departuretime>=cast(:time AS time)) 
                    t3 ON t.trainId=t3.trainId
                    INNER JOIN station s1 ON s1.stationID=t.src_station
                    INNER JOIN station s2 ON s2.stationID=t.dest_station
                    INNER JOIN journey j ON t.trainId=j.trainId
                    INNER JOIN availabledays a ON a.trainId=t.trainId WHERE a.saturday="Yes"
                AND j.journey_status="Live"
                ');
                break;
            case 'Sunday':
                $this->db->query('SELECT t.*, s1.name AS src_name, s2.name AS dest_name, j.journeyId, j.journey_status  FROM train t
                    INNER JOIN (SELECT t1.trainId FROM
                                        (SELECT r.trainId, rs.stopNo, rs.departuretime FROM route r INNER JOIN route_station rs ON r.routeId=rs.routeId WHERE rs.stationID=:srcStation)
                                         t1 INNER JOIN (SELECT r.trainId, rs.stopNo FROM route r INNER JOIN route_station rs ON r.routeId=rs.routeId WHERE rs.stationID=:destStation)
                                         t2 ON t1.trainId=t2.trainId WHERE t1.stopNo<t2.stopNo and t1.departuretime>=cast(:time AS time)) 
                    t3 ON t.trainId=t3.trainId
                    INNER JOIN station s1 ON s1.stationID=t.src_station
                    INNER JOIN station s2 ON s2.stationID=t.dest_station
                    INNER JOIN journey j ON t.trainId=j.trainId
                    INNER JOIN availabledays a ON a.trainId=t.trainId WHERE a.sunday="Yes"
                AND j.journey_status="Live"
                ');
                break;

        }
        $this->db->bind(':srcStation', $data['srcStation']);
        $this->db->bind(':destStation', $data['destStation']);
        $this->db->bind(':time', $data['time']);

        $trains=$this->db->resultSet();
        return $trains;

    }

    public function  getTrain($trainId){
        $this->db->query('SELECT t.*, src.name AS src_name, dest.name AS dest_name FROM train t
                INNER JOIN station src ON src.stationId=t.src_station
                INNER  JOIN station dest ON dest.stationId=t.dest_Station
    WHERE t.trainId=:trainId');
        $this->db->bind(":trainId", $trainId);
        $row=$this->db->single();
        return $row;
    }

    public function getJourney($journeyId){
        $this->db->query("SELECT * FROM journey WHERE journeyId=:journeyId AND journey_status<>'Ended'");
        $this->db->bind(":journeyId", $journeyId);
        $journey=$this->db->single();
        return $journey;
    }







//appandtrackrelated
    public function getJourneyLocation($journeyId){
        $this->db->query("SELECT * FROM location l 
        INNER JOIN journey j on j.journeyId=l.journeyId 
        INNER JOIN train t on j.trainId=t.trainId 
    WHERE l.journeyId=:journeyId and j.journey_status<>'Ended'");
        $this->db->bind(':journeyId', $journeyId);
        $results=$this->db->resultSet();
        return $results;
    }

    public function getLiveTrains(){
        $this->db->query("SELECT * FROM location l 
        INNER JOIN journey j on j.journeyId=l.journeyId 
        INNER JOIN train t on j.trainId=t.trainId 
    WHERE j.journey_status<>'Ended'");
        $results=$this->db->resultSet();
        return $results;
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


    public function getEndedJourneys($date, $time){
        $this->db->query("SELECT * FROM journey WHERE ended_date>=:date AND ended_time>=:time AND journey_status='Ended'");
        $this->db->bind(':date', $date);
        $this->db->bind(':time', $time);
        $results=$this->db->resultSet();
        return $results;
    }




}