<?php
$protocol = 'http'.(!empty($_SERVER['HTTPS']) ? 's' : '');
$root = $protocol.'://'.$_SERVER['SERVER_NAME'].dirname($_SERVER['PHP_SELF']);

?>
<html>
<head>
	<style>
	html,body{width:100%;height:100%;overflow-x: hidden;}
	.container{width:60%;margin: 0 auto;background: #cdcdcd;padding: 25px}
	.container form {padding: 10px;}
	.container form .field-row{width: 100%;}
	.container form .field-row label{width: 100%;}
	.container form .field-row input{width: 100%;padding: 10px}

	.main{margin:0 auto;background:#cdcdcd;}
.main .sub .block{height:30px;background:#dcdcdc;padding:10px;}
.main .sub .support_block{padding:10px;display:none;border:1px solid #000;background: #dcdcdc;margin:10px}
.main .sub .support_block.in{display:block;}
	form input{padding: 10px}
	</style>
	  <script src="//code.jquery.com/jquery-1.10.2.js"></script>
</head>
<body>
	<div class="container">
		<form method="post" action="installer_dump.php">
			<div class="field-row">
				<input type="hidden" name="hostname" value='<?php echo $root;?>'>
			</div>
			<hr />
			<div class='main'>
      <div class='sub'>
          <div class='block'>DB configuration</div>
          <div class='support_block in'>
          	<div class="field-row">
				<label>Database Host Name : </label>
				<input type="text" name="db_hostname" placeholder='example_hostname'>
			</div>
			<div class="field-row">
				<label>Database Name : </label>
				<input type="text" name="db_name" placeholder='example_database'>
			</div>
			<div class="field-row">
				<label>Username : </label>
				<input type="text" name="db_user_name" placeholder='username'>
			</div>
			<div class="field-row">
				<label>Password : </label>
				<input type="password" name="db_password" placeholder='password'>
			</div>
			<hr />
          </div>
    </div>
    <hr/>
    <div class='sub'>
        <div class='block'>Mail configuration</div>

        <div class='support_block'>
        	<div class="field-row">
				<label>Mail Host : </label>
				<input type="text" name="mail_host_name" placeholder='mail.example.com'>
			</div>
			<div class="field-row">
				<label>Port : </label>
				<input type="text" name="mail_port" placeholder='567'>
			</div>
			<div class="field-row">
				<label>Mail Username : </label>
				<input type="text" name="mail_user_name" placeholder='example@youdomain.com'>
			</div>
			<div class="field-row">
				<label>Mail Password : </label>
				<input type="password" name="mail_password" placeholder='password'>
			</div>
			<div class="field-row">
				<label>From Address : </label>
				<input type="text" name="from_address" placeholder='exampl@yourdomain.com'>
			</div>
			<div class="field-row">
				<label>From Name : </label>
				<input type="text" name="from_name" placeholder='example site'>
			</div>
        	<input style='margin-top:5px' type="submit" name="submit" value="SUBMIT">
			<input style='margin-top:5px' type="reset" name="reset" value="RESET">
			<hr /></div>
    </div>
    <hr/>
</div>
			
			
			
		</form>
	</div>
</body>
<script>
 $(document).ready(function(){
 	$('.block').click(function(){
	$('.support_block').slideToggle();
});
 });
</script>
</html>
