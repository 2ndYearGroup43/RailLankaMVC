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
                    <li><a href="<?php echo URLROOT; ?>/adminReports/delayAlertReport">Delay Alert Report </a></li></ul>
                </ul>
            </div>    
            <br><br>
<center>
<div class="div-alertsingle" > 
 
    
            <div class="content-flexrow">
                <div class="container-table" id="printrev">

                        <div class="logo-container" align="center">
                        <a href="index.html">
                        <img src="<?php echo URLROOT;?>/public/img/logotrack.jpg" height="130px" algin="center" >
                        </a>
                        </div>

                    <center>
                    <h1 style="color: #13406d;">Alerts Details </h1>
                    <h2 style="color: #13406d;">Date : <small style="color: black;"> <?php echo $data['date'];?></small></h2></center>
                    
                    <table class="data-display">
                        <caption style="color: #F1A618;"><h2>Delayed Alerts</h2></caption>
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
                            <td>Total Cancellation Alerts : </td>
                            <td data-th="Alert Id"><?php echo "Total - ". count($data["results"]);?></td>
                            <td colspan="2"></td>
                        </tr>
                   

                    </table>
<br>
<br>
<br>

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

                        <?php foreach ($data["results"] as $row):?>
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



