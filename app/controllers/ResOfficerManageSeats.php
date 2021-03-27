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

        public function search() {
            
            $stations=$this->resofficerReservationModel->getStations();
            
            $data = [
                'src'=>'',
                'dest'=>'',
                'dateFull'=>'',
                'date'=>'',
                'deptTime'=>'',
                'trains'=> '',
                'stations'=>$stations,
                'srcError'=>'',
                'destError'=>'',
                'dateError'=>'',
                'timeError'=>''
            ];


            if($_SERVER['REQUEST_METHOD']=='POST'){

                //sanitise post data
                $_POST=filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
                
                $data = [
                    'src'=>trim($_POST['source']),
                    'dest'=>trim($_POST['destination']),
                    'dateFull'=>trim($_POST['date']),
                    'date'=>'',
                    'deptTime'=>trim($_POST['time']),
                    'trains'=>'',
                    'stations'=>$stations,
                    'srcError'=>'',
                    'destError'=>'',
                    'dateError'=>'',
                    'timeError'=>''
                ];   

                if(empty($data['src'])){
                    $data['srcError']="Please enter the source station to proceed.";
                }else{
                    if(!$this->resofficerReservationModel->checkStation($data['src'])){
                        $data['srcError']='Source station doesnt exist'; //Passenger enters non existing source station
                    } else{
                        $result=$this->resofficerReservationModel->getStationId($data['src']);
                        $data['src']=$result->stationId;
                    } 
                }

                if(!empty($data['dest'])){
                    if(!$this->resofficerReservationModel->checkStation($data['dest'])){
                        $data['destError']='Destination station doesnt exist';
                    } else{
                        $result=$this->resofficerReservationModel->getStationId($data['dest']);
                        $data['dest']=$result->stationId;

                        if($data['src']==$data['dest']){
                            $data['destError']='Destination and source station cannot be the same';
                        }
                    }
                }

                if(empty($data['srcError']) && empty($data['destError']) && empty($data['dateError']) && empty($data['timeError'])){

                    #src-date-time/src-date/src-time/src
                    if(empty($data['dest'])){

                        #src
                        if(empty($data['date']) && empty($data['deptTime'])){
                            $data['trains']=$this->resofficerReservationModel->searchSrc($data);

                        #src-time
                        }elseif(empty($data['date'])){
                            $data['trains']=$this->resofficerReservationModel->searchSrcTime($data);
                        #src-date
                        }elseif(empty($data['deptTime'])){
                            $data['trains']=$this->resofficerReservationModel->searchSrcDate($data);
                        #src-date-time
                        }else {
                            $data['trains']=$this->resofficerReservationModel->searchSrcDateTime($data);
                        }

                    #src-dest-date-time/src-dest-date/src-dest-time/src-dest
                    }else {

                        #src-dest
                        if(empty($data['date']) && empty($data['deptTime'])){
                            $data['trains']=$this->resofficerReservationModel->searchSrcDest($data);
                        #src-dest-time
                        }elseif(empty($data['date'])){
                            $data['trains']=$this->resofficerReservationModel->searchSrcDestTime($data);
                        #src-dest-date
                        }elseif(empty($data['deptTime'])){
                            $data['trains']=$this->resofficerReservationModel->searchSrcDestDate($data);
                        #src-dest-date-time
                        }else {
                            $data['trains']=$this->resofficerReservationModel->searchAll($data);
                        }

                    }

                    $this->displayTrains($data); 
                    return;

                }else {

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