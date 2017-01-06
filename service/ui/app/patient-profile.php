<?php 
   include("service/ui/common/header.php");   
   $result = $scad->getUserDetails($_SESSION['userID']); 
   $resu = $scad->getDetails($_SESSION['userID']);
	foreach ($resu as $key => $value) {
	$ids[]=$value['doctor_id'];
    $res[]= $scad->getDocDetails($value['doctor_id']);
	}
   ?>
   <style>

   </style>
   <script>
	$( document ).ready(function() {
		function test(){		
$(".submit").click(function(){ 
	//alert ("okkk");
//var n=$("#userIdf").val();
var i = $(this).parent().find("#userIdf").val();
//alert(i);	
	
	
	
	    var ovrall=$("input[name='rating']:checked").val();
	    // alert(ovrall);
	    var bsidemnr=$("input[name='rating2']:checked").val();
	    // alert(bsidemnr);
	    var waiting=$("input[name='rating3']:checked").val();
	    // alert(waiting);
	
	    var msg =$("#message").val();
	    var userget=$("#userid").val();
	    //alert(userget);
	    var docId=$("#dctid").val(); 
	    //alert(docId);
$.ajax({
				type: 'POST',	
								
				url: SITEURL+'patient/profile/ratingaction',
				data: {"ovrall":ovrall , "bsidemnr":bsidemnr , "waiting":waiting , "msg":msg , "userget":userget , "docId":docId },
				success: function(res)
				{
					 $("#rateModl").modal('hide');
							
				}
		
		});

//*ajax end 	



});

//id request 
$(".cancel").click(function(){
 	
 	
 $("#rateModl").modal('hide');
//alert ("ok");

});

}

	$(".ratng").click(function(e)
	{
    e.preventDefault();
	var sum= $(this).attr("target");
	
	// alert (sum);
	
	$.ajax({
				type: 'POST',				
				url: SITEURL+'patient/profile/ratingpopup',
				data: {"sum":sum},
				success: function(res)
				
				{
					 console.log(res);
					 
					 $("#rateModl").html(res);$('#rateModl').modal('show');				
$('.submit').show();
					 test();
					 /*if (res === 0) {
                        $("#error").fadeIn(1000);
                        document.getElementById('ratings').style.pointerEvents = 'auto';
                        $("#continue-join-patient").text('Countinue');
                    } else {
      
                        $("#abnt-form").fadeOut(1000);
      $(".here").html(res);
                    }*/
                }
				
		
		});

//submitclickaction();
//alert ("ok");	

});



});
	
