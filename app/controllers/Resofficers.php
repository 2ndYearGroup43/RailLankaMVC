<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

    class Resofficers extends Controller{
        public function __construct()
        {
            $this->resofficerModel=$this->model('Resofficer');
        }

        public function index() { // index function

            $data = [
                'title' => 'Resofficer Home Page',
            ];

            $this->view('resofficers/index', $data); 
        }

        public function registerResofficer() // add reservation officer data
        {
            $data=[
                'officerId'=>'',
                'employeeId'=>'',
                'firstName'=>'',
                'lastName'=>'',
                'email'=>'',
                'mobileNo'=>'',
                'password'=>'',
                'regDate'=>'',
                'regTime'=>'',
                'officerIdError'=>'',
                'employeeIdError'=>'',
                'firstNameError'=>'',
                'lastNameError'=>'',
                'emailError'=>'',
                'mobileNoError'=>'',             
            ];

            if($_SERVER['REQUEST_METHOD']=='POST'){
                //sanitize post data
                $_POST=filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
                $data=[
                    'officerId'=>trim($_POST['officerId']),
                    'employeeId'=>trim($_POST['employeeId']),
                    'firstName'=>trim($_POST['firstName']),
                    'lastName'=>trim($_POST['lastName']),
                    'email'=>trim($_POST['email']),
                    'mobileNo'=>trim($_POST['mobileNo']),
                    'password'=>'',
                    'regDate'=>date("Y-m-d"),
                    'regTime'=>date("H:i:sa"),
                    'officerIdError'=>'',
                    'employeeIdError'=>'',
                    'firstNameError'=>'',
                    'lastNameError'=>'',
                    'emailError'=>'',
                    'mobileNoError'=>'',             
                ];
                $idValidation="/^[a-zA-Z0-9]*$/";
                $nameValidation="/^[a-zA-Z]*$/";
                $mobileValidation="/^[0-9]{10}+$/";
                $passwordValidation= "/^(?=.*[a-z])(?=.*\\d).{8,}$/i";
                if(empty($data['officerId'])){
                    $data['officerIdError']='Please Enter the Officer ID.';
                }elseif(!preg_match($idValidation, $data['officerId'])){
                    $data['officerIdError']="Officer ID can only contain letters and numbers.";
                }else{
                    //if officerID exists
                    if($this->resofficerModel->findResofficerByResofficerId($data['officerId'])){
                        $data['officerIdError']='This ID is already registered as a Officer in the system.'; 
                    }
                }
                if(empty($data['employeeId'])){
                    $data['employeeIdError']='Please Enter the Employee ID.';
                }elseif(!preg_match($idValidation, $data['employeeId'])){
                    $data['employeeIdError']="Employee ID can only contain letters and numbers.";
                }else{
                    //if Employee ID exists
                    if($this->resofficerModel->findResofficerByEmployeeId($data['employeeId'])){
                        $data['employeeIdError']='This employee is already registered as a Officer in the system.'; 
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
                    if($this->resofficerModel->findResofficerByEmail($data['email'])){
                        $data['emailError']='Entered email is already registered in the system.'; 
                    }
                }

                if(empty($data['mobileNo'])){
                    $data['mobileNoError']='Please Enter the Mobile No.';
                }elseif(!preg_match($mobileValidation, $data['mobileNo'])){
                    $data['mobileNoError']="Name can only contain numbers and +.";
                }


                $informPass=$data['email'].$data['officerId'];
                $data['password']=$informPass;
                $userEmail=$data['email'];

                if(empty($data['officerIdError']) && empty($data['employeerIdError']) &&
                empty($data['firstNameError']) && empty($data['lastNameError']) && 
                empty($data['emailError']) && empty($data['mobileNoError'])){

                       
                        $data['password']=password_hash($data['password'], PASSWORD_DEFAULT);
                        //Register user from model function
                        if($this->resofficerModel->registerResofficer($data)){
                            //Redrects to the login page
                            
                            $this->informEmployeeOfthePassword($userEmail, $informPass);
                            header('Location: '.URLROOT.'/resofficers/viewResofficers');
                        }else{
                            die('Something went wrong');
                        }
                }

            }

            $this->view('resofficers/registerResofficer', $data);
        }


        public function informEmployeeOfthePassword($email, $password) // send email
        {   
            require APPROOT . '/libraries/PHPMailer/src/Exception.php';
            require APPROOT . '/libraries/PHPMailer/src/PHPMailer.php';
            require APPROOT . '/libraries/PHPMailer/src/SMTP.php';
            $code = uniqid(true);

            if(!$this->resofficerModel->requestReset($email,$code)){
                die('Something went wrong');
            }

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
                $mail->addAddress($email);     // Add a recipient
                        // Name is optional
                $mail->addReplyTo('no-reply@example.com', 'Information', 'No reply');
            
                // Content
                $mail->isHTML(true); 
                $url = URLROOT . "/users/resetPassword?code=$code";   //  

                // Set email format to HTML
                $mail->Subject = 'Reservation Offiver Registration';
                $mail->Body    = "<h1>You have successfully registered as a Reservation Officer</h1><p>Your Password has been set to ".$password." . You can use it 
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




        public function updateResofficer($userId) // update resofficer data
        {

            $resofficer=$this->resofficerModel->findResofficerById($userId);
            $data=[
                'userId'=>$userId,
                'resofficer'=>$resofficer,
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
                    'resofficer'=>$resofficer,
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
                if(empty($data['officerId'])){
                    $data['officerIdError']='Please Enter the Officer ID.';
                }elseif(!preg_match($idValidation, $data['officerId'])){
                    $data['officerIdError']="Officer ID can only contain letters and numbers.";
                }else{
                    //if officerID exists
                    if($this->resofficerModel->findResofficerByResofficerId($data['officerId'])){
                        $data['officerIdError']='This ID is already registered as a Officer in the system.'; 
                    }
                }
                if(empty($data['employeeId'])){
                    $data['employeeIdError']='Please Enter the Employee ID.';
                }elseif(!preg_match($idValidation, $data['employeeId'])){
                    $data['employeeIdError']="Employee ID can only contain letters and numbers.";
                }else{
                    //if Employee ID exists
                    if($this->resofficerModel->findResofficerByEmployeeId($data['employeeId']) &&
                    $this->resofficerModel->findResofficerById($userId)->employeeId!=$data['employeeId']){
                        $data['employeeIdError']='This employee is already registered as a Officer in the system.'; 
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
                    if($this->resofficerModel->findResofficerByEmail($data['email']) &&
                    $this->resofficerModel->findResofficerById($userId)->email!=$data['email']){
                        $data['emailError']='Entered email is already registered in the system.'; 
                    }
                }

                if(empty($data['mobileNo'])){
                    $data['mobileNoError']='Please Enter the Mobile No.';
                }elseif(!preg_match($mobileValidation, $data['mobileNo'])){
                    $data['mobileNoError']="Name can only contain numbers and +.";
                }

                //password validate by length and numeric values
               

                if ($data['employeeId']==$this->resofficerModel->findResofficerById($userId)->employeeId &&
                    $data['firstName']==$this->resofficerModel->findResofficerById($userId)->firstname &&
                    $data['lastName']==$this->resofficerModel->findResofficerById($userId)->lastname &&
                    $data['email']==$this->resofficerModel->findResofficerById($userId)->email &&
                    $data['mobileNo']==$this->resofficerModel->findResofficerById($userId)->mobileno
                    ){
                        $data['officerIdError']='No change was detected at any field';
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
                        //Register user from model function
                        if($this->resofficerModel->updateResofficer($data)){
                            //Redrects to the login page
                            header('Location: '.URLROOT.'/resofficers/viewResofficers');
                        }else{
                            die('Something went wrong');
                        }
                }

            }

            $this->view('resofficers/updateResofficer', $data);
        }




        public function viewResofficers() // view resofficer data
        {
            $resofficers=$this->resofficerModel->getResofficers();
            $fields=$this->resofficerModel->getResofficerFields();
            $data=[
                'resofficers'=>$resofficers,
                'fields'=>$fields
            ];

            $this->view('resofficers/manageResofficers', $data);
        }

        public function resofficersSearchBy() // resofficer search
        {
           
            $data=[
                'resofficers'=>'',
                'fields'=>'',
                'searchBar'=>'',
                'searchSelect'=>''
            ];
            if($_SERVER['REQUEST_METHOD']=='POST'){
                $_POST=filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
                $data=[
                    'resofficers'=>'',
                    'fields'=>'',
                    'searchBar'=>trim($_POST['searchbar']),
                    'searchSelect'=>trim($_POST['searchselect'])
                ];

                $resofficers=$this->resofficerModel->searchResofficers($data['searchBar'],$data['searchSelect']);
                $fields=$this->resofficerModel->getResofficerFields();
                $data=[
                    'resofficers'=>$resofficers,
                    'fields'=>$fields,
                    'searchBar'=>trim($_POST['searchbar']),
                    'searchSelect'=>trim($_POST['searchselect'])
                ];
                
            }  
            $this->view('resofficers/manageResofficers', $data);

        }

        public function resofficerAccount() // resofficer account details
        {
            $id = $_SESSION['userid'];
            $resofficer=$this->resofficerModel->findResofficerById($id);
            $data=[
                'resofficer'=>$resofficer,
                'id'=>$id
            ];

            $this->view('resofficers/resofficerAccount', $data);
        }

        public function deleteUser($userId) // delete resofficer
        {
            if($_SERVER['REQUEST_METHOD']=='POST'){
                $_POST=filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
                if ($this->resofficerModel->deleteUser($userId)) {
                    header("Location: ".URLROOT."/resofficers/viewResofficers");
                } else {
                    die("Something went wrong");
                }
                
            }
            
        }

        public function logout() { // logout resofficer
            unset($_SESSION['userid']);
            unset($_SESSION['email']);
            unset($_SESSION['role']);
            unset($_SESSION['resofficer_id']);
            header('location:' . URLROOT . '/pages/index');
        }
    }