<?php
include("./conf/config.inc.php");
$Data = $_POST;
?>
<div class="row"><div class="col-md-12"><h2 align="left">Primary Health Insurance</h2></div></div>
<table class="table  table-striped   col-md-12 col-sm-12 col-xs-12" >

<tr>
<th colspan="3">Primary Health Insurance Details</th>
</tr>

<tr>
<td style="color:#000;">Insurance Company</td>
<td style="color:#666;" class="name"><?php  if(empty($Data[Company_name])){echo "No response";}else{echo $Data[Company_name];}?></td>
<td class="editthis" style="cursor:pointer">Edit</td>
</tr>
<tr style="display:none" class="datas">
<td colspan="3">
	<div class="col-md-4 col-sm-4 col-xs-12">
		<input type="text" name="Company_name" maxlength="30" placeholder="Insurence Company" value="<?php echo $Data[Company_name]; ?>"/>
	</div>
	<div class="col-md-4 col-sm-4 col-xs-12">
		<input type="button" value="submit" class="save2 submit_button " />
	</div>
	<div class="col-md-4 col-sm-4 col-xs-12">
		<input type="button" value="cancel" class="cancel cancel_button " />
	</div>
</td>
</tr>

<tr>
<td style="color:#000;">Plan</td>
<td style="color:#666;" class="name"><?php  if(empty($Data[plan])){echo "No response";}else{echo $Data[plan];}?></td>
<td class="editthis" style="cursor:pointer">Edit</td>
</tr>
<tr style="display:none" class="datas">
<td colspan="3">
	<div class="col-md-4 col-sm-4 col-xs-12">
		<input type="text" name="plan" maxlength="30"placeholder="Plan" value="<?php echo $Data[plan]; ?>">
	</div>
	<div class="col-md-4 col-sm-4 col-xs-12">
		<input type="button" value="submit" class="save2 submit_button " />
	</div>
	<div class="col-md-4 col-sm-4 col-xs-12">
		<input type="button" value="cancel" class="cancel cancel_button " />
	</div>
</td>
</tr>

<tr>
<td style="color:#000;">Plan Number</td>
<td style="color:#666;" class="name"><?php  if(empty($Data[plan_num])){echo "No response";}else{echo $Data[plan_num];}?></td>
<td class="editthis" style="cursor:pointer">Edit</td>
</tr>
<tr style="display:none" class="datas">
<td colspan="3">
	<div class="col-md-4 col-sm-4 col-xs-12">
		<input type="text" name="plan_num" maxlength="30" placeholder="Plan Number" value="<?php echo $Data[plan_num]; ?>"/>
	</div>
	<div class="col-md-4 col-sm-4 col-xs-12">
		<input type="button" value="submit" class="save2 submit_button " />
	</div>
	<div class="col-md-4 col-sm-4 col-xs-12">
		<input type="button" value="cancel" class="cancel cancel_button " />
	</div>
</td>
</tr>

<tr>
<td style="color:#000;">Group Number</td>
<td style="color:#666;" class="name"><?php  if(empty($Data[GROUP_NUM])){echo "No response";}else{echo $Data[GROUP_NUM];}?></td>
<td class="editthis" style="cursor:pointer">Edit</td>
</tr>
<tr style="display:none" class="datas">
<td colspan="3">
	<div class="col-md-4 col-sm-4 col-xs-12">
		<input type="text" name="GROUP_NUM" maxlength="30" placeholder="Group Number" value="<?php echo $Data[GROUP_NUM]; ?>"/>
	</div>
	<div class="col-md-4 col-sm-4 col-xs-12">
		<input type="button" value="submit" class="save2 submit_button " />
	</div>
	<div class="col-md-4 col-sm-4 col-xs-12">
		<input type="button" value="cancel" class="cancel cancel_button " />
	</div>
</td>
</tr>

<tr>
<td style="color:#000;">Insured's Name</td>
<td style="color:#666;" class="name"><?php  if(empty($Data[employer])){echo "No response";}else{echo $Data[employer];}?></td>
<td class="editthis" style="cursor:pointer">Edit</td>
</tr>
<tr style="display:none" class="datas">
<td colspan="3">
	<div class="col-md-4 col-sm-4 col-xs-12">
		<input type="text" name="employer" maxlength="30" placeholder="Insured's Name" value="<?php echo $Data[employer]; ?>"/>
	</div>
	<div class="col-md-4 col-sm-4 col-xs-12">
		<input type="button" value="submit" class="save2 submit_button " />
	</div>
	<div class="col-md-4 col-sm-4 col-xs-12">
		<input type="button" value="cancel" class="cancel cancel_button " />
	</div>
