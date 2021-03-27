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
            'refundDate'=>date("Y-m-d"),
            'refundTime'=>date("H:i:sa"),
            'ticketId'=>trim($_POST['ticketId']),
            'officerId'=>$resofficer->officerId,
            'ticketIdError'=>''
            ];

            $dates=$this->resofficerRefundModel->checkDate($data['ticketId']);
            $rescheduledDate=$this->resofficerRefundModel->checkRescheduledAlertDate($data['ticketId']);
            $tickets=$this->resofficerRefundModel->getTicketDetails($data['ticketId']);
            $passenger=$this->resofficerRefundModel->checkUnregisteredPassenger($data['ticketId']);
            $journeys=$this->resofficerRefundModel->getJourneyDetails($data['ticketId']);
            $trains=$this->resofficerRefundModel->getTrainDetails($data['ticketId']);
            $dates->seat_date;
            $dates->cancelled_date;

            if(empty($passenger->passengerId)){
                $emails=$this->resofficerRefundModel->getUnregisteredPassengerEmail($data['ticketId']);
            }else{
                $emails=$this->resofficerRefundModel->getPassengerEmail($data['ticketId']);
            }

            if(empty($data['ticketId'])){
                $data['ticketIdError']='Please Enter the ticket ID.';
                }
            elseif(($rescheduledDate->seat_date!=$rescheduledDate->rescheduled_date) && $dates->seat_date!=$dates->cancelled_date){
                $data['ticketIdError']='This Ticket does not belong to a rescheduled or cancelled train.';
                }    
            elseif($this->resofficerRefundModel->checkTicketId($data['ticketId'])) {
                $data['ticketIdError']='This Ticket has already refunded.';  
                }    
            if(empty($data['ticketIdError'])){

                if ($this->resofficerRefundModel->refund($data)){
                    $this->informPassengerOftheRefund($emails->email, $tickets->ticketId, $tickets->price, $tickets->trainId, $tickets->nic, $dates->cancelled_date, $rescheduledDate->rescheduled_date, $journeys->srcName, $journeys->destName, $trains->name);               
                    header("Location: " . URLROOT . "/ResOfficerRefunds/displayRefundConf/" . $data['ticketId']);                              
                }else{
                    die("Something Going Wrong");
                }
            }                                                                     
        }
    
        $this->view('resofficers/refunds/refund', $data); 
        }

        public function informPassengerOftheRefund($email, $ticketId, $price, $trainId, $nic, $cancelled_date, $rescheduled_date, $srcName, $destName, $name)
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
 
                // Set email format to HTML
                $mail->Subject = 'Ticket Refund';
                $mail->Body    = "<h1>We have successfully refunded your ticket.</h1><p>Your railway ticket has refunded.
                And you collected your money. The ticket details of you as follow.
                <br> Your Ticket ID : $ticketId</br>
                <br> Your Ticket Price : $price</br>
                <br> Train ID : $trainId</br>
                <br> Train Name : $name</br>
                <br> Your NIC : $nic</br>
                <br> Cancelled Date : $cancelled_date</br>
                <br> Rescheduled Date : $rescheduled_date</br>
                <br> Start Station : $srcName</br> 
                <br> End Station : $destName</br>   
                </p>";
                $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

                $mail->send();
                // $msg = 'Reset password link has been sent to your email';
                return;

            } catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }
        
            exit();
        }

        public function displayRefundConf($ticketId) {
            
            $tickets=$this->resofficerRefundModel->getRefundDetails($ticketId);
            $journeys=$this->resofficerRefundModel->getJourneyDetails($ticketId);
            $trains=$this->resofficerRefundModel->getTrainDetails($ticketId);

            $data = [
                'tickets'=>$tickets,
                'journeys'=>$journeys,
                'trains'=>$trains
            ];
            
            $this->view('resofficers/refunds/refundConf',  $data); 
        }           
    }
