<?php
   require APPROOT . '/views/includes/admin_head.php';
?>


    <?php
       require APPROOT . '/views/includes/admin_navigation.php';
    ?>

<div class="body-section">

            <!--<div class="content-row">-->
                <ul class="breadcrumb">
                    <li><a href="<?php echo URLROOT; ?>/admins/index">Home</a></li>
                    <li><u>Reports</u></li>
                    <li><a href="<?php echo URLROOT; ?>/adminReports/addRefundDetails">Add Refund Report Details</a></li>
                </ul>
            

            <div class="content-flexrow">
                <div class="container">
                    <div class="text">Add Refund Report Details</div>
                    <form action="<?php echo URLROOT; ?>/adminReports/refundReport" method="POST">


                     <div class="form-row">
                            <div class="input-data">
                                <label for="dest">Select Train</label>
                                <select name="dest" id="dest">
                                    <option value="t1">All Trains</option>
                                    <option value="t1">Galuu Kumaree</option>
                                    <option value="t2">Udarata Manike</option>
                                    <option value="t2">Badulu Dewi</option>
                                    <option value="t2">Ruhunu Kumaree</option>
                                </select>
                            </div>
                    </div>
                    <br>
                     <div class="form-row">
                        <!--<label>Select Duration</label>-->
                            <div class="input-data">
                                <label for="date">From</label>
                                <input type="date" id="date" >
                            </div>
                            <div class="input-data">
                                <label for="date">To</label>
                                <input type="date" id="date" >
                            </div>
                        
                    </div>
                    <br>
                     <!--<div class="form-row">
                            <div class="input-data">
                                <label for="dest">Order By</label>
                                <select name="dest" id="dest">
                                    <option value="1">1</option>
                                    <option value="2">2</opttion>
                                </select>
                            </div>
                    </div>
                    <br>-->
    




                        <div class="form-row submit-btn">
                            <div class="input-data">
                                <input onclick="location.href='<?php echo URLROOT; ?>/adminReports/refundReport' "   type="submit" class="blue-btn" value="Create Report">
                            </div> 
                            <div class="input-data">
                                <input onclick="history.go(-1);" type="submit" class="red-btn" value="Back"  >
                            </div>   
                            
                        </div>
                    </form>
                </div>
            </div>
        </div>






<?php
    require APPROOT . '/views/includes/footer.php';

?>



