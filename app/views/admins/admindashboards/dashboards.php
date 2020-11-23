<?php
   require APPROOT . '/views/includes/admin_head.php';
?>


    <?php
       require APPROOT . '/views/includes/admin_navigation.php';
    ?>
<script src="<?php echo URLROOT;?>/javascript/alertDashboardChart.js"></script>

<div class="body-section">

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
                    <h1>Alerts Summary <br> <small>Date: </small></h1><h2>2020-10-10</h2>
                </div>
                <form action="#">
                    <div class="input-data">
                        <input type="Date" placeholder="Select Date" name=searchbar>
                        <span><input type="submit" value="Search" class="search-btn" style="line-height: 0rem; color: white;"></span>
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
                        15
                    </div>
                    <div class="card-link">
                        <a href="#">Manage</a>
                    </div>
                </div>
                <div class="count-card">
                    <div class="card-title">
                        Delays<br>
                        Alerts
                    </div>
                    <div class="card-count">
                        12
                    </div>
                    <div class="card-link">
                        <a href="#">Manage</a>
                    </div>
                </div>
                <div class="count-card">
                    <div class="card-title">
                        Rescheduled <br>
                        Alerts
                    </div>
                    <div class="card-count">
                        7
                    </div>
                    <div class="card-link">
                        <a href="#">Manage</a>
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
    require APPROOT . '/views/includes/footer.php';

?>