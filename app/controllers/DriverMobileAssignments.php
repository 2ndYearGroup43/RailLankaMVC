<?php
    class DriverMobileAssignments extends Controller{
        private $driverAssignment;
        public function __construct()
        {
            $this->driverAssignmentModel=$this->model('DriverMobileAssignment');
        }

        public function getCurrentAssignment(){
            $response = array();
            $_POST=filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $driverId= $_POST['driverId'];
//            $driverId='01';
            $assignment=$this->driverAssignmentModel->checkCurrentAssignments($driverId);
//            var_dump($assignment);
            if($assignment){
                $response['result']=true;
                $response['assignment']=$assignment;
            }else{
                $response['result']=false;
            }

            echo json_encode($response);


//            var_dump($response);

        }

        public function getPastAssignments(){
            $response = Array();
            $_POST=filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $driverId=$_POST['driverId'];

//            $assignments=$this->driverAssignmentModel->

        }

    }



