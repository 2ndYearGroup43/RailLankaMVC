<?php
class AdminPassengers extends Controller {
    public function __construct() {
        isAdminLoggedIn();
        $this->adminpassengerModel = $this->model('AdminPassenger');
    }

//     public function index() {
//         //$data = $this->stationModel->findAllStations();

//         $data = [
//             'stations' => $stations
//         ];
// //var_dump($stations);
//         $this->view('admins/passengers/index');
//     }
    public function index() {
        $passengers = $this->adminpassengerModel->findAllPassengers();
        $fields=$this->adminpassengerModel->getPassengerFields();
            $data=[
                'passengers'=>$passengers,
                'fields'=>$fields
            ];
        /*$data = [
            'passengers' => $passengers
        ];*/

        $this->view('admins/passengers/index', $data);
    }



/*public function viewAdmins()
        {
            $admins=$this->adminModel->getAdmins();
            $fields=$this->adminModel->getAdminFields();
            $data=[
                'admins'=>$admins,
                'fields'=>$fields
            ];

            $this->view('admins/manageAdmins', $data);
        }*/


        public function passengersSearchBy()
        {
           
            $data=[
                'passengers'=>'',
                'fields'=>'',
                'searchBar'=>'',
                'searchSelect'=>''
            ];
            if($_SERVER['REQUEST_METHOD']=='POST'){
                $_POST=filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
                $data=[
                    'passengers'=>'',
                    'fields'=>'',
                    'searchBar'=>trim($_POST['searchbar']),
                    'searchSelect'=>trim($_POST['searchselect'])
                ];

                $passengers=$this->adminpassengerModel->searchPassengers($data['searchBar'],$data['searchSelect']);
                $fields=$this->adminpassengerModel->getPassengerFields();
                $data=[
                    'passengers'=>$passengers,
                    'fields'=>$fields,
                    'searchBar'=>trim($_POST['searchbar']),
                    'searchSelect'=>trim($_POST['searchselect'])
                ];
                
            }  
            $this->view('admins/passengers/index', $data);

        }

        public function delete($userid)
        {
            if($_SERVER['REQUEST_METHOD']=='POST'){
                $_POST=filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
                if ($this->adminpassengerModel->delete($userid)) {
                    header("Location: ".URLROOT."/adminPassengers/index");
                } else {
                    die("Something went wrong");
                }
                
            }
            
        }
}