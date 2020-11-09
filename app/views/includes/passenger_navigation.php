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
				<a href="<?php echo URLROOT; ?>/pages/index">Alerts</a>
			</li>
			<li>
				<a href="<?php echo URLROOT; ?>/pages/index">Track Train</a>
			</li>
			<?php if(isset($_SESSION['userid'])) : ?>
			<li>
				<a href="<?php echo URLROOT; ?>/pages/index">Account <i class="fa fa-chevron-down"></i></a>
				<ul>
					<li><a href="<?php echo URLROOT; ?>/pages/index">Edit Profile</a></li>
					<li><a href="<?php echo URLROOT; ?>/pages/index">Tickets</a></li>
					<li><a href="<?php echo URLROOT; ?>/pages/index">Subscriptions</a></li>
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


