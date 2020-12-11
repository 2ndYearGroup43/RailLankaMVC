<?php
class Admin_manage_schedules extends Controller{
	public function __construct(){
		isAdminLoggedIn();
		$this->adminModel=$this->model('Admin_manage_schedule');
	}

	public function index(){
		$manage_schedule=$this->adminModel->get();
		$data = [
			'manage_schedule'=>$manage_schedule
		];
		$this->view('admins/manage_schedule/index', $data);
	}

	public function create(){
		$routes=$this->adminModel->getRouteId();
		$stations=$this->adminModel->getStationID();
		$added_data=$this->adminModel->get();
		$data = [
			'routes'=>$routes,
			'stations'=>$stations,
			'added_data'=>$added_data,
			'routeId'=>'',
			'stationID'=>'',
			'stopNo'=>'',
			'arrivaltime'=>'',
			'departuretime'=>'',
			'date'=>'',
            'distance'=>'',
            'routeIdError'=>'',
            'stationIDError'=>'',
            'stopNoError'=>'',
            'distanceError'=>''
		];

		if($_SERVER['REQUEST_METHOD']=='POST'){
			$_POST=filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
			$data=[
			'routes'=>$routes,
			'stations'=>$stations,
			'added_data'=>$added_data,	
			'routeId'=>trim($_POST['routeId']),	
			'stationID'=>trim($_POST['stationID']),			
			'stopNo'=>trim($_POST['stopNo']),
			'arrivaltime'=>trim($_POST['arrivaltime']),
			'departuretime'=>trim($_POST['departuretime']),
			'date'=>trim($_POST['date']),
			'distance'=>trim($_POST['distance']),
			'routeIdError'=>'',
            'stationIDError'=>'',
            'stopNoError'=>'',
            'distanceError'=>''
			];
            $idValidation="/^[a-zA-Z0-9]*$/";
            $numberValidation="/^[0-9]*$/";

                if(empty($data['routeId'])){
                $data['routeIdError']='Please Enter the Route ID.';
                }elseif(!preg_match($idValidation, $data['routeId'])){
                    $data['routeIdError']="Route ID can only contain letters and numbers.";
                }
                if(empty($data['stationID'])){
                    $data['stationIDError']='Please Enter the Compartment No.';
                }elseif(!preg_match($idValidation, $data['stationID'])){
                    $data['stationIDError']="Compartment No can only contain letters and numbers.";
                }
                if(empty($data['stopNo'])){
                    $data['stopNoError']='Please Enter the Stop Number.';
                }elseif(!preg_match($numberValidation, $data['stopNo'])){
                    $data['stopNoError']="Stop Number can only contain numbers.";
                }
                if(empty($data['distance'])){
                    $data['distanceError']='Please Enter the Last Name.';
                }elseif(!preg_match($numberValidation, $data['distance'])){
                    $data['distanceError']="Distance can only contain numbers.";
                }

                if(empty($data['routeIdError']) && empty($data['stationIDError']) &&
                empty($data['stopNoError']) && empty($data['distanceError']) ){

			if ($this->adminModel->create_schedule($data)) {
				header("Location: " . URLROOT . "/Admin_manage_schedules/create");
			}else{
				die("Something Going Wrong");
			}
           }
		}

		$this->view('admins/manage_schedule/create', $data);

	}

	public function addSchedule($trainId)
	{
		// $routes=$this->adminModel->getRouteId();
		$stations=$this->adminModel->getStationID();
		// $added_data=$this->adminModel->get();

		$data=[
			'trainId'=>$trainId,
			// 'routes'=>$routes,
			'stations'=>$stations,
			// 'added_data'=>$added_data,
			// "trainId"=>$trainId,
			"scheduleError"=>'',
			"schedules"=>''
		];

		if($_SERVER['REQUEST_METHOD']=='POST'){
			$a=json_decode($_POST['scheduleField']);
			$_POST=filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);


			$data=[
				'trainId'=>$trainId,
				// 'routes'=>$routes,
				'stations'=>$stations,
				// 'added_data'=>$added_data,
				// "trainId"=>$trainId,
				"scheduleError"=>'',
				"schedules"=>$a
			];


			if(empty($data['schedules'])){
				$data['scheduleError']="No schedules to entered";
			}

			if(empty($data['scheduleError'])){
				// $this->adminModel();

				// echo $_POST['scheduleField'];
			
				// var_dump($a);
				// echo $a[0]->stationId;
				// echo $a[2]->distance;
				// $this->view('admins/manage_schedule/create', $data);
			
			
				
				if($this->adminModel->addSchedule($data)){
					header("Location: " . URLROOT . "/Admin_manage_available_days/create/".$data['trainId']);
				}else{
					die("Something went wrong");
				}
				
				


			}else{
				$this->view('admins/manage_schedule/create', $data);
				return;
			}
			
		}

