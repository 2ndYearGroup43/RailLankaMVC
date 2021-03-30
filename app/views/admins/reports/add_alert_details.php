<?php
   require APPROOT . '/views/includes/admin_head.php';
?>


    <?php
       require APPROOT . '/views/includes/admin_navigation.php';
    ?>
<!-- <?php var_dump($data["trains"]) ?> -->
<div class="body-section">

            <div class="content-row">
                <ul class="breadcrumb">
                    <li><a href="<?php echo URLROOT; ?>/admins/index">Home</a></li>
                    <li><u>Reports</u></li>
                    <li><a href="<?php echo URLROOT; ?>/adminReports/addAlertDetails">Add Alert Report Details</a></li>
                </ul>
            </div>


            <div class="content-flexrow">
                <div class="container">
                    <div class="text">Add Alert Report Details</div>
                    <form action="<?php echo URLROOT; ?>/adminReports/addAlertDetails" method="POST">


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

                                <select name = "trainName">

                                <?php foreach ($data["trains"] as $train): ?>
                                <option value= "<?php echo $train->trainId; ?>"> <?php echo $train->name; ?></option>
                                <?php endforeach ;?>

                                     <!-- <?php echo $data['train']->name;?> -->
                                </select>

                                <span class="invalidFeedback">
                                    <?php echo $data['nameError']; ?>
                                </span>

                                
                            </div>
                    </div>



                    <div class="form-row">
                        <!--<label>Select Duration</label>-->
                            <div class="input-data">
                                <label for="from_date">From</label>
                                <input type="date" name="fromDate" id="from_date" max= "<?php echo date("Y-m-d");?>" >

                                <span class="invalidFeedback">
                                    <?php echo $data['fromError']; ?>
                                </span>

                            </div>
                            <div class="input-data">
                                <label for="to_date">To</label>
                                <input type="date" name="toDate" id="to_date" max= "<?php echo date("Y-m-d");?>" >
                                <span class="invalidFeedback">
                                    <?php echo $data['toError']; ?>
                                </span>
                            </div>
                        
                    </div>

                    <br>

                        <div class="form-row submit-btn">
                            <div class="input-data">
                      <input name="create" type="submit" class="blue-btn"  value="Create Report">         <!--  <input onclick="location.href='<?php echo URLROOT; ?>/adminReports/alertsetting' "                            type="submit"  class="blue-btn" value="Create Report"> -->
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



