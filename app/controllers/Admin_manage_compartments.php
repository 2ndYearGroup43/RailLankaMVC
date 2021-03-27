<?php
class Admin_manage_compartments extends Controller{
	public function __construct(){
		isAdminLoggedIn();
		$this->adminModel=$this->model('Admin_manage_compartment');
	}

	public function index(){
		$manage_compartment=$this->adminModel->get();
		$data = [
			'manage_compartment'=>$manage_compartment
		];
		$this->view('admins/manage_compartment/index', $data);
	}

	public function create($trainId){
		$types=$this->adminModel->getType();
		$data = [
			'types'=>$types,
			'trainId'=>$trainId,
			'compartmentError'=>'',
			'compartments'=>''
		];

		if($_SERVER['REQUEST_METHOD']=='POST'){
			$a=json_decode($_POST['compartmentField']);
			$_POST=filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
			
			
			$data=[
			'types'=>$types,
			'trainId'=>$trainId,
			'compartmentError'=>'',
			'compartments'=>$a
			];

			if(empty($data['compartments'])){
				$data['compartmentError']="Please enter at least one compartment";
			}
            
            if(empty($data['compartmentError'])){
				if ($this->adminModel->create_compartment($data)) {
					header("Location: " . URLROOT . "/Admin_manage_trains");
				}else{
					die("Something went Wrong");
				}
			}
		}

		
		$this->view('admins/manage_compartment/create', $data);
	}


