<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Schema;
use DB;
use Twilio\Rest\Client;


// session_start();
class Site extends Model{
  

    public static function fil_email($str){
        $val = preg_replace("/[^A-Za-z0-9_.-@]/", "", $str);
        $val = strtolower($val);
        return $val;
    }

    public static function fil_amount($str){
        $val = preg_replace("/[^0-9+.]/", "", $str);
        return $val;
    }
 
    public static function fil_num($str){
        $val = preg_replace("/[^0-9+.]/", "", $str);
        return $val;
    }

    public static function fil_text($str){
        $val = preg_replace("/[^A-Za-z0-9,_.\-@() ]/", "", $str);
        $val = strtolower($val);
        return $val;
    }
    
    public static function fil_special($str){
        $val = preg_replace("/[^A-Za-z0-9,_.\-@() ]/", "", $str);
        return $val;
    }

    public static function fil_string($str){
        $val = preg_replace("/[^A-Za-z0-9_.\-]/", "", $str);
        $val = strtolower($val);
        return $val;
    }

    public static function fil_password($str){
        $val = preg_replace("/[^A-Za-z0-9_.\-@!#$%&*() ]/", "", $str);
        return $val;
    }
    
    public static function encode_password($t) {
        $a = "677HHge";
        $b = "lopjdhg";
        //encode pass
        $r = base64_encode($t);
        //add pre salt
        $r = $a.$r;
        return $r;
    }

    public static function decode_password($t) {
        $r = substr($t, 7);
        $r = base64_decode($r);
        return $r;
    }

    public static function gen_uq_id($txt) {
        // $a = uniqid();
        $a = mt_rand(9000,9000000);
        $r = $txt.substr(str_shuffle($a),0, 4);
        return strtoupper($r);
    }

    public static function gen_token() {
        $a = mt_rand(9000,9000000);
        $r = substr(str_shuffle($a),0, 6);
        return strtoupper($r);
    }

    public static function fil_request($in, $except = null) {
        if(is_array($in)){
            $filtered = [];
            foreach ($in as $key => $value) {
                $k = strtolower($key);


                if(!is_array($value)){

                    // get exceptions
                    if($k != $except){
                        $v = strtolower($value);
                       
                    }
                    else{
                        $v = $value;
                    }

                     $filtered[$k] = $v;
                }
                else{
                    // level 2 array
                    $k = strtolower($key);
                    foreach ($value as $ky => $vl) {
                        $k1 = strtolower($ky);
                        $v1 = strtolower($vl);

                        $filtered[$k][$k1] = $v1;
                    }

                }
                
            }

            return $filtered;
        }
        else{
            return null;
        }
    }

    public static function convert_db_json_to_array($json){
        $r = json_decode(json_encode(json_decode($json)), true);
        return $r; 
    }

    public static function convert_db_array_to_json($arr){
        $r = json_encode(json_decode(json_encode($arr)), true);
        return $r; 
    }

     public static function get_visitor_location(){
        $xml = simplexml_load_file("http://www.geoplugin.net/xml.gp?ip=".Site::get_visitor_ip());
        return $xml->geoplugin_city.", ".$xml->geoplugin_countryName;
    }

