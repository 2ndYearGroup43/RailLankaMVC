<?php 

	class ResOfficerTicketDetails extends Controller {

		public function __construct() {
			$this->resofficerReservationModel = $this->model('ResOfficerTicketDetail');
			isResofficerLoggedIn();
		}

		public function index()
        {
            $stations=$this->resofficerReservationModel->getStations();
            $data=[
                'stations'=>$stations
            ];
            $this->view('resofficers/ticket_details/search_ticket_details',$data);
        }
        
		public function search() {
			
	        $stations=$this->resofficerReservationModel->getStations();
            $data=[
                'stations'=>$stations,
                'search_date'=>'',
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
                    'search_date'=>trim($_POST['date']),
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
                    if(!$this->resofficerReservationModel->checkStation($data['srcStation'])){
                        $data['srcError']='Entered source station doesnt exist';
                    }
                }
                if(!empty($data['destStation'])){
                    if(!$this->resofficerReservationModel->checkStation($data['destStation'])){
                        $data['destError']='Entered destination station doesnt exist';
                    }
                }
                if(empty($data['time'])){
                    $data['time']=1;
                }
                if (!empty($data['date'])){
                    //$search_date=$data['date'];
                    //echo $data['search_date'];
                    $data['date']= date('l', strtotime($data['date']));

                }


                if(empty($data['srcError']) && empty($data['destError'])
                    && empty($data['dateError']) && empty($data['timeError'])){
                    if(empty($data['srcStation']) || empty($data['destStation'])){
                        if(empty($data['destStation'])){
                            if(empty($data['date'])){
                                $data['trains']=$this->resofficerReservationModel->searchSrcOnly($data);
                            }else{
                                $data['trains']=$this->resofficerReservationModel->searchSrcDate($data);
                            }
                        }
                        if(empty($data['srcStation'])){

                            if(empty($data['date'])){

                                $data['trains']=$this->resofficerReservationModel->searchDestOnly($data);
                            }else{

                                $data['trains']=$this->resofficerReservationModel->searchDestDate($data);
                            }
                        }
                    }else{
                        if(empty($data['date'])){
                            $data['trains']=$this->resofficerReservationModel->searchSrcDestOnly($data);
                        }else{
                            $data['trains']=$this->resofficerReservationModel->searchSrcDestDate($data);
                        }
                    }

                    //$this->view('moderators/schedule/scheduleSearchResults', $data);
                    $this->displayTicketTrains($data);
                    return;


                }else{
                    $this->view('resofficers/ticket_details/search_ticket_details',$data);
                }
            }
            $this->view('resofficers/ticket_details/search_ticket_details',$data);
		}

		public function displayTicketTrains($data) {

			$this->view('resofficers/ticket_details/display_ticket_trains', $data);

		}

		public function displayTicketDetails($trainId, $searchDate) {

        $trains=$this->resofficerReservationModel->getTicketDetails($trainId, $searchDate);
        $names=$this->resofficerReservationModel->findTrainName($trainId);

        $data = [
            'trains'=>$trains,
            'trainId'=>$trainId,
            'names'=>$names
        ];
            
			$this->view('resofficers/ticket_details/display_ticket_details', $data); 
		}
		
	}