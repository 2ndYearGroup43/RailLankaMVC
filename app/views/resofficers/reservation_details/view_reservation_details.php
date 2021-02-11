<?php
    require APPROOT.'/views/includes/resofficer_head.php';
?>
<?php
    require APPROOT.'/views/includes/resofficer_navigation.php';
?>
<div class="body-section">
            <div class="content-flexrow">
                <div class="container-table">
                    <h2 style="color: #13406d;">Reservation Details</h2>
                    <table class="data-display">
                        <tr>
                            <td >Ticket ID: </td>
                            <td><?php echo $data['passengers']->ticketId?></td>
                            <td colspan="2"></td>
                        </tr>
                        <tr>
                            <td >Name: </td>
                            <td><?php echo $data['passengers']->firstname?> <?php echo $data['passengers']->lastname?></td>
                            <td colspan="2"></td>
                        </tr>
                        <tr>
                            <td>NIC: </td>
                            <td><?php echo $data['passengers']->nic?></td>
                            <td colspan="2"></td>
                        </tr>
                        <tr>
                            <td >Mobile No: </td>
                            <td><?php echo $data['passengers']->mobileno?></td>
                            <td colspan="2"></td>
                        </tr>
                        <tr>
                            <td >Source Station: </td>
                            <td><?php echo $data['passengers']->start_station?></td>
                            <td colspan="2"></td>
                        </tr>
                        <tr>
                            <td >Destination: </td>
                            <td><?php echo $data['passengers']->dest_station?></td>
                            <td colspan="2"></td>
                        </tr>
                        <tr>
                            <td >Date: </td>
                            <td><?php echo $data['passengers']->date?></td>
                            <td colspan="2"></td>
                        </tr>
                        <tr>
                            <td >Compartment No: </td>
                            <td><?php echo $data['passengers']->compartmentNo?></td>
                            <td colspan="2"></td>
                        </tr>
                        <tr>
                            <td >Seat No: </td>
                            <td><?php echo $data['passengers']->seatNo?></td>
                            <td colspan="2"></td>
                        </tr>
                        <tr>
                            <td >Class: </td>
                            <td><?php echo $data['passengers']->classtype?></td>
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

