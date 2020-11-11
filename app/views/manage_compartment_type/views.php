<?php
    require APPROOT.'/views/includes/head.php';
?>
<?php
    require APPROOT.'/views/includes/train_management.php';
?> 
<div class="body-section">
            <div class="content-flexrow">
                <div class="container-table">
                    <h2 style="color: #13406d;">Manage Trains <small style="color: black;">View Compartment Type Details</small></h2>
                    <table class="data-display" action="<?php echo URLROOT; ?>/manage_compartment_type/views/<?php echo $data['manage_compartment_type']->typeNo?>" method = "POST">
                        <tr>
                            <td >Type No: </td>
                            <td><?php echo $data['manage_compartment_type']->typeNo?></td>
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