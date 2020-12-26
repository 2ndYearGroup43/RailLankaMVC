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
                        <label for="refundNo">Refund No</label>
                        <input type="text" name="refundNo" id="refundNo" required >
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
                    </div>
                </div>
                <div class="form-row submit-btn">
                    <div class="input-data">
                        <input type="submit" class="blue-btn" name="submit" value="Refund" data-target="alert-success-popup">
                    </div>     
                </div>
            </form>
        </div>
    </div>
</div>

    <!-- alert success pop up -->
    <div class="flash-alert-box" id="alert-success-popup">
        <div class="alert-box-content">
            <div class="alert-icon">
                <i class="fa fa-check" aria-hidden="true"></i>
            </div>
            <div class="alert-body">
                <h3>Refund Successfull!</h3>
                <p>You will recieve alert notifications via email.
                </p>
            </div>
            <button onclick="location.href='<?php echo URLROOT; ?>/resofficers/index'" type="button" class="close-alert">&times;</button>
        </div>
    </div>
    <!-- end of alert success popup -->

    <script>
            const alertBtn = document.querySelectorAll(".blue-btn");
            alertBtn.forEach(function(btn){
                btn.addEventListener("click", function(){
                    const target = this.getAttribute("data-target");
                    const alertBox = document.getElementById(target)
                    alertBox.classList.add("alert-box-show");

                    const closeAlert = alertBox.querySelector(".close-alert");
                    closeAlert.addEventListener("click",function(){
                        alertBox.classList.remove("alert-box-show");
                    });

                    alertBox.addEventListener("click",function(event){
                        if(event.target === this){
                            alertBox.classList.remove("alert-box-show");
                        }
                    });
                });
            });

        </script>

     
    <!-- js for pop up -->
    <script>

        document.getElementById('pop-up').addEventListener('click', function() {
                document.querySelector('.bg-modal').style.display = 'flex';
        });

        document.querySelector('.close').addEventListener('click', function(){
            document.querySelector('.bg-modal').style.display = 'none';
        });

    </script>
    <!-- end of js for pop up -->

<?php
    require APPROOT.'/views/includes/footer.php';
?>

