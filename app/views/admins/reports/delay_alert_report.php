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
                    <li><a href="<?php echo URLROOT; ?>/adminReports/delayAlertReport">Delay Alert Report </a></li></ul>
                </ul>
            </div>    
            <br><br>
<center>
<div class="div-alert" > 
 
    
            <div class="content-flexrow">
                <div class="container-table" id="printrev">

                    <center>
                        <div class="logo-container" align="center">
                        <a href="index.html">
                        <img src="<?php echo URLROOT;?>/public/img/logotrack.jpg" height="130px" algin="center" >
                        </a>
                        </div>
                    </center>
                    <h2 style="color: #13406d;">Alerts Details <small style="color: black;">
                    Admin Id: 0002A</small></h2>
                    <h2 style="color: #13406d;">Date : <small style="color: black;"> 12/12/2020</small></h2>
                    <table class="data-display">
                        <caption>Delays Details</caption>
                        <tr>
                            <td >Admin ID: </td>
                            <td>0002A</td>
                            <td colspan="2"></td>
                        </tr>
                        <tr>
                            <td >Train ID: </td>
                            <td>038B</td>
                            <td colspan="2"></td>
                        </tr>
                        <tr>
                            <td>Train Name: </td>
                            <td>Udarata Manike</td>
                            <td colspan="2"></td>
                        </tr>
                        <tr>
                            <<td > Duration: </td>
                            <td>from: 01/11/2020</td>
                            <td>to: 30/11/2020</td>
                            <td colspan="2"></td>
                        </tr>
                        
                        <tr>
                            <td>No. of Total Delay Alerts : </td>
                            <td>10</td>
                            <td colspan="2"></td>
                        </tr>
                        
                    </table>
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



