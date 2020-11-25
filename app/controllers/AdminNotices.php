<?php
class AdminNotices extends Controller {
    public function __construct() {
        isAdminLoggedIn();
        $this->adminnoticeModel = $this->model('AdminNotice');
    }

    public function index() {
       // $data = $this->noticeModel->findAllNotices();

        /*$data = [
            'stations' => $stations
        ];*/
//var_dump($stations);
        $this->view('admins/notices/index');
    }

     public function addNotice() {

        $this->view('admins/notices/add_notice');
     }
     public function updateNotice() {

        $this->view('admins/notices/update_notice');
     }




}