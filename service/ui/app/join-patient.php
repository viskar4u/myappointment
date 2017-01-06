<?php
session_start();
include("service/ui/common/header.php"); 
 $_SESSION['userID'];
?>

      <div class="container section_wrapper">
         <div class="row">
            <div class="col-md-6">
               <section class="register">
                  <h3>Join Now</h3>
                  <div id="patient_error" style="margin-top:20px;display:none;" class="alert alert-error">Email Already Exist.</div>
                  <div id="patient_success" style="margin-top:20px;display:none;" class="alert alert-success">Registration success .<br/>Please verify your account.(check your mail)</div>
                  <form  style="margin-top:20px;" id="patient-form" name="patient-form">
                  <div class="reg_section personal_info">
                     <label>Email</label>
                     <input type="text" name="email" data-type="email" data-trigger="change" data-required="true" value="" placeholder="Email Address">
                     <label>Create a Password</label>
                     <input type="password" name="password" value="" data-minlength="6" data-trigger="change" data-required="true" id="password" placeholder="Password">
                  </div>
                  <div class="reg_section password">
                     <label>Name</label>
                     <input type="text" data-regexp="^[a-zA-Z]+$" data-trigger="change" data-minlength="3" data-required="true" placeholder="First" name="firstname" id=""  style='margin-bottom:5px' >
                       <input type="text" data-regexp="^[a-zA-Z]+$" data-trigger="change" data-minlength="3" data-required="true" placeholder="Last" name="lastname" id="" >
                  </div>
                  <label>Date of Birth</label> 
                  <input class="date-field-required" type="text" data-trigger="mouseleave" data-required="true" data-beatpicker="true" data-beatpicker-format="['YYYY','MM','DD']" name="dob" id="dob" placeholder="YYYY-MM-DD"  />   
                  <label>Sex</label> 
                  <div class="clearBoth"></div>
                  <div class="rad-but">
                     <input id="male" name="gender" value="1" data-required="true"   type="radio"> Male
                     &nbsp;&nbsp;
                     <input id="female" name="gender" value="2" data-required="true" type="radio"> Female
                     <div class="clearBoth"></div>
                  </div>
                  <div class="reg_section password">
                  </div>
                  <div>
                    <p class="terms">
                       <label>
                       &nbsp; <input data-trigger="change" data-required="true" name="privacy" name="privacy" type="checkbox">
                       <i><a href="<?php echo WEB_ROOT;?>index.php/terms">I agree to the Terms of Service</a></i>
                       </label>
                    </p>
                  </div>

                  <div class="findDoctors submission" type="image" id="continue"><h4>Continue</h4></div>
                  </form>
               </section>
            </div>
            <div class="col-md-6">
               <div class="doc">
                  <img src="<?php echo WEB_ROOT;?>service/public/images/images/doctorr.png">
               </div>
               <div class="patient weight time">
                  <h2>Book my doc in totally free.</h2>
                  <p>Book online instanly,no credit card required.
                  </p>
               </div>
            </div>
         </div>
      </div>

<?php include("service/ui/common/footer.php"); ?>