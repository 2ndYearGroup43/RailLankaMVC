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
                        <a class= "blue-btn" style="padding-left: 70px;" data-target="alert-success-popup">Refund</a>
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
                <h3>Refund Successful!</h3>
                <p>You will recieve alert notifications via email.
                </p>
            </div>
            <button type="button" class="close-alert">&times;</button>
        </div>
    </div>
    <!-- end of alert success popup -->

    <script>
            const alertBtn = document.querySelectorAll(".alert-btn");
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

