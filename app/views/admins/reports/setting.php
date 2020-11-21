<?php 
    if ( isset($_POST['create']))
    {
        $payment = $_POST['radio'];
        if ($payment=="Online")
        {
            header("location: ".URLROOT."/reports/online_revenue_report");
        }

        else if ($payment=="Over the Counter")
        {
            header("location: ".URLROOT."/reports/counter_revenue_report");
        }
        else if ($payment=="Both")
        {
            header("location: ".URLROOT."/reports/both_revenue_report");
        }
    }
?>