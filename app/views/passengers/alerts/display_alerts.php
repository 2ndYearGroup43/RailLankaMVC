<?php 

	//echo out databse info to the screen
	// foreach ($data['users'] as $user) {
	// 	echo "Information: " . $user->user_name . $user->user_email;
	// 	echo "<br>";
	// }
	
	// isPassenger();
	require APPROOT . '/views/includes/passenger_head.php';
	require APPROOT . '/views/includes/passenger_navigation.php';
?>

<!-- <?php var_dump($data['fields']); ?>  -->

<!-- display all alerts -->
	<div class="body-section">
		<div class="content-row">
		</div>
		<div class="content-row">
		</div>

		<div class="table-container">
			<!-- <div class="img-container">
				<img src="<?php echo URLROOT ?>/public/img/logoc.jpg">
			</div> -->
			<h1 class="title alert-title">Alerts</h1>

				<div class="row alerts-row">

					<?php if(isset($_SESSION['userid'])) : ?>
                    <div class="btn-group col-4" id="cng">
					  <button onclick="location.href='<?php echo URLROOT; ?>/passengerAccounts/displaySubscriptions'" class="blue-btn">My Alerts</button>
					  <button onclick="location.href='<?php echo URLROOT; ?>/passengerAlerts/search'" class="blue-btn">Subscribe</button>
					</div>
					<?php endif; ?>

					<!-- <div class="col"> -->

						 <div class="table-searchbar">
		                    <form action="<?php echo URLROOT?>/passengerAlerts/searchAlertsBy" method="POST">
		                    	 <span>
		                        	<select name="searchField" id="searchField">
		                            <?php foreach ($data['fields'] as $field ):?>
		                                <?php if($field->columns!='moderatorId' AND $field->columns!='time'):?>
		                                    <option value="<?php echo $field->columns?>"><?php echo $field->columns?></option>
		                                <?php endif;?>
		                            <?php endforeach;?>
		                        	</select>
		                        </span>
		                        <input type="text" placeholder="Search by" name=searchVal>
		                       
		                        <span>
		                        	<input type="submit" value=" " class="table-search-btn">
		                        </span>
		                        <span>
		                        	<i class="fa fa-search glyph"></i>
		                        </span>
		                    </form>
		                </div>

						<!-- <div class="alerts-wrapper">
						    <div class="alerts-search-box">
						        <div class="alerts-dropdown">
						        	<div class="default_option"><?php echo $data['fields'][0]->columns ?> 
						        	</div> 
								        <ul>
								        	<?php foreach ($data['fields'] AS $field): ?>
								        		<?php if ($field->columns!='moderatorId'):?>
									           		<li><?php echo $field->columns ?></li>
									           	<?php endif; ?>
									        <?php endforeach; ?>   	
								        </ul>
						        </div>
						      	<div class="search-field">
						        	<input type="text" class="alerts-input" placeholder="Search">
						        	<i class="fa fa-search"></i>
						      	</div>
						  	</div>
						</div> -->
					<!-- </div> -->
				
				</div>

				<table class="content-table">
					<thead>
						<tr>
							<th>AlertID</th>
							<th>TrainID</th>
							<th>Type</th>
							<th>Entered Date</th>
							<th>Entered Time</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($data['alerts'] as $row):?>
						<tr class="active-row">
							<td data-label="AlertID"><?php echo $row->alertId ?></td>
							<td data-label="TrainID"><?php echo $row->trainId ?></td>
							<?php if($row->type=="delayed"): ?>
								<td class="delayed-label" data-label="Type"><?php echo $row->type ?></td>
							<?php elseif($row->type=="cancelled"): ?>
								<td class="cancelled-label" data-label="Type"><?php echo $row->type ?></td>
							<?php elseif($row->type=="rescheduled"): ?>
								<td class="rescheduled-label" data-label="Type"><?php echo $row->type ?></td>
							<?php endif; ?>
							<td data-label="Date"><?php echo $row->date ?></td>
							<td data-label="Time"><?php echo $row->time ?></td>
							<td>
								<button type="submit" id="<?php echo $row->alertId; ?>" class="btn pop-up"><span>View Details</span></button>
							</td>
						</tr>
						<?php endforeach;?>
					</tbody>
				</table>
				<br>
				<div class="pagination">
					<ul>
						<li>
							<?php if($data['start']==0) : ?>
								<a href="<?php echo URLROOT; ?>/passengerAlerts/displayAlerts?page=1" class="prev">Prev</a>
							<?php else : ?>
								<a href="<?php echo URLROOT; ?>/passengerAlerts/displayAlerts?page=<?php echo $data['page']-1; ?>" class="prev">Prev</a>
							<?php endif; ?>

						</li>
						<?php for($page=1;$page<=$data['totalPages'];$page++) {

							if($data['page']==$page)
							{

								echo '<li class="pageNumber active"><a href="'. URLROOT . '/passengerAlerts/displayAlerts?page=' . $page . '">' . $page . '</a></li>';
							}
							else {
								echo '<li class="pageNumber"><a href="'. URLROOT . '/passengerAlerts/displayAlerts?page=' . $page . '">' . $page . '</a></li>';
							}
						}
						?>
						<li>
							<?php if($data['page']==$data['totalPages']) : ?>
								<a href="#" class="next">Next</a>
							<?php else : ?>
								<a href="<?php echo URLROOT; ?>/passengerAlerts/displayAlerts?page=<?php echo $data['page']+1; ?>" class="prev">Next</a>
							<?php endif; ?>
						</li>
					</ul>
				</div>
				<br>			
			</div>
		<div class="content-row">
		</div>
		<div class="content-row">
		</div>
	</div>
	<!-- end of display all alerts -->

	<!-- pop up -->
	<div class="bg-modal">
		<div class="modal-content">
			<div class="close">+</div>
			<div class="notices-container">
			<div class="img-container">
					<img src="<?php echo URLROOT ?>/public/img/logoc.jpg">
			</div>  
			<h2 class="title">Alert Details</h2>
				<table class="content-table" id="details">
				</table>
			</div>
		</div>
	</div>
	<!-- end of pop up -->

	
	<!-- js for pop up -->
	<script>

		$('.pop-up').bind('click', function() {
			var alert_id = $(this).attr("id");

			$.ajax({
				url:"<?php echo URLROOT; ?>/passengerAlerts/displayAlertDetails",
				type:"POST",
				data: {'alertid':alert_id},
				success: function(returndata){
					$('#details').html(returndata);
					document.querySelector('.bg-modal').style.display = 'flex';
				},
				error: function(){
					alert('error');
				},
				beforeSend: function(){
					//alert("Alert showing before AJAX call");
				},
				complete: function(){
					//alert("Alert showing after AJAX call completion");
				}
			})
			
		});

		document.querySelector('.close').addEventListener('click', function(){
			document.querySelector('.bg-modal').style.display = 'none';
		});

	</script>
	<!-- end of js for pop up -->


	<!-- js for pagination --> 
	<script>
		$(document).ready(function(){
			$('.next').click(function(){
				$('.pagination').find('.pageNumber.active').next().addClass('active');
				$('.pagination').find('.pageNumber.active').prev().removeClass('active');
			});
			$('.prev').click(function(){
				$('.pagination').find('.pageNumber.active').prev().addClass('active');
				$('.pagination').find('.pageNumber.active').next().removeClass('active');
			});
		});
	</script>
	<!-- end of js for pagination -->

	<!-- js for dropdown -->
	<script type="text/javascript">
		$(document).ready(function(){
			$(".default_option").click(function(){
				$(".alerts-dropdown ul").toggleClass("active");
			});
			$(".alerts-dropdown ul li").click(function(){
				var text = $(this).text();
				$(".default_option").text(text);
				$(".alerts-dropdown ul").removeClass("active");
			});
		});
	</script>

	

	<!-- end of js for drop down -->

<?php require APPROOT . '/views/includes/passenger_footer.php'; ?>