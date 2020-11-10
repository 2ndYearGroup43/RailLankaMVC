<?php
class manage_available_day extends Controller{
	public function __construct(){
		$this->postModel=$this->model('Manage_available_days');
	}

	public function index(){
		$manage_available_day=$this->postModel->get();
		$data = [
			'manage_available_day'=>$manage_available_day
		];
		$this->view('manage_available_day/index', $data);
	}

	public function create(){
		$data = [
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

            $nameValidation="/^[a-zA-Z0-9]*$/";


                if(empty($data['trainId'])){
                $data['trainId']='Please Enter the typeNo.';
                }elseif(!preg_match($nameValidation, $data['trainId'])){
                    $data['trainIdError']="Type can only contain letters and numbers.";
                }else{
                    //if moderatorID exists
                    if($this->postModel->findTrainTypeByTrainId($data['trainId'])){
                        $data['trainIdError']='This Type is already registered in the system.'; 
                    }
                }

                if(empty($data['trainIdError']) ){

			if ($this->postModel->create_available_day($data)) {
				header("Location: " . URLROOT . "/manage_available_day");
			}else{
				die("Something Going Wrong");
			}
           }
		}

		$this->view('manage_available_day/create', $data);

	}

	public function edit($trainId){

		$manage_available_day=$this->postModel->findTrainId($trainId);

		$data = [
			'manage_available_day'=>$manage_available_day,
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
                    if($this->postModel->findTrainTypeByTrainId($data['trainId'])){
                        $data['trainIdError']='This Type is already registered in the system.'; 
                    }
                }

                if(empty($data['trainIdError']) ){

			if ($this->postModel->edit($data)) {
				header("Location: " . URLROOT . "/manage_available_day");
			}else{
				die("Something Going Wrong");
			}           
		}
	}
		$this->view('manage_available_day/edit', $data);
	}

		public function views($trainId){

		$manage_available_day=$this->postModel->findTrainId($trainId);

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
			if ($this->postModel->views($data)) {
				header("Location: " . URLROOT . "/manage_available_day");
			}else{
				die("Something Going Wrong");
			}           
		}
		$this->view('manage_available_day/views', $data);
	}

	public function delete($trainId){

		$manage_available_day=$this->postModel->findTrainId($trainId);

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
		if($this->postModel->delete($trainId)){
			header("Location: " . URLROOT . "/manage_available_day");
		}
		else{
			die('Something Going Wrong');
		}
	}
	}
}	