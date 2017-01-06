<?php
include("./conf/config.inc.php");
//$patientData = $_POST;
 $page     = $_POST['sum'];
 
$value = $scad->getUserDetails($page);
$img = $scad->getDocProImg($page);
$spcl = $scad->getDocSpeciality($page);

if(!empty($img[name])){
	$imageName = $img[name];
	}
	else{
		$imageName = 'no_image.jpg';
		}
?>

         <?php
        	$rtng=$scad->userting($_REQUEST['sum'],$_SESSION['userID']);
			?>


  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Rating Details</h4>
      </div>
      <div class="modal-body">
        <div class="row">
            <div class="col-md-12">
               <div class="col-md-6">
                <form> 
<input type="hidden" class="dctid" value="<?php echo $page;   ?> "  id="dctid"> 
                  <div class="over">
                     <div class="inputwrap">
                                             <div class="inputwrap">
                      <fieldset class="popup-rating one">
                            <legend>Over all Rating</legend>
<input type="radio" id="star5" name="rating" value="5" <?php if($rtng['overall']==5){echo "checked ";} if($rtng>0){echo "disabled ";} ?>/><label for="star5" title="Rocks!"><span>&#9733</span></label>
<input type="radio" id="star4" name="rating" value="4" <?php if($rtng['overall']==4){echo "checked ";} if($rtng>0){echo "disabled ";} ?>/><label for="star4" title="Pretty good"><span>&#9733</span></label>
<input type="radio" id="star3" name="rating" value="3" <?php if($rtng['overall']==3){echo "checked ";} if($rtng>0){echo "disabled ";} ?>/><label for="star3" title="Meh"><span>&#9733</span></label>
<input type="radio" id="star2" name="rating" value="2" <?php if($rtng['overall']==2){echo "checked ";} if($rtng>0){echo "disabled ";} ?>/><label for="star2" title="Kinda bad"><span>&#9733</span></label>
<input type="radio" id="star1" name="rating" value="1" <?php if($rtng['overall']==1){echo "checked ";} if($rtng>0){echo "disabled ";} ?>/><label for="star1" title="Sucks big time"><span>&#9733</span></label>
    </fieldset>

    <fieldset class="popup-rating two">
        <legend>Bedside Manner</legend>
<input type="radio" id="star5-1" name="rating2" value="5" <?php if($rtng['beside']==5){echo "checked ";} if($rtng>0){echo "disabled ";} ?>/><label for="star5-1" title="Rocks!"><span>&#9733</span></label>
<input type="radio" id="star4-1" name="rating2" value="4" <?php if($rtng['beside']==4){echo "checked ";} if($rtng>0){echo "disabled ";} ?>/><label for="star4-1" title="Pretty good"><span>&#9733</span></label>
<input type="radio" id="star3-1" name="rating2" value="3" <?php if($rtng['beside']==3){echo "checked ";} if($rtng>0){echo "disabled ";} ?>/><label for="star3-1" title="Meh"><span>&#9733</span></label>
<input type="radio" id="star2-1" name="rating2" value="2" <?php if($rtng['beside']==2){echo "checked ";} if($rtng>0){echo "disabled ";} ?>/><label for="star2-1" title="Kinda bad"><span>&#9733</span></label>
<input type="radio" id="star1-1" name="rating2" value="1" <?php if($rtng['beside']==1){echo "checked ";} if($rtng>0){echo "disabled ";} ?>/><label for="star1-1" title="Sucks big time"><span>&#9733</span></label>
    </fieldset>

        <fieldset class="popup-rating three">
            <legend>Wait Time</legend>
<input type="radio" id="star5-2" name="rating3" value="5" <?php if($rtng['waiting']==5){echo "checked ";} if($rtng>0){echo "disabled ";} ?>/><label for="star5-2" title="Rocks!"><span>&#9733</span></label>
<input type="radio" id="star4-2" name="rating3" value="4" <?php if($rtng['waiting']==4){echo "checked ";} if($rtng>0){echo "disabled ";} ?>/><label for="star4-2" title="Pretty good"><span>&#9733</span></label>
<input type="radio" id="star3-2" name="rating3" value="3" <?php if($rtng['waiting']==3){echo "checked ";} if($rtng>0){echo "disabled ";} ?>/><label for="star3-2" title="Meh"><span>&#9733</span></label>
<input type="radio" id="star2-2" name="rating3" value="2" <?php if($rtng['waiting']==2){echo "checked ";} if($rtng>0){echo "disabled ";} ?>/><label for="star2-2" title="Kinda bad"><span>&#9733</span></label>
<input type="radio" id="star1-2" name="rating3" value="1" <?php if($rtng['waiting']==1){echo "checked ";} if($rtng>0){echo "disabled ";} ?>/><label for="star1-2" title="Sucks big time"><span>&#9733</span></label>
    </fieldset>
