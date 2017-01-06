 <?php
   include(APP_PATH."service/ui/common/admin_header.php");
   ?>
<?php
$action=$_GET['type'];
 include("conf/config.inc.php");
include(APP_PATH."service/ui/app/admin/confg/config.menu.action.php");
$list_op=menu_action($action);

?>



      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            <?php echo strtoupper(str_replace("_"," ",$_GET['type']));?>
          </h1>
          
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <?php if($list_op['multiple']!='yes' ){
                    $key_type1=array('check_in_lists','doctor_files_lists','payment_packages');
              if (!(in_array($_GET['type'], $key_type1)) ){ ?>
                  <a class='btn btn-primary' href="<?php echo $url=WEB_ROOT.'index.php/admin/edit?type='.$_GET['type'].'&tb='.base64_encode($list_op['table']);?>">Add new</a>
                  <?php }} ?>
                <?php
                if(isset($_GET['msg']) && $_GET['msg']=='true' ) 
                {echo '<div class="callout callout-success" style="margin-top:10px"><h4>Success!</h4><p>saved successfully.</p></div>';}
                ?>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <?php 
                  //define which fields are need to fetch in table
                  //url structure
                  //admin/user-server-response/'+ fields +'/'+table+'/'+condition+'/'+types+'/'+join_tables,
                  //admin/user-server-response/'+ fields +'/'+table+'/'+condition+'/'+types,
                  $ajax_url;
                  $get_where='';
                  $ajax_data='';
                  if(isset($_GET['field'])){
                    $get_field=base64_decode($_GET['field']);
                    $get_value=base64_decode($_GET['value']);
                    $get_where= array('fieldname' => $get_field,'value' =>$get_value );
                  }
                  if($list_op['multiple']=='yes'){
                    //$ajax_url="admin/user-server-response1/".base64_encode(json_encode($list_op["columns"]))."/".$list_op["table"]."/".base64_encode(json_encode($list_op["where"]))."/".$_GET['type']."/".base64_encode(json_encode($list_op['join_table']));
                    //$ajax_url="admin/user-server-response1/".base64_encode(json_encode($list_op))."/".$_GET['type'];
                    $ajax_url="admin/user-server-response1";
                    $ajax_data=base64_encode(json_encode($list_op));
                    }else{
                      if($list_op["where"]==''){$list_op["where"]=$get_where;}
                    $ajax_url="admin/user-server-response";
                    $ajax_data=base64_encode(json_encode($list_op));
                    //$ajax_url="admin/user-server-response/".base64_encode(json_encode($list_op["columns"]))."/".$list_op["table"]."/".base64_encode(json_encode($list_op["where"]))."/".$_GET['type'];
                  }
                  $disable_delete = (isset($list_op['disable_delete'])) ? $list_op['disable_delete'] : 'none';
                  ?>
                  <input type='hidden' id='colums' value='<?php echo base64_encode(json_encode($list_op["columns"])); ?>'>
                  <input type='hidden' id='where' value='<?php echo base64_encode(json_encode($list_op["where"])); ?>'>
                  <input type='hidden' id='table_name' value='<?php echo $list_op["table"]; ?>'>
                  <input type='hidden' id='disable_delete' value='<?php echo $disable_delete; ?>'>
                  <input type='hidden' id='type' value='<?php echo $_GET['type']; ?>'>
                  <input type='hidden' id='ajax_url' value='<?php echo $ajax_url; ?>'>
                  <table id="example" class="display" cellspacing="0" width="100%">
<thead>
<tr>
<?php
  foreach ($list_op['columns'] as $key => $value) {
    echo '<th>'.strtoupper(str_replace("_"," ",$value)).'</th>';
  }
?>
<?php
//if($_GET['type']!='doctor_files_lists'){
$key_type=array('gender','doctor_files_lists','usertypes');
              if (!(in_array($_GET['type'], $key_type)) ){
if($list_op['multiple']!='yes' ){
?><th>Action</th><?php
}}
?>
</tr>
</thead>
</table>
                  
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
      $(document).ready(function () {
        
        setTimeout(function(){ $('.callout').fadeOut('5000'); }, 3000);
        var fields=$('#colums').val();
        var condition=$('#where').val();
        var table=$('#table_name').val();
        var disable_delete=$('#disable_delete').val();
        var types=$('#type').val();
        var ajax_url=$('#ajax_url').val();
        //alert(fields);
        $('#example').dataTable( {
 "aProcessing": true,
 "aServerSide": true,
//"ajax": SITEURL + 'admin/user-server-response/'+ fields +'/'+table+'/'+condition+'/'+types,
//"ajax": SITEURL + ajax_url,
"ajax": {
            "url": SITEURL + ajax_url,
            "type": "GET",
            "data":{'fields':'<?php echo $ajax_data;?>','type':'<?php echo $_GET["type"] ?>'}
        },
} );
      	 $(document).on("click", ".delete_row", function(event){
          event.preventDefault();
          var r = confirm("Are you sure to delete?");
          var thiss=$(this);
if (r == true) {
    txt = "You pressed OK!";

          var urld=$(this).attr('href');
          $.ajax({
            url:urld,
            success: function(res){
              if(res == 1){
                thiss.parent().parent().css('background','red ');
                setTimeout(function(){ thiss.parent().parent().remove(); }, 500);
              }
            }
          });
          } else {
    txt = "You pressed Cancel!";
}
           //$(this).parent().parent().remove();
        });

      });
    </script>