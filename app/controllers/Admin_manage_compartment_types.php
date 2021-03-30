<?php
class Admin_manage_compartment_types extends Controller{
	public function __construct(){
                isAdminLoggedIn();
		$this->adminModel=$this->model('Admin_manage_compartment_type');
	}

	public function index(){ // index function
		$manage_compartment_type=$this->adminModel->get();
		$data = [
			'manage_compartment_type'=>$manage_compartment_type
		];
		$this->view('admins/manage_compartment_type/index', $data);
	}

	public function create(){ // add compartments types
		$data = [
			'typeNo'=>'',
			'imageDir'=>'',
            'typeNoError'=>''
		];

		if($_SERVER['REQUEST_METHOD']=='POST'){
			$_POST=filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
			$data=[
			'typeNo'=>trim($_POST['typeNo']),
			'imageDir'=>trim($_POST['imageDir']),
            'typeNoError'=>''
			];

            $nameValidation="/^[a-zA-Z0-9]*$/";


                if(empty($data['typeNo'])){
                $data['typeNoError']='Please Enter the typeNo.';
                }elseif(!preg_match($nameValidation, $data['typeNo'])){
                    $data['typeNoError']="Type can only contain letters and numbers.";
                }else{

                    if($this->adminModel->findCompartmentTypeByTypeNo($data['typeNo'])){
                        $data['typeNoError']='This Type is already registered in the system.'; 
                    }
                }

                if(empty($data['typeNoError']) ){

			if ($this->adminModel->create_compartment_type($data)) {
				header("Location: " . URLROOT . "/Admin_manage_compartment_types");
			}else{
				die("Something Going Wrong");
			}
           }
		}

		$this->view('admins/manage_compartment_type/create', $data);

	}

		public function views($typeNo){ // view compartment type

		$manage_compartment_type=$this->adminModel->findCompartmentType($typeNo);

		$data = [
			'manage_compartment_type'=>$manage_compartment_type,
			'typeNo'=>'',
			'imageDir'=>'',
			'noofseats'=>''
			
		];

		if($_SERVER['REQUEST_METHOD']=='POST'){
			$_POST=filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
			$data=[
			'typeNo'=>$typeNo,
			'imageDir'=>trim($_POST['imageDir']),
			'noofseats'=>trim($_POST['noofseats']),
			];
			if ($this->adminModel->views($data)) {
				header("Location: " . URLROOT . "/Admin_manage_compartment_types");
			}else{
				die("Something Going Wrong");
			}           
		}
		$this->view('admins/manage_compartment_type/views', $data);
	}
}	