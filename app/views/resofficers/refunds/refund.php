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
                    <div class="input-data">
                        <label for="refundNo">Refund No</label>
                        <input type="text" name="refundNo" id="refundNo" required >
                    </div>
                    <div class="input-data">
                        <label for="refundDate">Refund Date</label>
                        <input type="date" name="refundDate" id="refundDate" required >
                    </div>
                </div>
                <div class="form-row">
                    <div class="input-data">
                        <label for="refundTime">Refund Time</label>
                        <input type="time" name="refundTime" id="refundTime" required >
                    </div>
                    <div class="input-data">
                        <label for="ticketId">Ticket ID</label>
                        <input type="text" name="ticketId" id="ticketId" required >
                    </div>
                </div>
                <div class="form-row">
                    <div class="input-data">
                        <label for="officerId">Officer ID</label>
                        <input type="email" name="officerId" id="officerId" required >
                    </div>
                </div>
                <div class="form-row submit-btn">
                    <div class="input-data">
                        <a class= "blue-blue-btn" style="padding-left: 70px;">Refund</a>
                    </div>     
                </div>
            </form>
        </div>
    </div>
</div>
<?php
    require APPROOT.'/views/includes/footer.php';
?>

