<?php 
	
	class PassengerSchedules extends Controller {

		public function __construct() {
			isPassenger();
			$this->passengerScheduleModel = $this->model('PassengerSchedule');
		}

		public function search() {

			$stations=$this->passengerScheduleModel->getStations();
			
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
		        	$data['srcError']="Please enter the source station to proceed.";
		        }else{
		        	if(!$this->passengerScheduleModel->checkStation($data['src'])){
		        		$data['srcError']='Source station doesnt exist';
		        	} else{
		        		$result=$this->passengerScheduleModel->getStationId($data['src']);
		        		$data['src']=$result->stationId;
		        		var_dump($data['src']);
		        	} 
		        	
		        }

		        if(!empty($data['dest'])){
		        	if(!$this->passengerScheduleModel->checkStation($data['dest'])){
		        		$data['destError']='Destination station doesnt exist';
		        	} else{
		        		$result=$this->passengerScheduleModel->getStationId($data['dest']);
		        		$data['dest']=$result->stationId;
		        		var_dump($data['dest']);
		        	}
		        }

		        if(!empty($data['date'])){
		        	$data['date']= date('l', strtotime($data['date']));
		        	var_dump($data['date']);
		        }

		        if(!empty($data['deptTime'])){
		        	var_dump($data['deptTime']);
		        }

		        if(empty($data['srcError']) && empty($data['destError']) && empty($data['dateError']) && empty($data['timeError'])){

		        	#src-date-time/src-date/src-time/src
		        	if(empty($data['dest'])){

		        		#src
		        		if(empty($data['date']) && empty($data['deptTime'])){
		        			echo "#src";
		        			$data['trains']=$this->passengerScheduleModel->searchSrc($data);

		        		#src-time
		        		}elseif(empty($data['date'])){
		        			echo "#src-time";
		        			$data['trains']=$this->passengerScheduleModel->searchSrcTime($data);
		        		#src-date
		        		}elseif(empty($data['deptTime'])){
		        			echo "#src-date";
		        			$data['trains']=$this->passengerScheduleModel->searchSrcDate($data);
		        		#src-date-time
		        		}else {
		        			echo "#src-date-time";
		        			$data['trains']=$this->passengerScheduleModel->searchSrcDateTime($data);
		        		}

		        	#src-dest-date-time/src-dest-date/src-dest-time/src-dest
		        	}else {

		        		#src-dest
		        		if(empty($data['date']) && empty($data['deptTime'])){
		        			echo "#src-dest";
		        			$data['trains']=$this->passengerScheduleModel->searchSrcDest($data);
		        		#src-dest-time
		        		}elseif(empty($data['date'])){
		        			echo "#src-dest-time";
		        			$data['trains']=$this->passengerScheduleModel->searchSrcDestTime($data);
		        		#src-dest-date
		        		}elseif(empty($data['deptTime'])){
		        			echo "#src-dest-date";
		        			$data['trains']=$this->passengerScheduleModel->searchSrcDestDate($data);
		        		#src-dest-date-time
		        		}else {
		        			echo "#src-dest-date-time";
		        			$data['trains']=$this->passengerScheduleModel->searchAll($data);
		        		}

		        	}

		        	$this->displayTrains($data); 
		        	return;

		        }else {

		        	$this->view('passengers/schedules/search_trains',$data);
		        }
	        }

			$this->view('passengers/schedules/search_trains',$data); 
		}

		public function displayTrains($data) {

			
			$this->view('passengers/schedules/display_trains',$data); 
		}

		public function displayTrainDetails($id) {

			$data= [
				'train'=>'',
				'route'=>'',
			];
			$data['train']=$this->passengerScheduleModel->getTrainDetails($id);
			$data['route']=$this->passengerScheduleModel->getRouteDetails($id);
			$this->view('passengers/schedules/display_traindetails',$data); 
		}	
	}
