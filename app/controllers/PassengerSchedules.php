<?php 
	
	class PassengerSchedules extends Controller {

		public function __construct() {
			isPassenger();
			$this->passengerScheduleModel = $this->model('PassengerSchedule');
		}

		public function search() {
			
			
			$this->view('passengers/schedules/search_trains'); 
		}

		public function displayTrains() {

			
			$this->view('passengers/schedules/display_trains'); 
		}

		public function displayTrainDetails() {

			
			$this->view('passengers/schedules/display_traindetails'); 
		}	
	}
