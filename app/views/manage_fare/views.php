<!DOCTYPE html>
<html>
<head>
	<title>View Fare Details</title>
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
                <div class="container-table">
                    <h2 style="color: #13406d;">Fare Details </h2>
                    <table class="data-display" action="<?php echo URLROOT; ?>/manage_fare/views/<?php echo $data['manage_fare']->rateID?>" method = "POST">
                        <tr>
                            <td >Rate ID: </td>
                            <td><?php echo $data['manage_fare']->rateID?></td>
                            <td colspan="2"></td>
                        </tr>
                        <tr>
                            <td >First Class Base: </td>
                            <td><?php echo $data['manage_fare']->fclassbase?></td>
                            <td colspan="2"></td>
                        </tr>
                        <tr>
                            <td>Second Class Base: </td>
                            <td><?php echo $data['manage_fare']->sclassbase?></td>
                            <td colspan="2"></td>
                        </tr>
                        <tr>
                            <td>Third Class Base: </td>
                            <td><?php echo $data['manage_fare']->tclassbase?></td>
                            <td colspan="2"></td>
                        </tr>
                        <tr>
                            <td >Distance: </td>
                            <td><?php echo $data['manage_fare']->distance?></td>
                            <td colspan="2"></td>
                        </tr>
                        <tr>
                            <td >Rate: </td>
                            <td><?php echo $data['manage_fare']->rate?></td>
                            <td colspan="2"></td>
                        </tr>
                    </table>
                    <button type="button" onclick="history.go(-1);" class="back-btn" value="Back">Back</button>
                </div>
            </div>
        </div>
<?php
    require APPROOT.'/views/includes/footer.php';
?>