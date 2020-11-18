<?php
   require APPROOT . '/views/includes/head.php';
?>


    <?php
       require APPROOT . '/views/includes/navigationadmin.php';
    ?>





<div class="body-section">

            <div class="content-row">
                <ul class="breadcrumb">
                    <li><a href="#">Home</a></li>
                    <li><u>Station Management</u></li>
                    <li><a href="<?php echo URLROOT; ?>/stations/manage_station">Manage Station</a></li>
                </ul>
            </div>

            

            <div class="content-row">
                <div class="container-table">
                    <h2>Station Management </h2>
                    <table class="blue">
                        <thead>
                            <tr>
                                <th>Station ID</th>
                                <th>Station name</th>
                                <th>Telephone Number</th>
                                <th>Type</th>
                                <th>Entered Date</th>
                                <th>Entered Time</th>
                                <th>Manage</th>    
                            </tr>
                        </thead>

                        <?php foreach ($data as $row):?>
	              	<tr>
	            	    <td data-th="Station ID"><?php echo $row->stationID;?></td>
	                    <td data-th="Station name"><?php echo $row->name;?></td>
	                	<td data-th="Telephone Number"><?php echo $row->telephoneNo;?></td>
	                    <td data-th="Type"><?php echo $row->type;?></td>
	                    <td data-th="Entered Date"><?php echo $row->entered_date;?></td>
	                    <td data-th="Entered Time"><?php echo $row->entered_time;?></td>
	                    <td data-th="Manage"><input type="submit" class="blue-btn" value="View"><input onclick="location.href='<?php echo URLROOT; ?>/stations/update_station' " type="submit" class="blue-btn" value="Edit"><input type="submit" class="red-btn" value="Delete"></td>
	                </tr>
	                
                   <?php endforeach;?>


                    </table> 
                </div>       
            </div>
        </div>


<?php
    require APPROOT . '/views/includes/footer.php';

?>



