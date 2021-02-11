<?php


class DriverMobileLocations extends Controller
{
    private $locationModel;

    public function __construct(){
        $this->locationModel=$this->model('DriverMobileLocation');
    }

    public function startJourney($journeyId){ //checks if a journey is entered again and it exists check if the location is created of not if not creates one or else continues the one by updating
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

    public function saveLocationData(){//works
        $_POST=filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        $response= array();
        $journeyId=$_POST['journeyId'];
        $lat=$_POST['lat'];
        $lng=$_POST['lng'];
//        $journeyId='13';
//        $lat='45.6890';
//        $lng='88.411162';
        if($this->locationModel->checkJourney($journeyId)){
            if($this->locationModel->checkIfStarted($journeyId)){//location exists
                if($this->locationModel->updateLocation($journeyId, $lat, $lng)){
                    $response['error']=false;
                    $response['started']=true;
                    $response['journey']=true;
                    $response['updated']=true;
                    $response['message']="Continuing the journey....";
                }else{
                    $response['error']=false;
                    $response['started']=true;
                    $response['journey']=true;
                    $response['updated']=false;
                    $response['message']="Continuing the journey....";
                }

            }else{
                if($this->locationModel->createLocation($journeyId, $lat, $lng)){
                    $response['error']=false;
                    $response['started']=true;
                    $response['journey']=true;
                    $response['updated']=true;
                    $response['message']="Journey's started!";
                }else{
                    $response['error']=true;
                    $response['started']=false;
                    $response['journey']=true;
                    $response['updated']=false;
                    $response['message']="Something went wrong with starting the journey";
                }
            }
        }else{
            $response['error']=true;
            $response['started']=false;
            $response['journey']=false;
            $response['updated']=false;
            $response['message']="The journey assignment no longer exists!";
        }

        echo json_encode($response);

    }

    public function stopSharing(){
        $_POST=filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        $journeyId=$_POST['journeyId'];
        $response=array();
        if($this->locationModel->checkJourney($journeyId)){
            //journey exists
            if($this->locationModel->stopJourney($journeyId)){
                $response['error']=false;
                $response['journey']=true;
                $response['message']='Journey successfully stopped';
            }else{
                $response['error']=true;
                $response['journey']=true;
                $response['message']='Journey couldnt be stopped';
            }
        }else{
            $response['error']=true;
            $response['journey']=false;
            $response['message']='Journey Doesnt exist! maybe ended';
        }
        echo json_encode($response);
    }


    public function endJourney(){
        $_POST=filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        $response=array();
        $journeyId=$_POST['journeyId'];
        if($this->locationModel->checkJourney($journeyId)){
            //journey exists
            if($this->locationModel->endJourney($journeyId)){
                $response['error']=false;
                $response['journey']=true;
                $response['message']='Journey successfully ended';
            }else{
                $response['error']=true;
                $response['journey']=true;
                $response['message']='Journey couldnt be ended';
            }
        }else{
            $response['error']=false;//journey is basically ended
            $response['journey']=false;
            $response['message']='Journey Doesnt exist! maybe already ended';
        }

        echo  json_encode($response);
    }

}