<?php 
	
	isPassenger();
	require APPROOT . '/views/includes/passenger_head.php';
	require APPROOT . '/views/includes/passenger_navigation.php';
?>

<!-- reserve shortcuts -->
<section id="nback" >
		<div class="row">
			<div  class="col-l">
				<section id="carousel">
					<div class="slide-holder">
					<div class="slideshow">
						<input type="radio" name="r" id="r1" checked>
						<input type="radio" name="r" id="r2">
						<input type="radio" name="r" id="r3">
						<input type="radio" name="r" id="r4">
						<div class="slideshow-item s1">
							<img src="<?php echo URLROOT ?>/public/img/bookmark4.jpg">
						</div>
						<div class="slideshow-item">
							<img src="<?php echo URLROOT ?>/public/img/bookmark1.jpg">
						</div>
						<div class="slideshow-item">
							<img src="<?php echo URLROOT ?>/public/img/bookmark2.jpg">
						</div>
						<div class="slideshow-item">
							<img src="<?php echo URLROOT ?>/public/img/bookmark3.jpg">
							<div class="slideshow-item-text">
								<h3>EXPLORE SRI LANKA ON RAILS</h3>
								<p>From the big city sprawl to the genteel greenery of the Sri Lankan landscape. Don't miss out on these epic train journeys!</p>
								<button onclick="location.href='<?php echo URLROOT; ?>/passengerReservations/search'" type="submit" class="btn">Reserve Now</button>
							</div>
						</div>
						<div class="navigation">
						<label for="r1" class="bar"></label>
						<label for="r2" class="bar"></label>
						<label for="r3" class="bar"></label>
						<label for="r4" class="bar"></label>
					</div>
					</div>
				</div>
				</section>
			</div>
		</div>
	<!-- </div> -->
</section>
<!-- end of reserve shortcuts -->

<!-- Quick search view -->
<section id="notices-section">
	<div class="leftbox">
		<div class="content">
			<div class="mini-schedule">
				<h2 class="title" id="title3">SEARCH TRAIN</h2>
				<form action="<?php echo URLROOT;?>/passengerSchedules/search?>" method="post">
					<div class="form-row">
						<div class="mini-input-data">
							<label for="source">From</label>
		                    <select name="source" id="source">
		                    	<?php foreach ($data['stations'] as $station): ?>
		                        	<option value="<?php echo $station->stationName; ?>"><?php echo $station->stationName; ?></option>
		            			<?php endforeach; ?>
		                    </select>
						</div>
						<div class="mini-input-data">
							<label for="destination">To</label>
		                    <select name="destination" id="destination">
		                      	<?php foreach ($data['stations'] as $station): ?>
		                        	<option value="<?php echo $station->stationName; ?>"><?php echo $station->stationName; ?></option>
		            			<?php endforeach; ?>
		                    </select>
		                </div>	
					</div>
					<div class="form-row">
						<div class="mini-input-data">
							<label for="date">Date</label>
		                  	<input type="date" name="date" id="date" required>
		                </div>
					</div>
					<div class="form-row">
						<div class="mini-input-data">
							<label for="time">Time</label>
		                    <input type="time" name="time" id="time" required>
		                </div>
					</div>
					<button type="submit" id="view-all">Go <i class="fa fa-long-arrow-right"></i></button>
				</form>
			</div>
		</div>
	</div>
	<!-- end of quick search -->

	<!-- display of latest notices -->
	<div class="events">
		<h1>NOTICES</h1>
		<ul>
			<?php foreach ($data['notices'] as $row):?>
			<li>
				<div class="time">
					<h2><?php echo date('d', strtotime($row->entered_date)); ?><br><span><?php echo date('F', strtotime($row->entered_date)); ?></span></h2>
				</div>
				<div class="time-details">
					<h3><?php echo $row->title; ?></h3>
					<a id="<?php echo $row->noticeId; ?>" class="pop-up" href="#">
						<p>Read More <i class="fa fa-angle-double-right"></i></p>
					</a>
				</div>
				<div style="clear: both;"></div>
			</li>
			<?php endforeach;?>
		</ul>
		<a href="<?php echo URLROOT; ?>/pages/notices" id="view-all">View All <i class="fa fa-long-arrow-right"></i></a>
	</div>
	<!-- end of display of latest notices -->
</section>

	<!-- notice pop up -->
	<div class="bg-modal" id="front-page">
		<div class="modal-content">
			<div class="close">+</div>
			<div class="notices-container">
			<div class="img-container">
					<img src="<?php echo URLROOT ?>/public/img/logoc.jpg">
			</div>  
			<h2 class="title">Notice</h2>
				<table class="content-table" id="details">
				</table>
			</div>
		</div>
	</div>
	<!-- end of notice pop up -->

	
	<!-- js for notice pop up -->
	<script>

		$('.pop-up').bind('click', function() {
			var notice_id = $(this).attr("id");

			$.ajax({
				url:"<?php echo URLROOT; ?>/pages/displayNoticeDetails",
				type:"POST",
				data: {'noticeid':notice_id},
				success: function(returndata){
					$('#details').html(returndata);
					document.querySelector('.bg-modal').style.display = 'flex';
				},
				error: function(){
					alert('error');
				}
			})
			
		});

		document.querySelector('.close').addEventListener('click', function(){
			document.querySelector('.bg-modal').style.display = 'none';
		});

	</script>
	<!-- end of js for notice pop up -->

<?php require APPROOT . '/views/includes/passenger_footer.php'; ?>


