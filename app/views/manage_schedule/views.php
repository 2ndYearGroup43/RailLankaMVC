<!DOCTYPE html>
<html>
<head>
	<title>View Schedule Details</title>
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
    require APPROOT.'/views/includes/manage_schedule_navigation.php';
?>
<div class="body-section">
            <div class="content-flexrow">
                <div class="container-table">
                    <h2 style="color: #13406d;">Schedule Details </h2>
                    <table class="data-display" action="<?php echo URLROOT; ?>/manage_schedule/views/<?php echo $data['manage_schedule']->routeId?>" method = "POST">
                        <tr>
                            <td >Train ID: </td>
                            <td><?php echo $data['manage_schedule']->routeId?></td>
                            <td colspan="2"></td>
                        </tr>
                        <tr>
                            <td >Compartment No: </td>
                            <td><?php echo $data['manage_schedule']->stationId?></td>
                            <td colspan="2"></td>
                        </tr>
                        <tr>
                            <td>Class: </td>
                            <td><?php echo $data['manage_schedule']->stopNo?></td>
                            <td colspan="2"></td>
                        </tr>
                        <tr>
                            <td>Number of Seats: </td>
                            <td><?php echo $data['manage_schedule']->arrivaltime?></td>
                            <td colspan="2"></td>
                        </tr>
                        <tr>
                            <td >Type: </td>
                            <td><?php echo $data['manage_schedule']->departuretime?></td>
                            <td colspan="2"></td>
                        </tr>
                        <tr>
                            <td >Type: </td>
                            <td><?php echo $data['manage_schedule']->date?></td>
                            <td colspan="2"></td>
                        </tr>
                        <tr>
                            <td >Type: </td>
                            <td><?php echo $data['manage_schedule']->distance?></td>
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