</td>
</tr>

<tr>
<td style="color:#000;">Insured's Phone Number</td>
<td style="color:#666;" class="name"><?php  if(empty($Data[insurednum])){echo "No response";}else{echo $Data[insurednum];}?></td>
<td class="editthis" style="cursor:pointer">Edit</td>
</tr>
<tr style="display:none" class="datas">
<td colspan="3">
	<div class="col-md-4 col-sm-4 col-xs-12">
		<input type="text" name="insurednum" maxlength="30" placeholder="Insured's Phone Number" value="<?php echo $Data[insurednum]; ?>"/>
	</div>
	<div class="col-md-4 col-sm-4 col-xs-12">
		<input type="button" value="submit" class="save2 submit_button " />
	</div>
	<div class="col-md-4 col-sm-4 col-xs-12">
		<input type="button" value="cancel" class="cancel cancel_button " />
	</div>
</td>
</tr>

<tr>
<td style="color:#000;">Insured's Birth Date</td>
<td style="color:#666;" class="name"><?php  if(empty($Data[insureddob])){echo "No response";}else{echo $Data[insureddob];}?></td>
<td class="editthis" style="cursor:pointer">Edit</td>
</tr>
<tr style="display:none" class="datas">
<td colspan="3">
	<div class="col-md-4 col-sm-4 col-xs-12">
		<input type="text" name="insureddob" maxlength="30" placeholder="Insured's Birth Date" value="<?php echo $Data[insureddob]; ?>"/>
	</div>
	<div class="col-md-4 col-sm-4 col-xs-12">
		<input type="button" value="submit" class="save2 submit_button " />
	</div>
	<div class="col-md-4 col-sm-4 col-xs-12">
		<input type="button" value="cancel" class="cancel cancel_button " />
	</div>
</td>
</tr>

<tr>
<td style="color:#000;">Social Security Number</td>
<td style="color:#666;" class="name"><?php  if(empty($Data[bsec])){echo "No response";}else{echo $Data[bsec];}?></td>
<td class="editthis" style="cursor:pointer">Edit</td>
</tr>
<tr style="display:none" class="datas">
<td colspan="3">
	<div class="col-md-4 col-sm-4 col-xs-12">
		<input type="text" name="bsec" maxlength="30" placeholder="Social Security Number" value="<?php echo $Data[bsec]; ?>"/>
	</div>
	<div class="col-md-4 col-sm-4 col-xs-12">
		<input type="button" value="submit" class="save2 submit_button " />
	</div>
	<div class="col-md-4 col-sm-4 col-xs-12">
		<input type="button" value="cancel" class="cancel cancel_button " />
	</div>
</td>
</tr>

<tr>
<td style="color:#000;">City</td>
<td style="color:#666;" class="name"><?php  if(empty($Data[bCity])){echo "No response";}else{echo $Data[bCity];}?></td>
<td class="editthis" style="cursor:pointer">Edit</td>
</tr>
<tr style="display:none" class="datas">
<td colspan="3">
	<div class="col-md-4 col-sm-4 col-xs-12">
		<input type="text" name="bCity" maxlength="30" placeholder="City" value="<?php echo $Data[bCity]; ?>" />
	</div>
	<div class="col-md-4 col-sm-4 col-xs-12">
		<input type="button" value="submit" class="save2 submit_button " />
	</div>
	<div class="col-md-4 col-sm-4 col-xs-12">
		<input type="button" value="cancel" class="cancel cancel_button " />
	</div>
</td>
</tr>

<tr>
<td style="color:#000;">Pincode</td>
<td style="color:#666;" class="name"><?php  if(empty($Data[bPin])){echo "No response";}else{echo $Data[bPin];}?></td>
<td class="editthis" style="cursor:pointer">Edit</td>
</tr>
<tr style="display:none" class="datas">
<td colspan="3">
	<div class="col-md-4 col-sm-4 col-xs-12">
		<input type="text" name="bPin" maxlength="30" placeholder="Pincode" value="<?php echo $Data[bPin]; ?>"/>
	</div>
	<div class="col-md-4 col-sm-4 col-xs-12">
		<input type="button" value="submit" class="save2 submit_button " />
	</div>
	<div class="col-md-4 col-sm-4 col-xs-12">
		<input type="button" value="cancel" class="cancel cancel_button " />
	</div>
