<?php
    class Moderators extends Controller{
        public function __construct()
        {
            $this->moderatorModel=$this->model('Moderator');
        }


        
		public function index() {

			// $users = $this->userModel->getUsers();

			$data = [
				'title' => 'Moderator Home Page',
				// 'users' => $users
			];

			$this->view('moderators/index', $data); //
		}

        

        public function registerModerator()
        {
            $data=[
                'moderatorId'=>'',
                'employeeId'=>'',
                'firstName'=>'',
                'lastName'=>'',
                'email'=>'',
                'mobileNo'=>'',
                'password'=>'',
                'confirmPassword'=>'',
                'regDate'=>'',
                'regTime'=>'',
                'moderatorIdError'=>'',
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
                    'moderatorId'=>trim($_POST['moderatorId']),
                    'employeeId'=>trim($_POST['employeeId']),
                    'firstName'=>trim($_POST['firstName']),
                    'lastName'=>trim($_POST['lastName']),
                    'email'=>trim($_POST['email']),
                    'mobileNo'=>trim($_POST['mobileNo']),
                    'password'=>trim($_POST['password']),
                    'confirmPassword'=>trim($_POST['confirmPassword']),
                    'regDate'=>date("Y-m-d"),
                    'regTime'=>date("H:i:sa"),
                    'moderatorIdError'=>'',
                    'employeeIdError'=>'',
                    'firstNameError'=>'',
                    'lastNameError'=>'',
                    'emailError'=>'',
                    'mobileNoError'=>'',
                    'passwordError'=>'',
                    'confirmPasswordError'=>''              
                ];
                echo "wtf";
                echo $data['moderatorId'];
                $idValidation="/^[a-zA-Z0-9]*$/";
                $nameValidation="/^[a-zA-Z]*$/";
                $mobileValidation="/^[0-9]{10}+$/";
                $passwordValidation= "/^(?=.*[a-z])(?=.*\\d).{8,}$/i";
                if(empty($data['moderatorId'])){
                    $data['moderatorIdError']='Please Enter the Moderator ID.';
                }elseif(!preg_match($idValidation, $data['moderatorId'])){
                    $data['moderatorIdError']="Moderator ID can only contain letters and numbers.";
                }else{
                    //if moderatorID exists
                    if($this->moderatorModel->findModeratorByModeratorId($data['moderatorId'])){
                        $data['moderatorIdError']='This ID is already registered as a Moderator in the system.'; 
                    }
                }
                if(empty($data['employeeId'])){
                    $data['employeeIdError']='Please Enter the Employee ID.';
                }elseif(!preg_match($idValidation, $data['employeeId'])){
                    $data['employeeIdError']="Employee ID can only contain letters and numbers.";
                }else{
                    //if Employee ID exists
                    if($this->moderatorModel->findModeratorByEmployeeId($data['employeeId'])){
                        $data['employeeIdError']='This employee is already registered as a Moderator in the system.'; 
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
                    if($this->moderatorModel->findModeratorByEmail($data['email'])){
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

                if(empty($data['moderatorIdError']) && empty($data['employeerIdError']) &&
                empty($data['firstNameError']) && empty($data['lastNameError']) && 
                empty($data['emailError']) && empty($data['mobileNoError']) &&
                empty($data['passwordError']) && empty($data['confirmPasswordError'])){
                        //Hash passsword
                        echo "hariiii";
                        $data['password']=password_hash($data['password'], PASSWORD_DEFAULT);
                        //Rgoster user from model function
                        if($this->moderatorModel->registerModerator($data)){
                            //Redrects to the login page
                            header('Location: '.URLROOT.'/moderators/viewModerators');
                        }else{
                            die('Something went wrong');
                        }
                }

            }

            $this->view('moderators/registermoderator', $data);
        }



        public function updateModerator($userId)
        {
            echo "here";

            $moderator=$this->moderatorModel->findModeratorById($userId);
            $data=[
                'userId'=>$userId,
                'moderator'=>$moderator,
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
                    'moderator'=>$moderator,
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
                if(empty($data['moderatorId'])){
                    $data['moderatorIdError']='Please Enter the Moderator ID.';
                }elseif(!preg_match($idValidation, $data['moderatorId'])){
                    $data['moderatorIdError']="Moderator ID can only contain letters and numbers.";
                }else{
                    //if moderatorID exists
                    if($this->moderatorModel->findModeratorByModeratorId($data['moderatorId'])){
                        $data['moderatorIdError']='This ID is already registered as a Moderator in the system.'; 
                    }
                }
                if(empty($data['employeeId'])){
                    $data['employeeIdError']='Please Enter the Employee ID.';
                }elseif(!preg_match($idValidation, $data['employeeId'])){
                    $data['employeeIdError']="Employee ID can only contain letters and numbers.";
                }else{
                    //if Employee ID exists
                    if($this->moderatorModel->findModeratorByEmployeeId($data['employeeId']) &&
                    $this->moderatorModel->findModeratorById($userId)->employeeId!=$data['employeeId']){
                        $data['employeeIdError']='This employee is already registered as a Moderator in the system.'; 
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
                    if($this->moderatorModel->findModeratorByEmail($data['email']) &&
                    $this->moderatorModel->findModeratorById($userId)->email!=$data['email']){
                        $data['emailError']='Entered email is already registered in the system.'; 
                    }
                }

                if(empty($data['mobileNo'])){
                    $data['mobileNoError']='Please Enter the Mobile No.';
                }elseif(!preg_match($mobileValidation, $data['mobileNo'])){
                    $data['mobileNoError']="Name can only contain numbers and +.";
                }

                //password validate by length and numeric values
               

                if ($data['employeeId']==$this->moderatorModel->findModeratorById($userId)->employeeId &&
                    $data['firstName']==$this->moderatorModel->findModeratorById($userId)->firstname &&
                    $data['lastName']==$this->moderatorModel->findModeratorById($userId)->lastname &&
                    $data['email']==$this->moderatorModel->findModeratorById($userId)->email &&
                    $data['mobileNo']==$this->moderatorModel->findModeratorById($userId)->mobileno
                    ){
                        $data['moderatorIdError']='No change was detected at any field';
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
                        if($this->moderatorModel->updateModerator($data)){
                            //Redrects to the login page
                            header('Location: '.URLROOT.'/moderators/viewModerators');
                        }else{
                            die('Something went wrong');
                        }
                }

            }

            $this->view('moderators/updateModerator', $data);
        }




        public function viewModerators()
        {
            $moderators=$this->moderatorModel->getModerators();
            $fields=$this->moderatorModel->getModeratorFields();
            $data=[
                'moderators'=>$moderators,
                'fields'=>$fields
            ];

            $this->view('moderators/manageModerators', $data);
        }

        public function moderatorsSearchBy()
        {
            if (!isModeratorLoggedIn()) {
                header("Location: ".URLROOT."/moderators/login");
                exit;
            }
            $data=[
                'moderators'=>'',
                'fields'=>'',
                'searchBar'=>'',
                'searchSelect'=>''
            ];
            if($_SERVER['REQUEST_METHOD']=='POST'){
                $_POST=filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
                $data=[
                    'moderators'=>'',
                    'fields'=>'',
                    'searchBar'=>trim($_POST['searchbar']),
                    'searchSelect'=>trim($_POST['searchselect'])
                ];

                $moderators=$this->moderatorModel->searchModerators($data['searchBar'],$data['searchSelect']);
                $fields=$this->moderatorModel->getModeratorFields();
                $data=[
                    'moderators'=>$moderators,
                    'fields'=>$fields,
                    'searchBar'=>trim($_POST['searchbar']),
                    'searchSelect'=>trim($_POST['searchselect'])
                ];
                
            }  
            $this->view('moderators/manageModerators', $data);

        }

        public function deleteUser($userId)
        {
            if($_SERVER['REQUEST_METHOD']=='POST'){
                $_POST=filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
                if ($this->moderatorModel->deleteUser($userId)) {
                    header("Location: ".URLROOT."/moderators/viewModerators");
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
                    $loggedInUser=$this->moderatorModel->login($data['username'] ,$data['password']);
                    
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
            
            $_SESSION['moderator_id']= $loggedInUser->moderatorId;
            $_SESSION['employee_id']= $loggedInUser->employeeId;
            $_SESSION['email']= $loggedInUser->email;

            header('location: '.URLROOT.'/alerts/index');
            
        }

        public function logout()
        {
            unset($_SESSION['moderator_id']);
            unset($_SESSION['employee_id']);
            unset($_SESSION['email']);

            header('location: '.URLROOT.'/moderators/login');
            
        }
    }