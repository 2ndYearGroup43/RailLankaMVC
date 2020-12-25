<?php isModeratorLoggedIn(); ?>
<?php
    require APPROOT.'/views/includes/moderator_head.php';
?>
<?php
    require APPROOT.'/views/includes/moderator_navigation.php';
?>

<div class="body-section">
        <div class="content-flexrow">
            <div class="container-table" id="scheduleDiv">
                <div class="container-row">
                    <img src="<?php echo URLROOT?>/public/img/logoschedule.jpg" alt="schedule-logo">
                </div>
                <h3 style="text-align: center;">Schedule for <small>Train Id: <?php echo $data['trainId'];?></small></h3>
                <table class="data-display">
                    <caption>Train Details</caption>
                    <tr>
                        <td>Train Id: </td>
                        <td><?php echo $data['trainId'];?></td>
                        <td colspan="2"></td>
                    </tr>
                    <tr>
                        <td>Train Name: </td>
                        <td><?php echo $data['train']->name;?></td>
                        <td colspan="2"></td>
                    </tr>
                    <tr>
                        <td >Source Station: </td>
                        <td><?php echo $data['train']->src_name;?></td>
                        <td >Arrival time: </td>
                        <td><?php echo $data['train']->starttime;?></td>
                    </tr>
                    <tr>
                        <td >Destination Station: </td>
                        <td><?php echo $data['train']->dest_name;?></td>
                        <td >Arrival time: </td>
                        <td><?php echo $data['train']->endtime;?></td>
                    </tr>
                    <tr>
                        <td >Available Classes</td>
                        <td>1st Class</td>
                        <td >2nd Class</td>
                        <td>3rd Class</td>
                    </tr>
                </table>
                <br>
                <table class="blue">
                    <thead>
                        <tr>
                        <th>Stop No</th>
                        <th>Station</th>
                        <th>Arr-Time</th>
                        <th>Dep-Time</th>
                        <th>Distance</th>
                        <th>1stClass</th>
                        <th>2ndClass</th>
                        <th>3rdClass</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php $it=0;?>
                    <?php foreach ($data['routes'] as $route):?>
                        <tr>
                            <td data-th="Stop Number"><?php echo $route->stopNo;?></td>
                            <td data-th="Station"><?php echo $route->name;?></td>
                            <td data-th="Arrival Time"><?php echo $route->arrivaltime;?></td>
                            <td data-th="Departure Time"><?php echo $route->departuretime;?></td>
                            <td data-th="Distance"><?php echo $route->distance;?></td>
                            <td data-th="1st Class Price"><?php echo 'Rs. '.$data['prices'][$it]["fclass"];?></td>
                            <td data-th="2nd Class Price"><?php echo 'Rs. '.$data['prices'][$it]["sclass"];?></td>
                            <td data-th="3rd Class Price"><?php echo 'Rs. '.$data['prices'][$it]["tclass"];?></td>
                            <?php $it++?>
                        </tr>
                    <?php endforeach; ?>
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
                            <input type="button" class="blue-btn" onclick="printSchedule('scheduleDiv')" value="Print">
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

                    function printSchedule(el) {
                       
                        var restorePage= document.body.innerHTML;
                        var schedule= document.getElementById(el).innerHTML;
                        document.body.innerHTML=schedule;
                        window.print();
                        document.body.innerHTML=restorePage;
                    }
                </script>

            </div>
        </div>
    </div>
        



<?php
    require APPROOT.'/views/includes/footer.php';
?>