	public function viewCompartments($trainId)
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

		
		$this->view('admins/manage_compartment/viewCompartments', $data);
	}
	

	public function editSingle($trainId, $cno)
	{
		$compartment=$this->adminModel->getCompartment($trainId,$cno);
		$manage_compartment=$this->adminModel->findTrain($trainId);
		$types=$this->adminModel->getType();
		
		$data = [
			'manage_compartment'=>$manage_compartment,
			'types'=>$types,
			'trainId'=>$trainId,
			'compartment'=>$compartment,
			'compartmentNo'=>$compartment->compartmentNo,
			'class'=>$compartment->class,
			'type'=>$compartment->type,
			'trainIdError'=>'',
            'compartmentNoError'=>'',
            'classError'=>'',
            'typeError'=>''
		];

		if($_SERVER['REQUEST_METHOD']=='POST'){
			$_POST=filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
			$data=[
			'manage_compartment'=>$manage_compartment,
			'types'=>$types,
			'trainId'=>$trainId,
			'compartment'=>$compartment,	
			'compartmentNo'=>trim($_POST['compartmentNo']),			
			'class'=>trim($_POST['class']),
			'type'=>trim($_POST['type']),
			'trainIdError'=>'',
            'compartmentNoError'=>'',
            'classError'=>'',
            'typeError'=>''
			];


            $nameValidation="/^[a-zA-Z]*$/";
            $numberValidation="/^[0-9]*$/";

		    if(empty($data['compartmentNo'])){
                $data['compartmentNoError']='Please Enter the Compartment No.';
            }elseif(!preg_match($numberValidation, $data['compartmentNo'])){
                $data['compartmentNoError']="Compartment No can only contain letters and numbers.";
            }elseif($compartment->compartmentNo!=$data['compartmentNo']){
                if($this->adminModel->findCompartmentByCompartmentNo($trainId, $data['compartmentNo'])){
                    $data['compartmentNoError']='This compartment is already registered as a compartment in the system.'; 
                }
            }
            if(empty($data['class'])){
                $data['classError']='Please Enter the Class.';
            }
            
            if(empty($data['type'])){
                $data['typeError']='Please Enter the Type.';
            }
            
            if(empty($data['compartmentNoError']) &&
                empty($data['classError']) &&  empty($data['typeError']) ){

            	if ($this->adminModel->editSingle($data)) {
				    header("Location: " . URLROOT . "/Admin_manage_compartments/viewCompartments/". $trainId);
			    }else{
				    die("Something Going Wrong");
			    }  
            }
        }
		$this->view('admins/manage_compartment/editSingle', $data);
	}

	public function edit($trainId){

		$manage_compartment=$this->adminModel->findTrain($trainId);
		$types=$this->adminModel->getType();
		$compartments=$this->adminModel->getCompartments($trainId);

		$data = [
			'manage_compartment'=>$manage_compartment,
			'types'=>$types,
			'trainId'=>$trainId,
			'compartments'=>$compartments,
			'compartmentNo'=>'',
			'class'=>'',
			'type'=>'',
			'trainIdError'=>'',
            'compartmentNoError'=>'',
            'classError'=>'',
            'typeError'=>''
		];

		if($_SERVER['REQUEST_METHOD']=='POST'){
			$_POST=filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
			$data=[
			'manage_compartment'=>$manage_compartment,
			'types'=>$types,
			'trainId'=>$trainId,
			'compartments'=>$compartments,	
			'compartmentNo'=>trim($_POST['compartmentNo']),			
			'class'=>trim($_POST['class']),
			'type'=>trim($_POST['type']),
			'trainIdError'=>'',
            'compartmentNoError'=>'',
            'classError'=>'',
            'typeError'=>''
			];

            $idValidation="/^[a-zA-Z0-9]*$/";
            $nameValidation="/^[a-zA-Z]*$/";
            $numberValidation="/^[0-9]*$/";


                if(empty($data['compartmentNo'])){
                    $data['compartmentNoError']='Please Enter the Compartment No.';
                }elseif(!preg_match($idValidation, $data['compartmentNo'])){
                    $data['compartmentNoError']="Compartment No can only contain letters and numbers.";
                }else{
                    if($this->adminModel->findCompartmentByCompartmentNo($data['compartmentNo'])){
                        $data['compartmentNoError']='This compartment is already registered as a compartment in the system.'; 
                    }
                }
                if(empty($data['class'])){
                    $data['classError']='Please Enter the Class.';
                }elseif(!preg_match($nameValidation, $data['class'])){
                    $data['classError']="Class can only contain letters.";
                }

                if(empty($data['type'])){
                    $data['typeError']='Please Enter the Type.';
                }elseif(!preg_match($numberValidation, $data['compartmentNo'])){
                    $data['typeError']="Type can only contain letters and numbers.";
                }else{

                    if($this->adminModel->findCompartmentByType($data['type'])){
                        $data['typeError']='This compartment is already registered as a compartment in the system.'; 
                    }
                }

                if(empty($data['trainIdError']) && empty($data['compartmentNoError']) &&
                empty($data['classError']) && empty($data['typeError']) ){

			if ($this->adminModel->edit($data)) {
				header("Location: " . URLROOT . "/Admin_manage_compartments");
			}else{
				die("Something Going Wrong");
			}           
		}
	}
		$this->view('admins/manage_compartment/edit', $data);
	}

		public function views($trainId, $typeNo){

		$manage_compartment=$this->adminModel->findTrain($trainId);
		$noofseats=$this->adminModel->getNoofSeats($typeNo);

		$data = [
			'manage_compartment'=>$manage_compartment,
			'noofseats'=>$noofseats,
			'trainId'=>'',
			'compartmentNo'=>'',
			'class'=>'',
			'type'=>''
		];

		if($_SERVER['REQUEST_METHOD']=='POST'){
			$_POST=filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
			$data=[
			'trainId'=>$trainId,	
			'compartmentNo'=>trim($_POST['compartmentNo']),			
			'class'=>trim($_POST['class']),
			'type'=>trim($_POST['type'])
			];
			if ($this->adminModel->views($data)) {
				header("Location: " . URLROOT . "/Admin_manage_compartments");
			}else{
				die("Something Going Wrong");
			}           
		}
		$this->view('admins/manage_compartment/views', $data);
	}

	public function delete($compartmentNo, $trainId){

		$manage_compartment=$this->adminModel->findTrain($trainId);

		$data = [
			'manage_compartment'=>$manage_compartment,
			'trainId'=>'trainId',
			'compartmentNo'=>'',
			'class'=>'',
			'type'=>''
		];

		if($_SERVER['REQUEST_METHOD']=='POST'){
			$_POST=filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
		if($this->adminModel->delete($compartmentNo, $trainId)){
			header("Location: " . URLROOT . "/Admin_manage_compartments/viewCompartments/" . $trainId);
		}
		else{
			die('Something Going Wrong');
		}
	}
	}

	public function addNewCompartment($trainId){
		$types=$this->adminModel->getType();
        $compartments=$this->adminModel->getCompartments($trainId);

        $data = [
			'types'=>$types,
			'trainId'=>$trainId,
			'compartmentError'=>'',
            'currentCompartments'=>$compartments,
			'compartments'=>''
		];

		if($_SERVER['REQUEST_METHOD']=='POST'){
			$a=json_decode($_POST['compartmentField']);
			$_POST=filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
			
			
			$data=[
                'types'=>$types,
                'trainId'=>$trainId,
                'compartmentError'=>'',
                'currentCompartments'=>$compartments,
                'compartments'=>$a
			];

			if(empty($data['compartments'])){
				$data['compartmentError']="Please enter at least one compartment";
			}
            
            if(empty($data['compartmentError'])){
				if ($this->adminModel->create_compartment($data)) {
					header("Location: " . URLROOT . "/Admin_manage_compartments/viewCompartments/". $trainId);
				}else{
					die("Something went Wrong");
				}
			}
		}

		
		$this->view('admins/manage_compartment/addNewCompartment', $data);
	}
}	