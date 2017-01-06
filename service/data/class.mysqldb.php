<?php
include_once "class.smtp.php";
include_once "class.phpmailer.php";
class mysqldb{

	function __construct(){
		//if db connection not exist, it will create aq new connection "con" 
		if (!$this->db){
		$this->db = new ezSQL_mysql(dbusername,dbpassword,dbname,host);
	 }
	
	}


	function get_account($key,$mail){
		echo $sql = "select * from `" . DB_PREFIX . "users` WHERE `email`='".base64_decode($mail,true)."' and `secret_key`='".$key."'";			
	 	return $this->db->get_row($sql,ARRAY_A);
	}
	//web service data
	function set_account($key,$mail){
		$sql = "update `" . DB_PREFIX . "users` SET status=1 WHERE `email`='".base64_decode($mail,true)."' and `secret_key`='".$key."'";			
	 	return $this->db->get_row($sql,ARRAY_A);
	}
	function get_table_selected_field_data($table,$fields){

		$sTable = DB_PREFIX .$table;
		$sField = implode(',', $fields);
		$sQuery = "SELECT $sField FROM $sTable"; 
		return $rResult = $this->db->get_results($sQuery,ARRAY_A) ;
	}
	function get_table_selected_field_data_where($table,$fields,$where){

		$sTable = DB_PREFIX .$table;
		$sField = implode(',', $fields);
		$sQuery = "SELECT $sField FROM $sTable";
		return $rResult = $this->db->get_results($sQuery,ARRAY_A) ;
	}
	function get_table_selected_field_data_like($table,$fields,$like,$search_text){

		$sTable = DB_PREFIX .$table;
		$sField = implode(',', $fields);
		//$sLike = implode(' or like',$like);
		foreach ($like as $key => $value) {
			$slike []= $value." like '%".$search_text."%'"; 	
		}
		$sLike = implode(' or ',$slike);
		$sQuery = "SELECT $sField FROM $sTable where  $sLike";
		return $rResult = $this->db->get_results($sQuery,ARRAY_A) ;
	}
	function getUserAppointmentDetails($userID){
		try 
		{
			$sql = "SELECT * FROM (SELECT * FROM `" . DB_PREFIX . "doctor_appointments` WHERE `patient_id`='".$userID."'  order by id desc) as tmpTable group by doctor_id";			
			return $this->db->get_results($sql,ARRAY_A);
		}
		catch(Exception $e)
		{
			echo $e->getMessage();
		}
	}
	 function userAppoinmentCount($doctor_id){
     try
     {
      
	      $sql = "SELECT doctor_id, count(doctor_id) as count from `" . DB_PREFIX . "doctor_appointments` WHERE `doctor_id`='".$doctor_id."'GROUP BY doctor_id";   
	        return $this->db->get_row($sql,ARRAY_A);
	  }
	  catch(Exception $e)
	  {
	   echo $e->getMessage();
	  }
	 }

	 function getDocSpeciality_web($party_id)
	{
		try
		{
			$sql = "SELECT spc.name,spc.id FROM " . DB_PREFIX . "speciality spc LEFT JOIN " . DB_PREFIX . "users docspc ON(docspc.speciality=spc.id) WHERE docspc.id = '".$party_id."'";
			return $this->db->get_row($sql,ARRAY_A);
		}
		catch(Exception $e)
		{
			echo $e->getMessage();
		}
	
	}
//web service data
function PdfDetails($doctor_id){
     try
     {
      
       $sql = "select * from scad_checkin where id=".$doctor_id;   
        return $this->db->get_results($sql,ARRAY_A);
  }
  catch(Exception $e)
  {
   echo $e->getMessage();
  }
 }
 function AppoinmentCount($doctor_id){
     try
     {
      
      $sql = "SELECT doctor_id, count(doctor_id) from `" . DB_PREFIX . "doctor_appointments` WHERE `doctor_id`='".$doctor_id."'GROUP BY doctor_id";   
        return $this->db->get_results($sql,ARRAY_A);
  }
  catch(Exception $e)
  {
   echo $e->getMessage();
  }
 }
//shilpa...............//
    
    
    function apnt_spec_with_docname($doctor_id,$speciality_id){
		
	$sql="SELECT scad_doctor_speciality.*, scad_users.firstname,scad_speciality.name as spec,specl.name as status FROM scad_doctor_speciality 
	INNER JOIN scad_users ON scad_doctor_speciality.doctor_id=scad_users.id 
	INNER JOIN scad_speciality ON scad_doctor_speciality.speciality_id=scad_speciality.id  
	INNER JOIN scad_speciality as specl ON scad_doctor_speciality.speciality_status=specl.id ";
	return $this->db->get_results($sql,ARRAY_A);
	}
    
    function apnt_insu_with_docname($doctor_id,$insurance_id){
		
	$sql="SELECT scad_doctor_insurance.*, scad_users.firstname,scad_insurance.name as ins,insu.name as sub FROM scad_doctor_insurance 
	INNER JOIN scad_users ON scad_doctor_insurance.doctor_id=scad_users.id 
	INNER JOIN scad_insurance ON scad_doctor_insurance.insurance_id=scad_insurance.id 
	INNER JOIN scad_insurance as insu ON scad_doctor_insurance.sub_insurance_id=insu.id ";
	return $this->db->get_results($sql,ARRAY_A);
	}
    
    
	function apnt_lang_with_docname($doctor_id,$language_id){
		
	$sql="SELECT scad_doctor_languages.*, scad_users.firstname,scad_languages.name as lang FROM scad_doctor_languages 
	INNER JOIN scad_users ON scad_doctor_languages.doctor_id=scad_users.id 
	INNER JOIN scad_languages ON scad_doctor_languages.language_id=scad_languages.id  ";
	return $this->db->get_results($sql,ARRAY_A);
	}
	  
	  
	function apnt_details_with_docname($doctor_id,$patient_id){
		
	$sql="SELECT scad_doctor_appointments.*, scad_users.firstname as doc_name ,user.firstname as patient_name FROM scad_doctor_appointments 
	INNER JOIN scad_users ON scad_doctor_appointments.doctor_id=scad_users.id 
	INNER JOIN scad_users as user ON scad_doctor_appointments.patient_id=user.id";
	return $this->db->get_results($sql,ARRAY_A);
	}
	
	function apnt_rtng_with_docname($doctor_id,$user_id){
		
	$sql="SELECT scad_ratings.*, scad_users.firstname,user.firstname as usertype FROM scad_ratings 
	INNER JOIN scad_users ON scad_ratings.doctor_id=scad_users.id 
	INNER JOIN scad_users as user ON scad_ratings.userid=user.id  ";
	return $this->db->get_results($sql,ARRAY_A);
	}
	
	
//----------------------------//	
	function getDownload($userid){
  try 
  {
   $sql = "SELECT * FROM `" . DB_PREFIX . "checkin` WHERE `apnt_id`='".$userid."'"; 
   return $this->db->get_row($sql,ARRAY_A);
  }
  catch(Exception $e)
  {
   echo $e->getMessage();
  }
 }
	function listbox($table,$key,$val,$condition=NULL,$order=NULL,$selected=NULL)
	{
		try 
		{
			$condition = ($condition<>"" ) ?  "AND $condition " : "";
			$order = ($order<>"" ) ?  "ORDER BY  $order " : "";
		    $sql ="SELECT $key,$val FROM `" . DB_PREFIX . "$table` WHERE 1 $condition $order";
			$res = $this->db->get_results($sql,ARRAY_A);
			foreach($res as $keys=>$value)
			{
				//echo $selected == $keys;
				$select = ($selected == $value[$key]) ? "selected='selected'" : "" ;
				$values.= "<option value='".$value[$key]."' $select>$value[$val]</value><br>";
			}
			echo $values;
		}
		catch(Exception $e)
		{
			echo $e->getMessage();
		}
	}
	function userExistancy($email){
		try 
		{
			$sql = "SELECT * FROM `" . DB_PREFIX . "users` WHERE `email`='".$email."'";			
			return count($this->db->get_row($sql,ARRAY_A));
		}
		catch(Exception $e)
		{
			echo $e->getMessage();
		}
	}
	function userDeatails($email,$password){
		try 
		{
			
			 $sql = "SELECT * FROM `" . DB_PREFIX . "users` WHERE `email`='".$email."' AND `password`='".md5($password)."'";			
			return $this->db->get_row($sql,ARRAY_A);
		}
		catch(Exception $e)
		{
			echo $e->getMessage();
		}
	}
	function getUserDetails($userID){
		try 
		{
			$sql = "SELECT * FROM `" . DB_PREFIX . "users` WHERE `id`='".$userID."'";			
			return $this->db->get_row($sql,ARRAY_A);
		}
		catch(Exception $e)
		{
			echo $e->getMessage();
		}
	}
function getAlpha($userID){
		try 
		{
			$sql = "SELECT id,firstname,lastname,address FROM `" . DB_PREFIX . "users` WHERE `usertype`='1' and firstname like '".$userID."%'";			
			return $this->db->get_results($sql,ARRAY_A);
		}
		catch(Exception $e)
		{
			echo $e->getMessage();
		}
	}	
	
function getAlpha1($userID,$start,$end){
		try 
		{
			$sql = "SELECT id,firstname,lastname,address FROM `" . DB_PREFIX . "users` WHERE `usertype`='1' and firstname like '".$userID."%' LIMIT ".$start." , ".$end."";			
			return $this->db->get_results($sql,ARRAY_A);
		}
		catch(Exception $e)
		{
			echo $e->getMessage();
		}
	}	
	
