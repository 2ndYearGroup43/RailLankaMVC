<?php
   require APPROOT . '/views/includes/admin_head.php';
?>


    <?php
       require APPROOT . '/views/includes/admin_navigation.php';
    ?>
<!--<?php var_dump($data['notice'])?>-->
<div class="body-section">

            <!--<div class="content-row">-->
                <ul class="breadcrumb">
                    <li><a href="<?php echo URLROOT; ?>/admins/index">Home</a></li>
                    <li><u>Notice </u></li>
                    <li><a href="<?php echo URLROOT; ?>/adminNotices/addNotice">Add New Notices Management</a></li>
                </ul>
          

            <div class="content-flexrow">
                <div class="container">

                    <div class="logo-container" align="center">
                        <a href="index.html">
                        <img src="<?php echo URLROOT;?>/public/img/logotrack.jpg" height="130px" algin="center" >
                        </a>
                    </div>

                    <div class="text"></div>

                    <center><h1>Add New Notice Details</h1></center>

                    <form action="<?php echo URLROOT; ?>/adminNotices/addNotice" method="POST">

                        <div class="form-row">
                            <div class="input-data">
                                <label for="type">Notice Type</label>
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
                            <div class="input-data textarea">
                                <label for="description">Description</label>
                                 <textarea name="description" id="description" cols="30" rows="10" placeholder="Enter the Description.." required></textarea>
                                 <span class="invalidFeedback">
                                    <?php echo $data['descriptionError']; ?>
                                </span>
                            </div>

                        </div>
                        <br>



                        <div class="form-row submit-btn">
                            <div class="input-data">
                                <input type="submit" class="blue-btn" value="Save">
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



