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

		public function viewReservationDetails($trainId, $ticketId, $nic) {

        //$manage_train=$this->resofficerReservationModel->findTrain($trainId, $nic);
        //$names=$this->resofficerReservationModel->findTrainName($trainId);
        //$nics=$this->resofficerReservationModel->findPassengerDetails($nic);
        //$seats=$this->resofficerReservationModel->findSeatDetails($nic);
          $passengers=$this->resofficerReservationModel->getPassengerDetails($trainId, $ticketId, $nic);  

        $data = [
            //'manage_train'=>$manage_train,
            //'trainId'=>$trainId,
            //'names'=>$names,
            //'nics'=>$nics,
            //'seats'=>$seats
            'passengers'=>$passengers
        ];    

			
			$this->view('resofficers/reservation_details/view_reservation_details', $data); 
		}
		
	}