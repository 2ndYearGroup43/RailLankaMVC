<?php	
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

class DriverMobiles extends Controller{
    public function __construct()
    {
        $this->driverModel=$this->model('DriverMobile');
    }

    public function login()
    {
        $response=array();
        // $email="kroos@gmail.com";
        // $password="kroos1234";

        $email=$_POST['email'];
        $password=$_POST['password'];

        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $response['error']=true;
            $response['message']="This email is not a valid email.";
        }else{
            if ($this->driverModel->checkEmail($email)) {
                $driver=$this->driverModel->getDriverDetails($email);


                $hashedpassword=$driver->password;
                if(password_verify($password, $hashedpassword)){
                    $response['userId']=$driver->userid;
                    $response['email']=$driver->email;
                    $response['driverId']=$driver->driverId;
                    $response['employeeId']=$driver->employeeId;
                    $response['firstName']=$driver->firstname;
                    $response['lastName']=$driver->lastname;
                    $response['mobileNo']=$driver->mobileno;
                    $response['error']=false;
                    $response['message']="Login Success";
                }else{
                    $response['error']=true;
                    $response['message']="Wrong password";
                }
            }else{
                $response['error']=true;
                $response['message']="Email is not registered";
            }

        }

        echo json_encode($response);

    }


    public function driverforgotpassword()
    {
        $response=array();
        //$email='husseyhh@gmail.com';
        $email=$_POST['email'];

        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $response['error']=true;
            $response['message']='Entered email is not a valid email';
        }else{
            if ($this->driverModel->checkEmail($email)){
                $this->resetDriverPassword($email);
                $response['error']=false;
                $response['message']="Reset password sent to the email successfully..";
            }else{
                $response['error']=true;
                $response['message']="Email is not registered";
            }
        }

        
        echo json_encode($response);

    }




    public function resetDriverPassword($email)
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
            $mail->Username   = 'raillankaproject@gmail.com';                     // SMTP username
            $mail->Password   = 'Raillanka@2';                               // SMTP password
            $mail->SMTPSecure = 'ssl';         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
            $mail->Port       = 465;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

            //Recipients
            $mail->setFrom('raillankaproject@gmail.com', 'RailLanka');
            $mail->addAddress($email);     // Add a recipient
                    // Name is optional
            $mail->addReplyTo('no-reply@example.com', 'Information', 'No reply');
        
            // Content
            $mail->isHTML(true); 
            $url =  "http://192.168.43.107/raillankamvc/users/resetPassword?code=$code";   //  

            // Set email format to HTML
            $mail->Subject = 'Request to reset the password for the Driver';
            $mail->Body    = "<h1>You have requested to reset the password</h1><p> Please change your password by clicking the link below. And login from the mobile app afterwards</p> Click on <a href='$url'>this link</a> to reset your password</h1>";
            $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

            $mail->send();
            // $msg = 'Reset password link has been sent to your email';
            return;

        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    
        exit();
    }











}
