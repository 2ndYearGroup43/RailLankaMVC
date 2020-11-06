    <header>
        <nav>
            <div class="logo"><a href="index.html"><img src="<?php echo URLROOT;?>/public/images/logonav1.jpg" alt="logo" height="85px"></a></div>
            <label for="btn" class="icon">
                <span class="fa fa-bars" aria-hidden="true"></span>
            </label>
            <input type="checkbox" id="btn">
            <ul class="main-nav">
                <li><a href="#">Home</a></li>
                <li>
                    <label for="btn-1" class="show">ALERTS +</label>
                    <a href="<?php echo URLROOT;?>/alerts/viewCancelledAlerts">Alerts
                        <span class="fa fa-caret-down"  aria-hidden="true"></span>
                    </a>
                    <input type="checkbox" id="btn-1">
                    <ul>
                        <li>
                            <label for="btn-2" class="show2">ADD NEW ALERTS +</label>
                            <a href="#">Add New Alerts <span class="fa fa-caret-right"></span></a>
                            <input type="checkbox" id="btn-2">
                            <ul>
                                <li><a href="<?php echo URLROOT;?>/alerts/createCancellationAlerts">Cancellations</a></li>
                                <li><a href="<?php echo URLROOT;?>/alerts/createDelayAlerts">Delays</a></li>
                                <li><a href="<?php echo URLROOT;?>/alerts/createRescheduledAlerts">Reschedulements</a></li>
                            </ul>
                        </li>
                        <li>
                            <label for="btn-3" class="show2">ALERT MANAGEMENT +</label>
                            <a href="#">Alert Management<span class="fa fa-caret-right"></span></a>
                            <input type="checkbox" id="btn-3">
                            <ul>
                                <li><a href="<?php echo URLROOT;?>/alerts/viewCancelledAlerts">Cancellations</a></li>
                                <li><a href="<?php echo URLROOT;?>/alerts/viewDelayedAlerts">Delays</a></li>
                                <li><a href="<?php echo URLROOT;?>/alerts/viewRescheduledAlerts">Reschedulements</a></li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <li>
                    <label for="btn-4" class="show">JOURNEY +</label>
                    <a href="#">Journey <span class="fa fa-caret-down"  aria-hidden="true"></span></a>
                    <input type="checkbox" id="btn-4">
                    <ul>
                        <li><a href="Moderator-journeyAssignment.html">Driver Assignment</a></li>
                        <li><a href="Moderator-journeyManagement.html">Manage Journey</a></li>
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
                    <?php   if(isModeratorLoggedIn()):?>
                            <label for="btn-6" class="show">ACCOUNT +</label>
                            <a href="Moderator-account.html"><span class="fa fa-user" aria-hidden="true"></span> Account <span class="fa fa-caret-down" aria-hidden="true"></span></a>
                            <input type="checkbox" id="btn-6">
                            <ul>
                                <li><a href="<?php echo URLROOT;?>/moderators/logout">Logout <span class="fa fa-sign-out" aria-hidden="true"></span></a></li>
                            </ul>
                    <?php else:?>
                        <a href="<?php echo URLROOT;?>/moderators/login">Login</a>
                    <?php endif; ?>
                </li>
            </ul>
            <!-- <label id="icon">
                <i class="fa fa-bars" aria-hidden="true"></i>
            </label>     -->
        </nav>
    </header>