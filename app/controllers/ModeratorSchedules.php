<?php
    class ModeratorSchedules extends Controller{
        private $scheduleModel;
        public function __construct()
        {
            $this->scheduleModel=$this->model('ModeratorSchedule');
        }

        public function index()
        {
           $this->searchTrains('search');
        }

        public function searchTrains($flag)
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
                if($flag=='results'){
                    $trains=json_decode($_POST['searchResults']);
                }
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
                    $data['date']= date('l', strtotime($data['date']));//monday
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

                    //$this->view('moderators/schedule/scheduleSearchResults', $data);
                    $this->displayScheduleList($data);
                    return;


                }else{
                    switch ($flag){
                        case 'search':
                            $this->view('moderators/schedule/searchTrains',$data);
                            break;
                        case 'results':
                            $data['trains']=$trains;
                            $this->displayScheduleList($data);
                            break;
                    }
                    return;
                }
            }
            $this->view('moderators/schedule/searchTrains',$data);
        }

        public function displayScheduleList($data)
        {
            $this->view('moderators/schedule/scheduleSearchResults', $data);
        }

        public function viewSchedule($trainId)
        {
            $train=$this->scheduleModel->getTrain($trainId);
            $days=$this->scheduleModel->getDays($trainId);
            $rate=$this->scheduleModel->getRate($trainId);
            $routes=$this->scheduleModel->getSchedule($trainId);
            $prices=$this->calPrices($routes, $rate);
            $data=[
              'train'=>$train,
              'trainId'=>$trainId,
              'routes'=>$routes,
              'prices'=>$prices,
              'days'=>$days
            ];
            $this->view('moderators/schedule/viewScheduleDetails',$data);
        }

        public function calPrices($routes, $rate){
            //var_dump($routes);
            $data= array();
            foreach ($routes as $route){
                $prices=[
                    "fclass"=>'',
                    "sclass"=>'',
                    "tclass"=>''
                ];
                $fb=$rate->fclassnormalbase;
                $sb=$rate->sclassnormalbase;
                $tb=$rate->tclassnormalbase;
                $dis=$rate->distance;
                $rdis=$route->distance;
                $r=$rate->rate;
                if($rdis==0){
                    $prices['fclass']=0;
                    $prices['sclass']=0;
                    $prices['tclass']=0;

                }else{
                    $prices['fclass']=$fb+(floor($rdis/$dis))*($fb/$r);
                    $prices['sclass']=$sb+(floor($rdis/$dis))*($sb/$r);
                    $prices['tclass']=$tb+(floor($rdis/$dis))*($tb/$r);

                }
                array_push($data, $prices);
            }
            //var_dump($data);
            //echo sizeof($data);



            return $data;
        }


    }