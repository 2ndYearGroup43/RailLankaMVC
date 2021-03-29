<?php 

	require APPROOT . '/views/includes/passenger_head.php';
	require APPROOT . '/views/includes/passenger_navigation.php';
?>

<!-- display all notices -->
	<div class="body-section">
		<div class="content-row">
		</div>
		<div class="content-row">
		</div>
		<div class="table-container">
			<h1 class="title">Notices</h1>
				<table class="content-table">
					<thead>
						<tr>
							<th>Notice ID</th>
							<th>Date</th>
							<th>Title</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach($data AS $row): ?>
						<tr class="active-row">
							<td data-label="Notice ID"><?php echo $row->noticeId; ?></td>
							<td data-label="Date"><?php echo $row->entered_date; ?></td>
							<td data-label="Title"><?php echo $row->title ?></td>
							<td>
								<button id="<?php echo $row->noticeId; ?>" type="submit" class="btn pop-up"><span>View Details</span></button>
							</td>
						</tr>
					<?php endforeach; ?>
					</tbody>
				</table>

			<button onclick="location.href='<?php echo URLROOT; ?>/pages/index'" type="submit" class="btn blue-btn back-btn">Back</button>	
		</div>
		<div class="content-row">
		</div>
		<div class="content-row">
		</div>
	</div>
	<!-- end of display all notices -->


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