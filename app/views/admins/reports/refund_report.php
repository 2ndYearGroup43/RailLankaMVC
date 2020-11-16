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
                    <li><a href="<?php echo URLROOT; ?>/reports/add_refund_details">Add Refund Report Details</a></li>
                    <li><a href="<?php echo URLROOT; ?>/reports/refund_report">Refund Report</a></li>
                </ul>
            </div>
<div class="body-section">

            <div class="content-row">
                <ul class="breadcrumb">
                    <li><a href="#">Home</a></li>
                    <li><u>Reports</u></li>
                    <li><a href="add_refund_details.html">Add Refund Report Details</a></li>
                    <li><a href="created_refund_refund.html">Refund Report</a></li>
                </ul>
            </div>

            <div class="content-flexrow">
                <div class="container-table">
                    <h2 style="color: #13406d;">Refund Details <small style="color: black;">Admin Id: xxxx</small></h2>
                    <table class="data-display">
                        <!--<caption>Online Details</caption>-->
                        <tr>
                            <td >Admin ID: </td>
                            <td>xxxx</td>
                            <td colspan="2"></td>
                        </tr>
                        <tr>
                            <td >Employee ID: </td>
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
                            <td >Email: </td>
                            <td>xxxx</td>
                            <td colspan="2"></td>
                        </tr>
                        <tr>
                            <td >Mobile No: </td>
                            <td>xxxx</td>
                            <td colspan="2"></td>
                        </tr>
                            <td>Total Refunds : </td>
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



