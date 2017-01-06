 <?php
   include(APP_PATH."service/ui/common/admin_header.php");
   ?>
<?php include("conf/config.inc.php");



?>



      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Data Tables
            <small>advanced tables</small>
          </h1>
          
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <a class='btn btn-primary' href="<?php echo $url=WEB_ROOT.'index.php/admin/edit?tb='.base64_encode('users');?>">Add new</a>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <?php 
                  //define which fields are need to fetch in table
                  $colums=array( 'firstname', 'email', 'lastname', 'dob');
                  ?>
                  <input type='hidden' id='colums' value=' <?php echo base64_encode(json_encode($colums)); ?>'>
                  <table id="example" class="display" cellspacing="0" width="100%">
<thead>
<tr>
<th>First name</th>
<th>Email</th>
<th>lastname</th>
<th>Dob</th>
<th>Action</th>
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
    
<!-- SlimScroll -->
    <script src="<?php echo WEB_ROOT?>service/public/admin/plugins/slimScroll/jquery.slimscroll.min.js"></script>
    <!-- FastClick -->
    <script src="<?php echo WEB_ROOT?>service/public/admin/plugins/fastclick/fastclick.min.js"></script>
    <!-- AdminLTE App -->
    <script src="<?php echo WEB_ROOT?>service/public/admin/dist/js/app.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="<?php echo WEB_ROOT?>service/public/admin/dist/js/demo.js"></script>

    
<script>
      $(document).ready(function () {
        var fields=$('#colums').val();
        //alert(fields);
        $('#example').dataTable( {
 "aProcessing": true,
 "aServerSide": true,
"ajax": SITEURL + 'admin/user-server-response/'+ fields +'/users',
} );
      	 $("#example1").DataTable();
        $('#example2').DataTable({
          "paging": true,
          "lengthChange": false,
          "searching": false,
          "ordering": true,
          "info": true,
          "autoWidth": false
        });
      });
    </script>