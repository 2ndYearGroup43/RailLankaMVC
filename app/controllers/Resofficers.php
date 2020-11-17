<?php
    class Resofficers extends Controller{
        public function __construct()
        {
            $this->resofficerModel=$this->model('Resofficer');
        }

        public function index() {

            // $users = $this->userModel->getUsers();

            $data = [
                'title' => 'Resofficer Home Page',
                // 'users' => $users
            ];

            $this->view('resofficers/index', $data); //
        }

        public function registerResofficer()
        {
            $data=[
                'officerId'=>'',
                'employeeId'=>'',
                'firstName'=>'',
                'lastName'=>'',
                'email'=>'',
                'mobileNo'=>'',
                'password'=>'',
                'confirmPassword'=>'',
                'regDate'=>'',
                'regTime'=>'',
                'officerIdError'=>'',
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
                $data=[
                    'officerId'=>trim($_POST['officerId']),
                    'employeeId'=>trim($_POST['employeeId']),
                    'firstName'=>trim($_POST['firstName']),
                    'lastName'=>trim($_POST['lastName']),
                    'email'=>trim($_POST['email']),
                    'mobileNo'=>trim($_POST['mobileNo']),
                    'password'=>trim($_POST['password']),
                    'confirmPassword'=>trim($_POST['confirmPassword']),
                    'regDate'=>date("Y-m-d"),
                    'regTime'=>date("H:i:sa"),
                    'officerIdError'=>'',
                    'employeeIdError'=>'',
                    'firstNameError'=>'',
                    'lastNameError'=>'',
                    'emailError'=>'',
                    'mobileNoError'=>'',
                    'passwordError'=>'',
                    'confirmPasswordError'=>''              
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

                if(empty($data['officerIdError']) && empty($data['employeerIdError']) &&
                empty($data['firstNameError']) && empty($data['lastNameError']) && 
                empty($data['emailError']) && empty($data['mobileNoError']) &&
                empty($data['passwordError']) && empty($data['confirmPasswordError'])){
                        //Hash passsword
                        echo "hariiii";
                        $data['password']=password_hash($data['password'], PASSWORD_DEFAULT);
                        //Rgoster user from model function
                        if($this->resofficerModel->registerResofficer($data)){
                            //Redrects to the login page
                            header('Location: '.URLROOT.'/resofficers/viewResofficers');
                        }else{
                            die('Something went wrong');
                        }
                }

            }

            $this->view('resofficers/registerResofficer', $data);
        }



        public function updateResofficer($userId)
        {
            echo "here";

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
                        //Rgoster user from model function
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




        public function viewResofficers()
        {
            $resofficers=$this->resofficerModel->getResofficers();
            $fields=$this->resofficerModel->getResofficerFields();
            $data=[
                'resofficers'=>$resofficers,
                'fields'=>$fields
            ];

            $this->view('resofficers/manageResofficers', $data);
        }

        public function resofficersSearchBy()
        {
            if (!isResofficerLoggedIn()) {
                header("Location: ".URLROOT."/resofficers/login");
                exit;
            }
            $data=[
                'resofficers'=>'',
                'fields'=>'',
                'searchBar'=>'',
                'searchSelect'=>''
            ];
            if($_SERVER['REQUEST_METHOD']=='POST'){
                $_POST=filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
                $data=[
                    'officers'=>'',
                    'fields'=>'',
                    'searchBar'=>trim($_POST['searchbar']),
                    'searchSelect'=>trim($_POST['searchselect'])
                ];

                $resofficers=$this->resofficerModel->searchResofficers($data['searchBar'],$data['searchSelect']);
                $fields=$this->resofficerModel->getResofficerFields();
                $data=[
                    'officers'=>$officers,
                    'fields'=>$fields,
                    'searchBar'=>trim($_POST['searchbar']),
                    'searchSelect'=>trim($_POST['searchselect'])
                ];
                
            }  
            $this->view('resofficers/manageResofficers', $data);

        }

        public function deleteUser($userId)
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





        public function login()
        {
            $data = [
                'title'=>'Login page',
                'username'=>'',
                'password'=>'',
                'usernameError'=>'',
                'passwordError'=>''
            ];


            if($_SERVER['REQUEST_METHOD']=='POST'){
                //sanitize te data
                $_POST=filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
                $data=[
                    'username'=>trim($_POST['username']),
                    'password'=>trim($_POST['password']),
                    'usernameError'=>'',
                    'passwordError'=>''
                ];

                if(empty($data['username'])){
                    $data['usernameError']="Please enter a username.";   
                }
                if(empty($data['password'])){
                    $data['passwordError']="Please enter a password.";
                }

                if(empty($data['usernameError'])&& empty($data['passwordError'])){
                    $loggedInUser=$this->resofficerModel->login($data['username'] ,$data['password']);
                    
                    if($loggedInUser){
                        $this->createUserSession($loggedInUser);
                    }else{
                        $data['passwordError']='Username or Password is incorrect.
                        Please try again.';

                        $this->view('users/login', $data);
                    }
                }
            
            }else{
                $data=[
                    'username'=>'',
                    'password'=>'',
                    'usernameError'=>'',
                    'passwordError'=>''
                ];
            }



            $this->view('users/login', $data);
        }


        public function createUserSession($loggedInUser)
        {
            
            $_SESSION['resofficer_id']= $loggedInUser->officerId;
            $_SESSION['employee_id']= $loggedInUser->employeeId;
            $_SESSION['email']= $loggedInUser->email;

            header('location: '.URLROOT.'/pages/index');
            
        }

        public function logout()
        {
           
            unset($_SESSION['ro_id']);
            unset($_SESSION['userid']);
            unset($_SESSION['email']);
            unset($_SESSION['role']);

            header('location:' . URLROOT . '/pages/index');
            
        }
    }