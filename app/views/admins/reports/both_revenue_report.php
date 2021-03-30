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
                    <li><u>Reports</u></li>
                    
                    <li><a href="<?php echo URLROOT; ?>/adminReports/bothRevenueReport"> Online & Over the Counter Revenue Report </a></li></ul>
                </ul>
            </div><br><br>



<center>
<div class="div2" >
       
            <div class="content-flexrow">
                <div class="container-table">

                    
                        <div class="logo-container" align="center">
                        <a href="index.html">
                        <img src="<?php echo URLROOT;?>/public/img/logotrack.jpg" height="130px" algin="center" >
                        </a>
                        </div>
                    
                    <center>
                    <h2 style="color: #13406d;">Revenue Details 
                        <br>
                    <small style="color: black;">Admin Id: <b><?php echo $data['adminId'];?></b></small></h2>
                    <h2 style="color: black;">Date : <small style="color: black;"> <?php echo $data['date'];?></small></h2></center> 

                    <table class="data-display">
                        <center><caption><h2>Online & Over the Counter Revenue Details </h2></caption></center>
                        
                        <tr>
                            <td>Train Id</td>
                            <td><?php echo $data['train']->trainId;?></td>
                            <td colspan="2"></td>
                        </tr>
                        <tr>
                            <td >Train Name: </td>
                            <td><?php echo $data['train']->name;?></td>
                            <td colspan="2"></td>
                        </tr>
                        <tr>
                            <td>Start Station: </td>
                            <td><?php echo $data['train']->srcName;?></td>
                            <td colspan="2"></td>
                        </tr>
                        <tr>
                            <td>Destination Station: </td>
                            <td><?php echo $data['train']->destName;?></td>
                            <td colspan="2"></td>
                        </tr>
                        <!-- <tr>
                            <td>Route: </td>
                            <td><?php echo $data['routeId'];?></td>
                            <td colspan="2"></td>
                        </tr> -->
                        <tr>
                            <td > Duration: </td>
                            <td id="from_date"><?php echo $data['from'];?></td>
                            <td id="to_date"><?php echo $data['to'];?></td>
                            <td colspan="2"></td>
                        </tr>
                        <tr>
                            <td>Number of dates: </td>
                            <td><?php echo (strtotime($data['to'])-strtotime($data['from']))/(60*60*24); ?></td>
                            <td colspan="2"></td>
                        </tr>
                        <tr>
                            <td>Number of Online Journey: </td>
                            <td><?php echo " ". count($data["onlines"]);?></td>
                            <td colspan="2"></td>
                        </tr>
                        <tr>
                            <td>Number of counter Journey: </td>
                            <td><?php echo "". count($data["onlines"] + $data["counters"]);?></td>
                            <td colspan="2"></td>
                        </tr>

                         <!-- <tr>
                            <td>Total Revenue for Counter  : </td>
                            <td><?php echo $data['total']; ?></td>
                            <td colspan="2"></td>
                        </tr>  -->
                        <!-- <tr>

                            <td><h3><b>Total Revenue for Counter : </b></h3></td>
                            <td><h3><b><?php echo "Total - ". count($data["onlines"]);?></b></h3></td>
                            <td colspan="2"></td>
                        </tr>
                         
                        <tr>

                            <td><h3><b>Total Revenue for Online & Over the Counter : </b></h3></td>
                            <td><h3><b><?php echo "Total - ". count($data["results"]);?></b></h3></td>
                            <td colspan="2"></td>
                        </tr> -->
                        
                    </table>


                    <br><br><br><br><br>
                    
                    <caption style="color: #D13977;"><h2>Online Revenue Details</h2></caption>
                    <div id="repo">
                    <table class="repo" align="center">


                        <thead>
                            <tr>
                                
                                <th>Ticket ID</th>
                                <th>Reservation Type</th>
                                <th>Journey Date</th>
                                <th>Price</th>
                                <th>Officer ID</th>
                                

                            </tr>
                        </thead>

                        <?php foreach ($data["onlines"] as $row):?>
                    <tr>
                        <td data-th="Ticket ID"><?php echo $row->ticketId;?></td>
                        <td data-th="Reservation Type"><?php echo $row->reservationType;?></td>
                        <td data-th="Journey Date"><?php echo $row->journeyDate;?></td>
                        <td data-th="Price"><?php echo $row->price;?></td>
                        <td data-th="Officer ID"><?php echo $row->officerId;?></td>
                        
                    </tr>
                    
                        <?php endforeach;?>

                    </table>  
                    </div>



                    <br>
                    <br>
                <caption style="color: #D13977;"><h2>Over The Counter Revenue Details</h2></caption>

                    <div id="repo">
                    <table class="repo" align="center">


                        <thead>
                            <tr>
                                
                                <th>Ticket ID</th>
                                <th>Reservation Type</th>
                                <th>Journey Date</th>
                                <th>Price</th>
                                <th>Officer ID</th>
                                

                            </tr>
                        </thead>

                        <?php foreach ($data["counters"] as $row):?>
                    <tr>
                        <td data-th="Ticket ID"><?php echo $row->ticketId;?></td>
                        <td data-th="Reservation Type"><?php echo $row->reservationType;?></td>
                        <td data-th="Journey Date"><?php echo $row->journeyDate;?></td>
                        <td data-th="Price"><?php echo $row->price;?></td>
                        <td data-th="Officer ID"><?php echo $row->officerId;?></td>
                        
                    </tr>
                        <?php endforeach;?>

                    </table>  
                    </div>
                    <button  type="button" onclick="printContent('printrev')" class="back-btn">Print</button>
                    
                    <button onclick="history.go(-1);" type="button" class="back-btn">Back</button>
                </div>
            </div>
            <br>
        </div>
</center>
<br><br>
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



