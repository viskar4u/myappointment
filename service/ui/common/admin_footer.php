<footer class="main-footer">
        
      </footer>

      
      <!-- Add the sidebar's background. This div must be placed
           immediately after the control sidebar -->
      <div class="control-sidebar-bg"></div>
    </div><!-- ./wrapper -->

    <!-- jQuery 2.1.4 -->
    
    <script src="<?php echo WEB_ROOT?>service/public/js/jquery.min.js"></script>

    <!-- jQuery UI 1.11.4 -->
    <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
    
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
      $.widget.bridge('uibutton', $.ui.button);
    </script>
    <!-- Bootstrap 3.3.5 -->
    <script src="<?php echo WEB_ROOT?>service/public/admin/bootstrap/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="<?php echo WEB_ROOT?>service/public/js/parsley.min.js"></script>
    <script type="text/javascript" src="<?php echo WEB_ROOT?>conf/config.js"></script>
   <script type="text/javascript" src="<?php echo WEB_ROOT?>service/public/js/scadcustom.js"></script>
    <!-- AdminLTE for demo purposes -->
    <link rel="stylesheet" href="<?php echo WEB_ROOT?>service/public/admin/dist/css/style.css"/>
    <!-- SlimScroll -->
    <script src="<?php echo WEB_ROOT?>service/public/admin/plugins/slimScroll/jquery.slimscroll.min.js"></script>
    <!-- FastClick -->
    <script src="<?php echo WEB_ROOT?>service/public/admin/plugins/fastclick/fastclick.min.js"></script>
    <!-- AdminLTE App -->
    <script src="<?php echo WEB_ROOT?>service/public/admin/dist/js/app.min.js"></script>
    <script>
    $(document).ready(function(){
        var url      = window.location.href;
        // $('.sidebar-menu li a').each(function(){
        //   var li_url=$(this).attr('href');
        //     if(li_url==url){
        //       $(this).parents('li').addClass('active');
        //     }
        // });

    $('.sidebar-menu li a').each(function(){
           var li_url=$(this).attr('href');
           var str1 = $(this).attr('href');
var str2 = "<?php echo $_GET['type']; ?>";
if(str2!=''){
if(str1.indexOf(str2) != -1){
     $(this).parents('li').addClass('active');
}}
        });
    });
        
    </script>
   
  </body>
</html>