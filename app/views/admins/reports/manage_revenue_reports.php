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
                    <li><a href="<?php echo URLROOT; ?>/adminReports/manageRevenueReports">Manage Revenue Reports</a></li>
                </ul>
            </div>

            




            <div class="content-row">
                <div class="container-table">
                    <h2>Revenue Report Management </h2>

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
                            <td data-th="Type">Counter Revenue</td>
                            <td data-th="Created Date">20/12/2020</td>
                            <td data-th="Created Time">10.30 AM</td>
                            <td data-th="Admin ID">00003B</td>
                            <td data-th="Description">November counter revenue</td>
                            <td data-th="Manage"><input type="submit" class="blue-btn" onclick="location.href='<?php echo URLROOT ;?>/adminReports/counterRevenueReport'" value="View"><input type="submit" class="red-btn" value="Delete"></td>

                        </tr>
                        <tr>
                            <td data-th="Id">00011</td>
                            <td data-th="Type">Online Revenue</td>
                            <td data-th="Created Date">14/12/2020</td>
                            <td data-th="Created Time">10.00 AM</td>
                            <td data-th="Admin ID">00002A</td>
                            <td data-th="Description">November online revenue</td>
                            <td data-th="Manage"><input type="submit" class="blue-btn" onclick="location.href='<?php echo URLROOT ;?>/adminReports/onlineRevenueReport'" value="View"><input type="submit" class="red-btn" value="Delete"></td>

                        </tr>
                        <tr>
                            <td data-th="Id">0002</td>
                            <td data-th="Type">Both Revenue</td>
                            <td data-th="Created Date">20/12/2020</td>
                            <td data-th="Created Time">11.00 AM</td>
                            <td data-th="Admin ID">00002A</td>
                            <td data-th="Description">November online & counter revenue</td>
                            <td data-th="Manage"><input type="submit" class="blue-btn" onclick="location.href='<?php echo URLROOT ;?>/adminReports/bothRevenueReport'" value="View"><input type="submit" class="red-btn" value="Delete"></td>

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



