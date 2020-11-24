<?php 

	//echo out databse info to the screen
	// foreach ($data['users'] as $user) {
	// 	echo "Information: " . $user->user_name . $user->user_email;
	// 	echo "<br>";
	// }
	
	// isPassenger();
	require APPROOT . '/views/includes/passenger_head.php';
	require APPROOT . '/views/includes/admin_navigation_home.php';
?>

<!--<?php var_dump($_SESSION); ?> -->

<!-- banner area -->
<div class="marquee-area info-tag">
	<marquee>
		<i class="fa fa-exclamation-triangle" aria-hidden="true" size="3x"></i> Coronavirus(COVID-19) - For the latest updates and travel information, please visit our Coronavirus Information Center
	</marquee>
</div>


<div class="banner">
	<div class="wrapper-landing">
			<h1>EXPLORE SRI LANKA ON RAILS</h1>
			<div class="search-box">
				<input class="search-txt" type="text" name="" placeholder="Search">
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
							<img src="<?php echo URLROOT ?>/public/images/bookmark1.jpg">
							<div class="slideshow-item-text">
								<h3>COLOMBO-KANDY</h3>
								<!-- <p>The three-hour trip from Colombo to Kandy will whisk you away from the big city sprawl to the genteel greenery of Sri Lanka’s spiritual capital.</p> -->
								<button onclick="location.href='<?php echo URLROOT; ?>/reservations/displayTrains'" type="submit" class="btn">Reserve Now</button>
							</div>
						</div>
						<div class="slideshow-item">
							<img src="<?php echo URLROOT ?>/public/images/bookmark2.jpg">
							<div class="slideshow-item-text">
								<h3>COLOMBO-GALLE</h3>
								<!-- <p>Lorem Ipsum</p> -->
								<button onclick="location.href='<?php echo URLROOT; ?>/reservations/displayTrains'" type="submit" class="btn">Reserve Now</button>
							</div>
						</div>
						<div class="slideshow-item">
							<img src="<?php echo URLROOT ?>/public/images/bookmark3.jpg">
							<div class="slideshow-item-text">
								<h3>COLOMBO-JAFFNA</h3>
								<!-- <p>Lorem Ipsum</p> -->
								<button onclick="location.href='<?php echo URLROOT; ?>/reservations/displayTrains'" type="submit" class="btn">Reserve Now</button>
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
				<h2 class="title">SEARCH TRAIN</h2>
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
				<a href="<?php echo URLROOT; ?>/schedules/displayTrains" id="view-all">Go <i class="fa fa-long-arrow-right"></i></a>
			</div>
		</div>
	</div>
	<div class="events">
		<h1>NOTICES</h1>
		<ul>
			<li>
				<div class="time">
					<h2>24<br><span>June</span></h2>
				</div>
				<div class="time-details">
					<a id=pop-up href="#"><h3>Where does it come from</h3></a>
					<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
					</p>
				</div>
				<div style="clear: both;"></div>
			</li>
			<li>
				<div class="time">
						<h2>24<br><span>June</span></h2>
					</div>
					<div class="time-details">
						<a id=pop-up href="#"><h3>Where does it come from</h3></a>
						<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
						</p>
					</div>
				<div style="clear: both;"></div>
			</li>
			<li>
				<div class="time">
					<h2>24<br><span>June</span></h2>
				</div>
				<div class="time-details">
					<a id=pop-up href="#"><h3>Where does it come from</h3></a>
					<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
					</p>
				</div>
				<div style="clear: both;"></div>
			</li>
		</ul>
		<a href="" id="view-all">View All <i class="fa fa-long-arrow-right"></i></a>
	</div>
</section>

<!-- pop up -->
	<div class="bg-modal">
		<div class="modal-content">
			<div class="close">+</div>
			<div class="notices-container">
			<h2 class="title">Notice</h2>
				<table class="content-table" id="details">

					<tbody>	
						<tr>
							<td><h2>lorem ipsum</h2></td>
						</tr>
						<tr>	
							<td>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
							tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
							quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
							consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
							cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
							proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
							</td>
						</tr>
					</tbody>		
				</table>
			</div>
		</div>
	</div>
	<!-- end of pop up -->


<!-- js for toggle menu -->
<script>
	var menuItems = document.getElementById("menuItems");
	menuItems.style.maxHeight = "0px"
	function menutoggle(){
		if(menuItems.style.maxHeight == "0px"){
			menuItems.style.maxHeight = "390px";
		}
		else{
			menuItems.style.maxHeight = "0px";
		}
	}
</script>

<!-- js for pop up -->
<script>

	document.getElementById('pop-up').addEventListener('click', function() {
				document.querySelector('.bg-modal').style.display = 'flex';
		});

	document.querySelector('.close').addEventListener('click', function(){
			document.querySelector('.bg-modal').style.display = 'none';
		});

</script>
<!-- end of js for pop up -->

<?php require APPROOT . '/views/includes/footer.php'; ?>


