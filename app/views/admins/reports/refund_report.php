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
                    <!--<li><a href="<?php echo URLROOT; ?>/adminReports/addRefundDetails">Add Refund Report Details</a></li>-->
                    <li><a href="<?php echo URLROOT; ?>/adminReports/refundReport">Refund Report</a></li>
                </ul>
            </div>
<br><br>

<center>
<div class="div-alert" >        

            

            <div class="content-flexrow">
                <div class="container-table">

                    <center>
                        <div class="logo-container" align="center">
                        <a href="index.html">
                        <img src="<?php echo URLROOT;?>/public/img/logotrack.jpg" height="130px" algin="center" >
                        </a>
                        </div>
                    </center>

                    <h2 style="color: #13406d;">Refund Details <small style="color: black;">Admin Id: 0005C</small></h2>
                    <h2 style="color: #13406d;">Date : <small style="color: black;"> 12/12/2020</small></h2>
                    <table class="data-display">
                        <!--<caption>Online Details</caption>-->
                        <tr>
                            <td >Admin ID: </td>
                            <td>0005C</td>
                            <td colspan="2"></td>
                        </tr>
                        <tr>
                            <td >Refund ID: </td>
                            <td>0028</td>
                            <td colspan="2"></td>
                        </tr>
                        <tr>
                            <td>Train Name: </td>
                            <td>Galu kumaree</td>
                            <td colspan="2"></td>
                        </tr>
                        <tr>
                            <td > Duration: </td>
                            <td>from: 01/11/2020</td>
                            <td>to: 30/11/2020</td>
                            <td colspan="2"></td>
                        </tr>
                        <tr>
                            <td >Refunds Tickets No.: </td>
                            <td>124253</td>
                            <td>124253</td>
                            <td>124253</td>
                            <td colspan="4"></td>
                        </tr>
                        
                            <td>Total Refunds : </td>
                            <td>3</td>
                            <td colspan="2"></td>
                        </tr>
                        
                    </table>
                    <button onclick="history.go(-1);" type="button" class="back-btn">Back</button>
                </div>
            </div>

        </div>
    </center>
        </div>







<?php
    require APPROOT . '/views/includes/footer.php';

?>



