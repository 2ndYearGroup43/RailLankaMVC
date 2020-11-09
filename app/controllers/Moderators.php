<?php 
	class Moderators extends Controller {

		public function __construct() {
			$this->moderatorModel = $this->model('Moderator');
		}

		public function index() {

			// $users = $this->userModel->getUsers();

			$data = [
				'title' => 'Moderator Home Page',
				// 'users' => $users
			];

			$this->view('moderators/index', $data); //
		}

	}
