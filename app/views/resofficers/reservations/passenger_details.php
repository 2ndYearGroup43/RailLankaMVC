<?php
    require APPROOT.'/views/includes/resofficer_head.php';
?>
<?php
    require APPROOT.'/views/includes/resofficer_navigation.php';
?>
<div class="body-section">
        <div class="content-flexrow">
            <div class="container">
            <div class="text" style="color: #13406d;">Reservations <small style="color: black;">Passenger Details</small></div>
            <form action="#">
                <div class="form-row">
                    <div class="input-data">
                        <label for="nic">NIC</label>
                        <input type="text" name="nic" id="nic" required >
                    </div>
                    <div class="input-data">
                        <label for="password">Password</label>
                        <input type="text" name="password" id="password" required >
                    </div>
                </div>
                <div class="form-row">
                    <div class="input-data">
                        <label for="fname">First Name</label>
                        <input type="text" name="fname" id="fname" required >
                    </div>
                    <div class="input-data">
                        <label for="lname">Last Name</label>
                        <input type="text" name="lname" id="lname" required >
                    </div>
                </div>
                <div class="form-row">
                    <div class="input-data">
                        <label for="email">Email</label>
                        <input type="email" id="email" required >
                    </div>
                    <div class="input-data">
                        <label for="mobile">Mobile-No</label>
                        <input type="mobile" id="mobile" placeholder="+94 ** *** *****" required >
                    </div>
                </div>
                <div class="form-row">
                    <div class="input-data">
                         <label for="address_number">Address Number</label>
                         <input type="text" name="address_number" id="address_number" required>
                    </div>
                    <div class="input-data">
                        <label for="street">Street</label>
                        <input type="text" name="street" id="street" required>
                   </div>
                </div>
                <div class="form-row">
                    <div class="input-data">
                         <label for="city">City</label>
                         <input type="text" name="city" id="city" required>
                    </div>
                    <div class="input-data">
                        <label for="country">Country</label>
                        <input type="text" name="country" id="country" required>
                   </div>
                </div>
                <div class="form-row submit-btn">
                    <div class="input-data">
                        <a class= "blue-btn" href="<?php echo URLROOT; ?>/resofficerReservations/displayETicket" style="padding-left: 70px;">Reserve</a>
                    </div>     
                </div>
            </form>
        </div>
    </div>
</div>
<?php
    require APPROOT.'/views/includes/footer.php';
?>

