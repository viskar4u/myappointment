<?php
include("./conf/config.inc.php");
$patientData = $_POST;
//print_r($patientData);
if(!empty($patientData)){
	$result = $scad->userDeatails($patientData['email'],$patientData['password']);
	//print_r($result);exit;
	if(!empty($result)){
	if($result['status']==0){
		echo 3;
		}
	else{
		if($result['usertype']==1){
			$payment = $scad->getAllTableData1('package_payments','user_id="'.$result['id'].'"');
			$date = strtotime(date('Y-m-d'));
			$expire_date = strtotime($payment[0]['expiry_date']);
			$status = ($date > $expire_date)? 'expired' : 'not expired';
			if(count($payment)==0 || $date > $expire_date){
				$cookie_name = "check_pending_user";
				$cookie_value = $result['id'];
				setcookie($cookie_name, $cookie_value);
				echo 4;exit;
			}
		}
		$_SESSION['userID'] = $result['id'];	
		$_SESSION['userType'] = $result['usertype'];
		$_SESSION['gender']=$result['gender'];
		$_SESSION['name']=$result['firstname']." ".$result['lastname'];
		echo $redirectlag =$result['dob'].",".$result['gender'].",".$result['id'].",".$result['usertype'];
	    }
	}else{
		echo $redirectlag = '0';
	
	}
}
?>