	function getSpecl($userID){
		try 
		{
			$sql = "SELECT spcl.*,users.* FROM `" . DB_PREFIX . "speciality` as spcl inner join `" . DB_PREFIX . "users` as users on users.speciality=spcl.id and spcl.name like '".$userID."%'";			
			return $this->db->get_results($sql,ARRAY_A);
		}
		catch(Exception $e)
		{
			echo $e->getMessage();
		}
	}	
	
function getSpecl1($userID,$start,$end){
		try 
		{
			$sql = "SELECT spcl.*,users.* FROM `" . DB_PREFIX . "speciality` as spcl inner join `" . DB_PREFIX . "users` as users on users.speciality=spcl.id and spcl.name like '".$userID."%' LIMIT ".$start." , ".$end."";			
			return $this->db->get_results($sql,ARRAY_A);
		}
		catch(Exception $e)
		{
			echo $e->getMessage();
		}
	}
	
	function getLang($userID){
		try 
		{
			$sql = "SELECT * FROM `" . DB_PREFIX . "languages` WHERE  name like '".$userID."%'";			
			return $this->db->get_results($sql,ARRAY_A);
		}
		catch(Exception $e)
		{
			echo $e->getMessage();
		}
	}	
	
function getLang1($userID,$start,$end){
		try 
		{
			$sql = "SELECT * FROM `" . DB_PREFIX . "languages` WHERE  name like '".$userID."%' LIMIT ".$start." , ".$end."";			
			return $this->db->get_results($sql,ARRAY_A);
		}
		catch(Exception $e)
		{
			echo $e->getMessage();
		}
	}
	
	
	
	
	
	
	function getInsura($userID){
		try 
		{
			$sql = "SELECT * FROM `" . DB_PREFIX . "insurance` WHERE  name like '".$userID."%'";			
			return $this->db->get_results($sql,ARRAY_A);
		}
		catch(Exception $e)
		{
			echo $e->getMessage();
		}
	}	
	
function getInsura1($userID,$start,$end){
		try 
		{
			$sql = "SELECT * FROM `" . DB_PREFIX . "insurance` WHERE  name like '".$userID."%' LIMIT ".$start." , ".$end."";			
			return $this->db->get_results($sql,ARRAY_A);
		}
		catch(Exception $e)
		{
			echo $e->getMessage();
		}
	}
	
	
	
	function getloca($userID){
		try 
		{
			$sql = "SELECT * FROM `" . DB_PREFIX . "location` WHERE  location_name like '".$userID."%'";			
			return $this->db->get_results($sql,ARRAY_A);
		}
		catch(Exception $e)
		{
			echo $e->getMessage();
		}
	}	
	
function getloca1($userID,$start,$end){
		try 
		{
			$sql = "SELECT * FROM `" . DB_PREFIX . "location` WHERE  location_name like '".$userID."%' LIMIT ".$start." , ".$end."";			
			return $this->db->get_results($sql,ARRAY_A);
		}
		catch(Exception $e)
		{
			echo $e->getMessage();
		}
	}
	
	
	
	function getDocid(){
		try 
		{
			//$sql = "SELECT * FROM `" . DB_PREFIX . "languages` WHERE  name like '".$userID."%'";	
			$sql = "SELECT A.`doctor_id` as doc_id,B.id FROM `" . DB_PREFIX . "ratings` A,`" . DB_PREFIX . "users` B WHERE A.`date` BETWEEN CURDATE() - INTERVAL 30 DAY AND CURDATE() AND A.`doctor_id`=B.`id` group by B.`id`";		
			return $this->db->get_results($sql,ARRAY_A);
		}
		catch(Exception $e)
		{
			echo $e->getMessage();
		}
	}
	
	function getDocidLimit($start,$end){
		try 
		{
			//$sql = "SELECT * FROM `" . DB_PREFIX . "languages` WHERE  name like '".$userID."%'";	
			$sql = "SELECT A.`doctor_id` as doc_id,B.id FROM `" . DB_PREFIX . "ratings` A,`" . DB_PREFIX . "users` B WHERE A.`date` BETWEEN CURDATE() - INTERVAL 30 DAY AND CURDATE() AND A.`doctor_id`=B.`id` group by B.`id` LIMIT ".$start." , ".$end."";		
			return $this->db->get_results($sql,ARRAY_A);
		}
		catch(Exception $e)
		{
			echo $e->getMessage();
		}
	}
	
	function getRatingCount($userID){
		try 
		{
			$sql = "SELECT count(doctor_id) as reviewCount FROM `" . DB_PREFIX . "ratings` WHERE `doctor_id`='".$userID."'";			
			return $this->db->get_row($sql,ARRAY_A);
		}
		catch(Exception $e)
		{
			echo $e->getMessage();
		}
	}
	
	function getAppointmentDetails($userID){
		try 
		{
			$sql = "SELECT * FROM `" . DB_PREFIX . "doctor_appointments` WHERE `doctor_id`='".$userID."'";			
			return $this->db->get_results($sql,ARRAY_A);
		}
		catch(Exception $e)
		{
			echo $e->getMessage();
		}
	}

	function getAppointmentDetailsWithDate($userID,$startDate,$endDate){
		try 
		{
			$sql = "SELECT * FROM `" . DB_PREFIX . "doctor_appointments` WHERE `doctor_id`='".$userID."' and (`apnt_date` BETWEEN '".$startDate."' AND '".$endDate."')";		
			return $this->db->get_results($sql,ARRAY_A);
		}
		catch(Exception $e)
		{
			echo $e->getMessage();
		}
	}
	
	function getApntDetails($userID,$date,$time,$pant_id){
		try 
		{
			$sql = "SELECT * FROM `" . DB_PREFIX . "doctor_appointments` WHERE `doctor_id`='".$userID."' and `apnt_date`='".$date."' and `apnt_starttime`='".$time."' and `patient_id`='".$pant_id."'";			
			return $this->db->get_results($sql,ARRAY_A);
		}
		catch(Exception $e)
		{
			echo $e->getMessage();
		}
	}
	
	
	function searchDoctor($speciality=NULL,$zip=NULL,$insuracePlan=NULL,$subInsurance=NULL,$srchReason=NULL,$language=NULL,$gender=NULL){
		try 
		{
			//echo $gender;
			//echo $speciality."--".$zip."--".$insuracePlan."--".$subInsurance."--".$language."--".$gender;
			$cond = "";
			$sql = "";
			if($speciality){
				/*$cond .= "       AND SPL.`id` = DSPL.`speciality_id` ";
				$cond .= "       AND USR.`id` = DSPL.`doctor_id` ";	*/	
				$cond .= "       AND SPL.`id` = '".$speciality."' ";
			}
			if($zip){
		$zipstart=$zip;
				$cond .= "       AND (USR.`zipcode` = '".$zipstart."' or USR.`city` =' ".$zipstart."' or USR.`state` = '".$zipstart."' )";
			}
			else{
				$zipstart=$zip;
				$cond .= "       AND (USR.`zipcode` = '".$zipstart."' or USR.`city` = '".$zipstart."' or USR.`state` = '".$zipstart."' )";
				}
			if($insuracePlan){				
				$cond .= "       AND DINS.`insurance_id` = '".$insuracePlan."'";
				$cond .= "       AND DINS.`sub_insurance_id` = '".$subInsurance."'";
			}
			if($language){
				$cond .= "       AND USR.`id` in (SELECT `doctor_id`       FROM   `" . DB_PREFIX . "doctor_languages`         WHERE  `language_id` = '$language'            ) ";
			}
			if($gender == 1 || $gender == 2){
				$cond .= "       AND USR.`gender` = '".$gender."' ";
			}
			/*if($srchReason){
				$cond .= "       AND USR.`id` = (SELECT `doctor_id`       FROM   `" . DB_PREFIX . "doctor_speciality`         WHERE  `speciality_id` = '$srchReason'           ) ";
			}*/
			$sql .= "SELECT USR.`id` AS doctorID, ";
			$sql .= "       USR.`firstname`, ";
			$sql .= "       USR.`lastname`, ";
			$sql .= "       USR.`address`, ";
			$sql .= "       USR.`zipcode`, ";
			$sql .= "       USR.`description`, ";
			$sql .= "       SPL.`id`                         AS specilaityID, ";
			$sql .= "       SPL.`name`                       AS specilaityName, ";
			//$sql .= "       DSPL.`speciality_id`             AS doctor_specilaityID, ";
			$sql .= "       (SELECT `name` ";
			$sql .= "        FROM   `" . DB_PREFIX . "userimages` ";
			$sql .= "        WHERE  `user_id` = USR.`id` ";
			$sql .= "               AND `set_profile` = '1') AS imageName, ";
			$sql .= "       DINS.`insurance_id`              AS insuranceID, ";
			$sql .= "       DINS.`sub_insurance_id`          AS subInsuranceID ";
			$sql .= "FROM   `" . DB_PREFIX . "users` USR, ";
			$sql .= "       `" . DB_PREFIX . "speciality` SPL, ";
			//$sql .= "       `" . DB_PREFIX . "doctor_speciality` DSPL, ";
			$sql .= "       `" . DB_PREFIX . "doctor_insurance` DINS ";
			$sql .= "WHERE  USR.`usertype` = 1   AND USR.`status` = '1' ";
			$cond .= "       AND SPL.`id` = USR.`speciality` ";
			//$cond .="        AND USR.`status` = 1 ";
			$sql .= $cond;
			$sql .= " GROUP  BY USR.`id` " ;	
			//echo $sql;exit;
			return $this->db->get_results($sql,ARRAY_A);
		}
		catch(Exception $e)
		{
			echo $e->getMessage();
		}	
	}
	function userCount(){
			try 
		{
			$sql = "SELECT Count(*) * FROM `" . DB_PREFIX . "users` WHERE `usertype`='1'";			
			return $this->db->get_results($sql,ARRAY_A);
		}
		catch(Exception $e)
		{
			echo $e->getMessage();
		}
		}
		
