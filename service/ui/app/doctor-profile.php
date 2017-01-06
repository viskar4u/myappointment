<?php 
   include("service/ui/common/header.php"); 
?>
<input type="hidden" name="doctorID" id="doctorID" value="<?php echo $_SESSION['userID'];?>"  />
<input type="hidden" name="patientID" id="patientID" value="<?php echo $_SESSION['userID'];?>"  />
<input type="hidden" name="eventID" id="eventID" />
<input type="hidden" name="newData" id="newData" />

<style>
.hiddenEvent{display: none;}
.fc-other-month .fc-day-number { display:none;}

td.fc-other-month .fc-day-number {
     visibility: hidden;
}
.breaks{
	background: none repeat scroll 0 0 #ececec !important;
	border:1px solid #ececec !important;
	color:#000 !important;
	}
	.vecation{
	background: none repeat scroll 0 0 #ececec !important;
	border:1px solid #ececec !important;
	width:94px !important;
	color:#000 !important;
	z-index:99 !important;
	}
</style>
<link href='<?php echo WEB_ROOT;?>service/public/css/fullcalendar.css' rel='stylesheet' />
<link href='<?php echo WEB_ROOT;?>service/public/css/fullcalendar.print.css' rel='stylesheet' media='print' />
<script src='<?php echo WEB_ROOT;?>service/public/js/calander/moment.min.js'></script>
<script src='<?php echo WEB_ROOT;?>service/public/js/out/jquery-ui.js'></script>
<script src='<?php echo WEB_ROOT;?>service/public/js/calander/doc-custom-calendar.js'></script>
<script src='<?php echo WEB_ROOT;?>service/public/js/out/fullcalendar.js'></script>
<script type='text/javascript'>
   var date = new Date();
   		var d = date.getDate();
   		var m = date.getMonth();
   		var y = date.getFullYear();
   		var dateDis = new Date(y, m, d, 13, 0);
		var ytuyt = '';
  /* var ytuyt =  [
   				
   				{
   					//start: new Date(y, m, d-1, 0, 0),
					start:'2014-08-01T13:15:00.000+10:00',
					end:'2014-08-01T14:15:00.000+10:00',
   					//end: new Date(y, m, d-1, 23, 59),
   					background: '#E7E7E7',// optional
   					cls: 'testCls'
   				},
   				{
   					start: new Date(y, m, d-2, 0, 0),
   					end: new Date(y, m, d-2, 23, 59),
   					background: '#E7E7E7',// optional
   					cls: 'testCls'
   				}
   			] ;*/
   
   	$(document).ready(function() {
							   var docid=$("#patientID").val();
   		var date = new Date();
   		var d = date.getDate();
   		var m = date.getMonth();
   		var y = date.getFullYear();
		var titles=["vacation","BreakTime"]
   		var dateDis = new Date(y, m, d, 13, 0);
   		$('#calendar').fullCalendar({
   			header: {
   				left: 'prev,next today',
                center: 'title',
                right: 'agendaDay,agendaWeek',
   			},		
   			defaultView: 'agendaWeek',
   			allDaySlot: false,
   			slotMinutes: 15,
   			firstHour: 10,
   			lastHour: 18,
   			firstDay: 1,
				hiddenDays: [ 2, 4 ] ,
   			editable: true,
			minTime: "09:00:00",
        maxTime: "18:00:00",
   			eventDurationEditable: true,
		   eventStartEditable: true,
		   selectable: true,
		   selectHelper: true,
   			weekNumbers: true,
				intervalStart:dateDis,
				intervalEnd:dateDis+1,
   			events: SITEURL+'calendar_events/?doctorID='+docid,
   			annotations: ytuyt ,
   				loading: function(bool) {
   			if (bool) 
   				$('#load').show();
   			else 
   				$('#load').hide();
				$('#statusBar').show();
				//hidedate(date);
      		//checkdays();
			//test(slotMinutes);
   			},		
   		 select: function( startDate, endDate, allDay, jsEvent, view) {
   			var startTime = moment(startDate).format();
   			var endTime = moment(endDate).format();
			var check = startTime;
			var today = $.fullCalendar.formatDate(new Date(),'yyyy-MM-dd');
			if(check < today)
			{
				//$(".fc-mon").addClass("fc-state-disabled");
				//alert("Cant");// Previous Day. show message if you want otherwise do nothing.
				// So it will be unselectable
			}
			else
			{
				$("#saveAppnt").show();
        $("#approveAppnt").hide();
    $("#Unapprove").hide();
				$("#deleteAppnt").hide();
				$("#bookModel").modal("show");
				$(".fc-content").css("z-index","2");
				$("#approvedHead").hide();				
				$("#pendingHead").hide();
				$("#defaultHead").show();
				$("#patientApnt-form")[0].reset();
				$("#pop_load").show();
				appointmentScheduling(startTime,endTime);
			}
   		},viewDisplay: function(view) {
            if (view.name == 'month'){ //just in month view mode 
                var d = view.calendar.getDate(); //choise the date for cell customize
                var cell = view.dateCell(d); //get the cell location for date
                var bodyCells = view.element.find('tbody').find('td');//get all cells from current calendar
                var _element = bodyCells[cell.row*view.getColCnt() + cell.col]; //get specific cell for the date
                $(_element).css('background-color', 'red'); //customize the cell
            }
        },
   		eventClick: function(calEvent, jsEvent, view) {
   			$("#eventID").val(calEvent.id);
			var title1=calEvent.title;
			console.log(title1);
			$("#newData").val(calEvent);
			//if((title1 != "vacation") || (title1 != "BreakTime")  ){
				if(jQuery.inArray( title1, titles)<0){
   			appntDetails(calEvent, jsEvent, view,1);
   			$("#pop_load").show();
			}
   		}, 
		eventDrop: function(event,dayDelta,minuteDelta,allDay,revertFunc) {
			$("#load").show();
			var newStartTime = getHoursAndMinutes(event.start);
			var newEndTime = getHoursAndMinutes(event.end);
			var statTime = event.start;
			var curMonth  = statTime.getMonth()+1;
			if(curMonth<10){
			 curMonth = "0"+curMonth;
			}
			var apntDate = statTime.getFullYear()+"-"+curMonth+"-"+statTime.getDate();
			updateEvents(event.id,apntDate,newStartTime,newEndTime);
  	  },/*dayClick: function( date, allDay, jsEvent, view ) { 
                    var myDate = new Date();
                    
                    //How many days to add from today?
                    var daysToAdd = 15;
                    
                    myDate.setDate(myDate.getDate() + daysToAdd);
                
                    if (date < myDate) {
                        //TRUE Clicked date smaller than today + daysToadd
                    alert("You cannot book on this day!");    
                    }
                    else
                    {
                        //FLASE Clicked date larger than today + daysToadd
                        alert("Excellent choice! We can book today..");    
                     }   
                    
            },*/
	  eventResize: function(event, delta, revertFunc) {
		$("#load").show();
		var newStartTime = getHoursAndMinutes(event.start);
		var newEndTime = getHoursAndMinutes(event.end);
		var statTime = event.start;
		var curMonth  = statTime.getMonth()+1;
		if(curMonth<10){
			curMonth = "0"+curMonth;
		}
		var apntDate = statTime.getFullYear()+"-"+curMonth+"-"+statTime.getDate();
		updateEvents(event.id,apntDate,newStartTime,newEndTime);
    }/*,		
   		viewDisplay : function(view) {
			var selectedWeekNumber = getWeekNumber(view.start);
			   var currentWeekNumber = getWeekNumber(new Date());
			var endWeekNumber = currentWeekNumber+4;
			$('.fc-button-prev').addClass("fc-state-disabled");
			if(selectedWeekNumber < currentWeekNumber){
				$('.fc-button-prev').addClass("fc-state-disabled");
				$('.fc-button-next').removeClass("fc-state-disabled");
			}else if(selectedWeekNumber > currentWeekNumber){
				$('.fc-button-prev').removeClass("fc-state-disabled");
				$('.fc-button-next').removeClass("fc-state-disabled");
			}
			if(selectedWeekNumber == endWeekNumber){
				$('.fc-button-next').addClass("fc-state-disabled");
				$('.fc-button-prev').removeClass("fc-state-disabled");
			}
   		} */ 		
       });
		
        $("#calanderLoading").hide();
		//jQuery("th.fc-agenda-axis").hide();
		/*function checkdays(){
		for(var i=0;i<7;i++){
		 var date = $(".fc-col"+i).html();
		 var date1="Sun 9/7";
				var j=i+2;
		 if(date==date1){
			 $("td:nth-child("+j+")").addClass("mine");
			 }
			 else{
				if($("td:nth-child("+j+")").hasClass("mine")){
					$("td:nth-child("+j+")").removeClass("mine");
				}
				// $("td:nth-child("+j+")").css("background-color","white");
				 }
		 }										
												}*/
												function test(slotMinutes){
													console.log(slotMinutes);
													}
	});
   	
   
