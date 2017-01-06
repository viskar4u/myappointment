<!DOCTYPE html>

<html>

  <head>

    <meta charset="utf-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>BookMyDocAdmin</title>

    <!-- Tell the browser to be responsive to screen width -->

    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <!-- Bootstrap 3.3.5 -->

    <link rel="stylesheet" href="<?php echo WEB_ROOT?>service/public/admin/bootstrap/css/bootstrap.min.css">

    <!-- Font Awesome -->

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">

    <!-- Ionicons -->

    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">

    <!-- Theme style -->

    <link rel="stylesheet" href="<?php echo WEB_ROOT?>service/public/admin/dist/css/AdminLTE.min.css">

    

    <link rel="stylesheet" href="<?php echo WEB_ROOT?>service/public/admin/dist/css/dataTables.bootstrap.css">

    <!-- AdminLTE Skins. Choose a skin from the css/skins

         folder instead of downloading all of them to reduce the load. -->

    <link rel="stylesheet" href="<?php echo WEB_ROOT?>service/public/admin/dist/css/skins/_all-skins.min.css">

    <!-- iCheck -->

    <link rel="stylesheet" href="<?php echo WEB_ROOT?>service/public/admin/plugins/iCheck/flat/blue.css">

    <!-- Morris chart -->

    <link rel="stylesheet" href="<?php echo WEB_ROOT?>service/public/admin/plugins/morris/morris.css">

    <!-- jvectormap -->

    <link rel="stylesheet" href="<?php echo WEB_ROOT?>service/public/admin/plugins/jvectormap/jquery-jvectormap-1.2.2.css">

    <!-- Date Picker -->

    <link rel="stylesheet" href="<?php echo WEB_ROOT?>service/public/admin/plugins/datepicker/datepicker3.css">

    <!-- Daterange picker -->

    <link rel="stylesheet" href="<?php echo WEB_ROOT?>service/public/admin/plugins/daterangepicker/daterangepicker-bs3.css">

    <!-- bootstrap wysihtml5 - text editor -->

    <link rel="stylesheet" href="<?php echo WEB_ROOT?>service/public/admin/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">

   

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->

    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->

    <!--[if lt IE 9]>

        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>

        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>

    <![endif]-->

  </head>

  <body class="hold-transition skin-blue sidebar-mini">

    <div class="wrapper">



      <header class="main-header">

        <!-- Logo -->

        <a href="<?php echo WEB_ROOT?>index.php/admin" class="logo">

          <!-- mini logo for sidebar mini 50x50 pixels -->

          <span class="logo-mini"><b>HOME</b></span>

          <!-- logo for regular state and mobile devices -->

          <span class="logo-lg"><b>BookMyDoc</b></span>

        </a>

        <!-- Header Navbar: style can be found in header.less -->

        <nav class="navbar navbar-static-top" role="navigation">

          <!-- Sidebar toggle button-->

          <a class="sidebar-toggle" role="button" data-toggle="offcanvas" href="#">

<span class="sr-only">Toggle navigation</span>

</a>

          <div class="navbar-custom-menu">

            <ul class="nav navbar-nav">

             

             

              <!-- Tasks: style can be found in dropdown.less -->

             

              <!-- User Account: style can be found in dropdown.less -->

              <li class="dropdown user user-menu">

               

                  <div class="pull-right">

                      <a href="<?php echo WEB_ROOT?>index.php/signout" class="btn btn-default btn-flat"><i class="fa fa-power-off fa-3x"></i>

