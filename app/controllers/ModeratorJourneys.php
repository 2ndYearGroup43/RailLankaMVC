<?php
    class ModeratorJourneys extends Controller{

        public function __construct()
        {
            isModeratorLoggedIn();
            $this->journeyModel=$this->model('ModeratorJourney');
        }

        public function index()
        {
            

            $data=$this->journeyModel->displayJourneyAssignments();
                       
            $this->view('moderators/journeys/journeymanagement', $data);
        }

        public function createJourneyAssignment()
        {
            $trains=$this->journeyModel->getTrains();
            $drivers=$this->journeyModel->getDrivers();

            $data=[
                'trains'=>$trains,
                'drivers'=>$drivers,
                'trainId'=>'',
                'driverId'=> '',
                'date' => '',
                'jstatus' => '',
                'insertedDate'=>'',
                'insertedTime'=>'',
                'moderatorId'=>'',
                'trainIdError'=>'',
                'driverIdError'=>'',
                'dateError' => '',
                'jstatusError' => ''

            ];

            

            if($_SERVER['REQUEST_METHOD']=='POST'){
                $_POST=filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);//filter harmful data
                $data=[
                    'trains'=>$trains,
                    'drivers'=>$drivers,
                    'trainId'=>trim($_POST['trainid']),
                    'driverId'=>trim($_POST['driverid']),
                    'jstatus'=>trim($_POST['jstatus']),
                    'date'=> trim($_POST['date']),
                    'insertedDate'=>date("Y-m-d"),
                    'insertedTime'=>date("H:i:sa"),
                    'moderatorId'=>$_SESSION['moderator_id'],
                    'trainIdError'=>'',
                    'driverIdError'=>'',
                    'jstatusError' => '',
                    'dateError' => ''
                ];

                echo $data['trainId'];
                
                //check if trainId is entered | exists 
                if(empty($data['trainId'])){
                    $data['trainIdError']='The trainId should not be empty';   
                }elseif (!$this->journeyModel->findTrainById($data['trainId'])) {
                    $data['trainIdError']="The train Id entered doesnt exist in the system.";
                }elseif ($this->journeyModel->checkTrain($data['trainId'])) {
                    $data['trainIdError']='The Train is not eligible for assignment Maybe already assigned.';
                }

                //check if driverId is entered | exists 
                if(empty($data['driverId'])){
                    $data['driverIdError']='The driverId should not be empty';   
                }elseif (!$this->journeyModel->findDriverById($data['driverId'])) {
                    $data['driverIdError']="The train Id entered doesnt exist in the system.";
                }elseif ($this->journeyModel->checkDriver($data['driverId'])) {
                    $data['driverIdError']='The Driver is not eligible for assignment Maybe already assigned.';
                }

                //check if the status field is empty
                if(empty($data['jstatus'])){
                    $data['jstatusError']='The journey status should not be empty';    
                }

                //check if the date field is empty
                if(empty($data['date'])){
                    $data['dateError']='The date should not be empty';    
                }


                if(empty($data['trainIdError']) && empty($data['driverIdError']) && empty($data['jstatusError']) && empty($data['dateError'])){
                    if($this->journeyModel->addJourneyAssignment($data)){
                        header("Location: ".URLROOT."/ModeratorJourneys/index");
                    }else{
                        die("Something went wrong please try again");
                    }
                }else{
                    $this->view('moderators/journeys/journeyassignment',$data);
                }
            }

            $this->view('moderators/journeys/journeyassignment',$data);
        }


        public function updateJourney($journeyId, $driverId)
        {
            $trains=$this->journeyModel->getTrains();
            $drivers=$this->journeyModel->getDrivers();
            $journey=$this->journeyModel->getJourneyDetails($journeyId,$driverId);

            $data=[
                'trains'=>$trains,
                'drivers'=>$drivers,
                'journeyId'=>$journeyId,
                'driver'=>$driverId,
                'journey'=>$journey,
                'trainId'=>'',
                'driverId'=> '',
                'date' => '',
                'jstatus' => '',
                'trainIdError'=>'',
                'driverIdError'=>'',
                'dateError' => '',
                'jstatusError' => ''
            ];

            if($_SERVER['REQUEST_METHOD']=='POST'){
                $_POST=filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);//filter harmful data
                $data=[
                    'trains'=>$trains,
                    'drivers'=>$drivers,
                    'journeyId'=>$journeyId,
                    'driver'=>$driverId,
                    'journey'=>$journey,
                    'trainId'=>trim($_POST['trainid']),
                    'driverId'=>trim($_POST['driverid']),
                    'jstatus'=>trim($_POST['jstatus']),
                    'date'=> trim($_POST['date']),
                    'insertedDate'=>date("Y-m-d"),
                    'insertedTime'=>date("H:i:sa"),
                    'moderatorId'=>$_SESSION['moderator_id'],
                    'trainIdError'=>'',
                    'driverIdError'=>'',
                    'jstatusError' => '',
                    'dateError' => ''
                ];

                
                
                //check if trainId is entered | exists 
                if(empty($data['trainId'])){
                    $data['trainIdError']='The trainId should not be empty';   
                }elseif (!$this->journeyModel->findTrainById($data['trainId'])) {
                    $data['trainIdError']="The train Id entered doesnt exist in the system.";
                }elseif ($data['trainId']!=$journey->trainId && $this->journeyModel->checkTrain($data['trainId'])) {
                    $data['trainIdError']='The Train is not eligible for assignment Maybe already assigned.';
                }

                
                //check if driverId is entered | exists 
                if(empty($data['driverId'])){
                    $data['driverIdError']='The driverId should not be empty';   
                }elseif (!$this->journeyModel->findDriverById($data['driverId'])) {
                    $data['driverIdError']="The train Id entered doesnt exist in the system.";
                }elseif ($data['driverId']!=$journey->driverId && $this->journeyModel->checkDriver($data['driverId'])) {
                    $data['driverIdError']='The Driver is not eligible for assignment Maybe already assigned.';
                }

                //check if the status field is empty
                if(empty($data['jstatus'])){
                    $data['jstatusError']='The journey status should not be empty';    
                }

                //check if the date field is empty
                if(empty($data['date'])){
                    $data['dateError']='The date should not be empty';    
                }


                if ($data['trainId']==$journey->trainId && $data['driverId']==$journey->driverId &&
                    $data['jstatus']==$journey->journey_status && $data['date']==$journey->date) {
                        $data['trainIdError']='At least change one field';
                        $data['driverIdError']='At least change one field';
                        $data['jstatusError']='At least change one field';
                        $data['dateError']='At least change one field';      
                }


                if(empty($data['trainIdError']) && empty($data['driverIdError']) && empty($data['jstatusError']) && empty($data['dateError'])){
                    if($this->journeyModel->updateJourneyAssignment($data)){
                        header("Location: ".URLROOT."/ModeratorJourneys/index");
                    }else{
                        die("Something went wrong please try again");
                    }
                }else{
                    $this->view('moderators/journeys/updatejourneyassignment',$data);
                }


            }

            $this->view('moderators/journeys/updatejourneyassignment',$data);

        }












    }