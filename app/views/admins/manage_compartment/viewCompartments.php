<?php
    require APPROOT.'/views/includes/resofficer_head.php';
?>
<?php
    require APPROOT.'/views/includes/admin_navigation.php';
?>  
	<div class="body-section">
            <div class="content-row"></div>
            <div class="content-row">
                <div class="container-table">
                    <h2 style="color: #13406d;">Manage Trains <small style="color: black;">Manage Compartments</small></h2>
                    <a class= "blue-btn" href="<?php echo URLROOT; ?>/Admin_manage_compartments/addNewCompartment/<?php echo $data['trainId'];?>">Add New Compartment</a>
                    <table class="blue">
                        <thead>
                            <tr>
                                <th>Train ID</th>
                                <th>Compartment No</th>
                                <th>Class</th>
                                <th>No of Seats</th>
                                <th>Type</th>
                                <th>Manage</th>    
                            </tr>
                        </thead>
                        <?php foreach($data['compartments'] as $compartment):?>
                        <tr>
                            <td data-th="Train ID"><?php echo $compartment->trainId?></td>
                            <td data-th="Compartment No"><?php echo $compartment->compartmentNo?></td>
                            <td data-th="Class"><?php echo $compartment->class?></td>
                            <td data-th="No of Seats"><?php echo $compartment->noofseats?></td>
                            <td data-th="Type"><?php echo $compartment->type?></td>
                            <td data-th="Manage">
                            <form action="<?php echo URLROOT . "/Admin_manage_compartments/delete/" . $compartment->compartmentNo?>/<?php echo $compartment->trainId?>" method="POST">    
                            <a class= "blue-btn" href="<?php echo URLROOT . "/Admin_manage_compartments/views/" . $compartment->trainId?>">View</a>
                            <a class= "blue-btn" href="<?php echo URLROOT . "/Admin_manage_compartments/editSingle/" . $compartment->trainId?>/<?php echo $compartment->compartmentNo?>">Edit</a>
                            <input type="submit" name="delete" value="Remove" class="red-btn">
                            </form></td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                    <button type="button" onclick="history.go(-1);" class="back-btn" value="Back">Back</button>             </div>
            </div>
        </div>
<?php
    require APPROOT.'/views/includes/footer.php';
?>