		$this->view('admins/manage_schedule/create', $data);



	}

	public function edit($routeId){

		$manage_schedule=$this->adminModel->findRoute($routeId);
		$routes=$this->adminModel->getRouteId();
		$stations=$this->adminModel->getStationID();
		$added_data=$this->adminModel->get();

		$data = [
			'manage_schedule'=>$manage_schedule,
			'routes'=>$routes,
			'stations'=>$stations,
			'added_data'=>$added_data,	
			'routeId'=>'',
			'stationID'=>'',
			'stopNo'=>'',
			'arrivaltime'=>'',
			'departuretime'=>'',
			'date'=>'',
            'distance'=>'',
            'routeIdError'=>'',
            'stationIDError'=>'',
            'stopNoError'=>'',
            'distanceError'=>''
		];

		if($_SERVER['REQUEST_METHOD']=='POST'){
			$_POST=filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
			$data=[
			'manage_schedule'=>$manage_schedule,
			'routes'=>$routes,
			'stations'=>$stations,		
			'routeId'=>$routeId,
			'added_data'=>$added_data,	
			'stationID'=>trim($_POST['stationID']),			
			'stopNo'=>trim($_POST['stopNo']),
			'arrivaltime'=>trim($_POST['arrivaltime']),
			'departuretime'=>trim($_POST['departuretime']),
			'date'=>trim($_POST['date']),
			'distance'=>trim($_POST['distance']),
			'routeIdError'=>'',
            'stationIDError'=>'',
            'stopNoError'=>'',
            'distanceError'=>''
			];
            $idValidation="/^[a-zA-Z0-9]*$/";
            $numberValidation="/^[0-9]*$/";

                if(empty($data['routeId'])){
                $data['routeIdError']='Please Enter the Route ID.';
                }elseif(!preg_match($idValidation, $data['routeId'])){
                    $data['routeIdError']="Route ID can only contain letters and numbers.";
                }else{
                    //if moderatorID exists
                    if($this->adminModel->findRouteByRouteId($data['routeId'])){
                        $data['routeIdError']='This ID is already registered as a Route in the system.'; 
                    }
                }
                if(empty($data['stationID'])){
                    $data['stationIDError']='Please Enter the Compartment No.';
                }elseif(!preg_match($idValidation, $data['stationID'])){
                    $data['stationIDError']="Compartment No can only contain letters and numbers.";
                }else{
                    //if Employee ID exists
                    if($this->adminModel->findRouteByStationID($data['stationID'])){
                        $data['stationIDError']='This route is already registered as a route in the system.'; 
                    }
                }
                if(empty($data['stopNo'])){
                    $data['stopNoError']='Please Enter the Stop Number.';
                }elseif(!preg_match($numberValidation, $data['stopNo'])){
                    $data['stopNoError']="Stop Number can only contain numbers.";
                }
                if(empty($data['distance'])){
                    $data['distanceError']='Please Enter the Last Name.';
                }elseif(!preg_match($numberValidation, $data['distance'])){
                    $data['distanceError']="Distance can only contain numbers.";
                }

                if(empty($data['routeIdError']) && empty($data['stationIDError']) &&
                empty($data['stopNoError']) && empty($data['distanceError']) ){

			if ($this->adminModel->edit($data)) {
				header("Location: " . URLROOT . "/Admin_manage_schedules");
			}else{
				die("Something Going Wrong");
			}           
		}
	}
		$this->view('admins/manage_schedule/edit', $data);
	}

		public function views($routeId){

		$manage_schedule=$this->adminModel->findRoute($routeId);

		$data = [
			'manage_schedule'=>$manage_schedule,
			'routeId'=>'',
			'stationID'=>'',
			'stopNo'=>'',
			'arrivaltime'=>'',
			'departuretime'=>'',
			'date'=>'',
            'distance'=>''
		];

		if($_SERVER['REQUEST_METHOD']=='POST'){
			$_POST=filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
			$data=[
			'routeId'=>$routeId,	
			'stationID'=>trim($_POST['stationID']),			
			'stopNo'=>trim($_POST['stopNo']),
			'arrivaltime'=>trim($_POST['arrivaltime']),
			'departuretime'=>trim($_POST['departuretime']),
			'date'=>trim($_POST['date']),
			'distance'=>trim($_POST['distance'])
			];
			if ($this->adminModel->views($data)) {
				header("Location: " . URLROOT . "/Admin_manage_schedules");
			}else{
				die("Something Going Wrong");
			}           
		}
		$this->view('admins/manage_schedule/views', $data);
	}

	public function delete($stationID, $trainId){

		$manage_schedule=$this->adminModel->findRoute($stationID);
		$route=$this->adminModel->getRouteId($trainId);
		$trainId=$route->trainId;
		
		$data = [
			'manage_schedule'=>$manage_schedule,
			'trainId'=>$trainId,
			'routeId'=>'',
			'stationID'=>'',
			'stopNo'=>'',
			'arrivaltime'=>'',
			'departuretime'=>'',
			'date'=>'',
            'distance'=>''
		];

		if($_SERVER['REQUEST_METHOD']=='POST'){
			$_POST=filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
		if($this->adminModel->delete($stationID)){
			header("Location: " . URLROOT . "/Admin_manage_schedules/viewAllSchedule/" . $trainId);
		}
		else{
			die('Something Going Wrong');
		}
	}
	}


	public function viewSchedule($trainId)
	{
		$manage_train=$this->adminModel->findTrain($trainId);
		$schedules=$this->adminModel->getScheduleDetails($trainId);
		$days=$this->adminModel->getAvailableDays($trainId);
		$compartments=$this->adminModel->getCompartments($trainId);


		$data = [
			'manage_train'=>$manage_train,
			'trainId'=>$trainId,
			'schedules'=>$schedules,
			'days'=>$days,
			'compartments'=>$compartments
		];

		
		$this->view('admins/manage_schedule/viewSchedule', $data);
	}

	public function addNewStops($trainId,$routeId){
		$stations=$this->adminModel->getStationID();
		$route=$this->adminModel->getRouteId($trainId);
		$routeId=$route->routeId;

		$data=[
			'trainId'=>$trainId,
			'routeId'=>$routeId,
			'stations'=>$stations,
			// 'added_data'=>$added_data,
			// "trainId"=>$trainId,
			"scheduleError"=>'',
			"schedules"=>''
		];

		if($_SERVER['REQUEST_METHOD']=='POST'){
			$a=json_decode($_POST['scheduleField']);
			$_POST=filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);


			$data=[
				'trainId'=>$trainId,
				// 'routes'=>$routes,
				'stations'=>$stations,
				// 'added_data'=>$added_data,
				// "trainId"=>$trainId,
				"scheduleError"=>'',
				"schedules"=>$a
			];


			if(empty($data['schedules'])){
				$data['scheduleError']="No schedules to entered";
			}

			if(empty($data['scheduleError'])){
				// $this->adminModel();

				// echo $_POST['scheduleField'];
			
				// var_dump($a);
				// echo $a[0]->stationId;
				// echo $a[2]->distance;
				// $this->view('admins/manage_schedule/create', $data);
			
			
				
				if($this->adminModel->addNewStops($trainId,$routeId,$data)){
					header("Location: " . URLROOT . "/Admin_manage_schedules/viewAllSchedule/". $trainId);
				}else{
					die("Something went wrong");
				}
				
				


			}else{
				$this->view('admins/manage_schedule/addNewStops', $data);
				return;
			}
			
		}

		$this->view('admins/manage_schedule/addNewStops', $data);
	}

		public function viewAllSchedule($trainId)
	{
		$route=$this->adminModel->getRouteId($trainId);
		$routeId=$route->routeId;
		$routes=$this->adminModel->getRoutes($routeId);
        
		$data = [
			'routes'=>$routes,
			'trainId'=>$trainId,
            'routeId'=>$routeId
            
		];

		$this->view('admins/manage_schedule/viewAllSchedules', $data);
	}

	public function editSingle($routeId, $stationID, $trainId){
		$manage_schedule=$this->adminModel->findRoute($routeId);
		$schedule=$this->adminModel->getSchedule($routeId, $stationID);
		$route=$this->adminModel->getRouteId($trainId);
		$trainId=$route->trainId;

		$data = [
			'manage_schedule'=>$manage_schedule,
			'schedule'=>$schedule,
	        'trainId'=>$trainId,
			'routeId'=>$schedule->routeId,
			'stationID'=>$schedule->stationID,
			'stopNo'=>$schedule->stopNo,
			'arrivaltime'=>$schedule->arrivaltime,
			'departuretime'=>$schedule->departuretime,
			'date'=>$schedule->date,
            'distance'=>$schedule->distance,
            'routeIdError'=>'',
            'stationIDError'=>'',
            'stopNoError'=>'',
            'distanceError'=>''
		];

		if($_SERVER['REQUEST_METHOD']=='POST'){
			$_POST=filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
			$data=[
			'manage_schedule'=>$manage_schedule,
			'schedule'=>$schedule,
			'trainId'=>$trainId,		
			'routeId'=>$schedule->routeId,		
			'stationID'=>$schedule->stationID,			
			'stopNo'=>trim($_POST['stopNo']),
			'arrivaltime'=>trim($_POST['arrivaltime']),
			'departuretime'=>trim($_POST['departuretime']),
			'date'=>trim($_POST['date']),
			'distance'=>trim($_POST['distance']),
			'routeIdError'=>'',
            'stationIDError'=>'',
            'stopNoError'=>'',
            'distanceError'=>''
			];
            $idValidation="/^[a-zA-Z0-9]*$/";
            $numberValidation="/^[0-9]*$/";

                if(empty($data['routeId'])){
                $data['routeIdError']='Please Enter the Route ID.';
                }elseif(!preg_match($idValidation, $data['routeId'])){
                    $data['routeIdError']="Route ID can only contain letters and numbers.";
                }
                elseif($schedule->routeId!=$data['routeId']){
                if($this->adminModel->findRouteByRouteId($data['routeId'])){
                    $data['routeIdError']='This compartment is already registered as a compartment in the system.'; 
                    }
                }

                if(empty($data['stationID'])){
                    $data['stationIDError']='Please Enter the Compartment No.';
                }elseif(!preg_match($idValidation, $data['stationID'])){
                    $data['stationIDError']="Compartment No can only contain letters and numbers.";
                }
                elseif($schedule->stationID!=$data['stationID']){
                if($this->adminModel->findRouteByStationID($data['stationID'])){
                    $data['stationIDError']='This compartment is already registered as a compartment in the system.'; 
                    }
                }

                if(empty($data['stopNo'])){
                    $data['stopNoError']='Please Enter the Stop Number.';
                }elseif(!preg_match($numberValidation, $data['stopNo'])){
                    $data['stopNoError']="Stop Number can only contain numbers.";
                }
                if(empty($data['distance'])){
                    $data['distanceError']='Please Enter the Last Name.';
                }elseif(!preg_match($numberValidation, $data['distance'])){
                    $data['distanceError']="Distance can only contain numbers.";
                }

                if(empty($data['routeIdError']) && empty($data['stationIDError']) &&
                empty($data['stopNoError']) && empty($data['distanceError']) ){

			if ($this->adminModel->edit($data)) {
				header("Location: " . URLROOT . "/Admin_manage_schedules/viewAllSchedule/" . $trainId);
			}else{
				die("Something Going Wrong");
			}           
		}
	}
		$this->view('admins/manage_schedule/editSingle', $data);
	 	
	}

	
}	