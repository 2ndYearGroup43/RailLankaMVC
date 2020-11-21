<?php
   require APPROOT . '/views/includes/admin_head.php';
?>


    <?php
       require APPROOT . '/views/includes/admin_navigation.php';
    ?>

<div class="body-section">

            <div class="content-row">
                <ul class="breadcrumb">
                    <li><a href="#">Home</a></li>
                    <li><u>Notice Management</u></li>
                    <li><a href="<?php echo URLROOT; ?>/adminNotices/index">Manage Notices</a></li>
                    <li><a href="<?php echo URLROOT; ?>/adminNotices/updateNotice">Update Notices</a></li>
                </ul>
            </div>



            <div class="content-flexrow">
                <div class="container">
                    <div class="text">Update Notice Details</div>
                    <form action="#">
                        <div class="form-row">
                            <div class="input-data">
                                <label for="trainid">Notice Id</label>
                                <input type="text" name="trainid" id="trainid" placeholder="00001" required >
                            </div>
                        </div>
                     <div class="form-row">
                            <div class="input-data">
                                <label for="dest">Notice Type</label>
                                <select name="dest" id="dest">
                                    <option value="Fort">Main</option>
                                    <option value="Kandy">Normal</option>
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
                                <input type="text" name="trainid" id="trainid" placeholder="00011" required >
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="input-data textarea">
                                 <label for="delaycause">Description</label>
                                 <textarea name="delaycause" id="delaycause" cols="30" rows="10" placeholder="xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx" required></textarea>
                            </div>
                        </div>
                        <br>

                        <div class="form-row submit-btn">
                            <div class="input-data">
                                <input type="submit" class="blue-btn" value="Update">
                            </div>    
                            
                            <div class="input-data">
                                <input onclick="history.go(-1);" type="submit" class="red-btn" value="Back">
                            </div>
                        </div>  

                        
                    </form>
                    
                </div>
            </div>
        </div>






<?php
    require APPROOT . '/views/includes/footer.php';

?>



