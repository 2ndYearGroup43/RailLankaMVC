<!DOCTYPE html>
<html>
<head>
	<title>Update Compartment Details</title>
	<meta name="viewport" content="width-device-width, intial-scale=1.0">
	<link rel="stylesheet" href="<?php echo URLROOT ?>/public/css/ddd.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <script  src="http://code.jquery.com/jquery-3.5.1.js"></script>
        <script>
            $(document).ready(function(){
                $('#icon').click(function(){
                    $('ul').toggleClass('show');
                })
            })
        </script>
</head>
<body>
<?php
    require APPROOT.'/views/includes/manage_compartment_navigation.php';
?> 
<div class="body-section">
        <div class="content-flexrow">
           <div class="container">
            <div class="text">Update Compartment</div>
            <form action="<?php echo URLROOT; ?>/manage_compartment/edit/<?php echo $data['manage_compartment']->trainId?>" method = "POST">
                            <div class="form-row">
                                <div class="input-data">
                                    <label for="trainId">Train ID</label>
                                    <input type="text" name="trainId" value="<?php echo $data['manage_compartment']->trainId?>" id="trainId" required >
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
                                    <input type="text" name="class" value="<?php echo $data['manage_compartment']->class?>" id="class" required >
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
                                    <input type="text" name="type" value="<?php echo $data['manage_compartment']->type?>" id="type" required >
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