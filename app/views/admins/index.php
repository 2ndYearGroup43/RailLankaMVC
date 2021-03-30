<?php 

	//echo out databse info to the screen
	// foreach ($data['users'] as $user) {
	// 	echo "Information: " . $user->user_name . $user->user_email;
	// 	echo "<br>";
	// }
	
	// isPassenger();
	require APPROOT . '/views/includes/passenger_head.php';
	require APPROOT . '/views/includes/admin_navigation_home.php';
?>


<!-- reserve shortcuts -->
<section id="nback" >
    <!-- <div  class="container">	 -->
    <div class="row">
        <div  class="col-l">
            <section id="carousel">
                <div class="slide-holder">
                    <div class="slideshow">
                        <input type="radio" name="r" id="r1" checked>
                        <input type="radio" name="r" id="r2">
                        <input type="radio" name="r" id="r3">
                        <input type="radio" name="r" id="r4">
                        <div class="slideshow-item s1">
                            <img src="<?php echo URLROOT ?>/public/img/bookmark4.jpg">
                            <div class="slideshow-item-text t1">
                                <!-- <h3>COLOMBO-ELLA</h3>
								<p>The three-hour trip from Colombo to Kandy will whisk you away from the big city sprawl to the genteel greenery of Sri Lanka’s spiritual capital.</p>
								<button onclick="location.href='<?php echo URLROOT; ?>/passengerReservations/search'" type="submit" class="btn">Reserve Now</button> -->
                            </div>
                        </div>
                        <div class="slideshow-item">
                            <img src="<?php echo URLROOT ?>/public/img/bookmark1.jpg">
                            <!-- <div class="slideshow-item-text">
								<h3>COLOMBO-KANDY</h3>
								<p>The three-hour trip from Colombo to Kandy will whisk you away from the big city sprawl to the genteel greenery of Sri Lanka’s spiritual capital.</p>
								<button onclick="location.href='<?php echo URLROOT; ?>/passengerReservations/search'" type="submit" class="btn">Reserve Now</button>
							</div> -->
                        </div>
                        <div class="slideshow-item">
                            <img src="<?php echo URLROOT ?>/public/img/bookmark2.jpg">
                            <!-- <div class="slideshow-item-text">
								<h3>COLOMBO-GALLE</h3>
								<p>The three-hour trip from Colombo to Kandy will whisk you away from the big city sprawl to the genteel greenery of Sri Lanka’s spiritual capital.</p>
								<button onclick="location.href='<?php echo URLROOT; ?>/passengerReservations/search'" type="submit" class="btn">Reserve Now</button>
							</div> -->
                        </div>
                        <div class="slideshow-item">
                            <img src="<?php echo URLROOT ?>/public/img/bookmark3.jpg">
                            <div class="slideshow-item-text">
                                <h3>EXPLORE SRI LANKA ON RAILS</h3>
                                <p>From the big city sprawl to the genteel greenery of the Sri Lankan landscape. Don't miss out on these epic train journeys!</p>
                                <button onclick="location.href='<?php echo URLROOT; ?>/passengerReservations/search'" type="submit" class="btn">Reserve Now</button>
                            </div>
                        </div>
                        <div class="navigation">
                            <label for="r1" class="bar"></label>
                            <label for="r2" class="bar"></label>
                            <label for="r3" class="bar"></label>
                            <label for="r4" class="bar"></label>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
    <!-- </div> -->
</section>
<!-- end of reserve shortcuts -->

<!-- Quick search view -->
<section id="notices-section">
    <div class="leftbox">
        <div class="content">
            <div class="mini-schedule">
                <h2 class="title" id="title3">SEARCH TRAIN</h2>
                <form action="#">
                    <div class="form-row">
                        <div class="mini-input-data">
                            <label for="src">From</label>
                            <select name="src" id="src">
                                <option value="Fort">Fort</option>
                                <option value="Kandy">Kandy</option>
                                <option value="Galle">Galle</option>
                                <option value="Baadulla">Baadulla</option>
                            </select>
                        </div>
                        <div class="mini-input-data">
                            <label for="src">To</label>
                            <select name="src" id="src">
                                <option value="Fort">Fort</option>
                                <option value="Kandy">Kandy</option>
                                <option value="Galle">Galle</option>
                                <option value="Baadulla">Baadulla</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="mini-input-data">
                            <label for="date">Date</label>
                            <input type="date" id="date" >
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="mini-input-data">
                            <label for="time">Time</label>
                            <input type="time" id="time" >
                        </div>
                    </div>
                </form>
                <a href="<?php echo URLROOT; ?>/passengerSchedules/displayTrains" id="view-all">Go <i class="fa fa-long-arrow-right"></i></a>
            </div>
        </div>
    </div>
    <!-- end of quick search -->

    <!-- display of latest notices -->
    <div class="events">
        <h1>NOTICES</h1>
        <ul>
            <?php foreach ($data as $row):?>
                <li>
                    <div class="time">
                        <h2><?php echo date('d', strtotime($row->entered_date)); ?><br><span><?php echo date('F', strtotime($row->entered_date)); ?></span></h2>
                    </div>
                    <div class="time-details">
                        <h3><?php echo $row->title; ?></h3>
                        <a id="<?php echo $row->noticeId; ?>" class="pop-up" href="#">
                            <p>Read More <i class="fa fa-angle-double-right"></i></p>
                        </a>
                    </div>
                    <div style="clear: both;"></div>
                </li>
            <?php endforeach;?>
        </ul>
        <a href="<?php echo URLROOT; ?>/pages/notices" id="view-all">View All <i class="fa fa-long-arrow-right"></i></a>
    </div>
    <!-- end of display of latest notices -->
</section>

<!-- notice pop up -->
<div class="bg-modal" id="front-page">
    <div class="modal-content">
        <div class="close">+</div>
        <div class="notices-container">
            <div class="img-container">
                <img src="<?php echo URLROOT ?>/public/img/logoc.jpg">
            </div>
            <h2 class="title">Notice</h2>
            <table class="content-table" id="details">
            </table>
        </div>
    </div>
</div>
<!-- end of notice pop up -->


<!-- js for notice pop up -->
<script>

    $('.pop-up').bind('click', function() {
        var notice_id = $(this).attr("id");

        $.ajax({
            url:"<?php echo URLROOT; ?>/pages/displayNoticeDetails",
            type:"POST",
            data: {'noticeid':notice_id},
            success: function(returndata){
                $('#details').html(returndata);
                document.querySelector('.bg-modal').style.display = 'flex';
            },
            error: function(){
                alert('error');
            }
        })

    });

    document.querySelector('.close').addEventListener('click', function(){
        document.querySelector('.bg-modal').style.display = 'none';
    });

</script>
<!-- end of js for notice pop up -->

<?php require APPROOT . '/views/includes/footer.php'; ?>


