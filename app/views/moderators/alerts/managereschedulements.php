<?php
    require APPROOT.'/views/includes/moderator_head.php';
?>
<?php
    require APPROOT.'/views/includes/moderator_navigation.php';
?>
<div class="marquee-area info-tag">
	<marquee>
		<i class="fa fa-exclamation-triangle" aria-hidden="true" size="3x"></i> Coronavirus(COVID-19) - For the latest updates and travel information, please visit our Coronavirus Information Center
	</marquee>
</div>
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
                                    <?php if($field->columns!='type'):?>
                                        <option value="<?php echo $field->columns?>"><?php echo $field->columns?></option>
                                    <?php endif;?>
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
                        <tr id="oldDateTime">
                            <td>Old Date: </td>
                            <td id="oldDate">Not Available</td>
                            <td colspan="2"></td>
                        </tr>
                        <tr id="newDateTime">
                            <td>New Date: </td>
                            <td id="newDate">Not available</td>
                            <td>New Time: </td>
                            <td id="newTime">Not available</td>
                        </tr>
                        <tr id="moderatorId">
                            <td>Entered by: </td>
                            <td id="moderatorId">Not available</td>
                            <td>Issue Type: </td>
                            <td id="issueType">Not available</td>
                        </tr>
                        <tr id="date_time">
                            <td>Entered Date: </td>
                            <td id="enteredDate">Not available</td>
                            <td>Entered Time: </td>
                            <td id="enteredTime">Not available</td>
                        </tr>
                        <tr id="rescheduledCause" style="font-size: 25px;">
                            <td rowspan="2">Cause: </td>
                            <td rowspan="2" id="rescheduledCause">Not available </td>
                            <td rowspan="2" colspan="2"></td>
                        </tr>
                        <button style="position: relative; padding: 10px 15px;" class="back-btn" onclick="closeRescheduledAlert()"><i class="fa fa-times"></i></button>
                    </table>
                </div>
                <table class="blue">
                    <thead>
                        <tr>
                            <th>Alert ID</th>
                            <th>Train ID</th>
                            <th>Old Date</th>
                            <th>New Date</th>
                            <th>New Time</th>
                            <th>Entered Date</th>
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
                            <td data-th="Old Date"><?php echo $row->olddate;?></td>
                            <td data-th="New Date"><?php echo $row->newdate;?></td>
                            <td data-th="New Time"><?php echo $row->newtime;?></td>
                            <td data-th="Entered Date"><?php echo $row->date;?></td>
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

                
                <br>
				<div class="pagination">
					<ul>
                        <?php if(!isset($data['searchBar'])):?>
                            <li>
                                <?php if($data['start']==0):?>
                                    <a href="<?php echo URLROOT;?>/moderatorAlerts/viewRescheduledAlerts?page=1" class="prev">Prev</a>
                                <?php else:?>
                                    <a href="<?php echo URLROOT;?>/moderatorAlerts/viewRescheduledAlerts?page=<?php echo $data['page']-1;?>" class="prev">Prev</a>
                                <?php endif;?>
                            </li>

                            <?php for($page=1; $page<=$data['totalPages'];$page++){
                                if ($data['page']==$page){
                                    echo '<li class="pageNumber active"><a href="'.URLROOT.'/moderatorAlerts/viewRescheduledAlerts?page='.$page.'">'.$page.'</a></li>';
                                }else{
                                    echo '<li class="pageNumber"><a href="'.URLROOT.'/moderatorAlerts/viewRescheduledAlerts?page='.$page.'">'.$page.'</a></li>';
                                }
                            }
                            ?>
                            <li>
                                <?php if($data['page']==$data['totalPages']):?>
                                    <a href="#" class="next">Next</a>
                                <?php else:?>
                                    <a href="<?php echo URLROOT;?>/moderatorAlerts/viewRescheduledAlerts?page=<?php echo $data['page']+1;?>" class="next">Next</a>
                                <?php endif;?>
                            </li>
                        <?php else:?>
                            <?php $searchBar=$data['searchBar']; $searchSelect=$data['searchSelect']; ?>
                            <li>
                                <?php if($data['start']==0):?>
                                    <a href="<?php echo URLROOT;?>/moderatorAlerts/reschedulementsSearchBy?page=1&amp;searchbar=<?php echo $searchBar;?>&amp;searchselect=<?php echo $searchSelect;?>" class="prev">Prev</a>
                                <?php else:?>
                                    <a href="<?php echo URLROOT;?>/moderatorAlerts/reschedulementsSearchBy?page=<?php echo $data['page']-1;?>&amp;searchbar=<?php echo $searchBar;?>&amp;searchselect=<?php echo $searchSelect;?>" class="prev">Prev</a>
                                <?php endif;?>
                            </li>

                            <?php for($page=1; $page<=$data['totalPages'];$page++){
                                if ($data['page']==$page){
                                    echo '<li class="pageNumber active"><a href="'.URLROOT.'/moderatorAlerts/reschedulementsSearchBy?page='.$page.'&amp;searchbar=' . $searchBar . '&amp;searchselect=' . $searchSelect . '">' . $page . '</a></li>';
                                }else{
                                    echo '<li class="pageNumber"><a href="'.URLROOT.'/moderatorAlerts/reschedulementsSearchBy?page='.$page.'&amp;searchbar=' . $searchBar . '&amp;searchselect=' . $searchSelect . '">' . $page . '</a></li>';
                                }
                            }
                            ?>
                            <li>
                                <?php if($data['page']==$data['totalPages']):?>
                                    <a href="#" class="next">Next</a>
                                <?php else:?>
                                    <a href="<?php echo URLROOT;?>/moderatorAlerts/reschedulementsSearchBy?page=<?php echo $data['page']+1;?>&amp;searchbar=<?php echo $searchBar;?>&amp;searchselect=<?php echo $searchSelect;?>" class="next">Next</a>
                                <?php endif;?>
                            </li>
                        <?php endif;?>
