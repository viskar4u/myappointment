<?php include("service/ui/common/header.php"); ?>
<div class="container section_wrapper">
         <div class="row">
            <div class="col-md-8">
               <div class="signlog padding-lft-20">
                  <h3>Sign In</h3>
               </div>
               <div id="payment_error" style="margin-top:20px;display:none;" class="alert alert-error">You account has been expired.<a href="<?php echo WEB_ROOT?>index.php/payment_package" >click here</a> to subscribe.</div>
               <div id="email_error" style="margin-top:20px;display:none;" class="alert alert-error">Email not verified.</div>
               <div id="signin_error" style="margin-top:20px;display:none;" class="alert alert-error">Invalid Login.</div>
               <form id="signin-form" name="signin-form">
               
                  <fieldset class="account-text accotxt">
                     <label>
                     Email<br>
                     <input type="email" placeholder="Email Address" data-type="email" data-trigger="change" data-required="true" class="input-block-level"  name="email"  id="email">
                     </label>
                     <label>
                     Password<br>
                     <input type="password" placeholder="Password" data-trigger="change" data-required="true" id="password" name="password" class="input-block-level">
                     </label>
                  </fieldset>
                  <div class="forgot">
                     <P><a href="#">Forgot your password?</P>
                     </a>
                  </div>
                  <div class="between"></div>
                  <div id="signinBtn" class="findDoctors join jo">Sign In </div>
               </form>
               <div class="between"></div>
               <div class="patient">
                  <h2>I'm a new patient</h2>
                  <p>Sign up for a book my doc account to book an appoiment right<br>
                     now!   <span class="underline underline"><a href="<?php echo WEB_ROOT;?>index.php/join">Join Now</a></span>
                  </p>
                  <br>
               </div>
               <div class="col-md-4"></div>
            </div>
         </div>
      </div>


<?php include("service/ui/common/footer.php"); ?>