</td>
</tr>

<tr>
<td style="color:#000;">Why you are book this appointment?</td>
<td style="color:#666;" class="name"><?php  if(empty($Data[bstate])){echo "No response";}else{echo $Data[bstate];}?></td>
<td class="editthis" style="cursor:pointer">Edit</td>
</tr>
<tr style="display:none" class="datas">
<td colspan="3">
	<div class="col-md-4 col-sm-4 col-xs-12">
		<input type="text" name="bstate" maxlength="30" placeholder="State" value="<?php echo $Data[bstate]; ?>" />
	</div>
	<div class="col-md-4 col-sm-4 col-xs-12">
		<input type="button" value="submit" class="save2 submit_button " />
	</div>
	<div class="col-md-4 col-sm-4 col-xs-12">
		<input type="button" value="cancel" class="cancel cancel_button " />
	</div>
</td>
</tr>

<tr>
<td style="color:#000;">Insured Address</td>
<td style="color:#666;" class="name"><?php  if(empty($Data[iAddress])){echo "No response";}else{echo $Data[iAddress];}?></td>
<td class="editthis" style="cursor:pointer">Edit</td>
</tr>
<tr style="display:none" class="datas">
<td colspan="3">
	<div class="col-md-4 col-sm-4 col-xs-12">
		<textarea name="iAddress" rows="4" cols="30" placeholder="Insured Address"><?php echo $Data[bstate]; ?></textarea>
	</div>
	<div class="col-md-4 col-sm-4 col-xs-12">
		<input type="button" value="submit" class="save2 submit_button " />
	</div>
	<div class="col-md-4 col-sm-4 col-xs-12">
		<input type="button" value="cancel" class="cancel cancel_button " />
	</div>
</td>
</tr>

</table>

<h1>Basic Info</h1>
<table class="table  table-striped  " >

<tr>
<th colspan="3">Secondary Health Insurance Details</th>
</tr>

<tr>
<td style="color:#000;">Insurence Company</td>
<td style="color:#666;" class="name"><?php  if(empty($Data[sCompany_name])){echo "No response";}else{echo $Data[sCompany_name];}?></td>
<td class="editthis" style="cursor:pointer">Edit</td>
</tr>
<tr style="display:none" class="datas">
<td colspan="3">
	<div class="col-md-4 col-sm-4 col-xs-12">
		<input type="text" name="sCompany_name" maxlength="30" placeholder="Insurence Company" value="<?php echo $Data[sCompany_name]; ?>"/>
	</div>
	<div class="col-md-4 col-sm-4 col-xs-12">
		<input type="button" value="submit" class="save2 submit_button " />
	</div>
	<div class="col-md-4 col-sm-4 col-xs-12">
		<input type="button" value="cancel" class="cancel cancel_button " />
	</div>
</td>
</tr>

<tr>
<td style="color:#000;">Plan</td>
<td style="color:#666;" class="name"><?php  if(empty($Data[splan])){echo "No response";}else{echo $Data[splan];}?></td>
<td class="editthis" style="cursor:pointer">Edit</td>
</tr>
<tr style="display:none" class="datas">
<td colspan="3">
	<div class="col-md-4 col-sm-4 col-xs-12">
		<input type="text" name="splan" maxlength="30"placeholder="Plan" value="<?php echo $Data[plan]; ?>">
	</div>
	<div class="col-md-4 col-sm-4 col-xs-12">
		<input type="button" value="submit" class="save2 submit_button " />
	</div>
	<div class="col-md-4 col-sm-4 col-xs-12">
		<input type="button" value="cancel" class="cancel cancel_button " />
	</div>
</td>
</tr>

