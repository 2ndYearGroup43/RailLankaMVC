<?php
    require APPROOT.'/views/includes/moderator_head.php';
?>
<?php
    require APPROOT.'/views/includes/moderator_navigation.php';
?>
<!-- <?php var_dump($_SESSION); ?> -->
<div class="body-section">
	<div class="content-row"></div>
    <div class="content-row">
	    <div class="container-table">
	        <h2>Journey Management <small>Driver Assignment</small></h2>
	        <table class="blue">
	        	<thead>
	                <tr>
	            	   <th>Journey ID</th>
	                	<th>Train ID</th>
	                    <th>Driver ID</th>
	                    <th>Journey Date</th>
	                    <th>Journey Status</th>
	                    <th>Assigned Date</th>
	                    <th>Assigned Time</th>
	                    <th>Moderator ID</th>
	                    <th>Manage</th>    
	                </tr>
	            </thead>
	            	<?php $count=0?>
                    <?php foreach ($data as $row):?>
	              	<tr>
	            	    <td data-th="Journey ID"><?php echo $row->journeyId;?></td>
	                    <td data-th="Train ID"><?php echo $row->trainId;?></td>
	                	<td data-th="Driver ID"><?php echo $row->driverId;?></td>
	                    <td data-th="Journey Date"><?php echo $row->date;?></td>
	                    <td data-th="Journey Status"><?php echo $row->journey_status;?></td>
	                    <td data-th="Assigned Date"><?php echo $row->assignment_date;?></td>
	                    <td data-th="Assigned Time"><?php echo $row->assignment_time;?></td>
	                    <td data-th="Moderator ID"><?php echo $row->moderatorId;?></td>
	                    <td data-th="Manage">
							<form action="#" method="POST">
								<button type="button" class="table-btn blue" onclick="">View</button>
								<a href="<?php echo URLROOT;?>/moderatorjourneys/updatejourney/<?php echo $row->journeyId.'/'.$row->driverId;?>" class="blue-btn">Edit</a>
								<input type="button" class="red-btn" value="Delete">
							</form>
                        </td>
	                </tr>
	               <?php $count++;?>    
                   <?php endforeach;?> 
	        </table> 
	    </div>       
    </div>
</div>
        

<?php
    require APPROOT.'/views/includes/footer.php';
?>