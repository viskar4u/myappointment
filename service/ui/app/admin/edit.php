 <?php
   include(APP_PATH."service/ui/common/admin_header.php");
   ?>
<?php include("conf/config.inc.php");
include("check_fields.php");
?>

<style>
  .con .form-group {
    background: #cdcdcd none repeat scroll 0 0;
    margin-bottom: 1px;
    padding: 10px;
}
#myModal .modal-content{background: transparent;}
#myModal .close{color:#fff;opacity: 1;}
#myModal .con .btn-primary{float: right;margin-top: 5px;}
.popup_load {
    background: rgba(0, 0, 0, 0) url("<?php echo WEB_ROOT."service/public";?>/images/ajax-loader.GIF") no-repeat scroll 0 0;
    height: 100px;
    margin: 4% 42% 4% auto;
    width: 102px;
}
.detail-box {
    border: 1px solid #cdcdcd;
    padding: 0 0 0 10px;
}
</style>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            <?php echo strtoupper(str_replace("_"," ",base64_decode($_GET['tb'])));
            $visited_page = $_SERVER['HTTP_REFERER'];
            ?>
          </h1>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
              <div class="box box-primary">
                <div class="box-header">
                  
                </div><!-- /.box-header -->
                <div class="box-body ">
                  <form id='form-table'>
                  <?php 
                    $table=base64_decode($_GET['tb']);
                    //$table=$_GET['tb'];
                  $id=base64_decode($_GET['id']);
                 // $id=$_GET['id'];
                     $result1 = $scad->get_td_data1($table,$id);
                   $result = $scad->get_td_data($table,$id);
                   ?>
                   <!-- test new one -->
                   <?php  $start = empty($id)? 1:0; $count=0;?>
                   <?php for($i=$start;$i<count($result1);$i++){
                    
                    $data[]=check_field($result1[$i]['Field'],$result1[$i]['Type'],$result1[$i]['Key'],$result[$result1[$i]['Field']],$result1[$i]['Comment'],$_GET['type']);
                   

                   }
                   ?>
                   <?php 
                    for($i=0;$i<count($data) ;$i++){?>
                 <div class='row'>
                    <div class='col-md-6'>
                   <?php  if($i % 2 == 0){ 
                    echo $data[$i];
                    $i++; 
                  }?>
                    </div>
                    <div class='col-md-6'>
                       <?php  if($i % 2 != 0){ 
                        echo $data[$i];
                      }?>
                    </div>
                  </div>
                  <?php } ?>
                  <?php 
                  $field_btn =(! empty($id)) ?  "update" :  "create";
                  

                  ?>
                <div class="col-md-12">  
                <a class='btn btn-primary' id='action' action='<?php echo $field_btn; ?>'><?php echo $field_btn; ?> </a>
                </div>
              </form>
              <div class='form-msg col-lg-12' style='margin-top:5px;'></div>
                  </div><!-- /.box-body -->
              </div><!-- /.box -->

              
    
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
     


<!-- Modal -->
<div class="modal fade bs-example-modal-lg" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      
      <div class="modal-body">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <div class="col-lg-12 bg-black disabled color-palette form-group popup_load_div">
        <div style="z-index: 999;" class="popup_load"></div>
      </div>
        <div class="con ">
       </div>
      </div>
    </div>
  </div>