</script>

<section  class="team-modern-12">
   <div class="container">
      <div class="dctr_mbr_mdl">
         <div class="dctr_mbr_lft" style="float: left;padding: 0;width: 75%;">
            <div class="dctr_mbr_tbl">
            
            	<div id="statusBar" class="clndr_clr" style="display:none;">
       <div class="clndr_aprv"> <div class="clndr_aprv1"></div>  <div class="clndr_aprv2"> Approved </div> </div>
  <div class="clndr_pndg"> <div class="clndr_pndg1"></div>  <div class="clndr_pndg2"> Pending </div> </div>
        <div class="clndr_cncl"> <div class="clndr_cncl1"></div>  <div class="clndr_cncl2"> Cancelled </div> </div>
      </div>
      
                <div style="width:784px;height:631px;float:left;">
                    <div class="dr_book_calender">
                        <div class="dr_calender_outr" id="load">
                        	<div class="dr_calender_load"></div>
                        </div>
                        <div id="apntEdit" style="left:257px;position: absolute;top: 365px;width: 400px;z-index: 999999; display:none;" role="alert" class="alert alert-success">
                        Your changes saved successfully.
                        </div>
                        <div id='calendar'></div>
                    </div>
                </div>
            </div>
            <!--<div class="dctr_mbr_pgnationmn">
               <nav class="dctr_mbr_pgnation">
                  <a href="#" class="prev">&lt;</a>
                  <span>1</span>
                  <a href="#">2</a>
                  <a href="#">3</a>
                  <a href="#">4</a>                  
                  <a href="#">5</a>
                  <a href="#" class="next">&gt;</a>
               </nav>
               </div>-->
         </div>
         <div class="dctr_mbr_rht " style="float: left;margin: 0;padding: 0 ;width: 25%;">
            <nav class="dctr_br_side-nav">
               <a href="#" class="dctr_br_side-nav-button active"> <img src="<?php echo WEB_ROOT;?>service/public/images/images/calendar edit.png" alt=""><br><p>Appointment</p> </a>
               <a href="<?php echo WEB_ROOT;?>index.php/calendar-settings" class="dctr_br_side-nav-button"> <img src="<?php echo WEB_ROOT;?>service/public/images/images/calendar setting.png" alt=""><br> 
               <p>Calendar Settings</p></a>
               <a href="<?php echo WEB_ROOT;?>index.php/doctor/profile/settings" class="dctr_br_side-nav-button"> <img src="<?php echo WEB_ROOT;?>service/public/images/images/settings.png" alt=""><br><p>Settings</p></a>

               <a href="<?php echo WEB_ROOT;?>index.php/signout" class="dctr_br_side-nav-button"> <img src="<?php echo WEB_ROOT;?>service/public/images/images/logout.png" alt=""><br> <p>Logout</p> </a>
            </nav>
         </div>
      </div>
   </div>
