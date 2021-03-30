<?php 
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    class Employees extends Controller{
        public function __construct()
        {
            $this->employeeModel=$this->model('Employee');
        }

        public function index(){
            header('Location: '.URLROOT.'/admins/index');
        }

        public function resetEmployeePassword($userId) {


            $user=$this->employeeModel->getUserById($userId);
		
            require APPROOT . '/libraries/PHPMailer/src/Exception.php';
            require APPROOT . '/libraries/PHPMailer/src/PHPMailer.php';
            require APPROOT . '/libraries/PHPMailer/src/SMTP.php';
                $role=$user->role;
                $emailTo = $user->email;
                $code = uniqid(true);

                $newPassword=$user->userid.$user->email;
                $informPassword=$newPassword;
                $newPassword=password_hash($newPassword, PASSWORD_DEFAULT);
                if(!$this->employeeModel->updateEmployeePassword($user->userid,$newPassword)){
                    die('Something went wrong!');
                }


                switch ($role){
                    case 2:
                        $roleName='Administrator';
                        $redirect=URLROOT.'/admins/viewAdmins';
                        break;
                    case 3:
                        $roleName='Moderator';
                        $redirect=URLROOT.'/moderators/viewModerators';
                        break;
                    case 4:
                        $roleName='Driver';
                        $redirect=URLROOT.'/drivers/viewDrivers';
                        break;
                    case 5:
                        $roleName='Reservation Officer';
                        $redirect=URLROOT.'/resofficers/viewResOfficers';
                        break;
                }

            if(!$this->employeeModel->requestReset($emailTo,$code)){
                die('Something went wrong');
            }

            $data=[
                'userId'=>$user->userid,
                'userEmail'=>$user->email,
                'userRole'=>$roleName,
                'redirect'=>$redirect
            ];

            // Instantiation and passing `true` enables exceptions
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
                $mail->addAddress($emailTo);     // Add a recipient
                        // Name is optional
                $mail->addReplyTo('no-reply@example.com', 'Information', 'No reply');
            
                // Content
                $mail->isHTML(true); 
                $url = URLROOT . "/users/resetPassword?code=$code";   //  

                // Set email format to HTML
                $mail->Subject = 'Password Request Link For '.$roleName.'.';
                $mail->Body    = "<h1>You requested a password change through the Administration</h1> <p>Your Password has been set to ".$informPassword." . You can use it 
                to login and change it to your preferred password at anytime by clicking the link below</p> Click on <a href='$url'>this link</a> to reset your password</h1>";
                $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

                $mail->send();
                // $msg = 'Reset password link has been sent to your email';
                $this->view('admins/employees/success_resetrequest', $data);

            } catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }
        
			exit();
        }


    }