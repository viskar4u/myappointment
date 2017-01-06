<?php 
   include("service/ui/common/header.php"); 
   
   ?>
<!-- <link rel="stylesheet" href="<?php echo WEB_ROOT?>service/public/css/setting_pg.css"> -->
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

<div class="container section_wrapper">

         <div class="row">
            <div class="col-md-9" style="padding:0;">
               <div class = "raspberry">
                  <a href="<?php echo WEB_ROOT;?>index.php/doctor/profile"><img width='48' height='47' src="<?php echo WEB_ROOT;?>service/public/images/images/calendar edit.png"/>
                  <p>Appointment</p></a>
               </div>
               <div class = "raspberry">
                  <a href="<?php echo WEB_ROOT;?>index.php/calendar-settings"> <img width='48' height='47' src="<?php echo WEB_ROOT;?>service/public/images/images/calendar setting.png"/>
                  <p>Calendar Settings</p></a>
               </div>
               <div class = "raspberry active">
                  <a href="#"> <img width='48' height='47' src='<?php echo WEB_ROOT;?>service/public/images/images/settings.png'/>
                  <p>Settings</p></a>
               </div>
               <div class = "raspberry">
                  <a href="<?php echo WEB_ROOT;?>index.php/signout"> <img width='48' height='47' src='<?php echo WEB_ROOT;?>service/public/images/images/logout.png'/>
                  <p>Logout</p></a>
               </div>
            </div>
         </div>
    
         <div class="dctr_mbr_mdl">
            <div class="dctr_mbr_lft">
               <div class="dctr_mbr_tbl">
                  <ul class="tabs" id="docTab" >
                     <li class="active" ><a  href="#doc-profile">Edit Profile</a></li>
                     <li><a href="#doc-details">My Details</a></li>
                     <li><a href="#doc-pass1">Change Password</a></li>
                     <li><a href="#doc-imageupload">Upload Image/Video</a></li>
                  </ul>
                  <div class="tabcontents">
                     <div class="tab-pane active his" id="doc-profile">
                        <?php
                           $result = $scad->getUserDetails($_SESSION['userID']);
                           //print_r($result);
                           ?>
                        <!-- <div id="doc-setting-error" >no</div>-->
                        <form style="margin-top:20px;" id="doc-setting-form" name="doc-setting-form">
                           <div id="doc-success" style="display:none" class="alert alert-success">
                              <p align="center">Changes Saved!!</p>
                           </div>
                           <label class="subname2">  First Name </label> 
                           <input type="text" value="<?php echo $result['firstname'];?>" data-trigger="change" data-required="true" placeholder="First Name" name="firstname" id="" class=	"input-block-level" style="min-height:40px;" >
                           <label class="subname2">  Last Name </label> 
                           <input type="text" value="<?php echo $result['lastname'];?>" data-trigger="change" data-required="true" placeholder="Last Name" name="lastname" id="" class="input-block-level" style="min-height:40px;" >
                           <label class="subname2">  Email </label> 
                           <input type="email" readonly value="<?php echo $result['email'];?>" data-type="email" data-trigger="change" data-required="true" class="input-block-level"  name="email"  id="email" style="min-height:40px;" >
                           <label class="subname2">  Zip code </label> 
                           <input type="text" placeholder="zipcode" value="<?php echo $result['zipcode'];?>" data-trigger="change" data-required="true" id="password" name="code" class="input-block-level" style="min-height:40px;" >
                           
                           <div class="row">
                              <div class="col-md-3"></div>
                              <div class="col-md-6">
                                 <div id="doc-setting" class="save lg_btn">
                                    Save
                                 </div> 
                              </div>
                              <div class="col-md-3"></div>
                           </div>

                        </form>
                     </div>
                     <div class="tab-pane his" id="doc-details">
                     
                        <?php
                           $result = $scad->getUserDetails($_SESSION['userID']);
                           //print_r($result);
   						
   						if(empty($result)){
                           ?>
                        <!-- <div id="doc-setting-error" >no</div>-->
                        <form style="margin-top:20px;" id="doc-details-form" name="doc-setting-form" data-parsley-validate>
                           <div id="doc-success1" style="display:none" class="alert alert-success">
                              <p align="center">Changes Saved!!</p>
                           </div>
                           <div style="min-height:30px;">
                           <label class="subname2">  Speciality </label> <img class="addNewSpcl" title="Click to add more Languages" alt="Monday" style="cursor:pointer;float:right;" src="<?php echo WEB_ROOT?>service/public/images/tab_clum2_icon4.jpg"><br />
                           </div>
                           <div id="spcl">
                        <select name="docSpeciality[]" id="docSpeciality" class="input-block"  required>
                           <optgroup label="All">
                              <option value="" style="text-transform:lowercase;">Select a speciality</option>
                              <?php
                                 $condition = 'category_id = 1';
                                 $scad->listbox('speciality','id','name',$condition,'`id` ASC',$selected);?>
                           </optgroup>
                           <optgroup label="Therapist">
                              <?php
                                 $condition = 'category_id = 2';
                                 $scad->listbox('speciality','id','name',$condition,'`id` ASC',$selected);?>
                           </optgroup>
                           <optgroup label="Dental">
                              <?php
                                 $condition = 'category_id = 3';
                                 $scad->listbox('speciality','id','name',$condition,'`id` ASC',$selected);?>
                           </optgroup>
                           <optgroup label="Veterinary">
                              <?php
                                 $condition = 'category_id = 4';
                                 $scad->listbox('speciality','id','name',$condition,'`id` ASC',$selected);?>
                           </optgroup>
                        </select>
                        </div>
                        <div class="spcl-here"></div>
                           <label class="subname2">  Education </label> 
                           <textarea data-trigger="change" data-required="true" placeholder="Education" name="Education" id="" class=	"input-block-level" style="min-height:50px;" ></textarea>
                           <label class="subname2">  Hospital Affiliations </label> 
                           <input type="text" value="" data-trigger="change" data-required="true" placeholder="Hospital Affiliations" name="Hospital" id="" class="input-block-level" style="min-height:40px;" >
                              <input type="hidden" value="<?php echo $_SESSION['userID'];?>" data-trigger="change" data-required="true" id="password" name="doc-id" class="input-block-level" style="min-height:40px;" >
                              <div style="min-height:30px;">
                           <label class="subname2">  Languages Spoken </label> <img class="addNewLang" title="Click to add more Languages" alt="Monday" style="cursor:pointer;float:right;" src="<?php echo WEB_ROOT?>service/public/images/tab_clum2_icon4.jpg"><br />
                           </div>
                          <div id="lang">
                           <select class="input-block"  required name="Languages[]" >
                            <option value="">Select a Language</option>
                            <?php $scad->listbox('languages','id','name',$condition=NULL,'`name` ASC',$selected=NULL);?>
                           </select>
                           </div>
                           <div class="lang-here">
                           
                           </div>
                           <label class="subname2">  Board Certifications </label> 
                           <textarea data-trigger="change" data-required="true" placeholder="Board Certifications" name="Board" id="" class="input-block-level" style="min-height:50px;" ></textarea>
                           <label class="subname2">  Awards and Publications </label> 
                           <textarea data-trigger="change" data-required="true" placeholder="Awards and Publications" name="Awards" id="" class=	"input-block-level" style="min-height:50px;" ></textarea>
                            <label class="subname2">  Professional Memberships </label> 
                           <textarea data-trigger="change" data-required="true" placeholder="Professional Memberships" name="Memberships" id="" class=	"input-block-level" style="min-height:50px;" ></textarea>
                           <div style="min-height:30px;">
                           <label class="subname2">  In-Network Insurances </label> <img class="addNewInsurence" title="Click to add more Languages" alt="Monday" style="cursor:pointer;float:right;" src="<?php echo WEB_ROOT?>service/public/images/tab_clum2_icon4.jpg"><br />
                           </div>
                           <div class="insurence">
                        <select class="input-block" required name="insuranceSelect[]" id="insuranceSelect">
                           <option value="">Select Insurance</option>
                           <?php $scad->listbox('insurance','id','name','`parent_id`=0','`name` ASC',$selected=NULL); ?>
                        </select>
                     </div>
                     <div id="insurence-here"></div>
                           
                           <div class="row">
                              <div class="col-md-3"></div>
                              <div class="col-md-6">
                                 <div id="doc-detail" class="save">
                                    <h4><a href="#">Save</a></h4>
                                 </div> 
                              </div>
                              <div class="col-md-3"></div>
                           </div> 
                        </form>
                        </div>
                        <?php } else{ ?>
                        <!-- not empty section for details tab -->
                          <div class="insurence" style="display:none">
                        <select class="input-block" required name="insuranceSelect[]" id="insuranceSelect">
                           <option value="">Select Insurance</option>
                           <?php $scad->listbox('insurance','id','name','`parent_id`=0','`name` ASC',$selected=NULL); ?>
                        </select>
                     </div>
                           <div id="lang" style="display:none">
                           <select class="input-block"  required name="Languages[]" >
                            <option value="">Select a Language</option>
                            <?php $scad->listbox('languages','id','name',$condition=NULL,'`name` ASC',$selected=NULL);?>
                           </select>
                           </div>
                           <div id="spcl" style="display:none">
                        <select name="docSpeciality[]" id="docSpeciality" class="input-block"  required>
                           <optgroup label="All">
                              <option value="" style="text-transform:lowercase;">Select a speciality</option>
                              <?php
                                 $condition = 'category_id = 1';
                                 $scad->listbox('speciality','id','name',$condition,'`id` ASC',$selected);?>
                           </optgroup>
                           <optgroup label="Therapist">
                              <?php
                                 $condition = 'category_id = 2';
                                 $scad->listbox('speciality','id','name',$condition,'`id` ASC',$selected);?>
                           </optgroup>
                           <optgroup label="Dental">
                              <?php
                                 $condition = 'category_id = 3';
                                 $scad->listbox('speciality','id','name',$condition,'`id` ASC',$selected);?>
                           </optgroup>
                           <optgroup label="Veterinary">
                              <?php
                                 $condition = 'category_id = 4';
                                 $scad->listbox('speciality','id','name',$condition,'`id` ASC',$selected);?>
                           </optgroup>
                        </select>
                        </div>
                        <form style="margin-top:20px;" id="doc-details-form1" name="doc-setting-form" data-parsley-validate>
                           <div id="doc-success11" style="display:none" class="alert alert-success">
                              <p align="center">Changes Saved!!</p>
                           </div>
                         
                           <div style="min-height:30px;">
                           <label class="subname2">  Speciality </label> <img class="addNewSpcl" title="Click to add more Languages" alt="Monday" style="cursor:pointer;float:right;" src="<?php echo WEB_ROOT?>service/public/images/tab_clum2_icon4.jpg"><br />
                           </div>
                           <?php 
   						$spcl=$scad->getDocSpeciality($_SESSION['userID']);
   						foreach($spcl as $keys=>$value){
   							 $spcls[]=$value;
   							}
   							$spclen=count($spcls);
   							?>
                           <div id="spcl1">
                           <?php for($i=0;$i<$spclen;$i++){
   							 $selected=$spcls[$i][id];
   							?>
                        <select name="docSpeciality[]" id="docSpeciality" class="input-block"  required>
                           <optgroup label="All">
                              <option value="" style="text-transform:lowercase;">Select a speciality</option>
                              <?php
                                 $condition = 'category_id = 1';
                                 $scad->listbox('speciality','id','name',$condition,'`id` ASC',$selected);?>
                           </optgroup>
                           <optgroup label="Therapist">
                              <?php
                                 $condition = 'category_id = 2';
                                 $scad->listbox('speciality','id','name',$condition,'`id` ASC',$selected);?>
                           </optgroup>
                           <optgroup label="Dental">
                              <?php
                                 $condition = 'category_id = 3';
                                 $scad->listbox('speciality','id','name',$condition,'`id` ASC',$selected);?>
                           </optgroup>
                           <optgroup label="Veterinary">
                              <?php
                                 $condition = 'category_id = 4';
                                 $scad->listbox('speciality','id','name',$condition,'`id` ASC',$selected);?>
                           </optgroup>
                        </select>
                        <?php } ?>
                        </div>
                        <div class="spcl-here"></div>
                           <label class="subname2">  Education </label> 
                           <textarea data-trigger="change" data-required="true" placeholder="Education" name="Education" id="" class=	"input-block-level" style="min-height:50px;" >
                           <?php echo $result[Education];?></textarea>
                           <label class="subname2">  Hospital Affiliations </label> 
                           <textarea data-trigger="change" data-required="true" placeholder="Hospital Affiliations" name="Hospital" id="" class=	"input-block-level" style="min-height:50px;" >
                           <?php echo $result[HospitalAffiliations];?></textarea>
                              <input type="hidden" value="<?php echo $_SESSION['userID'];?>" data-trigger="change" data-required="true" id="password" name="doc-id" class="input-block-level" style="min-height:40px;" >
                              <div style="min-height:30px;">
                           <label class="subname2">  Languages Spoken </label> <img class="addNewLang" title="Click to add more Languages" alt="Monday" style="cursor:pointer;float:right;" src="<?php echo WEB_ROOT?>service/public/images/tab_clum2_icon4.jpg"><br />
                           </div>
                          <div id="lang">
                          <?php 
   						$spcl=$scad->getDocLang($_SESSION['userID']);
   						//print_r($spcl);
   						foreach($spcl as $keys=>$value){
   							 $spcll[]=$value;
   							}
   							 $spclen=count($spcll);
   							for($i=0;$i<$spclen;$i++){
   							$selected=$spcll[$i][id];
   							?>
                           <select class="input-block"  required name="Languages[]" >
                            <option value="">Select a Language</option>
                            <?php $scad->listbox('languages','id','name',$condition=NULL,'`name` ASC',$selected);?>
                           </select>
                           <?php } ?>
                           </div>
                           <div class="lang-here">
                           
                           </div>
                           <label class="subname2">  Board Certifications </label> 
                           <textarea data-trigger="change" data-required="true" placeholder="Board Certifications" name="Board" id="" class="input-block-level" style="min-height:50px;" ><?php echo $result[BoardCertifications];?></textarea>
                           <label class="subname2">  Awards and Publications </label> 
                           <textarea data-trigger="change" data-required="true" placeholder="Awards and Publications" name="Awards" id="" class=	"input-block-level" style="min-height:50px;" ><?php echo $result[Awards];?></textarea>
                            <label class="subname2">  Professional Memberships </label> 
                           <textarea data-trigger="change" data-required="true" placeholder="Professional Memberships" name="Memberships" id="" class=	"input-block-level" style="min-height:50px;" ><?php echo $result[ProfessionalMemberships];?></textarea>
                           <div style="min-height:30px;">
                           <label class="subname2">  In-Network Insurances </label> <img class="addNewInsurence" title="Click to add more Languages" alt="Monday" style="cursor:pointer;float:right;" src="<?php echo WEB_ROOT?>service/public/images/tab_clum2_icon4.jpg"><br />
                           </div>
                           <div class="insurence">
                           <?php
                           $spcl=$scad->getDocInsu($_SESSION['userID']);
   						foreach($spcl as $keys=>$value){
   							 $spcli[]=$value;
   							}
   							 $spclen=count($spcli);
   							for($i=0;$i<$spclen;$i++){
   							$selected=$spcli[$i][id];
   							?>
                        <select class="input-block" required name="insuranceSelect[]" id="insuranceSelect">
                           <option value="">Select Insurance</option>
                           <?php $scad->listbox('insurance','id','name','`parent_id`=0','`name` ASC',$selected); ?>
                        </select>
                        <?php } ?>
                     </div>
                     <div id="insurence-here"></div>
                           
                           <div class="row">
                              <div class="col-md-3"></div>
                              <div class="col-md-6">
                                 <div id="doc-detail1" class="save lg_btn">
                                    Save
                                 </div> 
                              </div>
                              <div class="col-md-3"></div>
                           </div>
                        </form>
                        </div>
                        <?php } ?>
                     
                     <div class="tab-pane his" id="doc-pass1">
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
                           <label class="subname2">  Enter Current Password </label> 
                           <input type="password" placeholder="Current Password"  data-trigger="change" data-required="true"  name="cur_pass" id="cp" class="input-block-level" style="min-height:40px;" >
                           <label class="subname2">  Enter New Password </label> 
                           <input type="password" data-trigger="change" placeholder="New Password" data-required="true"  name="new_pass" id="p1" class="input-block-level" style="min-height:40px;" >
                           <label class="subname2">  Retype Password </label> 
                           <input type="password" data-trigger="change" placeholder="Retype Password" data-required="true"  name="re_pass" id="p2" class="input-block-level" style="min-height:40px;" >
                           
                           <div class="row">
                              <div class="col-md-3"></div>
                              <div class="col-md-6">
                                 <div id="doc-pass" class="save lg_btn">
                                    Save
                                 </div> 
                              </div>
                              <div class="col-md-3"></div>
                           </div>
                        </form>
                     </div>
                     <div class="tab-pane his" id="doc-imageupload">
                        <div id="doc-success-pic" style="display:none;margin-top:20px;" class="alert alert-success">
                           <p align="center">Profile Picture Successfully Changed!!</p>
                        </div>
                        <div id="delete-img-info" class="alert alert-success" style="display:none;margin-top:20px;">
                           <p align="center">Image Successfully Removed</p>
                        </div>
                        <div class="row">
                           <ul class="subject-contents files">
                              <?php
                                 //  print_r($userID);
                                   //echo $userID['id'];

                           $condition="user_id=".$_SESSION['userID'];
                                   $userID =  $scad->getDoctorImages('userimages',$condition);
                           $len=sizeof($userID);
                           if($len>0){
                        
                                   foreach($userID as $keys=>$value){
                                 
                                 ?>
                              <li>
                                 <div class="imageHolder">
                                    <?php if ($value['type']==0){?>
                                       <img style="height:100%;width:100%" src="<?php echo WEB_ROOT?>service/public/z_uploads/doctor/thumbnail/<?php echo $value['name'];?>" />
                                       <?php } else {?>
                                       <img style="height:100%;width:100%" src="<?php echo WEB_ROOT?>service/public/images/video.jpg" />
                                       <?php } ?>
                                    <div class="caption">
                                       <?php $cls = ($value['set_profile']==1 && $value['type']==0)? 'activate out' : 'activate in';?>
                                       <a href="javascript:void(0);" class='<?php echo $cls;?>' value="<?php echo $value['id'];?>" ><i style="float:left;margin-left:9px; color:white;margin:top:5px;" class="fa fa-picture-o fa-2x"></i>
                                       </a><a href="javascript:void(0);" class='delete1' value="<?php echo WEB_ROOT?>index.php/service/public/z_uploads/?file=<?php echo $value['name'];?>&_method=DELETE" ><i style="float:right;margin-right:19px;color:#CA1F53;" class="fa fa-trash-o fa-2x"></i>
                                       </a>
                                    </div>
                                 </div>
                              </li>
                              <?php } }?>
                           </ul>
                        </div>
                        
                              
                        <div class="st_btn_outr">
                        <form enctype="multipart/form-data" method="POST" action="" id="fileupload">
                           <!-- Redirect browsers with JavaScript disabled to the origin page 
                              <noscript><input type="hidden" name="redirect" value="http://blueimp.github.io/jQuery-File-Upload/"></noscript>-->
                           <!-- The fileupload-buttonbar contains buttons to add/delete files and start/cancel the upload -->
                           <!-- The table listing the files available for upload/download -->
                           <table style="max-width:70%;margin-top:20px;" class="table table-striped" role="presentation">
                              <tbody class="files"></tbody>
                           </table>
                           <div class="row fileupload-buttonbar" style="margin: 0px auto; max-width: 70%;">
                              <div style="float:left; width:100%;">
                                 <div class="col-lg-12 fileupload-progress fade">
                                    <!-- The global progress bar -->
                                    <div aria-valuemax="100" aria-valuemin="0" role="progressbar" class="progress progress-striped active">
                                       <div style="width:0%;" class="progress-bar progress-bar-success"></div>
                                    </div>
                                    <!-- The extended global progress state -->
                                    <div class="progress-extended">&nbsp;</div>
                                 </div>
                                 <div class="col-lg-12">
                                    <!-- The fileinput-button span is used to style the file input field as button -->
                                    <div class="col-md-4 col-sm-4 col-xs-12">
                                       <div class="fileinput-button " >
                                          <span>Add files...</span>
                                          <input type="file" name="files[]" multiple="" class="btn1">
                                       </div>
                                    </div>
                                    <div class="col-md-4 col-sm-4 col-xs-12">
                                       <button type="submit" class="btn1 start"  >
                                          <i class="fa fa-upload"></i>
                                          <span>Start upload</span>
                                       </button>
                                    </div>
                                    <div class="col-md-4 col-sm-4 col-xs-12">
                                       <button type="reset" class="btn1 cancel"  >
                                          <i class="fa fa-ban"></i>
                                          <span>Cancel upload</span>
                                       </button>
                                    </div>
                                    <span class="fileupload-process"></span>
                                 </div>
                              </div>
                        
                        </div></form> 
                     </div>
                     </div>
                  </div>
               </div>
         </div>

      </div>
   </div>