<!--						<li><a href="#" class="prev">Prev</a></li>-->
<!--						<li class="pageNumber active"><a href="--><?php //echo URLROOT; ?><!--/moderatoralerts/viewRescheduledAlerts">1</a></li>-->
<!--						<li class="pageNumber"><a href="--><?php //echo URLROOT; ?><!--/moderatoralerts/viewRescheduledAlerts">2</a></li>-->
<!--						<li class="pageNumber"><a href="--><?php //echo URLROOT; ?><!--/moderatoralerts/viewRescheduledAlerts">3</a></li>-->
<!--						<li><a href="--><?php //echo URLROOT; ?><!--/moderatoralerts/viewRescheduledAlerts" class="next">Next</a></li>-->
					</ul>
				</div>
                <br>	
                
                <script>
                    function openRescheduledAlert(alerts,x) {
                        var table=document.getElementById("rescheduledpopup");
                        table.rows.namedItem("Ids").cells.namedItem("alertId").innerHTML=alerts[x].alertId;
                        table.rows.namedItem("Ids").cells.namedItem("trainId").innerHTML=alerts[x].trainId;
                        table.rows.namedItem("oldDateTime").cells.namedItem("oldDate").innerHTML=alerts[x].olddate;
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
                <!-- pagination -->
                <script>
                    $(document).ready(function(){
                        $('.next').click(function(){
                            $('.pagination').find('.pageNumber.active').next().addClass('active');
                            $('.pagination').find('.pageNumber.active').prev().removeClass('active');
                        });
                        $('.prev').click(function(){
                            $('.pagination').find('.pageNumber.active').prev().addClass('active');
                            $('.pagination').find('.pageNumber.active').next().removeClass('active');
                        });
                    });
                </script>
            <!-- end of js for pagination -->
            </div>
            </div>
        </div>
    </div>
        

<?php
    require APPROOT.'/views/includes/footer.php';
?>