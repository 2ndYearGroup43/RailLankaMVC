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
                    <li><a href="<?php echo URLROOT; ?>/reports/add_refund_details">Add Refund Report Details</a></li>
                </ul>
            </div>

            <div class="content-flexrow">
                <div class="container">
                    <div class="text">Add Refund Report Details</div>
                    <form action="<?php echo URLROOT; ?>/reports/refund_report" method="POST">


                     <div class="form-row">
                            <div class="input-data">
                                <label for="dest">Select Train</label>
                                <select name="dest" id="dest">
                                    <option value="t1">t1</option>
                                    <option value="t2">t2</opttion>
                                </select>
                            </div>
                    </div>
                    <br>
                     <div class="form-row">
                            <div class="input-data">
                                <label for="dest">Select Duration</label>
                                <select name="dest" id="dest">
                                    <option value="d1">d1</option>
                                    <option value="d2">d2</opttion>
                                </select>
                            </div>
                    </div>
                    <br>
                     <div class="form-row">
                            <div class="input-data">
                                <label for="dest">Order By</label>
                                <select name="dest" id="dest">
                                    <option value="1">1</option>
                                    <option value="2">2</opttion>
                                </select>
                            </div>
                    </div>
                    <br>
    




                        <div class="form-row submit-btn">
                            <div class="input-data">
                                <input onclick="location.href='<?php echo URLROOT; ?>/reports/refund_report' "   type="submit" class="blue-btn" value="Create Report">
                            </div>    
                            
                        </div>
                    </form>
                </div>
            </div>
        </div>






<?php
    require APPROOT . '/views/includes/footer.php';

?>



