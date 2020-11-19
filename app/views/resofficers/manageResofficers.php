<?php
    require APPROOT.'/views/includes/resofficer_head.php';
?>
<?php
    require APPROOT.'/views/includes/train_management_navigation.php';
?>
    <div class="body-section">
        <div class="content-row"></div>
        <div class="content-row">
            <div class="container-table">
                <h1 style="color: #13406d;">Employee Management <small style="color: black;">Reservation officers</small></h1>
                <a class= "blue-btn" href="<?php echo URLROOT; ?>/Resofficers/registerResofficer">Add New Employee</a>
                <div class="table-searchbar">
                    <form action="<?php echo URLROOT?>/resofficers/resofficersSearchBy" method="POST">
                        <input type="text" placeholder="Search by" name=searchbar><span><select name="searchselect" id="searchselect">
                            <?php foreach ($data['fields'] as $field ):?>
                                    <option value="<?php echo $field->columns?>"><?php echo $field->columns?></option>
                            <?php endforeach;?>
                        </select></span><span><input type="submit" value=" " class="search-btn"></span><span><i class="fa fa-search glyph"></i></span>
                    </form>
                </div>
                <div class="container-table popup" id="popup-alert">
                    <h3>Reservation Officer Details</h3>
                    <table class="data-display" id="cancelpopup">
                        <tr id="userId">
                            <td>User Id: </td>
                            <td id="userId">Not available</td>
                            <td colspan="2"></td>
                        </tr>
                        <tr id="officerId">
                            <td>Officer Id: </td>
                            <td id="officerId">Not available</td>
                            <td colspan="2"></td>
                        </tr>
                        <tr id="employeeId">
                            <td>Employee Id: </td>
                            <td id="employeeId">Not available</td>
                            <td colspan="2"></td>
                        </tr><tr id="firstName">
                            <td>First Name: </td>
                            <td id="firstName">Not available</td>
                            <td colspan="2"></td>
                        </tr><tr id="lastName">
                            <td>Last Name: </td>
                            <td id="lastName">Not available</td>
                            <td colspan="2"></td>
                        </tr><tr id="email">
                            <td>Email: </td>
                            <td id="email">Not available</td>
                            <td colspan="2"></td>
                        </tr><tr id="mobileNo">
                            <td>Mobile No: </td>
                            <td id="mobileNo">Not available</td>
                            <td colspan="2"></td>
                        </tr>
                        <tr id="registeredDate">
                            <td>Registered Date: </td>
                            <td id="registeredDate">Not available</td>
                            <td colspan="2"></td>
                        </tr>
                        <tr id="registeredTime">
                            <td>Registered Time: </td>
                            <td id="registeredTime">Not available</td>
                            <td colspan="2"></td>
                        </tr>
                       
                        <button style="position: relative; padding: 10px 15px;" class="back-btn"><i class="fa fa-times" onclick="closeResofficerView()"></i></button>
                    </table>
                </div>
                <table class="blue">
                    <thead>
                            <tr>    
                                <th>User ID</th>
                                <th>Officer ID</th>
                                <th>Employee ID</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>E-mail</th>
                                <th>Mobile-No</th>
                                <th>Registered-Date</th>
                                <th>Registered-Time</th>
                                <th>Manage</th>    
                            </tr>
                    </thead>
                    <script>
                        var c=0;
                        var alerts=[];
                    </script>
                    <?php $count=0?>
                    <!-- <?php var_dump($data);?> -->
                    <?php foreach ($data['resofficers'] as $row):?>
                        <tr>
                            <td data-th="User ID"><?php echo $row->userid;?></td>
                            <td data-th="Modertor ID"><?php echo $row->officerId;?></td>
                            <td data-th="Employee ID"><?php echo $row->employeeId;?></td>
                            <td data-th="First Name"><?php echo $row->firstname;?></td>
                            <td data-th="Last Name"><?php echo $row->lastname;?></td>
                            <td data-th="Email"><?php echo $row->email;?></td>
                            <td data-th="Mobile No"><?php echo $row->mobileno;?></td>
                            <td data-th="Registered Date"><?php echo $row->reg_date;?></td>
                            <td data-th="Registered Time"><?php echo $row->reg_time;?></td>    
                            <script> 
                                alerts[c]=<?php echo json_encode($row, JSON_PRETTY_PRINT)?>;

                            </script>
                            <td data-th="Manage">
                                <form action="<?php echo URLROOT;?>/resofficers/deleteUser/<?php echo $row->userid;?>" method="POST">
                                <button type="button" class="table-btn blue" onclick="openResofficerView(alerts,<?php echo $count;?>)">View</button>
                                <a href="<?php echo URLROOT;?>/resofficers/updateResofficer/<?php echo $row->userid;?>" class="blue-btn">Edit</a>
                                <input type="submit" class="red-btn" value="Delete">
                                </form>
                            </td>
                        </tr>
                        <script>
                            c++;
                        </script>
                        <?php $count++;?>    
                    <?php endforeach;?>    
                </table>
                <script>
                    function openResofficerView(alerts,x) {
                        var table=document.getElementById("cancelpopup");
                        table.rows.namedItem("userId").cells.namedItem("userId").innerHTML=alerts[x].userid;
                        table.rows.namedItem("officerId").cells.namedItem("officerId").innerHTML=alerts[x].officerId;
                        table.rows.namedItem("employeeId").cells.namedItem("employeeId").innerHTML=alerts[x].employeeId;
                        table.rows.namedItem("firstName").cells.namedItem("firstName").innerHTML=alerts[x].firstname;
                        table.rows.namedItem("lastName").cells.namedItem("lastName").innerHTML=alerts[x].lastname;
                        table.rows.namedItem("email").cells.namedItem("email").innerHTML=alerts[x].email;
                        table.rows.namedItem("mobileNo").cells.namedItem("mobileNo").innerHTML=alerts[x].mobileno;
                        table.rows.namedItem("registeredDate").cells.namedItem("registeredDate").innerHTML=alerts[x].reg_date;
                        table.rows.namedItem("registeredTime").cells.namedItem("registeredTime").innerHTML=alerts[x].reg_time;
                        document.getElementById("popup-alert").style.display = "block";
                    }
    
                    function closeResofficerView() {
                        document.getElementById("popup-alert").style.display = "none";
                    }
                </script>                     
            </div>
        </div>
    </div>
        

<?php
    require APPROOT.'/views/includes/footer.php';
?>