<?php
    require APPROOT.'/views/includes/resofficer_head.php';
?>
<?php
    require APPROOT.'/views/includes/resofficer_navigation.php';
?>
        <div class="body-section">
            <div class="content-row">   
            </div>
            <div class="content-row">
                    <div class="container-table">
                        <h2 style="color: #13406d;">Disabled Seats Details</h2>
                        <div class="res-table">
                            <table class="blue">
                                <thead>
                                    <tr>
                                        <th>Disable ID</th>
                                        <th>Disable No</th>
                                        <th>Compartment No</th>
                                        <th>Seat No</th>
                                        <th>Train ID</th>
                                        <th>Officer ID</th>
                                        <th>Action</th> 
                                    </tr>
                                </thead>
                                <?php foreach ($data['seats'] as $seat):?>
                                <tr>
                                    <td data-th="Disable ID"><?php echo $seat->disabledId?></td>
                                    <td data-th="Disable No"><?php echo $seat->disabledNo?></td>
                                    <td data-th="Compartment No"><?php echo $seat->compartmentNo?></td>
                                    <td data-th="Seat No"><?php echo $seat->seatNo?></td>
                                    <td data-th="Train ID"><?php echo $seat->trainId?></td>
                                    <td data-th="Officer ID"><?php echo $seat->officerId?></td>
                                    <td data-th="Action">
                                    <form action="<?php echo URLROOT . "/ResOfficerManageSeats/delete/" . $seat->disabledId?>" method="POST">                              
                                    <input type="submit" name="delete" value="Remove" class="red-btn">
                                   </form></td>
                                </tr>
                                <?php endforeach;?>
                            </table>
                            <br>

                            <button type="button" onclick="history.go(-1);" class="back-btn" value="Back">Back</button>  
                        </div>      
                    </div>
                </div>
                
            </div>
        </div>
<?php
    require APPROOT.'/views/includes/footer.php';
?>