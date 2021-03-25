<?php
class Admindashboards extends Controller {
    public function __construct() {
    	isAdminLoggedIn();
        $this->admindashboardModel = $this->model('Admindashboard');
    }

    public function index() {
      
        $this->view('admins/admindashboards/index');
    }
    public function dashboards() {
      
        $this->view('admins/admindashboards/dashboards');
    }


    public function alertsDash()
    {
        $cancelCount=$this->admindashboardModel->getCancelCount();
        $delayCount=$this->admindashboardModel->getDelayCount();
        $reschCount=$this->admindashboardModel->getReschCount();

        $issueCounts=$this->admindashboardModel->getIssueCounts();

        $date=new DateTime();
        $data=[
            'searchDate'=>$date->format("Y-m-d"),
            'cancelledCount'=>$cancelCount,
            'delayedCount'=>$delayCount,
            'rescheduledCount'=>$reschCount,
            'envCount'=>$issueCounts['environmental'],
            'techCount'=>$issueCounts['technical'],
            'railroadCount'=>$issueCounts['railroad'],
            'unspecCount'=>$issueCounts['unspecified'],
            'otherCount'=>$issueCounts['other']
        ];
        $this->view('admins/admindashboards/dashboards', $data);
    }


    public function alertsDateDash()
    {

        $data=[
            'searchDate'=>'',
            'cancelledCount'=>'',
            'delayedCount'=>'',
            'rescheduledCount'=>'',
            'technicalCount'=>'',
            'environCount'=>'',
            'railCount'=>'',
            'otherCount'=>''
        ];

        if($_SERVER['REQUEST_METHOD']=='POST'){
            filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $date=$_POST['searchDate'];
            if(empty($date)){
                $today=new DateTime();
                $date=$today->format("Y-m-d");
            }
            $cancelCount=$this->admindashboardModel->getCancelCount($date);
            $delayCount=$this->admindashboardModel->getDelayCount($date);
            $reschCount=$this->admindashboardModel->getReschCount($date);

            $issueCounts=$this->admindashboardModel->getIssueCounts($date);

            $data=[
                'searchDate'=>$date,
                'cancelledCount'=>$cancelCount,
                'delayedCount'=>$delayCount,
                'rescheduledCount'=>$reschCount,
                'envCount'=>$issueCounts['environmental'],
                'techCount'=>$issueCounts['technical'],
                'railroadCount'=>$issueCounts['railroad'],
                'unspecCount'=>$issueCounts['unspecified'],
                'otherCount'=>$issueCounts['other']
            ];
            $this->view('admins/admindashboards/dashboards', $data);

        }
        $this->view('admins/admindashboards/dashboards', $data);
    }
}