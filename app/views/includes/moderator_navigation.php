    <!-- <header>
        <nav class="h">
            <div class="logo"><a href="<?php echo URLROOT;?>/moderators/"><img src="<?php echo URLROOT;?>/public/img/logonav1.jpg" alt="logo" height="85px"></a></div>
            <label for="btn" class="icon">
                <span class="fa fa-bars" aria-hidden="true"></span>
            </label>
            <input type="checkbox" id="btn">
            <ul class="main-nav">
                <li><a href="<?php echo URLROOT;?>/moderators/">Home</a></li>
                <li>
                    <label for="btn-1" class="show">ALERTS +</label>
                    <a href="<?php echo URLROOT;?>/moderatoralerts/viewCancelledAlerts">Alerts
                        <span class="fa fa-caret-down"  aria-hidden="true"></span>
                    </a>
                    <input type="checkbox" id="btn-1">
                    <ul>
                        <li>
                            <label for="btn-2" class="show2">ADD NEW ALERTS +</label>
                            <a href="#">Add New Alerts <span class="fa fa-caret-right"></span></a>
                            <input type="checkbox" id="btn-2">
                            <ul>
                                <li><a href="<?php echo URLROOT;?>/moderatoralerts/createCancellationAlerts">Cancellations</a></li>
                                <li><a href="<?php echo URLROOT;?>/moderatoralerts/createDelayAlerts">Delays</a></li>
                                <li><a href="<?php echo URLROOT;?>/moderatoralerts/createRescheduledAlerts">Reschedulements</a></li>
                            </ul>
                        </li>
                        <li>
                            <label for="btn-3" class="show2">ALERT MANAGEMENT +</label>
                            <a href="#">Alert Management<span class="fa fa-caret-right"></span></a>
                            <input type="checkbox" id="btn-3">
                            <ul>
                                <li><a href="<?php echo URLROOT;?>/moderatoralerts/viewCancelledAlerts">Cancellations</a></li>
                                <li><a href="<?php echo URLROOT;?>/moderatoralerts/viewDelayedAlerts">Delays</a></li>
                                <li><a href="<?php echo URLROOT;?>/moderatoralerts/viewRescheduledAlerts">Reschedulements</a></li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <li>
                    <label for="btn-4" class="show">JOURNEY +</label>
                    <a href="<?php echo URLROOT;?>/ModeratorJourneys/index">Journey <span class="fa fa-caret-down"  aria-hidden="true"></span></a>
                    <input type="checkbox" id="btn-4">
                    <ul>
                        <li><a href="<?php echo URLROOT;?>/ModeratorJourneys/createJourneyAssignment">Driver Assignment</a></li>
                        <li><a href="<?php echo URLROOT;?>/ModeratorJourneys/index">Manage Journey</a></li>
                    </ul>
                </li>
                <li>
                    <label for="btn-5" class="show">TRACKING +</label>
                    <a href="Moderator-searchtracktrains.html">Tracking <span class="fa fa-caret-down" aria-hidden="true"></span> </a>
                    <input type="checkbox" id="btn-5">
                    <ul>
                        <li><a href="Moderator-searchtracktrains.html">Track Trains</a></li>
                        <li><a href="Moderator-viewtrainsmap.html">View Live Map</a></li>
                    </ul>
                </li>
                <li><a href="Moderator-searchescheduletrains.html">Schedule</a></li>
                
                <li>
                    <?php   if(isLoggedIn()):?>
                            <label for="btn-6" class="show">ACCOUNT +</label>
                            <a href="Moderator-account.html"><span class="fa fa-user" aria-hidden="true"></span> Account <span class="fa fa-caret-down" aria-hidden="true"></span></a>
                            <input type="checkbox" id="btn-6">
                            <ul>
                                <li><a href="<?php echo URLROOT;?>/moderators/logout">Logout <span class="fa fa-sign-out" aria-hidden="true"></span></a></li>
                            </ul>
                    <?php else:?>
                        <a href="<?php echo URLROOT;?>/users/login">Login</a>
                    <?php endif; ?>
                </li>
            </ul> -->
            <!-- <label id="icon">
                <i class="fa fa-bars" aria-hidden="true"></i>
            </label>     -->
        <!-- </nav>
    </header> -->
        <header>
                <div class="nav-container">
                    <input type="checkbox" name="" id="check">
                    <div class="logo-container">
                        <a href="<?php echo URLROOT;?>/moderators/">
                            <img src="<?php echo URLROOT;?>/public/img/logo.jpg" alt="logo" height="80px">
                        </a>
                    </div>
                    <div class="nav-btn">
                        <div class="nav-links">
                            <ul>
                                <li class="nav-link" style="--i: .6s"> 
                                    <a href="<?php echo URLROOT;?>/moderators/">Home</a>
                                </li>
                                <li class="nav-link" style="--i: .85s">
                                    <label for="btn-1" class="show">Alerts <i class="fa fa-caret-down"></i></label></label>
                                    <a href="<?php echo URLROOT;?>/moderatoralerts/viewCancelledAlerts">Alerts <i class="fa fa-caret-down"></i></a>
                                    <input type="checkbox" id="btn-1">
                                    <div class="dropdown">
                                        <ul>
                                            <li class="dropdown-link">
                                                <a href="<?php echo URLROOT;?>/moderatoralerts/alertsdash">Alerts Dashboard<i class="fa fa-line-chart"></i></a>  
                                            </li>
                                            <li class="dropdown-link">
                                                <label for="btn-2" class="show2">Add New Alerts +</label>
                                                <a href="<?php echo URLROOT;?>/moderatoralerts/viewCancelledAlerts">Add New Alerts<i class="fa fa-caret-down"></i></a>
                                                <input type="checkbox" id="btn-2">
                                                <div class="dropdown second">
                                                    <ul>
                                                        <li class="dropdown-link">
                                                            <a href="<?php echo URLROOT;?>/moderatoralerts/createCancellationAlerts">Cancellations</a>
                                                        </li>
                                                        <li class="dropdown-link">
                                                            <a href="<?php echo URLROOT;?>/moderatoralerts/createDelayAlerts">Delays</a>
                                                        </li>
                                                        <li class="dropdown-link">
                                                            <a href="<?php echo URLROOT;?>/moderatoralerts/createRescheduledAlerts">Reschedulements</a>
                                                        </li>
                                                        <div class="arrow"></div>
                                                    </ul>
                                                </div>
                                            </li>
                                            <li class="dropdown-link">
                                                <label for="btn-3" class="show2">Manage Alerts +</label>
                                                <a href="<?php echo URLROOT;?>/moderatoralerts/viewCancelledAlerts">Manage Alerts<i class="fa fa-caret-down"></i></a>
                                                <input type="checkbox" id="btn-3">
                                                <div class="dropdown second">
                                                    <ul>
                                                        <li class="dropdown-link">
                                                            <a href="<?php echo URLROOT;?>/moderatoralerts/viewCancelledAlerts">Cancellations</a>
                                                        </li>
                                                        <li class="dropdown-link">
                                                            <a href="<?php echo URLROOT;?>/moderatoralerts/viewDelayedAlerts">Delays</a>
                                                        </li>
                                                        <li class="dropdown-link">
                                                            <a href="<?php echo URLROOT;?>/moderatoralerts/viewRescheduledAlerts">Reschedulements</a>
                                                        </li>
                                                        <div class="arrow"></div>
                                                    </ul>
                                                </div>
                                            </li>
                                            <div class="arrow"></div>
                                        </ul>
                                    </div>
                                </li>
                                <li class="nav-link" style="--i: 1.1s">
                                    <label for="btn-4" class="show">Journey <i class="fa fa-caret-down"></i></label></label>
                                    <a href="<?php echo URLROOT;?>/ModeratorJourneys/index">Journey <i class="fa fa-caret-down"></i></a>
                                    <input type="checkbox" id="btn-4">
                                    <div class="dropdown">
                                        <ul>
                                            <li class="dropdown-link">
                                                <a href="<?php echo URLROOT;?>/ModeratorJourneys/createJourneyAssignment">Driver Assignment</a>
                                            </li>
                                            <li class="dropdown-link">
                                                <label for="btn-7" class="show2">Manage Journeys +</label>
                                                <a href="<?php echo URLROOT;?>/ModeratorJourneys/index">Manage Journey <i class="fa fa-caret-down"></i></a>
                                                <input type="checkbox" id="btn-7">
                                                <div class="dropdown second">
                                                    <ul>
                                                        <li class="dropdown-link">
                                                            <a href="<?php echo URLROOT;?>/moderatorJourneys/index">All Journeys</a>
                                                        </li>
                                                        <li class="dropdown-link">
                                                            <a href="<?php echo URLROOT;?>/moderatorJourneys/viewJourneys/live">Live Journeys</a>
                                                        </li>
                                                        <li class="dropdown-link">
                                                            <a href="<?php echo URLROOT;?>/moderatorJourneys/viewJourneys/offline">Off-Line Journeys</a>
                                                        </li>
                                                        <li class="dropdown-link">
                                                            <a href="<?php echo URLROOT;?>/moderatorJourneys/viewJourneys/ended">Ended Journeys</a>
                                                        </li>
                                                        <div class="arrow"></div>
                                                    </ul>
                                                </div>
                                            </li>
                                            <div class="arrow"></div>
                                        </ul>
                                    </div>
                                </li>
                                <li class="nav-link" style="--i: 1.35s">
                                    <label for="btn-5" class="show">Tracking <i class="fa fa-caret-down"></i></label></label>
                                    <a href="<?php echo URLROOT;?>/ModeratorTrackings/searchTrains/search">Tracking <i class="fa fa-caret-down"></i></a>
                                    <input type="checkbox" id="btn-5">
                                    <div class="dropdown">
                                        <ul>
                                            <li class="dropdown-link">
                                                <a href="<?php echo URLROOT;?>/ModeratorTrackings/searchTrains/search">Track Trains</a>
                                            </li>
                                            <li class="dropdown-link">
                                                <a href="<?php echo URLROOT;?>/ModeratorTrackings/viewlivetrains">View Live Map</a>
                                            </li>
                                            <div class="arrow"></div>
                                        </ul>
                                    </div>
                                </li>
                                <li class="nav-link" style="--i: 1.8s">
                                    <a href="<?php echo URLROOT;?>/moderatorSchedules/searchtrains/search">Schedule</a>
                                </li>
                                <li class="nav-link" style="--i: 2.05s">
                                    <label for="btn-6" class="show">Account <i class="fa fa-caret-down"></i></label></label>
                                    <a href="<?php echo URLROOT;?>/moderators/moderatorAccount">Account  <span class="fa fa-user"></span><i class="fa fa-caret-down"></i></a>
                                    <input type="checkbox" id="btn-6">
                                    <div class="dropdown">
                                        <ul>
                                            <li class="dropdown-link">
                                                <a href="<?php echo URLROOT;?>/moderators/moderatorAccount">Account<span class="fa fa-user"></span></a>
                                            </li>
                                            <li class="dropdown-link">
                                                <a href="<?php echo URLROOT;?>/moderators/logout">Logout<span class="fa fa-sign-out"></span></a>
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