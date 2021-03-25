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
                            <td >Train Name: </td>
                            <td><?php echo $data['trains']->name?></td>
                            <td colspan="2"></td>
                        </tr>
                        <tr>
                            <td >Price: </td>
                            <td><?php echo $data['tickets']->price?></td>
                            <td colspan="2"></td>
                        </tr>
                        <tr>
                            <td >Journey Date: </td>
                            <td><?php echo $data['journeys']->JourneyDate?></td>
                            <td colspan="2"></td>
                        </tr>
                        <tr>
                            <td >Start Station: </td>
                            <td><?php echo $data['journeys']->srcName?></td>
                            <td colspan="2"></td>
                        </tr>
                        <tr>
                            <td >End Station: </td>
                            <td><?php echo $data['journeys']->destName?></td>
                            <td colspan="2"></td>
                        </tr>
                        <?php foreach($data['compseats'] as $compseat):?>
                        <tr>
                            <td >Compartment & Seat No: </td>
                            <td><?php echo $compseat->compartmentNo?> <?php echo $compseat->seatNo?></td>
                            <td colspan="2"></td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                    <button type="button" onclick="history.go(-1);" class="back-btn" value="Back">Back</button>
                </div>
            </div>
        </div>
<?php
    require APPROOT.'/views/includes/footer.php';
?>

