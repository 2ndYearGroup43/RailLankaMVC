<?php
class manage_compartment extends Controller{
	public function __construct(){
		$this->postModel=$this->model('Manage_compartments');
	}

	public function index(){
		$manage_compartment=$this->postModel->get();
		$data = [
			'manage_compartment'=>$manage_compartment
		];
		$this->view('manage_compartment/index', $data);
	}

	public function create(){
		$data = [
			'trainId'=>'',
			'compartmentNo'=>'',
			'class'=>'',
			'noofseats'=>'',
			'type'=>'',
			'trainIdError'=>'',
            'compartmentNoError'=>'',
            'classError'=>'',
            'noofseatsError'=>'',
            'typeError'=>''
		];

		if($_SERVER['REQUEST_METHOD']=='POST'){
			$_POST=filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
			$data=[
			'trainId'=>trim($_POST['trainId']),	
			'compartmentNo'=>trim($_POST['compartmentNo']),			
			'class'=>trim($_POST['class']),
			'noofseats'=>trim($_POST['noofseats']),
			'type'=>trim($_POST['type']),
			'trainIdError'=>'',
            'compartmentNoError'=>'',
            'classError'=>'',
            'noofseatsError'=>'',
            'typeError'=>''
			];
            $idValidation="/^[a-zA-Z0-9]*$/";
            $nameValidation="/^[a-zA-Z]*$/";
            $numberValidation="/^[0-9]*$/";

                if(empty($data['trainId'])){
                $data['trainIdError']='Please Enter the Train ID.';
                }elseif(!preg_match($idValidation, $data['trainId'])){
                    $data['trainIdError']="Officer ID can only contain letters and numbers.";
                }else{
                    //if moderatorID exists
                    if($this->postModel->findTrainByTrainId($data['trainId'])){
                        $data['trainIdError']='This ID is already registered as a Officer in the system.'; 
                    }
                }
                if(empty($data['compartmentNo'])){
                    $data['compartmentNoError']='Please Enter the Compartment No.';
                }elseif(!preg_match($idValidation, $data['compartmentNo'])){
                    $data['compartmentNoError']="Compartment No can only contain letters and numbers.";
                }else{
                    //if Employee ID exists
                    if($this->postModel->findCompartmentByCompartmentNo($data['compartmentNo'])){
                        $data['compartmentNoError']='This compartment is already registered as a compartment in the system.'; 
                    }
                }
                if(empty($data['class'])){
                    $data['classError']='Please Enter the First Name.';
                }elseif(!preg_match($nameValidation, $data['class'])){
                    $data['classError']="Class can only contain letters.";
                }
                if(empty($data['noofseats'])){
                    $data['noofseatsError']='Please Enter the Last Name.';
                }elseif(!preg_match($numberValidation, $data['noofseats'])){
                    $data['noofseatsError']="Number of Seats can only contain numbers.";
                }
                if(empty($data['type'])){
                    $data['typeError']='Please Enter the Compartment No.';
                }elseif(!preg_match($numberValidation, $data['compartmentNo'])){
                    $data['typeError']="Type can only contain letters and numbers.";
                }else{
                    //if Employee ID exists
                    if($this->postModel->findCompartmentByType($data['type'])){
                        $data['typeError']='This compartment is already registered as a compartment in the system.'; 
                    }
                }

                if(empty($data['trainIdError']) && empty($data['compartmentNoError']) &&
                empty($data['classError']) && empty($data['noofseatsError']) && 
                empty($data['typeError']) ){

			if ($this->postModel->create_compartment($data)) {
				header("Location: " . URLROOT . "/manage_compartment");
			}else{
				die("Something Going Wrong");
			}
           }
		}

		$this->view('manage_compartment/create', $data);

	}

	public function edit($trainId){

		$manage_compartment=$this->postModel->findTrain($trainId);

		$data = [
			'manage_compartment'=>$manage_compartment,
			'trainId'=>'',
			'compartmentNo'=>'',
			'class'=>'',
			'noofseats'=>'',
			'type'=>'',
			'trainIdError'=>'',
            'compartmentNoError'=>'',
            'classError'=>'',
            'noofseatsError'=>'',
            'typeError'=>''
		];

		if($_SERVER['REQUEST_METHOD']=='POST'){
			$_POST=filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
			$data=[
			'trainId'=>$trainId,	
			'compartmentNo'=>trim($_POST['compartmentNo']),			
			'class'=>trim($_POST['class']),
			'noofseats'=>trim($_POST['noofseats']),
			'type'=>trim($_POST['type']),
			'trainIdError'=>'',
            'compartmentNoError'=>'',
            'classError'=>'',
            'noofseatsError'=>'',
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
                    //if Employee ID exists
                    if($this->postModel->findCompartmentByCompartmentNo($data['compartmentNo'])){
                        $data['compartmentNoError']='This compartment is already registered as a compartment in the system.'; 
                    }
                }
                if(empty($data['class'])){
                    $data['classError']='Please Enter the First Name.';
                }elseif(!preg_match($nameValidation, $data['class'])){
                    $data['classError']="Class can only contain letters.";
                }
                if(empty($data['noofseats'])){
                    $data['noofseatsError']='Please Enter the Last Name.';
                }elseif(!preg_match($numberValidation, $data['noofseats'])){
                    $data['noofseatsError']="Number of Seats can only contain numbers.";
                }
                if(empty($data['type'])){
                    $data['typeError']='Please Enter the Compartment No.';
                }elseif(!preg_match($numberValidation, $data['compartmentNo'])){
                    $data['typeError']="Type can only contain letters and numbers.";
                }else{
                    //if Employee ID exists
                    if($this->postModel->findCompartmentByType($data['type'])){
                        $data['typeError']='This compartment is already registered as a compartment in the system.'; 
                    }
                }

                if(empty($data['trainIdError']) && empty($data['compartmentNoError']) &&
                empty($data['classError']) && empty($data['noofseatsError']) && 
                empty($data['typeError']) ){

			if ($this->postModel->edit($data)) {
				header("Location: " . URLROOT . "/manage_compartment");
			}else{
				die("Something Going Wrong");
			}           
		}
	}
		$this->view('manage_compartment/edit', $data);
	}

		public function views($trainId){

		$manage_compartment=$this->postModel->findTrain($trainId);

		$data = [
			'manage_compartment'=>$manage_compartment,
			'trainId'=>'',
			'compartmentNo'=>'',
			'class'=>'',
			'noofseats'=>'',
			'type'=>''
		];

		if($_SERVER['REQUEST_METHOD']=='POST'){
			$_POST=filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
			$data=[
			'trainId'=>$trainId,	
			'compartmentNo'=>trim($_POST['compartmentNo']),			
			'class'=>trim($_POST['class']),
			'noofseats'=>trim($_POST['noofseats']),
			'type'=>trim($_POST['type'])
			];
			if ($this->postModel->views($data)) {
				header("Location: " . URLROOT . "/manage_compartment");
			}else{
				die("Something Going Wrong");
			}           
		}
		$this->view('manage_compartment/views', $data);
	}

	public function delete($trainId){

		$manage_compartment=$this->postModel->findTrain($trainId);

		$data = [
			'manage_compartment'=>$manage_compartment,
			'trainId'=>'',
			'compartmentNo'=>'',
			'class'=>'',
			'noofseats'=>'',
			'type'=>''
		];

		if($_SERVER['REQUEST_METHOD']=='POST'){
			$_POST=filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
		if($this->postModel->delete($trainId)){
			header("Location: " . URLROOT . "/manage_compartment");
		}
		else{
			die('Something Going Wrong');
		}
	}
	}
}	