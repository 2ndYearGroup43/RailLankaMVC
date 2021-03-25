<?php
    require APPROOT.'/views/includes/moderator_head.php';
?>
<?php
    require APPROOT.'/views/includes/moderator_navigation.php';
?>
    <script src="<?php echo URLROOT;?>/javascript/alertDashboardChart.js"></script>
    <script src="<?php echo URLROOT;?>/javascript/alertDashValidation.js"></script>

<div class="marquee-area info-tag">
	<marquee>
		<i class="fa fa-exclamation-triangle" aria-hidden="true" size="3x"></i> Coronavirus(COVID-19) - For the latest updates and travel information, please visit our Coronavirus Information Center
	</marquee>
</div>
    <div class="body-section" onload="initiateCharts(<?php echo json_encode($data);?>)">
            <div class="content-flexrow dash">
                <div class="controls-container">
                    <div class="text">
                        <h1>Alerts Summary <br> <small>Date: </small></h1><h2><?php echo $data['searchDate'];?></h2>
                    </div>
                    <form action="<?php echo URLROOT;?>/moderatorAlerts/alertsDateDash" method="post">
                        <div class="form-row">
                            <div class="input-data">
                                <input type="date" name="searchDate" id="searchDate" max="">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="input-data">
                                <input type="submit" value="Search" class="search-btn" style="line-height: 0rem; color: white;">
                            </div>
                            <div class="input-data">
                                <input type="button" onclick="printCharts()" value="Print" class="search-btn" style="line-height: 0rem; color: white; margin-top: 10px;">
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

            <div class="content-flexrow dash" id="alertChartDiv">
                <div class="chart-container">
                    <div class="data-chart" id="alertTypeChart"></div>
                </div>
                <div class="chart-container">
                    <div class="data-chart" id="issueTypeChart"></div>
                </div>
            </div>
        </div>

        <script>
            function printAlertDash(el) {

                       var restorePage= document.body.innerHTML;
                       var schedule= document.getElementById(el).innerHTML;
                       document.body.innerHTML=schedule;
                       window.print();
                       document.body.innerHTML=restorePage;
                   }




        initiateCharts(<?php echo json_encode($data);?>);
        </script>



<?php
    require APPROOT.'/views/includes/footer.php';
?>