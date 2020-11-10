<!DOCTYPE html>
<html>
<head>
	<title>Manage Available Days</title>
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
    require APPROOT.'/views/includes/manage_compartment_navigation.php';
?>    
        <div class="body-section">
            <div class="content-flexrow">
                <div class="container">
                    <div class="text">Manage Available Days</div>
                         <form action="<?php echo URLROOT; ?>/manage_available_day/edit/<?php echo $data['manage_available_day']->trainId?>" method = "POST">
                            <div class="form-row">
                                <div class="input-data">
                                    <label for="trainId">Train Id</label>
                                    <input type="text" name="trainId" value="<?php echo $data['manage_available_day']->trainId?>" id="trainId" required >
                                    <span class="invalidFeedback">
                                        <?php echo $data['trainIdError'];?>
                                    </span>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="input-data">
                                    <input type="hidden" name="sunday" value="No">
                                    <input type="checkbox" name="sunday" value="Yes">
                                    <label for="sunday">Sunday</label>
                                    <span class="fa fa-check"></span>
                                </div>
                                <div class="input-data">
                                    <input type="hidden" name="monday" value="No">
                                    <input type="checkbox" name="monday" value="Yes">
                                    <label for="monday">Monday</label>
                                    <span class="fa fa-check"></span>
                                </div>
                                <div class="input-data">
                                    <input type="hidden" name="tuesday" value="No">
                                    <input type="checkbox" name="tuesday" value="Yes">
                                    <label for="tuesday">Tuesday</label>
                                </div>
                                <div class="input-data">
                                    <input type="hidden" name="wednesday" value="No">
                                    <input type="checkbox" name="wednesday" value="Yes">
                                    <label for="wednesday">Wednesday</label>
                                </div>
                                <div class="input-data">
                                    <input type="hidden" name="thursday" value="No">
                                    <input type="checkbox" name="thursday" value="Yes">
                                    <label for="thursday">Thursday</label>
                                </div>
                                <div class="input-data">
                                    <input type="hidden" name="friday" value="No">
                                    <input type="checkbox" name="friday" value="Yes">
                                    <label for="friday">Friday</label>
                                </div>
                                <div class="input-data">
                                    <input type="hidden" name="saturday" value="No">
                                    <input type="checkbox" name="saturday" value="Yes">
                                    <label for="saturday">Saturday</label>
                                </div>
                                </div>
                                <div class="form-row submit-btn">
                                    <div class="input-data">
                                        <input type="submit" class="blue-btn" name="submit" value="Update Days">
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