<nav>
	<div class="container">
		<img src="<?php echo URLROOT ?>/public/img/menu.png" class="menu-icon" onclick="menutoggle()">
		<div class="logo">
			<a href="index.html">
				<img src="<?php echo URLROOT ?>/public/img/logo.jpg" alt="logo" height="80px">
			</a>
		</div>
		<ul id="menuItems">
			<li>
				<a href="<?php echo URLROOT; ?>/pages/index">Home</a>
			</li>
			<li>
				<a href="<?php echo URLROOT; ?>/schedules/search">Schedule</a>
			</li>
			<li>
				<a href="<?php echo URLROOT; ?>/reservations/search">Reservation</a>
			</li>
			<li>
				<a href="<?php echo URLROOT; ?>/alerts/displayAlerts">Alerts <i class="fa fa-chevron-down"></i></a>
				<ul>
					<li><a href="<?php echo URLROOT; ?>/alerts/displayDelayed">Delayed</a></li>
					<li><a href="<?php echo URLROOT; ?>/alerts/displayCancelled">Cancelled</a></li>
					<li><a href="<?php echo URLROOT; ?>/alerts/displayRescheduled">Rescheduled</a></li>
				</ul>
			</li>
			<li>
				<a href="<?php echo URLROOT; ?>/trackings/search">Track Train</a>
			</li>
			<?php if(isset($_SESSION['userid'])) : ?>
			<li>
				<a href="<?php echo URLROOT; ?>/accounts/displayAccount">Account <i class="fa fa-chevron-down"></i></a>
				<ul>
					<li><a href="<?php echo URLROOT; ?>/accounts/editAccount">Edit Profile</a></li>
					<li><a href="<?php echo URLROOT; ?>/accounts/displayTickets">Tickets</a></li>
					<li><a href="<?php echo URLROOT; ?>/accounts/displaySubscriptions">Subscriptions</a></li>
				</ul>
			</li>
			<?php endif; ?>
			<li>
				<?php if(isset($_SESSION['userid'])) : ?>
					<a href="<?php echo URLROOT; ?>/users/logout">Log Out</a>
				<?php else : ?>
					<a href="<?php echo URLROOT; ?>/users/login">Log In</a>
					<ul>
						<li><a href="<?php echo URLROOT; ?>/users/register">Register</a></li>
					</ul>
				<?php endif; ?>
			</li>
		</ul>
	</div>
</nav>


