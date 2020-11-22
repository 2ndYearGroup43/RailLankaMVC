<?php
    require APPROOT.'/views/includes/moderator_head.php';
?>
<?php
    require APPROOT.'/views/includes/moderator_navigation.php';
?>
<?php var_dump($_SESSION); ?>
    <div class="body-section">
        <div class="content-row"></div>
        <div class="content-row">
            <div class="container-table">
                <h2>Reschedulements <small>Alert Management</small></h2>
                <div class="table-searchbar">
                    <form action="<?php echo URLROOT?>/moderatoralerts/reschedulementsSearchBy" method="POST">
                        <input type="text" placeholder="Search by" name=searchbar><span><select name="searchselect" id="searchselect">
                            <?php foreach ($data['fields'] as $field ):?>
                                <?php if($field->columns!='reschedulement_cause'):?>
                                    <option value="<?php echo $field->columns?>"><?php echo $field->columns?></option>
                                <?php endif;?>
                            <?php endforeach;?>
                        </select></span><span><input type="submit" value=" " class="search-btn"></span><span><i class="fa fa-search glyph"></i></span>
                    </form>
                </div>
                <div class="container-table popup" id="popup-alert">
                    <h3>Alert Details</h3>
                    <table class="data-display" id="rescheduledpopup">
                        <tr id="Ids">
                            <td>Alert Id: </td>
                            <td id="alertId">Not available</td> 
                            <td>Train Id: </td>
                            <td id="trainId" style="font-weight: 500;">Not available</td>
                        </tr>
                        <tr id="date_time">
                            <td>Entered Date: </td>
                            <td id="enteredDate">Not available</td>
                            <td>Entered Time: </td>
                            <td id="enteredTime">Not available</td>
                        </tr>
                        <tr id="moderatorId">
                            <td>Entered by: </td>
                            <td id="moderatorId">Not available</td>
                            <td>Issue Type: </td>
                            <td id="issueType">Not available</td>
                        </tr>
                        <tr id="newDateTime">
                            <td>New Date: </td>
                            <td id="newDate">Not available</td>
                            <td>New Time: </td>
                            <td id="newTime">Not available</td>
                        </tr>
                        <tr id="rescheduledCause" style="font-size: 25px;">
                            <td rowspan="2">Cause: </td>
                            <td rowspan="2" id="rescheduledCause">Not available </td>
                            <td rowspan="2" colspan="2"></td>
                        </tr>
                        <button style="position: relative; padding: 10px 15px;" class="back-btn"><i class="fa fa-times" onclick="closeRescheduledAlert()"></i></button>
                    </table>
                </div>
                <table class="blue">
                    <thead>
                        <tr>
                            <th>Alert ID</th>
                            <th>Train ID</th>
                            <th>New Date</th>
                            <th>New Time</th>
                            <th>Entered Date</th>
                            <th>Entered Time</th>
                            <th>Issue Type</th>
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
                            <td data-th="New Date"><?php echo $row->newdate;?></td>
                            <td data-th="New Time"><?php echo $row->newtime;?></td>
                            <td data-th="Entered Date"><?php echo $row->date;?></td>
                            <td data-th="Entered Time"><?php echo $row->time;?></td>
                            <td data-th="Issue Type"><?php echo $row->issuetype;?></td>
                            <td data-th="Moderater ID"><?php echo $row->moderatorId;?></td>    
                            <script> 
                                alerts[c]=<?php echo json_encode($row, JSON_PRETTY_PRINT)?>;

                            </script>
                            <td data-th="Manage">
                                <form action="<?php echo URLROOT;?>/moderatoralerts/deleteAlert/<?php echo $row->alertId;?>/r" method="POST">
                                    <button type="button" class="table-btn blue" onclick="openRescheduledAlert(alerts,<?php echo $count;?>)">View</button>
                                    <a href="<?php echo URLROOT;?>/moderatoralerts/updateReschedulements/<?php echo $row->alertId;?>" class="blue-btn">Edit</a>
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
                    function openRescheduledAlert(alerts,x) {
                        var table=document.getElementById("rescheduledpopup");
                        table.rows.namedItem("Ids").cells.namedItem("alertId").innerHTML=alerts[x].alertId;
                        table.rows.namedItem("Ids").cells.namedItem("trainId").innerHTML=alerts[x].trainId;
                        table.rows.namedItem("date_time").cells.namedItem("enteredDate").innerHTML=alerts[x].date;
                        table.rows.namedItem("date_time").cells.namedItem("enteredTime").innerHTML=alerts[x].time;
                        table.rows.namedItem("moderatorId").cells.namedItem("moderatorId").innerHTML=alerts[x].moderatorId;
                        table.rows.namedItem("moderatorId").cells.namedItem("issueType").innerHTML=alerts[x].issuetype;
                        table.rows.namedItem("newDateTime").cells.namedItem("newDate").innerHTML=alerts[x].newdate;
                        table.rows.namedItem("newDateTime").cells.namedItem("newTime").innerHTML=alerts[x].newtime;
                        table.rows.namedItem("rescheduledCause").cells.namedItem("rescheduledCause").innerHTML=alerts[x].reschedulement_cause;
                        document.getElementById("popup-alert").style.display = "block";
                    }
    
                    function closeRescheduledAlert() {
                        document.getElementById("popup-alert").style.display = "none";
                    }
                </script>                     
            </div>
        </div>
    </div>
        

<?php
    require APPROOT.'/views/includes/footer.php';
?>