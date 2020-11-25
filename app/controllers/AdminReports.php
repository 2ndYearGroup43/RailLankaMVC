<?php
class AdminReports extends Controller {
    public function __construct() {
        isAdminLoggedIn();
        $this->adminreportModel = $this->model('AdminReport');
    }

    public function index() {
      
        $this->view('admins/reports/index');
    }

     public function onlineRevenueReport() {

        $this->view('admins/reports/online_revenue_report');
     }
     public function counterRevenueReport() {

        $this->view('admins/reports/counter_revenue_report');
     }
     public function bothRevenueReport() {

        $this->view('admins/reports/both_revenue_report');
     }




     public function addAlertDetails() {
     	
        $this->view('admins/reports/add_alert_details');
     }
     public function cancellationAlertReport() {
     	
        $this->view('admins/reports/cancellation_alert_report');
     }
     public function delayAlertReport() {
     	
        $this->view('admins/reports/delay_alert_report');
     }
     public function reschedulmentAlertReport() {
     	
        $this->view('admins/reports/reschedulment_alert_report');
     }
     public function allAlertReport() {
     	
        $this->view('admins/reports/all_alert_report');
     }
     
     
	 public function addRefundDetails() {
     	
        $this->view('admins/reports/add_refund_details');
     }
     public function refundReport() {
     	
        $this->view('admins/reports/refund_report');
     }



     public function manageRevenueReports() {
     	
        $this->view('admins/reports/manage_revenue_reports');
     }
     public function manageAlertReports() {
     	
        $this->view('admins/reports/manage_alert_reports');
     }
     public function manageRefundReports() {
     	
        $this->view('admins/reports/manage_refund_reports');
     }


    public function setting() {
        if ( isset($_POST['create']))
    {
        $payment = $_POST['radio'];
        if ($payment=="Online")
        {
            $this->view('admins/reports/online_revenue_report');
            //header("location: ".URLROOT."/reports/online_revenue_report");

        }

        else if ($payment=="Over the counter")
        {
            $this->view('admins/reports/counter_revenue_report');
            //header("location: ".URLROOT."/reports/counter_revenue_report");
        }
        else if ($payment=="Both")
        {
            $this->view('admins/reports/both_revenue_report');
                //header("location: ".URLROOT."/reports/both_revenue_report");
        }
    }
        
        //$this->view('reports/setting');
    }




    public function alertsetting() {
        if ( isset($_POST['create']))
    {
        $payment = $_POST['radio'];
        if ($payment=="Cancellation")
        {
            $this->view('admins/reports/cancellation_alert_report');
        }

        else if ($payment=="Delays")
        {
            $this->view('admins/reports/delay_alert_report');
        }
        else if ($payment=="Reschedulements")
        {
            $this->view('admins/reports/reschedulment_alert_report');
        }
        else if ($payment=="All")
        {
            $this->view('admins/reports/all_alert_report');        }
    }
        
        //$this->view('reports/setting');
    }

}