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
                            <br>
                <div class="pagination">
                    <ul>
                        <li><a href="#" class="prev">Prev</a></li>
                        <li class="pageNumber active"><a href="<?php echo URLROOT; ?>/ResOfficerReservationDetails/displayTrainReservationDetails">1</a></li>
                        <li class="pageNumber"><a href="<?php echo URLROOT; ?>/ResOfficerReservationDetails/displayTrainReservationDetails">2</a></li>
                        <li class="pageNumber"><a href="<?php echo URLROOT; ?>/ResOfficerReservationDetails/displayTrainReservationDetails">3</a></li>
                        <li><a href="<?php echo URLROOT; ?>/ResOfficerReservationDetails/displayTrainReservationDetails" class="next">Next</a></li>
                    </ul>
                </div>
                <br>

                <!-- js for pagination --> 
                <script>
                    $(document).ready(function(){
                        $('.next').click(function(){
                            $('.pagination').find('.pageNumber.active').next().addClass('active');
                            $('.pagination').find('.pageNumber.active').prev().removeClass('active');
                        });
                        $('.prev').click(function(){
                            $('.pagination').find('.pageNumber.active').prev().addClass('active');
                            $('.pagination').find('.pageNumber.active').next().removeClass('active');
                        });
                    });
                </script>
            <!-- end of js for pagination -->   
                            <button type="button" onclick="history.go(-1);" class="back-btn" value="Back">Back</button>  
                        </div>      
                    </div>
                </div>
                
            </div>
        </div>
<?php
    require APPROOT.'/views/includes/footer.php';
?>

