<?php
    require APPROOT.'/views/includes/resofficer_head.php';
?>
<?php
    require APPROOT.'/views/includes/resofficer_navigation.php';
?>
        <div class="body-section" id="table">
            <div class="content-row">   
            </div>
            <div class="content-row">
                    <div class="container-table">
                        <h1>Ticket Details</h1>
                        <div class="res-table">
                            <h8>First Class</h8>
                            <table class="blue">
                                <thead>
                                    <tr>
                                        <th>Train ID</th>
                                        <th>Name</th>
                                        <th>Date</th>
                                        <th>Time</th>
                                        <th>Compartment No</th>
                                        <th>Seat No</th>
                                        <th>NIC</th>
                                        <th>Ticket ID</th>   
                                    </tr>
                                </thead>
                                <tr>
                                    <td data-th="Train ID"> BLa</td>
                                    <td data-th="Name">BLa</td>
                                    <td data-th="Date">BLa</td>
                                    <td data-th="Time">BLa</td>
                                    <td data-th="Compartment No">BLa</td>
                                    <td data-th="Seat No">BLa</td>
                                    <td data-th="NIC">BLa</td>
                                    <td data-th="Ticket ID">BLa</td>
                                   </td>
                                </tr>
                                <tr>
                                    <td data-th="Train ID"> BLa</td>
                                    <td data-th="Name">BLa</td>
                                    <td data-th="Date">BLa</td>
                                    <td data-th="Time">BLa</td>
                                    <td data-th="Compartment No">BLa</td>
                                    <td data-th="Seat No">BLa</td>
                                    <td data-th="NIC">BLa</td>
                                    <td data-th="Ticket ID">BLa</td>
				                    </td>
                                </tr>
                            </table>
                            <h8>Second Class</h8>
                            <table class="blue">
                                <thead>
                                    <tr>
                                        <th>Train ID</th>
                                        <th>Name</th>
                                        <th>Date</th>
                                        <th>Time</th>
                                        <th>Compartment No</th>
                                        <th>Seat No</th>
                                        <th>NIC</th>
                                        <th>Ticket ID</th>   
                                    </tr>
                                </thead>
                                <tr>
                                    <td data-th="Train ID"> BLa</td>
                                    <td data-th="Name">BLa</td>
                                    <td data-th="Date">BLa</td>
                                    <td data-th="Time">BLa</td>
                                    <td data-th="Compartment No">BLa</td>
                                    <td data-th="Seat No">BLa</td>
                                    <td data-th="NIC">BLa</td>
                                    <td data-th="Ticket ID">BLa</td>
                                   </td>
                                </tr>
                                <tr>
                                    <td data-th="Train ID"> BLa</td>
                                    <td data-th="Name">BLa</td>
                                    <td data-th="Date">BLa</td>
                                    <td data-th="Time">BLa</td>
                                    <td data-th="Compartment No">BLa</td>
                                    <td data-th="Seat No">BLa</td>
                                    <td data-th="NIC">BLa</td>
                                    <td data-th="Ticket ID">BLa</td>
                                    </td>
                                </tr>
                            </table>
                            <h8>Third Class</h8>
                            <table class="blue">
                                <thead>
                                    <tr>
                                        <th>Train ID</th>
                                        <th>Name</th>
                                        <th>Date</th>
                                        <th>Time</th>
                                        <th>Compartment No</th>
                                        <th>Seat No</th>
                                        <th>NIC</th>
                                        <th>Ticket ID</th>   
                                    </tr>
                                </thead>
                                <tr>
                                    <td data-th="Train ID"> BLa</td>
                                    <td data-th="Name">BLa</td>
                                    <td data-th="Date">BLa</td>
                                    <td data-th="Time">BLa</td>
                                    <td data-th="Compartment No">BLa</td>
                                    <td data-th="Seat No">BLa</td>
                                    <td data-th="NIC">BLa</td>
                                    <td data-th="Ticket ID">BLa</td>
                                   </td>
                                </tr>
                                <tr>
                                    <td data-th="Train ID"> BLa</td>
                                    <td data-th="Name">BLa</td>
                                    <td data-th="Date">BLa</td>
                                    <td data-th="Time">BLa</td>
                                    <td data-th="Compartment No">BLa</td>
                                    <td data-th="Seat No">BLa</td>
                                    <td data-th="NIC">BLa</td>
                                    <td data-th="Ticket ID">BLa</td>
                                    </td>
                                </tr>
                            </table>
                            <button class="back-btn" onclick="printContent('e-ticket')"><i class="fa fa-print" aria-hidden="true"></i> Print This Page </button>  
                        </div>      
                    </div>
                </div>
                
            </div>
        </div>
        <script>
        function printContent(el){
            var restorepage = document.body.innerHTML;
            var printContent = document.getElementById(el).innerHTML;
            document.body.innerHTML = printContent;
            window.print();
            document.body.innerHTML = restorepage;
        }
        </script>
<?php
    require APPROOT.'/views/includes/footer.php';
?>