		function getUpcomingEvents($id,$date){
			try 
		{
			$sql = "SELECT * FROM `" . DB_PREFIX . "doctor_appointments` WHERE `status`='1' and patient_id=".$id." and apnt_date >='".$date."'";			
			return $this->db->get_results($sql,ARRAY_A);
		}
		catch(Exception $e)
		{
			echo $e->getMessage();
		}
		}
		
	function searchDoctorLimit($speciality=NULL,$zip=NULL,$insuracePlan=NULL,$subInsurance=NULL,$srchReason=NULL,$language=NULL,$gender=NULL,$start,$perpage){
		try 
		{
			//echo $speciality."--".$zip."--".$insuracePlan."--".$subInsurance."--".$language."--".$gender;
			$cond = "";
			$sql = "";
			if($speciality){
				/*$cond .= "       AND SPL.`id` = DSPL.`speciality_id` ";
				$cond .= "       AND USR.`id` = DSPL.`doctor_id` ";	*/	
				$cond .= "       AND SPL.`id` = '".$speciality."' ";
			}
			if($zip){
		$zipstart=$zip;
				$cond .= "       AND (USR.`zipcode` = '".$zipstart."' or USR.`city` = '".$zipstart."' or USR.`state` = '".$zipstart."' )";
			}
			else{
				//$zip=33324;
				$zipstart=$zip;
				//$cond .= "       AND (USR.`zipcode` = '".$zipstart."' or USR.`city` = '".$zipstart."' or USR.`state` = '".$zipstart."' )";
				}
			if($insuracePlan){				
				$cond .= "       AND DINS.`insurance_id` = '".$insuracePlan."'";
				$cond .= "       AND DINS.`sub_insurance_id` = '".$subInsurance."'";
			}
			if($language){
				$cond .= "       AND USR.`id` in (SELECT `doctor_id`       FROM   `" . DB_PREFIX . "doctor_languages`         WHERE  `language_id` = '$language'             ) ";
			}
			/*if($srchReason){
				$cond .= "       AND USR.`id` = (SELECT `speciality_id`       FROM   `" . DB_PREFIX . "speciality_id`         WHERE  `id` = '$srchReason'           ) ";
			}*/
			if($gender){
				$cond .= "       AND USR.`gender` = '".$gender."' ";
			}
			$sql .= "SELECT USR.`id` AS doctorID, ";
			$sql .= "       USR.`firstname`, ";
			$sql .= "       USR.`lastname`, ";
			$sql .= "       USR.`address`, ";
			$sql .= "       USR.`zipcode`, ";
			$sql .= "       USR.`description`, ";
			$sql .= "       SPL.`id`                         AS specilaityID, ";
			$sql .= "       SPL.`name`                       AS specilaityName, ";
			//$sql .= "       DSPL.`speciality_id`             AS doctor_specilaityID, ";
			$sql .= "       (SELECT `name` ";
			$sql .= "        FROM   `" . DB_PREFIX . "userimages` ";
			$sql .= "        WHERE  `user_id` = USR.`id` ";
			$sql .= "               AND `set_profile` = '1') AS imageName, ";
			$sql .= "       DINS.`insurance_id`              AS insuranceID, ";
			$sql .= "       DINS.`sub_insurance_id`          AS subInsuranceID ";
			$sql .= "FROM   `" . DB_PREFIX . "users` USR, ";
			$sql .= "       `" . DB_PREFIX . "speciality` SPL, ";
			//$sql .= "       `" . DB_PREFIX . "doctor_speciality` DSPL, ";
			$sql .= "       `" . DB_PREFIX . "doctor_insurance` DINS ";
			$sql .= "WHERE  USR.`usertype` = 1  AND USR.`status` = '1' ";
			$cond .= "       AND SPL.`id` = USR.`speciality` ";
			//$cond .="        AND USR.`status` = 1 ";
			$sql .= $cond;
			$sql .= " GROUP  BY USR.`id` ORDER BY `USR`.`id` ASC  LIMIT ".$start." , ".$perpage."" ;	
			//echo $sql;exit;
			return $this->db->get_results($sql,ARRAY_A);
		}
		catch(Exception $e)
		{
			echo $e->getMessage();
		}	
	}
	function getSpeciality($specilaityID){
		try 
		{
			$sql = "SELECT `name` FROM `" . DB_PREFIX . "speciality` WHERE `id`='".$specilaityID."'";			
			return $this->db->get_row($sql,ARRAY_A);
		}
		catch(Exception $e)
		{
			echo $e->getMessage();
		}
	}
	
	
	
	function getDocProImg($specilaityID){
		try 
		{
			$sql = "SELECT `name` FROM `" . DB_PREFIX . "userimages` WHERE `user_id`='".$specilaityID."' and `set_profile`=1";		
			return $this->db->get_row($sql,ARRAY_A);
		}
		catch(Exception $e)
		{
			echo $e->getMessage();
		}
	}
	function getImages($doctorID){
		try 
		{
			$sql = "SELECT `id`,`name`,`type`,`set_profile` FROM `" . DB_PREFIX . "userimages` WHERE `user_id`='".$doctorID."' ORDER BY `set_profile` DESC";	
			return $this->db->get_results($sql,ARRAY_A);
		}
		catch(Exception $e)
		{
			echo $e->getMessage();
		}
	}
	function getDoctorEvents($doctorID){
		try 
		{
			$sql = "SELECT * FROM `" . DB_PREFIX . "doctor_appointments` WHERE `doctor_id`='".$doctorID."'";	
			return $this->db->get_results($sql,ARRAY_A);
		}
		catch(Exception $e)
		{
			echo $e->getMessage();
		}
	}

	

