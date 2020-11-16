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
            $this->view('moderators/tracking/viewLiveTrainsMap');
        }

    }