</div>
                                      
                     <div class="inputwrap">
                        <label>Comments
                        &nbsp;
                        <br>
                        </label>
                        <textarea id="message" placeholder="Your Message to Us" cols="53" rows="3"><?php echo $rtng['message'];?></textarea>
                     </div>
                     <div style="width: 100%;margin:5px auto;"> 
                        <input style="border:none" type="button" value="submit" class="lg_btn submit" <?php if($rtng>0){echo "disabled ";} ?> id="submit">
                    </div>
                    <div style="width: 100%;margin:5px auto;"> 
                        <input style="border:none"  type="button" value="Cancel" class="lg_btn cancel" id="cancelRtg">
                    </div>
                  </div>
                </form>
               </div>
           </div>
               <div class="col-md-1"></div>
               <div class="col-md-5">
                  <div class="profile full fill">
                     <div class="col-md-4">
                        <div class="propic photo">
                           <img src="<?php echo WEB_ROOT;?>service/public/z_uploads/doctor/small/<?php echo $imageName;?>">
                        </div>
                     </div>
                     <div class="col-md-8">
                        <div class="name">
                           <h3><?php echo $value['firstname']." ".$value['lastname'];?></h3>
                        </div>
                        <div class="prodt">
                           <?php 
                            $len=count($spcl);
                            for($i=0;$i<$len;$i++){
                            echo $spcl[$i][name];
                            }?> </b> <br> <?php echo $value['address'];?> 
                        </div>
                        <!-- <span class="rating rate">
                        <input type="radio" name="rating-input-1" id="rating-input-1-5" class="rating-input">
                        <label class="rating-star" for="rating-input-1-5"></label>
                        <input type="radio" name="rating-input-1" id="rating-input-1-4" class="rating-input">
                        <label class="rating-star" for="rating-input-1-4"></label>
                        <input type="radio" name="rating-input-1" id="rating-input-1-3" class="rating-input">
                        <label class="rating-star" for="rating-input-1-3"></label>
                        <input type="radio" name="rating-input-1" id="rating-input-1-2" class="rating-input">
                        <label class="rating-star" for="rating-input-1-2"></label>
                        <input type="radio" name="rating-input-1" id="rating-input-1-1" class="rating-input">
                        <label class="rating-star" for="rating-input-1-1"></label>
                        </span>
                        <div class="row"></div>
                        <div class="viewpro">
                           <p><a href="#">Book Online</a></p>
                        </div> -->
                     </div>
                  </div>
               </div>
           </div>
        </div>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
