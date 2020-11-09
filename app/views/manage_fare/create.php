<!DOCTYPE html>
<html>
<head>
	<title>Add Fare</title>
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
            <div class="text">Add Fare</div>
            <form action="<?php echo URLROOT; ?>/manage_fare/create" method = "POST">
                <div class="form-row">
                    <div class="input-data">
                        <label for="rateID">Rate ID</label>
                        <input type="text" name="rateID" id="rateID" required >
                        <span class="invalidFeedback">
                            <?php echo $data['rateIDError'];?>
                        </span>
                    </div>
                    <div class="input-data">
                        <label for="fclassbase">First Class Base</label>
                        <input type="text" name="fclassbase" id="fclassbase" required >
                        <span class="invalidFeedback">
                            <?php echo $data['fclassbaseError'];?>
                        </span>
                    </div>
                </div>
                <div class="form-row">
                    <div class="input-data">
                        <label for="sclassbase">Second Class Base</label>
                        <input type="text" name="sclassbase" id="sclassbase" required >
                        <span class="invalidFeedback">
                            <?php echo $data['sclassbaseError'];?>
                        </span>
                    </div>
                    <div class="input-data">
                        <label for="tclassbase">Third Class Base</label>
                        <input type="text" name="tclassbase" id="tclassbase" required >
                        <span class="invalidFeedback">
                            <?php echo $data['tclassbaseError'];?>
                        </span>
                    </div>
                </div>
                <div class="form-row">
                    <div class="input-data">
                        <label for="distance">Distance</label>
                        <input type="text" name="distance" id="distance" required >
                        <span class="invalidFeedback">
                            <?php echo $data['distanceError'];?>
                        </span>
                    </div>
                    <div class="input-data">
                        <label for="rate">Rate</label>
                        <input type="text" name="rate" id="rate" required >
                        <span class="invalidFeedback">
                            <?php echo $data['rateError'];?>
                        </span>
                    </div>
                </div>
                <div class="form-row submit-btn">
                    <div class="input-data">
                        <input type="submit" class="blue-btn" name="submit" value="Add Fare">
                    </div>    
                    <div class="input-data">
                        <input type="button" onclick="history.go(-1);" class="red-btn" value="Back">
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<?php
    require APPROOT.'/views/includes/footer.php';
?>  