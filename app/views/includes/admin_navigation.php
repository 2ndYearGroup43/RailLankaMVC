  
    <header>
        <nav class="h">
            <div class="logo"><a href="<?php echo URLROOT;?>/moderators/index"><img src="<?php echo URLROOT;?>/public/img/logonav1.jpg" alt="logo" height="85px"></a></div>
            <label for="btn" class="icon">
                <span class="fa fa-bars" aria-hidden="true"></span>
            </label>
            <input type="checkbox" id="btn">
            <ul class="main-nav">
                <li><a href="<?php echo URLROOT;?>/moderators/index">Home</a></li>
                <li>
                    <label for="btn-1" class="show">MANAGE USERS +</label>
                    <a href="#">Manage Users <span class="fa fa-caret-down"  aria-hidden="true"></span></a>
                    <input type="checkbox" id="btn-1">
                    <ul>
                        <li><a href="Moderator-journeyAssignment.html">Add Passengers</a></li>
                        <li><a href="Moderator-journeyManagement.html">Manage Passengers</a></li>
                    </ul>
                </li>
                <li>
                    <label for="btn-2" class="show">MANAGE EMPLOYEES +</label>
                    <a href="#">Manage Employees <span class="fa fa-caret-down"  aria-hidden="true"></span></a>
                    <input type="checkbox" id="btn-2">
                    <ul>
                        <li>
                            <label for="btn-3" class="show2">ADD EMPLOYEES +</label>
                            <a href="#">Add Employees <span class="fa fa-caret-right"></span></a>
                            <input type="checkbox" id="btn-3">
                            <ul>
                                <li><a href="Admin-addRO.html">Reservation Dept.</a></li>
                                <li><a href="<?php echo URLROOT;?>/moderators/registerModerator">Moderators</a></li>
                                <li><a href="<?php echo URLROOT;?>/drivers/registerDriver">Drivers</a></li>
                            </ul>
                        </li>
                        <li>
                            <label for="btn-4" class="show2">MANAGE EMPLOYEES +</label>
                            <a href="#">Manage Employees<span class="fa fa-caret-right"></span></a>
                            <input type="checkbox" id="btn-4">
                            <ul>
                                <li><a href="Admin-manageRO.html">Reservation Dept.</a></li>
                                <li><a href="<?php echo URLROOT;?>/moderators/viewModerators">Moderators</a></li>
                                <li><a href="<?php echo URLROOT;?>/drivers/viewDrivers">Drivers</a></li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <li>
                    <label for="btn-5" class="show">TRAIN +</label>
                    <a href="Moderator-searchtracktrains.html">Trains <span class="fa fa-caret-down" aria-hidden="true"></span> </a>
                    <input type="checkbox" id="btn-5">
                    <ul>
                        <li><a href="Moderator-searchtracktrains.html">Add Trains</a></li>
                        <li><a href="Moderator-viewtrainsmap.html">Manage Trains</a></li>
                    </ul>
                </li>
                <li>
                    <label for="btn-6" class="show">STATION +</label>
                    <a href="Moderator-searchtracktrains.html">Stations <span class="fa fa-caret-down" aria-hidden="true"></span> </a>
                    <input type="checkbox" id="btn-6">
                    <ul>
                        <li><a href="Moderator-searchtracktrains.html">Add Stations</a></li>
                        <li><a href="Moderator-viewtrainsmap.html">Manage Stations</a></li>
                    </ul>
                </li>
                <li>
                    <label for="btn-7" class="show">NOTICES +</label>
                    <a href="Moderator-searchtracktrains.html">Notices <span class="fa fa-caret-down" aria-hidden="true"></span> </a>
                    <input type="checkbox" id="btn-7">
                    <ul>
                        <li><a href="Moderator-searchtracktrains.html">Add Notices</a></li>
                        <li><a href="Moderator-viewtrainsmap.html">Manage Notices</a></li>
                    </ul>
                </li>
                <li>
                    <?php   if(isLoggedIn()):?>
                            <label for="btn-6" class="show">ACCOUNT +</label>
                            <a href="Moderator-account.html"><span class="fa fa-user" aria-hidden="true"></span> Account <span class="fa fa-caret-down" aria-hidden="true"></span></a>
                            <input type="checkbox" id="btn-6">
                            <ul>
                                <li><a href="<?php echo URLROOT;?>/users/logout">Logout <span class="fa fa-sign-out" aria-hidden="true"></span></a></li>
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