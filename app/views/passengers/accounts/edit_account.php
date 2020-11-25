<?php 

	//echo out databse info to the screen
	// foreach ($data['users'] as $user) {
	// 	echo "Information: " . $user->user_name . $user->user_email;
	// 	echo "<br>";
	// }
	
	// isPassenger();
	require APPROOT . '/views/includes/passenger_head.php';
	require APPROOT . '/views/includes/passenger_navigation.php';
?>

<!-- <?php var_dump($_SESSION); ?>  -->


<!-- Account Details -->
	<div class="body-section">
		<div class="content-row">
		</div>
		<div class="content-row">
		</div>
		<div class="profile-container">
			<h1 class="title">Edit Profile</h1>
			<!-- <h3 class="title" style="text-align: left"><a href="<?php echo URLROOT; ?>/passengerAccounts/displayAccount"><i class="fa fa-angle-double-left"></i></a> Back To Profile</h3> -->
			<div class="tabstop">
				<div class="tabs__sidebartop">
					<button class="tabs__buttontop" data-for-tab="1"> <span>Edit Profile</span> <i class="fa fa-edit" aria-hidden="true"></i> </button>
					<button class="tabs__buttontop" data-for-tab="2"> <span>Reset Password</span> <i class="fa fa-key" aria-hidden="true"></i></button>
					<button class="tabs__buttontop" data-for-tab="3"> <span>Delete Account</span> <i class="fa fa-trash-o" aria-hidden="true"></i></button>
				</div>

				<div class="tabs__contenttop" data-tab="1">
					<div class="acc-wrapper">
					    <div class="acc-title">
					      UPDATE ACCOUNT
					    </div>
					    <div class="acc-form">
					      	<div class="acc-inputfield">
					          	<label>First Name</label>
					          	<input type="text" placeholder="John" class="acc-input">
					      	</div> 
					      	<div class="acc-inputfield">
					          	<label>Last Name</label>
					          	<input type="text" placeholder="Doe" class="acc-input">
					      	</div>  
					      	<div class="acc-inputfield">
					          	<label>Phone Number</label>
					          	<input type="text" placeholder="+94 777 875634" class="acc-input">
					      	</div> 
					      	<div class="acc-inputfield">
					          	<label>Address Number</label>
					          	<input type="text" placeholder="40" class="acc-input">
					      	</div> 
					      	<div class="acc-inputfield">
					          	<label>Street</label>
					          	<input type="text" placeholder="Park Street" class="acc-input">
					      	</div> 
					      	<!-- <div class="acc-inputfield">
					          	<label>Address</label>
					          	<textarea class="acc-textarea"></textarea>
					      	</div> --> 
					      	<div class="acc-inputfield">
					          	<label>City</label>
					          	<input type="text" placeholder="Colombo 7" class="acc-input">
					      	</div> 
					      	<div class="acc-inputfield">
					          	<label>Country</label>
					          	<div class="acc-custom_select">
						            <select>
						              	<option value="">Select</option>
						              	<option value="Afghanistan">Afghanistan</option>
						                <option value="Åland Islands">Åland Islands</option>
						                <option value="Albania">Albania</option>
						                <option value="Algeria">Algeria</option>
						                <option value="American Samoa">American Samoa</option>
						                <option value="Andorra">Andorra</option>
						                <option value="Angola">Angola</option>
						                <option value="Anguilla">Anguilla</option>
						                <option value="Antarctica">Antarctica</option>
						                <option value="Antigua and Barbuda">Antigua and Barbuda</option>
						                <option value="Argentina">Argentina</option>
						                <option value="Armenia">Armenia</option>
						                <option value="Aruba">Aruba</option>
						                <option value="Australia">Australia</option>
						                <option value="Austria">Austria</option>
						                <option value="Azerbaijan">Azerbaijan</option>
						                <option value="Bahamas">Bahamas</option>
						                <option value="Bahrain">Bahrain</option>
						                <option value="Bangladesh">Bangladesh</option>
						                <option value="Barbados">Barbados</option>
						                <option value="Belarus">Belarus</option>
						                <option value="Belgium">Belgium</option>
						                <option value="Belize">Belize</option>
						                <option value="Benin">Benin</option>
						                <option value="Bermuda">Bermuda</option>
						                <option value="Bhutan">Bhutan</option>
						                <option value="Bolivia">Bolivia</option>
						                <option value="Bosnia and Herzegovina">Bosnia and Herzegovina</option>
						                <option value="Botswana">Botswana</option>
						                <option value="Bouvet Island">Bouvet Island</option>
						                <option value="Brazil">Brazil</option>
						                <option value="British Indian Ocean Territory">British Indian Ocean Territory</option>
						                <option value="Brunei Darussalam">Brunei Darussalam</option>
						                <option value="Bulgaria">Bulgaria</option>
						                <option value="Burkina Faso">Burkina Faso</option>
						                <option value="Burundi">Burundi</option>
						                <option value="Cambodia">Cambodia</option>
						                <option value="Cameroon">Cameroon</option>
						                <option value="Canada">Canada</option>
						                <option value="Cape Verde">Cape Verde</option>
						                <option value="Cayman Islands">Cayman Islands</option>
						                <option value="Central African Republic">Central African Republic</option>
						                <option value="Chad">Chad</option>
						                <option value="Chile">Chile</option>
						                <option value="China">China</option>
						                <option value="Christmas Island">Christmas Island</option>
						                <option value="Cocos (Keeling) Islands">Cocos (Keeling) Islands</option>
						                <option value="Colombia">Colombia</option>
						                <option value="Comoros">Comoros</option>
						                <option value="Congo">Congo</option>
						                <option value="Congo, The Democratic Republic of The">Congo, The Democratic Republic of The</option>
						                <option value="Cook Islands">Cook Islands</option>
						                <option value="Costa Rica">Costa Rica</option>
						                <option value="Cote D'ivoire">Cote D'ivoire</option>
						                <option value="Croatia">Croatia</option>
						                <option value="Cuba">Cuba</option>
						                <option value="Cyprus">Cyprus</option>
						                <option value="Czech Republic">Czech Republic</option>
						                <option value="Denmark">Denmark</option>
						                <option value="Djibouti">Djibouti</option>
						                <option value="Dominica">Dominica</option>
						                <option value="Dominican Republic">Dominican Republic</option>
						                <option value="Ecuador">Ecuador</option>
						                <option value="Egypt">Egypt</option>
						                <option value="El Salvador">El Salvador</option>
						                <option value="Equatorial Guinea">Equatorial Guinea</option>
						                <option value="Eritrea">Eritrea</option>
						                <option value="Estonia">Estonia</option>
						                <option value="Ethiopia">Ethiopia</option>
						                <option value="Falkland Islands (Malvinas)">Falkland Islands (Malvinas)</option>
						                <option value="Faroe Islands">Faroe Islands</option>
						                <option value="Fiji">Fiji</option>
						                <option value="Finland">Finland</option>
						                <option value="France">France</option>
						                <option value="French Guiana">French Guiana</option>
						                <option value="French Polynesia">French Polynesia</option>
						                <option value="French Southern Territories">French Southern Territories</option>
						                <option value="Gabon">Gabon</option>
						                <option value="Gambia">Gambia</option>
						                <option value="Georgia">Georgia</option>
						                <option value="Germany">Germany</option>
						                <option value="Ghana">Ghana</option>
						                <option value="Gibraltar">Gibraltar</option>
						                <option value="Greece">Greece</option>
						                <option value="Greenland">Greenland</option>
						                <option value="Grenada">Grenada</option>
						                <option value="Guadeloupe">Guadeloupe</option>
						                <option value="Guam">Guam</option>
						                <option value="Guatemala">Guatemala</option>
						                <option value="Guernsey">Guernsey</option>
						                <option value="Guinea">Guinea</option>
						                <option value="Guinea-bissau">Guinea-bissau</option>
						                <option value="Guyana">Guyana</option>
						                <option value="Haiti">Haiti</option>
						                <option value="Heard Island and Mcdonald Islands">Heard Island and Mcdonald Islands</option>
						                <option value="Holy See (Vatican City State)">Holy See (Vatican City State)</option>
						                <option value="Honduras">Honduras</option>
						                <option value="Hong Kong">Hong Kong</option>
						                <option value="Hungary">Hungary</option>
						                <option value="Iceland">Iceland</option>
						                <option value="India">India</option>
						                <option value="Indonesia">Indonesia</option>
						                <option value="Iran, Islamic Republic of">Iran, Islamic Republic of</option>
						                <option value="Iraq">Iraq</option>
						                <option value="Ireland">Ireland</option>
						                <option value="Isle of Man">Isle of Man</option>
						                <option value="Israel">Israel</option>
						                <option value="Italy">Italy</option>
						                <option value="Jamaica">Jamaica</option>
						                <option value="Japan">Japan</option>
						                <option value="Jersey">Jersey</option>
						                <option value="Jordan">Jordan</option>
						                <option value="Kazakhstan">Kazakhstan</option>
						                <option value="Kenya">Kenya</option>
						                <option value="Kiribati">Kiribati</option>
						                <option value="Korea, Democratic People's Republic of">Korea, Democratic People's Republic of</option>
						                <option value="Korea, Republic of">Korea, Republic of</option>
						                <option value="Kuwait">Kuwait</option>
						                <option value="Kyrgyzstan">Kyrgyzstan</option>
						                <option value="Lao People's Democratic Republic">Lao People's Democratic Republic</option>
						                <option value="Latvia">Latvia</option>
						                <option value="Lebanon">Lebanon</option>
						                <option value="Lesotho">Lesotho</option>
						                <option value="Liberia">Liberia</option>
						                <option value="Libyan Arab Jamahiriya">Libyan Arab Jamahiriya</option>
						                <option value="Liechtenstein">Liechtenstein</option>
						                <option value="Lithuania">Lithuania</option>
						                <option value="Luxembourg">Luxembourg</option>
						                <option value="Macao">Macao</option>
						                <option value="Macedonia, The Former Yugoslav Republic of">Macedonia, The Former Yugoslav Republic of</option>
						                <option value="Madagascar">Madagascar</option>
						                <option value="Malawi">Malawi</option>
						                <option value="Malaysia">Malaysia</option>
						                <option value="Maldives">Maldives</option>
						                <option value="Mali">Mali</option>
						                <option value="Malta">Malta</option>
						                <option value="Marshall Islands">Marshall Islands</option>
						                <option value="Martinique">Martinique</option>
						                <option value="Mauritania">Mauritania</option>
						                <option value="Mauritius">Mauritius</option>
						                <option value="Mayotte">Mayotte</option>
						                <option value="Mexico">Mexico</option>
						                <option value="Micronesia, Federated States of">Micronesia, Federated States of</option>
						                <option value="Moldova, Republic of">Moldova, Republic of</option>
						                <option value="Monaco">Monaco</option>
						                <option value="Mongolia">Mongolia</option>
						                <option value="Montenegro">Montenegro</option>
						                <option value="Montserrat">Montserrat</option>
						                <option value="Morocco">Morocco</option>
						                <option value="Mozambique">Mozambique</option>
						                <option value="Myanmar">Myanmar</option>
						                <option value="Namibia">Namibia</option>
						                <option value="Nauru">Nauru</option>
						                <option value="Nepal">Nepal</option>
						                <option value="Netherlands">Netherlands</option>
						                <option value="Netherlands Antilles">Netherlands Antilles</option>
						                <option value="New Caledonia">New Caledonia</option>
						                <option value="New Zealand">New Zealand</option>
						                <option value="Nicaragua">Nicaragua</option>
						                <option value="Niger">Niger</option>
						                <option value="Nigeria">Nigeria</option>
						                <option value="Niue">Niue</option>
						                <option value="Norfolk Island">Norfolk Island</option>
						                <option value="Northern Mariana Islands">Northern Mariana Islands</option>
						                <option value="Norway">Norway</option>
						                <option value="Oman">Oman</option>
						                <option value="Pakistan">Pakistan</option>
						                <option value="Palau">Palau</option>
						                <option value="Palestinian Territory, Occupied">Palestinian Territory, Occupied</option>
						                <option value="Panama">Panama</option>
						                <option value="Papua New Guinea">Papua New Guinea</option>
						                <option value="Paraguay">Paraguay</option>
						                <option value="Peru">Peru</option>
						                <option value="Philippines">Philippines</option>
						                <option value="Pitcairn">Pitcairn</option>
						                <option value="Poland">Poland</option>
						                <option value="Portugal">Portugal</option>
						                <option value="Puerto Rico">Puerto Rico</option>
						                <option value="Qatar">Qatar</option>
						                <option value="Reunion">Reunion</option>
						                <option value="Romania">Romania</option>
						                <option value="Russian Federation">Russian Federation</option>
						                <option value="Rwanda">Rwanda</option>
						                <option value="Saint Helena">Saint Helena</option>
						                <option value="Saint Kitts and Nevis">Saint Kitts and Nevis</option>
						                <option value="Saint Lucia">Saint Lucia</option>
						                <option value="Saint Pierre and Miquelon">Saint Pierre and Miquelon</option>
						                <option value="Saint Vincent and The Grenadines">Saint Vincent and The Grenadines</option>
						                <option value="Samoa">Samoa</option>
						                <option value="San Marino">San Marino</option>
						                <option value="Sao Tome and Principe">Sao Tome and Principe</option>
						                <option value="Saudi Arabia">Saudi Arabia</option>
						                <option value="Senegal">Senegal</option>
						                <option value="Serbia">Serbia</option>
						                <option value="Seychelles">Seychelles</option>
						                <option value="Sierra Leone">Sierra Leone</option>
						                <option value="Singapore">Singapore</option>
						                <option value="Slovakia">Slovakia</option>
						                <option value="Slovenia">Slovenia</option>
						                <option value="Solomon Islands">Solomon Islands</option>
						                <option value="Somalia">Somalia</option>
						                <option value="South Africa">South Africa</option>
						                <option value="South Georgia and The South Sandwich Islands">South Georgia and The South Sandwich Islands</option>
						                <option value="Spain">Spain</option>
						                <option value="Sri Lanka">Sri Lanka</option>
						                <option value="Sudan">Sudan</option>
						                <option value="Suriname">Suriname</option>
						                <option value="Svalbard and Jan Mayen">Svalbard and Jan Mayen</option>
						                <option value="Swaziland">Swaziland</option>
						                <option value="Sweden">Sweden</option>
						                <option value="Switzerland">Switzerland</option>
						                <option value="Syrian Arab Republic">Syrian Arab Republic</option>
						                <option value="Taiwan, Province of China">Taiwan, Province of China</option>
						                <option value="Tajikistan">Tajikistan</option>
						                <option value="Tanzania, United Republic of">Tanzania, United Republic of</option>
						                <option value="Thailand">Thailand</option>
						                <option value="Timor-leste">Timor-leste</option>
						                <option value="Togo">Togo</option>
						                <option value="Tokelau">Tokelau</option>
						                <option value="Tonga">Tonga</option>
						                <option value="Trinidad and Tobago">Trinidad and Tobago</option>
						                <option value="Tunisia">Tunisia</option>
						                <option value="Turkey">Turkey</option>
						                <option value="Turkmenistan">Turkmenistan</option>
						                <option value="Turks and Caicos Islands">Turks and Caicos Islands</option>
						                <option value="Tuvalu">Tuvalu</option>
						                <option value="Uganda">Uganda</option>
						                <option value="Ukraine">Ukraine</option>
						                <option value="United Arab Emirates">United Arab Emirates</option>
						                <option value="United Kingdom">United Kingdom</option>
						                <option value="United States">United States</option>
						                <option value="United States Minor Outlying Islands">United States Minor Outlying Islands</option>
						                <option value="Uruguay">Uruguay</option>
						                <option value="Uzbekistan">Uzbekistan</option>
						                <option value="Vanuatu">Vanuatu</option>
						                <option value="Venezuela">Venezuela</option>
						                <option value="Viet Nam">Viet Nam</option>
						                <option value="Virgin Islands, British">Virgin Islands, British</option>
						                <option value="Virgin Islands, U.S.">Virgin Islands, U.S.</option>
						                <option value="Wallis and Futuna">Wallis and Futuna</option>
						                <option value="Western Sahara">Western Sahara</option>
						                <option value="Yemen">Yemen</option>
						                <option value="Zambia">Zambia</option>
						                <option value="Zimbabwe">Zimbabwe</option>
						            </select>
						        </div>
						    </div> 
					    	<div class="acc-inputfield">
					        	<input type="submit" value="Update" class="acc-btn">
					      	</div>
					    </div>
					</div>
				</div>

				<div class="tabs__contenttop" data-tab="2">
					<div class="acc-wrapper">
					    <div class="acc-title">
					    	RESET PASSWORD
					    </div>
					    <div class="acc-form">
					    	<div class="acc-inputfield">
					          	<label>Current Password</label>
					          	<input type="password" name="password" class="acc-input">
					       	</div>  
					       	<div class="acc-inputfield">
					          	<label>New Password</label>
					          	<input type="password" name="newPassword" class="acc-input">
					       	</div>  
					      	<div class="acc-inputfield">
					          	<label>Confirm New Password</label>
					          	<input type="password" name="confirmPassword" class="acc-input">
					       	</div> 
					    	<div class="acc-inputfield">
					        	<input type="submit" value="Reset" class="acc-btn">
					      	</div>
					    </div>
					</div>
				</div>

				<div class="tabs__contenttop" data-tab="3">
					<div class="acc-wrapper">
					    <div class="acc-title">
					    	DELETE YOUR ACCOUNT?
					    </div>
					    <div class="acc-form">
					    	<center><p>We're sorry to hear you'd like to delete your account.</p>
					    	<br> 
					    	<p>Keep in mind that you will not be able to reactivate your account or retrieve any of the content or information you have added.</p>
					    	<br>
					    	<p>If you would still like your account deleted, click "Delete My Account".</p></center>
					    	<br>
					    	<div class="acc-inputfield">
					        	<input type="submit" value="Delete My Account" class="acc-btn del-acc">
					      	</div>
					    </div>
					</div>
				</div>

			</div>

			<button type="submit" data-target="alert-warning-popup" class="btn blue-btn alert-btn back-btn"><span>Back</span></button>
		</div>

		<div class="content-row">
		</div>
		<div class="content-row">
		</div>
	</div>

	<div class="popup-box">
		<i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
		<h1>Delete Your Account</h1>
		<!-- <p>We're sorry to hear you'd like to delete your account.<br> Keep in mind that you will not be able to reactivate your account or retrieve any of the content or information you have added.</p> -->
		<label>Are you sure you wanna proceed?</label>
		<div class="btns">
			<a href="#" class="btn1">Cancel</a>
			<a href="#" class="btn2">Delete Account</a>
		</div>
	</div>

	<!-- alert warning pop up -->
	<div class="flash-alert-box" id="alert-warning-popup">
		<div class="alert-box-content">
			<div class="alert-icon">
				<i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
			</div>
			<div class="alert-body">
				<h3>Are you sure?</h3>
				<p>You will lose any unsaved changes.</p>
				<!-- <p><a>Proceed Anyway?</a></p> -->
				<button onclick="location.href='<?php echo URLROOT; ?>/passengerAccounts/displayAccount'" class="proceed-btn">Proceed Anyway</button>
			</div>
			<button type="button" class="close-alert">&times;</button>
		</div>
	</div>
	<!-- end of alert warning popup -->

	<!-- js for tabs -->
	<script>
		function setupTabs() {
			document.querySelectorAll(".tabs__buttontop").forEach(button => {
				button.addEventListener("click", () => {
					const sideBar = button.parentElement;
					const tabsContainer = sideBar.parentElement;
					const tabNumber = button.dataset.forTab;
					const tabToActivate = tabsContainer.querySelector(`.tabs__contenttop[data-tab="${tabNumber}"]`);

					// console.log(sideBar);
					// console.log(tabsContainer);
					// console.log(tabNumber);
					// console.log(tabToActivate);

					sideBar.querySelectorAll(".tabs__buttontop").forEach(button => {
						button.classList.remove("tabs__buttontop--active");
					});

					tabsContainer.querySelectorAll(".tabs__contenttop").forEach(button => {
						button.classList.remove("tabs__contenttop--active");
					});

					button.classList.add("tabs__buttontop--active");
					tabToActivate.classList.add("tabs__contenttop--active");
				});
			});
		}

		document.addEventListener("DOMContentLoaded", () => {
			setupTabs();

			document.querySelectorAll(".tabstop").forEach(tabsContainer => {tabsContainer.querySelector(".tabs__sidebartop .tabs__buttontop").click();
			});
		});

	</script>
	<!-- end of js for tabs -->


	<!-- js for pop up alert  -->
	<script>
		$(document).ready(function(){
			$('.del-acc').click(function(){
				$('.popup-box').css({
					"opacity":"1",
					"pointer-events":"auto"
				});
			});
			$('.btn1').click(function(){
				$('.popup-box').css({
					"opacity":"0",
					"pointer-events":"none"
					// "left":"event.pageX"
					// "top":"event.pageY"
				});
			});
			$('.btn2').click(function(){
				$('.popup-box').css({
					"opacity":"0",
					"pointer-events":"none"
				});
				window.location.href='<?php echo URLROOT; ?>/pages/index';

			});
		});
	</script>
	<!-- end of js for pop up alert  -->

	<!-- js for flash message -->
	<script>
		const alertBtn = document.querySelectorAll(".alert-btn");
		alertBtn.forEach(function(btn){
			btn.addEventListener("click", function(){
				const target = this.getAttribute("data-target");
				const alertBox = document.getElementById(target)
				alertBox.classList.add("alert-box-show");

				const closeAlert = alertBox.querySelector(".close-alert");
				closeAlert.addEventListener("click",function(){
					alertBox.classList.remove("alert-box-show");
				});

				alertBox.addEventListener("click",function(event){
					if(event.target === this){
						alertBox.classList.remove("alert-box-show");
					}
				});
			});
		});

	</script>
	<!-- end of js for flash message -->

<?php require APPROOT . '/views/includes/passenger_footer.php'; ?>