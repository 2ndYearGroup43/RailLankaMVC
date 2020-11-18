<?php	
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;
    
    class Drivers extends Controller{
        public function __construct()
        {
            $this->driverModel=$this->model('Driver');
        }


        public function index()
        {
            $this->view('drivers/afterLogin');
        }

        

        public function registerDriver()
        {
            $data=[
                'driverId'=>'',
                'employeeId'=>'',
                'firstName'=>'',
                'lastName'=>'',
                'email'=>'',
                'mobileNo'=>'',
                'password'=>'',
                'confirmPassword'=>'',
                'regDate'=>'',
                'regTime'=>'',
                'driverIdError'=>'',
                'employeeIdError'=>'',
                'firstNameError'=>'',
                'lastNameError'=>'',
                'emailError'=>'',
                'mobileNoError'=>'',
                'passwordError'=>'',
                'confirmPasswordError'=>''              
            ];

            if($_SERVER['REQUEST_METHOD']=='POST'){
                //sanitize post data
                $_POST=filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
                echo "hariiii";
                $data=[
                    'driverId'=>trim($_POST['driverId']),
                    'employeeId'=>trim($_POST['employeeId']),
                    'firstName'=>trim($_POST['firstName']),
                    'lastName'=>trim($_POST['lastName']),
                    'email'=>trim($_POST['email']),
                    'mobileNo'=>trim($_POST['mobileNo']),
                    'password'=>trim($_POST['password']),
                    'confirmPassword'=>trim($_POST['confirmPassword']),
                    'regDate'=>date("Y-m-d"),
                    'regTime'=>date("H:i:sa"),
                    'driverIdError'=>'',
                    'employeeIdError'=>'',
                    'firstNameError'=>'',
                    'lastNameError'=>'',
                    'emailError'=>'',
                    'mobileNoError'=>'',
                    'passwordError'=>'',
                    'confirmPasswordError'=>''              
                ];
                echo "wtf";
                echo $data['driverId'];
                $idValidation="/^[a-zA-Z0-9]*$/";
                $nameValidation="/^[a-zA-Z]*$/";
                $mobileValidation="/^[0-9]{10}+$/";
                $passwordValidation= "/^(?=.*[a-z])(?=.*\\d).{8,}$/i";
                if(empty($data['driverId'])){
                    $data['driverIdError']='Please Enter the Driver ID.';
                }elseif(!preg_match($idValidation, $data['driverId'])){
                    $data['driverIdError']="Driver ID can only contain letters and numbers.";
                }else{
                    //if driverId exists
                    if($this->driverModel->findDriverBydriverId($data['driverId'])){
                        $data['driverIdError']='This ID is already registered as a Driver in the system.'; 
                    }
                }
                if(empty($data['employeeId'])){
                    $data['employeeIdError']='Please Enter the Employee ID.';
                }elseif(!preg_match($idValidation, $data['employeeId'])){
                    $data['employeeIdError']="Employee ID can only contain letters and numbers.";
                }else{
                    //if Employee ID exists
                    if($this->driverModel->findDriverByEmployeeId($data['employeeId'])){
                        $data['employeeIdError']='This employee is already registered as a Driver in the system.'; 
                    }
                }
                if(empty($data['firstName'])){
                    $data['firstNameError']='Please Enter the First Name.';
                }elseif(!preg_match($nameValidation, $data['firstName'])){
                    $data['firstNameError']="Name can only contain letters.";
                }
                if(empty($data['lastName'])){
                    $data['lastNameError']='Please Enter the Last Name.';
                }elseif(!preg_match($nameValidation, $data['lastName'])){
                    $data['lastNameError']="Name can only contain letters.";
                }
                if(empty($data['email'])){
                    $data['emailError']='Please Enter the Email address.';
                }elseif(!filter_var($data['email'], FILTER_VALIDATE_EMAIL)){
                    $data['emailError']='Please enter the correct format';
                }else{
                    //if email exists
                    if($this->driverModel->findDriverByEmail($data['email'])){
                        $data['emailError']='Entered email is already registered in the system.'; 
                    }
                }

                if(empty($data['mobileNo'])){
                    $data['mobileNoError']='Please Enter the Mobile No.';
                }elseif(!preg_match($mobileValidation, $data['mobileNo'])){
                    $data['mobileNoError']="Name can only contain numbers and +.";
                }

                //password validate by length and numeric values
                if(empty($data['password'])){
                    $data['passwordError']='Please Enter the passsword.';
                }elseif (strlen($data['password'])<8) {
                    $data['passwordError']="Password length should be atleast 8 characters long";
                }elseif(!preg_match($passwordValidation, $data['password'])){
                    $data['passwordError']="Password must have atleast one numeric value.";
                }

                if(empty($data['confirmPassword'])){
                    $data['confirmPasswordError']='Please Enter the passsword.';
                }else{
                    if($data['password']!=$data['confirmPassword']){
                        $data['confirmPasswordError']='Passwords do not match.';
                    }
                }

                if(empty($data['driverIdError']) && empty($data['employeerIdError']) &&
                empty($data['firstNameError']) && empty($data['lastNameError']) && 
                empty($data['emailError']) && empty($data['mobileNoError']) &&
                empty($data['passwordError']) && empty($data['confirmPasswordError'])){
                        //Hash passsword
                        echo "hariiii";
                        $data['password']=password_hash($data['password'], PASSWORD_DEFAULT);
                        //Rgoster user from model function
                        if($this->driverModel->registerDriver($data)){
                            //Redrects to the login page
                            header('Location: '.URLROOT.'/drivers/viewDrivers');
                        }else{
                            die('Something went wrong');
                        }
                }else{
                    $this->view('drivers/registerdriver', $data);
                }


            }

            $this->view('drivers/registerdriver', $data);
        }



        public function updateDriver($userId)
        {
            echo "here";

            $driver=$this->driverModel->findDriverById($userId);
            $data=[
                'userId'=>$userId,
                'driver'=>$driver,
                'employeeId'=>'',
                'firstName'=>'',
                'lastName'=>'',
                'email'=>'',
                'mobileNo'=>'',
                'employeeIdError'=>'',
                'firstNameError'=>'',
                'lastNameError'=>'',
                'emailError'=>'',
                'mobileNoError'=>''             
            ];

            if($_SERVER['REQUEST_METHOD']=='POST'){
                //sanitize post data
                $_POST=filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
                echo "hariiii";
                $data=[
                    'userId'=>$userId,
                    'driver'=>$driver,
                    'employeeId'=>trim($_POST['employeeId']),
                    'firstName'=>trim($_POST['firstName']),
                    'lastName'=>trim($_POST['lastName']),
                    'email'=>trim($_POST['email']),
                    'mobileNo'=>trim($_POST['mobileNo']),
                    'employeeIdError'=>'',
                    'firstNameError'=>'',
                    'lastNameError'=>'',
                    'emailError'=>'',
                    'mobileNoError'=>''          
                ];
                
                $idValidation="/^[a-zA-Z0-9]*$/";
                $nameValidation="/^[a-zA-Z]*$/";
                $mobileValidation="/^[0-9]{10}+$/";
                $passwordValidation= "/^(?=.*[a-z])(?=.*\\d).{8,}$/i";
                if(empty($data['driverId'])){
                    $data['driverIdError']='Please Enter the Driver ID.';
                }elseif(!preg_match($idValidation, $data['driverId'])){
                    $data['driverIdError']="Driver ID can only contain letters and numbers.";
                }else{
                    //if driverId exists
                    if($this->driverModel->findDriverBydriverId($data['driverId'])){
                        $data['driverIdError']='This ID is already registered as a Driver in the system.'; 
                    }
                }
                if(empty($data['employeeId'])){
                    $data['employeeIdError']='Please Enter the Employee ID.';
                }elseif(!preg_match($idValidation, $data['employeeId'])){
                    $data['employeeIdError']="Employee ID can only contain letters and numbers.";
                }else{
                    //if Employee ID exists
                    if($this->driverModel->findDriverByEmployeeId($data['employeeId']) &&
                    $this->driverModel->findDriverById($userId)->employeeId!=$data['employeeId']){
                        $data['employeeIdError']='This employee is already registered as a Driver in the system.'; 
                    }
                }
                if(empty($data['firstName'])){
                    $data['firstNameError']='Please Enter the First Name.';
                }elseif(!preg_match($nameValidation, $data['firstName'])){
                    $data['firstNameError']="Name can only contain letters.";
                }
                if(empty($data['lastName'])){
                    $data['lastNameError']='Please Enter the Last Name.';
                }elseif(!preg_match($nameValidation, $data['lastName'])){
                    $data['lastNameError']="Name can only contain letters.";
                }
                if(empty($data['email'])){
                    $data['emailError']='Please Enter the Email address.';
                }elseif(!filter_var($data['email'], FILTER_VALIDATE_EMAIL)){
                    $data['emailError']='Please enter the correct format';
                }else{
                    //if email exists
                    if($this->driverModel->findDriverByEmail($data['email']) &&
                    $this->driverModel->findDriverById($userId)->email!=$data['email']){
                        $data['emailError']='Entered email is already registered in the system.'; 
                    }
                }

                if(empty($data['mobileNo'])){
                    $data['mobileNoError']='Please Enter the Mobile No.';
                }elseif(!preg_match($mobileValidation, $data['mobileNo'])){
                    $data['mobileNoError']="Name can only contain numbers and +.";
                }

                //password validate by length and numeric values
               

                if ($data['employeeId']==$this->driverModel->findDriverById($userId)->employeeId &&
                    $data['firstName']==$this->driverModel->findDriverById($userId)->firstname &&
                    $data['lastName']==$this->driverModel->findDriverById($userId)->lastname &&
                    $data['email']==$this->driverModel->findDriverById($userId)->email &&
                    $data['mobileNo']==$this->driverModel->findDriverById($userId)->mobileno
                    ){
                        $data['driverIdError']='No change was detected at any field';
                        $data['employeeIdError']='No change was detected at any field'; 
                        $data['firstNameError']='No change was detected at any field';
                        $data['lastNameError']='No change was detected at any field';
                        $data['emailError']='No change was detected at any field';
                        $data['mobileNoError']='No change was detected at any field';
                }

                if(empty($data['employeerIdError']) && empty($data['firstNameError'])
                 && empty($data['lastNameError']) && 
                empty($data['emailError']) && empty($data['mobileNoError'])){
                        //Hash passsword
                        echo "hariiii";
                        //Rgoster user from model function
                        if($this->driverModel->updateDriver($data)){
                            //Redrects to the login page
                            header('Location: '.URLROOT.'/drivers/viewDrivers');
                        }else{
                            die('Something went wrong');
                        }
                }else{
                    $this->view('drivers/updateDriver', $data);
                }

            }

            $this->view('drivers/updateDriver', $data);
        }




        public function viewDrivers()
        {
            $drivers=$this->driverModel->getDrivers();
            $fields=$this->driverModel->getDriverFields();
            $data=[
                'drivers'=>$drivers,
                'fields'=>$fields
            ];

            $this->view('drivers/manageDrivers', $data);
        }

        public function driversSearchBy()
        {
           
            $data=[
                'drivers'=>'',
                'fields'=>'',
                'searchBar'=>'',
                'searchSelect'=>''
            ];
            if($_SERVER['REQUEST_METHOD']=='POST'){
                $_POST=filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
                $data=[
                    'drivers'=>'',
                    'fields'=>'',
                    'searchBar'=>trim($_POST['searchbar']),
                    'searchSelect'=>trim($_POST['searchselect'])
                ];

                $drivers=$this->driverModel->searchDrivers($data['searchBar'],$data['searchSelect']);
                $fields=$this->driverModel->getDriverFields();
                $data=[
                    'drivers'=>$drivers,
                    'fields'=>$fields,
                    'searchBar'=>trim($_POST['searchbar']),
                    'searchSelect'=>trim($_POST['searchselect'])
                ];
                
            }  
            $this->view('drivers/manageDrivers', $data);

        }


        

        public function driverForgotPassword()
        {
            $response=[
                'message'=>'',
                'email'=>'',
                'error'=>''
            ];

            if($_SERVER['REQUEST_METHOD']=='POST'){
                $_POST=filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

                $response=[
                    'message'=>'',
                    'email'=>trim($_POST('email')),
                    'error'=>''
                ];
                
                if(!empty($response['email'])){
                    $response['error']='true';
                    $response['message']='Email field is empty. Please enter your email';
                }elseif(!filter_var($response['email'], FILTER_VALIDATE_EMAIL)){
                    $response['error']='true';
                    $response['message']='Please enter a valid email';
                }
                elseif(!$this->driverModel->findDriverByEmail($response['email'])){
                    $response['error']='true';
                    $response['message']='This email does not exist in our system please enter the email that you have been registered into the system';
                }

                if(empty($response['error'])){
                    require APPROOT . '/libraries/PHPMailer/src/Exception.php';
					require APPROOT . '/libraries/PHPMailer/src/PHPMailer.php';
                    require APPROOT . '/libraries/PHPMailer/src/SMTP.php';
                    
                    if (isset($_POST['email'])) {
                        $emailTo=$_POST['email'];
                        $code=uniqid(true);
                        
                        if(!$this->driverModel->requestToReset($emailTo,  $code)){
                            $response['error']='true';
                            $response['message']="something went wrong process died";
                            $this->view('drivers/mobileapp/driverForgotPassword', $response);
                            exit();
                        }

                        $mail=new PHPMailer(true);

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
					        $url = URLROOT . "/drivers/resetPassword?code=$code";   //  

					        // Set email format to HTML
					        $mail->Subject = 'Your Password Request Link';
					        $mail->Body    = "<h1>You requested a password change</h1> Click on <a href='$url'>this link</a> to reset your password</h1>";
					        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

					        $mail->send();
					        // $msg = 'Reset password link has been sent to your email';
					        $this->view('drivers/mobileapp/success_resetrequest');

                        } catch (Exception $e) {
                            $response['error']='true';
                            $response['message']="Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                        }

                        exit();

                    }
                }
                
            }
            $this->view('drivers/mobileapp/driverForgotPassword', $response);

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
			$result = (array)$this->driverModel->findEmailByCode($code);
			// var_dump($result);
			
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
					if($this->driverModel->updatePassword($data['email'], $data['password'])) {

						if($this->driverModel->deleteCode($data['code'])){
							echo 'password updated!';
							$this->view('drivers/mobileapp/success_resetreset');
						}

					} else {
						die('Something went wrong.');
					}
				}

			}

			$this->view('drivers/mobileapp/reset_password', $data);
		}




        public function deleteUser($userId)
        {
            if($_SERVER['REQUEST_METHOD']=='POST'){
                $_POST=filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
                if ($this->driverModel->deleteUser($userId)) {
                    header("Location: ".URLROOT."/drivers/mobileapp/viewDrivers");
                } else {
                    die("Something went wrong");
                }
                
            }
            
        }





    }









//     <?php   
//     require_once "conn.php";
//     $user_email = $_POST['userName'];
//     $user_pass = $_POST['password'];

//     $stmt=$conn->prepare("SELECT u.* FROM users u INNER JOIN driver d ON u.userId=d.userId 
//     WHERE u.email=:email");

//     $stmt->bindValue(":email", $user_email, PDO::PARAM_STR);
//     $stmt->execute();
//     $row=$stmt->fetch(PDO::FETCH_OBJ);


//     // var_dump($row);

//     $hashedpassword=$row->password;
//     if(password_verify($user_pass, $hashedpassword)){
//         echo "authenticated!!!!!!!!!!!!";
//     }else{
//         echo "who dis";
//     }
    

?>