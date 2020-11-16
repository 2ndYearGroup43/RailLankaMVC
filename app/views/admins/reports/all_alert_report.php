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
                    <li><a href="<?php echo URLROOT; ?>/reports/all_alert_report">Cancellations/Delays/Reschedulments Alert Report </a></li></ul>
                </ul>
            </div>
 
    
            <div class="content-flexrow">
                <div class="container-table">
                    <h2 style="color: #13406d;">Alerts Details <small style="color: black;">
                    Admin Id: xxxx</small></h2>
                    <table class="data-display">
                        <!--<caption>Reschedulements Details</caption>-->
                        <tr>
                            <td ><i><b><u>Cancellation Alerts Details </u></b></i></td>
                            <td colspan="2"></td>
                        </tr>
                        <tr>
                            <td >Admin ID: </td>
                            <td>xxxx</td>
                            <td colspan="2"></td>
                        </tr>
                        <tr>
                            <td >Train ID: </td>
                            <td>xxxx</td>
                            <td>Train Name: </td>
                            <td>xxxx</td>
                            <td colspan="3"></td>
                        </tr>
                        <tr>
                            <td>Duration: </td>
                            <td>xxxx</td>
                            <td colspan="2"></td>
                        </tr>
                        <tr>
                            <td>No of Total Alerts : </td>
                            <td>xxxx</td>
                            <td colspan="2"></td>
                        </tr>


                        <tr>
                            <td ><i><b><u>Delays Alerts Details </u></b></i></td>
                            <td colspan="2"></td>
                        </tr>
                        <tr>
                            <td >Admin ID: </td>
                            <td>xxxx</td>
                            <td colspan="2"></td>
                        </tr>
                        <tr>
                            <td >Train ID: </td>
                            <td>xxxx</td>
                            <td>Train Name: </td>
                            <td>xxxx</td>
                            <td colspan="4"></td>
                        </tr>
                        <tr>
                            <td>Duration: </td>
                            <td>xxxx</td>
                            <td colspan="2"></td>
                        </tr>
                        <tr>
                            <td>No of Total Alerts : </td>
                            <td>xxxx</td>
                            <td colspan="2"></td>
                        </tr>

                        <tr>
                            <td ><i><b><u>Reschedulments Alerts Details </u></b></i></td>
                            <td colspan="2"></td>
                        </tr>
                        <tr>
                            <td >Admin ID: </td>
                            <td>xxxx</td>
                            <td colspan="2"></td>
                        </tr>
                        <tr>
                            <td >Train ID: </td>
                            <td>xxxx</td>
                            <td>Train Name: </td>
                            <td>xxxx</td>
                            <td colspan="4"></td>
                        </tr>
                        <tr>
                            <td>Duration: </td>
                            <td>xxxx</td>
                            <td colspan="2"></td>
                        </tr>
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



