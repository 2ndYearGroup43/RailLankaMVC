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
                                        <th>Reservation Type</th>
                                        <th>Price</th>
                                        <th>Compartment No</th>
                                        <th>Seat No</th>
                                        <th>NIC</th>
                                        <th>Ticket ID</th>
                                        <th>Action</th>   
                                    </tr>
                                </thead>
                                <?php foreach ($data['trains'] as $train):?>
                                <tr>
                                    <td data-th="Train ID"><?php echo $train->trainId?></td>
                                    <td data-th="Reservation Type"><?php echo $train->reservationType?></td>
                                    <td data-th="Price"><?php echo $train->price?></td>
                                    <td data-th="Compartment No"><?php echo $train->compartmentNo?></td>
                                    <td data-th="Seat No"><?php echo $train->seatNo?></td>
                                    <td data-th="NIC"><?php echo $train->nic?></td>
                                    <td data-th="Ticket ID"><?php echo $train->ticketId?></td>
                                    <td data-th="Action">                              
                                    <a class= "blue-btn" href="<?php echo URLROOT . "/ResOfficerReservationDetails/viewReservationDetails/" . $train->trainId?>/<?php echo $train->ticketId?>/<?php echo $train->nic?>">View</a>
                                   </td>
                                </tr>
                                <?php endforeach;?>
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

