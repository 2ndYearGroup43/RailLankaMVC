<?php 

	//echo out databse info to the screen
	// foreach ($data['users'] as $user) {
	// 	echo "Information: " . $user->user_name . $user->user_email;
	// 	echo "<br>";
	// }
	
	isPassenger();
	require APPROOT . '/views/includes/passenger_head.php';
	require APPROOT . '/views/includes/passenger_navigation.php';
?>

<!-- <?php var_dump($_SESSION); ?>  -->
  

<?php echo password_hash("super@123", PASSWORD_DEFAULT); ?>

<div class="marquee-area info-tag">
	<marquee>
		<i class="fa fa-exclamation-triangle" aria-hidden="true" size="3x"></i> All stations closed until further notice due to COVID-19
	</marquee>
</div>

<!-- banner area -->
<div class="banner">
	<div class="wrapper-landing">
			<h1>EXPLORE SRI LANKA ON RAILS</h1>
			<div class="search-box">
				<input class="search-txt" type="text" list="keywordList" placeholder="Search">
				<datalist id="keywordList">
					<option>Reserve</option>
					<option>Track</option>
					<option>Schedule</option>
					<option>Notices</option>
				</datalist>
				<a class="search-btn" href="#">
					<i class="fa fa-search"></i>
				</a>
			</div>
	</div>	
</div>
<!-- end of banner area -->


<!-- reserve shortcuts -->
<section id="nback" >
	<div  class="container">	
		<div class="row">
			<div  class="container col-l">
				<section id="carousel">
					<div class="slideshow">
						<div class="slideshow-item">
							<img src="<?php echo URLROOT ?>/public/img/bookmark1.jpg">
							<div class="slideshow-item-text">
								<h3>COLOMBO-KANDY</h3>
								<!-- <p>The three-hour trip from Colombo to Kandy will whisk you away from the big city sprawl to the genteel greenery of Sri Lanka’s spiritual capital.</p> -->
								<button onclick="location.href='<?php echo URLROOT; ?>/passengerReservations/displayTrains'" type="submit" class="btn">Reserve Now</button>
							</div>
						</div>
						<div class="slideshow-item">
							<img src="<?php echo URLROOT ?>/public/img/bookmark2.jpg">
							<div class="slideshow-item-text">
								<h3>COLOMBO-GALLE</h3>
								<!-- <p>Lorem Ipsum</p> -->
								<button onclick="location.href='<?php echo URLROOT; ?>/passengerReservations/displayTrains'" type="submit" class="btn">Reserve Now</button>
							</div>
						</div>
						<div class="slideshow-item">
							<img src="<?php echo URLROOT ?>/public/img/bookmark3.jpg">
							<div class="slideshow-item-text">
								<h3>COLOMBO-JAFFNA</h3>
								<!-- <p>Lorem Ipsum</p> -->
								<button onclick="location.href='<?php echo URLROOT; ?>/passengerReservations/displayTrains'" type="submit" class="btn">Reserve Now</button>
							</div>
						</div>
					</div>
				</section>
			</div>
		</div>
	</div>
</section>
<!-- end of reserve shortcuts -->

<section id="notices-section">
	<div class="leftbox">
		<div class="content">
			<div class="mini-schedule">
				<h2 class="title" id="title3">SEARCH TRAIN</h2>
				<form action="#">
					<div class="form-row">
						<div class="mini-input-data">
							<label for="src">From</label>
		                    <select name="src" id="src">
		                        <option value="Fort">Fort</option>
		                        <option value="Kandy">Kandy</option>
		                        <option value="Galle">Galle</option>
		            		    <option value="Baadulla">Baadulla</option>
		                    </select>
						</div>
						<div class="mini-input-data">
							<label for="src">To</label>
		                    <select name="src" id="src">
		                      	<option value="Fort">Fort</option>
		                        <option value="Kandy">Kandy</option>
		                        <option value="Galle">Galle</option>
		                        <option value="Baadulla">Baadulla</option>
		                    </select>
		                </div>	
					</div>
					<div class="form-row">
						<div class="mini-input-data">
							<label for="date">Date</label>
		                  	<input type="date" id="date" >
		                </div>
					</div>
					<div class="form-row">
						<div class="mini-input-data">
							<label for="time">Time</label>
		                    <input type="time" id="time" >
		                </div>
					</div>
				</form>
				<a href="<?php echo URLROOT; ?>/passengerSchedules/displayTrains" id="view-all">Go <i class="fa fa-long-arrow-right"></i></a>
			</div>
		</div>
	</div>
	<div class="events">
		<h1>NOTICES</h1>
		<ul>
			<li>
				<div class="time">
					<h2>02<br><span>October</span></h2>
				</div>
				<div class="time-details">
					<h3>Unawatuna Sub Railway Station Temporarily Closed Due To COVID-19</h3>
					<a class="pop-up" href="#">
						<p>Read More <i class="fa fa-angle-double-right"></i></p>
					</a>
				</div>
				<div style="clear: both;"></div>
			</li>
			<li>
				<div class="time">
					<h2>28<br><span>August</span></h2>
				</div>
				<div class="time-details">
					<h3>Beliatta-Anuradhapura Express Train won't be in operation until further notice</h3>
					<a class="pop-up" href="#">
						<p>Read More <i class="fa fa-angle-double-right"></i></p>
					</a>
				</div>
				<div style="clear: both;"></div>
			</li>
			<li>
				<div class="time">
					<h2>13<br><span>July</span></h2>
				</div>
				<div class="time-details">
					<h3>Denuwara Menike And KKS Intercity Trains To Run On Weekends</h3>
					<a class="pop-up" href="#">
						<p>Read More <i class="fa fa-angle-double-right"></i></p>
					</a>
				</div>
				<div style="clear: both;"></div>
			</li>
		</ul>
		<a href="<?php echo URLROOT; ?>/pages/notices" id="view-all">View All <i class="fa fa-long-arrow-right"></i></a>
	</div>
</section>

<!-- pop up -->
	<div class="bg-modal" id="front-page">
		<div class="modal-content">
			<div class="close">+</div>
			<div class="notices-container">
			<h2 class="title">Notice</h2>
				<table class="content-table" id="details">

					<tbody>	
						<tr>
							<td>2nd October 2020</td>
						</tr>
						<tr>
							<td><center><h3>Unawatuna sub railway station temporarily closed due to COVID-19</h3></center></td>
						</tr>
						<tr>	
							<td>The Unawatuna Railway Station was temporarily closed on Monday (July 13), according to the Department of Railways.

							“An officer at the Unawatuna Railway Station was directed for PCR testing after it was confirmed he maintained contact with a COVID-19 case,” Dilantha Fernando – the General Manager of Railways said on Monday (July 12).

							According to Fernando, the Unawatuna Railway station will remain closed until the officer’s PCR test results are released.
							</td>
						</tr>
					</tbody>		
				</table>
			</div>
		</div>
	</div>
	<!-- end of pop up -->

<!-- js for pop up -->
<script>

	$('.pop-up').bind('click', function() {
				document.querySelector('.bg-modal').style.display = 'flex';
		});

	document.querySelector('.close').addEventListener('click', function(){
			document.querySelector('.bg-modal').style.display = 'none';
		});

</script>
<!-- end of js for pop up -->

<?php require APPROOT . '/views/includes/passenger_footer.php'; ?>


