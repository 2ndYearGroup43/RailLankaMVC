<?php
    require APPROOT.'/views/includes/resofficer_head.php';
?>
<?php
    require APPROOT.'/views/includes/train_management_navigation.php';
?>
<div class="body-section">
            <div class="content-flexrow">
                <div class="container-table">
                    <h2 style="color: #13406d;">Manage Trains <small style="color: black;">View Train Details</small> </h2>
                    <table class="data-display" >
                        <tr>
                            <td >Train ID: </td>
                            <td><?php echo $data['manage_train']->trainId?></td>
                            <td >Train Name: </td>
                            <td><?php echo $data['manage_train']->name?></td>
                        </tr>
                        <tr>
                            <td>Reservable Status: </td>
                            <td><?php echo $data['manage_train']->reservable_status?></td>
                            <td>Type: </td>
                            <td><?php echo $data['manage_train']->type?></td>
                        </tr>
                        <tr>
                            <td >Source Station: </td>
                            <td><?php echo $data['manage_train']->src_station?>  <?php echo $data['manage_train']->src?></td>
                            <td >Start Time: </td>
                            <td><?php echo $data['manage_train']->starttime?></td>
                        </tr>
                        <tr>
                            <td >Destination: </td>
                            <td><?php echo $data['manage_train']->dest_station?>  <?php echo $data['manage_train']->dest?></td>
                            <td >End Time: </td>
                            <td><?php echo $data['manage_train']->endtime?></td>
                        </tr>
                        <tr>
                            <td >Rate ID: </td>
                            <td><?php echo $data['manage_train']->rateId?></td>
                            <td colspan="2"></td>
                        </tr>
                        <tr>
                            <td >Entered Date: </td>
                            <td><?php echo $data['manage_train']->entered_date?></td>
                            <td >Entered Time: </td>
                            <td><?php echo $data['manage_train']->entered_time?></td>
                        </tr>
                        <tr>
                            <td>View & Manage Schedule</td>
                            <td> <a href="<?php echo URLROOT; ?>/Admin_manage_schedules/viewSchedule/<?php echo $data['trainId']?>" class="blue-btn">View&Manage</a>
                            <td colspan="2"></td>
                        </tr>
                        <tr>
                            <td>View & Manage Days</td>
                            <td> <a href="<?php echo URLROOT; ?>/Admin_manage_available_days/edit/<?php echo $data['trainId']?>" class="blue-btn">View&Manage</a>
                            <td colspan="2"></td>
                        </tr>
                        <tr>
                            <td>View & Manage Compartments</td>
                            <td> <a href="<?php echo URLROOT; ?>/Admin_manage_compartments/viewCompartments/<?php echo $data['trainId']?>" class="blue-btn">View&Manage</a>
                            <td colspan="2"></td>
                        <tr>
                            
                            <td colspan="2"></td>
                        </tr>
                        <tr>
                            
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