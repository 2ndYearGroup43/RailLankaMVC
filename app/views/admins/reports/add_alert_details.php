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
                    <li><u>Reports</u></li>
                    <li><a href="<?php echo URLROOT; ?>/reports/add_alert_details">Add Alert Report Details</a></li>
                </ul>
            </div>



    
            <div class="content-flexrow">
                <div class="container">
                    <div class="text">Add Alert Report Details</div>
                    <form action="<?php echo URLROOT; ?>/reports/cancellation_alert_report" method="POST">



                    <br>

            <h3>Select Report Type</h3>

            <label class="checkradio">Cancellation
                <input type="radio" checked="checked" name="radio">
                <span class="checkmark"></span>
            </label>
            <label class="checkradio">Delays
                <input type="radio" name="radio">
                <span class="checkmark"></span>
            </label>
            <label class="checkradio">Reschedulements
                <input type="radio" name="radio">
                <span class="checkmark"></span>
            </label>
            <label class="checkradio">All
                <input type="radio" name="radio">
                <span class="checkmark"></span>
            </label>


                     <div class="form-row">
                            <div class="input-data">
                                <label for="dest">Select Train</label>
                                <select name="dest" id="dest">
                                    <option value="t1">t1</option>
                                    <option value="t2">t2</opttion>
                                </select>
                            </div>
                    </div>
                     <div class="form-row">
                            <div class="input-data">
                                <label for="dest">Select Duration</label>
                                <select name="dest" id="dest">
                                    <option value="d1">d1</option>
                                    <option value="d2">d2</opttion>
                                </select>
                            </div>
                    </div>
                    <div class="form-row">
                            <div class="input-data">
                                <label for="dest">Alert Cause Type</label>
                                <select name="dest" id="dest">
                                    <option value="d1">c1</option>
                                    <option value="d2">c2</opttion>
                                </select>
                            </div>
                    </div>
                     <div class="form-row">
                            <div class="input-data">
                                <label for="dest">Order By</label>
                                <select name="dest" id="dest">
                                    <option value="1">1</option>
                                    <option value="2">2</opttion>
                                </select>
                            </div>
                    </div>

                        <div class="form-row submit-btn">
                            <div class="input-data">
                                <input type="submit" class="blue-btn" onclick="location.href='<?php echo URLROOT ;?>/reports/cancellation_alert_report'" value="Create Report">
                            </div>
                          
                        </div>


                    </form>
                </div>
            </div>
        </div>





<?php
    require APPROOT . '/views/includes/footer.php';

?>



