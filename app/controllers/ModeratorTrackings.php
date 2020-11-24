<?php
    class ModeratorTrackings extends Controller{

        public function __construct()
        {
            $this->trackModel=$this->model('ModeratorTrack');
        }

        public function index()
        {
            $this->view('moderators/tracking/searchTrackTrains');
        }

        public function searchTrackTrains()
        {
            $this->view('moderators/tracking/searchTrackTrains');
        }

        public function displayTrackList()
        {
            $this->view('moderators/tracking/trackSearchResults');
        }

        public function trackTrainMap()
        {
            $this->view('moderators/tracking/trackTrainMap');
        }


        public function viewLiveTrains()
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

    }