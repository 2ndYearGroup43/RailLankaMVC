<?php
class Admin_manage_fares extends Controller{
	public function __construct(){
                isAdminLoggedIn();
		$this->adminModel=$this->model('Admin_manage_fare');
	}

	public function index(){
		$manage_fare=$this->adminModel->get();
		$data = [
			'manage_fare'=>$manage_fare
		];
		$this->view('admins/manage_fare/index', $data);
	}

	public function create(){
		$data = [
			'fclassbase'=>'',
			'sclassbase'=>'',
			'tclassbase'=>'',
            'fclassnormalbase'=>'',
            'sclassnormalbase'=>'',
            'tclassnormalbase'=>'',
            'distance'=>'',
			'rate'=>'',
			'rateIDError'=>'',
            'fclassbaseError'=>'',
            'sclassbaseError'=>'',
            'tclassbaseError'=>'',
            'fclassnormalbaseError'=>'',
            'sclassnormalbaseError'=>'',
            'tclassnormalbaseError'=>'',
            'distanceError'=>'',
            'rateError'=>''
		];

		if($_SERVER['REQUEST_METHOD']=='POST'){
			$_POST=filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
			$data=[
			'fclassbase'=>trim($_POST['fclassbase']),
			'sclassbase'=>trim($_POST['sclassbase']),
			'tclassbase'=>trim($_POST['tclassbase']),
            'fclassnormalbase'=>trim($_POST['fclassnormalbase']),
            'sclassnormalbase'=>trim($_POST['sclassnormalbase']),
            'tclassnormalbase'=>trim($_POST['tclassnormalbase']),
			'distance'=>trim($_POST['distance']),
			'rate'=>trim($_POST['rate']),
			'rateIDError'=>'',
            'fclassbaseError'=>'',
            'sclassbaseError'=>'',
            'tclassbaseError'=>'',
            'fclassnormalbaseError'=>'',
            'sclassnormalbaseError'=>'',
            'tclassnormalbaseError'=>'',
            'distanceError'=>'',
            'rateError'=>''
			];
            $idValidation="/^[a-zA-Z0-9]*$/";
            $numberValidation="/^[a-zA-Z0-9]*$/";


                if(empty($data['fclassbase'])){
                    $data['fclassbaseError']='Please Enter the First Class.';
                }elseif(!preg_match($numberValidation, $data['fclassbase'])){
                    $data['fclassbaseError']="First Class can only contain letters.";
                }
                if(empty($data['sclassbase'])){
                    $data['sclassbaseError']='Please Enter the Second Class.';
                }elseif(!preg_match($numberValidation, $data['sclassbase'])){
                    $data['sclassbaseError']="Second Class can only contain letters.";
                }
                if(empty($data['tclassbase'])){
                    $data['tclassbaseError']='Please Enter the Third Class.';
                }elseif(!preg_match($numberValidation, $data['tclassbase'])){
                    $data['tclassbaseError']="Third Class can only contain letters.";
                }

                if(empty($data['fclassnormalbase'])){
                    $data['fclassnormalbaseError']='Please Enter the First Class.';
                }elseif(!preg_match($numberValidation, $data['fclassnormalbase'])){
                    $data['fclassnormalbaseError']="First Class can only contain letters.";
                }
                if(empty($data['sclassnormalbase'])){
                    $data['sclassnormalbaseError']='Please Enter the Second Class.';
                }elseif(!preg_match($numberValidation, $data['sclassnormalbase'])){
                    $data['sclassnormalbaseError']="Second Class can only contain letters.";
                }
                if(empty($data['tclassnormalbase'])){
                    $data['tclassnormalbaseError']='Please Enter the Third Class.';
                }elseif(!preg_match($numberValidation, $data['tclassnormalbase'])){
                    $data['tclassnormalbaseError']="Third Class can only contain letters.";
                }


                if(empty($data['distance'])){
                    $data['distanceError']='Please Enter the Distance.';
                }elseif(!preg_match($numberValidation, $data['distance'])){
                    $data['distanceError']="Distance can only contain numbers";
                }
                if(empty($data['rate'])){
                    $data['rateError']='Please Enter the Rate.';
                }elseif(!preg_match($numberValidation, $data['rate'])){
                    $data['rateError']="Rate can only contain numbers";
                }



                if(empty($data['fclassbaseError']) &&
                empty($data['sclassbaseError']) && empty($data['tclassbaseError']) && 
                empty($data['distanceError']) && empty($data['rateError']) && empty($data['fclassnormalbaseError']) &&
                empty($data['sclassnormalbaseError']) && empty($data['tclassnormalbaseError']) ){
                        
			if ($this->adminModel->create_fare($data)) {
				header("Location: " . URLROOT . "/Admin_manage_fares");
			}else{
				die("Something Going Wrong");
			}
           }
		}

		$this->view('admins/manage_fare/create', $data);

	}

