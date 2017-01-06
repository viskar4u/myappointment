<?php include("conf/config.inc.php");

?>
<html>
    <head>
        <title>book my doc
        </title>
           <link rel="shortcut icon" type="image/png" href="<?php echo WEB_ROOT?>service/public/images/favicon.png">
   <link href="<?php echo WEB_ROOT?>service/public/css/common.css" rel="stylesheet">
   <link href="<?php echo WEB_ROOT?>service/public/css/custom.css" rel="stylesheet">
   <link href="<?php echo WEB_ROOT?>service/public/css/style.css" rel="stylesheet">
   <link href="<?php echo WEB_ROOT?>service/public/css/blue.css"  rel="stylesheet">
   <link href="<?php echo WEB_ROOT?>service/public/css/responsive.css" rel="stylesheet">
   <link href="<?php echo WEB_ROOT?>service/public/css/BeatPicker.min.css" rel="stylesheet">
   <link href="<?php echo WEB_ROOT?>service/public/css/font-awesome/font-awesome.css" rel="stylesheet">
   <link href='http://fonts.googleapis.com/css?family=Open+Sans+Condensed:300,300italic,700|Open+Sans:400,300,300italic,400italic,600,600italic,700,700italic,800,800italic|Noto+Sans:400,400italic,700,700italic|PT+Sans+Caption:400,700|Lato:400,100,100italic,300,300italic,400italic,700,700italic|Roboto:400,100italic,100,300,300italic,400italic,500,500italic,700,700italic' rel='stylesheet' type='text/css'>
   <link href='http://fonts.googleapis.com/css?family=Oswald' rel='stylesheet' type='text/css'>
<!-- file upload css -->
<link rel="stylesheet" href="<?php echo WEB_ROOT?>service/public/css/fileupload/jquery.fileupload.css">
<link rel="stylesheet" href="<?php echo WEB_ROOT?>service/public/css/fileupload/jquery.fileupload-ui.css">
<!-- <link rel="stylesheet" href="<?php echo WEB_ROOT?>service/public/css/fileupload/jquery.blueimp-gallery.min.css">
CSS adjustments for browsers with JavaScript disabled -->


<noscript><link rel="stylesheet" href="css/jquery.fileupload-noscript.css"></noscript>
<noscript><link rel="stylesheet" href="css/jquery.fileupload-ui-noscript.css"></noscript>
<!-- file upload css -->

   <script type='text/javascript' src='<?php echo WEB_ROOT?>service/public/js/jquery.min.js'></script>
 <!--  <script type="text/javascript" src="<?php echo WEB_ROOT?>service/public/js/script.js"></script>-->
   <script type='text/javascript' src='<?php echo WEB_ROOT?>service/public/js/bootstrap.min.js'></script>
   <script type='text/javascript' src='<?php echo WEB_ROOT?>service/public/js/jquery.bootpag.js'></script>



    <script type='text/javascript' src='<?php echo WEB_ROOT?>service/public/js/slider/jquery.mobile.customized.min.js'></script>
    <script type='text/javascript' src='<?php echo WEB_ROOT?>service/public/js/slider/jquery.easing.1.3.js'></script> 
    <script type='text/javascript' src='<?php echo WEB_ROOT?>service/public/js/slider/camera.min.js'></script> 
    
    
   <script type="text/javascript" src="<?php echo WEB_ROOT?>service/public/js/jquery.mousewheel.min.js"></script>
   <script type="text/javascript" src="<?php echo WEB_ROOT?>service/public/js/jquery.touchSwipe.min.js"></script>
   <script type="text/javascript" src='<?php echo WEB_ROOT;?>service/public/js/jquery.base64.min.js'></script>
   <script type="text/javascript" src="<?php echo WEB_ROOT?>service/public/js/parsley.min.js"></script>
   <script type="text/javascript" src="<?php echo WEB_ROOT?>conf/config.js"></script>
   <script type="text/javascript" src="<?php echo WEB_ROOT?>service/public/js/scadcustom.js"></script>
   <!--Date Picker-->
   <link rel="stylesheet" href="<?php echo WEB_ROOT?>service/public/css/BeatPicker.min.css"/>
   <script src="<?php echo WEB_ROOT?>service/public/js/calander/BeatPicker.min.js"></script>
   
        <link href="<?php echo WEB_ROOT?>service/public/css/css/bookmydoc.css" rel="stylesheet" type="text/css">
        <link href="<?php echo WEB_ROOT?>service/public/css/css/bootstrap.css" rel="stylesheet" type="text/css">
        <link href="<?php echo WEB_ROOT?>service/public/css/css/bootstrap-theme.css" rel="stylesheet" type="text/css">
    </head>
    <body>
    <div class="header">
        <div class="container">
            <div class="col-md-12">
                <div class="col-md-8">
                    <a href="<?php echo WEB_ROOT?>"><div  class="logo"></div></a>
                </div>
                <div class="col-md-4">
                                            <?php if($_SESSION['userID']){ 
                          $url = ($_SESSION['userType'] == 1) ? WEB_ROOT.'index.php/doctor/profile' : WEB_ROOT.'index.php/patient/profile'?>
                            <!-- echo '<a href="'.WEB_ROOT.'index.php/doctor/profile" class="button large orange-1">My Account</a>'; -->
                            <div class="signup">
                             <div class="sign">
                                 <img src="<?php echo WEB_ROOT?>service/public/images/images/my_account.png">
                                 <a href="<?php echo $url;?>"><p>Hi <?php echo strlen($_SESSION['name']>6) ? substr($_SESSION['name'],6).'...' : $_SESSION['name']; ?></p></a>
                              </div>
                            </div>
                            <div class="signup">
                             <div class="sign">
                                 <img width="24px" height="24px" src="<?php echo WEB_ROOT?>service/public/images/images/logout.png">
                                 <a href="<?php echo WEB_ROOT?>index.php/signout"><p>Logout</p></a>
                              </div>
                            </div>
                           <?php //}else{ ?>
                            <!-- //echo '<a href="'.WEB_ROOT.'index.php/patient/profile" class="button large orange-1">My Account</a>'; -->
                           <?php //}
                            } else {      ?>
                         <div class="signup">
                             <div class="sign">
                                 <img src="<?php echo WEB_ROOT?>service/public/images/images/signn.png">
                                 <a href="<?php echo WEB_ROOT?>index.php/join"><p>Sign Up</p></a>
                              </div>
                          </div>
                          <div class="signin">
                            <div class="sign">
                              <img src="<?php echo WEB_ROOT?>service/public/images/images/signin.png"><a href="<?php echo WEB_ROOT?>index.php/signin "><p>Sign In </p></a>
                            </div>
                          </div>
                          <?php } ?>
                    
                </div>
            </div>
        </div>
    </div>