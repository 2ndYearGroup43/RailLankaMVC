<?php
    require APPROOT.'/views/includes/moderator_head.php';
?>
<?php
    require APPROOT.'/views/includes/moderator_navigation.php';
?>
     <script src="<?php echo URLROOT;?>/javascript/alertDashboardChart.js"></script>
<div class="marquee-area info-tag">
	<marquee>
		<i class="fa fa-exclamation-triangle" aria-hidden="true" size="3x"></i> Coronavirus(COVID-19) - For the latest updates and travel information, please visit our Coronavirus Information Center
	</marquee>
</div>
    <div class="body-section">
            <div class="content-flexrow dash">
                <div class="controls-container">
                    <div class="text">
                        <h1>Alerts Summary <br> <small>Date: </small></h1><h2>2020-10-10</h2>
                    </div>
                    <form action="#">
                        <div class="form-row">
                            <div class="input-data">
                                <input type="date" name="searchbar">
                            </div>            
                        </div>
                        <div class="form-row">
                            <div class="input-data">
                                <input type="button" onclick="location.href='<?php echo URLROOT;?>/moderatorAlerts/alertsrandomdash'" value="Search" class="search-btn" style="line-height: 0rem; color: white;">
                            </div>    
                        </div>    
                    </form>
                </div>
                <div class="card-container">
                    <div class="count-card">
                        <div class="card-title">
                            Cancellations<br>
                            Alerts
                        </div>
                        <div class="card-count">
                            <?php echo $data['cancelledCount'];?>
                        </div>
                        <div class="card-link">
                            <a href="<?php echo URLROOT;?>/moderatoralerts/viewCancelledAlerts">Manage</a>
                        </div>
                    </div>
                    <div class="count-card">
                        <div class="card-title">
                            Delays<br>
                            Alerts
                        </div>
                        <div class="card-count">
                            <?php echo $data['delayedCount'];?>
                        </div>
                        <div class="card-link">
                            <a href="<?php echo URLROOT;?>/moderatoralerts/viewDelayedAlerts">Manage</a>
                        </div>
                    </div>
                    <div class="count-card">
                        <div class="card-title">
                            Rescheduled <br>
                            Alerts
                        </div>
                        <div class="card-count">
                            <?php echo $data['rescheduledCount'];?>
                        </div>
                        <div class="card-link">
                            <a href="<?php echo URLROOT;?>/moderatoralerts/viewReschedulededAlerts">Manage</a>
                        </div>
                    </div>
                </div>    
            </div>

            <div class="content-flexrow dash">
                <div class="chart-container">
                    <div class="data-chart" id="alertTypeChart"></div>
                </div>
                <div class="chart-container">
                    <div class="data-chart" id="issueTypeChart"></div>
                </div>
            </div>
        </div>


<?php
    require APPROOT.'/views/includes/footer.php';
?>