<!DOCTYPE html>
<html>
<head>
	<title>Add New Stop</title>
	<meta name="viewport" content="width-device-width, intial-scale=1.0">
	<link rel="stylesheet" href="<?php echo URLROOT ?>/public/css/ddd.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <script  src="http://code.jquery.com/jquery-3.5.1.js"></script>
        <script>
            $(document).ready(function(){
                $('#icon').click(function(){
                    $('ul').toggleClass('show');
                })
            })
        </script>
</head>
<body>
<?php
    require APPROOT.'/views/includes/manage_schedule_navigation.php';
?>    
	    <div class="body-section">
        <div class="content-flexrow">
           <div class="container">
            <div class="text">Schedule Form</div>
            <form action="<?php echo URLROOT; ?>/manage_schedule/create" method = "POST">
                <div class="form-row">
                    <div class="input-data">
                        <label for="routeId">Route Id</label>
                        <input type="text" name="routeId" id="routeId" required >
                        <span class="invalidFeedback">
                            <?php echo $data['routeIdError'];?>
                        </span>
                    </div>
                    <div class="input-data">
                        <label for="stationId">Station Id</label>
                        <input type="text" name="stationId" id="stationId" required >
                        <span class="invalidFeedback">
                            <?php echo $data['stationIdError'];?>
                        </span>
                    </div>
                </div>
                <div class="form-row">
                    <div class="input-data">
                        <label for="stopNo">Stop No</label>
                        <input type="text" name="stopNo" id="stopNo" required >
                        <span class="invalidFeedback">
                            <?php echo $data['stopNoError'];?>
                        </span>
                    </div>
                    <div class="input-data">
                        <label for="arrivaltime">Arrival Time</label>
                        <input type="Time" name="arrivaltime" id="arrivaltime" required >
                    </div>
                </div>
                <div class="form-row">
                    <div class="input-data">
                        <label for="departuretime">Departure Time</label>
                        <input type="Time" name="departuretime" id="departuretime" required >
                    </div>
                    <div class="input-data">
                        <label for="date">Date</label>
                        <input type="Date" name="date" id="date" required >
                    </div>
                </div>
                <div class="form-row">
                    <div class="input-data">
                        <label for="distance">Distance</label>
                        <input type="text" name="distance" id="distance" required >
                        <span class="invalidFeedback">
                            <?php echo $data['distanceError'];?>
                        </span>
                    </div>
                </div>
                <div class="form-row submit-btn">
                    <div class="input-data">
                        <input type="submit" class="blue-btn" name="submit" value="Add Station">
                    </div>
                </div>
            </form>
                    <button type="button" id="availdays-btn" class="collapsible" onclick="collapseContent()">View Added Schedule <span class="fa fa-caret-down" aria-hidden="true"></span></button>
                    <div class="collapsible-content">
                        <table class="blue" style="margin-top: 0px;">
                            <thead>
                                <tr>
                                    <th>Route Id</th>
                                    <th>Station Id</th>
                                    <th>Stop No</th>
                                    <th>Arrival Time</th>
                                    <th>Departure Time</th>
                                    <th>Date</th>
                                    <th>Distance</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td data-th="Route Id">bla</td>
                                    <td data-th="Station Id">bla</td>
                                    <td data-th="Stop No">bla</td>
                                    <td data-th="Arrival Time">bla</td>
                                    <td data-th="Departure Time">bla</td>
                                    <td data-th="Date">bla</td>
                                    <td data-th="Distance">bla</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <button type="button" onclick="history.go(-1);" class="back-btn" value="Back">Back</button>


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