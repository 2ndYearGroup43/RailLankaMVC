<?php
   require APPROOT . '/views/includes/admin_head.php';
?>


    <?php
       require APPROOT . '/views/includes/admin_navigation.php';
    ?>

<div class="body-section">

            
                <ul class="breadcrumb">
                    <li><a href="<?php echo URLROOT; ?>/admins/index">Home</a></li>
                    <li><u>Accounts</u></li>
                    <li><a href="<?php echo URLROOT; ?>/adminAccounts/index">Over the Counter Revenue Report </a></li></ul>
                </ul>
            

            <div class="content-flexrow">
                <div class="container-table">
                    <h2 style="color: #13406d;">Account Details <small style="color: black;">Admin Id: 0002A</small></h2>
                    <table class="data-display">
                        <caption>Admin Details</caption>
                        <tr>
                            <td >Admin ID: </td>
                            <td>0002A</td>
                            <td colspan="2"></td>
                        </tr>
                        <tr>
                            <td >Employee ID: </td>
                            <td>00011</td>
                            <td colspan="2"></td>
                        </tr>
                        <tr>
                            <td >Account Number: </td>
                            <td>8080041214</td>
                            <td colspan="2"></td>
                        </tr>
                        <tr>
                            <td>Admin Name: </td>
                            <td>Nimal Kure</td>
                            <td colspan="2"></td>
                        </tr>
                        <tr>
                            <td >Email: </td>
                            <td>nimal@gmail.com</td>
                            <td colspan="2"></td>
                        </tr>
                        <tr>
                            <td >Mobile No: </td>
                            <td>0771251251</td>
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