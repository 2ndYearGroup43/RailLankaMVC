<?php
class Admin_manage_schedules extends Controller{
	public function __construct(){
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
                    if($this->adminModel->findRouteByStationId($data['stationID'])){
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

			if ($this->adminModel->create_schedule($data)) {
				header("Location: " . URLROOT . "/Admin_manage_schedules/create");
			}else{
				die("Something Going Wrong");
			}
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

	public function delete($routeId){

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
		if($this->adminModel->delete($routeId)){
			header("Location: " . URLROOT . "/Admin_manage_schedules");
		}
		else{
			die('Something Going Wrong');
		}
	}
	}
}	