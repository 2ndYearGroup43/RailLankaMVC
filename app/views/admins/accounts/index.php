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
                    <li><a href="<?php echo URLROOT; ?>/AdminAccounts/index">Admin Account </a></li></ul>
                </ul>
            

            <div class="content-flexrow">
                <div class="container-table">
                    <div class="container-row">
                        <img src="<?php echo URLROOT;?>/public/img/account.PNG" alt="account-image">
                    </div>

                    <h2 style="color: #13406d; text-align: center;">Account Details </h2>
                    <table class="data-display">
                    <caption>Admin Details</caption>
                    <tr>
                        <td>Admin ID: </td>
                        <td><?php if($_SESSION['role']==6){
                                echo $data['admin']->super_adminId;
                            }else{
                                echo $data['admin']->adminId;
                            } ?></td>
                        <td colspan="2"></td>
                    </tr>
                    <tr>
                        <td>Employee ID: </td>
                        <td><?php echo $data['admin']->employeeId;?></td>
                        <td colspan="2"></td>
                    </tr>
                    <tr>
                        <td>Admin Name: </td>
                        <td><?php echo $data['admin']->firstname.' '.$data['admin']->lastname;?></td>
                        <td colspan="2"></td>
                    </tr>
                    <tr>
                        <td>Email: </td>
                        <td><?php echo $data['admin']->email;?></td>
                        <td colspan="2"></td>
                    </tr>
                    <tr>
                        <td>Mobile No: </td>
                        <td><?php echo $data['admin']->mobileno;?></td>
                        <td colspan="2"></td>
                    </tr>
                </table>
                <!-- <form action="#"> -->
                    <div class="formrow submit-btn">
                        <div class="input-data action">
                            <input type="button" onclick="history.go(-1)" class="red-btn" value="Back">
                        </div>
                    </div>
                    
                <!-- </form> -->
            </div>
        </div>
    </div>



<?php
    require APPROOT . '/views/includes/footer.php';

?>