<?php 
	
	class Pages extends Controller {

		public function __construct() {
			// $this->userModel = $this->model('User');
		}

		public function index() {
			$this->view('pages/index'); //
		}

		public function notices() {
			$this->view('pages/notices'); //
		}

		public function contactUs() {
			$this->view('pages/contact');
		}

	}
