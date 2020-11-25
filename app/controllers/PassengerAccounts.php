<?php 
	
	class PassengerAccounts extends Controller {

		public function __construct() {
			isPassengerLoggedIn();
			$this->passengerAccountModel = $this->model('PassengerAccount');
		}

		public function displayAccount() {
			
			
			$this->view('passengers/accounts/view_account'); 
		}

		public function editAccount() {

	
			$this->view('passengers/accounts/edit_account'); 
		}

		public function displayTickets() {
			
			
			$this->view('passengers/accounts/view_tickets'); 
		}

		public function displayTicket1() {
			
			
			$this->view('passengers/accounts/booking_conf1'); 
		}

		public function displaySubscriptions() {
			
			
			$this->view('passengers/accounts/view_subscriptions'); 
		}
		
	}