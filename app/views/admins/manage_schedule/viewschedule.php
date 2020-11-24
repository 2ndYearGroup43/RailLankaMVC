<?php
    require APPROOT.'/views/includes/resofficer_head.php';
?>
<?php
    require APPROOT.'/views/includes/admin_navigation.php';
?>  
        <div class="body-section">
            <div class="content-flexrow">
                <div class="container-table">
                    <h3>Schedule for <?php echo $data['manage_train']->name?> <small>Train Id: <?php echo $data['manage_train']->trainId?></small></h3>
                    <table class="data-display">
                        <caption>Train Details</caption>
                        <tr>
                            <td>Train Id: </td>
                            <td><?php echo $data['manage_train']->trainId?></td>
                            <td colspan="2"></td>
                        </tr>
                        <tr>
                            <td>Train Name: </td>
                            <td><?php echo $data['manage_train']->name?></td>
                            <td colspan="2"></td>
                        </tr>
                        <tr>
                            <td >Source Station: </td>
                            <td><?php echo $data['manage_train']->src_station?> <?php echo $data['manage_train']->src?></td>
                            <td >Arrival time: </td>
                            <td><?php echo $data['manage_train']->starttime?></td>
                        </tr>
                        <tr>
                            <td >Destination Station: </td>
                            <td><?php echo $data['manage_train']->dest_station?> <?php echo $data['manage_train']->dest?></td>
                            <td >Arrival time: </td>
                            <td><?php echo $data['manage_train']->endtime?></td>
                        </tr>
                        <tr>
                            <td >Available Classes</td>
                            <td>1st Class</td>
                            <td>2nd Class</td>
                            <td>3rd Class</td>
                        </tr>
                    </table>
                    <br>
                    <table class="blue">
                        <thead>
                            <tr>
                            <th>Stop Number</th>
                            <th>Station</th>
                            <th>Arrival Time</th>
                            <th>Departure Time</th>
                            <th>Distance</th>
                            <th>1st Class Price</th>
                            <th>2nd Class Price</th>
                            <th>3rd Class Price</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($data['schedules'] as $schedule):?> 
                                

                            <tr>
                                <td data-th="Stop Number"><?php echo $schedule->stopNo?></td>
                                <td data-th="Station"><?php echo $schedule->stationID?> <?php echo $schedule->station?></td>
                                <td data-th="Arrival Time"><?php echo $schedule->arrivaltime?></td>
                                <td data-th="Departure Time"><?php echo $schedule->departuretime?></td>
                                <td data-th="Distance"><?php echo $schedule->distance?>km</td>
                                <td data-th="1st Class Price">Rs. 20</td>
                                <td data-th="2nd Class Price">Rs. 15</td>
                                <td data-th="3rd Class Price">Rs. 10</td>
                            </tr>

                            <?php endforeach;?> 
                        </tbody>
                    </table>

                    <button type="button" id="availdays-btn" class="collapsible" onclick="collapseContent()">Available Days <span class="fa fa-caret-down" aria-hidden="true"></span></button>
                    <div class="collapsible-content">
                        <table class="blue" style="margin-top: 0px;">
                            <thead>
                                <tr>
                                    <th>Sunday</th>
                                    <th>Monday</th>
                                    <th>Tuesday</th>
                                    <th>Wednesday</th>
                                    <th>Thursday</th>
                                    <th>Friday</th>
                                    <th>Saturday</th>                                    
                                </tr>
                            </thead>
                            <tbody>
                           
                                <tr>
                                    <td data-th="Sunday"><span class="<?php $day = ($data['days']->sunday=="Yes") ? "check" : "times" ; echo "fa fa-$day";?>"></span></td>
                                    <td data-th="Monday"><span class="<?php $day = ($data['days']->monday=='Yes') ? "check" : "times" ; echo "fa fa-$day";?>"></span></td>
                                    <td data-th="Tuesday"><span class="<?php $day = ($data['days']->tuesday=="Yes") ? "check" : "times" ; echo "fa fa-$day";?>"></span></td>
                                    <td data-th="Wednesday"><span class="<?php $day = ($data['days']->wednesday=="Yes") ? "check" : "times" ; echo "fa fa-$day";?>"></span></td>
                                    <td data-th="Thursday"><span class="<?php $day = ($data['days']->thursday=="Yes") ? "check" : "times" ; echo "fa fa-$day";?>"></span></td>
                                    <td data-th="Friday"><span class="<?php $day = ($data['days']->friday=="Yes") ? "check" : "times" ; echo "fa fa-$day";?>"></span></td>
                                    <td data-th="Saturday"><span class="<?php $day = ($data['days']->saturday=='Yes') ? "check" : "times" ; echo "fa fa-$day";?>"></span></td>
                                    
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    
                    <form action="#">
                        <div class="formrow submit-btn">
                            <div class="input-data action">
                                <input type="button" onclick="history.go(-1)" class="red-btn" value="Back">
                            </div>
                            <div class="input-data action">
                                <input type="button" class="blue-btn" value="Print">
                            </div>
                            <div class="input-data action" style="padding: 5px";>
                                <a type="button" class="blue-btn" href="<?php echo URLROOT; ?>/Admin_manage_schedules/viewAllSchedule/<?php echo $data['trainId'];?>" style="padding-left: 125px";>Manage Schedule</a>
                            </div>                          
                        </div>
                    </form>


                    <script>
                        function collapseContent(){
                            var coll= document.getElementById("availdays-btn");
                            var content=coll.nextElementSibling;
                            if(content.style.display==="none"){
                                content.style.display="block";
                                coll.style.backgroundColor="#0c2752";
                            }else if(content.style.display="block"){
                                content.style.display="none";
                                coll.style.backgroundColor="#13406d";
                            }
                        }
                    </script>

                </div>
            </div>
        </div> 



<?php
    require APPROOT.'/views/includes/footer.php';
?>
    