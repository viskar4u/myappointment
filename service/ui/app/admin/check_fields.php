<?php
include(APP_PATH."service/ui/app/admin/confg/config.menu.action.php");

function check_field($field,$type,$key,$value,$comment,$tb_type){
  $d_type=explode('(', $type);
    //echo $field;
    //print_r($d_type);
    $list_op=menu_action($tb_type);
    $hi_fields=$list_op['hidden'];
    if(empty($hi_fields)){$hi_fields[]='fg';}
    $min='';$max='';
    if (!(in_array($field, $hi_fields))){
      $required='required="required"';
    if($key=='PRI' ||  $field=='size' || $field=='apnt_id' ||  ($field=='password' && isset($_GET['id']) )) 
     { $disabled='readonly="readonly"'; }
    else { $disabled='';}
    if($field=='password'){
      $field_type='password';
      $min='data-minlength="6"';
    }elseif($field=='email'){
        $field_type='email';
    }else{
      $field_type='text';
    }
 if($field=='city' || $field=='state'){
          $placeholder='placeholder="Enter zipcode first"';
        }
        if($field=='zipcode'){$min='data-minlength="5"';$max='data-maxlength="6"';}
        if($field=='phone'){$min='data-minlength="10"';$max='data-maxlength="10"';$validate=' data-type="digits"';}
        $extra_field=false;
        if($field=='working_plan' || $field=='breaks' || $field=='vecation' || $field=='reg_details' || $field=='insurence_details' || $field=='medical_details'){
          $extra_field=true;
          $disabled='readonly="readonly"';
          if($field=='reg_details' || $field=='medical_details' || $field=='insurence_details'){
            $F_cls='pull-right checkin';
          }else{
            $F_cls='pull-right calender';
          }
        }
        

    //check join to another table or not
    if(isset($comment)){
      $cmt=explode('>', $comment);
      if($cmt[0]=='join'){
        $cmt_cls='cmt_cls';
        $cmt_tb=$cmt[1];
      }
      if($cmt[0]=='get'){
        $cmt_cls='get_cls';
        $cmt_tb_s=explode('-',$cmt[1]);
        $cmt_tb=$cmt_tb_s[0];
        $cmt_name=$cmt_tb_s[1];
      }else{$cmt_name='';}
    }
  switch ($d_type[0]) {
      case 'int':
      //if(isset($comment))echo 's';
      if(!isset($_GET['id']) && $key=='PRI'){}else{
       
      return '<div class="form-group">
                      <label >'.strtoupper(str_replace("_"," ",$field)).'</label>
                      <input data-trigger="change" '.$min.' '.$required.' type="'.$field_type.'" '.$placeholder.' name="'.$field.'" value="'.$value.'" cmt_tb="'.$cmt_tb.'" cmt_name="'.$cmt_name.'"  class="'.$cmt_cls.' form-control" '.$disabled.'>
                    </div>';
                  }
                  
      break;
      case 'longtext':
      if($field=='vecation'){$F_name='vacation';}else{$F_name=$field;}
      if( (isJSON($value)) || $field=='vecation' || $field=='breaks' || $field=='working_plan'){
            $arr_data=json_decode($value,true);

            $data= '<div class="form-group">
            <label>'.strtoupper(str_replace("_"," ",$F_name)).'</label>';
            //json display
            if(count($arr_data) > 0){
            $data .='<div class="detail-box" ><dl class="dl-horizontal">';
            foreach ($arr_data as $key => $value1) {
            if(is_string($value1)){
              $_dis= (empty($value1)) ? "--" : $value1;
              $data .='<dt>'.$key.' :- </dt><dd>'.$_dis.'</dd>';
            }else{
              $_key= (is_string($key)) ? $key : $F_name." ".$key;
              $data .='<dt>'.$_key.' :- </dt><dd>';
              foreach ($value1 as $key1 => $value2) {
                //$data .='<dt>'.$key1.'</dt><dd>'.$value2.'</dd>';
                $data .=$key1." : ".$value2.", ";
              }
              $data .='</dd>';
            }
            }
            $data .='</dl></div>';
          }else{
            $data .='<div class="detail-box" > Please enter '.strtoupper(str_replace("_"," ",$F_name)).' details </div>';
          }
            //json display
            $data .='<textarea '.$required.' style="display:none;" name="'.$field.'"  placeholder="Enter ..." rows="3" class="form-control" '.$disabled.'>'.$value.'</textarea>';
            //$data .='<input type="hidden" name="'.$field.'" '.$required.' value='.$value.'>';
            if($extra_field){
            $data .= '<a target="'.$F_name.'" class="'.$F_cls.'" href="#" data-toggle="modal" data-target="#myModal">SETUP '.strtoupper(str_replace("_"," ",$F_name)).'</a>';
            }
            $data .='</div>';
      }
      else{
            $data= '<div class="form-group">
            <label>'.strtoupper(str_replace("_"," ",$F_name)).'</label>
            <textarea '.$required.' name="'.$field.'"  placeholder="Enter ..." rows="3" class="form-control" '.$disabled.'>'.$value.'</textarea>';
            if($extra_field){
            $data .= '<a target="'.$F_name.'" class="'.$F_cls.'" href="#" data-toggle="modal" data-target="#myModal">SETUP '.strtoupper(str_replace("_"," ",$F_name)).'</a>';
            }
            $data .='</div>';
          }
      return $data;

      break;

      case 'varchar':
      if($field=='secret_key'){
          $val=md5(substr(number_format(time() * mt_rand(),0,'',''),0,10));
          $disabled="readonly='readonly'";
      }else{
          $val=$value;
      }
      return '<div class="form-group">
                      <label >'.strtoupper(str_replace("_"," ",$field)).'</label>
                      <input data-trigger="change" '.$validate.' '.$min.' '.$max.' '.$required.' name="'.$field.'" '.$placeholder.' type="'.$field_type.'" value="'.$val.'" cmt_tb="'.$cmt_tb.'" cmt_name="'.$cmt_name.'" class="'.$cmt_cls.' form-control" '.$disabled.'>
                    </div>';
      break;
      case 'date':
      return '<div class="form-group">
                      <label >'.strtoupper(str_replace("_"," ",$field)).'</label>
                      <input data-trigger="change" '.$required.' name="'.$field.'"  type="text" value="'.$value.'"  class="datepicker form-control" '.$disabled.'>
                    </div>';
      break;

      case 'datetime':
      if($field=='updatedate' || $field=='createdate'){
        if($field!='createdate'){$val=date('Y-m-d h:i:s');}else{if($field=='createdate' && !isset($_GET['id'])){$val=date('Y-m-d h:i:s');}else{$val=$value;}}
        
        $disabled='readonly="readonly"';$class='timepicker';
      }
      else{$val=$value;$disabled='';$class='';}
      return '<div class="form-group">
                      <label >'.strtoupper(str_replace("_"," ",$field)).'</label>
                      <input data-trigger="change" '.$required.' name="'.$field.'"  type="text" value="'.$val.'"  class="'.$class.' form-control" '.$disabled.'>
                    </div>';
      break;
      case 'time':
      $val=$value;$disabled='';$class='timepicker';
      return '<div class="form-group">
                      <label >'.strtoupper(str_replace("_"," ",$field)).'</label>
                      <input data-trigger="change" '.$required.' name="'.$field.'"  type="text" value="'.$val.'"  class="'.$class.' form-control" '.$disabled.'>
                    </div>';
      break;
      case 'enum':
        $enum_var=explode(',', $d_type[1]);
        $options=explode(',',$comment);
        $arr;
        foreach ($options as $key => $op_value) {
          $op_data=explode('->', $op_value);
          $arr[$op_data[0]]=$op_data[1];
        }
        //print_r($arr);
        $field_html = '<div class="form-group">
                      <label >'.strtoupper(str_replace("_"," ",$field)).'</label><select '.$required.' name="'.$field.'" style="width: 100%;" class="form-control select2 select2-hidden-accessible" tabindex="-1" aria-hidden="true">
        <option value="">Select one</option>';
        $selected='';
        foreach ($arr as $key => $values) {

          if($value==$key){$selected='selected="selected"';}else{$selected='';}
            $field_html .='<option '.$selected.' value='.$key.'>'.$values.'</option>';
        }
                      
                 $field_html .='</select></div>';
                 return $field_html;
    
    default:
      # code...
      break;
  }
}
}
?>