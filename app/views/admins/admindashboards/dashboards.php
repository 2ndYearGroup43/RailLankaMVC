<?php
   require APPROOT . '/views/includes/admin_head.php';
?>
<?php
   require APPROOT . '/views/includes/admin_navigation.php';
?>
    <script src="<?php echo URLROOT;?>/javascript/alertDashboardChart.js"></script>
    <script src="<?php echo URLROOT;?>/javascript/alertDashValidation.js"></script>

<div class="body-section" onload="initiateCharts(<?php echo json_encode($data);?>)">

            <div class="content-row">
                <ul class="breadcrumb">
                    <li><a href="<?php echo URLROOT; ?>/admins/index">Home</a></li>
                    <li><u>Dashboards </u></li>
                    <li><a href="<?php echo URLROOT; ?>/admindashboards/dashboards">Alert Dashboards </a></li>
                </ul>
            </div>

        <div class="content-flexrow dash">
            <div class="controls-container">
                <div class="text">
                    <h1>Alerts Summary <br> <small>Date: </small></h1><h2><?php echo $data['searchDate'];?></h2>
                </div>
                <form action="<?php echo URLROOT;?>/adminDashboards/alertsDateDash" method="post">
                    <div class="input-data">
                        <input type="date" name="searchDate" id="searchDate" max="">
                        <span><input type="submit" value="Search" class="search-btn" style="line-height: 0rem; color: white;"></span>
                    </div>
                    <div class="input-data">
                        <input type="button" onclick="printCharts()" value="Print" class="search-btn" style="line-height: 0rem; color: white; margin-top: 10px;">
                    </div>
                </form>
            </div>
            <div class="card-container">
                <div class="count-card">
                    <div class="card-title">
                        <h1>Cancellations</h1><br>
                        <h2>Alerts</h2>
                    </div>
                    <div class="card-count">
                        <?php echo $data['cancelledCount'];?>
                    </div>
                </div>
                <div class="count-card">
                    <div class="card-title">
                        <h1>Delays</h1><br>
                        <h2>Alerts</h2>
                    </div>
                    <div class="card-count">
                        <?php echo $data['delayedCount'];?>
                    </div>
                </div>
                <div class="count-card">
                    <div class="card-title">
                        <h1>Rescheduled</h1><br>
                        <h2>Alerts</h2>
                    </div>
                    <div class="card-count">
                        <?php echo $data['rescheduledCount'];?>
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
    require APPROOT . '/views/includes/footer.php';

?>