<?php 
	class Resofficers extends Controller {

		public function __construct() {
			$this->adminModel = $this->model('Resofficer');
		}

		public function index() {

			// $users = $this->userModel->getUsers();

			$data = [
				'title' => 'Reservation Officer Home Page',
				// 'users' => $users
			];

			$this->view('resofficers/index', $data); //
		}

	}