<tr>
<td style="color:#000;">Plan Number</td>
<td style="color:#666;" class="name"><?php  if(empty($Data[splan_num])){echo "No response";}else{echo $Data[splan_num];}?></td>
<td class="editthis" style="cursor:pointer">Edit</td>
</tr>
<tr style="display:none" class="datas">
<td colspan="3">
	<div class="col-md-4 col-sm-4 col-xs-12">
		<input type="text" name="splan_num" maxlength="30" placeholder="Plan Number" value="<?php echo $Data[splan_num]; ?>"/>
	</div>
	<div class="col-md-4 col-sm-4 col-xs-12">
		<input type="button" value="submit" class="save2 submit_button " />
	</div>
	<div class="col-md-4 col-sm-4 col-xs-12">
		<input type="button" value="cancel" class="cancel cancel_button " />
	</div>
</td>
</tr>

<tr>
<td style="color:#000;">Group Number</td>
<td style="color:#666;" class="name"><?php  if(empty($Data[sGROUP_NUM])){echo "No response";}else{echo $Data[sGROUP_NUM];}?></td>
<td class="editthis" style="cursor:pointer">Edit</td>
</tr>
<tr style="display:none" class="datas">
<td colspan="3">
	<div class="col-md-4 col-sm-4 col-xs-12">
		<input type="text" name="sGROUP_NUM" maxlength="30" placeholder="Group Number" value="<?php echo $Data[sGROUP_NUM]; ?>"/>
	</div>
	<div class="col-md-4 col-sm-4 col-xs-12">
		<input type="button" value="submit" class="save2 submit_button " />
	</div>
	<div class="col-md-4 col-sm-4 col-xs-12">
		<input type="button" value="cancel" class="cancel cancel_button " />
	</div>
</td>
</tr>

<tr>
<td style="color:#000;">Insured's Name</td>
<td style="color:#666;" class="name"><?php  if(empty($Data[semployer])){echo "No response";}else{echo $Data[semployer];}?></td>
<td class="editthis" style="cursor:pointer">Edit</td>
</tr>
<tr style="display:none" class="datas">
<td colspan="3">
	<div class="col-md-4 col-sm-4 col-xs-12">
		<input type="text" name="semployer" maxlength="30" placeholder="Insured's Name" value="<?php echo $Data[semployer]; ?>"/>
	</div>
	<div class="col-md-4 col-sm-4 col-xs-12">
		<input type="button" value="submit" class="save2 submit_button " />
	</div>
	<div class="col-md-4 col-sm-4 col-xs-12">
		<input type="button" value="cancel" class="cancel cancel_button " />
	</div>
</td>
</tr>

<tr>
<td style="color:#000;">Insured's Phone Number</td>
<td style="color:#666;" class="name"><?php  if(empty($Data[sinsurednum])){echo "No response";}else{echo $Data[sinsurednum];}?></td>
<td class="editthis" style="cursor:pointer">Edit</td>
</tr>
<tr style="display:none" class="datas">
<td colspan="3">
	<div class="col-md-4 col-sm-4 col-xs-12">
		<input type="text" name="sinsurednum" maxlength="30" placeholder="Insured's Phone Number" value="<?php echo $Data[sinsurednum]; ?>"/>
	</div>
	<div class="col-md-4 col-sm-4 col-xs-12">
		<input type="button" value="submit" class="save2 submit_button " />
	</div>
	<div class="col-md-4 col-sm-4 col-xs-12">
		<input type="button" value="cancel" class="cancel cancel_button " />
	</div>
</td>
</tr>

<tr>
<td style="color:#000;">Insured's Birth Date</td>
<td style="color:#666;" class="name"><?php  if(empty($Data[sinsureddob])){echo "No response";}else{echo $Data[sinsureddob];}?></td>
<td class="editthis" style="cursor:pointer">Edit</td>
</tr>
<tr style="display:none" class="datas">
<td colspan="3">
	<div class="col-md-4 col-sm-4 col-xs-12">
		<input type="text" name="sinsureddob" maxlength="30" placeholder="Insured's Birth Date" value="<?php echo $Data[sinsureddob]; ?>"/>
	</div>
	<div class="col-md-4 col-sm-4 col-xs-12">
		<input type="button" value="submit" class="save2 submit_button " />
	</div>
	<div class="col-md-4 col-sm-4 col-xs-12">
		<input type="button" value="cancel" class="cancel cancel_button " />
	</div>
</td>
</tr>

