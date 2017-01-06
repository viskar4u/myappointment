<?php

session_start();
include("service/ui/common/header.php"); 
//$_SESSION['userID'];
?>
<?php
//print_r($payment);die();
include("././conf/config.inc.php");
$item_number = $payment['item_number']; 
$txn_id = $payment['tx'];
$payment_gross = $payment['amt'];
$currency_code = $payment['cc'];
$payment_status = $payment['st'];


$productResult = $scad->getAllTableData1('packages','id="'.$item_number.'"');
$productPrice = $productResult[0]['price'];
$user_id=$_COOKIE['check_pending_user'];
$date = date('Y-m-d H:i:s');
$expiry_date = date("Y-m-d H:i:s", strtotime("+".$productResult[0]['duration'], strtotime($date)));

if(!empty($txn_id) && $payment_gross == $productPrice){

	$productResult = $scad->getAllTableData1('package_payments','user_id="'.$_COOKIE['check_pending_user'].'"');
	$user_exist = count($productResult);
	if($user_exist>0){

		$data = array('package_id'=>$item_number,'user_id'=>$_COOKIE['check_pending_user'],'txn_id'=>$txn_id,'amount'=>$payment_gross,'currency_code'=>'USD','payment_status'=>$payment_status,'last_payment_date'=>$date,'expiry_date'=>$expiry_date);
    	$last_insert_id = $scad->update_re('package_payments',$data,'user_id="'.$_COOKIE['check_pending_user'].'"');

	}else{

    	$data = array('package_id'=>$item_number,'user_id'=>$_COOKIE['check_pending_user'],'txn_id'=>$txn_id,'amount'=>$payment_gross,'currency_code'=>'USD','payment_status'=>$payment_status,'last_payment_date'=>$date,'expiry_date'=>$expiry_date);
    	$last_insert_id = $scad->insert('package_payments',$data);

    }
    //echo $last_insert_id;
    if($last_insert_id!=0){
    	setcookie("check_pending_user", "", time()-3600);
    	$user_result = $scad->getAllTableData1('packages','id="'.$user_id.'"');
    	//print_r($user_result[0]);
    	$_SESSION['userID'] = $user_result[0]['id'];	
		$_SESSION['userType'] = $user_result[0]['usertype'];
		$_SESSION['gender']=$user_result[0]['gender'];
		$_SESSION['name']=$user_result[0]['firstname']." ".$user_result[0]['lastname'];
    }
?>
	<div class="container section_wrapper">
		<div class="payment_success" >
			<h1>Your payment has been successful.</h1>
    		<h3>Your Payment ID - <?php echo $txn_id; ?>.</h3>
    		<p>You will be redirect to profile page in 10 seconds or <a href="<?php echo WEB_ROOT;?>index.php/doctor/profile">click here</a></p>
    	</div>
    </div>
<?php
}else{
?>
	<div class="container section_wrapper">
		<div class="payment_success" >
			<h1 style="color:red;">Your payment has failed.</h1>
		</div>
	</div>
<?php
}
?>
<?php 
	  include("service/ui/common/footer.php"); 
	  ?>
<script>
$(document).ready(function(){
	setTimeout(function(){window.location.href= '<?php echo WEB_ROOT;?>index.php/doctor/profile'},10000);
});
</script>