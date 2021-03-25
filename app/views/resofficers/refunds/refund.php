<?php
    require APPROOT.'/views/includes/resofficer_head.php';
?>
<?php
    require APPROOT.'/views/includes/resofficer_navigation.php';
?>
<div class="body-section">
        <div class="content-flexrow">
            <div class="container">
            <h2 style="color: #13406d;">Reservations <small style="color: black;">Refund</small></h2>
            <form action="<?php echo URLROOT; ?>/ResOfficerRefunds/refund" method = "POST">
                <div class="form-row">    
                    <div class="searchlogo">
                        <img src="<?php echo URLROOT ?>/public/img/logob2.png">
                    </div>
                </div> 
                <div class="form-row">
                    <div class="input-data">
                        <label for="ticketId">Ticket ID</label>
                        <select name="ticketId" id="ticketId" required>
                                <option value="">Select</option>
                                <?php foreach ($data['tickets'] as $ticket ):?>
                                <option value="<?php echo $ticket->ticketId?>"><?php echo $ticket->ticketId?></option>
                            <?php endforeach;?>
                        </select>
                        <span class="invalidFeedback">
                            <?php echo $data['ticketIdError'];?>
                        </span>                      
                    </div>
                </div>
                <div class="form-row submit-btn">
                    <div class="input-data">
                        <input type="submit" class="blue-btn" name="submit" value="Refund">
                    </div>     
                </div>
            </form>
        </div>
    </div>
</div>

<?php
    require APPROOT.'/views/includes/footer.php';
?>

