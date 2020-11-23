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
                    <li><a href="<?php echo URLROOT; ?>/adminReports/manageRefundReports">Manage Refund Reports</a></li>
                </ul>
            </div>

            




            <div class="content-row">
                <div class="container-table">
                    <h2>Refund Report Management </h2>

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
                                <th>Created Date</th>
                                <th>Created Time</th>
                                <th>Admin ID</th>
                                <th>Description</th>
                                <th>Manage</th>    
                            </tr>
                        </thead>
                        <tr>
                            <td data-th="Id">0001</td>
                            <td data-th="Entered Date">01/12/2020</td>
                            <td data-th="Entered Time">11.00 AM</td>
                            <td data-th="Admin ID">00012A</td>
                            <td data-th="Description">November refunds</td>
                            <td data-th="Manage"><input type="submit" class="blue-btn" onclick="location.href='<?php echo URLROOT ;?>/adminReports/refundReport'" value="View"><input type="submit" class="red-btn" value="Delete"></td>

                        </tr>
                        <tr>
                            <td data-th="Id">0002</td>
                            <td data-th="Entered Date">01/01/2021</td>
                            <td data-th="Entered Time">10.00 AM</td>
                            <td data-th="Admin ID">00032A</td>
                            <td data-th="Description">December refunds</td>
                            <td data-th="Manage"><input type="submit" class="blue-btn" onclick="location.href='<?php echo URLROOT ;?>/adminReports/refundReport'" value="View"><input type="submit" class="red-btn" value="Delete"></td>

                        </tr>
                    </table> 
                </div>       
            </div>
        </div>



<div class="container-searchbox-popup " id="popupsearch">
                    <form action="#">
                       
                        <div class="form-row submit-btn">
                               
                            <div class="input-data">
                                <input type="submit" class="red-btn" value="close" style="font-size: 15px;" onclick="closeForm()">
                            </div>
                        </div>


                        <div class="content-flexrow">
                <div class="container-table">
                    <h2 style="color: #13406d;">Revenue Details <small style="color: black;">Admin Id: xxxx</small></h2>
                    <table class="data-display">
                        <caption>Online Details</caption>
                        <tr>
                            <td>Train Id</td>
                            <td>xxxx</td>
                            <td colspan="3"></td>
                        </tr>
                        <tr>
                            <td >Train Name: </td>
                            <td>xxxx</td>
                            <td colspan="2"></td>
                        </tr>
                        <tr>
                            <td>Rotu: </td>
                            <td>xxxx</td>
                            <td colspan="2"></td>
                        </tr>
                        <tr>
                            <td >Total Select Duration: </td>
                            <td>xxxx</td>
                            <td colspan="2"></td>
                        </tr>
                        <tr>
                            <td>Total Revenue for Online : </td>
                            <td>xxxx</td>
                            <td colspan="2"></td>
                        </tr>
                    
                    </table>
                    <!--<button onclick="history.go(-1);" type="submit" class="back-btn">Back</button>-->
                </div>
            </div>
        </div>


                    </form>
                </div>




            </div>
        </div>






<?php
    require APPROOT . '/views/includes/footer.php';

?>



