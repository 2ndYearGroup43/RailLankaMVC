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
                <h3 style="text-align: center;">Schedule for <small>Train Id: xxxx</small></h3>
                <table class="data-display">
                    <caption>Train Details</caption>
                    <tr>
                        <td>Train Id: </td>
                        <td>xxxx</td>
                        <td colspan="2"></td>
                    </tr>
                    <tr>
                        <td>Train Name: </td>
                        <td>xxxx</td>
                        <td colspan="2"></td>
                    </tr>
                    <tr>
                        <td >Source Station: </td>
                        <td>xxxx</td>
                        <td >Arrival time: </td>
                        <td>xxxx</td>
                    </tr>
                    <tr>
                        <td >Destination Station: </td>
                        <td>xxxx</td>
                        <td >Arrival time: </td>
                        <td>xxxx</td>
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
                        <tr>
                            <td data-th="Stop Number">0</td>
                            <td data-th="Station">Colombo Fort</td>
                            <td data-th="Arrival Time">08:30</td>
                            <td data-th="Departure Time">08:35</td>
                            <td data-th="Distance">0km</td>
                            <td data-th="1st Class Price">Rs. 20</td>
                            <td data-th="2nd Class Price">Rs. 15</td>
                            <td data-th="3rd Class Price">Rs. 10</td>
                        </tr>
                        <td data-th="Stop Number">1</td>
                            <td data-th="Station">Maradana</td>
                            <td data-th="Arrival Time">08:40</td>
                            <td data-th="Departure Time">08:45</td>
                            <td data-th="Distance">2km</td>
                            <td data-th="1st Class Price">Rs. 20</td>
                            <td data-th="2nd Class Price">Rs. 15</td>
                            <td data-th="3rd Class Price">Rs. 10</td>
                    </tbody>
                </table>

                <button type="button" id="availdays-btn" class="collapsible" onclick="collapseContent()">Available Days <span class="fa fa-caret-down" aria-hidden="true"></span></button>
                <div class="collapsible-content">
                    <table class="blue" style="margin-top: 0px;">
                        <thead>
                            <tr>
                                <th>Monday</th>
                                <th>Tuesday</th>
                                <th>Wednesday</th>
                                <th>Thursday</th>
                                <th>Friday</th>
                                <th>Saturday</th>
                                <th>Sunday</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td data-th="Monday"><span class="fa fa-check"></span></td>
                                <td data-th="Tuesday"><span class="fa fa-check"></span></td>
                                <td data-th="Wednesday"><span class="fa fa-check"></span></td>
                                <td data-th="Thursday"><span class="fa fa-check"></span></td>
                                <td data-th="Friday"><span class="fa fa-check"></span></td>
                                <td data-th="Saturday"><span class="fa fa-times"></span></td>
                                <td data-th="Sunday"><span class="fa fa-times"></span></td>
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