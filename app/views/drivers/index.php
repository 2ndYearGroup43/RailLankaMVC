<?php 

	//echo out databse info to the screen
	// foreach ($data['users'] as $user) {
	// 	echo "Information: " . $user->user_name . $user->user_email;
	// 	echo "<br>";
	// }
	
	isDriver();
	require APPROOT . '/views/includes/passenger_head.php';
	require APPROOT . '/views/includes/passenger_navigation.php';
?>

<?php var_dump($_SESSION); ?> 


<!-- banner area -->
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

<!-- Schedule and reserve shortcuts -->
<div  class="container">	
	<div class="row">

		<!-- mini schedule -->
		<div class="notices-container col-4">
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
				
				<button class="btn">Go  <i class="fa fa-long-arrow-right"></i></button>
			</div>
		</div>
		<!-- end of mini schedule -->

		<!-- reserve shortcuts -->
		<div class="container col-3">
			<section id="carousel">
				<div class="slideshow">
					<div class="slideshow-item">
						<img src="<?php echo URLROOT ?>/public/images/bookmark1.jpg">
						<div class="slideshow-item-text">
							<h3>COLOMBO-KANDY</h3>
							<!-- <p>The three-hour trip from Colombo to Kandy will whisk you away from the big city sprawl to the genteel greenery of Sri Lanka’s spiritual capital.</p> -->
							<button type="submit" class="btn">Reserve Now</button>
						</div>
					</div>
					<div class="slideshow-item">
						<img src="<?php echo URLROOT ?>/public/images/bookmark2.jpg">
						<div class="slideshow-item-text">
							<h3>COLOMBO-GALLE</h3>
							<!-- <p>Lorem Ipsum</p> -->
							<button type="submit" class="btn">Reserve Now</button>
						</div>
					</div>
					<div class="slideshow-item">
						<img src="<?php echo URLROOT ?>/public/images/bookmark3.jpg">
						<div class="slideshow-item-text">
							<h3>COLOMBO-JAFFNA</h3>
							<!-- <p>Lorem Ipsum</p> -->
							<button type="submit" class="btn">Reserve Now</button>
						</div>
					</div>
				</div>
			</section>
		</div>
		<!-- end of reserve shortcuts -->	
	</div>
</div>
<!-- end of schedule and reserve shorcuts -->



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

<?php require APPROOT . '/views/includes/footer.php'; ?>