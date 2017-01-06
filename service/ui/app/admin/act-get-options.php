<?php
include("./conf/config.inc.php");
$optionData = $_GET;
//print_r($optionData);



if($optionData['value']!=0 ){
	$result=$scad->get_td_field_data($optionData['tb'],$optionData['value'],$optionData['f_name']);
//echo $result[$optionData['f_name']];
	$selected='selected="selected"';
	$data="<label>".strtoupper(str_replace("_"," ",$optionData['name']))."</label><select class='form-control ' name=".$optionData['name'].">";
	$data .="<option ".$selected." value=".$optionData['value'].">".$result[$optionData['f_name']]."</option>";
	$data .="</select>";

	echo $data;
}else{
	if($optionData['name']=='doctor_id' ){
	$where='usertype="1"';
	$result=$scad->getAllTableData1($optionData['tb'],$where);
}
else if($optionData['name']=='userid' || $optionData['name']=='user_id'){
	$where='usertype="2"';
	$result=$scad->getAllTableData1($optionData['tb'],$where);
}else{
	$result=$scad->getAllData($optionData['tb']);	
}
$data="<label>".strtoupper(str_replace("_"," ",$optionData['name']))."</label><select class='form-control select4' name=".$optionData['name'].">
<option value=''>select one</option>";
foreach ($result as $key => $value) {
	if($optionData['value']==$value['id']){$selected='selected="selected"';}else{$selected='';}
	if($optionData['name']=='doctor_id' || $optionData['name']=='userid' || $optionData['name']=='user_id'){
		$data .="<option ".$selected." value=".$value['id'].">".$value['firstname']."</option>";
	}
	else{
	$data .="<option ".$selected." value=".$value['id'].">".$value['name']."</option>";
}
}
$data .="</select>";
echo $data;
}
?>