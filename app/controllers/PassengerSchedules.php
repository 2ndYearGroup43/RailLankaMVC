<?php 
	
	class PassengerSchedules extends Controller {

		public function __construct() {
			isPassenger();
			$this->passengerScheduleModel = $this->model('PassengerSchedule');
		}


		//Function to search for trains
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

		        //checking source station input
		        if(empty($data['src'])){
		        	$data['srcError']="Please enter the source station to proceed."; //Passenger hasn't enetered source station
		        }else{
		        	if(!$this->passengerScheduleModel->checkStation($data['src'])){
		        		$data['srcError']='Source station does not exist'; //Passenger enters non existing source station
		        	} else{
		        		$result=$this->passengerScheduleModel->getStationId($data['src']);
		        		$data['src']=$result->stationId;
		        	} 
		        	
		        }

		        //checking destination station input
		        if(!empty($data['dest'])){
		        	if(!$this->passengerScheduleModel->checkStation($data['dest'])){
		        		$data['destError']='Destination station does not exist'; //Passenger enters non existing destination station
		        	} else{
		        		$result=$this->passengerScheduleModel->getStationId($data['dest']);
		        		$data['dest']=$result->stationId;

		        		if($data['src']==$data['dest']){
		        			$data['destError']='Destination and source station cannot be the same'; //Passenger enters same station for source and destination
		        		}
		        	}
		        }

		        //checking date input
		        if(!empty($data['date'])){
		        	if(($data['date']<date("Y-m-d")) || ($data['date']>date("Y-m-d", strtotime("+2 months")))) {
		        		$data['dateError']='Bookings can be done only upto 2 months in advance'; //Passenger enters date that is more than two months away
		        	}else{
			        	$data['date']= date('l', strtotime($data['date'])); //getting the weekday related to the train
		        	}
		        }

		        //checking time input
		        if(!empty($data['deptTime'])){

		        }

				//checking for errors
		        if(empty($data['srcError']) && empty($data['destError']) && empty($data['dateError']) && empty($data['timeError'])){

		        	#src-date-time/src-date/src-time/src
		        	if(empty($data['dest'])){

		        		#src
		        		if(empty($data['date']) && empty($data['deptTime'])){
		        			
		        			$data['trains']=$this->passengerScheduleModel->searchSrc($data);

		        		#src-time
		        		}elseif(empty($data['date'])){
		        			
		        			$data['trains']=$this->passengerScheduleModel->searchSrcTime($data);
		        		#src-date
		        		}elseif(empty($data['deptTime'])){
		        			
		        			$data['trains']=$this->passengerScheduleModel->searchSrcDate($data);
		        		#src-date-time
		        		}else {
		        			
		        			$data['trains']=$this->passengerScheduleModel->searchSrcDateTime($data);
		        		}

		        	#src-dest-date-time/src-dest-date/src-dest-time/src-dest
		        	}else {

		        		#src-dest
		        		if(empty($data['date']) && empty($data['deptTime'])){
		        			
		        			$data['trains']=$this->passengerScheduleModel->searchSrcDest($data);
		        		#src-dest-time
		        		}elseif(empty($data['date'])){
		        			
		        			$data['trains']=$this->passengerScheduleModel->searchSrcDestTime($data);
		        		#src-dest-date
		        		}elseif(empty($data['deptTime'])){
		        			
		        			$data['trains']=$this->passengerScheduleModel->searchSrcDestDate($data);
		        		#src-dest-date-time
		        		}else {
		        			
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


		//Function to display the search results(trains)
		public function displayTrains($data) {

			
			$this->view('passengers/schedules/display_trains',$data); 
		}


		//Function to display individual train details
		public function displayTrainDetails($id) {

			$train=$this->passengerScheduleModel->getTrainDetails($id);
			$routes=$this->passengerScheduleModel->getSchedule($id);
			$rate=$this->passengerScheduleModel->getRate($id);
			$prices=$this->calPrices($routes, $rate);
			$data= [
				'train'=>$train,
				'routes'=>$routes,
				'prices'=>$prices
			];
			
			$this->view('passengers/schedules/display_traindetails',$data); 
		}	


		//Function to calculate and retrive prices of stops
		public function calPrices($routes, $rate){
        
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
            return $data;
        }

	}
