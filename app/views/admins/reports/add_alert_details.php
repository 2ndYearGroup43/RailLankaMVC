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
                    <li><u>Reports</u></li>
                    <li><a href="<?php echo URLROOT; ?>/adminReports/addAlertDetails">Add Alert Report Details</a></li>
                </ul>
            </div>



    
            <div class="content-flexrow">
                <div class="container">
                    <div class="text">Add Alert Report Details</div>
                    <form action="<?php echo URLROOT; ?>/adminReports/alertsetting" method="POST">



                    <br>

            <h3>Select Report Type</h3>

            <label class="checkradio">Cancellation Alerts
                <input type="radio" checked="checked" name="radio" value="Cancellation">
                <span class="checkmark"></span>
            </label>
            <label class="checkradio">Delays Alerts
                <input type="radio" name="radio" value="Delays">
                <span class="checkmark"></span>
            </label>
            <label class="checkradio">Reschedulements Alerts
                <input type="radio" name="radio" value="Reschedulements">
                <span class="checkmark"></span>
            </label>
            <label class="checkradio">All Alerts
                <input type="radio" name="radio" value="All">
                <span class="checkmark"></span>
            </label>


                     <div class="form-row">
                            <div class="input-data">
                                <label for="dest">Select Train</label>
                                <select name="dest" id="dest">
                                    <option value="t1">t1</option>
                                    <option value="t2">t2</option>
                                </select>
                            </div>
                    </div>



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


                     
                    <div class="form-row">
                            <div class="input-data">
                                <label for="dest">Alert Cause Type</label>
                                <select name="dest" id="dest">
                                    <option value="d1">c1</option>
                                    <option value="d2">c2</option>
                                </select>
                            </div>
                    </div>
                     <div class="form-row">
                            <div class="input-data">
                                <label for="dest">Order By</label>
                                <select name="dest" id="dest">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                </select>
                            </div>
                    </div>
                    <br>

                        <div class="form-row submit-btn">
                            <div class="input-data">
                                <input name="create" type="submit" class="blue-btn" value="Create Report">
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



