<?php
require APPROOT.'/views/includes/moderator_head.php';
?>
<?php
require APPROOT.'/views/includes/moderator_navigation.php';
//var_dump($data);
//echo sizeof($data['fields']);
?>
    <!-- <?php var_dump($_SESSION); ?> -->
    <script src="<?php echo URLROOT;?>/javascript/journeyManagement.js"></script>
    <div class="body-section">
        <div class="content-row"></div>
        <div class="content-row">
            <div class="container-table">
                <h2>Journey Management <?php echo $data['jstatus'];?><small>Driver Assignment</small></h2>
                <div class="table-searchbar">
                    <form action="<?php echo URLROOT;?>/moderatorjourneys/journeysFilteredSearchBy/<?php echo $data['jstatus'];?>" method="post">
                        <input type="text" placeholder="Search by" name="searchbar"><span><select name="searchselect" id="searchselect">
                        <?php foreach ($data['fields'] as $field):?>
                            <option value="<?php echo $field->columns;?>"><?php echo $field->columns;?></option>
                        <?php endforeach;?>
                        </select></span><span><input type="submit" value=" " class="search-btn"></span><span><i class="fa fa-search glyph"></i></span>
                    </form>
                </div>
                <div class="container-table popup" id="popup-journey">
                    <h3>Alert Details</h3>
                    <table class="data-display" id="journeypopup">
                        <tr id="Ids">
                            <td>Journey Id: </td>
                            <td id="journeyId">Not available</td>
                            <td>Entered By: </td>
                            <td id="moderatorId" style="font-weight: 500;">Not available</td>
                        </tr>
                        <tr id="date_time">
                            <td>Assigned Date: </td>
                            <td id="assignedDate">Not available</td>
                            <td>Entered Time: </td>
                            <td id="assignedTime">Not available</td>
                        </tr>
                        <tr id="journey_date_time">
                            <td>Started at: </td>
                            <td id="started_date_time">Not available</td>
                            <td>Ended At: </td>
                            <td id="ended_date_time">Not available</td>
                        </tr>
                        <tr id="journeyStatus" style="font-size: 20px;">
                            <td >Journey Date: </td>
                            <td id="journeyDate">Not available </td>
                            <td >Journey Status: </td>
                            <td id="journeyStatus">Not available </td>
                        </tr>
                        <tr id="journeyDetails" style="font-size: 25px;">
                            <td >Train Id: </td>
                            <td id="trainId">Not available </td>
                            <td >Driver Id: </td>
                            <td id="driverId">Not available </td>
                        </tr>
                        <button style="position: relative; padding: 10px 15px;" class="back-btn" onclick="closeJourneyDetails()"><i class="fa fa-times"></i></button>
                    </table>
                </div>
                <table class="blue" id="journeyTable">
                    <thead>
                    <tr>
                        <th>Journey ID</th>
                        <th>Train ID</th>
                        <th>Driver ID</th>
                        <th>Journey Date</th>
                        <th>Journey Status</th>
                        <th>Assigned Date</th>
                        <th>Assigned Time</th>
                        <th>Moderator ID</th>
                        <th>Manage</th>
                    </tr>
                    </thead>
                    <script>
                        var c=0;
                        var alerts=[];
                    </script>
                    <?php $count=0?>
                    <?php foreach ($data['journeys'] as $row):?>
                        <tr>
                            <td data-th="Journey ID"><?php echo $row->journeyId;?></td>
                            <td data-th="Train ID"><?php echo $row->trainId;?></td>
                            <td data-th="Driver ID"><?php echo $row->driverId;?></td>
                            <td data-th="Journey Date"><?php echo $row->date;?></td>
                            <td data-th="Journey Status" id="jstatus"><?php echo $row->journey_status;?></td>
                            <td data-th="Assigned Date"><?php echo $row->assignment_date;?></td>
                            <td data-th="Assigned Time"><?php echo $row->assignment_time;?></td>
                            <td data-th="Moderator ID"><?php echo $row->moderatorId;?></td>
                            <script>
                                alerts[c]=<?php echo json_encode($row, JSON_PRETTY_PRINT);?>;
                            </script>
                            <td data-th="Manage">
                                <form action="<?php echo URLROOT;?>/moderatorJourneys/deleteJourney/<?php echo $data['jstatus'];?>" method="POST">
                                    <button type="button" class="table-btn blue" onclick="openJourneyDetails(alerts, <?php echo $count;?>)">View</button>
                                    <a href="<?php echo URLROOT;?>/moderatorjourneys/updatejourney/<?php echo $row->journeyId.'/'.$row->driverId;?>" class="blue-btn">Edit</a>
                                    <input type="submit" class="red-btn" value="Delete">
                                    <input type="hidden" id="journeyIdDel" name="journeyIdDel" value="<?php echo $row->journeyId;?>">
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
                                    <a href="<?php echo URLROOT;?>/moderatorJourneys/viewJourneys/<?php echo $data['jstatus'];?>?page=1" class="prev">Prev</a>
                                <?php else:?>
                                    <a href="<?php echo URLROOT;?>/moderatorJourneys/viewJourneys/<?php echo $data['jstatus'];?>?page=<?php echo $data['page']-1;?>" class="prev">Prev</a>
                                <?php endif;?>
                            </li>

                            <?php for($page=1; $page<=$data['totalPages'];$page++){
                                if ($data['page']==$page){
                                    echo '<li class="pageNumber active"><a href="'.URLROOT.'/moderatorJourneys/viewJourneys/'.$data['jstatus'].'?page='.$page.'">'.$page.'</a></li>';
                                }else{
                                    echo '<li class="pageNumber"><a href="'.URLROOT.'/moderatorJourneys/viewJourneys/'.$data['jstatus'].'?page='.$page.'">'.$page.'</a></li>';
                                }
                            }
                            ?>
                            <li>
                                <?php if($data['page']==$data['totalPages']):?>
                                    <a href="#" class="next">Next</a>
                                <?php else:?>
                                    <a href="<?php echo URLROOT;?>/moderatorJourneys/viewJourneys/<?php echo $data['jstatus'];?>?page=<?php echo $data['page']+1;?>" class="next">Next</a>
                                <?php endif;?>
                            </li>
                        <?php else:?>
                            <?php $searchBar=$data['searchBar']; $searchSelect=$data['searchSelect']; ?>
                            <li>
                                <?php if($data['start']==0):?>
                                    <a href="<?php echo URLROOT;?>/moderatorJourneys/journeysFilteredSearchBy/<?php echo $data['jstatus'];?>?page=1&amp;searchbar=<?php echo $searchBar;?>&amp;searchselect=<?php echo $searchSelect;?>" class="prev">Prev</a>
                                <?php else:?>
                                    <a href="<?php echo URLROOT;?>/moderatorJourneys/journeysFilteredSearchBy/<?php echo $data['jstatus'];?>?page=<?php echo $data['page']-1;?>&amp;searchbar=<?php echo $searchBar;?>&amp;searchselect=<?php echo $searchSelect;?>" class="prev">Prev</a>
                                <?php endif;?>
                            </li>

                            <?php for($page=1; $page<=$data['totalPages'];$page++){
                                if ($data['page']==$page){
                                    echo '<li class="pageNumber active"><a href="'.URLROOT.'/moderatorJourneys/journeysFilteredSearchBy/'.$data['jstatus'].'?page='.$page.'&amp;searchbar=' . $searchBar . '&amp;searchselect=' . $searchSelect . '">' . $page . '</a></li>';
                                }else{
                                    echo '<li class="pageNumber"><a href="'.URLROOT.'/moderatorJourneys/journeysFilteredSearchBy/'.$data['jstatus'].'?page='.$page.'&amp;searchbar=' . $searchBar . '&amp;searchselect=' . $searchSelect . '">' . $page . '</a></li>';
                                }
                            }
                            ?>
                            <li>
                                <?php if($data['page']==$data['totalPages']):?>
                                    <a href="#" class="next">Next</a>
                                <?php else:?>
                                    <a href="<?php echo URLROOT;?>/moderatorJourneys/journeysFilteredSearchBy/<?php echo $data['jstatus'];?>?page=<?php echo $data['page']+1;?>&amp;searchbar=<?php echo $searchBar;?>&amp;searchselect=<?php echo $searchSelect;?>" class="next">Next</a>
                                <?php endif;?>
                            </li>
                        <?php endif;?>
                    </ul>
                </div>
                <br>





                <!-- js for pagination -->
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


<?php
require APPROOT.'/views/includes/footer.php';
?>