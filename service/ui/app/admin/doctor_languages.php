 <?php
   include(APP_PATH."service/ui/common/admin_header.php");
   ?>
<?php include("conf/config.inc.php");

$result = $scad->apnt_lang_with_docname();


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
                  
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="example2" class="table table-bordered table-hover">
                    <thead>
                      <tr>
                        <th>doctor_id</th>
                        <th>language_id</th>
                        <th>Edit</th>
                        
                        
                        
                      </tr>
                    </thead>
                    <tbody>
                    	<?php
                    	foreach ($result as $key => $value) {
                    	?>
                      <tr>
                        <td><?php echo $value['firstname'];?></td>
                        <td><?php echo $value['lang'];?></td>
                        <td>
                       	<a href="#"><i class="fa fa-eye"></i></a>
                       	<a href="#"><i class="fa fa-pencil"></i></a>
                        <a href="#"><i class="fa fa-trash-o"></i></a>
                      </td> 
                        
                      </tr>
                      <?php } ?>
                    </tbody>
                  </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->

    
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
      <?php include(APP_PATH."service/ui/common/admin_footer.php"); ?>
          
    
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