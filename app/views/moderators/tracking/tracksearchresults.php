<?php isModeratorLoggedIn(); ?>
<?php
    require APPROOT.'/views/includes/moderator_head.php';
?>
<?php
    require APPROOT.'/views/includes/moderator_navigation.php';
?>

<div class="body-section">
            <div class="content-row">
                <button type="submit" class="submit-btn search" onclick="openForm()">Search</button>    
            </div>
            <div class="content-row">
                <div class="container-searchbox-popup" id="popupsearch">
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
                            <div class="input-data" style="margin-left: auto;">
                                <input type="button" onclick="location.href='<?php echo URLROOT;?>/moderatorTrackings/displayTrackList'" class="blue-btn" style="font-size: 15px;" value="Search">
                            </div>    
                            <div class="input-data" style="margin-right: auto;">
                                <input type="reset" class="blue-btn" value="Reset" style="font-size: 15px;" onclick="closeForm()">
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
                                        <th>Location Status</th>
                                        <th>Track</th>    
                                    </tr>
                                </thead>
                                <tr>
                                    <td data-th="Train-ID"> 101COLBAD0630</td>
                                    <td data-th="From">Colombo-Fort</td>
                                    <td data-th="Start Time">06:30</td>
                                    <td data-th="To">Badulla</td>
                                    <td data-th="End Time">17:30</td>
                                    <td data-th="Location Status">Live</td>
                                    <td data-th="Track Now"><a class="blue-btn" href="<?php echo URLROOT;?>/moderatortrackings/tracktrainmap">Track</a></td>  
                                </tr>
                                <tr>
                                    <td data-th="Train-ID"> 101COLKAN1230</td>
                                    <td data-th="From">Colombo Fort</td>
                                    <td data-th="Start Time">12:30</td>
                                    <td data-th="To">Kandy</td>
                                    <td data-th="End Time">16:00</td>
                                    <td data-th="Location Status">Live</td>
                                    <td data-th="Track Now"><a class="blue-btn" href="<?php echo URLROOT;?>/moderatortrackings/tracktrainmap">Track</a></td>  
                                </tr>
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