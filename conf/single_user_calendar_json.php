<?php
include("config.inc.php");


Function GetDays($sStartDate, $sEndDate){  
  $sStartDate = gmdate("Y-m-d", strtotime($sStartDate));  
  $sEndDate = gmdate("Y-m-d", strtotime($sEndDate));  
  $aDays[] = $sStartDate;  
  $sCurrentDate = $sStartDate;  
  while($sCurrentDate < $sEndDate){  
    $sCurrentDate = gmdate("Y-m-d", strtotime("+1 day", strtotime($sCurrentDate)));  
    $aDays[] = $sCurrentDate;  
  }  
  return $aDays;  
}  

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
function get_times($starttime,$endtime){
	$begin = new DateTime(date("H:i", strtotime($starttime)));
	$end = new DateTime(date("H:i", strtotime($endtime)));

	$timerange = new DatePeriod($begin, new DateInterval('PT900S'), $end);

	foreach($timerange as $time){
		$atimes[] =$time->format("H:ia");
	}
	$atimes[] =date("H:ia", strtotime($enddate)) ;
	return $atimes;  
}
function init($doc,$currDate,$status){
	$scad = new mysqldb();
	$currDay =date('D',strtotime($currDate));
	$currTime = date('h:ia',strtotime($currDate));
	$currDate = date('Y-m-d',strtotime($currDate));
	$result=$scad->getUserDetails($doc);
	$id[]= $result[id];
	$t=$result[working_plan];

	$b=$result[breaks];
	$v=$result[vecation];
	$docId[]=$result[id];
	$work[]=json_decode($t,TRUE);
	$break[]=json_decode($b,TRUE);
	$vecation[]=json_decode($v,TRUE);
	$count=0;
	foreach($docId as $value){
		$apntdetails=$scad->getAppointmentDetails($value);
		foreach($apntdetails as $keey=>$valus){
			$apnts[]=array($valus[apnt_date]=>array($valus[doctor_id]=>array(start=>$valus[apnt_starttime],ends=>$valus[apnt_endtime],dates=>$valus[apnt_date])));
			$count++;
		}
	}
	foreach($vecation as $key=>$valueve){
		$leng=count($valueve);
		for($jk=0;$jk<$leng;$jk++){
			$vecation_dates[] = get_days($valueve[$jk]['startdate'], $valueve[$jk]['enddate']);
			$ve_time[] = get_times($valueve[$jk]['starttime'], $valueve[$jk]['endtime']);
		}
	}
	
	$max=count($apnts);
	for($i=0;$i<1;$i++){
		if(empty($work[$i])){
			$Date = date('Y-m-d', strtotime($currDate. ' + 0 days'));
			return get_error($Date,$work[$i],$break[$i],$id[$i],$apnts,$max);	
		}else{
			if($status == 'first'){
				$Date = date('Y-m-d', strtotime($currDate. ' + 0 days'));
				return get_week_dates($Date,$work[$i],$break[$i],$id[$i],$apnts,$max,$ve_time,$vecation_dates,$currTime);
			}else if($status == 'next'){
				$Date = date('Y-m-d', strtotime($currDate));
				return get_week_dates($Date,$work[$i],$break[$i],$id[$i],$apnts,$max,$ve_time,$vecation_dates,$currTime);
			}else{
				$Date = date('Y-m-d', strtotime($currDate));
				return get_week_dates($Date,$work[$i],$break[$i],$id[$i],$apnts,$max,$ve_time,$vecation_dates,$currTime);
			}
		}
	}
}
	function calendarPeriod($firstTime,$lastTime,$breakTime,$res,$i,$apns,$max,$dateInc,$ve_time,$vecation_dates,$currTime)
{
$time=$firstTime."-".$lastTime;
$ve_date_len=count($vecation_dates);
$breakmax=count($breakTime[$res]);
$breakMax=count($breakTime[$res],1);
if($breakMax > 2){
		for($j=0;$j<$breakmax;$j++){
		 $break_start = strtotime($breakTime[$res][$j]['start']);
		 $break_end = strtotime($breakTime[$res][$j]['ends']);
		 $break_time=$break_start."-".$break_end;
		 while($break_time<$break_end){
				 $brTime[] = date('h:ia', $break_time);
				$break_time = strtotime('+15 minutes', $break_time);
			}
		}
}
else{
	 $break_start = strtotime($breakTime[$res]['start']);
	 $break_end = strtotime($breakTime[$res]['ends']);
		 $break_time=$break_start."-".$break_end;
		 while($break_time<$break_end){
				 $brTime[] = date('h:ia', $break_time);
				$break_time = strtotime('+15 minutes', $break_time);
			}
}
for($j=0;$j<$max;$j++){
		   $apnt_start = strtotime($apns[$j][$dateInc][$i]['start']);
		   $apnt_end = strtotime($apns[$j][$dateInc][$i]['ends']);
		 $apnt_time=$apnt_start."-".$apnt_end;
		 while($apnt_time<$apnt_end){
				 $apntTime[] = date('h:ia', $apnt_time);
				$apnt_time = strtotime('+15 minutes', $apnt_time);
			}
		}
	$html = '';
	while($time < $lastTime){
				 $Times[] = date('h:ia', $time);
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
			$k=0;
			$key = array_search($currTime, $Times);
			if(!empty($key)){
				for($i=$key;$i<$key+5;$i++){
					$selected[]=$basket[$i];
				}
			}else{
				$selected[]='Not available over this time on Today';
			}
	return $selected;
}
function get_error($Date,$work,$break,$id,$apns,$max)
{
	
			$data .="No availability these days.";
	return $data;
}
function get_week_dates($Date,$work,$break,$id,$apns,$max,$ve_time,$vecation_dates,$currTime)
{
	$start = strtotime($Date);
	$data = '';
	
		for( $i = 0; $i < 1; $i++ )
	{
	$res = date( 'D' ,  $start );
		 $breakTime = $break;
		 $breakMax = count($breakTime,1);
		 $startTime = $work[$res][start];
		$endTime = $work[$res][ends];
		$res = date( 'D' , ( $start + ( $i * ( 60 * 60 * 24 ) ) ) );
		$dateInc = date( 'Y-m-d' , ( $start + ( $i * ( 60 * 60 * 24 ) ) ) );
		$data= calendarPeriod(strtotime($dateInc." ".$startTime),strtotime($dateInc." ".$endTime),$breakTime,$res,$id,$apns,$max,$dateInc,$ve_time,$vecation_dates,$currTime);
}
	return $data;
}
?>