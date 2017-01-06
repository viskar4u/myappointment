

<?php 
   include("service/ui/common/header.php");   
   ?>
<link rel="stylesheet" href="<?php echo WEB_ROOT?>service/public/css/checkin.css">
<style type="text/css">
   h3{font-family: font-family: 'Roboto', sans-serif; font-size: 19pt; font-style: normal; font-weight: bold; color:#3699DD;
   text-align: center; text-decoration: none; margin-right: 832px; }
   table{font-family: Calibri; color:#3499DD; font-size: 11pt; font-style: normal;
   text-align:; background-color: #ffffff; border-collapse: collapse; }
   table.inner{border: 0px}
</style>
<script type='text/javascript' src='<?php echo WEB_ROOT?>service/public/js/check-in.js'></script>
<script type='text/javascript' src='<?php echo WEB_ROOT?>service/public/js/token/jquery.sumoselect.min.js'></script>
<div class="container section_wrapper checkin_pg">
<div class="row  hide-it-aj">
   <div class="col-md-12">
      <h2 align="center">Check-In</h2>
   </div>
</div>

<div class="row  hide-it-aj">
   <div class="col-md-12">
      <h3 align="left">Billing And Insurance</h3>
   </div>
</div>
      <form  id="user_insurence">
         <div class="row">
            <div class="col-md-12">
               <h4 align="center">Primary Health Insurence</h4>
            </div>
         </div>

            <div class='row checkin'>
               <div class="col-md-12 col-sm-12 col-xs-12">
                  <div class="col-md-4 col-sm-4 col-xs-12 field">
                     <input required type="text" name="Company_name" maxlength="30" placeholder="Insurence Company"/>
                  </div>
                  <div class="col-md-4 col-sm-4 col-xs-12 field">
                     <input required type="text" name="employer" maxlength="30" placeholder="Insured's Name"/>
                  </div>
                  <div class="col-md-4 col-sm-4 col-xs-12 field">
                     <input required type="text" name="bCity" maxlength="30" placeholder="City" />
                  </div>
               </div>
            </div>

            <div class='row checkin'>
               <div class="col-md-12 col-sm-12 col-xs-12">
                  <div class="col-md-4 col-sm-4 col-xs-12 field">
                     <input required type="text" name="plan" maxlength="30"placeholder="Plan">
                  </div>
                  <div class="col-md-4 col-sm-4 col-xs-12 field">
                     <input required type="text" data-type='number' data-minLength='10' data-maxLength='10' name="insurednum" maxlength="30" placeholder="Insured's Phone Number"/>
                  </div>
                  <div class="col-md-4 col-sm-4 col-xs-12 field">
                     <input required type="text" name="bPin" maxlength="30" placeholder="Pincode"/>
                  </div>
               </div>
            </div>

            <div class='row checkin'>
               <div class="col-md-12 col-sm-12 col-xs-12">
                  <div class="col-md-4 col-sm-4 col-xs-12 field">
                     <input required type="text" name="plan_num" maxlength="30" placeholder="Plan Number"/>
                  </div>
                  <div class="col-md-4 col-sm-4 col-xs-12 field">
                     <input required type="text" name="insureddob" maxlength="30" placeholder="Insured's Birth Date"/>
                  </div>
                  <div class="col-md-4 col-sm-4 col-xs-12 field">
                     <input required type="text" name="bstate" maxlength="30" placeholder="State" />
                  </div>
               </div>
            </div>

            <div class='row checkin'>
               <div class="col-md-12 col-sm-12 col-xs-12">
                  <div class="col-md-4 col-sm-4 col-xs-12 field">
                     <input required type="text" name="GROUP_NUM" maxlength="30" placeholder="Group Number"/>
                  </div>
                  <div class="col-md-4 col-sm-4 col-xs-12 field">
                     <input required type="text" name="bsec" maxlength="30" placeholder="Social Security Number"/>
                  </div>
                  <div class="col-md-4 col-sm-4 col-xs-12 field">
                     <textarea required name="iAddress" rows="4" cols="30" placeholder="Insured Address"></textarea>
                  </div>
               </div>
            </div>

         <div class="row"><div class="col-md-12"><h4 align="center">Secondary Health Insurance</h4></div></div>
            <div class='row checkin'>
               <div class="col-md-12 col-sm-12 col-xs-12">
                  <div class="col-md-4 col-sm-4 col-xs-12 field">
                     <input required type="text" name="sCompany_name" maxlength="30" placeholder="Insurence Company"/>
                  </div>
                  <div class="col-md-4 col-sm-4 col-xs-12 field">
                     <input required type="text" name="semployer" maxlength="30" placeholder="Insured's Name"/>
                  </div>
                  <div class="col-md-4 col-sm-4 col-xs-12 field">
                     <input required type="text" name="sbCity" maxlength="30" placeholder="City" />
                  </div>
               </div>
            </div>

            <div class='row checkin'>
               <div class="col-md-12 col-sm-12 col-xs-12">
                  <div class="col-md-4 col-sm-4 col-xs-12 field">
                     <input required type="text" name="splan" maxlength="30"placeholder="Plan">
                  </div>
                  <div class="col-md-4 col-sm-4 col-xs-12 field">
                     <input required type="text" data-type='number' data-minLength='10' data-maxLength='10' name="sinsurednum" maxlength="30" placeholder="Insured's Phone Number"/>
                  </div>
                  <div class="col-md-4 col-sm-4 col-xs-12 field">
                     <input required type="text" name="sbPin" maxlength="30" placeholder="Pincode"/>
                  </div>
               </div>
            </div>

            <div class='row checkin'>
               <div class="col-md-12 col-sm-12 col-xs-12">
                  <div class="col-md-4 col-sm-4 col-xs-12 field">
                     <input required type="text" name="splan_num" maxlength="30" placeholder="Plan Number"/>
                  </div>
                  <div class="col-md-4 col-sm-4 col-xs-12 field">
                     <input required type="text" name="sinsureddob" maxlength="30" placeholder="Insured's Birth Date"/>
                  </div>
                  <div class="col-md-4 col-sm-4 col-xs-12 field">
                     <input required type="text" name="sbstate" maxlength="30" placeholder="State" />
                  </div>
               </div>
            </div>

            <div class='row checkin'>
               <div class="col-md-12 col-sm-12 col-xs-12">
                  <div class="col-md-4 col-sm-4 col-xs-12 field">
                     <input required type="text" name="sGROUP_NUM" maxlength="30" placeholder="Group Number"/>
                  </div>
                  <div class="col-md-4 col-sm-4 col-xs-12 field">
                     <input required type="text" name="sbsec" maxlength="30" placeholder="Social Security Number"/>
                  </div>
                  <div class="col-md-4 col-sm-4 col-xs-12 field">
                     <textarea required name="siAddress" rows="4" cols="30" placeholder="Insured Address" ></textarea>
                  </div>
               </div>
            </div>
            
         <div class="conform_button insurence_click lg_btn col-md-offset-4 col-md-4 col-sm-offset-4 col-sm-4 col-xs-offset-0 col-xs-12" id='insurence_click'>Continue</div>  
      </form>
   <input type="hidden" class="resultis"/> 
   <div class="row info">
      <div class="col-md-12">
         <h2 align="center">Confirm Insurance</h2>
      </div>
   </div>
   <form class="conform_insurence" id="query_result">
   </form>
   <div class="final_conformation">
      <div class="col-md-6">
         <div class="nurse">
            <img src="<?php echo WEB_ROOT;?>service/public/images/images/nurse.png" alt="">            
         </div>
      </div>
      <div class="col-md-6">

         <div class="patient weight">
            <h2>Check-In</h2>
            <p> I verify that the information presented here is accurate, and  <br>
            I authrorize  Bookmydoc to send this information to my <br>
            health care provider<br>
            </p>
         </div>

         <div style="margin-left:15px;" class="cont contt conform_button final_confirm_click lg_btn">
            Click here to Proceed
         </div> 
      </div>
      </div>
</div>
<?php include("service/ui/common/footer.php"); ?>

