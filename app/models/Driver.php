<?php 
	class Driver {
		private $db;

		public function __construct() {
			$this->db = new Database;
		}

	}