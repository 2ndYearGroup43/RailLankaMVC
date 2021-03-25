<?php
    class SuperAdmins extends Controller{

        public function __construct()
        {
            isSuperAdminLoggedIn();
            $this->superAdminModel=$this->model('SuperAdmin');
        }


        public function index()
        {
            $data = [
				'title' => 'Admin Home Page',
				// 'users' => $users
			];

			$this->view('superadmins/index', $data); //
        }
    }
