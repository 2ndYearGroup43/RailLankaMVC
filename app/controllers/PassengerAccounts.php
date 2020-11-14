<?php 
	
	class PassengerAccounts extends Controller {

		public function __construct() {
			$this->passengerAccountModel = $this->model('PassengerAccount');
		}

		public function displayAccount() {
			
			isPassengerLoggedIn();
			$this->view('passengers/accounts/view_account'); 
		}

		public function editAccount() {

			isPassengerLoggedIn();
			$this->view('passengers/accounts/edit_account'); 
		}

		public function displayTickets() {
			
			isPassengerLoggedIn();
			$this->view('passengers/accounts/view_tickets'); 
		}

		public function displaySubscriptions() {
			
			isPassengerLoggedIn();
			$this->view('passengers/accounts/view_subscriptions'); 
		}
		
	}