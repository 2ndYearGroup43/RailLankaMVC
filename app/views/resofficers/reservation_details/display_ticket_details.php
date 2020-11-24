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
                                    <td data-th="Train ID"> 101COLBAD0630</td>
                                    <td data-th="Name">Denuwara Manike</td>
                                    <td data-th="Date">26.11.2020</td>
                                    <td data-th="Time">06.30</td>
                                    <td data-th="Compartment No">1</td>
                                    <td data-th="Seat No">10</td>
                                    <td data-th="NIC">971701617V</td>
                                    <td data-th="Ticket ID">1045</td>
                                   </td>
                                </tr>
                                <tr>
                                    <td data-th="Train ID"> 101COLBAD0630</td>
                                    <td data-th="Name">Denuwara Manike</td>
                                    <td data-th="Date">26.11.2020</td>
                                    <td data-th="Time">06.30</td>
                                    <td data-th="Compartment No">2</td>
                                    <td data-th="Seat No">32</td>
                                    <td data-th="NIC">971701617V</td>
                                    <td data-th="Ticket ID">1234</td>
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
                                    <td data-th="Train ID"> 101COLBAD0630</td>
                                    <td data-th="Name">Denuwara Manike</td>
                                    <td data-th="Date">26.11.2020</td>
                                    <td data-th="Time">06.30</td>
                                    <td data-th="Compartment No">3</td>
                                    <td data-th="Seat No">23</td>
                                    <td data-th="NIC">971701617V</td>
                                    <td data-th="Ticket ID">3423</td>
                                   </td>
                                </tr>
                                <tr>
                                    <td data-th="Train ID"> 101COLBAD0630</td>
                                    <td data-th="Name">Denuwara Manike</td>
                                    <td data-th="Date">26.11.2020</td>
                                    <td data-th="Time">06.30</td>
                                    <td data-th="Compartment No">3</td>
                                    <td data-th="Seat No">34</td>
                                    <td data-th="NIC">971701617V</td>
                                    <td data-th="Ticket ID">1275</td>
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
                                    <td data-th="Train ID"> 101COLBAD0630</td>
                                    <td data-th="Name">Denuwara Manike</td>
                                    <td data-th="Date">26.11.2020</td>
                                    <td data-th="Time">06.30</td>
                                    <td data-th="Compartment No">4</td>
                                    <td data-th="Seat No">4</td>
                                    <td data-th="NIC">971701617V</td>
                                    <td data-th="Ticket ID">2098</td>
                                   </td>
                                </tr>
                                <tr>
                                    <td data-th="Train ID"> 101COLBAD0630</td>
                                    <td data-th="Name">Denuwara Manike</td>
                                    <td data-th="Date">26.11.2020</td>
                                    <td data-th="Time">06.30</td>
                                    <td data-th="Compartment No">2</td>
                                    <td data-th="Seat No">16</td>
                                    <td data-th="NIC">971701617V</td>
                                    <td data-th="Ticket ID">5643</td>
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

