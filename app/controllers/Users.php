<?php 
	
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\SMTP;
	use PHPMailer\PHPMailer\Exception;

	class Users extends Controller {

		public function __construct() {
			$this->userModel = $this->model('User');
		}

		public function register() {

			$data = [
				// 'username' => '',
				'nic' => '',
				'passport' => '',
				'email' => '',
				'password' => '',
				'confirmPassword' => '',
				'role' => '',
				'reg_date' => '',
				'reg_time' => '',
				'code'=> '',
				'nicError' => '',
				'passportError' => '',
				'usernameError' => '',
				'emailError' => '',
				'passwordError' => '',
				'confirmPasswordError' => ''
			];

			if($_SERVER['REQUEST_METHOD'] == 'POST') {
				//sanitize post data 
				$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

				$data = [
					'nic' => trim($_POST['nic']),
					'passport' => trim($_POST['passport']),
					// 'username' => trim($_POST['username']),
					'email' => trim($_POST['email']),
					'password' => trim($_POST['password']),
					'confirmPassword' => trim($_POST['confirmPassword']),
					'role' => 1,
					'reg_date'=>date("Y-m-d"),
                    'reg_time'=>date("H:i:sa"),
                    'code'=>uniqid(true),
                    'nicError' => '',
                    'passportError' => '',
					'usernameError' => '',
					'emailError' => '',
					'passwordError' => '',
					'confirmPasswordError' => ''
				];

				$passportValidation = "/^([a-zA-Z0-9]{8}|[a-zA-Z0-9]{9})$/";
				$nicValidation = "/^([0-9]{9}[x|X|v|V]|[0-9]{12})$/";
				$nameValidation = "/^[a-zA-Z0-9]*$/";
				$passwordValidation = "/^(.{0,7}|[^a-z]*|[^\d]*)$/i";


				//check if either NIC field or passport field is filled
				if(empty($data['nic']) && empty($data['passport'])){
					// $data['nicError'] = 'Please enter NIC number or Passport Number.';
					$data['passportError'] = 'Please enter NIC number or Passport Number.';
				} else {
					//validate nic on letters and numbers
					if (empty($data['passport'])) {

						if (!preg_match($nicValidation, $data['nic'])) {
							$data['nicError'] = 'Invalid NIC number.';
							//check if nic is already registered
						} elseif ($this->userModel->findPassengerByNIC($data['nic'])) {
								$data['nicError'] = 'nic is already registered.';
						}
					}

					//validate passport number on letters and numbers
					elseif (empty($data['nic'])) {
						
						if (!preg_match($passportValidation, $data['passport'])) {
							$data['passportError'] = 'Invalid Passport number.';
							//check if passport is already registered
						} elseif ($this->userModel->findPassengerByNIC($data['nic'])) {
								$data['passportError'] = 'passport is already registered.';
						}
					}
				}
				

				// //validate username on letters and numbers
				// if (empty($data['username'])) {
				// 	$data['usernameError'] = 'Please enter username.';
				// } elseif (!preg_match($nameValidation, $data['username'])) {
				// 	$data['usernameError'] = 'Name can only contain letters and numbers.';
				// }

				//validate email
				if (empty($data['email'])) {
					$data['emailError'] = 'Please enter email address.';
				} elseif (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
					$data['emailError'] = 'Please enter the correct format.';
				} else {
					//check if email exists
					if ($this->userModel->findUserByEmail($data['email'])) {
						$data['emailError'] = 'Email is already taken.';
					}
				}

				//Validate password on length and numeric values 
				if (empty($data['password'])) {
					$data['passwordError'] = 'Please enter password.';
				} elseif(strlen($data['password']) < 6){
					$data['passwordError'] = 'Password must be at least 8 characters.';
				} elseif (preg_match($passwordValidation, $data['password'])) {
					$data['passwordError'] = 'The password must have at least one numeric value.';
				}

				//Validate confirm password
				if (empty($data['confirmPassword'])) {
					$data['confirmPasswordError'] = 'Please enter password.';
				} else {
					if ($data['password'] != $data['confirmPassword']) {
						$data['confirmPasswordError'] = 'Passwords do not match!.';
					}
				}

				//make sure that errors are empty
				if (empty($data['nicError']) && empty($data['passportError']) && empty($data['emailError']) && empty($data['passwordError']) && empty($data['confirmPasswordError'])) {

					//Hash password
					$data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

					//Register user from model function
					if($this->userModel->register($data)) {
						//send verification email 
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
					        $mail->Password   = 'Raillanka@1234';                               // SMTP password
					        $mail->SMTPSecure = 'ssl';         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
					        $mail->Port       = 465;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

					        //Recipients
					        $mail->setFrom('raillankaproject@gmail.com', 'RailLanka');
					        $mail->addAddress($data['email']);     // Add a recipient
					                   // Name is optional
					        $mail->addReplyTo('no-reply@example.com', 'Information', 'No reply');
					    
					        // Content
					        $mail->isHTML(true); 
					        $code = $data['code'];
					        $url = URLROOT . "/users/verifyEmail?code=$code";   //  

					        // Set email format to HTML
					        $mail->Subject = 'Verify your email address';
					        $mail->Body    = "<h1>Thank you for signing up with RailLanka!</h1><p>To finish setting up your RailLanka Account, we just need to make sure this email address is yours.</p><p>Clink on <a href='$url'>this link</a> to verify your email.</p><br><p>Thanks,</p><p>RailLanka Team</p>";
					        //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

					        $mail->send();
					        // $msg = 'Reset password link has been sent to your email';
					        header('location: ' . URLROOT . '/users/verifyRequest');
					        

					    } catch (Exception $e) {
					    	//echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
					    	if($this->userModel->removeUser($data['email'])){
					    		$data['emailError'] = 'Please enter a valid email address'; //??
					    		$this->view('users/register', $data);
					    	}

					    }
					   
					    exit();
						//redirect to the login page
						//header('location: ' . URLROOT . '/users/login');
					} else {
						die('Something went wrong.');
					}
				}

			}

			$this->view('users/register', $data);
		}


		public function verifyRequest(){
			$this->view('users/validate_email');
		}


		public function verifyEmail(){

			$data = [

				'code' => '',
				'password'=> '',
				'email' => '',
				'confirmPassword' => '',
				'passwordError' => '',
				'confirmPasswordError' => ''
			];

			if(!isset($_GET["code"])) {
				exit("Can't find page");
			}

			$code = $_GET["code"];

			// $getEmailQuery = mysqli_query($conn, "SELECT email FROM resetpasswords WHERE code='$code'" );
			$result = (array)$this->userModel->findUserIdByCode($code);
			// var_dump($result);
			
			if (empty($result)) {
				exit("Can't find page");
			}else{
				
				if($this->userModel->verifyEmail($result['userId'])){
					
					if($this->userModel->deleteVerifyCode($code)){
						header('location: ' . URLROOT . '/users/login');
					}
					
				}else{
					exit("Something went wrong");
				}
			}

		}


		public function login() {
			$data = [
				'title' => 'Login page',
				'email' => '',
				'password' => '',
				'emailError' => '',
				'passwordError' => ''
			];

			//Check for post
			if($_SERVER['REQUEST_METHOD'] == 'POST'){

				//Sanitize post data
				$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

				$data = [
					'email' => trim($_POST['email']),
					'password' => trim($_POST['password']),
					'emailError' => '',
					'passwordError' => '',
				];

				//validate username
				if (empty($data['email'])) {
					$data['emailError'] = 'Please enter email.';
				}

				//validate password
				if (empty($data['password'])) {
					$data['passwordError'] = 'Please enter password.';
				}

				//check if all errors are empty
				if(empty($data['emailError']) && empty($data['passwordError'])) {
					$loggedInUser = $this->userModel->login($data['email'], $data['password']);

					if ($loggedInUser){
						if($loggedInUser->role==1 && $loggedInUser->isVerified==0){
							$data['emailError'] = 'Please verify your email address.';
						}else{
							$this->createUserSession($loggedInUser);
						}
					} else {
						$data['passwordError'] = 'Password or email is incorrect. Please try again';

						$this->view('users/login', $data);

					}
				}

			} else {

				$data = [
					'email' => '',
					'password' => '',
					'emailError' => '',
					'passwordError' => ''
				];
			}

			$this->view('users/login', $data);
		}
		

		public function createUserSession($user) {
			$_SESSION['userid'] = $user->userid;
			$_SESSION['email'] = $user->email;
			$_SESSION['role'] = $user->role;
			$_SESSION['passenger_nic'] = '';
			$_SESSION['passenger_id'] = '';
			$_SESSION['admin_id'] = '';
			$_SESSION['moderator_id'] = '';
			$_SESSION['driver_id'] = '';
			$_SESSION['ro_id'] = '';
			$_SESSION['superadmin_id'] = '';

			
			if($user->role)
			{
				if($user->role==1)
				{
					$passenger=$this->userModel->getPassengerById($user->userid);
					$_SESSION['passenger_nic'] = $passenger->nic;
					$_SESSION['passenger_id'] = $passenger->passengerId;
				}

				if($user->role==2)
				{ 	
					$admin=$this->userModel->getAdminById($user->userid);
					$_SESSION['admin_id'] = $admin->adminId;
				}

				if($user->role==3)
				{
					$moderator=$this->userModel->getModeratorById($user->userid);
					$_SESSION['moderator_id'] = $moderator->moderatorId;
				}

				if($user->role==4)
				{
					$driver=$this->userModel->getDriverById($user->userid);
					$_SESSION['driver_id'] = $driver->driverId;
				}

				if($user->role==5)
				{
					$RO=$this->userModel->getROById($user->userid);
					$_SESSION['ro_id'] = $RO->officerId;
				}

				if($user->role==6)
				{
					$superadmin=$this->userModel->getSuperAdminById($user->userid);
					$_SESSION['superadmin_id'] = $superadmin->super_adminId;
				}
			}

			redirect($_SESSION['role']);	
		}

		public function logout() {
			unset($_SESSION['userid']);
			unset($_SESSION['email']);
			unset($_SESSION['role']);
			unset($_SESSION['passenger_nic']);
			unset($_SESSION['admin_id']);
			unset($_SESSION['moderator_id']);
			unset($_SESSION['driver_id']);
			unset($_SESSION['ro_id']);
			unset($_SESSION['superadmin_id']);
			header('location:' . URLROOT . '/pages/index');
		}



		public function requestReset() {

			
			$data = [

				'email' => '',
				'emailTo' => '',
				'code'=> '',
				'mail' => '',
				'emailError' => ''
			];

			if($_SERVER['REQUEST_METHOD'] == 'POST') {
				//sanitize post data 
				$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

				$data = [
					
					'email' => trim($_POST['email']),
					'emailTo' => '',
					'code'=> '',
					'mail' => '',
					'emailError' => '',
				];

				
				//validate email
				if (empty($data['email'])) {
					$data['emailError'] = 'Please enter email address.';
				} elseif (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
					$data['emailError'] = 'Please enter the correct format.';
				} else {
					//check if email exists
					if (!$this->userModel->findUserByEmail($data['email'])) {
						$data['emailError'] = "Sorry, we don't recognize this email.";
					}
				}

				//make sure that errors are empty
				if (empty($data['emailError'])) {

					require APPROOT . '/libraries/PHPMailer/src/Exception.php';
					require APPROOT . '/libraries/PHPMailer/src/PHPMailer.php';
					require APPROOT . '/libraries/PHPMailer/src/SMTP.php';

					if(isset($_POST['email'])){

					    $emailTo = $_POST['email'];
					    $code = uniqid(true);

					    

					    if(!$this->userModel->requestReset($emailTo,$code)){
					        die('Something went wrong');
					    }

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
					        $url = URLROOT . "/users/resetPassword?code=$code";   //  

					        // Set email format to HTML
					        $mail->Subject = 'Your Password Request Link';
					        $mail->Body    = "<h1>You requested a password change</h1> Clink on <a href='$url'>this link</a> to reset your password</h1>";
					        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

					        $mail->send();
					        // $msg = 'Reset password link has been sent to your email';
					        $this->view('users/success_resetrequest');

					    } catch (Exception $e) {
					        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
					    }
					   
					    exit();
					}

				}

			}

			$this->view('users/request_reset', $data);
		}


		public function resetPassword() {

			$data = [

				'code' => '',
				'password'=> '',
				'email' => '',
				'confirmPassword' => '',
				'passwordError' => '',
				'confirmPasswordError' => ''
			];

			if(!isset($_GET["code"])) {
				exit("Can't find page");
			}

			$code = $_GET["code"];

			// $getEmailQuery = mysqli_query($conn, "SELECT email FROM resetpasswords WHERE code='$code'" );
			$result = (array)$this->userModel->findEmailByCode($code);
			var_dump($result);
			
			if (empty($result)) {
				exit("Can't find page");
			}

			if(isset($_POST['password'])) {

				//sanitize post data 
				$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

				$data = [
					'code' => $code,
					'email' => $result['email'],
					'password' => trim($_POST['password']),
					'confirmPassword' => trim($_POST['confirmPassword']),
					'passwordError' => '',
					'confirmPasswordError' => ''
				];

				$passwordValidation = "/^(.{0,7}|[^a-z]*|[^\d]*)$/i";

				//Validate password on length and numeric values 
				if (empty($data['password'])) {
					$data['passwordError'] = 'Please enter password.';
				} elseif(strlen($data['password']) < 6){
					$data['passwordError'] = 'Password must be at least 8 characters.';
				} elseif (preg_match($passwordValidation, $data['password'])) {
					$data['passwordError'] = 'The password must have at least one numeric value.';
				}

				//Validate confirm password
				if (empty($data['confirmPassword'])) {
					$data['confirmPasswordError'] = 'Please enter password.';
				} else {
					if ($data['password'] != $data['confirmPassword']) {
						$data['confirmPasswordError'] = 'Passwords do not match!.';
					}
				}

				//make sure that errors are empty
				if (empty($data['passwordError']) && empty($data['confirmPasswordError'])) {

					//Hash password
					$data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

					//Update password and remove record from resetpasswords table
					if($this->userModel->updatePassword($data['email'], $data['password'])) {

						if($this->userModel->deleteCode($data['code'])){
							echo 'password updated!';
							header('location: ' . URLROOT . '/users/login');
						}

					} else {
						die('Something went wrong.');
					}
				}

			}

			$this->view('users/reset_password', $data);
		}


	}