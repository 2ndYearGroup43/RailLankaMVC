<?php
class Passengers extends Controller {
    public function __construct() {
        $this->passengerModel = $this->model('Passenger');
    }

    public function index() {
        //$data = $this->stationModel->findAllStations();

        /*$data = [
            'stations' => $stations
        ];*/
//var_dump($stations);
        $this->view('passengers/index');
    }
}