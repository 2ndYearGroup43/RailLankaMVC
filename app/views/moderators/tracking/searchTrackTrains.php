<?php isModeratorLoggedIn(); ?>
<?php
    require APPROOT.'/views/includes/moderator_head.php';
?>
<?php
    require APPROOT.'/views/includes/moderator_navigation.php';
?>

<div class="body-section">
            <div class="content-flexrow">
                <div class="container-searchbox">
                    <form action="#">
                        <div class="form-row logoimg">    
                            <div class="searchlogo">
                                <img src="<?php echo URLROOT;?>/public/img/logotrack.jpg" alt="raillankatracktrains">
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
                            <div class="input-data" style="margin-left: 70px;">
                                <input type="button" onclick="location.href='<?php echo URLROOT;?>/moderatorTrackings/displayTrackList'" class="blue-btn" value="Search">
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