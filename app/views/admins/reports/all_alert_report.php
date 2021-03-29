<?php
   require APPROOT . '/views/includes/admin_head.php';
?>


    <?php
       require APPROOT . '/views/includes/admin_navigation.php';
    ?>

<div class="body-section">

            <div class="content-row">
                <ul class="breadcrumb">
                    <li><a href="<?php echo URLROOT; ?>/admins/index">Home</a></li>
                    <li><u>Reports</u></li>
                    <li><a href="<?php echo URLROOT; ?>/reports/allAlertReport">Cancellations & Delays & Reschedulments Alert Report </a></li></ul>
                </ul>
            </div>
<br><br>

<center>
<div class="div-alert" > 
    
            <div class="content-flexrow">
                <div class="container-table" id="printrev">

                    
                        <div class="logo-container" align="center">
                        <a href="index.html">
                        <img src="<?php echo URLROOT;?>/public/img/logotrack.jpg" height="130px" algin="center" >
                        </a>
                        </div>

                    <center>
                    <h1 style="color: #13406d;">All Alerts Details </h1>
                    <h2 style="color: #13406d;">Date : <small style="color: black;"> <?php echo $data['date'];?></small></h2></center>

                    <table class="data-display">
                        
                        <tr>
                            <td><b>Admin ID: </b></td>
                             <td><b><?php echo $data['adminId'];?></b></td>
                            <td colspan="2"></td>
                        </tr>

                        <tr id="userId">
                            <td>User Id: </td>
                            <td> <?php echo $data['userid'];?></td>
                            <td colspan="2"></td>
                        </tr>

                        <tr>
                            <td>Train Name: </td>
                            <td id="name"><?php echo $data['name'];?></td>
                            <td colspan="2"></td>
                        </tr>

                        <tr>
                            <td > Duration: </td>
                            <td id="from_date"><?php echo $data['from'];?></td>
                            <td id="to_date"><?php echo $data['to'];?></td>
                            <td colspan="2"></td>
                        </tr>

                        <tr>
                            <td>Number of dates: </td>
                            <td><?php echo (strtotime($data['to'])-strtotime($data['from']))/(60*60*24); ?></td>
                            <td colspan="2"></td>
                        </tr>
                                               
                        <tr>
                            <td>Number of Cancellation Alerts : </td>
                            <td data-th="Alert Id"><?php echo "  ". count($data["cancelled"]);?></td>
                            <td colspan="2"></td>
                        </tr>
                        <tr>
                            <td>Number of Delayed Alerts : </td>
                            <td data-th="Alert Id"><?php echo " ". count($data["delayed"]);?></td>
                            <td colspan="2"></td>
                        </tr>
                        <tr>
                            <td>Number of Reschedulment Alerts : </td>
                            <td data-th="Alert Id"><?php echo " ". count($data["rescheduled"]);?></td>
                            <td colspan="2"></td>
                        </tr>
                   

                    </table>
                    <br>
                    <br>
                    <br>
                    
                        <tr>
                            <caption style="color: #D13977;"><h2>Cancellation Alerts</h2></caption>
                            <!-- <td style="color: #D13977;"><i><b><u>Cancellation Alerts Details </u></b></i></td> -->
                            <td colspan="2"></td>
                        </tr>
                    <div id="repo">
             
                    <table class="repo" align="center">


                        <thead>
                            <tr>
                                
                                <th>Alert Id</th>
                                <th>Date</th>
                                <th>Time</th>
                                <th>Train ID</th>
                                <th>Moderator ID</th>
                                <th>Issue Type</th>
                                <th>Cancellation Date</th>
                                <th>Cancellation Cause</th>

                            </tr>
                        </thead>

                        <?php foreach ($data["cancelled"] as $row):?>
                    <tr>
                        <td data-th="Alert ID"><?php echo $row->alertId;?></td>
                        <td data-th="Date"><?php echo $row->date;?></td>
                        <td data-th="Time"><?php echo $row->time;?></td>
                        <td data-th="Train ID"><?php echo $row->trainId;?></td>
                        <td data-th="Moderator ID"><?php echo $row->moderatorId;?></td>
                        <td data-th="Issue Type"><?php echo $row->issuetype;?></td>
                        <td data-th="Cancellation Date"><?php echo $row->cancellation_date;?></td>
                        <td data-th="Cancellation Cause"><?php echo $row->cancellation_cause;?></td>
                        
                    </tr>
                
                   <?php endforeach;?>

                    </table>  

                    </div>

