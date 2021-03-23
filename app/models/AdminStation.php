<?php
class AdminStation {
    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    public function findAllStations() {
        $this->db->query('SELECT * FROM station ORDER BY entered_date ASC');

        $results = $this->db->resultSet();

        return $results;
    }


    public function addStation($data) {
        $this->db->query('INSERT INTO station (stationID, name, telephoneNo, type, entered_date, entered_time) VALUES ( :stationID, :name, :telephoneNo, :type, :entered_date, :entered_time)');

        $this->db->bind(':stationID', $data['stationID']);
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':telephoneNo', $data['telephoneNo']);
        $this->db->bind(':type', $data['type']);
        $this->db->bind(':entered_date', $data['entered_date']);
        $this->db->bind(':entered_time', $data['entered_time']);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }


    public function findStationById($stationID) {
        $this->db->query('SELECT * FROM station WHERE stationID = :stationID');

        $this->db->bind(':stationID', $stationID);

        $row = $this->db->single();

        return $row;
    }



/*
public function displaystations()
        {
            $this->db->query('SELECT * FROM station WHERE stationID = :stationID');
            $results=$this->db->resultSet();
            return $results;
        }

        public function getstationFields()
        {
            $this->db->query("SELECT * FROM station WHERE stationID = :stationIDs')");
            $results=$this->db->resultSet();
            return $results;
        }
*/


    public function updateStation($data) {
        $this->db->query('UPDATE station SET stationID = :stationID, name = :name, telephoneNo = :telephoneNo, type = :type, entered_date = :entered_date, entered_time = :entered_time  WHERE stationID = :stationID');

        $this->db->bind(':stationID', $data['stationID']);
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':telephoneNo', $data['telephoneNo']);
        $this->db->bind(':type', $data['type']);
        $this->db->bind(':entered_date', $data['entered_date']);
        $this->db->bind(':entered_time', $data['entered_time']);


        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }


    public function deleteStation($stationID) {
        $this->db->query('DELETE FROM station WHERE stationID = :stationID');

        $this->db->bind(':stationID', $stationID);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
  

    public function getStations()
    {
        $this->db->query('SELECT stationID FROM station');
        $results=$this->db->resultSet();
        return $results;
    }

    public function getStationFields(){
        $this->db->query("SELECT DISTINCT column_name AS columns FROM INFORMATION_SCHEMA.columns WHERE TABLE_NAME IN('station') AND
         column_name IN('stationID','type','name','telephoneNo','entered_date','entered_time')");
        $results=$this->db->resultSet();
        return $results;
    }

    public function searchStations($searchterm, $searchfield)
        {
            if($searchterm==''){
                $this->db->query('SELECT * FROM station ');
            }else{
                switch ($searchfield) {
                    case 'stationID':
                        $this->db->query('SELECT * FROM station WHERE stationID = :searchTerm');
                        break;
                    case 'name':
                        $this->db->query('SELECT * FROM station WHERE name = :searchTerm');
                        break;
                    case 'telephoneNo':
                        $this->db->query('SELECT * FROM station WHERE telephoneNo = :searchTerm');
                        break;
                    case 'type':
                        $this->db->query('SELECT * FROM station WHERE type = :searchTerm');
                        break;
                    case 'entered_date':
                        $this->db->query('SELECT type FROM station WHERE entered_date = :searchTerm');
                        break;
                    case 'entered_time':
                        $this->db->query('SELECT type FROM station WHERE entered_time = :searchTerm');
                        break;
                    
                    
                    
                }
            }
            
            $this->db->bind(':searchTerm',$searchterm);
            $results=$this->db->resultSet();
            return $results;
            
        }

}
