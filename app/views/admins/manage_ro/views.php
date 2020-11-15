<?php
    require APPROOT.'/views/includes/resofficer_head.php';
?>
<?php
    require APPROOT.'/views/includes/resofficer_navigation.php';
?>
<div class="body-section">
            <div class="content-flexrow">
                <div class="container-table">
                    <h2 style="color: #13406d;">Employee Management <small style="color: black;">View Reservation Officer </small></h2>
                    <table class="data-display" action="<?php echo URLROOT; ?>/Admin_manage_ros/views/<?php echo $data['manage_ro']->officerId?>" method = "POST">
                        <caption>Recervation Officer Details</caption>
                        <tr>
                            <td >Recervation Officer ID: </td>
                            <td><?php echo $data['manage_ro']->officerId?></td>
                            <td colspan="2"></td>
                        </tr>
                        <tr>
                            <td >Employee ID: </td>
                            <td><?php echo $data['manage_ro']->employeeId?></td>
                            <td colspan="2"></td>
                        </tr>
                        <tr>
                            <td>Recervation Officer Name: </td>
                            <td><?php echo $data['manage_ro']->firstname?></td>
                            <td colspan="2"></td>
                        </tr>
                        <tr>
                            <td>Recervation Officer Name: </td>
                            <td><?php echo $data['manage_ro']->lastname?></td>
                            <td colspan="2"></td>
                        </tr>
                        <tr>
                            <td >Email: </td>
                            <td><?php echo $data['manage_ro']->email?></td>
                            <td colspan="2"></td>
                        </tr>
                        <tr>
                            <td >Mobile No: </td>
                            <td><?php echo $data['manage_ro']->mobileno?></td>
                            <td colspan="2"></td>
                        </tr>
                        <tr>
                            <td >Registered Date: </td>
                            <td><?php echo $data['manage_ro']->reg_date?></td>
                            <td colspan="2"></td>
                        </tr>
                        <tr>
                            <td >Registered Time: </td>
                            <td><?php echo $data['manage_ro']->reg_time?></td>
                            <td colspan="2"></td>
                        </tr>
                    </table>
                    <button type="button" onclick="history.go(-1);" class="back-btn" value="Back">Back</button>
                </div>
            </div>
        </div>
<?php
    require APPROOT.'/views/includes/footer.php';
?>