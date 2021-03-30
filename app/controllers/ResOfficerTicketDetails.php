<?php 

	class ResOfficerTicketDetails extends Controller {

		public function __construct() {
			$this->resofficerReservationModel = $this->model('ResOfficerTicketDetail');
			isResofficerLoggedIn();
		}

		public function index() // index function
        {
            $stations=$this->resofficerReservationModel->getStations();
            $data=[
                'stations'=>$stations
            ];
            $this->view('resofficers/ticket_details/search_ticket_details',$data);
        }
        
		public function search() { // search train function
			
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

                if(empty($data['srcStation'])){
                    $data['srcError']='Please enter source station to proceed';
                }
                if(empty($data['destStation'])){
                    $data['destError']='Please enter destination station to proceed';
                }
                if(empty($data['date'])){
                    $data['dateError']='Please enter the date to proceed';
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
                    $data['date']= date('l', strtotime($data['date'])); //Parse about any English textual datetime description into a Unix timestamp
                }

                if(empty($data['srcError']) && empty($data['destError']) && empty($data['dateError']) && empty($data['timeError'])){
                                                                    
                        $data['trains']=$this->resofficerReservationModel->searchSrcDestDate($data);
                        
                    $this->displayTicketTrains($data);
                    return;

                }else{
                    $this->view('resofficers/ticket_details/search_ticket_details',$data);
                }
            }
            $this->view('resofficers/ticket_details/search_ticket_details',$data);
		}

		public function displayTicketTrains($data) { // display ticket details

			$this->view('resofficers/ticket_details/display_ticket_trains', $data);

		}

		public function displayTicketDetails($trainId, $searchDate) { // display ticket details

        $trains=$this->resofficerReservationModel->getTicketDetails($trainId, $searchDate);

        $data = [
            'trains'=>$trains,
            'trainId'=>$trainId
        ];
            
			$this->view('resofficers/ticket_details/display_ticket_details', $data); 
		}
		
	}