<tr>
<td style="color:#000;">Social Security Number</td>
<td style="color:#666;" class="name"><?php  if(empty($Data[sbsec])){echo "No response";}else{echo $Data[sbsec];}?></td>
<td class="editthis" style="cursor:pointer">Edit</td>
</tr>
<tr style="display:none" class="datas">
<td colspan="3">
	<div class="col-md-4 col-sm-4 col-xs-12">
		<input type="text" name="sbsec" maxlength="30" placeholder="Social Security Number" value="<?php echo $Data[sbsec]; ?>"/>
	</div>
	<div class="col-md-4 col-sm-4 col-xs-12">
		<input type="button" value="submit" class="save2 submit_button " />
	</div>
	<div class="col-md-4 col-sm-4 col-xs-12">
		<input type="button" value="cancel" class="cancel cancel_button " />
	</div>
</td>
</tr>

<tr>
<td style="color:#000;">City</td>
<td style="color:#666;" class="name"><?php  if(empty($Data[sbCity])){echo "No response";}else{echo $Data[sbCity];}?></td>
<td class="editthis" style="cursor:pointer">Edit</td>
</tr>
<tr style="display:none" class="datas">
<td colspan="3">
	<div class="col-md-4 col-sm-4 col-xs-12">
		<input type="text" name="sbCity" maxlength="30" placeholder="City" value="<?php echo $Data[sbCity]; ?>" />
	</div>
	<div class="col-md-4 col-sm-4 col-xs-12">
		<input type="button" value="submit" class="save2 submit_button " />
	</div>
	<div class="col-md-4 col-sm-4 col-xs-12">
		<input type="button" value="cancel" class="cancel cancel_button " />
	</div>
</td>
</tr>

<tr>
<td style="color:#000;">Pincode</td>
<td style="color:#666;" class="name"><?php  if(empty($Data[sbPin])){echo "No response";}else{echo $Data[sbPin];}?></td>
<td class="editthis" style="cursor:pointer">Edit</td>
</tr>
<tr style="display:none" class="datas">
<td colspan="3">
	<div class="col-md-4 col-sm-4 col-xs-12">
		<input type="text" name="sbPin" maxlength="30" placeholder="Pincode" value="<?php echo $Data[sbPin]; ?>"/>
	</div>
	<div class="col-md-4 col-sm-4 col-xs-12">
		<input type="button" value="submit" class="save2 submit_button " />
	</div>
	<div class="col-md-4 col-sm-4 col-xs-12">
		<input type="button" value="cancel" class="cancel cancel_button " />
	</div>
</td>
</tr>

<tr>
<td style="color:#000;">Why you are book this appointment?</td>
<td style="color:#666;" class="name"><?php  if(empty($Data[sbstate])){echo "No response";}else{echo $Data[sbstate];}?></td>
<td class="editthis" style="cursor:pointer">Edit</td>
</tr>
<tr style="display:none" class="datas">
<td colspan="3">
	<div class="col-md-4 col-sm-4 col-xs-12">
		<input type="text" name="sbstate" maxlength="30" placeholder="State" value="<?php echo $Data[sbstate]; ?>" />
	</div>
	<div class="col-md-4 col-sm-4 col-xs-12">
		<input type="button" value="submit" class="save2 submit_button " />
	</div>
	<div class="col-md-4 col-sm-4 col-xs-12">
		<input type="button" value="cancel" class="cancel cancel_button " />
	</div>
</td>
</tr>

<tr>
<td style="color:#000;">Insured Address</td>
<td style="color:#666;" class="name"><?php  if(empty($Data[siAddress])){echo "No response";}else{echo $Data[siAddress];}?></td>
<td class="editthis" style="cursor:pointer">Edit</td>
</tr>
<tr style="display:none" class="datas">
<td colspan="3">
	<div class="col-md-4 col-sm-4 col-xs-12">
		<textarea name="iAddress" rows="4" cols="30" placeholder="Insured Address"><?php echo $Data[sbstate]; ?></textarea>
	</div>
	<div class="col-md-4 col-sm-4 col-xs-12">
		<input type="button" value="submit" class="save2 submit_button " />
	</div>
	<div class="col-md-4 col-sm-4 col-xs-12">
		<input type="button" value="cancel" class="cancel cancel_button " />
	</div>
</td>
</tr>


</table>




<div class="conform_button conform_insurence_click lg_btn col-md-offset-4 col-md-4 col-sm-offset-4 col-sm-4 col-xs-offset-0 col-xs-12">save</div>