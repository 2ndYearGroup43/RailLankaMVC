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
				'email' => '',
				'password' => '',
				'confirmPassword' => '',
				'role' => '',
				'reg_date' => '',
				'reg_time' => '',
				'nicError' => '',
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
					// 'username' => trim($_POST['username']),
					'email' => trim($_POST['email']),
					'password' => trim($_POST['password']),
					'confirmPassword' => trim($_POST['confirmPassword']),
					'role' => 1,
					'reg_date'=>date("Y-m-d"),
                    'reg_time'=>date("H:i:sa"),
                    'nicError' => '',
					'usernameError' => '',
					'emailError' => '',
					'passwordError' => '',
					'confirmPasswordError' => ''
				];

				
				$nameValidation = "/^[a-zA-Z0-9]*$/";
				$passwordValidation = "/^(.{0,7}|[^a-z]*|[^\d]*)$/i";


				//validate nic on letters and numbers
				if (empty($data['nic'])) {
					$data['nicError'] = 'Please enter username.';
				} elseif (!preg_match($nameValidation, $data['nic'])) {
					$data['nicError'] = 'NIC can only contain letters and numbers.';
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
				if (empty($data['nicError']) && empty($data['emailError']) && empty($data['passwordError']) && empty($data['confirmPasswordError'])) {

					//Hash password
					$data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

					//Register user from model function
					if($this->userModel->register($data)) {

						//redirect to the login page
						header('location: ' . URLROOT . '/users/login');
					} else {
						die('Something went wrong.');
					}
				}

			}

			$this->view('users/register', $data);
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
						$this->createUserSession($loggedInUser);
					} else {
						$data['passwordError'] = 'Password or username is incorrect. Please try again';

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
			
			if($user->role)
			{
				if($user->role==1)
				{
					$passenger=$this->userModel->getPassengerById($user->userid);
					$_SESSION['passenger_nic'] = $passenger->nic;
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
					$_SESSION['driver_nic'] = $driver->driverId;
				}

				if($user->role==5)
				{
					$RO=$this->userModel->getROById($user->userid);
					$_SESSION['ro_id'] = $RO->officerId;
				}
			}

			redirect($_SESSION['role']);	
		}

		public function logout() {
			unset($_SESSION['userid']);
			unset($_SESSION['email']);
			unset($_SESSION['role']);
			unset($_SESSION['passenger_nic']);
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
					        $mail->Body    = "<h1>You requested a password change</h1> Click on <a href='$url'>this link</a> to reset your password</h1>";
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