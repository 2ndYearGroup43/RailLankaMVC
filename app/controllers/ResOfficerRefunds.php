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
            'officerId'=>$resofficer->officerId
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
            'officerId'=>$resofficer->officerId
			];

			if ($this->resofficerRefundModel->refund($data)){				
					header("Location: " . URLROOT . "/ResOfficers/index");								
			}else{
				die("Something Going Wrong");
			}
            
		}
	
		$this->view('resofficers/refunds/refund', $data); 
	    }			
	}
