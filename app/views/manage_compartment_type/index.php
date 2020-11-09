<!DOCTYPE html>
<html>
<head>
	<title>Manage Compartment Types</title>
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
            <div class="content-row"></div>
            <div class="content-row">
                <div class="container-table">
                    <h2>Manage Compartment Type</h2>
                    <a class= "blue-btn" href="<?php echo URLROOT; ?>/manage_compartment_type/create">Add New Compartment Type</a>
                    <table class="blue">
                        <thead>
                            <tr>
                                <th>Type No</th>
                                <th>Manage</th>    
                            </tr>
                        </thead>
                        <?php foreach($data['manage_compartment_type'] as $post):?>
                        <tr>
                            <td data-th="Type"><?php echo $post->typeNo?></td>
                            <td data-th="Manage">
                            <a class= "blue-btn" href="<?php echo URLROOT . "/manage_compartment_type/views/" . $post->typeNo?>">View</a>
                            <a class= "blue-btn" href="<?php echo URLROOT . "/manage_compartment_type/edit/" . $post->typeNo?>">Edit</a>
                            <form action="<?php echo URLROOT . "/manage_compartment_type/delete/" . $post->typeNo?>" method="POST">
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