<!DOCTYPE html>
<html>
<head>
	<title>Rail Lanka</title>
	<meta charset="UTF-8">
	<meta htttp-equiv="Cache-control" content="no-cache">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?php echo SITENAME; ?></title>
	<link rel="stylesheet" type="text/css" href="<?php echo URLROOT ?>/public/css/passenger_main.css">
	<link href="https://fonts.googleapis.com/css?family=Poppins:400,500,600,700&display=swap" rel="stylesheet"> 
</head>
<header>
	<div class=nav-container>
			<input type="checkbox" name="" id="check">
			<div class="logo-container">	
				<a href="index.html">
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
			   			<a href="<?php echo URLROOT; ?>/ResOfficerReservations/search">Reservation</a>
			   		</li>
			   		<li class="nav-link" style="--i: 1.1s" >	
			   			<a href="<?php echo URLROOT; ?>/ResOfficerRefunds/refund">Refund</a>
			   		</li>
			   		<li class="nav-link" style="--i: 1.35s">	
			   			<a href="<?php echo URLROOT; ?>/ResOfficerReservationDetails/search">Reservation Details</a>
			   		</li>
			   		<li class="nav-link" style="--i: 1.8s">	
			   			<a href="<?php echo URLROOT; ?>/ResOfficerReservationDetails/searchTicketDetails">Ticket Details</a>
			   		</li>
			   		<li class="nav-link" style="--i: 1.8s">	
			   			<a href="<?php echo URLROOT; ?>/ResOfficerManageSeats/search">Manage Seats</a>
			   		</li>
			   		<?php if(isset($_SESSION['userid'])) : ?>
			   		<li class="nav-link" style="--i: 2.05s">	
			   			<a href="<?php echo URLROOT; ?>/resofficers/resofficerAccount">Account <i class="fa fa-caret-down"></i></a>
			   		</li>
			   		<?php endif; ?>
			   		<li class="nav-link" style="--i: 2.3s">	
			   			<?php if(isset($_SESSION['userid'])) : ?>
						<a href="<?php echo URLROOT; ?>/users/logout">Log Out</a>
						<?php else : ?>
						<a href="<?php echo URLROOT; ?>/users/login">Log In</a>
						<div class="nav-dropdown">	
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

	<div class="body-section">
		<div class="content-row">
		</div>
		<div class="content-row">
		</div>
		<div class="map-container">
			<h1 class="title">SEAT MAP</h1>
			
			<div class="row">

				<div class="compartment-container">
				   	<h3>Select Compartment</h3>
				   	<div class='compartment-area'>
				   		<input onclick="location.href='<?php echo URLROOT; ?>/resofficerManageSeats/displaySeatMaps'" type="submit" class="compartment" value="Wagon 1">
					   	<input onclick="location.href='<?php echo URLROOT; ?>/resofficerManageSeats/displaySeatMaps2'" type="submit" class="compartment active-comp" value="Wagon 2">
					   	<input onclick="location.href='<?php echo URLROOT; ?>/resofficerManageSeats/displaySeatMaps3'" type="submit" class="compartment" value="Wagon 3">
					   	<input onclick="location.href='<?php echo URLROOT; ?>/resofficerManageSeats/displaySeatMaps4'" type="submit" class="compartment" value="Wagon 4">
					   	<input onclick="location.href='<?php echo URLROOT; ?>/resofficerManageSeats/displaySeatMaps5'" type="submit" class="compartment" value="Wagon 5">
					   	<input onclick="location.href='<?php echo URLROOT; ?>/resofficerManageSeats/displaySeatMaps6'" type="submit" class="compartment" value="Wagon 6">
				   	</div>
				   	<div class="seat-map-legend">
						<ul class="seat-map-legendList">
							<li class="seat-map-legendItem">
								<div class="seat-map-cell seat-map-seat f-c"></div>
								<span class="seat-map-legendDescription">First Class</span>
							</li>
							<li class="seat-map-legendItem">
								<div class="seat-map-cell seat-map-seat s-c"></div>
								<span class="seat-map-legendDescription">Second Class</span>
							</li>
							<li class="seat-map-legendItem">
								<div class="seat-map-cell seat-map-seat t-c"></div>
								<span class="seat-map-legendDescription">Third Class</span>
							</li>
							<li class="seat-map-legendItem">
								<div class="seat-map-cell seat-map-seat unavailable"></div>
								<span class="seat-map-legendDescription">Unavailable</span>
							</li>
						</ul>
					</div>
			    </div>

			    <div class="seat-map-container">
					<h3>Wagon 2 - Second Class</h3>
					<div class=front>
						Front
					</div>
					<div class="seat-map-compartment">
						<div class="seat-map-row">
							<div class="seat-map-cell seat-map-space">A</div>
							<div class="seat-map-cell seat-map-seat s-c">1</div>
							<div class="seat-map-cell seat-map-seat s-c">2</div>
							<div class="seat-map-cell seat-map-space"></div>
							<div class="seat-map-cell seat-map-space"></div>
							<div class="seat-map-cell seat-map-seat s-c">3</div>
							<div class="seat-map-cell seat-map-seat s-c">4</div>
						</div>
						<div class="seat-map-row">
							<div class="seat-map-cell seat-map-space">B</div>
							<div class="seat-map-cell seat-map-seat s-c">5</div>
							<div class="seat-map-cell seat-map-seat s-c">6</div>
							<div class="seat-map-cell seat-map-space"></div>
							<div class="seat-map-cell seat-map-space"></div>
							<div class="seat-map-cell seat-map-seat s-c">7</div>
							<div class="seat-map-cell seat-map-seat s-c">8</div>
						</div>
						<div class="seat-map-row">
							<div class="seat-map-cell seat-map-space">C</div>
							<div class="seat-map-cell seat-map-seat s-c">9</div>
							<div class="seat-map-cell seat-map-seat s-c">10</div>
							<div class="seat-map-cell seat-map-space"></div>
							<div class="seat-map-cell seat-map-space"></div>
							<div class="seat-map-cell seat-map-seat s-c">11</div>
							<div class="seat-map-cell seat-map-seat s-c">12</div>
						</div>
						<div class="seat-map-row">
							<div class="seat-map-cell seat-map-space">D</div>
							<div class="seat-map-cell seat-map-seat s-c">13</div>
							<div class="seat-map-cell seat-map-seat s-c">14</div>
							<div class="seat-map-cell seat-map-space"></div>
							<div class="seat-map-cell seat-map-space"></div>
							<div class="seat-map-cell seat-map-seat s-c">15</div>
							<div class="seat-map-cell seat-map-seat s-c">16</div>
						</div>
						<div class="seat-map-row">
							<div class="seat-map-cell seat-map-space">E</div>
							<div class="seat-map-cell seat-map-seat s-c">17</div>
							<div class="seat-map-cell seat-map-seat s-c">18</div>
							<div class="seat-map-cell seat-map-space"></div>
							<div class="seat-map-cell seat-map-space"></div>
							<div class="seat-map-cell seat-map-seat s-c">19</div>
							<div class="seat-map-cell seat-map-seat s-c">20</div>
						</div>
						<div class="seat-map-row">
							<div class="seat-map-cell seat-map-space">F</div>
							<div class="seat-map-cell seat-map-seat s-c unavailable">21</div>
							<div class="seat-map-cell seat-map-seat s-c">22</div>
							<div class="seat-map-cell seat-map-space"></div>
							<div class="seat-map-cell seat-map-space"></div>
							<div class="seat-map-cell seat-map-seat s-c">23</div>
							<div class="seat-map-cell seat-map-seat s-c">24</div>
						</div>
						<div class="seat-map-row">
							<div class="seat-map-cell seat-map-space">G</div>
							<div class="seat-map-cell seat-map-seat s-c">25</div>
							<div class="seat-map-cell seat-map-seat s-c">26</div>
							<div class="seat-map-cell seat-map-space"></div>
							<div class="seat-map-cell seat-map-space"></div>
							<div class="seat-map-cell seat-map-seat s-c">27</div>
							<div class="seat-map-cell seat-map-seat s-c">28</div>
						</div>
						<div class="seat-map-row">
							<div class="seat-map-cell seat-map-space">H</div>
							<div class="seat-map-cell seat-map-seat s-c">29</div>
							<div class="seat-map-cell seat-map-seat s-c">30</div>
							<div class="seat-map-cell seat-map-space"></div>
							<div class="seat-map-cell seat-map-space"></div>
							<div class="seat-map-cell seat-map-seat s-c">31</div>
							<div class="seat-map-cell seat-map-seat s-c">32</div>
						</div>
					</div>
				</div>
			</div>

			
			<button  class="btn checkout-btn">Save &raquo;</button>
				<p class="options">Back to search results? <a href="<?php echo URLROOT; ?>/resofficerManageSeats/displayTrains">Click here.</a></p>
			<!-- <button type="submit" class="btn blue-btn checkout-btn">Back</button> -->
		</div>		
		<div class="content-row">
		</div>
		<div class="content-row">
		</div>	
		<div class="content-row">
		</div>
		
	</div>

<?php require APPROOT . '/views/includes/passenger_footer.php'; ?>