<?php
   require APPROOT . '/views/includes/admin_head.php';
?>


    <?php
       require APPROOT . '/views/includes/admin_navigation.php';
    ?>

<div class="body-section">

            <div class="content-row">
                <ul class="breadcrumb">
                    <li><a href="#">Home</a></li>
                    <li><u>Reports</u></li>
                    
                    <li><a href="<?php echo URLROOT; ?>/adminReports/bothRevenueReport"> Online/ Over the Counter Revenue Report </a></li></ul>
                </ul>
            </div>


       
            <div class="content-flexrow">
                <div class="container-table">
                    <h2 style="color: #13406d;">Revenue Details <small style="color: black;">Admin Id: 00001A</small></h2>
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
                            
                        </tr>  
                            <td>Total Revenue for Over the counter : </td>
                            <td>Rs. 3 000 000.00</td>
                            <td colspan="2"></td>
                        </tr>
                        <tr>
                            <td><b><h3>Total Revenue for Online & Over the counter : </h3></b></td>
                            <td>Rs. 5 000 000.00</td>
                            <td colspan="3"></td>
                        </tr>
                    
                    </table>
                    <button onclick="history.go(-1);" type="submit" class="back-btn">Back</button>
                </div>
            </div>
        </div>





<?php
    require APPROOT . '/views/includes/footer.php';

?>



