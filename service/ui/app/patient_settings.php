<?php 
   include("service/ui/common/header.php"); 
   
   ?>
<link rel="stylesheet" href="<?php echo WEB_ROOT?>service/public/css/setting_pg.css">
<script type='text/javascript' src='<?php echo WEB_ROOT?>service/public/js/doctor-profile-settings.js'></script>

<style>

.input-block {
    box-sizing: border-box;
    display: block;
    min-height: 40px;
    width: 100%;
}
.detail_box{
	float:left;
	width:80%;
}
.action_box{
		float:right;
		width:20%;
		margin-top:5%;
	}
</style>
<section  class="team-modern-12">
   <div class="container">
    <div class="row">
      <div style="padding:0;" class="col-md-9">
        <div class="raspberry">
            <a href="<?php echo WEB_ROOT;?>index.php/patient/profile">
              <img src="<?php echo WEB_ROOT?>service/public/images/images/medical.png">
              <p>Medical Team</p>
            </a>
            
        </div>
        <div class="raspberry">
          <a href="<?php echo WEB_ROOT;?>index.php/past_appoinments"> 
            <img src="<?php echo WEB_ROOT?>service/public/images/images/past.png">
            <p>Past Appointment</p>
          </a>
          
        </div>
        <div class="raspberry">
          <a href="javascript:void(0);">
            <img src="<?php echo WEB_ROOT?>service/public/images/images/notification.png">
            <p style="margin-top:15px;">Notifications</p>
          </a>
        </div>
        <div class="raspberry active">
          <a href="<?php echo WEB_ROOT;?>index.php/patient_settings"> 
            <img src="<?php echo WEB_ROOT?>service/public/images/images/settings.png">
            <p>Settings</p>
          </a>
          
        </div>
        <div class="raspberry">
          <a href="<?php echo WEB_ROOT ?>index.php/signout"> 
            <img src="<?php echo WEB_ROOT?>service/public/images/images/logout.png">
            <p>Logout</p>
          </a>
          
        </div>
      </div>
    </div>

      <div class="row study">
               <ul class="tabs" id="docTab" style="list-style:none; padding:0; margin:0;">
                  <li class="active" ><a  href="#doc-profile">Edit Profile</a></li>
                  
                  <li><a href="#doc-pass1">Change Password</a></li>
                  
               </ul>
               <div class="tabcontents">
                  <div class="tab-pane active" id="doc-profile">
                     <?php
                        $result = $scad->getUserDetails($_SESSION['userID']);
                        //print_r($result);
                        ?>
                     <!-- <div id="doc-setting-error" >no</div>-->
                     <form style="margin-top:20px;" id="doc-setting-form" name="doc-setting-form">
                        <div id="doc-success" style="display:none" class="alert alert-success">
                           <p align="center">Changes Saved!!</p>
                        </div>
                        <fieldset class="his">
                          <label style=" margin-bottom: -3px;">  First Name </label> 
                          <input type="text" value="<?php echo $result['firstname'];?>" data-trigger="change" data-required="true" placeholder="First Name" name="firstname"  >
                          <label style=" margin-bottom: -3px;">  Last Name </label> 
                          <input type="text" value="<?php echo $result['lastname'];?>" data-trigger="change" data-required="true" placeholder="Last Name" name="lastname"  >
                          <label style=" margin-bottom: -3px;">  Email </label> 
                          <input type="email" readonly value="<?php echo $result['email'];?>" data-type="email" data-trigger="change" data-required="true"   name="email"   >
                          <label style=" margin-bottom: -3px;">  Date of Birth </label>
                          <input class="date-field-required" type="text"value="<?php echo $result['dob'];?>" data-trigger="mouseleave" data-required="true" data-beatpicker="true" name="dob" id="dob" placeholder="YYYY-MM-DD"  data-beatpicker-format="['YYYY','MM','DD']" /> 
                        </fieldset>
                        <div class="row" style="margin-top: 20px;">
                          <div class="col-md-3"></div>
                          <div class="col-md-6">
                            <div id="pat-setting" class="lg_btn findDoctors">
                              Confirm
                            </div> 
                          </div>
                          <div class="col-md-3"></div>
                        </div>
                          <!-- <div >Save</div> -->
                     </form>
                  </div>
                  
                  <div class="tab-pane" id="doc-pass1">
                     <form style="margin-top:20px;" id="doc-setting-pass" name="doc-setting-form">
                        <div id="doc-pass-error1" style="display:none" class="alert alert-danger">
                           <p align="center">Failed to Upload</p>
                        </div>
                        <div id="doc-pass-error2" style="display:none" class="alert alert-danger">
                           <p align="center">Password Mismatch</p>
                        </div>
                        <div id="doc-pass-error3" style="display:none" class="alert alert-danger">
                           <p align="center">You are entered a <em>Wrong Password</em></p>
                        </div>
                        <div id="doc-pass-success" style="display:none" class="alert alert-success">
                           <p align="center">Changes Saved!!</p>
                        </div>
                        <fieldset class="his">
                          <label class="subname2">  Enter Current Password </label> 
                          <input type="password" placeholder="Current Password"  data-trigger="change" data-required="true" placeholder="First" name="cur_pass" id="cp" class="input-block-level" style="min-height:40px;" >
                          <label class="subname2">  Enter New Password </label> 
                          <input type="password" data-trigger="change" placeholder="New Password" data-required="true" placeholder="First" name="new_pass" id="p1" class="input-block-level" style="min-height:40px;" >
                          <label class="subname2">  Retype Password </label> 
                          <input type="password" data-trigger="change" placeholder="Retype Password" data-required="true" placeholder="First" name="re_pass" id="p2" class="input-block-level" style="min-height:40px;" >
                        </fieldset>
                        <div class="row" style="margin-top: 20px;">
                          <div class="col-md-3"></div>
                          <div class="col-md-6">
                            <div id="doc-pass" class="findDoctors lg_btn">
                              Confirm
                            </div> 
                          </div>
                          <div class="col-md-3"></div>
                        </div>
                        <!-- <div id="doc-pass" class="findDoctors">Save</div> -->
                     </form>
                  </div>
            <!--<div class="dctr_mbr_pgnationmn">
               <nav class="dctr_mbr_pgnation">
                  <a href="#" class="prev">&lt;</a>
                  <span>1</span>
                  <a href="#">2</a>
                  <a href="#">3</a>
                  <a href="#">4</a>                  
                  <a href="#">5</a>
                  <a href="#" class="next">&gt;</a>
               </nav>
               </div>-->
         </div>
        
      </div>
   </div>
