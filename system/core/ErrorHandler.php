<?php

/**
 * Zoom
 *
 * An open source application development framework for PHP
 *
 * This content is released under the Joeworld
 *
 * Copyright (c) 2017, Joestack. - http://iamjoestack.com/
 *
 **/

defined('BASEPATH') OR exit('No direct script access allowed');

/**
* Displays Default Error
*/

class ErrorHandler
{

private $zoomversion = zoom_config::ZOOM_VERSION;

private $zoomurl = zoom_config::ZOOM_URL;

public function DefError($errtype, $errno, $errstr, $errfile, $errline)
{

$message = <<<HTML
<hr>
<div style="margin:0 auto;max-width:700px;">
<table class="" style="width:100%;font-size:0px;">
<tbody>
 <tr>
   <td style="text-align:center;vertical-align:top;font-size:0;padding:20px 0;padding-top:0px;padding-bottom:24px;"></td>
 </tr>
</tbody>
</table>
</div>
<div style="margin:0 auto;max-width:700px;">
<table class="" style="width:100%;font-size:0px;background:#d8e2e7;">
<tbody>
 <tr>
   <td style="text-align:center;vertical-align:top;font-size:0;padding:1px;">
     <div style="vertical-align:top;display:inline-block;font-size:13px;text-align:left;width:100%;">
       <table style="background:white;width:100%">
         <tbody>
           <tr>
             <td style="font-size:0;padding:30px 30px 18px;">
               <div style="cursor:auto;color:#000000;font-family:Proxima Nova, Arial, Arial, Helvetica, sans-serif;font-size:22px;line-height:22px;">
                 <h2>A PHP Error was encountered <br><br>({$errtype})</h2>
                 <p><b>Error No: </b>[{$errno}]</p>
                 <p><b>Error Message: </b>[{$errstr}]</p>
                 <p><b>File: </b>[{$errfile}]</p>
                 <p><b>Line: </b>[{$errline}]</p>
                 <br>
                 <p>Please correct error immediately</p>
               </div>
             </td>
           </tr>
           <tr>
             <td style="font-size:0;padding:8px 16px 10px;padding-bottom:16px;padding-right:30px;padding-left:30px;">
               <table style="border:none;border-radius:25px;">
                 <tbody>
                   <!--<tr>
                     <td>
                       <a href="#" style="display:inline-block;text-decoration:none;background:#00a8ff;border:1px solid #00a8ff;border-radius:3px;color:white;font-family:Proxima Nova, Arial, Arial, Helvetica, sans-serif;font-size:14px;font-weight:400;padding:8px 12px 9px;" target="_blank">Go back to homepage</a>
                     </td>
                   </tr>-->
                 </tbody>
               </table>
             </td>
           </tr>
         </tbody>
       </table>
     </div>
   </td>
 </tr>
</tbody>
</table>
<table style="width:100%">
<tbody>
 <tr>
   <td style="font-size:0;padding:0px;">
     <div style="cursor:auto;color:#6b7a85;font-family:Proxima Nova, Arial, Arial, Helvetica, sans-serif;font-size:12px;line-height:22px;margin-top:10px;text-align:center;">
       © 2017 Zoom Framework&nbsp;&nbsp;&nbsp;&bull;&nbsp;&nbsp;&nbsp;<a href="{$this->zoomurl}" target="_blank" style="border-bottom: dotted 1px #b3bac1;text-decoration: none; color: inherit;"></a>&nbsp;&nbsp;&nbsp;&bull;&nbsp;&nbsp;&nbsp;Version - {$this->zoomversion}
     </div>
   </td>
 </tr>
</tbody>
</table>
</div>
<hr>
HTML;

return $message;

}


public function DbShowError($msg)
{
$message = <<<HTML
<hr>
<div style="margin:0 auto;max-width:700px;">
<table class="" style="width:100%;font-size:0px;">
<tbody>
 <tr>
   <td style="text-align:center;vertical-align:top;font-size:0;padding:20px 0;padding-top:0px;padding-bottom:24px;"></td>
 </tr>
</tbody>
</table>
</div>
<div style="margin:0 auto;max-width:700px;">
<table class="" style="width:100%;font-size:0px;background:#d8e2e7;">
<tbody>
 <tr>
   <td style="text-align:center;vertical-align:top;font-size:0;padding:1px;">
     <div style="vertical-align:top;display:inline-block;font-size:13px;text-align:left;width:100%;">
       <table style="background:white;width:100%">
         <tbody>
           <tr>
             <td style="font-size:0;padding:30px 30px 18px;">
               <div style="cursor:auto;color:#000000;font-family:Proxima Nova, Arial, Arial, Helvetica, sans-serif;font-size:22px;line-height:22px;">
                 <h2>A DATABASE Error was encountered <br><br>Due to misconfiguration</h2>
                 <p>
                   <b>Message</b>: {$msg}
                 </p>
                 <p>Please correct error immediately</p>
               </div>
             </td>
           </tr>
           <tr>
             <td style="font-size:0;padding:8px 16px 10px;padding-bottom:16px;padding-right:30px;padding-left:30px;">
               <table style="border:none;border-radius:25px;">
                 <tbody>
                   <!--<tr>
                     <td>
                       <a href="#" style="display:inline-block;text-decoration:none;background:#00a8ff;border:1px solid #00a8ff;border-radius:3px;color:white;font-family:Proxima Nova, Arial, Arial, Helvetica, sans-serif;font-size:14px;font-weight:400;padding:8px 12px 9px;" target="_blank">Go back to homepage</a>
                     </td>
                   </tr>-->
                 </tbody>
               </table>
             </td>
           </tr>
         </tbody>
       </table>
     </div>
   </td>
 </tr>
</tbody>
</table>
<table style="width:100%">
<tbody>
 <tr>
   <td style="font-size:0;padding:0px;">
     <div style="cursor:auto;color:#6b7a85;font-family:Proxima Nova, Arial, Arial, Helvetica, sans-serif;font-size:12px;line-height:22px;margin-top:10px;text-align:center;">
       © 2017 Zoom Framework&nbsp;&nbsp;&nbsp;&bull;&nbsp;&nbsp;&nbsp;<a href="{$this->zoomurl}" target="_blank" style="border-bottom: dotted 1px #b3bac1;text-decoration: none; color: inherit;"></a>&nbsp;&nbsp;&nbsp;&bull;&nbsp;&nbsp;&nbsp;Version - {$this->zoomversion}
     </div>
   </td>
 </tr>
</tbody>
</table>
</div>
<hr>
HTML;

return $message;

}

public function custom404(){

$message = <<<HTML
<hr>
<div style="margin:0 auto;max-width:700px;">
<table class="" style="width:100%;font-size:0px;">
<tbody>
 <tr>
   <td style="text-align:center;vertical-align:top;font-size:0;padding:20px 0;padding-top:0px;padding-bottom:24px;"></td>
 </tr>
</tbody>
</table>
</div>
<div style="margin:0 auto;max-width:700px;">
<table class="" style="width:100%;font-size:0px;background:#d8e2e7;">
<tbody>
 <tr>
   <td style="text-align:center;vertical-align:top;font-size:0;padding:1px;">
     <div style="vertical-align:top;display:inline-block;font-size:13px;text-align:left;width:100%;">
       <table style="background:white;width:100%">
         <tbody>
           <tr>
             <td style="font-size:0;padding:30px 30px 18px;">
               <div style="cursor:auto;color:#000000;font-family:Proxima Nova, Arial, Arial, Helvetica, sans-serif;font-size:22px;line-height:22px;">
                 <p>Requested Page Was Not Found</p>
               </div>
             </td>
           </tr>
           <tr>
             <td style="font-size:0;padding:8px 16px 10px;padding-bottom:16px;padding-right:30px;padding-left:30px;">
               <table style="border:none;border-radius:25px;">
                 <tbody>
                   <!--<tr>
                     <td>
                       <a href="#" style="display:inline-block;text-decoration:none;background:#00a8ff;border:1px solid #00a8ff;border-radius:3px;color:white;font-family:Proxima Nova, Arial, Arial, Helvetica, sans-serif;font-size:14px;font-weight:400;padding:8px 12px 9px;" target="_blank">Go back to homepage</a>
                     </td>
                   </tr>-->
                 </tbody>
               </table>
             </td>
           </tr>
         </tbody>
       </table>
     </div>
   </td>
 </tr>
</tbody>
</table>
<table style="width:100%">
<tbody>
 <tr>
   <td style="font-size:0;padding:0px;">
     <div style="cursor:auto;color:#6b7a85;font-family:Proxima Nova, Arial, Arial, Helvetica, sans-serif;font-size:12px;line-height:22px;margin-top:10px;text-align:center;">
       © 2017 Zoom Framework&nbsp;&nbsp;&nbsp;&bull;&nbsp;&nbsp;&nbsp;<a href="{$this->zoomurl}" target="_blank" style="border-bottom: dotted 1px #b3bac1;text-decoration: none; color: inherit;"></a>&nbsp;&nbsp;&nbsp;&bull;&nbsp;&nbsp;&nbsp;Version - {$this->zoomversion}
     </div>
   </td>
 </tr>
</tbody>
</table>
</div>
<hr>
HTML;

return $message;

}

//End class
}
