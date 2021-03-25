<?php 
	
	class ResOfficerManageSeats extends Controller {

		public function __construct() {
			$this->resofficerReservationModel = $this->model('ResOfficerManageSeat');
                        isResofficerLoggedIn();
		}

		public function index()
        {
            $stations=$this->resofficerReservationModel->getStations();
            $data=[
                'stations'=>$stations
            ];
            $this->view('resofficers/manage_seats/search_trains',$data);
        }

		public function search()
        {
            $stations=$this->resofficerReservationModel->getStations();
            $data=[
                'stations'=>$stations,
                'trains'=>'',
                'srcStation'=>'',
                'destStation'=>'',
                'date'=>'',
                'time'=>'',
                'srcError'=>'',
                'destError'=>'',
                'dateError'=>'',
                'timeError'=>''
            ];

            if($_SERVER['REQUEST_METHOD']=='POST'){
                $_POST=filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
                $data=[
                    'stations'=>$stations,
                    'trains'=>'',
                    'srcStation'=>trim($_POST['src']),
                    'destStation'=>trim($_POST['dest']),
                    'date'=>trim($_POST['date']),
                    'time'=>trim($_POST['time']),
                    'srcError'=>'',
                    'destError'=>'',
                    'dateError'=>'',
                    'timeError'=>''
                ];

                if(empty($data['srcStation']) && empty($data['destStation'])){
                    $data['srcError']='Please enter Atleast one station to proceed';
                    $data['destError']='Please enter Atleast one station to proceed';
                }
                if(!empty($data['srcStation'])){
                    if(!$this->resofficerReservationModel->checkStation($data['srcStation'])){
                        $data['srcError']='Entered source station doesnt exist';
                    }
                }
                if(!empty($data['destStation'])){
                    if(!$this->resofficerReservationModel->checkStation($data['destStation'])){
                        $data['destError']='Entered destination station doesnt exist';
                    }
                }
                if(empty($data['time'])){
                    $data['time']=1;
                }
                if (!empty($data['date'])){
                    $data['date']= date('l', strtotime($data['date']));
                }


                if(empty($data['srcError']) && empty($data['destError'])
                    && empty($data['dateError']) && empty($data['timeError'])){
                    if(empty($data['srcStation']) || empty($data['destStation'])){
                        if(empty($data['destStation'])){
                            if(empty($data['date'])){
                                $data['trains']=$this->resofficerReservationModel->searchSrcOnly($data);
                            }else{
                                $data['trains']=$this->resofficerReservationModel->searchSrcDate($data);
                            }
                        }
                        if(empty($data['srcStation'])){
                            echo 'methana';
                            if(empty($data['date'])){
                                echo 'methana';
                                $data['trains']=$this->resofficerReservationModel->searchDestOnly($data);
                            }else{
                                echo "here";
                                $data['trains']=$this->resofficerReservationModel->searchDestDate($data);
                            }
                        }
                    }else{
                        if(empty($data['date'])){
                            $data['trains']=$this->resofficerReservationModel->searchSrcDestOnly($data);
                        }else{
                            $data['trains']=$this->resofficerReservationModel->searchSrcDestDate($data);
                        }
                    }

                    $this->displayTrains($data); 
                    return;


                }else{
                    $this->view('resofficers/manage_seats/search_trains',$data);
                }
            }
            $this->view('resofficers/manage_seats/search_trains',$data);
        }

        public function displayTrains($data) {

            
            $this->view('resofficers/manage_seats/display_trains',$data); 
        }

        public function createReservation($id){

            $oid = $_SESSION['userid'];
            $resofficer=$this->resofficerReservationModel->findResofficerById($oid);

            $data=[
                'disabledNo'=>trim($_POST['disabledNo']),  
                'resofficer'=>$resofficer,    
                'trainId'=>$id,
                //'journeyDate'=>$date,
                'officerId'=>$resofficer->officerId,
                'compNo'=>'A',

            ];
            
            $resNo = $this->resofficerReservationModel->addDisabled($data);

            if($resNo){
                header("Location: " . URLROOT . "/ResOfficerManageSeats/displaySeatMaps/".$data['compNo']."/".$resNo . "/" .$id);
                }
            else{
                    die("Something Going Wrong");
                }    
                     
        }

        public function displaySeatMaps($compNo, $resNo, $id) {

                if(isset($_GET['compNo'])){ 
                    $compNo=$_GET['compNo'];
                }else{
                    //$compNo="A";
                }

                if(isset($_GET['resNo'])){
                    $resNo = $_GET['resNo'];
                }


            $compartments=$this->resofficerReservationModel->getCompartments($id); //To list the compartments of the given train
            $currComp=$this->resofficerReservationModel->getCompartmentDetails($id,$compNo); //To get details about this compartment

        
            $class='';

            if(($currComp->class)=="F"){
                $class = "First Class";
            }elseif(($currComp->class)=="S"){
                $class = "Second Class";
            }else {
                $class = "Third Class";
            }
            
            //$journeyDate=$date;

            $data=[
                'trainId'=>$id,
                //'date'=>$journeyDate,
                'compartments'=>$compartments,
                'currComp'=>$currComp,
                'compartmentNo'=>$currComp->compartmentNo,
                'class'=>$class,
                'count'=>0,
                'resNo'=>$resNo,
                'seats'=>'',
            ]; 
                    
            if($currComp->type==1){
                $this->view('resofficers/manage_seats/display_seatmapsnew',$data); 
            } elseif($currComp->type==2){
                $this->view('resofficers/manage_seats/display_seatmapsnew2',$data);
            } else {
                $this->view('resofficers/manage_seats/display_seatmapsnew3',$data);
            }
        
            
        }

        public function seatSelected() {
    
            $data =[
                'id'=>$_POST['id'],
                'label'=>$_POST['label'],
                //'journeyDate'=>$_POST['date'],
                'compartment'=>$_POST['compartment'],
                'trainId'=>$_POST['trainId'],
                'classtype'=>$_POST['class'],
                'status'=>"selected",
                'resno'=>$_POST['resno'],
                'price'=>$_POST['price'],
                'total'=>$_POST['total'],
                'count'=>$_POST['count']
            ];

            $results=$this->resofficerReservationModel->addSeat($data);
         
        }

        public function viewDisabledSeats(){
            $seats=$this->resofficerReservationModel->getDisabledSeatDetails();

            $data = [

                'seats'=>$seats
                 
            ];

            $this->view('resofficers/manage_seats/view_disabled_seats', $data);
        }

        public function delete($disabledId){

            $data = [
                'disabledId'=>'',
                'disabledNo'=>'',
                'trainId'=>'',
                'compartmentNo'=>'',
                'seatId'=>'',
                'seatNo'=>''
            ];

            if($_SERVER['REQUEST_METHOD']=='POST'){
                $_POST=filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            if($this->resofficerReservationModel->delete($disabledId)){
                header("Location: " . URLROOT . "/ResOfficerManageSeats/viewDisabledSeats");
            }
            else{
                die('Something Going Wrong');
            }
        }
    }

}