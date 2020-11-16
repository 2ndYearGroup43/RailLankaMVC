<?php
    class ModeratorSchedules extends Controller{
        public function __construct()
        {
            $this->scheduleModel=$this->model('ModeratorSchedule');
        }

        public function index()
        {
            $this->view('moderators/schedule/searchTrains');
        }

        public function searchTrains()
        {
            $this->view('moderators/schedule/searchTrains');
        }

        public function displayScheduleList()
        {
            $this->view('moderators/schedule/scheduleSearchResults');
        }

        public function viewSchedule()
        {
            $this->view('moderators/schedule/viewScheduleDetails');
        }


    }