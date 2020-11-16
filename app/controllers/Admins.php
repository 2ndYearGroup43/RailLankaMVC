<?php
    class Admins extends Controller{
        public function __construct()
        {
            $this->adminModel=$this->model('Admin');
        }

        

        public function registerAdmin()
        {
            $data=[
                'adminId'=>'',
                'role'=>'',
                'employeeId'=>'',
                'firstname'=>'',
                'lastname'=>'',
                'email'=>'',
                'mobileno'=>'',
                'password'=>'',
                'confirmPassword'=>'',
                'reg_date'=>'',
                'reg_time'=>'',
                'adminIdError'=>'',
                'employeeIdError'=>'',
                'firstnameError'=>'',
                'lastnameError'=>'',
                'emailError'=>'',
                'mobilenoError'=>'',
                'passwordError'=>'',
                'confirmPasswordError'=>''              
            ];

            if($_SERVER['REQUEST_METHOD']=='POST'){
                $_POST=filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
    
                $data=[
                    'adminId'=>trim($_POST['adminId']),
                    'role'=>2,
                    'employeeId'=>trim($_POST['employeeId']),
                    'firstname'=>trim($_POST['firstname']),
                    'lastname'=>trim($_POST['lastname']),
                    'email'=>trim($_POST['email']),
                    'mobileno'=>trim($_POST['mobileno']),
                    'password'=>trim($_POST['password']),
                    'confirmPassword'=>trim($_POST['confirmPassword']),
                    'reg_date'=>date("Y-m-d"),
                    'reg_time'=>date("H:i:sa"),
                    'adminIdError'=>'',
                    'employeeIdError'=>'',
                    'firstnameError'=>'',
                    'lastnameError'=>'',
                    'emailError'=>'',
                    'mobilenoError'=>'',
                    'passwordError'=>'',
                    'confirmPasswordError'=>''              
                ];
            
                echo $data['adminId'];
                $idValidation="/^[a-zA-Z0-9]*$/";
                $nameValidation="/^[a-zA-Z]*$/";
                $mobileValidation="/^[0-9]{10}+$/";
                $passwordValidation= "/^(?=.*[a-z])(?=.*\\d).{8,}$/i";

                if(empty($data['adminId'])){
                    $data['adminIdError']='Please Enter the Admin ID.';
                }elseif(!preg_match($idValidation, $data['adminId'])){
                    $data['adminIdError']="Admin ID can only contain letters and numbers.";
                }else{
                    //if driverId exists
                    if($this->adminModel->findAdminByadminId($data['adminId'])){
                        $data['adminIdError']='This ID is already registered as a Admin in the system.'; 
                    }
                }
                if(empty($data['employeeId'])){
                    $data['employeeIdError']='Please Enter the Employee ID.';
                }elseif(!preg_match($idValidation, $data['employeeId'])){
                    $data['employeeIdError']="Employee ID can only contain letters and numbers.";
                }else{
                    //if Employee ID exists
                    if($this->adminModel->findAdminByEmployeeId($data['employeeId'])){
                        $data['employeeIdError']='This employee is already registered as a Admin in the system.'; 
                    }
                }
                if(empty($data['firstname'])){
                    $data['firstnameError']='Please Enter the First Name.';
                }elseif(!preg_match($nameValidation, $data['firstname'])){
                    $data['firstnameError']="Name can only contain letters.";
                }
                if(empty($data['lastname'])){
                    $data['lastnameError']='Please Enter the Last Name.';
                }elseif(!preg_match($nameValidation, $data['lastname'])){
                    $data['lastnameError']="Name can only contain letters.";
                }
                if(empty($data['email'])){
                    $data['emailError']='Please Enter the Email address.';
                }elseif(!filter_var($data['email'], FILTER_VALIDATE_EMAIL)){
                    $data['emailError']='Please enter the correct format';
                }else{
                    //if email exists
                    if($this->adminModel->findAdminByEmail($data['email'])){
                        $data['emailError']='Entered email is already registered in the system.'; 
                    }
                }

                if(empty($data['mobileno'])){
                    $data['mobilenoError']='Please Enter the Mobile No.';
                }elseif(!preg_match($mobileValidation, $data['mobileno'])){
                    $data['mobilenoError']="Name can only contain numbers and +.";
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

                if(empty($data['adminIdError']) && empty($data['employeeIdError']) &&
                empty($data['firstnameError']) && empty($data['lastnameError']) && 
                empty($data['emailError']) && empty($data['mobilenoError']) &&
                empty($data['passwordError']) && empty($data['confirmPasswordError'])){
                        //Hash passsword
                        //echo "hariiii";
                        $data['password']=password_hash($data['password'], PASSWORD_DEFAULT);
                        //Rgoster user from model function
                        if($this->adminModel->registerAdmin($data)){
                            //Redrects to the login page
                            header('Location: '.URLROOT.'/admins/viewAdmins');
                        }else{
                            die('Something went wrong');
                        }
                }else{
                    $this->view('admins/registerAdmin', $data);
                }


            }

            $this->view('admins/registerAdmin', $data);
        }




 
        
        public function updateAdmin($userId)
        {
            echo "here";

            $admin=$this->adminModel->findAdminById($userId);
            $data=[
                'userId'=>$userId,
                'admin'=>$admin,
                'employeeId'=>'',
                'firstname'=>'',
                'lastname'=>'',
                'email'=>'',
                'mobileno'=>'',
                'employeeIdError'=>'',
                'firstnameError'=>'',
                'lastnameError'=>'',
                'emailError'=>'',
                'mobilenoError'=>''             
            ];

            if($_SERVER['REQUEST_METHOD']=='POST'){
                //sanitize post data
                $_POST=filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
                echo "hariiii";
                $data=[
                    'userId'=>$userId,
                    'admin'=>$admin,
                    'employeeId'=>trim($_POST['employeeId']),
                    'firstname'=>trim($_POST['firstname']),
                    'lastname'=>trim($_POST['lastname']),
                    'email'=>trim($_POST['email']),
                    'mobileno'=>trim($_POST['mobileno']),
                    'employeeIdError'=>'',
                    'firstnameError'=>'',
                    'lastnameError'=>'',
                    'emailError'=>'',
                    'mobilenoError'=>''          
                ];
                
                $idValidation="/^[a-zA-Z0-9]*$/";
                $nameValidation="/^[a-zA-Z]*$/";
                $mobileValidation="/^[0-9]{10}+$/";
                $passwordValidation= "/^(?=.*[a-z])(?=.*\\d).{8,}$/i";
                if(empty($data['adminId'])){
                    $data['adminIdError']='Please Enter the Admin ID.';
                }elseif(!preg_match($idValidation, $data['driverId'])){
                    $data['adminIdError']="Admin ID can only contain letters and numbers.";
                }else{
                    //if driverId exists
                    if($this->adminModel->findAdminByadminId($data['adminId'])){
                        $data['adminIdError']='This ID is already registered as a Admin in the system.'; 
                    }
                }
                if(empty($data['employeeId'])){
                    $data['employeeIdError']='Please Enter the Employee ID.';
                }elseif(!preg_match($idValidation, $data['employeeId'])){
                    $data['employeeIdError']="Employee ID can only contain letters and numbers.";
                }else{
                    //if Employee ID exists
                    if($this->adminModel->findDriverByEmployeeId($data['employeeId']) &&
                    $this->adminModel->findDriverById($userId)->employeeId!=$data['employeeId']){
                        $data['employeeIdError']='This employee is already registered as a Admin in the system.'; 
                    }
                }
                if(empty($data['firstname'])){
                    $data['firstnameError']='Please Enter the First Name.';
                }elseif(!preg_match($nameValidation, $data['firstname'])){
                    $data['firstnameError']="Name can only contain letters.";
                }
                if(empty($data['lastname'])){
                    $data['lastnameError']='Please Enter the Last Name.';
                }elseif(!preg_match($nameValidation, $data['lastname'])){
                    $data['lastnameError']="Name can only contain letters.";
                }
                if(empty($data['email'])){
                    $data['emailError']='Please Enter the Email address.';
                }elseif(!filter_var($data['email'], FILTER_VALIDATE_EMAIL)){
                    $data['emailError']='Please enter the correct format';
                }else{
                    //if email exists
                    if($this->adminModel->findAdminByEmail($data['email']) &&
                    $this->adminModel->findAdminById($userId)->email!=$data['email']){
                        $data['emailError']='Entered email is already registered in the system.'; 
                    }
                }

                if(empty($data['mobileno'])){
                    $data['mobilenoError']='Please Enter the Mobile No.';
                }elseif(!preg_match($mobileValidation, $data['mobileno'])){
                    $data['mobilenoError']="Name can only contain numbers and +.";
                }

                //password validate by length and numeric values
               

                if ($data['employeeId']==$this->adminModel->findAdminById($userId)->employeeId &&
                    $data['firstname']==$this->adminModel->findAdminById($userId)->firstname &&
                    $data['lastname']==$this->adminModel->findAdminById($userId)->lastname &&
                    $data['email']==$this->adminModel->findAdminById($userId)->email &&
                    $data['mobileno']==$this->adminModel->findAdminById($userId)->mobileno
                    ){
                        $data['adminIdError']='No change was detected at any field';
                        $data['employeeIdError']='No change was detected at any field'; 
                        $data['firstnameError']='No change was detected at any field';
                        $data['lastnameError']='No change was detected at any field';
                        $data['emailError']='No change was detected at any field';
                        $data['mobilenoError']='No change was detected at any field';
                }

                if(empty($data['employeeIdError']) && empty($data['firstnameError'])
                 && empty($data['lastnameError']) && 
                empty($data['emailError']) && empty($data['mobilenoError'])){
                        //Hash passsword
                        //echo "hariiii";
                        //Rgoster user from model function
                        if($this->adminModel->updateAdmin($data)){
                            //Redrects to the login page
                            header('Location: '.URLROOT.'/admins/viewAdmins');
                        }else{
                            die('Something went wrong');
                        }
                }else{
                    $this->view('admins/updateAdmins', $data);
                }

            }

            $this->view('admins/updateAdmins', $data);
        }




        public function viewAdmins()
        {
            $admins=$this->adminModel->getAdmins();
            $fields=$this->adminModel->getAdminFields();
            $data=[
                'admins'=>$admins,
                'fields'=>$fields
            ];

            $this->view('admins/manageAdmins', $data);
        }


        public function adminsSearchBy()
        {
           
            $data=[
                'admins'=>'',
                'fields'=>'',
                'searchBar'=>'',
                'searchSelect'=>''
            ];
            if($_SERVER['REQUEST_METHOD']=='POST'){
                $_POST=filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
                $data=[
                    'admins'=>'',
                    'fields'=>'',
                    'searchBar'=>trim($_POST['searchbar']),
                    'searchSelect'=>trim($_POST['searchselect'])
                ];

                $admins=$this->driverModel->searchAdmins($data['searchBar'],$data['searchSelect']);
                $fields=$this->driverModel->getAdminFields();
                $data=[
                    'admins'=>$admins,
                    'fields'=>$fields,
                    'searchBar'=>trim($_POST['searchbar']),
                    'searchSelect'=>trim($_POST['searchselect'])
                ];
                
            }  
            $this->view('admins/manageAdmins', $data);

        }

        public function deleteUser($userId)
        {
            if($_SERVER['REQUEST_METHOD']=='POST'){
                $_POST=filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
                if ($this->adminModel->deleteUser($userId)) {
                    header("Location: ".URLROOT."/admins/viewAdmins");
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
                    $loggedInUser=$this->adminModel->login($data['username'] ,$data['password']);
                    
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
            
            $_SESSION['moderator_id']= $loggedInUser->adminId;
            $_SESSION['employee_id']= $loggedInUser->employeeId;
            $_SESSION['email']= $loggedInUser->email;

            header('location: '.URLROOT.'/pages/index');
            
        }

    }    