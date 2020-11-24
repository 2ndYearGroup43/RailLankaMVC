<?php
    require APPROOT.'/views/includes/resofficer_head.php';
?>
<?php
    require APPROOT.'/views/includes/resofficer_navigation.php';
?>
<div class="body-section">
        <div class="content-flexrow">
            <div class="container">
            <div class="text" style="color: #13406d;">Reservations <small style="color: black;">Refund</small></div>
            <form action="#">
                <div class="form-row">    
                    <div class="searchlogo">
                        <img src="<?php echo URLROOT ?>/public/img/logob2.png">
                    </div>
                </div>  
                <div class="form-row">
                    <div class="input-data">
                        <label for="ticketId">Ticket ID</label>
                        <input type="text" name="ticketId" id="ticketId" required >
                    </div>
                </div>
                <div class="form-row submit-btn">
                    <div class="input-data">
                        <a class= "blue-btn" style="padding-left: 70px;">Refund</a>
                    </div>     
                </div>
            </form>
        </div>
    </div>
</div>
<?php
    require APPROOT.'/views/includes/footer.php';
?>

