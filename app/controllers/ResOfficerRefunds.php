<?php 
	
	class ResOfficerRefunds extends Controller {

		public function __construct() {
			$this->resofficerRefundModel = $this->model('ResOfficerRefund');
		}

		public function refund() {
			
	
			$this->view('resofficers/refunds/refund'); 
		}

	}