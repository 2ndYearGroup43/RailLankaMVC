<?php
   require APPROOT . '/views/includes/admin_head.php';
?>


    <?php
       require APPROOT . '/views/includes/admin_navigation.php';
    ?>

<!-- <?php var_dump($data); ?> -->
<div class="body-section">

            <!-- <div class="content-row"> -->
                <ul class="breadcrumb">
                    <li><a href="<?php echo URLROOT; ?>/admins/index">Home</a></li>
                    <li><u>Reports</u></li>
                    <li><a href="<?php echo URLROOT; ?>/adminReports/addRefundDetails">Add Refund Report Details</a></li>
                    <li><a href="<?php echo URLROOT; ?>/adminReports/refundReport">Refund Report</a></li>
                </ul>
            <!-- </div> -->
<br><br>

<center>
<div class="div-alert" >        

            

            <div class="content-flexrow">
                <div class="container-table" id="printrev">

                    
                        <div class="logo-container" align="center">
                        <a href="index.html">
                        <img src="<?php echo URLROOT;?>/public/img/logotrack.jpg" height="130px" algin="center" >
                        </a>
                        </div>
                    
                    <center><h1 style="color: #13406d;">Refund Details </h1>
                    <h2 style="color: #13406d;">Date : <small style="color: black;"> <?php echo $data['date'];?></small></h2></center>

                    <table class="data-display">
                        
                        <tr>
                            <td>Admin ID: </td>
                            <td><?php echo $data['adminId'];?></td>
                            <td colspan="2"></td>
                        </tr>

                        <tr id="userId">
                            <td>User Id: </td>
                            <td> <?php echo $data['userid'];?></td>
                            <td colspan="2"></td>
                        </tr>
                        
                        <tr>
                            <td>Train ID: </td>
                            <td id="name"><?php echo $data['id'];?></td>
                            <td colspan="2"></td>
                        </tr>

                        <tr>
                            <td>Train Name: </td>
                            <td id="name"><?php echo $data['name'];?></td>
                            <td colspan="2"></td>
                        </tr> 

                        <tr>
                            <td>Duration: </td>
                            <td id="from_date"><?php echo $data['from'];?></td>
                            <td id="to_date"><?php echo $data['to'];?></td>
                            <td colspan="2"></td>
                        </tr>
                        
                        <tr>
                            <td>Number of Refunds : </td>
                            <td data-th="Refund No"><?php echo " ". count($data["results"]);?></td>
                            <td colspan="2"></td>
                        </tr>

                        <tr>
                            <td>Total Amount of Refunds : </td>
                            <td><?php echo $data['total']; ?></td>
                            <td colspan="2"></td>
                        </tr>  
                       

                    </table>

                    <br>
                    <br>
                    <br>

                    <div id="repo">
                    <table class="repo" align="center">


                        <thead>
                            <tr>
                                
                                <th>Refund No</th>
                                <th>Refund Date</th>
                                <th>Refund Time</th>
                                <th>Ticket ID</th>
                                <th>Officer ID</th>
                                <th>Price</th>
                                <th>Issue Date</th>    
                                <th>Issue Time</th>
                             
                            </tr>
                        </thead>

                        <?php foreach ($data["results"] as $row):?>
                    <tr>
                        <td data-th="Refund No"><?php echo $row->refundNo;?></td>
                        <td data-th="Refund Date"><?php echo $row->refundDate;?></td>
                        <td data-th="Refund Time"><?php echo $row->refundTime;?></td>
                        <td data-th="Ticket ID"><?php echo $row->ticketId;?></td>
                        <td data-th="Officer ID"><?php echo $row->officerId;?></td>
                        <td data-th="Price"><?php echo $row->price;?></td>
                        <td data-th="Issue Date"><?php echo $row->issueDate;?></td>
                        <td data-th="Issue Time"><?php echo $row->issueTime;?></td>
                    </tr>
                    
                   <?php endforeach;?>

                        </table>  
                        </div>

                    <button  type="button" onclick="printContent('printrev')" class="back-btn">Print</button>
                    
                    <button onclick="history.go(-1);" type="button" class="back-btn">Back</button>
                </div>
            </div>

        </div>
    </center>
        </div>


<script >
    function printContent(el){
        var restorepage = document.body.innerHTML;
        var printContent = document.getElementById(el).innerHTML;
        document.body.innerHTML = printContent;
        window.print();
        document.body.innerHTML = restorepage;

    }
</script>




<?php
    require APPROOT . '/views/includes/footer.php';

?>



