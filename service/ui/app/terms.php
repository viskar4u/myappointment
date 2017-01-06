<?php
session_start();
include("service/ui/common/header.php"); 
$_SESSION['userID'];
?>
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
      <div class="condition">
              <p style="text-align:justify">
      
<h4>Terms and conditions ...</h4>
<p style="text-align:justify">
We recently welcomed a new Chief Operating Officer to the team. Carlyle Singer brings over 30 years of executive, management, operational and corporate finance experience, most recently serving as President and CEO of a $280M private equity-owned global distribution company for printing and copier products. </p>
<br \>
 <br \>
<p style="text-align:justify">
With experience living and working across Europe and South America, Carlyle brings energy, flexibility and interest in exploring the geographies in which Acumen operates. In close collaboration with the Management Committee, Carlyle is overseeing our overall strategic direction and has direct responsibility for Acumen's core operating activities, supporting our ambitious 2013 goals and the next chapter in our history.</p>
<br \>
 <br \>
<p style="text-align:justify">
We are delighted to welcome her to the Acumen team.</p>
</p>
      </div>
    </div>
  </div>
</div>

      <?php 
	  include("service/ui/common/footer.php"); 
	  ?>