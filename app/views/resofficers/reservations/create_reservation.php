<?php
    require APPROOT.'/views/includes/resofficer_head.php';
?>
<?php
    require APPROOT.'/views/includes/resofficer_navigation.php';
?>
<div class="body-section">
        <div class="content-flexrow">
            <div class="container">
            <h2 style="color: #13406d;">Reservations <small style="color: black;">Create Reservation</small></h2>
            <form action="<?php echo URLROOT; ?>/ResOfficerReservations/createReservation/<?php echo $data['train']->trainId?>/<?php echo $data['journeyDate']?>" method = "POST">
                <div class="form-row">    
                    <div class="searchlogo">
                        <img src="<?php echo URLROOT ?>/public/img/logob2.png">
                    </div>
                </div>
                <div class="form-row">                   
                    <div class="input-data">
                        <label for="nic">NIC</label>
                        <input type="text" name="nic" id="nic" required >
                    </div>                   
                </div>
                <div class="form-row">                   
                    <div class="input-data">
                        <label for="email">Email</label>
                        <input type="Email" name="email" id="email" required >
                    </div>
                    <div class="input-data">
                        <label for="mobileno">Mobile No</label>
                        <input type="text" name="mobileno" id="mobileno" >
                    </div>                    
                </div>
                <div class="form-row">                   
                    <div class="input-data">
                        <label for="firstname">First Name</label>
                        <input type="text" name="firstname" id="firstname" >
                    </div>
                    <div class="input-data">
                        <label for="lastname">Last Name</label>
                        <input type="text" name="lastname" id="lastname" >
                    </div>                    
                </div>
                <div class="form-row">                   
                    <div class="input-data">
                        <label for="address_number">Address Number</label>
                        <input type="text" name="address_number" id="address_number" >
                    </div>
                    <div class="input-data">
                        <label for="street">Street</label>
                        <input type="text" name="street" id="street" >
                    </div>                    
                </div>
                <div class="form-row">                   
                    <div class="input-data">
                        <label for="city">City</label>
                        <input type="text" name="city" id="city" >
                    </div>
                    <div class="input-data">
                        <label for="country">Country</label>
                        <input type="text" name="country" id="country" >
                    </div>                    
                </div>  
                <div class="form-row submit-btn">
                    <div class="input-data">
                        <input type="submit" class="blue-btn" name="submit" value="Reserve">
                    </div>     
                </div>
            </form>
        </div>
    </div>
</div>

<?php
    require APPROOT.'/views/includes/footer.php';
?>