</div>

      <?php include(APP_PATH."service/ui/common/admin_footer.php"); ?>
       <link rel="stylesheet" type="text/css" href="<?php echo WEB_ROOT?>service/public/admin/dist/css/jquery.dataTables.css"> 
    <script src="<?php echo WEB_ROOT?>service/public/admin/dist/js/jquery.dataTables.min.js"></script>
    <script src="<?php echo WEB_ROOT?>service/public/admin/dist/js/dataTables.bootstrap.min.js"></script>
    
    <script src="<?php echo WEB_ROOT?>service/public/admin/dist/js/jquery.datetimepicker.full.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo WEB_ROOT?>service/public/admin/dist/css/jquery.datetimepicker.css"> 
  <script src="<?php echo WEB_ROOT?>service/public/admin/dist/js/select2.full.min.js"></script>
  <link rel="stylesheet" href="<?php echo WEB_ROOT?>service/public/admin/dist/css/select2.min.css">

  <!--<script src="<?php echo WEB_ROOT?>service/public/js/calander_function.js"></script>-->

   <script>
      $(document).ready(function(){
          $('.detail-box').slimScroll({
          height: '100px'
          });
        var city = $('input[name="city"]').val();
        var state = $('input[name="state"]').val();
        if(city==''&&state==''){
          var zip=$('input[name="zipcode"]').val();
            check_location(zip);          
        }
        $('#myModal .popup_load_div').hide();
        $('.pull-right.calender').click(function(){
          $('#myModal .con').hide();
          $('#myModal .popup_load_div').show();
            var f_val=$(this).prev().val();
            var target=$(this).attr('target');
            $.ajax({
              url: SITEURL + 'admin/schedule_calender',
              data:{'f_val':f_val,'target':target},
              action:'get',
              success:function(data){
                $('#myModal .con').html('');
                $('#myModal .con').html(data);
                calander();
                set_pickers();
                setTimeout(function(){
                  $('#myModal .con').fadeIn(3000);
          $('#myModal .popup_load_div').slideUp('fast');
                },3000)
              }
            });
        });

        //checkin popup ajax
        $('.pull-right.checkin').click(function(){
          $('#myModal .con').hide();
          $('#myModal .popup_load_div').show();
          $('#myModal .con').html('');
            var f_val=$(this).prev().val();
            var target=$(this).attr('target');
            $.ajax({
              url: SITEURL + 'admin/schedule_checkin',
              data:{'f_val':f_val,'target':target},
              action:'get',
              success:function(data){
                $('#myModal .con').html('');
                $('#myModal .con').html(data);
                $('.day').datetimepicker({format:'d',timepicker:false,});
                $('.month').datetimepicker({format:'M',timepicker:false});
                $('.year').datetimepicker({format:'Y',timepicker:false});
                checkin();
                setTimeout(function(){
                  $('#myModal .con').fadeIn(3000);
          $('#myModal .popup_load_div').slideUp('fast');
                },3000)
              }
            });
        });

          $.fn.serializeObject = function()
          {
          var o = {};
          var a = this.serializeArray();
          $.each(a, function() {
          if (o[this.name] !== undefined) {
              if (!o[this.name].push) {
                  o[this.name] = [o[this.name]];
              }
              o[this.name].push(this.value || '');
          } else {
              o[this.name] = this.value || '';
          }
          });
          return o;
          };

        function checkin(){
          $(".multi-select").select2();
          $('.registration').click(function(){
            var f_data=$('#myModal .con #Patients_checkin').serializeArray();
            var json_data=JSON.stringify($('#myModal .con #Patients_checkin').serializeObject());
            $('textarea[name="reg_details"]').val(json_data);
            $.ajax({
                  url: SITEURL + 'admin/build_json_data',
                  data:{'f_data':json_data},
                  action:'get',
                  success:function(data1){
                    $('textarea[name="reg_details"]').prev().find('.detail-box').html('');
                    $('textarea[name="reg_details"]').prev().find('.detail-box').html(data1);
                    $('#myModal').modal('hide');
                  }
                });
          });
          $('.medical').click(function(){
            var f_data=$('#myModal .con #Patients_checkin').serializeArray();
            $.ajax({
              url: SITEURL + 'admin/build_json',
              data:{'f_data':f_data},
              action:'get',
              success:function(data){
                $('textarea[name="medical_details"]').val(data);
                $.ajax({
                  url: SITEURL + 'admin/build_json_data',
                  data:{'f_data':data},
                  action:'get',
                  success:function(data1){
                    $('textarea[name="medical_details"]').prev().find('.detail-box').html('');
                    $('textarea[name="medical_details"]').prev().find('.detail-box').html(data1);
                    $('#myModal').modal('hide');
                  }
                });
              }
            });
          });
          $('.insurence').click(function(){
            var f_data=$('#myModal .con #Patients_checkin').serializeArray();
            var json_data=JSON.stringify($('#myModal .con #Patients_checkin').serializeObject());
            $('textarea[name="insurence_details"]').val(json_data);
            $.ajax({
                  url: SITEURL + 'admin/build_json_data',
                  data:{'f_data':json_data},
                  action:'get',
                  success:function(data1){
                    $('textarea[name="insurence_details"]').prev().find('.detail-box').html('');
                    $('textarea[name="insurence_details"]').prev().find('.detail-box').html(data1);
                    $('#myModal').modal('hide');
                  }
                });
          });
        }
//popup functions
  function calander(){
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
             url: SITEURL + 'updateDrvecationTime1',
       data:{"startdate":startdate,"enddate":enddate,"starttime":starttime,"endtime":endtime},
             success: function(res) {
                if(res==1){
          $(".con #update_error2").fadeIn(1000);
          $(".con #update_error2").fadeOut(1500);
        }
        else{
          $(".con #update_succes2").fadeIn(500).delay(1000);
          $(".con #update_succes2").fadeOut(2500);
          setTimeout(function(){
            $('#myModal').modal('hide');
            $('textarea[name="vecation"]').val(res);
             $.ajax({
                  url: SITEURL + 'admin/build_json_data',
                  data:{'f_data':res},
                  action:'get',
                  success:function(data1){
                    $('textarea[name="vecation"]').prev().find('.detail-box').html('');
                    $('textarea[name="vecation"]').prev().find('.detail-box').html(data1);
                    $('#myModal').modal('hide');
                  }
                });
          },3000);
        }
             }
         });
});
                 $(".save").click(function(){
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
  $.ajax({
             type: 'POST',
             url: SITEURL + 'updateDrBrkTime1',
       data:{"Contain": Contain,"total_count":total_count},
             success: function(res) {
                if(res==0){
          $("#update_error1").fadeIn(1000);
          $("#update_error1").fadeOut(1500);
        }
        else{
          $("#update_succes1").fadeIn(500).delay(1000);
          $("#update_succes1").fadeOut(2500);
          setTimeout(function(){
            //$('#myModal').modal('hide');
            $('textarea[name="breaks"]').val(res);
             $.ajax({
                  url: SITEURL + 'admin/build_json_data',
                  data:{'f_data':res},
                  action:'get',
                  success:function(data1){
                    $('textarea[name="breaks"]').prev().find('.detail-box').html('');
                    $('textarea[name="breaks"]').prev().find('.detail-box').html(data1);
                    $('#myModal').modal('hide');
                  }
                });
          },3000);
          
        }
             }
         });
   });
               $(".change").click(function(){
                  $(this).parent().parent().hide(500);
                  $(this).parent().parent().next().show();
                  //$(".show").slideDown();
                  });
    $(".change2").click(function(){
                  $(this).parent().parent().hide();
                  $(this).parent().parent().prev().show(500);
                  //$(".show").slideDown();
                  });
    $(".addNew1").click(function(){
                  var cls = $(this).attr("alt");
                  html=''+'<div class="col-lg-12 form-group " ><div class="col-sm-3"><input name="" class="check1 '+cls+'" type="checkbox" value="'+cls+'"> '+cls+' </div><div class="col-sm-3"> <input type="text" value="" placeholder="" data-type="text" data-trigger="change" data-required="true" class="form-control input-block-level timeformat1" name="text" id="text" style="min-height:30px;"></div><div class="col-sm-3"> <input type="text" value="" placeholder="" data-type="text" data-trigger="change" data-required="true" class="form-control input-block-level timeformat1'+cls+'" name="text" id="text" style="min-height:30px;"></div><div class="col-sm-3"> <img src="<?php echo WEB_ROOT?>service/public/images/tab_clum2_icon5.jpg"  style="cursor:pointer;" class="save" alt=""><img src="<?php echo WEB_ROOT?>service/public/images/tab_clum2_icon2.jpg" style="cursor:pointer;margin-left:3px;" class="change2" alt=""><img src="<?php echo WEB_ROOT?>service/public/images/tab_clum2_icon4.jpg" class="addNew1" style="cursor:pointer;" alt="'+cls+'"></div></div>';
                  html = $("."+cls+"br").html()+html;
                  $("."+cls+"br").html(html);
                  allFunction();set_pickers();
                  });
    $(function() {
                    $('.timeformat').datetimepicker({ format: 'H:i' ,datepicker:false,step: 60/*,'minTime': '2:00am',
    'maxTime': '11:00am'*/});
           <?php
   $k=0;
   foreach($day as $value){
   ?>
          $('.timeformat1<?php echo $days[$k];?>').datetimepicker({ format: 'H:i' ,datepicker:false,step: 30,'minTime': '<?php echo $docwrk[0][$value][start];?>',
    'maxTime': '<?php echo $docwrk[0][$value][ends];?>'});
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
                  $(this).parent().parent().hide();
                  $(this).parent().parent().next().show();
                  });
    $(".change2").click(function(){
                  $(this).parent().parent().hide();
                  $(this).parent().parent().prev().show();
                  });
    $(".addNew").click(function(){
                  var cls = $(this).attr("alt");
                  html=''+'<div class="col-lg-12 form-group " ><div class="col-sm-3"><input name="" class=" check1 '+cls+'" type="checkbox" value="'+cls+'"> '+cls+' </div><div class="col-sm-3"> <input type="text" value="" placeholder="" class="form-control input-block-level timeformat1'+cls+'" name="text" id="text" style="min-height:30px;"></div><div class="col-sm-3"> <input type="text" value="" placeholder="" class="form-control input-block-level timeformat1'+cls+'" name="text" id="text" style="min-height:30px;"></div><div class="col-sm-3"> <img src="<?php echo WEB_ROOT?>service/public/images/tab_clum2_icon5.jpg"  style="cursor:pointer;" class="save" alt=""><img src="<?php echo WEB_ROOT?>service/public/images/tab_clum2_icon2.jpg" style="cursor:pointer;margin-left:3px;" class="change2" alt=""><img src="<?php echo WEB_ROOT?>service/public/images/tab_clum2_icon4.jpg" class="addNew1" style="cursor:pointer;" alt="'+cls+'"></div></div>';
                  html = $("."+cls+"br").html()+html;
                  $("."+cls+"br").html(html);
                  allFunction();set_pickers();
                  });
    $(".setVecation").click(function(){
                  html=''+'<div class="col-xs-12 form-group" ><div class="col-xs-2 col-xs-offset-1"> <input type="text" name="dob" id="dob" placeholder="DD-MM-YY" class="form-control input-block-level startdate" style="min-height:30px;"/></div><div class="col-xs-2"> <input type="text" name="dob" id="dob" placeholder="DD-MM-YY" class="form-control form-control input-block-level enddate" style="min-height:30px;"/></div><div class="col-xs-2"> <input type="text" placeholder="" data-type="text" value="" data-trigger="change" data-required="true" class="form-control input-block-level starttime timeformat" name="text" id="text" style="min-height:30px;"></div><div class="col-xs-2"> <input type="text" placeholder="" value="" class="form-control input-block-level endtime timeformat" name="text" id="text" style="min-height:30px;"></div><div class="col-xs-2"> <img src="<?php echo WEB_ROOT?>service/public/images/tab_clum2_icon5.jpg" style="cursor:pointer;" class="savevecation" alt=""><img src="<?php echo WEB_ROOT?>service/public/images/tab_clum2_icon2.jpg" style="cursor:pointer;margin-left:3px;" class="change2" alt=""></div></div>';
                  html = $(".vecation").html()+html;
                  $(".vecation").html(html);
                  allFunction();
                  set_pickers();
                  });
    $(".removeVecation").click(function(){
                      if(confirm("Are you sure to remove the vecation period?")==true){
                      $(this).parent().parent().next().remove();
                     $(this).parent().parent().remove();
                     
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
       data:{"drId":<?php echo $id=(isset($_GET['id'])) ? base64_decode($_GET['id']) : 0; ?>,"startdate":startdate,"enddate":enddate,"starttime":starttime,"endtime":endtime},
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
                     $(this).parent().parent().next().remove();
                     $(this).parent().parent().remove();
                     
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
             url: SITEURL + 'updateDrBrkTime1',
       data:{"Contain": Contain,"total_count":total_count},
             success: function(res) {
                if(res==0){
          $("#update_error1").fadeIn(1000);
          $("#update_error1").fadeOut(1500);
        }
        else{
          $("#update_succes1").fadeIn(500).delay(1000);
          $("#update_succes1").fadeOut(2500);
          setTimeout(function(){$('#myModal').modal('hide');$('textarea[name="breaks"]').val(res);},3000);
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
             url: SITEURL + 'updateDrvecationTime1',
       data:{"startdate":startdate,"enddate":enddate,"starttime":starttime,"endtime":endtime},
             success: function(res) {
                if(res==0){
          $("#update_error2").fadeIn(1000);
          $("#update_error2").fadeOut(1500);
        }
        else{
          $("#update_succes2").fadeIn(500).delay(1000);
          $("#update_succes2").fadeOut(2500);
          setTimeout(function(){
            $('#myModal').modal('hide');
            $('textarea[name="vecation"]').val(res);
             $.ajax({
                  url: SITEURL + 'admin/build_json_data',
                  data:{'f_data':res},
                  action:'get',
                  success:function(data1){
                    $('textarea[name="vecation"]').prev().find('.detail-box').html('');
                    $('textarea[name="vecation"]').prev().find('.detail-box').html(data1);
                    $('#myModal').modal('hide');
                  }
                });
          },3000);
        }
             }
         });
});
 

$('.change1').click(function(){
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
             url: SITEURL + 'updateDrBrkTime1',
       data:{"Contain": Contain,"total_count":total_count},
             success: function(res) {
                if(res==0){
          $("#update_error1").fadeIn(1000);
          $("#update_error1").fadeOut(1500);
        }
        else{
          $("#update_succes1").fadeIn(500).delay(1000);
          $("#update_succes1").fadeOut(2500);
          setTimeout(function(){
            //$('#myModal').modal('hide');
            $('textarea[name="breaks"]').val(res);
             $.ajax({
                  url: SITEURL + 'admin/build_json_data',
                  data:{'f_data':res},
                  action:'get',
                  success:function(data1){
                    $('textarea[name="breaks"]').prev().find('.detail-box').html('');
                    $('textarea[name="breaks"]').prev().find('.detail-box').html(data1);
                    $('#myModal').modal('hide');
                  }
                });
          },3000);
        }
             }
         });
   });
