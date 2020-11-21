<?php
   require APPROOT . '/views/includes/admin_head.php';
?>


    <?php
       require APPROOT . '/views/includes/admin_navigation.php';
    ?>

<div class="body-section">

            
                <ul class="breadcrumb">
                    <li><a href="#">Home</a></li>
                    <li><u>Reports</u></li>
                    <li><a href="<?php echo URLROOT; ?>/reports/addRefundDetails">Add Refund Report Details</a></li>
                    <li><a href="<?php echo URLROOT; ?>/reports/refundReport">Refund Report</a></li>
                </ul>
        

            

            <div class="content-flexrow">
                <div class="container-table">
                    <h2 style="color: #13406d;">Refund Details <small style="color: black;">Admin Id: 0005C</small></h2>
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
                    <button onclick="history.go(-1);" type="submit" class="back-btn">Back</button>
                </div>
            </div>
        </div>







<?php
    require APPROOT . '/views/includes/footer.php';

?>



