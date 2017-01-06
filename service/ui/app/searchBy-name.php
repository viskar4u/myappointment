

<?php include("service/ui/common/header.php"); ?>
<script type="text/javascript">
   $(document).ready(function(){
    function height_cal(){
      var max_height = 0;
      $('ul.ser_pag li').each(function(){
        var height = $(this).height();
        if(height>max_height){
          $(this).css({'min-height':height + 5});
        }
      });
    }
   
   function loadData(page,letter){  
   $(".ser_pag").hide();   
   					$(".outr_load").show();                   
                       $.ajax
                       ({
                           type: "POST",
                           url: SITEURL+'search-Alpha',
   						data:{"page":page,"letter":letter},
                           success: function(msg)
                           {
                               //console.log(msg);
                                   
                                  $(".ser_pag").html(msg);
								  // procedures();
								   $(".outr_load").hide();                 
								   $(".ser_pag").show();
                   //height_cal();
                           }
                       });
                   }
                   loadData(1,'a');
   //setTimeout(function(){loadData(1,'a')}, 3000);  // For first time page load default results
   $(".alphabets").click(function(){
                        $(".ser_pag").hide();
	   $(".outr_load").show(); 
	   $(".alphabets").removeClass("selected");
	   $(this).addClass("selected");
                       var the_letter = $(this).attr("target");
					   $(".alpha").val(the_letter);
   					//alert(the_letter);
            loadData(1,the_letter);
					//setTimeout(function(){loadData(1,the_letter)}, 3000);
                      
                   });
   				
   				$(".searchbtn").click(function(){
                       var the_letter = $('.textarea').val();
                       var target = the_letter.charAt(0).toUpperCase();
                       $('.alphabets').removeClass('selected');
                       $('.alphabets').each(function(){
                        if($(this).attr('target')==target){
                          $(this).addClass('selected');
                        }
                       });
   					//alert(the_letter);
   loadData(1,the_letter);
                      
                   });
   				
                   $('.ser_pag .rvwpaginatin li.activ').live('click',function(){
                                       $(".ser_pag").hide();
	   $(".outr_load").show(); 
                       var page = $(this).attr('p');
					   var the_letter =  $(".alpha").val();
                       setTimeout(function(){loadData(page,the_letter)}, 3000);
                       
                   });   
   $('#go_btn').live('click',function(){
                       var page = parseInt($('.goto').val());
                       var no_of_pages = parseInt($('.total').attr('a'));
                       if(page != 0 && page <= no_of_pages){
                           loadData(page);
                       }else{
                           alert('Enter a PAGE between 1 and '+no_of_pages);
                           $('.goto').val("").focus();
                           return false;
                       }
                       
                   });
               			
   });
   
   
</script><input type="hidden" class="alpha" value="A">
<div class="container section_wrapper">

  <div class="row">
      <div class="col-md-6 col-sm-6 col-xs-12 patient weight">
        <h2> Find Doctors by Name </h2>
      </div>
  </div>

  <div class="row">

    <div class="col-md-12">

      <div style="font-weight:600;" class="search-by col-md-12 col-sm-12 col-xs-12">
        <div class="col-md-9 col-sm-9 col-xs-12">
          Search By Name
          <input type="text" name="fname" placeholder="Doctor Name" class="textarea"> 
        </div>
        <div class="col-md-3 col-sm-3 col-xs-12">
          <div class="search-box searchbtn lg_btn" style="float:right;padding:10px;">Search</div> 
        </div>

      </div>

    </div>
  </div>

  <div class="row">
                <div class="col-md-1"></div>
                 <div class="col-md-10">
                     <div class="graybox">
                         <div id="navcontainer">
                             <ul>
                             <li class="alpha" style="border-right:3px solid #d2d2d2;"><a  target="A" class="alphabets selected">A</a></li>
                              <li class="alpha" style="border-right:3px solid #d2d2d2;"><a  target="B" class="alphabets">B </a></li>
                              <li class="alpha" style="border-right:3px solid #d2d2d2;"><a  target="C" class="alphabets">C</a></li>
                              <li class="alpha" style="border-right:3px solid #d2d2d2;"><a  target="D" class="alphabets">D</a></li>
                             
                             <li class="alpha"  style="border-right:3px solid #d2d2d2;"><a  target="E" class="alphabets">E</a></li>
                              <li class="alpha"  style="border-right:3px solid #d2d2d2;"><a  target="F" class="alphabets">F</a></li>
                              <li class="alpha"  style="border-right:3px solid #d2d2d2"><a  target="G" class="alphabets">G</a></li>
                              <li class="alpha"  style="border-right:3px solid #d2d2d2"><a  target="H" class="alphabets">H</a></li>
                             
                             <li class="alpha"  style="border-right:3px solid #d2d2d2;"><a  target="I" class="alphabets">I</a></li>
                              <li class="alpha"  style="border-right:3px solid #d2d2d2;"><a  target="J" class="alphabets">J</a></li>
                              <li class="alpha"  style="border-right:3px solid #d2d2d2;"><a  target="K" class="alphabets">K</a></li>
                              <li class="alpha"  style="border-right:3px solid #d2d2d2;"><a  target="L" class="alphabets">L</a></li>
                             
                             <li class="alpha"  style="border-right:3px solid #d2d2d2;"><a  target="M" class="alphabets">M</a></li>
                              <li class="alpha"  style="border-right:3px solid #d2d2d2;"><a  target="N" class="alphabets">N</a></li>
                              <li class="alpha"  style="border-right:3px solid #d2d2d2;"><a  target="O" class="alphabets">O</a></li>
                              <li class="alpha"  style="border-right:3px solid #d2d2d2;"><a  target="P" class="alphabets">P</a></li>
                             
                             <li class="alpha"  style="border-right:3px solid #d2d2d2;"><a  target="Q" class="alphabets">Q</a></li>
                              <li class="alpha"  style="border-right:3px solid #d2d2d2;"><a  target="R" class="alphabets">R</a></li>
                              <li class="alpha"  style="border-right:3px solid #d2d2d2"><a  target="S" class="alphabets">S</a></li>
                              <li class="alpha"  style="border-right:3px solid #d2d2d2"><a  target="T" class="alphabets">T</a></li>
                             
                             <li class="alpha"  style="border-right:3px solid #d2d2d2;"><a  target="U" class="alphabets">U</a></li>
                              <li class="alpha"  style="border-right:3px solid #d2d2d2;"><a  target="V" class="alphabets">V</a></li>
                              <li class="alpha"  style="border-right:3px solid #d2d2d2;"><a  target="W" class="alphabets">W</a></li>
                              <li class="alpha"  style="border-right:3px solid #d2d2d2;"><a  target="X" class="alphabets">X</a></li>
                             <li class="alpha"  style="border-right:3px solid #d2d2d2;"><a  target="Y" class="alphabets">Y</a></li>
                              <li class="alpha" ><a  target="Z" class="alphabets">Z</a></li>
                             
                         </ul>
                     </div>
                </div>
                 <div class="col-md-1"></div>
            </div>
          
        </div>

  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12 ser_pag">
    </div>
  </div>

</div>

<?php include("service/ui/common/footer.php"); ?>
