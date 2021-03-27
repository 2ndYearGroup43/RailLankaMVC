    <?php
    require APPROOT.'/views/includes/resofficer_head.php';
?>
<?php
    require APPROOT.'/views/includes/admin_navigation.php';
?>   


<script src="<?php echo URLROOT;?>/javascript/trainCompartmentAdd.js"></script>
        <div class="body-section">
            <div class="content-flexrow">
                <div class="container">
                    <div class="text" style="color: #13406d;">Manage Trains <small style="color: black;">Add New Compartments</small></div>
                        <form action="<?php echo URLROOT; ?>/Admin_manage_compartments/create/<?php echo $data['trainId'];?>" method = "POST">
                            <div class="form-row">
                                <div class="input-data">
                                    <label for="compartmentNo">Compartment No</label>
                                    <input type="text" name="compartmentNo" id="compartmentNo"  >
                                    <span class="invalidFeedback" id="compartmentNoError">
                                        <!-- <?php echo $data['compartmentNoError'];?> -->
                                    </span>
                                </div>
                                <div class="input-data">
                                    <label for="class">Class</label>
                                    <select name="class" id="trainClass" >
                                        <option >Select</option>
                                        <option >F</option>
                                        <option >S</option>
                                        <option >T</option>
                                    </select>
                                    <span class="invalidFeedback" id="classError">
                                        <!-- <?php echo $data['classError'];?> -->
                                    </span>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="input-data">
                                    <label for="type">Type</label>
                                    <select name="type" id="type" >
                                        <option value="">Select</option>
                                        <?php foreach ($data['types'] as $Type ):?>
                                            <option value="<?php echo $Type->typeNo?>"><?php echo $Type->typeNo?></option>
                                        <?php endforeach;?>
                                    </select>
                                    <span class="invalidFeedback" id="typeError">
                                        <!-- <?php echo $data['typeError'];?> -->
                                    </span>
                                </div>
                            </div>
                            
                            <div class="input-data">
                                <span class="invalidFeedback">
                                    <?php echo $data['compartmentError'];?>
                                </span>
                            </div>
                            
                            <input type="hidden" id="compartmentField" name="compartmentField">
                            <div class="form-row submit-btn">
                                <div class="input-data">
                                    <input type="button" class="blue-btn" name="submit" value="Add Compartment" onclick="Javascript:addCompartmentRow()">
                                </div>
                                <div class="input-data">
                                    <input type="submit" class="blue-btn" id="post" name="post" value="Finish">
                                </div>
                            </div>
                        </form>
                        
                    <button type="button" id="availdays-btn" class="collapsible" onclick="collapseContent()">View Added Compartments <span class="fa fa-caret-down" aria-hidden="true"></span></button>
                    <div class="collapsible-content">
                        <table class="blue" style="margin-top: 0px;" id="compartmentTable">
                            <thead>
                                <tr>
                                    <th>Compartment No</th>
                                    <th>Class</th>
                                    <th>Type</th>
                                    <th>Manage</th>
                                </tr>
                            </thead>
                            <tbody>
                         
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