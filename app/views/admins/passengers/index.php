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
                    <li><u>User Management</u></li>
                    <li><a href="<?php echo URLROOT; ?>/adminPassengers/index">Manage Passengers</a></li>
                </ul>
            </div>

            

            <div class="content-row">
                <div class="container-table">
                    <h2>User Management </h2>

                
                <div class="table-searchbar">
                    <form action="<?php echo URLROOT?>/adminPassengers/passengersSearchBy" method="POST">
                        <input type="text" placeholder="Search by" name=searchbar><span><select name="searchselect" id="searchselect">
                            <?php foreach ($data['fields'] as $field ):?>
                                    <option value="<?php echo $field->columns?>"><?php echo $field->columns?></option>
                            <?php endforeach;?>
                        </select></span><span><input type="submit" value=" " class="search-btn"></span><span><i class="fa fa-search glyph"></i></span>
                    </form>
                </div>




                    <div class="container-table popup" id="popup-alert">
                    <h3>User Management</h3>
                    <table class="data-display" id="cancelpopup">
                        <tr id="userId">
                            <td>User Id: </td>
                            <td id="userId">Not available</td>
                            <td colspan="2"></td>
                        </tr>
                        <tr id="nic">
                            <td>NIC: </td>
                            <td id="nic">Not available</td>
                            <td colspan="2"></td>
                        </tr>
                        </tr><tr id="firstName">
                            <td>First Name: </td>
                            <td id="firstName">Not available</td>
                            <td colspan="2"></td>
                        </tr>
                        <tr id="lastName">
                            <td>Last Name: </td>
                            <td id="lastName">Not available</td>
                            <td colspan="2"></td>
                        </tr>
                        <tr id="email">
                            <td>Email: </td>
                            <td id="email">Not available</td>
                            <td colspan="2"></td>
                        </tr>
                        <tr id="mobileno">
                            <td>Mobile No: </td>
                            <td id="mobileno">Not available</td>
                            <td colspan="2"></td>
                        </tr>
                        <tr id="city">
                            <td>City: </td>
                            <td id="city">Not available</td>
                            <td colspan="2"></td>
                        </tr>
                        <tr id="country">
                            <td>Country: </td>
                            <td id="country">Not available</td>
                            <td colspan="2"></td>
                        </tr>
                        <tr id="address_number">
                            <td>Address Number: </td>
                            <td id="address_number">Not available</td>
                            <td colspan="2"></td>
                        </tr>
                        <tr id="street">
                            <td>Street: </td>
                            <td id="street">Not available</td>
                            <td colspan="2"></td>
                        </tr>
                        <tr id="city">
                            <td>City: </td>
                            <td id="city">Not available</td>
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
                       
                        <button style="position: relative; padding: 10px 15px;" class="back-btn"><i class="fa fa-times" onclick="closePassengerView()"></i></button>
                    </table>
                </div>
                <table class="blue">
                    <thead>
                            <tr>    
                                 <th>NIC</th>
                                <th>First name</th>
                                <th>Last name</th>
                                <th>Email Address</th>
                                <th>Mobile Number</th>
                                <!--<th>Address_No</th>
                                <th>Street</th>-->
                                <th>City</th>
                                <th>Country</th>
                                <th>Register Date</th>
                                <!--<th>Register Time</th>-->
                                <th>Manage</th>        
                            </tr>
                    </thead>
                    <script>
                        var c=0;
                        var alerts=[];
                    </script>
                    <?php $count=0?>
                    <!-- <?php var_dump($data);?> -->
                    <?php foreach ($data['passengers'] as $row):?>
                        <tr>
                            <td data-th="NIC"><?php echo $row->nic;?></td>
                        <!--<td data-th="userid"><?php echo $row->name;?></td>-->
                        <td data-th="First Name"><?php echo $row->firstname;?></td>
                        <td data-th="Last Name"><?php echo $row->lastname;?></td>
                        <td data-th="Email"><?php echo $row->email;?></td>
                        <td data-th="Mobile No"><?php echo $row->mobileno;?></td>
                        <!--<td data-th="address_number"><?php echo $row->address_number;?></td>
                        <td data-th="street"><?php echo $row->street;?></td>-->
                        <td data-th="City"><?php echo $row->city;?></td>
                        <td data-th="Country"><?php echo $row->country;?></td>
                        <td data-th="Register Date"><?php echo $row->reg_date;?></td>
                        <!--<td data-th="ragister Time"><?php echo $row->rag_time;?></td>-->
                           
                            <script> 
                                alerts[c]=<?php echo json_encode($row, JSON_PRETTY_PRINT)?>;

                            </script>
                            <td data-th="Manage">
                                
                                
                                <button type="button" class="table-btn blue" onclick="openPassengerView(alerts,<?php echo $count;?>)">View</button>
                            <form action="<?php echo URLROOT;?>/adminPassengers/delete/<?php echo $row->userid;?>" method="POST">
                            <input type="submit" class="red-btn" value="Delete"></form>
                                
                            </td>
                        </tr>
                        <script>
                            c++;
                        </script>
                        <?php $count++;?>    
                    <?php endforeach;?>    
                </table>
                <script>
                    function openPassengerView(alerts,x) {
                        var table=document.getElementById("cancelpopup");
                        table.rows.namedItem("userId").cells.namedItem("userId").innerHTML=alerts[x].userid;
                        table.rows.namedItem("nic").cells.namedItem("nic").innerHTML=alerts[x].nic;
                        table.rows.namedItem("firstName").cells.namedItem("firstName").innerHTML=alerts[x].firstname;
                        table.rows.namedItem("lastName").cells.namedItem("lastName").innerHTML=alerts[x].lastname;
                        table.rows.namedItem("email").cells.namedItem("email").innerHTML=alerts[x].email;
                        table.rows.namedItem("mobileno").cells.namedItem("mobileno").innerHTML=alerts[x].mobileno;

                        table.rows.namedItem("address_number").cells.namedItem("address_number").innerHTML=alerts[x].address_number;

                        table.rows.namedItem("street").cells.namedItem("street").innerHTML=alerts[x].street;
                        table.rows.namedItem("city").cells.namedItem("city").innerHTML=alerts[x].city;
                        table.rows.namedItem("registeredDate").cells.namedItem("registeredDate").innerHTML=alerts[x].reg_date;
                        table.rows.namedItem("registeredTime").cells.namedItem("registeredTime").innerHTML=alerts[x].reg_time;
                        document.getElementById("popup-alert").style.display = "block";
                    }
    
                    function closePassengerView() {
                        document.getElementById("popup-alert").style.display = "none";
                    }
                </script>                  
                </div>


</div>
            </div>




<?php
    require APPROOT . '/views/includes/footer.php';

?>



