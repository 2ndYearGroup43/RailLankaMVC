<?php 
	
	class PassengerAlerts extends Controller {

		public function __construct() {
			$this->passengerAlertModel = $this->model('PassengerAlert');
		}

		public function search() {
			
			isPassengerLoggedIn();
			$stations=$this->passengerAlertModel->getStations();
			
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
		        	if(!$this->passengerAlertModel->checkStation($data['src'])){
		        		$data['srcError']='Source station doesnt exist';
		        	} else{
		        		$result=$this->passengerAlertModel->getStationId($data['src']);
		        		$data['src']=$result->stationId;
		        		// var_dump($data['src']);
		        	} 
		        	
		        }

		        if(!empty($data['dest'])){
		        	if(!$this->passengerAlertModel->checkStation($data['dest'])){
		        		$data['destError']='Destination station doesnt exist';
		        	} else{
		        		$result=$this->passengerAlertModel->getStationId($data['dest']);
		        		$data['dest']=$result->stationId;
		        		// var_dump($data['dest']);
		        	}
		        }

		        if(!empty($data['date'])){
		        	$data['date']= date('l', strtotime($data['date']));
		        	// var_dump($data['date']);
		        }

		        if(!empty($data['deptTime'])){
		        	// var_dump($data['deptTime']);
		        }

		        if(empty($data['srcError']) && empty($data['destError']) && empty($data['dateError']) && empty($data['timeError'])){

		        	#src-date-time/src-date/src-time/src
		        	if(empty($data['dest'])){

		        		#src
		        		if(empty($data['date']) && empty($data['deptTime'])){
		        			// echo "#src";
		        			$data['trains']=$this->passengerAlertModel->searchSrc($data);

		        		#src-time
		        		}elseif(empty($data['date'])){
		        			// echo "#src-time";
		        			$data['trains']=$this->passengerAlertModel->searchSrcTime($data);
		        		#src-date
		        		}elseif(empty($data['deptTime'])){
		        			//echo "#src-date";
		        			$data['trains']=$this->passengerAlertModel->searchSrcDate($data);
		        		#src-date-time
		        		}else {
		        			//echo "#src-date-time";
		        			$data['trains']=$this->passengerAlertModel->searchSrcDateTime($data);
		        		}

		        	#src-dest-date-time/src-dest-date/src-dest-time/src-dest
		        	}else {

		        		#src-dest
		        		if(empty($data['date']) && empty($data['deptTime'])){
		        			//echo "#src-dest";
		        			$data['trains']=$this->passengerAlertModel->searchSrcDest($data);
		        		#src-dest-time
		        		}elseif(empty($data['date'])){
		        			//echo "#src-dest-time";
		        			$data['trains']=$this->passengerAlertModel->searchSrcDestTime($data);
		        		#src-dest-date
		        		}elseif(empty($data['deptTime'])){
		        			//echo "#src-dest-date";
		        			$data['trains']=$this->passengerAlertModel->searchSrcDestDate($data);
		        		#src-dest-date-time
		        		}else {
		        			//echo "#src-dest-date-time";
		        			$data['trains']=$this->passengerAlertModel->searchAll($data);
		        		}

		        	}

		        	$this->displayTrains($data); 
		        	return;

		        }else {

		        	$this->view('passengers/alerts/search_trains',$data);
		        }
	        }

			$this->view('passengers/alerts/search_trains',$data); 
		}

		public function displayTrains($data) {

			isPassengerLoggedIn();
			$this->view('passengers/alerts/display_trains',$data); 
		}

		public function displayAlerts() {

			isPassenger();
			
			$fields=$this->passengerAlertModel->getAlertFields();
			$totalAlerts=$this->passengerAlertModel->countAllAlerts();
			$limit=5;

			if(!isset($_GET['page'])){
				$page = 1;
			} else {
				$page = $_GET['page'];
			}

			$start = ($page-1)*$limit;

			$alerts=$this->passengerAlertModel->displayAll($start,$limit);

			$data=[
				'alerts'=>$alerts,
				'fields'=>$fields,
				'limit'=>$limit,
				'totalAlerts'=>$totalAlerts,
				'totalPages'=>ceil($totalAlerts/$limit),
				'start'=>$start,
				'page'=>$page

			];

			$this->view('passengers/alerts/display_alerts', $data); 
		}	

		public function searchAlertsBy() {

			isPassenger();

			$data = [
				'alerts'=>'',
				'fields'=>'',
				'searchField'=>'',
				'searchVal'=>'',
				'limit'=>'',
				'totalAlerts'=>'',
				'totalPages'=>'',
				'start'=>'',
				'page'=>''
			];

			if($_SERVER['REQUEST_METHOD']=='POST'){
				$_POST=filter_input_array(INPUT_POST,FILTER_SANITIZE_STRING);

				$searchField = trim($_POST['searchField']);
				$searchVal = trim($_POST['searchVal']);

			} else {

				if(isset($_GET['searchVal']))
				{
					$searchField = $_GET['searchField'];
					$searchVal = $_GET['searchVal'];
				} else {
					$searchVal = '';
					$searchField = '';
				}
			}

			$limit=5;

			if(!isset($_GET['page'])){
				$page = 1;
			} else {
				$page = $_GET['page'];
			}

			$start = ($page-1)*$limit;

			//$alerts=$this->passengerAlertModel->displayAll($start,$limit);
			$totalAlerts=$this->passengerAlertModel->countAlerts($searchField,$searchVal);
			$alerts=$this->passengerAlertModel->searchAlerts($searchField,$searchVal,$start,$limit);
			$fields=$this->passengerAlertModel->getAlertFields();

			$data=[
				'alerts'=>$alerts,
				'fields'=>$fields,
				'searchField'=>$searchField,
				'searchVal'=>$searchVal,
				'limit'=>$limit,
				'totalAlerts'=>$totalAlerts,
				'totalPages'=>ceil($totalAlerts/$limit),
				'start'=>$start,
				'page'=>$page
			];

			$this->view('passengers/alerts/display_alerts2', $data); 
		}

		public function displayCancelled() {

			isPassenger();
			$alerts=$this->passengerAlertModel->displayCancelled();
			$data=[
				'alerts'=>$alerts
			];
			$this->view('passengers/alerts/display_cancelled', $data); 
		}	

		public function displayDelayed() {

			isPassenger();
			$alerts=$this->passengerAlertModel->displayDelayed();
			$data=[
				'alerts'=>$alerts
			];
			$this->view('passengers/alerts/display_delayed', $data); 
		}	

		public function displayRescheduled() {

			isPassenger();
			$alerts=$this->passengerAlertModel->displayRescheduled();
			$data=[
				'alerts'=>$alerts
			];
			$this->view('passengers/alerts/display_rescheduled', $data); 
		}	

		public function displayAlertDetails(){

			isPassenger();
			if(isset($_POST['alertid'])){
				$result = '';
				$output = '';
				$alertid=trim($_POST['alertid']);

				$alertType=$this->passengerAlertModel->getAlertType($alertid);

				if($alertType->type=="cancelled"){

					$result=$this->passengerAlertModel->getCancelledAlert($alertid);

					$output .= '
						<tbody>
							<tr>
								<th>AlertID:</th>	
								<td>'.$result->alertId.'</td>
							</tr>
							<tr>
								<th>Cancellation Cause:</th>	
								<td>'.$result->cancellation_cause.'</td>
							</tr>
						</tbody>	
					';

				}else if($alertType->type=="delayed"){

					$result=$this->passengerAlertModel->getDelayedAlert($alertid);

					$output .= '
						<tbody>
							<tr>
								<th>AlertID:</th>	
								<td>'.$result->alertId.'</td>
							</tr>
							<tr>
								<th>Delay Cause:</th>	
								<td>'.$result->delay_cause.'</td>
							</tr>
							<tr>
								<th>Delay Time:</th>	
								<td>'.$result->delaytime.'</td>
							</tr>
						</tbody>	
					';

				}else if($alertType->type=="rescheduled"){

					$result=$this->passengerAlertModel->getRescheduledAlert($alertid);

					$output .= '
						<tbody>
							<tr>
								<th>AlertID:</th>	
								<td>'.$result->alertId.'</td>
							</tr>
							<tr>
								<th>New Date:</th>	
								<td>'.$result->newdate.'</td>
							</tr>
							<tr>
								<th>New Time:</th>	
								<td>'.$result->newtime.'</td>
							</tr>
							<tr>
								<th>Reschedulement Cause:</th>	
								<td>'.$result->reschedulement_cause.'</td>
							</tr>
						</tbody>	
					';
				}

				echo $output;
			}
		}

		public function subscribe(){

			isPassengerLoggedIn();
			$id = $_SESSION['passenger_id'];

			if(isset($_POST['trainid'])){
				$trainid = trim($_POST['trainid']);
			}

			$result=$this->passengerAlertModel->addSubscription($trainid, $id);

			// echo $trainid;
			// echo $nic;
			echo $result;
		}
	}
