<?php
    require APPROOT.'/views/includes/head.php';
?>
<?php
    require APPROOT.'/views/includes/navigationModerator.php';
?>
    <div class="body-section">
        <div class="content-row"></div>
        <div class="content-row">
            <div class="container-table">
                <h2>Cancellations <small>Alert Management</small></h2>
                <div class="table-searchbar">
                    <form action="<?php echo URLROOT?>/alerts/cancellationsSearchBy" method="POST">
                        <input type="text" placeholder="Search by" name=searchbar><span><select name="searchselect" id="searchselect">
                            <?php foreach ($data['fields'] as $field ):?>
                                <?php if($field->columns!='cancellation_cause'):?>
                                    <option value="<?php echo $field->columns?>"><?php echo $field->columns?></option>
                                <?php endif;?>
                            <?php endforeach;?>
                        </select></span><span><input type="submit" value=" " class="search-btn"></span><span><i class="fa fa-search glyph"></i></span>
                    </form>
                </div>
                <div class="container-table popup" id="popup-alert">
                    <h3>Alert Details</h3>
                    <table class="data-display" id="cancelpopup">
                        <tr id="alertId">
                            <td>Alert Id: </td>
                            <td id="alertId">Not available</td>
                            <td colspan="2"></td>
                        </tr>
                        <tr id="trainId">
                            <td>Train Id: </td>
                            <td id="trainId">Not available</td>
                            <td colspan="2"></td>
                        </tr>
                        <tr id="enteredDate">
                            <td>Entered Date: </td>
                            <td id="enteredDate">Not available</td>
                            <td colspan="2"></td>
                        </tr>
                        <tr id="enteredTime">
                            <td>Entered Time: </td>
                            <td id="enteredTime">Not available</td>
                            <td colspan="2"></td>
                        </tr>
                        <tr id="moderatorId">
                            <td>Entered by: </td>
                            <td id="moderatorId">Not available</td>
                            <td colspan="2"></td>
                        </tr>
                        <tr id="cancellationCause">
                            <td rowspan="2">Cause: </td>
                            <td rowspan="2" id="cancellationCause">Not available </td>
                            <td rowspan="2" colspan="2"></td>
                        </tr>
                        <button style="position: relative; padding: 10px 15px;" class="back-btn"><i class="fa fa-times" onclick="closeCancelAlert()"></i></button>
                    </table>
                </div>
                <table class="blue">
                    <thead>
                        <tr>
                            <th>Alert ID</th>
                            <th>Train ID</th>
                            <th>Entered Date</th>
                            <th>Entered Time</th>
                            <th>Cancellation Cause</th>
                            <th>Moderator ID</th>
                            <th>Manage</th>    
                        </tr>
                    </thead>
                    <script>
                        var c=0;
                        var alerts=[];
                    </script>
                    <?php $count=0?>
                    <?php foreach ($data['alerts'] as $row):?>
                        <tr>
                            <td data-th="Alert ID"><?php echo $row->alertId;?></td>
                            <td data-th="Train ID"><?php echo $row->trainId;?></td>
                            <td data-th="Entered Date"><?php echo $row->date;?></td>
                            <td data-th="Entered Time"><?php echo $row->time;?></td>
                            <td data-th="Cancellation Time"><?php echo $row->cancellation_cause;?></td>
                            <td data-th="Moderater ID"><?php echo $row->moderatorId;?></td>    
                            <script> 
                                alerts[c]=<?php echo json_encode($row, JSON_PRETTY_PRINT)?>;

                            </script>
                            <td data-th="Manage">
                                <form action="<?php echo URLROOT;?>/alerts/deleteAlert/<?php echo $row->alertId;?>/c" method="POST">
                                <button type="button" class="table-btn blue" onclick="openCancelAlert(alerts,<?php echo $count;?>)">View</button>
                                <a href="<?php echo URLROOT;?>/alerts/updateCancellations/<?php echo $row->alertId;?>" class="blue-btn">Edit</a>
                                <input type="submit" class="red-btn" value="Delete">
                                </form>
                            </td>
                        </tr>
                        <script>
                            c++;
                        </script>
                        <?php $count++;?>    
                    <?php endforeach;?>    
                </table>
                <script>
                    function openCancelAlert(alerts,x) {
                        var table=document.getElementById("cancelpopup");
                        table.rows.namedItem("alertId").cells.namedItem("alertId").innerHTML=alerts[x].alertId;
                        table.rows.namedItem("trainId").cells.namedItem("trainId").innerHTML=alerts[x].trainId;
                        table.rows.namedItem("enteredDate").cells.namedItem("enteredDate").innerHTML=alerts[x].date;
                        table.rows.namedItem("enteredTime").cells.namedItem("enteredTime").innerHTML=alerts[x].time;
                        table.rows.namedItem("moderatorId").cells.namedItem("moderatorId").innerHTML=alerts[x].moderatorId;
                        table.rows.namedItem("cancellationCause").cells.namedItem("cancellationCause").innerHTML=alerts[x].cancellation_cause;
                        document.getElementById("popup-alert").style.display = "block";
                    }
    
                    function closeCancelAlert() {
                        document.getElementById("popup-alert").style.display = "none";
                    }
                </script>                     
            </div>
        </div>
    </div>
        

<?php
    require APPROOT.'/views/includes/footer.php';
?>