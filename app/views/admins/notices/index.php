<?php
   require APPROOT . '/views/includes/admin_head.php';
?>


    <?php
       require APPROOT . '/views/includes/admin_navigation.php';
    ?>

<div class="body-section">

            <div class="content-row">
                <ul class="breadcrumb">
                    <li><a href="<?php echo URLROOT; ?>/admins/index">Home</a></li>
                    <li><u>Notice Management</u></li>
                    <li><a href="<?php echo URLROOT; ?>adminNotices/index">Manage Notices</a></li>
                </ul>
            </div>

           

            <div class="content-row">
                <div class="container-table">
                    <h2>Notice Management </h2>

                <div class="table-searchbar">
                    <form action="<?php echo URLROOT?>/adminNotices/noticeSearchBy" method="POST">
                        <input type="text" placeholder="Search by" name=searchbar><span><select name="searchselect" id="searchselect">
                            <?php foreach ($data['fields'] as $field ):?>
                                    <option value="<?php echo $field->columns?>"><?php echo $field->columns?></option>
                            <?php endforeach;?>
                        </select></span><span><input type="submit" value=" " class="search-btn"></span><span><i class="fa fa-search glyph"></i></span>
                    </form>
                </div>

                <div class="container-table popup" id="popup-alert">
                    <h3>Notice Details</h3>
                    <table class="data-display" id="cancelpopup">
                        <tr id="noticeId">
                            <td>notice Id: </td>
                            <td id="noticeId">Not available</td>
                            <td colspan="2"></td>
                        </tr>
                        <tr id="description">
                            <td>description: </td>
                            <td id="description">Not available</td>
                            <td colspan="2"></td>
                        </tr>
                        <tr id="adminId">
                            <td>adminId: </td>
                            <td id="adminId">Not available</td>
                            <td colspan="2"></td>
                        </tr>
                        <tr id="type">
                            <td>type: </td>
                            <td id="type">Not available</td>
                            <td colspan="2"></td>
                         </tr>   
                        <tr id="entered_date">
                            <td>entered_date: </td>
                            <td id="entered_date">Not available</td>
                            <td colspan="2"></td>
                        </tr>
                        <tr id="entered_time">
                            <td>entered_time: </td>
                            <td id="entered_time">Not available</td>
                            <td colspan="2"></td>
                        </tr>
                       
                        <button style="position: relative; padding: 10px 15px;" class="back-btn"><i class="fa fa-times" onclick="closeNoticeView()"></i></button>
                    </table>
                </div>



                    <table class="blue">
                        <thead>
                            <tr>
                                <th>Notice ID</th>
                                <th>Notice Type</th>
                                <th>Entered Date</th>
                                <th>Entered Time</th>
                                <th>Admin ID</th>
                                <th>Manage</th>    
                            </tr>
                        </thead>
                        
                        <script>
                        var c=0;
                        var alerts=[];
                    </script>
                    <?php $count=0?>

                        <?php foreach ($data["notices"] as $row):?>
                    <tr>
                        <td data-th="Notice ID"><?php echo $row->noticeId;?></td>
                        <td data-th="Notice Type"><?php echo $row->type;?></td>
                        <td data-th="Entered Date"><?php echo $row->entered_date;?></td>
                        <td data-th="Entered Time"><?php echo $row->entered_time;?></td>
                        <td data-th="Admin ID"><?php echo $row->adminId;?></td>
                            <script> 
                                alerts[c]=<?php echo json_encode($row, JSON_PRETTY_PRINT)?>;

                            </script>

                        <td data-th="Manage">

                            <form action="<?php echo URLROOT;?>/adminNotices/delete/<?php echo $row->noticeId;?>" method="POST">
                            <button type="button" class="table-btn blue" onclick="openNoticeView(alerts,<?php echo $count;?>)">View</button>
                            <a href="<?php echo URLROOT;?>/adminNotices/updateNotice/<?php echo $row->noticeId;?>" class="blue-btn">Edit</a>
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
                    function openNoticeView(alerts,x) {
                        var table=document.getElementById("cancelpopup");
                        table.rows.namedItem("noticeId").cells.namedItem("noticeId").innerHTML=alerts[x].noticeId;
                        table.rows.namedItem("description").cells.namedItem("description").innerHTML=alerts[x].description;
                        table.rows.namedItem("adminId").cells.namedItem("adminId").innerHTML=alerts[x].adminId;
                        table.rows.namedItem("type").cells.namedItem("type").innerHTML=alerts[x].type;
                        table.rows.namedItem("entered_date").cells.namedItem("entered_date").innerHTML=alerts[x].entered_date;
                        table.rows.namedItem("entered_time").cells.namedItem("entered_time").innerHTML=alerts[x].entered_time;
                        document.getElementById("popup-alert").style.display = "block";
                    }
    
                    function closeNoticeView() {
                        document.getElementById("popup-alert").style.display = "none";
                    }
                </script>  


            </div>
        </div>

</div>



<?php
    require APPROOT . '/views/includes/footer.php';

?>



