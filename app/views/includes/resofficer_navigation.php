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
                                    <a href="<?php echo URLROOT; ?>/resofficers/index">Home</a>
                                </li>
                                <li class="nav-link" style="--i: .6s"> 
                                    <a href="<?php echo URLROOT; ?>/ResOfficerReservations/search">Reservation</a>
                                </li>
                                <li class="nav-link" style="--i: .6s"> 
                                    <a href="<?php echo URLROOT; ?>/ResOfficerRefunds/refund">Refund<i class="fa fa-caret-down"></i></a>
                                    <div class="dropdown">
                                        <ul>
                                            <li class="dropdown-link">
                                                <a href="<?php echo URLROOT; ?>/ResOfficerRefunds/refund">Refund</a>
                                            </li>
                                            <div class="arrow"></div>
                                        </ul>
                                        <ul>
                                            <li class="dropdown-link">
                                                <a href="<?php echo URLROOT; ?>/ResOfficerRefundDetails/views">Refund Details</a>
                                            </li>
                                            <div class="arrow"></div>
                                        </ul>
                                    </div>
                                </li>
                                <li class="nav-link" style="--i: .6s"> 
                                    <a href="<?php echo URLROOT; ?>/ResOfficerReservationDetails/search">Reservation Details</a>
                                </li>
                                <li class="nav-link" style="--i: 1.1s">
                                    <a href="<?php echo URLROOT; ?>/ResOfficerTicketDetails/search">Ticket Details</a>
                                </li>
                                <li class="nav-link" style="--i: .6s"> 
                                    <a href="<?php echo URLROOT; ?>/ResOfficerManageSeats/search">Manage Seats</a>
                                </li>
                                <li class="nav-link" style="--i: 2.05s">
                                    <label for="btn-6" class="show">Account <i class="fa fa-caret-down"></i></label></label>
                                    <a href="<?php echo URLROOT; ?>/resofficers/resofficerAccount">Account <span class="fa fa-user"></span><i class="fa fa-caret-down"></i></a>
                                    <input type="checkbox" id="btn-6">
                                    <div class="dropdown">
                                        <ul>
                                            <li class="dropdown-link">
                                                <a href="<?php echo URLROOT; ?>/resofficers/resofficerAccount">Account<span class="fa fa-user"></span></a>
                                            </li>
                                            <li class="dropdown-link">
                                                <a href="<?php echo URLROOT;?>/resofficers/logout">Logout<span class="fa fa-sign-out"></span></a>
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