<?php
include("./conf/config.inc.php");

$data=$_POST;
//print_r($data);exit;

$page = $_POST['page'];
$alpha=$_POST['letter'];
$cur_page = $page;
$page -= 1;
$per_page = 24;
$previous_btn = true;
$next_btn = true;
$first_btn = true;
$last_btn = true;
$start = $page * $per_page;

 $result1 = $scad->getloca($alpha);
 $result = $scad->getloca1($alpha,$start,$per_page);
 $end  = count($result1);


        	
      

      
         $count=count($result);
		 if(!empty($result))
		 {
			 $msg .= '<ul style="width:100%;" class="ser_pag">';
			 
         for($i=0;$i<$count;$i++)
		 {
			
		  $msg .= '<li  class="spcl_foot1" id="'. $result[$i]['id'].'">
   <div class="col-li"><i class="fa fa-map-marker fa-2x"></i><p>'. $result[$i]['location_name'].'</p></div>
</li>';
		/*$msg .=' <div class="" style="width:33%;float:left">
         <div class="doctrdetails1">
            <ul>' ;
			
			
$msg .='<li class="doctradrs"><a href="'.WEB_ROOT. 'view-prrofile/' .$result[$i]['id'] .'" style="font-size:16px">'. $result[$i]['firstname']." ".$result[$i]['lastname'].'</a></li>
               <li style="width:50%">'. $result[$i]['address'].'</li>		
		
			
	
            </ul>
		 
         </div>
      </div>';*/
		 }
		 	$msg .= '</ul>';
		 }
		 else
		 {
			 $msg .=' <div class="no_result">No data to display </div>';
		 }


            	    	     
/* --------------------------------------------- */
//$query_pag_num = "SELECT COUNT(*) AS count FROM scad_speciality";

 $no_of_paginations = ceil($end / $per_page);
/* ---------------Calculating the starting and endign values for the loop----------------------------------- */
if ($cur_page >= 7) {
    $start_loop = $cur_page - 3;
    if ($no_of_paginations > $cur_page + 3)
        $end_loop = $cur_page + 3;
    else if ($cur_page <= $no_of_paginations && $cur_page > $no_of_paginations - 6) {
        $start_loop = $no_of_paginations - 6;
        $end_loop = $no_of_paginations;
    } else {
        $end_loop = $no_of_paginations;
    }
} else {
    $start_loop = 1;
    if ($no_of_paginations > 7)
        $end_loop = 7;
    else
        $end_loop = $no_of_paginations;
}

		 
/* ----------------------------------------------------------------------------------------------------------- */
$msg .= " <div class='col-md-12 col-sm-12 col-xs-12'><div class='rvwpaginatin'><ul>";

// FOR ENABLING THE FIRST BUTTON
if ($first_btn && $cur_page > 1) {
    $msg .= "<li p='1' class='activ'>First</li>";
} else if ($first_btn) {
    $msg .= "<li p='1' class='inactiv'>First</li>";
}

// FOR ENABLING THE PREVIOUS BUTTON
if ($previous_btn && $cur_page > 1) {
    $pre = $cur_page - 1;
    $msg .= "<li p='$pre' class='activ'>Prev</li>";
} else if ($previous_btn) {
    $msg .= "<li class='inactiv'>Prev</li>";
}
for ($i = $start_loop; $i <= $end_loop; $i++) {

    if ($cur_page == $i)
        $msg .= "<li p='$i' style='color:#fff;background-color:#c81e51;' class='activ'>{$i}</li>";
    else
        $msg .= "<li p='$i' class='activ'>{$i}</li>";
}

// TO ENABLE THE NEXT BUTTON
if ($next_btn && $cur_page < $no_of_paginations) {
    $nex = $cur_page + 1;
    $msg .= "<li p='$nex' class='activ'>Next</li>";
} else if ($next_btn) {
    $msg .= "<li class='inactiv'>Next</li>";
}

// TO ENABLE THE END BUTTON
if ($last_btn && $cur_page < $no_of_paginations) {
    $msg .= "<li p='$no_of_paginations' class='activ'>Last</li>";
} else if ($last_btn) {
    $msg .= "<li p='$no_of_paginations' class='inactiv'>Last</li>";
}


$msg = $msg . "</ul>" . $goto . $total_string . "</div></div>";  // Content for pagination
echo $msg;
//echo $_POST['id'];

?>