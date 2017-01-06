

<?php include("service/ui/common/header.php"); ?>
<script type="text/javascript">
   $(document).ready(function(){
   function procedures(){
	   $('.ser_pag .rvwpaginatin li.activ').live('click',function(){
                         $(".ser_pag").hide();
	   $(".outr_load").show(); 
                       var page = $(this).attr('p');
					   var the_letter =  $(".alpha").val();
                       loadData(page,the_letter);
                       
                   }); 
							   $(".spcl_foot1").click(function(){
													 var zip=$(this).attr("id");
													 //alert(zip);
													 $("#srchLanguage").val(zip);
													 var formData = $('#hiddenform').serialize();
													 //console.log(formData);
        var data = $.base64.encode(formData);
        window.location.href = SITEURL + 'search/' + data;
													 });
							   }
   function loadData(page,letter){
	   $(".ser_pag").hide();   
   					$(".outr_load").show();                 
                       $.ajax
                       ({
                           type: "POST",
                           url: SITEURL+'search-insurance',
   						data:{"page":page,"letter":letter},
                           success: function(msg)
                           {
                               //console.log(msg);
                                   
                                   $(".ser_pag").html(msg);
								   procedures();
								   $(".outr_load").hide();                 
								   $(".ser_pag").show();
                           }
                       });
                   }
   loadData(1,'a');  // For first time page load default results
   $(".alphabets").click(function(){
	   $(".ser_pag").hide();
	   $(".outr_load").show(); 
	   $(".alphabets").removeClass("selected");
	   $(this).addClass("selected");
                       var the_letter = $(this).attr("target");
					   $(".alpha").val(the_letter);
   					//alert(the_letter);
					loadData(1,the_letter);
                      
                   });
   				
   				
   				
                     
   $('#go_btn').live('click',function(){
	   					$(".dr_pfl_outr_load").show();
                       var page = parseInt($('.goto').val());
                       var no_of_pages = parseInt($('.total').attr('a'));
                       if(page != 0 && page <= no_of_pages){
                           loadData(page);
                       }else{
                           alert('Enter a PAGE between 1 and '+no_of_pages);
                           $('.goto').val("").focus();
                           return false;
                       }
                       
                   });
               			
   });
   
   
</script><form style="margin-top:15px;display:none" id="hiddenform">
                  <div class="styled-selected">
                     <select name="docSpeciality" id="docSpeciality_foot">
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
                  <div class="hme_txtfm"> In </div>
                  <input type="text" placeholder="Enter your Zip" name="docZip" id="doc-zip-foot" class="input-block-level" style="min-height:30px;" >
                  <div class="hme_txtfm"> Who participates in </div>
                  <div class="styled-selected">
                     <select class="input-block-level" name="insuranceSelect" id="insuranceSelect">
                        <option value="">Select Insurance</option>
                        <?php $scad->listbox('insurance','id','name','`parent_id`=0','`name` ASC',$selected=NULL); ?>
                     </select>
                  </div>
               <div id="loading" style="display: none;    height: 30px;    margin: 11px 0 7px;"><img style=""  src="<?php echo WEB_ROOT?>service/public/images/loading.gif" /></div>
                  <div id="subInsurance" class="styled-selected" style="display:none;">
                     <select class="input-block-level" name="subInsuranceSelect" id="subInsuranceSelect"></select>
                  </div>
                  <div class="styled-selected">
                     <select id="srchReason" name="srchReason" class="select2_dr">
                        <option value="0" class="parent-346">Reason for Visit</option>
                        <option value="1" class="parent-346">Hearing Problems / Ringing in Ears</option>
                        <option value="2" class="parent-346">Damage to the Ear and Disease of the Ear</option>
                        <option value="3" class="parent-346">Dizziness / Vertigo</option>
                        <option value="4" class="parent-346">Ear Infection</option>
                        <option value="5" class="parent-346">Evaluation for Cochlear Implant</option>
                        <option value="6" class="parent-346">Hearing Test</option>
                        <option value="7" class="parent-346">Multiple Sclerosis</option>
                        <option value="8" class="parent-346">Family History of Hearing Loss</option>
                        <option value="9" class="parent-346">Pediatric Audiology</option>
                        <option value="10" class="parent-346">Problem with Balance</option>
                        <option value="11" class="parent-346">Problem with Hearing Aid</option>
                        <option value="12" class="parent-346">Stroke</option>
                        <option value="13" class="parent-346">Tumor Affecting Hearing (Acoustic Neuroma, Meningioma, Astrocytoma)</option>
                     </select>
                  </div>
                  <div class="styled-selected">
                     <select id="srchLanguage" name="language" class="select2_dr">
						<option value="0">Select a Language</option>
						<?php $scad->listbox('insurance','id','name',$condition=NULL,'`name` ASC',$selected=NULL);?>
                     </select>
                  </div>
                  <div class="styled-selected">
                     <select class="select2_dr" name="gender" id="gender">
                        <option value="0">Doctor Gender</option>
                        <option value="1">Male</option>
                        <option value="2">Female</option>
                     </select>
                  </div>
                  <div  id="findDoctorBtn" class="findDoctors">Find Doctors </div>
               </form>
               <input type="hidden" class="alpha" value="A">
