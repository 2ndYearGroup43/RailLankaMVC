<?php
class AdminReports extends Controller {
    public function __construct() {
        isAdminLoggedIn();
        $this->adminreportModel = $this->model('AdminReport');
    }

    public function index() {
      
        $trains = $this->adminreportModel->findTrains();


         $data=[
                 'trains'=>$trains,
                 'name'=>'',
                 'from'=>'',
                 'to'=>'',
                 'nameError'=>'',
                 'fromError'=>'',
                 'toError'=>''
        ];

        if($_SERVER['REQUEST_METHOD']=='POST'){

            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
               
                    'name'=>trim($_POST['trainName']),
                    'from'=>trim($_POST['fromDate']),
                    'to'=>trim($_POST['toDate']),
                    'paymentrev'=>trim($_POST['radio']),
                    'trains'=>$trains,
                    'nameError'=>'',
                    'fromError'=>'',
                    'toError'=>''

            ];


            if(empty($data['name'])) {
                $data['nameError'] = 'The trainID cannot be empty';
            }

            if(empty($data['from'])) {
                $data['fromError'] = 'The from date cannot be empty';
            }
            if(empty($data['to'])) {
                $data['toError'] = 'The to date cannot be empty';
            }
            if(!empty($data['from']) && !empty($data['from'])){
                if($data['to'] < $data['from']){
                    $data['fromError'] = "This date must be the day before 'to date'";
                    $data['toError'] = "This date must be the day after 'from date'";
                }
            }


            if (empty($data['nameError']) && empty($data['fromError']) && empty($data['toError'])){
                
                if ($data['paymentrev']=="Online")
                    {
                        
                        $results=$this->adminreportModel->createOnlineRevenue($data['name'], $data['from'], $data['to']);
                        if($results){

                            $this->onlineRevenueReport($results, $data['name'], $data['from'], $data['to']);
                            return;
                        }
                        $this->view('admins/reports/online_revenue_report', $data);

                    }

                    else if ($data['paymentrev']=="Over the counter")
                    {

                        $results=$this->adminreportModel->createCounterRevenue($data['name'], $data['from'], $data['to']);
                        if($results){

                            $this->counterRevenueReport($results, $data['name'], $data['from'], $data['to']);
                            return;
                        }

                        $this->view('admins/reports/counter_revenue_report', $data);        
                    }
                    else if ($data['paymentrev']=="Both")
                    {

                        $revenue['onlines']=$this->adminreportModel->createOnlineRevenue($data['name'], $data['from'], $data['to']);
                        $revenue['counters']=$this->adminreportModel->createCounterRevenue($data['name'], $data['from'], $data['to']);
                        //if($results){

                            $this->bothRevenueReport($revenue, $data['name'], $data['from'], $data['to']);
                            return;
                        //}

                        $this->view('admins/reports/both_revenue_report', $data);
                        
                    }
                } else {
                   $this->view('admins/reports/index', $data);
                }
            }
                else {
                $this->view('admins/reports/index', $data);
            }     

                
        }


        

     public function onlineRevenueReport($results, $name, $from, $to) {

        $total = 0;
        foreach($results as $row){
            $total += $row->price;
        }

        $train = $this->adminreportModel->getTrainDetails($name);
        $data=[
            //'adminId'=>$_SESSION['admin_id'],
            'userid'=>$_SESSION['userid'],
            'results'=>$results,
            'train'=>$train,
            'date'=>date("Y-m-d"),
            'name'=> $name,
            'from'=> $from,
            'to'=>$to,
            'total'=>$total

        ];

        if($_SESSION['role']==6){
                $data['adminId'] = $_SESSION['superadmin_id'];
        }elseif($_SESSION['role']==2){
                $data['adminId']=$_SESSION['admin_id'];
        }

        $this->view('admins/reports/online_revenue_report', $data);
     }
     public function counterRevenueReport($results, $name, $from, $to) {

        $totalc = 0;
        foreach($results as $row){
            $totalc += $row->price;
        }

        $train = $this->adminreportModel->getTrainDetails($name);
        $data=[
            //'adminId'=>$_SESSION['admin_id'],
            'userid'=>$_SESSION['userid'],
            'results'=>$results,
            'train'=>$train,
            'date'=>date("Y-m-d"),
            'name'=> $name,
            'from'=> $from,
            'to'=>$to,
            'totalc'=>$totalc

        ];

        if($_SESSION['role']==6){
                $data['adminId'] = $_SESSION['superadmin_id'];
        }elseif($_SESSION['role']==2){
                $data['adminId']=$_SESSION['admin_id'];
        }

        $this->view('admins/reports/counter_revenue_report', $data);
     }
     public function bothRevenueReport($results, $name, $from, $to) {

        // $total = 0;
        // foreach($results as $row){
        //     $total += $row->price;
        // }

        $train = $this->adminreportModel->getTrainDetails($name);
        $data=[
            //'adminId'=>$_SESSION['admin_id'],
            'userid'=>$_SESSION['userid'],
            //'results'=>$results,
            'onlines'=>$results['onlines'],
            'counters'=>$results['counters'],
            'train'=>$train,
            'date'=>date("Y-m-d"),
            'name'=> $name,
            'from'=> $from,
            'to'=>$to,
            //'total'=>$total

        ];

        if($_SESSION['role']==6){
                $data['adminId'] = $_SESSION['superadmin_id'];
        }elseif($_SESSION['role']==2){
                $data['adminId']=$_SESSION['admin_id'];
        }

        $this->view('admins/reports/both_revenue_report', $data);
     }






     public function addAlertDetails() {
        
         $trains = $this->adminreportModel->findTrains();


         $data=[
                 'trains'=>$trains,
                 'name'=>'',
                 //'id'=>'',
                 'from'=>'',
                 'to'=>'',
                 'nameError'=>'',
                 'fromError'=>'',
                 'toError'=>''
        ];

        if($_SERVER['REQUEST_METHOD']=='POST'){

            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [

                    //'id'=>trim($_POST['trainName']),
                    'name'=>trim($_POST['trainName']),
                    //'name'=>'',
                    'from'=>trim($_POST['fromDate']),
                    'to'=>trim($_POST['toDate']),
                    'payment'=>trim($_POST['radio']),
                    'nameError'=>'',
                    'fromError'=>'',
                    'toError'=>''
            ];


            if(empty($data['name'])) {
                $data['nameError'] = 'The trainID cannot be empty';
            }

            if(empty($data['from'])) {
                $data['fromError'] = 'The from date cannot be empty';
            }
            if(empty($data['to'])) {
                $data['toError'] = 'The to date cannot be empty';
            }
            if(!empty($data['from']) && !empty($data['from'])){
                if($data['to'] < $data['from']){
                    $data['fromError'] = "This date must be the day before 'to date'";
                    $data['toError'] = "This date must be the day after 'from date'";
                }
            }


            if (empty($data['nameError']) && empty($data['fromError']) && empty($data['toError'])) {
                // if ($this->adminreportModel->createCancellationAlerts($data) || createDelayAlerts($data) || createReschedulementAlerts($data)) {
                //  
                //   header("Location: " . URLROOT . "/adminReports");
                if ($data['payment']=="Cancellation")
            {
                $results=$this->adminreportModel->createCancellationAlerts($data['name'], $data['from'], $data['to']);
                if($results){
                    $this->cancellationAlertReport($results, $data['name'], $data['from'], $data['to']);
                    return;
                }



                 
                $this->view('admins/reports/cancellation_alert_report',$data);
            }

            else if ($data['payment']=="Delays")
            {

                $results=$this->adminreportModel->createDelayAlerts($data['name'], $data['from'], $data['to']);

                if($results){
                    $this->delayAlertReport($results, $data['name'], $data['from'], $data['to']);
                    return;
                    
                }

                $this->view('admins/reports/delay_alert_report', $data);
            }
            else if ($data['payment']=="Reschedulements")
            {

                $results=$this->adminreportModel->createReschedulementAlerts($data['name'], $data['from'], $data['to']);

                if($results){
                    $this->reschedulmentAlertReport($results, $data['name'], $data['from'], $data['to']);
                    return;
                    
                }

                $this->view('admins/reports/reschedulment_alert_report', $data);
            }
            else if ($data['payment']=="All")
            {   

                $alerts['cancelled']=$this->adminreportModel->createCancellationAlerts($data['name'], $data['from'], $data['to']);
                $alerts['delayed']=$this->adminreportModel->createDelayAlerts($data['name'], $data['from'], $data['to']);
                $alerts['rescheduled']=$this->adminreportModel->createReschedulementAlerts($data['name'], $data['from'], $data['to']);

                
                    $this->allAlertReport($alerts, $data['name'], $data['from'], $data['to']);
                    return;
                    
               
                $this->view('admins/reports/all_alert_report', $data);        
            }
                // } else {
                //     die("Something went wrong, please try again!");
                // }
            }
                else {
                $this->view('admins/reports/add_alert_details', $data);
            } 

            
        }

        $this->view('admins/reports/add_alert_details', $data);
     }


     public function cancellationAlertReport($results, $id, $from, $to) {
        
        $data=[
            //'adminId'=>$_SESSION['admin_id'],
            'userid'=>$_SESSION['userid'],
            'results'=>$results,
            'date'=>date("Y-m-d"),
            'id'=>$id,
            //'name'=> $name,
            'from'=> $from,
            'to'=>$to

        ];

        if($_SESSION['role']==6){
                $data['adminId'] = $_SESSION['superadmin_id'];
        }elseif($_SESSION['role']==2){
                $data['adminId']=$_SESSION['admin_id'];
        }

        $this->view('admins/reports/cancellation_alert_report', $data);
     }

     public function delayAlertReport($results, $name, $from, $to) {

        $data=[
            //'adminId'=>$_SESSION['admin_id'],
            'userid'=>$_SESSION['userid'],
            'results'=>$results,
            'date'=>date("Y-m-d"),
            'name'=> $name,
            'from'=> $from,
            'to'=>$to

        ];

        if($_SESSION['role']==6){
                $data['adminId'] = $_SESSION['superadmin_id'];
        }elseif($_SESSION['role']==2){
                $data['adminId']=$_SESSION['admin_id'];
        }
        
        $this->view('admins/reports/delay_alert_report', $data);
     }
     public function reschedulmentAlertReport($results, $name, $from, $to) {

        $data=[
            //'adminId'=>$_SESSION['admin_id'],
            'userid'=>$_SESSION['userid'],
            'results'=>$results,
            'date'=>date("Y-m-d"),
            'name'=> $name,
            'from'=> $from,
            'to'=>$to

        ];

        if($_SESSION['role']==6){
                $data['adminId'] = $_SESSION['superadmin_id'];
        }elseif($_SESSION['role']==2){
                $data['adminId']=$_SESSION['admin_id'];
        }
        
        $this->view('admins/reports/reschedulment_alert_report', $data);
     }
     public function allAlertReport($results, $name, $from, $to) {

        $data=[
            //'adminId'=>$_SESSION['admin_id'],
            'userid'=>$_SESSION['userid'],
            'cancelled'=>$results['cancelled'],
            'delayed'=>$results['delayed'],
            'rescheduled'=>$results['rescheduled'],
            'date'=>date("Y-m-d"),
            'name'=> $name,
            'from'=> $from,
            'to'=>$to

        ];

        if($_SESSION['role']==6){
                $data['adminId'] = $_SESSION['superadmin_id'];
        }elseif($_SESSION['role']==2){
                $data['adminId']=$_SESSION['admin_id'];
        }
        
        $this->view('admins/reports/all_alert_report', $data);
     }
     


     
     public function addRefundDetails() {

         $trains = $this->adminreportModel->findTrains();


         $data=[
                 'trains'=>$trains,
                 'id'=>'',
                 'from'=>'',
                 'to'=>'',
                 'idError'=>'',
                 'fromError'=>'',
                 'toError'=>''
        ];

        if($_SERVER['REQUEST_METHOD']=='POST'){

            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
               
                    'id'=>trim($_POST['trainName']),
                    'name'=>'',
                    'from'=>trim($_POST['fromDate']),
                    'to'=>trim($_POST['toDate']),
                    'adminId'=>$_SESSION['admin_id'],
                    'userid'=>$_SESSION['userid'],
                    'trains'=>$trains,
                    'results'=>'',
                    'date'=>date("Y-m-d"),
                    'total'=>'',
                    'idError'=>'',
                    'fromError'=>'',
                    'toError'=>''
            ];

            if(empty($data['id'])) {
                $data['idError'] = 'The trainID cannot be empty';
            }

            if(empty($data['from'])) {
                $data['fromError'] = 'The from date cannot be empty';
            }
            if(empty($data['to'])) {
                $data['toError'] = 'The to date cannot be empty';
            }
            if(!empty($data['from']) && !empty($data['from'])){
                if($data['to'] < $data['from']){
                    $data['fromError'] = "This date must be the day before 'to date'";
                    $data['toError'] = "This date must be the day after 'from date'";
                }
            }

            //else {
            //     $this->view('admins/stations/add_station', $data);
            // }

            $results=$this->adminreportModel->createRefunds($data['id'], $data['from'], $data['to']);
            //var_dump($results);
            if($results){
                //$this->refundReport($results, $data['name'], $data['from'], $data['to']);
                //return;
                //$this->view('admins/reports/refund_report', $results);
                
                $total = 0;
                foreach($results as $row){
                    $total += $row->price;
                }

                $data['name']=$results[0]->name;
                $data['results']=$results;
                $data['total']=$total;

                $this->view('admins/reports/refund_report', $data);
                return;
            }

            if (empty($data['idError']) && empty($data['fromError']) && empty($data['toError'])) {
                if ($this->adminreportModel->createRefunds($data)) {
                    header("Location: " . URLROOT . "/adminReports");
                } else {
                    die("Something went wrong, please try again!");
                }
            }
                else {
                $this->view('admins/reports/add_refund_details', $data);
            } 
        }

        $this->view('admins/reports/add_refund_details', $data);
     }



     public function refundReport($results, $name, $from, $to) {

        $total = 0;
        foreach($results as $row){
            $total += $row->price;
        }

        $data=[
            //'adminId'=>$_SESSION['admin_id'],
            'userid'=>$_SESSION['userid'],
            'results'=>$results,
            'date'=>date("Y-m-d"),
            'name'=> $name,
            'from'=> $from,
            'to'=>$to,
            'total'=>$total

        ];

        if($_SESSION['role']==6){
                $data['adminId'] = $_SESSION['superadmin_id'];
        }elseif($_SESSION['role']==2){
                $data['adminId']=$_SESSION['admin_id'];
        }


        
        $this->view('admins/reports/refund_report', $data);
     }



    public function setting() {
        if ( isset($_POST['create']))
    {
        $paymentrev = $_POST['radio'];
        if ($paymentrev=="Online")
        {

            $results=$this->adminreportModel->createOnlineRevenue($data['name'], $data['from'], $data['to']);
            if($results){
                $this->onlineRevenueReport($results, $data['name'], $data['from'], $data['to']);
                return;
            }
            $this->view('admins/reports/online_revenue_report', $data);

        }

        else if ($paymentrev=="Over the counter")
        {

            $results=$this->adminreportModel->createCounterRevenue($data['name'], $data['from'], $data['to']);
            if($results){

                $this->counterRevenueReport($results, $data['name'], $data['from'], $data['to']);
                return;
            }

            $this->view('admins/reports/counter_revenue_report', $data);        
        }
        else if ($paymentrev=="Both")
        {

            $results=$this->adminreportModel->createAllRevenue($data['name'], $data['from'], $data['to']);
            if($results){

                $this->allRevenueReport($results, $data['name'], $data['from'], $data['to']);
                return;
            }

            $this->view('admins/reports/both_revenue_report', $data);
            
        }
    }
       
    }




    public function alertsetting() {
        if ( isset($_POST['create']))
    {
        $payment = $_POST['radio'];
        if ($payment=="Cancellation")
        {
            $results=$this->adminreportModel->createCancellationAlerts($data['name'], $data['from'], $data['to']);
            //var_dump($results);

            if($results){
                $this->cancellationAlertReport($results, $data['name'], $data['from'], $data['to']);
                return;
                //$this->view('admins/reports/refund_report', $results);
            }
             
            $this->view('admins/reports/cancellation_alert_report',$data);
        }

        else if ($payment=="Delays")
        {

            $results=$this->adminreportModel->createDelayAlerts($data['name'], $data['from'], $data['to']);

            if($results){
                $this->delayAlertReport($results, $data['name'], $data['from'], $data['to']);
                return;
                
            }

            $this->view('admins/reports/delay_alert_report', $data);
        }
        else if ($payment=="Reschedulements")
        {

            $results=$this->adminreportModel->createReschedulementAlerts($data['name'], $data['from'], $data['to']);

            if($results){
                $this->reschedulmentAlertReport($results, $data['name'], $data['from'], $data['to']);
                return;
                
            }

            $this->view('admins/reports/reschedulment_alert_report', $data);
        }
        else if ($payment=="All")
        {

            $results=$this->adminreportModel->createAllAlerts($data['name'], $data['from'], $data['to']);

            if($results){
                $this->allAlertReport($results, $data['name'], $data['from'], $data['to']);
                return;
                
            }

            $this->view('admins/reports/all_alert_report', $data);        
        }
    }
        
           }

}