</section>

         
         <div id="bookModel" class="modal fade"  tabindex="-1" role="dialog">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-body">
                   <div class="ball" data-dismiss="modal">
                      <a href="javascript:void(0);" > <img src="<?php echo WEB_ROOT;?>service/public/images/images/ballinto.png"></a>
                  </div>
                  <form class="basic-grey" id="patientApnt-form">
                    <h3 id="defaultHead" class="modal-title create" align="center" style="text-align:center;display:none;">Create a new Appointment</h3>
                    <h3 id="pendingHead" class="modal-title create" align="center" style="text-align:center;color:#F49B44;display:none;">Waiting for doctor approval</h3>
                    <h3 id="approvedHead" class="modal-title create" align="center" style="text-align:center;color:#A4D250;display:none;">Approved appointment</h3>
                    <h3 id="cancelledHead" class="modal-title create" align="center" style="text-align:center;color:#ff5183;display:none;">Cancelled Appointment</h3>
                    <div class="pop_outr" id="pop_load">
                       <div class="pop_load"></div>
                    </div>
                      <div class="row">
                        <div class="inputpop">
                          <div class="col-md-2">
                             <label>Name:</label>
                          </div>
                          <div class="col-md-offset-2 col-md-8">
                            <input type="text" name="patName" id="patName" title="Hospital is required!" required="" placeholder="DOCP" class="rounded3">
                          </div>
                        </div>
                      </div><br />
                      <div class="row">
                        <div class="inputpop">
                          <div class="col-md-2">
                            <label>Email:</label>
                          </div>
                          <div class="col-md-offset-2 col-md-8">
                            <input type="text" name="patEmail" id="patEmail" title="Hospital is required!" required="" placeholder="doc@bookmydoc.in" class="rounded3">
                          </div>
                        </div>
                      </div><br />
                      <div class="row">
                        <div class="inputpop">
                          <div class="col-md-2">
                            <label>Phone:</label>
                          </div>
                        <div class="col-md-offset-2 col-md-8">
                          <input type="text" name="patPhone" id="patPhone" title="Hospital is required!" required="" placeholder="123456890" class="rounded3">
                        </div>
                        </div>
                      </div><br />
                      <div class="row">
                        <div class="inputpop">
                          <div class="col-md-2">
                          <label>Date:</label>
                        </div>
                        <div class="col-md-offset-2 col-md-8">
                          <input type="text" name="apntDate" id="apntDate" title="Hospital is required!" required="" placeholder="2016-01-06" class="rounded3">
                        </div>
                        </div>
                      </div><br />
                      <div class="row">
                        <div class="inputpop">
                          <div class="col-md-2">
                            <label>Time:</label>
                          </div>
                          <div class="col-md-offset-2 col-md-8">
                            <div class="row">
                              <div class="col-md-6">
                                <input type="text" name="apntStart" id="apntStart" title="Hospital is required!" required="" placeholder="10:45:00" class="rounded3">
                              </div>
                              <div class="col-md-6">
                                <input type="text" name="apntEnd" id="apntEnd" title="Hospital is required!" required="" placeholder="12.30.00" class="rounded3">
                              </div>
                            </div>
                          </div>
                        </div>
                      </div><br />
                      <div class="row">
                        <div class="inputpop">
                          <div class="col-md-2">
                            <label>comments:</label>
                          </div>
                          <div class="col-md-offset-2 col-md-8">
                            <textarea name="notes" id="notes" placeholder="Your Message to Us" cols="53" rows="3"></textarea>
                          </div>
                        </div>
                      </div><br />
                    <!--<div class="rm_popup">
                       <label>
                          <span class="frm_txtp">Insurance :</span>
                          <select name="selection">
                             <option value="Job Inquiry">Insurance 1</option>
                             <option value="General Question">Insurance 2</option>
                          </select>
                       </label>
                       </div>-->
                    <div class="rm_popup col-md-offset-4 col-md-8" >
                       <input id="saveAppnt" type="button" value="Save" class="button">
                       <input style="display:none;" id="approveAppnt" type="button" value="Approve" class="button">
                       <input style="display:none;" id="Unapprove" type="button" value="Unapprove" class="button">
                       <input id="deleteAppnt" type="button" value="Delete" class="button2"> 
                       <input id="cancelAppnt" type="button" value="Close" class="button2">         
                    </div>
                    <div class="clearfix"></div>
                  </form>
                </div>
              </div>
            </div>
         </div>    
         <script>
		 $(document).ready(function(){
		 /*$(".fc-widget-header").each(function(){
											  alert($(this).html());
										});*/
		 /*
		 for(var i=0;i<7;i++){
		 var date = $(".fc-col"+i).html();
		 alert(date);
		 var date1="Sun 9/7";
				var j=i+2;
		 if(date==date1){
			 $("td:nth-child("+j+")").addClass("mine");
			 }
			 else{
				if($("td:nth-child("+j+")").hasClass("mine")){
					$("td:nth-child("+j+")").removeClass("mine");
				}
				// $("td:nth-child("+j+")").css("background-color","white");
				 }
		 }*/
		 
		 });
		 </script>
<?php include("service/ui/common/footer.php"); ?>