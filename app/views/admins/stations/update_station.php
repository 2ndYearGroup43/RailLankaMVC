<?php
   require APPROOT . '/views/includes/head.php';
?>


    <?php
       require APPROOT . '/views/includes/navigationadmin.php';
    ?>



        <div class="body-section">

            <div class="content-row">
                <ul class="breadcrumb">
                    <li><a href="#">Home</a></li>
                    <li><u>Station Management</u></li>
                    <li><a href="<?php echo URLROOT; ?>/stations/manage_station">Manage Station</a></li>
                    <li><a href="<?php echo URLROOT; ?>/stations/update_station">Update Station</a></li>
                </ul>
            </div>


            <div class="content-flexrow">
                <div class="container">
                    <div class="text">Update Station Details</div>
                    <form action="<?php echo URLROOT; ?>/stations/add_station" method="POST">
                        <div class="form-row">
                            <div class="input-data">
                                <label for="stationID">Station Id</label>
                                <input type="text" name="stationID" id="stationID" placeholder="Enter Station ID.." required >

                                <span class="invalidFeedback">
                                    <?php echo $data['stationIDError']; ?>
                                </span>
                            </div>

                        </div>
                        <div class="form-row">
                            <div class="input-data ">
                                 <label for="name">Station Name</label>
                                 <input type="text" name="name" id="name" placeholder="Enter Station Name.." required >

                                <span class="invalidFeedback">
                                    <?php echo $data['nameError']; ?>
                                </span>   
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="input-data ">
                                 <label for="telephoneNo">Telephone NUmber</label>
                                 <input type="text" name="telephoneNo" id="telephoneNo" placeholder="Enter Station Telephone Number.." required > 

                                 <span class="invalidFeedback">
                                    <?php echo $data['telephoneNoError']; ?>
                                </span>
                            </div>
                        </div>
                     <div class="form-row">
                            <div class="input-data">
                                <label for="type">Station Type</label>
                                <select name="type" id="type">
                                    <option value="Main">Main</option>
                                    <option value="Normal">Normal</option>
                                </select>

                                <span class="invalidFeedback">
                                    <?php echo $data['typeError']; ?>
                                </span>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="input-data">
                                <label for="entered_date">Entered Date</label>
                                <input type="date" name="entered_date" id="entered_date" >

                                <span class="invalidFeedback">
                                    <?php echo $data['entered_dateError']; ?>
                                </span>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="input-data">
                                <label for="entered_time">Entered Time</label>
                                <input type="time" name="entered_time" id="entered_time" >

                                <span class="invalidFeedback">
                                    <?php echo $data['entered_timeError']; ?>
                                </span>
                            </div>
                        </div>

                        <div class="form-row submit-btn">
                            <div class="input-data">
                                <input type="submit" class="blue-btn" value="Save">
                            </div>    
                            
                            <div class="input-data">
                                <input type="submit" class="red-btn" value="Back">
                            </div>
                        </div>   
                            
                        </div>
                    </form>
                </div>
            </div>
        </div>






<?php
    require APPROOT . '/views/includes/footer.php';
?>

