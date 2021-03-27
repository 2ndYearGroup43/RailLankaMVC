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
                            <td >Train ID: </td>
                            <td><?php echo $data['passengers']->trainId?></td>
                            <td colspan="2"></td>
                        </tr>
                        <tr>
                            <td >Train Name: </td>
                            <td><?php echo $data['passengers']->name?></td>
                            <td colspan="2"></td>
                        </tr>
                        <tr>
                            <td>Passenger Name</td>
                            <td><?php echo $data['passengers']->firstname?> <?php echo $data['passengers']->lastname?></td>
                            <td colspan="2"></td>
                        </tr>
                        <tr>
                            <td>Passenger Mobile No</td>
                            <td><?php echo $data['passengers']->mobileno?></td>
                            <td colspan="2"></td>
                        </tr>
                        <tr>
                            <td>Passenger Address</td>
                            <td><?php echo $data['passengers']->address_number?>, <?php echo $data['passengers']->street?>, <?php echo $data['passengers']->city?></td>
                            <td colspan="2"></td>
                        </tr>
                        <tr>
                            <td>NIC: </td>
                            <td><?php echo $data['passengers']->nic?></td>
                            <td colspan="2"></td>
                        </tr>
                        <tr>
                            <td >Source Station: </td>
                            <td><?php echo $data['passengers']->sname?></td>
                            <td colspan="2"></td>
                        </tr>
                        <tr>
                            <td >Destination: </td>
                            <td><?php echo $data['passengers']->dname?></td>
                            <td colspan="2"></td>
                        </tr>
                        <tr>
                            <td >Journey Date: </td>
                            <td><?php echo $data['passengers']->journeyDate?></td>
                            <td colspan="2"></td>
                        </tr>
                        <tr>
                            <td >Price: </td>
                            <td><?php echo $data['passengers']->price?></td>
                            <td colspan="2"></td>
                        </tr>
                        <?php foreach($data['compseats'] as $compseat):?>
                        <tr>
                            <td >Class & Compartment No & Seat No: </td>
                            <td><?php echo $compseat->classtype?> : <?php echo $compseat->compartmentNo?> : <?php echo $compseat->seatNo?></td>
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

