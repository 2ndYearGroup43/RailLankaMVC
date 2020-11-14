<?php 
	
	class PassengerSchedules extends Controller {

		public function __construct() {
			$this->passengerScheduleModel = $this->model('PassengerSchedule');
		}

		public function search() {
			
			isPassenger();
			$this->view('passengers/schedules/search_trains'); 
		}

		public function displayTrains() {

			isPassenger();
			$this->view('passengers/schedules/display_trains'); 
		}

		public function displayTrainDetails() {

			isPassenger();
			$this->view('passengers/schedules/display_traindetails'); 
		}	
	}
