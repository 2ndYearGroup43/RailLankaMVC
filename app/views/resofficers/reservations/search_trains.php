<?php
    require APPROOT.'/views/includes/resofficer_head.php';
?>
<?php
    require APPROOT.'/views/includes/resofficer_navigation.php';
?>
        <div class="body-section">
            <div class="content-flexrow">
                <div class="container-searchbox">
                    <form action="<?php echo URLROOT;?>/ResOfficerReservations/search" method="POST">
                        <div class="form-row">    
                            <div class="searchlogo">
                                <img src="<?php echo URLROOT;?>/public/img/logoschedule.jpg" alt="raillankatracktrains">
                            </div>
                        </div>    
                        <div class="form-row">
                            <div class="input-data">
                                <label for="source">Source Station</label>
                                <input list="srcStations" name="source" id="source">
                                <datalist id="srcStations">
                                    <?php foreach ( $data['stations'] as $station ):?>
                                        <?php var_dump($data['stations']);?>
                                        <option value="<?php echo $station->stationName;?>"><?php echo $station->stationId.' '.$station->stationName?></option>
                                    <?php endforeach;?>    
                                </datalist>
                                <span class="invalidFeedback">
                                    <?php echo $data['srcError'];?>
                                </span>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="input-data">
                                <label for="destination">Destination Station</label>
                                <input list="destStations" name="destination" id="destination">
                                <datalist id="destStations">
                                    <?php foreach ($data['stations'] as $station ):?>
                                        <option value="<?php echo $station->stationName;?>"><?php echo $station->stationId.' '.$station->stationName;?></option>
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
                            <div class="input-data" style="margin-left: 70px;">
                                <input type="submit" class="blue-btn" value="Search">
                            </div>    
                            <div class="input-data">
                                <input type="reset" class="blue-btn" value="Reset">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
<?php
    require APPROOT.'/views/includes/footer.php';
?>