	function getratingDetails($useridf){
		try 
		{
			$sql = "SELECT * FROM `" . DB_PREFIX . "ratings` WHERE `doctor_id`='".$useridf."'";	
			return $this->db->get_results($sql,ARRAY_A);
		}
		catch(Exception $e)
		{
			echo $e->getMessage();
		}
	}
	function getDoctorMarker($doctorID){
		try 
		{
			$sql = "SELECT * FROM `" . DB_PREFIX . "users` WHERE `usertype`='".$doctorID."'";	
			return $this->db->get_results($sql,ARRAY_A);
		}
		catch(Exception $e)
		{
			echo $e->getMessage();
		}
	}
	function getDisplayEvents($apntID,$doctorID,$patientID){
	
	try 
	{
		$sql = "SELECT APNT.id AS apntID,APNT.apnt_note AS notes,APNT.status,APNT.apnt_starttime AS apntStart,APNT.apnt_endtime AS apntEnd,APNT.apnt_date AS apntDate,USR.firstname AS patFname,USR.lastname AS patLname,USR.email AS Email,USR.phone AS phone
FROM `scad_doctor_appointments` APNT,`scad_users` USR WHERE APNT.`patient_id`=USR.`id` AND APNT.id='".$apntID."' AND APNT.`doctor_id`='".$doctorID."' AND APNT.`patient_id` = '".$patientID."'";	
		return $this->db->get_row($sql,ARRAY_A);
	}
	catch(Exception $e)
	{
		echo $e->getMessage();
	}
	
	
	}
	function mailSending($toMail,$toName,$subject,$mailTemplate){
		// $mail = new PHPMailer();
		// $mail->isSMTP();
		// $mail->CharSet = 'UTF-8';
		// $mail->SMTPDebug = 1;
		// $mail->Debugoutput = 'html';
		// $mail->Host = MAIL_HOST;
		// $mail->Port = MAIL_PORT;
		// $mail->SMTPSecure = 'tls';
		// $mail->SMTPAuth = true;
		// $mail->Username = MAIL_USERNAME;
		// $mail->Password = MAIL_PASSWORD;
		// $mail->setFrom(FROM_ADDRESS, FROM_NAME);
		// $mail->IsHTML(false);
		// //$mail->addReplyTo('aneesh@techware.co.in', 'Test NameReply');
		// $mail->addAddress($toMail,$toName);
		// $mail->Subject = $subject;
		// $mail->msgHTML($mailTemplate);
		// //$mail->AltBody = 'This is a plain-text message body';
		// if(!$mail->Send()) {
		// 	echo 'Message could not be sent.';
		// 	echo 'Mailer Error: ' . $mail->ErrorInfo;
		// 	exit;
		// }
		//  echo 'Message has been sent';

		$to = $toMail;
		$subject = $subject;
		$txt = $mailTemplate;
		$headers = "MIME-Version: 1.0" . "\r\n";
		$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
		$headers .= "From: ".MAIL_USERNAME;

		mail($to,$subject,$txt,$headers);
		}
	//arun code begin
		function getDoctorImages($tbname,$where)
	{
		try
		{
			$sql = "SELECT * FROM `" . DB_PREFIX . "$tbname` WHERE $where";
			return $this->db->get_results($sql,ARRAY_A);
		}
		catch(Exception $e)
		{
			echo $e->getMessage();
		}
	}
	function checkProfileImageExist($tbname,$where)
	{
		try
		{
			$sql = "SELECT * FROM `" . DB_PREFIX . "$tbname` WHERE $where";
			return $this->db->get_results($sql,ARRAY_A);
		}
		catch(Exception $e)
		{
			echo $e->getMessage();
		}
	}
	//code end
	
	function listbox_data($table,$key,$val,$condition=NULL,$order=NULL,$selected=NULL)
	{
		try 
		{	
			$condition = ($condition<>"" ) ?  "AND $condition " : "";
			$order = ($order<>"" ) ?  "ORDER BY  $order " : "";
			$sql ="SELECT $key,$val FROM $table WHERE 1 $condition ";
			$res = $this->db->get_results($sql,ARRAY_A);
			foreach($res as $keys=>$value){
				$values[]= array('id'=>$value[$val],'name'=>$value[$key]);					
			}
			return $values;
		}
		catch(Exception $e)
		{
			echo $e->getMessage();
		}
	}
	function escape($string){ 
		/* if(get_magic_quotes_runtime()) $string = stripslashes($string); 
		return @mysql_real_escape_string($string);  */
		return $string;
	}
	
	function multiListbox($table,$key,$val,$condition=NULL,$order=NULL,$selected_array=NULL)
	{

		try
		{
			//multiListbox
			$condition = ($condition<>"" ) ?  "AND $condition " : "";
			$order = ($order<>"" ) ?  "ORDER BY  $order " : "";
			$sql ="SELECT $key,$val FROM $table WHERE 1 $condition ";
			$res = $this->db->get_results($sql,ARRAY_A);
			if($res)
			{
				foreach($res as $keys=>$value)
				{
					$select = (in_array($value[$val],$selected_array)) ? "selected='selected'" : "" ;
					$values.= "<option value='".$value[$val]."' $select>$value[$key]</value><br>";
					//$values .= $value[$val].$value[$key]."<br>";
				}
			}
			echo $values;
		}
		catch(Exception $e)
		{
			echo $e->getMessage();
		}
	}
	
	function selectsinglerow($param)
	{
		try
		{
			$sql = "SELECT party_id FROM party WHERE party_email = '".$param."'";
			return $this->db->get_row($sql);	
		}
		catch(Exception $e)
		{
			echo $e->getMessage();
		}
	}
	
	function getPartyDetails($party_id)
	{
		try
		{
			$sql = "SELECT pty.party_id, usr.username AS party_email, party_name, prsn.person_type  FROM  user usr  LEFT JOIN  party pty ON(usr.party_id=pty.party_id)  LEFT JOIN person prsn  ON(pty.party_id=prsn.party_id)  WHERE pty.party_id = '".$party_id."'  AND pty.party_type_id ='1'";
			return $this->db->get_row($sql);
		}
		catch(Exception $e)
		{
			echo $e->getMessage();
		}
	
	}
	
	function getDocSpeciality($party_id)
	{
		try
		{
			/*$sql = "SELECT pty.party_id, usr.username AS party_email, party_name, prsn.person_type  FROM  user usr  LEFT JOIN  party pty ON(usr.party_id=pty.party_id)  LEFT JOIN person prsn  ON(pty.party_id=prsn.party_id)  WHERE pty.party_id = '".$party_id."'  AND pty.party_type_id ='1'";*/
			  $sql = "SELECT spc.name,spc.id FROM " . DB_PREFIX . "speciality spc LEFT JOIN " . DB_PREFIX . "doctor_speciality docspc ON(docspc.speciality_id=spc.id) WHERE docspc.doctor_id = '".$party_id."'";
			return $this->db->get_results($sql,ARRAY_A);
		}
		catch(Exception $e)
		{
			echo $e->getMessage();
		}
	
	}
	
	function getDocLang($party_id)
	{
		try
		{
			/*$sql = "SELECT pty.party_id, usr.username AS party_email, party_name, prsn.person_type  FROM  user usr  LEFT JOIN  party pty ON(usr.party_id=pty.party_id)  LEFT JOIN person prsn  ON(pty.party_id=prsn.party_id)  WHERE pty.party_id = '".$party_id."'  AND pty.party_type_id ='1'";*/
			$sql = "SELECT spc.name,spc.id FROM " . DB_PREFIX . "languages spc LEFT JOIN " . DB_PREFIX . "doctor_languages docspc ON(docspc.language_id=spc.id) WHERE docspc.doctor_id = '".$party_id."'";
			return $this->db->get_results($sql,ARRAY_A);
		}
		catch(Exception $e)
		{
			echo $e->getMessage();
		}
	
	}
	
	
	function getDocInsu($party_id)
	{
		try
		{
			/*$sql = "SELECT pty.party_id, usr.username AS party_email, party_name, prsn.person_type  FROM  user usr  LEFT JOIN  party pty ON(usr.party_id=pty.party_id)  LEFT JOIN person prsn  ON(pty.party_id=prsn.party_id)  WHERE pty.party_id = '".$party_id."'  AND pty.party_type_id ='1'";*/
			$sql = "SELECT spc.name,spc.id FROM " . DB_PREFIX . "insurance spc LEFT JOIN " . DB_PREFIX . "doctor_insurance docspc ON(docspc.insurance_id=spc.id) WHERE docspc.doctor_id = '".$party_id."'";
			return $this->db->get_results($sql,ARRAY_A);
		}
		catch(Exception $e)
		{
			echo $e->getMessage();
		}
	
	}
	
	function getAllDetails($param) 
	{
		
		try
		{
			$sql="select * from party_person_vw where PartyID  = '".$param."'";
			return $this->db->get_row($sql);
		}
		catch(Exception $e)
		{
			echo $e->getMessage();
		}
	}
	function getEducationdatas($person_Id)
	{
		try
		{
			$sql = "SELECT GROUP_CONCAT(er.education_id),GROUP_CONCAT(e.education_name) as Education FROM education_relation er LEFT JOIN education e ON (e.education_id = er.education_id) WHERE er.person_id='".$person_Id."'";
			return $this->db->get_row($sql);
		}
		catch(Exception $e)
		{
			echo $e->getMessage();
		}
	
	}
	
	function getloginCredentials($userid,$pass)
	{
		try
		{
			$sql="SELECT party_id,passcode,party_name,party_email FROM party WHERE party_email = '".$userid."' AND passcode = '".$pass."'";
			return $this->db->get_row($sql);
		}
		catch(Exception $e)
		{
			echo $e->getMessage();
		}
	}
	function getEducationData($person_id)
	{
		try
		{
			$sql ="SELECT education_id FROM education_relation WHERE person_id='".$person_id."'";
			$res = $this->db->get_results($sql,ARRAY_A);
			foreach($res as $value){
				$array_education[] =	$value;		
			}
			return $array_education;
		}
		catch(Exception $e)
		{
			echo $e->getMessage();
		}
	}
	
