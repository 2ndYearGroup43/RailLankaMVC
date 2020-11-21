<?php
class AdminStations extends Controller {
    public function __construct() {
        $this->adminstationModel = $this->model('AdminStation');
    }

    public function index() {
        $data = $this->adminstationModel->findAllStations();

        /*$data = [
            'stations' => $stations
        ];*/
//var_dump($stations);
        $this->view('admins/stations/manage_station', $data);
    }



    public function add_station() {
        /*if(!isLoggedIn()) {
            header("Location: " . URLROOT . "/stations");
        }*/

        $data = [
                'stationID'=>'',
                'name'=>'',
                'telephoneNo'=>'',
                'type'=>'',
                'entered_date'=>'',
                'entered_time'=>'',
                'stationIDError'=>'',
                'nameError'=>'',
                'telephoneNoError'=>'',
                'typeError'=>'',
                'entered_dateError'=>'',
                'entered_timeError'=>''
                       
        ];

        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                    'stationID'=>trim($_POST['stationID']),
                    'name'=>trim($_POST['name']),
                    'telephoneNo'=>trim($_POST['telephoneNo']),
                    'type'=>trim($_POST['type']),
                    'entered_date'=>date("Y-m-d"),
                    'entered_time'=>date("H:i:s"),
                    //'adminID'=>$_SESSION['adminID'],
                    'stationIDError'=>'',
                    'nameError'=>'',
                    'telephoneNoError'=>'',
                    'typeError'=>'',
                    'entered_dateError'=>'',
                    'entered_timeError'=>''
            ];

            $telephoneValidation="/^[0-9]{10}+$/";


            if(empty($data['stationID'])) {
                $data['stationIDError'] = 'The stationID of a station cannot be empty';
            }

            if(empty($data['name'])) {
                $data['nameError'] = 'The name of a station cannot be empty';
            }

            /*if(empty($data['telephoneNo'])) {
                $data['telephoneNoError'] = 'The telephoneNo of a station cannot be empty';
            }*/

            if(empty($data['telephoneNo'])){
                    $data['telephoneNoError']='Please Enter the Telephone No.';
                }elseif(!preg_match($telephoneValidation, $data['telephoneNo'])){
                    $data['telephoneNoError']="Name can only contain numbers and +.";
            }

            if(empty($data['type'])) {
                $data['typeError'] = 'The type of a station cannot be empty';
            }

            /*if(empty($data['entered_date'])) {
                $data['entered_dateError'] = 'The entered_date of a station cannot be empty';
            }

            if(empty($data['entered_time'])) {
                $data['entered_timeError'] = 'The entered_time of a station cannot be empty';
            }*/

            if (empty($data['stationIDError']) && empty($data['nameError']) && empty($data['telephoneNoError']) && empty($data['typeError']) ) {
                if ($this->adminstationModel->addStation($data)) {
                    header("Location: " . URLROOT . "/adminStations");
                } else {
                    die("Something went wrong, please try again!");
                }
            } else {
                $this->view('admins/stations/add_station', $data);
            }
        }

        $this->view('admins/stations/add_station', $data);
    }




/*
        public function viewstations()
        {
            if (!isModeratorLoggedIn()) {
                header("Location: ".URLROOT."/moderators/login");
                exit;
            }

            $stations=$this->stationModel->displaystations();
            $fields=$this->stationModel->getstationFields();
            $data=[
                'stations'=>$stations,
                'fields'=>$fields
            ];
            
            $this->view('stations/manage_station', $data);
        }

*/

