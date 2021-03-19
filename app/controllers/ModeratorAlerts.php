<?php
    class ModeratorAlerts extends Controller{
        private $limit;
        public function __construct()
        {
            isModeratorLoggedIn();
            $this->alertModel=$this->model('ModeratorAlert');
            $this->limit=50;
        }

        public function index()
        {
           
            $alerts=$this->alertModel->displayCancellations();
            $fields=$this->alertModel->getCancellationFields();
            $data=[
                'alerts'=>$alerts,
                'fields'=>$fields
            ];
            

            $this->view('moderators/alerts/managecancellations', $data);
        }

        public function createCancellationAlerts()
        {
           $trains=$this->alertModel->getTrains();

            $data=[
                'trains'=>$trains,
                'trainId'=>'',
                'cancelCause'=>'',
                'cancelDate'=>'',
                'issueType'=>'',
                'insertedDate'=>'',
                'insertedTime'=>'',
                'moderatorId'=>'',
                'trainIdError'=>'',
                'cancelDateError'=>'',
                'issueTypeError'=>'',
                'cancelCauseError'=>''

            ];


            if($_SERVER['REQUEST_METHOD']=='POST'){
                $_POST=filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);//filter harmful data
                $data=[
                    'trains'=>$trains,
                    'trainId'=>trim($_POST['trainid']),
                    'cancelDate'=>trim($_POST['cancelDate']),
                    'cancelCause'=>trim($_POST['cancelcause']),
                    'issueType'=>trim($_POST['issueType']),
                    'insertedDate'=>date("Y-m-d"),
                    'insertedTime'=>date("H:i:sa"),
                    'moderatorId'=>$_SESSION['moderator_id'],
                    'trainIdError'=>'',
                    'cancelDateError'=>'',
                    'issueTypeError'=>'',
                    'cancelCauseError'=>''
                ];

                

                if(empty($data['trainId'])){
                    $data['trainIdError']='The trainId should not be empty';   
                }elseif (!$this->alertModel->findTrainById($data['trainId'])) {
                    $data['trainIdError']="The train Id entered doesnt exist in the system.";
                }

                if(empty($data['cancelCause'])){
                    $data['cancelCauseError']='The Cancellation cause should not be empty';    
                }
                $cdate= new DateTime($data['cancelDate']);
                $cdate=$cdate->format("Y-m-d");
                $now=new DateTime();
                $now=$now->format("Y-m-d");
                if(empty($data['cancelDate'])){
                    $data['cancelDateError']='The Cancellation date should not be empty';
                }elseif ($cdate<$now){
                    $data['cancelDateError']='Cancellation date is not valid maybe in the past';
                }

                
                if(empty($data['issueType'])){
                    $data['issueTypeError']='The Issue Type should not be empty';    
                }

                if(empty($data['trainIdError'])&& empty($data['cancelCauseError']) && empty($data['issueTypeError'])
                && empty($data['cancelDateError'])){
                    if($this->alertModel->addCancellationAlert($data)){
                        header("Location: ".URLROOT."/moderatoralerts/viewcancelledalerts");
                    }else{
                        die("Something went wrong please try again");
                    }
                }else{
                    $this->view('moderators/alerts/addCancellations',$data);
                }
            }

            $this->view('moderators/alerts/addCancellations',$data);
        }


        public function viewCancelledAlerts()
        {
            $limit=$this->limit;
            $totalAlerts=$this->alertModel->countCancellations();
            $fields=$this->alertModel->getCancellationFields();

            if(isset($_GET['page'])){
                $page=$_GET['page'];
            }else{
                $page=1;
            }

            $start=($page-1)*$limit;

            $alerts=$this->alertModel->displayCancellations($start, $limit);


            $data=[
                'alerts'=>$alerts,
                'fields'=>$fields,
                'limit'=>$limit,
                'totalAlerts'=>$totalAlerts,
                'totalPages'=>ceil($totalAlerts/$limit),
                'start'=>$start,
                'page'=>$page
            ];
            
            $this->view('moderators/alerts/managecancellations', $data);
        }

        public function cancellationsSearchBy()
        {
            $limit=$this->limit;
           
            $data=[
                'alerts'=>'',
                'fields'=>'',
                'searchBar'=>'',    
                'searchSelect'=>'',
                'limit'=>'',
                'totalAlerts'=>'',
                'totalPages'=>'',
                'start'=>'',
                'page'=>''
            ];
            if($_SERVER['REQUEST_METHOD']=='POST'){
                $_POST=filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

                $searchBar=trim($_POST['searchbar']);
                $searchSelect=trim($_POST['searchselect']);
            }else{
                if(isset($_GET['searchbar'])){
                    $searchBar=$_GET['searchbar'];
                    $searchSelect=$_GET['searchselect'];
                }else{
                    $searchSelect='';
                    $searchBar='';
                }
            }


            if (isset($_GET['page'])){
                $page=$_GET['page'];
            }else{
                $page=1;
            }

            $start=($page-1)*$limit;
            $totalAlerts=$this->alertModel->countFilteredCancellations($searchBar, $searchSelect);
            $alerts=$this->alertModel->searchCancellations($searchBar, $searchSelect, $start, $limit);
            $fields=$this->alertModel->getCancellationFields();

            $data=[
                'alerts'=>$alerts,
                'fields'=>$fields,
                'searchBar'=>$searchBar,
                'searchSelect'=>$searchSelect,
                'limit'=>$limit,
                'totalAlerts'=>$totalAlerts,
                'totalPages'=>ceil($totalAlerts/$limit),
                'start'=>$start,
                'page'=>$page
            ];

//
            $this->view('moderators/alerts/managecancellations', $data);

        }

        public function updateCancellations($id)
        {
            $trains=$this->alertModel->getTrains();

             
            $alert=$this->alertModel->findCancellationById($id);
            
        
            $data=[
                'alert'=>$alert,
                'trains'=>$trains,
                'trainId'=>'',
                'cancelDate'=>'',
                'issueType'=>'',
                'cancelCause'=>'',
                'insertedDate'=>'',
                'insertedTime'=>'',
                'moderatorId'=>'',
                'trainIdError'=>'',
                'cancelDateError'=>'',
                'issueTypeError'=>'',
                'cancelCauseError'=>''
            ];

            if($_SERVER['REQUEST_METHOD']=='POST'){
                $_POST=filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);//filter harmful data
                $data=[
                    'alert'=>$alert,
                    'trains'=>$trains,
                    'alertId'=>$id,
                    'issueType'=>trim($_POST['issueType']),
                    'trainId'=>trim($_POST['trainid']),
                    'cancelDate'=>trim($_POST['cancelDate']),
                    'cancelCause'=>trim($_POST['cancelcause']),
                    'insertedDate'=>date("Y-m-d"),
                    'insertedTime'=>date("H:i:sa"),
                    'moderatorId'=>$_SESSION['moderator_id'],
                    'issueTypeError'=>'',
                    'trainIdError'=>'',
                    'cancelDateError'=>'',
                    'cancelCauseError'=>''
                ];

                

                if(empty($data['trainId'])){
                    $data['trainIdError']='The trainId should not be empty';   
                }elseif (!$this->alertModel->findTrainById($data['trainId'])) {
                    $data['trainIdError']="The train Id entered doesnt exist in the system.";
                }


                if(empty($data['cancelCause'])){
                    $data['cancelCauseError']='The Cancellation cause should not be empty';    
                }

                $cdate= new DateTime($data['cancelDate']);
                $cdate=$cdate->format("Y-m-d");
                $now=new DateTime();
                $now=$now->format("Y-m-d");
                if(empty($data['cancelDate'])){
                    $data['cancelDateError']='The Cancellation date should not be empty';
                }elseif ($cdate<$now){
                    $data['cancelDateError']='Cancellation date is not valid maybe in the past';
                }

                
                if(empty($data['issueType'])){
                    $data['issueTypeError']='The Issue type should not be empty';    
                }



                if($data['trainId']==$this->alertModel->findCancellationById($id)->trainId
                     && $data['cancelCause']==$this->alertModel->findCancellationById($id)->cancellation_cause
                     && $data['issueType']==$this->alertModel->findCancellationById($id)->issuetype
                    && $data['cancelDate']==$this->alertModel->findCancellationById($id)->cancellation_date){
                    $data['trainIdError']='No change done to any field.';
                    $data['cancelCauseError']='No change done to any field.';
                    $data['cancelDateError']='No change done to any field';
                    $data['issueTypeError']='No change done to any field.';    
                }

                if(empty($data['trainIdError'])&& empty($data['cancelCauseError']) && empty($data['issueTypeError'])
                && empty($data['cancelDateError'])){
                    if($this->alertModel->updateCancellationAlert($data)){
                        header("Location: ".URLROOT."/moderatoralerts/viewcancelledalerts");
                    }else{
                        die("Something went wrong please try again");
                    }
                }else{
                    $this->view('moderators/alerts/updateCancellations',$data);
                }
            }

            $this->view('moderators/alerts/updateCancellations',$data);
        }

   

        
        public function createDelayAlerts()
        {
           
            $trains=$this->alertModel->getTrains();

            $data=[
                'trainId'=>'',
                'trains'=>$trains,
                'delayTime'=>'',
                'delayDate'=>'',
                'delayCause'=>'',
                'issueType'=>'',
                'insertedDate'=>'',
                'insertedTime'=>'',
                'moderatorId'=>'',
                'trainIdError'=>'',
                'issueTypeError'=>'',
                'delayDateError'=>'',
                'delayTimeError'=>'',
                'delayCauseError'=>''

            ];

            if($_SERVER['REQUEST_METHOD']=='POST'){
                $_POST=filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);//filter harmful data
                $data=[
                    'trains'=>$trains,
                    'trainId'=>trim($_POST['trainid']),
                    'delayTime'=>trim($_POST['delaytime']),
                    'delayDate'=>trim($_POST['delaydate']),
                    'issueType'=>trim($_POST['issueType']),
                    'delayCause'=>trim($_POST['delaycause']),
                    'insertedDate'=>date("Y-m-d"),
                    'insertedTime'=>date("H:i:sa"),
                    'moderatorId'=>$_SESSION['moderator_id'],
                    'trainIdError'=>'',
                    'issueTypeError'=>'',
                    'delayDateError'=>'',
                    'delayTimeError'=>'',
                    'delayCauseError'=>''
                ];

                

                if(empty($data['trainId'])){
                    $data['trainIdError']='The trainId should not be empty';   
                }elseif (!$this->alertModel->findTrainById($data['trainId'])) {
                    $data['trainIdError']="The train Id entered doesnt exist in the system.";
                }

                $ddate= new DateTime($data['delayDate']);
                $now=new DateTime();
                $ddate=$ddate->format('Y-m-d');
                $now=$now->format("Y-m-d");
                if(empty($data['delayDate'])){
                    $data['delayDateError']='The Delay Date should not be empty';
                }elseif ($ddate<$now){
                    $data['delayDateError']='The entered date might be in the past';
                }
                if(empty($data['delayTime'])){
                    $data['delayTimeError']='The Delay Time should not be empty';
                }

                if(empty($data['delayCause'])){
                    $data['delayCauseError']='The Delay cause should not be empty';    
                }
                if(empty($data['issueType'])){
                    $data['issueTypeError']='The Issue type should not be empty';    
                }


                if(empty($data['trainIdError']) && empty($data['delayTimeError']) && empty($data['delayCauseError'])
                &&  empty($data['issueTypeError']) && empty($data['delayDateError'])){
                    if($this->alertModel->addDelayAlert($data)){
                        header("Location: ".URLROOT."/moderatoralerts/viewDelayedAlerts");
                    }else{
                        die("Something went wrong please try again");
                    }
                }else{
                    $this->view('moderators/alerts/addDelays',$data);
                }
            }

            $this->view('moderators/alerts/addDelays',$data);
        }

        public function updateDelays($id)
        {

            $trains=$this->alertModel->getTrains();

            $alert=$this->alertModel->findDelayById($id);
            
        
            $data=[
                'alert'=>$alert,
                'trains'=>$trains,
                'trainId'=>'',
                'issueType'=>'',
                'delayDate'=>'',
                'delayTime'=>'',
                'delayCause'=>'',
                'insertedDate'=>'',
                'insertedTime'=>'',
                'moderatorId'=>'',
                'trainIdError'=>'',
                'issueTypeError'=>'',
                'delayDateError'=>'',
                'delayTimeError'=>'',
                'delayCauseError'=>''

            ];


            if($_SERVER['REQUEST_METHOD']=='POST'){
                $_POST=filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);//filter harmful data
                $data=[
                    'alert'=>$alert,
                    'trains'=>$trains,
                    'alertId'=>$id,
                    'trainId'=>trim($_POST['trainid']),
                    'issueType'=>trim($_POST['issueType']),
                    'delayDate'=>trim($_POST['delaydate']),
                    'delayTime'=>trim($_POST['delaytime']),
                    'delayCause'=>trim($_POST['delaycause']),
                    'insertedDate'=>date("Y-m-d"),
                    'insertedTime'=>date("H:i:sa"),
                    'moderatorId'=>$_SESSION['moderator_id'],
                    'trainIdError'=>'',
                    'issueTypeError'=>'',
                    'delayDateError'=>'',
                    'delayTimeError'=>'',
                    'delayCauseError'=>''
                ];

                


                if(empty($data['trainId'])){
                    $data['trainIdError']='The trainId should not be empty';   
                }elseif (!$this->alertModel->findTrainById($data['trainId'])) {
                    $data['trainIdError']="The train Id entered doesnt exist in the system.";
                }

                $ddate= new DateTime($data['delayDate']);
                $now=new DateTime();
                $ddate=$ddate->format('Y-m-d');
                $now=$now->format("Y-m-d");
                if(empty($data['delayDate'])){
                    $data['delayDateError']='The Delay Date should not be empty';
                }elseif ($ddate<$now){
                    $data['delayDateError']='The entered date might be in the past';
                }

                if(empty($data['delayTime'])){
                    $data['delayTimeError']='The Delay Time should not be empty';    
                }

                if(empty($data['delayCause'])){
                    $data['delayCauseError']='The Delay cause should not be empty';    
                }

                if(empty($data['issueType'])){
                    $data['issueTypeError']='The Issue type should not be empty';    
                }

                
                if($data['trainId']==$this->alertModel->findDelayById($id)->trainId
                     && $data['delayCause']==$this->alertModel->findDelayById($id)->delay_cause
                     && $data['delayTime']==$this->alertModel->findDelayById($id)->delaytime
                     && $data['delayDate']==$this->alertModel->findDelayById($id)->delaydate
                     && $data['issueType']==$this->alertModel->findDelayById($id)->issueType){
                    $data['trainIdError']='No change done to any field.';
                    $data['delayTimeError']='No change done to any field.';
                    $data['delayDateError']='No change done to any field.';
                    $data['delayCauseError']='No change done to any field.'; 
                    $data['issueTypeError']='No change done to any field.';
                }

                if(empty($data['trainIdError']) && empty($data['delayTimeError']) && empty($data['delayCauseError'])
                && empty($data['issueTypeError']) && empty($data['delayDateError'])){
                    if($this->alertModel->updateDelayAlert($data)){
                        header("Location: ".URLROOT."/moderatoralerts/viewDelayedAlerts");
                    }else{
                        die("Something went wrong please try again");
                    }
                }else{
                    $this->view('moderators/alerts/updateDelays',$data);
                }
            }

            $this->view('moderators/alerts/updateDelays',$data);
        }






        public function viewDelayedAlerts()
        { 
            $limit=$this->limit;
            $totalAlerts=$this->alertModel->countDelays();
            $fields=$this->alertModel->getDelayFields();

            if(isset($_GET['page'])){
                $page=$_GET['page'];
            }else{
                $page=1;
            }

            $start=($page-1)*$limit;
            $alerts=$this->alertModel->displayDelays($start, $limit);

            $data=[
                'alerts'=>$alerts,
                'fields'=>$fields,
                'limit'=>$limit,
                'totalAlerts'=>$totalAlerts,
                'totalPages'=>ceil($totalAlerts/$limit),
                'start'=>$start,
                'page'=>$page
            ];



            $this->view('moderators/alerts/managedelays', $data);
        }

        public function delaysSearchBy()
        {
            $data=[
                'alerts'=>'',
                'fields'=>'',
                'searchBar'=>'',
                'searchSelect'=>'',
                'limit'=>'',
                'totalAlerts'=>'',
                'totalPages'=>'',
                'start'=>'',
                'page'=>''
            ];

            if($_SERVER['REQUEST_METHOD']=='POST'){
                $_POST=filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

                    $searchBar=trim($_POST['searchbar']);
                    $searchSelect=trim($_POST['searchselect']);

            }else{
                if(isset($_GET['searchbar'])){
                    $searchBar=$_GET['searchbar'];
                    $searchSelect=$_GET['searchselect'];
                }else{
                    $searchBar="";
                    $searchSelect="";
                }
            }

            if(isset($_GET['page'])){
                $page=$_GET['page'];
            }else{
                $page=1;
            }

            $limit=$this->limit;
            $start=($page-1)*$this->limit;
            $totalAlerts=$this->alertModel->countFilteredDelays($searchBar, $searchSelect);
            $alerts=$this->alertModel->searchDelays($searchBar, $searchSelect, $start, $limit);
            $fields=$this->alertModel->getDelayFields();

            $data=[
                'alerts'=>$alerts,
                'fields'=>$fields,
                'searchBar'=>$searchBar,
                'searchSelect'=>$searchSelect,
                'limit'=>$limit,
                'totalAlerts'=>$totalAlerts,
                'totalPages'=>ceil($totalAlerts/$limit),
                'start'=>$start,
                'page'=>$page
            ];



            $this->view('moderators/alerts/managedelays', $data);

        }



        public function createRescheduledAlerts()
        {
            $trains=$this->alertModel->getTrains();
            
            $data=[
                'trainId'=>'',
                'trains'=>$trains,
                'issueType'=>'',
                'oldDate'=>'',
                'newDate'=>'',
                'newTime'=>'',
                'rechduledCause'=>'',
                'insertedDate'=>'',
                'insertedTime'=>'',
                'moderatorId'=>'',
                'trainIdError'=>'',
                'issueTypeError'=>'',
                'oldDateError'=>'',
                'newDateError'=>'',
                'newTimeError'=>'',
                'reschedulementCauseError'=>''
            ];

            if($_SERVER['REQUEST_METHOD']=='POST'){
                $_POST=filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);//filter harmful data
                $data=[
                    'trainId'=>trim($_POST['trainid']),
                    'trains'=>$trains,
                    'issueType'=>trim($_POST['issueType']),
                    'oldDate'=>trim($_POST['olddate']),
                    'newDate'=>trim($_POST['newdate']),
                    'newTime'=>trim($_POST['newtime']),
                    'reschedulementCause'=>trim($_POST['reschedulementcause']),
                    'insertedDate'=>date("Y-m-d"),
                    'insertedTime'=>date("H:i:sa"),
                    'moderatorId'=>$_SESSION['moderator_id'],
                    'trainIdError'=>'',
                    'issueTypeError'=>'',
                    'oldDateError'=>'',
                    'newDateError'=>'',
                    'newTimeError'=>'',
                    'reschedulementCauseError'=>''
                ];

                

                if(empty($data['trainId'])){
                    $data['trainIdError']='The trainId should not be empty';   
                }elseif (!$this->alertModel->findTrainById($data['trainId'])) {
                    $data['trainIdError']="The train Id entered doesnt exist in the system.";
                }

                $rdate= new DateTime($data['oldDate']);
                $now=new DateTime();
                $rdate=$rdate->format("Y-m-d");
                $now=$now->format("Y-m-d");
                if(empty($data['oldDate'])){
                    $data['oldDateError']='The old date should not be empty.';
                }

                if(empty($data['newDate'])){
                    $data['newDateError']='The new date should not be empty';    
                }

                $rnewDate=new DateTime($data['newDate']);
                $rnewDate=$rnewDate->format("Y-m-d");
                if($rdate>$rnewDate){
                    $data['oldDateError']='The old date should be older than the new date.';
                    $data['newDateError']='The new date should be newer than the old date.';
                }

                if(empty($data['newTime'])){
                    $data['newTimeError']='The new time should not be empty';    
                }

                if(empty($data['reschedulementCause'])){
                    $data['reschedulementCauseError']='The reschedulement cause should not be empty';    
                }

                if(empty($data['issueType'])){
                    $data['issueTypeError']='The Issue type should not be empty';    
                }




                if(empty($data['trainIdError']) && empty($data['newDateError']) && empty($data['newTimeError']) && empty($data['reschedulementCauseError'])
                && empty($data['issueTypeError']) && empty($data['oldDateError'])){
                    if($this->alertModel->addRescheduledAlert($data)){
                        header("Location: ".URLROOT."/moderatoralerts/viewRescheduledAlerts");
                    }else{
                        die("Something went wrong please try again");
                    }
                }else{
                    $this->view('moderators/alerts/addReschedulements',$data);
                }
            }

            $this->view('moderators/alerts/addReschedulements',$data);
        }

        public function updateReschedulements($id)
        {
            $trains=$this->alertModel->getTrains();

            $alert=$this->alertModel->findReschedulementById($id);
            
        
            $data=[
                'alert'=>$alert,
                'alertId'=>$id,
                'trains'=>$trains,
                'trainId'=>'',
                'issueType'=>'',
                'oldDate'=>'',
                'newDate'=>'',
                'newTime'=>'',
                'rechduledCause'=>'',
                'insertedDate'=>'',
                'insertedTime'=>'',
                'moderatorId'=>'',
                'trainIdError'=>'',
                'issueTypeError'=>'',
                'oldDateError'=>'',
                'newDateError'=>'',
                'newTimeError'=>'',
                'reschedulementCauseError'=>''
            ];


            if($_SERVER['REQUEST_METHOD']=='POST'){
                $_POST=filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);//filter harmful data
                $data=[
                    'alert'=>$alert,
                    'alertId'=>$id,
                    'trains'=>$trains,
                    'trainId'=>trim($_POST['trainid']),
                    'issueType'=>trim($_POST['issueType']),
                    'oldDate'=>trim(($_POST['olddate'])),
                    'newDate'=>trim($_POST['newdate']),
                    'newTime'=>trim($_POST['newtime']),
                    'reschedulementCause'=>trim($_POST['reschedulementcause']),
                    'insertedDate'=>date("Y-m-d"),
                    'insertedTime'=>date("H:i:sa"),
                    'moderatorId'=>$_SESSION['moderator_id'],
                    'trainIdError'=>'',
                    'issueTypeError'=>'',
                    'oldDateError'=>'',
                    'newDateError'=>'',
                    'newTimeError'=>'',
                    'reschedulementCauseError'=>''
                ];

                

                if(empty($data['trainId'])){
                    $data['trainIdError']='The trainId should not be empty';   
                }elseif (!$this->alertModel->findTrainById($data['trainId'])) {
                    $data['trainIdError']="The train Id entered doesnt exist in the system.";
                }

                $rdate= new DateTime($data['oldDate']);
                $now=new DateTime();
                if(empty($data['oldDate'])){
                    $data['oldDateError']='The old date should not be empty.';
                }elseif ($rdate<$now){
                    $data['oldDateError']='The date entered should not be in the past.';
                }


                if(empty($data['newDate'])){
                    $data['newDateError']='The new date should not be empty';    
                }

                $rnewDate=new DateTime($data['newDate']);
                if($rdate>$rnewDate){
                    $data['oldDateError']='The old date should be older than the new date.';
                    $data['newDateError']='The new date should be newer than the old date.';
                }

                if(empty($data['newTime'])){
                    $data['newTimeError']='The new time should not be empty';    
                }

                if(empty($data['issueType'])){
                    $data['issueTypeError']='The Issue type should not be empty';    
                }


                if(empty($data['reschedulementCause'])){
                    $data['reschedulementCauseError']='The reschedulement cause should not be empty';    
                }

                if($data['trainId']==$this->alertModel->findReschedulementById($id)->trainId
                     && $data['reschedulementCause']==$this->alertModel->findReschedulementById($id)->reschedulement_cause
                     && $data['newDate']==$this->alertModel->findReschedulementById($id)->newdate
                     && $data['newTime']==$this->alertModel->findReschedulementById($id)->newtime
                     && $data['newTime']==$this->alertModel->findReschedulementById($id)->issueType
                     && $data['oldDate']==$this->alertModel->findReschedulementById($id)->olddate){
                    $data['trainIdError']='No change done to any field.';
                    $data['oldDateError']='No change done to any field.';
                    $data['newDateError']='No change done to any field.';
                    $data['newTimeError']='No change done to any field.';
                    $data['reschedulementCauseError']='No change done to any field.';
                    $data['issueTypeError']='No change done to any field.';  
                }


                if(empty($data['trainIdError']) && empty($data['newDateError']) && empty($data['newTimeError']) && empty($data['reschedulementCauseError'])
                && empty($data['issueTypeError']) && empty($data['oldDateError'])){
                    if($this->alertModel->updateRescheduledAlert($data)){
                        header("Location: ".URLROOT."/moderatoralerts/viewRescheduledAlerts");
                    }else{
                        die("Something went wrong please try again");
                    }
                }else{
                    $this->view('moderators/alerts/updateReschedulements',$data);
                }
            }

            $this->view('moderators/alerts/updateReschedulements',$data);
        }

        public function viewRescheduledAlerts()
        {
            $limit=$this->limit;
            $totalAlerts=$this->alertModel->countReshedulements();
            $fields=$this->alertModel->getReschedulementFields();

            if(isset($_GET['page'])){
                $page=$_GET['page'];
            }else{
                $page=1;
            }

            $start=($page-1)*$limit;

            $alerts=$this->alertModel->displayReschedulements($start, $limit);
            $data=[
                'alerts'=>$alerts,
                'fields'=>$fields,
                'limit'=>$limit,
                'totalAlerts'=>$totalAlerts,
                'totalPages'=>ceil($totalAlerts/$limit),
                'start'=>$start,
                'page'=>$page
            ];
            
            $this->view('moderators/alerts/managereschedulements', $data);
        }

        public function reschedulementsSearchBy()
        {
           $limit=$this->limit;
            $data=[
                'alerts'=>'',
                'fields'=>'',
                'searchBar'=>'',
                'searchSelect'=>'',
                'limit'=>'',
                'totalAlerts'=>'',
                'totalPages'=>'',
                'start'=>'',
                'page'=>''
            ];
            if($_SERVER['REQUEST_METHOD']=='POST'){
                $_POST=filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
                    $searchBar=trim($_POST['searchbar']);
                    $searchSelect=trim($_POST['searchselect']);
            }  else {
                if (isset($_GET['searchbar'])) {
                    $searchBar = $_GET['searchbar'];
                    $searchSelect = $_GET['searchselect'];
                } else {
                    $searchBar = '';
                    $searchSelect = '';
                }

            }

                if(isset($_GET['page'])){
                    $page=$_GET['page'];
                }else{
                    $page=1;
                }

                $start=($page-1)*$limit;
                $totalAlerts=$this->alertModel->countFilteredReshedulements($searchBar, $searchSelect);
                $alerts=$this->alertModel->searchReschedulements($searchBar, $searchSelect, $start, $limit);
                $fields=$this->alertModel->getReschedulementFields();

                $data=[
                    'alerts'=>$alerts,
                    'fields'=>$fields,
                    'searchBar'=>$searchBar,
                    'searchSelect'=>$searchSelect,
                    'limit'=>$limit,
                    'totalAlerts'=>$totalAlerts,
                    'totalPages'=>ceil($totalAlerts/$limit),
                    'start'=>$start,
                    'page'=>$page
                ];

            $this->view('moderators/alerts/managereschedulements', $data);

        }

        public function alertsDash()
        {
            $cancelCount=$this->alertModel->getCancelCount();
            $delayCount=$this->alertModel->getDelayCount();
            $reschCount=$this->alertModel->getReschCount();

            $issueCounts=$this->alertModel->getIssueCounts();

            $date=new DateTime();
            $data=[
                'searchDate'=>$date->format("Y-m-d"),
                'cancelledCount'=>$cancelCount,
                'delayedCount'=>$delayCount,
                'rescheduledCount'=>$reschCount,
                'envCount'=>$issueCounts['environmental'],
                'techCount'=>$issueCounts['technical'],
                'railroadCount'=>$issueCounts['railroad'],
                'unspecCount'=>$issueCounts['unspecified'],
                'otherCount'=>$issueCounts['other']
            ];
            $this->view('moderators/alerts/alertsdash', $data);
        }

        
        public function alertsDateDash()
        {
            
            $data=[
                'searchDate'=>'',
                'cancelledCount'=>'',
                'delayedCount'=>'',
                'rescheduledCount'=>'',
                'technicalCount'=>'',
                'environCount'=>'',
                'railCount'=>'',
                'otherCount'=>''
            ];

            if($_SERVER['REQUEST_METHOD']=='POST'){
                filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
                $date=$_POST['searchDate'];
                $cancelCount=$this->alertModel->getCancelCount($date);
                $delayCount=$this->alertModel->getDelayCount($date);
                $reschCount=$this->alertModel->getReschCount($date);

                $issueCounts=$this->alertModel->getIssueCounts($date);

                $data=[
                    'searchDate'=>$date,
                    'cancelledCount'=>$cancelCount,
                    'delayedCount'=>$delayCount,
                    'rescheduledCount'=>$reschCount,
                    'envCount'=>$issueCounts['environmental'],
                    'techCount'=>$issueCounts['technical'],
                    'railroadCount'=>$issueCounts['railroad'],
                    'unspecCount'=>$issueCounts['unspecified'],
                    'otherCount'=>$issueCounts['other']
                ];
                $this->view('moderators/alerts/alertsdash', $data);

            }
            $this->view('moderators/alerts/alertsdash', $data);
        }

        public function revenue()
        {
            $this->view('moderators/revenuedash');
        }

        public function deleteAlert($id,$type)
        {

            if($_SERVER['REQUEST_METHOD']=='POST'){
                $_POST=filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);//filter harmful data

                if($this->alertModel->deleteAlert($id)){
                    switch ($type) {
                        case 'c':
                            header("Location: ".URLROOT."/moderatoralerts/viewCancelledAlerts");
                            break;
                        case 'd':
                            header("Location: ".URLROOT."/moderatoralerts/viewDelayedAlerts");
                            break;
                        case 'r':
                            header("Location: ".URLROOT."/moderatoralerts/viewRescheduledAlerts");
                            break;
                    }
                    
                }else{
                    die("Something went wrong");
                }
            }

        }


    
    
    
    }


   
