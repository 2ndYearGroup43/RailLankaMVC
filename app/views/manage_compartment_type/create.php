<!DOCTYPE html>
<html>
<head>
	<title>Add New Compartment Type</title>
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
                    <div class="text">Compartment Type Form</div>
                        <form action="<?php echo URLROOT; ?>/manage_compartment_type/create" method = "POST">
                            <div class="form-row">
                                <div class="input-data">
                                    <label for="typeNo">Type No</label>
                                    <input type="text" name="typeNo" id="typeNo" required >
                                    <span class="invalidFeedback">
                                        <?php echo $data['typeNoError'];?>
                                    </span>
                                </div>
                            </div>
                            <div class="form-row submit-btn">
                                <div class="input-data">
                                    <input type="submit" class="blue-btn" name="submit" value="ADD Type">
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