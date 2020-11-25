<?php
    require APPROOT.'/views/includes/resofficer_head.php';
?>
<?php
    require APPROOT.'/views/includes/resofficer_navigation.php';
?>


<div class="body-section">
        <div class="content-flexrow">
            <div class="container-table">
                <div class="container-row">
                    <img src="<?php echo URLROOT;?>/public/img/account.PNG" alt="account-image">
                </div>
                <h2 style="color: #13406d; text-align: center;">Account Details </h2>
                <table class="data-display">
                    <caption>Reservation Officer Details</caption>
                    <tr>
                        <td>Officer ID: </td>
                        <td><?php echo $data['resofficer']->officerId;?></td>
                        <td colspan="2"></td>
                    </tr>
                    <tr>
                        <td>Employee ID: </td>
                        <td><?php echo $data['resofficer']->employeeId;?></td>
                        <td colspan="2"></td>
                    </tr>
                    <tr>
                        <td>Reservation Officer Name: </td>
                        <td><?php echo $data['resofficer']->firstname.' '.$data['resofficer']->lastname;?></td>
                        <td colspan="2"></td>
                    </tr>
                    <tr>
                        <td>Email: </td>
                        <td><?php echo $data['resofficer']->email;?></td>
                        <td colspan="2"></td>
                    </tr>
                    <tr>
                        <td>Mobile No: </td>
                        <td><?php echo $data['resofficer']->mobileno;?></td>
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