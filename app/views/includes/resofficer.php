	<header>
		<nav>
            <div class="logo"><a href="index.html"><img src="<?php echo URLROOT;?>/public/img/logonav1.jpg" alt="logo" height="85px"></a></div>
            <ul>
                <li><a href="#">Home</a></li>
                <li><a href="#">User Management</a></li>
                <li><a class="active" href="<?php echo URLROOT; ?>/manage_ro/index">Employee Management</a></li>
                <li>
                        <label for="btn-4" class="show">Train Management +</label>
                        <a href="<?php echo URLROOT; ?>/manage_train/index" >Train Management <span class="fa fa-caret-down"  aria-hidden="true"></span></a>
                        <input type="checkbox" id="btn-4">
                        <ul>
                            <li><a href="<?php echo URLROOT; ?>/manage_fare/index">Manage Fare</a></li>
                            <li><a href="<?php echo URLROOT; ?>/manage_compartment_type/index">Compartment Type</a></li>
                        </ul>
                </li>
                <li><a href="#">Station Management</a></li>
                <li><a href="#">Reports</a></li>
                <li>
                        <label for="btn-6" class="show">ACCOUNT +</label>
                        <a href="#"><span class="fa fa-user" aria-hidden="true"></span> Account <span class="fa fa-caret-down" aria-hidden="true"></span></a>
                        <input type="checkbox" id="btn-6">
                        <ul>
                            <li><a href="#">Logout <span class="fa fa-sign-out" aria-hidden="true"></span></a></li>
                       </ul>
                </li>
            </ul>
            <label id="icon">
                <i class="fa fa-bars" aria-hidden="true"></i>
            </label>    
        </nav>
	</header>  <!--header-->