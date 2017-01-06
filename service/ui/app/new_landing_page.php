<?php
   include(APP_PATH."service/ui/common/header_new.php");
   ?>
        <div class="schedule">
            <div class="schedulein">
               
                <div class="scheduleinner">
                    <div class="free"><p>it's free !</p></div>
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="col-md-8">
                                    <div class="form">
                                          <h2>Find a doctor and schedule an appointment</h2>

                                    </div>
                                    
                                    
                                    
                                </div>
                                <div class="col-md-4"></div>
                            </div>
                        </div>
                        <div class="row">
                        <div class="col-lg-12">
                            <div class="col-md-4">
                                <div class="form">
                                <h3>Get Started</h3>
                                    </div>

                            </div>
                            <div class="col-md-4">

                                
                            </div>
                             <div class="col-md-4"></div>
                            
                        </div>
                        </div>
                        
                         <div class="row">
                        <div class="col-lg-12">
                            <div class="col-md-4">

                            </div>
                            <div class="col-md-4">
                                <div class="form">

                               <h4>Who participitate in</h4> 
                                    </div>
                            </div>
                             <div class="col-md-4"></div>
                            
                        </div>
                        </div>
                        <form style="margin-top:15px;" id="findDoctor-form">
                        <div class="row">
                            <div class="col-lg-12">
                              <div class="col-md-4">
                                <div class="form">
                                  <div class="place-select">
                                    <select name="docSpeciality" id="docSpeciality" class="spciality_search">
                        <optgroup label="All">
                           <option value="" style="text-transform:unset;">Select a Speciality</option>
                           <?php
                              $condition = 'category_id = 1';
                              $scad->listbox('speciality','id','name',$condition,'`name` ASC',$selected);?>
                        </optgroup>
                        <optgroup label="Therapists / Counselors">
                           <?php
                              $condition = 'category_id = 2';
                              $scad->listbox('speciality','id','name',$condition,'`name` ASC',$selected);?>
                        </optgroup>
                        <optgroup label="Dental">
                           <?php
                              $condition = 'category_id = 3';
                              $scad->listbox('speciality','id','name',$condition,'`name` ASC',$selected);?>
                        </optgroup>
                        <optgroup label="Veterinary">
                           <?php
                              $condition = 'category_id = 4';
                              $scad->listbox('speciality','id','name',$condition,'`name` ASC',$selected);?>
                        </optgroup>
                     </select>

                                  </div>

                                </div>      


                              </div>
                              <div class="col-md-4">
                                <div class="place-select">
                                    <select class="input-block-level" name="insuranceSelect" id="insuranceSelect">
                                    <option value="">Select Insurance</option>
                                    <?php $scad->listbox('insurance','id','name','`parent_id`=0','`name` ASC',$selected=NULL); ?>
                                    </select>
                                </div>
                                <div id="loading" style="display: none;    height: 30px;    margin: 11px 0 7px;"><img style=""  src="<?php echo WEB_ROOT?>service/public/images/loading.gif" /></div>
                            <div id="subInsurance" class="place-select" style="display:none;margin: 21px 0 0;">
                            <select class="input-block-level" name="subInsuranceSelect" id="subInsuranceSelect"></select>
                            </div>
                              </div>  
                              <div class="col-md-4">
                                <div class="form">
                                  <div class="place-select">
                                    <select id="srchLanguage" name="language" class="select2_dr">
                                    <option value="0">Select a Language</option>
                                    <?php $scad->listbox('languages','id','name',$condition=NULL,'`name` ASC',$selected=NULL);?>
                                    </select>
                                  </div>
                                </div>

                              </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="col-md-4">
                                        <div class="form">
                                            <div class="in">In</div>
                                            </div>
                                        </div>
                                        <div class="col-md-4"></div>
                                        
                                         <div class="col-md-4"></div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="col-md-4">
                                            <div class="form">
                                                <input type="text" placeholder="Enter your Zip" name="docZip" id="doc-zip" class="input-block-level" style="background: transparent none repeat scroll 0 0;border: 1px solid;border-radius: 0;box-shadow: none;margin: 0;min-height: 36px;padding: 0 15px;color: #75737b;text-indent: 0.01px;" >
                                                </div>

                                        </div>
                                        <div class="col-md-4">
                                            <div class="form">
                                              <div class="place-select">
                                                <select id="srchReason" name="srchReason" class="select2_dr">
                                                <option value="0" class="parent-346">Reason for Visit</option>
                                                <option class="parent-346" value="other">Other </option>
                                                </select>

                        </div>
                                                </div>

                                        </div>
                                        <div class="col-md-4">
                                            <div class="form">
                                              <div class="place-select">
                                                <select class="select2_dr" name="gender" id="gender">
                                                <option value="0">Doctor Gender</option>
                                                <option value="1">Male</option>
                                                <option value="2">Female</option>
                                                </select>

                        </div>
                                                </div>

                                        </div>
                                        
                                        
                                    </div>
                                </div>
                            </form>
                                <div class="row">
                               
                                        <div class="col-md-4"></div>
                                          <div class="col-md-4">
                                               <div id="findDoctorBtn" class="finddoc"><h4>Find Doctors</h4></div>

                                        </div>
                                          <div class="col-md-4"></div>
                                    
                                </div>
                                
                                
                            </div>
                        </div>
                                
                                
                            </div>
                        </div>
                        
                        
                        
                        
                        
                    </div>
                </div>
            </div>
        </div>  
        <div class="banner">
            
        </div>
          
        <div class="container">
            <div class="healthcare">
                <h1>HEALTHCARE AT YOUR DEMAND !</h1>
                <p>Find a nearby doctor or dentist and book an appointment instantly.And it's free ! </p>
                <h2>FEATURES</h2>
                <ul>
                        <li><a>View a map of doctors in your insurance network.</a></li>
                        <li><a>Read patient reviews to help you choose the right doctor.</a></li>
                        <li><a>See any doctor's available times and click to book!</a></li>
                        
                    </ul>
                <h2>GET THE APP</h2>
            </div>
        </div>
    
        <div class="mobilehand">
            <div class="container">
                <div class="apple">
        <a href="index.html"><img src="<?php echo WEB_ROOT?>service/public/images/images/apple.png"></a>
                    <a href="index.html"><img src="<?php echo WEB_ROOT?>service/public/images/images/google_play.png"></a></div>
            </div>
        </div>
   <?php include(APP_PATH."service/ui/common/footer.php"); ?>