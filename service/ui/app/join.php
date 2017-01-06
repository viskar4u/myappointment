<?php include("service/ui/common/header.php"); ?>
      <div class="container section_wrapper">
         <div class="row">
            <div class="col-md-6">
               <div class="patient join-nw jo">
                  <h2>Join Now</h2>
               </div>
               <img class="doctor" src="<?php echo WEB_ROOT;?>service/public/images/images/docor.png"></img>
            </div>
            <div class="col-md-6">
               <div class="patient weight">
                  <h2>I'm a new patient</h2>
                  <p>Find a doctor and a book an appointment online for free!
                  </p>
               </div>
               <div class="between"></div>
               <div class="between"></div>
               <div class="join now-width">
                  <a href="<?php echo WEB_ROOT;?>index.php/join/patient">
                     <h4>Join Now</h4>
                  </a>
               </div>
               <div class="between"></div>
               <div class="between"></div>
               <div class="patient weight">
                  <h2>I'm a doctor</h2>
                  <p>Quicker way for your patient to schedule an appointment.register<br>
                     with book My Doc
                  </p>
                  <div class=" learn">
                     <P><a href="<?php echo WEB_ROOT;?>index.php/join/learnmore">learn more</P>
                     </a>
                  </div>
               </div>
            </div>
         </div>
      </div>
<?php include(APP_PATH."service/ui/common/footer.php"); ?>