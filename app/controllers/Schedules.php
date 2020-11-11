<?php 
	
	class Schedules extends Controller {

		public function __construct() {
			$this->scheduleModel = $this->model('Schedule');
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
