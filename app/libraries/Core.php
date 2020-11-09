<?php 
	//Core App Class
	class Core {
		//If there are no other controllers in the controller file Pages will be automatically loaded
		protected $currentController = 'Pages';
		//current controller and method will change if the url changes
		protected $currentMethod = 'index';
		protected $params = [];

		public function __construct() {
			// print_r($this->getUrl());
			$url = $this->getUrl();

			//Look in 'controllers' for first value, ucwords will capitalize first letter
			if(isset($url[0])) { //????????????? not in original
				//Lokk in BBLfor first value
				if (file_exists('../app/controllers/' . ucwords($url[0]) . '.php')) {
					//if exixts, Will set a new controller
					$this->currentController = ucwords($url[0]);
					//unset 0 index
					unset($url[0]);
				}
			}

			//Require the controller
			require_once '../app/controllers/' . $this->currentController . '.php';

			//instantiate controller class
			$this->currentController = new $this->currentController;

			//Check for the second part of the URL
			if(isset($url[1])) {
				//check to see if method exists in controller
				if(method_exists($this->currentController, $url[1])) {
					$this->currentMethod = $url[1];
					//Unset 1 index
					unset($url[1]);
				}
			}

			//Get parameters 
			$this->params = $url ? array_values($url) : [];

			//call a callback with arrays of params
			call_user_func_array([$this->currentController, $this->currentMethod], $this->params);
		}



		public function getUrl(){
			if(isset($_GET['url'])){
				$url = rtrim($_GET['url'], '/');
				//Allow to filter variable as string/number
				$url = filter_var($url, FILTER_SANITIZE_URL);
				//Breaking into an array
				$url = explode('/', $url);
				return $url;
			}
		}
	}

