
        <header>
            <nav>
                <div class="logo"><a href="index.html"><img src="<?php echo URLROOT;?>/public/img/logo.jpg"  alt="logo" height="85px"></a></div>
                <label for="btn" class="icon">
                <span class="fa fa-bars" aria-hidden="true"></span>
                </label>
                <input type="checkbox" id="btn">
                <ul class="main-nav">
                    <li><a href="#">Home</a></li>

                    <li><a href="<?php echo URLROOT; ?>/passengers">USER MANAGEMENT</a></li>

                    <li>
                        <label for="btn-4" class="show">EMPLOYEE MANAGEMENT +</label>
                        <a href="#">Employee management <span class="fa fa-caret-down"  aria-hidden="true"></span></a>
                        <input type="checkbox" id="btn-4">
                        <ul>
                            <li><a href="<?php echo URLROOT; ?>/employees/add_employee">Add New Employee</a></li>
                            <li><a href="<?php echo URLROOT; ?>/employees">Manage Employee</a></li>
                        </ul>
                    </li>

                    <li><a href="#">TRAIN MANAGEMENT</a></li>

                    <li>
                        <label for="btn-5" class="show">STATION MANAGEMENT +</label>
                        <a href="#" >Station management <span class="fa fa-caret-down"  aria-hidden="true"></span></a>
                        <input type="checkbox" id="btn-5">
                        <ul>
                            <li><a href="<?php echo URLROOT; ?>/stations/add_station">Add New Station</a></li>
                            <li><a href="<?php echo URLROOT; ?>/stations/manage_station">Manage Station</a></li>
                        </ul>
                    </li> 

                    <li>
                        <label for="btn-6" class="show">NOTICE +</label>
                        <a href="#">Notice <span class="fa fa-caret-down"  aria-hidden="true"></span></a>
                        <input type="checkbox" id="btn-6">
                        <ul>
                            <li><a href="<?php echo URLROOT; ?>/notices/add_notice">Add New Notices</a></li>
                            <li><a href="<?php echo URLROOT; ?>/notices">Manage Notices</a></li>
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
                                    <li><a href="<?php echo URLROOT; ?>/reports">Revenue Reports</a></li>
                                    <li><a href="<?php echo URLROOT; ?>/reports/add_alert_details">Alert Report</a></li>
                                    <li><a href="<?php echo URLROOT; ?>/reports/add_refund_details">Refund Report</a></li>
                                </ul>
                            </li>
                            <li>
                                <label for="btn-3" class="show2">REPORTS MANAGE +</label>
                                <a href="#">Reports Manage<span class="fa fa-caret-right"></span></a>
                                <input type="checkbox" id="btn-3">
                                <ul>
                                    <li><a href="<?php echo URLROOT; ?>/reports/manage_revenue_reports">Revenue Reports</a></li>
                                    <li><a href="<?php echo URLROOT; ?>/reports/manage_alert_reports">Alert Report</a></li>
                                    <li><a href="<?php echo URLROOT; ?>/reports/manage_refund_reports">Refund Report</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li> 

                    <li>
                        <label for="btn-6" class="show">ACCOUNT +</label>
                        <a href="account.html" > <span class="fa fa-user" aria-hidden="true"></span> Account <span class="fa fa-caret-down" aria-hidden="true"></span></a>
                        <input type="checkbox" id="btn-6">
                        <ul>
                            <li><a href="#">Logout <span class="fa fa-sign-out" aria-hidden="true"></span></a></li>
                       </ul>
                    </li>
                    
                </ul>
              
            </nav>
        </header>