<div class="container section_wrapper lang">
  <div class="row">
      <div class="col-md-6 col-sm-6 col-xs-12 patient weight">
        <h2> Find Doctors by Insurance </h2>
      </div>
  </div>

  <div class="row">

    <div class="col-md-12">

      <div class="search-by col-md-12 col-sm-12 col-xs-12" style="font-weight:600;">
        <div class="col-md-9 col-sm-9 col-xs-12" style="margin-top">
          <h3>Find a Doctor or Dentist Near You</h3>
        </div>
        <div class="col-md-3 col-sm-3 col-xs-12">
          <a href="<?php echo WEB_ROOT;?>index.php/search" style="float:right;padding:10px;" class="search-box searchbtn lg_btn">Search</a> 
        </div>

      </div>

    </div>
  </div>

  <div class="row">
                <div class="col-md-1"></div>
                 <div class="col-md-10">
                     <div class="graybox">
                         <div id="navcontainer">
                             <ul>
                             <li style="border-right:3px solid #d2d2d2;" class="alpha"><a class="alphabets selected" target="A">A</a></li>
                              <li style="border-right:3px solid #d2d2d2;" class="alpha"><a class="alphabets" target="B">B </a></li>
                              <li style="border-right:3px solid #d2d2d2;" class="alpha"><a class="alphabets" target="C">C</a></li>
                              <li style="border-right:3px solid #d2d2d2;" class="alpha"><a class="alphabets" target="D">D</a></li>
                             
                             <li style="border-right:3px solid #d2d2d2;" class="alpha"><a class="alphabets" target="E">E</a></li>
                              <li style="border-right:3px solid #d2d2d2;" class="alpha"><a class="alphabets" target="F">F</a></li>
                              <li style="border-right:3px solid #d2d2d2" class="alpha"><a class="alphabets" target="G">G</a></li>
                              <li style="border-right:3px solid #d2d2d2" class="alpha"><a class="alphabets" target="H">H</a></li>
                             
                             <li style="border-right:3px solid #d2d2d2;" class="alpha"><a class="alphabets" target="I">I</a></li>
                              <li style="border-right:3px solid #d2d2d2;" class="alpha"><a class="alphabets" target="J">J</a></li>
                              <li style="border-right:3px solid #d2d2d2;" class="alpha"><a class="alphabets" target="K">K</a></li>
                              <li style="border-right:3px solid #d2d2d2;" class="alpha"><a class="alphabets" target="L">L</a></li>
                             
                             <li style="border-right:3px solid #d2d2d2;" class="alpha"><a class="alphabets" target="M">M</a></li>
                              <li style="border-right:3px solid #d2d2d2;" class="alpha"><a class="alphabets" target="N">N</a></li>
                              <li style="border-right:3px solid #d2d2d2;" class="alpha"><a class="alphabets" target="O">O</a></li>
                              <li style="border-right:3px solid #d2d2d2;" class="alpha"><a class="alphabets" target="P">P</a></li>
                             
                             <li style="border-right:3px solid #d2d2d2;" class="alpha"><a class="alphabets" target="Q">Q</a></li>
                              <li style="border-right:3px solid #d2d2d2;" class="alpha"><a class="alphabets" target="R">R</a></li>
                              <li style="border-right:3px solid #d2d2d2" class="alpha"><a class="alphabets" target="S">S</a></li>
                              <li style="border-right:3px solid #d2d2d2" class="alpha"><a class="alphabets" target="T">T</a></li>
                             
                             <li style="border-right:3px solid #d2d2d2;" class="alpha"><a class="alphabets" target="U">U</a></li>
                              <li style="border-right:3px solid #d2d2d2;" class="alpha"><a class="alphabets" target="V">V</a></li>
                              <li style="border-right:3px solid #d2d2d2;" class="alpha"><a class="alphabets" target="W">W</a></li>
                              <li style="border-right:3px solid #d2d2d2;" class="alpha"><a class="alphabets" target="X">X</a></li>
                             <li style="border-right:3px solid #d2d2d2;" class="alpha"><a class="alphabets" target="Y">Y</a></li>
                              <li class="alpha"><a class="alphabets" target="Z">Z</a></li>
                             
                         </ul>
                     </div>
                </div>
                 <div class="col-md-1"></div>
            </div>
          
        </div>

        <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12 ser_pag">
    </div>
  </div>

</div>

<?php include("service/ui/common/footer.php"); ?>
