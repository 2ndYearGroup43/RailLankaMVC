<?php
    class Pages extends Controller{
        public function __construct()
        {
            $this->userModel=$this->model('resofficer');
        }

        public function index()
        {   
            $this->view('pages/index');
        }
        public function about()
        {
            $this->view('pages/about');
        }
    }