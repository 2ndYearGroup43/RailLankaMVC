<?php
    require APPROOT.'/views/includes/resofficer_head.php';
?>
<?php
    require APPROOT.'/views/includes/admin_navigation.php';
?>  
<div class="body-section">
            <div class="content-flexrow">
                <div class="container-table">
                    <h2 style="color: #13406d;">Manage Trains <small style="color: black;">View Schedule Details</small> </h2>
                    <table class="data-display" action="<?php echo URLROOT; ?>/Admin_manage_schedules/views/<?php echo $data['manage_schedule']->routeId?>" method = "POST">
                        <tr>
                            <td >Route ID: </td>
                            <td><?php echo $data['manage_schedule']->routeId?></td>
                            <td colspan="2"></td>
                        </tr>
                        <tr>
                            <td >Station ID: </td>
                            <td><?php echo $data['manage_schedule']->stationID?></td>
                            <td colspan="2"></td>
                        </tr>
                        <tr>
                            <td>Stop No: </td>
                            <td><?php echo $data['manage_schedule']->stopNo?></td>
                            <td colspan="2"></td>
                        </tr>
                        <tr>
                            <td>Arrival Time: </td>
                            <td><?php echo $data['manage_schedule']->arrivaltime?></td>
                            <td colspan="2"></td>
                        </tr>
                        <tr>
                            <td >Departure Time: </td>
                            <td><?php echo $data['manage_schedule']->departuretime?></td>
                            <td colspan="2"></td>
                        </tr>
                        <tr>
                            <td >Date: </td>
                            <td><?php echo $data['manage_schedule']->date?></td>
                            <td colspan="2"></td>
                        </tr>
                        <tr>
                            <td >Distance: </td>
                            <td><?php echo $data['manage_schedule']->distance?></td>
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