	function getLanguageData($person_id)
	{
		try
		{
			$sql ="SELECT language_id FROM langugae_relation WHERE person_id='".$person_id."'";
			$res = $this->db->get_results($sql,ARRAY_A);
			foreach($res as $value){
				$array_language[] =	$value;		
			}
			return $array_language;
		}
		catch(Exception $e)
		{
			echo $e->getMessage();
		}
	}
	
	function update($table, $data, $where='1')
	{ 
		try
		{
			$q="UPDATE `" . DB_PREFIX . "$table`  SET ";
			foreach($data as $key=>$val)
			{ 
				if(strtolower($val)=='null') $q.= "`$key` = NULL, "; 
				elseif(strtolower($val)=='now()') $q.= "`$key` = NOW(), "; 
				elseif(preg_match("/^increment\((\-?\d+)\)$/i",$val,$m)) $q.= "`$key` = `$key` + $m[1], ";  
				else $q.= "`$key`='".$val."', "; 
			} 
		 $q = rtrim($q, ', ') . ' WHERE '.$where.';'; 
		// echo $q;exit;
		   echo $this->db->query($q); 
		}
		catch(Exception $e)
		{
			echo $e->getMessage();
		}
	}
		function update_re($table, $data, $where='1')
	{ 
		try
		{
			$q="UPDATE `" . DB_PREFIX . "$table`  SET ";
			foreach($data as $key=>$val)
			{ 
				if(strtolower($val)=='null') $q.= "`$key` = NULL, "; 
				elseif(strtolower($val)=='now()') $q.= "`$key` = NOW(), "; 
				elseif(preg_match("/^increment\((\-?\d+)\)$/i",$val,$m)) $q.= "`$key` = `$key` + $m[1], ";  
				else $q.= "`$key`='".$val."', "; 
			} 
		 $q = rtrim($q, ', ') . ' WHERE '.$where.';'; 
		// echo $q;exit;
		   return $this->db->query($q); 
		}
		catch(Exception $e)
		{
			echo $e->getMessage();
		}
	}
	function delete($table,$where='')
	{
		try
		{
			$sql = "DELETE FROM `" . DB_PREFIX . "$table` WHERE $where";
			return $this->db->query($sql); 
		}
		catch(Exception $e)
		{
			echo $e->getMessage();
		}
	}	
	function getPhysicianDetails()
	{
		try
		{
			$sql = "SELECT pty.party_id,pty.party_name,	usr.username AS party_email, rcp.recipient_printer,rcp.recipient_printer_url,	rcp.recipient_draft FROM party pty 	LEFT JOIN user usr ON(usr.party_id=pty.party_id) LEFT JOIN person prsn ON(pty.party_id=prsn.party_id) LEFT JOIN recipient rcp ON(pty.party_id = rcp.party_id) WHERE prsn.person_type='3' AND pty.party_type_id='1'";
		return $this->db->get_results($sql,ARRAY_A);
		}
		catch(Exception $e)
		{
			echo $e->getMessage();
		}
	}
	function getDoctorDetails($doctor_id)
	{
		try
		{
			$sql = "SELECT pty.party_id,person_id,person_fname,person_lname,usr.username AS party_email,rcp.recipient_printer,rcp.recipient_printer_url,rcp.recipient_draft FROM party pty 	LEFT JOIN user usr ON(usr.party_id=pty.party_id) LEFT JOIN person prsn ON (pty.party_id=prsn.party_id) left join recipient rcp on (pty.party_id = rcp.party_id)  WHERE person_type='3' and pty.party_id='".$doctor_id."'";
			return $this->db->get_row($sql,ARRAY_A);
		}
		catch(Exception $e)
		{
			echo $e->getMessage();
		}
	}
	function selectsingledata()
	{
		try
		{
			$sql="SELECT pty.party_id, party_name,party_email,rcp.recipient_printer,rcp.recipient_printer_url,rcp.recipient_draft FROM party pty LEFT JOIN person prsn ON(pty.party_id=prsn.party_id) left join recipient rcp on (pty.party_id = rcp.party_id) WHERE prsn.person_type='3' AND pty.party_type='1'";
			return $this->db->get_row($sql);
		}
		catch(Exception $e)
		{
			echo $e->getMessage();
		}
	}
	
	function insert($table, $data)
	{ 
		try
		{
			$q="INSERT INTO `" . DB_PREFIX . "$table` "; 
			$v=''; $n='';
			
			foreach($data as $key=>$val)
			{ 
				$n.="`$key`, "; 
				if(strtolower($val)=='null') $v.="NULL, "; 
				elseif(strtolower($val)=='now()') $v.="NOW(), "; 
				else $v.= "'".$this->escape($val)."', "; 
			} 
			$q .= "(". rtrim($n, ', ') .") VALUES (". rtrim($v, ', ') .");";
			//echo $q; 			
			if($this->db->query($q))
			{ 
				return $this->db->insert_id; 
			} 
			else 
			{
				return false; 
			}
		}
		catch(Exception $e)
		{
			echo $e->getMessage();
		}
	}
	function getAllTableData($tbname,$where)
	{
		try
		{
			$sql = "SELECT * FROM " . DB_PREFIX . "$tbname WHERE $where";
			return $this->db->get_row($sql);
		}
		catch(Exception $e)
		{
			echo $e->getMessage();
		}
	}

	function getAllTableData1($tbname,$where)
	{
		try
		{
			$sql = "SELECT * FROM " . DB_PREFIX . "$tbname WHERE $where";
			return $this->db->get_results($sql,ARRAY_A);
		}
		catch(Exception $e)
		{
			echo $e->getMessage();
		}
	}
	function getAllData($tbname)
	{
		try
		{
			$sql = "SELECT * FROM " . DB_PREFIX . "$tbname ";
			return $this->db->get_results($sql,ARRAY_A);
		}
		catch(Exception $e)
		{
			echo $e->getMessage();
		}
	}
	
	function getUserExist($username,$password)
	{
		try
		{
			$sql = "SELECT * FROM `" . DB_PREFIX . "user` WHERE username='".$username."' AND password='".md5($password)."'";
			return $this->db->get_row($sql,ARRAY_A);
		}
		catch(Exception $e)
		{
			echo $e->getMessage();
		}
	}
	function setUserserSsion($userID)
	{
		try
		{
			$sql = "INSERT INTO `" . DB_PREFIX . "usersession` (`user_id`, `usersession_id`) VALUES ('".$userID."', FLOOR(10000 + RAND() * 89999))";
			$this->db->query($sql);
			$this->db->insert_id;
			$query = "SELECT * FROM `" . DB_PREFIX . "usersession` WHERE id='".$this->db->insert_id."'";
			return $this->db->get_row($query,ARRAY_A);
		}
		catch(Exception $e)
		{
			echo $e->getMessage();
		}
	}
function getUsers()
	{
		try
		{
			echo $sql = "SELECT * FROM `" . DB_PREFIX . "user`";
			return $this->db->get_results($sql);
		}
		catch(Exception $e)
		{
			echo $e->getMessage();
		}
	}
function getLnt($zip){
	// $url = "http://maps.googleapis.com/maps/api/geocode/json?address=
	// ".urlencode($zip)."&sensor=false";
	// $result_string = file_get_contents($url);
	// $result = json_decode($result_string, true);
	// //print_r($result);exit;
	// return $result['results'][0]['geometry']['location'];
		$Address = urlencode($zip);
		$request_url = "http://maps.googleapis.com/maps/api/geocode/xml?address=".$Address."&sensor=true";
		$xml = simplexml_load_file($request_url) or die("url not loading");
		$status = $xml->status;
		if ($status=="OK") {
		return get_object_vars($xml->result->geometry->location);
		}
}
function getDetails($useridf){
		try 
		{
			$sql = "SELECT * FROM `" . DB_PREFIX . "doctor_appointments` WHERE `patient_id`='".$useridf."' GROUP BY doctor_id";	
			return $this->db->get_results($sql,ARRAY_A);
		}
		catch(Exception $e)
		{
			echo $e->getMessage();
		}
	}
	function getDetails1($useridf,$date){
		try 
		{
			 $sql = "SELECT * FROM `" . DB_PREFIX . "doctor_appointments` WHERE `patient_id`='".$useridf."' and `apnt_date`<='".$date."' ORDER BY id DESC ";	
			return $this->db->get_results($sql,ARRAY_A);
		}
		catch(Exception $e)
		{
			echo $e->getMessage();
		}
	}
	function getDocDetails($userID){
		try 
		{
			$sql = "SELECT * FROM `" . DB_PREFIX . "users` WHERE `id`='".$userID."' ";			
			return $this->db->get_results($sql,ARRAY_A);
		}
		catch(Exception $e)
		{
			echo $e->getMessage();
		}
	}
	function userting($doctor_id,$user_id){
    	try
    	{
    		
    	$sql = "SELECT * FROM `" . DB_PREFIX . "ratings` WHERE `doctor_id`='".$doctor_id."' and `userid`='".$user_id."'";			
			return $this->db->get_row($sql,ARRAY_A);
		}
		catch(Exception $e)
		{
			echo $e->getMessage();
		}
	}

	
	function getrting($doctor_id){
    	try
    	{
    		
    	$sql = "SELECT * FROM `" . DB_PREFIX . "ratings` WHERE `doctor_id`='".$doctor_id."'";			
			return $this->db->get_results($sql,ARRAY_A);
		}
		catch(Exception $e)
		{
			echo $e->getMessage();
		}
	}
	function ratinglimit($doctor_id,$start,$end){
    	try
    	{
    		
       $sql = "SELECT * FROM `" . DB_PREFIX . "ratings` WHERE `doctor_id`='".$doctor_id."' ORDER by id DESC  LIMIT ".$start." , ".$end."";			
			return $this->db->get_results($sql,ARRAY_A);
		}
		catch(Exception $e)
		{
			echo $e->getMessage();
		}
	}
	
