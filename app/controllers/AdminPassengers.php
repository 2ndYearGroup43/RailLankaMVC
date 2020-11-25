<?php
class AdminPassengers extends Controller {
    public function __construct() {
        isAdminLoggedIn();
        $this->adminpassengerModel = $this->model('AdminPassenger');
    }

    public function index() {
        //$data = $this->stationModel->findAllStations();

        /*$data = [
            'stations' => $stations
        ];*/
//var_dump($stations);
        $this->view('admins/passengers/index');
    }
}