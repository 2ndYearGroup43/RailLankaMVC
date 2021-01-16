<?php
    require APPROOT.'/views/includes/resofficer_head.php';
?>
<?php
    require APPROOT.'/views/includes/admin_navigation.php';
?>  
 
<div class="body-section">
        <div class="content-flexrow">
           <div class="container">
            <div class="text" style="color: #13406d;">Manage Trains <small style="color: black;">Update Compartments</small></div>
            <form action="#" method = "POST">
                            <div class="form-row">
                                <div class="input-data">
                                    <label for="compartmentNo">Compartment No</label>
                                    <input type="text" name="compartmentNo"  id="compartmentNo" required >
                                    <span class="invalidFeedback">
                                        <?php echo $data['compartmentNoError'];?>
                                    </span>
                                </div>
                                <div class="input-data">
                                    <label for="class">Class</label>
                                    <select name="class" id="class" required>
                                        <option >First</option>
                                        <option >Second</option>
                                        <option >Third</option>
                                    </select>
                                    <span class="invalidFeedback">
                                        <?php echo $data['classError'];?>
                                    </span>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="input-data">
                                    <label for="type">Type</label>
                                    <select name="type" id="type" required>
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
                                    <input type="submit" class="blue-btn" name="submit" value="Update Compartment">
                                </div>
                            </div>
                        </form>
                        
                    <button type="button" id="availdays-btn" class="collapsible" onclick="collapseContent()">View Added Compartments <span class="fa fa-caret-down" aria-hidden="true"></span></button>
                    <div class="collapsible-content">
                        <table class="blue" style="margin-top: 0px;">
                            <thead>
                                <tr>
                                    <th>Compartment No</th>
                                    <th>Class</th>
                                    <th>No of Seats</th>
                                    <th>Type</th>
                                    <th>Manage</th>
                                </tr>
                            </thead>
                            <tbody>                            
                            <?php foreach($data['compartments'] as $compartment):?>                                
                                <tr>
                                    <td data-th="Compartment No"><?php echo $compartment->compartmentNo?></td>
                                    <td data-th="Class"><?php echo $compartment->class?></td>
                                    <td data-th="No of Seats"><?php echo $compartment->noofseats?></td>
                                    <td data-th="Type"><?php echo $compartment->type?></td>
                                    <td data-th="Type"><input type="button" classr="red-btn" value="Delete"></td>
                                </tr>
                            <?php endforeach; ?>
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