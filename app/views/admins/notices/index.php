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
                    <li><u>Notice Management</u></li>
                    <li><a href="<?php echo URLROOT; ?>adminNotices/index">Manage Notices</a></li>
                </ul>
            </div>

           

            <div class="content-row">
                <div class="container-table">
                    <h2>Notice Management </h2>

                <div class="table-searchbar">
                    <form action="#" method="POST">
                        <input type="text" placeholder="Search by" name=searchbar><span><select name="searchselect" id="searchselect">
                                    <option value="notice Id">Notice ID</option>
                                    <option value="Type">Type</option>
                                    <option value="Date">Entered Date</option>
                                    <option value="Date">Entered Time</option>
                        </select></span><span><input type="submit" value=" " class="search-btn"></span><span><i class="fa fa-search glyph"></i></span>
                    </form>
                </div>

                    <table class="blue">
                        <thead>
                            <tr>
                                <th>Notice ID</th>
                                <th>Notice Type</th>
                                <th>Entered Date</th>
                                <th>Entered Time</th>
                                <th>Admin ID</th>
                                
                                <th>Manage</th>    
                            </tr>
                        </thead>
                        

                        <?php foreach ($data as $row):?>
                    <tr>
                        <td data-th="Notice ID"><?php echo $row->nticeId;?></td>
                        <td data-th="Notice Type"><?php echo $row->type;?></td>
                        <td data-th="Entered Date"><?php echo $row->date;?></td>
                        <td data-th="Entered Time"><?php echo $row->time;?></td>
                        <td data-th="Admin ID"><?php echo $row->adminId;?></td>
                        <td data-th="Description"><?php echo $row->description;?></td>
                        <td data-th="Manage"><input type="submit" class="blue-btn" value="View"><input type="submit" class="blue-btn" value="Edit"><input type="submit" class="red-btn" value="Delete"></td>
                    </tr>
                    
                   <?php endforeach;?>


                   <tr>
                            <td data-th="Notice ID">00001</td>
                            <td data-th="Notice type">Main</td>
                            <td data-th="Entered Date">14/11/2020</td>
                            <td data-th="Entered Time">09.20 AM</td>
                            <td data-th="Admin ID">00011</td>
                            
                            <td data-th="Manage"><input type="submit" class="blue-btn" onclick="openForm()" value="View"><input onclick="location.href='<?php echo URLROOT; ?>/adminNotices/updateNotice' "  type="submit" class="blue-btn" value="Edit"><input type="submit" class="red-btn" value="Delete"></td>

                        </tr>
                        <tr>
                            <td data-th="Notice ID">00002</td>
                            <td data-th="Notice type">Normal</td>
                            <td data-th="Entered Date">15/12/2020</td>
                            <td data-th="Entered Time">10.00 AM</td>
                            <td data-th="Admin ID">00012</td>
                        
                            <td data-th="Manage"><input type="submit" class="blue-btn" onclick="openForm()" value="View"><input onclick="location.href='<?php echo URLROOT; ?>/adminNotices/updateNotice' " type="submit" class="blue-btn" value="Edit"><input type="submit" class="red-btn" value="Delete"></td>

                        </tr>

                        <tr>
                            <td data-th="Notice ID">00003</td>
                            <td data-th="Notice type">Normal</td>
                            <td data-th="Entered Date">19/12/2020</td>
                            <td data-th="Entered Time">12.10 PM</td>
                            <td data-th="Admin ID">00011</td>
                            
                            <td data-th="Manage"><input type="submit" class="blue-btn" onclick="openForm()" value="View"><input onclick="location.href='<?php echo URLROOT; ?>/adminNotices/updateNotice' " type="submit" class="blue-btn" value="Edit"><input type="submit" class="red-btn" value="Delete"></td>

                        </tr>




                    </table> 
                </div>





            <div class="container-searchbox-popup " id="popupsearch">
                    <form action="#">
                       
                        <div class="form-row submit-btn">
                               
                            <div class="input-data">
                                <input type="submit" class="red-btn" value="close" style="font-size: 15px;" onclick="closeForm()">
                            </div>
                        </div>

                        <div class="form-row">

                            <div class="input-data">
                                <label for="trainid">Notice Id</label>
                                <input type="text" name="trainid" id="trainid" placeholder="00001" required >

                            </div>
                            <div class="input-data ">
                                 <label for="delaycause">Admin ID</label>
                                 <input type="text" name="trainid" id="trainid" placeholder="00011" required >
                           </div>
                        </div>
                        <div class="form-row">
                            <div class="input-data ">
                                 <label for="delaycause">Notice type</label>
                                 <input type="text" name="trainid" id="trainid" placeholder="Main" required >   
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="input-data ">
                                 <label for="delaycause">Entered Date</label>
                                 <input type="text" name="trainid" id="trainid" placeholder="14/11/2020" required > 
                            </div>
                            <div class="input-data ">
                                 <label for="delaycause">Entered Time</label>
                                 <input type="text" name="trainid" id="trainid" placeholder="09.20 AM" required > 
                           </div>
                        </div>
                        <!--<div class="form-row">
                            <div class="input-data ">
                                 <label for="delaycause">Entered Time</label>
                                 <input type="text" name="trainid" id="trainid" placeholder="09.20 AM" required > 
                           </div>
                        </div>
                        <div class="form-row">
                            <div class="input-data ">
                                 <label for="delaycause">Admin ID</label>
                                 <input type="text" name="trainid" id="trainid" placeholder="00011" required >
                           </div>
                        </div>-->
                        <div class="form-row">
                            <!--<div class="input-data ">
                                 <label for="delaycause">Description </label>
                                 <input type="text" name="trainid" id="trainid" placeholder="xxxxxxxxxxxxx" required >
                           </div>-->
                           <div class="input-data textarea">
                                 <label for="delaycause">Description</label>
                                 <textarea name="delaycause" id="delaycause" cols="30" rows="10" placeholder="Train protests are scheduled for next week " required></textarea>
                            </div>
                        </div>

                    </form>
                </div>





            </div>
        </div>





<?php
    require APPROOT . '/views/includes/footer.php';

?>



