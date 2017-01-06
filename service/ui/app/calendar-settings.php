<?php 
   include("service/ui/common/header.php"); 
   function is_multi($a) {
    $rv = array_filter($a,'is_array');
    if(count($rv)>0) return 1;
    return 0;
   }
   ?><?php
   $result = $scad->getUserDetails($_SESSION['userID']);
   $br=$result['breaks'];
   $doc[]=json_decode($br,TRUE);
   $wrk=$result['working_plan'];
   $docwrk[]=json_decode($wrk,TRUE);
   $vecation=$result['vecation'];
   $vecation_arr[]=json_decode($vecation,TRUE);
   $day=array(Mon,Tue,Wed,Thu,Fri,Sat,Sun);
   $days=array(Monday,Tuesday,Wednesday,Thursday,Friday,Saturday,Sunday);
   ?>
<!-- <link rel="stylesheet" href="<?php echo WEB_ROOT?>service/public/css/setting_pg.css"> -->
<script type='text/javascript' src='<?php echo WEB_ROOT?>service/public/js/doctor-profile-settings.js'></script>
<script type='text/javascript' src='<?php echo WEB_ROOT?>service/public/js/timepicker/jquery.timepicker.js'></script>
<link rel="stylesheet" href="<?php echo WEB_ROOT?>service/public/css/timepicker/jquery.timepicker.css">
<script>
   $(document).ready(function(){
      $('input[type="text"]').keyup(function(){
        $(this).val('');
        $(this).attr('readonly','readonly');
        var thiss=$(this);
        setTimeout(function(){
          thiss.removeAttr('readonly');
        },1000);
      });
                 if($(".check1").is(':checked'))
                               {
                                 $(this).parent().next().find("input").removeAttr("disabled");
                                 $(this).parent().next().next().find("input").removeAttr("disabled");
                               }
                                else{
                                 $(this).parent().next().find("input").attr("disabled","true");
                                 $(this).parent().next().next().find("input").attr("disabled","true");
                               }
                 function allFunction(){
                   $(".savevecation").click(function(){
       var startdate = "";
       $(".startdate").each(function(){
                        var isDisabled = $(this).prop('disabled');
       
       if (isDisabled)
       {
           startdate += "none,";
       }else{
           startdate += $(this).val() + ",";
    }
       });
    var enddate = "";
       $(".enddate").each(function(){
                        var isDisabled = $(this).prop('disabled');
       
       if (isDisabled)
       {
           enddate += "none,";
       }else{
           enddate += $(this).val() + ",";
    }
       });
    var starttime = "";
       $(".starttime").each(function(){
                        var isDisabled = $(this).prop('disabled');
       
       if (isDisabled)
       {
           starttime += "none,";
       }else{
           starttime += $(this).val() + ",";
    }
       });
    var endtime = "";
       $(".endtime").each(function(){
                        var isDisabled = $(this).prop('disabled');
       
       if (isDisabled)
       {
           endtime += "none,";
       }else{
           endtime += $(this).val() + ",";
    }
       });
    //alert(startdate+"@"+enddate+"@"+starttime+"@"+endtime);
    $.ajax({
                type: 'POST',
                url: SITEURL + 'updateDrvecationTime',
         data:{"drId":<?php echo $_SESSION['userID'];?>,"startdate":startdate,"enddate":enddate,"starttime":starttime,"endtime":endtime},
                success: function(res) {
                   if(res==1){
            $("#update_succes2").fadeIn(500).delay(1000);
            $("#update_succes2").fadeOut(2500);
          }
          else{
            $("#update_error2").fadeIn(1000);
            $("#update_error2").fadeOut(1500);
          }
                }
            });
   });
                   $(".saves").click(function(){
                    var trg = $(this);
// var validation = trg.parent().parent().parent().parent().parent().find('form').parsley('isValid');
//         var count=0;
//         trg.parent().parent().parent().parent().parent().find('input[type="text"]').each(function(){
//             var val = $(this).val();
//             $(this).parent().find('.parsley-error-list').remove();
//             if(val==''){
//               $(this).addClass('parsley-validated parsley-error');
//               var html = '<ul class="parsley-error-list" style="display: block;"><li class="required" style="display: block;">This value is required.</li></ul>';
//               $(this).parent().append(html);
//               count++;
//             }
//           });
       // var validation = (count > 0) ? false : true;
        var validation = true;
        if(validation===true){
          trg.parent().parent().parent().parent().parent().find('input[type="text"]').each(function(){
            $(this).removeClass('parsley-validated parsley-error');
          });
          var Contain = "";
          var mon_len=$(".Monday").length;
          var tue_len=$(".Tuesday").length;
          var wed_len=$(".Wednesday").length;
          var thu_len=$(".Thursday").length;
          var fri_len=$(".Friday").length;
          var sat_len=$(".Saturday").length;
          var sun_len=$(".Sunday").length;
          $("#doc-pass1 :text").each(function(){
            var isDisabled = $(this).prop('disabled');
            if (isDisabled)
            {
              Contain += "none,";
            }else{
              Contain += $(this).val() + ",";
            }
          });
          var total_count = mon_len+","+tue_len+","+wed_len+","+thu_len+","+fri_len+","+sat_len+","+sun_len;
          //alert(total_count);
          $.ajax({
            type: 'POST',
            url: SITEURL + 'updateDrBrkTime',
            data:{"Contain": Contain,"drId":<?php echo $_SESSION['userID'];?>,"total_count":total_count},
            success: function(res) {
              if(res==1){
                $("#update_succes1").fadeIn(500).delay(1000);
                $("#update_succes1").fadeOut(2500);
              }
              else{
                $("#update_error1").fadeIn(1000);
                $("#update_error1").fadeOut(1500);
              }
            }
          });
        }
      });
                 $(".change").click(function(){
                    $(this).parent().parent().parent().parent().hide(500);
                    $(this).parent().parent().parent().parent().next().show();
                    //$(".show").slideDown();
                    });
      $(".change2").click(function(){
                    $(this).parent().parent().parent().parent().hide();
                    $(this).parent().parent().parent().parent().prev().show(500);
                    //$(".show").slideDown();
                    });
      $(".addNew1").click(function(){
                    var cls = $(this).attr("alt");
                    html=''+'<div class="row shows" style="border-bottom:2px solid #f0f0f0;padding-bottom:8px;" ><div class="col-md-3 col-sm-3 col-xs-12"><label>&nbsp;<input name="" class="check1 '+cls+'" type="checkbox" value="'+cls+'"> '+cls+' </label></div><div class="col-md-3 col-sm-3 col-xs-12"> <fieldset class="account-text registration days"><input type="text" value="" placeholder="" data-type="text" data-trigger="change" data-required="true" class="timeformat1'+cls+'" name="text" id="text" style="min-height:30px;"></fieldset></div><div class="col-md-3 col-sm-3 col-xs-12"> <fieldset class="account-text registration days"><input type="text" value="" placeholder="" data-type="text" data-trigger="change" data-required="true" class=" timeformat1'+cls+'" name="text" id="text" style="min-height:30px;"></fieldset></div><div class="col-md-3 col-sm-3 col-xs-6"> <div class="action" style="float:left;margin:2px"><a href="javascript:void(0);"><img src="<?php echo WEB_ROOT?>service/public/images/tab_clum2_icon5.jpg"  style="cursor:pointer;" class="saves" alt=""></a></div><div class="action" style="float:left;margin:2px"><a href="javascript:void(0);"><img src="<?php echo WEB_ROOT?>service/public/images/tab_clum2_icon2.jpg" style="cursor:pointer;margin-left:3px;" class="change2" alt=""></a></div><div class="action" style="float:left;margin:2px"><a href="javascript:void(0);"><img src="<?php echo WEB_ROOT?>service/public/images/tab_clum2_icon4.jpg" class="addNew1" style="cursor:pointer;" alt="'+cls+'"></a></div></div></div>';
                    html = $("."+cls+"br").html()+html;
                    $("."+cls+"br").html(html);
                    allFunction();
                    });
      $(function() {
                       $('.timeformat').timepicker({ 'timeFormat': 'H:i' ,'step': 60/*,'minTime': '2:00am',
       'maxTime': '11:00am'*/});
             <?php
      $k=0;
      foreach($day as $value){
      ?>
            $('.timeformat1<?php echo $days[$k];?>').timepicker({ 'timeFormat': 'H:i' ,'step': 30,'minTime': '<?php echo (isset($docwrk[0][$value][start])) ? $docwrk[0][$value][start] : "00:00";?>',
       'maxTime': '<?php echo (isset($docwrk[0][$value][ends])) ? $docwrk[0][$value][ends] : "23:00";?>'});
            <?php $k++;  } ?>
                   });
                 }
                 $(".check1").click(function(){
                               if($(this).is(':checked'))
                               {
                                 $(this).parent().next().find("input").removeAttr("disabled");
                                 $(this).parent().next().next().find("input").removeAttr("disabled");
                               }
                               else{
                                 $(this).parent().next().find("input").attr("disabled","true");
                                 $(this).parent().next().next().find("input").attr("disabled","true");
                               }
                               });
      $(".change").click(function(){
                    $(this).parent().parent().parent().parent().hide();
                    $(this).parent().parent().parent().parent().next().show();
                    });
      $(".change2").click(function(){
                    $(this).parent().parent().parent().parent().remove();
                    //$(this).parent().parent().parent().parent().prev().show();
                    });
      $(".addNew").click(function(){
                    var cls = $(this).attr("alt");
                    html=''+'<div class="row shows" style="border-bottom:2px solid #f0f0f0;padding-bottom:8px;"><div class="col-md-3 col-sm-3 col-xs-12"><label>&nbsp;<input name="" class="check1 '+cls+'" type="checkbox" value="'+cls+'"> '+cls+' </label></div><div class="col-md-3 col-sm-3 col-xs-12"> <fieldset class="account-text registration days"><input type="text" value="" placeholder="" data-type="text" data-trigger="change" data-required="true" class=" timeformat1'+cls+'" name="text" id="text" style="min-height:30px;"></fieldset></div><div class="col-md-3 col-sm-3 col-xs-12"> <fieldset class="account-text registration days"><input type="text" value="" placeholder="" data-type="text" data-trigger="change" data-required="true" class=" timeformat1'+cls+'" name="text" id="text" style="min-height:30px;"></fieldset></div><div class="col-md-3 col-sm-3 col-xs-6"> <div class="action" style="float:left;margin:2px"><a href="javascript:void(0);"><img src="<?php echo WEB_ROOT?>service/public/images/tab_clum2_icon5.jpg"  style="cursor:pointer;" class="saves" alt=""></a></div><div class="action" style="float:left;margin:2px"><a href="javascript:void(0);"><img src="<?php echo WEB_ROOT?>service/public/images/tab_clum2_icon2.jpg" style="cursor:pointer;margin-left:3px;" class="change2" alt=""></a></div><div class="action" style="float:left;margin:2px"><a href="javascript:void(0);"><img src="<?php echo WEB_ROOT?>service/public/images/tab_clum2_icon4.jpg" class="addNew1" style="cursor:pointer;" alt="'+cls+'"></a></div></div></div>';
                    html = $("."+cls+"br").html()+html;
                    $("."+cls+"br").html(html);
                    allFunction();
                    });
      $(".setVecation").click(function(){
                    html=''+'<div class="row shows" style="border-bottom:2px solid #f0f0f0;padding-bottom:8px;"><div class="col-md-2 col-sm-6 col-xs-12"> <fieldset class="account-text end"><input type="text" data-trigger="mouseleave" data-required="true" data-beatpicker="true" name="dob" id="dob" placeholder="DD-MM-YY" class="input-block-level startdate date-field-required" style="min-height:30px;"/></fieldset></div><div class="col-md-2 col-sm-6 col-xs-12"> <fieldset class="account-text end"><input type="text" data-trigger="mouseleave" data-required="true" data-beatpicker="true" name="dob" id="dob" placeholder="DD-MM-YY" class="input-block-level enddate date-field-required" style="min-height:30px;"/></fieldset></div><div class="col-md-2 col-sm-6 col-xs-12"> <fieldset class="account-text end"><input type="text" placeholder="" data-type="text" value="" data-trigger="change" data-required="true" class="input-block-level starttime timeformat date-field-required" name="text" id="text" style="min-height:30px;"></fieldset></div><div class="col-md-2 col-sm-6 col-xs-12"> <fieldset class="account-text end"><input type="text" placeholder="" data-type="text" value="" data-trigger="change" data-required="true" class="input-block-level endtime timeformat date-field-required" name="text" id="text" style="min-height:30px;"></fieldset></div><div class="col-md-2 col-sm-6 col-xs-6"><div class="actions"><a href="javascript:void(0);"> <img src="<?php echo WEB_ROOT?>service/public/images/tab_clum2_icon5.jpg" style="cursor:pointer;" class="savevecation" alt=""></a></div><div clas="actions"><a href="javascript:void(0);"><img src="<?php echo WEB_ROOT?>service/public/images/tab_clum2_icon2.jpg" style="cursor:pointer;margin-left:3px;" class="change2" alt=""></a></div></div></div>';
                    html = $(".vecation").html()+html;
                    $(".vecation").html(html);
                    allFunction();
                    var js = document.createElement('script');
   js.setAttribute('type', 'text/javascript');
   js.src = '<?php echo WEB_ROOT?>service/public/js/calander/BeatPicker.min.js';
   document.body.appendChild(js);
                    });
      $(".removeVecation").click(function(){
                        if(confirm("Are you sure to remove the vecation period?")==true){
                        $(this).parent().parent().parent().parent().next().remove();
                       $(this).parent().parent().parent().parent().remove();
                       
       var startdate = "";
       $(".startdate").each(function(){
                        var isDisabled = $(this).prop('disabled');
       
       if (isDisabled)
       {
           startdate += "none,";
       }else{
           startdate += $(this).val() + ",";
    }
       });
    var enddate = "";
       $(".enddate").each(function(){
                        var isDisabled = $(this).prop('disabled');
       
       if (isDisabled)
       {
           enddate += "none,";
       }else{
           enddate += $(this).val() + ",";
    }
       });
    var starttime = "";
       $(".starttime").each(function(){
                        var isDisabled = $(this).prop('disabled');
       
       if (isDisabled)
       {
           starttime += "none,";
       }else{
           starttime += $(this).val() + ",";
    }
       });
    var endtime = "";
       $(".endtime").each(function(){
                        var isDisabled = $(this).prop('disabled');
       
       if (isDisabled)
       {
           endtime += "none,";
       }else{
           endtime += $(this).val() + ",";
    }
       });
    //alert(startdate+"@"+enddate+"@"+starttime+"@"+endtime);
    $.ajax({
                type: 'POST',
                url: SITEURL + 'updateDrvecationTime',
         data:{"drId":<?php echo $_SESSION['userID'];?>,"startdate":startdate,"enddate":enddate,"starttime":starttime,"endtime":endtime},
                success: function(res) {
                   if(res==1){
            $("#update_succes2").fadeIn(500).delay(1000);
            $("#update_succes2").fadeOut(2500);
          }
          else{
            $("#update_error2").fadeIn(1000);
            $("#update_error2").fadeOut(1500);
          }
                }
            });
                        }
                        });
      $(".removeBreak").click(function(){
                       if(confirm("Are you sure to remove the break time?")==true){
                       $(this).parent().parent().parent().parent().next().remove();
                       $(this).parent().parent().parent().parent().remove();
                       
       var Contain = "";
    var mon_len=$(".Monday").length;
    var tue_len=$(".Tuesday").length;
    var wed_len=$(".Wednesday").length;
    var thu_len=$(".Thursday").length;
    var fri_len=$(".Friday").length;
    var sat_len=$(".Saturday").length;
    var sun_len=$(".Sunday").length;
       $("#doc-pass1 :text").each(function(){
                        var isDisabled = $(this).prop('disabled');
       
       if (isDisabled)
       {
           Contain += "none,";
       }else{
           Contain += $(this).val() + ",";
    }
       });
    var total_count = mon_len+","+tue_len+","+wed_len+","+thu_len+","+fri_len+","+sat_len+","+sun_len;
    //alert(total_count+"@"+Contain);
    $.ajax({
                type: 'POST',
                url: SITEURL + 'updateDrBrkTime',
         data:{"Contain": Contain,"drId":<?php echo $_SESSION['userID'];?>,"total_count":total_count},
                success: function(res) {
                   if(res==1){
            $("#update_succes1").fadeIn(500).delay(1000);
            $("#update_succes1").fadeOut(2500);
          }
          else{
            $("#update_error1").fadeIn(1000);
            $("#update_error1").fadeOut(1500);
          }
                }
            });
      
                       }});
      $(".savevecation1").click(function(){
       var startdate = "";
       $(".startdate").each(function(){
                        var isDisabled = $(this).prop('disabled');
       
       if (isDisabled)
       {
           startdate += "none,";
       }else{
           startdate += $(this).val() + ",";
    }
       });
    var enddate = "";
       $(".enddate").each(function(){
                        var isDisabled = $(this).prop('disabled');
       
       if (isDisabled)
       {
           enddate += "none,";
       }else{
           enddate += $(this).val() + ",";
    }
       });
    var starttime = "";
       $(".starttime").each(function(){
                        var isDisabled = $(this).prop('disabled');
       
       if (isDisabled)
       {
           starttime += "none,";
       }else{
           starttime += $(this).val() + ",";
    }
       });
    var endtime = "";
       $(".endtime").each(function(){
                        var isDisabled = $(this).prop('disabled');
       
       if (isDisabled)
       {
           endtime += "none,";
       }else{
           endtime += $(this).val() + ",";
    }
       });
    //alert(startdate+"@"+enddate+"@"+starttime+"@"+endtime);
    $.ajax({
                type: 'POST',
                url: SITEURL + 'updateDrvecationTime',
         data:{"drId":<?php echo $_SESSION['userID'];?>,"startdate":startdate,"enddate":enddate,"starttime":starttime,"endtime":endtime},
                success: function(res) {
                   if(res==1){
            $("#update_succes2").fadeIn(500).delay(1000);
            $("#update_succes2").fadeOut(2500);
          }
          else{
            $("#update_error2").fadeIn(1000);
            $("#update_error2").fadeOut(1500);
          }
                }
            });
   });
      });
   
   function Getbrvalue(trg){
        // var validation = trg.parent().parent().parent().parent().parent().find('form').parsley('isValid');
        // var count=0;
        // trg.parent().parent().parent().parent().parent().find('input[type="text"]').each(function(){
        //     var val = $(this).val();
        //     $(this).parent().find('.parsley-error-list').remove();
        //     if(val==''){
        //       $(this).addClass('parsley-validated parsley-error');
        //       var html = '<ul class="parsley-error-list" style="display: block;"><li class="required" style="display: block;">This value is required.</li></ul>';
        //       $(this).parent().append(html);
        //       count++;
        //     }
        //   });
        // var validation = (count > 0) ? false : true;
        var validation =true;
        if(validation===true){
          trg.parent().parent().parent().parent().parent().find('input[type="text"]').each(function(){
            $(this).removeClass('parsley-validated parsley-error');
          });
          var Contain = "";
          var mon_len=$(".Monday").length;
          var tue_len=$(".Tuesday").length;
          var wed_len=$(".Wednesday").length;
          var thu_len=$(".Thursday").length;
          var fri_len=$(".Friday").length;
          var sat_len=$(".Saturday").length;
          var sun_len=$(".Sunday").length;
          $("#doc-pass1 :text").each(function(){
            var isDisabled = $(this).prop('disabled');
            if (isDisabled)
            {
              Contain += "none,";
            }else{
              Contain += $(this).val() + ",";
            }
          });
          var total_count = mon_len+","+tue_len+","+wed_len+","+thu_len+","+fri_len+","+sat_len+","+sun_len;
          //alert(total_count);
          $.ajax({
            type: 'POST',
            url: SITEURL + 'updateDrBrkTime',
            data:{"Contain": Contain,"drId":<?php echo $_SESSION['userID'];?>,"total_count":total_count},
            success: function(res) {
              if(res==1){
                $("#update_succes1").fadeIn(500).delay(1000);
                $("#update_succes1").fadeOut(2500);
              }
              else{
                $("#update_error1").fadeIn(1000);
                $("#update_error1").fadeOut(1500);
              }
            }
          });
        }
      }
   function Getvalue(){
       var Contain = "";
       $("#doc-profile :text").each(function(){
                        var isDisabled = $(this).prop('disabled');
       
       if (isDisabled)
       {
           Contain += "none,";
       }else{
           Contain += $(this).val() + ",";
    }
       });
    $.ajax({
                type: 'POST',
                url: SITEURL + 'updateDrWorkTime',
         data:{"Contain": Contain,"drId":<?php echo $_SESSION['userID'];?>},
                success: function(res) {
                   if(res==1){
            $("#update_succes").fadeIn(500).delay(1000);
            $("#update_succes").fadeOut(2500);
          }
          else{
            $("#update_error").fadeIn(1000);
            $("#update_error").fadeOut(1500);
          }
                }
            });
   }
   
   
     $(function() {
                       $('.timeformat').timepicker({ 'timeFormat': 'H:i' ,'step': 60/*,'minTime': '2:00am',
       'maxTime': '11:00am'*/});
             <?php
      $k=0;
      foreach($day as $value){
      ?>
            $('.timeformat1<?php echo $day[$k];?>').timepicker({ 'timeFormat': 'H:i' ,'step': 30,'minTime': '<?php echo (isset($docwrk[0][$value][start])) ? $docwrk[0][$value][start] : "00:00";?>',
       'maxTime': '<?php echo (isset($docwrk[0][$value][ends])) ? $docwrk[0][$value][ends] : "23:00";?>'});
            <?php $k++;  } ?>
                   });
      
