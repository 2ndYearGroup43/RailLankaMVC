<?php
    require APPROOT.'/views/includes/resofficer_head.php';
?>
<?php
    require APPROOT.'/views/includes/train_management_navigation.php';
?>
<div class="body-section">
        <div class="content-flexrow">
           <div class="container">
            <div class="text" style="color: #13406d;">Manage Trains <small style="color: black;">Update Compartments</small></div>
            <form action="<?php echo URLROOT; ?>/Admin_manage_compartments/edit/<?php echo $data['manage_compartment']->trainId?>" method = "POST">
                            <div class="form-row">
                                <div class="input-data">
                                    <label for="trainId">Train ID</label>
                                    <select name="trainId" id="trainId" required>
                                        <option value=""><?php echo $data['manage_compartment']->trainId?></option>
                                        <?php foreach ($data['trains'] as $train ):?>
                                            <option value="<?php echo $train->trainId?>"><?php echo $train->trainId?></option>
                                        <?php endforeach;?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="input-data">
                                    <label for="compartmentNo">Compartment No</label>
                                    <input type="text" name="compartmentNo" value="<?php echo $data['manage_compartment']->compartmentNo?>" id="compartmentNo" required >
                                    <span class="invalidFeedback">
                                        <?php echo $data['compartmentNoError'];?>
                                    </span>
                                </div>
                                <div class="input-data">
                                    <label for="class">Class</label>
                                    <select name="class" id="class" required>
                                        <option ><?php echo $data['manage_compartment']->class?></option>
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
                                    <label for="noofseats">No of Seats</label>
                                    <input type="text" name="noofseats" value="<?php echo $data['manage_compartment']->noofseats?>" id="noofseats" required >
                                    <span class="invalidFeedback">
                                        <?php echo $data['noofseatsError'];?>
                                    </span>
                                </div>
                                <div class="input-data">
                                    <label for="type">Type</label>
                                    <select name="type" id="type" required>
                                        <option value=""><?php echo $data['manage_compartment']->type?></option>
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
                                    <th>Train ID</th>
                                    <th>Compartment No</th>
                                    <th>Class</th>
                                    <th>No of Seats</th>
                                    <th>Type</th>
                                </tr>
                            </thead>
                            <tbody>                                
                            <?php foreach($data['added_data'] as $post):?>                                
                                <tr>
                                    <td data-th="Train ID"><?php echo $post->trainId?></td>
                                    <td data-th="Compartment No"><?php echo $post->compartmentNo?></td>
                                    <td data-th="Class"><?php echo $post->class?></td>
                                    <td data-th="No of Seats"><?php echo $post->noofseats?></td>
                                    <td data-th="Type"><?php echo $post->type?></td>
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