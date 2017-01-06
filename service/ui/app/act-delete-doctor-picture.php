<?php
include("./conf/config.inc.php");
$patientData = $_POST;
print_r($patientData);
 if(!empty($patientData)){
		echo $Data= $patientData['formData'];
		$condition="id=".$Data;
	echo	$userID =  $scad->delete('userimages',$condition);exit;
//		ech$userID;
} else{
echo $errorflag = 0;
}
?>