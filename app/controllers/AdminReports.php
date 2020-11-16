<?php
class Reports extends Controller {
    public function __construct() {
        $this->reportModel = $this->model('Report');
    }

    public function index() {
      
        $this->view('reports/index');
    }

     public function online_revenue_report() {

        $this->view('reports/online_revenue_report');
     }
     public function counter_revenue_report() {

        $this->view('reports/counter_revenue_report');
     }
     public function both_revenue_report() {

        $this->view('reports/both_revenue_report');
     }




     public function add_alert_details() {
     	
        $this->view('reports/add_alert_details');
     }
     public function cancellation_alert_report() {
     	
        $this->view('reports/cancellation_alert_report');
     }
     public function delay_alert_report() {
     	
        $this->view('reports/delay_alert_report');
     }
     public function reschedulment_alert_report() {
     	
        $this->view('reports/reschedulment_alert_report');
     }
     public function all_alert_report() {
     	
        $this->view('reports/all_alert_report');
     }
     
     
	 public function add_refund_details() {
     	
        $this->view('reports/add_refund_details');
     }
     public function refund_report() {
     	
        $this->view('reports/refund_report');
     }



     public function manage_revenue_reports() {
     	
        $this->view('reports/manage_revenue_reports');
     }
     public function manage_alert_reports() {
     	
        $this->view('reports/manage_alert_reports');
     }
     public function manage_refund_reports() {
     	
        $this->view('reports/manage_refund_reports');
     }

}