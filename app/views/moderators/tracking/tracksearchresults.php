<?php isModeratorLoggedIn(); ?>
<?php
    require APPROOT.'/views/includes/moderator_head.php';
?>
<?php
    require APPROOT.'/views/includes/moderator_navigation.php';
//    var_dump($data);
//echo gettype($data['trains']);
//
//echo json_encode($data['trains']);
?>

<div class="body-section">
            <div class="content-row">
                <button type="submit" class="submit-btn search" onclick="openForm()">Search</button>    
            </div>
            <div class="content-row">
                <div class="container-searchbox-popup" id="popupsearch">
                    <form action="<?php echo URLROOT;?>/moderatortrackings/searchtrains/results" method="POST">
                        <button type="button" style="position: relative; padding: 10px 15px;" class="back-btn" onclick="closeForm()"><i class="fa fa-times"></i></button>
                        <div class="form-row logoimg">
                            <div class="searchlogo">
                                <img src="<?php echo URLROOT;?>/public/img/logotrack.jpg" alt="raillankatracktrains">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="input-data">
                                <label for="src">Source Station</label>
                                <input list="srcStations" name="src" id="src" value="<?php echo $data['srcStation'];?>">
                                <datalist id="srcStations">
                                    <?php foreach ( $data['stations'] as $station ):?>
                                        <option value="<?php echo $station->stationID;?>"><?php echo $station->stationID.' '.$station->name?></option>
                                    <?php endforeach;?>
                                </datalist>
                                <span class="invalidFeedback">
                                    <?php echo $data['srcError'];?>
                                </span>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="input-data">
                                <label for="dest">Destination Station</label>
                                <input list="destStations" name="dest" id="dest" value="<?php echo $data['destStation'];?>">
                                <datalist id="destStations">
                                    <?php foreach ($data['stations'] as $station ):?>
                                        <option value="<?php echo $station->stationID;?>"><?php echo $station->stationID.' '.$station->name;?></option>
                                    <?php endforeach;?>
                                </datalist>
                                <span class="invalidFeedback">
                                    <?php echo $data['destError'];?>
                                </span>
                            </div>
                        </div>
<!--                        <div class="form-row">-->
<!--                            <div class="input-data">-->
<!--                                <label for="date">Date</label>-->
<!--                                <input type="date" id="date" name="date" value="--><?php //echo $data['date'];?><!--">-->
<!--                                <span class="invalidFeedback">-->
<!--                                    --><?php //echo $data['dateError'];?>
<!--                                </span>-->
<!--                            </div>-->
<!--                        </div>-->
                        <div class="form-row">
                            <div class="input-data">
                                <label for="time">Departure Time</label>
                                <input type="time" id="time" name="time" value="<?php echo $data['time'];?>">
                                <span class="invalidFeedback">
                                    <?php echo $data['timeError'];?>
                                </span>
                            </div>
                        </div>
                        <div class="form-row submit-btn">
                            <div class="input-data" style="margin-left: auto;">
                                <input type="submit"  class="blue-btn" style="font-size: 15px;" value="Search">
                                <input type="hidden" value='<?php echo json_encode($data['trains']);?>' name="searchResults" id="searchResults">
                            </div>    
                            <div class="input-data" style="margin-right: auto;">
                                <input type="reset" class="blue-btn" value="Reset" style="font-size: 15px;">
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
                        <div class="container-row">
                            <img src="<?php echo URLROOT;?>/public/img/logotrack.jpg" alt="logo-track">
                        </div>
                        <h2 style="color: #13406d;">Live Trains  <small></small></h2>
                        <div class="res-table">
                            <table class="blue">
                                <thead>
                                    <tr>
                                        <th >Train ID</th>
                                        <th>From</th>
                                        <th>Start Time</th>
                                        <th>To</th>
                                        <th>End Time</th>
                                        <th>Train Name</th>
                                        <th>Location Status</th>
                                        <th>Track</th>    
                                    </tr>
                                </thead>
                                <?php foreach ($data['trains'] as $train):?>
                                    <tr>
                                        <td data-th="Train-ID"><?php echo $train->trainId;?></td>
                                        <td data-th="From"><?php echo $train->src_name;?></td>
                                        <td data-th="Start Time"><?php echo $train->starttime;?></td>
                                        <td data-th="To"><?php echo $train->dest_name;?></td>
                                        <td data-th="End Time"><?php echo $train->endtime;?></td>
                                        <td data-th="Name"><?php echo $train->name;?></td>
                                        <td data-th="Type"><?php echo $train->journey_status;?></td>
                                        <td data-th="View Now"><a class="blue-btn" href="<?php echo URLROOT;?>/moderatortrackings/trackTrainMap/<?php echo $train->trainId;?>/<?php echo $train->journeyId;?>">View Details</a></td>
                                    </tr>
                                <?php endforeach;?>
                            </table>  

                            <br>
                            <div class="pagination">
                                <ul>
                                    <li><a href="#" class="prev">Prev</a></li>
                                    <li class="pageNumber active"><a href="<?php echo URLROOT; ?>/moderatorTrackings/displayTrackList">1</a></li>
                                    <li class="pageNumber"><a href="<?php echo URLROOT; ?>/moderatorTrackings/displayTrackList">2</a></li>
                                    <li class="pageNumber"><a href="<?php echo URLROOT; ?>/moderatorTrackings/displayTrackList">3</a></li>
                                    <li><a href="<?php echo URLROOT; ?>/moderatorTrackings/displayTrackList" class="next">Next</a></li>
                                </ul>
                            </div>
                            <br>	

                            <!-- pagination -->
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