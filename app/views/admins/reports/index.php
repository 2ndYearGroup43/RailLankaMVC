<?php
   require APPROOT . '/views/includes/admin_head.php';
?>


<?php
    require APPROOT . '/views/includes/admin_navigation.php';
?>

    <div class="body-section">
            <div class="content-row">
                <ul class="breadcrumb">
                    <li><a href="<?php echo URLROOT; ?>/admins/index">Home</a></li>
                    <li><u>Reports</u></li>
                    <li><a href="<?php echo URLROOT; ?>/adminReports/index">Add Revenue Details</a></li>
                </ul>
            </div>
    


            <div class="content-flexrow">
                <div class="container">
                    <div class="text">Add Revenue Report Details</div>
                    <form action="<?php echo URLROOT; ?>/adminReports/setting" method="POST">
                    


            <br>
            <h3>Select Report Type</h3>

            <label class="checkradio">Online Revenue
                <input  type="radio" checked="checked" name="radio" value="Online">
                <span class="checkmark"></span><br>
            </label>
            <label  class="checkradio">Over the Counter Revenue
                <input  type="radio" name="radio" value="Over the counter">
                <span class="checkmark"></span><br>
            </label>
            <label class="checkradio">Both Revenue
                <input type="radio" name="radio" value="Both">
                <span class="checkmark"></span>
            </label>


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
                                    <option value="2">2</option>
                                </select>
                            </div>
                    </div>-->
                    <br>

    

                        <div class="form-row submit-btn">
                            <div class="input-data">
                                <input name="create" type="submit" class="blue-btn" value="Create Report">
                            </div>
                            <div class="input-data">
                                <input onclick="history.go(-1);" type="button" class="red-btn" value="Back"  >
                            </div>    
                        </div>

                    </form>




                </div>
            </div>
        </div>





<?php
    require APPROOT . '/views/includes/footer.php';

?>



