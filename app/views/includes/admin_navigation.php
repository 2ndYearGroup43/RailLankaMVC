
    <header>
        <nav>
            <div class="nav-container">
                <input type="checkbox" name="" id="check">
                <div class="logo-container">
                    <a href="index.html">
                        <img src="<?php echo URLROOT;?>/public/img/logo.jpg" height="80px">
                        <!--<img src="img/logo.jpg" alt="logo" height="80px">-->
                    </a>
                </div>
                <div class="nav-btn">
                    <div class="nav-links">
                        <ul>

                        <li class="nav-link" style="--i: .6s">
                            <a href="" >HOME</a>
                        </li>
                        <li class="nav-link" style="--i: .6s">
                            <a href="<?php echo URLROOT; ?>admins/admindashboards/dashboards">Dashboard</a>
                        </li>
                        <li class="nav-link" style="--i: .6s">
                            <a href="<?php echo URLROOT; ?>/adminPassengers/index">Users</a>
                        </li>
                        <li class="nav-link" style="--i: .85s">
                                <label for="btn-1" class="show">Employees <i class="fa fa-caret-down"></i></label></label>
                                <a href="#">Employees <i class="fa fa-caret-down"></i></a>
                                <input type="checkbox" id="btn-1">
                                <div class="dropdown">
                                    <ul>
                                        <li class="dropdown-link">
                                            <label for="btn-2" class="show2">Add New Employees +</label>
                                            <a href="#">Add New Employees<i class="fa fa-caret-down"></i></a>
                                            <input type="checkbox" id="btn-2">
                                            <div class="dropdown second">
                                                <ul>
                                                    <li class="dropdown-link">
                                                        <a href="<?php echo URLROOT; ?>/admins/registerAdmin">Admins</a>
                                                    </li>
                                                    <li class="dropdown-link">
                                                        <a href="">Res. officers</a>
                                                    </li>
                                                    <li class="dropdown-link">
                                                        <a href="#">Moderators</a>
                                                    </li>
                                                    <li class="dropdown-link">
                                                        <a href="#">Drivers</a>
                                                    </li>
                                                    <div class="arrow"></div>
                                                </ul>
                                            </div>
                                        </li>
                                        <li class="dropdown-link">
                                            <label for="btn-3" class="show2">Manage Employees +</label>
                                            <a href="#">Manage Employees<i class="fa fa-caret-down"></i></a>
                                            <input type="checkbox" id="btn-3">
                                            <div class="dropdown second">
                                                <ul>
                                                    <li class="dropdown-link">
                                                        <a href="<?php echo URLROOT; ?>/admins/viewAdmins">Admins</a>
                                                    </li>
                                                    <li class="dropdown-link">
                                                        <a href="#">Res. officers</a>
                                                    </li>
                                                    <li class="dropdown-link">
                                                        <a href="#">Moderators</a>
                                                    </li>
                                                    <li class="dropdown-link">
                                                        <a href="#">Drivers</a>
                                                    </li>
                                                    <div class="arrow"></div>
                                                </ul>
                                            </div>
                                        </li>
                                        <div class="arrow"></div>
                                    </ul>
                                </div>
                        </li>
                        
                        <li class="nav-link" style="--i: .6s">
                            <a href="#">Trains</a>
                        </li>

                        <li class="nav-link" style="--i: 1.1s">
                                <label for="btn-4" class="show">Stations <i class="fa fa-caret-down"></i></label></label>
                                <a href="#">Stations <i class="fa fa-caret-down"></i></a>
                                <input type="checkbox" id="btn-4">
                                <div class="dropdown">
                                    <ul>
                                        <li class="dropdown-link">
                                            <a href="<?php echo URLROOT; ?>/adminStations/add_station">Add New Station</a>
                                        </li>
                                        <li class="dropdown-link">
                                            <a href="<?php echo URLROOT; ?>/adminStations/manage_station">Manage Station</a>
                                        </li>
                                        <div class="arrow"></div>
                                    </ul>
                                </div>
                        </li>

                        
                        <li class="nav-link" style="--i: 1.1s">
                                <label for="btn-4" class="show">Notices <i class="fa fa-caret-down"></i></label></label>
                                <a href="#">Notices <i class="fa fa-caret-down"></i></a>
                                <input type="checkbox" id="btn-4">
                                <div class="dropdown">
                                    <ul>
                                        <li class="dropdown-link">
                                            <a href="<?php echo URLROOT; ?>/adminNotices/addNotice">Add New Notice</a>
                                        </li>
                                        <li class="dropdown-link">
                                            <a href="<?php echo URLROOT; ?>/adminNotices/index">Manage Notices</a>
                                        </li>
                                        <div class="arrow"></div>
                                    </ul>
                                </div>
                        </li>
                        <li class="nav-link" style="--i: .85s">
                                <label for="btn-1" class="show">Reports <i class="fa fa-caret-down"></i></label></label>
                                <a href="#">Reports <i class="fa fa-caret-down"></i></a>
                                <input type="checkbox" id="btn-1">
                                <div class="dropdown">
                                    <ul>
                                        <li class="dropdown-link">
                                            <label for="btn-2" class="show2">Create Reports +</label>
                                            <a href="#">Create Reports<i class="fa fa-caret-down"></i></a>
                                            <input type="checkbox" id="btn-2">
                                            <div class="dropdown second">
                                                <ul>
                                                    <li class="dropdown-link">
                                                        <a href="<?php echo URLROOT; ?>/adminReports/index">Revenue Reports</a>
                                                    </li>
                                                    <li class="dropdown-link">
                                                        <a href="<?php echo URLROOT; ?>/adminReports/addAlertDetails">Alert Reports </a>
                                                    </li>
                                                    <li class="dropdown-link">
                                                        <a href="<?php echo URLROOT; ?>/adminReports/addRefundDetails">Refund Reports</a>
                                                    </li>
                                                    <div class="arrow"></div>
                                                </ul>
                                            </div>
                                        </li>
                                        <li class="dropdown-link">
                                            <label for="btn-3" class="show2">Manage Reports +</label>
                                            <a href="#">Manage Reports<i class="fa fa-caret-down"></i></a>
                                            <input type="checkbox" id="btn-3">
                                            <div class="dropdown second">
                                                <ul>
                                                    <li class="dropdown-link">
                                                        <a href="<?php echo URLROOT; ?>/adminReports/manageRevenueReports">Revenue Reports</a>
                                                    </li>
                                                    <li class="dropdown-link">
                                                        <a href="<?php echo URLROOT; ?>/adminReports/manageAlertReports">Alert Reports </a>
                                                    </li>
                                                    <li class="dropdown-link">
                                                        <a href="<?php echo URLROOT; ?>/adminReports/manageRefundReports">Refund Reports</a>
                                                    </li>
                                                    <div class="arrow"></div>
                                                </ul>
                                            </div>
                                        </li>
                                        <div class="arrow"></div>
                                    </ul>
                                </div>
                        </li>
                        
                            <li class="nav-link" style="--i: 2.05s">
                                <label for="btn-6" class="show">Account <i class="fa fa-caret-down"></i></label></label>
                                <a href="<?php echo URLROOT; ?>/adminAccounts/index">Account <i class="fa fa-caret-down"></i></a>
                                <input type="checkbox" id="btn-6">
                                <div class="dropdown">
                                    <ul>
                                        <li class="dropdown-link">
                                            <a href="#">Logout</a>
                                        </li>
                                        <div class="arrow"></div>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="hamburger-menu-container">
                    <div class="hamburger-menu">
                        <div></div>
                    </div>
                </div>

            </div>
        </nav>
    </header>