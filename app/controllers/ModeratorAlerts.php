<?php
    class ModeratorAlerts extends Controller{
        public function __construct()
        {
            $this->alertModel=$this->model('ModeratorAlert');
        }

        public function index()
        {
            if (!isLoggedIn()) {
                header("Location: ".URLROOT."/users/login");
                exit;
            }

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
            if (!isLoggedIn()) {
                header("Location: ".URLROOT."/users/login");
                exit;
            }

            $data=[
                'trainId'=>'',
                'cancelCause'=>'',
                'insertedDate'=>'',
                'insertedTime'=>'',
                'moderatorId'=>'',
                'trainIdError'=>'',
                'cancelCauseError'=>''

            ];

            var_dump($_SERVER['REQUEST_METHOD']);

            if($_SERVER['REQUEST_METHOD']=='POST'){
                $_POST=filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);//filter harmful data
                $data=[
                    'trainId'=>trim($_POST['trainid']),
                    'cancelCause'=>trim($_POST['cancelcause']),
                    'insertedDate'=>date("Y-m-d"),
                    'insertedTime'=>date("H:i:sa"),
                    'moderatorId'=>$_SESSION['moderator_id'],
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

                if(empty($data['trainIdError'])&& empty($data['cancelCauseError'])){
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
            if (!isLoggedIn()) {
                header("Location: ".URLROOT."/users/login");
                exit;
            }

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
            if (!isLoggedIn()) {
                header("Location: ".URLROOT."/users/login");
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
            $this->view('moderators/alerts/managecancellations', $data);

        }

        public function updateCancellations($id)
        {

            if (!isLoggedIn()) {
                header("Location: ".URLROOT."/users/login");
                exit;
            }

            
            $alert=$this->alertModel->findCancellationById($id);
            
        
            $data=[
                'alert'=>$alert,
                'trainId'=>'',
                'cancelCause'=>'',
                'insertedDate'=>'',
                'insertedTime'=>'',
                'moderatorId'=>'',
                'trainIdError'=>'',
                'cancelCauseError'=>''
            ];

            if($_SERVER['REQUEST_METHOD']=='POST'){
                $_POST=filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);//filter harmful data
                $data=[
                    'alert'=>$alert,
                    'alertId'=>$id,
                    'trainId'=>trim($_POST['trainid']),
                    'cancelCause'=>trim($_POST['cancelcause']),
                    'insertedDate'=>date("Y-m-d"),
                    'insertedTime'=>date("H:i:sa"),
                    'moderatorId'=>$_SESSION['moderator_id'],
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
                if($data['trainId']==$this->alertModel->findCancellationById($id)->trainId
                     && $data['cancelCause']==$this->alertModel->findCancellationById($id)->cancellation_cause){
                    $data['trainIdError']='No change done to any field.';
                    $data['cancelCauseError']='No change done to any field.';    
                }

                if(empty($data['trainIdError'])&& empty($data['cancelCauseError'])){
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

        public function delete()
        {
            
        }


        
        public function createDelayAlerts()
        {
            if (!isLoggedIn()) {
                header("Location: ".URLROOT."/users/login");
                exit;
            }

            $data=[
                'trainId'=>'',
                'delayTime'=>'',
                'delayCause'=>'',
                'insertedDate'=>'',
                'insertedTime'=>'',
                'moderatorId'=>'',
                'trainIdError'=>'',
                'delayTimeError'=>'',
                'delayCauseError'=>''

            ];

            if($_SERVER['REQUEST_METHOD']=='POST'){
                $_POST=filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);//filter harmful data
                $data=[
                    'trainId'=>trim($_POST['trainid']),
                    'delayTime'=>trim($_POST['delaytime']),
                    'delayCause'=>trim($_POST['delaycause']),
                    'insertedDate'=>date("Y-m-d"),
                    'insertedTime'=>date("H:i:sa"),
                    'moderatorId'=>$_SESSION['moderator_id'],
                    'trainIdError'=>'',
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

                if(empty($data['trainIdError']) && empty($data['delayTimeError']) && empty($data['delayCauseError'])){
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

            if (!isLoggedIn()) {
                header("Location: ".URLROOT."/users/login");
                exit;
            }

            
            $alert=$this->alertModel->findDelayById($id);
            
        
            $data=[
                'alert'=>$alert,
                'trainId'=>'',
                'delayTime'=>'',
                'delayCause'=>'',
                'insertedDate'=>'',
                'insertedTime'=>'',
                'moderatorId'=>'',
                'trainIdError'=>'',
                'delayTimeError'=>'',
                'delayCauseError'=>''

            ];


            if($_SERVER['REQUEST_METHOD']=='POST'){
                $_POST=filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);//filter harmful data
                $data=[
                    'alert'=>$alert,
                    'alertId'=>$id,
                    'trainId'=>trim($_POST['trainid']),
                    'delayTime'=>trim($_POST['delaytime']),
                    'delayCause'=>trim($_POST['delaycause']),
                    'insertedDate'=>date("Y-m-d"),
                    'insertedTime'=>date("H:i:sa"),
                    'moderatorId'=>$_SESSION['moderator_id'],
                    'trainIdError'=>'',
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

                
                if($data['trainId']==$this->alertModel->findCancellationById($id)->trainId
                     && $data['delayCause']==$this->alertModel->findCancellationById($id)->delay_cause
                     && $data['delayTime']==$this->alertModel->findCancellationById($id)->delaytime){
                    $data['trainIdError']='No change done to any field.';
                    $data['delayTimeError']='No change done to any field.';
                    $data['delayCauseError']='No change done to any field.';    
                }

                if(empty($data['trainIdError']) && empty($data['delayTimeError']) && empty($data['delayCauseError'])){
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
            if (!isLoggedIn()) {
                header("Location: ".URLROOT."/users/login");
                exit;
            }

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
            if (!isLoggedIn()) {
                header("Location: ".URLROOT."/users/login");
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
            if (!isLoggedIn()) {
                header("Location: ".URLROOT."/users/login");
                exit;
            }
            
            $data=[
                'trainId'=>'',
                'newDate'=>'',
                'newTime'=>'',
                'rechduledCause'=>'',
                'insertedDate'=>'',
                'insertedTime'=>'',
                'moderatorId'=>'',
                'trainIdError'=>'',
                'newDateError'=>'',
                'newTimeError'=>'',
                'reschedulementCauseError'=>''
            ];

            if($_SERVER['REQUEST_METHOD']=='POST'){
                $_POST=filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);//filter harmful data
                $data=[
                    'trainId'=>trim($_POST['trainid']),
                    'newDate'=>trim($_POST['newdate']),
                    'newTime'=>trim($_POST['newtime']),
                    'reschedulementCause'=>trim($_POST['reschedulementcause']),
                    'insertedDate'=>date("Y-m-d"),
                    'insertedTime'=>date("H:i:sa"),
                    'moderatorId'=>$_SESSION['moderator_id'],
                    'trainIdError'=>'',
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

                if(empty($data['trainIdError']) && empty($data['newDateError']) && empty($data['newTimeError']) && empty($data['reschedulementCauseError'])){
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

            if (!isLoggedIn()) {
                header("Location: ".URLROOT."/users/login");
                exit;
            }

            
            $alert=$this->alertModel->findReschedulementById($id);
            
        
            $data=[
                'alert'=>$alert,
                'alertId'=>$id,
                'trainId'=>'',
                'newDate'=>'',
                'newTime'=>'',
                'rechduledCause'=>'',
                'insertedDate'=>'',
                'insertedTime'=>'',
                'moderatorId'=>'',
                'trainIdError'=>'',
                'newDateError'=>'',
                'newTimeError'=>'',
                'reschedulementCauseError'=>''
            ];


            if($_SERVER['REQUEST_METHOD']=='POST'){
                $_POST=filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);//filter harmful data
                $data=[
                    'alert'=>$alert,
                    'alertId'=>$id,
                    'trainId'=>trim($_POST['trainid']),
                    'newDate'=>trim($_POST['newdate']),
                    'newTime'=>trim($_POST['newtime']),
                    'reschedulementCause'=>trim($_POST['reschedulementcause']),
                    'insertedDate'=>date("Y-m-d"),
                    'insertedTime'=>date("H:i:sa"),
                    'moderatorId'=>$_SESSION['moderator_id'],
                    'trainIdError'=>'',
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

                if($data['trainId']==$this->alertModel->findReschedulementById($id)->trainId
                     && $data['reschedulementCause']==$this->alertModel->findReschedulementById($id)->reschedulement_cause
                     && $data['newDate']==$this->alertModel->findReschedulementById($id)->newdate
                     && $data['newTime']==$this->alertModel->findReschedulementById($id)->newtime){
                    $data['trainIdError']='No change done to any field.';
                    $data['newDateError']='No change done to any field.';
                    $data['newTimeError']='No change done to any field.';
                    $data['reschedulementCauseError']='No change done to any field.';    
                }


                if(empty($data['trainIdError']) && empty($data['newDateError']) && empty($data['newTimeError']) && empty($data['reschedulementCauseError'])){
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
            if (!isLoggedIn()) {
                header("Location: ".URLROOT."/users/login");
                exit;
            }

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
            if (!isLoggedIn()) {
                header("Location: ".URLROOT."/users/login");
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

                $alerts=$this->alertModel->searchReschedulements($data['searchBar'],$data['searchSelect']);
                $fields=$this->alertModel->getRescheduledFields();
                $data=[
                    'alerts'=>$alerts,
                    'fields'=>$fields
                ];
                
            }  
            $this->view('moderators/alerts/managereschedulements', $data);

        }

        public function deleteAlert($id,$type)
        {
            if (!isLoggedIn()) {
                header("Location: ".URLROOT."/users/login");
                exit;
            }

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






        //passengers Anuki's Alerts

        public function search() {
			
			$this->view('passengers/alerts/search_trains'); 
		}

		public function displayTrains() {

			$this->view('passengers/alerts/display_trains'); 
		}

		public function displayAlerts() {

			$this->view('passengers/alerts/display_alerts'); 
		}	

		public function displayCancelled() {

			$this->view('passengers/alerts/display_cancelled'); 
		}	

		public function displayDelayed() {

			$this->view('passengers/alerts/display_delayed'); 
		}	

		public function displayRescheduled() {

			$this->view('passengers/alerts/display_rescheduled'); 
		}	
    
    
    
    
    }


   