</a>

                    </div> 

               

               

                

              </li>

              <!-- Control Sidebar Toggle Button -->

              <li>

               

              </li>

            </ul>

          </div>

        </nav>

      </header>

      <!-- Left side column. contains the logo and sidebar -->

      <aside class="main-sidebar">

        <!-- sidebar: style can be found in sidebar.less -->

        <section class="sidebar">

          <!-- Sidebar user panel -->

          <div class="user-panel">

            <div class="pull-left image">

              <img src="<?php echo WEB_ROOT?>service/public/admin/dist/img/avatar04.png" class="img-circle" alt="User Image">

            </div>

            <div class="pull-left info">

          <p><?php echo $_SESSION['name']; ?></p>

          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>

        </div>

          </div>

          

          <!-- sidebar menu: : style can be found in sidebar.less -->

          <ul class="sidebar-menu">

            <!--<li class="header">MAIN NAVIGATION</li>-->

            <!-- doctor menu -->

              

                <li class="treeview">

              <a href="#">

                <i class="fa fa-user-secret"></i> <span>Admins</span> <i class="fa fa-angle-left pull-right"></i>

              </a>

              <ul class="treeview-menu">

                <li><a href="<?php echo $url=WEB_ROOT.'index.php/admin/action?type=admin_details'; ?>"><i class="fa fa-circle-o"></i> view admin details</a></li>

              </ul>

            </li>

            <!--doctor menu -->



            <!-- doctor menu -->

              

                <li class="treeview">

              <a href="#">

                <i class="fa fa-user-md"></i> <span>Doctors</span> <i class="fa fa-angle-left pull-right"></i>

              </a>

              <ul class="treeview-menu">

                <li><a href="<?php echo $url=WEB_ROOT.'index.php/admin/action?type=doctor_details'; ?>"><i class="fa fa-circle-o"></i> View Doctor Details</a></li>

                <li><a href="<?php echo $url=WEB_ROOT.'index.php/admin/action?type=doctor_check_in'; ?>"><i class="fa fa-circle-o"></i> View Doctor Check-in</a></li>

                <li><a href="<?php echo $url=WEB_ROOT.'index.php/admin/action?type=doctor_appointment'; ?>"><i class="fa fa-circle-o"></i> Manage Doctor Appointments</a></li>

                <li><a href="<?php echo $url=WEB_ROOT.'index.php/admin/action?type=doctor_insurence'; ?>"><i class="fa fa-circle-o"></i> Manage Doctor Insurence</a></li>

                <li><a href="<?php echo $url=WEB_ROOT.'index.php/admin/action?type=doctor_language'; ?>"><i class="fa fa-circle-o"></i> Manage Doctor Language</a></li>

                <li><a href="<?php echo $url=WEB_ROOT.'index.php/admin/action?type=doctor_speciality'; ?>"><i class="fa fa-circle-o"></i> Manage Doctor Speciality</a></li>

                <li><a href="<?php echo $url=WEB_ROOT.'index.php/admin/action?type=doctor_ratings'; ?>"><i class="fa fa-circle-o"></i> Manage Doctor Ratings</a></li>

                <li><a href="<?php echo $url=WEB_ROOT.'index.php/admin/action?type=doctor_files'; ?>"><i class="fa fa-circle-o"></i> Manage Doctor Files</a></li>

              </ul>

            </li>

            <!--doctor menu -->



            <!--user menu -->

               <li class="treeview">

              <a href="#">

                <i class="fa fa-user"></i> <span>Patients</span> <i class="fa fa-angle-left pull-right"></i>

              </a>

              <ul class="treeview-menu">

                <li><a href="<?php echo $url=WEB_ROOT.'index.php/admin/action?type=patient_details'; ?>"><i class="fa fa-circle-o"></i> View Patient Details</a></li>

                <li><a href="<?php echo $url=WEB_ROOT.'index.php/admin/action?type=patient_checkin'; ?>"><i class="fa fa-circle-o"></i> View Patient Check-in</a></li>

                <li><a href="<?php echo $url=WEB_ROOT.'index.php/admin/action?type=patient_appointment'; ?>"><i class="fa fa-circle-o"></i> View Patient Appointments</a></li>

                <li><a href="<?php echo $url=WEB_ROOT.'index.php/admin/action?type=patient_ratings'; ?>"><i class="fa fa-circle-o"></i> View Patient Ratings</a></li>

              </ul>

            </li>

            



            <li class="treeview">

              <a href="#">

                <i class="fa fa-users"></i> <span>System</span> <i class="fa fa-angle-left pull-right"></i>

              </a>

              <ul class="treeview-menu">

                <li><a href="<?php echo $url=WEB_ROOT.'index.php/admin/action?type=gender'; ?>"><i class="fa fa-circle-o"></i> Manage Gender Details</a></li>

                <li><a href="<?php echo $url=WEB_ROOT.'index.php/admin/action?type=illness'; ?>"><i class="fa fa-circle-o"></i> Manage Illness Details</a></li>

                <li><a href="<?php echo $url=WEB_ROOT.'index.php/admin/action?type=manage_insurence'; ?>"><i class="fa fa-circle-o"></i> Manage Insurence Details</a></li>

                <li><a href="<?php echo $url=WEB_ROOT.'index.php/admin/action?type=manage_language'; ?>"><i class="fa fa-circle-o"></i> Manage Language Details</a></li>

                <li><a href="<?php echo $url=WEB_ROOT.'index.php/admin/action?type=manage_speciality'; ?>"><i class="fa fa-circle-o"></i> Manage Speciality Details</a></li>

                <li><a href="<?php echo $url=WEB_ROOT.'index.php/admin/action?type=usertypes'; ?>"><i class="fa fa-circle-o"></i> Manage UserTypes Details</a></li>

            </ul>

          </li>



          <!--user menu -->

            <!-- package setup-->
            <li class="treeview">

              <a href="#">

                <i class="fa fa-paypal"></i> <span>Packages</span> <i class="fa fa-angle-left pull-right"></i>

              </a>

              <ul class="treeview-menu">

                <li><a href="<?php echo $url=WEB_ROOT.'index.php/admin/edit?type=payment_gateway&tb='.base64_encode("payment_gateway").'&id='.base64_encode(1); ?>"><i class="fa fa-circle-o"></i> Payment settings</a></li>

                <li><a href="<?php echo $url=WEB_ROOT.'index.php/admin/action?type=payment_packages'; ?>"><i class="fa fa-circle-o"></i> View Packages</a></li>

                <li><a href="<?php echo $url=WEB_ROOT.'index.php/admin/action?type=package_payments'; ?>"><i class="fa fa-circle-o"></i> View Payment details</a></li>

              </ul>

            </li>
            <!--package setup-->

            <!--mobile application config-->
            <li class="treeview">

              <a href="#">

                <i class="fa fa-mobile"></i> <span>Mobile Application</span> <i class="fa fa-angle-left pull-right"></i>

              </a>

              <ul class="treeview-menu">

                <li><a href="<?php echo $url=WEB_ROOT.'index.php/admin/edit?type=application_config&tb='.base64_encode("app_config").'&id='.base64_encode(1); ?>"><i class="fa fa-circle-o"></i> Setup secrect key</a></li>

              </ul>

            </li>
            <!--mobile application config-->



          </ul>

        </section>

        <!-- /.sidebar -->

      </aside>