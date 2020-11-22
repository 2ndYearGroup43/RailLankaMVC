<?php
    require APPROOT.'/views/includes/moderator_head.php';
?>
<?php
    require APPROOT.'/views/includes/moderator_navigation.php';
?>
<script src="<?php echo URLROOT;?>/javascript/revenueDashChart.js"></script>
   

<div class="body-section">
        <div class="content-flexrow dash">
            <div class="dash-column" style="flex: 1;">
                <div class="controls-container">
                    <div class="text">
                        <h1>Revenue Booking Types</h1><br>
                        <h3><small>From:  </small>2020-10-20  <small>To:  </small>2020-11-20</h3>
                    </div>
                    <div class="container dash">
                        <form action="#">
                            <div class="form-row">
                                <div class="input-data">
                                    <label for="reservationType">Reservation Type </label>
                                    <input list="resType" placeholder="Select a Reservation Type" name="trainId">
                                    <datalist id="resType">
                                        <option value="all">All Types</option>
                                        <option value="Both">Both</option>
                                        <option value="Online">Online</option>
                                        <option value="Over the Counter">Over the Counter</option>
                                    </datalist>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="input-data">
                                    <label for="startDate">Start Date</label>
                                    <input type="Date" placeholder="Select start Date" name="startDate">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="input-data">
                                    <label for="endDate">End Date</label>
                                    <input type="Date" placeholder="Select end Date" name="endDate">
                                </div>
                            </div>
                            <div class="form-row submit-btn">
                                <div class="input-data">    
                                    <input type="submit" value="Search" class="blue-btn">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="dash-column" style="flex: 2;">
                <div class="chart-container" style="flex: 2;">
                    <div class="data-chart" id="totalRevenueChart"></div>
                </div>
                <div class="chart-container" style="flex: 1;">
                    <div class="data-chart" id="totalRevenueByType"></div>
                </div>
            </div>
        </div>
        <div class="content-flexrow dash">
            <div class="dash-column" style="flex: 1;">
                <div class="controls-container">
                    <div class="text">
                        <h1>Revenue Classes Summary</h1><br>
                        <h3><small>From:  </small>2020-10-20  <small>To:  </small>2020-11-20</h3>
                    </div>
                    <div class="container dash">
                        <form action="#">
                            <div class="form-row">
                                <div class="input-data">
                                    <label for="startDate">TrainId: </label>
                                    <input list="trainid" placeholder="Select a specific Train" name=trainId>
                                    <datalist id="trainid">
                                        <option value="0530COLBAD">0530COLBAD</option>
                                        <option value="1730COLGAL">1730COLGAL</option>
                                        <option value="1830COLRAG">1830COLRAG</option>
                                        <option value="0930TRICOL">0930TRICOL</option>
                                    </datalist>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="input-data">
                                    <label for="startDate">Start Date</label>
                                    <input type="Date" placeholder="Select start Date" name=startDate>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="input-data">
                                    <label for="endDate">End Date</label>
                                    <input type="Date" placeholder="Select end Date" name=endDate>
                                </div>
                            </div>
                            <div class="form-row submit-btn">
                                <div class="input-data">    
                                    <input type="submit" value="Search" class="blue-btn">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
                
            <div class="dash-column" style="flex: 2;">
                <div class="card-container">
                    <div class="count-card">
                        <div class="card-title">
                            1st Class<br>
                            Revenue
                        </div>
                        <div class="card-count revenue">
                            <small>Rs.</small> 32,250
                        </div>
                    </div>
                    <div class="count-card">
                        <div class="card-title">
                            2nd Class<br>
                            Revenue
                        </div>
                        <div class="card-count revenue">
                           <small>Rs.</small> 45,250
                        </div>
                    </div>
                    <div class="count-card">
                        <div class="card-title">
                            3rd Class <br>
                            Revenue
                        </div>
                        <div class="card-count revenue">
                            <small>Rs.</small> 62,250
                        </div>
                    </div>
                </div> 
                <div class="dash-row">
                    <div class="chart-container">
                        <div class="data-chart" id="revenueClassChart"></div>
                    </div>
                    <div class="chart-container">
                        <div class="data-chart" id="revenueTypeChart"></div>
                    </div>
                </div>  
            </div>
         </div>
    </div>

    
    
<?php
    require APPROOT.'/views/includes/footer.php';
?>