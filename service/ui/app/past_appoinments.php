<?php 
   include("service/ui/common/header.php");   
   $result = $scad->getUserDetails($_SESSION['userID']); 
   
   //print_r($result);exit;
   $resu = $scad->getDetails1($_SESSION['userID'],date("Y-m-d"));
	//echo "<pre>";print_r($resu);exit;
	foreach ($resu as $key => $value) {
	$ids[]=$value['doctor_id'];
    $res[]= $scad->getDocDetails($value['doctor_id']);
	}
  //  print_r($res);exit;
   ?>
   
   
   
   <script>
   $(document).ready(function(){
   			$(".delete_apt").click(function(){
          var cnf= confirm('Are you sure to delete this?');
          if(cnf===true){
            df=$(this);
            var id=$(this).attr("target");
            $.ajax({
                  type: 'POST',
                  url: SITEURL + 'act-delete-appoinments',
                  data: {"id":id},
                  success: function(res) {
                      if (res == 0) {
                          $("#doc_setting_error").fadeIn(3000);
                          $("#doc-setting-error").delay(1000).fadeOut(8000);
                          document.getElementById('doc-detail').style.pointerEvents = 'auto';
                          $("#doc-detail").text('Save');
                      } else {
                          $("#apntEdit").show().delay(1000);
                          df.parent().parent().hide();
                          $("#apntEdit").fadeOut(1000);
                      }
                  }
              });
          }
   				
   			});
   });
 </script>
 
 
 
 
 
 
 
   
   

   <div class="container section_wrapper">
      <div class="row">
      <div style="padding:0;" class="col-md-9">
        <div class="raspberry ">
            <a href="<?php echo WEB_ROOT;?>index.php/patient/profile">
              <img src="<?php echo WEB_ROOT?>service/public/images/images/medical.png">
              <p>Medical Team</p>
            </a>
            
        </div>
        <div class="raspberry active">
          <a href="javascript:void(0);"> 
            <img src="<?php echo WEB_ROOT?>service/public/images/images/past.png">
            <p>Past Appointment</p>
          </a>
          
        </div>
        <div class="raspberry">
          <a href="javascript:void(0);">
            <img src="<?php echo WEB_ROOT?>service/public/images/images/notification.png">
            <p style="margin-top:15px;">Notifications</p>
          </a>
        </div>
        <div class="raspberry">
          <a href="<?php echo WEB_ROOT;?>index.php/patient_settings"> 
            <img src="<?php echo WEB_ROOT?>service/public/images/images/settings.png">
            <p>Settings</p>
          </a>
          
        </div>
        <div class="raspberry">
          <a href="<?php echo WEB_ROOT ?>index.php/signout"> 
            <img src="<?php echo WEB_ROOT?>service/public/images/images/logout.png">
            <p>Logout</p>
          </a>
          
        </div>
      </div>
    </div>
      
      <div class="profile_banner">
     <div id="apntEdit" style="left:240px;position: absolute;top: 140px;width: 400px;z-index: 999999; display:none;" role="alert" class="alert alert-success">
                        Your changes saved successfully.
                        </div>
      	
<h1 style="color: #CA1F53;font-size: 16px;" >Past Appointments</h1>

            <?php if(empty($resu)){ ?>
            <div style=" color:#ccc; font-size: 31px;text-align:center">No data to display</div>
            <?php } else{?> 
       <div style="overflow-x:auto;height:500px">
      <table class="table  table-striped past_app" >
      	
        <thead>
          <tr>
          <th colspan="">Doc Name</th>
          <th colspan="">Illness</th>
          <th colspan="">Appoinment Date</th>
          <th colspan="">Action</th>
          <th colspan="">Download</th>
          </tr>
        </thead>

            <tbody>
          <?php
                        $i=0;  
						foreach ($resu as $key => $val) {
							//echo $val['illness'];
							//print_r($val);
                        $res= $scad->getDocDetails($val['doctor_id']);
						
                       foreach ($res as $key => $value) {
                       	//echo $val['illness'];
							//print_r($val);exit;
                      //print_r($value);exit;
	                     ?>  
	                     
            <tr>	        
    <td data-label="Doc Name" ><?php echo $value['firstname']." ".$value['lastname'];?></td>						
    <td data-label="Illness"class="name"><?php  if(empty($val['illness'])){echo "No response";}else{echo $val['illness'];}?></td>
    
     <td data-label="Appoinment Date"><?php echo $newDate = date("d-m-Y", strtotime($val['apnt_date'])); ?></td>
     <td class="editthis" data-label="Edit" style="cursor:pointer"><a class="delete_apt" target="<?php echo $val['id'];?>">Delete</a></td>
     
     <?php
        	$download=$scad->getDownload($val['id']);

			?>
     <td class="editthis" data-label="Download" style="cursor:pointer;"><?php if(!empty($download)){?><a href="<?php echo WEB_ROOT;?>index.php/pdf1/<?php echo $download['id'];?>" target="_blank">Dowload Pdf</a><?php } else {?><span style=''> check-in status not submitted </span><?php } ?></td>

</tr>
      	
<?php         	
	          }
$i++;}
            	?>
            </tbody>
      </table> 
      
      <?php } ?>     	
            	</div>
      	</div>
      	</div>
      	
      	
   
<?php include("service/ui/common/footer.php"); ?>

