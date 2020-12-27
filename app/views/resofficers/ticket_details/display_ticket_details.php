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
                    <div class="container-table" id="scheduleDiv">
                        <h2 style="color: #13406d;">Ticket Details</h2>
                        <div class="res-table">
                            <table class="blue">
                                <thead>
                                    <tr>
                                        <th>Train ID</th>
                                        <th>Date</th>
                                        <th>Compartment No</th>
                                        <th>Seat No</th>
                                        <th>NIC</th>
                                        <th>Ticket ID</th>   
                                    </tr>
                                </thead>
                                <?php foreach ($data['train'] as $train):?>
                                <tr>
                                    <td data-th="Train ID"><?php echo $data['train']->ticketId?></td>
                                    <td data-th="Date"><?php echo $data['train']->date?></td>
                                    <td data-th="Compartment No"><?php echo $data['train']->compartmentNo?></td>
                                    <td data-th="Seat No"><?php echo $data['train']->seatNo?></td>
                                    <td data-th="NIC"><?php echo $data['train']->nic?></td>
                                    <td data-th="Class"><?php echo $data['train']->classType?></td>
                                    <td data-th="Date"><?php echo $data['train']->date?></td>
                                    <td data-th="Ticket ID"><?php echo $data['train']->ticketId?></td>
                                   </td>
                                </tr>
                                <?php endforeach;?>
                            </table>
                            <button class="back-btn" onclick="printSchedule('scheduleDiv')"><i class="fa fa-print" aria-hidden="true"></i> Print This Page </button>  
                        </div>      
                    </div>
                </div>
                
            </div>
        </div>
        <script>
            function printSchedule(el) {
                var restorePage= document.body.innerHTML;
                var schedule= document.getElementById(el).innerHTML;
                document.body.innerHTML=schedule;
                window.print();
                document.body.innerHTML=restorePage;
            }
        </script>
<?php
    require APPROOT.'/views/includes/footer.php';
?>

