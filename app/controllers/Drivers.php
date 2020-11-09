<?php 
	class Drivers extends Controller {

		public function __construct() {
			$this->driverModel = $this->model('Driver');
		}

		public function index() {

			// $users = $this->userModel->getUsers();

			$data = [
				'title' => 'Driver Home Page',
				// 'users' => $users
			];

			$this->view('drivers/index', $data); //
		}

	}