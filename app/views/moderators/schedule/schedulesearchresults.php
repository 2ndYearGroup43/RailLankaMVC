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
                <form action="#">
                    <div class="form-row logoimg">    
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
                        <div class="input-data" style="margin-left: auto;" >
                            <input type="submit" class="blue-btn"  value="Search">
                        </div>    
                        <div class="input-data" style="margin-right: auto;">
                            <input type="button" class="red-btn" value="Close" onclick="closeForm()">
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

                    <br>
                    <div class="pagination">
                        <ul>
                            <li><a href="#" class="prev">Prev</a></li>
                            <li class="pageNumber active"><a href="<?php echo URLROOT; ?>/moderatorSchedules/displayschedulelist">1</a></li>
                            <li class="pageNumber"><a href="<?php echo URLROOT; ?>/moderatorSchedules/displayschedulelist">2</a></li>
                            <li class="pageNumber"><a href="<?php echo URLROOT; ?>/moderatorSchedules/displayschedulelist">3</a></li>
                            <li><a href="<?php echo URLROOT; ?>/moderatorSchedules/displayschedulelist" class="next">Next</a></li>
                        </ul>
                    </div>
                    <br>	

                </div>      
            </div>

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

<?php
    require APPROOT.'/views/includes/footer.php';
?>