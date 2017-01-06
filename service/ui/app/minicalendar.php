<?php
	include("conf/config.inc.php");
	$currDate = date('Y-m-d');
	$doc[]=json_decode($allDoctors);

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
	$cnt = 0;
	foreach($doc as $key=>$valu){
		foreach($valu as $key=>$value){
			$result=$scad->getUserDetails($value);
			$id[]= $result[id];
			$t=$result[working_plan];
			$b=$result[breaks];
			$v=$result[vecation];
			$docId[]=$result[id];
			$work[]=json_decode($t,TRUE);
			$break[]=json_decode($b,TRUE);
			$vecation[$result[id]]=json_decode($v,TRUE);
			$cnt++;
		}
	}
	foreach($vecation as $key=>$valueve){
		$leng=count($valueve);
		for($jk=0;$jk<$leng;$jk++){
			$vecation_dates[$key][] = get_days($valueve[$jk]['startdate'], $valueve[$jk]['enddate']);
			$ve_time[$key][] = get_times($valueve[$jk]['starttime'], $valueve[$jk]['endtime']);
		}
	}

	$count=0;
	foreach($docId as $value){
		$apntdetails=$scad->getAppointmentDetails($value);
		foreach($apntdetails as $keey=>$valus){
			$apnts[]=array($valus[apnt_date]=>array($valus[doctor_id]=>array(start=>$valus[apnt_starttime],ends=>$valus[apnt_endtime],dates=>$valus[apnt_date])));
			$count++;
		}
	}

	$max=count($apnts);
	for($i=0;$i<$cnt;$i++){
		if(empty($work[$i]) ){
			$Date = date('Y-m-d', strtotime($currDate. ' + 0 days'));
			echo get_error($Date,$work[$i],$break[$i],$id[$i],$apnts,$max);	
		}else{
			if($status == 'first'){
				$Date = date('Y-m-d', strtotime($currDate. ' + 0 days'));
				echo get_week_dates($Date,$work[$i],$break[$i],$id[$i],$apnts,$max,$ve_time[$id[$i]],$vecation_dates[$id[$i]]);
			}else if($status == 'next'){
				$Date = date('Y-m-d', strtotime($dateCnt. ' + 3 days'));
				echo get_week_dates($Date,$work[$i],$break[$i],$id[$i],$apnts,$max,$ve_time[$id[$i]],$vecation_dates[$id[$i]]);
			}else{
				$Date = date('Y-m-d', strtotime($dateCnt. ' - 3 days'));
				echo get_week_dates($Date,$work[$i],$break[$i],$id[$i],$apnts,$max,$ve_time[$id[$i]],$vecation_dates[$id[$i]]);
			}
		}
	}
	function calendarPeriod($firstTime,$lastTime,$breakTime,$res,$i,$apns,$max,$dateInc,$ve_time,$vecation_dates)
	{

		$ve_date_len=count($vecation_dates);	
		$time=$firstTime."-".$lastTime;
		$breakmax=count($breakTime[$res]);
		$breakMax=count($breakTime[$res],1);
		if($breakMax > 2){
			for($j=0;$j<$breakmax;$j++){
				$break_start = strtotime($breakTime[$res][$j]['start']);
				$break_end = strtotime($breakTime[$res][$j]['ends']);
				$break_time=$break_start."-".$break_end;
				while($break_time<$break_end){
					$brTime[] = date('H:i A', $break_time);
					$break_time = strtotime('+15 minutes', $break_time);
				}
			}
		}
		else{
			$break_start = strtotime($breakTime[$res]['start']);
			$break_end = strtotime($breakTime[$res]['ends']);
			$break_time=$break_start."-".$break_end;
			while($break_time<$break_end){
				$brTime[] = date('H:i A', $break_time);
				$break_time = strtotime('+15 minutes', $break_time);
			}
		}

		for($j=0;$j<$max;$j++){
			$apnt_start = strtotime($apns[$j][$dateInc][$i]['start']);
			$apnt_end = strtotime($apns[$j][$dateInc][$i]['ends']);
			$apnt_time=$apnt_start."-".$apnt_end;
			while($apnt_time<$apnt_end){
				$apntTime[] = date('H:i A', $apnt_time);
				$apnt_time = strtotime('+15 minutes', $apnt_time);
			}
		}
		$html = '';
		while($time < $lastTime){
			$Times[] = date('H:i A', $time);
			$time = strtotime('+15 minutes', $time);
		}
		$k=0;		
		if($ve_date_len > 0){
			for($vei=0;$vei<$ve_date_len;$vei++){
				if(in_array($dateInc,$vecation_dates[$vei])){
					foreach($Times as $key=>$value)
					{
						if(in_array($value,$ve_time[$vei])){
							$tmpAry[$key]="Vacation";
						}
					}
				}
				else{
					foreach($Times as $key=>$value){
						if(in_array($value,$brTime)){
							$tmpAry[$key]="Break";
						}elseif(in_array($value,$apntTime) ){
							$tmpAry[$key]="Booked";
						}
					}
				}
			}
		}
		else{
			foreach($Times as $key=>$value){
				if(in_array($value,$brTime)){
					$tmpAry[$key]="Break";
				}elseif(in_array($value,$apntTime) ){
					$tmpAry[$key]="Booked";
				}
			}
		}
		if(!empty($tmpAry)){
			$basket = array_replace($Times, $tmpAry);
		}
		else{
			$basket=$Times;
		}
		//}
		$k=0;
		foreach($basket as $key=>$value){
			//echo $value;
			$k++;
			if($k == 6){
				$finalBorder = 'bottomBorder';
			}
			elseif($k<6){
				$finalBorder = 'test1';
			}
			else{
				$finalBorder = 'test2';
			}
			if($k==6){
				$html .='<li  value="'.$i.'" class="'.$finalBorder.'  moreClk'.$i.'  appointDate1">More</li>';
			}else{
				if($value==end($Times)){
				$html .='<li value="'.$i.'" class="'.$finalBorder.' more'.$i.' last show'.$i.' appointDate1">Less</li>';
			}else{
				if($k>6){
				if($value=="Break" || $value=="Booked" || $value=="Vacation"){
				$html .='<li class="'.$finalBorder.' show'.$i.'">'.$value.'</li>';					
			}
			else{
				$html .='<li class="'.$finalBorder.' show'.$i.' appointDate" id="'.$i.'_'.$res.' '.$dateInc.'_'.$value.'">'.$value.'</li>';
			}				
			}else{
				if($value=="Break" || $value=="Booked" || $value=="Vacation"){
				$html .='<li class="'.$finalBorder.' '.$i.'">'.$value.'</li>';					
			}
			else{
				$html .='<li class="'.$finalBorder.' '.$i.' appointDate" id="'.$i.'_'.$res.' '.$dateInc.'_'.$value.'">'.$value.'</li>';
			}
			}
			}
			}

		}
		return $html;
	}
	function get_error($Date,$work,$break,$id,$apns,$max)
	{


		$data .= '<div class="none" align="center" >';
		$data .="No availability these days.";
		$data .= '</div>';
		return $data;
	}

	function get_week_dates($Date,$work,$break,$id,$apns,$max,$ve_time,$vecation_dates)
	{
		$start = strtotime($Date);
		$data = '';
		$data .='<div class="common'.$id.'" style="min-height:209px; clear:both;">';
		for( $i = 0; $i < 3; $i++ )
		{
			$res = date( 'D' , ( $start + ( $i * ( 60 * 60 * 24 ) ) ) );
			$breakTime = $break;
			$breakMax = count($breakTime,1);
			$startTime = $work[$res][start];
			$endTime = $work[$res][ends];
			$res = date( 'D' , ( $start + ( $i * ( 60 * 60 * 24 ) ) ) );
			$dateInc = date( 'Y-m-d' , ( $start + ( $i * ( 60 * 60 * 24 ) ) ) );
			$data .= '<div class="calender_custom1">';
			$data .= '<div class="calender_custom1cl">';
			$data .= '<input type="hidden" class="cldr_cstm_hdtxt2 firstDate_'.$i.'" value="'.$res." ".date("d-m-Y", strtotime($dateInc)).'">';
			$data .= '<ul class="cellColor'.$id.' hri'.$i.$id.'">';
			$data .= calendarPeriod(strtotime($dateInc." ".$startTime),strtotime($dateInc." ".$endTime),$breakTime,$res,$id,$apns,$max,$dateInc,$ve_time,$vecation_dates);
			$data .= '</ul>';
			$data .= '</div>';
			$data .= '</div>';
		}
		$data .='</div>';
		return $data;
	}
?>