	public function edit($rateID){

		$manage_fare=$this->adminModel->findFare($rateID);

		$data = [
			'manage_fare'=>$manage_fare,
			'rateID'=>'',
            'fclassbase'=>'',
            'sclassbase'=>'',
            'tclassbase'=>'',
            'fclassnormalbase'=>'',
            'sclassnormalbase'=>'',
            'tclassnormalbase'=>'',
            'distance'=>'',
            'rate'=>'',
            'rateIDError'=>'',
            'fclassbaseError'=>'',
            'sclassbaseError'=>'',
            'tclassbaseError'=>'',
            'fclassnormalbaseError'=>'',
            'sclassnormalbaseError'=>'',
            'tclassnormalbaseError'=>'',
            'distanceError'=>'',
            'rateError'=>''
		];

		if($_SERVER['REQUEST_METHOD']=='POST'){
			$_POST=filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
			$data=[
            'manage_fare'=>$manage_fare,    
			'rateID'=>$rateID,	
			'fclassbase'=>trim($_POST['fclassbase']),            
            'sclassbase'=>trim($_POST['sclassbase']),
            'tclassbase'=>trim($_POST['tclassbase']),
            'fclassnormalbase'=>trim($_POST['fclassnormalbase']),
            'sclassnormalbase'=>trim($_POST['sclassnormalbase']),
            'tclassnormalbase'=>trim($_POST['tclassnormalbase']),
            'distance'=>trim($_POST['distance']),
            'rate'=>trim($_POST['rate']),
            'rateIDError'=>'',
            'fclassbaseError'=>'',
            'sclassbaseError'=>'',
            'tclassbaseError'=>'',
            'fclassnormalbaseError'=>'',
            'sclassnormalbaseError'=>'',
            'tclassnormalbaseError'=>'',
            'distanceError'=>'',
            'rateError'=>''
			];
            $idValidation="/^[a-zA-Z0-9]*$/";
            $numberValidation="/^[0-9]*$/";
            $decimalNumberValidation="/^[0-9]*[.][0-9]{0,4}$/";

                if(empty($data['rateID'])){
                $data['rateIDError']='Please Enter the Rate ID.';
                }

                if(empty($data['fclassbase'])){
                    $data['fclassbaseError']='Please Enter the First Class.';
                }

                if(empty($data['sclassbase'])){
                    $data['sclassbaseError']='Please Enter the Second Class.';
                }

                if(empty($data['tclassbase'])){
                    $data['tclassbaseError']='Please Enter the Third Class.';
                }

                if(empty($data['fclassnormalbase'])){
                    $data['fclassnormalbaseError']='Please Enter the First Class.';
                }
                if(empty($data['sclassnormalbase'])){
                    $data['sclassnormalbaseError']='Please Enter the Second Class.';
                }
                if(empty($data['tclassnormalbase'])){
                    $data['tclassnormalbaseError']='Please Enter the Third Class.';
                }


                if(empty($data['distance'])){
                    $data['distanceError']='Please Enter the Distance.';
                }

                if(empty($data['rate'])){
                    $data['rateError']='Please Enter the Rate.';
                }elseif(!preg_match($numberValidation, $data['rate'])){
                    $data['rateError']="Rate can only contain numbers";
                }

                if(empty($data['rateIDError']) && empty($data['fclassbaseError']) &&
                empty($data['sclassbaseError']) && empty($data['tclassbaseError']) &&
                empty($data['distanceError']) && empty($data['rateError']) && empty($data['fclassnormalbaseError']) &&
                    empty($data['sclassnormalbaseError']) && empty($data['tclassnormalbaseError'])){

                    if ($this->adminModel->edit($data)) {
                        header("Location: " . URLROOT . "/Admin_manage_fares");
                    }else{
                        die("Something Going Wrong");
                    }
		        }
		}
		$this->view('admins/manage_fare/edit', $data);
	}

		public function views($rateID){

		$manage_fare=$this->adminModel->findFare($rateID);

		$data = [
			'manage_fare'=>$manage_fare,
			'rateID'=>'',
            'fclassbase'=>'',
            'sclassbase'=>'',
            'tclassbase'=>'',
            'distance'=>'',
            'rate'=>''
		];

		if($_SERVER['REQUEST_METHOD']=='POST'){
			$_POST=filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
			$data=[
			'rateID'=>$rateID,   
            'fclassbase'=>trim($_POST['fclassbase']),            
            'sclassbase'=>trim($_POST['sclassbase']),
            'tclassbase'=>trim($_POST['tclassbase']),
            'distance'=>trim($_POST['distance']),
            'rate'=>trim($_POST['rate']),
			];
			if ($this->adminModel->views($data)) {
				header("Location: " . URLROOT . "/Admin_manage_fares");
			}else{
				die("Something Going Wrong");
			}           
		}
		$this->view('admins/manage_fare/views', $data);
	}

	public function delete($rateID){

		$manage_fare=$this->adminModel->findFare($rateID);

		$data = [
			'manage_fare'=>$manage_fare,
			'rateID'=>'',
            'fclassbase'=>'',
            'sclassbase'=>'',
            'tclassbase'=>'',
            'distance'=>'',
            'rate'=>''
		];

		if($_SERVER['REQUEST_METHOD']=='POST'){
			$_POST=filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
		if($this->adminModel->delete($rateID)){
			header("Location: " . URLROOT . "/Admin_manage_fares");
		}
		else{
			die('Something Going Wrong');
		}
	}
	}
}	