</script>
<!--<section  class="team-modern-12">
   <div class="container">
      <div class="profile_nav1">
         <ul>
            <li><a href="#"> <img src="<?php echo WEB_ROOT;?>service/public/images/profile_team.png"  alt=""> <br> Medical Team </a>  </li>
            <li><a href="<?php echo WEB_ROOT;?>index.php/past_appoinments"> <img src="<?php echo WEB_ROOT;?>service/public/images/profile_appointment.png"  alt=""> <br>  Past Appointment </a>  </li>
            <li><a href="#"> <img src="<?php echo WEB_ROOT;?>service/public/images/profile_notification.png"  alt=""> <br> Notification </a>  </li>
            <li><a href="<?php echo WEB_ROOT;?>index.php/patient_settings"><img src="<?php echo WEB_ROOT;?>service/public/images/profile_setting.png"  alt=""> <br> Settings </a></li>
			<li><a href="<?php echo WEB_ROOT;?>index.php/signout"> <img src="<?php echo WEB_ROOT;?>service/public/images/logout.png"  alt=""> <br> Logout </a></li>
         </ul>
      </div>
      <div class="profile_banner">
         <div class="prfl_bnr_lft">
            <div class="prfl_bnr_lft_clm1">
               <h1> Welcome, <?php echo $result['firstname']." ".$result['lastname'];?> </h1>
               <p> More than 5 million patients use Bookmydoc to find doctors every month. Let them book appointments with you instantly. </p>
                <a class="btn" href="<?php echo WEB_ROOT;?>index.php/search">Search</a>
            </div>
            <div class="prfl_bnr_lft_clm1_sdw">  </div>
         </div>
         <div class="prfl_bnr_rht"><img src="<?php echo WEB_ROOT;?>service/public/images/pic123.jpg" alt=""></div>
      </div>
      <div class="comment_popup modal fade test" id="rateModl"  tabindex="-1" role="dialog" >
        
        <!--<div cass="comment_popup">
        
     
        </div>

        <div class="clearfix"></div> 
         
      <div class="prflpg_clm3">
         <div class="pfl_clm3_lft">
            <ul>
            <?php
                        $i=0;  
						foreach ($resu as $key => $val) {
                        $res= $scad->getDocDetails($val['doctor_id']);
	$rat=$scad->getrting($val['doctor_id']);
			$len=count($rat);
			  for($j=0;$j<$len;$j++){
				  $overall[$val['doctor_id']][]=($rat[$j]['overall'] +$rat[$j]['beside'] +$rat[$j]['waiting'])/3  ;
				  }
			//print_r($overall);
			$rateval=0; 
			for($k=0;$k<count($overall[$val['doctor_id']]);$k++){
			  $rate = $overall[$val['doctor_id']][$k];
			 $rateval= $rateval+$rate;
			 }
			 $doc_rating = round($rateval/count($overall[$val['doctor_id']]));
                       foreach ($res as $key => $value) {
                         	
                         	//$ra[] = $value[ra];
							//echo "<pre>";
							 $img= $scad->getDocProImg($value['id']);
							 //print_r($img);
							 if ($img['name']) {
                    $docImage = $img['name'];
                } else {
                    $docImage = 'no_image.jpg';
                }

					   // echo $i;
							// echo round($ra[$i]);
                       ?>
               <li>
                  <h1> Book a Primary care physician </h1>
                  <div class="prlf_close"><a href="#"><img src="<?php echo WEB_ROOT;?>service/public/images/profile_close.png"  alt=""></a></div>
                  <div class="prlf_usrpic"><img src="<?php echo WEB_ROOT;?>service/public/z_uploads/doctor/small/<?php echo $docImage ?>"  alt=""></div>
                  <div class="prfle_clm3_cnt">
                          
              
                  		<h2> <a href='<?php echo WEB_ROOT;?>index.php/view-prrofile/<?php echo $val['doctor_id'];?>'><?php echo $value['firstname']." ".$value['lastname'];?></a> <!--<span class="dr_text"> MD </span></h2>
                        <div class="drpfl_satr">
                         <input type="hidden" value="<?php echo $val['doctor_id'];?>" id="userIdf">
                         <input type="hidden" value="<?php echo $_SESSION['userID'];?>" id="userid">	 
                        <div class="drpflrating">
                        <input type="radio" <?php if($doc_rating==0){echo "checked ";}  ?> disabled="disabled" /><span id="drpflhide"></span>
                        <input type="radio" <?php if($doc_rating==1){echo "checked ";}  ?> disabled="disabled" value="1" name="rating<?php echo $i; ?>"><span></span>
                        <input type="radio" <?php if($doc_rating==2){echo "checked ";}  ?> disabled="disabled" value="2" name="rating<?php echo $i; ?>"><span></span>
                        <input type="radio" <?php if($doc_rating==3){echo "checked ";}  ?> disabled="disabled" value="3" name="rating<?php echo $i; ?>"><span></span>
                        <input type="radio" <?php if($doc_rating==4){echo "checked ";}  ?> disabled="disabled" value="4" name="rating<?php echo $i; ?>"><span></span>
                        <input type="radio" <?php if($doc_rating==5){echo "checked ";}  ?> disabled="disabled" value="5" name="rating<?php echo $i; ?>"><span></span>
                        
                        <?php
                         
                        $count=$scad->getratingDetails($val['doctor_id']);
                      //print_r($count);
                       $c=count($count);
					  // echo $c;
                        if($c==0)
						
						
                        {
                        	
						
                        ?>
                       
                        <a  class="ratng" style="cursor:pointer" id="docid" datasrc="5" target="<?php echo $val['doctor_id'] ;?>"> Rate</a>
                        <?php 
                        
                        }
						
						else 
						{
						?>
						<a style="cursor:pointer"  class="ratng" id="docid1" datasrc="5" target="<?php echo $val['doctor_id'] ;?>"> Rated</a>
						
						<?php
							
						}
						
						?>
						
						
                        
                        </div>
                        <?php
                        
                        $co=$scad->AppoinmentCount($val['doctor_id']);
						//foreach ($co as $key => $value) {
							//echo "<pre>";
						//print_r($co);
						$totl= $co[0]["count(doctor_id)"];	
						//echo $totl;
						
                        ?>
                        <div class="pfl_pnt_list">
                        <ul>
                        <li> <a href="#"> <div class="pfl_pnt_apnum"> <?php echo $totl; ?> </div> Appointments </a></li>
                        <li> <a href='<?php echo WEB_ROOT;?>index.php/view-prrofile/<?php echo $val['doctor_id'];?>'> <img src="<?php echo WEB_ROOT;?>service/public/images/dr_pfl_bookagain.png"  alt=""> Book Again </a></li>
                        <li>999 555 1111</li>
                        
                        </ul>
                        </div>
                        
                        
                        
                        </div>
                      
                  </div>
               </li>
                 <?php         	
	          }
$i++;}
            	?>
               <li id="findDocli">
                  <div class="pfl_adddctr" id="findDoc">
                   <a href="#"> <img src="<?php echo WEB_ROOT;?>service/public/images/profile_add_dctr.png" alt=""> <br> Find a Docotor </a>
                   </div>
               </li>
               <li id="bookDocli" style="display:none;">
                  <div class="pfl_opt">
                     <h1> Book an Appointment </h1>
                     <form style="margin-top:10px;">
                        <select class="select2">
                           <option val="">Select a Speciality</option>
                            <?php $scad->listbox('speciality','id','name',$condition=NULL,'`name` ASC',$selected=NULL); ?>
                        </select>
                        <a class="btn" href="<?php echo WEB_ROOT;?>index.php/search">Search</a>
                     </form>
                  </div>
               </li>
            </ul>
         </div>
         <?php
		 $res=$scad->getUpcomingEvents($_SESSION['userID'],date("Y-m-d"));
		 /*echo "<pre>";
		 print_r($res);*/
		 ?>
         <div class="pfl_clm3_rht" style="overflow-x:auto;height:372px">
            <h1> <img src="<?php echo WEB_ROOT;?>service/public/images/profile_upcmg_icon.png" alt=""> Upcoming Events </h1>
            <div class="pfl_evnts">
               <ul>
               <?php 
			   if(!empty($res)){
			   $len=count($res);
			   for($i=0;$i<$len;$i++){
				 $user=$scad->getUserDetails($res[$i][doctor_id]);
			   ?>
                  <div class="pfl_evntss">
                     <a href="#">
                        <h1> <?php echo $user[firstname]." ".$user[lastname];?> </h1>
                        <?php echo $res[$i][apnt_date].$res[$i][apnt_starttime]; ?> <br> <?php echo $res[$i][apnt_note];?> 
                     </a>
                  </div>
                  <?php } }else{?>
                  <div class="pfl_evntss" style="height:300px"><p style="margin: 53% 28%;">No data to dispaly</p></div>
                  <?php } ?>
                  <!--<li>
                     <div class="pfl_evnts_click">
                        <p> 2620  W 26 Mile <br>
                           Suite 205 <br>
                           Southfield, MI <br>
                           <a href="#"> Map </a>
                        </p>
                        <p> 9999 5555 666 </p>
                        999 5555 666 </p>
                        <div class="pfl_upcmg_ftr">
                           <ul>
                              <li><a href="#"> <img src="<?php echo WEB_ROOT;?>service/public/images/profile_calender.png" alt=""> Add to Calender </a> </li>
                              <li><a href="#"> <img src="<?php echo WEB_ROOT;?>service/public/images/profile_print.png" alt=""> Print Reminder </a> </li>
                              <li><a href="#"> <img src="<?php echo WEB_ROOT;?>service/public/images/profile_reshedule.png" alt=""> Reschedule </a> </li>
                              <li><a href="#"> <img src="<?php echo WEB_ROOT;?>service/public/images/profile_cancel.png" alt=""> Cancel </a> </li>
                           </ul>
                        </div>
                     </div>
                  </li>
               </ul>
            </div>
         </div>
      </div>
   </div>
