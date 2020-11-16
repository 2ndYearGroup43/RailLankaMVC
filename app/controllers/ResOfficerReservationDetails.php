<?php 
	
	class ResOfficerReservationDetails extends Controller {

		public function __construct() {
			$this->resofficerReservationModel = $this->model('ResOfficerReservationDetail');
		}

		public function search() {
			
	
			$this->view('resofficers/reservation_details/search_trains'); 
		}

		public function displayReservationDetails() {

			
			$this->view('resofficers/reservation_details/display_reservation_details'); 
		}

		public function viewReservationDetails() {

			
			$this->view('resofficers/reservation_details/view_reservation_details'); 
		}

		public function searchTicketDetails() {

			
			$this->view('resofficers/reservation_details/search_ticket_details'); 
		}

		public function displayTicketDetails() {

			
			$this->view('resofficers/reservation_details/display_ticket_details'); 
		}
		
	}