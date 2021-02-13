<?php
    require APPROOT.'/views/includes/resofficer_head.php';
?>
<?php
    require APPROOT.'/views/includes/resofficer_navigation.php';
?>
<div class="body-section">
            <div class="content-flexrow">
                <div class="container-table">
                    <h2 style="color: #13406d;">Refund Details</h2>
                    <table class="data-display">
                        <tr>
                            <td >Ticket ID: </td>
                            <td><?php echo $data['tickets']->ticketId?></td>
                            <td colspan="2"></td>
                        </tr>
                        <tr>
                            <td>NIC: </td>
                            <td><?php echo $data['tickets']->nic?></td>
                            <td colspan="2"></td>
                        </tr>
                        <tr>
                            <td >Train Id: </td>
                            <td><?php echo $data['tickets']->trainId?></td>
                            <td colspan="2"></td>
                        </tr>
                        <tr>
                            <td >Price: </td>
                            <td><?php echo $data['tickets']->price?></td>
                            <td colspan="2"></td>
                        </tr>
                        <tr>
                            <td >Compartment No: </td>
                            <td><?php echo $data['tickets']->compartmentNo?></td>
                            <td colspan="2"></td>
                        </tr>
                        <tr>
                            <td >Seat No: </td>
                            <td><?php echo $data['tickets']->seatNo?></td>
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

