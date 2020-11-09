<?php 
	
	//Loads the model and the view
	class Controller {

		//Loads the model
		public function model($model) {
			//Require model file
			require_once '../app/models/' . $model . '.php';
			//Instantiate model
			return new $model();
		}

		//Loads the view checks for the file
		//empty array contains dynamic data from the website
		public function view($view, $data = []) {

			if (file_exists('../app/views/' . $view . '.php')) {
				require_once '../app/views/' . $view . '.php';
			} else {
				die("View does not exist.");
			}
		}
	}
