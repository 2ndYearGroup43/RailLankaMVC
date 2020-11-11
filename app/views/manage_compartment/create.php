<?php
    require APPROOT.'/views/includes/head.php';
?>
<?php
    require APPROOT.'/views/includes/train_management.php';
?>    
        <div class="body-section">
            <div class="content-flexrow">
                <div class="container">
                    <div class="text" style="color: #13406d;">Manage Trains <small style="color: black;">Add New Compartments</small></div>
                        <form action="<?php echo URLROOT; ?>/manage_compartment/create" method = "POST">
                            <div class="form-row">
                                <div class="input-data">
                                    <label for="trainId">Train ID</label>
                                    <select name="trainId" id="trainId" required>
                                        <option value="">Select</option>
                                        <?php foreach ($data['trains'] as $train ):?>
                                            <option value="<?php echo $train->trainId?>"><?php echo $train->trainId?></option>
                                        <?php endforeach;?>
                                    </select>
                                    <span class="invalidFeedback">
                                        <?php echo $data['trainIdError'];?>
                                    </span>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="input-data">
                                    <label for="compartmentNo">Compartment No</label>
                                    <input type="text" name="compartmentNo" id="compartmentNo" required >
                                    <span class="invalidFeedback">
                                        <?php echo $data['compartmentNoError'];?>
                                    </span>
                                </div>
                                <div class="input-data">
                                    <label for="class">Class</label>
                                    <input type="text" name="class" id="class" required >
                                    <span class="invalidFeedback">
                                        <?php echo $data['classError'];?>
                                    </span>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="input-data">
                                    <label for="noofseats">No of Seats</label>
                                    <input type="text" name="noofseats" id="noofseats" required >
                                    <span class="invalidFeedback">
                                        <?php echo $data['noofseatsError'];?>
                                    </span>
                                </div>
                                <div class="input-data">
                                    <label for="type">Type</label>
                                    <select name="type" id="type" required>
                                        <option value="">Select</option>
                                        <?php foreach ($data['types'] as $Type ):?>
                                            <option value="<?php echo $Type->typeNo?>"><?php echo $Type->typeNo?></option>
                                        <?php endforeach;?>
                                    </select>
                                    <span class="invalidFeedback">
                                        <?php echo $data['typeError'];?>
                                    </span>
                                </div>
                            </div>
                            <div class="form-row submit-btn">
                                <div class="input-data">
                                    <input type="submit" class="blue-btn" name="submit" value="Add Compartment">
                                </div>
                            </div>
                        </form>
                        
                    <button type="button" id="availdays-btn" class="collapsible" onclick="collapseContent()">View Added Compartments <span class="fa fa-caret-down" aria-hidden="true"></span></button>
                    <div class="collapsible-content">
                        <table class="blue" style="margin-top: 0px;">
                            <thead>
                                <tr>
                                    <th>Train ID</th>
                                    <th>Compartment No</th>
                                    <th>Class</th>
                                    <th>No of Seats</th>
                                    <th>Type</th>
                                </tr>
                            </thead>
                            <tbody>                                
                                <tr>
                                    <td data-th="Train ID">bla</td>
                                    <td data-th="Compartment No">bla</td>
                                    <td data-th="Class">bla</td>
                                    <td data-th="No of Seats">bla</td>
                                    <td data-th="Type">bla</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <button type="button" onclick="history.go(-1);" class="back-btn" value="Back">Back</button>


                    <script>
                        function collapseContent(){
                            var coll= document.getElementById("availdays-btn");
                            var content=coll.nextElementSibling;
                            if(content.style.display==="none"){
                                content.style.display="block";
                                coll.style.backgroundColor="#0c2752";
                            }else if(content.style.display="block"){
                                content.style.display="none";
                                coll.style.backgroundColor="#13406d";
                            }
                        }
                    </script>

                </div>
            </div>
        </div>
<?php
    require APPROOT.'/views/includes/footer.php';
?>