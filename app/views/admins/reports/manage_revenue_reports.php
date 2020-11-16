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
                    <li><a href="<?php echo URLROOT; ?>/reports/manage_revenue_reports">Manage Revenue Reports</a></li>
                </ul>
            </div>

            




            <div class="content-row">
                <div class="container-table">
                    <h2>Revenue Report Management </h2>

                <div class="table-searchbar">
                    <form action="#" method="POST">
                        <input type="text" placeholder="Search by" name=searchbar><span><select name="searchselect" id="searchselect">
                                    <option value="notice Id">User ID</option>
                                    <option value="Type">Type</option>
                                    <option value="Date">Created Date</option>
                                    <option value="Date">Created Time</option>
                        </select></span><span><input type="submit" value=" " class="search-btn"></span><span><i class="fa fa-search glyph"></i></span>
                    </form>
                </div>


                    <table class="blue">
                        <thead>
                            <tr>
                                <th>Type</th>
                                <th>Created Date</th>
                                <th>Created Time</th>
                                <th>Admin ID</th>
                                <th>Description</th>
                                <th>Manage</th>    
                            </tr>
                        </thead>
                        <tr>
                            <td data-th="Type">XXXXXX</td>
                            <td data-th="Created Date">XXXXXX</td>
                            <td data-th="Created Time">XXXXXXXXX</td>
                            <td data-th="Admin ID">XXXXXX</td>
                            <td data-th="Description">XXXXXX</td>
                            <td data-th="Manage"><input type="submit" class="blue-btn" onclick="location.href='<?php echo URLROOT ;?>/reports/counter_revenue_report'" value="View"><input type="submit" class="red-btn" value="Delete"></td>

                        </tr>
                        <tr>
                            <td data-th="Type">XXXXXX</td>
                            <td data-th="Created Date">XXXXX</td>
                            <td data-th="Created Time">XXXXXX</td>
                            <td data-th="Admin ID">XXXXXX</td>
                            <td data-th="Description">XXXXXX</td>
                            <td data-th="Manage"><input type="submit" class="blue-btn" onclick="location.href='<?php echo URLROOT ;?>/reports/online_revenue_report'" value="View"><input type="submit" class="red-btn" value="Delete"></td>

                        </tr>
                        <tr>
                            <td data-th="Type">XXXXXX</td>
                            <td data-th="Created Date">XXXXX</td>
                            <td data-th="Created Time">XXXXXX</td>
                            <td data-th="Admin ID">XXXXXX</td>
                            <td data-th="Description">XXXXXX</td>
                            <td data-th="Manage"><input type="submit" class="blue-btn" onclick="location.href='<?php echo URLROOT ;?>/reports/both_revenue_report'" value="View"><input type="submit" class="red-btn" value="Delete"></td>

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



