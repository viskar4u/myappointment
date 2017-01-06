<?php
include("./conf/config.inc.php");
if ($_POST['page']) {
    $page     = $_POST['page'];
    $cur_page = $page;
    $page -= 1;
    $per_page     = 5;
    $previous_btn = true;
    $next_btn     = true;
    $first_btn    = true;
    $last_btn     = true;
    $start        = $page * $per_page;
    if ($search == 1) {
        $result        = $scad->searchDoctorLimit(44, $docZip, $insuranceSelect, $subInsuranceSelect,$srchReason, $language,$gender, $start, $per_page);
        $result1       = $scad->searchDoctor(44, $docZip, $insuranceSelect, $subInsuranceSelect,$srchReason, $language,$gender);
        $docSpeciality = 44;
    } else if ($search == 2) {
        $result        = $scad->searchDoctorLimit(8, $docZip, $insuranceSelect, $subInsuranceSelect,$srchReason,$language,$gender, $start, $per_page);
        $result1       = $scad->searchDoctor(8, $docZip, $insuranceSelect, $subInsuranceSelect,$srchReason,$language,$gender);
        $docSpeciality = 8;
    } else if ($search == 3) {
        $result        = $scad->searchDoctorLimit(16, $docZip, $insuranceSelect, $subInsuranceSelect, $srchReason,$language,$gender, $start, $per_page);
        $result1       = $scad->searchDoctor(16, $docZip, $insuranceSelect, $subInsuranceSelect,$srchReason,$language,$gender);
        $docSpeciality = 16;
    } else if ($search == 4) {
        $result        = $scad->searchDoctorLimit(102, $docZip, $insuranceSelect, $subInsuranceSelect,$srchReason, $language,$gender, $start, $per_page);
        $result1       = $scad->searchDoctor(102, $docZip, $insuranceSelect, $subInsuranceSelect,$srchReason,$language, $gender);
        $docSpeciality = 102;
    } else {
        $searchTerms = base64_decode($search);
        parse_str($searchTerms);
		
        $result  = $scad->searchDoctorLimit($docSpeciality, $docZip, $insuranceSelect, $subInsuranceSelect,$srchReason, $language,$gender, $start, $per_page);
        $result1 = $scad->searchDoctor($docSpeciality, $docZip, $insuranceSelect, $subInsuranceSelect,$srchReason,$language, $gender);
    }
    // print_r($result1);
    $end  = count($result1);
    $end1 = count($result);

        $currDate = date('Y-m-d');
    $doc[]=json_decode($allDoctors);
    //print_r($dateCnt);
    $days=array('Mon','Tue','Wed','Thu','Fri','Sat','Sun');
    $columns = 3;
    if($status=='next'){
         $date= ($dateCnt==0) ? date('Y-m-d') : date('Y-m-d' , strtotime($dateCnt. ' + '.$columns.' days'));
         $Day = ($dateCnt==0) ? date('D') : date('D',strtotime($dateCnt. ' + '.$columns.' days'));
    }else{
         $date= ($dateCnt==0) ? date('Y-m-d') : date('Y-m-d' , strtotime($dateCnt. ' - '.$columns.' days'));
         $Day = ($dateCnt==0) ? date('D') : date('D',strtotime($dateCnt. ' - '.$columns.' days'));
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
            $br[] = get_times($br_plan[$key]['start'],$br_plan[$key]['ends']);
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

    //calendar html
         function calendar_html($value,$columns,$Day,$date,$s,$key){
            for($i=0;$i<$columns;$i++){
            $day_C = date('D', strtotime($Day. ' + '.$i.' days'));
            $date_C = date('Y-m-d', strtotime($date. ' + '.$i.' days'));
            $list_work_array[] = $value[$day_C]['working_time'];
            $list_brk_array[] = $value[$day_C]['break_time'];
            if(array_key_exists($date_C,$value['apnttime'])){
            $list_apnt_array[] = $value['apnttime'][$date_C];
            }
            if (in_array($date_C, $value['vacation_date'])){
            $list_vecation_array[] = $value['vacation_time'][$date_C];
            }

            }

            $final_array = array();
            foreach ($list_work_array as $key => $value) {
            foreach ($value as $key1 => $value1) {
            if(array_key_exists($key,$list_work_array)){
            if(in_array($value1,$list_work_array[$key])){
            $final_array[$key][$key1] = $value1;
            }
            }
            if(array_key_exists($key,$list_brk_array)){
            if(in_array($value1,$list_brk_array[$key])){
            $final_array[$key][$key1] = 'Break';
            }
            }
            if(array_key_exists($key,$list_apnt_array)){
            if(in_array($value1,$list_apnt_array[$key])){
            $final_array[$key][$key1] = 'Booked';
            }
            }
            if(array_key_exists($key,$list_vecation_array)){
            if(in_array($value1,$list_vecation_array[$key])){
            $final_array[$key][$key1] = 'In vacation';
            }
            }
            }
            }
            echo '<pre>';
            print_r($final_array);
            echo '</pre>';
            // echo '<pre>';
            // print_r($list_work_array);
            // print_r($list_brk_array);
            // print_r($list_apnt_array);
            // print_r($list_vecation_array);
            // echo '</pre>';
            die;
        }
    //calendar html

    	if(!empty($result1)){
			
    foreach ($result as $key => $value) {
//print_r($value);die;
                //calendar 
                    $cal_result=$scad->getUserDetails($value['doctorID']);
                    $apntdetails=$scad->getAppointmentDetailsWithDate($value['id'],$date,$end_date);
                   // print_r($cal_result);die;
                    $id[]=$cal_result['id'];
                    $check_id[$cal_result['id']]=$cal_result['id'];
                    //echo $result['breaks'];exit;
                    if(! empty($cal_result['working_plan'])){
                        $data[$cal_result['id']]['working_plan']=json_decode($cal_result['working_plan'],TRUE);
                        $data1=1;
                    }else{
                        $data[$cal_result['id']]['working_plan']='none';
                    }
                    if(! empty($cal_result['breaks'])){
                        $data[$cal_result['id']]['breaks']=json_decode($cal_result['breaks'],TRUE);
                    }
                    if(! empty($cal_result['vecation'])){
                        $data[$cal_result['id']]['vacation']=json_decode($cal_result['vecation'],TRUE);
                    }
                    if(is_array($apntdetails)){
                        foreach($apntdetails as $keey=>$valus){
                            $data[$cal_result['id']]['apntdate'][]=$valus['apnt_date'];
                            $data[$cal_result['id']]['apnttime'][$valus['apnt_date']]=get_apnt_times($valus['apnt_starttime'], $valus['apnt_endtime']);
                        }
                    }

                    if(! empty($cal_result['working_plan'])){
        foreach ($data as $key => $value) {
            foreach ($days as  $day) {
                $data[$key][$day]['working_time'] = (array_key_exists('working_plan',$value) && $value['working_plan']!='none') ? get_working_plan($value['working_plan'][$day]) : '';
                $data[$key][$day]['break_time'] = (array_key_exists('breaks',$value)) ? get_break_time($value['breaks'][$day]) : '';
                $data[$key]['vacation_date'] = (array_key_exists('vacation',$value)) ? get_vacation_date($value['vacation']) : '';
                $data[$key]['vacation_time'] = (array_key_exists('vacation',$value)) ? get_vacation_time($value['vacation'],$data[$key]['vacation_date']) : '';
            }
        }
    }
                //calendar
$data_res = '<input type="hidden" id="firstdate" value="'.$date.'">';
        foreach ($data as $key => $value) {
    $data_res .=  '<div class="date">';
            if($value['working_plan']=='none'){
                $data_res .=  '<div style="height:140px;float:left;margin-right:1px;text-align:center;background:#cdcdcd;">
                <p style="margin:0 auto;padding:20px">No availability these days</p></div>';
            }
            else{
            for($i=0;$i<$columns;$i++){
                $day_C = date('D', strtotime($Day. ' + '.$i.' days'));
                $date_C = date('Y-m-d', strtotime($date. ' + '.$i.' days'));
                //if($day_C == $days[$i]){
                $cls = ($i==0) ? 'firstDate_0' : '';
                $data_res .=  '<ul>';
                foreach ($value[$day_C]['working_time'] as $ve_key => $ve_value) {
                     //echo $ve_value;
                    if($ve_key>4){
                        $cls_hi='hidden show'.$key;
                    }else{
                        $cls_hi='';
                    }
                    if($ve_key==4){
                        $data_res .=  '<li class="'.$cls_hi.'" style="background-color: #6a94bc;color: white;"> More </li>';
                    }elseif($ve_value==end($value[$day_C]['working_time'])){
                        $data_res .=  '<li class="'.$cls_hi.'"   style="background-color: #6a94bc;color: white;"> Less </li>';
                    }
                    elseif(is_array($value['vacation_date']) && in_array($date_C, $value['vacation_date'])){
                        if(in_array($date_C, $value['vacation_date'])){
                            if(in_array($ve_value, $value['vacation_time'][$date_C])){
                                $data_res .=  '<li class="'.$cls_hi.'" >vacation</li>';
                            }else{
                                $data_res .=  '<li class="'.$cls_hi.'"  > '.$ve_value.'</li>';
                            }
                        }
                    }elseif(is_array($value[$day_C]['break_time'])){ 
                        if(in_array($ve_value, $value[$day_C]['break_time'])) {
                            $data_res .=  '<li class="'.$cls_hi.'"  > Break </li>';
                        }else{
                        $data_res .=  '<li class="'.$cls_hi.'" > '.$ve_value.'</li>';
                    }
                    }elseif(array_key_exists('apntdate',$value)){
                        if(in_array($date_C, $value['apntdate'])){
                            if(in_array($ve_value, $value['apnttime'][$date_C])){
                                $data_res .=  '<li class="'.$cls_hi.'" >Booked</li>';
                            }else{
                                $data_res .=  '<li class="'.$cls_hi.'" > '.$ve_value.'</li>';
                            }
                        }else{
                        $data_res .=  '<li class="'.$cls_hi.'" > '.$ve_value.'</li>';
                    }
                    }else{
                        $data_res .=  '<li class="'.$cls_hi.'" > '.$ve_value.'</li>';
                    }
                }
                $data_res .=  '</li></ul>';
                //}
            }
            $data_res .=  '</div>';
    }
        $res12[$key]=$data_res;
    }
    //echo $data_res;die;
				$val1  = $scad->getLnt($value['address']);
                //echo $value['address']."<br>";
                if ($value['imageName']) {
                    $docImage = $value['imageName'];
                } else {
                    $docImage = 'no_image.jpg';
                }
				$id1[]=$value['doctorID'];
                $userImg = WEB_ROOT . "service/public/z_uploads/doctor/small/" . $docImage;
                $wid1     = "100px";
                $img1     = "<img src=" . $userImg . " width=" . $wid1 . ">";
                $lat1[]   = $val1['lat'];
                $lng1[]   = $val1['lng'];
                $city1[]  = "<div style=" . "width:100%" . "><div style=" . "width:47%;" . "float:left" . ">" . $img1 . " </div><div style=" . "width:53%;" . "float:left" . "><a href=" . WEB_ROOT . "view-prrofile/" . $value['doctorID'] . ">" . $value['firstname'] . " " . $value['lastname']."</a> ".$value['zipcode']."</div><div>".$value['address']."</div><a href=" . WEB_ROOT . "view-prrofile/" . $value['doctorID'] . " style="."padding:3px 13px"." class="."dr_bkonline"."> Book Online </a></div>";
				//<a target='1' class='dr_bkonline' data-toggle='modal'> Book Online </a>
			}
                //print_r($val1);exit;
			for ($i = 0; $i < $end; $i++) {
                $mapData1[] = array(
                    $city1[$i],
                    $lat1[$i],
                    $lng1[$i]
                );
			}
	}
		
	//echo $i; 
       // $msg = "<div style=\"border:solid #CCC 1px; float:left; height:30px; width:1170px;\"></div>";
        if (!empty($result)) {
			$kk = 0;
            foreach ($result as $key => $value) {
				$kk++;
				//echo $value['zipcode'];exit;
				
				$rat=$scad->getrting($value['doctorID']);
			$len=count($rat);
			  for($j=0;$j<$len;$j++){
				  $overall[$value['doctorID']][]=($rat[$j]['overall'] +$rat[$j]['beside'] +$rat[$j]['waiting'])/3  ;
				  }
			//print_r($overall);
			$rateval=0; 
			for($k=0;$k<count($overall[$value['doctorID']]);$k++){
			  $rate = $overall[$value['doctorID']][$k];
			 $rateval= $rateval+$rate;
			 }
			$doc_rating = round($rateval/count($overall[$value['doctorID']]));
			 
                $spec = $scad->getSpeciality($value['specilaityID']);
                $val  = $scad->getLnt($value['address']);
                //print_r($val);exit;
                //echo $value['address']."<br>";
                if ($value['imageName']) {
                    $docImage = $value['imageName'];
                } else {
                    $docImage = 'no_image.jpg';
                }
				$id[]=$value['doctorID'];
                $userImg = WEB_ROOT . "service/public/z_uploads/doctor/small/" . $docImage;
                $wid     = "100px";
                $img     = "<img src=" . $userImg . " width=" . $wid . ">";
                $lat[]   = $val['lat'];
                $lng[]   = $val['lng'];
                $city[]  = "<div style=" . "width:100%" . "><div style=" . "width:47%;" . "float:left" . ">" . $img . " </div><div style=" . "width:53%;" . "float:left" . "><a href=" . WEB_ROOT . "view-prrofile/" . $value['doctorID'] . ">" . $value['firstname'] . "&nbsp;" . $value['lastname']."</a> ".$value['zipcode']."</div><div>".$value['address']."</div><a href=" . WEB_ROOT . "view-prrofile/" . $value['doctorID'] . " style="."padding:3px 13px"." class="."dr_bkonline"."> Book Online </a></div>";
                //row beigns
                $c=$key+1;
                $msg .=' <div class="row"><div class="col-md-6 details">';
                //profile detail begins
                $msg .='<div class="profile">
                            <div class="col-md-4">
                                <div class="propic">
                                <img src="'.$userImg.'" style="width:93px;height:111px;">
                                    </div>
                                <div class="circle"><p>'.$c.'</p></div>
                                
                                
                                <span class="rating">
                                <input type="radio" class="rating-input"
                                id="rating-input-1-5" name="rating '. $value['doctorID'] .'"';
            if($doc_rating==5){$msg .= 'checked';}
            $msg .= '>
                                <label for="rating-input-1-5" class="rating-star"></label>
                                <input type="radio" class="rating-input"
                                id="rating-input-1-4" name="rating '. $value['doctorID'] .'"';
            if($doc_rating==4){$msg .= 'checked';}
            $msg .= '>
                                <label for="rating-input-1-4" class="rating-star"></label>
                                <input type="radio" class="rating-input"
                                id="rating-input-1-3" name="rating '. $value['doctorID'] .'"';
            if($doc_rating==3){$msg .= 'checked';}
            $msg .= '>
                                <label for="rating-input-1-3" class="rating-star"></label>
                                <input type="radio" class="rating-input"
                                id="rating-input-1-2" name="rating '. $value['doctorID'] .'"';
            if($doc_rating==2){$msg .= 'checked';}
            $msg .= '>
                                <label for="rating-input-1-2" class="rating-star"></label>
                                <input type="radio" class="rating-input"
                                id="rating-input-1-1" name="rating '. $value['doctorID'] .'"';
            if($doc_rating==1){$msg .= 'checked';}
            $msg .= '>
                                <label for="rating-input-1-1" class="rating-star"></label>
                                </span>
                            </div>
                            <div class="col-md-8">
                                <div class="name">
                                  <h3> '. $value['firstname'] ."&nbsp;". $value['lastname'] .' </h3>
                                </div>
                                <div class="prodt">
                                  ' . $spec['name'] . " </b> <br>" . $value['address'] . '
                                </div>
                                <div class="row"></div>
                                <div class="viewpro">
                                  <p><a href="' . WEB_ROOT . '"index.php/view-prrofile/"' . $value["doctorID"] .' ">View Profile</a></p>
                                </div>
                                <div class="book">
                                  <p><a data-toggle="modal" class="dr_bkonline" target="' . $value['doctorID'] .'">Book Online</a></p>
                                </div>
                                
                            </div>
                               
                            <div class="row">
                                   
                                <div class="col-md-12">
                                  <div class="text">
                                    <p>'. substr($value['description'], 0, 180)  . "..." . '
                                    </p>
                                  </div>
                                </div>
                            </div>
                          </div>';
                          //profile detail ends

                          //profile part ends and calendar start here
                          $msg .='</div><div class="col-md-6 ">';

                          //calendar begins
                 //          $msg .='<div class="date-full">
                 //          '.$data_res.'
                 // </div>';
                            $msg .='<div class="date-full">  </div>';
                          //calendar begins

                 //calender end row end and space added
                 $msg .='</div></div><div class="between"></div></div>';

    
			}
            for ($i = 0; $i < $end1; $i++) {
                $mapData[] = array(
                    $city[$i],
                    $lat[$i],
                    $lng[$i]
                );
            }
            //print_r($allAddress);
           $jsonAddr = json_encode($mapData);
			$jsonAddr1 = json_encode($mapData1);
$jsonId=json_encode($id);
$jsonId1=json_encode($id1);
            $msg .= "<input type='hidden' value='" . $jsonAddr . "' class='allzips'>";
			$msg .= "<input type='hidden' value='" . $jsonAddr1 . "' class='allzips1'>";
			$msg.="<input type='hidden' value='".$jsonId."' class='allDoctors' name='allDoctors'>";
			$msg.="<input type='hidden' value='".$jsonId1."' class='allDoctors1' name='allDoctors1'>";
        } else {
            
            $msg .= "<li style=\" padding: 100px; width: 970px;z-index:3;height:120px\">
                        <div class=\"alert alert-block alert-error fade in\">
                           <h4 class=\"alert-heading\">No results found.</h4>
                            <p>There are no search results for the requested search. Perform the search option with different search conditions</p>
                            <p>
                            </p>
                        </div>
                        </li>";
            $msg .= "<input type='hidden' value='none' class='allzips'>";
        }
        $msg .= " </ul>
            </div>
         </div>
         
         </div>
      </div>";
    
    //$msg = "<div class='data'><ul>" . $msg . "</ul></div>"; // Content for Data
    
  
    $no_of_paginations = ceil($end / $per_page);
    
    /* ---------------Calculating the starting and endign values for the loop----------------------------------- */
    if ($cur_page >= 7) {
        $start_loop = $cur_page - 3;
        if ($no_of_paginations > $cur_page + 3)
            $end_loop = $cur_page + 3;
        else if ($cur_page <= $no_of_paginations && $cur_page > $no_of_paginations - 6) {
            $start_loop = $no_of_paginations - 6;
            $end_loop   = $no_of_paginations;
        } else {
            $end_loop = $no_of_paginations;
        }
    } else {
        $start_loop = 1;
        if ($no_of_paginations > 7)
            $end_loop = 7;
        else
            $end_loop = $no_of_paginations;
    }
    /* ----------------------------------------------------------------------------------------------------------- */
    $msg .= "<div class='pagination'>";
    
    // FOR ENABLING THE FIRST BUTTON
    if ($first_btn && $cur_page > 1) {
        $msg .= "<a p='1' class='page acti'>First</a>";
    } else if ($first_btn) {
        $msg .= "<a p='1' class='page1'>First</a>";
    }
    
    // FOR ENABLING THE PREVIOUS BUTTON
    if ($previous_btn && $cur_page > 1) {
        $pre = $cur_page - 1;
        $msg .= "<a p='$pre' class='page acti'>Prev</a>";
    } else if ($previous_btn) {
        $msg .= "<a class='page1'>Prev</a>";
    }
    for ($i = $start_loop; $i <= $end_loop; $i++) {
        
        if ($cur_page == $i)
            $msg .= "<a p='$i'  class='page active acti'>{$i}</a>";
        else
            $msg .= "<a p='$i' class='page1 acti'>{$i}</a>";
    }
    
    // TO ENABLE THE NEXT BUTTON
    if ($next_btn && $cur_page < $no_of_paginations) {
        $nex = $cur_page + 1;
        $msg .= "<a p='$nex' class='page acti'>Next</a>";
    } else if ($next_btn) {
        $msg .= "<a class='page1'>Next</a>";
    }
    
    // TO ENABLE THE END BUTTON
    if ($last_btn && $cur_page < $no_of_paginations) {
        $msg .= "<a p='$no_of_paginations' class='page acti'>Last</a>";
    } else if ($last_btn) {
        $msg .= "<a p='$no_of_paginations' class='page1'>Last</a>";
    }
    echo $msg;
}
?>


