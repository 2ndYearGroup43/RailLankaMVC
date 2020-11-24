<?php 
	
	class ResOfficerManageSeats extends Controller {

		public function __construct() {
			$this->resofficerRefundModel = $this->model('ResOfficerManageSeat');
			isResofficerLoggedIn();
		}

		public function search() {
			
	
			$this->view('resofficers/manage_seats/search_trains'); 
		}

		public function displayTrains() {

			
			$this->view('resofficers/manage_seats/display_trains'); 
		}

		public function displaySeatMaps() {

			
			$this->view('resofficers/manage_seats/display_seatmaps1'); 
		}

		public function displaySeatMaps2() {

	
			$this->view('resofficers/manage_seats/display_seatmaps2'); 
		}

		public function displaySeatMaps3() {

			$this->view('resofficers/manage_seats/display_seatmaps3'); 
		}

		public function displaySeatMaps4() {

		
			$this->view('resofficers/manage_seats/display_seatmaps4'); 
		}

		public function displaySeatMaps5() {

	
			$this->view('resofficers/manage_seats/display_seatmaps5'); 
		}

		public function displaySeatMaps6() {

		
			$this->view('resofficers/manage_seats/display_seatmaps6'); 
		}
		
	}