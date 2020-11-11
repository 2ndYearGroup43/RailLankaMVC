<?php 
	
	class Accounts extends Controller {

		public function __construct() {
			$this->accountModel = $this->model('Account');
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

		public function displaySubscriptions() {
			
			$this->view('passengers/accounts/view_subscriptions'); 
		}
		
	}