<!-- <div class="comnt_plftmain">
        	
        <form> 
        <div class="comnt_starmain"> <div class="comnt_startxt"> Overall Rating  </div>  
        <div class="comnt_starbx">
        <div class="cmnt_satr">
        <input type="hidden" class="dctid" value="<?php echo $page;   ?> "  id="dctid">		
        <div class="cmnt_rating">
        <input type="radio" <?php if($rtng['overall']==1){echo "checked ";} if($rtng>0){echo "disabled ";} ?>  name="rating" value="0" checked  /><span id="cmnt_hide"></span>
        <input type="radio" <?php if($rtng['overall']==1){echo "checked ";} if($rtng>0){echo "disabled ";} ?>  name="rating" value="1" /><span></span>
        <input type="radio" <?php if($rtng['overall']==2){echo "checked ";} if($rtng>0){echo "disabled ";} ?>  name="rating" value="2" /><span></span>
        <input type="radio" <?php if($rtng['overall']==3){echo "checked ";} if($rtng>0){echo "disabled ";} ?>  name="rating" value="3" /><span></span>
        <input type="radio" <?php if($rtng['overall']==4){echo "checked ";} if($rtng>0){echo "disabled ";} ?>  name="rating" value="4" /><span></span>
        <input type="radio" <?php if($rtng['overall']==5){echo "checked ";} if($rtng>0){echo "disabled ";} ?>  name="rating" value="5" /><span></span>
        </div>
        
        </div>
        </div>
        </div>
        
        
        <div class="comnt_starmain"> <div class="comnt_startxt"> Bedside Manner </div>  
        <div class="comnt_starbx">
        <div class="cmnt_satr">
        <input type="hidden" class="dctid" value="<?php  ?>"  >	
        <div class="cmnt2_rating">
        <input type="radio" <?php if($rtng['beside']==1){echo "checked ";} if($rtng>0){echo "disabled ";} ?> name="rating2" value="0" checked /><span id="cmnt2_hide"></span>
        <input type="radio" <?php if($rtng['beside']==1){echo "checked ";} if($rtng>0){echo "disabled ";} ?> name="rating2" value="1"  /><span></span>
        <input type="radio" <?php if($rtng['beside']==2){echo "checked ";} if($rtng>0){echo "disabled ";} ?> name="rating2" value="2"  /><span></span>
        <input type="radio" <?php if($rtng['beside']==3){echo "checked ";} if($rtng>0){echo "disabled ";} ?> name="rating2" value="3" /><span></span>
        <input type="radio" <?php if($rtng['beside']==4){echo "checked ";} if($rtng>0){echo "disabled ";} ?> name="rating2" value="4"  /><span></span>
        <input type="radio" <?php if($rtng['beside']==5){echo "checked ";} if($rtng>0){echo "disabled ";} ?> name="rating2" value="5"  /><span></span>
        </div>
        
        </div>
        </div>
        </div>
        
        <div class="comnt_starmain"> <div class="comnt_startxt"> Wait Time </div>  
        <div class="comnt_starbx">
        <div class="cmnt_satr">
        <input type="hidden" class="dctid" value="<?php  ?>" >		
        <div class="cmnt3_rating">
        <input type="radio" <?php if($rtng['waiting']==1){echo "checked ";} if($rtng>0){echo "disabled ";} ?> name="rating3" value="0" checked /><span id="cmnt3_hide"></span>
        <input type="radio" <?php if($rtng['waiting']==1){echo "checked ";} if($rtng>0){echo "disabled ";} ?> name="rating3" value="1"  /><span></span>
        <input type="radio" <?php if($rtng['waiting']==2){echo "checked ";} if($rtng>0){echo "disabled ";} ?> name="rating3" value="2" /><span></span>
        <input type="radio" <?php if($rtng['waiting']==3){echo "checked ";} if($rtng>0){echo "disabled ";} ?> name="rating3" value="3" /><span></span>
        <input type="radio" <?php if($rtng['waiting']==4){echo "checked ";} if($rtng>0){echo "disabled ";} ?> name="rating3" value="4" /><span></span>
        <input type="radio" <?php if($rtng['waiting']==5){echo "checked ";} if($rtng>0){echo "disabled ";} ?> name="rating3" value="5"  /><span></span>
        </div>
        </div>
        </div>
        </div>
        
          <div class="comnt_pop_cmntbx">
        <div class="comnt_pop_txtare"> Comments  </div>
        <textarea id="message" placeholder="Your Message to Us" name="message" class="comnt_pop_txtbx" style="min-height:70px; "></textarea>
        <label style="width: 160px; float: left;"> <input type="button" value="submit" class="cmnt_btn submit" <?php if($rtng>0){echo "disabled ";} ?> id="submit"></label>
        <label style="width: 160px; float: left;"> <input type="button" value="Cancel" class="cmnt_btn cancel" id="cancelRtg"></label>
        </div>
        </form>
        </div>
        
        
        <div class="comnt_pop_drmain">
        <ul>
        
        
        <li style=" width:338px; height: auto;   float:left; background:#fdfdfd; border:solid #e7e7e7 1px; margin:0px 8px 8px 0 ;  padding:8px 8px 8px 8px; ">
        <div class="comnt_pop_drmain_clm1">
        <img align="left" alt="" src="<?php echo WEB_ROOT;?>service/public/z_uploads/doctor/small/<?php echo $imageName;?>">

        
        
        <div class="comnt_pop_drmain_adrs"> 
        	
        	
        <h2>  <?php echo $value['firstname']." ".$value['lastname'];?> </h2>
        <p><b> <?php 
		$len=count($spcl);
		for($i=0;$i<$len;$i++){
		echo $spcl[$i][name];
		}?> </b> <br> <?php echo $value['address'];?> </p>
        </div>
        </div>
        
        <!--<div class="comt_pop_disc">
        
        <h2> Wednesday, July 16 - 1:00pm </h2>
        <h2> Patient </h2>
        <input type="hidden" class="userid" value="<?php echo $_SESSION['userID']; ?>"  id="userid">
        <p> <?php echo $result['firstname']." ".$result['lastname'];?></p>
        
        <h2> Reason for Visit</h2>
        <p> General Follow Up </p>
        
        </div>
        
        </li>
        </ul>
        </div> -->
