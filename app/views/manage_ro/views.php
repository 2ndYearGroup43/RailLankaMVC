<!DOCTYPE html>
<html>
<head>
	<title>View Employee Details</title>
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
    require APPROOT.'/views/includes/manage_ro_navigation.php';
?>
<div class="body-section">
            <div class="content-flexrow">
                <div class="container-table">
                    <h2 style="color: #13406d;">Employee Details <small style="color: black;">Reservation Officer </small></h2>
                    <table class="data-display" action="<?php echo URLROOT; ?>/manage_ro/views/<?php echo $data['manage_ro']->officerId?>" method = "POST">
                        <caption>Recervation Officer Details</caption>
                        <tr>
                            <td >Recervation Officer ID: </td>
                            <td><?php echo $data['manage_ro']->officerId?></td>
                            <td colspan="2"></td>
                        </tr>
                        <tr>
                            <td >Employee ID: </td>
                            <td><?php echo $data['manage_ro']->employeeId?></td>
                            <td colspan="2"></td>
                        </tr>
                        <tr>
                            <td>Recervation Officer Name: </td>
                            <td><?php echo $data['manage_ro']->firstname?></td>
                            <td colspan="2"></td>
                        </tr>
                        <tr>
                            <td>Recervation Officer Name: </td>
                            <td><?php echo $data['manage_ro']->lastname?></td>
                            <td colspan="2"></td>
                        </tr>
                        <tr>
                            <td >Email: </td>
                            <td><?php echo $data['manage_ro']->email?></td>
                            <td colspan="2"></td>
                        </tr>
                        <tr>
                            <td >Mobile No: </td>
                            <td><?php echo $data['manage_ro']->mobileno?></td>
                            <td colspan="2"></td>
                        </tr>
                        <tr>
                            <td >Registered Date: </td>
                            <td><?php echo $data['manage_ro']->reg_date?></td>
                            <td colspan="2"></td>
                        </tr>
                        <tr>
                            <td >Registered Time: </td>
                            <td><?php echo $data['manage_ro']->reg_time?></td>
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