	//function server_response($table,$fields,$where,$type){
	function server_response_backup($fields,$type){
    //$aColumns = array( 'firstname', 'email', 'lastname', 'dob');
		$aLists=json_decode(base64_decode($fields),true);
     $aColumns =$aLists['columns'];
     $where =$aLists['where'];
     $table =$aLists['table'];
     //print_r($aLists);exit;
   
    $sIndexColumn = "id";
 
    $sTable = DB_PREFIX .$table;
		/*
     * Paging
     */
    $sLimit = "";
    if ( isset( $_GET['iDisplayStart'] ) && $_GET['iDisplayLength'] != '-1' )
    {
        $sLimit = "LIMIT ".intval( $_GET['iDisplayStart'] ).", ".
            intval( $_GET['iDisplayLength'] );
    }
     
     
    /*
     * Ordering
     */
    $sOrder = "";
    if ( isset( $_GET['iSortCol_0'] ) )
    {
        $sOrder = "ORDER BY  ";
        for ( $i=0 ; $i<intval( $_GET['iSortingCols'] ) ; $i++ )
        {
            if ( $_GET[ 'bSortable_'.intval($_GET['iSortCol_'.$i]) ] == "true" )
            {
                $sOrder .= $aColumns[ intval( $_GET['iSortCol_'.$i] ) ]."
                    ".($_GET['sSortDir_'.$i]==='asc' ? 'asc' : 'desc') .", ";
            }
        }
         
        $sOrder = substr_replace( $sOrder, "", -2 );
        if ( $sOrder == "ORDER BY" )
        {
            $sOrder = "";
        }
    }
     
     
    /*
     * Filtering
     * NOTE this does not match the built-in DataTables filtering which does it
     * word by word on any field. It's possible to do here, but concerned about efficiency
     * on very large tables, and MySQL's regex functionality is very limited
     */
    $sWhere = "";
    $ex_where=$where;
    
    if ( (isset($_GET['sSearch']) && $_GET['sSearch'] != "" )|| (isset($ex_where) && $ex_where != "" ))
    {
        $sWhere = "WHERE (";
        	$sWhere .= $ex_where['fieldname']."=".$ex_where['value'];
        	if(isset($_GET['sSearch']) && $_GET['sSearch'] != "" ){
        for ( $i=0 ; $i<count($aColumns) ; $i++ )
        {
            if ( isset($_GET['bSearchable_'.$i]) && $_GET['bSearchable_'.$i] == "true" )
            {
                $sWhere .= $aColumns[$i]." LIKE '%".mysql_real_escape_string( $_GET['sSearch'] )."%' OR ";
            }
        }
        $sWhere = substr_replace( $sWhere, "", -3 );}

        $sWhere .= ')';
    }
     
    /* Individual column filtering */
    for ( $i=0 ; $i<count($aColumns) ; $i++ )
    {
        if ( isset($_GET['bSearchable_'.$i]) && $_GET['bSearchable_'.$i] == "true" && $_GET['sSearch_'.$i] != '' )
        {
            if ( $sWhere == "" )
            {
                $sWhere = "WHERE ";
            }
            else
            {
                $sWhere .= " AND ";
            }
            $sWhere .= $aColumns[$i]." LIKE '%".mysql_real_escape_string($_GET['sSearch_'.$i])."%' ";
        }
    }
     
     
    /*
     * SQL queries
     * Get data to display
     */
    /*$sQuery = "
        SELECT SQL_CALC_FOUND_ROWS ".str_replace(" , ", " ", implode(", ", $aColumns))."
        FROM   $sTable
        $sWhere
        $sOrder
        $sLimit
    ";*/

    $sQuery = "
        SELECT *
        FROM   $sTable
        $sWhere
        $sOrder
        $sLimit
    ";
    $rResult = $this->db->get_results($sQuery,ARRAY_A) ;
     //echo $rResult[0]['firstname'];echo '<pre>';print_r($rResult);echo '</pre>';echo count($rResult);exit;
    /* Data set length after filtering */
    $sQuery = "
        SELECT FOUND_ROWS()
    ";
    $rResultFilterTotal = $this->db->get_results($sQuery,ARRAY_A) ;
    $aResultFilterTotal = count($rResultFilterTotal);
    $iFilteredTotal = $aResultFilterTotal;
     
    /* Total data set length */
    $sQuery = "
        SELECT COUNT(".$sIndexColumn.")
        FROM   $sTable
    ";
    $rResultTotal = $this->db->get_results($sQuery,ARRAY_A) ;
    $aResultTotal = count($rResultTotal);
    $iTotal = $aResultTotal;
     
     
    /*
     * Output
     */
    /*
	$output = array(
        "sEcho" => intval($_GET['sEcho']),
        "iTotalRecords" => $iTotal,
        "iTotalDisplayRecords" => $iFilteredTotal,
        "aaData" => array()
    );
	*/
     
        $row = array();
        for ( $i=0 ; $i<count($rResult) ; $i++ )
        {
                for ( $j=0 ; $j<count($aColumns) ; $j++ )
        		{

           			 
           			 if($aColumns[$j]=='name' && $type=='doctor_files_lists'){
           			 	$row[$i][] = '<img src='.WEB_ROOT.'service/public/z_uploads/doctor/small/'.$rResult[$i][ $aColumns[$j]].'>';
           			 }else{
           			 	$row[$i][] = $rResult[$i][ $aColumns[$j]];
           			 }
            	}
            	$key_type=array('gender','doctor_files_lists','usertypes');
            	if (!(in_array($type, $key_type)) ){
            	$row[$i][] = '<a href="'.WEB_ROOT.'index.php/admin/view?type='.$type.'&tb='.base64_encode($table).'&id='.base64_encode($rResult[$i]["id"]).'"><i class="fa fa-eye"></i></a>
                       	<a href="'.WEB_ROOT.'index.php/admin/edit?type='.$type.'&tb='.base64_encode($table).'&id='.base64_encode($rResult[$i]["id"]).'"><i class="fa fa-pencil"></i></a>
                        <a class="delete_row" href="'.WEB_ROOT.'index.php/admin/delete?type='.$type.'&tb='.base64_encode($table).'&id='.base64_encode($rResult[$i]["id"]).'"><i class="fa fa-trash-o "></i></a>';
                    }
            	//unset($row);
            	//print_r($row);exit;
        }
        $output['aaData']= $row;
     
    echo json_encode( $output );
	}

	function get_td_field_data($table,$id,$field){

		$sTable = DB_PREFIX .$table;
		$sWhere ='where id='.$id.'';
		$sField = $field;
		$sQuery = "
        SELECT $field
        FROM   $sTable
        $sWhere
    ";
   // echo $sQuery;
    return $rResult = $this->db->get_row($sQuery,ARRAY_A) ;
	}

	function get_td_data($table,$id){

		$sTable = DB_PREFIX .$table;
		$sWhere ='where id='.$id.'';
		$sQuery = "
        SELECT *
        FROM   $sTable
        $sWhere
    ";
   // echo $sQuery;
    return $rResult = $this->db->get_row($sQuery,ARRAY_A) ;
	}

	function get_td_data1($table,$id){

		$sQuery =      "show full columns from ".DB_PREFIX .$table."";
    //echo $sQuery;
    return $rResult = $this->db->get_results($sQuery,ARRAY_A) ;
	}

