<?php

	function menu_action($action){

		$data;

		switch ($action) {

      // set up admin listing action

      case 'admin_details':

    	$colums=array( 'firstname', 'email', 'lastname', 'dob');

    	$where= array('fieldname' => 'usertype','value' => 3 );

    	$table='users';

      //hide doctor fields while loading admin

      $hiddenfileds=array('speciality','description','Education','HospitalAffiliations','BoardCertifications','ProfessionalMemberships','Awards','working_plan','breaks','vecation');

    	$data['columns']=$colums;

    	$data['where']=$where;

    	$data['table']=$table;

      $data['hidden']=$hiddenfileds;

      $data['disable_delete']='yes';

    	return $data;

      break;

      // set up doctor listing action

      case 'doctor_details':

    	$colums=array( 'firstname', 'email', 'lastname', 'dob');

    	$where= array('fieldname' => 'usertype','value' => 1 );

    	$table='users';

      

    	$data['columns']=$colums;

    	$data['where']=$where;

    	$data['table']=$table;

      

    	return $data;

      break;



      // set up user listing action

      case 'patient_details':

    	$colums=array( 'firstname', 'email', 'lastname', 'dob');

    	$where= array('fieldname' => 'usertype','value' => 2 );

    	$table='users';

      //hide doctor fields while loading user

      $hiddenfileds=array('speciality','description','Education','HospitalAffiliations','BoardCertifications','ProfessionalMemberships','Awards','working_plan','breaks','vecation');

    	$data['columns']=$colums;

    	$data['where']=$where;

    	$data['table']=$table;

      $data['hidden']=$hiddenfileds;

    	return $data;

      break;



      // set up appointment listing action

      case 'doctor_appointment1':

      $colums=array( 'apnt_starttime', 'apnt_endtime', 'apnt_date', 'apnt_note');

      $where= '';

      $table='doctor_appointments';

      $data['columns']=$colums;

      $data['where']=$where;

      $data['table']=$table;

      return $data;

      break;



      // set up appointment listing action for doctors

      case 'doctor_appointment':

      $multiple='yes';

      $table='users';//$table[]='doctor_appointments';

      $join_tables[]=array('table'=>'doctor_appointments','fieldname'=>'doctor_id','display_name'=>'Appointments');

    	//must set display name in colums array

      $colums=array( 'email', 'firstname', 'lastname' , 'Appointments');

      $custom_columns=array('appointment count');

    	$where= array('fieldname' => 'usertype','value' => 1 );

      $next_action='appointment_lists';

    	$data['columns']=$colums;

    	$data['where']=$where;

    	$data['table']=$table;

      $data['multiple']=$multiple;

      $data['join_table']=$join_tables;

      $data['next_action']=$next_action;

    	return $data;

      break;



      // set up appointment listing action for patients

      case 'patient_appointment':

      $multiple='yes';

      $table='users';//$table[]='doctor_appointments';

      $join_tables[]=array('table'=>'doctor_appointments','fieldname'=>'patient_id','display_name'=>'Appointments');

      //must set display name in colums array

      $colums=array( 'email', 'firstname', 'lastname' , 'Appointments');

      $custom_columns=array('appointment count');

      $where= array('fieldname' => 'usertype','value' => 2 );

      $next_action='appointment_lists';

      $data['columns']=$colums;

      $data['where']=$where;

      $data['table']=$table;

      $data['multiple']=$multiple;

      $data['join_table']=$join_tables;

      $data['next_action']=$next_action;

      return $data;

      break;



      /* set up appointment listing action for individual users

      *in listing action the $where array must be empty

      */

      case 'appointment_lists':

      $colums=array( 'apnt_starttime', 'apnt_endtime', 'apnt_date', 'apnt_note');

      $where= '';

      $table='doctor_appointments';

      $data['columns']=$colums;

      $data['where']=$where;

      $data['table']=$table;

      return $data;

      break;





      // set up checkin listing action for doctor

      case 'doctor_check_in':

      $multiple='yes';

      $table='users';//$table[]='doctor_appointments';

      $join_tables[]=array('table'=>'checkin','fieldname'=>'doctor_id','display_name'=>'Total Check-in');

      //must set display name in colums array

      $colums=array( 'email', 'firstname', 'lastname' , 'Total Check-in');

      $custom_columns=array('appointment count');

      $where= array('fieldname' => 'usertype','value' => 1 );

      $next_action='check_in_lists';

      $data['columns']=$colums;

      $data['where']=$where;

      $data['table']=$table;

      $data['multiple']=$multiple;

      $data['join_table']=$join_tables;

      $data['next_action']=$next_action;

      return $data;

      break;



      // set up checkin listing action for patient

      case 'patient_checkin':

      $multiple='yes';

      $table='users';//$table[]='doctor_appointments';

      $join_tables[]=array('table'=>'checkin','fieldname'=>'user_id','display_name'=>'Total Check-in');

      //must set display name in colums array

      $colums=array( 'email', 'firstname', 'lastname' , 'Total Check-in');

      $custom_columns=array('appointment count');

      $where= array('fieldname' => 'usertype','value' => 2 );

      $next_action='check_in_lists';

      $data['columns']=$colums;

      $data['where']=$where;

      $data['table']=$table;

      $data['multiple']=$multiple;

      $data['join_table']=$join_tables;

      $data['next_action']=$next_action;

      return $data;

      break;



      /* set up checkin listing action for individual users

      *in listing action the $where array must be empty

      */

      case 'check_in_lists':

      $colums=array( 'reg_details', 'medical_details', 'insurence_details');

      $where= '';

      $table='checkin';

      $data['columns']=$colums;

      $data['where']=$where;

      $data['table']=$table;

      return $data;

      break;



      // set up insurence listing action

      case 'doctor_insurence':

      $multiple='yes';

      $table='users';//$table[]='doctor_appointments';

      $join_tables[]=array('table'=>'doctor_insurance','fieldname'=>'doctor_id','display_name'=>'Accepting Insurence(Total)');

      //must set display name in colums array

      $colums=array( 'email', 'firstname', 'lastname' , 'Accepting Insurence(Total)');

      //$custom_columns=array('appointment count');

      $where= array('fieldname' => 'usertype','value' => 1 );

      $next_action='doctor_insurence_lists';

      $data['columns']=$colums;

      $data['where']=$where;

      $data['table']=$table;

      $data['multiple']=$multiple;

      $data['join_table']=$join_tables;

      $data['next_action']=$next_action;

      return $data;

      break;



      /* set up appointment listing action

      *in listing action the $where array must be empty

      */

      case 'doctor_insurence_lists':

      $colums=array( 'insurance_id', 'sub_insurance_id');

      $where= '';

      $table='doctor_insurance';

      $data['columns']=$colums;

      $data['where']=$where;

      $data['table']=$table;

      return $data;

      break;



      // set up language listing action

      case 'doctor_language':

      $multiple='yes';

      $table='users';//$table[]='doctor_appointments';

      $join_tables[]=array('table'=>'doctor_languages','fieldname'=>'doctor_id','display_name'=>'Known languages(Total)');

      //must set display name in colums array

      $colums=array( 'email', 'firstname', 'lastname' , 'Known languages(Total)');

      //$custom_columns=array('appointment count');

      $where= array('fieldname' => 'usertype','value' => 1 );

      $next_action='doctor_language_lists';

      $data['columns']=$colums;

      $data['where']=$where;

      $data['table']=$table;

      $data['multiple']=$multiple;

      $data['join_table']=$join_tables;

      $data['next_action']=$next_action;

      return $data;

      break;



      /* set up language listing action

      *in listing action the $where array must be empty

      */

      case 'doctor_language_lists':

      $colums=array( 'doctor_id', 'language_id');

      $where= '';

      $table='doctor_languages';

      $data['columns']=$colums;

      $data['where']=$where;

      $data['table']=$table;

      return $data;

      break;



      // set up doctor_speciality listing action

      case 'doctor_speciality':

      $multiple='yes';

      $table='users';//$table[]='doctor_appointments';

      $join_tables[]=array('table'=>'doctor_speciality','fieldname'=>'doctor_id','display_name'=>'Speciality In(Total)');

      //must set display name in colums array

      $colums=array( 'email', 'firstname', 'lastname' , 'Speciality In(Total)');

      //$custom_columns=array('appointment count');

      $where= array('fieldname' => 'usertype','value' => 1 );

      $next_action='doctor_speciality_lists';

      $data['columns']=$colums;

      $data['where']=$where;

      $data['table']=$table;

      $data['multiple']=$multiple;

      $data['join_table']=$join_tables;

      $data['next_action']=$next_action;

      return $data;

      break;



      /* set up appointment listing action

      *in listing action the $where array must be empty

      */

      case 'doctor_speciality_lists':

      $colums=array( 'doctor_id', 'speciality_id');

      $where= '';

      $table='doctor_speciality';

      $data['columns']=$colums;

      $data['where']=$where;

      $data['table']=$table;

      return $data;

      break;





      // set up ratings listing action

      case 'doctor_ratings':

      $multiple='yes';

      $table='users';//$table[]='doctor_appointments';

      $join_tables[]=array('table'=>'ratings','fieldname'=>'doctor_id','display_name'=>'Ratings(Total-in count)');

      //must set display name in colums array

      $colums=array( 'email', 'firstname', 'lastname' , 'Ratings(Total-in count)');

      //$custom_columns=array('appointment count');

      $where= array('fieldname' => 'usertype','value' => 1 );

      $next_action='ratings_lists';

      $data['columns']=$colums;

      $data['where']=$where;

      $data['table']=$table;

      $data['multiple']=$multiple;

      $data['join_table']=$join_tables;

      $data['next_action']=$next_action;

      return $data;

      break;



      

      // set up ratings listing action

      case 'patient_ratings':

      $multiple='yes';

      $table='users';//$table[]='doctor_appointments';

      $join_tables[]=array('table'=>'ratings','fieldname'=>'userid','display_name'=>'Ratings(Total-in count)');

      //must set display name in colums array

      $colums=array( 'email', 'firstname', 'lastname' , 'Ratings(Total-in count)');

      //$custom_columns=array('appointment count');

      $where= array('fieldname' => 'usertype','value' => 2 );

      $next_action='ratings_lists';

      $data['columns']=$colums;

      $data['where']=$where;

      $data['table']=$table;

      $data['multiple']=$multiple;

      $data['join_table']=$join_tables;

      $data['next_action']=$next_action;

      return $data;

      break;



      /* set up ratings listing action

      *in listing action the $where array must be empty

      */

      case 'ratings_lists':

      $colums=array( 'beside', 'overall','waiting','message');

      $where= '';

      $table='ratings';

      $data['columns']=$colums;

      $data['where']=$where;

      $data['table']=$table;

      return $data;

      break;



      // set up userimages listing action

      case 'doctor_files':

      $multiple='yes';

      $table='users';//$table[]='doctor_appointments';

      $join_tables[]=array('table'=>'userimages','fieldname'=>'user_id','display_name'=>'Files(Total-in count)');

      //must set display name in colums array

      $colums=array( 'email', 'firstname', 'lastname' , 'Files(Total-in count)');

      //$custom_columns=array('appointment count');

      $where= array('fieldname' => 'usertype','value' => 1 );

      $next_action='doctor_files_lists';

      $data['columns']=$colums;

      $data['where']=$where;

      $data['table']=$table;

      $data['multiple']=$multiple;

      $data['join_table']=$join_tables;

      $data['next_action']=$next_action;

      return $data;

      break;



      /* set up userimages listing action

      *in listing action the $where array must be empty

      */

      case 'doctor_files_lists':

      $colums=array( 'name', 'set_profile','type','size');

      $where= '';

      $table='userimages';

      $data['columns']=$colums;

      $data['where']=$where;

      $data['table']=$table;

      return $data;

      break;



      // set up gender listing action

      case 'gender':

    	$colums=array( 'id', 'name');

    	$where= '';

    	$table='gendertypes';

    	$data['columns']=$colums;

    	$data['where']=$where;

    	$data['table']=$table;

    	return $data;

      break;



      // set up illness listing action

      case 'illness':

    	$colums=array( 'id', 'name');

    	$where= '';

    	$table='illness';

    	$data['columns']=$colums;

    	$data['where']=$where;

    	$data['table']=$table;

    	return $data;

      break;



      // set up insurance listing action

      case 'manage_insurence':

    	$colums=array( 'id', 'name','insurance_sk');

    	$where= '';

    	$table='insurance';

    	$data['columns']=$colums;

    	$data['where']=$where;

    	$data['table']=$table;

    	return $data;

      break;



      // set up language listing action

      case 'manage_language':

    	$colums=array( 'id', 'name');

    	$where= '';

    	$table='languages';

    	$data['columns']=$colums;

    	$data['where']=$where;

    	$data['table']=$table;

    	return $data;

      break;



	  // set up speciality listing action

      case 'manage_speciality':

    	$colums=array( 'id', 'name','speciality_sk');

    	$where= '';

    	$table='speciality';

    	$data['columns']=$colums;

    	$data['where']=$where;

    	$data['table']=$table;

    	return $data;

      break;



      // set up speciality listing action

      case 'usertypes':

    	$colums=array( 'id', 'name');

    	$where= '';

    	$table='usertypes';

    	$data['columns']=$colums;

    	$data['where']=$where;

    	$data['table']=$table;

    	return $data;

      break;



      // set up payment gateway settings

      case 'payment_gateway':

      $colums=array( 'paypal_merchant_account_email_id', 'sandbox_mode', 'payment_mode', 'currency_mode');

      $where= '';

      $table='payment_gateway';

      $data['columns']=$colums;

      $data['where']=$where;

      $data['table']=$table;

      return $data;

      break;



      // set up payment gateway settings

      case 'payment_packages':

      $colums=array( 'package_name', 'duration', 'price');

      $where= '';

      $table='packages';

      $disable_delete = 'yes';

      $data['columns']=$colums;

      $data['where']=$where;

      $data['table']=$table;

      $data['disable_delete']=$disable_delete;

      return $data;

      break; 



      case 'package_payments':

      $colums=array( 'package_id', 'user_id', 'txn_id', 'amount','currency_code','payment_status','expiry_date');

      $where= '';

      $table='package_payments';

      $data['columns']=$colums;

      $data['where']=$where;

      $data['table']=$table;

      return $data;

      break;

      // set up mobile application settings

      case 'application_config':

      $colums=array( 'application_secret_key');

      $where= '';

      $table='app_config';

      $data['columns']=$colums;

      $data['where']=$where;

      $data['table']=$table;

      return $data;

      break; 



  		}

	}

?>