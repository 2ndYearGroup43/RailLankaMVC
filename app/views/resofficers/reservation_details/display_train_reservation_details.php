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
                        <h1>Ticket Details</h1>
                        <div class="res-table">
                            <table class="blue">
                                <thead>
                                    <tr>
                                        <th>Train ID</th>
                                        <th>Name</th>
                                        <th>Date</th>
                                        <th>Time</th>
                                        <th>Compartment No</th>
                                        <th>Seat No</th>
                                        <th>NIC</th>
                                        <th>Ticket ID</th>
                                        <th>Action</th>   
                                    </tr>
                                </thead>
                                <tr>
                                    <td data-th="Train ID"> BLa</td>
                                    <td data-th="Name">BLa</td>
                                    <td data-th="Date">BLa</td>
                                    <td data-th="Time">BLa</td>
                                    <td data-th="Compartment No">BLa</td>
                                    <td data-th="Seat No">BLa</td>
                                    <td data-th="NIC">BLa</td>
                                    <td data-th="Ticket ID">BLa</td>
                                    <td data-th="Action">                              
                                    <a class= "blue-btn" href="<?php echo URLROOT; ?>/ResOfficerReservationDetails/viewReservationDetails">View</a>
                                   </td>
                                </tr>
                                <tr>
                                    <td data-th="Train ID"> BLa</td>
                                    <td data-th="Name">BLa</td>
                                    <td data-th="Date">BLa</td>
                                    <td data-th="Time">BLa</td>
                                    <td data-th="Compartment No">BLa</td>
                                    <td data-th="Seat No">BLa</td>
                                    <td data-th="NIC">BLa</td>
                                    <td data-th="Ticket ID">BLa</td>
                                    <td data-th="Action">                              
                                    <a class= "blue-btn" href="<?php echo URLROOT; ?>/ResOfficerReservationDetails/viewReservationDetails">View</a>
				                    </td>
                                </tr>
                            </table>
                            <button type="button" onclick="history.go(-1);" class="back-btn" value="Back">Back</button>  
                        </div>      
                    </div>
                </div>
                
            </div>
        </div>
<?php
    require APPROOT.'/views/includes/footer.php';
?>

