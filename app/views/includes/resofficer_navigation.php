	<header>
		<nav>
            <div class="logo"><a href="index.html"><img src="<?php echo URLROOT;?>/public/img/logonav1.jpg" alt="logo" height="85px"></a></div>
            <ul>
                <li><a href="#">Home</a></li>
                <li><a href="<?php echo URLROOT; ?>/ResOfficerReservations/search">Reservation</a></li>
                <li><a href="<?php echo URLROOT; ?>/ResOfficerRefunds/refund">Refund</a></li>
                <li><a href="<?php echo URLROOT; ?>/ResOfficerReservationDetails/search">Reservation Details</a></li>
                <li><a href="<?php echo URLROOT; ?>/ResOfficerReservationDetails/searchTicketDetails">Ticket Details</a></li>
                <li>
                        <label for="btn-6" class="show">ACCOUNT +</label>
                        <a href="#"><span class="fa fa-user" aria-hidden="true"></span> Account <span class="fa fa-caret-down" aria-hidden="true"></span></a>
                        <input type="checkbox" id="btn-6">
                        <ul>
                            <li><a href="<?php echo URLROOT; ?>/resofficers/logout">Logout <span class="fa fa-sign-out" aria-hidden="true"></span></a></li>
                       </ul>
                </li>
            </ul>
            <label id="icon">
                <i class="fa fa-bars" aria-hidden="true"></i>
            </label>    
        </nav>
	</header>  <!--header-->