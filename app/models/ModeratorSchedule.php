<?php
class ModeratorSchedule{
    private $db;

    public function __construct()
    {
        $this->db= new Database;
    }

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
        $this->db->query('SELECT * FROM train 
        WHERE trainID=(SELECT r.trainId FROM route r INNER JOIN route_station rs ON r.routeId=rs.routeId WHERE rs.stationID=:srcStation AND rs.departuretime>=cast(:time AS time))
           OR src_station=:srcStation');
        $this->db->bind(':time', $data['time']);
        $this->db->bind(':srcStation', $data['srcStation']);

        $trains=$this->db->resultSet();
        return $trains;
    }

    public function searchSrcDate($data)
    {
        switch ($data['date']) {
            case 'Monday':
                $this->db->query('SELECT t1.* FROM 
                 (SELECT * FROM train WHERE
                        trainID=(SELECT r.trainId FROM route r INNER JOIN 
                            route_station rs ON r.routeId=rs.routeId WHERE rs.stationID=:srcStation AND rs.departuretime>=cast(1 AS time))
                            OR src_station=:srcStation)
                     t1 INNER JOIN availabledays a ON t1.trainId=a.trainId WHERE a.monday="Yes"');
                break;
            case 'Tuesday':
                $this->db->query('SELECT t1.* FROM 
                 (SELECT * FROM train WHERE
                        trainID=(SELECT r.trainId FROM route r INNER JOIN 
                            route_station rs ON r.routeId=rs.routeId WHERE rs.stationID=:srcStation AND rs.departuretime>=cast(1 AS time))
                            OR src_station=:srcStation)
                     t1 INNER JOIN availabledays a ON t1.trainId=a.trainId WHERE a.tuesday="Yes"');
                break;
            case 'Wednesday':
                $this->db->query('SELECT t1.* FROM 
                 (SELECT * FROM train WHERE
                        trainID=(SELECT r.trainId FROM route r INNER JOIN 
                            route_station rs ON r.routeId=rs.routeId WHERE rs.stationID=:srcStation AND rs.departuretime>=cast(1 AS time))
                            OR src_station=:srcStation)
                     t1 INNER JOIN availabledays a ON t1.trainId=a.trainId WHERE a.wednesday="Yes"');
                break;
            case 'Thursday':
                $this->db->query('SELECT t1.* FROM 
                 (SELECT * FROM train WHERE
                        trainID=(SELECT r.trainId FROM route r INNER JOIN 
                            route_station rs ON r.routeId=rs.routeId WHERE rs.stationID=:srcStation AND rs.departuretime>=cast(1 AS time))
                            OR src_station=:srcStation)
                     t1 INNER JOIN availabledays a ON t1.trainId=a.trainId WHERE a.thursday="Yes"');
                break;
            case 'Friday':
                $this->db->query('SELECT t1.* FROM 
                 (SELECT * FROM train WHERE
                        trainID=(SELECT r.trainId FROM route r INNER JOIN 
                            route_station rs ON r.routeId=rs.routeId WHERE rs.stationID=:srcStation AND rs.departuretime>=cast(1 AS time))
                            OR src_station=:srcStation)
                     t1 INNER JOIN availabledays a ON t1.trainId=a.trainId WHERE a.friday="Yes"');
                break;
            case 'Saturday':
                $this->db->query('SELECT t1.* FROM 
                 (SELECT * FROM train WHERE
                        trainID=(SELECT r.trainId FROM route r INNER JOIN 
                            route_station rs ON r.routeId=rs.routeId WHERE rs.stationID=:srcStation AND rs.departuretime>=cast(1 AS time))
                            OR src_station=:srcStation)
                     t1 INNER JOIN availabledays a ON t1.trainId=a.trainId WHERE a.saturday="Yes"');
                break;
            case 'Sunday':
                $this->db->query('SELECT t1.* FROM 
                 (SELECT * FROM train WHERE
                        trainID=(SELECT r.trainId FROM route r INNER JOIN 
                            route_station rs ON r.routeId=rs.routeId WHERE rs.stationID=:srcStation AND rs.departuretime>=cast(1 AS time))
                            OR src_station=:srcStation)
                     t1 INNER JOIN availabledays a ON t1.trainId=a.trainId WHERE a.sunday="Yes"');
        }

        $this->db->bind(':srcStation', $data['srcStation']);
        $this->db->bind(':time', $data['time']);
        $trains=$this->db->resultSet();
        return $trains;
    }


    public function searchDestOnly($data)
    {
        $this->db->query('SELECT * FROM train 
        WHERE trainID=(SELECT r.trainId FROM route r INNER JOIN route_station rs ON r.routeId=rs.routeId WHERE rs.stationID=:destStation AND rs.departuretime>=cast(:time AS time))
           OR dest_station=:destStation');
        $this->db->bind(':destStation', $data['destStation']);
        $this->db->bind(':time', $data['time']);
        $trains = $this->db->resultSet();
        return $trains;
    }

    public function searchDestDate($data)
    {
        switch ($data['date']) {
            case 'Monday':
                $this->db->query('SELECT t1.* FROM 
                 (SELECT * FROM train WHERE
                        trainID=(SELECT r.trainId FROM route r INNER JOIN 
                            route_station rs ON r.routeId=rs.routeId WHERE rs.stationID=:destStation AND rs.departuretime>=cast(1 AS time))
                            OR dest_station=:destStation)
                     t1 INNER JOIN availabledays a ON t1.trainId=a.trainId WHERE a.monday="Yes"');
                break;
            case 'Tuesday':
                $this->db->query('SELECT t1.* FROM 
                 (SELECT * FROM train WHERE
                        trainID=(SELECT r.trainId FROM route r INNER JOIN 
                            route_station rs ON r.routeId=rs.routeId WHERE rs.stationID=:destStation AND rs.departuretime>=cast(1 AS time))
                            OR dest_station=:destStation)
                     t1 INNER JOIN availabledays a ON t1.trainId=a.trainId WHERE a.tuesday="Yes"');
            case 'Wednesday':
                $this->db->query('SELECT t1.* FROM 
                 (SELECT * FROM train WHERE
                        trainID=(SELECT r.trainId FROM route r INNER JOIN 
                            route_station rs ON r.routeId=rs.routeId WHERE rs.stationID=:destStation AND rs.departuretime>=cast(1 AS time))
                            OR dest_station=:destStation)
                     t1 INNER JOIN availabledays a ON t1.trainId=a.trainId WHERE a.wednesday="Yes"');
                break;
            case 'Thursday':
                $this->db->query('SELECT t1.* FROM 
                 (SELECT * FROM train WHERE
                        trainID=(SELECT r.trainId FROM route r INNER JOIN 
                            route_station rs ON r.routeId=rs.routeId WHERE rs.stationID=:destStation AND rs.departuretime>=cast(1 AS time))
                            OR dest_station=:destStation)
                     t1 INNER JOIN availabledays a ON t1.trainId=a.trainId WHERE a.thursday="Yes"');
                break;
            case 'Friday':
                $this->db->query('SELECT t1.* FROM 
                 (SELECT * FROM train WHERE
                        trainID=(SELECT r.trainId FROM route r INNER JOIN 
                            route_station rs ON r.routeId=rs.routeId WHERE rs.stationID=:destStation AND rs.departuretime>=cast(1 AS time))
                            OR dest_station=:destStation)
                     t1 INNER JOIN availabledays a ON t1.trainId=a.trainId WHERE a.friday="Yes"');
                break;
            case 'Saturday':
                $this->db->query('SELECT t1.* FROM 
                 (SELECT * FROM train WHERE
                        trainID=(SELECT r.trainId FROM route r INNER JOIN 
                            route_station rs ON r.routeId=rs.routeId WHERE rs.stationID=:destStation AND rs.departuretime>=cast(1 AS time))
                            OR dest_station=:destStation)
                     t1 INNER JOIN availabledays a ON t1.trainId=a.trainId WHERE a.saturday="Yes"');
                break;
            case 'Sunday':
                $this->db->query('SELECT t1.* FROM 
                 (SELECT * FROM train WHERE
                        trainID=(SELECT r.trainId FROM route r INNER JOIN 
                            route_station rs ON r.routeId=rs.routeId WHERE rs.stationID=:destStation AND rs.departuretime>=cast(1 AS time))
                            OR dest_station=:destStation)
                     t1 INNER JOIN availabledays a ON t1.trainId=a.trainId WHERE a.sunday="Yes"');
                break;
        }

        $this->db->bind(':destStation', $data['destStation']);
        $this->db->bind(':time', $data['time']);
        $trains=$this->db->resultSet();
        return $trains;
    }


    public function searchSrcDestOnly($data){
        $this->db->query('SELECT * FROM train
            WHERE trainid=(SELECT t1.trainId FROM
                                (SELECT r.trainId, rs.stopNo, rs.departuretime FROM route r INNER JOIN route_station rs ON r.routeId=rs.routeId WHERE rs.stationID=:srcStation)
                                    t1 INNER JOIN (SELECT r.trainId, rs.stopNo FROM route r INNER JOIN route_station rs ON r.routeId=rs.routeId WHERE rs.stationID=:destStation)
                                        t2 ON t1.trainId=t2.trainId WHERE t1.stopNo<t2.stopNo and t1.departuretime>=cast(:time AS time))
            OR src_station=:srcStation OR dest_station=:destStation');

        $this->db->bind(':srcStation', $data['srcStation']);
        $this->db->bind(':destStation', $data['destStation']);
        $this->db->bind(':time', $data['time']);

        $trains=$this->db->resultSet();
        return $trains;

    }

    public function searchSrcDestDate($data){
        switch ($data['date']){
            case 'Monday':
                $this->db->query('SELECT t3.* FROM 
                 (SELECT * FROM train WHERE
                        trainid=(SELECT t1.trainId FROM (SELECT r.trainId, rs.stopNo, rs.departuretime FROM route r INNER JOIN route_station rs ON r.routeId=rs.routeId WHERE rs.stationID=:srcStation) t1
                            INNER JOIN (SELECT r.trainId, rs.stopNo FROM route r INNER JOIN route_station rs ON r.routeId=rs.routeId WHERE rs.stationID=:destStation) t2
                                ON t1.trainId=t2.trainId WHERE t1.stopNo<t2.stopNo and t1.departuretime>=cast(1 AS time))
                                         OR src_station=:srcStation OR dest_station=:destStation) t3
                     INNER JOIN availabledays a on a.trainId=t3.trainId WHERE a.monday="Yes"');
                break;
            case 'Tuesday':
                $this->db->query('SELECT t3.* FROM 
                 (SELECT * FROM train WHERE
                        trainid=(SELECT t1.trainId FROM (SELECT r.trainId, rs.stopNo, rs.departuretime FROM route r INNER JOIN route_station rs ON r.routeId=rs.routeId WHERE rs.stationID=:srcStation) t1
                            INNER JOIN (SELECT r.trainId, rs.stopNo FROM route r INNER JOIN route_station rs ON r.routeId=rs.routeId WHERE rs.stationID=:destStation) t2
                                ON t1.trainId=t2.trainId WHERE t1.stopNo<t2.stopNo and t1.departuretime>=cast(1 AS time))
                                         OR src_station=:srcStation OR dest_station=:destStation) t3
                     INNER JOIN availabledays a on a.trainId=t3.trainId WHERE a.tuesday="Yes"');
                break;
            case 'Wednesday':
                $this->db->query('SELECT t3.* FROM 
                 (SELECT * FROM train WHERE
                        trainid=(SELECT t1.trainId FROM (SELECT r.trainId, rs.stopNo, rs.departuretime FROM route r INNER JOIN route_station rs ON r.routeId=rs.routeId WHERE rs.stationID=:srcStation) t1
                            INNER JOIN (SELECT r.trainId, rs.stopNo FROM route r INNER JOIN route_station rs ON r.routeId=rs.routeId WHERE rs.stationID=:destStation) t2
                                ON t1.trainId=t2.trainId WHERE t1.stopNo<t2.stopNo and t1.departuretime>=cast(1 AS time))
                                         OR src_station=:srcStation OR dest_station=:destStation) t3
                     INNER JOIN availabledays a on a.trainId=t3.trainId WHERE a.wednesday="Yes"');
                break;
            case 'Thursday':
                $this->db->query('SELECT t3.* FROM 
                 (SELECT * FROM train WHERE
                        trainid=(SELECT t1.trainId FROM (SELECT r.trainId, rs.stopNo, rs.departuretime FROM route r INNER JOIN route_station rs ON r.routeId=rs.routeId WHERE rs.stationID=:srcStation) t1
                            INNER JOIN (SELECT r.trainId, rs.stopNo FROM route r INNER JOIN route_station rs ON r.routeId=rs.routeId WHERE rs.stationID=:destStation) t2
                                ON t1.trainId=t2.trainId WHERE t1.stopNo<t2.stopNo and t1.departuretime>=cast(1 AS time))
                                         OR src_station=:srcStation OR dest_station=:destStation) t3
                     INNER JOIN availabledays a on a.trainId=t3.trainId WHERE a.thursday="Yes"');
                break;
            case 'Friday':
                $this->db->query('SELECT t3.* FROM 
                 (SELECT * FROM train WHERE
                        trainid=(SELECT t1.trainId FROM (SELECT r.trainId, rs.stopNo, rs.departuretime FROM route r INNER JOIN route_station rs ON r.routeId=rs.routeId WHERE rs.stationID=:srcStation) t1
                            INNER JOIN (SELECT r.trainId, rs.stopNo FROM route r INNER JOIN route_station rs ON r.routeId=rs.routeId WHERE rs.stationID=:destStation) t2
                                ON t1.trainId=t2.trainId WHERE t1.stopNo<t2.stopNo and t1.departuretime>=cast(1 AS time))
                                         OR src_station=:srcStation OR dest_station=:destStation) t3
                     INNER JOIN availabledays a on a.trainId=t3.trainId WHERE a.friday="Yes"');
                break;
            case 'Saturday':
                $this->db->query('SELECT t3.* FROM 
                 (SELECT * FROM train WHERE
                        trainid=(SELECT t1.trainId FROM (SELECT r.trainId, rs.stopNo, rs.departuretime FROM route r INNER JOIN route_station rs ON r.routeId=rs.routeId WHERE rs.stationID=:srcStation) t1
                            INNER JOIN (SELECT r.trainId, rs.stopNo FROM route r INNER JOIN route_station rs ON r.routeId=rs.routeId WHERE rs.stationID=:destStation) t2
                                ON t1.trainId=t2.trainId WHERE t1.stopNo<t2.stopNo and t1.departuretime>=cast(1 AS time))
                                         OR src_station=:srcStation OR dest_station=:destStation) t3
                     INNER JOIN availabledays a on a.trainId=t3.trainId WHERE a.saturday="Yes"');
                break;
            case 'Sunday':
                $this->db->query('SELECT t3.* FROM 
                 (SELECT * FROM train WHERE
                        trainid=(SELECT t1.trainId FROM (SELECT r.trainId, rs.stopNo, rs.departuretime FROM route r INNER JOIN route_station rs ON r.routeId=rs.routeId WHERE rs.stationID=:srcStation) t1
                            INNER JOIN (SELECT r.trainId, rs.stopNo FROM route r INNER JOIN route_station rs ON r.routeId=rs.routeId WHERE rs.stationID=:destStation) t2
                                ON t1.trainId=t2.trainId WHERE t1.stopNo<t2.stopNo and t1.departuretime>=cast(1 AS time))
                                         OR src_station=:srcStation OR dest_station=:destStation) t3
                     INNER JOIN availabledays a on a.trainId=t3.trainId WHERE a.sunday="Yes"');
                break;

        }
        $this->db->bind(':srcStation', $data['srcStation']);
        $this->db->bind(':destStation', $data['destStation']);
        $this->db->bind(':time', $data['time']);

        $trains=$this->db->resultSet();
        return $trains;

    }

    public function getTrain($trainId){
        $this->db->query('
SELECT t1.*, ss.name AS src_name FROM
    (SELECT t.*, sd.name AS dest_name FROM train t INNER JOIN station sd ON t.dest_station=sd.stationID WHERE t.trainId=:trainId)
    t1 INNER JOIN station ss ON t1.src_station=ss.stationID');
        $this->db->bind(':trainId', $trainId);
        $row=$this->db->single();
        return $row;
    }

    public function getSchedule($trainId){
        $this->db->query('SELECT t1.*,s.name FROM (SELECT rs.* FROM (SELECT * FROM route WHERE trainId=:trainId) rt INNER JOIN route_station rs ON rs.routeId=rt.routeId) t1 INNER JOIN station s on s.stationId=t1.stationId');
        $this->db->bind(':trainId', $trainId);
        $results=$this->db->resultSet();
        return $results;
    }

    public function getDays($trainId){
        $this->db->query('SELECT * FROM availabledays WHERE trainid=:trainId');
        $this->db->bind(':trainId', $trainId);
        $row=$this->db->single();
        return $row;
    }












    

}