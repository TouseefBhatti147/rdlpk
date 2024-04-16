<?php 
class MyHelper
{

          public static  function encrypt_text($string)
             {
                $ciphering = "AES-128-CTR";
                $iv_length = openssl_cipher_iv_length($ciphering);
                $options = 0;
                $encryption_iv = '1234567891011121';
                $encryption_key = "smartsuite_for_everyone";
                $encryption = openssl_encrypt($string, $ciphering,
                $encryption_key, $options, $encryption_iv);
                return base64_encode($encryption);
                 
             }

         public static function send_email($param)
             {
                 
                 $string = md5(uniqid(). "rdlpk.comjunahmed46@gmail.com") . "|8:5uv,6hPB!EwS'QKna-?n$-^-9h=" . "|" . uniqid()."|". time();
                  $code = self::encrypt_text($string);
                   $curl = curl_init();

                    curl_setopt_array($curl, array(
                      
                      //CURLOPT_URL => 'https://hrldigital.com/process-email',
                      CURLOPT_URL => 'https://support.smartsuitepk.com/process-email',
                      CURLOPT_RETURNTRANSFER => true,
                      CURLOPT_ENCODING => '',
                      CURLOPT_MAXREDIRS => 10,
                      CURLOPT_TIMEOUT => 5,
                      CURLOPT_FOLLOWLOCATION => true,
                      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                      CURLOPT_CUSTOMREQUEST => 'POST',
                      CURLOPT_POSTFIELDS => array(
                          'mail_to' => $param['mail_to'],
                          'mail_subject' => $param['mail_subject'],
                          'mail_detail' => $param['mail_detail'],
                          'project_id' => '4',
                          'hash_code' => $code),
                      
                    ));
                    
                    $response = curl_exec($curl);
              }
    
}           

