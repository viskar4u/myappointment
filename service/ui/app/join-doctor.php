<?php 
include("service/ui/common/header.php"); 

?>
<div class="container section_wrapper">

   <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12" style="text-align: right;">
         <a href="<?php echo WEB_ROOT;?>index.php/join/patient">Not a Doctor or Dentist? Click here </a>
      </div>
   </div>

   <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
         <div class="col-md-6 col-sm-6 col-xs-6">
            <div class="signup_nw">
               <h1> You’ll love being on Bookmydoc </h1>
               <ul>
                  <li>
                     <h2> You’ll love being on Bookmydoc </h2>
                     Access Bookmydoc network of more than 5 million patients. 
                  </li>
                  <li>
                     <h2> You’ll love being on Bookmydoc </h2>
                     Let patients schedule appointments with you instantly, 24-7, from Bookmydoc and from your practice website.
                  </li>
                  <li>
                     <h2> You’ll love being on Bookmydoc </h2>
                     Access Bookmydoc network of more than 5 million patients. 
                  </li>
                  <li>
                     <h2> You’ll love being on Bookmydoc  </h2>
                     Access Bookmydoc network of more than 5 million patients. 
                  </li>
                  <li>
                     <h2> You’ll love being on Bookmydoc  </h2>
                     Let patients schedule appointments with you instantly, 24-7, from Book My Doc.com and from your practice website.
                  </li>
               </ul>
            </div>
         </div>
         <div class="col-md-6 col-sm-6 col-xs-6">
            <div class="register">
                     <div class="colorbox"></div>
                     <div class="">
                        <h3 class="login-header"> Let's get started!</h3>
                  <div id="doc_error" style="margin-top:20px;display:none;" class="alert alert-error">Email-ID Already Exist.</div>
                        <div id="doc_success" style="margin-top:20px;display:none;" class="alert alert-success">Registration success .<br/>Please verify your account.(check your mail)</div>
                        <form style="margin-top:20px;" name="doctor-form" id="doctor-form">
                           <label class="subname2">  Name </label>
                       <input type="text" data-trigger="change" data-required="true"  placeholder="First" data-minlength="3"  name="firstname" id="" class="input-block-level" style="margin-bottom:10px" >
                       <input type="text" data-trigger="change" data-required="true" placeholder="Last" data-minlength="3" name="lastname" id="" class="input-block-level" style="" >
                           <label class="subname2">  Email </label> 
                           <input type="email" placeholder="Email Address" data-type="email" data-trigger="change" data-required="true" class="input-block-level"  name="email"  id="email"  >
                     <label class="subname2">  Password </label> 
                          <input type="password" placeholder="Password" data-minlength="6" data-trigger="change" data-required="true" id="password" name="password" class="input-block-level"  >
                           <input name="phone" type="text" data-trigger="change" data-maxlength="10" data-minlength="10" data-type='number' data-required="true" placeholder="Phone" class="input-block-level" style="min-height:40px;" >
                           <label class="subname2">  Practice ZIP Code </label> 
                           <input name="zipcode" id="zipcode" type="text" data-minlength="5" data-trigger="change" data-required="true" placeholder="ZIP" class="input-block-level" style="min-height:40px;" >
                           <div>
                              <div class="drop-select">
                              <select data-trigger="change" data-required="true"    name="speciality" id="speciality">
                       <option value="0">Select Speciality</option>
                       <?php $scad->listbox('speciality','id','name',$condition=NULL,'`name` ASC',$selected=NULL); ?></select></div>
                           </div>
                           <div>
                             <p class="terms">
                                <label>
                                &nbsp; <input type="checkbox" name="privacy" data-required="true" data-trigger="change">
                                <i><a href="http://localhost/bookmydoc_new_theme/index.php/terms">I agree to the Terms of Service</a></i>
                                </label>
                             </p>
                           </div>
                           <div class="clear"></div>
                          <div href="#" id="doc-continue" class="findDoctors ctn_btn lg_btn"> Continue</div>
                        </form>
                     </div>
                     <div class="itsfree"></div>
                  </div>
         </div>
      </div>
   </div>

</div>

<?php include("service/ui/common/footer.php"); ?>