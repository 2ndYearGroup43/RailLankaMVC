<header>
	<div class=nav-container>
			<input type="checkbox" name="" id="check">
			<div class="logo-container">	
				<a href="<?php echo URLROOT; ?>/pages/index">
				<img src="<?php echo URLROOT ?>/public/img/logo.jpg" alt="logo" height="80px">
				</a>
			</div>	
			<div class="nav-btn">
			    <div class="nav-links">
			   	<ul>
			   		<li class="nav-link" style="--i: .6s">	
			   			<a href="<?php echo URLROOT; ?>/pages/index">Home</a>
			   		</li>	
			   		<li class="nav-link" style="--i: .85s">	
			   			<a href="<?php echo URLROOT; ?>/passengerSchedules/search">Schedule</a>
			   		</li>
			   		<li class="nav-link" style="--i: 1.1s" >	
			   			<a href="<?php echo URLROOT; ?>/passengerReservations/search">Reservation</a>
			   		</li>
			   		<li class="nav-link" style="--i: 1.35s">	
			   			<a href="<?php echo URLROOT; ?>/passengerTrackings/search">Track Train</a>
			   		</li>
			   		<li class="nav-link" style="--i: 1.8s">	
			   			<a href="#">Alerts <i class="fa fa-caret-down"></i></a>
			   			<div class="nav-dropdown">	
			   				<ul>
			   					<li class="nav-dropdown-link">	
			   						<a href="<?php echo URLROOT; ?>/passengerAlerts/displayAlerts">All Alerts</a>
			   					</li>	
			   					<li class="nav-dropdown-link">	
			   						<a href="<?php echo URLROOT; ?>/passengerAlerts/displayDelayed">Delayed</a>
			   					</li>
			   					<li class="nav-dropdown-link">	
			   						<a href="<?php echo URLROOT; ?>/passengerAlerts/displayCancelled">Cancelled</a>
			   					</li>
			   					<li class="nav-dropdown-link">	
			   						<a href="<?php echo URLROOT; ?>/passengerAlerts/displayRescheduled">Rescheduled</a>
			   					</li>
			   					<?php if(isset($_SESSION['userid'])) : ?>
			   					<li class="nav-dropdown-link">	
			   						<a href="<?php echo URLROOT; ?>/passengerAlerts/search">Subscribe</a>
			   					</li>
			   					<?php endif; ?>
			   					<div class="arrow">	</div>
			   				</ul>
			   			</div>
			   		</li>
			   		<?php if(isset($_SESSION['userid'])) : ?>
			   		<li class="nav-link" style="--i: 2.05s">	
			   			<a href="#">Account <i class="fa fa-caret-down"></i></a>
			   			<div class="nav-dropdown">	
			   				<ul>
			   					<li class="nav-dropdown-link">	
			   						<a href="<?php echo URLROOT; ?>/passengerAccounts/displayAccount">View Profile</a>
			   					</li>	
			   					<li class="nav-dropdown-link">	
			   						<a href="<?php echo URLROOT; ?>/passengerAccounts/editAccount">Edit Profile</a>
			   					</li>
			   					<li class="nav-dropdown-link">	
			   						<a href="<?php echo URLROOT; ?>/passengerAccounts/displayTickets">Tickets</a>
			   					</li>
			   					<li class="nav-dropdown-link">	
			   						<a href="<?php echo URLROOT; ?>/passengerAccounts/displaySubscriptions">Subscriptions</a>
			   					</li>
			   					<div class="arrow">	</div>
			   				</ul>
			   			</div>
			   		</li>
			   		<?php endif; ?>
			   		<li class="nav-link" style="--i: 2.3s">	
			   			<?php if(isset($_SESSION['userid'])) : ?>
						<a href="<?php echo URLROOT; ?>/users/logout">Log Out</a>
						<?php else : ?>
						<a href="<?php echo URLROOT; ?>/users/login">Log In</a>
						<div class="nav-dropdown">	
						<ul>
							<li class="nav-dropdown-link">
								<a href="<?php echo URLROOT; ?>/users/register">Register</a>
							</li>
							<div class="arrow">	</div>
						</ul>
						<?php endif; ?>
			   		</li>
			   	</ul>
			    </div>	
			</div>
			<div class="hamburger-menu-container">
				<div class="hamburger-menu">
						<div>	</div>	
				</div>	
			</div>
		</div>
	</header>
	



