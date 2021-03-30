<?php 
    class ResOfficerReservation {
        private $db;

        public function __construct() {
            $this->db = new Database;
        }


        public function getStations(){ // get station id and names

            $this->db->query('SELECT stationID AS stationId, name AS stationName FROM station');
            $results = $this->db->resultSet();
            return $results;
        }

        public function getStationId($staionName){ // find station by name
            $this->db->query('SELECT stationID AS stationId FROM station WHERE name=:src');
            $this->db->bind(':src',$staionName);
            $results = $this->db->single();
            return $results;
        }


        public function searchSrc($data){ // search only with source

            $this->db->query('SELECT t.*, s1.name AS srcName, s2.name AS destName FROM train t 
                INNER JOIN (SELECT DISTINCT r.trainId FROM route r INNER JOIN route_station rs ON r.routeId=rs.routeId WHERE rs.stationId=:src) t1 ON t.trainId=t1.trainId 
                INNER JOIN station s1 ON s1.stationID=t.src_station 
                INNER JOIN station s2 ON s2.stationID=t.dest_station
                    WHERE :src!=t.dest_station AND t.reservable_status!=0');
            $this->db->bind(':src',$data['src']);
            $results = $this->db->resultSet();
            return $results;
        }

        public function searchSrcDate($data){ // search only with source and date

            switch($data['date']){
                case 'Monday':
                    $this->db->query("SELECT t.*, s1.name AS srcName, s2.name AS destName FROM train t 
                    INNER JOIN (SELECT DISTINCT r.trainId FROM route r INNER JOIN route_station rs ON r.routeId=rs.routeId WHERE rs.stationId=:src) t1 ON t.trainId=t1.trainId 
                    INNER JOIN station s1 ON s1.stationID=t.src_station 
                    INNER JOIN station s2 ON s2.stationID=t.dest_station
                    INNER JOIN availabledays a ON a.trainId=t.trainId
                        WHERE :src!=t.dest_station AND a.Monday='Yes' AND t.reservable_status!=0 AND t.trainId NOT IN (SELECT a.trainId FROM alerts a INNER JOIN cancelled_alerts c ON a.alertId=c.alertId WHERE c.cancellation_date = :journeyDate UNION SELECT a.trainId FROM alerts a INNER JOIN rescheduled_alerts r ON a.alertId=r.alertId WHERE r.olddate = :journeyDate)");
                    break;

                case 'Tuesday':
                    $this->db->query("SELECT t.*, s1.name AS srcName, s2.name AS destName FROM train t 
                    INNER JOIN (SELECT DISTINCT r.trainId FROM route r INNER JOIN route_station rs ON r.routeId=rs.routeId WHERE rs.stationId=:src) t1 ON t.trainId=t1.trainId 
                    INNER JOIN station s1 ON s1.stationID=t.src_station 
                    INNER JOIN station s2 ON s2.stationID=t.dest_station
                    INNER JOIN availabledays a ON a.trainId=t.trainId
                        WHERE :src!=t.dest_station AND a.Tuesday='Yes' AND t.reservable_status!=0 AND t.trainId NOT IN (SELECT a.trainId FROM alerts a INNER JOIN cancelled_alerts c ON a.alertId=c.alertId WHERE c.cancellation_date = :journeyDate UNION SELECT a.trainId FROM alerts a INNER JOIN rescheduled_alerts r ON a.alertId=r.alertId WHERE r.olddate = :journeyDate)");
                    $this->db->bind(':journeyDate',$data['dateFull']);
                    break;

                case 'Wednesday':
                    $this->db->query("SELECT t.*, s1.name AS srcName, s2.name AS destName FROM train t 
                    INNER JOIN (SELECT DISTINCT r.trainId FROM route r INNER JOIN route_station rs ON r.routeId=rs.routeId WHERE rs.stationId=:src) t1 ON t.trainId=t1.trainId 
                    INNER JOIN station s1 ON s1.stationID=t.src_station 
                    INNER JOIN station s2 ON s2.stationID=t.dest_station
                    INNER JOIN availabledays a ON a.trainId=t.trainId
                        WHERE :src!=t.dest_station AND a.Wednesday='Yes' AND t.reservable_status!=0 AND t.trainId NOT IN (SELECT a.trainId FROM alerts a INNER JOIN cancelled_alerts c ON a.alertId=c.alertId WHERE c.cancellation_date = :journeyDate UNION SELECT a.trainId FROM alerts a INNER JOIN rescheduled_alerts r ON a.alertId=r.alertId WHERE r.olddate = :journeyDate)");
                    $this->db->bind(':journeyDate',$data['dateFull']);
                    break;

                case 'Thursday':
                    $this->db->query("SELECT t.*, s1.name AS srcName, s2.name AS destName FROM train t 
                    INNER JOIN (SELECT DISTINCT r.trainId FROM route r INNER JOIN route_station rs ON r.routeId=rs.routeId WHERE rs.stationId=:src) t1 ON t.trainId=t1.trainId 
                    INNER JOIN station s1 ON s1.stationID=t.src_station 
                    INNER JOIN station s2 ON s2.stationID=t.dest_station
                    INNER JOIN availabledays a ON a.trainId=t.trainId
                        WHERE :src!=t.dest_station AND a.Thursday='Yes' AND t.reservable_status!=0 AND t.trainId NOT IN (SELECT a.trainId FROM alerts a INNER JOIN cancelled_alerts c ON a.alertId=c.alertId WHERE c.cancellation_date = :journeyDate UNION SELECT a.trainId FROM alerts a INNER JOIN rescheduled_alerts r ON a.alertId=r.alertId WHERE r.olddate = :journeyDate)");
                    $this->db->bind(':journeyDate',$data['dateFull']);
                    break;

                case 'Friday':
                    $this->db->query("SELECT t.*, s1.name AS srcName, s2.name AS destName FROM train t 
                    INNER JOIN (SELECT DISTINCT r.trainId FROM route r INNER JOIN route_station rs ON r.routeId=rs.routeId WHERE rs.stationId=:src) t1 ON t.trainId=t1.trainId 
                    INNER JOIN station s1 ON s1.stationID=t.src_station 
                    INNER JOIN station s2 ON s2.stationID=t.dest_station
                    INNER JOIN availabledays a ON a.trainId=t.trainId
                        WHERE :src!=t.dest_station AND a.Friday='Yes' AND t.reservable_status!=0 AND t.trainId NOT IN (SELECT a.trainId FROM alerts a INNER JOIN cancelled_alerts c ON a.alertId=c.alertId WHERE c.cancellation_date = :journeyDate UNION SELECT a.trainId FROM alerts a INNER JOIN rescheduled_alerts r ON a.alertId=r.alertId WHERE r.olddate = :journeyDate)");
                    $this->db->bind(':journeyDate',$data['dateFull']);
                    break;

                case 'Saturday':
                    $this->db->query("SELECT t.*, s1.name AS srcName, s2.name AS destName FROM train t 
                    INNER JOIN (SELECT DISTINCT r.trainId FROM route r INNER JOIN route_station rs ON r.routeId=rs.routeId WHERE rs.stationId=:src) t1 ON t.trainId=t1.trainId 
                    INNER JOIN station s1 ON s1.stationID=t.src_station 
                    INNER JOIN station s2 ON s2.stationID=t.dest_station
                    INNER JOIN availabledays a ON a.trainId=t.trainId
                        WHERE :src!=t.dest_station AND a.Saturday='Yes' AND t.reservable_status!=0 AND t.trainId NOT IN (SELECT a.trainId FROM alerts a INNER JOIN cancelled_alerts c ON a.alertId=c.alertId WHERE c.cancellation_date = :journeyDate UNION SELECT a.trainId FROM alerts a INNER JOIN rescheduled_alerts r ON a.alertId=r.alertId WHERE r.olddate = :journeyDate)");
                    $this->db->bind(':journeyDate',$data['dateFull']);
                    break;

                case 'Sunday':
                    $this->db->query("SELECT t.*, s1.name AS srcName, s2.name AS destName FROM train t 
                    INNER JOIN (SELECT DISTINCT r.trainId FROM route r INNER JOIN route_station rs ON r.routeId=rs.routeId WHERE rs.stationId=:src) t1 ON t.trainId=t1.trainId 
                    INNER JOIN station s1 ON s1.stationID=t.src_station 
                    INNER JOIN station s2 ON s2.stationID=t.dest_station
                    INNER JOIN availabledays a ON a.trainId=t.trainId
                        WHERE :src!=t.dest_station AND a.Sunday='Yes' AND t.reservable_status!=0 AND t.trainId NOT IN (SELECT a.trainId FROM alerts a INNER JOIN cancelled_alerts c ON a.alertId=c.alertId WHERE c.cancellation_date = :journeyDate UNION SELECT a.trainId FROM alerts a INNER JOIN rescheduled_alerts r ON a.alertId=r.alertId WHERE r.olddate = :journeyDate)");
                    break;

            }

            $this->db->bind(':src',$data['src']);
            $this->db->bind(':journeyDate',$data['dateFull']);
            $results = $this->db->resultSet();
            return $results;
            
        }


        public function searchSrcTime($data){ //search only with source and time

            $this->db->query('SELECT t.*, s1.name AS srcName, s2.name AS destName FROM train t 
                INNER JOIN (SELECT DISTINCT r.trainId FROM route r INNER JOIN route_station rs ON r.routeId=rs.routeId WHERE rs.stationId=:src AND rs.departuretime>=:deptTime) t1 ON t.trainId=t1.trainId 
                INNER JOIN station s1 ON s1.stationID=t.src_station 
                INNER JOIN station s2 ON s2.stationID=t.dest_station
                    WHERE :src!=t.dest_station');
            $this->db->bind(':src',$data['src']);
            $this->db->bind(':deptTime',$data['deptTime']);
            $results = $this->db->resultSet();
            return $results;
            
        }


        public function searchSrcDateTime($data){ //search only with source, date and time

            switch($data['date']){
                case 'Monday':
                    $this->db->query("SELECT t.*, s1.name AS srcName, s2.name AS destName FROM train t 
                    INNER JOIN (SELECT DISTINCT r.trainId FROM route r INNER JOIN route_station rs ON r.routeId=rs.routeId WHERE rs.stationId=:src AND rs.departuretime>=:deptTime) t1 ON t.trainId=t1.trainId 
                    INNER JOIN station s1 ON s1.stationID=t.src_station 
                    INNER JOIN station s2 ON s2.stationID=t.dest_station
                    INNER JOIN availabledays a ON a.trainId=t.trainId
                        WHERE :src!=t.dest_station AND a.monday='Yes' AND t.reservable_status!=0");
                    break;
                case 'Tuesday':
                    $this->db->query("SELECT t.*, s1.name AS srcName, s2.name AS destName FROM train t 
                    INNER JOIN (SELECT DISTINCT r.trainId FROM route r INNER JOIN route_station rs ON r.routeId=rs.routeId WHERE rs.stationId=:src AND rs.departuretime>=:deptTime) t1 ON t.trainId=t1.trainId 
                    INNER JOIN station s1 ON s1.stationID=t.src_station 
                    INNER JOIN station s2 ON s2.stationID=t.dest_station
                    INNER JOIN availabledays a ON a.trainId=t.trainId
                        WHERE :src!=t.dest_station AND a.tuesday='Yes' AND t.reservable_status!=0");
                    break;
                case 'Wednesday':
                    $this->db->query("SELECT t.*, s1.name AS srcName, s2.name AS destName FROM train t 
                    INNER JOIN (SELECT DISTINCT r.trainId FROM route r INNER JOIN route_station rs ON r.routeId=rs.routeId WHERE rs.stationId=:src AND rs.departuretime>=:deptTime) t1 ON t.trainId=t1.trainId 
                    INNER JOIN station s1 ON s1.stationID=t.src_station 
                    INNER JOIN station s2 ON s2.stationID=t.dest_station
                    INNER JOIN availabledays a ON a.trainId=t.trainId
                        WHERE :src!=t.dest_station AND a.wednesday='Yes' AND t.reservable_status!=0");
                    break;
                case 'Thursday':
                    $this->db->query("SELECT t.*, s1.name AS srcName, s2.name AS destName FROM train t 
                    INNER JOIN (SELECT DISTINCT r.trainId FROM route r INNER JOIN route_station rs ON r.routeId=rs.routeId WHERE rs.stationId=:src AND rs.departuretime>=:deptTime) t1 ON t.trainId=t1.trainId 
                    INNER JOIN station s1 ON s1.stationID=t.src_station 
                    INNER JOIN station s2 ON s2.stationID=t.dest_station
                    INNER JOIN availabledays a ON a.trainId=t.trainId
                        WHERE :src!=t.dest_station AND a.thursday='Yes' AND t.reservable_status!=0");
                    break;
                case 'Friday':
                    $this->db->query("SELECT t.*, s1.name AS srcName, s2.name AS destName FROM train t 
                    INNER JOIN (SELECT DISTINCT r.trainId FROM route r INNER JOIN route_station rs ON r.routeId=rs.routeId WHERE rs.stationId=:src AND rs.departuretime>=:deptTime) t1 ON t.trainId=t1.trainId 
                    INNER JOIN station s1 ON s1.stationID=t.src_station 
                    INNER JOIN station s2 ON s2.stationID=t.dest_station
                    INNER JOIN availabledays a ON a.trainId=t.trainId
                        WHERE :src!=t.dest_station AND a.friday='Yes' AND t.reservable_status!=0");
                    break;
                case 'Saturday':
                    $this->db->query("SELECT t.*, s1.name AS srcName, s2.name AS destName FROM train t 
                    INNER JOIN (SELECT DISTINCT r.trainId FROM route r INNER JOIN route_station rs ON r.routeId=rs.routeId WHERE rs.stationId=:src AND rs.departuretime>=:deptTime) t1 ON t.trainId=t1.trainId 
                    INNER JOIN station s1 ON s1.stationID=t.src_station 
                    INNER JOIN station s2 ON s2.stationID=t.dest_station
                    INNER JOIN availabledays a ON a.trainId=t.trainId
                        WHERE :src!=t.dest_station AND a.saturday='Yes' AND t.reservable_status!=0");
                    break;
                case 'Sunday':
                    $this->db->query("SELECT t.*, s1.name AS srcName, s2.name AS destName FROM train t 
                    INNER JOIN (SELECT DISTINCT r.trainId FROM route r INNER JOIN route_station rs ON r.routeId=rs.routeId WHERE rs.stationId=:src AND rs.departuretime>=:deptTime) t1 ON t.trainId=t1.trainId 
                    INNER JOIN station s1 ON s1.stationID=t.src_station 
                    INNER JOIN station s2 ON s2.stationID=t.dest_station
                    INNER JOIN availabledays a ON a.trainId=t.trainId
                        WHERE :src!=t.dest_station AND a.sunday='Yes' AND t.reservable_status!=0");
                    break;

            }

            $this->db->bind(':src',$data['src']);
            $this->db->bind(':deptTime',$data['deptTime']);
            $results = $this->db->resultSet();
            return $results;
        }


        public function searchSrcDest($data){ // search only with source and destination

            $this->db->query('SELECT t.*, s1.name AS srcName, s2.name AS destName FROM train t 
                INNER JOIN (SELECT DISTINCT r1.trainId FROM (SELECT r.trainId, rs.stopNo FROM route r INNER JOIN route_station rs ON r.routeId=rs.routeId WHERE rs.stationId=:src ) r1 INNER JOIN (SELECT r.trainId, rs.stopNo FROM route r INNER JOIN route_station rs ON r.routeId=rs.routeId WHERE rs.stationId=:dest) r2 ON r1.trainId=r2.trainId WHERE r1.stopNo<r2.stopNo) t1 ON t.trainId=t1.trainId  
                INNER JOIN station s1 ON s1.stationID=t.src_station 
                INNER JOIN station s2 ON s2.stationID=t.dest_station
                    WHERE :src!=t.dest_station');
            $this->db->bind(':src',$data['src']);
            $this->db->bind(':dest',$data['dest']);
            $results = $this->db->resultSet();
            return $results;
            
        }

        public function searchSrcDestDate($data){ //search only with source, destination and date

            switch($data['date']){
                case 'Monday':
                    $this->db->query("SELECT t.*, s1.name AS srcName, s2.name AS destName FROM train t 
                    INNER JOIN (SELECT DISTINCT r1.trainId FROM (SELECT r.trainId, rs.stopNo FROM route r INNER JOIN route_station rs ON r.routeId=rs.routeId WHERE rs.stationId=:src ) r1 INNER JOIN (SELECT r.trainId, rs.stopNo FROM route r INNER JOIN route_station rs ON r.routeId=rs.routeId WHERE rs.stationId=:dest) r2 ON r1.trainId=r2.trainId WHERE r1.stopNo<r2.stopNo) t1 ON t.trainId=t1.trainId  
                    INNER JOIN station s1 ON s1.stationID=t.src_station 
                    INNER JOIN station s2 ON s2.stationID=t.dest_station
                    INNER JOIN availabledays a ON a.trainId=t.trainId
                        WHERE :src!=t.dest_station AND a.monday='Yes' AND t.reservable_status!=0");
                    break;
                case 'Tuesday':
                    $this->db->query("SELECT t.*, s1.name AS srcName, s2.name AS destName FROM train t 
                    INNER JOIN (SELECT DISTINCT r1.trainId FROM (SELECT r.trainId, rs.stopNo FROM route r INNER JOIN route_station rs ON r.routeId=rs.routeId WHERE rs.stationId=:src ) r1 INNER JOIN (SELECT r.trainId, rs.stopNo FROM route r INNER JOIN route_station rs ON r.routeId=rs.routeId WHERE rs.stationId=:dest) r2 ON r1.trainId=r2.trainId WHERE r1.stopNo<r2.stopNo) t1 ON t.trainId=t1.trainId  
                    INNER JOIN station s1 ON s1.stationID=t.src_station 
                    INNER JOIN station s2 ON s2.stationID=t.dest_station
                    INNER JOIN availabledays a ON a.trainId=t.trainId
                        WHERE :src!=t.dest_station AND a.tuesday='Yes' AND t.reservable_status!=0");
                    break;
                case 'Wednesday':
                    $this->db->query("SELECT t.*, s1.name AS srcName, s2.name AS destName FROM train t 
                    INNER JOIN (SELECT DISTINCT r1.trainId FROM (SELECT r.trainId, rs.stopNo FROM route r INNER JOIN route_station rs ON r.routeId=rs.routeId WHERE rs.stationId=:src ) r1 INNER JOIN (SELECT r.trainId, rs.stopNo FROM route r INNER JOIN route_station rs ON r.routeId=rs.routeId WHERE rs.stationId=:dest) r2 ON r1.trainId=r2.trainId WHERE r1.stopNo<r2.stopNo) t1 ON t.trainId=t1.trainId  
                    INNER JOIN station s1 ON s1.stationID=t.src_station 
                    INNER JOIN station s2 ON s2.stationID=t.dest_station
                    INNER JOIN availabledays a ON a.trainId=t.trainId
                        WHERE :src!=t.dest_station AND a.wednesday='Yes' AND t.reservable_status!=0");
                    break;
                case 'Thursday':
                    $this->db->query("SELECT t.*, s1.name AS srcName, s2.name AS destName FROM train t 
                    INNER JOIN (SELECT DISTINCT r1.trainId FROM (SELECT r.trainId, rs.stopNo FROM route r INNER JOIN route_station rs ON r.routeId=rs.routeId WHERE rs.stationId=:src ) r1 INNER JOIN (SELECT r.trainId, rs.stopNo FROM route r INNER JOIN route_station rs ON r.routeId=rs.routeId WHERE rs.stationId=:dest) r2 ON r1.trainId=r2.trainId WHERE r1.stopNo<r2.stopNo) t1 ON t.trainId=t1.trainId  
                    INNER JOIN station s1 ON s1.stationID=t.src_station 
                    INNER JOIN station s2 ON s2.stationID=t.dest_station
                    INNER JOIN availabledays a ON a.trainId=t.trainId
                        WHERE :src!=t.dest_station AND a.thursday='Yes' AND t.reservable_status!=0");
                    break;
                case 'Friday':
                    $this->db->query("SELECT t.*, s1.name AS srcName, s2.name AS destName FROM train t 
                    INNER JOIN (SELECT DISTINCT r1.trainId FROM (SELECT r.trainId, rs.stopNo FROM route r INNER JOIN route_station rs ON r.routeId=rs.routeId WHERE rs.stationId=:src ) r1 INNER JOIN (SELECT r.trainId, rs.stopNo FROM route r INNER JOIN route_station rs ON r.routeId=rs.routeId WHERE rs.stationId=:dest) r2 ON r1.trainId=r2.trainId WHERE r1.stopNo<r2.stopNo) t1 ON t.trainId=t1.trainId  
                    INNER JOIN station s1 ON s1.stationID=t.src_station 
                    INNER JOIN station s2 ON s2.stationID=t.dest_station
                    INNER JOIN availabledays a ON a.trainId=t.trainId
                        WHERE :src!=t.dest_station AND a.friday='Yes' AND t.reservable_status!=0");
                    break;
                case 'Saturday':
                    $this->db->query("SELECT t.*, s1.name AS srcName, s2.name AS destName FROM train t 
                    INNER JOIN (SELECT DISTINCT r1.trainId FROM (SELECT r.trainId, rs.stopNo FROM route r INNER JOIN route_station rs ON r.routeId=rs.routeId WHERE rs.stationId=:src ) r1 INNER JOIN (SELECT r.trainId, rs.stopNo FROM route r INNER JOIN route_station rs ON r.routeId=rs.routeId WHERE rs.stationId=:dest) r2 ON r1.trainId=r2.trainId WHERE r1.stopNo<r2.stopNo) t1 ON t.trainId=t1.trainId  
                    INNER JOIN station s1 ON s1.stationID=t.src_station 
                    INNER JOIN station s2 ON s2.stationID=t.dest_station
                    INNER JOIN availabledays a ON a.trainId=t.trainId
                        WHERE :src!=t.dest_station AND a.saturday='Yes' AND t.reservable_status!=0");
                    break;
                case 'Sunday':
                    $this->db->query("SELECT t.*, s1.name AS srcName, s2.name AS destName FROM train t 
                    INNER JOIN (SELECT DISTINCT r1.trainId FROM (SELECT r.trainId, rs.stopNo FROM route r INNER JOIN route_station rs ON r.routeId=rs.routeId WHERE rs.stationId=:src ) r1 INNER JOIN (SELECT r.trainId, rs.stopNo FROM route r INNER JOIN route_station rs ON r.routeId=rs.routeId WHERE rs.stationId=:dest) r2 ON r1.trainId=r2.trainId WHERE r1.stopNo<r2.stopNo) t1 ON t.trainId=t1.trainId  
                    INNER JOIN station s1 ON s1.stationID=t.src_station 
                    INNER JOIN station s2 ON s2.stationID=t.dest_station
                    INNER JOIN availabledays a ON a.trainId=t.trainId
                        WHERE :src!=t.dest_station AND a.sunday='Yes' AND t.reservable_status!=0");
                    break;

            }

            $this->db->bind(':src',$data['src']);
            $this->db->bind(':dest',$data['dest']);
            $results = $this->db->resultSet();
            return $results;
            
        }

   
        public function searchSrcDestTime($data){ //search only with source, destination, time

            $this->db->query('SELECT t.*, s1.name AS srcName, s2.name AS destName FROM train t 
                INNER JOIN (SELECT DISTINCT r1.trainId FROM (SELECT r.trainId, rs.stopNo FROM route r INNER JOIN route_station rs ON r.routeId=rs.routeId WHERE rs.stationId=:src AND rs.departuretime>=:deptTime) r1 INNER JOIN (SELECT r.trainId, rs.stopNo FROM route r INNER JOIN route_station rs ON r.routeId=rs.routeId WHERE rs.stationId=:dest) r2 ON r1.trainId=r2.trainId WHERE r1.stopNo<r2.stopNo) t1 ON t.trainId=t1.trainId  
                INNER JOIN station s1 ON s1.stationID=t.src_station 
                INNER JOIN station s2 ON s2.stationID=t.dest_station
                    WHERE :src!=t.dest_station');
            $this->db->bind(':src',$data['src']);
            $this->db->bind(':dest',$data['dest']);
            $this->db->bind(':deptTime',$data['deptTime']);
            $results = $this->db->resultSet();
            return $results;
        }


        public function searchAll($data){ //search with all four fields

            switch($data['date']){
                case 'Monday':
                    $this->db->query("SELECT t.*, s1.name AS srcName, s2.name AS destName FROM train t 
                    INNER JOIN (SELECT DISTINCT r1.trainId FROM (SELECT r.trainId, rs.stopNo FROM route r INNER JOIN route_station rs ON r.routeId=rs.routeId WHERE rs.stationId=:src AND rs.departuretime>=:deptTime) r1 INNER JOIN (SELECT r.trainId, rs.stopNo FROM route r INNER JOIN route_station rs ON r.routeId=rs.routeId WHERE rs.stationId=:dest) r2 ON r1.trainId=r2.trainId WHERE r1.stopNo<r2.stopNo) t1 ON t.trainId=t1.trainId  
                    INNER JOIN station s1 ON s1.stationID=t.src_station 
                    INNER JOIN station s2 ON s2.stationID=t.dest_station
                    INNER JOIN availabledays a ON a.trainId=t.trainId
                        WHERE :src!=t.dest_station AND a.monday='Yes' AND t.reservable_status!=0");
                    break;
                case 'Tuesday':
                    $this->db->query("SELECT t.*, s1.name AS srcName, s2.name AS destName FROM train t 
                    INNER JOIN (SELECT DISTINCT r1.trainId FROM (SELECT r.trainId, rs.stopNo FROM route r INNER JOIN route_station rs ON r.routeId=rs.routeId WHERE rs.stationId=:src AND rs.departuretime>=:deptTime) r1 INNER JOIN (SELECT r.trainId, rs.stopNo FROM route r INNER JOIN route_station rs ON r.routeId=rs.routeId WHERE rs.stationId=:dest) r2 ON r1.trainId=r2.trainId WHERE r1.stopNo<r2.stopNo) t1 ON t.trainId=t1.trainId  
                    INNER JOIN station s1 ON s1.stationID=t.src_station 
                    INNER JOIN station s2 ON s2.stationID=t.dest_station
                    INNER JOIN availabledays a ON a.trainId=t.trainId
                        WHERE :src!=t.dest_station AND a.tuesday='Yes' AND t.reservable_status!=0");
                    break;
                case 'Wednesday':
                    $this->db->query("SELECT t.*, s1.name AS srcName, s2.name AS destName FROM train t 
                    INNER JOIN (SELECT DISTINCT r1.trainId FROM (SELECT r.trainId, rs.stopNo FROM route r INNER JOIN route_station rs ON r.routeId=rs.routeId WHERE rs.stationId=:src AND rs.departuretime>=:deptTime) r1 INNER JOIN (SELECT r.trainId, rs.stopNo FROM route r INNER JOIN route_station rs ON r.routeId=rs.routeId WHERE rs.stationId=:dest) r2 ON r1.trainId=r2.trainId WHERE r1.stopNo<r2.stopNo) t1 ON t.trainId=t1.trainId  
                    INNER JOIN station s1 ON s1.stationID=t.src_station 
                    INNER JOIN station s2 ON s2.stationID=t.dest_station
                    INNER JOIN availabledays a ON a.trainId=t.trainId
                        WHERE :src!=t.dest_station AND a.wednesday='Yes' AND t.reservable_status!=0");
                    break;
                case 'Thursday':
                    $this->db->query("SELECT t.*, s1.name AS srcName, s2.name AS destName FROM train t 
                    INNER JOIN (SELECT DISTINCT r1.trainId FROM (SELECT r.trainId, rs.stopNo FROM route r INNER JOIN route_station rs ON r.routeId=rs.routeId WHERE rs.stationId=:src AND rs.departuretime>=:deptTime) r1 INNER JOIN (SELECT r.trainId, rs.stopNo FROM route r INNER JOIN route_station rs ON r.routeId=rs.routeId WHERE rs.stationId=:dest) r2 ON r1.trainId=r2.trainId WHERE r1.stopNo<r2.stopNo) t1 ON t.trainId=t1.trainId  
                    INNER JOIN station s1 ON s1.stationID=t.src_station 
                    INNER JOIN station s2 ON s2.stationID=t.dest_station
                    INNER JOIN availabledays a ON a.trainId=t.trainId
                        WHERE :src!=t.dest_station AND a.thursday='Yes' AND t.reservable_status!=0");
                    break;
                case 'Friday':
                    $this->db->query("SELECT t.*, s1.name AS srcName, s2.name AS destName FROM train t 
                    INNER JOIN (SELECT DISTINCT r1.trainId FROM (SELECT r.trainId, rs.stopNo FROM route r INNER JOIN route_station rs ON r.routeId=rs.routeId WHERE rs.stationId=:src AND rs.departuretime>=:deptTime) r1 INNER JOIN (SELECT r.trainId, rs.stopNo FROM route r INNER JOIN route_station rs ON r.routeId=rs.routeId WHERE rs.stationId=:dest) r2 ON r1.trainId=r2.trainId WHERE r1.stopNo<r2.stopNo) t1 ON t.trainId=t1.trainId  
                    INNER JOIN station s1 ON s1.stationID=t.src_station 
                    INNER JOIN station s2 ON s2.stationID=t.dest_station
                    INNER JOIN availabledays a ON a.trainId=t.trainId
                        WHERE :src!=t.dest_station AND a.friday='Yes' AND t.reservable_status!=0");
                    break;
                case 'Saturday':
                    $this->db->query("SELECT t.*, s1.name AS srcName, s2.name AS destName FROM train t 
                    INNER JOIN (SELECT DISTINCT r1.trainId FROM (SELECT r.trainId, rs.stopNo FROM route r INNER JOIN route_station rs ON r.routeId=rs.routeId WHERE rs.stationId=:src AND rs.departuretime>=:deptTime) r1 INNER JOIN (SELECT r.trainId, rs.stopNo FROM route r INNER JOIN route_station rs ON r.routeId=rs.routeId WHERE rs.stationId=:dest) r2 ON r1.trainId=r2.trainId WHERE r1.stopNo<r2.stopNo) t1 ON t.trainId=t1.trainId  
                    INNER JOIN station s1 ON s1.stationID=t.src_station 
                    INNER JOIN station s2 ON s2.stationID=t.dest_station
                    INNER JOIN availabledays a ON a.trainId=t.trainId
                        WHERE :src!=t.dest_station AND a.saturday='Yes' AND t.reservable_status!=0");
                    break;
                case 'Sunday':
                    $this->db->query("SELECT t.*, s1.name AS srcName, s2.name AS destName FROM train t 
                    INNER JOIN (SELECT DISTINCT r1.trainId FROM (SELECT r.trainId, rs.stopNo FROM route r INNER JOIN route_station rs ON r.routeId=rs.routeId WHERE rs.stationId=:src AND rs.departuretime>=:deptTime) r1 INNER JOIN (SELECT r.trainId, rs.stopNo FROM route r INNER JOIN route_station rs ON r.routeId=rs.routeId WHERE rs.stationId=:dest) r2 ON r1.trainId=r2.trainId WHERE r1.stopNo<r2.stopNo) t1 ON t.trainId=t1.trainId  
                    INNER JOIN station s1 ON s1.stationID=t.src_station 
                    INNER JOIN station s2 ON s2.stationID=t.dest_station
                    INNER JOIN availabledays a ON a.trainId=t.trainId
                        WHERE :src!=t.dest_station AND a.sunday='Yes' AND t.reservable_status!=0");
                    break;

            }

            $this->db->bind(':src',$data['src']);
            $this->db->bind(':dest',$data['dest']);
            $this->db->bind(':deptTime',$data['deptTime']);
            $results = $this->db->resultSet();
            return $results;
        }


        public function checkStation($station){ // check station already inserted

            $this->db->query('SELECT COUNT(*) AS count FROM station WHERE name=:station');
            $this->db->bind(':station', $station);
            $row=$this->db->single();
            if ($row->count>0){
                return true;
            }else{
                return false;
            }
        }

        public function getTrainDetails($id){ // get train details

            $this->db->query('SELECT t.*, f.*, s1.name AS srcName, s2.name AS destName FROM train t INNER JOIN fare f ON t.rateId=f.rateID INNER JOIN station s1 ON s1.stationID=t.src_station INNER JOIN station s2 ON s2.stationID=t.dest_station WHERE t.trainId=:id');
            $this->db->bind(':id',$id);
            $results = $this->db->single();
            return $results;
        }

        public function getCompartments($id){ // get compartment details

            $this->db->query('SELECT c.* FROM compartment c INNER JOIN train t ON c.trainId=t.trainId INNER JOIN compartment_type ct ON c.type=ct.typeNo WHERE t.trainId=:id ORDER BY c.compartmentNo');
            $this->db->bind(':id',$id);
            $results = $this->db->resultSet();
            return $results;
        }

        public function getCompartmentDetails($id,$compNo){ // get compartment details

            $this->db->query('SELECT * FROM compartment WHERE trainId=:id AND compartmentNo=:compNo');
            $this->db->bind(':id',$id);
            $this->db->bind(':compNo',$compNo);
            $results = $this->db->single();
            return $results;
        }


        
        public function getStopNo($id,$stationid){ //Function to get the stop No of a station in a route

            $this->db->query('SELECT rs.stopNo, s.name FROM train t INNER JOIN route r ON r.trainId=t.trainId INNER JOIN route_station rs ON r.routeId=rs.routeId INNER JOIN station s ON s.stationID=rs.stationId WHERE t.trainId=:id AND rs.stationId=:stationid');
            $this->db->bind(':id',$id);
            $this->db->bind(':stationid',$stationid);
            $results = $this->db->single();
            return $results;
        }

        public function addReservation($data){ // function to add reservation

            $this->db->query('INSERT INTO reservation ( reservationNo, trainId, journeyDate, officerId) VALUES (:reservationNo, :trainId, :journeyDate, :officerId )');

            //bind values
            $this->db->bind(':reservationNo', $data['reservationNo']);
            $this->db->bind(':trainId', $data['trainId']);
            $this->db->bind(':journeyDate', $data['journeyDate']);
            $this->db->bind(':officerId', $data['officerId']);          

            //Execute function
            if ($this->db->execute()) {
                $this->db->query('SELECT LAST_INSERT_ID() As resNo');
                $result = [];
                $result = $this->db->resultSet();
                return $result[0]->resNo;       
            } else {
                return false;
            }
        }
//MySQL the TIMESTAMPDIFF() returns a value after subtracting a datetime expression from another.
        public function checkSeat($date, $trainId, $compNo, $seatNo){ // function to check seat

            $this->db->query('SELECT r.reservationNo, s.seatId, s.status, r.res_time, TIMESTAMPDIFF(SECOND,r.res_time, NOW()) AS dif FROM seat s INNER JOIN reservation r ON r.reservationNo=s.reservationNo WHERE s.trainid=:trainId AND s.compartmentNo=:compNo AND s.seatNo=:seatNo AND r.journeyDate=:journeyDate');
            $this->db->bind(':trainId',$trainId);
            $this->db->bind(':compNo',$compNo);
            $this->db->bind(':seatNo',$seatNo);
            $this->db->bind(':journeyDate',$date);
            
            $results=$this->db->single();
            return $results;
            
        }

        
        public function addSeat($data){ //Function to add a selected seat 

            $this->db->query('INSERT INTO seat (reservationNo,trainId,compartmentNo,seatNo,seatId,classtype,status,price) VALUES (:resNo, :trainid, :compNo, :label, :id, :class, :status, :price)');

            //bind values
            $this->db->bind(':resNo', $data['resno']);
            $this->db->bind(':trainid', $data['trainid']);
            $this->db->bind(':compNo', $data['compartment']);
            $this->db->bind(':label', $data['label']);
            $this->db->bind(':id', $data['id']);
            $this->db->bind(':class', $data['classtype']);
            $this->db->bind(':status', $data['status']);
            $this->db->bind(':price', $data['price']);  

            //Execute function
            if ($this->db->execute()) {
                return true;                
            } else {
                return false;
            }
        }

        public function updateSeat($data, $prevres){ // function to update seat

            $this->db->query('UPDATE seat SET status=:status, reservationNo=:resno WHERE reservationNo=:prevres AND trainId=:trainid AND compartmentNo=:compNo AND seatNo=:label');

            //bind values
            $this->db->bind(':prevres', $prevres);
            $this->db->bind(':status', $data['status']);
            $this->db->bind(':trainid', $data['trainid']);
            $this->db->bind(':compNo', $data['compartment']);
            $this->db->bind(':label', $data['label']);
            // $this->db->bind(':nic', $data['nic']);   
            $this->db->bind(':resno', $data['resno']);      

            //Execute function
            if ($this->db->execute()) {
                return true;                
            } else {
                return false;
            }
        }

        
        public function removeSeat($data){ //Function to deselect a seat 

            $this->db->query("UPDATE seat SET status='deselected' WHERE reservationNo=:resNo AND trainId=:trainid AND compartmentNo=:compNo AND seatNo=:label");

            //bind values
            $this->db->bind(':trainid', $data['trainid']);
            $this->db->bind(':compNo', $data['compartment']);
            $this->db->bind(':label', $data['label']);
            $this->db->bind(':resNo', $data['resNo']);

            //Execute function
            if ($this->db->execute()) {
                return true;                
            } else {
                return false;
            }

        }

        
        public function cancelReservation($resNo){ //Function to deselect the seats of a reservation 

            $this->db->query("UPDATE seat SET status='deselected' WHERE reservationNo=:resNo");

            //bind values
            $this->db->bind(':resNo', $resNo);

            //Execute function
            if ($this->db->execute()) {
                return true;                
            } else {
                return false;
            }

        }

        //Function to get all seats selected by the GIVEN USER in ANY COMPARTMENT in the GIVEN TRAIN, DATE -  For a given booking 
        public function getSelectedSeats($resNo){

            $this->db->query("SELECT s.seatNo, s.seatId, s.compartmentNo, s.classtype, s.price FROM seat s INNER JOIN reservation r ON s.reservationNo=r.reservationNo WHERE s.reservationNo=:resNo AND s.status='selected'");

            $this->db->bind(':resNo',$resNo);
            $results = $this->db->resultSet();
            return $results;
        }

        //Function to get all seats booked or selected by(other passengers-different order number) in the GIVEN COMPARTMENT, TRAIN, DATE
        public function getUnavailable($id, $compNo, $date, $resNo){

            $this->db->query("SELECT s.seatId FROM seat s INNER JOIN reservation r ON r.reservationNo=s.reservationNo WHERE (s.trainId=:id AND s.compartmentNo=:compNo AND r.journeyDate=:jdate AND s.status='booked') OR (s.trainId=:id AND s.compartmentNo=:compNo AND r.journeyDate=:jdate AND s.status='selected' AND r.reservationNo!=:resNo)");
            $this->db->bind(':id',$id);
            $this->db->bind(':compNo',$compNo);
            $this->db->bind(':jdate',$date);
            $this->db->bind(':resNo',$resNo);
            $results = $this->db->resultSet();
            return $results;
        }


        //Function to get all seats deselected by other passengers in the GIVEN COMPARTMENT, TRAIN AND DATE
        public function getDeselected($id, $compNo, $date, $resNo, $currTime){

            $this->db->query("SELECT s.seatId FROM seat s INNER JOIN reservation r ON s.reservationNo=r.reservationNo WHERE (s.trainId=:id AND s.compartmentNo=:compNo AND r.journeyDate=:jdate AND s.status='deselected' AND r.reservationNo!=:resNo) OR (s.trainId=:id AND s.compartmentNo=:compNo AND r.journeyDate=:jdate AND s.status='selected' AND r.reservationNo!=:resNo AND TIMESTAMPDIFF(SECOND,r.res_time,:currTime) > 1800)");
            $this->db->bind(':id',$id);
            $this->db->bind(':compNo',$compNo);
            $this->db->bind(':jdate',$date);
            $this->db->bind(':resNo',$resNo);
            $this->db->bind(':currTime',$currTime);
            $results = $this->db->resultSet();
            return $results;

        }


        //Function to get the total no of items and total price of the reservation to update the database reservation table 
        public function getSummary($resNo){
            $this->db->query("SELECT COUNT(s.seatNo) AS count, SUM(s.price) AS total FROM seat s WHERE s.reservationNo=:resNo AND status='selected'");

            //bind values
            $this->db->bind(':resNo',$resNo);
            $results = array();
            $results = $this->db->resultSet();

            return $results;
        }


        //Function to update the reservation table with the total price and item count 
        public function updateReservation($resNo,$count,$total,$comp_time){

            $this->db->query('UPDATE reservation SET itemCount=:count, total=:total, comp_time=:comp_time WHERE reservationNo=:resNo');

            //bind values
            $this->db->bind(':resNo', $resNo);
            $this->db->bind(':count', $count);
            $this->db->bind(':total', $total);
            $this->db->bind(':comp_time', $comp_time);
            //Execute function
            if ($this->db->execute()) {
                return true;                
            } else {
                return false;
            }
        }

        public function updateReservationStatus($resNo){ // function to update reservation status

            $this->db->query('UPDATE reservation SET status="S" WHERE reservationNo=:resNo');

            //bind values
            $this->db->bind(':resNo', $resNo);

            //Execute function
            if ($this->db->execute()) {
                return true;                
            } else {
                return false;
            }
        }

        //Get the reservation details of the relevant reservation 
        public function getReservationDetails($resNo){

            $this->db->query('SELECT * FROM reservation WHERE reservationNo=:resNo');

            //bind values
            $this->db->bind(":resNo",$resNo);
            $row=$this->db->single();

            return $row; 
        }


        //Get the account details of the relevant customer - BOOKING REVIEW
        public function getAccountDetails($nic){

            $this->db->query('SELECT p.*, u.email FROM passenger p INNER JOIN users u ON p.userid=u.userid WHERE p.nic=:nic');

            //bind values
            $this->db->bind(":nic",$nic);
            $row=$this->db->single();

            return $row; 
        }


        //Function to get the time at which the reservation was started 
        public function checkReservation($resNo){

            $this->db->query('SELECT res_time FROM reservation WHERE reservationNo=:resNo');

            //bind values
            $this->db->bind(':resNo', $resNo);
            $result = [];
            $result = $this->db->resultSet();

            return $result[0]->res_time;        
        }


        //Function to change the status of the seats as booked 
        public function confirmReservation($resNo){

            $this->db->query("UPDATE seat SET status='booked' WHERE reservationNo=:resNo AND status='selected'");

            //bind values

            $this->db->bind(':resNo', $resNo);

            //Execute function
            if ($this->db->execute()) {
                return true;                
            } else {
                return false;
            }
        }

        //Function to get the seats of a relevant booking
        public function getBookedSeats($resNo){

            $this->db->query("SELECT s.seatNo, s.compartmentNo, s.classtype, s.price FROM seat s INNER JOIN reservation r ON s.reservationNo=r.reservationNo WHERE s.reservationNo=:resNo AND s.status='booked'");

            $this->db->bind(':resNo',$resNo);
            $results = $this->db->resultSet();
            return $results;
        }

        public function getReservationNIC($resNo){ // get nic from reservation table

            $this->db->query("SELECT nic FROM reservation WHERE reservationNo=:resNo");
            $this->db->bind(':resNo',$resNo);
            $row=$this->db->single();
            return $row; 
        }


        public function create_unregistered_passenger($data){ // function to create unregistered passenger
            //this is an preapared statement
            $this->db->query('INSERT INTO unregistered_passenger (uPassenger_id, nic, email, mobileno, firstname, lastname, address_number, street, city, country ) VALUES (:uPassenger_id, :nic, :email, :mobileno, :firstname, :lastname, :address_number, :street, :city, :country )');
            //bind values
            $this->db->bind(':uPassenger_id', $data['uPassenger_id']);
            $this->db->bind(':nic', $data['nic']);        
            $this->db->bind(':email', $data['email']);
            $this->db->bind(':mobileno', $data['mobileno']);
            $this->db->bind(':firstname', $data['firstname']);
            $this->db->bind(':lastname', $data['lastname']);
            $this->db->bind(':address_number', $data['address_number']);
            $this->db->bind(':street', $data['street']);
            $this->db->bind(':city', $data['city']);
            $this->db->bind(':country', $data['country']);
            //execute

            if ($this->db->execute()) {
                $this->db->query('SELECT LAST_INSERT_ID() As uPId');
                $result = [];
                $result = $this->db->resultSet();
                return $result[0]->uPId;       
            } else {
                return false;
            }

        }

        public function getUnregisteredPassengerDetails($uPId){ // function to get unregistered passenger details

            $this->db->query("SELECT * FROM unregistered_passenger WHERE uPassenger_id=:uPId");
            $this->db->bind(':uPId',$uPId);
            $row=$this->db->single();
            return $row; 
        }



        public function create_ticket($data){ // function to create the ticket
            //this is an preapared statement
            $this->db->query('INSERT INTO ticket (ticketNo, ticketId, reservationType, price, journeyDate, issueDate, issueTime, trainId, officerId, uPassenger_id, nic ) VALUES (:ticketNo, :ticketId, :reservationType, :price, :journeyDate, :issueDate, :issueTime, :trainId, :officerId, :uPassenger_id, :nic )');
            //bind values
            $this->db->bind(':ticketNo', $data['ticketNo']);
            $this->db->bind(':ticketId', $data['ticketId']);
            $this->db->bind(':reservationType', $data['reservationType']);        
            $this->db->bind(':price', $data['price']);
            $this->db->bind(':journeyDate', $data['journeyDate']);
            $this->db->bind(':issueDate', $data['issueDate']);
            $this->db->bind(':issueTime', $data['issueTime']);
            $this->db->bind(':trainId', $data['trainId']);
            $this->db->bind(':officerId', $data['officerId']);
            $this->db->bind(':uPassenger_id', $data['uPassenger_id']);
            $this->db->bind(':nic', $data['nic']);
            //execute
            if($this->db->execute()){
                return true;
            }else{
                return false;
            }
        }

        public function getTicketDetails($resNo){ // function to get ticket details
            $this->db->query('SELECT * FROM ticket WHERE ticketId=:resNo');

            $this->db->bind(':resNo',$resNo);
            $row=$this->db->single();
            return $row; 

        }

        public function findResofficerById($oid){ // find reservation officer details
            $this->db->query('SELECT m.*, u.email FROM reservation_officer m INNER JOIN users u ON m.userId=u.userId WHERE m.userId=:userId');
            $this->db->bind(":userId",$oid);
            $row=$this->db->single();
            return $row; 
        }

        public function getDisabledSeats($id, $compNo){ // get disabled seats

            $this->db->query("SELECT s.seatId FROM disabled_seat_mark s INNER JOIN disabled_seat r ON r.disabledNo=s.disabledNo WHERE (r.trainId=:id AND s.compartmentNo=:compNo)");
            $this->db->bind(':id',$id);
            $this->db->bind(':compNo',$compNo);
            $results = $this->db->resultSet();
            return $results;
        }

        public function getFinalBookedSeats($resNo){ // get final booked seats

            $this->db->query("SELECT s.seatNo, s.seatId, s.compartmentNo, s.classtype, s.price FROM seat s INNER JOIN reservation r ON s.reservationNo=r.reservationNo WHERE s.reservationNo=:resNo AND s.status='booked'");

            $this->db->bind(':resNo',$resNo);
            $results = $this->db->resultSet();
            return $results;
        }

        public function getBookingSummary($resNo){ // get booking summary
            $this->db->query("SELECT COUNT(s.seatNo) AS count, SUM(s.price) AS total FROM seat s WHERE s.reservationNo=:resNo AND status='booked'");

            //bind values
            $this->db->bind(':resNo',$resNo);
            $results = array();
            $results = $this->db->resultSet();

            return $results;
        }

    }
