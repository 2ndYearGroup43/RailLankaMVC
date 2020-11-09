<?php 
	class Admins extends Controller {

		public function __construct() {
			$this->adminModel = $this->model('Admin');
		}

		public function index() {

			// $users = $this->userModel->getUsers();

			$data = [
				'title' => 'Admin Home Page',
				// 'users' => $users
			];

			$this->view('admins/index', $data); //
		}

	}