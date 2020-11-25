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
                <div class="container-table" id="printrev">

                    <center>
                        <div class="logo-container" align="center">
                        <a href="index.html">
                        <img src="<?php echo URLROOT;?>/public/img/logotrack.jpg" height="130px" algin="center" >
                        </a>
                        </div>
                    </center>

                    <h2 style="color: #13406d;">Revenue Details <small style="color: black;">Admin Id: 00001A</small></h2>
                    <h2 style="color: #13406d;">Date : <small style="color: black;"> 12/12/2020</small></h2>
                    <table class="data-display">
                        <!--<caption>Over the Counter Details</caption>-->
                       <tr>
                            <td><i><b><h3>Online Revenue Details</h3></b></i></td>
                            <td colspan="3"></td>
                        </tr>
                        <tr>
                            <td>Train Id</td>
                            <td>00007A</td>
                            <td colspan="3"></td>
                        </tr>
                        <tr>
                            <td >Train Name: </td>
                            <td>Ruhunu Kumaree</td>
                            <td colspan="2"></td>
                        </tr>
                        <tr>
                            <td>Route: </td>
                            <td>T38</td>
                            <td colspan="2"></td>
                        </tr>
                        <tr>
                            <td > Duration: </td>
                            <td>from: 01/11/2020</td>
                            <td>to: 30/11/2020</td>
                            <td colspan="2"></td>
                        </tr>
                        <tr>
                            <td>Number of dates: </td>
                            <td>30</td>
                            <td colspan="2"></td>
                        </tr>
                        <tr>
                            <td>Number of travels: </td>
                            <td>40</td>
                            <td colspan="2"></td>
                        </tr>
                        <tr>
                            <td>Total Revenue for Online : </td>
                            <td>Rs. 2 000 000.00</td>
                            <td colspan="2"></td>
                        </tr>
                        <tr>
                            <td><i><b><h3>Over the Counter Details</h3></b></i></td>
                            <td colspan="3"></td>
                        </tr>
                        <tr>
                            <td>Train Id</td>
                            <td>00007A</td>
                            <td colspan="3"></td>
                        </tr>
                        <tr>
                            <td >Train Name: </td>
                            <td>Ruhunu Kumaree</td>
                            <td colspan="2"></td>
                        </tr>
                        <tr>
                            <td>Route: </td>
                            <td>T38</td>
                            <td colspan="2"></td>
                        </tr>
                        <tr>
                            <td > Duration: </td>
                            <td>from: 01/11/2020</td>
                            <td>to: 30/11/2020</td>
                            <td colspan="2"></td>
                        </tr>
                        <tr>
                            <td>Number of dates: </td>
                            <td>30</td>
                            <td colspan="2"></td>
                        </tr>
                        <tr>
                        <tr>
                            <td>Number of travels: </td>
                            <td>40</td>
                            <td colspan="2"></td>
                        </tr>  
                        </tr>  
                            <td>Total Revenue for Over the counter : </td>
                            <td>Rs. 3 000 000.00</td>
                            <td colspan="2"></td>
                        </tr>
                        <tr>
                            <td><b><h3 style="color: #13406d;">Total Revenue for Online & Over the counter : </h3></b></td>
                            <td>Rs. 5 000 000.00</td>
                            <td colspan="3"></td>
                        </tr>
                    
                    </table>


<br><br>

<div id="repo">
<table class="repo" align="center">

<tr>
    <td>No.</td>
    <td><b>Date</b></td>
    <td><b>Departure Time</b></td>
    <td><b>Arrival Time</b></td>
    <td><b>Online Revenue</b></td>
    <td><b>Counter Revenue</b></td>
  </tr>
  <tr>
    <td>01</td>
    <td>01/11/2020</td>
    <td>08:00 AM</td>
    <td>11:00 AM</td>
    <td>Rs. 10 000.00</td>
    <td>Rs. 8 000.00</td>
  </tr>
  
  <tr>
    <td>02</td>
    <td>01/11/2020</td>
    <td>01:00 PM</td>
    <td>05:00 PM</td>
    <td>Rs. 8 500.00</td>
    <td>Rs. 10 000.00</td>
  </tr>
  <tr>
    <td>03</td>
    <td>03/11/2020</td>
    <td>08:00 AM</td>
    <td>11:00 AM</td>
    <td>Rs. 10 000.00</td>
    <td>Rs. 12 000.00</td>
  </tr>
  <tr>
    <td>04</td>
    <td>03/11/2020</td>
    <td>08:00 AM</td>
    <td>11:00 AM</td>
    <td>Rs. 8 000.00</td>
    <td>Rs. 15 000.00</td>
  </tr>
  <tr>
    <td>05</td>
    <td>06/11/2020</td>
    <td>10:00 AM</td>
    <td>01:00 PM</td>
    <td>Rs. 10 000.00</td>
    <td>Rs. 20 000.00</td>
  </tr>
  <tr>
    <td>06</td>
    <td>07/11/2020</td>
    <td>08:00 AM</td>
    <td>11:00 AM</td>
    <td>Rs. 20 000.00</td>
    <td>Rs. 18 000.00</td>
  </tr>

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



