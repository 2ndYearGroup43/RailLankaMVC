<?php
   require APPROOT . '/views/includes/admin_head.php';
?>


    <?php
       require APPROOT . '/views/includes/admin_navigation.php';
    ?>


<!--<?php var_dump($data['fields'])?>-->


    <div class="body-section">

            <div class="content-row">
                <ul class="breadcrumb">
                    <li><a href="<?php echo URLROOT; ?>/admins/index">Home</a></li>
                    <li><u>Station Management</u></li>
                    <li><a href="<?php echo URLROOT; ?>/adminStations/manage_station">Manage Station</a></li>
                </ul>
            </div>

            

            <div class="content-row">
                <div class="container-table">
                    <h2>Station Management </h2>


                <div class="table-searchbar">
                    <form action="<?php echo URLROOT?>/adminStations/stationSearchBy" method="POST">
                        <input type="text" placeholder="Search by" name=searchbar><span><select name="searchselect" id="searchselect">
                            <?php foreach ($data['fields'] as $field ):?>
                                    <option value="<?php echo $field->columns?>"><?php echo $field->columns?></option>
                            <?php endforeach;?>
                        </select></span><span><input type="submit" value=" " class="search-btn"></span><span><i class="fa fa-search glyph"></i></span>
                    </form>
                </div>


                    <table class="blue">

                        <thead>
                            <tr>
                                <th>Station ID</th>
                                <th>Station name</th>
                                <th>Telephone Number</th>
                                <th>Type</th>
                                <th>Entered Date</th>
                                <th>Entered Time</th>
                                <th>Manage</th>    
                            </tr>
                        </thead>

                    <?php foreach ($data["stations"] as $row):?>
                    <tr>
                        <td data-th="Station ID"><?php echo $row->stationID;?></td>
                        <td data-th="Station name"><?php echo $row->name;?></td>
                        <td data-th="Telephone Number"><?php echo $row->telephoneNo;?></td>
                        <td data-th="Type"><?php echo $row->type;?></td>
                        <td data-th="Entered Date"><?php echo $row->entered_date;?></td>
                        <td data-th="Entered Time"><?php echo $row->entered_time;?></td>
                        <td data-th="Manage">

                            <form action="<?php echo URLROOT;?>/adminStations/deleteStation/<?php echo $row->stationID;?>" method="POST">
                            <a href="<?php echo URLROOT;?>/adminStations/update_station/<?php echo $row->stationID;?>" class="blue-btn">Edit</a>
                            <input type="submit" class="red-btn" value="Delete">
                            </form>
                            
                        </td>    
                    </tr>
                    <?php endforeach;?>

                    </table> 
            </div>  
                     
    </div>
    


<?php
    require APPROOT . '/views/includes/footer.php';

?>



