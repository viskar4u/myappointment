<?php
include("./conf/config.inc.php");
     function is_multi($a) {
    $rv = array_filter($a,'is_array');
    if(count($rv)>0) return 1;
    return 0;
}                   $result = $_GET;
                        $target=$result['target'];
                        $br=$result['f_val'];
						$doc[]=json_decode($br,TRUE);
						//print_r($doc);exit();
						$day=array('Mon','Tue','Wed','Thu','Fri','Sat','Sun');
						$days=array('Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday');
                       if($target=='working_plan'){
                        ?>

      <!--regular time-->
       <div id="update_error" style="margin-top:20px;display:none;text-align:center;" class="alert alert-error">Update Failed.</div>
     <div id="update_succes" style="margin-top:20px;display:none;text-align:center;" class="alert alert-success">Successfully Updated.</div>
     
      <div class="tab_clum1">
     <div class="col-lg-12 bg-black disabled color-palette form-group">
     <div class="col-sm-4"><i class="fa fa-sun-o text-aqua"></i> Day </div>
     <div class="col-sm-4"> 
     <i class="fa fa-clock-o text-aqua"></i> Start Time </div>
     <div class="col-sm-4"> 
     <i class="fa fa-clock-o text-aqua"></i> End Time </div>
     </div> 
     <?php
	 $k=0;
	 foreach($day as $value){
	 ?>
     <div class="col-lg-12 form-group">
     <div class="col-sm-4"> 
     	<input name="" class="check1  " <?php if(!($doc[0][$value]['start']=='none')) echo "checked"; ?>   type="checkbox" value="<?php echo $days[$k]; ?>"> <?php echo $days[$k]; ?> 
     </div>
     <div class="col-sm-4"> 
     	<input type="text" placeholder="" data-type="text" value="<?php echo $doc[0][$value]['start'];?>" <?php if($doc[0][$value]['start']=='none') echo "disabled"; ?>  class="form-control" name="text" id="text" style="min-height:30px;">
     </div>
     <div class="col-sm-4">
      <input type="text" placeholder="" data-type="text" value="<?php echo $doc[0][$value]['ends'];?>" <?php if($doc[0][$value]['ends']=='none') echo "disabled"; ?>  class="form-control" name="text" id="text" style="min-height:30px;">
  		</div>
     </div>
     <?php $k++; } ?>
   
     </div>
     <div class="col-lg-12 form-group">
     	<button class="btn col-lg-12 btn-primary work_enable" >Enable</button>
     </div>
     <!--regular time-->
     <?php } elseif ($target=='breaks') {?>
     	 <div class="tab-pane" id="doc-pass1">
                     <!-- Second  --><div id="update_error1" style="margin-top:20px;display:none;text-align:center;" class="alert alert-error">Update Failed.</div>
     <div id="update_succes1" style="margin-top:20px;display:none;text-align:center;" class="alert alert-success">Successfully Updated.</div>
     <div class="tab_clum2">
     <div class="col-lg-12 bg-black disabled color-palette form-group">
     <div class="col-sm-3"><i class="fa fa-sun-o text-aqua"></i> Day </div>
     <div class="col-sm-3"> 
     <i class="fa fa-clock-o text-aqua"></i> Start Time </div>
     <div class="col-sm-3"> 
     <i class="fa fa-clock-o text-aqua"></i> End Time </div>
     <div class="col-sm-3"> 
     <i class="fa fa-cogs text-aqua"></i> Actions </div>
     </div> 
     <?php 
	 if(empty($doc[0]['Mon'])){
	 ?>
     <div class="col-lg-12 form-group show">
     <div class="col-sm-3"> <input name="" class="check1 Monday"  type="checkbox" value=""> Monday </div>
     <div class="col-sm-3"> <input type="text" value="" placeholder=""  class="form-control input-block-level timeformat1Mon" name="text" id="text" style="min-height:30px;"></div>
     <div class="col-sm-3"> <input type="text" value="" placeholder=""  class="form-control input-block-level timeformat1Mon" name="text" id="text" style="min-height:30px;"></div>
     <div class="col-sm-3"> <img src="<?php echo WEB_ROOT?>service/public/images/tab_clum2_icon5.jpg" onclick="Getbrvalue()" style="cursor:pointer;" class="change1" alt=""><img src="<?php echo WEB_ROOT?>service/public/images/tab_clum2_icon2.jpg" style="cursor:pointer;margin-left:3px;" class="change2" alt=""><img src="<?php echo WEB_ROOT?>service/public/images/tab_clum2_icon4.jpg" class="addNew" style="cursor:pointer;" alt="Monday"></div>
     </div><div class="Mondaybr"></div>
         <?php
	 }else{
		$ar=$doc[0]['Mon'];
	  $b=is_multi($doc[0]['Mon']);
						if($b==1){
	 foreach($ar as $key=>$value){
		 $start[]=$value['start'];
		 $ends[]=$value['ends'];
	 //	print_r($value);
	 }}
	 else{
		 $start[]=$ar['start'];
		 $ends[]=$ar['ends'];
		 }
		 $len=count($start);
	 ?>
       <?php for($i=0;$i<$len;$i++){ ?> 
     <div class="col-lg-12 form-group exist">
     <div class="col-sm-3"> <input name=""  type="checkbox" value=""> Monday </div>
    
     <div class="col-sm-3"> <?php echo $start[$i]?> </div>
     
     <div class="col-sm-3"> <?php echo $ends[$i]?> </div>
     <div class="col-sm-3"> <img src="<?php echo WEB_ROOT?>service/public/images/tab_clum2_icon1.jpg" style="cursor:pointer;" class="change" alt=""> <img src="<?php echo WEB_ROOT?>service/public/images/tab_clum2_icon2.jpg" class="removeBreak" style="cursor:pointer;" alt=""><?php
	 if($i==($len-1))
	 {
	?> <img src="<?php echo WEB_ROOT?>service/public/images/tab_clum2_icon4.jpg"  class="addNew" style="cursor:pointer;" alt="Monday"><?php
	 }
	 ?>
     </div>
     </div>
     
      <div class="col-lg-12 form-group " style="display:none">
     <div class="col-sm-3"> <input name="" class="check1 Monday" <?php if(!($start[$i]=='none')){echo "checked";} ?> type="checkbox" value=""> Monday </div>
     <div class="col-sm-3"> <input type="text" value="<?php echo $start[$i]?>" placeholder=""  class="form-control input-block-level timeformat1Mon" name="text" id="text" style="min-height:30px;"></div>
     <div class="col-sm-3"> <input type="text" value="<?php echo $ends[$i]?>" placeholder=""  class="form-control input-block-level timeformat1Mon" name="text" id="text" style="min-height:30px;"></div>
     <div class="col-sm-3"> <img src="<?php echo WEB_ROOT?>service/public/images/tab_clum2_icon5.jpg"  style="cursor:pointer;" class="change1" alt=""><img src="<?php echo WEB_ROOT?>service/public/images/tab_clum2_icon2.jpg" style="cursor:pointer;margin-left:3px;" class="change2" alt=""></div>
     </div>
     <?php
	 if($i==($len-1))
	 {
	?>
     <div class="Mondaybr"></div><?php
	 }
	 ?>
     <?php }} ?>
    
   <?php 
	 if(empty($doc[0]['Tue'])){
	 ?>
     <div class="col-lg-12 form-group show">
     <div class="col-sm-3"> <input name="" class="check1 Tuesday"  type="checkbox" value=""> Tuesday </div>
     <div class="col-sm-3"> <input type="text" value="" placeholder="" data-type="text" data-trigger="change" data-required="true" class="form-control input-block-level timeformat1Thu" name="text" id="text" style="min-height:30px;"></div>
     <div class="col-sm-3"> <input type="text" value="" placeholder="" data-type="text" data-trigger="change" data-required="true" class="form-control input-block-level timeformat1Thu" name="text" id="text" style="min-height:30px;"></div>
     <div class="col-sm-3"> <img src="<?php echo WEB_ROOT?>service/public/images/tab_clum2_icon5.jpg" onclick="Getbrvalue()" style="cursor:pointer;" class="change1" alt=""><img src="<?php echo WEB_ROOT?>service/public/images/tab_clum2_icon2.jpg" style="cursor:pointer;margin-left:3px;" class="change2" alt=""><img src="<?php echo WEB_ROOT?>service/public/images/tab_clum2_icon4.jpg" class="addNew" style="cursor:pointer;" alt="Tuesday"></div>
     </div><div class="Tuesdaybr"></div>
         <?php
	 }else{
		 $ar=$doc[0]['Tue'];
	  $b=is_multi($doc[0]['Tue']);
						if($b==1){
	 foreach($ar as $key=>$value){
		 $starttu[]=$value['start'];
		 $endstu[]=$value['ends'];
	 //	print_r($value);
	 }}
	 else{
		 $starttu[]=$ar['start'];
		 $endstu[]=$ar['ends'];
		 }
		 $len=count($starttu);
	 ?>
       <?php for($i=0;$i<$len;$i++){ ?> 
     <div class="col-lg-12 form-group exist">
     <div class="col-sm-3"> <input name=""  type="checkbox" value=""> Tuesday </div>
    
     <div class="col-sm-3"> <?php echo $starttu[$i]?> </div>
     
     <div class="col-sm-3"> <?php echo $endstu[$i]?> </div>
     <div class="col-sm-3"> <img src="<?php echo WEB_ROOT?>service/public/images/tab_clum2_icon1.jpg" style="cursor:pointer;" class="change" alt=""> <img src="<?php echo WEB_ROOT?>service/public/images/tab_clum2_icon2.jpg" class="removeBreak" style="cursor:pointer;" alt=""><?php
	 if($i==($len-1))
	 {
	?> <img src="<?php echo WEB_ROOT?>service/public/images/tab_clum2_icon4.jpg" class="addNew" style="cursor:pointer;" alt="Tuesday"><?php
	 }
	 ?>
     
     </div>
     </div>
     
      <div class="col-lg-12 form-group " style="display:none">
     <div class="col-sm-3"> <input name="" class="check1 Tuesday" <?php if(!($starttu[$i]=='none')){echo "checked";} ?> type="checkbox" value=""> Tuesday </div>
     <div class="col-sm-3"> <input type="text" value="<?php echo $starttu[$i]?>" placeholder=""  class="form-control input-block-level timeformat1Tue" name="text" id="text" style="min-height:30px;"></div>
     <div class="col-sm-3"> <input type="text" value="<?php echo $endstu[$i]?>" placeholder=""  class="form-control input-block-level timeformat1Tue" name="text" id="text" style="min-height:30px;"></div>
     <div class="col-sm-3"> <img src="<?php echo WEB_ROOT?>service/public/images/tab_clum2_icon5.jpg" onclick="Getbrvalue()" style="cursor:pointer;" class="change1" alt=""><img src="<?php echo WEB_ROOT?>service/public/images/tab_clum2_icon2.jpg" style="cursor:pointer;margin-left:3px;" class="change2" alt=""></div>
     </div><?php
	 if($i==($len-1))
	 {
	?>
     <div class="Tuesdaybr"></div><?php
	 }
	 ?>
     <?php }} ?>
     
      <?php 
	 if(empty($doc[0]['Wed'])){
	 ?>
     <div class="col-lg-12 form-group show">
     <div class="col-sm-3"> <input name="" class="check1 Wednesday"  type="checkbox" value=""> Wednesday </div>
     <div class="col-sm-3"> <input type="text" value="" placeholder="" data-type="text"  class="form-control input-block-level timeformat1Wed" name="text" id="text" style="min-height:30px;"></div>
     <div class="col-sm-3"> <input type="text" value="" placeholder="" data-type="text" class="form-control input-block-level timeformat1Wed" name="text" id="text" style="min-height:30px;"></div>
     <div class="col-sm-3"> <img src="<?php echo WEB_ROOT?>service/public/images/tab_clum2_icon5.jpg" onclick="Getbrvalue()" style="cursor:pointer;" class="change1" alt=""><img src="<?php echo WEB_ROOT?>service/public/images/tab_clum2_icon2.jpg" style="cursor:pointer;margin-left:3px;" class="change2" alt=""><img src="<?php echo WEB_ROOT?>service/public/images/tab_clum2_icon4.jpg" class="addNew" style="cursor:pointer;" alt="Wednesday"></div>
     </div><div class="Wednesdaybr"></div>
         <?php
	 }else{
		$ar=$doc[0]['Wed'];
	  $b=is_multi($doc[0]['Wed']);
						if($b==1){
	 foreach($ar as $key=>$value){
		 $startw[]=$value['start'];
		 $endsw[]=$value['ends'];
	 //	print_r($value);
	 }}
	 else{
		 $startw[]=$ar['start'];
		 $endsw[]=$ar['ends'];
		 }
		 $len=count($startw);
	 ?>
       <?php for($i=0;$i<$len;$i++){ ?> 
     <div class="col-lg-12 form-group exist">
     <div class="col-sm-3"> <input name="" type="checkbox" value=""> Wednesday </div>
    
     <div class="col-sm-3"> <?php echo $startw[$i]?> </div>
     
     <div class="col-sm-3"> <?php echo $endsw[$i]?> </div>
     <div class="col-sm-3"> <img src="<?php echo WEB_ROOT?>service/public/images/tab_clum2_icon1.jpg" style="cursor:pointer;" class="change" alt=""> <img src="<?php echo WEB_ROOT?>service/public/images/tab_clum2_icon2.jpg" class="removeBreak" style="cursor:pointer;" alt=""><?php
	 if($i==($len-1))
	 {
	?> <img src="<?php echo WEB_ROOT?>service/public/images/tab_clum2_icon4.jpg" style="cursor:pointer;" class="addNew" alt="Wednesday"><?php
	 }
	 ?></div>
     </div>
     
      <div class="col-lg-12 form-group " style="display:none">
     <div class="col-sm-3"> <input name="" class="check1 Wednesday" <?php if(!($startw[$i]=='none')){echo "checked";} ?>  type="checkbox" value=""> Wednesday </div>
     <div class="col-sm-3"> <input type="text" value="<?php echo $startw[$i]?>" placeholder="" class="form-control input-block-level timeformat1Wed" name="text" id="text" style="min-height:30px;"></div>
     <div class="col-sm-3"> <input type="text" value="<?php echo $endsw[$i]?>" placeholder="" class="form-control input-block-level timeformat1Wed" name="text" id="text" style="min-height:30px;"></div>
     <div class="col-sm-3"> <img src="<?php echo WEB_ROOT?>service/public/images/tab_clum2_icon5.jpg" onclick="Getbrvalue()" style="cursor:pointer;" class="change1" alt=""><img src="<?php echo WEB_ROOT?>service/public/images/tab_clum2_icon2.jpg" style="cursor:pointer;margin-left:3px;" class="change2" alt=""></div>
     </div><?php
	 if($i==($len-1))
	 {
	?> 
     <div class="Wednesdaybr"></div>
     <?php }}} ?>
     
      <?php 
	 if(empty($doc[0]['Thu'])){
	 ?>
     <div class="col-lg-12 form-group show">
     <div class="col-sm-3"> <input name="" class="check1 Thursday"  type="checkbox" value=""> Thursday </div>
     <div class="col-sm-3"> <input type="text" value="" placeholder="" data-type="text" class="form-control input-block-level timeformat1Thu" name="text" id="text" style="min-height:30px;"></div>
     <div class="col-sm-3"> <input type="text" value="" placeholder="" data-type="text" class="form-control input-block-level timeformat1Thu" name="text" id="text" style="min-height:30px;"></div>
     <div class="col-sm-3"> <img src="<?php echo WEB_ROOT?>service/public/images/tab_clum2_icon5.jpg" onclick="Getbrvalue()" style="cursor:pointer;" class="change1" alt=""><img src="<?php echo WEB_ROOT?>service/public/images/tab_clum2_icon2.jpg" style="cursor:pointer;margin-left:3px;" class="change2" alt=""><img src="<?php echo WEB_ROOT?>service/public/images/tab_clum2_icon4.jpg" class="addNew" style="cursor:pointer;" alt="Thursday"></div>
     </div><div class="Thursdaybr"></div>
         <?php
	 }else{
		$ar=$doc[0]['Thu'];
	  $b=is_multi($doc[0]['Thu']);
						if($b==1){
	 foreach($ar as $key=>$value){
		 $startt[]=$value['start'];
		 $endst[]=$value['ends'];
	 //	print_r($value);
	 }}
	 else{
		 $startt[]=$ar['start'];
		 $endst[]=$ar['ends'];
		 }
		 $len=count($startt);
	 ?>
       <?php for($i=0;$i<$len;$i++){ ?> 
     <div class="col-lg-12 form-group exist">
     <div class="col-sm-3"> <input name="" type="checkbox" value=""> Thursday </div>
    
     <div class="col-sm-3"> <?php echo $startt[$i]?> </div>
     
     <div class="col-sm-3"> <?php echo $endst[$i]?> </div>
     <div class="col-sm-3"> <img src="<?php echo WEB_ROOT?>service/public/images/tab_clum2_icon1.jpg" style="cursor:pointer;" class="change" alt=""> <img src="<?php echo WEB_ROOT?>service/public/images/tab_clum2_icon2.jpg" class="removeBreak" style="cursor:pointer;" alt=""><?php
	 if($i==($len-1))
	 {
	?> <img src="<?php echo WEB_ROOT?>service/public/images/tab_clum2_icon4.jpg" class="addNew" style="cursor:pointer;" alt="Thursday"><?php
	 }
	 ?></div>
     </div>
     
      <div class="col-lg-12 form-group " style="display:none">
     <div class="col-sm-3"> <input name="" type="checkbox" class="check1 Thursday" <?php if(!($startt[$i]=='none')){echo "checked";} ?>  value=""> Thursday </div>
     <div class="col-sm-3"> <input type="text" value="<?php echo $startt[$i]?>" placeholder="" class="form-control input-block-level timeformat1Thu" name="text" id="text" style="min-height:30px;"></div>
     <div class="col-sm-3"> <input type="text" value="<?php echo $endst[$i]?>" placeholder="" class="form-control input-block-level timeformat1Thu" name="text" id="text" style="min-height:30px;"></div>
     <div class="col-sm-3"> <img src="<?php echo WEB_ROOT?>service/public/images/tab_clum2_icon5.jpg" onclick="Getbrvalue()" style="cursor:pointer;" class="change1" alt=""><img src="<?php echo WEB_ROOT?>service/public/images/tab_clum2_icon2.jpg" style="cursor:pointer;margin-left:3px;" class="change2" alt=""></div>
     </div><?php
	 if($i==($len-1))
	 {
	?>
     <div class="Thursdaybr"></div>
     <?php }} } ?>
     
        <?php 
	 if(empty($doc[0]['Fri'])){
	 ?>
     <div class="col-lg-12 form-group show">
     <div class="col-sm-3"> <input name="" class="check1 Friday"  type="checkbox" value=""> Friday </div>
     <div class="col-sm-3"> <input type="text" value="" placeholder="" data-type="text" class="form-control input-block-level timeformat1Fri" name="text" id="text" style="min-height:30px;"></div>
     <div class="col-sm-3"> <input type="text" value="" placeholder="" data-type="text" class="form-control input-block-level timeformat1Fri" name="text" id="text" style="min-height:30px;"></div>
     <div class="col-sm-3"> <img src="<?php echo WEB_ROOT?>service/public/images/tab_clum2_icon5.jpg" onclick="Getbrvalue()" style="cursor:pointer;" class="change1" alt=""><img src="<?php echo WEB_ROOT?>service/public/images/tab_clum2_icon2.jpg" style="cursor:pointer;margin-left:3px;" class="change2" alt=""><img src="<?php echo WEB_ROOT?>service/public/images/tab_clum2_icon4.jpg" class="addNew" style="cursor:pointer;" alt="Friday"></div>
     </div><div class="Fridaybr"></div>
         <?php
	 }else{
		$ar=$doc[0]['Fri'];
	  $b=is_multi($doc[0]['Fri']);
						if($b==1){
	 foreach($ar as $key=>$value){
		 $startf[]=$value['start'];
		 $endsf[]=$value['ends'];
	 //	print_r($value);
	 }}
	 else{
		 $startf[]=$ar['start'];
		 $endsf[]=$ar['ends'];
		 }
		 $len=count($startf);
	 ?>
       <?php for($i=0;$i<$len;$i++){ ?> 
     <div class="col-lg-12 form-group exist">
     <div class="col-sm-3"> <input name="" type="checkbox" value=""> Friday </div>
    
     <div class="col-sm-3"> <?php echo $startf[$i]?> </div>
     
     <div class="col-sm-3"> <?php echo $endsf[$i]?> </div>
     <div class="col-sm-3"> <img src="<?php echo WEB_ROOT?>service/public/images/tab_clum2_icon1.jpg" style="cursor:pointer;" class="change" alt=""> <img src="<?php echo WEB_ROOT?>service/public/images/tab_clum2_icon2.jpg" class="removeBreak" style="cursor:pointer;" alt=""><?php
	 if($i==($len-1))
	 {
	?> <img src="<?php echo WEB_ROOT?>service/public/images/tab_clum2_icon4.jpg" class="addNew" style="cursor:pointer;" alt="Friday"><?php
	 }
	 ?></div>
     </div>
     
      <div class="col-lg-12 form-group " style="display:none">
     <div class="col-sm-3"> <input name="" type="checkbox" class="check1 Friday" <?php if(!($startf[$i]=='none')){echo "checked";} ?>  value=""> Friday </div>
     <div class="col-sm-3"> <input type="text" value="<?php echo $startf[$i]?>" placeholder="" class="form-control input-block-level timeformat1Fri" name="text" id="text" style="min-height:30px;"></div>
     <div class="col-sm-3"> <input type="text" value="<?php echo $endsf[$i]?>" placeholder="" class="form-control input-block-level timeformat1Fri" name="text" id="text" style="min-height:30px;"></div>
     <div class="col-sm-3"> <img src="<?php echo WEB_ROOT?>service/public/images/tab_clum2_icon5.jpg" onclick="Getbrvalue()" style="cursor:pointer;" class="change1" alt=""><img src="<?php echo WEB_ROOT?>service/public/images/tab_clum2_icon2.jpg" style="cursor:pointer;margin-left:3px;" class="change2" alt=""></div>
     </div><?php
	 if($i==($len-1))
	 {
	?>
     <div class="Fridaybr"></div>
     <?php }} }?>
     
     <?php 
	 if(empty($doc[0]['Sat'])){
	 ?>
     <div class="col-lg-12 form-group show">
     <div class="col-sm-3"> <input name="" class="check1 Saturday"  type="checkbox" value=""> Saturday </div>
     <div class="col-sm-3"> <input type="text" value="" placeholder="" data-type="text" class="form-control input-block-level timeformat1Sat" name="text" id="text" style="min-height:30px;"></div>
     <div class="col-sm-3"> <input type="text" value="" placeholder="" data-type="text" class="form-control input-block-level timeformat1Sat" name="text" id="text" style="min-height:30px;"></div>
     <div class="col-sm-3"> <img src="<?php echo WEB_ROOT?>service/public/images/tab_clum2_icon5.jpg" onclick="Getbrvalue()" style="cursor:pointer;" class="change1" alt=""><img src="<?php echo WEB_ROOT?>service/public/images/tab_clum2_icon2.jpg" style="cursor:pointer;margin-left:3px;" class="change2" alt=""><img src="<?php echo WEB_ROOT?>service/public/images/tab_clum2_icon4.jpg" class="addNew" style="cursor:pointer;" alt="Saturday"></div>
     </div><div class="Saturdaybr"></div>
         <?php
	 }else{
		$ar=$doc[0]['Sat'];
	  $b=is_multi($doc[0]['Sat']);
						if($b==1){
	 foreach($ar as $key=>$value){
		 $startsa[]=$value['start'];
		 $endssa[]=$value['ends'];
	 //	print_r($value);
	 }}
	 else{
		 $startsa[]=$ar['start'];
		 $endssa[]=$ar['ends'];
		 }
		 $len=count($startsa);
	 ?>
       <?php for($i=0;$i<$len;$i++){ ?> 
     <div class="col-lg-12 form-group exist">
     <div class="col-sm-3"> <input name="" type="checkbox" value=""> Saturday </div>
    
     <div class="col-sm-3"> <?php echo $startsa[$i]?> </div>
     
     <div class="col-sm-3"> <?php echo $endssa[$i]?> </div>
     <div class="col-sm-3"> <img src="<?php echo WEB_ROOT?>service/public/images/tab_clum2_icon1.jpg" style="cursor:pointer;" class="change" alt=""> <img src="<?php echo WEB_ROOT?>service/public/images/tab_clum2_icon2.jpg" class="removeBreak" style="cursor:pointer;" alt=""><?php
	 if($i==($len-1))
	 {
	?> <img src="<?php echo WEB_ROOT?>service/public/images/tab_clum2_icon4.jpg" class="addNew" style="cursor:pointer;" alt="Saturday"><?php
	 }
	 ?></div>
     </div>
     
      <div class="col-lg-12 form-group " style="display:none">
     <div class="col-sm-3"> <input name="" type="checkbox" class="check1 Saturday" <?php if(!($startsa[$i]=='none')){echo "checked";} ?>  value=""> Saturday </div>
     <div class="col-sm-3"> <input type="text" value="<?php echo $startsa[$i]?>" placeholder="" class="form-control input-block-level timeformat1Sat" name="text" id="text" style="min-height:30px;"></div>
     <div class="col-sm-3"> <input type="text" value="<?php echo $endssa[$i]?>" placeholder="" class="form-control input-block-level timeformat1Sat" name="text" id="text" style="min-height:30px;"></div>
     <div class="col-sm-3"> <img src="<?php echo WEB_ROOT?>service/public/images/tab_clum2_icon5.jpg" onclick="Getbrvalue()" style="cursor:pointer;" class="change1" alt=""><img src="<?php echo WEB_ROOT?>service/public/images/tab_clum2_icon2.jpg" style="cursor:pointer;margin-left:3px;" class="change2" alt=""></div>
     </div>
     <?php
	 if($i==($len-1))
	 {
	?>
     <div class="Saturdaybr"></div>
     <?php }}} ?>
     
     <?php 
	 if(empty($doc[0]['Sun'])){
	 ?>
     <div class="col-lg-12 form-group show">
     <div class="col-sm-3"> <input name="" class="check1 Sunday"  type="checkbox" value=""> Sunday </div>
     <div class="col-sm-3"> <input type="text" value="" placeholder="" data-type="text" class="form-control input-block-level timeformat1Sun" name="text" id="text" style="min-height:30px;"></div>
     <div class="col-sm-3"> <input type="text" value="" placeholder="" data-type="text" class="form-control input-block-level timeformat1Sun" name="text" id="text" style="min-height:30px;"></div>
     <div class="col-sm-3"> <img src="<?php echo WEB_ROOT?>service/public/images/tab_clum2_icon5.jpg" onclick="Getbrvalue()" style="cursor:pointer;" class="change1" alt=""><img src="<?php echo WEB_ROOT?>service/public/images/tab_clum2_icon2.jpg" style="cursor:pointer;margin-left:3px;" class="change2" alt=""><img src="<?php echo WEB_ROOT?>service/public/images/tab_clum2_icon4.jpg" class="addNew" style="cursor:pointer;" alt="Sunday"></div>
     </div><div class="Sundaybr"></div>
         <?php
	 }else{
		$ar=$doc[0]['Sun'];
	  $b=is_multi($doc[0]['Sun']);
						if($b==1){
	 foreach($ar as $key=>$value){
		 $startsu[]=$value['start'];
		 $endssu[]=$value['ends'];
	 //	print_r($value);
	 }}
	 else{
		 $startsu[]=$ar['start'];
		 $endssu[]=$ar['ends'];
		 }
		 $len=count($startsu);
	 ?>
       <?php for($i=0;$i<$len;$i++){ ?> 
     <div class="col-lg-12 form-group exist">
     <div class="col-sm-3"> <input name="" type="checkbox"  value=""> Sunday </div>
    
     <div class="col-sm-3"> <?php echo $startsu[$i]?> </div>
     
     <div class="col-sm-3"> <?php echo $endssu[$i]?> </div>
     <div class="col-sm-3"> <img src="<?php echo WEB_ROOT?>service/public/images/tab_clum2_icon1.jpg" style="cursor:pointer;" class="change" alt=""> <img src="<?php echo WEB_ROOT?>service/public/images/tab_clum2_icon2.jpg" class="removeBreak" style="cursor:pointer;" alt=""><?php
	 if($i==($len-1))
	 {
	?> <img src="<?php echo WEB_ROOT?>service/public/images/tab_clum2_icon4.jpg" class="addNew" style="cursor:pointer;" alt="Sunday"><?php
	 }
	 ?></div>
     </div>
     
      <div class="col-lg-12 form-group " style="display:none">
     <div class="col-sm-3"> <input name="" type="checkbox" class="check1 Sunday" <?php if(!($startsu[$i]=='none')){echo "checked";} ?>  value=""> Sunday </div>
     <div class="col-sm-3"> <input type="text" value="<?php echo $startsu[$i]?>" placeholder="" class="form-control input-block-level timeformat1Sun" name="text" id="text" style="min-height:30px;"></div>
     <div class="col-sm-3"> <input type="text" value="<?php echo $endssu[$i]?>" placeholder="" class="form-control input-block-level timeformat1Sun" name="text" id="text" style="min-height:30px;"></div>
     <div class="col-sm-3"> <img src="<?php echo WEB_ROOT?>service/public/images/tab_clum2_icon5.jpg" onclick="Getbrvalue()" style="cursor:pointer;" class="change1" alt=""><img src="<?php echo WEB_ROOT?>service/public/images/tab_clum2_icon2.jpg" style="cursor:pointer;margin-left:3px;" class="change2" alt=""></div>
     </div><?php
	 if($i==($len-1))
	 {
	?>
     <div class="Sundaybr"></div>
     <?php }}} ?>
     
     
     </div>
     <!-- END Second  --><!--<button class="setWrkTime">set</button>-->
                  </div>
     <?php } elseif ($target=='vacation') { ?>
     	<div class="tab-pane" id="doc-imageupload">
                   	<!-- Second  --><div id="update_error2" style="margin-top:20px;display:none;text-align:center;" class="alert alert-error">Update Failed.</div>
     <div id="update_succes2" style="margin-top:20px;display:none;text-align:center;" class="alert alert-success">Successfully Updated.</div>
     <div class="tab_clum3">
     	<div class="col-xs-12 bg-black disabled color-palette form-group">
     <div class="col-xs-2 col-xs-offset-1"><i class="fa fa-calendar text-aqua"></i><span> Start Date</span> </div>
     <div class="col-xs-2"> 
     <i class="fa fa-calendar text-aqua"></i><span> End Date</span> </div>
     <div class="col-xs-2"> 
     <i class="fa fa-clock-o text-aqua"></i> <span> Start Time</span> </div>
     <div class="col-xs-2"> 
     <i class="fa fa-clock-o text-aqua"></i><span> End Time</span>  </div>
     <div class="col-xs-2"> 
     <i class="fa fa-cogs text-aqua"></i> <span> Actions</span> </div>
     </div> 
     
        <div class="vecation">
        
        </div>
        <?php 
		if(!empty($doc[0])){
		foreach($doc as $key=>$value){
			$leng=count($value);
		}
		for($jk=0;$jk<$leng;$jk++){
		?>
     <div class="col-xs-12 form-group">
     <!--<div class="tab_clum2_frm_day"> <input name="" type="checkbox" value=""> Monday </div>-->
     <div class="col-xs-2 col-xs-offset-1"> <?php echo $value[$jk][startdate]; ?> </div>
     <div class="col-xs-2"><?php echo $value[$jk][enddate]; ?> </div>
     <div class="col-xs-2"> <?php echo $value[$jk][starttime]; ?>  </div>
     <div class="col-xs-2"> <?php echo $value[$jk][endtime]; ?>  </div>
     <div class="col-xs-2"> <img src="<?php echo WEB_ROOT?>service/public/images/tab_clum2_icon1.jpg" style="cursor:pointer;" class="change" alt=""> <img src="<?php echo WEB_ROOT?>service/public/images/tab_clum2_icon2.jpg" class="removeVecation" style="cursor:pointer;" alt=""><?php
	 if($jk==($leng-1))
	 {
	?><img src="<?php echo WEB_ROOT?>service/public/images/tab_clum2_icon4.jpg" class="setVecation" style="cursor:pointer;" alt="Sunday">
    <?php } ?></div>
     </div>
     
      <div class="col-xs-12 form-group" style="display:none">
     <!--<div class="tab_clum2_frm_day"> <input name="" type="checkbox" value=""> Sunday </div>-->
     <div class="col-xs-2 col-xs-offset-1"> <input type="text" value="<?php echo $value[$jk][startdate]; ?>"  name="dob" id="dob" placeholder="DD-MM-YY" class="form-control input-block-level startdate" style="min-height:30px;"/> </div>
     <div class="col-xs-2"> <input type="text" value="<?php echo $value[$jk][enddate]; ?>"  name="dob" id="dob" placeholder="DD-MM-YY" class="form-control input-block-level enddate" style="min-height:30px;"/></div>
     <div class="col-xs-2"> <input type="text" value="<?php echo $value[$jk][starttime]; ?>"  class="form-control input-block-level starttime timeformat" name="text" id="text" style="min-height:30px;"></div>
     <div class="col-xs-2"> <input type="text" value="<?php echo $value[$jk][endtime]; ?>"  class="form-control input-block-level endtime timeformat" name="text" id="text" style="min-height:30px;"></div>
     <div class="col-xs-2"> <img src="<?php echo WEB_ROOT?>service/public/images/tab_clum2_icon5.jpg" style="cursor:pointer;" class="savevecation1" alt=""><img src="<?php echo WEB_ROOT?>service/public/images/tab_clum2_icon2.jpg"  style="cursor:pointer;margin-left:3px;" class="change2" alt=""></div>
     </div>
     <?php }
	 } else {?>
     <div class="col-xs-12 form-group show" >
     <!--<div class="tab_clum2_frm_day"> <input name="" type="checkbox" value=""> Sunday </div>-->
     <div class="col-xs-2 col-xs-offset-1"> <input type="text"   name="dob" id="dob" placeholder="DD-MM-YY" class="form-control input-block-level startdate" style="min-height:30px;"/> </div>
     <div class="col-xs-2"> <input type="text"   name="dob" id="dob" placeholder="DD-MM-YY" class="form-control input-block-level enddate" style="min-height:30px;"/></div>
     <div class="col-xs-2"> <input type="text"  placeholder=""  class="form-control input-block-level starttime timeformat" name="text" id="text" style="min-height:30px;"></div>
     <div class="col-xs-2"> <input type="text"  placeholder=""  class="form-control  input-block-level endtime timeformat" name="text" id="text" style="min-height:30px;"></div>
     <div class="col-xs-2"> <img src="<?php echo WEB_ROOT?>service/public/images/tab_clum2_icon5.jpg" style="cursor:pointer;" class="savevecation1" alt=""><img src="<?php echo WEB_ROOT?>service/public/images/tab_clum2_icon2.jpg" style="cursor:pointer;margin-left:3px;" class="change2" alt=""><img src="<?php echo WEB_ROOT?>service/public/images/tab_clum2_icon4.jpg" class="setVecation" style="cursor:pointer;" alt="Sunday"></div>
     </div>
     
     <?php }?>
     </div>
     
     <!-- END Second <button class="setVecation"> Add New Vecation </button> -->
                  </div>
               </div>
            </div>
     <?php }?>