/*public function cancellationsSearchBy()
        {
            if (!isModeratorLoggedIn()) {
                header("Location: ".URLROOT."/moderators/login");
                exit;
            }
            $data=[
                'alerts'=>'',
                'fields'=>'',
                'searchBar'=>'',    
                'searchSelect'=>''
            ];
            if($_SERVER['REQUEST_METHOD']=='POST'){
                $_POST=filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
                $data=[
                    'alerts'=>'',
                    'fields'=>'',
                    'searchBar'=>trim($_POST['searchbar']),
                    'searchSelect'=>trim($_POST['searchselect'])
                ];

                $alerts=$this->alertModel->searchCancellations($data['searchBar'],$data['searchSelect']);
                $fields=$this->alertModel->getCancellationFields();
                $data=[
                    'alerts'=>$alerts,
                    'fields'=>$fields
                ];
                
            }  
            $this->view('alerts/managecancellations', $data);

        }*/






    public function update_station() {

        /*$station = $this->stationModel->findStationById($stationID);*/

       /* if(!isLoggedIn()) {
            header("Location: " . URLROOT . "/stations");
        } elseif($station->stationID != $_SESSION['stationID']){
            header("Location: " . URLROOT . "/stations");
        }
*/
              $data = [
                'station' => '',
                'stationID'=>'',
                'name'=>'',
                'telephoneNo'=>'',
                'type'=>'',
                'entered_date'=>'',
                'entered_time'=>'',
                'stationIDError'=>'',
                'nameError'=>'',
                'telephoneNoError'=>'',
                'typeError'=>'',
                'entered_dateError'=>'',
                'entered_timeError'=>''
        ];

        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                    'stationID'=>trim($_POST['stationID']),
                    'name'=>trim($_POST['name']),
                    'telephoneNo'=>trim($_POST['telephoneNo']),
                    'type'=>trim($_POST['type']),
                    'entered_date'=>date("Y-m-d"),
                    'entered_time'=>date("H:i:sa"),
                    //'adminID'=>$_SESSION['adminID'],
                    'stationIDError'=>'',
                    'nameError'=>'',
                    'telephoneNoError'=>'',
                    'typeError'=>'',
                    'entered_dateError'=>'',
                    'entered_timeError'=>''
            ];

           // echo $data['adminId'];

            $telephoneValidation="/^[0-9]{10}+$/";


            


            if(empty($data['stationID'])) {
                $data['stationIDError'] = 'The stationID of a station cannot be empty';
            }

            if(empty($data['name'])) {
                $data['nameError'] = 'The name of a station cannot be empty';
            }

            /*if(empty($data['telephoneNo'])) {
                $data['telephoneNoError'] = 'The telephoneNo of a station cannot be empty';
            }*/
            if(empty($data['telephoneNo'])){
                    $data['telephoneNoError']='Please Enter the Telephone No.';
                }elseif(!preg_match($telephoneValidation, $data['telephoneNo'])){
                    $data['telephoneNoError']="Name can only contain numbers and +.";
                }




            if(empty($data['type'])) {
                $data['typeError'] = 'The type of a station cannot be empty';
            }

            if(empty($data['entered_date'])) {
                $data['entered_dateError'] = 'The entered_date of a station cannot be empty';
            }

            if(empty($data['entered_time'])) {
                $data['entered_timeError'] = 'The entered_time of a station cannot be empty';
            }


            if($data['stationID'] == $this->stationModel->findStationById($stationID)->stationID) {
                $data['stationIDError'] == 'At least change the stationID!';
            }

            if($data['name'] == $this->stationModel->findStationById($stationID)->name) {
                $data['nameError'] == 'At least change the name!';
            }

            if($data['telephoneNo'] == $this->stationModel->findStationById($stationID)->telephoneNo) {
                $data['telephoneNoError'] == 'At least change the telephoneNo!';
            }

            if($data['type'] == $this->stationModel->findStationById($stationID)->type) {
                $data['typeError'] == 'At least change the type!';
            }

            if($data['entered_date'] == $this->stationModel->findStationById($stationID)->entered_date) {
                $data['entered_dateError'] == 'At least change the entered_date!';
            }

            if($data['entered_time'] == $this->stationModel->findStationById($stationID)->entered_time) {
                $data['entered_timeError'] == 'At least change the entered_time!';
            }


            if (empty($data['stationIDError']) && empty($data['nameError']) && empty($data['telephoneNoError']) && empty($data['typeError']) && empty($data['entered_dateError']) && empty($data['entered_timeError'])) {
                if ($this->adminstationModel->updateStation($data)) {
                    header("Location: " . URLROOT . "/adminStations");
                } else {
                    die("Something went wrong, please try again!");
                }
            } else {
                $this->view('admins/stations/update_station', $data);
            }
        }

        $this->view('admins/stations/update_station', $data);
    }




    public function delete($id) {

        $post = $this->adminstationModel->findStationById($id);

/*      if(!isLoggedIn()) {
            header("Location: " . URLROOT . "/stations");
        } elseif($post->stationID != $_SESSION['stationID']){
            header("Location: " . URLROOT . "/stations");
        }
*/
      $data = [
                'station' => $station,
                'stationID'=>'',
                'name'=>'',
                'telephoneNo'=>'',
                'type'=>'',
                'entered_date'=>'',
                'entered_time'=>'',
                'stationIDError'=>'',
                'nameError'=>'',
                'telephoneNoError'=>'',
                'typeError'=>'',
                'entered_dateError'=>'',
                'entered_timeError'=>''
        ];


        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            if($this->stationModel->deleteStation($id)) {
                    header("Location: " . URLROOT . "/adminStations");
            } else {
               die('Something went wrong!');
            }
        }
    }
}