$('.work_enable').click(function(){
    var Contain = "";
    $(".tab_clum1 :text").each(function(){
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
             url: SITEURL + 'updateDrWorkTime1',
       data:{"Contain": Contain,"drId":<?php echo $id=(isset($_GET['id'])) ? base64_decode($_GET['id']) : 0; ?>},
             success: function(res) {
                if(res==0){
          $(".con #update_error").fadeIn(1000);
          $(".con #update_error").fadeOut(1500);
                  }
        else{
           $(".con #update_succes").fadeIn(500).delay(1000);
          $(".con #update_succes").fadeOut(2500);
          setTimeout(function(){
            //$('#myModal').modal('hide');
            $('textarea[name="working_plan"]').val(res);
             $.ajax({
                  url: SITEURL + 'admin/build_json_data',
                  data:{'f_data':res},
                  action:'get',
                  success:function(data1){
                    $('textarea[name="working_plan"]').prev().find('.detail-box').html('');
                    $('textarea[name="working_plan"]').prev().find('.detail-box').html(data1);
                    $('#myModal').modal('hide');
                  }
                });
          },3000);

        }
             }
         });
});

 
  $(function() {
                    $('.timeformat').datetimepicker({ format: 'H:i' ,datepicker:false,step: 60/*,'minTime': '2:00am',
    'maxTime': '11:00am'*/});
           <?php
   $k=0;
   foreach($day as $value){
   ?>
          $('.timeformat1<?php echo $day[$k];?>').timepicker({ 'timeFormat': 'H:i' ,'step': 30,'minTime': '<?php echo $docwrk[0][$value][start];?>',
    'maxTime': '<?php echo $docwrk[0][$value][ends];?>'});
          <?php $k++;  } ?>
                });
}
function set_pickers(){
  $('.tab_clum1 input[type="text"]').datetimepicker({format:'H:i',datepicker:false,step:60,});
  $('#doc-pass1 input[type="text"]').datetimepicker({format:'H:i',datepicker:false,step:30,});
   $('#doc-imageupload .startdate').datetimepicker({format:'Y-m-d', minDate:'<?php echo date('Y-m-d'); ?>',timepicker:false});
   $('#doc-imageupload .enddate').datetimepicker({format:'Y-m-d',minDate:'<?php echo date('Y-m-d'); ?>',timepicker:false});
   $('#doc-imageupload .timeformat').datetimepicker({format:'H:i',datepicker:false,step:60,});
}
//popup functions

      $(".select2").select2();
        $('.timepicker').datetimepicker({format:'H:i:s',datepicker:false,step:15,});
        $('.datepicker').datetimepicker({format:'Y-m-d',timepicker:false,});
        $('.datetimepicker').datetimepicker();
        $('#action').click(function(){
          $('#form-table').parsley('validate');
        var validation = $('#form-table').parsley('isValid');
        if (validation == true) {
            document.getElementById('action').style.pointerEvents = 'none';
            $("#action").text('Processing...');
          var datas = $('#form-table').serialize();
          $.ajax({
           // url: SITEURL + 'admin/user-update-response/'+datas+'/<?php echo $field_btn."/".$table;?>',
            url: SITEURL + 'admin/user-update-response-test',
            data:{'datas':datas,'action':'<?php echo $field_btn?>','tb':'<?php echo $table?>'},
            action:'get',
            success: function(data) {
              if(data==0){
                $("#action").text('<?php echo $field_btn;?>');
          document.getElementById('action').style.pointerEvents = 'auto'; 
                  $('.form-msg').html('');
                $('.form-msg').html('<div class="callout callout-danger"><h4>Failed!</h4><p>Failed to save please try again.</p></div>');
                $('.form-msg').fadeIn(1000);
                setTimeout(function(){
                  $('.form-msg').fadeOut(3000);

                },3000);
               
                //$('#action').next().append('<i class="fa fa-circle-o text-aqua"></i><span>Success</span>')
                }
                else if(data==23){$("#action").text('<?php echo $field_btn;?>');
          document.getElementById('action').style.pointerEvents = 'auto'; 
                $('.form-msg').html('');
                $('.form-msg').html('<div class="callout callout-danger"><h4>Failed!</h4><p>Check Username and Password.</p></div>');
                $('.form-msg').fadeIn(1000);
                setTimeout(function(){$('.form-msg').fadeOut(3000)},3000);
              }
                else{
                   $("#action").text('<?php echo $field_btn;?>');
          document.getElementById('action').style.pointerEvents = 'auto'; 
                $('.form-msg').html('');
                $('.form-msg').html('<div class="callout callout-success"><h4>Success!</h4><p>saved successfully.</p></div>');
                $('.form-msg').fadeIn(1000);
                setTimeout(function(){
                  $('.form-msg').fadeOut(3000);
                   window.location.href='<?php echo $visited_page; ?>';
              },3000);
                }
            }
          });
        }
        });
 function check_location(address){
    $('input[name="city"]').val('');
    $('input[name="state"]').val('');

    $.ajax({
    type: "GET",
    dataType: "json",
    url: "http://maps.googleapis.com/maps/api/geocode/json",
    data: {'address': address,'sensor':false},
    success: function(data){
      console.log(data.results[0].address_components.length);
      console.log(data);
        if(data.results.length){
            //alert(data.results[0].address_components[0]["long_name"]);
            if(data.results[0].address_components.length >= 2){
            $('input[name="city"]').val(data.results[0].address_components[1]["long_name"]);
            $('input[name="city"]').removeClass('parsley-error');
            $('input[name="city"]').next().hide();
            $('input[name="city"]').addClass('parsley-success');
          }else{
            alert('Failed to fetch city.Please enter manually');
          }
            if(data.results[0].address_components.length > 2){
            $('input[name="state"]').val(data.results[0].address_components[2]["long_name"]);
            $('input[name="state"]').removeClass('parsley-error');
            $('input[name="state"]').next().hide();
            $('input[name="state"]').addClass('parsley-success');
          }else{
            alert('Failed to fetch state.Please enter manually');
          }
        }else{
        alert('Failed to get lattitude & longitude.Please check your pincode');
       }
    }
});
 }

