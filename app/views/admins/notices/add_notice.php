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
                    <li><u>Notice Management</u></li>
                    <li><a href="<?php echo URLROOT; ?>/notices/add_notice">Add New Notices</a></li>
                </ul>
            </div>

            <div class="content-flexrow">
                <div class="container">
                    <div class="text">Add New Notice Details</div>
                    <form action="#">
                        <div class="form-row">
                            <div class="input-data">
                                <label for="trainid">Notice Id</label>
                                <input type="text" name="trainid" id="trainid" placeholder="Enter the Station ID.." required >
                            </div>
                        </div>
                     <div class="form-row">
                            <div class="input-data">
                                <label for="dest">Notice Type</label>
                                <select name="dest" id="dest">
                                    <option value="Fort">Main</option>
                                    <option value="Kandy">Normal</opttion>
                                </select>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="input-data">
                                <label for="date">Entered Date</label>
                                <input type="date" id="date" >
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="input-data">
                                <label for="time">Entered Time</label>
                                <input type="time" id="time" >
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="input-data">
                                <label for="trainid">Admin Id</label>
                                <input type="text" name="trainid" id="trainid" placeholder="Enter the Admin ID.." required >
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="input-data textarea">
                                 <label for="delaycause">Description</label>
                                 <textarea name="delaycause" id="delaycause" cols="30" rows="10" placeholder="Enter the Description.." required></textarea>
                            </div>
                        </div>




                        <div class="form-row submit-btn">
                            <div class="input-data">
                                <input type="submit" class="blue-btn" value="Save">
                            </div>    
                            
                            <div class="input-data">
                                <input action="<?php echo URLROOT; ?>/notices/index" type="submit" class="red-btn" value="Back"  >
                            </div>
                        </div> 

                    </form>
                </div>
            </div>
        </div>







<?php
    require APPROOT . '/views/includes/footer.php';

?>



