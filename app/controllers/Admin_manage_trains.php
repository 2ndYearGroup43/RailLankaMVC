<?php
class Admin_manage_trains extends Controller{
	public function __construct(){
		$this->adminModel=$this->model('Admin_manage_train');
	}

	public function index(){
		$manage_train=$this->adminModel->get();
		$data = [
			'manage_train'=>$manage_train
		];
		$this->view('admins/manage_train/index', $data);
	}

	public function create(){

		$rates=$this->adminModel->getRateId();
		$stationids=$this->adminModel->getStationID();

		$data = [
			'rates'=>$rates,
			'stationids'=>$stationids,
			'trainId'=>'',
			'name'=>'',
			'reservable_status'=>'',
			'type'=>'',
			'src_station'=>'',
			'starttime'=>'',
			'dest_station'=>'',
			'endtime'=>'',
            'rateId'=>'',
			'entered_date'=>'',
            'entered_time'=>'',
            'trainIdError'=>'',
            'nameError'=>'',
            'reservable_statusError'=>'',
            'src_stationError'=>'',
            'dest_stationError'=>'',
            'typeError'=>''
		];

		if($_SERVER['REQUEST_METHOD']=='POST'){
			$_POST=filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
			$data=[
			'rates'=>$rates,
			'stationids'=>$stationids,	
			'trainId'=>trim($_POST['trainId']),	
			'name'=>trim($_POST['name']),			
			'reservable_status'=>trim($_POST['reservable_status']),
			'type'=>trim($_POST['type']),
			'src_station'=>trim($_POST['src_station']),
			'starttime'=>trim($_POST['starttime']),
			'dest_station'=>trim($_POST['dest_station']),
            'endtime'=>trim($_POST['endtime']),
            'rateId'=>trim($_POST['rateId']),
			'entered_date'=>date("Y-m-d"),
            'entered_time'=>date("H:i:sa"),
			'trainIdError'=>'',
            'nameError'=>'',
            'reservable_statusError'=>'',
            'src_stationError'=>'',
            'dest_stationError'=>'',
            'typeError'=>''
			];
            $idValidation="/^[a-zA-Z0-9]*$/";
            $nameValidation="/^[a-zA-Z]*$/";

                if(empty($data['trainId'])){
                $data['trainIdError']='Please Enter the Train ID.';
                }elseif(!preg_match($idValidation, $data['trainId'])){
                    $data['trainIdError']="Officer ID can only contain letters and numbers.";
                }else{

                    if($this->adminModel->findTrainByTrainId($data['trainId'])){
                        $data['trainIdError']='This ID is already registered as a Train in the system.'; 
                    }
                }

                if(empty($data['src_station'])){
                $data['src_stationError']='Please Enter the Train ID.';
                }else{

                    if(($data['src_station']) == ($data['dest_station'])){
                        $data['src_stationError']='Source and Destination Stations Cannot be Same.'; 
                    }
                }

                if(empty($data['dest_station'])){
                $data['dest_stationError']='Please Enter the Train ID.';
                }else{

                    if(($data['dest_station']) == ($data['src_station'])){
                        $data['dest_stationError']='Source and Destination Stations Cannot be Same.'; 
                    }
                }

                if(empty($data['name'])){
                    $data['nameError']='Please Enter the Train Name.';
                }elseif(!preg_match($nameValidation, $data['name'])){
                    $data['nameError']="Train Name can only contain letters and numbers.";
                }
                if(empty($data['reservable_status'])){
                    $data['reservable_statusError']='Please Enter the Reservable Status.';
                }
                if(empty($data['type'])){
                    $data['typeError']='Please Enter the Last Name.';
                }elseif(!preg_match($nameValidation, $data['type'])){
                    $data['typeError']="Type can only contain letters.";
                }

                if(empty($data['trainIdError']) && empty($data['nameError']) &&
                empty($data['reservable_statusError']) && empty($data['typeError']) && empty($data['src_stationError']) && empty($data['dest_stationError'])){

			if ($this->adminModel->create_train($data)) {				
					header("Location: " . URLROOT . "/Admin_manage_schedules/addSchedule/".$data['trainId']);								
			}else{
				die("Something Going Wrong");
			}
           }
		}
		$this->view('admins/manage_train/create', $data);
	}

