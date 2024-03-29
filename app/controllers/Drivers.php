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
                // 'confirmPassword'=>'',
                'regDate'=>'',
                'regTime'=>'',
                'driverIdError'=>'',
                'employeeIdError'=>'',
                'firstNameError'=>'',
                'lastNameError'=>'',
                'emailError'=>'',
                'mobileNoError'=>'',
                // 'passwordError'=>'',
                // 'confirmPasswordError'=>''              
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
                    'password'=>'',
                    // 'confirmPassword'=>trim($_POST['confirmPassword']),
                    'regDate'=>date("Y-m-d"),
                    'regTime'=>date("H:i:sa"),
                    'driverIdError'=>'',
                    'employeeIdError'=>'',
                    'firstNameError'=>'',
                    'lastNameError'=>'',
                    'emailError'=>'',
                    'mobileNoError'=>'',
                    // 'passwordError'=>'',
                    // 'confirmPasswordError'=>''              
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

                $informPass=$data['email'].$data['driverId'];
                $data['password']=$informPass;
                $userEmail=$data['email'];


                if(empty($data['driverIdError']) && empty($data['employeerIdError']) &&
                empty($data['firstNameError']) && empty($data['lastNameError']) && 
                empty($data['emailError']) && empty($data['mobileNoError'])){
                // empty($data['passwordError']) && empty($data['confirmPasswordError'])){
                        //Hash passsword
                        echo "hariiii";
                        $data['password']=password_hash($data['password'], PASSWORD_DEFAULT);
                        //Rgoster user from model function
                        if($this->driverModel->registerDriver($data)){
                            //Redrects to the manage  page
                            $this->informEmployeeOfthePassword($userEmail, $informPass);
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


        
        public function informEmployeeOfthePassword($email, $password)
        {   
            require APPROOT . '/libraries/PHPMailer/src/Exception.php';
            require APPROOT . '/libraries/PHPMailer/src/PHPMailer.php';
            require APPROOT . '/libraries/PHPMailer/src/SMTP.php';
            $code = uniqid(true);

            if(!$this->driverModel->requestReset($email,$code)){
                die('Something went wrong');
            }

            $mail = new PHPMailer(true);

            try {
                //Server settings   
                $mail->isSMTP();                                            // Send using SMTP
                $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
                $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
                $mail->Username   = PROJECTEMAIL;                     // SMTP username
                $mail->Password   = PROJECTEMAILPASSWORD;                               // SMTP password
                $mail->SMTPSecure = 'ssl';         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
                $mail->Port       = 465;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

                //Recipients
                $mail->setFrom(PROJECTEMAIL, 'RailLanka');
                $mail->addAddress($email);     // Add a recipient
                        // Name is optional
                $mail->addReplyTo('no-reply@example.com', 'Information', 'No reply');
            
                // Content
                $mail->isHTML(true); 
                $url = URLROOT . "/users/resetPassword?code=$code";   //  

                // Set email format to HTML
                $mail->Subject = 'Driver Registration';
                $mail->Body    = "<h1>You have successfully registered as a Driver</h1><p>Your Password has been set to ".$password." . You can use it 
                to login and change it to your preferred password at anytime by clicking the link below</p> Click on <a href='$url'>this link</a> to reset your password</h1>";
                $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

                $mail->send();
                // $msg = 'Reset password link has been sent to your email';
                return;

            } catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }
        
			exit();
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



        


        





        public function deleteUser($userId)
        {
            if($_SERVER['REQUEST_METHOD']=='POST'){
                $_POST=filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
                if ($this->driverModel->deleteUser($userId)) {
                    header("Location: ".URLROOT."/drivers/viewdrivers");
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