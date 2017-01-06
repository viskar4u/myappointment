

<?php 
   include("service/ui/common/header.php");   
   include("./conf/config.inc.php");
   $patientData = $dateCnt;
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
<div  class="container section_wrapper checkin_pg">
      <div class="row  hide-it-aj"><div class="col-md-12"><h2 align="center">Check-In</h2></div></div>
   
      
      <div class="row  hide-it-aj"><div class="col-md-12"><h1 align="left">Patients Registration Form</h1></div></div>
      <form action="" method="POST" id="checkin_reg">
            <!--row one-->
            <div class='row checkin'>
               <div class="col-md-12 col-sm-12 col-xs-12">
                  <div class="col-md-4 col-sm-4 col-xs-12 field">
                        <input type="text" name="apnt_time" maxlength="30" required readonly="readonly" value="<?php echo $dateCnt;?>" />
                  </div>
                  <div class="col-md-4 col-sm-4 col-xs-12 field">
                     <div class="drop-select">
                        <select required   name="marital" id="marital">
                        <option value="">Marital Status</option>
                        <option value="Single">Single</option>
                        <option value="Married">Married</option>
                        </select>
                     </div>
                  </div>
                  <div class="col-md-4 col-sm-4 col-xs-12 field">
                     <input required  type="text" name="ssn"  maxlength="30" placeholder="Social Security Number" />
                  </div>
               </div>
            </div>
            <!--row one-->

            <!--row two-->
            <div class='row checkin'>
               <div class="col-md-12 col-sm-12 col-xs-12">
                  <div class="col-md-4 col-sm-4 col-xs-12 field">
                     <input type="text" name="fname" data-regexp="^[a-zA-Z]+$"  required  maxlength="30" placeholder="First Name"/>
                  </div>
                  <div class="col-md-4 col-sm-4 col-xs-12 field">
                     <input required  type="text" name="pnum" data-type='number' data-minlength='10' data-maxlength="10" placeholder="Mobile Number"/>
                  </div>
                  <div class="col-md-4 col-sm-4 col-xs-12 field">
                     <input required  type="text" name="reff" maxlength="30" placeholder="Reffered By"/>
                  </div>
               </div>
            </div>
            <!--row two-->

            
            <!--row three-->
            <div class='row checkin'>
               <div class="col-md-12 col-sm-12 col-xs-12">
                  <div class="col-md-4 col-sm-4 col-xs-12 field">
                     <input type="text" name="mname" data-regexp="^[a-zA-Z]+$"    maxlength="30"placeholder="Middle Name">
                  </div>
                  <div class="col-md-4 col-sm-4 col-xs-12 field">
                     <input required  type="text" name="hnum" data-type='number' data-minlength='10' data-maxlength="10" maxlength="30" placeholder="Home Number"/>
                  </div>
                  <div class="col-md-4 col-sm-4 col-xs-12 field">
                     <input required  type="text" name="pcp" maxlength="30" placeholder="Primary Care Physician" />
                  </div>
               </div>
            </div>
            <!--row three-->

            
            <!--row four-->
            <div class='row checkin'>
               <div class="col-md-12 col-sm-12 col-xs-12">
                  <div class="col-md-4 col-sm-4 col-xs-12 field">
                     <input type="text" name="lname" required data-regexp="^[a-zA-Z]+$"   maxlength="30" placeholder="Last Name"/>
                  </div>
                  <div class="col-md-4 col-sm-4 col-xs-12 field">
                     <input required  type="text" name="pCity" maxlength="30" placeholder="City" />
                  </div>
                  <div class="col-md-4 col-sm-4 col-xs-12 field">
                     <input required  type="text" name="pcpn" maxlength="30" placeholder="Primary Care Physician Number" />
                  </div>
               </div>
            </div>
            <!--row four-->

            
            <!--row five-->
            <div class='row checkin'>
               <div class="col-md-12 col-sm-12 col-xs-12">
                  <div class="col-md-4 col-sm-4 col-xs-12 field">
                       <input class="date-field-required"  type='text' required placeholder='Birthday Date' name="Birthday_day" id="Birthday_Day">
                  </div>
                  <div class="col-md-4 col-sm-4 col-xs-12 field">
                     <input required  type="text" name="pPin" data-type='number' data-minlength='6' data-maxlength="6" maxlength="30" placeholder="Pincode"/>
                  </div>
                  <div class="col-md-4 col-sm-4 col-xs-12 field">
                     <input required  type="text" name="phar" maxlength="30" placeholder="Pharmacy" />
                  </div>
               </div>
            </div>
            <!--row five-->

            
            <!--row six-->
            <div class='row checkin'>
               <div class="col-md-12 col-sm-12 col-xs-12 ">
                  <div class="col-md-4 col-sm-4 col-xs-12 field">
                        <input class="date-field-required"  type='text' placeholder='Birthday Month' required id="Birthday_Month" name="Birthday_Month">
                  </div>
                  <div class="col-md-4 col-sm-4 col-xs-12 field">
                     <input required  type="text" name="pstate" maxlength="30" placeholder="State" />
                  </div>
                  <div class="col-md-4 col-sm-4 col-xs-12 field">
                     <input required  type="text" name="phnum" maxlength="30" placeholder="Pharmacy Number" />
                  </div>
               </div>
            </div>
            <!--row six-->

            <!--row seven-->
            <div class='row checkin'>
               <div class="col-md-12 col-sm-12 col-xs-12">
                  <div class="col-md-4 col-sm-4 col-xs-12 field">
                        <input class="date-field-required"  type='text' required placeholder='Birthday Year'  name="Birthday_Year" id="Birthday_Year">
                        <div class="drop-select">
                           <select required name="gender" id="gender">
                              <option value="">Gender:</option>
                              <option value="Male">Male</option>
                              <option value="Female">Female</option>
                           </select>
                        </div>
                     <input required  type="text" name="occupation" maxlength="30" placeholder="Occupation"/>
                        <input required  type="email" name="email" maxlength="30" placeholder="Email ID"/>
                  </div>
                  <div class="col-md-4 col-sm-4 col-xs-12 field">
                     <textarea required  name="pAddress" rows="7" cols="30" placeholder="Address" ></textarea>
                  </div>
                  <div class="col-md-4 col-sm-4 col-xs-12 field">
                     <textarea required  name="phAddress" rows="7" cols="30" placeholder="Pharmacy Address" ></textarea>
                  </div>
               </div>
            </div>
            <!--row seven-->

            <div class="row checkin">
               <div class="col-md-12 col-sm-12 col-xs-12 field">
                  <!-- <div class="col-md-4 col-sm-4 col-xs-12"></div> -->
                  <div class="col-md-offset-4 col-md-4 col-sm-offset-4 col-sm-4 col-xs-offset-0 col-xs-12" align="center">
                     <div class="lg_btn registration_click" id='check_button'>Continue</div>
                  </div>
                  <!-- <div class="col-md-4 col-sm-4 col-xs-12"></div> -->
               </div>
            </div>
         
         
   
   </form>
   <!-- result stored in  this input-->
   <input type="hidden" class="resultis"/> 
   <h1 class="info" align="center">Confirm Registration</h1>
   <form class="conform_registration">
      <input type="hidden" name="apnt_time" maxlength="30" readonly value="<?php echo $dateCnt;?>" />
   </form>
</div>
<?php include("service/ui/common/footer.php"); ?>
<script src="<?php echo WEB_ROOT?>service/public/admin/dist/js/jquery.datetimepicker.full.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo WEB_ROOT?>service/public/admin/dist/css/jquery.datetimepicker.css"> 
<script>
   $(document).ready(function(){
      $('#Birthday_Day').datetimepicker({format:'d',timepicker:false,});
      $('#Birthday_Month').datetimepicker({format:'M',timepicker:false});
      $('#Birthday_Year').datetimepicker({format:'Y',timepicker:false});
   });
</script>

