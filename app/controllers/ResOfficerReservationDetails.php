<?php 
	
	class ResOfficerReservationDetails extends Controller {

		public function __construct() {
			$this->resofficerReservationModel = $this->model('ResOfficerReservationDetail');
			isResofficerLoggedIn();
		}

		public function index()
        {
            $stations=$this->resofficerReservationModel->getStations();
            $data=[
                'stations'=>$stations
            ];
            $this->view('resofficers/reservation_details/search_trains',$data);
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
                    $data['date']= date('l', strtotime($data['date']));////Parse about any English textual datetime description into a Unix timestamp

                }


                if(empty($data['srcError']) && empty($data['destError'])
                    && empty($data['dateError']) && empty($data['timeError'])){
                                            
                    $data['trains']=$this->resofficerReservationModel->searchSrcDestDate($data);
                         
                    $this->displayAllReservationDetails($data);
                    return;


                }else{
                    $this->view('resofficers/reservation_details/search_trains',$data);
                }
            }
            $this->view('resofficers/reservation_details/search_trains',$data);
		}

		public function displayAllReservationDetails($data) {

			$this->view('resofficers/reservation_details/display_all_reservation_details', $data);

		}

		public function displayTrainReservationDetails($trainId, $searchDate) {

        $trains=$this->resofficerReservationModel->getReservationDetails($trainId, $searchDate);


            $data = [
                'trains'=>$trains,
                'trainId'=>$trainId

            ];

			$this->view('resofficers/reservation_details/display_train_reservation_details', $data); 
		}

		public function viewReservationDetails($trainId, $ticketId, $journeyDate) {

          $compseats=$this->resofficerReservationModel->getCompSeatDetails($ticketId);
          $passenger=$this->resofficerReservationModel->checkUnregisteredPassenger($ticketId);
          $old=$this->resofficerReservationModel->getOldPassengerDetails($trainId, $ticketId);

            if($passenger->tid==$passenger->uid){
                $passengers=$this->resofficerReservationModel->getUnregisteredPassengerDetails($trainId, $ticketId);
            }else{
                $passengers=$this->resofficerReservationModel->getRegisteredPassengerDetails($trainId, $ticketId);
            }    

            $data = [

                'passengers'=>$passengers,
                'compseats'=>$compseats,
                'old'=>$old
            ];  

            if(strtotime($journeyDate)>=strtotime(date("Y-m-d"))){
                $this->view('resofficers/reservation_details/view_reservation_details', $data);
            }else{
                $this->view('resofficers/reservation_details/view_old_reservation_details', $data);
            }
			
			 
		}
		
	}