<?php 

	require APPROOT . '/views/includes/passenger_head.php';
	require APPROOT . '/views/includes/passenger_navigation.php';
?>

<!-- <?php var_dump($_SESSION); ?>  -->

<!-- Further Details -->
	<div class="body-section">
		<div class="content-row">
		</div>
		<div class="content-row">
		</div>
		<div class="conf-ticket" id="review">
			<div>
				<img src="<?php echo URLROOT ?>/public/img/logoc.jpg">
			</div>
			<h1 class="title">BOOKING REVIEW</h1>
			<div class="summary">
				<center><p>We will email you a confirmation of this booking.</p><p> You may also view your reservation details online at any time.</p></center>
			</div>
			
			<div class="summary-header">
				<h3>CUSTOMER DETAILS</h3>
			</div>
			<div class=summary>
				<div class="acc-wrapper">
					    <div class="acc-form">
					      	<div class="acc-inputfield">
					          	<label>First Name *</label>
					          	<input type="text" class="acc-input" required>
					      	</div> 
					      	<div class="acc-inputfield">
					          	<label>Last Name *</label>
					          	<input type="text" class="acc-input" required>
					      	</div>  
					      	<div class="acc-inputfield">
					          	<label>Email Address *</label>
					          	<input type="text" placeholder="user1@gmail.com" class="acc-input" disabled>
					      	</div> 
					      	<div class="acc-inputfield">
					          	<label>NIC/Passport No. *</label>
					          	<input type="text" placeholder="976709531V" class="acc-input" disabled>
					      	</div> 
					      	<div class="acc-inputfield">
					          	<label>Phone Number *</label>
					          	<input type="text" class="acc-input" required>
					      	</div> 
					      	<div class="acc-inputfield">
					          	<label>Address Number *</label>
					          	<input type="text" class="acc-input" required>
					      	</div> 
					      	<div class="acc-inputfield">
					          	<label>Street *</label>
					          	<input type="text" class="acc-input" required>
					      	</div> 
					      	<div class="acc-inputfield">
					          	<label>City *</label>
					          	<input type="text" class="acc-input" required>
					      	</div> 
					      	<div class="acc-inputfield">
					          	<label>Country *</label>
					          	<div class="acc-custom_select" required>
						            <select>
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
						                <option value="Sri Lanka" selected>Sri Lanka</option>
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
					    </div>
					</div>
			</div>
			
			<div class="summary-header">
				<h3>YOUR JOURNEY</h3>
			</div>
			<div class="summary">
			
				<div class="journey">
					Colombo Fort <i class="fa fa-long-arrow-right" aria-hidden="true"></i> Badulla
				</div>
				<div class="journey-row">
					<div class="journey-details">
						<p>Intercity Express Train <b>Denuwara Menike</b></p>
						<p><i class="fa fa-calendar-o" aria-hidden="true"></i> 20th June 2020</p>
						<p><i class="fa fa-clock-o" aria-hidden="true"></i> 6.30 AM -> 15.01 AM</p>
						<p><i class="fa fa-clock-o" aria-hidden="true"></i> 8 hrs 43 mins</p>
						<p>Train to Badulla</p>
					</div>
					<div class="journey-seats">
						<p>Train ID: 1001</p>
						<p>Seat Numbers:</p>

							<ul>
								<li>Compartment A :  21 , 22</li>
								<li>Compartment C :  33 , 34</li>
							</ul> 
						
					</div>
				</div>
			</div>
			<br>
			
			<div class="summary-header">
				<h3>BOOKING AND PAYMENT SUMMARY</h3>
			</div>
			<div class="summary">
				<table class="content-table" id="booking-rev-table">
					<thead>
						<tr>
							<td data-label="Type">Type</td>
							<td data-label="Price">Price</td>
							<td data-label="Quantity">Quantity</td>
							<td data-label="Total">Total</td>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td data-label="Type">First Class</td>
							<td data-label="Price">Rs. 1700.00</td>
							<td data-label="Quantity">2</td>
							<td data-label="Total">Rs. 3400.00</td>
						</tr>
						<tr>
							<td data-label="Type">Second Class</td>
							<td data-label="Price">Rs. 1000.00</td>
							<td data-label="Quantity">2</td>
							<td data-label="Total">Rs. 1000.00</td>
						</tr>
						<tr class="grand-total">
							<td>Total</td>
							<td></td>
							<td></td>
							<td>Rs. 4400.00</td>
						</tr>
					</tbody>
				</table>
			</div>
			<br>
			
			<div id="cancel-policy" class="summary">
				<div>
					<h3>CANCELLATION POLICY</h3>
				</div>
				<p>Deposit is non-refundable and will be charged to your credit card.</p>
				<p>A passenger is entitled to a refund on the ticket price if a train journey is marked as cancelled, regardless of the reason. A full refund can be obtained by producing the email confirmation/e-ticket at the counter.</p>
			</div>

			<br><br>
			
			<button onclick="location.href='<?php echo URLROOT; ?>/passengerReservations/bookingConf'" class="btn checkout-btn">Checkout &raquo;</button>
			<p class="options">Back to seat map? <a data-target="alert-warning-popup" class="alert-btn" href="#">Click here.</a></p>

			<img id="payment-image" src="<?php echo URLROOT ?>/public/img/payhere.jpg">

		</div>
		<div class="content-row">
		</div>
		<div class="content-row">		
		</div>
	</div>
	<!-- end of further details -->

	<!-- alert warning pop up -->
	<div class="flash-alert-box" id="alert-warning-popup">
		<div class="alert-box-content">
			<div class="alert-icon">
				<i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
			</div>
			<div class="alert-body">
				<h3>Are you sure?</h3>
				<p>You will lose unsaved changes if you continue</p>
				<button onclick="location.href='<?php echo URLROOT; ?>/passengerReservations/displaySeatMaps'" class="proceed-btn">Proceed Anyway</button>
			</div>
			<button type="button" class="close-alert">&times;</button>
		</div>
	</div>
	<!-- end of alert warning popup -->

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