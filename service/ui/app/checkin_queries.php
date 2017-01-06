<?php 
   include("service/ui/common/header.php");   
   ?>
<link rel="stylesheet" href="<?php echo WEB_ROOT?>service/public/css/checkin.css">
<link rel="stylesheet" href="<?php echo WEB_ROOT?>service/public/css/token/sumoselect.css">
<style type="text/css">
   h3{font-family: font-family: 'Roboto', sans-serif; font-size: 19pt; font-style: normal; font-weight: bold; color:#3699DD;
   text-align: center; text-decoration: none; margin-right: 832px; }
   table{font-family: Calibri; color:#3499DD; font-size: 11pt; font-style: normal;
   text-align:; background-color: #ffffff; border-collapse: collapse; }
   table.inner{border: 0px}
</style>
<script type='text/javascript' src='<?php echo WEB_ROOT?>service/public/js/token/jquery.sumoselect.min.js'></script>
<div  class="container section_wrapper checkin_pg">
    <div class="row hide-it-aj"><div class="col-md-12"><h2 align="center">Check-In</h2></div></div>

   	<div class="row  hide-it-aj"><div class="col-md-12"><h2 align="left">Patients Medical History</h2></div></div>

      <form  method="POST" id="queries">
         <h4>Reason for Visit</h4>
	        <div class="row checkin">
	         	<div class="col-md-12 col-sm-12 col-xs-12">
	                  <div class="col-md-4 col-sm-4 col-xs-12 field">
	                  	<input type="text"  required name="reason" maxlength="30" placeholder="Reason for Visit"/>
	                  </div>
	                  <div class="col-md-4 col-sm-4 col-xs-12 field">
	                  	<input required    type="text" name="concerns" maxlength="30" placeholder="Other Concerns"/>
	                  </div>
	                  <div class="col-md-4 col-sm-4 col-xs-12 field">
	                  	<div class="">
		                  	<select   required  multiple="multiple"  class="SlectB"  name="allergies" id="allergies">
		                     <option value="" disabled>Allergies</option>
		                     <option value="AdhesiveTape">AdhesiveTape</option>
		                     <option value="Barbiturates">Barbiturates</option>
		                     <option value="Codeine">Codeine</option>
		                     <option value="Antibiotics">Antibiotics</option>
		                     <option value="Aspirin">Aspirin</option>
		                     <option value="Sulfa">Sulfa</option>
		                     <option value="Latex">Latex</option>
		                     <option value="Iodine">Iodine</option>
		                     <option value="LocalAnesthetics">LocalAnesthetics</option>
		                  	</select>
		                </div>
	                  </div>
	            </div>
	        </div>

	        <div class="row checkin">
	         	<div class="col-md-12 col-sm-12 col-xs-12">
					<div class="col-md-4 col-sm-4 col-xs-12 field">
						<div class="drop-select">
							<select required   name="health" id="health">
			                  <option value="">Your Health</option>
			                  <option value="Excellent">Excellent</option>
			                  <option value="Good">Good</option>
			                  <option value="Fair">Fair</option>
			                  <option value="Poor">Poor</option>
			               	</select>
			            </div>
					</div>
					<div class="col-md-4 col-sm-4 col-xs-12 field">
						<div class="col-md-4 col-sm-4 col-xs-12 padding-0">
							<div class="drop-select">
								<select   name="medicine" id="medicine">
									<option value="">Current Medicine:</option>
									<option value="0">0</option>
									<option value="1">1</option>
									<option value="2">2</option>
								</select>
							</div>
						</div>
						<div class="col-md-4 col-sm-4 col-xs-12 padding-0">
							<div class="drop-select">
								<select  id="dosage" name="dosage">
									<option value="">Dosage:</option>
									<option value="0">0</option>
									<option value="1">1</option>
								</select>
			                </div>
						</div>
						<div class="col-md-4 col-sm-4 col-xs-12 padding-0">
							<div class="drop-select">
								<select id="frequency" name="Frequency">
									<option value="">Frequency:</option>
									<option value="0">0</option>
									<option value="1">1</option>
								</select>
							</div>
						</div>
					</div>
					<div class="col-md-4 col-sm-4 col-xs-12 field">
					</div>
	            </div>
	        </div>

	        <div class="row checkin">
	         	<div class="col-md-12 col-sm-12 col-xs-12">
					<div class="col-md-4 col-sm-4 col-xs-12 field">
						<input   type="text" name="hosp" maxlength="30" placeholder="Reason"/>
					</div>
					<div class="col-md-4 col-sm-4 col-xs-12 field">
						<div class="col-md-4 col-sm-4 col-xs-12 padding-0">
							<div class="drop-select">
								<select name="Surgeries_Day" id="Surgeries_Day">
									<option value="">Day Of surgery:</option>
									<option value="1">1</option>
									<option value="2">2</option>
									<option value="3">3</option>
									<option value="4">4</option>
									<option value="5">5</option>
									<option value="6">6</option>
									<option value="7">7</option>
									<option value="8">8</option>
									<option value="9">9</option>
									<option value="10">10</option>
									<option value="11">11</option>
									<option value="12">12</option>
									<option value="13">13</option>
									<option value="14">14</option>
									<option value="15">15</option>
									<option value="16">16</option>
									<option value="17">17</option>
									<option value="18">18</option>
									<option value="19">19</option>
									<option value="20">20</option>
									<option value="21">21</option>
									<option value="22">22</option>
									<option value="23">23</option>
									<option value="24">24</option>
									<option value="25">25</option>
									<option value="26">26</option>
									<option value="27">27</option>
									<option value="28">28</option>
									<option value="29">29</option>
									<option value="30">30</option>
									<option value="31">31</option>
								</select>
							</div>
						</div>
						<div class="col-md-4 col-sm-4 col-xs-12 padding-0">
							<div class="drop-select">
								<select id="Surgeries_Month" name="Surgeries_Month">
									<option value="">Month:</option>
									<option value="January">Jan</option>
									<option value="February">Feb</option>
									<option value="March">Mar</option>
									<option value="April">Apr</option>
									<option value="May">May</option>
									<option value="June">Jun</option>
									<option value="July">Jul</option>
									<option value="August">Aug</option>
									<option value="September">Sep</option>
									<option value="October">Oct</option>
									<option value="November">Nov</option>
									<option value="December">Dec</option>
			                  	</select>
			                </div>
						</div>
						<div class="col-md-4 col-sm-4 col-xs-12 padding-0">
							<div class="drop-select">
								<select name="Surgeries_Year" id="Surgeries_Month">
									<option value="">Year:</option>
									<option value="2012">2012</option>
									<option value="2011">2011</option>
									<option value="2010">2010</option>
									<option value="2009">2009</option>
									<option value="2008">2008</option>
									<option value="2007">2007</option>
									<option value="2006">2006</option>
									<option value="2005">2005</option>
									<option value="2004">2004</option>
									<option value="2003">2003</option>
									<option value="2002">2002</option>
									<option value="2001">2001</option>
									<option value="2000">2000</option>
									<option value="1999">1999</option>
									<option value="1998">1998</option>
									<option value="1997">1997</option>
									<option value="1996">1996</option>
									<option value="1995">1995</option>
									<option value="1994">1994</option>
									<option value="1993">1993</option>
									<option value="1992">1992</option>
									<option value="1991">1991</option>
									<option value="1990">1990</option>
									<option value="1989">1989</option>
									<option value="1988">1988</option>
									<option value="1987">1987</option>
									<option value="1986">1986</option>
									<option value="1985">1985</option>
									<option value="1984">1984</option>
									<option value="1983">1983</option>
									<option value="1982">1982</option>
									<option value="1981">1981</option>
									<option value="1980">1980</option>
	                  			</select>
	                  		</div>
						</div>
					</div>
					<div class="col-md-4 col-sm-4 col-xs-12 field">
					</div>
	            </div>
	        </div>

	        <div class="row"><div class="col-md-12"><h2 align="center">Women's Only</h2></div></div>

                  
                  
                  
                  
                  
                  
	        <div class="row checkin">
	         	<div class="col-md-12 col-sm-12 col-xs-12">
					<div class="col-md-4 col-sm-4 col-xs-12 field">
						<input <?php if($__SESSION['gender']=='2') {?>  required <?php } ?> type="text" name="preg" maxlength="30" placeholder="# of Pregnancies"/>
					</div>
					<div class="col-md-4 col-sm-4 col-xs-12 field">
						<input <?php if($__SESSION['gender']=='2') {?>  required <?php } ?>   type="text" name="misc" maxlength="30" placeholder="# of Miscarraiges"/>
					</div>
					<div class="col-md-4 col-sm-4 col-xs-12 field">
					</div>
	            </div>
	        </div>

	        <div class="row checkin">
	         	<div class="col-md-12 col-sm-12 col-xs-12">
					<div class="col-md-4 col-sm-4 col-xs-12 field">
						<input <?php if($__SESSION['gender']=='2') {?>  required <?php } ?>   type="text" name="abo" maxlength="30" placeholder="# of Abortion"/>
					</div>
					<div class="col-md-4 col-sm-4 col-xs-12 field">
						<input <?php if($__SESSION['gender']=='2') {?>  required <?php } ?>   type="text" name="living" maxlength="30" placeholder="# # of Living"/>
					</div>
					<div class="col-md-4 col-sm-4 col-xs-12 field">
					</div>
	            </div>
	        </div>

	        <div class="row checkin">
	         	<div class="col-md-12 col-sm-12 col-xs-12">
					<div class="col-md-4 col-sm-4 col-xs-12 field">
						<input <?php if($__SESSION['gender']=='2') {?>  required <?php } ?>   type="text" name="last" maxlength="30" placeholder="# Last Pap Smear"/>
					</div>
					<div class="col-md-4 col-sm-4 col-xs-12 field">
						<input <?php if($__SESSION['gender']=='2') {?>  required <?php } ?>   type="text" name="lastm" maxlength="30" placeholder="# Last Mammogram"/>
					</div>
					<div class="col-md-4 col-sm-4 col-xs-12 field">
					</div>
	            </div>
	        </div>

	        <div class="row checkin">
	         	<div class="col-md-12 col-sm-12 col-xs-12">
					<div class="col-md-4 col-sm-4 col-xs-12 field">
						<input <?php if($__SESSION['gender']=='2') {?>  required <?php } ?>   type="text" name="birth" maxlength="30" placeholder="# Birth Control Method"/>
					</div>
	            </div>
	        </div>

	        <div class="row"><div class="col-md-12"><h2 align="center">Family History</h2></div></div>

	        <div class="row checkin">
	         	<div class="col-md-12 col-sm-12 col-xs-12">
					<div class="col-md-offset-4 col-md-4 col-sm-offset-4 col-sm-4 col-xs-12 field">
						<div class="">
							<select   required  multiple="multiple"  class="SlectBo"  name="mhistory" id="history">
								<option value="" disabled>Medical History</option>
								<option value="Alcoholism">Alcoholism</option>
								<option value="Allergies">Allergies</option>
								<option value="Anemia">Anemia</option>
								<option value="AnxietyDisorder">AnxietyDisorder</option>
								<option value="Aspirin">Aspirin</option>
								<option value="Asthma">Asthma</option>
								<option value="AIDS/HIV">AIDS/HIV</option>
								<option value="BleedingDisorder">BleedingDisorder</option>
								<option value="BloodDisease">BloodDisease</option>
	                  		</select>
	                  	</div>
					</div>
	            </div>
	        </div>

	        <div class="row"><div class="col-md-12"><h2 align="center">Life Style</h2></div></div>

	        <div class="row checkin">
	         	<div class="col-md-12 col-sm-12 col-xs-12">
					<div class="col-md-4 col-sm-4 col-xs-12 field">
						<div class="col-md-6 col-sm-6 col-xs-12 padding-0">
							<div class="drop-select">
								<select   required  name="active" id="active">
			                        <option value="">Sexually Active</option>
			                        <option value="Yes">Yes</option>
			                        <option value="No">No</option>
			                    </select>
			                </div>
						</div>
						<div class="col-md-6 col-sm-6 col-xs-12 padding-0">
							<input required  type="text" name="partner" maxlength="30" placeholder="# of partners in past year" />
						</div>
					</div>
					<div class="col-md-4 col-sm-4 col-xs-12 field">
						<div class="col-md-6 col-sm-6 col-xs-6 padding-0">
							<div class="drop-select">
								<select   required  name="smoke" id="smoke">
			                        <option value="">Smoked:</option>
			                        <option value="yes">yes</option>
			                        <option value="No">No</option>
			                    </select>
			                </div>
						</div>
						<div class="col-md-6 col-sm-6 col-xs-6 padding-0">
							<input  required  type="text" name="packs" maxlength="30" placeholder="# packs/day" />
						</div>
					</div>
					<div class="col-md-4 col-sm-4 col-xs-12 field">
						<input type="text" placeholder="# alcohol drinks/week" maxlength="30" name="alcohol" required="" >
					</div>
	            </div>
	        </div>

	        <div class="row checkin">
	         	<div class="col-md-12 col-sm-12 col-xs-12">
					<div class="col-md-4 col-sm-4 col-xs-12 field">
						<div class="drop-select">
							<select   required  name="std" id="std">
								<option value="">Checked for STD's:</option>
								<option value="yes">yes</option>
								<option value="No">No</option>
							</select>
						</div>
					</div>
					<div class="col-md-4 col-sm-4 col-xs-12 field">
						<div class="col-md-6 col-sm-6 col-xs-12 padding-0">
							<div class="drop-select">
								<select   required   name="smokes" id="smokes">
									<option value="">Smokes now:</option>
									<option value="yes">yes</option>
									<option value="No">No</option>
								</select>
							</div>
						</div>
						<div class="col-md-6 col-sm-6 col-xs-12 padding-0">
							<input required  type="text" name="npacks" maxlength="30" placeholder="# packs/day"/>
						</div>
					</div>
					<div class="col-md-4 col-sm-4 col-xs-12 field">
						<input   required  type="text" name="caffeine" maxlength="30" placeholder="# caffeine/day"/>
					</div>
	            </div>
	        </div>

	        <div class="row checkin">
	         	<div class="col-md-12 col-sm-12 col-xs-12">
					<div class="col-md-4 col-sm-4 col-xs-12 field">
						<div class="drop-select">
							<select   required  name="pm" id="pm">
								<option value="">Physically or mentally hurted</option>
								<option value="yes">yes</option>
								<option value="No">No</option>
							</select>
						</div>
					</div>
					<div class="col-md-4 col-sm-4 col-xs-12 field">
						<div class="col-md-4 col-sm-4 col-xs-12 padding-0">
							<div class="drop-select">
								<select   required   name="drugs" id="medicine">
									<option value="">Recreational drugs:</option>
									<option value="yes">yes</option>
									<option value="No">No</option>
								</select>
							</div>
						</div>
						<div class="col-md-4 col-sm-4 col-xs-12 padding-0">
							<input   required  type="text" name="type" maxlength="30" placeholder="types" />
						</div>
						<div class="col-md-4 col-sm-4 col-xs-12 padding-0">
							<input   required  type="text" name="wtype" maxlength="30" placeholder="# times/week" />
						</div>
					</div>
					<div class="col-md-4 col-sm-4 col-xs-12 field">
						<div class="col-md-6 col-sm-6 col-xs-12 padding-0">
							<div class="drop-select">
								<select  required   name="excr" id="excr">
									<option value="">Do you Exercise</option>
									<option value="yes">yes</option>
									<option value="No">No</option>
								</select>
							</div>
						</div>
						<div class="col-md-6 col-sm-6 col-xs-12 padding-0">
							<input   required  type="text" name="nexcr" maxlength="30" placeholder="# times/week" />
						</div>
					</div>
	            </div>
	        </div>


            
            <div class="conform_button queries_click lg_btn col-md-offset-4 col-md-4 col-sm-offset-4 col-sm-4 col-xs-offset-0 col-xs-12" id='queries_click'>Continue</div>

         <input type="hidden" class="allergies" name="allergies"/> 
         <input type="hidden" class="history" name="history"/> 
         <input type="hidden" class="fhistory" name="fhistory"/> 
      </form>
   
   <input type="hidden" class="resultis"/> 
   <h1 class="info" align="center">Confirm Medical</h1>
   <form class="conform_registration" id="query_result">
   </form>
</div>
<script type='text/javascript' src='<?php echo WEB_ROOT?>service/public/js/check-in.js'></script>
<?php include("service/ui/common/footer.php"); ?>