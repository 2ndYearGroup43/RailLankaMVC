<?php
class Admin_manage_available_days extends Controller{
	public function __construct(){
                isAdminLoggedIn();
		$this->adminModel=$this->model('Admin_manage_available_day');
	}

	public function index(){ // index function
		$manage_available_day=$this->adminModel->get();
		$data = [
			'manage_available_day'=>$manage_available_day
		];
		$this->view('admins/manage_available_day/index', $data);
	}

	public function create($trainId){ // available days add function
		$rstatus=$this->adminModel->getReservableStatus($trainId);
		
		$data = [
			'trainId'=>$trainId,
			'rstatus'=>$rstatus,
			'sunday'=>'',
			'monday'=>'',
			'tuesday'=>'',
			'wednesday'=>'',
			'thursday'=>'',
			'friday'=>'',
			'saturday'=>''
		];

		if($_SERVER['REQUEST_METHOD']=='POST'){
			$_POST=filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
			$data=[
				'trainId'=>$trainId,
				'rstatus'=>$rstatus,
				'sunday'=>trim($_POST['sunday']),
				'monday'=>trim($_POST['monday']),
				'tuesday'=>trim($_POST['tuesday']),
				'wednesday'=>trim($_POST['wednesday']),
				'thursday'=>trim($_POST['thursday']),
				'friday'=>trim($_POST['friday']),
				'saturday'=>trim($_POST['saturday']),
            ];

			if ($this->adminModel->create_available_day($data)) {
				if($rstatus=='1'){
					header("Location: " . URLROOT . "/Admin_manage_compartments/create/".$data['trainId']);
				}else{
					header("Location: " . URLROOT . "/Admin_manage_trains");
				}
				
			}else{
				die("Something went Wrong");
			}

		}
		$this->view('admins/manage_available_day/create', $data);

	}

	public function edit($trainId){ // edit available days

		$manage_available_day=$this->adminModel->findTrainId($trainId);
		$days=$this->adminModel->getAvailableDays($trainId);
		

		$data = [
			'manage_available_day'=>$manage_available_day,
			'trainId'=>$trainId,
			'days'=>$days,
			'sunday'=>'',
			'monday'=>'',
			'tuesday'=>'',
			'wednesday'=>'',
			'thursday'=>'',
			'friday'=>'',
			'saturday'=>'',
            'trainIdError'=>''

		];

		if($_SERVER['REQUEST_METHOD']=='POST'){
			$_POST=filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
			$data=[
			'manage_available_day'=>$manage_available_day,	
			'trainId'=>$trainId,
			'days'=>$days,
			'sunday'=>trim($_POST['sunday']),
			'monday'=>trim($_POST['monday']),
			'tuesday'=>trim($_POST['tuesday']),
			'wednesday'=>trim($_POST['wednesday']),
			'thursday'=>trim($_POST['thursday']),
			'friday'=>trim($_POST['friday']),
			'saturday'=>trim($_POST['saturday']),
            'trainIdError'=>''			
            ];


			if ($this->adminModel->edit($data)) {
				header("Location: " . URLROOT . "/Admin_manage_available_days");
			}else{
				die("Something Going Wrong");
			}           
		
		}
		$this->view('admins/manage_available_day/edit', $data);
	}

	public function views($trainId){ // view available days

		$manage_available_day=$this->adminModel->findTrainId($trainId);

		$data = [
			'manage_available_day'=>$manage_available_day,
			'trainId'=>'',
			'sunday'=>'',
			'monday'=>'',
			'tuesday'=>'',
			'wednesday'=>'',
			'thursday'=>'',
			'friday'=>'',
			'saturday'=>''
		];

		if($_SERVER['REQUEST_METHOD']=='POST'){
			$_POST=filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
			$data=[
			'manage_available_day'=>$manage_available_day,	
			'trainId'=>$trainId,
			'sunday'=>trim($_POST['sunday']),
			'monday'=>trim($_POST['monday']),
			'tuesday'=>trim($_POST['tuesday']),
			'wednesday'=>trim($_POST['wednesday']),
			'thursday'=>trim($_POST['thursday']),
			'friday'=>trim($_POST['friday']),
			'saturday'=>trim($_POST['saturday'])
			];
			if ($this->adminModel->views($data)) {
				header("Location: " . URLROOT . "/Admin_manage_available_days");
			}else{
				die("Something Going Wrong");
			}           
		}
		$this->view('admins/manage_available_day/views', $data);
	}

	public function delete($trainId){ // delete available days

		$manage_available_day=$this->adminModel->findTrainId($trainId);

		$data = [
			'manage_available_day'=>$manage_available_day,
			'trainId'=>'',
			'sunday'=>'',
			'monday'=>'',
			'tuesday'=>'',
			'wednesday'=>'',
			'thursday'=>'',
			'friday'=>'',
			'saturday'=>''
		];

		if($_SERVER['REQUEST_METHOD']=='POST'){
			$_POST=filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
		if($this->adminModel->delete($trainId)){
			header("Location: " . URLROOT . "/Admin_manage_available_days");
		}
		else{
			die('Something Going Wrong');
		}
	}
	}
}	