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
                    <li><u>User Management</u></li>
                    <li><a href="<?php echo URLROOT; ?>/notices/index">Manage Passengers</a></li>
                </ul>
            </div>

            

            <div class="content-row">
                <div class="container-table">
                    <h2>User Management </h2>

                <div class="table-searchbar">
                    <form action="#" method="POST">
                        <input type="text" placeholder="Search by" name=searchbar><span><select name="searchselect" id="searchselect">
                                    <option value="notice Id">User ID</option>
                                    <option value="Type">Email</option>
                                    <option value="Date">Register Date</option>
                                    <option value="Date">Register Time</option>
                        </select></span><span><input type="submit" value=" " class="search-btn"></span><span><i class="fa fa-search glyph"></i></span>
                    </form>
                </div>



                    <table class="blue">
                        <thead>
                            <tr>
                                <th>NIC</th>
                                <th>Password</th>
                                <th>First name</th>
                                <th>Last name</th>
                                <th>Email Address</th>
                                <th>Mobile Number</th>
                                <th>Address_No</th>
                                <th>Street</th>
                                <th>City</th>
                                <th>Country</th>
                                <th>Register Date</th>
                                <th>Register Time</th>
                                <th>Manage</th>    
                            </tr>
                        </thead>
                        <tr>
                            <td data-th="Employee ID">xxxxx</td>
                            <td data-th="Password">xxxxx</td>
                            <td data-th="First name">xxxxx</td>
                            <td data-th="Last name">xxxxx</td>
                            <td data-th="Email Address">xxxxx</td>
                            <td data-th="Mobile Number">xxxxx</td>
                            <td data-th="Address_No">xxxxx</td>
                            <td data-th="Street">xxxxx</td>
                            <td data-th="City">xxxxx</td>
                            <td data-th="Country">xxxxx</td>
                            <td data-th="Register Date">xxxxx</td>
                            <td data-th="Register Time">xxxxx</td>
                            <td data-th="Manage"><input type="submit" class="blue-btn" onclick="openForm()" value="View"><input type="submit" class="red-btn" value="Delete"></td>

                        </tr>
                        <tr>

                            <td data-th="Employee ID">xxxxx</td>
                            <td data-th="Password">xxxxx</td>
                            <td data-th="First name">xxxxx</td>
                            <td data-th="Last name">xxxxx</td>
                            <td data-th="Email Address">xxxxx</td>
                            <td data-th="Mobile Number">xxxxx</td>
                            <td data-th="Address_No">xxxxx</td>
                            <td data-th="Street">xxxxx</td>
                            <td data-th="City">xxxxx</td>
                            <td data-th="Country">xxxxx</td>
                            <td data-th="Register Date">xxxxx</td>
                            <td data-th="Register Time">xxxxx</td>
                            <td data-th="Manage"><input type="submit" class="blue-btn" onclick="openForm()" value="View"><input type="submit" class="red-btn" value="Delete"></td>


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
                                <label for="trainid">NIC</label>
                                <input type="text" name="trainid" id="trainid" placeholder="xxxxxxxxxxxxx" required >
                            </div>
                            <div class="input-data ">
                                 <label for="delaycause">Password</label>
                                 <input type="text" name="trainid" id="trainid" placeholder="xxxxxxxxxxxxx" required >   
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="input-data ">
                                 <label for="delaycause">First Name</label>
                                 <input type="text" name="trainid" id="trainid" placeholder="xxxxxxxxxxxxx" required > 
                            </div>
                            <div class="input-data ">
                                 <label for="delaycause">Last Name</label>
                                 <input type="text" name="trainid" id="trainid" placeholder="xxxxxxxxxxxxx" required > 
                           </div>
                        </div>
                        <div class="form-row">
                            <div class="input-data ">
                                 <label for="delaycause">Email Address</label>
                                 <input type="text" name="trainid" id="trainid" placeholder="xxxxxxxxxxxxx" required >
                            </div>     
                            <div class="input-data ">
                                 <label for="delaycause">Mobile No </label>
                                 <input type="text" name="trainid" id="trainid" placeholder="xxxxxxxxxxxxx" required >
                           </div>
                        </div>
                        <div class="form-row">
                            
                        </div>
                        <div class="form-row">
                            <div class="input-data ">
                                 <label for="delaycause">Address No </label>
                                 <input type="text" name="trainid" id="trainid" placeholder="xxxxxxxxxxxxx" required >
                           </div>
                           <div class="input-data ">
                                 <label for="delaycause">Street </label>
                                 <input type="text" name="trainid" id="trainid" placeholder="xxxxxxxxxxxxx" required >
                           </div>
                           <div class="input-data ">
                                 <label for="delaycause">City </label>
                                 <input type="text" name="trainid" id="trainid" placeholder="xxxxxxxxxxxxx" required >
                           </div>
                        </div>
                        <div class="form-row">
                            <div class="input-data ">
                                 <label for="delaycause">Country</label>
                                 <input type="text" name="trainid" id="trainid" placeholder="xxxxxxxxxxxxx" required >
                           </div>
                        </div>
                        <div class="form-row">
                            <div class="input-data ">
                                 <label for="delaycause">Registered Date</label>
                                 <input type="text" name="trainid" id="trainid" placeholder="xxxxxxxxxxxxx" required > 
                            </div>
                            <div class="input-data ">
                                 <label for="delaycause">Registered Time</label>
                                 <input type="text" name="trainid" id="trainid" placeholder="xxxxxxxxxxxxx" required > 
                           </div>
                        </div>

                    </form>
                </div>




            </div>
        </div>






<?php
    require APPROOT . '/views/includes/footer.php';

?>



