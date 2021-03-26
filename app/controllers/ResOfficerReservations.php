<?php 
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;
    class ResOfficerReservations extends Controller {

        public function __construct() {
            $this->resofficerReservationModel = $this->model('ResOfficerReservation');
                        isResofficerLoggedIn();
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

                if(empty($data['dateFull'])){
                    $data['dateError']="Please enter the date to proceed.";
                }else{
                    if(($data['dateFull']<date("Y-m-d")) || ($data['dateFull']>date("Y-m-d", strtotime("+2 months")))) {
                        $data['dateError']='Bookings can be done only upto 2 months in advance';
                    }else{
                        $data['date']= date('l', strtotime($data['dateFull']));
                    }
                }

                if(!empty($data['deptTime'])){
                    var_dump($data['deptTime']);
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

                    $this->view('resofficers/reservations/search_trains',$data);
                }
            }
            
            $this->view('resofficers/reservations/search_trains',$data); 
        }

        public function displayTrains($data) {

            
            $this->view('resofficers/reservations/display_trains',$data); 
        }

        public function createReservation($id, $date){
            $train=$this->resofficerReservationModel->getTrainDetails($id); //To get details about the train
            $oid = $_SESSION['userid'];
            $resofficer=$this->resofficerReservationModel->findResofficerById($oid);
            $data=[
                'officerId'=>$resofficer->officerId,
                'trainId'=>$id,
                'journeyDate'=>$date,
                'train'=>$train,
                'compNo'=>'A',
                'nic'=>'',
                'reservationNo'=>'',
                'uPassenger_id'=>'',
                'email'=>'',
                'mobileno'=>'',
                'firstname'=>'',
                'lastname'=>'',
                'address_number'=>'',
                'street'=>'',
                'city'=>'',
                'country'=>''
            ];
            if($_SERVER['REQUEST_METHOD']=='POST'){
            $_POST=filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $data=[
            'officerId'=>$resofficer->officerId,    
            'nic'=>trim($_POST['nic']), 
            'reservationNo'=>trim($_POST['reservationNo']),   
            'trainId'=>$id,
            'journeyDate'=>$date,
            'train'=>$train,
            'compNo'=>'A',
            'uPassenger_id'=>trim($_POST['uPassenger_id']), 
            'email'=>trim($_POST['email']), 
            'mobileno'=>trim($_POST['mobileno']), 
            'firstname'=>trim($_POST['firstname']), 
            'lastname'=>trim($_POST['lastname']), 
            'address_number'=>trim($_POST['address_number']), 
            'street'=>trim($_POST['street']), 
            'city'=>trim($_POST['city']), 
            'country'=>trim($_POST['country']), 
            ];
            
            $resNo = $this->resofficerReservationModel->addReservation($data);//To create a new reservation

            if($resNo){
                $uPId = $this->resofficerReservationModel->create_unregistered_passenger($data);
                header("Location: " . URLROOT . "/ResOfficerReservations/displaySeatMaps/".$data['compNo']."/".$resNo."/".$id."/".$uPId);
                }
            else{
                    die("Something Going Wrong");
                }    
            }
            $this->view('resofficers/reservations/create_reservation', $data);
            
        }

        public function displaySeatMaps($compNo, $resNo, $id, $uPId) {
            $uPassenger=$this->resofficerReservationModel->getUnregisteredPassengerDetails($uPId);
            $reservation=$this->resofficerReservationModel->getReservationDetails($resNo);
            $train=$this->resofficerReservationModel->getTrainDetails($id);
            $startTime= new DateTime($train->starttime);
            $endTime= new DateTime($train->endtime);
            $duration=$startTime->diff($endTime);

                if(isset($_GET['compNo'])){ 
                    $compNo=$_GET['compNo'];
                }else{
                    //$compNo="A";
                }

                if(isset($_GET['resNo'])){
                    $resNo = $_GET['resNo'];
                }

                $reservation=$this->resofficerReservationModel->getReservationDetails($resNo);
                $id=$reservation->trainId;
                $journeyDate=$reservation->journeyDate;
            
            //$nic=$this->resofficerReservationModel->getReservationNIC($resNo);
            $compartments=$this->resofficerReservationModel->getCompartments($id); //To list the compartments of the given train
            //$train=$this->resofficerReservationModel->getTrainDetails($id); //To get details about the train
            $currComp=$this->resofficerReservationModel->getCompartmentDetails($id,$compNo); //To get details about this compartment
            //$src=$this->resofficerReservationModel->getStopNo($id,$train->src_station);   //To get the stopNo of the source stationresofficerReservationModel->getStopNo($id,$train->dest_station); //To get the stopNo of the destination station
        
            $class='';

            if(($currComp->class)=="F"){
                $class = "First Class";
            }elseif(($currComp->class)=="S"){
                $class = "Second Class";
            }else {
                $class = "Third Class";
            }

            //$nic=$this->resofficerReservationModel->getReservationNIC($resNo);
            $currTime=date("Y-m-d H:i:s");
            
            $selected=$this->resofficerReservationModel->getSelectedSeats($resNo); //Seats in all compartments selected by the user for that order
            $unavailable=$this->resofficerReservationModel->getUnavailable($id, $compNo, $journeyDate, $resNo); //Seats in this compartment selected or booked by other users(or same user)
            $disabled=$this->resofficerReservationModel->getDisabledSeats($id, $compNo);

            $data=[
                'trainId'=>$id,
                'date'=>$journeyDate,
                'compartments'=>$compartments,
                'currComp'=>$currComp,
                'compartmentNo'=>$currComp->compartmentNo,
                'class'=>$class,
                'count'=>0,
                'resNo'=>$resNo,
                'seats'=>'',
                'selected'=>$selected,
                'unavailable'=>$unavailable,
                'train'=>$train,
                'reservation'=>$reservation,
                'startTime'=>$startTime,
                'endTime'=>$endTime,
                'duration'=>$duration,
                'disabled'=>$disabled,
                'uPassenger'=>$uPassenger

            ]; 
                    
            if($currComp->type==1){
                $this->view('resofficers/reservations/display_seatmapsnew',$data); 
            } elseif($currComp->type==2){
                $this->view('resofficers/reservations/display_seatmapsnew2',$data);
            } else {
                $this->view('resofficers/reservations/display_seatmapsnew3',$data);
            }
        
            
        }


        public function seatSelected() {
    
            $data =[
                'id'=>$_POST['id'],
                'label'=>$_POST['label'],
                'journeyDate'=>$_POST['date'],
                'compartment'=>$_POST['compartment'],
                'trainid'=>$_POST['trainid'],
                'classtype'=>$_POST['class'],
                'status'=>"selected",
                'resno'=>$_POST['resno'],
                'price'=>$_POST['price'],
                'total'=>$_POST['total'],
                'count'=>$_POST['count']
            ];

            $check=$this->resofficerReservationModel->checkSeat($data['journeyDate'], $data['trainid'], $data['compartment'], $data['label']);//needed?YES

            if(empty($check)){
                $results=$this->resofficerReservationModel->addSeat($data);
                //$results2=$this->resofficerReservationModel->updateReservation($data)

                echo $data['trainid'];
                echo $data['compartment'];
                echo $data['journeyDate'];
                echo $data['label'];
                echo $data['id'];
                echo $data['classtype'];
                echo $data['status'];
                echo $data['price'];
                echo $data['resno'];
                echo $data['total'];
                echo $data['count'];
                echo $results;
                echo $check;
            }elseif($check->status=='deselected'){

                $results=$this->resofficerReservationModel->updateSeat($data, $check->reservationNo);

                echo $data['trainid'];
                echo $data['compartment'];
                echo $data['label'];
                echo $data['id'];
                echo $data['classtype'];
                echo $data['status'];
                echo $data['journeyDate'];
                echo $data['resno'];
                echo $data['price'];
                echo $data['total'];
                echo $data['count'];
                echo $results;
                var_dump($check);

            }elseif($check->status=='selected' && $check->dif > 1800){

                $results=$this->resofficerReservationModel->updateSeat($data, $check->reservationNo);

                echo $data['trainid'];
                echo $data['compartment'];
                echo $data['label'];
                echo $data['id'];
                echo $data['classtype'];
                echo $data['status'];
                echo $data['journeyDate'];
                echo $data['resno'];
                echo $data['price'];
                echo $data['total'];
                echo $data['count'];
                echo $results;
                var_dump($check);

            }else{
                echo false;
            }
            
            
        }

        public function seatVacated() {

            $data =[
                'label'=>$_POST['label'],
                'compartment'=>$_POST['compartment'],
                'trainid'=>$_POST['trainid'],
                'journeyDate'=>$_POST['date'],
                'resNo'=>$_POST['resno'], 
                'total'=>$_POST['total'],
                'count'=>$_POST['count']
            ];

            
            $results=$this->resofficerReservationModel->removeSeat($data);

            echo $data['trainid'];
            echo $data['compartment'];
            echo $data['label'];
            echo $data['journeyDate'];
            echo $data['resNo'];
            echo $data['total'];
            echo $data['count'];
            echo $results;

        }

        public function findUnavailable() {

            $trainid=$_POST['trainid'];
            $compNo=$_POST['compartment'];
            $journeyDate=$_POST['date'];
            $resNo=$_POST['resno'];
            $currTime=date("Y-m-d H:i:s");

            $unavailable=$this->resofficerReservationModel->getUnavailable($trainid, $compNo, $journeyDate, $resNo, $currTime);
            $deselected = $this->resofficerReservationModel->getDeselected($trainid, $compNo, $journeyDate, $resNo, $currTime);

            $data=[
                'unavailable'=>$unavailable,
                'deselected'=>$deselected
            ];

            echo json_encode($data);
        }

        public function createTicket($resNo, $uPId){

                if(isset($_GET['resNo'])){
                $resNo = $_GET['resNo'];

            }

            $seats=$this->resofficerReservationModel->getSelectedSeats($resNo);
            $summary=$this->resofficerReservationModel->getSummary($resNo);
            $count=$summary[0]->count;
            $total=$summary[0]->total;
            $result=$this->resofficerReservationModel->updateReservation($resNo,$count,$total);
            $reservation=$this->resofficerReservationModel->getReservationDetails($resNo);
            $train=$this->resofficerReservationModel->getTrainDetails($reservation->trainId);
            $account=$this->resofficerReservationModel->getUnregisteredPassengerDetails($uPId);
            $reservation=$this->resofficerReservationModel->getReservationDetails($resNo);
            $id = $_SESSION['userid'];
            $resofficer=$this->resofficerReservationModel->findResofficerById($id);

            $data = [
                'train'=>$train,
                'account'=>$account,
                'reservation'=>$reservation,
                'seats'=>$seats,
                'total'=>$total,
                'ticketNo'=>trim($_POST['ticketNo']), 
                'ticketId'=>$resNo, 
                'reservationType'=>"Counter",
                'price'=>$total,
                'journeyDate'=>$reservation->journeyDate,
                'issueDate'=>date("Y-m-d"),
                'issueTime'=>date("H:i:sa"),
                'trainId'=>$train->trainId,
                'officerId'=>$resofficer->officerId,
                'uPassenger_id'=>$uPId,
                'nic'=>$account->nic,

            ];
     
                if ($this->resofficerReservationModel->create_ticket($data)){

                    $this->informPassengerOftheReservation($account->email, $resNo, $total, $train->trainId, $train->name, $account->nic, $reservation->journeyDate);
                    header("Location: " . URLROOT . "/ResOfficerReservations/bookingReview/" .$resNo."/".$uPId);                              
                }else{
                    die("Something Going Wrong");
                }
                     
        }

        public function bookingReview($resNo, $uPId) {

            if(isset($_GET['resNo'])){
                $resNo = $_GET['resNo'];

            }

            $seats=$this->resofficerReservationModel->getSelectedSeats($resNo);
            $summary=$this->resofficerReservationModel->getSummary($resNo);
            $count=$summary[0]->count;
            $total=$summary[0]->total;
            $reservation=$this->resofficerReservationModel->getReservationDetails($resNo);
            $train=$this->resofficerReservationModel->getTrainDetails($reservation->trainId);
            $startTime= new DateTime($train->starttime);
            $endTime= new DateTime($train->endtime);
            $duration=$startTime->diff($endTime);
            $account=$this->resofficerReservationModel->getUnregisteredPassengerDetails($uPId);
            $tickets=$this->resofficerReservationModel->getTicketDetails($resNo);

            $data = [
                'train'=>$train,
                'tickets'=>$tickets,
                'reservation'=>$reservation,
                'account'=>$account,
                'seats'=>$seats,
                'total'=>$total,
                'count'=>$count,
                'startTime'=>$startTime,
                'endTime'=>$endTime,
                'duration'=>$duration,
            ];
        $this->resofficerReservationModel->updateReservationStatus($resNo);
        $this->resofficerReservationModel->confirmReservation($resNo);  
        $this->view('resofficers/reservations/booking_conf', $data);
        
    }

    public function informPassengerOftheReservation($email, $ticketId, $price, $trainId, $name, $nic, $journeyDate)
        {   
            require APPROOT . '/libraries/PHPMailer/src/Exception.php';
            require APPROOT . '/libraries/PHPMailer/src/PHPMailer.php';
            require APPROOT . '/libraries/PHPMailer/src/SMTP.php';

            $mail = new PHPMailer(true);

            try {
                //Server settings   
                $mail->isSMTP();                                            // Send using SMTP
                $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
                $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
                $mail->Username   = 'raillankaproject@gmail.com';                     // SMTP username
                $mail->Password   = 'Raillanka@2';                               // SMTP password
                $mail->SMTPSecure = 'ssl';         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
                $mail->Port       = 465;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

                //Recipients
                $mail->setFrom('raillankaproject@gmail.com', 'RailLanka');
                $mail->addAddress($email);     // Add a recipient
                        // Name is optional
                $mail->addReplyTo('no-reply@example.com', 'Information', 'No reply');
            
                // Content
                $mail->isHTML(true); 
 
                // Set email format to HTML
                $mail->Subject = 'Reservation Successfull';
                $mail->Body    = "<h1>Your Reservation is successfull.</h1><p>The ticket details of you as follow.
                <br> Your Ticket ID : $ticketId</br>
                <br> Your Ticket Price : $price</br>
                <br> Train ID : $trainId</br>
                <br> Train Name : $name</br>
                <br> Your NIC : $nic</br>
                <br> Your Journey Date : $journeyDate</br>
                <br></br>
                <h2>Thank You For Booking With Us</h2>
                </p>";
                $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

                $mail->send();
                // $msg = 'Reset password link has been sent to your email';
                return;

            } catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }
        
            exit();
        }
}