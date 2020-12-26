<?php 
	
	class ResOfficerManageSeats extends Controller {

		public function __construct() {
			$this->resofficerReservationModel = $this->model('ResOfficerManageSeat');
                        isResofficerLoggedIn();
		}

		public function index()
        {
            $stations=$this->resofficerReservationModel->getStations();
            $data=[
                'stations'=>$stations
            ];
            $this->view('resofficers/manage_seats/search_trains',$data);
        }

		public function search() {
			
	        $stations=$this->resofficerReservationModel->getStations();
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
                    $this->displayTrains($data);
                    return;


                }else{
                    $this->view('resofficers/manage_seats/search_trains',$data);
                }
            }
            $this->view('resofficers/manage_seats/search_trains',$data);
		}

		public function displayTrains($data) {

			$this->view('resofficers/manage_seats/display_trains', $data);
		}

		public function displaySeatMapsnn() {

			
			$this->view('resofficers/manage_seats/display_seatmapsnn'); 
		}

		public function displaySeatMaps() {

			
			$this->view('resofficers/manage_seats/display_seatmaps1'); 
		}

		public function displaySeatMaps2() {

	
			$this->view('resofficers/manage_seats/display_seatmaps2'); 
		}

		public function displaySeatMaps3() {

			$this->view('resofficers/manage_seats/display_seatmaps3'); 
		}

		public function displaySeatMaps4() {

		
			$this->view('resofficers/manage_seats/display_seatmaps4'); 
		}

		public function displaySeatMaps5() {

	
			$this->view('resofficers/manage_seats/display_seatmaps5'); 
		}

		public function displaySeatMaps6() {

		
			$this->view('resofficers/manage_seats/display_seatmaps6'); 
		}
		
	}