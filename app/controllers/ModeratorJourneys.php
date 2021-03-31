<?php
    class ModeratorJourneys extends Controller{
        private $limit;
        public function __construct()
        {
            isModeratorLoggedIn();
            $this->limit=30;
            $this->journeyModel=$this->model('ModeratorJourney');
        }

        public function index()
        {
            $limit=$this->limit;
            $totalJourneys=$this->journeyModel->countJourneyAssignments();
            $fields=$this->journeyModel->getJourneyFields();

            if(isset($_GET['page'])){
                $page=$_GET['page'];
            }else{
                $page=1;
            }
            $start=($page-1)*$limit;

            $journeys=$this->journeyModel->displayJourneyAssignments($start, $limit);

            $data=[
                'journeys'=>$journeys,
                'fields'=>$fields,
                'limit'=>$limit,
                'totalJourneys'=>$totalJourneys,
                'totalPages'=>ceil($totalJourneys/$limit),
                'start'=>$start,
                'page'=>$page
            ];
                       
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

                $adate=new DateTime($data['date']);
                $adate=$adate->format("Y-m-d");
                $now=new DateTime();
                $now=$now->format("Y-m-d");
                //check if the date field is empty
                if(empty($data['date'])){
                    $data['dateError']='The date should not be empty';    
                }elseif ($adate<$now){
                    $data['dateError']='The assignment date cannot be in the past';
                }else{
                    if(empty($data['trainIdError'])){
                        $day=date('l', strtotime($data['date']));
                        $day=strtolower($day);
                        $availableDays=$this->journeyModel->getDays($data['trainId']);
                        if($availableDays->$day=="No"){
                            $data['dateError']='The assigned train is not run on '.$day.'s.';
                        }
                    }
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
                }else{
                    if(empty($data['trainIdError'])){
                        $day=date('l', strtotime($data['date']));
                        $day=strtolower($day);
                        $availableDays=$this->journeyModel->getDays($data['trainId']);
                        if($availableDays->$day=="No"){
                            $data['dateError']='The assigned train is not run on '.$day.'s.';
                        }
                    }
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

        public function journeysSearchBy(){
            $data=[
                'journeys'=>'',
                'fields'=>'',
                'searchBar'=>'',
                'searchSelect'=>'',
                'limit'=>'',
                'totalJourneys'=>'',
                'totalPages'=>'',
                'start'=>'',
                'page'=>''
            ];

            if($_SERVER['REQUEST_METHOD']=='POST'){
                $_POST=filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

                    $searchBar=trim($_POST['searchbar']);
                    $searchSelect=trim($_POST['searchselect']);

            }else{
                if (isset($_GET['searchbar'])){
                    $searchBar=$_GET['searchbar'];
                    $searchSelect=$_GET['searchselect'];
                }else{
                    $searchBar='';
                    $searchSelect='';
                }
            }
            $limit=$this->limit;
            if (isset($_GET['page'])){
                $page=$_GET['page'];
            }else{
                $page=1;
            }

            $start=($page-1)*$limit;
            $totalJourneys=$this->journeyModel->countSearchJourneys($searchBar, $searchSelect);
            $journeys=$this->journeyModel->searchJourneys($searchBar, $searchSelect, $start, $limit);
            $fields=$this->journeyModel->getJourneyFields();

            $data=[
                'journeys'=>$journeys,
                'fields'=>$fields,
                'searchBar'=>$searchBar,
                'searchSelect'=>$searchSelect,
                'limit'=>$limit,
                'totalJourneys'=>$totalJourneys,
                'totalPages'=>ceil($totalJourneys/$limit),
                'start'=>$start,
                'page'=>$page
            ];

            $this->view('moderators/journeys/journeymanagement', $data);

        }

        public function viewJourneys($statusFlag){
            switch ($statusFlag){
                case 'live':
                    $jStatus='Live';
                    break;
                case 'offline':
                    $jStatus='Off-Line';
                    break;
                case 'ended':
                    $jStatus='Ended';
                    break;
            }

            $limit=$this->limit;
            $totalJourneys=$this->journeyModel->countFilteredJourneyAssignments($jStatus);
            $fields=$this->journeyModel->getJourneyFields();


            if(isset($_GET['page'])){
                $page=$_GET['page'];
            }else{
                $page=1;
            }

            $start=($page-1)*$limit;


            $journeys=$this->journeyModel->displayFilteredJourneyAssignments($jStatus, $start, $limit);

            $c=0;
            foreach ($fields as $field){
                if($field=='journey_status'){
                    array_splice($fields, $c, $c);
                }
                $c++;
            }
            $data=[
                'journeys'=>$journeys,
                'fields'=>$fields,
                'jstatus'=>$statusFlag,
                'limit'=>$limit,
                'totalJourneys'=>$totalJourneys,
                'totalPages'=>ceil($totalJourneys/$limit),
                'start'=>$start,
                'page'=>$page
            ];



            $this->view('moderators/journeys/filteredjourneymanagement', $data);
        }

        public function journeysFilteredSearchBy($statusFlag){
            $data=[
                'journeys'=>'',
                'fields'=>'',
                'searchBar'=>'',
                'searchSelect'=>'',
                'jstatus'=>'',
                'limit'=>'',
                'totalJourneys'=>'',
                'totalPages'=>'',
                'start'=>'',
                'page'=>''
            ];


            switch ($statusFlag){
                case 'live':
                    $jStatus='Live';
                    break;
                case 'offline':
                    $jStatus='Off-Line';
                    break;
                case 'ended':
                    $jStatus='Ended';
                    break;
            }

            if($_SERVER['REQUEST_METHOD']=='POST'){
                $_POST=filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

                $searchBar=trim($_POST['searchbar']);
                $searchSelect=trim($_POST['searchselect']);

            }else{
                if(isset($_GET['searchbar'])){
                    $searchBar=$_GET['searchbar'];
                    $searchSelect=$_GET['searchselect'];
                }else{
                    $searchBar='';
                    $searchSelect='';
                }
            }

            if(isset($_GET['page'])){
                $page=$_GET['page'];
            }else{
                $page=1;
            }

            $limit=$this->limit;
            $start=($page-1)*$limit;

            $totalJourneys=$this->journeyModel->countSearchFilteredJourneys($searchBar, $searchSelect, $jStatus);
            $journeys=$this->journeyModel->searchFilteredJourneys($searchBar, $searchSelect, $jStatus, $start, $limit);
            $fields=$this->journeyModel->getJourneyFields();

            $data=[
                'journeys'=>$journeys,
                'fields'=>$fields,
                'searchBar'=>$searchBar,
                'searchSelect'=>$searchSelect,
                'jstatus'=>$statusFlag,
                'limit'=>$limit,
                'totalJourneys'=>$totalJourneys,
                'totalPages'=>ceil($totalJourneys/$limit),
                'start'=>$start,
                'page'=>$page
            ];



            $this->view('moderators/journeys/filteredjourneymanagement', $data);

        }

        public function deleteJourney($flag=0){
            if($_SERVER['REQUEST_METHOD']=='POST'){
                $_POST=filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
                $journeyId=$_POST['journeyIdDel'];
                if($this->journeyModel->deleteJourney($journeyId)){
                    switch($flag){
                        case 'live':
                            header("Location: ".URLROOT."/moderatorJourneys/viewJourneys/live");
                            break;
                        case 'offline':
                            header("Location: ".URLROOT."/moderatorJourneys/viewJourneys/offline");
                            break;
                        case 'ended':
                            header("Location: ".URLROOT."/moderatorJourneys/viewJourneys/ended");
                            break;
                        case all:
                            header("Location: ".URLROOT."/moderatorJourneys/index");
                            break;

                    }
                }else{
                    die("Something went wrong");
                }
            }
        }












    }