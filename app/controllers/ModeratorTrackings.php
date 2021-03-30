<?php
    class ModeratorTrackings extends Controller{
        private $threshHoldTime=2;//threshhold for false live trains
        public function __construct()
        {
            $this->trackModel=$this->model('ModeratorTrack');
            isModeratorLoggedIn();
        }

        public function index()
        {
            $this->searchTrains('search');
        }

        public function searchTrackTrains()
        {
            $this->view('moderators/tracking/searchTrackTrains');
        }

        public function trackTrainMap($trainId,$journeyId)
        {
            $train=$this->trackModel->getTrain($trainId);
            $journey=$this->trackModel->getJourney($journeyId);

            $data=[
                'journey'=>$journey,
                'train'=>$train
            ];

            $this->view('moderators/tracking/trackTrainMap', $data);
        }



        public function searchTrains($flag)
        {
            $stations=$this->trackModel->getStations();
            $data=[
                'stations'=>$stations,
                'trains'=>'',
                'srcStation'=>'',
                'destStation'=>'',
                'date'=>'',
                'journeyDate'=>'',
                'time'=>'',
                'srcError'=>'',
                'destError'=>'',
                'dateError'=>'',
                'timeError'=>''
            ];

            if($_SERVER['REQUEST_METHOD']=='POST'){
                if($flag=='results'){
//                        echo json_decode($_POST['searchResults']);
                        $trains=json_decode($_POST['searchResults']);
//                        echo $trains;
                }
               $_POST=filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
                $today=new DateTime();
                $today=$today->format("Y-m-d");
//                echo $_POST['searchResults'];
                $data=[
                    'stations'=>$stations,
                    'trains'=>'',
                    'srcStation'=>trim($_POST['src']),
                    'destStation'=>trim($_POST['dest']),
                    'date'=>$today,
                    'journeyDate'=>$today,
                    'time'=>trim($_POST['time']),
                    'srcError'=>'',
                    'destError'=>'',
                    'dateError'=>'',
                    'timeError'=>''
                ];

                if(empty($data['srcStation']) && empty($data['destStation'])){
                    $data['srcError']='Please enter Atleast one station to proceed';
                    $data['destError']='Please enter Atleast one station to proceed';
                }
                if(!empty($data['srcStation'])){
                    if(!$this->trackModel->checkStation($data['srcStation'])){
                        $data['srcError']='Entered source station doesnt exist';
                    }
                }
                if(!empty($data['destStation'])){
                    if(!$this->trackModel->checkStation($data['destStation'])){
                        $data['destError']='Entered destination station doesnt exist';
                    }
                }
                if(empty($data['time'])){
                    $data['time']=1;
                }
                if (!empty($data['date'])){
                    $data['date']= date('l', strtotime($data['date']));//monday
                }


                if(empty($data['srcError']) && empty($data['destError'])
                    && empty($data['dateError']) && empty($data['timeError'])){
                    if(empty($data['srcStation']) || empty($data['destStation'])){
                        if(empty($data['destStation'])){
                            if(empty($data['date'])){
                                $data['trains']=$this->trackModel->searchSrcOnly($data);
                            }else{
                                $data['trains']=$this->trackModel->searchSrcDate($data);
                            }
                        }
                        if(empty($data['srcStation'])){
                           // echo 'methana';
                            if(empty($data['date'])){
                           //     echo 'methana';
                                $data['trains']=$this->trackModel->searchDestOnly($data);
                            }else{
                                echo "here";
                                $data['trains']=$this->trackModel->searchDestDate($data);
                            }
                        }
                    }else{
                        if(empty($data['date'])){
                            $data['trains']=$this->trackModel->searchSrcDestOnly($data);
                        }else{
                            $data['trains']=$this->trackModel->searchSrcDestDate($data);
                        }
                    }

                    //$this->view('moderators/schedule/scheduleSearchResults', $data);
                    $this->displayTrackList($data);
                    return;


                }else{
                    switch ($flag){
                        case 'search':
                            $this->view('moderators/tracking/searchTrackTrains',$data);
                            break;
                        case 'results':
                            $data['trains']=$trains;
                            $this->displayTrackList($data);
                            break;
                    }
                    return;

                }
            }
            $this->view('moderators/tracking/searchTrackTrains',$data);
        }

        public function displayTrackList($data)
        {
            $this->view('moderators/tracking/trackSearchResults', $data);

        }









        public function getTrainLocation($journeyId){
            $response=array();
            $response=$this->trackModel->getJourneyLocation($journeyId);
            if(sizeof($response)>0){
                $now=time();
                $time=$response[0]->time;
                if($response[0]->journey_status=='Live'){
                    $x=$now-strtotime($time);
                    if($x>60*$this->threshHoldTime){
                        $this->trackModel->stopJourney($response[0]->journeyId);
                    }
                }
            }

            echo json_encode($response);
        }

        public function getLiveLocations(){
            $response=array();
            $response=$this->trackModel->getLiveTrains(); //<>ended
            $now=time();
            for($i=0;$i<sizeof($response);$i++){
                if($response[$i]->journey_status=='Live'){
                    $time=$response[$i]->time;
                    $x=$now-strtotime($time);
                    if($x>60*$this->threshHoldTime){
                        $this->trackModel->stopJourney($response[$i]->journeyId);
                    }
                }
            }
            echo json_encode($response);
        }


        public function viewLiveTtrains()
        {
            $data=[
                'centerAround'=>'',
                'pos'=>'{lat: 6.933924,lng: 79.850026}'
            ];

            if($_SERVER['REQUEST_METHOD']=='POST'){
                $_POST=filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);//filter harmful data
                $data=[
                    'centerAround'=>trim($_POST['centerAround']),
                    'pos'=>''
                ];

                if($data['centerAround']=='western'){
                    $data['pos']="{lat: 6.933924,lng: 79.850026}";
                }elseif ($data['centerAround']=='southern') {
                    $data['pos']="{lat: 6.034246461056236,lng: 80.214295039247}";  
                }elseif ($data['centerAround']=='northern') {
                    $data['pos']="{lat: 9.667037622579672,lng: 80.0209296861432}";
                }elseif ($data['centerAround']=='central') {     
                    $data['pos']="{lat: 7.289776,lng: 80.632347}";
                }elseif ($data['centerAround']=='eastern') {
                    $data['pos']="{lat: 8.593162518186563,lng: 81.22041713456699}";
                }
                
                $this->view('moderators/tracking/viewLiveTrainsMap', $data);
                return;
            }
            $this->view('moderators/tracking/viewLiveTrainsMap', $data);
        }


        public function viewLiveTrains()
        {
            $data = [
                'liveTrains' => ''
            ];

            $data['liveTrains'] = $this->trackModel->getLiveTrains();


            $this->view('moderators/tracking/viewLiveTrainsMap', $data);
        }


        public function getEndedJourneys(){
            $response=array();
            $date=$_GET['loadedDate'];
            $time=$_GET['loadedTime'];

            $response=$this->trackModel->getEndedJourneys($date, $time);

            echo json_encode($response);
        }

    }