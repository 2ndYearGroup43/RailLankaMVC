<?php
class Admin_manage_available_days extends Controller{
	public function __construct(){
		$this->adminModel=$this->model('Admin_manage_available_day');
	}

	public function index(){
		$manage_available_day=$this->adminModel->get();
		$data = [
			'manage_available_day'=>$manage_available_day
		];
		$this->view('admins/manage_available_day/index', $data);
	}

	public function create(){
		$trains=$this->adminModel->getTrainId();
		
		$data = [
			'trains'=>$trains,
			'trainId'=>'',
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
			'trains'=>$trains,	
			'trainId'=>trim($_POST['trainId']),
			'sunday'=>trim($_POST['sunday']),
			'monday'=>trim($_POST['monday']),
			'tuesday'=>trim($_POST['tuesday']),
			'wednesday'=>trim($_POST['wednesday']),
			'thursday'=>trim($_POST['thursday']),
			'friday'=>trim($_POST['friday']),
			'saturday'=>trim($_POST['saturday']),
            'trainIdError'=>''
			];

			$status=$this->adminModel->getReservableStatus($data['trainId']);

            $nameValidation="/^[a-zA-Z0-9]*$/";


                if(empty($data['trainId'])){
                $data['trainId']='Please Enter the typeNo.';
                }elseif(!preg_match($nameValidation, $data['trainId'])){
                    $data['trainIdError']="Type can only contain letters and numbers.";
                }else{
                    //if moderatorID exists
                    if($this->adminModel->findTrainTypeByTrainId($data['trainId'])){
                        $data['trainIdError']='This Type is already registered in the system.'; 
                    }
                }

                if(empty($data['trainIdError']) ){

			if ($this->adminModel->create_available_day($data)) {
				if($status=='Yes'){
					header("Location: " . URLROOT . "/Admin_manage_compartments/create");
				}else{
					header("Location: " . URLROOT . "/Admin_manage_trains");
				}
				
			}else{
				die("Something Going Wrong");
			}
           }
		}

		$this->view('admins/manage_available_day/create', $data);

	}

	public function edit($trainId){

		$manage_available_day=$this->adminModel->findTrainId($trainId);
		$trains=$this->adminModel->getTrainId();

		$data = [
			'manage_available_day'=>$manage_available_day,
			'trains'=>$trains,	
			'trainId'=>'',
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
			'trains'=>$trains,	
			'trainId'=>$trainId,
			'sunday'=>trim($_POST['sunday']),
			'monday'=>trim($_POST['monday']),
			'tuesday'=>trim($_POST['tuesday']),
			'wednesday'=>trim($_POST['wednesday']),
			'thursday'=>trim($_POST['thursday']),
			'friday'=>trim($_POST['friday']),
			'saturday'=>trim($_POST['saturday']),
            'trainIdError'=>''			
            ];

            $nameValidation="/^[a-zA-Z]*$/";


                if(empty($data['trainId'])){
                $data['trainIdError']='Please Enter the Train ID.';
                }elseif(!preg_match($nameValidation, $data['trainId'])){
                    $data['trainIdError']="Type can only contain letters and numbers.";
                }else{
                    //if moderatorID exists
                    if($this->adminModel->findTrainTypeByTrainId($data['trainId'])){
                        $data['trainIdError']='This Type is already registered in the system.'; 
                    }
                }

                if(empty($data['trainIdError']) ){

			if ($this->adminModel->edit($data)) {
				header("Location: " . URLROOT . "/Admin_manage_available_days");
			}else{
				die("Something Going Wrong");
			}           
		}
	}
		$this->view('admins/manage_available_day/edit', $data);
	}

		public function views($trainId){

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

	public function delete($trainId){

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