<?php 
include("./conf/config.inc.php");
$result = $_GET;
                        $target=$result['target'];
                        $br=$result['f_val'];
                       $doc=json_decode($br,TRUE);
                  //print_r($doc);exit();
             //patients registartion section         
             if($target=='reg_details'){ 
 $data = '<div class="col-lg-12 bg-black disabled color-palette form-group">
 <h3 class="box-title" align="center">Patients Registration Form</h3>
 <form id="Patients_checkin">
 <div class="col-lg-12 form-group">
     <div class="col-sm-4"> 
      <input type="text" class="form-control" name="apnt_time" maxlength="30" readonly="" value="'.$doc["apnt_time"].'">
     </div>
     <div class="col-sm-4"> 
      <select class="form-control"  name="marital" id="marital">
                  <option value="">Marital Status </option>
                  <option';
                  if($doc["marital"]==' single') {$data .= ' selected="selected" ';}
                  $data .=' value="Single">Single</option>
                  <option';
                  if($doc["marital"]=="Married") {$data .=' selected="selected" ';}
                  $data .=' value="Married">Married</option>
               </select>
     </div>
     <div class="col-sm-4">
         <input class="form-control" type="text" name="ssn" value="'.$doc["ssn"].'" maxlength="30" placeholder="Social Security Number">
      </div>
     </div>

      <div class="col-lg-12 form-group">
     <div class="col-sm-4"> 
      <input type="text" class="form-control" name="fname" value="'.$doc["fname"].'" maxlength="30" placeholder="First Name">
     </div>
     <div class="col-sm-4"> 
      <input class="form-control" type="text" name="pnum" value="'.$doc["pnum"].'" maxlength="30" placeholder="Mobile Number">
     </div>
     <div class="col-sm-4">
         <input class="form-control" type="text" name="reff" value="'.$doc["reff"].'" maxlength="30" placeholder="Reffered By">
      </div>
     </div>

      <div class="col-lg-12 form-group">
     <div class="col-sm-4"> 
      <input type="text" class="form-control" name="mname" value="'.$doc["mname"].'" maxlength="30" placeholder="Middle Name">
     </div>
     <div class="col-sm-4"> 
      <input class="form-control" type="text" name="hnum" value="'.$doc["hnum"].'" maxlength="30" placeholder="Home Number">
     </div>
     <div class="col-sm-4">
         <input class="form-control" type="text" name="pcp" value="'.$doc["pcp"].'" maxlength="30" placeholder="Primary Care Physician">
      </div>
     </div>

      <div class="col-lg-12 form-group">
     <div class="col-sm-4"> 
      <input type="text" class="form-control" name="lname" value="'.$doc["lname"].'" maxlength="30" placeholder="Last Name">
     </div>
     <div class="col-sm-4"> 
      <input class="form-control" type="text" name="pCity"  value="'.$doc["pCity"].'" maxlength="30" placeholder="City">
     </div>
     <div class="col-sm-4">
         <input class="form-control" type="text" name="pcpn" value="'.$doc["pcpn"].'" maxlength="30" placeholder="Primary Care Physician Number">
      </div>
     </div>

      <div class="col-lg-12 form-group">
     <div class="col-sm-4"> 

                  <input class="form-control day" type="text" name="Birthday_day" value="'.$doc["Birthday_day"].'" maxlength="30" placeholder="Birth Date">

                  <input class="form-control month" type="text" name="Birthday_Month" value="'.$doc["Birthday_Month"].'" maxlength="30" placeholder="Birth Month">

                  <input class="form-control year" type="text" name="Birthday_Year" value="'.$doc["Birthday_Year"].'" maxlength="30" placeholder="Birth Year">
                  

     </div>
     <div class="col-sm-4"> 
      <input class="form-control" type="text" name="pPin" value="'.$doc["pPin"].'" maxlength="30" placeholder="Pincode">
      <input class="form-control" type="text" name="email" value="'.$doc["email"].'" maxlength="30" placeholder="Email ID"></input>
     </div>
     <div class="col-sm-4">
         <input class="form-control" type="text" name="phar" value="'.$doc["phar"].'" maxlength="30" placeholder="Pharmacy">
      </div>
     </div>

      <div class="col-lg-12 form-group">
     <div class="col-sm-4"> 
      <select class="form-control"  name="gender" id="gender">
                     <option value="">Gender:</option>
                     <option ';
                  if($doc["gender"]=='Male') {$data .= ' selected="selected" ';}
                  $data .=' value="Male">Male</option>
                     <option';
                  if($doc["gender"]=='Female') {$data .= ' selected="selected" ';}
                  $data .=' value="Female">Female</option>
                  </select>
     </div>
     <div class="col-sm-4"> 
      <input class="form-control" type="text" name="pstate" value="'.$doc["pstate"].'" maxlength="30" placeholder="State">
     </div>
     <div class="col-sm-4">
         <input class="form-control" type="text" name="phnum" value="'.$doc["phnum"].'"  maxlength="30" placeholder="Pharmacy Number">
      </div>
     </div>

      <div class="col-lg-12 form-group">
     <div class="col-sm-4"> 
      <input class="form-control" type="text" name="occupation" value="'.$doc["occupation"].'"  maxlength="30" placeholder="Occupation">
     </div>
     <div class="col-sm-4"> 
      <textarea class="form-control" name="pAddress"  rows="2" cols="30" placeholder="Address" >'.$doc["pAddress"].'</textarea>
     </div>
     <div class="col-sm-4">
      <textarea class="form-control" name="phAddress"  rows="2" cols="30" placeholder="Pharmacy Address" >'.$doc["phAddress"].'</textarea>
      </div>
     </div>
            </form>
            <div class="btn col-lg-12 btn-primary registration">Submit</div>
          </div>';
          //patients registartion section    
          }      
