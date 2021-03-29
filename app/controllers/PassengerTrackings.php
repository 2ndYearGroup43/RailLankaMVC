<?php 
	
	class PassengerTrackings extends Controller {
		private $threshHoldTime=2;//threshhold for false live trains
		public function __construct() {
			isPassengerLoggedIn();
			$this->passengerTrackingModel = $this->model('PassengerTracking');
		}

		public function search() {
			
			$stations=$this->passengerTrackingModel->getStations();
			
	        $data = [
	        	'src'=>'',
	        	'dest'=>'',
	        	'date'=>'',
	        	'deptTime'=>'',
	        	'trains'=> '',
	        	'stations'=>$stations,
	        	'srcError'=>'',
	        	'destError'=>'',
	        	'dateError'=>'',
	        	'timeError'=>''
	        ];


	        if($_SERVER['REQUEST_METHOD']=='POST'){

	        	//sanitise post data
	        	$_POST=filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
	      		
	        	$data = [
		        	'src'=>trim($_POST['source']),
		        	'dest'=>trim($_POST['destination']),
		        	'date'=>trim($_POST['date']),
		        	'deptTime'=>trim($_POST['time']),
					'trains'=>'',
					'stations'=>$stations,
		        	'srcError'=>'',
		        	'destError'=>'',
		        	'dateError'=>'',
		        	'timeError'=>''
		        ];   

		        if(empty($data['src'])){
		        	$data['srcError']="Please enter the source station to proceed."; //Passenger hasnt enetered source station
		        }else{
		        	if(!$this->passengerTrackingModel->checkStation($data['src'])){
		        		$data['srcError']='Source station does not exist'; //Passenger enters non existing source station
		        	} else{
		        		$result=$this->passengerTrackingModel->getStationId($data['src']);
		        		$data['src']=$result->stationId;
		        		//var_dump($data['src']);
		        	} 
		        	
		        }

		        if(!empty($data['dest'])){
		        	if(!$this->passengerTrackingModel->checkStation($data['dest'])){
		        		$data['destError']='Destination station does not exist';
		        	} else{
		        		$result=$this->passengerTrackingModel->getStationId($data['dest']);
		        		$data['dest']=$result->stationId;

		        		if($data['src']==$data['dest']){
		        			$data['destError']='Destination and source station cannot be the same';
		        		}
		        		//var_dump($data['dest']);
		        	}
		        }

		        if(!empty($data['date'])){
		        	if(($data['date']<date("Y-m-d")) || ($data['date']>date("Y-m-d", strtotime("+2 months")))) {
		        		$data['dateError']='Bookings can be done only upto 2 months in advance';
		        	}else{
			        	$data['date']= date('l', strtotime($data['date']));
			        	//var_dump($data['date']);
		        	}
		        }

		        if(!empty($data['deptTime'])){
		        	//var_dump($data['deptTime']);
		        }

		        if(empty($data['srcError']) && empty($data['destError']) && empty($data['dateError']) && empty($data['timeError'])){

		        	#src-date-time/src-date/src-time/src
		        	if(empty($data['dest'])){

		        		#src
		        		if(empty($data['date']) && empty($data['deptTime'])){
		        			//echo "#src";
		        			$data['trains']=$this->passengerTrackingModel->searchSrc($data);

		        		#src-time
		        		}elseif(empty($data['date'])){
		        			//echo "#src-time";
		        			$data['trains']=$this->passengerTrackingModel->searchSrcTime($data);
		        		#src-date
		        		}elseif(empty($data['deptTime'])){
		        			//echo "#src-date";
		        			$data['trains']=$this->passengerTrackingModel->searchSrcDate($data);
		        		#src-date-time
		        		}else {
		        			//echo "#src-date-time";
		        			$data['trains']=$this->passengerTrackingModel->searchSrcDateTime($data);
		        		}

		        	#src-dest-date-time/src-dest-date/src-dest-time/src-dest
		        	}else {

		        		#src-dest
		        		if(empty($data['date']) && empty($data['deptTime'])){
		        			//echo "#src-dest";
		        			$data['trains']=$this->passengerTrackingModel->searchSrcDest($data);
		        		#src-dest-time
		        		}elseif(empty($data['date'])){
		        			//echo "#src-dest-time";
		        			$data['trains']=$this->passengerTrackingModel->searchSrcDestTime($data);
		        		#src-dest-date
		        		}elseif(empty($data['deptTime'])){
		        			//echo "#src-dest-date";
		        			$data['trains']=$this->passengerTrackingModel->searchSrcDestDate($data);
		        		#src-dest-date-time
		        		}else {
		        			//echo "#src-dest-date-time";
		        			$data['trains']=$this->passengerTrackingModel->searchAll($data);
		        		}

		        	}

		        	$this->displayTrains($data); 
		        	return;

		        }else {

		        	$this->view('passengers/trackings/search_trains',$data);
		        }
	        }

			$this->view('passengers/trackings/search_trains',$data); 
			
		}

		public function displayTrains($data) {

			
			$this->view('passengers/trackings/display_trains', $data); 
		}

		// public function displayLiveTrain() {
			
		// 	// $train=$this->trackModel->getTrain($trainId);
  //  //          $journey=$this->trackModel->getJourney($journeyId);

  //  //          $data=[
  //  //              'journey'=>$journey,
  //  //              'train'=>$train
  //  //          ];
			
		// 	$this->view('passengers/trackings/display_livetrain'); 
		// }

		public function displayLiveTrain($trainId,$journeyId) {
			
			$train=$this->passengerTrackingModel->getTrain($trainId);
            $journey=$this->passengerTrackingModel->getJourney($journeyId);

            $data=[
                'journey'=>$journey,
                'train'=>$train
            ];
			
			$this->view('passengers/trackings/display_livetrain', $data); 
		}

		public function getTrainLocation($journeyId){
            $response=array();
            $response=$this->passengerTrackingModel->getJourneyLocation($journeyId);
            if(sizeof($response)>0){
                $now=time();
                $time=$response[0]->time;
                if($response[0]->journey_status=='Live'){
                    $x=$now-strtotime($time);
                    if($x>60*$this->threshHoldTime){
                        $this->passengerTrackingModel->stopJourney($response[0]->journeyId);
                    }
                }
            }

            echo json_encode($response);
        }
		
	}
