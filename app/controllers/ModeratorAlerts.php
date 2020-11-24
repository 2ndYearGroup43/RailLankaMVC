<?php
    class ModeratorAlerts extends Controller{
        public function __construct()
        {
            isModeratorLoggedIn();
            $this->alertModel=$this->model('ModeratorAlert');
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
                'issueType'=>'',
                'insertedDate'=>'',
                'insertedTime'=>'',
                'moderatorId'=>'',
                'trainIdError'=>'',
                'issueTypeError'=>'',
                'cancelCauseError'=>''

            ];


            if($_SERVER['REQUEST_METHOD']=='POST'){
                $_POST=filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);//filter harmful data
                $data=[
                    'trains'=>$trains,
                    'trainId'=>trim($_POST['trainid']),
                    'cancelCause'=>trim($_POST['cancelcause']),
                    'issueType'=>trim($_POST['issueType']),
                    'insertedDate'=>date("Y-m-d"),
                    'insertedTime'=>date("H:i:sa"),
                    'moderatorId'=>$_SESSION['moderator_id'],
                    'trainIdError'=>'',
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

                
                if(empty($data['issueType'])){
                    $data['issueTypeError']='The Issue Type should not be empty';    
                }

                if(empty($data['trainIdError'])&& empty($data['cancelCauseError']) && empty($data['issueTypeError'])){
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
           
            $alerts=$this->alertModel->displayCancellations();
            $fields=$this->alertModel->getCancellationFields();
            $data=[
                'alerts'=>$alerts,
                'fields'=>$fields
            ];
            
            $this->view('moderators/alerts/managecancellations', $data);
        }

        public function cancellationsSearchBy()
        {
           
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
                'issueType'=>'',
                'cancelCause'=>'',
                'insertedDate'=>'',
                'insertedTime'=>'',
                'moderatorId'=>'',
                'trainIdError'=>'',
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
                    'cancelCause'=>trim($_POST['cancelcause']),
                    'insertedDate'=>date("Y-m-d"),
                    'insertedTime'=>date("H:i:sa"),
                    'moderatorId'=>$_SESSION['moderator_id'],
                    'issueTypeError'=>'',
                    'trainIdError'=>'',
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

                
                if(empty($data['issueType'])){
                    $data['issueTypeError']='The Issue type should not be empty';    
                }

                if($data['trainId']==$this->alertModel->findCancellationById($id)->trainId
                     && $data['cancelCause']==$this->alertModel->findCancellationById($id)->cancellation_cause
                     && $data['issueType']==$this->alertModel->findCancellationById($id)->issueType){
                    $data['trainIdError']='No change done to any field.';
                    $data['cancelCauseError']='No change done to any field.'; 
                    $data['issueTypeError']='No change done to any field.';    
                }

                if(empty($data['trainIdError'])&& empty($data['cancelCauseError']) && empty($data['issueTypeError'])){
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
                'delayCause'=>'',
                'issueType'=>'',
                'insertedDate'=>'',
                'insertedTime'=>'',
                'moderatorId'=>'',
                'trainIdError'=>'',
                'issueTypeError'=>'',
                'delayTimeError'=>'',
                'delayCauseError'=>''

            ];

            if($_SERVER['REQUEST_METHOD']=='POST'){
                $_POST=filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);//filter harmful data
                $data=[
                    'trains'=>$trains,
                    'trainId'=>trim($_POST['trainid']),
                    'delayTime'=>trim($_POST['delaytime']),
                    'issueType'=>trim($_POST['issueType']),
                    'delayCause'=>trim($_POST['delaycause']),
                    'insertedDate'=>date("Y-m-d"),
                    'insertedTime'=>date("H:i:sa"),
                    'moderatorId'=>$_SESSION['moderator_id'],
                    'trainIdError'=>'',
                    'issueTypeError'=>'',
                    'delayTimeError'=>'',
                    'delayCauseError'=>''
                ];

                

                if(empty($data['trainId'])){
                    $data['trainIdError']='The trainId should not be empty';   
                }elseif (!$this->alertModel->findTrainById($data['trainId'])) {
                    $data['trainIdError']="The train Id entered doesnt exist in the system.";
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
                &&  empty($data['issueTypeError'])){
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
                'delayTime'=>'',
                'delayCause'=>'',
                'insertedDate'=>'',
                'insertedTime'=>'',
                'moderatorId'=>'',
                'trainIdError'=>'',
                'issueTypeError'=>'',
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
                    'delayTime'=>trim($_POST['delaytime']),
                    'delayCause'=>trim($_POST['delaycause']),
                    'insertedDate'=>date("Y-m-d"),
                    'insertedTime'=>date("H:i:sa"),
                    'moderatorId'=>$_SESSION['moderator_id'],
                    'trainIdError'=>'',
                    'issueTypeError'=>'',
                    'delayTimeError'=>'',
                    'delayCauseError'=>''
                ];

                


                if(empty($data['trainId'])){
                    $data['trainIdError']='The trainId should not be empty';   
                }elseif (!$this->alertModel->findTrainById($data['trainId'])) {
                    $data['trainIdError']="The train Id entered doesnt exist in the system.";
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
                     && $data['issueType']==$this->alertModel->findDelayById($id)->issueType){
                    $data['trainIdError']='No change done to any field.';
                    $data['delayTimeError']='No change done to any field.';
                    $data['delayCauseError']='No change done to any field.'; 
                    $data['issueTypeError']='The Issue type should not be empty';    
                }

                if(empty($data['trainIdError']) && empty($data['delayTimeError']) && empty($data['delayCauseError'])
                && empty($data['issueTypeError'])){
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

            $alerts=$this->alertModel->displayDelays();
            $fields=$this->alertModel->getDelayFields();
            $data=[
                'alerts'=>$alerts,
                'fields'=>$fields
            ];
            
            $this->view('moderators/alerts/managedelays', $data);
        }

        public function delaysSearchBy()
        {
           
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

                $alerts=$this->alertModel->searchDelays($data['searchBar'],$data['searchSelect']);
                $fields=$this->alertModel->getDelayFields();
                $data=[
                    'alerts'=>$alerts,
                    'fields'=>$fields
                ];
                
            }  
            $this->view('moderators/alerts/managedelays', $data);

        }



        public function createRescheduledAlerts()
        {
            $trains=$this->alertModel->getTrains();
            
            $data=[
                'trainId'=>'',
                'trains'=>$trains,
                'issueType'=>'',
                'newDate'=>'',
                'newTime'=>'',
                'rechduledCause'=>'',
                'insertedDate'=>'',
                'insertedTime'=>'',
                'moderatorId'=>'',
                'trainIdError'=>'',
                'issueTypeError'=>'',
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
                    'newDate'=>trim($_POST['newdate']),
                    'newTime'=>trim($_POST['newtime']),
                    'reschedulementCause'=>trim($_POST['reschedulementcause']),
                    'insertedDate'=>date("Y-m-d"),
                    'insertedTime'=>date("H:i:sa"),
                    'moderatorId'=>$_SESSION['moderator_id'],
                    'trainIdError'=>'',
                    'issueTypeError'=>'',
                    'newDateError'=>'',
                    'newTimeError'=>'',
                    'reschedulementCauseError'=>''
                ];

                

                if(empty($data['trainId'])){
                    $data['trainIdError']='The trainId should not be empty';   
                }elseif (!$this->alertModel->findTrainById($data['trainId'])) {
                    $data['trainIdError']="The train Id entered doesnt exist in the system.";
                }

                if(empty($data['newDate'])){
                    $data['newDateError']='The new date should not be empty';    
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
                && empty($data['issueTypeError'])){
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
                'newDate'=>'',
                'newTime'=>'',
                'rechduledCause'=>'',
                'insertedDate'=>'',
                'insertedTime'=>'',
                'moderatorId'=>'',
                'trainIdError'=>'',
                'issueTypeError'=>'',
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
                    'newDate'=>trim($_POST['newdate']),
                    'newTime'=>trim($_POST['newtime']),
                    'reschedulementCause'=>trim($_POST['reschedulementcause']),
                    'insertedDate'=>date("Y-m-d"),
                    'insertedTime'=>date("H:i:sa"),
                    'moderatorId'=>$_SESSION['moderator_id'],
                    'trainIdError'=>'',
                    'issueTypeError'=>'',
                    'newDateError'=>'',
                    'newTimeError'=>'',
                    'reschedulementCauseError'=>''
                ];

                

                if(empty($data['trainId'])){
                    $data['trainIdError']='The trainId should not be empty';   
                }elseif (!$this->alertModel->findTrainById($data['trainId'])) {
                    $data['trainIdError']="The train Id entered doesnt exist in the system.";
                }

                if(empty($data['newDate'])){
                    $data['newDateError']='The new date should not be empty';    
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
                     && $data['newTime']==$this->alertModel->findReschedulementById($id)->issueType){
                    $data['trainIdError']='No change done to any field.';
                    $data['newDateError']='No change done to any field.';
                    $data['newTimeError']='No change done to any field.';
                    $data['reschedulementCauseError']='No change done to any field.';  
                    $data['issueTypeError']='No change done to any field.';  
                }


                if(empty($data['trainIdError']) && empty($data['newDateError']) && empty($data['newTimeError']) && empty($data['reschedulementCauseError'])
                && empty($data['issueTypeError'])){
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
           

            $alerts=$this->alertModel->displayReschedulements();
            $fields=$this->alertModel->getReschedulementFields();
            $data=[
                'alerts'=>$alerts,
                'fields'=>$fields
            ];
            
            $this->view('moderators/alerts/managereschedulements', $data);
        }

        public function reschedulementsSearchBy()
        {
           
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

                $alerts=$this->alertModel->searchReschedulements($data['searchBar'],$data['searchSelect']);
                $fields=$this->alertModel->getReschedulementFields();
                $data=[
                    'alerts'=>$alerts,
                    'fields'=>$fields
                ];
                
            }  
            $this->view('moderators/alerts/managereschedulements', $data);

        }

        public function alertsDash()
        {
            $data=[
                'cancelledCount'=>15,
                'delayedCount'=>10,
                'rescheduledCount'=>7
            ];
            $this->view('moderators/alerts/alertsdash', $data);
        }

        
        public function alertsRandomDash()
        {
            $cancelledCount=random_int(2, 20);
            $delayedCount=random_int(2, 20);
            $rescheduledCount=random_int(2, 20);
            
            $data=[
                'cancelledCount'=>$cancelledCount,
                'delayedCount'=>$delayedCount,
                'rescheduledCount'=>$rescheduledCount
            ];
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


   