elseif($target=='medical_details'){
          //patients medical section
         $medical_details ='<div class="col-lg-12 bg-black disabled color-palette form-group">
            <h3 class="box-title" >Patients Medical History</h3>
            <form id="Patients_checkin">
            <div class="col-lg-12 ">
               <h5 class="box-title" align="center">Reason for visit</h5>
            </div>
               <div class="col-lg-12 form-group">
               <div class="col-sm-4"> 
               <input type="text" class="form-control" name="reason" value="'.$doc["reason"].'" maxlength="30" placeholder="Reason for Visit">
               </div>
               <div class="col-sm-4"> 
               <input type="text" class="form-control" name="concerns" value="'.$doc["concerns"].'" maxlength="30" placeholder="Other Concerns">
               </div>
               <div class="col-sm-4">
               <select style="width:100% !important" multiple="multiple" class="form-control multi-select"  name="allergies" id="allergies" data-placeholder="Allergies">
               <option';
               if(is_array($doc['allergies'])){
                     if(in_array("AdhesiveTape", $doc["allergies"])){
                        $medical_details .= ' selected="selected" ';
                     }
               }else{
                  if($doc["allergies"]=='AdhesiveTape'  || strpos($doc["allergies"],'AdhesiveTape') !== false){
                        $medical_details .= ' selected="selected" ';
                  }
               }
                  $medical_details .=' value="AdhesiveTape">AdhesiveTape</option>
               <option';
                  if(is_array($doc['allergies'])){
                     if(in_array("Barbiturates", $doc["allergies"])){
                        $medical_details .= ' selected="selected" ';
                     }
               }else{
                  if($doc["allergies"]=='Barbiturates'  || strpos($doc["allergies"],'Barbiturates') !== false){
                        $medical_details .= ' selected="selected" ';
                  }
               }
                  $medical_details .=' value="Barbiturates">Barbiturates</option>
               <option';
                  if(is_array($doc['allergies'])){
                     if(in_array("Codeine", $doc["allergies"])){
                        $medical_details .= ' selected="selected" ';
                     }
               }else{
                  if($doc["allergies"]=='Codeine'  || strpos($doc["allergies"],'Codeine') !== false){
                        $medical_details .= ' selected="selected" ';
                  }
               }
                  $medical_details .=' value="Codeine">Codeine</option>
               <option';
                  if(is_array($doc['allergies'])){
                     if(in_array("Antibiotics", $doc["allergies"])){
                        $medical_details .= ' selected="selected" ';
                     }
               }else{
                  if($doc["allergies"]=='Antibiotics'  || strpos($doc["allergies"],'Antibiotics') !== false){
                        $medical_details .= ' selected="selected" ';
                  }
               }
                  $medical_details .=' value="Antibiotics">Antibiotics</option>
               <option';
                  if(is_array($doc['allergies'])){
                     if(in_array("Aspirin", $doc["allergies"])){
                        $medical_details .= ' selected="selected" ';
                     }
               }else{
                  if($doc["allergies"]=='Aspirin'  || strpos($doc["allergies"],'Aspirin') !== false){
                        $medical_details .= ' selected="selected" ';
                  }
               }
                  $medical_details .=' value="Aspirin">Aspirin</option>
               <option';
                  if(is_array($doc['allergies'])){
                     if(in_array("Sulfa", $doc["allergies"])){
                        $medical_details .= ' selected="selected" ';
                     }
               }else{
                  if($doc["allergies"]=='Sulfa'  || strpos($doc["allergies"],'Sulfa') !== false){
                        $medical_details .= ' selected="selected" ';
                  }
               }
                  $medical_details .=' value="Sulfa">Sulfa</option>
               <option';
                  if(is_array($doc['allergies'])){
                     if(in_array("Latex", $doc["allergies"])){
                        $medical_details .= ' selected="selected" ';
                     }
               }else{
                  if($doc["allergies"]=='Latex'  || strpos($doc["allergies"],'Latex') !== false){
                        $medical_details .= ' selected="selected" ';
                  }
               }
                  $medical_details .=' value="Latex">Latex</option>
               <option';
                  if(is_array($doc['allergies'])){
                     if(in_array("Iodine", $doc["allergies"])){
                        $medical_details .= ' selected="selected" ';
                     }
               }else{
                  if($doc["allergies"]=='Iodine'  || strpos($doc["allergies"],'Iodine') !== false){
                        $medical_details .= ' selected="selected" ';
                  }
               }
                  $medical_details .=' value="Iodine">Iodine</option>
               <option';
                  if(is_array($doc['allergies'])){
                     if(in_array("LocalAnesthetics", $doc["allergies"])){
                        $medical_details .= ' selected="selected" ';
                     }
               }else{
                  if($doc["allergies"]=='LocalAnesthetics'  || strpos($doc["allergies"],'LocalAnesthetics') !== false){
                        $medical_details .= ' selected="selected" ';
                  }
               }
                  $medical_details .=' value="LocalAnesthetics">LocalAnesthetics</option>
               </select>
               </div>
               </div>

               <div class="col-lg-12 form-group">
               <div class="col-sm-4"> 
                  <select class="form-control"  name="health"  id="health">
                  <option value="">Your Health</option>
                  <option';
                  if($doc["health"]=='Excellent') {$medical_details .= ' selected="selected" ';}
                  $medical_details .=' value="Excellent">Excellent</option>
                  <option';
                  if($doc["health"]=='Good') {$medical_details .= ' selected="selected" ';}
                  $medical_details .=' value="Good">Good</option>
                  <option';
                  if($doc["health"]=='Fair') {$medical_details .= ' selected="selected" ';}
                  $medical_details .=' value="Fair">Fair</option>
                  <option';
                  if($doc["health"]=='Poor') {$medical_details .= ' selected="selected" ';}
                  $medical_details .=' value="Poor">Poor</option>
                  </select>
               </div>
               <div class="col-sm-4"> 
                  <select class="form-control"  name="medicine" id="medicine">
                  <option value="">Current Medicine:</option>
                  <option';
                  if($doc["medicine"]==1) {$medical_details .= ' selected="selected" ';}
                  $medical_details .=' value="1">1</option>
                  <option';
                  if($doc["medicine"]==2) {$medical_details .= ' selected="selected" ';}
                  $medical_details .=' value="2">2</option>
                  </select>
                  <select class="form-control"  id="dosage" name="dosage">
                  <option value="">Dosage:</option>
                  <option';
                  if($doc["dosage"]==1) {$medical_details .= ' selected="selected" ';}
                  $medical_details .=' value="1">1</option>
                  </select>
                  <select class="form-control" id="frequency" name="Frequency">
                  <option value="">Frequency:</option>
                  <option';
                  if($doc["Frequency"]==1) {$medical_details .= ' selected="selected" ';}
                  $medical_details .=' value="1">1</option>
                  </select>
               </div>
               <div class="col-sm-4">
               <select style="width:100% !important" multiple="multiple" class="form-control multi-select" data-placeholder="Medical History" name="mhistory" id="history">
               <option';
                  if(is_array($doc['mhistory'])){
                     if(in_array("Alcoholism", $doc["mhistory"])){
                        $medical_details .= ' selected="selected" ';
                     }
               }else{
                  if($doc["mhistory"]=='Alcoholism'  || strpos($doc["mhistory"],'Alcoholism') !== false){
                        $medical_details .= ' selected="selected" ';
                  }
               }
                  $medical_details .=' value="Alcoholism">Alcoholism</option>
               <option';
                  if(is_array($doc['mhistory'])){
                     if(in_array("Allergies", $doc["mhistory"])){
                        $medical_details .= ' selected="selected" ';
                     }
               }else{
                  if($doc["mhistory"]=='Allergies'  || strpos($doc["mhistory"],'Allergies') !== false){
                        $medical_details .= ' selected="selected" ';
                  }
               }
                  $medical_details .=' value="Allergies">Allergies</option>
               <option';
                  if(is_array($doc['mhistory'])){
                     if(in_array("Anemia", $doc["mhistory"])){
                        $medical_details .= ' selected="selected" ';
                     }
               }else{
                  if($doc["mhistory"]=='Anemia'  || strpos($doc["mhistory"],'Anemia') !== false){
                        $medical_details .= ' selected="selected" ';
                  }
               }
                  $medical_details .=' value="Anemia">Anemia</option>
               <option';
                  if(is_array($doc['mhistory'])){
                     if(in_array("AnxietyDisorder", $doc["mhistory"])){
                        $medical_details .= ' selected="selected" ';
                     }
               }else{
                  if($doc["mhistory"]=='AnxietyDisorder'  || strpos($doc["mhistory"],'AnxietyDisorder') !== false){
                        $medical_details .= ' selected="selected" ';
                  }
               }
                  $medical_details .=' value="AnxietyDisorder">AnxietyDisorder</option>
               <option';
                  if(is_array($doc['mhistory'])){
                     if(in_array("Aspirin", $doc["mhistory"])){
                        $medical_details .= ' selected="selected" ';
                     }
               }else{
                  if($doc["mhistory"]=='Aspirin'  || strpos($doc["mhistory"],'Aspirin') !== false){
                        $medical_details .= ' selected="selected" ';
                  }
               }
                  $medical_details .=' value="Aspirin">Aspirin</option>
               <option';
                  if(is_array($doc['mhistory'])){
                     if(in_array("Asthma", $doc["mhistory"])){
                        $medical_details .= ' selected="selected" ';
                     }
               }else{
                  if($doc["mhistory"]=='Asthma'  || strpos($doc["mhistory"],'Asthma') !== false){
                        $medical_details .= ' selected="selected" ';
                  }
               }
                  $medical_details .=' value="Asthma">Asthma</option>
               <option';
                  if(is_array($doc['mhistory'])){
                     if(in_array("AIDS/HIV", $doc["mhistory"])){
                        $medical_details .= ' selected="selected" ';
                     }
               }else{
                  if($doc["mhistory"]=='AIDS/HIV'  || strpos($doc["mhistory"],'AIDS/HIV') !== false){
                        $medical_details .= ' selected="selected" ';
                  }
               }
                  $medical_details .=' value="AIDS/HIV">AIDS/HIV</option>
               <option';
                  if(is_array($doc['mhistory'])){
                     if(in_array("BleedingDisorder", $doc["mhistory"])){
                        $medical_details .= ' selected="selected" ';
                     }
               }else{
                  if($doc["mhistory"]=='BleedingDisorder'  || strpos($doc["mhistory"],'BleedingDisorder') !== false){
                        $medical_details .= ' selected="selected" ';
                  }
               }
                  $medical_details .=' value="BleedingDisorder">BleedingDisorder</option>
               <option';
                  if(is_array($doc['mhistory'])){
                     if(in_array("BloodDisease", $doc["mhistory"])){
                        $medical_details .= ' selected="selected" ';
                     }
               }else{
                  if($doc["mhistory"]=='BloodDisease'  || strpos($doc["mhistory"],'BloodDisease') !== false){
                        $medical_details .= ' selected="selected" ';
                  }
               }
                  $medical_details .=' value="BloodDisease">BloodDisease</option>
               </select>
               </div>
               </div>

               <div class="col-lg-12 ">
               <h5 class="box-title" align="center">Hospitalizations & Surgeries</h5>
               </div>

               <div class="col-lg-12 form-group">
               <div class="col-sm-4"> 
               <input class="form-control" type="text" name="hosp" value="'.$doc["hosp"].'" maxlength="30" placeholder="Reason">
               </div>
               <div class="col-sm-4"> 
               <input class="form-control day" type="text" name="Surgeries_Day" value="'.$doc["Surgeries_Day"].'" maxlength="30" placeholder="Day Of surgery:">
               <input class="form-control month" type="text" name="Surgeries_Month" value="'.$doc["Surgeries_Month"].'" maxlength="30" placeholder="Surgery Month:">
               </div>
               <div class="col-sm-4"> 
               <input class="form-control year" type="text" name="Surgeries_Year" value="'.$doc["Surgeries_Year"].'" maxlength="30" placeholder="Surgery Year:">
               </div>
               </div>

               <div class="col-lg-12 ">
               <h5 class="box-title" align="center">Women'."'".' s Only</h5>
               </div>

               <div class="col-lg-12 form-group">
               <div class="col-sm-4"> 
                  <input class="form-control" type="text" name="preg" value="'.$doc["preg"].'" maxlength="30" placeholder="# of Pregnancies">
               </div>
               <div class="col-sm-4"> 
               <input class="form-control" type="text" name="misc" value="'.$doc["misc"].'" maxlength="30" placeholder="# of Miscarraiges">
               </div>
               <div class="col-sm-4"> 
               <input class="form-control" type="text" name="abo" value="'.$doc["abo"].'" maxlength="30" placeholder="# of Abortion">
               </div>
               </div>

               <div class="col-lg-12 form-group">
               <div class="col-sm-4"> 
               <input class="form-control" type="text" name="living" value="'.$doc["living"].'" maxlength="30" placeholder="# # of Living">
               </div>
               <div class="col-sm-4"> 
               <input class="form-control" type="text" name="last" value="'.$doc["last"].'" maxlength="30" placeholder="# Last Pap Smear">
               </div>
               <div class="col-sm-4"> 
               <input class="form-control" type="text" name="lastm" value="'.$doc["lastm"].'" maxlength="30" placeholder="# Last Mammogram">
               </div>
               </div>

               <div class="col-lg-12 form-group">
               <div class="col-sm-4"> 
               <input class="form-control" type="text" name="birth" value="'.$doc["birth"].'" maxlength="30" placeholder="# Birth Control Method">
               </div>
               <div class="col-sm-4"> 
               </div>
               <div class="col-sm-4"> 
               </div>
               </div>

               <div class="col-lg-12 ">
               <h5 class="box-title" align="center">Family History</h5>
               </div>

               <div class="col-lg-12 form-group">
               <div class="col-sm-2"> 
               </div>
               <div class="col-sm-8"> 
               <select style="width:100% !important" multiple="multiple" class="form-control multi-select" data-placeholder="Affected by:" name="history" id="history">
               <option';
                  if(is_array($doc['history'])){
                     if(in_array("Alcoholism", $doc["history"])){
                        $medical_details .= ' selected="selected" ';
                     }
               }else{
                  if($doc["history"]=='Alcoholism'  || strpos($doc["history"],'Alcoholism') !== false){
                        $medical_details .= ' selected="selected" ';
                  }
               }
                  $medical_details .=' value="Alcoholism">Alcoholism</option>
               <option';
                  if(is_array($doc['history'])){
                     if(in_array("Allergies", $doc["history"])){
                        $medical_details .= ' selected="selected" ';
                     }
               }else{
                  if($doc["history"]=='Allergies'  || strpos($doc["history"],'Allergies') !== false){
                        $medical_details .= ' selected="selected" ';
                  }
               }
                  $medical_details .=' value="Allergies">Allergies</option>
               <option';
                  if(is_array($doc['history'])){
                     if(in_array("Anemia", $doc["history"])){
                        $medical_details .= ' selected="selected" ';
                     }
               }else{
                  if($doc["history"]=='Anemia'  || strpos($doc["history"],'Anemia') !== false){
                        $medical_details .= ' selected="selected" ';
                  }
               }
                  $medical_details .=' value="Anemia">Anemia</option>
               <option';
                  if(is_array($doc['history'])){
                     if(in_array("AnxietyDisorder", $doc["allergies"])){
                        $medical_details .= ' selected="selected" ';
                     }
               }else{
                  if($doc["history"]=='AnxietyDisorder'  || strpos($doc["history"],'AnxietyDisorder') !== false){
                        $medical_details .= ' selected="selected" ';
                  }
               }
                  $medical_details .=' value="AnxietyDisorder">AnxietyDisorder</option>
               <option';
                  if(is_array($doc['history'])){
                     if(in_array("Aspirin", $doc["history"])){
                        $medical_details .= ' selected="selected" ';
                     }
               }else{
                  if($doc["history"]=='Aspirin'  || strpos($doc["history"],'Aspirin') !== false){
                        $medical_details .= ' selected="selected" ';
                  }
               }
                  $medical_details .=' value="Aspirin">Aspirin</option>
               <option';
                  if(is_array($doc['history'])){
                     if(in_array("Asthma", $doc["history"])){
                        $medical_details .= ' selected="selected" ';
                     }
               }else{
                  if($doc["history"]=='Asthma'  || strpos($doc["history"],'Asthma') !== false){
                        $medical_details .= ' selected="selected" ';
                  }
               }
                  $medical_details .=' value="Asthma">Asthma</option>
               <option';
                  if(is_array($doc['history'])){
                     if(in_array("AIDS/HIV", $doc["history"])){
                        $medical_details .= ' selected="selected" ';
                     }
               }else{
                  if($doc["history"]=='AIDS/HIV'  || strpos($doc["history"],'AIDS/HIV') !== false){
                        $medical_details .= ' selected="selected" ';
                  }
               }
                  $medical_details .=' value="AIDS/HIV">AIDS/HIV</option>
               <option';
                  if(is_array($doc['history'])){
                     if(in_array("BleedingDisorder", $doc["history"])){
                        $medical_details .= ' selected="selected" ';
                     }
               }else{
                  if($doc["history"]=='BleedingDisorder'  || strpos($doc["history"],'BleedingDisorder') !== false){
                        $medical_details .= ' selected="selected" ';
                  }
               }
                  $medical_details .=' value="BleedingDisorder">BleedingDisorder</option>
               <option';
                  if(is_array($doc['history'])){
                     if(in_array("BloodDisease", $doc["history"])){
                        $medical_details .= ' selected="selected" ';
                     }
               }else{
                  if($doc["history"]=='BloodDisease'  || strpos($doc["history"],'BloodDisease') !== false){
                        $medical_details .= ' selected="selected" ';
                  }
               }
                  $medical_details .=' value="BloodDisease">BloodDisease</option>
               </select>
               </div>
               <div class="col-sm-2"> 
               </div>
               </div>

               <div class="col-lg-12 ">
               <h5 class="box-title" align="center">Life Style</h5>
               </div>

               <div class="col-lg-12 form-group">
               <div class="col-sm-4"> 
                  <select class="form-control" name="active" id="active">
                  <option value="">Sexually Active</option>
                  <option';
                  if($doc["active"]=='Yes') {$medical_details .= ' selected="selected" ';}
                  $medical_details .=' value="Yes">Yes</option>
                  <option';
                  if($doc["active"]=='No') {$medical_details .= ' selected="selected" ';}
                  $medical_details .=' value="No">No</option>
                  </select>
               </div>
               <div class="col-sm-4"> 
               <input class="form-control" type="text" name="partner" value="'.$doc["partner"].'" maxlength="30" placeholder="# of partners in past year" >
               </div>
               <div class="col-sm-4"> 
               <select class="form-control" name="std" id="std">
               <option value="">Checked for STD'."'".' s:</option>
               <option';
                  if($doc["std"]=='yes') {$medical_details .= ' selected="selected" ';}
                  $medical_details .=' value="yes">yes</option>
               <option';
                  if($doc["std"]=='No') {$medical_details .= ' selected="selected" ';}
                  $medical_details .=' value="No">No</option>
               </select>
               </div>
               </div>

               <div class="col-lg-12 form-group">
               <div class="col-sm-4"> 
               <select class="form-control" name="smoke" id="smoke">
               <option value="">Smoked:</option>
               <option';
                  if($doc["smoke"]=='yes') {$medical_details .= ' selected="selected" ';}
                  $medical_details .=' value="yes">yes</option>
               <option';
                  if($doc["smoke"]=='No') {$medical_details .= ' selected="selected" ';}
                  $medical_details .=' value="No">No</option>
               </select>
               </div>
               <div class="col-sm-4"> 
               <input class="form-control" type="text" name="packs" value="'.$doc["packs"].'" maxlength="30" placeholder="# packs/day" >
               </div>
               <div class="col-sm-4"> 
               <input class="form-control" type="text" name="alcohol" value="'.$doc["alcohol"].'" maxlength="30" placeholder="# alcohol drinks/week">
               </div>
               </div>

               <div class="col-lg-12 form-group">
               <div class="col-sm-4"> 
               <select class="form-control" name="smokes" id="smokes">
               <option value="">Smokes now:</option>
               <option';
                  if($doc["smokes"]=='yes') {$medical_details .= ' selected="selected" ';}
                  $medical_details .=' value="yes">yes</option>
               <option';
                  if($doc["smokes"]=='No') {$medical_details .= ' selected="selected" ';}
                  $medical_details .=' value="No">No</option>
               </select>
               </div>
               <div class="col-sm-4"> 
               <input class="form-control" type="text" name="npacks" value="'.$doc["npacks"].'" maxlength="30" placeholder="# packs/day" >
               </div>
               <div class="col-sm-4"> 
               <input class="form-control" type="text" name="caffeine" value="'.$doc["caffeine"].'" maxlength="30" placeholder="# caffeine/day">
               </div>
               </div>

               <div class="col-lg-12 form-group">
               <div class="col-sm-4"> 
               <select class="form-control" name="drugs" id="medicine">
               <option value="">Recreational drugs:</option>
               <option';
                  if($doc["drugs"]=='yes') {$medical_details .= ' selected="selected" ';}
                  $medical_details .=' value="yes">yes</option>
               <option';
                  if($doc["drugs"]=='No') {$medical_details .= ' selected="selected" ';}
                  $medical_details .=' value="No">No</option>
               </select>
               </div>
               <div class="col-sm-4"> 
               <input class="form-control" type="text" name="type" value="'.$doc["type"].'" maxlength="30" placeholder="types" >
               </div>
               <div class="col-sm-4"> 
               <input class="form-control" type="text" name="wtype" value="'.$doc["wtype"].'" maxlength="30" placeholder="# times/week" >
               </div>
               </div>

               <div class="col-lg-12 form-group">
               <div class="col-sm-4">
               <select class="form-control" name="pm" id="pm">
               <option value="">Physically or mentally hurted</option>
               <option';
                  if($doc["pm"]=='yes') {$medical_details .= ' selected="selected" ';}
                  $medical_details .=' value="yes">yes</option>
               <option';
                  if($doc["pm"]=='No') {$medical_details .= ' selected="selected" ';}
                  $medical_details .=' value="No">No</option>
               </select> 
               </div>
               <div class="col-sm-4"> 
               <select class="form-control" name="excr" id="excr">
               <option value="">Do you Exercise</option>
               <option';
                  if($doc["excr"]=='yes') {$medical_details .= ' selected="selected" ';}
                  $medical_details .=' value="yes">yes</option>
               <option';
                  if($doc["excr"]=='No') {$medical_details .= ' selected="selected" ';}
                  $medical_details .=' value="No">No</option>
               </select>
               </div>
               <div class="col-sm-4">
               <input class="form-control" type="text" name="nexcr" value="'.$doc["nexcr"].'" maxlength="30" placeholder="# times/week" > 
               </div>
               </div>

            </form>
            <div class="btn col-lg-12 btn-primary medical">Submit</div>
            </div>';

          //patients medical section

}
          elseif($target=='insurence_details'){
            //patients insurence section
         $insurence_details ='<div class="col-lg-12 bg-black disabled color-palette form-group">
         <h3 class="box-title" >Billing And Insurance</h3>
         <form id="Patients_checkin">

         <div class="col-lg-12 ">
         <h5 class="box-title" align="center">Primary Health Insurence</h5>
         </div>

         <div class="col-lg-12 form-group">
         <div class="col-sm-4"> 
         <input type="text" class="form-control" name="Company_name" value="'.$doc["Company_name"].'" maxlength="30" placeholder="Insurence Company">
         </div>
         <div class="col-sm-4"> 
         <input type="text" class="form-control" name="employer" value="'.$doc["employer"].'" maxlength="30" placeholder="Insured'."'".'s Name">
         </div>
         <div class="col-sm-4">
         <input type="text" class="form-control" name="bCity" value="'.$doc["bCity"].'" maxlength="30" placeholder="City">
         </div>
         </div>

         <div class="col-lg-12 form-group">
         <div class="col-sm-4"> 
         <input type="text" class="form-control" name="plan" value="'.$doc["plan"].'" maxlength="30" placeholder="Plan">
         </div>
         <div class="col-sm-4"> 
         <input type="text" class="form-control" name="insurednum" value="'.$doc["insurednum"].'" maxlength="30" placeholder="Insured'."'".'s Phone Number">
         </div>
         <div class="col-sm-4">
         <input type="text" class="form-control" name="bPin" value="'.$doc["bPin"].'" maxlength="30" placeholder="Pincode">
         </div>
         </div>

         <div class="col-lg-12 form-group">
         <div class="col-sm-4"> 
         <input type="text" class="form-control" name="plan_num" value="'.$doc["plan_num"].'" maxlength="30" placeholder="Plan Number">
         </div>
         <div class="col-sm-4"> 
         <input type="text" class="form-control" name="insureddob" value="'.$doc["insureddob"].'" maxlength="30" placeholder="Insured'."'".'s Birth Date">
         </div>
         <div class="col-sm-4">
         <input type="text" class="form-control" name="bstate" value="'.$doc["bstate"].'" maxlength="30" placeholder="State">
         </div>
         </div>

         <div class="col-lg-12 form-group">
         <div class="col-sm-4"> 
         <input class="form-control" type="text" name="GROUP_NUM" value="'.$doc["GROUP_NUM"].'" maxlength="30" placeholder="Group Number">
         </div>
         <div class="col-sm-4"> 
         <input class="form-control" type="text" name="bsec"  value="'.$doc["bsec"].'"maxlength="30" placeholder="Social Security Number">
         </div>
         <div class="col-sm-4">
         <textarea class="form-control" name="iAddress"  rows="2" cols="30" placeholder="Insured Address" >'.$doc["iAddress"].'</textarea>
         </div>
         </div>

         <div class="col-lg-12 ">
         <h5 class="box-title" align="center">Secondary Health Insurance</h5>
         </div>
         <div class="col-lg-12 form-group">
         <div class="col-sm-4"> 
         <input type="text" class="form-control" name="sCompany_name" value="'.$doc["sCompany_name"].'" maxlength="30" placeholder="Insurence Company">
         </div>
         <div class="col-sm-4"> 
         <input type="text" class="form-control" name="semployer" value="'.$doc["semployer"].'" maxlength="30" placeholder="Insured'."'".'s Name">
         </div>
         <div class="col-sm-4">
         <input type="text" class="form-control" name="sbCity" value="'.$doc["sbCity"].'" maxlength="30" placeholder="City">
         </div>
         </div>

         <div class="col-lg-12 form-group">
         <div class="col-sm-4"> 
         <input type="text" class="form-control" name="splan" value="'.$doc["splan"].'" maxlength="30" placeholder="Plan">
         </div>
         <div class="col-sm-4"> 
         <input type="text" class="form-control" name="sinsurednum" value="'.$doc["sinsurednum"].'" maxlength="30" placeholder="Insured'."'".'s Phone Number">
         </div>
         <div class="col-sm-4">
         <input type="text" class="form-control" name="sbPin" value="'.$doc["sbPin"].'" maxlength="30" placeholder="Pincode">
         </div>
         </div>

         <div class="col-lg-12 form-group">
         <div class="col-sm-4"> 
         <input type="text" class="form-control" name="splan_num" value="'.$doc["splan_num"].'" maxlength="30" placeholder="Plan Number">
         </div>
         <div class="col-sm-4"> 
         <input type="text" class="form-control" name="sinsureddob" value="'.$doc["sinsureddob"].'" maxlength="30" placeholder="Insured'."'".'s Birth Date">
         </div>
         <div class="col-sm-4">
         <input type="text" class="form-control" name="sbstate" value="'.$doc["sbstate"].'" maxlength="30" placeholder="State">
         </div>
         </div>

         <div class="col-lg-12 form-group">
         <div class="col-sm-4"> 
         <input type="text"class="form-control" name="sGROUP_NUM" value="'.$doc["sGROUP_NUM"].'" maxlength="30" placeholder="Group Number">
         </div>
         <div class="col-sm-4"> 
         <input type="text" class="form-control" name="sbsec" value="'.$doc["sbsec"].'" maxlength="30" placeholder="Social Security Number">
         </div>
         <div class="col-sm-4">
         <textarea class="form-control" name="siAddress"  rows="2" cols="30" placeholder="Insured Address" >'.$doc["siAddress"].'</textarea>
         </div>
         </div>


         </form>
         <div class="btn col-lg-12 btn-primary insurence">Submit</div>
         </div>';
         //patients insurence section
      }

          if($target=='reg_details'){
            echo $data;
          }
          elseif($target=='medical_details'){
            echo $medical_details;
          }
          elseif($target=='insurence_details'){
            echo $insurence_details;
          }
            
?>