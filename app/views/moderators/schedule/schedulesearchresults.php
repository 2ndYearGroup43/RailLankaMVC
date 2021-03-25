<?php isModeratorLoggedIn(); ?>
<?php
    require APPROOT.'/views/includes/moderator_head.php';
?>
<?php
    require APPROOT.'/views/includes/moderator_navigation.php';
//    var_dump($data);
//    var_dump($data['trains']);
?>
    <div class="body-section">
        <div class="content-row">
            <button type="submit" class="submit-btn search" onclick="openForm()">Search</button>    
            <div class="container-searchbox-popup" id="popupsearch">
                <form action="<?php echo URLROOT;?>/moderatorschedules/searchTrains/results" method="post">
                    <button type="button" style="position: relative; padding: 10px 15px;" class="back-btn" onclick="closeForm()"><i class="fa fa-times"></i></button>
                    <div class="form-row logoimg">
                            <div class="searchlogo">
                                <img src="<?php echo URLROOT;?>/public/img/logoschedule.jpg" alt="raillankatracktrains">
                            </div>
                        </div>
                    <div class="form-row">
                        <div class="input-data">
                            <label for="src">Source Station</label>
                            <input list="srcStations" name="src" id="src">
                            <datalist id="srcStations">
                                <?php foreach ( $data['stations'] as $station ):?>
                                    <?php var_dump($data['stations']);?>
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
                            <input list="destStations" name="dest" id="dest">
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
                    <div class="form-row">
                        <div class="input-data">
                            <label for="date">Date</label>
                            <input type="date" id="date" name="date" >
                            <span class="invalidFeedback">
                                    <?php echo $data['dateError'];?>
                                </span>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="input-data">
                            <label for="time">Departure Time</label>
                            <input type="time" id="time" name="time" >
                            <span class="invalidFeedback">
                                    <?php echo $data['timeError'];?>
                                </span>
                        </div>
                    </div>
                    <div class="form-row submit-btn">
                        <div class="input-data" style="margin-left: auto;" >
                            <input type="submit" class="blue-btn"  value="Search">
                            <input type="hidden" name="searchResults" id="searchResults" value='<?php echo json_encode($data['trains']);?>')>
                        </div>    
                        <div class="input-data" style="margin-right: auto;">
                            <input type="reset" class="blue-btn" value="Reset">
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
        </div>

        <div class="content-row">
            <div class="container-table">
                <div class="container-row">
                    <img src="<?php echo URLROOT;?>/public/img/logoschedule.jpg" alt="logo-track">
                </div>
                <h1>Schedule</h1>
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
                                <th>Schedule</th>    
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
                            <td data-th="View Now"><a class="blue-btn" href="<?php echo URLROOT;?>/moderatorschedules/viewschedule/<?php echo $train->trainId;?>">View Details</a></td>
                        </tr>
                        <?php endforeach;?>
                    </table>

                </div>      
            </div>

        </div>
    </div>

<?php
    require APPROOT.'/views/includes/footer.php';
?>