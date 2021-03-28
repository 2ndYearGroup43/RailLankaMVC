<?php
class AdminAccounts extends Controller {
    public function __construct() {
	isAdminLoggedIn();
        $this->adminaccountModel = $this->model('AdminAccount');
    }

    public function index() {

    	$id = $_SESSION['userid'];
            $admin=$this->adminaccountModel->findAdminById($id);
            $data=[
                'admin'=>$admin,
                'id'=>$id
            ];
        $this->view('admins/accounts/index', $data);
        
    }
}