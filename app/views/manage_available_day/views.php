<?php
    require APPROOT.'/views/includes/head.php';
?>
<?php
    require APPROOT.'/views/includes/train_management.php';
?> 
<div class="body-section">
            <div class="content-flexrow">
                <div class="container-table">
                    <h2 style="color: #13406d;">Manage Trains <small style="color: black;">View Available Days</small></h2>
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