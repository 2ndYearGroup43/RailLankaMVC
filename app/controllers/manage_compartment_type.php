<?php
class manage_compartment_type extends Controller{
	public function __construct(){
		$this->postModel=$this->model('Manage_compartment_types');
	}

	public function index(){
		$manage_compartment_type=$this->postModel->get();
		$data = [
			'manage_compartment_type'=>$manage_compartment_type
		];
		$this->view('manage_compartment_type/index', $data);
	}

	public function create(){
		$data = [
			'typeNo'=>'',
            'typeNoError'=>''
		];

		if($_SERVER['REQUEST_METHOD']=='POST'){
			$_POST=filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
			$data=[
			'typeNo'=>trim($_POST['typeNo']),
            'typeNoError'=>''
			];

            $nameValidation="/^[a-zA-Z0-9]*$/";


                if(empty($data['typeNo'])){
                $data['typeNoError']='Please Enter the typeNo.';
                }elseif(!preg_match($nameValidation, $data['typeNo'])){
                    $data['typeNoError']="Type can only contain letters and numbers.";
                }else{
                    //if moderatorID exists
                    if($this->postModel->findCompartmentTypeByTypeNo($data['typeNo'])){
                        $data['typeNoError']='This Type is already registered in the system.'; 
                    }
                }

                if(empty($data['typeNoError']) ){

			if ($this->postModel->create_compartment_type($data)) {
				header("Location: " . URLROOT . "/manage_compartment_type");
			}else{
				die("Something Going Wrong");
			}
           }
		}

		$this->view('manage_compartment_type/create', $data);

	}

	public function edit($typeNo){

		$manage_compartment_type=$this->postModel->findCompartmentType($typeNo);

		$data = [
			'manage_compartment_type'=>$manage_compartment_type,
			'typeNo'=>''

		];

		if($_SERVER['REQUEST_METHOD']=='POST'){
			$_POST=filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
			$data=[
			'manage_compartment_type'=>$manage_compartment_type,	
			'typeNo'=>$typeNo,	
			];

            $nameValidation="/^[a-zA-Z]*$/";


                if(empty($data['typeNo'])){
                $data['typeNoError']='Please Enter the Train ID.';
                }elseif(!preg_match($nameValidation, $data['typeNo'])){
                    $data['typeNoError']="Type can only contain letters and numbers.";
                }else{
                    //if moderatorID exists
                    if($this->postModel->findCompartmentTypeByTypeNo($data['typeNo'])){
                        $data['typeNoError']='This Type is already registered in the system.'; 
                    }
                }

                if(empty($data['typeNoError']) ){

			if ($this->postModel->edit($data)) {
				header("Location: " . URLROOT . "/manage_compartment_type");
			}else{
				die("Something Going Wrong");
			}           
		}
	}
		$this->view('manage_compartment_type/edit', $data);
	}

		public function views($typeNo){

		$manage_compartment_type=$this->postModel->findCompartmentType($typeNo);

		$data = [
			'manage_compartment_type'=>$manage_compartment_type,
			'typeNo'=>''
		];

		if($_SERVER['REQUEST_METHOD']=='POST'){
			$_POST=filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
			$data=[
			'typeNo'=>$typeNo
			];
			if ($this->postModel->views($data)) {
				header("Location: " . URLROOT . "/manage_compartment_type");
			}else{
				die("Something Going Wrong");
			}           
		}
		$this->view('manage_compartment_type/views', $data);
	}

	public function delete($typeNo){

		$manage_compartment_type=$this->postModel->findCompartmentType($typeNo);

		$data = [
			'manage_compartment_type'=>$manage_compartment_type,
			'typeNo'=>''
		];

		if($_SERVER['REQUEST_METHOD']=='POST'){
			$_POST=filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
		if($this->postModel->delete($typeNo)){
			header("Location: " . URLROOT . "/manage_compartment_type");
		}
		else{
			die('Something Going Wrong');
		}
	}
	}
}	