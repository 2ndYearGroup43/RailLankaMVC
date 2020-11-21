
        <header>
            <nav>
                <div class="logo"><a href="index.html"><img src="<?php echo URLROOT;?>/public/img/logo.jpg"  alt="logo" height="85px"></a></div>
                <label for="btn" class="icon">
                <span class="fa fa-bars" aria-hidden="true"></span>
                </label>
                <input type="checkbox" id="btn">
                <ul class="main-nav">
                    <li><a href="#">Home</a></li>

                    <li><a href="<?php echo URLROOT; ?>/admindashboards">Dashboard</a></li>

                    <li><a href="<?php echo URLROOT; ?>/adminPassengers/index">USERS</a></li>

                    <!--<li>
                        <label for="btn-4" class="show">EMPLOYEE MANAGEMENT +</label>
                        <a href="#">Employee management <span class="fa fa-caret-down"  aria-hidden="true"></span></a>
                        <input type="checkbox" id="btn-4">
                        <ul>
                            <li><a href="<?php echo URLROOT; ?>/employees/add_employee">Add New Employee</a></li>
                            <li><a href="<?php echo URLROOT; ?>/employees">Manage Employee</a></li>
                        </ul>
                    </li>-->

                    <li>
                        <label for="btn-4" class="show">EMPLOYEES +</label>
                        <a href="#">Employees
                            <span class="fa fa-caret-down"  aria-hidden="true"></span>
                        </a>
                        <input type="checkbox" id="btn-4">
                        <ul>
                            <li>
                                <label for="btn-2" class="show2">Add New EMPLOYEE  +</label>
                                <a href="#">Add New Employee  <span class="fa fa-caret-right"></span></a>
                                <input type="checkbox" id="btn-2">
                                <ul>
                                    <li><a href="<?php echo URLROOT; ?>/admins/registerAdmin">Admin </a></li>
                                    <li><a href="<?php echo URLROOT; ?>/admins/add_alert_details">Res. Officer</a></li>
                                    <li><a href="<?php echo URLROOT; ?>/admins/add_refund_details">Moderator</a></li>
                                    <li><a href="<?php echo URLROOT; ?>/admins/add_refund_details">Driver</a></li>
                                </ul>
                            </li>
                            <li>
                                <label for="btn-3" class="show2">EMPLOYEE MANAGE +</label>
                                <a href="#">Employee Manage<span class="fa fa-caret-right"></span></a>
                                <input type="checkbox" id="btn-3">
                                <ul>
                                    <li><a href="<?php echo URLROOT; ?>/admins/viewAdmins">Admin</a></li>
                                    <li><a href="<?php echo URLROOT; ?>/admins/add_alert_details">Res. Officer</a></li>
                                    <li><a href="<?php echo URLROOT; ?>/admins/add_refund_details">Moderator</a></li>
                                    <li><a href="<?php echo URLROOT; ?>/admins/add_refund_details">Driver</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li> 


                    <li><a href="#">TRAINS</a></li>

                    <li>
                        <label for="btn-5" class="show">STATIONS +</label>
                        <a href="#" >Stations <span class="fa fa-caret-down"  aria-hidden="true"></span></a>
                        <input type="checkbox" id="btn-5">
                        <ul>
                            <li><a href="<?php echo URLROOT; ?>/adminStations/add_station">Add New Station</a></li>
                            <li><a href="<?php echo URLROOT; ?>/adminStations/manage_station">Manage Station</a></li>
                        </ul>
                    </li> 

                    <li>
                        <label for="btn-6" class="show">NOTICE +</label>
                        <a href="#">Notice <span class="fa fa-caret-down"  aria-hidden="true"></span></a>
                        <input type="checkbox" id="btn-6">
                        <ul>
                            <li><a href="<?php echo URLROOT; ?>/adminNotices/addNotice">Add New Notices</a></li>
                            <li><a href="<?php echo URLROOT; ?>/adminNotices/index">Manage Notices</a></li>
                        </ul>
                    </li>  

                    <li>
                        <label for="btn-1" class="show">REPORT +</label>
                        <a href="#">Reports
                            <span class="fa fa-caret-down"  aria-hidden="true"></span>
                        </a>
                        <input type="checkbox" id="btn-1">
                        <ul>
                            <li>
                                <label for="btn-2" class="show2">CREATE REPORTS +</label>
                                <a href="#">Create reports <span class="fa fa-caret-right"></span></a>
                                <input type="checkbox" id="btn-2">
                                <ul>
                                    <li><a href="<?php echo URLROOT; ?>/adminReports/index">Revenue Reports</a></li>
                                    <li><a href="<?php echo URLROOT; ?>/adminReports/addAlertDetails">Alert Report</a></li>
                                    <li><a href="<?php echo URLROOT; ?>/adminReports/addRefundDetails">Refund Report</a></li>
                                </ul>
                            </li>
                            <li>
                                <label for="btn-3" class="show2">REPORTS MANAGE +</label>
                                <a href="#">Reports Manage<span class="fa fa-caret-right"></span></a>
                                <input type="checkbox" id="btn-3">
                                <ul>
                                    <li><a href="<?php echo URLROOT; ?>/adminReports/manageRevenueReports">Revenue Reports</a></li>
                                    <li><a href="<?php echo URLROOT; ?>/adminReports/manageAlertReports">Alert Report</a></li>
                                    <li><a href="<?php echo URLROOT; ?>/adminReports/manageRefundReports">Refund Report</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li> 

                    <li>
                        <label for="btn-6" class="show">ACCOUNT +</label>
                        <a href="<?php echo URLROOT; ?>/adminAccounts/index"> <span class="fa fa-user" aria-hidden="true"></span> Account <span class="fa fa-caret-down" aria-hidden="true"></span></a>
                        <input type="checkbox" id="btn-6">
                        <ul>
                            <li><a href="#">Logout <span class="fa fa-sign-out" aria-hidden="true"></span></a></li>
                       </ul>
                    </li>
                    
                </ul>

                
              
            </nav>
        </header>
