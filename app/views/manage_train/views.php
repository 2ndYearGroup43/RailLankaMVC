<!DOCTYPE html>
<html>
<head>
	<title>View Train Details</title>
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
                    <h2 style="color: #13406d;">Train Details </h2>
                    <table class="data-display" action="<?php echo URLROOT; ?>/manage_train/views/<?php echo $data['manage_ro']->officerId?>" method = "POST">
                        <tr>
                            <td >Train ID: </td>
                            <td><?php echo $data['manage_train']->trainId?></td>
                            <td colspan="2"></td>
                        </tr>
                        <tr>
                            <td >Train Name: </td>
                            <td><?php echo $data['manage_train']->name?></td>
                            <td colspan="2"></td>
                        </tr>
                        <tr>
                            <td>Reservable Status: </td>
                            <td><?php echo $data['manage_train']->reservable_status?></td>
                            <td colspan="2"></td>
                        </tr>
                        <tr>
                            <td>Type: </td>
                            <td><?php echo $data['manage_train']->type?></td>
                            <td colspan="2"></td>
                        </tr>
                        <tr>
                            <td >Source Station: </td>
                            <td><?php echo $data['manage_train']->src_station?></td>
                            <td colspan="2"></td>
                        </tr>
                        <tr>
                            <td >Start Time: </td>
                            <td><?php echo $data['manage_train']->starttime?></td>
                            <td colspan="2"></td>
                        </tr>
                        <tr>
                            <td >Destination: </td>
                            <td><?php echo $data['manage_train']->dest_station?></td>
                            <td colspan="2"></td>
                        </tr>
                        <tr>
                            <td >End Time: </td>
                            <td><?php echo $data['manage_train']->endtime?></td>
                            <td colspan="2"></td>
                        </tr>
                        <tr>
                            <td >Rate ID: </td>
                            <td><?php echo $data['manage_train']->rateId?></td>
                            <td colspan="2"></td>
                        </tr>
                        <tr>
                            <td >Entered Date: </td>
                            <td><?php echo $data['manage_train']->entered_date?></td>
                            <td colspan="2"></td>
                        </tr>
                        <tr>
                            <td >Entered Time: </td>
                            <td><?php echo $data['manage_train']->entered_time?></td>
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