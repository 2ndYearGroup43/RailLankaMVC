<?php
    class ModeratorJourneys extends Controller{

        public function __construct()
        {
            $this->journeyModel=$this->model('ModeratorJourney');
        }

        public function index()
        {
            

            $data=$this->journeyModel->displayJourneyAssignments();
                       
            $this->view('moderators/journeys/journeymanagement', $data);
        }

        public function createJourneyAssignment()
        {

            $data=[
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

            var_dump($_SERVER['REQUEST_METHOD']);

            if($_SERVER['REQUEST_METHOD']=='POST'){
                $_POST=filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);//filter harmful data
                $data=[
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
                }

                //check if driverId is entered | exists 
                if(empty($data['driverId'])){
                    $data['driverIdError']='The driverId should not be empty';   
                }elseif (!$this->journeyModel->findDriverById($data['driverId'])) {
                    $data['driverIdError']="The train Id entered doesnt exist in the system.";
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
    }