<?php


class DriverMobileLocations extends Controller
{
    private $locationModel;

    public function __construct(){
        $this->locationModel=$this->model('DriverMobileLocation');
    }

    public function startJourney($journeyId){
        $_POST=filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        $response= array();
        $lat=$_POST['lat'];
        $lng=$_POST['lng'];
//        $lat='45.6890';
//        $lng='88.457862';
        if($this->locationModel->checkJourney($journeyId)){
            if($this->locationModel->checkIfStarted($journeyId)){
                $response['error']=false;
                $response['started']=true;
                $response['message']="Continuing the journey....";
            }else{
                if($this->locationModel->createLocation($journeyId, $lat, $lng)){
                    $response['error']=false;
                    $response['started']=true;
                    $response['message']="Journey's started!";
                }else{
                    $response['error']=true;
                    $response['started']=false;
                    $response['message']="Something went wrong with starting the journey";
                }
            }
        }else{
            $response['error']=true;
            $response['started']=false;
            $response['message']="The journey assignment no longer exists!";
        }

        echo json_encode($response);
    }

}