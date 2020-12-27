<?php
    require APPROOT.'/views/includes/resofficer_head.php';
?>
<?php
    require APPROOT.'/views/includes/resofficer_navigation.php';
?>
        <div class="body-section">
            <div class="content-row">
            	<button type="submit" class="submit-btn search" onclick="openForm()">Search</button>    
            </div>
            <div class="content-row">
                <div class="container-searchbox-popup" id="popupsearch">
                    <form action="#">
                        <div class="form-row">    
                            <div class="searchlogo">
                                <img src="<?php echo URLROOT;?>/public/img/logoschedule.jpg" alt="raillankatracktrains">
                            </div>
                        </div>    
                        <div class="form-row">
                            <div class="input-data">
                                <label for="src">Source Station</label>
                                <select name="src" id="src">
                                    <option value="Fort">Fort</option>
                                    <option value="Kandy">Kandy</option>
                                    <option value="Galle">Galle</option>
                                    <option value="Baadulla">Baadulla</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="input-data">
                                <label for="dest">Destination Station</label>
                                <select name="dest" id="dest">
                                    <option value="Fort">Fort</option>
                                    <option value="Kandy">Kandy</option>
                                    <option value="Galle">Galle</option>
                                    <option value="Baadulla">Baadulla</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="input-data">
                                <label for="date">Date</label>
                                <input type="date" id="date" >
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="input-data">
                                <label for="time">Time</label>
                                <input type="time" id="time" >
                            </div>
                        </div>
                        <div class="form-row submit-btn">
                            <div class="input-data" >
                                <input type="submit" class="blue-btn" style="font-size: 15px;" value="Search">
                            </div>    
                            <div class="input-data">
                                <input type="submit" class="red-btn" value="Back" style="font-size: 15px;" onclick="closeForm()">
                            </div>
                        </div>
                    </form>
                    </div>
                
                    <script>
                        function openForm() {
                            document.getElementById("popupsearch").style.display = "block";
                        }
        
                        function closeForm() {
                            document.getElementById("popupsearch").style.display = "none";
                        }
                    </script>
                
                    <script>
                        $('.icon').click(function(){
                            $('span').toggleClass("cancel");
                        });
                    </script>
                    <div class="container-table">
                        <h2 style="color: #13406d;">Searched Trains</h2>
                        <div class="res-table">
                            <table class="blue">
                                <thead>
                                    <tr>
                                        <th >Train ID</th>
                                        <th>Start Station</th>
                                        <th>Arrival Time</th>
                                        <th>End Station</th>
                                        <th>End Time</th>
                                        <th>Name</th>
                                        <th>Type</th>
                                        <th>Action</th>    
                                    </tr>
                                </thead>
                                <?php foreach ($data['trains'] as $train):?>
                                    <tr>
                                        <td data-th="Train-ID"><?php echo $train->trainId;?></td>
                                        <td data-th="Start Station"><?php echo $train->src_name;?></td>
                                        <td data-th="Arrival Time"><?php echo $train->starttime;?></td>
                                        <td data-th="End Station"><?php echo $train->dest_name;?></td>
                                        <td data-th="End Time"><?php echo $train->endtime;?></td>
                                        <td data-th="Name"><?php echo $train->name;?></td>
                                        <td data-th="Type"><?php echo $train->type;?></td>
                                        <td data-th="View Now"><a class= "blue-btn" href="<?php echo URLROOT; ?>/resofficerReservations/displaySeatMapsnn">Reserve</a></td>
                                    </tr>
                                <?php endforeach;?>
                            </table>
                            <br>
                <div class="pagination">
                    <ul>
                        <li><a href="#" class="prev">Prev</a></li>
                        <li class="pageNumber active"><a href="<?php echo URLROOT; ?>/resofficerReservations/displayTrains">1</a></li>
                        <li class="pageNumber"><a href="<?php echo URLROOT; ?>/resofficerReservations/displayTrains">2</a></li>
                        <li class="pageNumber"><a href="<?php echo URLROOT; ?>/resofficerReservations/displayTrains">3</a></li>
                        <li><a href="<?php echo URLROOT; ?>/resofficerReservations/displayTrains" class="next">Next</a></li>
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
                        </div>      
                    </div>
                </div>
                
            </div>
        </div>
<?php
    require APPROOT.'/views/includes/footer.php';
?>

