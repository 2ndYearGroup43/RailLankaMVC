<?php
    class ModeratorSchedules extends Controller{
        private $scheduleModel;
        public function __construct()
        {
            $this->scheduleModel=$this->model('ModeratorSchedule');
        }

        public function index()
        {
            $stations=$this->scheduleModel->getStations();
            $data=[
                'stations'=>$stations
            ];
            $this->view('moderators/schedule/searchTrains',$data);
        }

        public function searchTrains()
        {
            $stations=$this->scheduleModel->getStations();
            $data=[
                'stations'=>$stations,
                'trains'=>'',
                'srcStation'=>'',
                'destStation'=>'',
                'date'=>'',
                'time'=>'',
                'srcError'=>'',
                'destError'=>'',
                'dateError'=>'',
                'timeError'=>''
            ];

            if($_SERVER['REQUEST_METHOD']=='POST'){
                $_POST=filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
                $data=[
                    'stations'=>$stations,
                    'trains'=>'',
                    'srcStation'=>trim($_POST['src']),
                    'destStation'=>trim($_POST['dest']),
                    'date'=>trim($_POST['date']),
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
                    if(!$this->scheduleModel->checkStation($data['srcStation'])){
                        $data['srcError']='Entered source station doesnt exist';
                    }
                }
                if(!empty($data['destStation'])){
                    if(!$this->scheduleModel->checkStation($data['destStation'])){
                        $data['destError']='Entered destination station doesnt exist';
                    }
                }
                if(empty($data['time'])){
                    $data['time']=1;
                }
                if (!empty($data['date'])){
                    $data['date']= date('l', strtotime($data['date']));
                    echo $data['date'];
                }


                if(empty($data['srcError']) && empty($data['destError'])
                    && empty($data['dateError']) && empty($data['timeError'])){
                    if(empty($data['srcStation']) || empty($data['destStation'])){
                        if(empty($data['destStation'])){
                            if(empty($data['date'])){
                                $data['trains']=$this->scheduleModel->searchSrcOnly($data);
                            }else{
                                $data['trains']=$this->scheduleModel->searchSrcDate($data);
                            }
                        }
                        if(empty($data['srcStation'])){
                            echo 'methana';
                            if(empty($data['date'])){
                                echo 'methana';
                                $data['trains']=$this->scheduleModel->searchDestOnly($data);
                            }else{
                                echo "here";
                                $data['trains']=$this->scheduleModel->searchDestDate($data);
                            }
                        }
                    }else{
                        if(empty($data['date'])){
                            $data['trains']=$this->scheduleModel->searchSrcDestOnly($data);
                        }else{
                            $data['trains']=$this->scheduleModel->searchSrcDestDate($data);
                        }
                    }

                    $this->view('moderators/schedule/scheduleSearchResults', $data);
                    return;


                }else{
                    $this->view('moderators/schedule/searchTrains',$data);
                }
            }
            $this->view('moderators/schedule/searchTrains',$data);
        }

        public function displayScheduleList($data)
        {
            $this->view('moderators/schedule/scheduleSearchResults');
        }

        public function viewSchedule($trainId)
        {
            $train=$this->scheduleModel->getTrain($trainId);
            $routes=$this->scheduleModel->getSchedule($trainId);
            $days=$this->scheduleModel->getDays($trainId);
            $data=[
              'train'=>$train,
              'trainId'=>$trainId,
              'routes'=>$routes,
              'days'=>$days
            ];
            $this->view('moderators/schedule/viewScheduleDetails',$data);
        }


    }