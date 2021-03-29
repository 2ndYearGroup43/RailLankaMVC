<?php 
	
	class Pages extends Controller {

		public function __construct() {
			$this->pageModel = $this->model('Page');
		}


		//function to load the home page
		public function index() {

			$data = $this->pageModel->getNotices();
			$this->view('pages/index', $data); 
		}


		//function to display a list of all the notices
		public function notices() {

			$data = $this->pageModel->getAllNotices();
			$this->view('pages/notices', $data); 
		}


		//function to load the contact us form
		public function contactUs() {
			$this->view('pages/contact');
		}


		//function to display information about a single notice
		public function displayNoticeDetails(){


			if(isset($_POST['noticeid'])){
				$result = '';
				$output = '';
				$noticeid=trim($_POST['noticeid']);

					$result=$this->pageModel->getNoticeDetails($noticeid);

					$output .= '	
						<tbody>
							<tr>
								<td><center>'.date('d-F-Y', strtotime($result->entered_date)).'</center></td>
							</tr>
							<tr>
								<td><center><h3>'.$result->title.'</h3></center></td>
							</tr>
							<tr>	
								<td><center>'.$result->description.'</center></td>
							</tr>
						</tbody>	
					';

				echo $output;
			}
		}

	}
