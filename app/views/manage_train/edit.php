<!DOCTYPE html>
<html>
<head>
	<title>Update Train Details</title>
	<meta name="viewport" content="width-device-width, intial-scale=1.0">
	<link rel="stylesheet" href="<?php echo URLROOT ?>/public/css/ddd.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <script  src="http://code.jquery.com/jquery-3.5.1.js"></script>
        <script>
            $(document).ready(function(){
                $('#icon').click(function(){
                    $('ul').toggleClass('show');
                })
            })
        </script>
</head>
<body>
<?php
    require APPROOT.'/views/includes/manage_train_navigation.php';
?> 
    <div class="body-section">
        <div class="content-flexrow">
           <div class="container">
            <div class="text">Manage Trains<small>Update Train Details</small></div>
            <form action="<?php echo URLROOT; ?>/manage_train/edit/<?php echo $data['manage_train']->trainId?>" method ="POST">
                <div class="form-row">
                    <div class="input-data">
                        <label for="trainId">Train Id</label>
                        <input type="text" name="trainId" value="<?php echo $data['manage_train']->trainId?>" id="trainId" required >
                    </div>
                    <div class="input-data">
                        <label for="name">Name</label>
                        <input type="text" name="name" value="<?php echo $data['manage_train']->name?>" id="name" required >
                        <span class="invalidFeedback">
                            <?php echo $data['nameError'];?>
                        </span>
                    </div>
                </div>
                <div class="form-row">
                    <div class="input-data">
                        <label for="reservable_status">Reservable Status</label>
                        <input type="text" name="reservable_status" value="<?php echo $data['manage_train']->reservable_status?>" id="reservable_status" required >
                        <span class="invalidFeedback">
                            <?php echo $data['reservable_statusError'];?>
                        </span>
                    </div>
                    <div class="input-data">
                        <label for="type">Type</label>
                        <input type="text" name="type" value="<?php echo $data['manage_train']->type?>" id="type" required >
                        <span class="invalidFeedback">
                            <?php echo $data['typeError'];?>
                        </span>
                    </div>
                </div>
                <div class="form-row">
                    <div class="input-data">
                        <label for="src_station">Source Station</label>
                        <input type="text" name="src_station" value="<?php echo $data['manage_train']->src_station?>" id="src_station" required >
                    </div>
                    <div class="input-data">
                        <label for="starttime">Start Time</label>
                        <input type="time" name="starttime" value="<?php echo $data['manage_train']->starttime?>" id="starttime" required >
                    </div>
                </div>
                <div class="form-row">
                    <div class="input-data">
                        <label for="dest_station">Destination</label>
                        <input type="text" name="dest_station" value="<?php echo $data['manage_train']->dest_station?>" id="dest_station" required >                       
                    </div>
                    <div class="input-data">
                        <label for="endtime">End Time</label>
                        <input type="time" name="endtime" value="<?php echo $data['manage_train']->endtime?>" id="endtime" required >
                    </div>
                </div>
                <div class="form-row">
                    <div class="input-data">
                        <label for="rateId">Rate ID</label>
                        <input type="text" name="rateId" value="<?php echo $data['manage_train']->rateId?>" id="rateId" required >                       
                    </div>
                </div>
                <div class="form-row submit-btn">
                    <div class="input-data">
                        <input type="submit" class="blue-btn" value="Update">
                    </div> 
                    <div class="input-data">
                        <input type="submit" class="blue-btn" value="Add New">
                    </div>   
                    <div class="input-data">
                        <input type="button" onclick="history.go(-1);" class="red-btn" value="Back">
                    </div>
                </div>
                <div class="form-row submit-btn">
                    <div class="input-data">
                        <input type="submit" class="blue-btn" value="Compartment">
                    </div>    
                    <div class="input-data">
                        <input type="submit" class="blue-btn" value="Days">
                    </div>
                    <div class="input-data">
                        <input type="submit" class="blue-btn" value="Schedule">
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<?php
    require APPROOT.'/views/includes/footer.php';
?>  