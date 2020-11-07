<?php
class manage_ro extends Controller{
	public function __construct(){
		$this->postModel=$this->model('Manage_ros');
	}

	public function index(){
		$manage_ro=$this->postModel->get();
		$data = [
			'manage_ro'=>$manage_ro
		];
		$this->view('manage_ro/index', $data);
	}

	public function create(){
		$data = [
			'officerId'=>'',
			'employeeId'=>'',
			'firstname'=>'',
			'lastname'=>'',
			'email'=>'',
			'mobileno'=>'',
			'password'=>'',
			'reg_date'=>'',
            'reg_time'=>'',
			'officerIdError'=>'',
            'employeeIdError'=>'',
            'firstnameError'=>'',
            'lastnameError'=>'',
            'emailError'=>'',
            'mobilenoError'=>'',
            'passwordError'=>''
		];

		if($_SERVER['REQUEST_METHOD']=='POST'){
			$_POST=filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
			$data=[
			'officerId'=>trim($_POST['officerId']),	
			'employeeId'=>trim($_POST['employeeId']),			
			'firstname'=>trim($_POST['firstname']),
			'lastname'=>trim($_POST['lastname']),
			'email'=>trim($_POST['email']),
			'mobileno'=>trim($_POST['mobileno']),
			'password'=>trim($_POST['password']),
			'reg_date'=>date("Y-m-d"),
            'reg_time'=>date("H:i:sa"),
			'officerIdError'=>'',
            'employeeIdError'=>'',
            'firstnameError'=>'',
            'lastnameError'=>'',
            'emailError'=>'',
            'mobilenoError'=>'',
            'passwordError'=>'',
			];
            $idValidation="/^[a-zA-Z0-9]*$/";
            $nameValidation="/^[a-zA-Z]*$/";
            $mobileValidation="/^[0-9]{10}+$/";
            $passwordValidation= "/^(?=.*[a-z])(?=.*\\d).{8,}$/i";

                if(empty($data['officerId'])){
                $data['officerIdError']='Please Enter the Officer ID.';
                }elseif(!preg_match($idValidation, $data['officerId'])){
                    $data['officerIdError']="Officer ID can only contain letters and numbers.";
                }else{
                    //if moderatorID exists
                    if($this->postModel->findOfficerByOfficerId($data['officerId'])){
                        $data['officerIdError']='This ID is already registered as a Officer in the system.'; 
                    }
                }
                if(empty($data['employeeId'])){
                    $data['employeeIdError']='Please Enter the Employee ID.';
                }elseif(!preg_match($idValidation, $data['employeeId'])){
                    $data['employeeIdError']="Employee ID can only contain letters and numbers.";
                }else{
                    //if Employee ID exists
                    if($this->postModel->findOfficerByEmployeeId($data['employeeId'])){
                        $data['employeeIdError']='This employee is already registered as a Officer in the system.'; 
                    }
                }
                if(empty($data['firstname'])){
                    $data['firstnameError']='Please Enter the First Name.';
                }elseif(!preg_match($nameValidation, $data['firstname'])){
                    $data['firstnameError']="Name can only contain letters.";
                }
                if(empty($data['lastname'])){
                    $data['lastnameError']='Please Enter the Last Name.';
                }elseif(!preg_match($nameValidation, $data['lastname'])){
                    $data['lastnameError']="Name can only contain letters.";
                }
                if(empty($data['email'])){
                    $data['emailError']='Please Enter the Email address.';
                }elseif(!filter_var($data['email'], FILTER_VALIDATE_EMAIL)){
                    $data['emailError']='Please enter the correct format';
                }else{
                    //if email exists
                    if($this->postModel->findofficerByEmail($data['email'])){
                        $data['emailError']='email is already taken'; 
                    }
                }

                if(empty($data['mobileno'])){
                    $data['mobilenoError']='Please Enter the Mobile No.';
                }elseif(!preg_match($mobileValidation, $data['mobileno'])){
                    $data['mobilenoError']="Mobile No can only contain numbers and +.";
                }

                //password validate by length and numeric values
                if(empty($data['password'])){
                    $data['passwordError']='Please Enter the passsword.';
                }elseif (strlen($data['password'])<8) {
                    $data['passwordError']="Password length should be atleast 8 characters long";
                }elseif(!preg_match($passwordValidation, $data['password'])){
                    $data['passwordError']="Password must have atleast one numeric value.";
                }

                if(empty($data['officerIdError']) && empty($data['employeerIdError']) &&
                empty($data['firstnameError']) && empty($data['lastnameError']) && 
                empty($data['emailError']) && empty($data['mobilenoError']) &&
                empty($data['passwordError']) ){
                        //Hash passsword
                        $data['password']=password_hash($data['password'], PASSWORD_DEFAULT);
                        //Rgoster user from model function

			if ($this->postModel->create_ro($data)) {
				header("Location: " . URLROOT . "/manage_ro");
			}else{
				die("Something Going Wrong");
			}
           }
		}

		$this->view('manage_ro/create', $data);

	}

