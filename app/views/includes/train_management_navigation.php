<header>
                <div class="nav-container">
                    <input type="checkbox" name="" id="check">
                    <div class="logo-container">
                        <a href="<?php echo URLROOT;?>/admins/">
                            <img src="<?php echo URLROOT;?>/public/img/logo.jpg" alt="logo" height="80px">
                        </a>
                    </div>
                    <div class="nav-btn">
                        <div class="nav-links">
                            <ul>
                                <li class="nav-link" style="--i: .6s"> 
                                    <a href="<?php echo URLROOT;?>/admins/">Home</a>
                                </li>
                                <li class="nav-link" style="--i: .6s"> 
                                    <a href="<?php echo URLROOT;?>/admins/">Users</a>
                                </li>
                                <li class="nav-link" style="--i: .6s"> 
                                    <a href="<?php echo URLROOT; ?>/Resofficers/viewResofficers">Employees</a>
                                </li>
                                <li class="nav-link" style="--i: 1.1s">
                                    <label for="btn-4" class="show">Trains <i class="fa fa-caret-down"></i></label></label>
                                    <a href="<?php echo URLROOT; ?>/Admin_manage_trains/index">Trains <i class="fa fa-caret-down"></i></a>
                                    <input type="checkbox" id="btn-4">
                                    <div class="dropdown">
                                        <ul>
                                            <li class="dropdown-link">
                                                <a href="<?php echo URLROOT; ?>/Admin_manage_fares/index">Manage Fare</a>
                                            </li>
                                            <li class="dropdown-link">
                                                <a href="<?php echo URLROOT; ?>/Admin_manage_compartment_types/index">Compartment Type</a>
                                            </li>
                                            <div class="arrow"></div>
                                        </ul>
                                    </div>
                                </li>
                                <li class="nav-link" style="--i: .6s"> 
                                    <a href="#">Stations</a>
                                </li>
                                <li class="nav-link" style="--i: .6s"> 
                                    <a href="#">Reports</a>
                                </li>
                                <li class="nav-link" style="--i: 2.05s">
                                    <label for="btn-6" class="show">Account <i class="fa fa-caret-down"></i></label></label>
                                    <a href="<?php echo URLROOT;?>/admins/adminAccount">Account  <span class="fa fa-user"></span><i class="fa fa-caret-down"></i></a>
                                    <input type="checkbox" id="btn-6">
                                    <div class="dropdown">
                                        <ul>
                                            <li class="dropdown-link">
                                                <a href="<?php echo URLROOT;?>/admins/adminAccount">Account<span class="fa fa-user"></span></a>
                                            </li>
                                            <li class="dropdown-link">
                                                <a href="<?php echo URLROOT;?>/admins/logout">Logout<span class="fa fa-sign-out"></span></a>
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
        </header>