<?php isModeratorLoggedIn(); ?>
<?php
    require APPROOT.'/views/includes/moderator_head.php';
?>
<?php
    require APPROOT.'/views/includes/moderator_navigation.php';
    var_dump($data);
?>


<div class="body-section">
        <div class="content-flexrow">
            <div class="container-table">
                <h2 style="color: #13406d;">Account Details <small style="color: black;">Moderator Id: <?php echo $data['moderator']->moderatorId;?></small></h2>
                <table class="data-display">
                    <caption>Moderator Details</caption>
                    <tr>
                        <td>Moderator ID: </td>
                        <td><?php echo $data['moderator']->moderatorId;?></td>
                        <td colspan="2"></td>
                    </tr>
                    <tr>
                        <td>Employee ID: </td>
                        <td><?php echo $data['moderator']->employeeId;?></td>
                        <td colspan="2"></td>
                    </tr>
                    <tr>
                        <td>Moderator Name: </td>
                        <td><?php echo $data['moderator']->firstname.' '.$data['moderator']->lastname;?></td>
                        <td colspan="2"></td>
                    </tr>
                    <tr>
                        <td>Email: </td>
                        <td><?php echo $data['moderator']->email;?></td>
                        <td colspan="2"></td>
                    </tr>
                    <tr>
                        <td>Mobile No: </td>
                        <td><?php echo $data['moderator']->mobileno;?></td>
                        <td colspan="2"></td>
                    </tr>
                </table>
                <form action="#">
                    <div class="formrow submit-btn">
                        <div class="input-data action">
                            <input type="button" onclick="history.go(-1)" class="red-btn" value="Back">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>