<?php
	include("service/ui/common/header.php");
	$date = date('Y-m-d');
	$ids=array(1,7);
	$idf=json_encode($ids);
?>
<input type="text" name="allDoctors" id="allDoctors" value="<?php echo $idf;?>" />
<style>
.hidden{
 	display: none;
}
</style>
<script type="text/javascript">
$(document).ready(function(){
	var allDoctors = $("#allDoctors").val();
	miniCalendar(0,allDoctors,'first');					   
	var nextDate = '';
	$("#next").click(function(){
		var firstDate=$("#firstdate").val();
		//var res = firstDate.split(" ");
		miniCalendar(firstDate,allDoctors,'next');
	});	
	$("#prev").click(function(){
		var firstDate=$("#firstdate").val();
		
		//var res = firstDate.split(" ");		
		miniCalendar(firstDate,allDoctors,'prev');
	});	
	function miniCalendar(dateCnt,allDoctors,status){
		$.ajax({
			type: 'GET',	
			url: SITEURL+'minicalendar-new/'+dateCnt+'/'+allDoctors+'/'+status,
			success: function(res){
				$(".calender_custom").html(res);
			}
		});
	}
});
</script>
<section class="team-modern-12">
   <div class="container">
      <div style="float:left; width:1000px;">
         <div class="calender_custom_nxt" style='left:690px'> <a style="cursor:pointer;" id="next"> Next </a></div>
         <div class="calender_custom_prv" style='left:60px'> <a style="cursor:pointer;" id="prev"> Pre </a></div>
         <div class="calender_custom" style='width:100%'>
			
         </div>
      </div>
   </div>
</section>
<?php

include("service/ui/common/footer.php"); ?>