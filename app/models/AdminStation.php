<?php
class AdminStation {
    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    public function findAllStations() {
        $this->db->query('SELECT * FROM station ');

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
        $this->db->query('SELECT COUNT(*) AS count FROM station WHERE stationID = :stationID');

        $this->db->bind(':stationID', $stationID);

        $row = $this->db->single();
        if($row->count>0){
            return true;
        }else{
            return false;
        }

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
}
