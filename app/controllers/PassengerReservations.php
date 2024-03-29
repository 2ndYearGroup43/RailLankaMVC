<?php 

	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\SMTP;
	use PHPMailer\PHPMailer\Exception;
	
	class PassengerReservations extends Controller {

		public function __construct() {

			isPassengerLoggedIn();
			$this->passengerReservationModel = $this->model('PassengerReservation');
		}

		public function search() {
			
			$stations=$this->passengerReservationModel->getStations();
			
	        $data = [
	        	'src'=>'',
	        	'dest'=>'',
	        	'dateFull'=>'',
	        	'date'=>'',
	        	'deptTime'=>'',
	        	'trains'=> '',
	        	'unavailable'=>'',
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
					'unavailable'=>'',
					'stations'=>$stations,
		        	'srcError'=>'',
		        	'destError'=>'',
		        	'dateError'=>'',
		        	'timeError'=>''
		        ];   

		        if(empty($data['src'])){
		        	$data['srcError']="Please enter the source station to proceed.";
		        }else{
		        	if(!$this->passengerReservationModel->checkStation($data['src'])){
		        		$data['srcError']='Source station does not exist'; //Passenger enters non existing source station
		        	} else{
		        		$result=$this->passengerReservationModel->getStationId($data['src']);
		        		$data['src']=$result->stationId;
		        	} 
		        }

		        if(!empty($data['dest'])){
		        	if(!$this->passengerReservationModel->checkStation($data['dest'])){
		        		$data['destError']='Destination station does not exist';
		        	} else{
		        		$result=$this->passengerReservationModel->getStationId($data['dest']);
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

		        	//get ids of trains that are cancelled or rescheduled for the day
		        	$data['unavailable']=$this->passengerReservationModel->getUnavailableTrains($data['dateFull']);
		        	#src-date-time/src-date/src-time/src
		        	if(empty($data['dest'])){

		        		#src //nn
		        		if(empty($data['date']) && empty($data['deptTime'])){
		        			//echo "#src";
		        			$data['trains']=$this->passengerReservationModel->searchSrc($data);

		        		#src-time //nn
		        		}elseif(empty($data['date'])){
		        			//echo "#src-time";
		        			$data['trains']=$this->passengerReservationModel->searchSrcTime($data);
		        		#src-date
		        		}elseif(empty($data['deptTime'])){
		        			//echo "#src-date";
		        			$data['trains']=$this->passengerReservationModel->searchSrcDate($data);
		        		#src-date-time
		        		}else {
		        			//echo "#src-date-time";
		        			$data['trains']=$this->passengerReservationModel->searchSrcDateTime($data);
		        		}

		        	#src-dest-date-time/src-dest-date/src-dest-time/src-dest
		        	}else {

		        		#src-dest //nn
		        		if(empty($data['date']) && empty($data['deptTime'])){
		        			//echo "#src-dest";
		        			$data['trains']=$this->passengerReservationModel->searchSrcDest($data);
		        		#src-dest-time //nn
		        		}elseif(empty($data['date'])){
		        			//echo "#src-dest-time";
		        			$data['trains']=$this->passengerReservationModel->searchSrcDestTime($data);
		        		#src-dest-date
		        		}elseif(empty($data['deptTime'])){
		        			//echo "#src-dest-date";
		        			$data['trains']=$this->passengerReservationModel->searchSrcDestDate($data);
		        		#src-dest-date-time
		        		}else {
		        			//echo "#src-dest-date-time";
		        			$data['trains']=$this->passengerReservationModel->searchAll($data);
		        		}

		        	}

		        	$this->displayTrains($data); 
		        	return;

		        }else {

		        	$this->view('passengers/reservations/search_trains',$data);
		        }
	        }
			
			$this->view('passengers/reservations/search_trains',$data); 
		}

		public function displayTrains($data) {

			
			$this->view('passengers/reservations/display_trains',$data); 
		}

		public function displayTrainDetails() {

			
			$this->view('passengers/reservations/display_traindetails'); 
		}


		public function checkDeptTime(){

			if(isset($_POST['trainid'])){
				$trainid=$_POST['trainid'];
			}
			if(isset($_POST['jdate'])){
				$jdate=$_POST['jdate'];
			}

			$today = date("Y-m-d");
			if($today == $jdate){
				$deptTime = $this->passengerReservationModel->getDeptTime($trainid);
				$timenow = time();
				$chktime = strtotime($deptTime->starttime); 
				$time_diff = $chktime - $timenow;
				if($time_diff > 3600){
					echo true;
				}else{
					echo false;
				}

			}else{
				echo true;
			}

		}

		public function createReservation(){

			var_dump($_GET);
			if(isset($_GET['id'])){
				$id = $_GET['id'];//trainid
				echo $id;
			}

			if(isset($_GET['date'])){
				$journeyDate = $_GET['date'];
				echo $journeyDate;
			}

			$passengerId=$_SESSION['passenger_id'];
			$nic=$_SESSION['passenger_nic'];

			$data=[
				'trainId'=>$id,
				'date'=>$journeyDate,
				'compNo'=>'A',
				'nic'=>$nic,
				'passengerId'=>$passengerId
			];

			$resNo = $this->passengerReservationModel->addReservation($data);//To create a new reservation

			if($resNo){
				header('location: ' . URLROOT . '/PassengerReservations/displaySeatMaps?compNo='.$data['compNo'].'&resNo='.$resNo);
			}
		}

		public function displaySeatMaps() {


			if(isset($_GET['compNo'])){ 
				$compNo=$_GET['compNo'];
			}else{
				$compNo="A";
			}

			if(isset($_GET['resNo'])){
				$resNo = $_GET['resNo'];
			}

			$reservation=$this->passengerReservationModel->getReservationDetails($resNo);

			if($reservation->status=='P'){

				$id=$reservation->trainId;
				$journeyDate=$reservation->journeyDate;
				$endTime=date('Y-m-d H:i:s',strtotime('+30 minutes',strtotime($reservation->res_time)));
				$nic=$_SESSION['passenger_nic'];
				$compartments=$this->passengerReservationModel->getCompartments($id); //To list the compartments of the given train
				$train=$this->passengerReservationModel->getTrainDetails($id); //To get details about the train
				$currComp=$this->passengerReservationModel->getCompartmentDetails($id,$compNo); //To get details about this compartment
					
				$class='';
				$compPrice='';

				if(($currComp->class)=="F"){
					$class = "First Class";
					$compPrice = $train->fclassbase;
				}elseif(($currComp->class)=="S"){
					$class = "Second Class";
					$compPrice = $train->sclassbase;
				}else {
					$class = "Third Class";
					$compPrice = $train->tclassbase;
				}

				$currTime=date("Y-m-d H:i:s");
				$selected=$this->passengerReservationModel->getSelectedSeats($resNo); //Seats in all compartments selected by the user for that order
				$disabled=$this->passengerReservationModel->getDisabledSeats($id,$compNo);//Seats disabled in this compartment
				$unavailable=$this->passengerReservationModel->getUnavailable($id, $compNo, $journeyDate, $resNo, $currTime); //Seats in this compartment selected or booked by other users(or same user)

				$data=[
					'trainId'=>$id,
					'train'=>$train,
					'date'=>$journeyDate,
					'compartments'=>$compartments,
					'currComp'=>$currComp,
					'compartmentNo'=>$currComp->compartmentNo,
					'class'=>$class,
					'count'=>0,
					'resNo'=>$resNo,
					'compPrice'=>$compPrice,
					'selected'=>$selected,
					'unavailable'=>$unavailable,
					'disabled'=>$disabled,
					'endTime'=>$endTime,
					'reservation'=>$reservation
				]; 
				
				if($currComp->type==1){
					$this->view('passengers/reservations/display_seatmapsnew',$data); 
				} elseif($currComp->type==2){
					$this->view('passengers/reservations/display_seatmapsnew2',$data);
				} else {
					$this->view('passengers/reservations/display_seatmapsnew3',$data);
				}

			}else{
				header('location: ' . URLROOT . '/passengerReservations/search');
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

			$check=$this->passengerReservationModel->checkSeat($data['journeyDate'], $data['trainid'], $data['compartment'], $data['label']);//needed?YES

			if(empty($check)){
				$results=$this->passengerReservationModel->addSeat($data);
				//$results2=$this->passengerReservationModel->updateReservation($data)

				// echo $data['trainid'];
				// echo $data['compartment'];
				// echo $data['journeyDate'];
				// echo $data['label'];
				// echo $data['id'];
				// echo $data['classtype'];
				// echo $data['status'];
				// echo $data['price'];
				// echo $data['resno'];
				// echo $data['total'];
				// echo $data['count'];
				// echo $results;
				// echo $check;
				echo true;
			}elseif($check->status=='deselected'){

				$results=$this->passengerReservationModel->updateSeat($data, $check->reservationNo);

				// echo $data['trainid'];
				// echo $data['compartment'];
				// echo $data['label'];
				// echo $data['id'];
				// echo $data['classtype'];
				// echo $data['status'];
				// echo $data['journeyDate'];
				// echo $data['resno'];
				// echo $data['price'];
				// echo $data['total'];
				// echo $data['count'];
				// echo $results;
				// var_dump($check);
				echo true;

			}elseif($check->status=='selected' && $check->dif > 1800){

				$results=$this->passengerReservationModel->updateSeat($data, $check->reservationNo);

				// echo $data['trainid'];
				// echo $data['compartment'];
				// echo $data['label'];
				// echo $data['id'];
				// echo $data['classtype'];
				// echo $data['status'];
				// echo $data['journeyDate'];
				// echo $data['resno'];
				// echo $data['price'];
				// echo $data['total'];
				// echo $data['count'];
				// echo $results;
				// var_dump($check);
				echo true;

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

			
			$results=$this->passengerReservationModel->removeSeat($data);

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

			$unavailable=$this->passengerReservationModel->getUnavailable($trainid, $compNo, $journeyDate, $resNo, $currTime);
			$deselected = $this->passengerReservationModel->getDeselected($trainid, $compNo, $journeyDate, $resNo, $currTime);

			$data=[
				'unavailable'=>$unavailable,
				'deselected'=>$deselected
			];

			echo json_encode($data);
		}


		public function bookingReview() {

			if(isset($_GET['resNo'])){
				$resNo = $_GET['resNo'];
			}
			$reservation=$this->passengerReservationModel->getReservationDetails($resNo);

			if($reservation->status=='P'){

				$seats=$this->passengerReservationModel->getSelectedSeats($resNo); //
				$summary=$this->passengerReservationModel->getSummary($resNo); //get price and item count
				$count=$summary[0]->count;
				$total=$summary[0]->total;
				$result=$this->passengerReservationModel->updateReservation($resNo,$count,$total); //update reservation table with summary
				$resEnd=date('Y-m-d H:i:s',strtotime('+30 minutes',strtotime($reservation->res_time)));
				$account=$this->passengerReservationModel->getAccountDetails($reservation->passengerId);
				$train=$this->passengerReservationModel->getTrainDetails($reservation->trainId);
				$startTime= new DateTime($train->starttime);
				$endTime= new DateTime($train->endtime);
				$duration=$startTime->diff($endTime);

				$data = [
					'train'=>$train,
					'reservation'=>$reservation,
					'account'=>$account,
					'seats'=>$seats,
					'total'=>$total,
					'count'=>$count,
					'startTime'=>$startTime,
					'endTime'=>$endTime,
					'duration'=>$duration,
					'resNo'=>$resNo,
					'resEnd'=>$resEnd
				];
				
				$this->view('passengers/reservations/booking_review', $data); 

			}else{
				header('location: ' . URLROOT . '/passengerReservations/search');
			}
			
		}



		public function bookingConf() {

			if(isset($_GET['resNo'])){
				$resNo = $_GET['resNo'];
			}

			$resTime=$this->passengerReservationModel->checkReservation($resNo); //Time at which the reservation was started
			$timenow = time(); //current time 
			$timedate = date('Y-m-d H:i:s', $timenow);
			$chktime = strtotime($resTime); 
			$time_diff = $timenow - $chktime;

			if( $time_diff > 1800) {
				$this->view('passengers/reservations/timeout', $data);
			   
			} else {

				if($this->passengerReservationModel->confirmReservation($resNo,$timedate)){

					$reservation=$this->passengerReservationModel->getReservationDetails($resNo);

					$nic=$_SESSION['passenger_nic']; //getNICbyID
					$nowdate = date('Y-m-d', $timenow);
					$nowTime = date('H:i:s', $timenow);

					//Add ticket details to ticket table
					$this->passengerReservationModel->addTicket($reservation,$nowdate, $nowTime, $nic);
				
					header('location: ' . URLROOT . '/PassengerReservations/viewTicket?resNo='.$resNo);

				} else{
					$this->search();
				}
			}
			 
		}


		public function viewTicket() {

			if(isset($_GET['resNo'])){
				$resNo = $_GET['resNo'];
			}

			$reservation=$this->passengerReservationModel->getReservationDetails($resNo);
			$account=$this->passengerReservationModel->getAccountDetails($reservation->passengerId);
			$train=$this->passengerReservationModel->getTrainDetails($reservation->trainId);
			$seats=$this->passengerReservationModel->getBookedSeats($resNo);
			$startTime= new DateTime($train->starttime);
			$endTime= new DateTime($train->endtime);
			$duration=$startTime->diff($endTime);			

			
			$data = [
				'train'=>$train,
				'reservation'=>$reservation,
				'account'=>$account,
				'seats'=>$seats,
				'startTime'=>$startTime,
				'endTime'=>$endTime,
				'duration'=>$duration,
				'resNo'=>$resNo,
				'endTime'=>$reservation->comp_time
			];

			if($_SERVER['REQUEST_METHOD'] == 'POST') {
				if($this->sendEmail($data)){
					$this->view('passengers/reservations/booking_conf', $data);
				}
			}

			$this->view('passengers/reservations/booking_conf', $data);
		}


		public function sendEmail($data){

			$output = '
				<link rel="stylesheet" type="text/css" href="'. URLROOT .'/public/css/passenger_main.css">
				<script src="https://use.fontawesome.com/0d40a8591c.js"></script>
				<div class="conf-ticket">
					<div class="normal-header">
						<img src="'. URLROOT .'/public/img/logob2.png">
						<h1 class="title" id="title3">BOOKING CONFIRMATION</h1>
					</div>
					<br><br><br>
					<div class="summary">
						<p><b>Your Ticket ID: '.$data["resNo"].'</b></p>
						<p><b>Booking Date: '.$data["endTime"].'</b></p>
					</div>
					<br>

					<h4 style="text-decoration: underline">CUSTOMER DETAILS</h4>
					<div class="summary">
						<p><b>Customer Name: </b>'.$data["account"]->firstname.' '.$data["account"]->lastname.'</p>
						<p><b>NIC: </b>'.$data["account"]->nic.'</p>
						<p><b>Mobile Number: </b>'.$data["account"]->mobileno.'</p>
					</div>
					<br>

					<h4 style="text-decoration: underline">YOUR JOURNEY</h4>
					<div class="summary">
						<h4><b>'.$data["reservation"]->srcName.' to '.$data["reservation"]->destName.'</h4>
						<p>'.$data["train"]->type.' Train - <b>'.$data["train"]->name.'</b></p>
						<p>Train ID: '.$data["train"]->trainId.'</p>
						<p>Journey Date: '.$data["reservation"]->journeyDate.'</p>
						<p>Departure Time: '.$data["train"]->starttime.'</p>
						<p>Arrival Time: '.$data["train"]->endtime.'</p>
						<p>Train to '.$data["train"]->destName.'</p>
					</div>
					<br>

					<h4 style="text-decoration: underline">BOOKING AND PAYMENT SUMMARY</h4>
					<br>
						<table style="width:80%">
							<thead>
								<tr>
									<td style="border-bottom:1px solid black">Comprtment</td>
									<td style="border-bottom:1px solid black">Seat Number</td>
									<td style="border-bottom:1px solid black">Type</td>
									<td style="border-bottom:1px solid black">Price</td>
								</tr>
							</thead>
							<tbody>';

					foreach ($data['seats'] as $seat){
					$output .='
									<tr>
										<td>'.$seat->compartmentNo.'</td>
										<td>'.$seat->seatNo.'</td>
										<td>'.$seat->classtype.' Seat</td>
										<td>'.$seat->price.'</td>
									</tr>
								';
					}
					
								
					$output .='
								<tr>
									<td style="border-top:1px solid black">Seat Count</td>
									<td style="border-top:1px solid black"></td>
									<td style="border-top:1px solid black"></td>
									<td style="border-top:1px solid black">'.$data['reservation']->itemCount.'</td>
								</tr>
								<tr class="grand-total">
									<td>Total</td>
									<td></td>
									<td></td>
									<td>'.$data['reservation']->total.'</td>
								</tr>
							</tbody>
						</table>
					<br>

					<h4 style="text-decoration: underline">CANCELLATION POLICY</h4>
					<div class="summary">
						<p>Deposit is non-refundable and will be charged to your credit card.</p>
						<p>A passenger is entitled to a refund on the ticket price if a train journey is marked as cancelled, regardless of the reason. A full refund can be obtained by producing the email confirmation/e-ticket at the counter.</p>
					</div>
		
					<div class="summary">
						<p><b>Please contact us for assistance: +940112-695-722 / raillanka@gmail.com</b></p>
					</div>
				</div>
			';

				require APPROOT . '/libraries/pdf.php';
				$file_name = md5(rand()) . '.pdf';
				$html_code = $output;
				$pdf = new Pdf();
				$pdf->set_option('enable_remote', TRUE);
				$pdf->load_html($html_code);
				$pdf->render();
				$file = $pdf->output();
				file_put_contents($file_name, $file);

				require APPROOT . '/libraries/PHPMailer/src/Exception.php';
				require APPROOT . '/libraries/PHPMailer/src/PHPMailer.php';
				require APPROOT . '/libraries/PHPMailer/src/SMTP.php';

				$emailTo = 'raillankaproject@gmail.com';
					    	
				// Instantiation and passing `true` enables exceptions
				$mail = new PHPMailer(true);

				try {
				   	//Server settings   
				   	$mail->isSMTP();                                            // Send using SMTP
				   	$mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
				   	$mail->SMTPAuth   = true;                                   // Enable SMTP authentication
				   	$mail->Username   = 'raillankaproject@gmail.com';                  // SMTP username
					$mail->Password   = 'Raillanka@1234';                               // SMTP password
				  	$mail->SMTPSecure = 'ssl';         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
				  	$mail->Port       = 465;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
					//Recipients
					$mail->setFrom('raillankaproject@gmail.com', 'RailLanka');
					$mail->addAddress($emailTo);     // Add a recipient
					// Name is optional
					$mail->addReplyTo('no-reply@example.com', 'Information', 'No reply');
					$mail->WordWrap = 50;	    
					// Content
					$mail->isHTML(true);  
					$mail->AddAttachment($file_name);
					// Set email format to HTML
					$mail->Subject = 'Booking Confirmation';
					$mail->Body    = "<p>Dear User, </p><p>Please find the confirmation ticket in the attachment.</p><p>Thank you for booking with us!</p>";
					$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
					if($mail->send()){
						return true;
					}

					} catch (Exception $e) {
					  	echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
					}
						   
					exit();
		}


		public function timeout(){

			if(isset($_GET['resNo'])){
				$resNo=$_GET['resNo'];
			}

			$row=$this->passengerReservationModel->getReservationStatus($resNo);

			//If the payment is complete
			if($row->status=='S'){
				echo "here";
				header('location: ' . URLROOT . '/passengerReservations/search');
			}else{
				//If there are selected or deselected seats 
				if($this->passengerReservationModel->checkReservationSeats($resNo)){
					$result=$this->passengerReservationModel->cancelReservation($resNo);
				//User has not selected or deselected any seats 
				}else {
					$result=$this->passengerReservationModel->removeReservation($resNo);
				}

				if($result){
					$this->view('passengers/reservations/booking_failed');
				}
			}
		}

		public function removeReservation(){

			if(isset($_GET['resNo'])){
				$resNo=$_GET['resNo'];
			}

			//If there are selected or deselected seats 
			if($this->passengerReservationModel->checkReservationSeats($resNo)){
				$result=$this->passengerReservationModel->cancelReservation($resNo);
			//User has not selected or deselected any seats 
			}else {
				$result=$this->passengerReservationModel->removeReservation($resNo);
			}
			
			if($result){
				header('location: ' . URLROOT . '/passengerReservations/search');
			}
		}


		public function done(){
			$merchant_id         = $_POST['merchant_id'];
			$order_id             = $_POST['order_id'];
			$payhere_amount     = $_POST['payhere_amount'];
			$payhere_currency    = $_POST['payhere_currency'];
			$status_code         = $_POST['status_code'];
			// $md5sig                = $_POST['md5sig'];
			// $merchant_secret = 'XXXXXXXXXXXXX'; // Replace with your Merchant Secret (Can be found on your PayHere account's Settings page)
			// $local_md5sig = strtoupper (md5 ( $merchant_id . $order_id . $payhere_amount . $payhere_currency . $status_code . strtoupper(md5($merchant_secret)) ) );
			if ($status_code == 2){
			        //TODO: Update your database as payment success
				$result=$this->passengerReservationModel->testmethod($order_id);
			}
		}
		
	}