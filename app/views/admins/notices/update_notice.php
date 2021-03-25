<?php
   require APPROOT . '/views/includes/admin_head.php';
?>
<?php
   require APPROOT . '/views/includes/admin_navigation.php';
//   var_dump($data);
?>

<div class="body-section">

            <div class="content-row">
                <ul class="breadcrumb">
                    <li><a href="<?php echo URLROOT; ?>/admins/index">Home</a></li>
                    <li><u>Notice Management</u></li>
                    <li><a href="<?php echo URLROOT; ?>/adminNotices/index">Manage Notices</a></li>
                    <li><a href="<?php echo URLROOT; ?>/adminNotices/updateNotice">Update Notices</a></li>
                </ul>
            </div>



            <div class="content-flexrow">
                <div class="container">
                    <div class="text">Update Notice Details</div>
                    
                    <form action="<?php echo URLROOT; ?>/adminNotices/updateNotice/<?php echo $data['notice']->noticeId;?>" method="POST">


                        <div class="form-row">
                            <div class="input-data">
                                <label for="type">Notice Type</label>

                                <select name="type" id="type">
                                    <option value="Main" 
                                    <?php 
                                        if($data['notice']->type=="Main")
                                            {echo "selected";}
                                    ?>
                                    >Main</option>

                                    <option value="Normal"
                                    <?php 
                                        if($data['notice']->type=="Normal")
                                    
                                            {echo "selected";}
                                    ?>
                                    >Normal</option>
                                </select>

                                <span class="invalidFeedback">
                                    <?php echo $data['typeError']; ?>
                                </span>
                            </div>
                        </div>


                        <div class="form-row">
                            <div class="input-data textarea">
                                 <label for="description">Description</label>
                                 <textarea name="description" id="description" cols="30" rows="10"  required><?php echo $data['notice']->description;?></textarea>

                                 <span class="invalidFeedback">
                                    <?php echo $data['descriptionError']; ?>
                                </span>
                            </div>
                        </div>

                        <br>

                        <div class="form-row submit-btn">
                            <div class="input-data">
                                <input   type="submit" class="blue-btn" value="Update">
                            </div>    
                            
                            <div class="input-data">
                                <input onclick="history.go(-1);" type="button" class="red-btn" value="Back">
                            </div>
                        </div>  

                        
                    </form>
                    </div>
                </div>
            </div>


<?php
    require APPROOT . '/views/includes/footer.php';

?>



