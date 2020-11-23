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
                    <li><a href="<?php echo URLROOT; ?>/adminReports/onlineRevenueReport">Online Revenue Report </a></li></ul>
                </ul>
            </div>
            <br><br>


<center>
        <div class="div3" >
                


            <div class="content-flexrow">
                
                <div class="container-table">
                    <center>
                        <div class="logo-container" align="center">
                        <a href="index.html">
                        <img src="<?php echo URLROOT;?>/public/img/logotrack.jpg" height="130px" algin="center" >
                        </a>
                        </div>
                    </center>

                    <h2 style="color: #13406d;">Revenue Details <small style="color: black;">Admin Id: 000011</small></h2>
                    <h2 style="color: #13406d;">Date : <small style="color: black;"> 12/12/2020</small></h2>
                    <table class="data-display">
                        <center><caption>Online Revenue</caption></center>
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

                            <td><h3><b>Total Revenue for Online : </b></h3></td>
                            <td><h3><b>Rs.  200 000.00</h3></b></td>
                            <td colspan="2"></td>
                        </tr>

                    
                    </table>

                    <br><br>

<div id="repo">
<table class="repo" align="center">

<tr>
    <td>No.</td>
    <td><b>Date</b></td>
    <td><b>Departure time</b></td>
    <td><b>Arrival time</b></td>
    <td><b>Online revenue</b></td>
  </tr>
  <tr>
    <td>01</td>
    <td>01/11/2020</td>
    <td>08:00 AM</td>
    <td>11:00 AM</td>
    <td>Rs. 10 000.00</td>
  </tr>
  
  <tr>
    <td>02</td>
    <td>01/11/2020</td>
    <td>01:00 PM</td>
    <td>05:00 PM</td>
    <td>Rs. 8 500.00</td>
  </tr>
  <tr>
    <td>03</td>
    <td>03/11/2020</td>
    <td>08:00 AM</td>
    <td>11:00 AM</td>
    <td>Rs. 10 000.00</td>
  </tr>
  <tr>
    <td>04</td>
    <td>03/11/2020</td>
    <td>08:00 AM</td>
    <td>11:00 AM</td>
    <td>Rs. 8 000.00</td>
  </tr>
  <tr>
    <td>05</td>
    <td>06/11/2020</td>
    <td>10:00 AM</td>
    <td>01:00 PM</td>
    <td>Rs. 10 000.00</td>
  </tr>
  <tr>
    <td>06</td>
    <td>07/11/2020</td>
    <td>08:00 AM</td>
    <td>11:00 AM</td>
    <td>Rs. 20 000.00</td>
  </tr>

</table>  
</div>
                    <button onclick="history.go(-1);" type="button" class="back-btn">Back</button>
                </div>
            


</div>

</div>
</center>
        </div>






<?php
    require APPROOT . '/views/includes/footer.php';

?>



