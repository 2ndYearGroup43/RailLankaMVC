<?php
class Admin_manage_fare {
	private $db;

	public function __construct(){
		$this->db = new Database;
	}

	public function create_fare($data){ // add fare details to fare table
		$this->db->query('INSERT INTO fare (fclassnormalbase, sclassnormalbase, tclassnormalbase, fclassbase, sclassbase, tclassbase, distance, rate )
 VALUES (:fclassnormalbase, :sclassnormalbase, :tclassnormalbase, :fclassbase, :sclassbase, :tclassbase, :distance, :rate)');

        $this->db->bind(':fclassnormalbase', $data['fclassnormalbase']);
        $this->db->bind(':sclassnormalbase', $data['sclassnormalbase']);
        $this->db->bind(':tclassnormalbase', $data['tclassnormalbase']);
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

    public function findRateByRateID($rid) // find fare rates 
    {
        //this is an preapared statement
        $this->db->query('SELECT COUNT(*) as count FROM fare WHERE rateID = :rid');

        $this->db->bind(':rid', $rid);

        $results=array();
        $results=$this->db->resultSet();
        $count=$results[0]->count;
        if($count>0){
            return true;
        }else{
            return false;
        }
    }

	public function get(){ // get fare details
		$this->db->query('SELECT * FROM fare ORDER BY rateID ASC');
		$results = $this->db->resultSet();
		return $results;
	}

	public function findFare($rateID){ // get fare details
		$this->db->query('SELECT * FROM fare WHERE rateID=:rateID');

		$this->db->bind(':rateID', $rateID);

		$row = $this->db->single();
		return $row;
	}

	public function edit($data){ // edit fare details
		$this->db->query('UPDATE fare SET fclassbase=:fclassbase, sclassbase=:sclassbase, tclassbase=:tclassbase,
                fclassnormalbase=:fclassnormalbase, sclassnormalbase=:sclassnormalbase, tclassnormalbase=:tclassnormalbase, 
                distance=:distance, rate=:rate WHERE rateID=:rateID');

		$this->db->bind(':rateID', $data['rateID']);
		$this->db->bind(':fclassbase', $data['fclassbase']);
		$this->db->bind(':sclassbase', $data['sclassbase']);
		$this->db->bind(':tclassbase', $data['tclassbase']);
        $this->db->bind(':fclassnormalbase', $data['fclassnormalbase']);
        $this->db->bind(':sclassnormalbase', $data['sclassnormalbase']);
        $this->db->bind(':tclassnormalbase', $data['tclassnormalbase']);
        $this->db->bind(':distance', $data['distance']);
		$this->db->bind(':rate', $data['rate']);


		if($this->db->execute()){
			return true;
		}else{
			return false;
		}
	}

		public function views($data){ // view fare details
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

	public function delete($rateID){ // delete fare details
		$this->db->query('DELETE FROM fare WHERE rateID=:rateID');

		$this->db->bind(':rateID',$rateID);

        if($this->db->execute()){
			return true;
		}else{
			return false;
		}
	}
}