//check zipcode
$('input[name="zipcode"]').change(function(){
  //alert('test');
  var address=$(this).val();
  check_location(address);
});
$('.cmt_cls').each(function(){
  var name=$(this).attr('name');
  var tb=$(this).attr('cmt_tb');
  var value=$(this).val();
  var thiss=$(this);
  var parentt=$(this).parent();
  //alert(name+"'"+tb);
  $.ajax({
            url: SITEURL + 'admin/check_options',
            data:{name:name,tb:tb,value:value},
            type:'get',
            success: function(data) {
              //alert(data);
             // alert(thiss.parent().html());
              thiss.parent().html('');
              parentt.html(data);
              $(".select3").select2();
            }
          });
});
$('.get_cls').each(function(){
  var name=$(this).attr('name');
  var tb=$(this).attr('cmt_tb');
  var f_name=$(this).attr('cmt_name');
  var value=$(this).val();
  var thiss=$(this);
  var parentt=$(this).parent();
  //alert(name+"'"+tb);
  $.ajax({
            url: SITEURL + 'admin/get_options',
            data:{name:name,tb:tb,value:value,f_name:f_name},
            type:'get',
            success: function(data) {
              thiss.parent().html('');
              parentt.html(data);
              $(".select4").select2();
            }
          });
});
 
      });
    </script>