</script>
<style>
   .setWrkTime{
   background-color: #ffffff;
   background-image: linear-gradient(to bottom, #fe6afe, #f819f8);
   /*background-repeat: repeat-x;*/
   border-color: rgba(0, 0, 0, 0.1) rgba(0, 0, 0, 0.1) rgba(0, 0, 0, 0.25);
   border-radius: 6px;
   color: #ffffff;
   cursor: pointer;
   font-family: roboto;
   font-size: 19px;
   font-weight: 700;
   padding: 12px 0;
   position: relative;
   text-align: center;
   text-decoration: none;
   text-shadow: 0 -1px 0 rgba(0, 0, 0, 0.25);
   width: 100%;
   }
</style>
<div class="container section_wrapper">
   <div class="row">
      <div style="padding:0;" class="col-md-9">
         <div class = "raspberry">
            <a href="<?php echo WEB_ROOT;?>index.php/doctor/profile">
               <img width='48' height='47' src="<?php echo WEB_ROOT;?>service/public/images/images/calendar edit.png"/>
               <p>Appointment</p>
            </a>
         </div>
         <div class = "raspberry active">
            <a href="#">
               <img width='48' height='47' src="<?php echo WEB_ROOT;?>service/public/images/images/calendar setting.png"/>
               <p>Calendar Settings</p>
            </a>
         </div>
         <div class = "raspberry">
            <a href="<?php echo WEB_ROOT;?>index.php/doctor/profile/settings">
               <img width='48' height='47' src='<?php echo WEB_ROOT;?>service/public/images/images/settings.png'/>
               <p>Settings</p>
            </a>
         </div>
         <div class = "raspberry">
            <a href="<?php echo WEB_ROOT;?>index.php/signout">
               <img width='48' height='47' src='<?php echo WEB_ROOT;?>service/public/images/images/logout.png'/>
               <p>Logout</p>
            </a>
         </div>
      </div>
   </div>
   <div class="row study">
      <ul data-persist="true" class="tabs">
         <li class="selected"><a href="#doc-profile">Work Plan</a></li>
         <li class=""><a href="#doc-pass1">Breaks</a></li>
         <li class=""><a href="#doc-imageupload">Vacations</a></li>
      </ul>
      <div class="tabcontents">
         <div id="doc-profile" style="display: block;">
            <div id="update_error" style="margin-top:20px;display:none;text-align:center;" class="alert alert-error">Update Failed.</div>
            <div id="update_succes" style="margin-top:20px;display:none;text-align:center;" class="alert alert-success">Successfully Updated.</div>
            <div style="background-color:#ececec;margin:0;" class="row">
               <div class="col-md-4 col-sm-4 col-xs-4">
                  <div class="start">
                     <p>Day</p>
                  </div>
                  <br>
               </div>
               <div class="col-md-4 col-sm-4 col-xs-4 ">
                  <div class="start">
                     <p>Start</p>
                  </div>
                  <br>
               </div>
               <div class="col-md-4 col-sm-4 col-xs-4">
                  <div class="start">
                     <p>End</p>
                  </div>
                  <br>
               </div>
            </div>
            <?php
               $k=0;
               foreach($day as $value){
               ?>
            <div style="border-bottom:2px solid #f0f0f0;padding-bottom:8px;" class="row">
               <div class="col-md-4 col-sm-4 col-xs-4">
                  <label>
                  &nbsp; <input type="checkbox" id="remember_me" name="remember_me" <?php if(!($docwrk[0][$value][start]==none)) echo "checked"; ?> value="<?php echo $days[$k]; ?>">
                  <?php echo $days[$k]; ?> 
                  </label>
               </div>
               <div class="col-md-4 col-sm-4 col-xs-4">
                  <fieldset class="account-text registration days">
                     <input  type="text" placeholder="08.00" value="<?php echo $docwrk[0][$value][start];?>" name="text" <?php if($docwrk[0][$value][start]==none) echo "disabled"; ?> data-trigger="change" data-required="true" class="timeformat date-field-required">
                  </fieldset>
               </div>
               <div class="col-md-4 col-sm-4 col-xs-4">
                  <fieldset class="account-text registration days">
                     <input type="text" placeholder="15.00" name="email" value="<?php echo $docwrk[0][$value][ends];?>" name="text" <?php if($docwrk[0][$value][ends]==none) echo "disabled"; ?> data-trigger="change" data-required="true" class="timeformat date-field-required">
                  </fieldset>
               </div>
            </div>
            <?php $k++;} ?>
            <div class="row">
               <div class="col-md-2"></div>
               <div class="col-md-8">
                  <div class="saves save"  onclick="Getvalue()">
                     <h4><a href="javascript:void(0);">Enable</a></h4>
                  </div>
               </div>
               <div class="col-md-2"></div>
            </div>
         </div>
         <div id="doc-pass1" style="display: block;">
            <div style="background-color:#ececec;margin:0;" class="row">
               <div class="col-md-3 col-sm-3 col-xs-3">
                  <div class="start">
                     <p>Day</p>
                  </div>
                  <br>
               </div>
               <div class="col-md-3 col-sm-3 col-xs-3 ">
                  <div class="start">
                     <p>Start</p>
                  </div>
                  <br>
               </div>
               <div class="col-md-3 col-sm-3 col-xs-3">
                  <div class="start">
                     <p>End</p>
                  </div>
                  <br>
               </div>
               <div class="col-md-3 col-sm-3 col-xs-3">
                  <div class="start">
                     <p>Actions</p>
                  </div>
                  <br>
               </div>
            </div>
            <?php 
               if(empty($doc[0][Mon])){
               ?>
            <div style="border-bottom:2px solid #f0f0f0;padding-bottom:8px;" class="row">
              <form>
               <div class="col-md-3 col-sm-3 col-xs-12"> 
                  <label>
                  &nbsp; <input name="" class="check1 Monday"  type="checkbox" value=""> Monday
                  </label> 
               </div>
               <div class="col-md-3 col-sm-3 col-xs-12">
                  <fieldset class="account-text registration days">
                  <input required type="text" value="" placeholder="" data-type="text" data-trigger="change" data-required="true" class="input-block-level timeformat1Mon" name="text" id="text" style="min-height:30px;">
                  </filedset>
               </div>
               <div class="col-md-3 col-sm-3 col-xs-12">
                  <fieldset class="account-text registration days">
                  <input required type="text" value="" placeholder="" data-type="text" data-trigger="change" data-required="true" class="input-block-level timeformat1Mon" name="text" id="text" style="min-height:30px;">
                  </filedset>
               </div>
               <div class="col-md-3 col-sm-3 col-xs-6">
                  <div class="actions">
                     <a href="javascript:void(0);">
                     <img src="<?php echo WEB_ROOT?>service/public/images/tab_clum2_icon5.jpg" onclick="Getbrvalue($(this))" style="cursor:pointer;" class="change1" alt="">
                     </a>
                  </div>
                  <div class="actions">
                     <a href="javascript:void(0);">
                     <img src="<?php echo WEB_ROOT?>service/public/images/tab_clum2_icon2.jpg" style="cursor:pointer;margin-left:3px;" class="change2" alt="">
                     </a>
                  </div>
                  <div class="actions">
                     <a href="javascript:void(0);">
                     <img src="<?php echo WEB_ROOT?>service/public/images/tab_clum2_icon4.jpg" class="addNew" style="cursor:pointer;" alt="Monday">
                     </a>
                  </div>
               </div>
             </form>
            </div>
            <div class="Mondaybr"></div>
            <?php
               }else{
               $ar=$doc[0][Mon];
                $b=is_multi($doc[0][Mon]);
                      if($b==1){
               foreach($ar as $key=>$value){
                $start[]=$value[start];
                $ends[]=$value[ends];
               // print_r($value);
               }}
               else{
                $start[]=$ar[start];
                $ends[]=$ar[ends];
                }
                $len=count($start);
               ?>
            <?php for($i=0;$i<$len;$i++){ ?> 
            <div style="border-bottom:2px solid #f0f0f0;padding-bottom:8px;" class="row exist">
               <div class="col-md-3 col-sm-3 col-xs-12"> 
                  <label>
                  &nbsp; <input name=""  type="checkbox" value=""> Monday 
                  </label>
               </div>
               <div class="col-md-3 col-sm-3 col-xs-12">
                  <fieldset class="account-text registration days">
                     <?php echo $start[$i]?>
                  </fieldset>
               </div>
               <div class="col-md-3 col-sm-3 col-xs-12">
                  <fieldset class="account-text registration days">
                     <?php echo $ends[$i]?> 
                  </fieldset>
               </div>
               <div class="col-md-3 col-sm-3 col-xs-6">
                  <div class="actions">
                     <a href="javascript:void(0);">
                     <img src="<?php echo WEB_ROOT?>service/public/images/tab_clum2_icon1.jpg" style="cursor:pointer;" class="change" alt="">
                     </a>
                  </div>
                  <div class="actions">
                     <a href="javascript:void(0);">
                     <img src="<?php echo WEB_ROOT?>service/public/images/tab_clum2_icon2.jpg" class="removeBreak" style="cursor:pointer;" alt="">
                     </a>
                  </div>
                  <?php
                     if($i==($len-1))
                     {
                     ?> 
                  <div class="actions">
                     <a href="javascript:void(0);">
                     <img src="<?php echo WEB_ROOT?>service/public/images/tab_clum2_icon4.jpg"  class="addNew" style="cursor:pointer;" alt="Monday">
                     </a>
                  </div>
                  <?php
                     }
                     ?>
               </div>
            </div>
            <div class="row shows" style="border-bottom:2px solid #f0f0f0;padding-bottom:8px;display:none !important;">
              <form>
               <div class="col-md-3 col-sm-3 col-xs-12">
                  <label>
                  &nbsp;<input name="" class="check1 Monday" <?php if(!($start[$i]=='none')){echo "checked";} ?> type="checkbox" value=""> Monday 
                  </label>
               </div>
               <div class="col-md-3 col-sm-3 col-xs-12">
                  <fieldset class="account-text registration days">
                     <input type="text" required value="<?php echo $start[$i]?>" placeholder="" data-type="text" data-trigger="change" data-required="true" class="input-block-level timeformat1Mon" name="text" id="text" style="min-height:30px;">
                  </fieldset>
               </div>
               <div class="col-md-3 col-sm-3 col-xs-12">
                  <fieldset class="account-text registration days">
                     <input type="text" required value="<?php echo $ends[$i]?>" placeholder="" data-type="text" data-trigger="change" data-required="true" class="input-block-level timeformat1Mon" name="text" id="text" style="min-height:30px;">
                  </fieldset>
               </div>
               <div class="col-md-3 col-sm-3 col-xs-6">
                  <div class="actions">
                     <a href="javascript:void(0);">
                     <img src="<?php echo WEB_ROOT?>service/public/images/tab_clum2_icon5.jpg" onclick="Getbrvalue($(this))" style="cursor:pointer;" class="change1" alt="">
                     </a>
                  </div>
                  <div class="actions">
                     <a href="javascript:void(0);">
                     <img src="<?php echo WEB_ROOT?>service/public/images/tab_clum2_icon2.jpg" style="cursor:pointer;margin-left:3px;" class="change2" alt="">
                     </a>
                  </div>
               </div>
             </form>
            </div>
            <?php
               if($i==($len-1))
               {
               ?>
            <div class="Mondaybr"></div>
            <?php
               }
               ?>
            <?php }} ?>

            <?php 
             if(empty($doc[0][Tue])){
             ?>
               <div class="row shows" style="border-bottom:2px solid #f0f0f0;padding-bottom:8px;" >
               <div class="col-md-3 col-sm-3 col-xs-12"> <label>&nbsp;<input name="" class="check1 Tuesday"  type="checkbox" value=""> Tuesday </label></div>
               <div class="col-md-3 col-sm-3 col-xs-12"> <fieldset class="account-text registration days"><input type="text" value="" placeholder="" data-type="text" data-trigger="change" data-required="true" class="input-block-level timeformat1Thu" name="text" id="text" style="min-height:30px;"></fieldset></div>
               <div class="col-md-3 col-sm-3 col-xs-12"> <fieldset class="account-text registration days"><input type="text" value="" placeholder="" data-type="text" data-trigger="change" data-required="true" class="input-block-level timeformat1Thu" name="text" id="text" style="min-height:30px;"></fieldset> </div>
               <div class="col-md-3 col-sm-3 col-xs-6"> <div class="actions"><a href="javascript:void(0);"><img src="<?php echo WEB_ROOT?>service/public/images/tab_clum2_icon5.jpg" onclick="Getbrvalue($(this))" style="cursor:pointer;" class="change1" alt=""></a></div><div class="actions"><a href="javascript:void(0);"><img src="<?php echo WEB_ROOT?>service/public/images/tab_clum2_icon2.jpg" style="cursor:pointer;margin-left:3px;" class="change2" alt=""></a></div><div class="actions"><a href="javascript:void(0);"><img src="<?php echo WEB_ROOT?>service/public/images/tab_clum2_icon4.jpg" class="addNew" style="cursor:pointer;" alt="Tuesday"></a></div></div>
               </div><div class="Tuesdaybr"></div>
                   <?php
             }else{
               $ar=$doc[0][Tue];
              $b=is_multi($doc[0][Tue]);
                      if($b==1){
             foreach($ar as $key=>$value){
               $starttu[]=$value[start];
               $endstu[]=$value[ends];
             // print_r($value);
             }}
             else{
               $starttu[]=$ar[start];
               $endstu[]=$ar[ends];
               }
               $len=count($starttu);
             ?>
                 <?php for($i=0;$i<$len;$i++){ ?> 
               <div style="border-bottom:2px solid #f0f0f0;padding-bottom:8px;" class="row exist">
               <div class="col-md-3 col-sm-3 col-xs-12"> <label>&nbsp;&nbsp;<input name=""  type="checkbox" value=""> Tuesday </label></div>
              
               <div class="col-md-3 col-sm-3 col-xs-12"> <fieldset class="account-text registration days"><?php echo $starttu[$i]?> </fieldset></div>
               
               <div class="col-md-3 col-sm-3 col-xs-12"> <fieldset class="account-text registration days"><?php echo $endstu[$i]?> </fieldset></div>
               <div class="col-md-3 col-sm-3 col-xs-6">
                <div class="actions">
                  <a href="javascript:void(0);"> 
                    <img src="<?php echo WEB_ROOT?>service/public/images/tab_clum2_icon1.jpg" style="cursor:pointer;" class="change" alt="">
                  </a>
                </div>
                <div class="actions">
                  <a href="javascript:void(0);"> 
                    <img src="<?php echo WEB_ROOT?>service/public/images/tab_clum2_icon2.jpg" class="removeBreak" style="cursor:pointer;" alt="">
                  </a>
                </div><?php
             if($i==($len-1))
             {
            ?> <div class="actions"><a href="javascript:void(0);">
            <img src="<?php echo WEB_ROOT?>service/public/images/tab_clum2_icon4.jpg" class="addNew" style="cursor:pointer;" alt="Tuesday">
            </a></div><?php
             }
             ?>
               
               </div>
               </div>
               
                <div class="row shows" style="border-bottom:2px solid #f0f0f0;padding-bottom:8px;display:none">
               <div class="col-md-3 col-sm-3 col-xs-12"> <label>&nbsp;<input name="" class="check1 Tuesday" <?php if(!($starttu[$i]=='none')){echo "checked";} ?> type="checkbox" value=""> Tuesday </label></div>
               <div class="col-md-3 col-sm-3 col-xs-12"> <fieldset class="account-text registration days"><input type="text" value="<?php echo $starttu[$i]?>" placeholder="" data-type="text" data-trigger="change" data-required="true" class="input-block-level timeformat1Tue" name="text" id="text" style="min-height:30px;"></fieldset></div>
               <div class="col-md-3 col-sm-3 col-xs-12"> <fieldset class="account-text registration days"><input type="text" value="<?php echo $endstu[$i]?>" placeholder="" data-type="text" data-trigger="change" data-required="true" class="input-block-level timeformat1Tue" name="text" id="text" style="min-height:30px;"></fieldset></div>
               <div class="col-md-3 col-sm-3 col-xs-6"> 
                <div class="actions">
                  <a href="javascript:void(0);">
                    <img src="<?php echo WEB_ROOT?>service/public/images/tab_clum2_icon5.jpg" onclick="Getbrvalue($(this))" style="cursor:pointer;" class="change1" alt="">
                  </a>
                </div>
                <div class="actions">
                  <a href="javascript:void(0);">
                    <img src="<?php echo WEB_ROOT?>service/public/images/tab_clum2_icon2.jpg" style="cursor:pointer;margin-left:3px;" class="change2" alt="">
                  </a>
                </div>
                </div>
               </div><?php
             if($i==($len-1))
             {
            ?>
               <div class="Tuesdaybr"></div><?php
             }
             ?>
               <?php }} ?>

                <?php 
               if(empty($doc[0][Wed])){
               ?>
                 <div class="row shows" style="border-bottom:2px solid #f0f0f0;padding-bottom:8px;">
                 <div class="col-md-3 col-sm-3 col-xs-12"><label>&nbsp; <input name="" class="check1 Wednesday"  type="checkbox" value=""> Wednesday </label></div>
                 <div class="col-md-3 col-sm-3 col-xs-12"> <fieldset class="account-text registration days"><input type="text" value="" placeholder="" data-type="text" data-trigger="change" data-required="true" class="input-block-level timeformat1Wed" name="text" id="text" style="min-height:30px;"></fieldset></div>
                 <div class="col-md-3 col-sm-3 col-xs-12"> <fieldset class="account-text registration days"><input type="text" value="" placeholder="" data-type="text" data-trigger="change" data-required="true" class="input-block-level timeformat1Wed" name="text" id="text" style="min-height:30px;"></fieldset></div>
                 <div class="col-md-3 col-sm-3 col-xs-6"> 
                  <div class="actions">
                    <a href="javascript:void(0);">
                     <img src="<?php echo WEB_ROOT?>service/public/images/tab_clum2_icon5.jpg" onclick="Getbrvalue($(this))" style="cursor:pointer;" class="change1" alt="">
                    </a>
                  </div>
                  <div class="actions">
                    <a href="javascript:void(0);">
                     <img src="<?php echo WEB_ROOT?>service/public/images/tab_clum2_icon2.jpg" style="cursor:pointer;margin-left:3px;" class="change2" alt="">
                    </a>
                  </div>
                  <div class="actions">
                    <a href="javascript:void(0);">
                      <img src="<?php echo WEB_ROOT?>service/public/images/tab_clum2_icon4.jpg" class="addNew" style="cursor:pointer;" alt="Wednesday"></div>
                    </a>
                  </div>
                 </div><div class="Wednesdaybr"></div>
                     <?php
               }else{
                $ar=$doc[0][Wed];
                $b=is_multi($doc[0][Wed]);
                        if($b==1){
               foreach($ar as $key=>$value){
                 $startw[]=$value[start];
                 $endsw[]=$value[ends];
               // print_r($value);
               }}
               else{
                 $startw[]=$ar[start];
                 $endsw[]=$ar[ends];
                 }
                 $len=count($startw);
               ?>
                   <?php for($i=0;$i<$len;$i++){ ?> 
                 <div class="row exist" style="border-bottom:2px solid #f0f0f0;padding-bottom:8px;">
                 <div class="col-md-3 col-sm-3 col-xs-12"><label> &nbsp; <input name="" type="checkbox" value=""> Wednesday </label></div>
                
                 <div class="col-md-3 col-sm-3 col-xs-12"> <fieldset class="account-text registration days"><?php echo $startw[$i]?> </fieldset></div>
                 
                 <div class="col-md-3 col-sm-3 col-xs-12"> <fieldset class="account-text registration days"><?php echo $endsw[$i]?></fieldset> </div>
                 <div class="col-md-3 col-sm-3 col-xs-6"> 
                  <div class="actions">
                    <a href="javascript:void(0);">
                    <img src="<?php echo WEB_ROOT?>service/public/images/tab_clum2_icon1.jpg" style="cursor:pointer;" class="change" alt="">
                    </a>
                  </div> 
                  <div class="actions">
                    <a href="javascript:void(0);">
                     <img src="<?php echo WEB_ROOT?>service/public/images/tab_clum2_icon2.jpg" class="removeBreak" style="cursor:pointer;" alt="">
                    </a>
                  </div>
                     <?php
               if($i==($len-1))
               {
              ?>  
                <div class="actions">
                  <a href="javascript:void(0);">
                    <img src="<?php echo WEB_ROOT?>service/public/images/tab_clum2_icon4.jpg" style="cursor:pointer;" class="addNew" alt="Wednesday">
                  </a>
                </div>
                    <?php
               }
               ?></div>
                 </div>
                 
                  <div class="row shows" style="border-bottom:2px solid #f0f0f0;padding-bottom:8px;display:none">
                 <div class="col-md-3 col-sm-3 col-xs-12"><label>&nbsp; <input name="" class="check1 Wednesday" <?php if(!($startw[$i]=='none')){echo "checked";} ?>  type="checkbox" value=""> Wednesday </label></div>
                 <div class="col-md-3 col-sm-3 col-xs-12"> <fieldset class="account-text registration days"><input type="text" value="<?php echo $startw[$i]?>" placeholder="" data-type="text" data-trigger="change" data-required="true" class="input-block-level timeformat1Wed" name="text" id="text" style="min-height:30px;"></fieldset></div>
                 <div class="col-md-3 col-sm-3 col-xs-12"> <fieldset class="account-text registration days"><input type="text" value="<?php echo $endsw[$i]?>" placeholder="" data-type="text" data-trigger="change" data-required="true" class="input-block-level timeformat1Wed" name="text" id="text" style="min-height:30px;"></fieldset></div>
                 <div class="col-md-3 col-sm-3 col-xs-6"> 
                  <div class="actions">
                    <a href="javascript:void(0);"> 
                      <img src="<?php echo WEB_ROOT?>service/public/images/tab_clum2_icon5.jpg" onclick="Getbrvalue($(this))" style="cursor:pointer;" class="change1" alt="">
                    </a>
                  </div> 
                  <div class="actions">
                    <a href="javascript:void(0);">
                      <img src="<?php echo WEB_ROOT?>service/public/images/tab_clum2_icon2.jpg" style="cursor:pointer;margin-left:3px;" class="change2" alt="">
                    </a>
                  </div>
                 </div>
                 </div><?php
               if($i==($len-1))
               {
              ?> 
                 <div class="Wednesdaybr"></div>
                 <?php }}} ?>
                 
                  <?php 
               if(empty($doc[0][Thu])){
               ?>
                 <div class="row shows" style="border-bottom:2px solid #f0f0f0;padding-bottom:8px;">
                 <div class="col-md-3 col-sm-3 col-xs-12"> <label> &nbsp;<input name="" class="check1 Thursday"  type="checkbox" value=""> Thursday </label></div>                 <div class="col-md-3 col-sm-3 col-xs-12"> <fieldset class="account-text registration days"><input type="text" value="" placeholder="" data-type="text" data-trigger="change" data-required="true" class="input-block-level timeformat1Thu" name="text" id="text" style="min-height:30px;"></fieldset></div>
                 <div class="col-md-3 col-sm-3 col-xs-12"> <fieldset class="account-text registration days"><input type="text" value="" placeholder="" data-type="text" data-trigger="change" data-required="true" class="input-block-level timeformat1Thu" name="text" id="text" style="min-height:30px;"></fieldset></div>
                 <div class="col-md-3 col-sm-3 col-xs-6">  
                  <div class="actions">
                    <a href="javascript:void(0);">
                      <img src="<?php echo WEB_ROOT?>service/public/images/tab_clum2_icon5.jpg" onclick="Getbrvalue($(this))" style="cursor:pointer;" class="change1" alt="">
                    </a>
                  </div> 
                  <div class="actions">
                    <a href="javascript:void(0);">
                      <img src="<?php echo WEB_ROOT?>service/public/images/tab_clum2_icon2.jpg" style="cursor:pointer;margin-left:3px;" class="change2" alt=""><img src="<?php echo WEB_ROOT?>service/public/images/tab_clum2_icon4.jpg" class="addNew" style="cursor:pointer;" alt="Thursday">
                    </a>
                  </div>
                 </div>
                 </div><div class="Thursdaybr"></div>
                     <?php
               }else{
                $ar=$doc[0][Thu];
                $b=is_multi($doc[0][Thu]);
                        if($b==1){
               foreach($ar as $key=>$value){
                 $startt[]=$value[start];
                 $endst[]=$value[ends];
               // print_r($value);
               }}
               else{
                 $startt[]=$ar[start];
                 $endst[]=$ar[ends];
                 }
                 $len=count($startt);
               ?>
                   <?php for($i=0;$i<$len;$i++){ ?> 
                 <div class="row exist" style="border-bottom:2px solid #f0f0f0;padding-bottom:8px;">
                 <div class="col-md-3 col-sm-3 col-xs-12"><label>&nbsp; <input name="" type="checkbox" value=""> Thursday </label></div>
                
                 <div class="col-md-3 col-sm-3 col-xs-12"> <fieldset class="account-text registration days"><?php echo $startt[$i]?></fieldset> </div>
                 
                 <div class="col-md-3 col-sm-3 col-xs-12"> <fieldset class="account-text registration days"><?php echo $endst[$i]?></fieldset> </div>
                 <div class="col-md-3 col-sm-3 col-xs-6">  
                  <div class="actions">
                    <a href="javascript:void(0);">
                      <img src="<?php echo WEB_ROOT?>service/public/images/tab_clum2_icon1.jpg" style="cursor:pointer;" class="change" alt=""> 
                    </a>
                  </div>
                  <div class="actions">
                    <a href="javascript:void(0);">
                      <ig src="<?php echo WEB_ROOT?>service/public/images/tab_clum2_icon2.jpg" class="removeBreak" style="cursor:pointer;" alt="">
                    </a>
                  </div>
                        <?php
               if($i==($len-1))
               {
              ?>  
                <div class="actions">
                  <a href="javascript:void(0);">
                    <img src="<?php echo WEB_ROOT?>service/public/images/tab_clum2_icon4.jpg" class="addNew" style="cursor:pointer;" alt="Thursday">
                  </a>
                </div>
                    <?php
               }
               ?></div>
                 </div>
                 
                  <div class="row shows" style="border-bottom:2px solid #f0f0f0;padding-bottom:8px;display:none">
                 <div class="col-md-3 col-sm-3 col-xs-12"><label> &nbsp;<input name="" type="checkbox" class="check1 Thursday" <?php if(!($startt[$i]=='none')){echo "checked";} ?>  value=""> Thursday </label></div>
                 <div class="col-md-3 col-sm-3 col-xs-12"> <fieldset class="account-text registration days"><input type="text" value="<?php echo $startt[$i]?>" placeholder="" data-type="text" data-trigger="change" data-required="true" class="input-block-level timeformat1Thu" name="text" id="text" style="min-height:30px;"></fieldset></div>
                 <div class="col-md-3 col-sm-3 col-xs-12"> <fieldset class="account-text registration days"><input type="text" value="<?php echo $endst[$i]?>" placeholder="" data-type="text" data-trigger="change" data-required="true" class="input-block-level timeformat1Thu" name="text" id="text" style="min-height:30px;"></fieldset></div>
                 <div class="col-md-3 col-sm-3 col-xs-6">  
                  <div class="actions">
                    <a href="javascript:void(0);">
                      <img src="<?php echo WEB_ROOT?>service/public/images/tab_clum2_icon5.jpg" onclick="Getbrvalue($(this))" style="cursor:pointer;" class="change1" alt="">
                    </a>
                  </div> 
                  <div class="actions">
                    <a href="javascript:void(0);">
                      <img src="<?php echo WEB_ROOT?>service/public/images/tab_clum2_icon2.jpg" style="cursor:pointer;margin-left:3px;" class="change2" alt="">
                    </a>
                  </div>
                 </div>
                 </div><?php
               if($i==($len-1))
               {
              ?>
                 <div class="Thursdaybr"></div>
                 <?php }} } ?>
                 
                    <?php 
               if(empty($doc[0][Fri])){
               ?>
                 <div class="row shows" style="border-bottom:2px solid #f0f0f0;padding-bottom:8px;">
                 <div class="col-md-3 col-sm-3 col-xs-12"><label>&nbsp; <input name="" class="check1 Friday"  type="checkbox" value=""> Friday </label></div>
                 <div class="col-md-3 col-sm-3 col-xs-12"> <fieldset class="account-text registration days"><input type="text" value="" placeholder="" data-type="text" data-trigger="change" data-required="true" class="input-block-level timeformat1Fri" name="text" id="text" style="min-height:30px;"></fieldset></div>
                 <div class="col-md-3 col-sm-3 col-xs-12"> <fieldset class="account-text registration days"><input type="text" value="" placeholder="" data-type="text" data-trigger="change" data-required="true" class="input-block-level timeformat1Fri" name="text" id="text" style="min-height:30px;"></fieldset></div>
                 <div class="col-md-3 col-sm-3 col-xs-6">  
                  <div class="actions">
                    <a href="javascript:void(0);">
                      <img src="<?php echo WEB_ROOT?>service/public/images/tab_clum2_icon5.jpg" onclick="Getbrvalue($(this))" style="cursor:pointer;" class="change1" alt="">
                    </a>
                  </div> 
                  <div class="actions">
                    <a href="javascript:void(0);">
                      <img src="<?php echo WEB_ROOT?>service/public/images/tab_clum2_icon2.jpg" style="cursor:pointer;margin-left:3px;" class="change2" alt=""><img src="<?php echo WEB_ROOT?>service/public/images/tab_clum2_icon4.jpg" class="addNew" style="cursor:pointer;" alt="Friday">
                    </a>
                  </div>
                 </div>
                 </div><div class="Fridaybr"></div>
                     <?php
               }else{
                $ar=$doc[0][Fri];
                $b=is_multi($doc[0][Fri]);
                        if($b==1){
               foreach($ar as $key=>$value){
                 $startf[]=$value[start];
                 $endsf[]=$value[ends];
               // print_r($value);
               }}
               else{
                 $startf[]=$ar[start];
                 $endsf[]=$ar[ends];
                 }
                 $len=count($startf);
               ?>
                   <?php for($i=0;$i<$len;$i++){ ?> 
                 <div class="row exist" style="border-bottom:2px solid #f0f0f0;padding-bottom:8px;">
                 <div class="col-md-3 col-sm-3 col-xs-12"><label> &nbsp; <input name="" type="checkbox" value=""> Friday </label></div>
                
                 <div class="col-md-3 col-sm-3 col-xs-12"> <fieldset class="account-text registration days"><?php echo $startf[$i]?> </fieldset></div>
                 
                 <div class="col-md-3 col-sm-3 col-xs-12"> <fieldset class="account-text registration days"><?php echo $endsf[$i]?> </fieldset></div>
                 <div class="col-md-3 col-sm-3 col-xs-6">  
                  <div class="actions">
                    <a href="javascript:void(0);">
                      <img src="<?php echo WEB_ROOT?>service/public/images/tab_clum2_icon1.jpg" style="cursor:pointer;" class="change" alt=""> 
                    </a>
                  </div>
                  <div class="actions">
                    <a href="javascript:void(0);">
                      <img src="<?php echo WEB_ROOT?>service/public/images/tab_clum2_icon2.jpg" class="removeBreak" style="cursor:pointer;" alt="">
                    </a>
                  </div>
                      <?php
               if($i==($len-1))
               {
              ?>  
                <div class="actions">
                  <a href="javascript:void(0);">
                    <img src="<?php echo WEB_ROOT?>service/public/images/tab_clum2_icon4.jpg" class="addNew" style="cursor:pointer;" alt="Friday">
                  </a>
                </div>
                    <?php
               }
               ?></div>
                 </div>
                 
                  <div class="row shows" style="border-bottom:2px solid #f0f0f0;padding-bottom:8px;display:none">
                 <div class="col-md-3 col-sm-3 col-xs-12"><label> &nbsp; <input name="" type="checkbox" class="check1 Friday" <?php if(!($startf[$i]=='none')){echo "checked";} ?>  value=""> Friday </label></div>
                 <div class="col-md-3 col-sm-3 col-xs-12"> <fieldset class="account-text registration days"><input type="text" value="<?php echo $startf[$i]?>" placeholder="" data-type="text" data-trigger="change" data-required="true" class="input-block-level timeformat1Fri" name="text" id="text" style="min-height:30px;"></fieldset></div>
                 <div class="col-md-3 col-sm-3 col-xs-12"> <fieldset class="account-text registration days"><input type="text" value="<?php echo $endsf[$i]?>" placeholder="" data-type="text" data-trigger="change" data-required="true" class="input-block-level timeformat1Fri" name="text" id="text" style="min-height:30px;"></fieldset></div>
                 <div class="col-md-3 col-sm-3 col-xs-6">  
                  <div class="actions">
                    <a href="javascript:void(0);">
                      <img src="<?php echo WEB_ROOT?>service/public/images/tab_clum2_icon5.jpg" onclick="Getbrvalue($(this))" style="cursor:pointer;" class="change1" alt="">
                    </a>
                  </div>
                  <div class="actions">
                    <a href="javascript:void(0);">  
                      <img src="<?php echo WEB_ROOT?>service/public/images/tab_clum2_icon2.jpg" style="cursor:pointer;margin-left:3px;" class="change2" alt="">
                    </a>
                  </div>
                 </div>
                 </div><?php
               if($i==($len-1))
               {
              ?>
                 <div class="Fridaybr"></div>
                 <?php }} }?>
                 
                 <?php 
               if(empty($doc[0][Sat])){
               ?>
                 <div class="row shows" style="border-bottom:2px solid #f0f0f0;padding-bottom:8px;">
                 <div class="col-md-3 col-sm-3 col-xs-12"><label> <input name="" class="check1 Saturday"  type="checkbox" value=""> Saturday </label></div>
                 <div class="col-md-3 col-sm-3 col-xs-12"> <fieldset class="account-text registration days"><input type="text" value="" placeholder="" data-type="text" data-trigger="change" data-required="true" class="input-block-level timeformat1Sat" name="text" id="text" style="min-height:30px;"></fieldset></div>
                 <div class="col-md-3 col-sm-3 col-xs-12"> <fieldset class="account-text registration days"><input type="text" value="" placeholder="" data-type="text" data-trigger="change" data-required="true" class="input-block-level timeformat1Sat" name="text" id="text" style="min-height:30px;"></fieldset></div>
                 <div class="col-md-3 col-sm-3 col-xs-6">  
                  <div class="actions">
                    <a href="javascript:void(0);">
                      <img src="<?php echo WEB_ROOT?>service/public/images/tab_clum2_icon5.jpg" onclick="Getbrvalue($(this))" style="cursor:pointer;" class="change1" alt="">
                    </a>
                  </div> 
                  <div class="actions">
                    <a href="javascript:void(0);">
                      <img src="<?php echo WEB_ROOT?>service/public/images/tab_clum2_icon2.jpg" style="cursor:pointer;margin-left:3px;" class="change2" alt=""><img src="<?php echo WEB_ROOT?>service/public/images/tab_clum2_icon4.jpg" class="addNew" style="cursor:pointer;" alt="Saturday">
                    </a>
                  </div>
                 </div>
                 </div><div class="Saturdaybr"></div>
                     <?php
               }else{
                $ar=$doc[0][Sat];
                $b=is_multi($doc[0][Sat]);
                        if($b==1){
               foreach($ar as $key=>$value){
                 $startsa[]=$value[start];
                 $endssa[]=$value[ends];
               // print_r($value);
               }}
               else{
                 $startsa[]=$ar[start];
                 $endssa[]=$ar[ends];
                 }
                 $len=count($startsa);
               ?>
                   <?php for($i=0;$i<$len;$i++){ ?> 
                 <div class="row exist" style="border-bottom:2px solid #f0f0f0;padding-bottom:8px;">
                 <div class="col-md-3 col-sm-3 col-xs-12"><label> &nbsp; <input name="" type="checkbox" value=""> Saturday </label></div>
                
                 <div class="col-md-3 col-sm-3 col-xs-12"> <fieldset class="account-text registration days"><?php echo $startsa[$i]?></fieldset> </div>
                 
                 <div class="col-md-3 col-sm-3 col-xs-12"> <fieldset class="account-text registration days"><?php echo $endssa[$i]?></fieldset> </div>
                 <div class="col-md-3 col-sm-3 col-xs-6">  
                  <div class="actions">
                    <a href="javascript:void(0);">
                      <img src="<?php echo WEB_ROOT?>service/public/images/tab_clum2_icon1.jpg" style="cursor:pointer;" class="change" alt=""> 
                    </a>
                  </div> 
                  <div class="actions">
                    <a href="javascript:void(0);">
                      <img src="<?php echo WEB_ROOT?>service/public/images/tab_clum2_icon2.jpg" class="removeBreak" style="cursor:pointer;" alt="">
                    </a>
                  </div>
                    <?php
               if($i==($len-1))
               {
              ?>  
                <div class="actions">
                  <a href="javascript:void(0);">
                    <img src="<?php echo WEB_ROOT?>service/public/images/tab_clum2_icon4.jpg" class="addNew" style="cursor:pointer;" alt="Saturday">
                  </a>
                </div>
                    <?php
               }
               ?></div>
                 </div>
                 
                  <div class="row shows" style="border-bottom:2px solid #f0f0f0;padding-bottom:8px;display:none">
                 <div class="col-md-3 col-sm-3 col-xs-12"><label>&nbsp; <input name="" type="checkbox" class="check1 Saturday" <?php if(!($startsa[$i]=='none')){echo "checked";} ?>  value=""> Saturday </label></div>
                 <div class="col-md-3 col-sm-3 col-xs-12"> <fieldset class="account-text registration days"><input type="text" value="<?php echo $startsa[$i]?>" placeholder="" data-type="text" data-trigger="change" data-required="true" class="input-block-level timeformat1Sat" name="text" id="text" style="min-height:30px;"></fieldset></div>
                 <div class="col-md-3 col-sm-3 col-xs-12"> <fieldset class="account-text registration days"><input type="text" value="<?php echo $endssa[$i]?>" placeholder="" data-type="text" data-trigger="change" data-required="true" class="input-block-level timeformat1Sat" name="text" id="text" style="min-height:30px;"></fieldset></div>
                 <div class="col-md-3 col-sm-3 col-xs-6">  
                  <div class="actions">
                    <a href="javascript:void(0);">
                      <img src="<?php echo WEB_ROOT?>service/public/images/tab_clum2_icon5.jpg" onclick="Getbrvalue($(this))" style="cursor:pointer;" class="change1" alt="">
                    </a>
                  </div> 
                  <div class="actions">
                    <a href="javascript:void(0);">
                      <img src="<?php echo WEB_ROOT?>service/public/images/tab_clum2_icon2.jpg" style="cursor:pointer;margin-left:3px;" class="change2" alt="">
                    </a>
                  </div>
                 </div>
                 </div>
                 <?php
               if($i==($len-1))
               {
              ?>
                 <div class="Saturdaybr"></div>
                 <?php }}} ?>
                 
                 <?php 
               if(empty($doc[0][Sun])){
               ?>
                 <div class="row shows" style="border-bottom:2px solid #f0f0f0;padding-bottom:8px;">
                 <div class="col-md-3 col-sm-3 col-xs-12"><label> &nbsp; <input name="" class="check1 Sunday"  type="checkbox" value=""> Sunday </label></div>
                 <div class="col-md-3 col-sm-3 col-xs-12"> <fieldset class="account-text registration days"><input type="text" value="" placeholder="" data-type="text" data-trigger="change" data-required="true" class="input-block-level timeformat1Sun" name="text" id="text" style="min-height:30px;"></fieldset></div>
                 <div class="col-md-3 col-sm-3 col-xs-12"> <fieldset class="account-text registration days"><input type="text" value="" placeholder="" data-type="text" data-trigger="change" data-required="true" class="input-block-level timeformat1Sun" name="text" id="text" style="min-height:30px;"></fieldset></div>
                 <div class="col-md-3 col-sm-3 col-xs-6">  
                  <div class="actions">
                    <a href="javascript:void(0);">
                      <img src="<?php echo WEB_ROOT?>service/public/images/tab_clum2_icon5.jpg" onclick="Getbrvalue($(this))" style="cursor:pointer;" class="change1" alt="">
                    </a>
                  </div> 
                  <div class="actions">
                    <a href="javascript:void(0);">
                      <img src="<?php echo WEB_ROOT?>service/public/images/tab_clum2_icon2.jpg" style="cursor:pointer;margin-left:3px;" class="change2" alt=""><img src="<?php echo WEB_ROOT?>service/public/images/tab_clum2_icon4.jpg" class="addNew" style="cursor:pointer;" alt="Sunday">
                    </a>
                  </div>
                 </div>
                 </div><div class="Sundaybr"></div>
                     <?php
               }else{
                $ar=$doc[0][Sun];
                $b=is_multi($doc[0][Sun]);
                        if($b==1){
               foreach($ar as $key=>$value){
                 $startsu[]=$value[start];
                 $endssu[]=$value[ends];
               // print_r($value);
               }}
               else{
                 $startsu[]=$ar[start];
                 $endssu[]=$ar[ends];
                 }
                 $len=count($startsu);
               ?>
                   <?php for($i=0;$i<$len;$i++){ ?> 
                 <div class="row exist" style="border-bottom:2px solid #f0f0f0;padding-bottom:8px;">
                 <div class="col-md-3 col-sm-3 col-xs-12"><label>&nbsp; <input name="" type="checkbox"  value=""> Sunday </label></div>
                
                 <div class="col-md-3 col-sm-3 col-xs-12"> <fieldset class="account-text registration days"><?php echo $startsu[$i]?></fieldset> </div>
                 
                 <div class="col-md-3 col-sm-3 col-xs-12"> <fieldset class="account-text registration days"><?php echo $endssu[$i]?></fieldset> </div>
                 <div class="col-md-3 col-sm-3 col-xs-6">  
                  <div class="actions">
                    <a href="javascript:void(0);">
                      <img src="<?php echo WEB_ROOT?>service/public/images/tab_clum2_icon1.jpg" style="cursor:pointer;" class="change" alt=""> 
                    </a>
                  </div> 
                  <div class="actions">
                    <a href="javascript:void(0);">
                      <img src="<?php echo WEB_ROOT?>service/public/images/tab_clum2_icon2.jpg" class="removeBreak" style="cursor:pointer;" alt="">
                    </a>
                  </div>
                      <?php
               if($i==($len-1))
               {
              ?>  
                <div class="actions">
                  <a href="javascript:void(0);">
                    <img src="<?php echo WEB_ROOT?>service/public/images/tab_clum2_icon4.jpg" class="addNew" style="cursor:pointer;" alt="Sunday">
                  </a>
                </div>
                    <?php
               }
               ?></div>
                 </div>
                 
                  <div class="row shows" style="border-bottom:2px solid #f0f0f0;padding-bottom:8px;display:none">
                 <div class="col-md-3 col-sm-3 col-xs-12"><label> &nbsp; <input name="" type="checkbox" class="check1 Sunday" <?php if(!($startsu[$i]=='none')){echo "checked";} ?>  value=""> Sunday </label></div>
                 <div class="col-md-3 col-sm-3 col-xs-12"> <fieldset class="account-text registration days"><input type="text" value="<?php echo $startsu[$i]?>" placeholder="" data-type="text" data-trigger="change" data-required="true" class="input-block-level timeformat1Sun" name="text" id="text" style="min-height:30px;"></fieldset></div>
                 <div class="col-md-3 col-sm-3 col-xs-12"> <fieldset class="account-text registration days"><input type="text" value="<?php echo $endssu[$i]?>" placeholder="" data-type="text" data-trigger="change" data-required="true" class="input-block-level timeformat1Sun" name="text" id="text" style="min-height:30px;"></fieldset></div>
                 <div class="col-md-3 col-sm-3 col-xs-6">  
                  <div class="actions">
                    <a href="javascript:void(0);">
                      <img src="<?php echo WEB_ROOT?>service/public/images/tab_clum2_icon5.jpg" onclick="Getbrvalue($(this))" style="cursor:pointer;" class="change1" alt="">
                    </a>
                  </div> 
                  <div class="actions">
                    <a href="javascript:void(0);">
                      <img src="<?php echo WEB_ROOT?>service/public/images/tab_clum2_icon2.jpg" style="cursor:pointer;margin-left:3px;" class="change2" alt="">
                    </a>
                  </div>
                    </div>
                 </div><?php
               if($i==($len-1))
               {
              ?>
                 <div class="Sundaybr"></div>
                 <?php }}} ?>
         </div>


         <div id="doc-imageupload" style="display: block;">
            <!-- Second  -->
                     <div id="update_error2" style="margin-top:20px;display:none;text-align:center;" class="alert alert-error">Update Failed.</div>
                     <div id="update_succes2" style="margin-top:20px;display:none;text-align:center;" class="alert alert-success">Successfully Updated.</div>
                     <div style="background-color:#ececec;margin:0;" class="row ">
                      <div class="col-md-2 col-sm-2 col-xs-2 ">
                          
                              <div class="starting"><p>Start Date</p></div><br>

                      </div>
                      <div class="col-md-2 col-sm-2 col-xs-2">
                           <div class="starting"><p>End Date</p></div><br>
                   
                      </div>
                      <div class="col-md-2 col-sm-2 col-xs-2">
                            <div class="starting"><p>Start Time</p></div><br>

                      </div>
                      <div class="col-md-2 col-sm-2 col-xs-2">
                            <div class="starting"><p>End Time</p></div><br>

                      </div>
                      <div class="col-md-2 col-sm-2 col-xs-2">
                            <div class="starting"><p>Actions</p></div><br>

                      </div>
                       <div class="col-md-2 col-sm-2 col-xs-2">
                            <div class="starting"><p></p></div><br>

                      </div>
                  </div>
                        <div style="border-bottom:2px solid #f0f0f0;padding-bottom:8px;margin:0;" class="row vecation">
                        </div>
                        <?php 
                           if(!empty($vecation)){
                           foreach($vecation_arr as $key=>$value){
                            $leng=count($value);
                           }
                           for($jk=0;$jk<$leng;$jk++){
                           ?>
                        <div style="border-bottom:2px solid #f0f0f0;padding-bottom:8px;margin:0;" class="row">
                           <!--<div class="tab_clum2_frm_day"> <input name="" type="checkbox" value=""> Monday </div>-->
                          <div class="col-md-2 col-sm-6 col-xs-12 "> 
                            <fieldset class="account-text end">
                              <?php echo $value[$jk][startdate]; ?>
                            </fieldset>
                          </div>
                           <div class="col-md-2 col-sm-6 col-xs-12 "> 
                            <fieldset class="account-text end">
                              <?php echo $value[$jk][enddate]; ?>
                            </fieldset>
                          </div>
                          <div class="col-md-2 col-sm-6 col-xs-12 "> 
                            <fieldset class="account-text end">
                              <?php echo $value[$jk][starttime]; ?>
                            </fieldset>
                          </div>
                          <div class="col-md-2 col-sm-6 col-xs-12 "> 
                            <fieldset class="account-text end">
                              <?php echo $value[$jk][endtime]; ?>  
                            </fieldset>
                          </div>
                           <div class="col-md-2 col-sm-6 col-xs-6"> 
                            <div class="actions">
                              <a href="javascript:void(0);">
                                <img src="<?php echo WEB_ROOT?>service/public/images/tab_clum2_icon1.jpg" style="cursor:pointer;" class="change" alt="">
                              </a>
                            </div>
                            <div class="actions">
                              <a href="javascript:void(0);">
                                <img src="<?php echo WEB_ROOT?>service/public/images/tab_clum2_icon2.jpg" class="removeVecation" style="cursor:pointer;" alt="">
                              </a>
                            </div><?php
                              if($jk==($leng-1))
                              {
                              ?>
                            <div class="actions">
                              <a href="javascript:void(0);">
                                <img src="<?php echo WEB_ROOT?>service/public/images/tab_clum2_icon4.jpg" class="setVecation" style="cursor:pointer;" alt="Sunday">
                              </a>
                            </div>
                              <?php } ?>
                           </div>
                        </div>
                        <div class="row shows" style="display:none">
                           <!--<div class="tab_clum2_frm_day"> <input name="" type="checkbox" value=""> Sunday </div>-->
                          <div class="col-md-2 col-sm-6 col-xs-12 "> 
                            <fieldset class="account-text end">
                              <input type="text" value="<?php echo $value[$jk][startdate]; ?>" data-trigger="mouseleave" data-required="true" data-beatpicker="true" name="dob" id="dob" placeholder="DD-MM-YY" class="input-block-level startdate date-field-required" style="min-height:30px;"/> 
                            </fieldset>
                          </div>
                          <div class="col-md-2 col-sm-6 col-xs-12 "> 
                            <fieldset class="account-text end">
                              <input type="text" value="<?php echo $value[$jk][enddate]; ?>" data-trigger="mouseleave" data-required="true" data-beatpicker="true" name="dob" id="dob" placeholder="DD-MM-YY" class="input-block-level enddate date-field-required" style="min-height:30px;"/>
                            </fieldset>
                            </div>
                          <div class="col-md-2 col-sm-6 col-xs-12 "> 
                            <fieldset class="account-text end">
                              <input type="text" value="<?php echo $value[$jk][starttime]; ?>" placeholder="" data-type="text" value="" data-trigger="change" data-required="true" class="input-block-level starttime timeformat date-field-required" name="text" id="text" style="min-height:30px;">
                            </fieldset>
                          </div>
                          <div class="col-md-2 col-sm-6 col-xs-12 "> 
                            <fieldset class="account-text end">
                              <input type="text" value="<?php echo $value[$jk][endtime]; ?>" placeholder="" data-type="text" value="" data-trigger="change" data-required="true" class="input-block-level endtime timeformat date-field-required" name="text" id="text" style="min-height:30px;">
                            </fieldset>
                          </div>
                           <div class="col-md-2 col-sm-6 col-xs-6"> 
                            <div class="actions">
                              <a href="javascript:void(0);">
                                <img src="<?php echo WEB_ROOT?>service/public/images/tab_clum2_icon5.jpg" style="cursor:pointer;" class="savevecation1" alt="">
                                </a>
                            </div>
                            <div class="actions">
                              <a href="javascript:void(0);">
                                <img src="<?php echo WEB_ROOT?>service/public/images/tab_clum2_icon2.jpg"  style="cursor:pointer;margin-left:3px;" class="change2" alt="">
                              </a>
                            </div></div>
                        </div>
                        <?php }
                           } else {?>
                        <div class="row shows" >
                           <!--<div class="tab_clum2_frm_day"> <input name="" type="checkbox" value=""> Sunday </div>-->
                          <div class="col-md-2 col-sm-6 col-xs-12 "> 
                            <fieldset class="account-text end">
                              <input type="text"  data-trigger="mouseleave" data-required="true" data-beatpicker="true" name="dob" id="dob" placeholder="DD-MM-YY" class="input-block-level startdate date-field-required" style="min-height:30px;"/> 
                            </fieldset>
                          </div>
                          <div class="col-md-2 col-sm-6 col-xs-12 "> 
                            <fieldset class="account-text end">
                              <input type="text"  data-trigger="mouseleave" data-required="true" data-beatpicker="true" name="dob" id="dob" placeholder="DD-MM-YY" class="input-block-level enddate date-field-required" style="min-height:30px;"/>
                            </fieldset>
                          </div>
                          <div class="col-md-2 col-sm-6 col-xs-12 "> 
                            <fieldset class="account-text end">
                              <input type="text"  placeholder="" data-type="text" value="" data-trigger="change" data-required="true" class="input-block-level starttime timeformat date-field-required" name="text" id="text" style="min-height:30px;">
                            </fieldset>
                          </div>
                          <div class="col-md-2 col-sm-6 col-xs-12 "> 
                            <fieldset class="account-text end">
                              <input type="text"  placeholder="" data-type="text" value="" data-trigger="change" data-required="true" class="input-block-level endtime timeformat date-field-required" name="text" id="text" style="min-height:30px;">
                            </fieldset>
                          </div>
                           <div class="col-md-2 col-sm-6 col-xs-6"> 
                            <div class="actions">
                              <a href="javascript:void(0);">
                                <img src="<?php echo WEB_ROOT?>service/public/images/tab_clum2_icon5.jpg" style="cursor:pointer;" class="savevecation1" alt="">
                              </a>
                            </div>
                            <div class="actions">
                              <a href="javascript:void(0);">
                                <img src="<?php echo WEB_ROOT?>service/public/images/tab_clum2_icon2.jpg" style="cursor:pointer;margin-left:3px;" class="change2" alt="">
                              </a>
                            </div>
                            <div class="actions">
                              <a href="javascript:void(0);">
                                <img src="<?php echo WEB_ROOT?>service/public/images/tab_clum2_icon4.jpg" class="setVecation" style="cursor:pointer;" alt="Sunday">
                              </a>
                            </div></div>
                        </div>
                        <?php }?>
                     </div>
         </div>
         <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8">
            </div>
            <div class="col-md-2"></div>
         </div>
      </div>
   </div>
</div>

<?php include("service/ui/common/footer.php"); ?>
