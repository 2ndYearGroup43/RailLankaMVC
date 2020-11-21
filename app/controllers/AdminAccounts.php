<?php
class AdminAccounts extends Controller {
    public function __construct() {
        $this->adminaccountModel = $this->model('AdminAccount');
    }

    public function index() {
        
        $this->view('admins/accounts/index');
    }
}