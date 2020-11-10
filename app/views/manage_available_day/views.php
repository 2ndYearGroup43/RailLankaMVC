<!DOCTYPE html>
<html>
<head>
	<title>View Available Days</title>
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
                <div class="container-table">
                    <h2 style="color: #13406d;">Available Days</h2>
                    <table class="data-display" action="<?php echo URLROOT; ?>/manage_available_day/views/<?php echo $data['manage_available_day']->trainId?>" method = "POST">
                        <tr>
                            <td >Train ID : </td>
                            <td><?php echo $data['manage_available_day']->trainId?></td>
                            <td colspan="2"></td>
                        </tr>
                        <tr>
                            <td >Sunday : </td>
                            <td><?php echo $data['manage_available_day']->sunday?></td>
                            <td colspan="2"></td>
                        </tr>
                        <tr>
                            <td>Monday : </td>
                            <td><?php echo $data['manage_available_day']->monday?></td>
                            <td colspan="2"></td>
                        </tr>
                        <tr>
                            <td>Tuesday : </td>
                            <td><?php echo $data['manage_available_day']->tuesday?></td>
                            <td colspan="2"></td>
                        </tr>
                        <tr>
                            <td >Wednesday : </td>
                            <td><?php echo $data['manage_available_day']->wednesday?></td>
                            <td colspan="2"></td>
                        </tr>
                        <tr>
                            <td >Thursday : </td>
                            <td><?php echo $data['manage_available_day']->thursday?></td>
                            <td colspan="2"></td>
                        </tr>
                        <tr>
                            <td >Friday : </td>
                            <td><?php echo $data['manage_available_day']->friday?></td>
                            <td colspan="2"></td>
                        </tr>
                        <tr>
                            <td >Saturday : </td>
                            <td><?php echo $data['manage_available_day']->saturday?></td>
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