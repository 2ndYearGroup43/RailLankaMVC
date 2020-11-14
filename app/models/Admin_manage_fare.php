<?php
class Admin_manage_fare {
	private $db;

	public function __construct(){
		$this->db = new Database;
	}

	public function create_fare($data){
		$this->db->query('INSERT INTO fare (rateID, fclassbase, sclassbase, tclassbase, distance, rate ) VALUES (:rateID, :fclassbase, :sclassbase, :tclassbase, :distance, :rate)');

		$this->db->bind(':rateID', $data['rateID']);
		$this->db->bind(':fclassbase', $data['fclassbase']);		
		$this->db->bind(':sclassbase', $data['sclassbase']);
		$this->db->bind(':tclassbase', $data['tclassbase']);
		$this->db->bind(':distance', $data['distance']);
		$this->db->bind(':rate', $data['rate']);

		if($this->db->execute()){
			return true;
		}else{
			return false;
		}
        
	}

    public function findRateByRateID($rid)
    {
        //this is an preapared statement
        $this->db->query('SELECT COUNT(*) as count FROM fare WHERE rateID = :rid');

        //Email param will be binded by the email variable

        $this->db->bind(':rid', $rid);

        //check if the email is already registsered;
        $results=array();
        $results=$this->db->resultSet();
        $count=$results[0]->count;
        if($count>0){
            return true;
        }else{
            return false;
        }
    }

	public function get(){
		$this->db->query('SELECT * FROM fare ORDER BY rateID ASC');
		$results = $this->db->resultSet();
		return $results;
	}

	public function findFare($rateID){
		$this->db->query('SELECT * FROM fare WHERE rateID=:rateID');

		$this->db->bind(':rateID', $rateID);

		$row = $this->db->single();
		return $row;
	}

	public function edit($data){
		$this->db->query('UPDATE fare SET rateID=:rateID, fclassbase=:fclassbase, sclassbase=:sclassbase, tclassbase=:tclassbase, distance=:distance, rate=:rate WHERE rateID=:rateID');

		$this->db->bind(':rateID', $data['rateID']);
		$this->db->bind(':fclassbase', $data['fclassbase']);		
		$this->db->bind(':sclassbase', $data['sclassbase']);
		$this->db->bind(':tclassbase', $data['tclassbase']);
		$this->db->bind(':distance', $data['distance']);
		$this->db->bind(':rate', $data['rate']);


		if($this->db->execute()){
			return true;
		}else{
			return false;
		}
	}

		public function views($data){
		$this->db->query('SELECT fare SET rateID=:rateID, fclassbase=:fclassbase, sclassbase=:sclassbase, tclassbase=:tclassbase, distance=:distance, rate=:rate WHERE rateID=:rateID');

		$this->db->bind(':rateID', $data['rateID']);
		$this->db->bind(':fclassbase', $data['fclassbase']);		
		$this->db->bind(':sclassbase', $data['sclassbase']);
		$this->db->bind(':tclassbase', $data['tclassbase']);
		$this->db->bind(':distance', $data['distance']);
		$this->db->bind(':rate', $data['rate']);

		if($this->db->execute()){
			return true;
		}else{
			return false;
		}
	}

	public function delete($rateID){
		$this->db->query('DELETE FROM fare WHERE rateID=:rateID');

		$this->db->bind(':rateID',$rateID);

        if($this->db->execute()){
			return true;
		}else{
			return false;
		}
	}
}