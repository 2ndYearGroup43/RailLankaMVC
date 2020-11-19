<?php 
	
	class Pages extends Controller {

		public function __construct() {
			// $this->userModel = $this->model('User');
		}

		public function index() {

			// $users = $this->userModel->getUsers();

			$data = [
				'title' => 'Home Page',
				// 'users' => $users
			];

			$this->view('pages/index', $data); //
		}

		public function notices() {

			// $users = $this->userModel->getUsers();

			$data = [
				'title' => 'Notices',
				// 'users' => $users
			];

			$this->view('pages/notices', $data); //
		}

		public function contactUs() {
			$this->view('pages/contact');
		}

	}
