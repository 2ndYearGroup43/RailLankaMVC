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
                        <h2 style="color: #13406d;">Reservation Details <small style="color: black;">Train ID-101COLBAD0630</small></h2>
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
                                    <td data-th="Train ID">101COLBAD0630</td>
                                    <td data-th="Name">Denuwara Manike</td>
                                    <td data-th="Date">25.11.2020</td>
                                    <td data-th="Time">08.30</td>
                                    <td data-th="Compartment No">2</td>
                                    <td data-th="Seat No">32</td>
                                    <td data-th="NIC">971701617V</td>
                                    <td data-th="Ticket ID">1045</td>
                                    <td data-th="Action">                              
                                    <a class= "blue-btn" href="<?php echo URLROOT; ?>/ResOfficerReservationDetails/viewReservationDetails">View</a>
                                   </td>
                                </tr>
                                <tr>
                                    <td data-th="Train ID">101COLBAD0630</td>
                                    <td data-th="Name">Denuwara Manike</td>
                                    <td data-th="Date">20.11.2020</td>
                                    <td data-th="Time">10.30</td>
                                    <td data-th="Compartment No">5</td>
                                    <td data-th="Seat No">20</td>
                                    <td data-th="NIC">971701617V</td>
                                    <td data-th="Ticket ID">2056</td>
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

