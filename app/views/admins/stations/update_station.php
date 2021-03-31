<?php
   require APPROOT . '/views/includes/admin_head.php';
?>


    <?php
       require APPROOT . '/views/includes/admin_navigation.php';
//       var_dump($data);
    ?>



        <div class="body-section">

            <div class="content-row">
                <ul class="breadcrumb">
                    <li><a href="<?php echo URLROOT; ?>/admins/index">Home</a></li>
                    <li><u>Station Management</u></li>
                    <li><a href="<?php echo URLROOT; ?>/AdminStations/manage_station">Manage Station</a></li>
                    <li><a href="<?php echo URLROOT; ?>/AdminStations/update_station">Update Station</a></li>
                </ul>
            </div>


            <div class="content-flexrow">
                <div class="container">

                    <div class="text">Update Station Details</div>
                    <form action="<?php echo URLROOT; ?>/AdminStations/update_station/<?php echo $data['station']->stationID;?>" method="POST">

                        <div class="form-row">
                            <div class="input-data">
                                <label for="stationID">Station Id</label>
                                <input type="text" name="stationID" id="stationID" value="<?php echo $data['station']->stationID;?>" required >

                                <span class="invalidFeedback">
                                    <?php echo $data['stationIDError']; ?>
                                </span>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="input-data ">
                                <label for="name">Station Name</label>
                                <input type="text" name="name" id="name" value="<?php echo $data['station']->name;?>" required >

                                <span class="invalidFeedback">
                                    <?php echo $data['nameError']; ?>
                                </span>   
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="input-data ">
                                <label for="telephoneNo">Telephone Number</label>
                                <input type="text" name="telephoneNo" id="telephoneNo" value="<?php echo $data['station']->telephoneNo;?>" required > 

                                <span class="invalidFeedback">
                                    <?php echo $data['telephoneNoError']; ?>
                                </span>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="input-data">
                                <label for="type">Station Type</label>
                                <select name="type" id="type">

                                    <option value="Main" 
                                    <?php 
                                        if($data['station']->type=="Main")
                                            {echo "selected";}
                                    ?>
                                    >Main</option>

                                    <option value="Normal"
                                    <?php 
                                        if($data['station']->type=="Normal")
                                    
                                            {echo "selected";}
                                    ?>
                                    >Normal</option>

                                </select>

                                <span class="invalidFeedback">
                                    <?php echo $data['typeError']; ?>
                                </span>
                            </div>
                        </div>

                        <div class="form-row submit-btn">
                            <div class="input-data">
                                <input type="submit" class="blue-btn" value="Save">
                            </div>    
                            
                            <div class="input-data">
                                <input onclick="history.go(-1);" type="button" class="red-btn" value="Back">
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

