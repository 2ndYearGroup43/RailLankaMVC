<?php 
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    class Employees extends Controller{
        public function __construct()
        {
            $this->employeeModel=$this->model('Employee');
        }



        public function informEmployeeOfthePassword($email, $password)
        {   
            require APPROOT . '/libraries/PHPMailer/src/Exception.php';
            require APPROOT . '/libraries/PHPMailer/src/PHPMailer.php';
            require APPROOT . '/libraries/PHPMailer/src/SMTP.php';
            $code = uniqid(true);

            if(!$this->employeeModel->requestReset($email,$code)){
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
                $url = URLROOT . "/users/resetPassword?code=$code";   //  

                // Set email format to HTML
                $mail->Subject = 'Password Request Link';
                $mail->Body    = "<h1>You requested a password change through the Administration</h1> Click on <a href='$url'>this link</a> to reset your password</h1>";
                $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

                $mail->send();
                // $msg = 'Reset password link has been sent to your email';
                $this->view('admins/success_resetrequest');

            } catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }
        
			exit();
        }



        public function requestResetPassword($userId) {


            $user=$this->employeeModel->getUserById($userId);
		
            require APPROOT . '/libraries/PHPMailer/src/Exception.php';
            require APPROOT . '/libraries/PHPMailer/src/PHPMailer.php';
            require APPROOT . '/libraries/PHPMailer/src/SMTP.php';
                $role=$user->role;
                $emailTo = $user->email;
                $code = uniqid(true);                

            if(!$this->employeeModel->requestReset($emailTo,$code)){
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
                $mail->Subject = 'Password Request Link';
                $mail->Body    = "<h1>You requested a password change through the Administration</h1> Click on <a href='$url'>this link</a> to reset your password</h1>";
                $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

                $mail->send();
                // $msg = 'Reset password link has been sent to your email';
                $this->view('admins/success_resetrequest');

            } catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }
        
			exit();
        }


    }