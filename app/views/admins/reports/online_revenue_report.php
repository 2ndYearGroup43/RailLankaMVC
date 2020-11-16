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
                    <li><a href="<?php echo URLROOT; ?>/reports/online_revenue_report">Over the Counter Revenue Report </a></li></ul>
                </ul>
            </div>



       
            <div class="content-flexrow">
                <div class="container-table">
                    <h2 style="color: #13406d;">Revenue Details <small style="color: black;">Admin Id: xxxx</small></h2>
                    <table class="data-display">
                        <caption>Online Details</caption>
                        <tr>
                            <td>Train Id</td>
                            <td>xxxx</td>
                            <td colspan="3"></td>
                        </tr>
                        <tr>
                            <td >Train Name: </td>
                            <td>xxxx</td>
                            <td colspan="2"></td>
                        </tr>
                        <tr>
                            <td>Rotu: </td>
                            <td>xxxx</td>
                            <td colspan="2"></td>
                        </tr>
                        <tr>
                            <td >Total Select Duration: </td>
                            <td>xxxx</td>
                            <td colspan="2"></td>
                        </tr>
                        <tr>
                            <td>Total Revenue for Online : </td>
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



