<?php
    require APPROOT.'/views/includes/resofficer_head.php';
?>
<?php
    require APPROOT.'/views/includes/resofficer_navigation.php';
?>
        <div class="body-section">
            <div class="content-row">   
            </div>
            <div class="content-row">
                    <div class="container-table">
                        <h2 style="color: #13406d;">Reservation Details</h2>
                        <div class="res-table">
                            <table class="blue">
                                <thead>
                                    <tr>
                                        <th>Train ID</th>
                                        <th>Train Name</th>
                                        <th>Compartment No</th>
                                        <th>Seat No</th>
                                        <th>Class</th>
                                        <th>Ticket ID</th>
                                        <th>Action</th>   
                                    </tr>
                                </thead>
                                <?php foreach ($data['trains'] as $train):?>
                                <tr>
                                    <td data-th="Train ID"><?php echo $train->trainId?></td>
                                    <td data-th="Reservation Type"><?php echo $train->name?></td>
                                    <td data-th="Compartment No"><?php echo $train->compartmentNo?></td>
                                    <td data-th="Seat No"><?php echo $train->seatNo?></td>
                                    <td data-th="Seat No"><?php echo $train->classType?></td>
                                    <td data-th="Ticket ID"><?php echo $train->ticketId?></td>
                                    <td data-th="Action">                              
                                    <a class= "blue-btn" href="<?php echo URLROOT . "/ResOfficerReservationDetails/viewReservationDetails/" . $train->trainId?>/<?php echo $train->ticketId?>">View</a>
                                   </td>
                                </tr>
                                <?php endforeach;?>
                            </table>
                            <br>

                            <button type="button" onclick="history.go(-1);" class="back-btn" value="Back">Back</button>  
                        </div>      
                    </div>
                </div>
                
            </div>
        </div>
<?php
    require APPROOT.'/views/includes/footer.php';
?>