	public function edit($officerId){

		$manage_ro=$this->postModel->findEmployee($officerId);

		$data = [
			'manage_ro'=>$manage_ro,
			'officerId'=>'',
			'employeeId'=>'',
			'firstname'=>'',
			'lastname'=>'',
			'email'=>'',
			'mobileno'=>'',
			'password'=>'',
			'officerIdError'=>'',
            'employeeIdError'=>'',
            'firstnameError'=>'',
            'lastnameError'=>'',
            'emailError'=>'',
            'mobilenoError'=>'',
            'passwordError'=>''
		];

		if($_SERVER['REQUEST_METHOD']=='POST'){
			$_POST=filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
			$data=[
			'officerId'=>$officerId,	
			'employeeId'=>trim($_POST['employeeId']),			
			'firstname'=>trim($_POST['firstname']),
			'lastname'=>trim($_POST['lastname']),
			'email'=>trim($_POST['email']),
			'mobileno'=>trim($_POST['mobileno']),
			'password'=>trim($_POST['password']),
			'officerIdError'=>'',
            'employeeIdError'=>'',
            'firstnameError'=>'',
            'lastnameError'=>'',
            'emailError'=>'',
            'mobilenoError'=>'',
            'passwordError'=>'',
			];

            $idValidation="/^[a-zA-Z0-9]*$/";
            $nameValidation="/^[a-zA-Z]*$/";
            $mobileValidation="/^[0-9]{10}+$/";
            $passwordValidation= "/^(?=.*[a-z])(?=.*\\d).{8,}$/i";

                if(empty($data['employeeId'])){
                    $data['employeeIdError']='Please Enter the Employee ID.';
                }elseif(!preg_match($idValidation, $data['employeeId'])){
                    $data['employeeIdError']="Employee ID can only contain letters and numbers.";
                }else{
                    //if Employee ID exists
                    if($this->postModel->findOfficerByEmployeeId($data['employeeId'])){
                        $data['employeeIdError']='This employee is already registered as a Officer in the system.'; 
                    }
                }
                if(empty($data['firstname'])){
                    $data['firstnameError']='Please Enter the First Name.';
                }elseif(!preg_match($nameValidation, $data['firstname'])){
                    $data['firstnameError']="Name can only contain letters.";
                }
                if(empty($data['lastname'])){
                    $data['lastnameError']='Please Enter the Last Name.';
                }elseif(!preg_match($nameValidation, $data['lastname'])){
                    $data['lastnameError']="Name can only contain letters.";
                }
                if(empty($data['email'])){
                    $data['emailError']='Please Enter the Email address.';
                }elseif(!filter_var($data['email'], FILTER_VALIDATE_EMAIL)){
                    $data['emailError']='Please enter the correct format';
                }else{
                    //if email exists
                    if($this->postModel->findofficerByEmail($data['email'])){
                        $data['emailError']='email is already taken'; 
                    }
                }

                if(empty($data['mobileno'])){
                    $data['mobilenoError']='Please Enter the Mobile No.';
                }elseif(!preg_match($mobileValidation, $data['mobileno'])){
                    $data['mobilenoError']="Mobile No can only contain numbers and +.";
                }

                //password validate by length and numeric values
                if(empty($data['password'])){
                    $data['passwordError']='Please Enter the passsword.';
                }elseif (strlen($data['password'])<8) {
                    $data['passwordError']="Password length should be atleast 8 characters long";
                }elseif(!preg_match($passwordValidation, $data['password'])){
                    $data['passwordError']="Password must have atleast one numeric value.";
                }

                if(empty($data['employeerIdError']) && empty($data['firstnameError']) && empty($data['lastnameError']) && 
                empty($data['emailError']) && empty($data['mobilenoError']) &&
                empty($data['passwordError']) ){
                        //Hash passsword
                        $data['password']=password_hash($data['password'], PASSWORD_DEFAULT);
                        //Rgoster user from model function

			if ($this->postModel->edit($data)) {
				header("Location: " . URLROOT . "/manage_ro");
			}else{
				die("Something Going Wrong");
			}           
		}
	}
		$this->view('manage_ro/edit', $data);
	}

		public function views($officerId){

		$manage_ro=$this->postModel->findEmployee($officerId);

		$data = [
			'manage_ro'=>$manage_ro,
			'officerId'=>'',
			'employeeId'=>'',
			'password'=>'',
			'email'=>'',
			'firstname'=>'',
			'lastname'=>'',
			'mobileno'=>'',
			'reg_date'=>'',
            'reg_time'=>''
		];

		if($_SERVER['REQUEST_METHOD']=='POST'){
			$_POST=filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
			$data=[
			'officerId'=>$officerId,	
			'employeeId'=>trim($_POST['employeeId']),
			'password'=>trim($_POST['password']),
			'email'=>trim($_POST['email']),
			'firstname'=>trim($_POST['firstname']),
			'lastname'=>trim($_POST['lastname']),
			'mobileno'=>trim($_POST['mobileno']),
			'reg_date'=>trim($_POST['reg_date']),
			'reg_time'=>trim($_POST['reg_time'])
			];
			if ($this->postModel->views($data)) {
				header("Location: " . URLROOT . "/manage_ro");
			}else{
				die("Something Going Wrong");
			}           
		}
		$this->view('manage_ro/views', $data);
	}

	public function delete($officerId){

		$manage_ro=$this->postModel->findEmployee($officerId);

		$data = [
			'manage_ro'=>$manage_ro,
			'officerId'=>'',
			'employeeId'=>'',
			'password'=>'',
			'email'=>'',
			'firstname'=>'',
			'lastname'=>'',
			'mobileno'=>'',
			'reg_date'=>'',
            'reg_time'=>''
		];

		if($_SERVER['REQUEST_METHOD']=='POST'){
			$_POST=filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
		if($this->postModel->delete($officerId)){
			header("Location: " . URLROOT . "/manage_ro");
		}
		else{
			die('Something Going Wrong');
		}
	}
	}
}	