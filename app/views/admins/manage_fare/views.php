<?php
    require APPROOT.'/views/includes/resofficer_head.php';
?>
<?php
    require APPROOT.'/views/includes/admin_navigation.php';
?>  
<div class="body-section">
            <div class="content-flexrow">
                <div class="container-table">
                    <h2 style="color: #13406d;">Manage Trains <small style="color: black;">View Fare Details</small></h2>
                    <table class="data-display" action="<?php echo URLROOT; ?>/Admin_manage_fares/views/<?php echo $data['manage_fare']->rateID?>" method = "POST">
                        <tr>
                            <td >Rate ID: </td>
                            <td><?php echo $data['manage_fare']->rateID?></td>
                            <td colspan="9"></td>
                        </tr>
                        <th colspan="11" style="background-color: #13406d; color: white">
                            Reservation Rates
                        </th>
                        <tr>
                            <td >First Class Base: </td>
                            <td><?php echo $data['manage_fare']->fclassbase?></td>
                            <td colspan="2"></td>
                            <td>Second Class Base: </td>
                            <td><?php echo $data['manage_fare']->sclassbase?></td>
                            <td colspan="2"></td>
                            <td>Third Class Base: </td>
                            <td><?php echo $data['manage_fare']->tclassbase?></td>
                            <td colspan="2"></td>
                        </tr>
                        <th colspan="11" style="background-color: #13406d; color: white">
                            Normal Rates
                        </th>
                        <tr>
                            <td >First Class Base: </td>
                            <td><?php echo $data['manage_fare']->fclassnormalbase?></td>
                            <td colspan="2"></td>
                            <td>Second Class Base: </td>
                            <td><?php echo $data['manage_fare']->sclassnormalbase?></td>
                            <td colspan="2"></td>
                            <td>Third Class Base: </td>
                            <td><?php echo $data['manage_fare']->tclassnormalbase?></td>
                            <td colspan="2"></td>
                        </tr>
                        <tr>
                            <td >Distance: </td>
                            <td><?php echo $data['manage_fare']->distance?></td>
                            <td colspan="9"></td>
                        </tr>
                        <tr>
                            <td >Rate: </td>
                            <td><?php echo $data['manage_fare']->rate?></td>
                            <td colspan="9"></td>
                        </tr>
                    </table>
                    <button type="button" onclick="history.go(-1);" class="back-btn" value="Back">Back</button>
                </div>
            </div>
        </div>
<?php
    require APPROOT.'/views/includes/footer.php';
?>