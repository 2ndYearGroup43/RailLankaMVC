<?php
class manage_schedule extends Controller{
	public function __construct(){
		$this->postModel=$this->model('Manage_schedules');
	}

	public function index(){
		$manage_schedule=$this->postModel->get();
		$data = [
			'manage_schedule'=>$manage_schedule
		];
		$this->view('manage_schedule/index', $data);
	}

	public function create(){
		$data = [
			'routeId'=>'',
			'stationId'=>'',
			'stopNo'=>'',
			'arrivaltime'=>'',
			'departuretime'=>'',
			'date'=>'',
            'distance'=>'',
            'routeIdError'=>'',
            'stationIdError'=>'',
            'stopNoError'=>'',
            'distanceError'=>''
		];

		if($_SERVER['REQUEST_METHOD']=='POST'){
			$_POST=filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
			$data=[
			'routeId'=>trim($_POST['routeId']),	
			'stationId'=>trim($_POST['stationId']),			
			'stopNo'=>trim($_POST['stopNo']),
			'arrivaltime'=>trim($_POST['arrivaltime']),
			'departuretime'=>trim($_POST['departuretime']),
			'date'=>trim($_POST['date']),
			'distance'=>trim($_POST['distance']),
			'routeIdError'=>'',
            'stationIdError'=>'',
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
                    if($this->postModel->findRouteByRouteId($data['routeId'])){
                        $data['routeIdError']='This ID is already registered as a Route in the system.'; 
                    }
                }
                if(empty($data['stationId'])){
                    $data['stationIdError']='Please Enter the Compartment No.';
                }elseif(!preg_match($idValidation, $data['stationId'])){
                    $data['stationIdError']="Compartment No can only contain letters and numbers.";
                }else{
                    //if Employee ID exists
                    if($this->postModel->findRouteByStationId($data['stationId'])){
                        $data['stationIdError']='This route is already registered as a route in the system.'; 
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

                if(empty($data['routeIdError']) && empty($data['stationIdError']) &&
                empty($data['stopNoError']) && empty($data['distanceError']) ){

			if ($this->postModel->create_schedule($data)) {
				header("Location: " . URLROOT . "/manage_schedule");
			}else{
				die("Something Going Wrong");
			}
           }
		}

		$this->view('manage_schedule/create', $data);

	}

	public function edit($routeId){

		$manage_schedule=$this->postModel->findRoute($routeId);

		$data = [
			'manage_schedule'=>$manage_schedule,
			'routeId'=>'',
			'stationId'=>'',
			'stopNo'=>'',
			'arrivaltime'=>'',
			'departuretime'=>'',
			'date'=>'',
            'distance'=>'',
            'routeIdError'=>'',
            'stationIdError'=>'',
            'stopNoError'=>'',
            'distanceError'=>''
		];

		if($_SERVER['REQUEST_METHOD']=='POST'){
			$_POST=filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
			$data=[
			'manage_schedule'=>$manage_schedule,	
			'routeId'=>$routeId,	
			'stationId'=>trim($_POST['stationId']),			
			'stopNo'=>trim($_POST['stopNo']),
			'arrivaltime'=>trim($_POST['arrivaltime']),
			'departuretime'=>trim($_POST['departuretime']),
			'date'=>trim($_POST['date']),
			'distance'=>trim($_POST['distance']),
			'routeIdError'=>'',
            'stationIdError'=>'',
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
                    if($this->postModel->findRouteByRouteId($data['routeId'])){
                        $data['routeIdError']='This ID is already registered as a Route in the system.'; 
                    }
                }
                if(empty($data['stationId'])){
                    $data['stationIdError']='Please Enter the Compartment No.';
                }elseif(!preg_match($idValidation, $data['stationId'])){
                    $data['stationIdError']="Compartment No can only contain letters and numbers.";
                }else{
                    //if Employee ID exists
                    if($this->postModel->findRouteByStationId($data['stationId'])){
                        $data['stationIdError']='This route is already registered as a route in the system.'; 
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

                if(empty($data['routeIdError']) && empty($data['stationIdError']) &&
                empty($data['stopNoError']) && empty($data['distanceError']) ){

			if ($this->postModel->edit($data)) {
				header("Location: " . URLROOT . "/manage_schedule");
			}else{
				die("Something Going Wrong");
			}           
		}
	}
		$this->view('manage_schedule/edit', $data);
	}

		public function views($routeId){

		$manage_schedule=$this->postModel->findRoute($routeId);

		$data = [
			'manage_schedule'=>$manage_schedule,
			'routeId'=>'',
			'stationId'=>'',
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
			'stationId'=>trim($_POST['stationId']),			
			'stopNo'=>trim($_POST['stopNo']),
			'arrivaltime'=>trim($_POST['arrivaltime']),
			'departuretime'=>trim($_POST['departuretime']),
			'date'=>trim($_POST['date']),
			'distance'=>trim($_POST['distance'])
			];
			if ($this->postModel->views($data)) {
				header("Location: " . URLROOT . "/manage_schedule");
			}else{
				die("Something Going Wrong");
			}           
		}
		$this->view('manage_schedule/views', $data);
	}

	public function delete($routeId){

		$manage_schedule=$this->postModel->findRoute($routeId);

		$data = [
			'manage_schedule'=>$manage_schedule,
			'routeId'=>'',
			'stationId'=>'',
			'stopNo'=>'',
			'arrivaltime'=>'',
			'departuretime'=>'',
			'date'=>'',
            'distance'=>''
		];

		if($_SERVER['REQUEST_METHOD']=='POST'){
			$_POST=filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
		if($this->postModel->delete($routeId)){
			header("Location: " . URLROOT . "/manage_schedule");
		}
		else{
			die('Something Going Wrong');
		}
	}
	}
}	