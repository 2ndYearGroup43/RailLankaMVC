    <header>
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
            </ul>
            <!-- <label id="icon">
                <i class="fa fa-bars" aria-hidden="true"></i>
            </label>     -->
        </nav>
    </header>


    