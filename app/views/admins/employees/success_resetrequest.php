<?php
    require APPROOT .'/views/includes/moderator_head.php';
?>
<?php
    require APPROOT.'/views/includes/admin_navigation.php';
?>

<div class="body-section">
    <div class="content-flexrow">
            <div class="container-table">
                <div class="container-row">
                    <img src="<?php echo URLROOT;?>/public/img/resetPassword.png" alt="account-image">
                </div>
                <h2 style="color: #13406d; text-align: center;">Employee Password Reset</h2>
                <table class="data-display">
                    <caption>Password successfully updated!</caption>
                    <tr>
                        <td>User ID: </td>
                        <td><?php echo $data['userId'];?></td>
                        <td>User Email: </td>
                        <td><?php echo $data['userEmail'];?></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td colspan="2">Password was updated and the reset link was sent successfully to the employee's email.</td>
                        <td></td>
                    </tr>

                </table>
                <form action="#">
                    <div class="formrow submit-btn">
                        <div class="input-data action">
                            <input type="button" onclick="location.href='<?php echo $data['redirect'];?>'" class="blue-btn" value="Proceed">
                        </div>
                    </div>
                </form>
            </div>
    </div>
</div>



<?php
    require APPROOT. '/views/includes/footer.php';
?>
