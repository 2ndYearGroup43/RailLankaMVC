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
                    <li><a href="<?php echo URLROOT; ?>/adminReports/manageAlertReports">Manage Alert Reports </a></li>
                </ul>
            </div>

            




            <div class="content-row">
                <div class="container-table">
                    <h2>Alert Report Management </h2>

                <div class="table-searchbar">
                    <form action="#" method="POST">
                        <input type="text" placeholder="Search by" name=searchbar><span><select name="searchselect" id="searchselect">
                                    <option value="notice Id">Report ID</option>
                                    <option value="Type">Type</option>
                                    <option value="Date">Created Date</option>
                                    <option value="Date">Created Time</option>
                        </select></span><span><input type="submit" value=" " class="search-btn"></span><span><i class="fa fa-search glyph"></i></span>
                    </form>
                </div>


                    <table class="blue">
                        <thead>
                            <tr>
                                <th>Report ID</th>
                                <th>Type</th>
                                <th>Created Date</th>
                                <th>Created Time</th>
                                <th>Admin ID</th>
                                <th>Description</th>
                                <th>Manage</th>    
                            </tr>
                        </thead>
                        <tr>
                            <td data-th="Id">0001</td>
                            <td data-th="Type">Cancellation</td>
                            <td data-th="Entered Date">01/12/2020</td>
                            <td data-th="Entered Time">10.00 AM</td>
                            <td data-th="Admin ID">00012D</td>
                            <td data-th="Description">November cancellation alerts</td>
                            <td data-th="Manage"><input type="submit" class="blue-btn" onclick="location.href='<?php echo URLROOT ;?>/adminReports/cancellationAlertReport'" value="View"><input type="submit" class="red-btn" value="Delete"></td>

                        </tr>
                        <tr>
                            <td data-th="Id">0002</td>
                            <td data-th="Type">Delay</td>
                            <td data-th="Entered Date">01/12/2020</td>
                            <td data-th="Entered Time">11.40 AM</td>
                            <td data-th="Admin ID">00001A</td>
                            <td data-th="Description">November delay alerts</td>
                            <td data-th="Manage"><input type="submit" class="blue-btn" onclick="location.href='<?php echo URLROOT ;?>/adminReports/delayAlertReport'" value="View"><input type="submit" class="red-btn" value="Delete"></td>

                        </tr>
                        <tr>
                            <td data-th="Id">0003</td>
                            <td data-th="Type">Reschedulment</td>
                            <td data-th="Entered Date">01/12/2020</td>
                            <td data-th="Entered Time">11.50 AM</td>
                            <td data-th="Admin ID">0004S</td>
                            <td data-th="Description">November reschedulment alerts</td>
                            <td data-th="Manage"><input type="submit" class="blue-btn" onclick="location.href='<?php echo URLROOT ;?>/adminReports/reschedulmentAlertReport'" value="View"><input type="submit" class="red-btn" value="Delete"></td>

                        </tr>
                        <tr>
                            <td data-th="Id">0004</td>
                            <td data-th="Type">All</td>
                            <td data-th="Entered Date">01/12/2020</td>
                            <td data-th="Entered Time">12.00 AM</td>
                            <td data-th="Admin ID">0002A</td>
                            <td data-th="Description">November all alerts</td>
                            <td data-th="Manage"><input type="submit" class="blue-btn" onclick="location.href='<?php echo URLROOT ;?>/adminReports/allAlertReport'" value="View"><input type="submit" class="red-btn" value="Delete"></td>

                        </tr>
                    </table> 
                </div>       
            </div>
        </div>







            </div>
        </div>






<?php
    require APPROOT . '/views/includes/footer.php';

?>