	//multiple table join server response
	//function server_response1($table,$fields,$where,$type,$multiple){
function server_response1($list,$type){
    //$aColumns = array( 'firstname', 'email', 'lastname', 'dob');
    $alistColumns =json_decode(base64_decode($list),true);
    // print_r($alistColumns['where']);exit;
   	// assign values to fields
   	 $table=$alistColumns['table'];
     $aColumns=$alistColumns['columns'];
     $where=$alistColumns['where'];
     $multiple=$alistColumns['multiple'];
     $aJoin=$alistColumns['join_table'];
     $next_type=$alistColumns['next_action'];
    $sIndexColumn = "id";
 
    $sTable = DB_PREFIX .$table;
		/*
     * Paging
     */
    $sLimit = "";
    if ( isset( $_GET['iDisplayStart'] ) && $_GET['iDisplayLength'] != '-1' )
    {
        $sLimit = "LIMIT ".intval( $_GET['iDisplayStart'] ).", ".
            intval( $_GET['iDisplayLength'] );
    }
     
     
    /*
     * Ordering
     */
    $sOrder = "";
    if ( isset( $_GET['iSortCol_0'] ) )
    {
        $sOrder = "ORDER BY  ";
        for ( $i=0 ; $i<intval( $_GET['iSortingCols'] ) ; $i++ )
        {
            if ( $_GET[ 'bSortable_'.intval($_GET['iSortCol_'.$i]) ] == "true" )
            {
                $sOrder .= $aColumns[ intval( $_GET['iSortCol_'.$i] ) ]."
                    ".($_GET['sSortDir_'.$i]==='asc' ? 'asc' : 'desc') .", ";
            }
        }
         
        $sOrder = substr_replace( $sOrder, "", -2 );
        if ( $sOrder == "ORDER BY" )
        {
            $sOrder = "";
        }
    }
     /*
     join with multiple tables table
     */
     $aJoinQuery='';
     $aSelectFields='';
     $aAsSelectFields='';
     $aGroupBy='';
     if($multiple=='yes' && count($aJoin)>0){
     	foreach ($aJoin as $key => $value) {
     		$aJoinQuery .=' LEFT JOIN '.DB_PREFIX .$value["table"].' ON '.$sTable.'.id='.DB_PREFIX .$value["table"].'.'.$value["fieldname"].' ';
     		$aSelectFields .=','.DB_PREFIX .$value["table"].'.'.$value["fieldname"];
     		$aAsSelectFields .=',count(distinct '.DB_PREFIX .$value["table"].'.id)  as "'.$value["display_name"].'"';
     			$aGroupBy='group by '.$sTable.'.id';
     	}
     }

    /*
     * Filtering
     * NOTE this does not match the built-in DataTables filtering which does it
     * word by word on any field. It's possible to do here, but concerned about efficiency
     * on very large tables, and MySQL's regex functionality is very limited
     */
    $sWhere = "";
    $ex_where=$where;
    
    if ( (isset($_GET['sSearch']) && $_GET['sSearch'] != "" )|| (isset($ex_where) && $ex_where != "" ))
    {
        $sWhere = "WHERE (";
        	$sWhere .= $ex_where['fieldname']."=".$ex_where['value'];
        	if(isset($_GET['sSearch']) && $_GET['sSearch'] != "" ){
        for ( $i=0 ; $i<count($aColumns) ; $i++ )
        {
            if ( isset($_GET['bSearchable_'.$i]) && $_GET['bSearchable_'.$i] == "true" )
            {
                $sWhere .= $aColumns[$i]." LIKE '%".mysql_real_escape_string( $_GET['sSearch'] )."%' OR ";
            }
        }
        $sWhere = substr_replace( $sWhere, "", -3 );}

        $sWhere .= ')';
    }
     
    /* Individual column filtering */
    for ( $i=0 ; $i<count($aColumns) ; $i++ )
    {
        if ( isset($_GET['bSearchable_'.$i]) && $_GET['bSearchable_'.$i] == "true" && $_GET['sSearch_'.$i] != '' )
        {
            if ( $sWhere == "" )
            {
                $sWhere = "WHERE ";
            }
            else
            {
                $sWhere .= " AND ";
            }
            $sWhere .= $aColumns[$i]." LIKE '%".mysql_real_escape_string($_GET['sSearch_'.$i])."%' ";
        }
    }
     
     
    /*
     * SQL queries
     * Get data to display
     */
    /*$sQuery = "
        SELECT SQL_CALC_FOUND_ROWS ".str_replace(" , ", " ", implode(", ", $aColumns))."
        FROM   $sTable
        $sWhere
        $sOrder
        $sLimit
    ";*/

    $sQuery = "
        SELECT $sTable.* $aSelectFields $aAsSelectFields 
        FROM   $sTable $aJoinQuery
        $sWhere $aGroupBy
        $sOrder
        $sLimit
    ";
   //echo $sQuery;exit; 
    $rResult = $this->db->get_results($sQuery,ARRAY_A) ;
     //echo $rResult[0]['firstname'];echo '<pre>';print_r($rResult);echo '</pre>';echo count($rResult);exit;
    /* Data set length after filtering */
    $sQuery = "
        SELECT FOUND_ROWS()
    ";
    $rResultFilterTotal = $this->db->get_results($sQuery,ARRAY_A) ;
    $aResultFilterTotal = count($rResultFilterTotal);
    $iFilteredTotal = $aResultFilterTotal;
     
    /* Total data set length */
    $sQuery = "
        SELECT COUNT(".$sIndexColumn.")
        FROM   $sTable
    ";
    $rResultTotal = $this->db->get_results($sQuery,ARRAY_A) ;
    $aResultTotal = count($rResultTotal);
    $iTotal = $aResultTotal;
     
     
    /*
     * Output
     */
    /*
	$output = array(
        "sEcho" => intval($_GET['sEcho']),
        "iTotalRecords" => $iTotal,
        "iTotalDisplayRecords" => $iFilteredTotal,
        "aaData" => array()
    );
	*/
     //echo $alistColumns["join_table"][0]["fieldname"];
        $row = array();
        for ( $i=0 ; $i<count($rResult) ; $i++ )
        {
                for ( $j=0 ; $j<count($aColumns) ; $j++ )
        		{
        			if($aColumns[$j]==$alistColumns["join_table"][0]["display_name"])
                {
                	$row[$i][] = $rResult[$i][ $aColumns[$j]].'<a style="margin-left:30px;" href="'.WEB_ROOT.'index.php/admin/action?type='.$next_type.'&field='.base64_encode($alistColumns["join_table"][0]["fieldname"]).'&value='.base64_encode($rResult[$i]["id"]).'"><i class="fa fa-pencil-square-o"></i></a>';;
                }else{
                	$row[$i][] = $rResult[$i][ $aColumns[$j]];
                }
            	}
            	//$row[$i][] = '<a href="'.WEB_ROOT.'index.php/admin/action?type='.$next_type.'&field='.base64_encode($alistColumns["join_table"][0]["fieldname"]).'&value='.base64_encode($rResult[$i]["id"]).'"><i class="fa fa-pencil-square-o"></i></a>';
            	//unset($row);
            	//print_r($row);exit;
        }
        $output['aaData']= $row;
     
    echo json_encode( $output );
	}


