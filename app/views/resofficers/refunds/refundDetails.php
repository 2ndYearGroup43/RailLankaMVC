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
                        <h2 style="color: #13406d;">Refund Details</h2>
                        <div class="res-table">
                            <table class="blue">
                                <thead>
                                    <tr>
                                        <th>Refund No</th>
                                        <th>Refund Date</th>
                                        <th>Refund Time</th>
                                        <th>Ticket Id</th>
                                        <th>Officer Id</th>
                                        <th>Action</th> 
                                    </tr>
                                </thead>
                                <?php foreach ($data['refund_details'] as $refund_detail):?>
                                <tr>
                                    <td data-th="Refund No"><?php echo $refund_detail->refundNo?></td>
                                    <td data-th="Refund Date"><?php echo $refund_detail->refundDate?></td>
                                    <td data-th="Refund Time"><?php echo $refund_detail->refundTime?></td>
                                    <td data-th="Ticket Id"><?php echo $refund_detail->ticketId?></td>
                                    <td data-th="Officer Id"><?php echo $refund_detail->officerId?></td>
                                    <td data-th="Action">                              
                                    <a class= "blue-btn" href="<?php echo URLROOT . "/ResOfficerRefundDetails/displayRefundDetails/" . $refund_detail->ticketId?>">View</a>
                                   </td>
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