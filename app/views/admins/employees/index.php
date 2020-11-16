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
                    <li><u>Employee Management</u></li>
                    <li><a href="<?php echo URLROOT; ?>/employees/index">Manage Employees</a></li>
                </ul>
            </div>




            



            <div class="content-row">
                <div class="container-table">
                    <h2>Employee Management </h2>


                <div class="table-searchbar">
                    <form action="#" method="POST">
                        <input type="text" placeholder="Search by" name=searchbar><span><select name="searchselect" id="searchselect">
                            <option value="employee ID">Employee ID</option>
                                    <option value="firstname">Firstname</option>
                                    <option value="Email">Email</option>
                        </select></span><span><input type="submit" value=" " class="search-btn"></span><span><i class="fa fa-search glyph"></i></span>
                    </form>
                </div>



                    <table class="blue">
                        <thead>
                            <tr>
                                <th>Employee ID</th>
                                <th>Password</th>
                                <th>First name</th>
                                <th>Last name</th>
                                <th>Email Address</th>
                                <th>Mobile Number</th>
                                <th>Manage</th>    
                            </tr>
                        </thead>
                        <tr>
                            <td data-th="Employee ID">xxxxxx</td>
                            <td data-th="Password">xxxxxx</td>
                            <td data-th="First name">xxxxxx</td>
                            <td data-th="Last name">xxxxxx</td>
                            <td data-th="Email Address">xxxxxx</td>
                            <td data-th="Mobile Number">xxxxxx</td>
                            <td data-th="Manage"><input type="submit" class="blue-btn" onclick="openForm()" value="View"><input onclick="location.href='<?php echo URLROOT; ?>/employees/update_employee' " type="submit" class="blue-btn" value="Edit"><input type="submit" class="red-btn" value="Delete"></td>

                        </tr>
                        <tr>
                            <td data-th="Employee ID">xxxxxx</td>
                            <td data-th="Password">xxxxxx</td>
                            <td data-th="First name">xxxxxx</td>
                            <td data-th="Last name">xxxxxx</td>
                            <td data-th="Email Address">xxxxxx</td>
                            <td data-th="Mobile Number">xxxxxx</td>
                            <td data-th="Manage"><input type="submit" class="blue-btn" onclick="openForm()" value="View"><input onclick="location.href='<?php echo URLROOT; ?>/employees/update_employee' "  type="submit" class="blue-btn" value="Edit"><input type="submit" class="red-btn" value="Delete"></td>

                        </tr>

                        <tr>
                            <td data-th="Employee ID">xxxxxx</td>
                            <td data-th="Password">xxxxxx</td>
                            <td data-th="First name">xxxxxx</td>
                            <td data-th="Last name">xxxxxx</td>
                            <td data-th="Email Address">xxxxxx</td>
                            <td data-th="Mobile Number">xxxxxx</td>
                            <td data-th="Manage"><input type="submit" class="blue-btn" onclick="openForm()" value="View"><input onclick="location.href='<?php echo URLROOT; ?>/employees/update_employee' "  type="submit" class="blue-btn" value="Edit"><input type="submit" class="red-btn" value="Delete"></td>

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
                                <label for="trainid">Employee Id</label>
                                <input type="text" name="trainid" id="trainid" placeholder="xxxxxxxxxxxxx" required >

                            </div>
                        </div>
                        <div class="form-row">
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
                        </div>
                        <div class="form-row">
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
                        </div>
                        <div class="form-row">
                            <div class="input-data ">
                                 <label for="delaycause">Mobile Number </label>
                                 <input type="text" name="trainid" id="trainid" placeholder="xxxxxxxxxxxxx" required >
                           </div>
                        </div>




                    </form>
                </div>
        
            </div>

            






<?php
    require APPROOT . '/views/includes/footer.php';

?>