	//function server_response($table,$fields,$where,$type){
	function server_response($fields,$type){
    //$aColumns = array( 'firstname', 'email', 'lastname', 'dob');
		$aLists=json_decode(base64_decode($fields),true);
     $aColumns =$aLists['columns'];
     $where =$aLists['where'];
     $table =$aLists['table'];
     $disable_delete = (isset($aLists['disable_delete'])) ? $aLists['disable_delete'] : 'none';
    // print_r($aLists);
     $where_str = implode("','", $aColumns);
   
   $sQuery =      "show full columns from ".DB_PREFIX .$table." where field in ('".$where_str."')";
    //echo $sQuery;
     $rResult = $this->db->get_results($sQuery,ARRAY_A) ;
//      echo '<pre>';
//      print_r($rResult);
// echo '</pre>';
     foreach ($rResult as $key => $value) {
     	 //echo $value['Comment'];
     	 if(isset($value['Comment'])){
      $cmt=explode('>', $value['Comment']);
      if($cmt[0]=='join'){
      	if($cmt[1]=='users'){
      		$ac_field='firstname';
      	}else{$ac_field='name';}
      	$cmt_base[] = array('table'=>$cmt[1],'field'=>$value['Field'],'ac_field'=>$ac_field);
      }
      else if($cmt[0]=='get'){
        $cmt_tb_s=explode('-',$cmt[1]);
         $cmt_base[] = array('table'=>$cmt_tb_s[0],'field'=>$value['Field'],'ac_field'=>$cmt_tb_s[1]);
      }
    }
     }
     $ex_table[]='gh';
     foreach ($cmt_base as $key => $value) {
     	if(in_array($value['table'], $ex_table)){
     		$jTable=$value['table']." as ".DB_PREFIX.$value['table']."1";
     		$jStable=$value['table']."1";
     	}else{
     		$jTable=$value['table'];
     		$jStable=$value['table'];
     	}
     	$join[]= " left join ".DB_PREFIX.$jTable." on ".DB_PREFIX.$jStable.".id=".DB_PREFIX.$table.".".$value['field'];
		$selected_fields[]= DB_PREFIX.$jStable.".".$value['ac_field']." as ".$value['field'];   	
		$ex_table[]=$value['table'];
     }
      $sJoin = implode(" ", $join);
     $sFields = implode(",", $selected_fields);


    $sIndexColumn = "id";
 
    $sTable = DB_PREFIX .$table;
		/*
     * Paging
     */
    $sLimit = "";
    if ( isset( $_GET['iDisplayStart'] ) && $_GET['iDisplayLength'] != '-1' )
    {
        $sLimit = "LIMIT ".intval( $_GET['iDisplayStart'] ).", ".
            intval( $_GET['iDisplayLength'] );
    }
     
     
    /*
     * Ordering
     */
    $sOrder = "";
    if ( isset( $_GET['iSortCol_0'] ) )
    {
        $sOrder = "ORDER BY  ";
        for ( $i=0 ; $i<intval( $_GET['iSortingCols'] ) ; $i++ )
        {
            if ( $_GET[ 'bSortable_'.intval($_GET['iSortCol_'.$i]) ] == "true" )
            {
                $sOrder .= $aColumns[ intval( $_GET['iSortCol_'.$i] ) ]."
                    ".($_GET['sSortDir_'.$i]==='asc' ? 'asc' : 'desc') .", ";
            }
        }
         
        $sOrder = substr_replace( $sOrder, "", -2 );
        if ( $sOrder == "ORDER BY" )
        {
            $sOrder = "";
        }
    }
     
     
    /*
     * Filtering
     * NOTE this does not match the built-in DataTables filtering which does it
     * word by word on any field. It's possible to do here, but concerned about efficiency
     * on very large tables, and MySQL's regex functionality is very limited
     */
    $sWhere = "";
    $ex_where=$where;
    
    if ( (isset($_GET['sSearch']) && $_GET['sSearch'] != "" )|| (isset($ex_where) && $ex_where != "" ))
    {
        $sWhere = "WHERE (";
        	$sWhere .= $ex_where['fieldname']."=".$ex_where['value'];
        	if(isset($_GET['sSearch']) && $_GET['sSearch'] != "" ){
        for ( $i=0 ; $i<count($aColumns) ; $i++ )
        {
            if ( isset($_GET['bSearchable_'.$i]) && $_GET['bSearchable_'.$i] == "true" )
            {
                $sWhere .= $aColumns[$i]." LIKE '%".mysql_real_escape_string( $_GET['sSearch'] )."%' OR ";
            }
        }
        $sWhere = substr_replace( $sWhere, "", -3 );}

        $sWhere .= ')';
    }
     
    /* Individual column filtering */
    for ( $i=0 ; $i<count($aColumns) ; $i++ )
    {
        if ( isset($_GET['bSearchable_'.$i]) && $_GET['bSearchable_'.$i] == "true" && $_GET['sSearch_'.$i] != '' )
        {
            if ( $sWhere == "" )
            {
                $sWhere = "WHERE ";
            }
            else
            {
                $sWhere .= " AND ";
            }
            $sWhere .= $aColumns[$i]." LIKE '%".mysql_real_escape_string($_GET['sSearch_'.$i])."%' ";
        }
    }
     
     
    /*
     * SQL queries
     * Get data to display
     */
    /*$sQuery = "
        SELECT SQL_CALC_FOUND_ROWS ".str_replace(" , ", " ", implode(", ", $aColumns))."
        FROM   $sTable
        $sWhere
        $sOrder
        $sLimit
    ";*/
	$sFields = empty($sFields)? '*' : $sFields.','.$sTable.'.id';
     $sQuery = "
        SELECT $sFields
        FROM   $sTable 
        $sJoin
        $sWhere
        $sOrder
        $sLimit
    ";
    //echo $sQuery;
    $rResult = $this->db->get_results($sQuery,ARRAY_A) ;
     //echo $rResult[0]['firstname'];echo '<pre>';print_r($rResult);echo '</pre>';echo count($rResult);exit;
    /* Data set length after filtering */
    $sQuery = "
        SELECT FOUND_ROWS()
    ";
    $rResultFilterTotal = $this->db->get_results($sQuery,ARRAY_A) ;
    $aResultFilterTotal = count($rResultFilterTotal);
    $iFilteredTotal = $aResultFilterTotal;
     
    /* Total data set length */
    $sQuery = "
        SELECT COUNT(".$sIndexColumn.")
        FROM   $sTable
    ";
    $rResultTotal = $this->db->get_results($sQuery,ARRAY_A) ;
    $aResultTotal = count($rResultTotal);
    $iTotal = $aResultTotal;
     
     
    /*
     * Output
     */
    /*
	$output = array(
        "sEcho" => intval($_GET['sEcho']),
        "iTotalRecords" => $iTotal,
        "iTotalDisplayRecords" => $iFilteredTotal,
        "aaData" => array()
    );
	*/
     
        $row = array();
        for ( $i=0 ; $i<count($rResult) ; $i++ )
        {
                for ( $j=0 ; $j<count($aColumns) ; $j++ )
        		{

           			 
           			 if($type=='doctor_files_lists'){
           			 	if($aColumns[$j]=='name'){
           			 	$row[$i][] = '<img src='.WEB_ROOT.'service/public/z_uploads/doctor/small/'.$rResult[$i][ $aColumns[$j]].'>';
           			 	}
           			 	elseif($aColumns[$j]=='set_profile'){
           			 		$row[$i][] = ($rResult[$i][ $aColumns[$j]]==1) ? 'Profile Picture' : 'Used for Gallery';
           			 	}elseif($aColumns[$j]=='type'){
           			 		$row[$i][] = ($rResult[$i][ $aColumns[$j]]==1) ? 'Video' : 'Image';
           			 	}
           			 	else{
           			 	$row[$i][] = $rResult[$i][ $aColumns[$j]];
           			 }
           			 }else{
           			 	if(isJSON($rResult[$i][ $aColumns[$j]])){
           			 		$arr_data=json_decode($rResult[$i][ $aColumns[$j]],true);
							if(count($arr_data) > 0){
								$data ='<div class="detail-box" ><dl class="dl-horizontal">';
								foreach ($arr_data as $key => $value1) {
									if(is_string($value1)){
										$_dis= (empty($value1)) ? "--" : $value1;
										$data .='<dt>'.$key.' :- </dt><dd>'.$_dis.'</dd>';
									}else{
										$_key= (is_string($key)) ? $key : $F_name." ".$key;
										$data .='<dt>'.$_key.' :- </dt><dd>';
										foreach ($value1 as $key1 => $value2) {
											$data .=$key1." : ".$value2.", ";
										}
										$data .='</dd>';
									}
								}
								$data .='</dl></div>';
								$row[$i][] = $data;
							}
							else{
								$row[$i][] ='--';
							}
           			 	}else{
           			 	$row[$i][] = $rResult[$i][ $aColumns[$j]];
           			 }
           			 }
            	}
            	$key_type=array('gender','doctor_files_lists','usertypes');
            	if (!(in_array($type, $key_type)) ){
            		if($disable_delete!='yes'){
            			$row[$i][] = '<a href="'.WEB_ROOT.'index.php/admin/view?type='.$type.'&tb='.base64_encode($table).'&id='.base64_encode($rResult[$i]["id"]).'"><i class="fa fa-eye"></i></a>
                       			<a href="'.WEB_ROOT.'index.php/admin/edit?type='.$type.'&tb='.base64_encode($table).'&id='.base64_encode($rResult[$i]["id"]).'"><i class="fa fa-pencil"></i></a>
                        	<a class="delete_row" href="'.WEB_ROOT.'index.php/admin/delete?type='.$type.'&tb='.base64_encode($table).'&id='.base64_encode($rResult[$i]["id"]).'"><i class="fa fa-trash-o "></i></a>';
                    }else{
                    	$row[$i][] = '<a href="'.WEB_ROOT.'index.php/admin/view?type='.$type.'&tb='.base64_encode($table).'&id='.base64_encode($rResult[$i]["id"]).'"><i class="fa fa-eye"></i></a>
                       			<a href="'.WEB_ROOT.'index.php/admin/edit?type='.$type.'&tb='.base64_encode($table).'&id='.base64_encode($rResult[$i]["id"]).'"><i class="fa fa-pencil"></i></a>';
                    }
                }

            	//unset($row);
            	//print_r($row);exit;
        }
        $output['aaData']= $row;
     
    echo json_encode( $output );
	}
}
function isJSON($string){
   return is_string($string) && is_array(json_decode($string, true)) ? true : false;
}

	
?>