<br><br>                
            <caption style="color: #D13977;"><h2>Delay Alerts</h2></caption>
<div id="repo">



                       
                    <table class="repo" align="center">

<thead>
                            <tr>
                                
                                <th>Alert Id</th>
                                <th>Date</th>
                                <th>Time</th>
                                <th>Train ID</th>
                                <th>Moderator ID</th>
                                <th>Issue Type</th>
                                <th>Delay Date</th>
                                <th>Delay Time</th>
                                <th>Delay Cause</th>

                            </tr>
                        </thead>

                        <?php foreach ($data["delayed"] as $row):?>
                    <tr>
                        <td data-th="Alert ID"><?php echo $row->alertId;?></td>
                        <td data-th="Date"><?php echo $row->date;?></td>
                        <td data-th="Time"><?php echo $row->time;?></td>
                        <td data-th="Train ID"><?php echo $row->trainId;?></td>
                        <td data-th="Moderator ID"><?php echo $row->moderatorId;?></td>
                        <td data-th="Issue Type"><?php echo $row->issuetype;?></td>
                        <td data-th="Delay Date"><?php echo $row->delaydate;?></td>
                        <td data-th="Delay Time"><?php echo $row->delaytime;?></td>
                        <td data-th="Delay Cause"><?php echo $row->delay_cause;?></td>
                        
                    </tr>
                    </td>
                        <?php endforeach;?>
                    </table>
                    </div>


                    <br>
                    
                     <tr>
                            <caption style="color: #D13977;"><h2>Reschedulment Alerts</h2></caption>
                            <!-- <td style="color: #D13977;"><i><b><u>Cancellation Alerts Details </u></b></i></td> -->
                            <td colspan="2"></td>
                        </tr>
                    <div id="repo">

                    <table class="repo" align="center">


                        <thead>
                            <tr>
                                
                                <th>Alert Id</th>
                                <th>Date</th>
                                <th>Time</th>
                                <th>Train ID</th>
                                <th>Moderator ID</th>
                                <th>New Date</th>
                                <th>Old Date</th>
                                <th>New Time</th>
                                <th>Reschedulement Cause</th>

                            </tr>
                        </thead>

                        <?php foreach ($data["rescheduled"] as $row):?>
                    <tr>
                        <td data-th="Alert ID"><?php echo $row->alertId;?></td>
                        <td data-th="Date"><?php echo $row->date;?></td>
                        <td data-th="Time"><?php echo $row->time;?></td>
                        <td data-th="Train ID"><?php echo $row->trainId;?></td>
                        <td data-th="Moderator ID"><?php echo $row->moderatorId;?></td>
                        <td data-th="New Date"><?php echo $row->newdate;?></td>
                        <td data-th="Old Date"><?php echo $row->olddate;?></td>
                        <td data-th="New Time"><?php echo $row->newtime;?></td>
                        <td data-th="Cancellation Cause"><?php echo $row->reschedulement_cause;?></td> 
                    </tr>
                   <?php endforeach;?>

                    </table>  

                    </div>

                    <br><br>

                    <button  type="button" onclick="printContent('printrev')" class="back-btn">Print</button>
                    
                    <button onclick="history.go(-1);" type="button" class="back-btn">Back</button>
                </div>
            </div>
            <br>
        </div>
    </center>
    <br><br>
        </div>


<script >
    function printContent(el){
        var restorepage = document.body.innerHTML;
        var printContent = document.getElementById(el).innerHTML;
        document.body.innerHTML = printContent;
        window.print();
        document.body.innerHTML = restorepage;

    }
</script>





<?php
    require APPROOT . '/views/includes/footer.php';

?>



