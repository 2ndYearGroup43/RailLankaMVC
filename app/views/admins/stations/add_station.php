<?php
   require APPROOT . '/views/includes/admin_head.php';
?>


    <?php
       require APPROOT . '/views/includes/admin_navigation.php';
    ?>



        <div class="body-section">

            
                <ul class="breadcrumb">
                    <li><a href="<?php echo URLROOT; ?>/admins/index">Home</a></li>
                    <li><u>Station Management</u></li>
                    <li><a href="<?php echo URLROOT; ?>/adminStations/add_station">Add New Station</a></li>
                </ul>
            


            <div class="content-flexrow">
                <div class="container">

                    <div class="text">Add New Station Details</div>
                    <form action="<?php echo URLROOT; ?>/adminStations/add_station" method="POST">
                    <br>

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
                                 <label for="telephoneNo">Telephone Number</label>
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
                        
                        <br><br>

                        <div class="form-row submit-btn">
                            <div class="input-data">
                                <input type="submit" class="blue-btn" value="Save">
                            </div>    
                            
                            <div class="input-data">
                                <input onclick="history.go(-1);" type="submit" class="red-btn" value="Back"  >
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



