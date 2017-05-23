<?php  
/** 
 *@see Yii CSecurityManager; 
 */  
class Des{  
  
  public static function encrypt($data,$key){  
      $module=mcrypt_module_open('des','', MCRYPT_MODE_CBC,'');  
      $key=substr(md5($key),0,mcrypt_enc_get_key_size($module));  
      srand();  
      $iv=mcrypt_create_iv(mcrypt_enc_get_iv_size($module), MCRYPT_RAND);  
      mcrypt_generic_init($module,$key,$iv);  
      $encrypted=$iv.mcrypt_generic($module,$data);  
      mcrypt_generic_deinit($module);  
      mcrypt_module_close($module);  
      return md5($data).'_'.base64_encode($encrypted);  
  }  
    
  public static function decrypt($data,$key){      
      $_data = explode('_',$data,2);  
      if(count($_data)<2){  
    return false;  
      }  
      $data = base64_decode($_data[1]);        
      $module=mcrypt_module_open('des','', MCRYPT_MODE_CBC,'');  
      $key=substr(md5($key),0,mcrypt_enc_get_key_size($module));  
      $ivSize=mcrypt_enc_get_iv_size($module);  
      $iv=substr($data,0,$ivSize);  
      mcrypt_generic_init($module,$key,$iv);  
      $decrypted=mdecrypt_generic($module,substr($data,$ivSize,strlen($data)));  
      mcrypt_generic_deinit($module);  
      mcrypt_module_close($module);  
      $decrypted = rtrim($decrypted,"\0");         
      if($_data[0]!=md5($decrypted)){  
    return false;  
      }  
      return $decrypted;  
  }  
    
}  
?>  