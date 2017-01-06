 <?php
   include(APP_PATH."service/ui/common/admin_header.php");
   ?>
<?php include("conf/config.inc.php");


include(APP_PATH."service/ui/app/admin/confg/config.menu.action.php");

?>



      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Details
          </h1>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <a class='btn btn-primary' href="<?php echo WEB_ROOT;?>index.php/admin/edit?type=<?php echo $_GET['type'];?>&tb=<?php echo $_GET['tb'];?>&id=<?php echo $_GET['id'];?>">Update</a>
                  <a class='btn btn-danger' href="<?php echo WEB_ROOT;?>index.php/admin/delete?type=<?php echo $_GET['type'];?>&tb=<?php echo $_GET['tb'];?>&id=<?php echo $_GET['id'];?>&url=<?php echo WEB_ROOT;?>index.php/admin/action?type=<?php echo $_GET['type'];?>">Delete</a>
                </div><!-- /.box-header -->
                <div class="box-body ">
                  <?php 
                    $table=base64_decode($_GET['tb']);
                  $id=base64_decode($_GET['id']);
                    $result = $scad->get_td_data($table,$id);
                    $result1 = $scad->get_td_data1($table,$id);
                    $list_op=menu_action($_GET['type']);
    $hi_fields=$list_op['hidden'];
    $hi_fields[]='id';$hi_fields[]='password';$hi_fields[]='secret_key';
                  ?>
              <ul class="list-group list-group-bordered ">
                  <?php
                  // echo '<pre>';
                  //   print_r($result1);
                  //   echo '</pre>';
                    $i=0;
                    foreach ($result as $key => $value) {
                      
                      if (!(in_array($key, $hi_fields)) ){
                        if(isset($result1[$i]['Comment'])){
                          $options=explode(',',$result1[$i]['Comment']);
        $arr='';
        foreach ($options as $key1 => $op_value) {
          $op_data=explode('->', $op_value);
          $arr[$op_data[0]]=$op_data[1];
        }
$cmt_name='';$cmt_cls='';$cmt_tb='';$cmt_name='';
      $cmt=explode('>', $result1[$i]['Comment']);
      if($cmt[0]=='join'){
        $cmt_cls='get_cls';
        $cmt_tb=$cmt[1];
        if($key=='doctor_id' || $key=='userid' || $key=='user_id'){
          $cmt_name='firstname';
        }
        else{$cmt_name='name';}
      }
      else if($cmt[0]=='get'){
        $cmt_cls='get_cls';
        $cmt_tb_s=explode('-',$cmt[1]);
        $cmt_tb=$cmt_tb_s[0];
        $cmt_name=$cmt_tb_s[1];
      }else{$cmt_name='';$cmt_cls='';$cmt_tb='';$cmt_name='';}
    }
                      ?>
                      <li class="list-group-item">
                        <p class=''>
                      <b><?php echo strtoupper(str_replace("_"," ",$key)); ?></b> 
                      <?php 
                      if(isJSON($value)){
                        $arr_data=json_decode($value,true);
                        //json display
                        if(count($arr_data) > 0){
                        $data ='<div class="detail-box" ><dl class="dl-horizontal">';
                        foreach ($arr_data as $key => $value1) {
                        if(is_string($value1)){
                        $_dis= (empty($value1)) ? "--" : $value1;
                        $data .='<dt>'.$key.' :- </dt><dd>'.$_dis.'</dd>';
                        }else{
                        $_key= (is_string($key)) ? $key : $F_name." ".$key;
                        $data .='<dt>'.$_key.' :- </dt><dd>';
                        foreach ($value1 as $key1 => $value2) {
                        //$data .='<dt>'.$key1.'</dt><dd>'.$value2.'</dd>';
                        $data .=$key1." : ".$value2.", ";
                        }
                        $data .='</dd>';
                        }
                        }
                        $data .='</dl></div>';
                        }else{
                        $data ='<div class="detail-box" > Please update '.strtoupper(str_replace("_"," ",$key)).' details </div>';
                        }
                        echo $data;
                        //json display
                      }else{
                      ?>
                      <i class="pull-right <?php echo $cmt_cls; ?>" name=<?php echo $key;?> cmt_tb="<?php echo $cmt_tb;?>" cmt_name="<?php echo $cmt_name;?>"><?php //echo $value;
                      $dara = (isset($arr[$value])) ? $arr[$value] : $value;
                      $dara = (!empty($dara)) ? $dara : '-';
                      echo substr_replace($dara,"",50); 
                      }?></i>
                    </p>
                    </li>
                      <?php
                  }
                  $i++;}

                  ?>
                </ul>
              
                  
                
                  </div><!-- /.box-body -->
              </div><!-- /.box -->

              
    
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
     
      

      <?php include(APP_PATH."service/ui/common/admin_footer.php"); ?>
       <link rel="stylesheet" type="text/css" href="<?php echo WEB_ROOT?>service/public/admin/dist/css/jquery.dataTables.css"> 
    <script src="<?php echo WEB_ROOT?>service/public/admin/dist/js/jquery.dataTables.min.js"></script>
    <script src="<?php echo WEB_ROOT?>service/public/admin/dist/js/dataTables.bootstrap.min.js"></script>
    
    <script>
    $(document).ready(function(){
       $('.detail-box').slimScroll({
          height: '250px'
          });
      $('.btn-danger').click(function(e){
        e.preventDefault();
        var r = confirm("Are you sure to delete?");
        if (r == true) {
          window.location.href=$(this).attr('href');
        }
      })
      $('.get_cls').each(function(){
  var name=$(this).attr('name');
  var tb=$(this).attr('cmt_tb');
  var f_name=$(this).attr('cmt_name');
  var value=$(this).text();
  var thiss=$(this);
  var parentt=$(this).parent();
  thiss.text('Loading...');
  //alert(name+"'"+tb);
  $.ajax({
            url: SITEURL + 'admin/get_single_options',
            data:{name:name,tb:tb,value:value,f_name:f_name},
            type:'get',
            success: function(data) {
              thiss.text(data);
            }
          });
});
    });
    </script>