</section>
<!-- The template to display files available for upload -->
<script id="template-upload" type="text/x-tmpl">
   {% for (var i=0, file; file=o.files[i]; i++) { %}
       <tr class="template-upload fade">
           <td>
               <span class="preview"></span>
           </td>
           <td>
               <p class="size">Processing...</p>
               <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0"><div class="progress-bar progress-bar-success" style="width:0%;"></div></div>
           </td>
           <td>
               {% if (!i && !o.options.autoUpload) { %}
                   <button class="btn1 btn-primary start" disabled>
                       <i class="glyphicon glyphicon-upload"></i>
                       <span>Start</span>
                   </button>
               {% } %}
               {% if (!i) { %}
                   <button class="btn1 btn-warning cancel">
                       <i class="glyphicon glyphicon-ban-circle"></i>
                       <span>Cancel</span>
                   </button>
               {% } %}
           </td>
       </tr>
   {% } %}
</script>
<!-- The template to display files available for download -->
<!-- The template to display files available for download -->
<script id="template-download" type="text/x-tmpl">
   //alert(file.thumbnailUrl);
   {% for (var i=0, file; file=o.files[i]; i++) { %}
       <tr class="template-download fade">
           <td>
               <span class="preview">
                   {% if (file.thumbnailUrl) { %}
                       <a  href="{%=file.url%}" title="{%=file.name%}" download="{%=file.name%}" data-gallery><img src="{%=file.thumbnailUrl%}" style="max-height:90px;max-width:80px"></a>
                   {% } %}
               </span>
           </td>
   
           <td>       
             <button class="btn1 btn-primary activate"  value="{%=file.name%}"   >
                                           <span>Activate</span>
                                           </button>
   		  {% if (file.error) { %}         <div><span class="label label-danger">Error</span> {%=file.error%}</div>
               {% } %}
           </td>
           <td>
               {% if (file.deleteUrl) { %}
                   <button class="btn1 btn-danger delete" data-type="{%=file.deleteType%}" data-url="{%=file.deleteUrl%}"{% if (file.deleteWithCredentials) { %} data-xhr-fields='{"withCredentials":true}'{% } %}>
                       <i class="glyphicon glyphicon-trash"></i>
                       <span>Delete</span>
                   </button>
               {% } else { %}
                   <button class="btn1 btn-warning cancel">
                       <i class="glyphicon glyphicon-ban-circle"></i>
                       <span>Cancel</span>
                   </button>
               {% } %}
           </td>
       </tr>
   {% } %}
</script>     
<?php include("service/ui/common/footer.php"); ?>