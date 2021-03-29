<?php 
	
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\SMTP;
	use PHPMailer\PHPMailer\Exception;
	
	class PassengerAccounts extends Controller {

		public function __construct() {
			isPassengerLoggedIn();
			$this->passengerAccountModel = $this->model('PassengerAccount');
		}

		public function displayAccount() {
			
			$id = $_SESSION['userid'];
	        $passenger=$this->passengerAccountModel->findPassengerById($id);
	        $data=[
	                'passenger'=>$passenger,
	                'id'=>$id
	        ];
		
			$this->view('passengers/accounts/view_account', $data); 
		}

		public function editAccount($id) {

			// $id = $_SESSION['userid'];
	        $passenger=$this->passengerAccountModel->findPassengerById($id);
	        $data = [
	        	'userId'=>$id,
	        	'passenger'=>$passenger,
	        	// 'nic'=>'',
	        	'firstName'=>'',
	        	'lastName'=>'',
	        	'email'=>'',
	        	'mobileNo'=>'',
	        	'addressNo'=>'',
	        	'street'=>'',
	        	'city'=>'',
	        	'country'=>'',
	        	'password'=> '',
	        	'newPassword'=> '',
				'confirmPassword' => '',
	        	'nicError'=>'',
	        	'firstNameError'=>'',
	        	'lastNameError'=>'',
	        	'mobileNoError'=>'',
	        	'addressNoError'=>'',
	        	'streetError'=>'',
	        	'cityError'=>'',
	        	'countryError'=>'',
				'passwordError' => '',
				'newPasswordError' => '',
				'confirmPasswordError' => ''
	        ];

	        if($_SERVER['REQUEST_METHOD']=='POST'){

	        	if(isset($_POST['editAccount'])){

	        		//sanitise post data
	        		$_POST=filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
	        	
		        	$data = [
			        	'userId'=>$_SESSION['userid'],
			        	'passenger'=>$passenger,
			        	// 'nic'=>trim($_POST['nic']),
			        	'firstName'=>trim($_POST['firstName']),
			        	'lastName'=>trim($_POST['lastName']),
			        	'mobileNo'=>trim($_POST['mobileNo']),
			        	'addressNo'=>trim($_POST['addressNo']),
			        	'street'=>trim($_POST['street']),
			        	'city'=>trim($_POST['city']),
			        	'country'=>trim($_POST['country']),
			        	'password'=> '',
			        	'newPassword'=> '',
						'confirmPassword' => '',
			        	'nicError'=>'',
			        	'firstNameError'=>'',
			        	'lastNameError'=>'',
			        	'mobileNoError'=>'',
			        	'addressNoError'=>'',
			        	'streetError'=>'',
			        	'cityError'=>'',
			        	'countryError'=>'',
			        	'passwordError' => '',
			        	'newPasswordError'=> '',
						'confirmPasswordError' => ''
			        ];

		       

			        //RegEx for validation
			        $passportValidation = "/^([a-zA-Z0-9]{8}|[a-zA-Z0-9]{9})$/";
					$nicValidation = "/^([0-9]{9}[x|X|v|V]|[0-9]{12})$/";
					$nameValidation = "/^[a-zA-Z]*$/";
					$mobileValidation ="/^[0-9]{10}+$/";
					$addressNoValidation ="/^[0-9]*$/";
					$addressValidation = "/^[a-zA-Z ]*$/";

					// //validate nic 
					// if(empty($data['nic'])){
					// 	$data['nicError'] = 'Please enter NIC number.';
					// //validate nic on letters and numbers
					// } elseif(!preg_match($nicValidation, $data['nic'])) {
					// 	$data['nicError'] = 'Invalid NIC number.';
					// //check if nic is already registered
					// } elseif ($this->passengerAccountModel->findPassengerByNIC($data['nic'])) {
					// 	$data['nicError'] = 'nic is already registered.';
					// }
				
					//validate first name on letters
					if($data['firstName']){
	                    if(!preg_match($nameValidation, $data['firstName'])){
	                    	$data['firstNameError']="Name can only contain letters.";
	                	}
	                }

					//validate last name on letters
					if($data['lastName']){
	                    if(!preg_match($nameValidation, $data['lastName'])){
	                    	$data['lastNameError']="Name can only contain letters.";
	                    }
	                }

					//validate mobile number on numbers and + sign
					if($data['mobileNo']){
	                  	if(!preg_match($mobileValidation, $data['mobileNo'])){
	                   		$data['mobileNoError']="Mobile Number can only contain numbers and +.";
	                   	}
	                }

					//validate address number on numbers
					if($data['addressNo']){
	                   	if(!preg_match($addressNoValidation, $data['addressNo'])){
	                    	$data['addressNoError']="Address Number can contain only numbers.";
	                    }
	                }

					//validate street on letters
					if($data['street']){
	                    if(!preg_match($addressValidation, $data['street'])){
	                    	$data['streetError']="Street can contain only letters.";
	                    }
	                }

					//validate city on letters
					if($data['city']){
	                    if(!preg_match($addressValidation, $data['city'])){
	                    	$data['cityError']="City can contain only letters.";
	                    }
	                }

					//validate country on letters
					if($data['country']){
	                    if(!preg_match($addressValidation, $data['country'])){
	                    	$data['countryError']="Name can contain only letters.";
	                    }
	                }

	                //make sure all errors are empty
					if (empty($data['nicError']) && empty($data['firstNameError']) && empty($data['lastNameError']) && empty($data['mobileNoError']) && empty($data['addressNoError']) && empty($data['streetError']) && empty($data['cityError']) && empty($data['countryError'])) {

						// echo "here";

						//Update user details user from model function
						if($this->passengerAccountModel->updatePassenger($data)) {

							// echo "here too";
							//redirect to the view account page
							header('location: ' . URLROOT . '/passengerAccounts/displayAccount');
						} else {
							die('Something went wrong.');
						}
					} else {
						$this->view('passengers/accounts/edit_account', $data);
					}
		        }

		        if(isset($_POST['editPassword'])){

		        		//sanitise post data
	        		$_POST=filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
	        	
		        	$data = [
			        	'userId'=>$_SESSION['userid'],
			        	'passenger'=>$passenger,
			        	// 'nic'=>trim($_POST['nic']),
			        	'firstName'=>'',
			        	'lastName'=>'',
			        	'mobileNo'=>'',
			        	'addressNo'=>'',
			        	'street'=>'',
			        	'city'=>'',
			        	'country'=>'',
			        	'password'=>trim($_POST['password']),
			        	'newPassword'=>trim($_POST['newPassword']),
						'confirmPassword' => trim($_POST['confirmPassword']),
			        	'nicError'=>'',
			        	'firstNameError'=>'',
			        	'lastNameError'=>'',
			        	'mobileNoError'=>'',
			        	'addressNoError'=>'',
			        	'streetError'=>'',
			        	'cityError'=>'',
			        	'countryError'=>'',
			        	'passwordError' => '',
			        	'newPasswordError' => '',
						'confirmPasswordError' => ''
			        ];


					$passwordValidation = "/^(.{0,7}|[^a-z]*|[^\d]*)$/i";

					//Validate password on length and numeric values 
					if (empty($data['newPassword'])) {
						$data['newPasswordError'] = 'Please enter password.';
					} elseif(strlen($data['password']) < 6){
						$data['newPasswordError'] = 'Password must be at least 8 characters.';
					} elseif (preg_match($passwordValidation, $data['password'])) {
						$data['newPasswordError'] = 'The password must have at least one numeric value.';
					}

					//Validate confirm password
					if (empty($data['confirmPassword'])) {
						$data['confirmPasswordError'] = 'Please enter password.';
					} else {
						if ($data['newPassword'] != $data['confirmPassword']) {
							$data['confirmPasswordError'] = 'Passwords do not match!.';
						}
					}

					//make sure that errors are empty
					if (empty($data['passwordError']) && empty($data['confirmPasswordError'])) {

						$validPassword = $this->passengerAccountModel->checkPassword($data['userId'], $data['password']);

						if($validPassword){

							require APPROOT . '/libraries/PHPMailer/src/Exception.php';
							require APPROOT . '/libraries/PHPMailer/src/PHPMailer.php';
							require APPROOT . '/libraries/PHPMailer/src/SMTP.php';

							//Hash password
							$data['newPassword'] = password_hash($data['newPassword'], PASSWORD_DEFAULT);

							//Update password and remove record from resetpasswords table
							if($this->passengerAccountModel->updatePassword($data['userId'], $data['newPassword'])) {

								$emailTo = 'raillankaproject@gmail.com';
					    	
						    	// Instantiation and passing `true` enables exceptions
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
						        	$mail->addAddress($emailTo);     // Add a recipient
						            // Name is optional
						        	$mail->addReplyTo('no-reply@example.com', 'Information', 'No reply');
						    
						        	// Content
						        	$mail->isHTML(true);  

						        	// Set email format to HTML
						        	$mail->Subject = 'Your RailLanka Account Pssword Has Changed';
						        	$mail->Body    = "<p>Dear User, </p><p>Your RailLanka account password has changed</p><p>The RailLanka Team</p>";
						        	$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

						        	$mail->send();
						        	header('location: ' . URLROOT . '/passengerAccounts/displayAccount');

						    	} catch (Exception $e) {
						        	echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
						    	}
						   
						   		exit();
							

							} else {
								die('Something went wrong.');
							}

						} else {

							$data['passwordError'] = 'Password is incorrect. Please try again';

							$this->view('passengers/accounts/edit_account', $data); 
						}

					}


		        }

	        }

			$this->view('passengers/accounts/edit_account', $data); 
		}


		public function displayTickets() {
			
			$id = $_SESSION['passenger_id'];
			$data=$this->passengerAccountModel->getTickets($id);
			$this->view('passengers/accounts/view_tickets', $data); 
		}

		public function viewTicket() {

			if(isset($_GET['resNo'])){
				$resNo = $_GET['resNo'];
			}
			// $timenow = time(); //current time 
			$reservation=$this->passengerAccountModel->getReservationDetails($resNo);
			$account=$this->passengerAccountModel->getAccountDetails($reservation->passengerId);
			$train=$this->passengerAccountModel->getTrainDetails($reservation->trainId);
			$seats=$this->passengerAccountModel->getBookedSeats($resNo);
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
					// echo "here";
					$this->view('passengers/accounts/booking_conf', $data);
				}
				// }
			}
			
			$this->view('passengers/accounts/booking_conf', $data); 
		}


		public function sendEmail($data){


			// if(isset($_GET['resNo'])){
			// 	$resNo = $_GET['resNo'];
			// }
			// // $timenow = time(); //current time 
			// $reservation=$this->passengerReservationModel->getReservationDetails($resNo);
			// $account=$this->passengerReservationModel->getAccountDetails($reservation->nic);
			// $train=$this->passengerReservationModel->getTrainDetails($reservation->trainId);
			// $seats=$this->passengerReservationModel->getBookedSeats($resNo);
			// $startTime= new DateTime($train->starttime);
			// $endTime= new DateTime($train->endtime);
			// $duration=$startTime->diff($endTime);

			// $data = [
			// 	'train'=>$train,
			// 	'reservation'=>$reservation,
			// 	'account'=>$account,
			// 	'seats'=>$seats,
			// 	'startTime'=>$startTime,
			// 	'endTime'=>$endTime,
			// 	'duration'=>$duration,
			// 	'resNo'=>$resNo,
			// 	'endTime'=>$reservation->comp_time
			// ];

			// $output = '<link rel="stylesheet" type="text/css" href="passenger_main.css">';
			// $output .= '<script src="https://use.fontawesome.com/0d40a8591c.js"></script>';
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

			//if(isset($_POST['mailTicket'])){

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
					$mail->Password   = 'Raillanka@2';                               // SMTP password
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
						// header('location: ' . URLROOT . '/PassengerReservations/viewTicket?resNo='.$resNo);
						return true;
					}
					//header('location: ' . URLROOT . '/passengerAccounts/displayAccount');

					} catch (Exception $e) {
					  	echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
					}
						   
					exit();
		}

		public function displaySubscriptions() {
			
			
			$this->view('passengers/accounts/view_subscriptions'); 
		}
		
	}