    public static function get_visitor_ip(){
        $ipaddress = '';
        if (getenv('HTTP_CLIENT_IP'))
            $ipaddress = getenv('HTTP_CLIENT_IP');
        else if(getenv('HTTP_X_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
        else if(getenv('HTTP_X_FORWARDED'))
            $ipaddress = getenv('HTTP_X_FORWARDED');
        else if(getenv('HTTP_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_FORWARDED_FOR');
        else if(getenv('HTTP_FORWARDED'))
            $ipaddress = getenv('HTTP_FORWARDED');
        else if(getenv('REMOTE_ADDR'))
            $ipaddress = getenv('REMOTE_ADDR');
        else
            $ipaddress = 'UNKNOWN';
     
        return $ipaddress;
    }

    public static function time_ago($time_ago){
        $time_ago = strtotime($time_ago);
        $cur_time   = time();
        $time_elapsed   = $cur_time - $time_ago;
        $seconds    = $time_elapsed ;
        $minutes    = round($time_elapsed / 60 );
        $hours      = round($time_elapsed / 3600);
        $days       = round($time_elapsed / 86400 );
        $weeks      = round($time_elapsed / 604800);
        $months     = round($time_elapsed / 2600640 );
        $years      = round($time_elapsed / 31207680 );
        // Seconds
        if($seconds <= 60){
            return "just now";
        }
        //Minutes
        else if($minutes <=60){
            if($minutes==1){
                return "one minute ago";
            }
            else{
                return "$minutes minutes ago";
            }
        }
        //Hours
        else if($hours <=24){
            if($hours==1){
                return "an hour ago";
            }else{
                return "$hours hrs ago";
            }
        }
        //Days
        else if($days <= 7){
            if($days==1){
                return "yesterday";
            }else{
                return "$days days ago";
            }
        }
        //Weeks
        else if($weeks <= 4.3){
            if($weeks==1){
                return "a week ago";
            }else{
                return "$weeks weeks ago";
            }
        }
        //Months
        else if($months <=12){
            if($months==1){
                return "a month ago";
            }else{
                return "$months months ago";
            }
        }
        //Years
        else{
            // if($years==1){
            //     return "one year ago";
            // }else{
            //     return "$years years ago";
            // }

            return $time_ago;
        }
    }

    public static function send_sms($message, $recipients){
        
    }

    public static function send_email($email, $subject, $msg){
        $message = "<!DOCTYPE html>
                                    <html lang='en' xmlns='http://www.w3.org/1999/xhtml' xmlns:o='urn:schemas-microsoft-com:office:office'>
                                    
                                    <head>
                                        <meta charset='utf-8'>
                                        <meta name='viewport' content='width=device-width,initial-scale=1'>
                                        <meta name='x-apple-disable-message-reformatting'>
                                        <title></title>
                                        <link rel='preconnect' href='https://fonts.googleapis.com'>
                                        <link rel='preconnect' href='https://fonts.gstatic.com' crossorigin>
                                        <link href='https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;500;600;700&display=swap'
                                            rel='stylesheet'>
                                        <!--[if mso]>
                                      <style>
                                        table {border-collapse:collapse;border-spacing:0;border:none;margin:0;}
                                        div, td {padding:0;}
                                        div {margin:0 !important;}
                                      </style>
                                      <noscript>
                                        <xml>
                                          <o:OfficeDocumentSettings>
                                            <o:PixelsPerInch>96</o:PixelsPerInch>
                                          </o:OfficeDocumentSettings>
                                        </xml>
                                      </noscript>
                                      <![endif]-->
                                    
                                    </head>
                                    
                                    <body style='margin:0;padding:0;word-spacing:normal;background-color:#fff;'>
                                        <table align='center' border='0' cellpadding='0' cellspacing='0' id='bodyTable'
                                            style='border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; height: 100%; margin: 0; padding: 0; width: 100%; background-color: #f3f3f3;'
                                            width='100%'>
                                            <tbody>
                                                <tr>
                                                    <td align='center' id='bodyCell'
                                                        style='mso-line-height-rule: exactly; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; height: 100%; margin: 0; width: 100%; padding: 10px; border-top: 0;'
                                                        valign='top'>
                                    
                                                        <table border='0' cellpadding='0' cellspacing='0' class='templateContainer'
                                                            style='border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; max-width: 600px !important; border: 0;'
                                                            width='100%'>
                                                            <tbody>
                                                                <tr>
                                                                    <td id='templatePreheader'
                                                                        style='mso-line-height-rule: exactly; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; background-color: #f3f3f3; background-image: none; background-repeat: no-repeat; background-position: center; background-size: cover; border-top: 0; border-bottom: 0; padding-top: 9px; padding-bottom: 9px;'
                                                                        valign='top'>&nbsp;</td>
                                                                </tr>
                                                                <tr>
                                                                    <td id='templateHeader'
                                                                        style='mso-line-height-rule: exactly; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; background-color: #ffffff; background-image: none; background-repeat: no-repeat; background-position: center; background-size: cover; border-top: 0; border-bottom: 0; padding-top: 0px; padding-bottom: 0;'
                                                                        valign='top'>
                                    
                                                                        <table border='0' cellpadding='0' cellspacing='0' class='mcnImageBlock'
                                                                            style='border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; min-width: 100%;'
                                                                            width='100%'>
                                                                            <tbody class='mcnImageBlockOuter'>
                                                                                <tr>
                                                                                    <td class='mcnImageBlockInner'
                                                                                        style='mso-line-height-rule: exactly; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; padding: 0px;'
                                                                                        valign='top'>
                                    
                                                                                        <table align='left' border='0' cellpadding='0' cellspacing='0'
                                                                                            class='mcnImageContentContainer'
                                                                                            style='border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; min-width: 100%;'
                                                                                            width='100%'>
                                                                                            <tbody>
                                                                                                <tr>
                                                                                                    <td class='mcnImageContent'
                                                                                                        style='mso-line-height-rule: exactly; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; text-align: center; padding: 0 0px 0 0px;'
                                                                                                        valign='top'>
                                                                                                        <center>
                                                                                                            <img src='https://treatsbybeats.com/logo.png' width='170' style='margin-top: 22px;'
                                                                                                                class='fr-deletable'>
                                                                                                        </center>
                                    
                                                                                                    </td>
                                                                                                </tr>
                                                                                            </tbody>
                                                                                        </table>
                                                                                    </td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td id='templateBody'
                                                                        style='mso-line-height-rule: exactly; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; background-color: #ffffff; background-image: none; background-repeat: no-repeat; background-position: center; background-size: cover; border-top: 0; border-bottom: 2px solid #EAEAEA; padding-top: 0; padding-bottom: 9px;'
                                                                        valign='top'>
                                    
                                                                        <table border='0' cellpadding='0' cellspacing='0' class='mcnTextBlock'
                                                                            style='border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; min-width: 100%;'
                                                                            width='100%'>
                                                                            <tbody class='mcnTextBlockOuter'>
                                                                                <tr>
                                                                                    <td class='mcnTextBlockInner'
                                                                                        style='mso-line-height-rule: exactly; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; padding-top: 9px;'
                                                                                        valign='top'>
                                    
                                                                                        <table align='left' border='0' cellpadding='0' cellspacing='0'
                                                                                            class='mcnTextContentContainer'
                                                                                            style='border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; max-width: 100%; min-width: 100%;'
                                                                                            width='100%'>
                                                                                            <tbody>
                                                                                                <tr>
                                                                                                    <td class='mcnTextContent'
                                                                                                        style='mso-line-height-rule: exactly; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; word-break: break-word; color: #202020; font-family: Helvetica; font-size: 16px; line-height: 150%; text-align: left; padding: 0 18px 9px 18px;'
                                                                                                        valign='top'>

                                                                                                                $msg
                                        
                                                                                                                <p dir='ltr'
                                                                                                                    style='margin: 10px 0; padding: 0; mso-line-height-rule: exactly; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; color: #202020; font-family: Helvetica; font-size: 16px; text-align: left; line-height: 1.38; margin-top: 0pt; margin-bottom: 0pt;'>
                                                                                                                    <span
                                                                                                                        style='font-size: 11pt; font-family: Arial; color: #000000; background-color: transparent; font-weight: bold; font-style: normal; font-variant: normal; text-decoration: none; vertical-align: baseline; white-space: pre-wrap;'>&nbsp;<strong
                                                                                                                            style='font-weight: normal;'><br></strong></span>
                                                                                                                </p>
                                            
                                                                                                                <p dir='ltr'
                                                                                                                    style='margin: 10px 0; padding: 0; mso-line-height-rule: exactly; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; color: #202020; font-family: Helvetica; font-size: 16px; text-align: left; line-height: 1.38; margin-top: 0pt; margin-bottom: 0pt;'>
                                                                                                                    &nbsp;</p>
                                            
                                                                                                            </td>
                                                                                                        </tr>
                                                                                                    </tbody>
                                                                                                </table>
                                                                                            </td>
                                                                                        </tr>
                                                                                    </tbody>
                                                                                </table>
                                            
                                                                                <table border='0' cellpadding='0' cellspacing='0' class='mcnDividerBlock'
                                                                                    style='border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; table-layout: fixed !important; min-width: 100%;'
                                                                                    width='100%'>
                                                                                    <tbody class='mcnDividerBlockOuter'>
                                                                                        <tr>
                                                                                            <td style='mso-line-height-rule: exactly; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; padding: 20px 0 0 0;'
                                                                                                valign='top'>&nbsp;</td>
                                                                                        </tr>
                                                                                    </tbody>
                                                                                </table>
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td id='templateFooter'
                                                                                style='mso-line-height-rule: exactly; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; background-color: #f3f3f3; background-image: none; background-repeat: no-repeat; background-position: center; background-size: cover; border-top: 0; border-bottom: 0; padding-top: 9px; padding-bottom: 9px;'
                                                                                valign='top'>
                                            
                                                                                <table border='0' cellpadding='0' cellspacing='0' class='mcnTextBlock'
                                                                                    style='border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; min-width: 100%;'
                                                                                    width='100%'>
                                                                                    <tbody class='mcnTextBlockOuter'>
                                                                                        <tr>
                                                                                            <td class='mcnTextBlockInner'
                                                                                                style='mso-line-height-rule: exactly; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; padding-top: 9px;'
                                                                                                valign='top'>
                                            
                                                                                                <table align='left' border='0' cellpadding='0'
                                                                                                    cellspacing='0' class='mcnTextContentContainer'
                                                                                                    style='border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; max-width: 100%; min-width: 100%;'
                                                                                                    width='100%'>
                                                                                                    <tbody>
                                                                                                        <tr>
                                                                                                            <td class='mcnTextContent'
                                                                                                                style='mso-line-height-rule: exactly; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; word-break: break-word; color: #656565; font-family: Helvetica; font-size: 12px; line-height: 150%; text-align: center; padding: 0 18px 9px 18px;'
                                                                                                                valign='top'>
                                            
                                                                                                                <p
                                                                                                                    style='margin: 10px 0; padding: 0; mso-line-height-rule: exactly; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; color: #656565; font-family: Helvetica; line-height: 150%; text-align: center; font-size: 12px !important;'>
                                                                                                                    Treats By Beats
                                                                                                                </p>
                                                                                                            </td>
                                                                                                        </tr>
                                                                                                    </tbody>
                                                                                                </table>
                                                                                            </td>
                                                                                        </tr>
                                                                                    </tbody>
                                                                                </table>
                                            
                                                                                <table border='0' cellpadding='0' cellspacing='0' class='mcnDividerBlock'
                                                                                    style='border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; table-layout: fixed !important; min-width: 100%;'
                                                                                    width='100%'>
                                                                                    <tbody class='mcnDividerBlockOuter'>
                                                                                        <tr>
                                                                                            <td class='mcnDividerBlockInner'
                                                                                                style='mso-line-height-rule: exactly; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; min-width: 100%; padding: 18px;'>
                                            
                                                                                                <table border='0' cellpadding='0' cellspacing='0'
                                                                                                    class='mcnDividerContent'
                                                                                                    style='border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; min-width: 100%; border-top: 2px solid #EAEAEA;'
                                                                                                    width='100%'>
                                                                                                    <tbody>
                                                                                                        <tr>
                                                                                                            <td
                                                                                                                style='mso-line-height-rule: exactly; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;'>
                                                                                                                &nbsp;</td>
                                                                                                        </tr>
                                                                                                    </tbody>
                                                                                                </table>
                                                                                            </td>
                                                                                        </tr>
                                                                                    </tbody>
                                                                                </table>
                                            
                                                                                
                                                                            </td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                                <div class='default-style'>&nbsp;</div>
                                            </body>
                                            
                                            </html>";

        // Always set content-type when sending HTML email
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

        $headers .= "X-Mailer: PHP/" . phpversion(). "\r\n";
        $headers .= "X-Priority: 1". "\r\n";

        // More headers
        $headers .= "From: BEATS <support@treatsbybeats.com>" . "\r\n";

        mail($email,$subject,$message,$headers);
    }


}
