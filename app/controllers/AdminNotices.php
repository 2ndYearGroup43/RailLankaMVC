<?php
class Notices extends Controller {
    public function __construct() {
        $this->noticeModel = $this->model('Notice');
    }

    public function index() {
       // $data = $this->noticeModel->findAllNotices();

        /*$data = [
            'stations' => $stations
        ];*/
//var_dump($stations);
        $this->view('notices/index');
    }

     public function add_notice() {

        $this->view('notices/add_notice');
     }
     public function update_notice() {

        $this->view('notices/update_notice');
     }




}