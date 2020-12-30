<?php 
	
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

			if(empty($data['ticketId'])){
                $data['ticketIdError']='Please Enter the ticket ID.';
                }else{
                    $dates=$this->resofficerRefundModel->checkDate($data['ticketId']);
                    $dates->seat_date;
                    $dates->cancelled_date;

                    if($dates->seat_date!=$dates->cancelled_date){
                    	$data['ticketIdError']='This Train is not cancelled.';
                    }
                    else{
                        if ($this->resofficerRefundModel->refund($data)){				
					        header("Location: " . URLROOT . "/ResOfficers/index");								
			            }else{
				            die("Something Going Wrong");
			            }
                    }                                         
                }
            
		}
	
		$this->view('resofficers/refunds/refund', $data); 
	    }			
	}
