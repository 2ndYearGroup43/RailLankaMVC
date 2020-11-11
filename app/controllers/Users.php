<?php 
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
			redirect($_SESSION['role']);
			// $role = $this->userModel->getRole($user->id);

			// if($role)
			// {
				// if($user->role==1)
				// {
				// 	$_SESSION['role'] = "passenger";
				// 	header('location:' . URLROOT . '/pages/index');
				// }

				// if($user->role==2)
				// {
				// 	$_SESSION['role'] = "admin";
				// 	header('location:' . URLROOT . '/admins/index');
				// }

				// if($user->role==3)
				// {
				// 	$_SESSION['role'] = "moderator";
				// 	header('location:' . URLROOT . '/moderators/index');
				// }

				// if($user->role==4)
				// {
				// 	$_SESSION['role'] = "driver";
				// 	header('location:' . URLROOT . '/drivers/index');
				// }

				// if($user->role==5)
				// {
				// 	$_SESSION['role'] = "resofficer";
				// 	header('location:' . URLROOT . '/resofficers/index');
				// }
			// }			
		}

		public function logout() {
			unset($_SESSION['userid']);
			unset($_SESSION['email']);
			unset($_SESSION['role']);
			header('location:' . URLROOT . '/pages/index');
		}
	}