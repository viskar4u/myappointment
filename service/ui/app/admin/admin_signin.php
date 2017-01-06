<?php include("conf/config.inc.php");

?>
<!DOCTYPE html>
<html >
  <head>
    <meta charset="UTF-8">
    <title> Login </title>
    
    


    <link rel='stylesheet prefetch' href='http://fonts.googleapis.com/css?family=Roboto:400,100,300,500,700,900|RobotoDraft:400,100,300,500,700,900'>
<link rel='stylesheet prefetch' href='http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css'>

      

    <link rel="stylesheet" href="<?php echo WEB_ROOT?>service/public/css/admin_style.css">
<link rel="stylesheet" href="<?php echo WEB_ROOT?>service/public/css/admin_reset.css">
    <script type='text/javascript' src='<?php echo WEB_ROOT?>service/public/js/jquery.min.js'></script>
      <script type="text/javascript" src="<?php echo WEB_ROOT?>service/public/js/parsley.min.js"></script>
 <script type='text/javascript' src='<?php echo WEB_ROOT?>service/public/js/admin_index.js'></script>   
 <script type="text/javascript" src="<?php echo WEB_ROOT?>conf/config.js"></script>    
 <script type="text/javascript" src="<?php echo WEB_ROOT?>service/public/js/scadcustom.js"></script>  
  </head>

  <body id='login_page'>

    
<!-- Form Mixin-->
<!-- Pen Title-->
<div class="pen-title">
  <img alt="logo" src="<?php echo WEB_ROOT?>service/public/images/logo1.png">
</div>
<!-- Form Module-->
<div class="module form-module">
  <div class="toggle"><i class="fa fa-times fa-pencil"></i>
   
  </div>
  <div class="form">
  <div id="email_error" style="margin-top:20px;display:none;" class="alert alert-error">Email not verified.</div>
		 <div id="signin_error" style="margin-top:20px;display:none;" class="alert alert-error">Invalid Login.</div>
    <h2>Login to your account</h2>
    <form id="admin-signin-form" name="admin-signin-form">
      <input type="text" name="email" id="email" required placeholder="Username"/>
      <input type="password" name="password" required id="password" placeholder="Password"/>
      <div id="admin_signin" class="loin">Login</div>
      <!--<button id="admin_signin"></button>-->
    </form>
  </div>
  
  <div class="cta">Forgot your password?</a></div>
</div>
 
    
  </body>
</html>
<script>
function sign_in(){

  $('#admin-signin-form').parsley('validate');
  var validation = $('#admin-signin-form').parsley('isValid');
    if (validation == true) {
        document.getElementById('admin_signin').style.pointerEvents = 'none';
        $("#admin_signin").text('Processing...');
        var formData = $('#admin-signin-form').serialize();
        $.ajax({url: SITEURL + 'act-signin',
            type: 'POST',
            
            data: formData,
            success: function(res) {
        if(res==3){
          $("#email_error").show();
          document.getElementById('admin_signin').style.pointerEvents = 'auto';
          $("#admin_signin").text('Sign In');
          $("#email").removeClass("parsley-success");
          $("#email").addClass("parsley-error");
          }
        else{
        var reslt = res.split(","); 
                if (reslt[3] == 3) {
                    window.location.href = SITEURL + 'admin/action?type=admin_details';
                }
                else if (reslt[3] == 1) 
        {
                    window.location.href = SITEURL + 'doctor/profile';
                } 
                else if (reslt[3] == 2) 
        {
                    window.location.href = SITEURL + 'patient/profile';
                } else {
                    $("#signin_error").show();
                    document.getElementById('admin_signin').style.pointerEvents = 'auto';
                    $("#admin_signin").text('Sign In');
          $("#email").removeClass("parsley-success");
          $("#email").addClass("parsley-error");
          $("#password").removeClass("parsley-success");
          $("#password").addClass("parsley-error");
                }
        }
            }
        });
    }
  
}
$("#admin_signin").click(function() {
	sign_in();
    });
$('#password').keypress(function (e) {
 var key = e.which;
 if(key == 13)  // the enter key code
  {
    sign_in();
  }
});
</script>