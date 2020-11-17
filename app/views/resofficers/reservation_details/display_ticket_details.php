<?php
    require APPROOT.'/views/includes/resofficer_head.php';
?>
<?php
    require APPROOT.'/views/includes/resofficer_navigation.php';
?>
<?php var_dump($_SESSION); ?>
        <div class="body-section">
            <div class="content-row">
            	<button type="submit" class="submit-btn search" onclick="openForm()">Search</button>    
            </div>
            <div class="content-row">
                <div class="container-searchbox-popup" id="popupsearch">
                    <form action="#">
                        <div class="form-row">    
                            <div class="searchlogo">
                                <img src="<?php echo URLROOT;?>/public/img/logoschedule.jpg" alt="raillankatracktrains">
                            </div>
                        </div>    
                        <div class="form-row">
                            <div class="input-data">
                                <label for="src">Source Station</label>
                                <select name="src" id="src">
                                    <option value="Fort">Fort</option>
                                    <option value="Kandy">Kandy</option>
                                    <option value="Galle">Galle</option>
                                    <option value="Baadulla">Baadulla</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="input-data">
                                <label for="dest">Destination Station</label>
                                <select name="dest" id="dest">
                                    <option value="Fort">Fort</option>
                                    <option value="Kandy">Kandy</option>
                                    <option value="Galle">Galle</option>
                                    <option value="Baadulla">Baadulla</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="input-data">
                                <label for="date">Date</label>
                                <input type="date" id="date" >
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="input-data">
                                <label for="time">Time</label>
                                <input type="time" id="time" >
                            </div>
                        </div>
                        <div class="form-row submit-btn">
                            <div class="input-data" >
                                <input type="submit" class="blue-btn" style="font-size: 15px;" value="Search">
                            </div>    
                            <div class="input-data">
                                <input type="submit" class="red-btn" value="Back" style="font-size: 15px;" onclick="closeForm()">
                            </div>
                        </div>
                    </form>
                    </div>
                
                    <script>
                        function openForm() {
                            document.getElementById("popupsearch").style.display = "block";
                        }
        
                        function closeForm() {
                            document.getElementById("popupsearch").style.display = "none";
                        }
                    </script>
                
                    <script>
                        $('.icon').click(function(){
                            $('span').toggleClass("cancel");
                        });
                    </script>
                    <div class="container-table">
                        <h1>Ticket Details</h1>
                        <div class="res-table">
                            <table class="blue">
                                <thead>
                                    <tr>
                                        <th>Train ID</th>
                                        <th>Name</th>
                                        <th>Date</th>
                                        <th>Time</th>
                                        <th>Compartment No</th>
                                        <th>Ticket ID</th>   
                                    </tr>
                                </thead>
                                <tr>
                                    <td data-th="Train ID"> BLa</td>
                                    <td data-th="Name">BLa</td>
                                    <td data-th="Date">BLa</td>
                                    <td data-th="Time">BLa</td>
                                    <td data-th="Compartment No">BLa</td>
                                    <td data-th="Ticket ID">BLa</td>
                                   </td>
                                </tr>
                                <tr>
                                    <td data-th="Train ID"> BLa</td>
                                    <td data-th="Name">BLa</td>
                                    <td data-th="Date">BLa</td>
                                    <td data-th="Time">BLa</td>
                                    <td data-th="Compartment No">BLa</td>
                                    <td data-th="Ticket ID">BLa</td>
				                    </td>
                                </tr>
                            </table>
                            <button type="submit" class="back-btn">Print</button>  
                        </div>      
                    </div>
                </div>
                
            </div>
        </div>
<?php
    require APPROOT.'/views/includes/footer.php';
?>

