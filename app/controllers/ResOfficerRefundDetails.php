<?php
class ResOfficerRefundDetails extends Controller{
	public function __construct() {
			$this->resofficerRefundModel = $this->model('ResOfficerRefundDetail');
			isResofficerLoggedIn();
		}

	public function views(){
		$refund_details=$this->resofficerRefundModel->views();
		$data = [
			'refund_details'=>$refund_details
		];
		$this->view('resofficers/refunds/refundDetails', $data);
	}

	public function displayRefundDetails($ticketId) {

        $tickets=$this->resofficerRefundModel->getRefundDetails($ticketId);
        $journeys=$this->resofficerRefundModel->getJourneyDetails($ticketId);
        $trains=$this->resofficerRefundModel->getTrainDetails($ticketId);
        $compseats=$this->resofficerRefundModel->getCompSeatDetails($ticketId);

        $data = [
            'tickets'=>$tickets,
            'journeys'=>$journeys,
            'trains'=>$trains,
            'compseats'=>$compseats

        ];			
			$this->view('resofficers/refunds/displayRefundDetails', $data); 
		}	
}	