</section>-->

<div class="container">
    <div class="row">
      <div style="padding:0;" class="col-md-9">
        <div class="raspberry active">
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
        <div class="raspberry">
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
   <div class="row">
      <div class="col-md-6">
         <div class="welcome">
            <div class="patient weight pat">
               <h2>Welcome, <?php echo $result['firstname']." ".$result['lastname'];?></h2>
               <p>More than 5 million patient use bookmydoc to find doctors<br>
                  every month.Let them book appointments with use instanly.
               </p>
            </div>
            <div class="wel_search">
               <a href="<?php echo WEB_ROOT;?>index.php/search">
                  <h4>Search</h4>
               </a>
            </div>
         </div>
      </div>
      <div class="col-md-2"></div>
      <div class="col-md-4">
         <div class="nurses">
            <img src="<?php echo WEB_ROOT?>service/public/images/images/nurse.png">
         </div>
      </div>
   </div>
   <div class="row">
      <div class="col-md-9 col-sm-12 col-xs-12">
         <ul class="welcomes">
          <?php
          $i=0;  
          foreach ($resu as $key => $val) {
            $i=$key;
            $res= $scad->getDocDetails($val['doctor_id']);
            $rat=$scad->getrting($val['doctor_id']);
            $len=count($rat);
            for($j=0;$j<$len;$j++){
              $overall[$val['doctor_id']][]=($rat[$j]['overall'] +$rat[$j]['beside'] +$rat[$j]['waiting'])/3  ;
            }
            //print_r($overall);
            $rateval=0; 
            for($k=0;$k<count($overall[$val['doctor_id']]);$k++){
              $rate = $overall[$val['doctor_id']][$k];
              $rateval= $rateval+$rate;
            }
            $doc_rating = round($rateval/count($overall[$val['doctor_id']]));
            foreach ($res as $key => $value) {
              $img= $scad->getDocProImg($value['id']);
              if ($img['name']) {
                $docImage = $img['name'];
              } else {
                $docImage = 'no_image.jpg';
              }
          ?>
            <li>
               <div class="primary">
                  <div class="care">
                     <h4>Book a primary care physican  </h4>
                     <div class="crossbar">
                        <a href="#"><img src="<?php echo WEB_ROOT?>service/public/images/images/cross.png"></a> 
                     </div>
                  </div>
                  <div class="profile full phy">
                     <div class="col-md-4">
                        <div class="propic photo">
                           <img src="<?php echo WEB_ROOT;?>service/public/z_uploads/doctor/small/<?php echo $docImage ?>">
                        </div>
                     </div>
                     <div class="col-md-8">
                        <div class="name">
                           <h3><?php echo $value['firstname']." ".$value['lastname'];?></h3>
                        </div>
                        <input type="hidden" value="<?php echo $val['doctor_id'];?>" id="userIdf">
                         <input type="hidden" value="<?php echo $_SESSION['userID'];?>" id="userid">
                        <span class="rating rate">
                        <input type="radio" <?php if($doc_rating==5){echo "checked ";}  ?> name="rating-input-<?php echo $i; ?>-5" id="rating-input-<?php echo $i; ?>-5" class="rating-input">
                        <label class="rating-star" for="rating-input-<?php echo $i; ?>-5"></label>
                        <input type="radio" <?php if($doc_rating==4){echo "checked ";}  ?> name="rating-input-<?php echo $i; ?>-4" id="rating-input-<?php echo $i; ?>-4" class="rating-input">
                        <label class="rating-star" for="rating-input-<?php echo $i; ?>-4"></label>
                        <input type="radio" <?php if($doc_rating==3){echo "checked ";}  ?> name="rating-input-<?php echo $i; ?>-3" id="rating-input-<?php echo $i; ?>-3" class="rating-input">
                        <label class="rating-star" for="rating-input-<?php echo $i; ?>-3"></label>
                        <input type="radio" <?php if($doc_rating==2){echo "checked ";}  ?> name="rating-input-<?php echo $i; ?>-2" id="rating-input-<?php echo $i; ?>-2" class="rating-input">
                        <label class="rating-star" for="rating-input-<?php echo $i; ?>-2"></label>
                        <input <?php if($doc_rating==1){echo "checked ";}  ?> type="radio" name="rating-input-<?php echo $i; ?>-1" id="rating-input-<?php echo $i; ?>-1" class="rating-input">
                        <label class="rating-star" for="rating-input-<?php echo $i; ?>-1"></label>
                        </span>
                        <?php
                        
                        $co=$scad->AppoinmentCount($val['doctor_id']);
                        $totl= $co[0]["count(doctor_id)"];  
                        
                        ?>
                        <div class="prodt">
                        <?php
                          $count=$scad->getratingDetails($val['doctor_id']);
                          $c=count($count);
                          if($c==0){
                        ?>
                          <a href="#" class="ratng" id="docid" datasrc="5" target="<?php echo $val['doctor_id'] ;?>">
                            <i class="fa fa-star-o"></i>
                            <span> Rate</span>
                          </a>
                          <?php } else{?>
                            <a href="#" class="ratng" id="docid1" datasrc="5" target="<?php echo $val['doctor_id'] ;?>">
                              <i class="fa fa-star-half-o"></i>
                              <span> Rated</span>
                            </a>
                          <?php } ?>
                        </div>
                        <div class="prodt">
                          <a href="javascript:void(0);">
                            <i class="fa fa-info-circle"></i>
                            <span><?php echo $totl; ?> Appointments</span>
                          </a>
                        </div>
                        <div class="prodt">
                          <a href="<?php echo WEB_ROOT;?>index.php/view-prrofile/<?php echo $val['doctor_id'];?>">
                            <i class="fa fa-repeat"></i>
                            <span>Book Again</span>
                          </a>
                        </div>
                        <div class="prodt">
                          <a href="mailto:<?php echo $value['email'];?>">
                            <i class="fa fa-envelope-o"></i>
                            <span><?php echo $value['email'];?></span>
                          </a>
                        </div>
                        <div class="prodt">
                          <a  href="javascript:void(0);">
                            <i class="fa fa-map-marker"></i>
                            <span><?php echo $value['address'];?></span>
                          </a>
                        </div>
                        <div class="row"></div>
                     </div>
                  </div>
               </div>
            </li>
            <?php } }
            ?>
            <li id="findDocli">
              <div class="primary">
                <div class="care">
                  <h4> Book an Appointment </h4>
                  <div class="crossbar">
                        <a href="#"><img src="<?php echo WEB_ROOT?>service/public/images/images/cross.png"></a> 
                     </div>
                </div>
                  <div class="round">
                    <div class="plus">
                      <a href="#" style="color:#c81e51;"> <img src="<?php echo WEB_ROOT;?>service/public/images/profile_add_dctr.png" alt=""> <br> Find a Docotor </a>
                    </div>
                  </div>
              </div>
               </li>
               <li id="bookDocli" style="display:none;">
                  <div class="primary">
                  <div class="care">
                    <h4> Book an Appointment </h4>
                    <div class="crossbar">
                        <a href="#"><img src="<?php echo WEB_ROOT?>service/public/images/images/cross.png"></a> 
                     </div>
                  </div>
                  <div class="profile full phy">
                    <form style="margin-top:10px;">
                      <div class="col-md-12 col-sm-12 col-xs-12">
                          <div class="drop-select">
                            <select class="select2">
                               <option val="">Select a Speciality</option>
                                <?php $scad->listbox('speciality','id','name',$condition=NULL,'`name` ASC',$selected=NULL); ?>
                            </select>
                          </div>
                        </div>
                          <div class="col-md-offset-4 col-md-4 col-sm-offset-4 col-sm-4 col-xs-offset-0 col-xs-12 lg_btn" style="margin-top:10px;"><a style="color:#fff;" class="" href="<?php echo WEB_ROOT;?>index.php/search">Search</a></div>
                       </form>
                  </div>
                </div>
               </li>
         </ul>
      </div>
      <div style="padding:0;" class="col-md-3">
        
         <div class="upcoming">
          <div class="upcoming_head">
              <img src="<?php echo WEB_ROOT?>service/public/images/images/clock.png">
            <h4>Upcoming Events</h4>
          </div>
            <div class="upcoming_display">
              <?php
               $res=$scad->getUpcomingEvents($_SESSION['userID'],date("Y-m-d"));
               // echo "<pre>";
               // print_r($res);
               // echo "</pre>";
              ?>
              <?php 
              if(!empty($res)){
                $len=count($res);
                for($i=0;$i<$len;$i++){
                  $user=$scad->getUserDetails($res[$i]["doctor_id"]);
                  ?>
                  <div class="up_event <?php echo (($i+1) % 2 == 0) ? 'even' : 'odd';?>">
                    <div class="pfl_evntss prodt">
                      <a href="javascript:void(0);">
                        <i class="fa fa-user-md"></i>
                        <span><?php echo $user["firstname"]." ".$user["lastname"];?></span>
                      </a>
                    </div>
                    <div class="pfl_evntss prodt">
                      <a href="javascript:void(0);">
                        <i class="fa fa-clock-o"></i>
                        <span><?php echo $res[$i]["apnt_date"].$res[$i]["apnt_starttime"]; ?></span>
                      </a>
                    </div>
                    <div class="pfl_evntss prodt">
                      <a href="javascript:void(0);">
                        <i class="fa fa-bell-o"></i>
                        <span><?php echo $res[$i]["apnt_note"];?></span>
                      </a>
                    </div>
                  </div>
              <?php } }else{?>
                <p class="no_data">No data to display</p>
              <?php } ?>
               
            </div>
         </div>
      </div>
   </div>
</div>
<div class="between"></div>
<div class="modal fade" tabindex="-1" role="dialog" id="rateModl">

</div><!-- /.modal -->
<?php include("service/ui/common/footer.php"); ?>