<!-- The template to display files available for upload -->
<script id="template-upload" type="text/x-tmpl">
   {% for (var i=0, file; file=o.files[i]; i++) { %}
       <tr class="template-upload fade">
           <td>
               <span class="preview"></span>
               <strong class="error text-danger"></strong>
           </td>
           <td>
               <p class="size">Processing...</p>
               <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0"><div class="progress-bar progress-bar-success" style="width:0%;"></div></div>
           </td>
           <td>
               {% if (!i && !o.options.autoUpload) { %}
                   <div class="col-md-6 col-sm-6 col-xs-6"><button class="btn1 start" disabled>
                       <i class="fa fa-upload"></i>
                       <span>Start</span>
                   </button></div>
               {% } %}
               {% if (!i) { %}
                   <div class="col-md-6 col-sm-6 col-xs-6"><button class="btn1 cancel">
                       <i class="fa fa-ban"></i>
                       <span>Cancel</span>
                   </button></div>
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
             <div class="btn1 activate active_div"  value="{%=file.id%}"   >
                                           <i class="fa fa-check"></i>
                                           <span>Activate</span>
                                           </div>
   		  {% if (file.error) { %}         <div><span class="label label-danger">Error</span> {%=file.error%}</div>
               {% } %}
           </td>
           <td>
               {% if (file.deleteUrl) { %}
                  
               {% } else { %}
                   <button class="btn1 cancel">
                       <i class="fa fa-ban"></i>
                       <span>Cancel</span>
                   </button>
               {% } %}
           </td>
       </tr>
   {% } %}
</script>     
<?php include("service/ui/common/footer.php"); ?>