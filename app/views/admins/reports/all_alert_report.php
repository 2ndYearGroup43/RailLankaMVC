<?php
   require APPROOT . '/views/includes/admin_head.php';
?>


    <?php
       require APPROOT . '/views/includes/admin_navigation.php';
    ?>

<div class="body-section">

            <div class="content-row">
                <ul class="breadcrumb">
                    <li><a href="#">Home</a></li>
                    <li><u>Reports</u></li>
                    <li><a href="<?php echo URLROOT; ?>/reports/allAlertReport">Cancellations/Delays/Reschedulments Alert Report </a></li></ul>
                </ul>
            </div>
 
    
            <div class="content-flexrow">
                <div class="container-table">
                    <h2 style="color: #13406d;">Alerts Details <small style="color: black;">
                    Admin Id: 00012A</small></h2>
                    <table class="data-display">
                        <!--<caption>Reschedulements Details</caption>-->
                        <tr>
                            <td ><i><b><u>Cancellation Alerts Details </u></b></i></td>
                            <td colspan="2"></td>
                        </tr>
                        <tr>
                            <td >Train ID: </td>
                            <td>038B</td>
                            <td>040A</td>
                            <td colspan="2"></td>
                        </tr>
                        <tr>
                            <td>Train Name: </td>
                            <td>Udarata Manike</td>
                            <td>Galuu Kumaree</td>
                            <td colspan="2"></td>
                        </tr>
                        <tr>
                            <<td > Duration: </td>
                            <td>from: 01/11/2020</td>
                            <td>to: 30/11/2020</td>
                            <td colspan="2"></td>
                        </tr>
                        <tr>
                        <tr>
                            <td>No of Cancellation Total Alerts : </td>
                            <td>8</td>
                            <td colspan="2"></td>
                        </tr>


                        <tr>
                            <td ><i><b><u>Delays Alerts Details </u></b></i></td>
                            <td colspan="2"></td>
                        </tr>
                        <tr>
                            <td >Train ID: </td>
                            <td>038B</td>
                            <td>038B</td>
                            <td colspan="2"></td>
                        </tr>
                        <tr>
                            <td>Train Name: </td>
                            <td>Udarata Manike</td>
                            <td>Udarata Manike</td>
                            <td colspan="2"></td>
                        </tr>
                        <tr>
                            <<td > Duration: </td>
                            <td>from: 01/11/2020</td>
                            <td>to: 30/11/2020</td>
                            <td colspan="2"></td>
                        </tr>
                        <tr>
                        <tr>
                            <td>No. of Total Delay Alerts : </td>
                            <td>10</td>
                            <td colspan="2"></td>
                        </tr>

                        <tr>
                            <td ><i><b><u>Reschedulments Alerts Details </u></b></i></td>
                            <td colspan="2"></td>
                        </tr>
                        <tr>
                            <td>Train ID: </td>
                            <td>038B</td>
                            <td colspan="2"></td>
                        </tr>
                        <tr>
                            <td>Train Name: </td>
                            <td>Udarata Manike</td>
                            <td colspan="2"></td>
                        </tr>
                        <tr>
                            <<td > Duration: </td>
                            <td>from: 01/11/2020</td>
                            <td>to: 30/11/2020</td>
                            <td colspan="2"></td>
                        </tr>
                        <tr>
                        <tr>
                            <td>No. of Total Reschedulment Delay Alerts : </td>
                            <td>5</td>
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



