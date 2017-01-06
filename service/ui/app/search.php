<?php
   include ("service/ui/common/header.php");
   $searchTerms = base64_decode($searchData);
   parse_str($searchTerms);
   if ($searchData == 1) {
      $docSpeciality = 5;
   } else if ($searchData == 2) {
      $docSpeciality = 67;
   } else if ($searchData == 3) {
      $docSpeciality = 75;
   } else if ($searchData == 4) {
      $docSpeciality = 62;
   }
   if($docSpeciality){
      $selected = $docSpeciality;
   }
   else{
      $selected = NULL;
   }
   ?>
<input type="hidden" name="searchData" id="searchData" value="<?php echo $searchData;?>"/>
<script type="application/javascript" src="<?php echo WEB_ROOT?>service/public/js/search.js"></script>
<script src="http://maps.google.com/maps/api/js?sensor=false"></script>
<style>
   /*.dr_pfl_map.affix2{
   top:20%;
   margin: 0 0 0 0;
   z-index:99;
   position:fixed;
   display:inline;
   }*/
   .dr_pfl_map.fixing{
   margin: 0 0 0 0;
   position:absolute;
   display:inline !important;
   margin-top:50%;
   }
   .dr_pfl_map.fixing1{
   margin: 0 0 0 0;
   position:absolute;
   display:inline !important;
   margin-top:17%;
   }
   .dr_pfl_nav.affix2{
   top:0px;
   margin: 0 0 0 0;
   z-index:99;
   position:fixed;
   width:87%;0
   }
   .dr_pfl_map.affix1{
   top:247px;
   margin: 0 0 0 0;
   position:fixed;
   display:inline !important;
   }
   body::-webkit-scrollbar {
   width: 1em;
   }
   .before{
   left:40%;
   width:100%!important;height:100%!important;
   overflow: auto !important;
   }
   /*.after{
   left:40%;top:10%!important;width:822px;height:500px;
   overflow:hidden;
   padding:30px;
   }*/
   #bookModel{
   overflow:hidden;
   }
   .test{
   background-color:#093}
   .after{
   overflow: auto !important;
   left:40%;top:10%!important;
   width:822px;height:500px;
   padding:30px;
   }
   .hiddens{
   display: none;
   }
</style>
<div class="container">
   <div class="">
      <div class="category">
         <form id='advanceSearch-form'>
            <div class="categoryinner">
               <div class='row'>
                  <div class='col-md-3 col-sm-6 col-xs-12'>
                     <div class="section">
                        <h4>Specialty(Dermatologist,Dentist,etc.)</h4>
                     </div>
                     <div class="form">
                        <div class="category-select">
                           <select id="srchSpeciality" class="advanceSearch" name="srchSpeciality">
                              <optgroup label="All">
                                 <option value="" style="text-transform:unset;">Select a Speciality</option>
                                 <?php
                                    $condition = 'category_id = 1';
                                    $scad->listbox('speciality','id','name',$condition,'`id` ASC',$selected);?>
                              </optgroup>
                              <optgroup label="Therapist">
                                 <?php
                                    $condition = 'category_id = 2';
                                    $scad->listbox('speciality','id','name',$condition,'`id` ASC',$selected);?>
                              </optgroup>
                              <optgroup label="Dental">
                                 <?php
                                    $condition = 'category_id = 3';
                                    $scad->listbox('speciality','id','name',$condition,'`id` ASC',$selected);?>
                              </optgroup>
                              <optgroup label="Veterinary">
                                 <?php
                                    $condition = 'category_id = 4';
                                    $scad->listbox('speciality','id','name',$condition,'`id` ASC',$selected);?>
                              </optgroup>
                           </select>
                        </div>
                     </div>
                  </div>
                  <div class='col-md-3 col-sm-6 col-xs-12'>
                     <div class="section">
                        <h4>Location(Zip, City,State)</h4>
                     </div>
                     <div class="category-select">
                        <input type="text" id="srchZipcode" name="srchZipcode" placeholder="Zip, City, State" value="<?php echo $docZip;?>" class="input-block-level" style="min-height:36px;" >
                     </div>
                  </div>
                  <div class='col-md-3 col-sm-6 col-xs-12'>
                     <div class="section">
                        <h4>Insurance Plan</h4>
                     </div>
                     <div class="category-select">
                        <select name="insuranceSelect" class="advanceSearch" id="insuranceSelect">
                           <option value="">Select Insurance</option>
                           <?php if($insuranceSelect){$selected = $insuranceSelect;}else{$selected = NULL;}  $scad->listbox('insurance','id','name','`parent_id`=0','`name` ASC',$selected); ?>
                        </select>
                     </div>
                  </div>
                  <div class='col-md-3 col-sm-6 col-xs-12'>
                     <div class="section">
                        <h4>Gender</h4>
                     </div>
                     <div class="category-select">
                        <select id="gender" name="gender" class="select2_dr">
                           <option value="0">Doctor Gender</option>
                           <option value="1">Male</option>
                           <option value="2">Female</option>
                        </select>
                     </div>
                  </div>
               </div>
               <div class='row'>
                  <div class='col-md-3 col-sm-6 col-xs-12'>
                     <div class="section">
                        <h4>Reason for Visit</h4>
                     </div>
                     <div class="category-select">
                        <select class="select2_dr" name="srchReason" id="srchReason">
                           <option class="parent-346" value="0">Reason for Visit</option>
                           <?php $condition = '`speciality_id`="'.$docSpeciality.'"';if($srchReason){$selected = $srchReason;}else{$selected = NULL;}  $scad->listbox('reasonforvisit','id','name',$condition,'`name` ASC',$selected); ?>
                           <option class="parent-346" value="other">Other </option>
                        </select>
                        <input id="srchReasontxt" type="text" class="input-block-level" style="display:none" name="srchReason1" placeholder="Reason for visit">
                        <div class="smalbut">Options</div>
                     </div>
                  </div>
                  <div class='col-md-3 col-sm-6 col-xs-12'>
                     <div class="section">
                        <h4>Who Speaks</h4>
                     </div>
                     <div class="category-select">
                        <select class="select2_dr" name="language" id="srchLanguage">
                           <option value="0">Select a Language</option>
                           <?php $scad->listbox('languages','id','name',$condition=NULL,'`name` ASC',$selected=NULL);?>
                        </select>
                     </div>
                  </div>
                  <div class='col-md-3 col-sm-6 col-xs-12'>
                     <div class="dr_frm" id="loading" style="display: none;z-index:99">
                        <img style="margin: 34px 0 0 5px;"  src="<?php echo WEB_ROOT?>service/public/images/loading.gif" />
                     </div>
                     <div class="section">
                        <h4>Insurance</h4>
                        <div class="category-select">
                           <select name="subInsuranceSelect" class="advanceSearch" id="subInsuranceSelect">
                              <option value="">Select Insurance</option>
                              <?php if($subInsuranceSelect){$selected = $subInsuranceSelect;}else{$selected = NULL;}  $scad->listbox('insurance','id','name',$condition=NULL,'`name` ASC',$selected); ?>
                           </select>
                        </div>
                     </div>
                  </div>
                  <div class='col-md-3 col-sm-6 col-xs-12'>
                     <div id='advanceSearchBtn' class="search">
                        <a >
                           <h4>Search</h4>
                        </a>
                     </div>
                  </div>
               </div>
            </div>
         </form>
      </div>
      <div class="row"></div>
      <div class="spcdoctor">
         <div class="mainstrip"></div>
         <h2>SELECT A SPECIALITY DOCTORS</h2>
      </div>
      <div class="dtlist-form">
         <div class="row" style="background-color:#dadada; margin-left:0;margin-right:0;">
            <div class="col-md-4 col-xs-2">
               <div class="dt-arw1"><img id='prev' src="<?php echo WEB_ROOT?>service/public/images/images/Pre.png"></div>
            </div>
            <div class="col-md-4 col-xs-8">
               <div class="dttime">
                  <div class="dttime-list"><?php echo $date= date('D Y-m-d');?></div>
                  <div class="dttime-list"><?php echo date('D Y-m-d', strtotime($date. ' + 1 days')) ?></div>
                  <div class="dttime-list"><?php echo date('D Y-m-d', strtotime($date. ' + 2 days')) ?></div>
               </div>
            </div>
            <div class="col-md-4 col-xs-2">
               <div class="dt-arw2"><img id="next" src="<?php echo WEB_ROOT?>service/public/images/images/Nex.png"></div>
            </div>
         </div>
      </div>
   </div>
   <div class="result_found"></div>
   <div class="row" id="result_area">
      <div class="col-md-4">
         <div class="map_cate"><div id="map" ></div>
         <div class="online">
            <h3><img src="<?php echo WEB_ROOT?>service/public/images/images/commaa.png" style="margin-top:-16px;">Find Doctors and Make Appoiments Online"<img src="<?php echo WEB_ROOT?>service/public/images/images/comma.png"></h3>
         </div>
         </div>
      </div>
      <div class="col-md-8 data-fetch">
         <div class="row">
            <div class="col-md-6 details">
               <div class="profile">
                  <div class="col-md-4">
                     <div class="propic">
                        <img src="<?php echo WEB_ROOT?>service/public/images/images/Profile.jpg">
                     </div>
                     <div class="circle">
                        <p>1</p>
                     </div>
                     <span class="rating">
                     <input type="radio" class="rating-input"
                        id="rating-input-1-5" name="rating-input-1">
                     <label for="rating-input-1-5" class="rating-star"></label>
                     <input type="radio" class="rating-input"
                        id="rating-input-1-4" name="rating-input-1">
                     <label for="rating-input-1-4" class="rating-star"></label>
                     <input type="radio" class="rating-input"
                        id="rating-input-1-3" name="rating-input-1">
                     <label for="rating-input-1-3" class="rating-star"></label>
                     <input type="radio" class="rating-input"
                        id="rating-input-1-2" name="rating-input-1">
                     <label for="rating-input-1-2" class="rating-star"></label>
                     <input type="radio" class="rating-input"
                        id="rating-input-1-1" name="rating-input-1">
                     <label for="rating-input-1-1" class="rating-star"></label>
                     </span>
                  </div>
                  <div class="col-md-8">
                     <div class="name">
                        <h3>Dr.Jerin</h3>
                     </div>
                     <div class="prodt">
                        Acupuncturists<br>
                        4/32 Sterlling Height,MI 30342
                     </div>
                     <div class="row"></div>
                     <div class="viewpro">
                        <p><a href="#">View Profile</p>
                        </a>
                     </div>
                     <div class="book">
                        <p><a href="#">Book Online</p>
                        </a>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-md-12">
                        <div class="text">
                           <p>Average Rating Read reviews Book Online practice Name Neil Rosenthal,MD Specialitis Neurologist proffesional statement A Native of New York ,Dr.Rosent...
                           </p>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <div class="col-md-6 ">
               <div class="date-full">
                  <div class="date">
                     <ul>
                        <li>
                           <div class="date">8.00 AM</div>
                        </li>
                        <li>
                           <div class="date">8.00 AM</div>
                        </li>
                        <li>
                           <div class="date">8.00 AM</div>
                        </li>
                     </ul>
                  </div>
                  <div class="date">
                     <ul>
                        <li>
                           <div class="date">8.15 AM</div>
                        </li>
                        <li>
                           <div class="date">8.15 AM</div>
                        </li>
                        <li>
                           <div class="date">8.15 AM</div>
                        </li>
                     </ul>
                  </div>
                  <div class="date">
                     <ul>
                        <li>
                           <div class="date">8.30 AM</div>
                        </li>
                        <li>
                           <div class="date">8.30 AM</div>
                        </li>
                        <li>
                           <div class="date">8.30 AM</div>
                        </li>
                     </ul>
                  </div>
                  <div class="date">
                     <ul>
                        <li>
                           <div class="date">8.45 AM</div>
                        </li>
                        <li>
                           <div class="date">8.45 AM</div>
                        </li>
                        <li>
                           <div class="date">8.45 AM</div>
                        </li>
                     </ul>
                  </div>
                  <div class="more">
                     <ul>
                        <li>
                           <div class="more">More</div>
                        </li>
                        <li>
                           <div class="more">More</div>
                        </li>
                        <li>
                           <div class="more">More</div>
                        </li>
                     </ul>
                  </div>
               </div>
            </div>
         </div>
         <div class="between"></div>
         <div class="row">
            <div class="col-md-1">
            </div>
            <div class="col-md-11">
               <div class="pagination">
                  <a href="#" class="page">First</a><a href="#" class="page">Prev</a><a href="#" class=
                     "page active">1</a><a href="#" class="page1">2</a><span
                     class="page1">3</span><a href="#" class=
                     "page1">4</a><a href="#" class="page1">5</a>
                  <a href="#" class="page1">6</a>
                  <a href="#" class="page1">7</a>
                  <a href="#"
                     class="page">Next</a>
                  <a href="#"
                     class="page">Last</a>
               </div>
            </div>
         </div>
      </div>
   </div>
   <div class='row' id="pagination_area">   </div>
</div>

<div class="modal fade" tabindex="-1" role="dialog" id="book_pop">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-body">
         <div class="ball" data-dismiss="modal" aria-label="Close">
                <a href="javascript:void(0);"> <img src="<?php echo WEB_ROOT;?>service/public/images/images/ballinto.png"></a>
            </div>
        <div class="bkng_online_popupmain " style="background-color:#FFF; border-radius:6px;">
         <div class="popup_load" style="display:none;z-index:999;"></div>
         <div class="con"></div>
      </div>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div>
<!-- <div class="dr_pfl_outr" id="searchLoading" style="display:none;z-index:100;">
   <div class="dr_pfl_outr_load"></div>
   </div> -->
<?php include("service/ui/common/footer.php"); ?>
<script>
   $(document).ready(function(){
      //alert($(document).height()+'--'+$(window).height());
      $('#searchLoading').css('height',$(document).height());
   });
</script>
<script>
   function initialize() {
     var mapCanvas = document.getElementById('map');
     var mapOptions = {
       center: new google.maps.LatLng(44.5403, -78.5463),
       zoom: 8,
       mapTypeId: google.maps.MapTypeId.ROADMAP
     }
     var map = new google.maps.Map(mapCanvas, mapOptions)
   }
   google.maps.event.addDomListener(window, 'load', initialize);

   $('.category').addClass('original').clone().insertAfter('.category').addClass('cloned').css('position','fixed').css('top','0').css('margin-top','-50px').css('z-index','500').removeClass('original').hide();



scrollIntervalID = setInterval(stickIt, 10);


function stickIt() {

  var orgElementPos = $('.original').offset();
  var mapElementPos = $('.map_cate').offset();
  var limitElementPos = $('#pagination_area').offset();
  orgElementTop = orgElementPos.top; 
  mapElementTop = mapElementPos.top; 
  limitElementTop = limitElementPos.top;              

  if (($(window).scrollTop() >= (orgElementTop)) && (($(window).scrollTop() + $('.original').height()) <= (limitElementTop))) {
    // scrolled past the original position; now only show the cloned, sticky element.

    // Cloned element should always have same left position and width as original element.     
    orgElement = $('.original');
    coordsOrgElement = orgElement.offset();
    leftOrgElement = coordsOrgElement.left;  
    widthOrgElement = orgElement.css('width');
    mapwidth = $('#map').width('width');
    $('.cloned').css('left',leftOrgElement+'px').css('top',0).css('width',widthOrgElement).show();
    $('.map_cate').css({'z-index':'500','position':'fixed',top:$('.original').height(),'width':'27%'}).show();
    $('.original').css('visibility','hidden');
  }else {
    // not scrolled past the menu; only show the original menu.
    $('.cloned').hide();
    $('.original').css('visibility','visible');
    $('.map_cate').css({'z-index':'0','position':'relative',top:0,width:'auto'}).show();
    
  }
  if((($(window).scrollTop() + $('.original').height() + $('.map_cate').height()) >= (limitElementTop))){
    $('.map_cate').css({'z-index':'0','position':'relative',top:0,width:'auto'}).show();
  }
}
</script>