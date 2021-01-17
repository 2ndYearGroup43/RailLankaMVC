<?php

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;
	class ResOfficerRefunds extends Controller {

		public function __construct() {
			$this->resofficerRefundModel = $this->model('ResOfficerRefund');
			isResofficerLoggedIn();
		}

		public function refund(){

        $id = $_SESSION['userid'];
		$resofficer=$this->resofficerRefundModel->findResofficerById($id);
		$tickets=$this->resofficerRefundModel->getTicketId();	

		$data = [
			'resofficer'=>$resofficer,
			'tickets'=>$tickets,
			'refundNo'=>'',
			'refundDate'=>'',
            'refundTime'=>'',
            'ticketId'=>'',
            'officerId'=>$resofficer->officerId,
            'ticketIdError'=>''
		];

		if($_SERVER['REQUEST_METHOD']=='POST'){
			$_POST=filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
			$data=[
			'resofficer'=>$resofficer,
			'tickets'=>$tickets,	
			'refundNo'=>trim($_POST['refundNo']),	
			'refundDate'=>date("Y-m-d"),
            'refundTime'=>date("H:i:sa"),
            'ticketId'=>trim($_POST['ticketId']),
            'officerId'=>$resofficer->officerId,
            'ticketIdError'=>''
			];

			$emails=$this->resofficerRefundModel->getPassengerEmail($data['ticketId']);
            $dates=$this->resofficerRefundModel->checkDate($data['ticketId']);
            $dates->seat_date;
            $dates->cancelled_date;

            echo $dates->seat_date;
            echo $dates->cancelled_date;

			if(empty($data['ticketId'])){
                $data['ticketIdError']='Please Enter the ticket ID.';
                }
            elseif($dates->seat_date!=$dates->cancelled_date){
                $data['ticketIdError']='This Ticket does not belong to a cancelled train.';
                }
            if(empty($data['ticketIdError'])){

                if ($this->resofficerRefundModel->refund($data)){
                    $this->informPassengerOftheRefund($emails->email);				
				    header("Location: " . URLROOT . "/ResOfficers/index");								
			    }else{
				    die("Something Going Wrong");
			    }
            }                                                                     
		}
	
		$this->view('resofficers/refunds/refund', $data); 
	    }

	    public function informPassengerOftheRefund($email)
        {   
            require APPROOT . '/libraries/PHPMailer/src/Exception.php';
            require APPROOT . '/libraries/PHPMailer/src/PHPMailer.php';
            require APPROOT . '/libraries/PHPMailer/src/SMTP.php';

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
 
                // Set email format to HTML
                $mail->Subject = 'Ticket Refund';
                $mail->Body    = "<h1>You have successfully refunded your ticket.</h1><p>Your railway ticket has refunded.
                You can visit the railway station with your NIC and collect your money.</p>";
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
