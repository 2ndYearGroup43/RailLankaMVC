<!DOCTYPE html>
<html>
<head>
	<title>Train Management</title>
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
            <div class="content-row"></div>
            <div class="content-row">
                <div class="container-table">
                    <h2>Train Management</h2>
                    <a class= "blue-btn" href="<?php echo URLROOT; ?>/manage_train/create">Add New Train</a>
                    <table class="blue">
                        <thead>
                            <tr>
                                <th>Train ID</th>
                                <th>Name</th>
                                <th>Reservable Status</th>
                                <th>Type</th>
                                <th>Source</th>
                                <th>Start Time</th>
                                <th>Destination</th>
                                <th>End Time</th>
                                <th>Rate ID</th>
                                <th>Manage</th>    
                            </tr>
                        </thead>
                        <?php foreach($data['manage_train'] as $post):?>
                        <tr>
                            <td data-th="Train ID"><?php echo $post->trainId?></td>
                            <td data-th="Name"><?php echo $post->name?></td>
                            <td data-th="Reservable Status"><?php echo $post->reservable_status?></td>
                            <td data-th="Type"><?php echo $post->type?></td>
                            <td data-th="Source"><?php echo $post->src_station?></td>
                            <td data-th="Start Time"><?php echo $post->starttime?></td>
                            <td data-th="Destination"><?php echo $post->dest_station?></td>
                            <td data-th="End Time"><?php echo $post->endtime?></td>
                            <td data-th="Rate ID"><?php echo $post->rateId?></td>
                            <td data-th="Manage">
                            <a class= "blue-btn" href="<?php echo URLROOT . "/manage_train/views/" . $post->trainId?>">View</a>
                            <a class= "blue-btn" href="<?php echo URLROOT . "/manage_train/edit/" . $post->trainId?>">Edit</a>
                            <form action="<?php echo URLROOT . "/manage_train/delete/" . $post->trainId?>" method="POST">
                            <input type="submit" name="delete" value="Remove" class="red-btn-r">
                            </form></td>
                        </tr>
                        <?php endforeach; ?>
                    </table>                                
                </div>
            </div>
        </div>

<?php
    require APPROOT.'/views/includes/footer.php';
?>	