<?php
session_start();
include("service/ui/common/header.php"); 
$_SESSION['userID'];
?>
<style>
.demo{
	min-height:20px;
	width:70%;
	}
</style>
<div class="container section_wrapper">
  <div class="row">
    <div class="col-md-2 col-sm-4 col-xs-12">
      <ul class="terms">
        <li><a href="<?php echo WEB_ROOT;?>index.php/About">About Us</a></li>
        <li><a href="<?php echo WEB_ROOT;?>index.php/Careers">Careers</a></li>
        <li><a href="<?php echo WEB_ROOT;?>index.php/Contact">Contact Us</a></li>
      </ul>
    </div>
    <div class="col-md-offset-1 col-md-9 col-sm-8 col-xs-12">
      <div class="condition register">
        <fieldset class="his">
          <h4>Getting back to us</h4>
          <input class="demo" type="text" placeholder="Your name...">
          <input class="demo" type="text" placeholder="Your email...">
          <input class="demo" type="text" placeholder="Your phone...">
          <textarea class="demo" placeholder="Your comments..."></textarea><br />
          <div class="col-md-offset-4 col-md-4 col-sm-offset-3 col-sm-9 col-xs-12 padding-0">
            <div class="lg_btn">Submit</div>
          </div>
        </fieldset>
      </div>
    </div>
  </div>
</div>

      <?php 
	  include("service/ui/common/footer.php"); 
	  ?>