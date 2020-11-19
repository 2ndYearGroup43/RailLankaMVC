    <header>
        <nav class="h">
            <div class="logo"><a href="<?php echo URLROOT;?>/admins/"><img src="<?php echo URLROOT;?>/public/img/logonav1.jpg" alt="logo" height="85px"></a></div>
            <label for="btn" class="icon">
                <span class="fa fa-bars" aria-hidden="true"></span>
            </label>
            <input type="checkbox" id="btn">
            <ul class="main-nav">
                <li><a href="<?php echo URLROOT;?>/admins/">Home</a></li>
                <li><a href="<?php echo URLROOT;?>/admins/">Users</a></li>
                <li><a href="<?php echo URLROOT; ?>/Resofficers/viewResofficers">Employees</a></li>
                <li>
                        <label for="btn-4" class="show">Trains +</label>
                        <a href="<?php echo URLROOT; ?>/Admin_manage_trains/index"  class="active">Trains<span class="fa fa-caret-down"  aria-hidden="true"></span></a>
                        <input type="checkbox" id="btn-4">
                        <ul>
                            <li><a href="<?php echo URLROOT; ?>/Admin_manage_fares/index">Manage Fare</a></li>
                            <li><a href="<?php echo URLROOT; ?>/Admin_manage_compartment_types/index">Compartment Type</a></li>
                        </ul>
                </li>
                <li><a href="#">Stations</a></li>
                <li><a href="#">Reports</a></li>
                
                <li>
                    
                            <label for="btn-6" class="show">ACCOUNT +</label>
                            <a href="Moderator-account.html"><span class="fa fa-user" aria-hidden="true"></span> Account <span class="fa fa-caret-down" aria-hidden="true"></span></a>
                            <input type="checkbox" id="btn-6">
                            <ul>
                                <li><a href="<?php echo URLROOT;?>/admins/logout">Logout <span class="fa fa-sign-out" aria-hidden="true"></span></a></li>
                            </ul>
                    
                        <a href="<?php echo URLROOT;?>/users/login">Login</a>
                    
                </li>
            </ul>
            <!-- <label id="icon">
                <i class="fa fa-bars" aria-hidden="true"></i>
            </label>     -->
        </nav>
    </header>