	public function edit($trainId){

		$manage_train=$this->adminModel->findTrain($trainId);
		$rates=$this->adminModel->getRateId();
		$stationids=$this->adminModel->getStationID();

		$data = [
			'manage_train'=>$manage_train,
			'rates'=>$rates,
			'stationids'=>$stationids,
			'trainId'=>'',
			'name'=>'',
			'reservable_status'=>'',
			'type'=>'',
			'src_station'=>'',
			'starttime'=>'',
			'dest_station'=>'',
			'endtime'=>'',
            'rateId'=>'',
            'trainIdError'=>'',
            'nameError'=>'',
            'reservable_statusError'=>'',
            'src_stationError'=>'',
            'dest_stationError'=>'',
            'typeError'=>''
		];

		if($_SERVER['REQUEST_METHOD']=='POST'){
			$_POST=filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
			$data=[
			'manage_train'=>$manage_train,
			'rates'=>$rates,
			'stationids'=>$stationids,	
			'trainId'=>$trainId,	
			'name'=>trim($_POST['name']),			
			'reservable_status'=>trim($_POST['reservable_status']),
			'type'=>trim($_POST['type']),
			'src_station'=>trim($_POST['src_station']),
			'starttime'=>trim($_POST['starttime']),
			'dest_station'=>trim($_POST['dest_station']),
            'endtime'=>trim($_POST['endtime']),
            'rateId'=>trim($_POST['rateId']),
			'trainIdError'=>'',
            'nameError'=>'',
            'reservable_statusError'=>'',
            'src_stationError'=>'',
            'dest_stationError'=>'',
            'typeError'=>''
			];

            $idValidation="/^[a-zA-Z0-9]*$/";
            $nameValidation="/^[a-zA-Z]*$/";

                if(empty($data['name'])){
                    $data['nameError']='Please Enter the Train Name.';
                }elseif(!preg_match($nameValidation, $data['name'])){
                    $data['nameError']="Train Name can only contain letters and numbers.";
                }

                if(empty($data['src_station'])){
                $data['src_stationError']='Please Enter the Train ID.';
                }else{

                    if(($data['src_station']) == ($data['dest_station'])){
                        $data['src_stationError']='Source and Destination Stations Cannot be Same.'; 
                    }
                }

                if(empty($data['dest_station'])){
                $data['dest_stationError']='Please Enter the Train ID.';
                }else{

                    if(($data['dest_station']) == ($data['dest_station'])){
                        $data['dest_stationError']='Source and Destination Stations Cannot be Same.'; 
                    }
                }
                
                if(empty($data['reservable_status'])){
                    $data['reservable_statusError']='Please Enter the Reservable Status.';
                }
                if(empty($data['type'])){
                    $data['typeError']='Please Enter the Last Name.';
                }elseif(!preg_match($nameValidation, $data['type'])){
                    $data['typeError']="Type can only contain letters.";
                }

                if(empty($data['nameError']) && empty($data['reservable_statusError']) && empty($data['typeError']) ){


			if ($this->adminModel->edit($data)) {
				if(($data['reservable_status'])=='Yes'){
					header("Location: " . URLROOT . "/Admin_manage_schedules");
				}
			}else{
				die("Something Going Wrong");
			}           
		}
	}
		$this->view('admins/manage_train/edit', $data);
	}

		public function views($trainId){

		$manage_train=$this->adminModel->findTrain($trainId);

		$data = [
			'manage_train'=>$manage_train,
			'trainId'=>'',
			'name'=>'',
			'reservable_status'=>'',
			'type'=>'',
			'src_station'=>'',
			'starttime'=>'',
			'dest_station'=>'',
			'endtime'=>'',
            'rateId'=>'',
			'entered_date'=>'',
            'entered_time'=>''
		];

		if($_SERVER['REQUEST_METHOD']=='POST'){
			$_POST=filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
			$data=[
			'trainId'=>$trainId,	
			'name'=>trim($_POST['name']),			
			'reservable_status'=>trim($_POST['reservable_status']),
			'type'=>trim($_POST['type']),
			'src_station'=>trim($_POST['src_station']),
			'starttime'=>trim($_POST['starttime']),
			'dest_station'=>trim($_POST['dest_station']),
            'endtime'=>trim($_POST['endtime']),
            'rateId'=>trim($_POST['rateId']),
			'entered_date'=>trim($_POST[entered_date]),
            'entered_time'=>trim($_POST[entered_time])
			];
			if ($this->adminModel->views($data)) {
				header("Location: " . URLROOT . "/Admin_manage_trains");
			}else{
				die("Something Going Wrong");
			}           
		}
		$this->view('admins/manage_train/views', $data);
	}

	public function delete($trainId){

		$manage_train=$this->adminModel->findTrain($trainId);

		$data = [
			'manage_train'=>$manage_train,
			'trainId'=>'',
			'name'=>'',
			'reservable_status'=>'',
			'type'=>'',
			'src_station'=>'',
			'starttime'=>'',
			'dest_station'=>'',
			'endtime'=>'',
            'rateId'=>'',
			'entered_date'=>'',
            'entered_time'=>''
		];

		if($_SERVER['REQUEST_METHOD']=='POST'){
			$_POST=filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
		if($this->adminModel->delete($trainId)){
			header("Location: " . URLROOT . "/Admin_manage_trains");
		}
		else{
			die('Something Going Wrong');
		}
	}
	}
}	