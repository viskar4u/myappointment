<?php
include("./conf/config.inc.php");
error_reporting(E_ALL);
//functions begin
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
        function get_vacation_time($va_time_plan){
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
                                        <p><a href="javascript:void(0);" data-toggle="modal" class="dr_bkonline" targets="'. $key .'">Book Online</a></p>
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
                                $calendar_html .= '<li class="active '.$cls_hi.' appointDate" id="'.$key.'_'.$day_C.' '.$date.'_'.$ve_value.'"> <div class="sch-slot" id="'.$date.'">'.$ve_value.'</div></li>';
                            }
                        }
                    }elseif(is_array($value[$day_C]['break_time'])){ 
                        if(in_array($ve_value, $value[$day_C]['break_time'])) {
                            $calendar_html .= '<li class="disabled '.$cls_hi.' "> <div class="sch-slot">Break </div></li>';
                        }else{
                        $calendar_html .='<li class="active '.$cls_hi.' appointDate" id="'.$key.'_'.$day_C.' '.$date.'_'.$ve_value.'"><div class="sch-slot" id="'.$date.'"> '.$ve_value.'</div></li>';
                    }
                    }elseif(array_key_exists('apntdate',$value)){
                        if(in_array($date_C, $value['apntdate'])){
                            if(in_array($ve_value, $value['apnttime'][$date_C])){
                                $calendar_html .='<li class="disabled '.$cls_hi.'"><div class="sch-slot">Booked</div></li>';
                            }else{
                                $calendar_html .= '<li class="active '.$cls_hi.' appointDate" id="'.$key.'_'.$day_C.' '.$date.'_'.$ve_value.'"> <div class="sch-slot" id="'.$date.'">'.$ve_value.'</div></li>';
                            }
                        }else{
                        $calendar_html .='<li class="active '.$cls_hi.' appointDate" id="'.$key.'_'.$day_C.' '.$date.'_'.$ve_value.'"><div class="sch-slot"> '.$ve_value.'</div></li>';
                    }
                    }else{
                        $calendar_html .= '<li class="active '.$cls_hi.' appointDate" id="'.$key.'_'.$day_C.' '.$date.'_'.$ve_value.'"><div class="sch-slot"> '.$ve_value.'</div></li>';
                    }
                }
                $calendar_html .= '</ul></div>';
                //}
            
            }
            //$calendar_html .= '</div>';
    
            }
            return $calendar_html;
    }
     function search_data($data,$scad,$pagination,$status = null,$dateCnt=0,$columns =3){
        
            //default values
            $currDate = date('Y-m-d');
            $days=array('Mon','Tue','Wed','Thu','Fri','Sat','Sun');

            if($status=='next'){
                $date= ($dateCnt==0) ? date('Y-m-d') : date('Y-m-d' , strtotime($dateCnt. ' + '.$columns.' days'));
                $Day = ($dateCnt==0) ? date('D') : date('D',strtotime($dateCnt. ' + '.$columns.' days'));
            }else{
                $date= ($dateCnt==0) ? date('Y-m-d') : date('Y-m-d' , strtotime($dateCnt. ' - '.$columns.' days'));
                $Day = ($dateCnt==0) ? date('D') : date('D',strtotime($dateCnt. ' - '.$columns.' days'));
            }
            $end_date = date('Y-m-d', strtotime($currDate. ' + '.$columns.' days'));
            $query =$data;
            //print_r($data);die;
            //caLendar data begins
            //getting doctor details
            $data1=0;
            foreach ($query as $key => $value) {
                $cal_result=$scad->getUserDetails($value['doctorID']);
                    $apntdetails=$scad->getAppointmentDetailsWithDate($value['doctorID'],$date,$end_date);
              // echo '<pre>';
              // print_r($cal_result);die;
                if ($value['imageName']) {
                    $docImage = $value['imageName'];
                } else {
                    $docImage = 'no_image.jpg';
                }
                $id1[]=$value['doctorID'];
                $userImg = WEB_ROOT . "service/public/z_uploads/doctor/small/" . $docImage;

                 $rat=$scad->getrting($value['doctorID']);
                    $len=count($rat);
                    $rateval=0; 
                    for($j=0;$j<$len;$j++){
                    $rateval=$rateval+($rat[$j]['overall'] +$rat[$j]['beside'] +$rat[$j]['waiting'])/3  ;
                    
                    }
                    $res_data[$value['doctorID']]['rating'] =$rateval;

                    $res_data[$value['doctorID']]['name'] = (!empty($value['firstname']) || !empty($value['lastname'])) ? $value['firstname']."&nbsp".$value['lastname'] : 'Not specified';
                    $res_data[$value['doctorID']]['address'] = (!empty($value['address']) || !empty($value['zipcode'])) ? $value['address'].'<br>'.$value['zipcode'] : 'Not Specified';
                    $res_data[$value['doctorID']]['zip'] =$value['zipcode'];
                    $res_data[$value['doctorID']]['description'] = (! empty($value['description'])) ? $value['description'] : '--';
                    $res_data[$value['doctorID']]['profile_pic'] = $userImg;

                if(! empty($cal_result['working_plan'])){
                    $res_data[$value['doctorID']]['working_plan']=json_decode($cal_result['working_plan'],TRUE);
                    $data1=1;
                }else{
                    $res_data[$value['doctorID']]['working_plan']='none';
                }
                if(! empty($cal_result['breaks'])){
                    $res_data[$value['doctorID']]['breaks']=json_decode($cal_result['breaks'],TRUE);
                }
                if(! empty($cal_result['vecation'])){
                    $res_data[$value['doctorID']]['vecation']=json_decode($cal_result['vecation'],TRUE);
                }
            }
            // echo '<pre>';
            //   print_r($res_data);die;
            foreach ($res_data as $key => $value) {
                if($value['working_plan'] != 'none'){
                    foreach ($days as  $day) {
                        $res_data[$key][$day]['working_time'] = (array_key_exists('working_plan',$value) && $value['working_plan']!='none')  ? get_working_plan($value['working_plan'][$day]) : '';
                        $res_data[$key][$day]['break_time'] = (array_key_exists('breaks',$value)) ? get_break_time($value['breaks'][$day]) : '';
                        $res_data[$key]['vacation_date'] = (array_key_exists('vecation',$value)) ? get_vacation_date($value['vecation']) : '';
                        //echo '<pre>';
                        //print_r($res_data[$key]['vacation_date']);die;
                        $res_data[$key]['vacation_time'] = (array_key_exists('vecation',$value)) ? get_vacation_time($value['vecation']) : '';
                    }
                }
            }
            //echo '<pre>';
              //print_r($res_data);die;
            //make time slot
            $data_res ='';
            $s =WEB_ROOT;
            $data_res .= '<input type="hidden" class="currentDate"  value="'.$date.'">';
            $count=0;
            foreach ($res_data as $key => $value) {
                
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



                //$map_data[] = map_over_data($value,$scad);

            }
            $pagination_data ='<div class="row"><div class="col-md-offset-1 col-md-11">';
                $pagination_data .=$pagination;
                $pagination_data .='</div></div>';
                //$data_res .= "<input type='hidden' value='" . json_encode($map_data) . "' class='allzips'>";
                $data_res .="<input type='hidden' value='".json_encode($id1)."' class='allDoctors' name='allDoctors'>";
            $date_slide= date_slide($columns,$date,0);
            //echo $data_res ;
            $result_data['date_slide'] = $date_slide;
            $result_data['html'] = $data_res;
            $result_data['pagination'] = $pagination_data;
            echo json_encode($result_data);
            //make time slot
            //calendar data begins

        }

    function modal_data($data,$status = null,$dateCnt=0,$columns,$profile,$map){
        $key = $data['id'];

        $query = $data;

        //forming profile data
        $value['name'] = (!empty($query->first_name) || !empty($query->last_name)) ? $query->first_name."&nbsp".$query->last_name : 'Not specified';
        $value['address'] = (!empty($query->address) || !empty($query->state) || !empty($query->city) || !empty($query->zip)) ? $query->address.'<br>'.$query->state.'<br>'.$query->city.'<br>'.$query->zip : 'Not Specified';
        $value['mobile'] = (!empty($query->mobile)) ? $query->mobile : 'Not Specified';
        $value['zip'] = $query->zip;
        //forming profile data

            //forming calendar data

            $currDate = date('Y-m-d');

            //print_r($dateCnt);


            $days=array('Mon','Tue','Wed','Thu','Fri','Sat','Sun');
            if($status=='next'){
                    $date= ($dateCnt==0) ? date('Y-m-d') : date('Y-m-d' , strtotime($dateCnt. ' + '.$columns.' days'));
                    $Day = ($dateCnt==0) ? date('D') : date('D',strtotime($dateCnt. ' + '.$columns.' days'));
                }else{
                    $date= ($dateCnt==0) ? date('Y-m-d') : date('Y-m-d' , strtotime($dateCnt. ' - '.$columns.' days'));
                    $Day = ($dateCnt==0) ? date('D') : date('D',strtotime($dateCnt. ' - '.$columns.' days'));
                }
                $end_date = date('Y-m-d', strtotime($currDate. ' + '.$columns.' days'));

            if(! empty($query->working_plan)){
                    $value['working_plan']=json_decode($query->working_plan,TRUE);
                    $data1=1;
                }else{
                    $value['working_plan']='none';
                }
                if(! empty($query->breaks)){
                    $value['breaks']=json_decode($query->breaks,TRUE);
                }
                if(! empty($result['vecation'])){
                    $value['vecation']=json_decode($query->vecation,TRUE);
                }

                if($value['working_plan'] != 'none'){
                        foreach ($days as  $day) {
                            $value[$day]['working_time'] = (array_key_exists('working_plan',$value) && $value['working_plan']!='none')  ? get_working_plan($value['working_plan'][$day]) : '';
                            $value[$day]['break_time'] = (array_key_exists('breaks',$value)) ? get_break_time($value['breaks'][$day]) : '';
                            $value['vacation_date'] = (array_key_exists('vacation',$value)) ? get_vacation_date($value['vacation']) : '';
                            $value['vacation_time'] = (array_key_exists('vacation',$value)) ? get_vacation_time($value['vacation'],$data[$key]['vacation_date']) : '';
                        }
                    }

                
        //forming calendar data

        $s =base_url();
        $calendar = '<input type="hidden" class="popcurrentDate"  value="'.$date.'">'.calendar_html($value,$columns,$Day,$date,$s,$key);
        if($profile==0){
            $response['profile'] = profile_html($value,$s,$key,1);
        }
        $response['date_slide'] = date_slide($columns,$date,1);
        $response['calendar'] = $calendar;
        if($map==0){
            $map_data[] = map_over_data($value);
            $response['map'] = $map_data;
        }

        echo json_encode($response);
    }



        //functions end



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
        //print_r($searchTerms);die;
        if(! empty($searchTerms)){
            $result  = $scad->searchDoctorLimit($docSpeciality, $docZip, $insuranceSelect, $subInsuranceSelect =null,$srchReason, $language,$gender, $start, $per_page);
            $result1 = $scad->searchDoctor($docSpeciality, $docZip, $insuranceSelect, $subInsuranceSelect,$srchReason,$language, $gender);
        }
        else{
            $result        = $scad->searchDoctorLimit(null, null, null, null,null , null,null, $start, $per_page);
        $result1       = $scad->searchDoctor(null,null,null,null ,null,null,null);
        }
    }
    
    $end  = count($result1);
    $end1 = count($result);

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
    $msg = "<div class='pagination'>";
    
    // FOR ENABLING THE FIRST BUTTON
    if ($first_btn && $cur_page > 1) {
        $msg .= "<a href='javascript:void(0);' p='1' class='page acti'>First</a>";
    } else if ($first_btn) {
        $msg .= "<a href='javascript:void(0);' p='1' class='page1'>First</a>";
    }
    
    // FOR ENABLING THE PREVIOUS BUTTON
    if ($previous_btn && $cur_page > 1) {
        $pre = $cur_page - 1;
        $msg .= "<a href='javascript:void(0);' p='$pre' class='page acti'>Prev</a>";
    } else if ($previous_btn) {
        $msg .= "<a href='javascript:void(0);' class='page1'>Prev</a>";
    }
    for ($i = $start_loop; $i <= $end_loop; $i++) {
        
        if ($cur_page == $i)
            $msg .= "<a href='javascript:void(0);' p='$i'  class='page active acti'>{$i}</a>";
        else
            $msg .= "<a href='javascript:void(0);' p='$i' class='page1 acti'>{$i}</a>";
    }
    
    // TO ENABLE THE NEXT BUTTON
    if ($next_btn && $cur_page < $no_of_paginations) {
        $nex = $cur_page + 1;
        $msg .= "<a href='javascript:void(0);' p='$nex' class='page acti'>Next</a>";
    } else if ($next_btn) {
        $msg .= "<a href='javascript:void(0);' class='page1'>Next</a>";
    }
    
    // TO ENABLE THE END BUTTON
    if ($last_btn && $cur_page < $no_of_paginations) {
        $msg .= "<a  href='javascript:void(0);' p='$no_of_paginations' class='page acti'>Last</a>";
    } else if ($last_btn) {
        $msg .= "<a href='javascript:void(0);' p='$no_of_paginations' class='page1'>Last</a>";
    }

       if($end1>0){
        search_data($result,$scad,$msg); 
       }else{
        //$result_data['date_slide'] = $date_slide;
            $result_data['html'] = '<p><i class="fa fa-exclamation-triangle fa-2x"></i><br />No Results Found<br /><small>There are no search results for the requested search. Perform the search option with different search conditions</small></p>';
            $result_data['status'] = 0;
            echo json_encode($result_data);
       }
   }
?>


