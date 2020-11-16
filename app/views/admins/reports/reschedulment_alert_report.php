<?php
   require APPROOT . '/views/includes/head.php';
?>


    <?php
       require APPROOT . '/views/includes/navigationadmin.php';
    ?>

<div class="body-section">

            <div class="content-row">
                <ul class="breadcrumb">
                    <li><a href="#">Home</a></li>
                    <li><u>Reports</u></li>
                    <li><a href="<?php echo URLROOT; ?>/reports/reschedulment_alert_report">Reschedulments Alert Report </a></li></ul>
                </ul>
            </div>

 
    
 <div class="body-section">

            <div class="content-row">
                <ul class="breadcrumb">
                    <li><a href="#">Home</a></li>
                    <li><u>Reports</u></li>
                    <li><a href="add_alert_details.html">Add Alert Report Details</a></li>
                    <li><a href="reschedulment_alert_details.html">Reschedulments Alert Report Details</a></li>
                </ul>
            </div>
 
    
            <div class="content-flexrow">
                <div class="container-table">
                    <h2 style="color: #13406d;">Alerts Details <small style="color: black;">
                    Admin Id: xxxx</small></h2>
                    <table class="data-display">
                        <caption>Reschedulements Details</caption>
                        <tr>
                            <td >Admin ID: </td>
                            <td>xxxx</td>
                            <td colspan="2"></td>
                        </tr>
                        <tr>
                            <td >Train ID: </td>
                            <td>xxxx</td>
                            <td colspan="2"></td>
                        </tr>
                        <tr>
                            <td>Train Name: </td>
                            <td>xxxx</td>
                            <td colspan="2"></td>
                        </tr>
                        <tr>
                            <td>Duration: </td>
                            <td>xxxx</td>
                            <td colspan="2"></td>
                        </tr>
                        <tr>
                        <tr>
                            <td>No of Total Alerts : </td>
                            <td>xxxx</td>
                            <td colspan="2"></td>
                        </tr>
                        
                    </table>
                    <button onclick="history.go(-1);" type="submit" class="back-btn">Back</button>
                </div>
            </div>
        </div>






<?php
    require APPROOT . '/views/includes/footer.php';

?>



