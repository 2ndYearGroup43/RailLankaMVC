<?php
class Admindashboards extends Controller {
    public function __construct() {
        $this->admindashboardModel = $this->model('Admindashboard');
    }

    public function index() {
      
        $this->view('admins/admindashboards/index');
    }
    public function dashboards() {
      
        $this->view('admins/admindashboards/index');
    }
}