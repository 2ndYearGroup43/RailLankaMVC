<?php
class AdminAccounts extends Controller {
    public function __construct() {
	isAdminLoggedIn();
        $this->adminaccountModel = $this->model('AdminAccount');
    }

    public function index() {

    	$id = $_SESSION['userid'];
    	if($_SESSION['role']==6){
    	   $admin= $this->adminaccountModel->getSuperAdminDetails($id);
        }elseif ($_SESSION['role']==2){
    	    $admin=$this->adminaccountModel->findAdminbyId($id);
        }
            $data=[
                'admin'=>$admin,
                'id'=>$id
            ];
        $this->view('admins/accounts/index', $data);
        
    }
}