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
                    <li><a href="<?php echo URLROOT; ?>/employees/add_employee">Add New Employees</a></li>
                </ul>
            </div>


            <div class="content-flexrow">
                <div class="container">
                <div class="form-row">

                    <div class="text">Add New Employee Details</div>


                    <form action="#">
                        <div class="form-row">

                            <div class="input-data">
                                <label for="employeeid">Employee Id</label>
                                <input type="text" name="employeeid" id="employeeid" placeholder="Enter Employee ID.." required >
                            </div>
                        </div>
                        <div class="form-row">

                            <div class="input-data">
                                <label for="id">Id</label>
                                <input type="text" name="id" id="id" placeholder="Enter Admin/ Moderator/Res.Officer ID.." required >
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="input-data ">
                                 <label for="delaycause">Password</label>
                                 <input type="text" name="trainid" id="trainid" placeholder="Enter Employee Password.." required >   
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="input-data ">
                                 <label for="delaycause">First Name</label>
                                 <input type="text" name="trainid" id="trainid" placeholder="Enter Employee First Name.." required > 
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="input-data ">
                                 <label for="delaycause">Last Name</label>
                                 <input type="text" name="trainid" id="trainid" placeholder="Enter Employee Last Name.." required > 
                           </div>
                        </div>
                        <div class="form-row">
                            <div class="input-data ">
                                 <label for="delaycause">Email Address</label>
                                 <input type="text" name="trainid" id="trainid" placeholder="Enter Employee Email Address.." required >
                           </div>
                        </div>
                        <div class="form-row">
                            <div class="input-data ">
                                 <label for="delaycause">Mobile Number </label>
                                 <input type="text" name="trainid" id="trainid" placeholder="Enter Employee Mobile Number.." required >
                           </div>
                        </div>


                        <div class="form-row submit-btn">
                            <div class="input-data">
                                <input type="submit" class="blue-btn" value="Save">
                            </div>    
                            
                            <div class="input-data">
                                <input onclick="history.go(-1);" type="submit" class="red-btn" value="Back">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>





<?php
    require APPROOT . '/views/includes/footer.php';

?>


