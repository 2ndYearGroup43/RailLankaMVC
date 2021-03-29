<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

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
            $this->alertsDash();
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
                }else{
                    if(empty($data['trainIdError'])){
                        $day=date('l', strtotime($data['cancelDate']));
                        $day=strtolower($day);
                        $availableDays=$this->alertModel->getDays($data['trainId']);
                        if($availableDays->$day=="No"){
                            $data['cancelDateError']='The assigned train is not run on '.$day.'s.';
                        }
                    }
                }

                
                if(empty($data['issueType'])){
                    $data['issueTypeError']='The Issue Type should not be empty';    
                }

                if(empty($data['trainIdError'])&& empty($data['cancelCauseError']) && empty($data['issueTypeError'])
                && empty($data['cancelDateError'])){
                    if($this->alertModel->addCancellationAlert($data)){
                        $train=$this->alertModel->getTrainDetails($data['trainId']);
                        $subscriberList=$this->alertModel->getSubscriptionList($data['trainId']);
                        if(sizeof($subscriberList)>0){
                            $message=$this->generateCancellationEmail($data, $train);
                            $this->sendAlertEmails($data, $subscriberList, $message);
                        }
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
                }else{
                    if(empty($data['trainIdError'])){
                        $day=date('l', strtotime($data['cancelDate']));
                        $day=strtolower($day);
                        $availableDays=$this->alertModel->getDays($data['trainId']);
                        if($availableDays->$day=="No"){
                            $data['cancelDateError']='The assigned train is not run on '.$day.'s.';
                        }
                    }
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
                        $train=$this->alertModel->getTrainDetails($data['trainId']);
                        $subscriberList=$this->alertModel->getSubscriptionList($data['trainId']);
                        if(sizeof($subscriberList)>0){
                            $message=$this->generateCancellationEmail($data, $train);
                            $this->sendAlertEmails($data, $subscriberList, $message);
                        }
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
                }else{
                    if(empty($data['trainIdError'])){
                        $day=date('l', strtotime($data['delayDate']));
                        $day=strtolower($day);
                        $availableDays=$this->alertModel->getDays($data['trainId']);
                        if($availableDays->$day=="No"){
                            $data['delayDateError']='The assigned train is not run on '.$day.'s.';
                        }
                    }
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
                        $train=$this->alertModel->getTrainDetails($data['trainId']);
                        $subscriberList=$this->alertModel->getSubscriptionList($data['trainId']);
                        if (sizeof($subscriberList)>0){
                            $message=$this->generateDelayEmail($data, $train);
                            $this->sendAlertEmails($data, $subscriberList, $message);
                        }
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
                }else{
                    if(empty($data['trainIdError'])){
                        $day=date('l', strtotime($data['delayDate']));
                        $day=strtolower($day);
                        $availableDays=$this->alertModel->getDays($data['trainId']);
                        if($availableDays->$day=="No"){
                            $data['delayDateError']='The assigned train is not run on '.$day.'s.';
                        }
                    }
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
                        $train=$this->alertModel->getTrainDetails($data['trainId']);
                        $subscriberList=$this->alertModel->getSubscriptionList($data['trainId']);
                        if (sizeof($subscriberList)>0){
                            $message=$this->generateDelayEmail($data, $train);
                            $this->sendAlertEmails($data, $subscriberList, $message);
                        }
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
                }else{
                    if(empty($data['trainIdError'])){
                        $day=date('l', strtotime($data['oldDate']));
                        $day=strtolower($day);
                        $availableDays=$this->alertModel->getDays($data['trainId']);
                        if($availableDays->$day=="No"){
                            $data['oldDateError']='The assigned train is not run on '.$day.'s.';
                        }
                    }
                }

                if(empty($data['newDate'])){
                    $data['newDateError']='The new date should not be empty';    
                }else{
                    if(empty($data['trainIdError'])){
                        $day=date('l', strtotime($data['newDate']));
                        $day=strtolower($day);
                        $availableDays=$this->alertModel->getDays($data['trainId']);
                        if($availableDays->$day=="Yes"){
                            $data['newDateError']='The assigned train already runs on '.$day.'s.';
                        }
                    }
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
                        $train=$this->alertModel->getTrainDetails($data['trainId']);
                        $subscriberList=$this->alertModel->getSubscriptionList($data['trainId']);
                        if(sizeof($subscriberList)>0){
                            $message=$this->generateRescheduledEmail($data, $train);
                            $this->sendAlertEmails($data, $subscriberList, $message);
                        }
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
                }else{
                    if(empty($data['trainIdError'])){
                        $day=date('l', strtotime($data['oldDate']));
                        $day=strtolower($day);
                        $availableDays=$this->alertModel->getDays($data['trainId']);
                        if($availableDays->$day=="No"){
                            $data['oldDateError']='The assigned train is not run on '.$day.'s.';
                        }
                    }
                }


                if(empty($data['newDate'])){
                    $data['newDateError']='The new date should not be empty';    
                }else{
                    if(empty($data['trainIdError'])){
                        $day=date('l', strtotime($data['newDate']));
                        $day=strtolower($day);
                        $availableDays=$this->alertModel->getDays($data['trainId']);
                        if($availableDays->$day=="Yes"){
                            $data['newDateError']='The assigned train already runs on '.$day.'s.';
                        }
                    }
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
                     && $data['newTime']==$this->alertModel->findReschedulementById($id)->issuetype
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
                        $train=$this->alertModel->getTrainDetails($data['trainId']);
                        $subscriberList=$this->alertModel->getSubscriptionList($data['trainId']);
                        if(sizeof($subscriberList)>0){
                            $message=$this->generateRescheduledEmail($data, $train);
                            $this->sendAlertEmails($data, $subscriberList, $message);
                        }
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
        
        
        //emails

        private function generateCancellationEmail($data, $train){
            $subject='Cancellation alert for '.$train->name.'.';
            $message="<h1>Cancellation Alert for Train ".$train->name."</h1><p>Dear Passenger,</p></p> <p>Please be notified that the ".$train->name." with the id ".$train->trainId." has been cancelled on ".$data['cancelDate']."
            due to ".$data['issueType']." reasons. Please consider that tickets reserved for this particular train is eligible for refunding. And can be refunded at the reservation office in Colombo Fort.</p>
             <p>We apologise for any inconvenience caused due to the delay.</p>
             <p>Thank you,<br>Control Room<br>Sri Lanka Railway Department</p>";

            $messageDetails=[
                'subject'=>$subject,
                'message'=>$message
            ];

            return $messageDetails;

        }

        private function generateDelayEmail($data, $train){
            $subject='Delay alert for '.$train->name.'.';
            $message="<h1>Delay Alert for Train ".$train->name."</h1><p>Dear Passenger,</p></p> <p>Please be notified that the ".$train->name." with the id ".$train->trainId."
             will be running approximately ".$data['delayTime']." minutes late on ".$data['delayDate']." due to ".$data['issueType']." reasons.</p>
             <p>We apologise for any inconvenience caused due to the cancellation.</p>
             <p>Thank you,<br>Control Room<br>Sri Lanka Railway Department</p>";

            $messageDetails=[
              'subject'=>$subject,
              'message'=>$message
            ];

            return $messageDetails;

        }

        private function generateRescheduledEmail($data, $train){
            $subject='Reschedulement alert for '.$train->name.'.';
            $message="<h1>Reschedulement Alert for Train ".$train->name."</h1><p>Dear Passenger,</p></p> <p>Please be notified that the ".$train->name." with the id ".$train->trainid." 
            that was supposed to run on ".$data['oldDate']." at ".$train->starttime." from ".$train->src_name." to ".$train->dest_name." has been rescheduled on ".$data['newDate']." at ".$data['newTime']."  due to ".$data['issueType']." reasons. Stay tuned for further updates.</p>
             <p>We apologise for any inconvenience caused due to the reschedulement.  <br>
             Please consider that incase of a new reschedulement date the purchased tickets will be eligible for refunding or negotiation at the Colombo Fort Reservation Office. </p>
             <p>Thank you,<br>Control Room<br>Sri Lanka Railway Department</p>";

            $messageDetails=[
                'subject'=>$subject,
                'message'=>$message
            ];

            return $messageDetails;

        }

        private function sendAlertEmails($data, $emailList, $mailBody){
            require APPROOT . '/libraries/PHPMailer/src/Exception.php';
            require APPROOT . '/libraries/PHPMailer/src/PHPMailer.php';
            require APPROOT . '/libraries/PHPMailer/src/SMTP.php';

            $mail=new PHPMailer(true);

            try{
                $mail->isSMTP();                                            // Send using SMTP
                $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
                $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
                $mail->Username   = PROJECTEMAIL;                     // SMTP username
                $mail->Password   = PROJECTEMAILPASSWORD;                               // SMTP password
                $mail->SMTPSecure = 'ssl';         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
                $mail->Port       = 465;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
                //From mail
                $mail->setFrom(PROJECTEMAIL, 'RailLanka');

                //looping through mail list

                foreach ($emailList as $user){
                    if(empty($user->firstname)||empty($user->lastname)){
                        $name=$user->email;
                    }else{
                        $name=''.$user->firstname.' '.$user->lastname.'';
                    }
                    $mail->addBCC($user->email, $name);
                }


                $mail->addReplyTo('no-reply@example.com', 'Information', 'No reply');

                $mail->isHTML(true);
                $mail->Subject=$mailBody['subject'];
                $mail->Body=$mailBody['message'];

                $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

                $mail->send();
                // $msg = 'Reset password link has been sent to your email';


            }catch (Exception $e){
                echo "Alert couldn't be sent. Mailer Error: {$mail->ErrorInfo}";
            }

        }

    
    
    }


   
