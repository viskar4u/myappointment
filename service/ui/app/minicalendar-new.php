<?php
   include("conf/config.inc.php");
   error_reporting(E_ALL);
   $currDate = date('Y-m-d');
   $doc[]=json_decode($allDoctors);
   // print_r($doc);die;
   $days=array('Mon','Tue','Wed','Thu','Fri','Sat','Sun');
   $columns = 3;
   if($status=='next'){
   	 $date= ($dateCnt===0) ? date('Y-m-d') : date('Y-m-d' , strtotime($dateCnt. ' + '.$columns.' days'));
   	 $Day = ($dateCnt===0) ? date('D') : date('D',strtotime($dateCnt. ' + '.$columns.' days'));
   }else{
   	 $date= ($dateCnt===0) ? date('Y-m-d') : date('Y-m-d' , strtotime($dateCnt. ' - '.$columns.' days'));
   	 $Day = ($dateCnt===0) ? date('D') : date('D',strtotime($dateCnt. ' - '.$columns.' days'));
   }
   $end_date = date('Y-m-d', strtotime($currDate. ' + '.$columns.' days'));
   
   //get working plan
   function get_working_plan($wr_plan){
   	return get_times($wr_plan['start'],$wr_plan['ends']);
   }
   //get working plan
   
   //get break time
   function get_break_time($br_plan){
   	foreach ($br_plan as $key => $value) {
              if($key==='start' || $key==='ends'){
                  $br[] = get_times($br_plan['start'],$br_plan['ends']);
              }else{
                  $br[] = get_times($br_plan[$key]['start'],$br_plan[$key]['ends']);    
              }
              
          }
          return $flat = call_user_func_array('array_merge', $br);
   }
   //get break time
   
   //get vacation times with date
   	function get_vacation_time($va_time_plan,$vacation_date){
   			foreach ($va_time_plan as $key => $value) {
   				$vdate = get_days($value['startdate'], $value['enddate']);
   				foreach ($vdate as $key => $value1) {
   					$vd[$value1] = get_times($value['starttime'], $value['endtime']);
   				}
   			}
   			return $vd;
   		}
   //get vacation times with date
   function get_apnt_times($starttime,$endtime){
   	$vd[] = get_times($starttime, $endtime);
   	return $flat = array_unique(call_user_func_array('array_merge', $vd));
   }
   //get vacation days
   function get_vacation_date($va_time_plan){
   	foreach ($va_time_plan as $key => $value) {
   		$vd[] = get_days($value['startdate'], $value['enddate']);
   	}
   	return $flat = array_unique(call_user_func_array('array_merge', $vd));
   }
   //get vacation days
   
   //get apointment time
   
   //get apointment time
   
   //calculate days between two dates
   function get_days($startdate,$enddate){
   	$begin = new DateTime(date("Y-m-d", strtotime($startdate)));
   	$end = new DateTime(date("Y-m-d", strtotime($enddate)));
   
   	$daterange = new DatePeriod($begin, new DateInterval('P1D'), $end);
   
   	foreach($daterange as $date){
   	$adays[] =$date->format("Y-m-d");
   	}
   	$adays[] =date("Y-m-d", strtotime($enddate)) ;
   	return $adays;  
   }
   //calculate days between two dates
   
   //calculate days between two times
   function get_times($startdate,$enddate){
   	$begin = new DateTime(date("H:i", strtotime($startdate)));
   	$end = new DateTime(date("H:i", strtotime($enddate)));
   
   	$daterange = new DatePeriod($begin, new DateInterval('PT900S'), $end);
   
   	foreach($daterange as $date){
   	$atimes[] =$date->format("H:i A");
   	}
   	$atimes[] =date("H:i A", strtotime($enddate)) ;
   	return $atimes;  
   }
   //calculate days between two times
   
   
      //get date slide
      function date_slide($columns,$date,$cls){
          $data = '';
          for($i=0;$i<$columns;$i++){
              $date_C = date('D Y-m-d', strtotime($date. ' + '.$i.' days'));
              if($cls==1){
                  $data .='<div class="col-sm-2 padding0"><div class="sch-dtetime width100">'.$date_C.'</div></div>';
              }else{
                  $data .='<div class="dttime-list">'.$date_C.'</div>';
              }
          }
          return $data;
      }
      //get date slide
   
      //get lnt and lat
      function getLnt($zip){
          $url = "http://maps.googleapis.com/maps/api/geocode/json?address=
          ".urlencode($zip)."&sensor=false";
          $result_string = file_get_contents($url);
          $result = json_decode($result_string, true);
          //print_r($result);die();
          return $result['results'][0]['geometry']['location'];
      } 
      //get lnt and lat
   
          function map_over_data($value,$scad){
          $s=WEB_ROOT;
          $map_over_data_html='<div class="row">
                                  <div class="col-md-4">
                                      <div class="sch-profile-pic">
                                          <img src="'.$s.'assets/frontend/img/sch-profpic1.png" style="width: 114px;height: 114px;">
                                      </div>
                                  </div>
                                  <div class="col-md-8">
                                      <div class="sch-profile-details">
                                          <h4>'.$value["name"].'</h4>
                                          <h5>Light Goods Vehicle</h5>
                                          <h6>'.$value["address"].'</h6>
                                      </div>
                                  </div>
                              </div>';
          $lat_lng = $scad->getLnt($value["zip"]);
          $map_over_data_lat = $lat_lng['lat'];
          $map_over_data_lng = $lat_lng['lng'];
          $map_over_data_img = $s.'assets/frontend/img/01.png';
   
          return $map_over_data = [$map_over_data_html,$map_over_data_lat,$map_over_data_lng,$map_over_data_img];
   
      }
          function profile_html($value,$s,$key,$button,$count){
          $style = ($button==1)? 'style="display:none"' : '';
          return $profile_html = '<div class="profile Doc'.$key.'">
                                  <div class="col-md-4">
                                      <div class="propic">
                                      <img src='.$value["profile_pic"].'>
                                          </div>
                                      <div class="circle"><p>'.$count.'</p></div>
                                      
                                      
                                      <span class="rating">
                                          <input type="radio"  class="rating-input"
                                              id="rating-input-1-5" name="rating-input-1">
                                          <label for="rating-input-1-5" class="rating-star"></label>
                                          <input type="radio"   class="rating-input"
                                              id="rating-input-1-4" name="rating-input-1">
                                          <label for="rating-input-1-4" class="rating-star"></label>
                                          <input type="radio"   class="rating-input"
                                              id="rating-input-1-3" name="rating-input-1">
                                          <label for="rating-input-1-3" class="rating-star"></label>
                                          <input type="radio"   class="rating-input"
                                              id="rating-input-1-2" name="rating-input-1">
                                          <label for="rating-input-1-2" class="rating-star"></label>
                                          <input type="radio"  class="rating-input"
                                              id="rating-input-1-1" name="rating-input-1">
                                          <label for="rating-input-1-1" class="rating-star"></label>
                                      </span>
                                  </div>
                                  <div class="col-md-8">
                                      <div class="name">
                                          <h3>'.$value["name"].'</h3>
                                      </div>
                                      <div class="prodt">'.$value["address"].'
                                      </div>
                                      <div class="row"></div>
                                      <div class="viewpro">
                                          <p><a href="'. WEB_ROOT . "index.php/view-prrofile/" . $key . '">View Profile</a></p>
                                      </div>
                                      <div class="book">
                                          <p><a href="javascript:void(0);" data-toggle=\"modal\" class=\"dr_bkonline\" target=" '. $key .'">Book Online</a></p>
                                      </div>
                                  </div>
                                 
                                  <div class="row"> 
                                      <div class="col-md-12">
                                          <div class="text">
                                              <p>'.substr($value["description"], 0, 100) . '...'.'
                                              </p>
                                          </div>
                                      </div>
                                  </div>
                              </div>';
      		}
       function calendar_html($value,$columns,$Day,$date,$s,$key){
          if($columns==3){$cal_cls='col-sm-4 col-sm-4';}else{$cal_cls='col-sm-2';}
          $calendar_html = '';
                      if($value['working_plan']=='none'){
                          $calendar_html .= '<div class="sch-profile-box" style="text-align:center;
                          ">
                          <p style="margin:0 auto;padding:20px">No availability these days</p></div></div>';
                      }
                      else{
                          for($i=0;$i<$columns;$i++){
                              $day_C = date('D', strtotime($Day. ' + '.$i.' days'));
                              $date_C = date('Y-m-d', strtotime($date. ' + '.$i.' days'));
                              //if($day_C == $days[$i]){
                              $cls = ($i==0) ? 'firstDate_0' : '';
                  $calendar_html .='<div class="date"><ul class="hri'.$i.$key.'">';
                  foreach ($value[$day_C]['working_time'] as $ve_key => $ve_value) {
                       //echo $ve_value;
                      if($ve_key>4){
                          $cls_hi='hiddens show'.$key;
                      }else{
                          $cls_hi='';
                      }
                      if($ve_key==4){
                          $calendar_html .= '<li  class="bottomBorder active moreClk'.$key.' more '.$cls_hi.' sss" value="'.$key.'"  > <div class="sch-slotex">
                              More
                              </div> </li>';
                      }elseif($ve_value==end($value[$day_C]['working_time'])){
                          $calendar_html .= '<li class="last active less '.$cls_hi.' sss'.$key.'" value="'.$key.'" > <div class="sch-slotex">Less </div></li>';
                      }
                      elseif(is_array($value['vacation_date']) && in_array($date_C, $value['vacation_date'])){
                          if(in_array($date_C, $value['vacation_date'])){
                              if(in_array($ve_value, $value['vacation_time'][$date_C])){
                                  $calendar_html .= '<li class="disabled '.$cls_hi.' "><div class="sch-slot">vacation</div></li>';
                              }else{
                                  $calendar_html .= '<li class="active '.$cls_hi.' appointDate" id="'.$i.'_'.$day_C.' '.$date.'_'.$ve_value.'"> <div class="sch-slot" >'.$ve_value.'</div></li>';
                              }
                          }
                      }elseif(is_array($value[$day_C]['break_time'])){ 
                          if(in_array($ve_value, $value[$day_C]['break_time'])) {
                              $calendar_html .= '<li class="disabled '.$cls_hi.' "> <div class="sch-slot">Break </div></li>';
                          }else{
                          $calendar_html .='<li class="active '.$cls_hi.' appointDate"  id="'.$i.'_'.$day_C.' '.$date.'_'.$ve_value.'"><div class="sch-slot"> '.$ve_value.'</div></li>';
                      }
                      }elseif(array_key_exists('apntdate',$value)){
                          if(in_array($date_C, $value['apntdate'])){
                              if(in_array($ve_value, $value['apnttime'][$date_C])){
                                  $calendar_html .='<li class="disabled '.$cls_hi.'"><div class="sch-slot">Booked</div></li>';
                              }else{
                                  $calendar_html .= '<li class="active '.$cls_hi.' appointDate"  id="'.$i.'_'.$day_C.' '.$date.'_'.$ve_value.'"> <div class="sch-slot">'.$ve_value.'</div></li>';
                              }
                          }else{
                          $calendar_html .='<li class="active '.$cls_hi.' appointDate" id="'.$i.'_'.$day_C.' '.$date.'_'.$ve_value.'"><div class="sch-slot"> '.$ve_value.'</div></li>';
                      }
                      }else{
                          $calendar_html .= '<li class="active '.$cls_hi.' appointDate" id="'.$i.'_'.$day_C.' '.$date.'_'.$ve_value.'"><div class="sch-slot"> '.$ve_value.'</div></li>';
                      }
                  }
                  $calendar_html .= '</ul></div>';
                  //}
              
              }
              //$calendar_html .= '</div>';
      
              }
              return $calendar_html;
      }
   //getting doctor details
   $data1=0; //used for check user has working time 
   foreach ($doc[0] as $key => $value) {
   	
   	$result=$scad->getUserDetails($value);
   	$image_result = $scad->getDocProImg($value);
   	// echo '<pre>';
   	// print_r($image_result);die;
   	$apntdetails=$scad->getAppointmentDetailsWithDate($value,$date,$end_date);
   	$id[]=$result['id'];
   	$check_id[$result['id']]=$result['id'];
   	if (! empty($image_result['name'])) {
                      $docImage = $image_result['name'];
                  } else {
                      $docImage = 'no_image.jpg';
                  }
                  $id1[]=$result['id'];
                  $userImg = WEB_ROOT . "service/public/z_uploads/doctor/small/" . $docImage;
   
                   $rat=$scad->getrting($result['id']);
                      $len=count($rat);
                      $rateval=0; 
                      for($j=0;$j<$len;$j++){
                      $rateval=$rateval+($rat[$j]['overall'] +$rat[$j]['beside'] +$rat[$j]['waiting'])/3  ;
                      
                      }
                      $data[$result['id']]['rating'] =$rateval;
   
                      $data[$result['id']]['name'] = (!empty($result['firstname']) || !empty($result['lastname'])) ? $result['firstname']."&nbsp".$result['lastname'] : 'Not specified';
                      $data[$result['id']]['address'] = (!empty($result['address']) || !empty($result['zipcode'])) ? $result['address'].'<br>'.$result['zipcode'] : 'Not Specified';
                      $data[$result['id']]['zip'] =$result['zipcode'];
                      $data[$result['id']]['description'] = (! empty($result['description'])) ? $result['description'] : '--';
                      $data[$result['id']]['profile_pic'] = $userImg;
   	//echo $result['breaks'];die;
   	if(! empty($result['working_plan'])){
   		$data[$result['id']]['working_plan']=json_decode($result['working_plan'],TRUE);
   		$data1=1;
   	}else{
   		$data[$result['id']]['working_plan']='none';
   	}
   	if(! empty($result['breaks'])){
   		$data[$result['id']]['breaks']=json_decode($result['breaks'],TRUE);
   	}
   	if(! empty($result['vecation'])){
   		$data[$result['id']]['vacation']=json_decode($result['vecation'],TRUE);
   	}
   	if(is_array($apntdetails)){
   		foreach($apntdetails as $keey=>$valus){
   			$data[$result['id']]['apntdate'][]=$valus['apnt_date'];
   			$data[$result['id']]['apnttime'][$valus['apnt_date']]=get_apnt_times($valus['apnt_starttime'], $valus['apnt_endtime']);
   		}
   	}
   }	
   //getting doctor details
   
   ////getting doctor apnt details
   if($data1!=0){
   	foreach ($data as $key => $value) {
   		foreach ($days as  $day) {
   			$data[$key][$day]['working_time'] = (array_key_exists('working_plan',$value) && $value['working_plan']!='none') ? get_working_plan($value['working_plan'][$day]) : '';
   			$data[$key][$day]['break_time'] = (array_key_exists('breaks',$value)) ? get_break_time($value['breaks'][$day]) : '';
   			$data[$key]['vacation_date'] = (array_key_exists('vacation',$value)) ? get_vacation_date($value['vacation']) : '';
   			$data[$key]['vacation_time'] = (array_key_exists('vacation',$value)) ? get_vacation_time($value['vacation'],$data[$key]['vacation_date']) : '';
   		}
   	}
   }
   
   $data_res ='';
              $s =WEB_ROOT;
              $data_res .= '<input type="hidden" class="currentDate"  value="'.$date.'">';
              $count=0;
              foreach ($data as $key => $value) {
                  
                  //print_r($value);exit;
                  //foreach ($days as $day_key => $day_value) {
                  // profile and popup
                  $data_res .='<div class="row">';
   
                  $data_res .='<div class="col-md-6 details">';
                  $data_res .=profile_html($value,$s,$key,0,++$count);
                  $data_res .='</div>';
   
                  $data_res .='<div class="col-md-6"><div class="date-full">';
                  $data_res .=calendar_html($value,$columns,$Day,$date,$s,$key);
                  $data_res .='</div>';
   
                  $data_res .='</div></div><div class="between"></div>';
   
   
   
                  $map_data[] = map_over_data($value,$scad);
   
              }
              
                  $data_res .= "<input type='hidden' value='" . json_encode($map_data) . "' class='allzips'>";
                  $data_res .="<input type='hidden' value='".json_encode($id1)."' class='allDoctors' name='allDoctors'>";
              $date_slide= date_slide($columns,$date,0);
              //echo $data_res ;
              $result_data['date_slide'] = $date_slide;
              $result_data['html'] = $data_res;
              $result_data['statuss'] = 1;
              echo json_encode($result_data);
   //make time slot
   ?>