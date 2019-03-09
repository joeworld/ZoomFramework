<?php

/**
* Zoom
*
* Ninimal but powerful web application framework for PHP
*
* This content is not open source but application built with zoom can be modified by users, but not to be sold
*
* Copyright (c) 2018, Zoom Inc, ZumClouds Nigeria.
*
**/

defined('BASEPATH') OR exit('No direct script access allowed');

/**
*
* EMAIL LAYOUTS OF MOST USED EMAIL TYPES LIKE REGISTERATION EMAILS, FORGOT PASSWORD, ACTIVATE ACCOUNT ETC.
*
**/

class Email_Layout
{

/**
 * User username
 */

private $username = null;

/**
 * User fullname
 */

private $fullname = null;


/**
 * Link to click if any
 */

private $link = null;

/**
 * Message to send to user
 */

private $message = null;

/**
 * E-mail Types
 */

private $email_types = array();

/**
 * Site Name
 */

private $sitename = null;

/**
 * Site url
 */

private $site_url = null;

public  function __construct($email_type = null, $message = null, $username = '', $fullname = '', $link = '', $sanitize = TRUE)
  {
     $date = date("Y-m-d H:i:s");
     $year   = date('Y');
     $this->year = $year;
     $this->username = strip_tags($username);
     $this->fullname = strip_tags($fullname);
     $this->link = strip_tags($link);
     if(defined('SITENAME')){
     $this->sitename = SITENAME;
     if(strlen($this->sitename) < 2){
     die("Your sitename is too short, please correct it in your config file");
     }
     }else{
     $this->sitename = 'Zoom';
     }

     if($sanitize == TRUE){
     $this->message = htmlspecialchars($message, ENT_QUOTES, "UTF-8");
     }else{
     $this->message = $message;
     }

     $this->site_url = BASEURL;

     if (strlen($this->site_url) < 2) {
     die("Please provide a valid site url in your config file to use e-mail layouts");
     }

    /**
     * Start e-mail process according to passed email_type
     */

     $this->email_types =  array('new_login_alert','activate','change_password','finish_registeration','thank_you');

     if($email_type != ""){
     if(in_array($email_type, $this->email_types)){

     /**
      * Use functions that has this e-mail names
      */

     if(method_exists($this, $email_type)){
     return self::$email_type();
     }else{
     print("There is no given function for this email type: $email_type");
     print(", below are the list of available functions<br>");
     foreach ($this->email_types as $type) {
     print("<b>$type</b><br>");
     }
     exit();
     }
     }else{

       print("There is no given function for this email type: $email_type");
       print(", below are the list of available functions<br>");
       foreach ($this->email_types as $type) {
       print("<b>$type</b><br>");
       }
       exit();

     }
     }

  }


public function new_login_alert(){

$ip = $_SERVER['REMOTE_ADDR'];
$device = $_SERVER['HTTP_USER_AGENT'];

$layout = <<<HTML
           <html lang="en">
           <body style="background: #e4e9f0;">
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
  												New Login Alert
  											</div>
  										</td>
  									</tr>
  									<tr>
  										<td style="font-size:0;padding:0 30px 16px;">
  											<div style="cursor:auto;color:#000000;font-family:Proxima Nova, Arial, Arial, Helvetica, sans-serif;font-size:14px;line-height:22px;">
  												Dear <b>{$this->username}</b>,<br/>
  												Your account just logged in from this device below.
  											</div>
  										</td>
  									</tr>
  									<tr>
  										<td style="font-size:0;padding:0 30px 6px;">
  											<div style="cursor:auto;color:#000000;font-family:Proxima Nova, Arial, Arial, Helvetica, sans-serif;font-size:14px;line-height:22px;">
  												<b>Device</b>: {$device}

  												<p><b>IP ADDRESS</b>: {$ip}</p>

                          <p><b>Timne</b>: {$date}</p>
  											</div>
  										</td>
  									</tr>
  									<tr>
  										<td style="font-size:0;padding:8px 16px 10px;padding-bottom:16px;padding-right:30px;padding-left:30px;">
  											<table style="border:none;border-radius:25px;">
  												<tbody>
  													<tr>
  														<td>
  															<a href="{$this->link}" style="display:inline-block;text-decoration:none;background:#00a8ff;border:1px solid #00a8ff;border-radius:3px;color:white;font-family:Proxima Nova, Arial, Arial, Helvetica, sans-serif;font-size:14px;font-weight:400;padding:8px 12px 9px;" target="_blank">Not you?</a>
  														</td>
  													</tr>
  												</tbody>
  											</table>
  										</td>
  									</tr>
  									<tr>
  										<td style="font-size:0;padding:0 30px 30px 30px;">
  											<div style="cursor:auto;color:#000000;font-family:Proxima Nova, Arial, Arial, Helvetica, sans-serif;font-size:14px;line-height:22px;">
  												-----<br/>
  												Thank you<br/>
  												{$this->sitename}
  											</div>
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
  							© {$this->year} &nbsp;&nbsp;&nbsp;&bull;&nbsp;&nbsp;&nbsp; <a href="{$this->site_url}" target="_blank" style="border-bottom: dotted 1px #b3bac1;text-decoration: none; color: inherit;">$this->sitename</a>&nbsp;&nbsp;&nbsp;&bull;&nbsp;&nbsp;&nbsp;Version - 1.0.0
  						</div>
  					</td>
  				</tr>
  			</tbody>
  		</table>
  	</div>
  </body>
  </html>
HTML;
return $layout;
}


public function activate(){

if(strlen($this->message) < 5){
$this->message = "We may need to send you critical information about our service and it is important that we have an accurate email address.";
}

$layout = <<<HTML
    <html lang="en">
  <body style="background: #e4e9f0;">
  	<div style="margin:0 auto;max-width:700px;">
  		<table class=""  style="width:100%;font-size:0px;" >
  			<tbody>
  				<tr>
  					<td style="text-align:center;vertical-align:top;font-size:0;padding:20px 0;padding-top:0px;padding-bottom:24px;"></td>
  				</tr>
  			</tbody>
  		</table>
  	</div>
  	<div style="margin:0 auto;max-width:700px;">
  		<table class=""  style="width:100%;font-size:0px;background:#d8e2e7;" >
  			<tbody>
  				<tr>
  					<td style="text-align:center;vertical-align:top;font-size:0;padding:1px;">
  						<div style="vertical-align:top;display:inline-block;font-size:13px;text-align:left;width:100%;">
  							<table style="background:white;width:100%;">
  								<tbody>
  									<tr>
  										<td style="font-size:0;padding:30px 30px 18px;" >
  											<div style="cursor:auto;color:#000000;font-family:Proxima Nova, Arial, Arial, Helvetica, sans-serif;font-size:22px;line-height:22px;">
  												Confirm your email
  											</div>
  										</td>
  									</tr>
  									<tr>
  										<td style="font-size:0;padding:0 30px 16px;" >
  											<div style="cursor:auto;color:#000000;font-family:Proxima Nova, Arial, Arial, Helvetica, sans-serif;font-size:14px;line-height:22px;">
  											<p>Dear {$this->username},</p>
  											</div>
  										</td>
  									</tr>
  									<tr>
  										<td style="font-size:0;padding:0 30px 6px;" >
  											<div style="cursor:auto;color:#000000;font-family:Proxima Nova, Arial, Arial, Helvetica, sans-serif;font-size:14px;line-height:22px;">
  												{$this->message}
  											</div>
  										</td>
  									</tr>
  									<tr>
  										<td style="font-size:0;padding:8px 16px 10px;padding-bottom:16px;padding-right:30px;padding-left:30px;" >
  											<table  style="border:none;border-radius:25px;" >
  												<tbody>
  													<tr>
  														<td>
  															<a href="{$this->link}" style="display:inline-block;text-decoration:none;background:#00a8ff;border:1px solid #00a8ff;border-radius:3px;color:white;font-family:Proxima Nova, Arial, Arial, Helvetica, sans-serif;font-size:14px;font-weight:400;padding:8px 12px 9px;" target="_blank">Confirm email address</a>
  														</td>
  													</tr>
  												</tbody>
  											</table>
  										</td>
  									</tr>
  									<tr>
  										<td style="font-size:0;padding:0 30px 30px 30px;">
  											<div style="cursor:auto;color:#000000;font-family:Proxima Nova, Arial, Arial, Helvetica, sans-serif;font-size:14px;line-height:22px;">
  												-----<br/>
  												Thank you<br/>
  												{$this->sitename}
  											</div>
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
  							© {$this->year} &nbsp;&nbsp;&nbsp;&bull;&nbsp;&nbsp;&nbsp; <a href="{$this->site_url}" target="_blank" style="border-bottom: dotted 1px #b3bac1;text-decoration: none; color: inherit;">$this->sitename</a>&nbsp;&nbsp;&nbsp;&bull;&nbsp;&nbsp;&nbsp;Version - 1.0.0
  						</div>
  					</td>
  				</tr>
  			</tbody>
  		</table>
  	</div>
  </body>
  </html>
HTML;

return $layout;

}


public function change_password(){

if(strlen($this->message < 5)){
$this->message = "You've requested to change your Password.<p>You can now click the link(Change Password) below to change your Password.</p>";
}

$layout = <<<HTML
           <html lang="en">
           <body style="background: #e4e9f0;">
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
  												Create a new Password
  											</div>
  										</td>
  									</tr>
  									<tr>
  										<td style="font-size:0;padding:0 30px 16px;">
  											<div style="cursor:auto;color:#000000;font-family:Proxima Nova, Arial, Arial, Helvetica, sans-serif;font-size:14px;line-height:22px;">
  												Dear <b>{$this->username}</b>,<br/>
                          {$this->message}
  											</div>
  										</td>
  									</tr>
  									<tr>
  										<td style="font-size:0;padding:0 30px 6px;">
  											<div style="cursor:auto;color:#000000;font-family:Proxima Nova, Arial, Arial, Helvetica, sans-serif;font-size:14px;line-height:22px;">
  											</div>
  										</td>
  									</tr>
  									<tr>
  										<td style="font-size:0;padding:8px 16px 10px;padding-bottom:16px;padding-right:30px;padding-left:30px;">
  											<table style="border:none;border-radius:25px;">
  												<tbody>
  													<tr>
  														<td>
  															<a href="{$this->link}" style="display:inline-block;text-decoration:none;background:#00a8ff;border:1px solid #00a8ff;border-radius:3px;color:white;font-family:Proxima Nova, Arial, Arial, Helvetica, sans-serif;font-size:14px;font-weight:400;padding:8px 12px 9px;" target="_blank">Change Password</a>
  														</td>
                              <td>
                               <p><a href="#">Ignore this message if it wasn't you</a></p>
                              </td>
  													</tr>
  												</tbody>
  											</table>
  										</td>
  									</tr>
  									<tr>
  										<td style="font-size:0;padding:0 30px 30px 30px;">
  											<div style="cursor:auto;color:#000000;font-family:Proxima Nova, Arial, Arial, Helvetica, sans-serif;font-size:14px;line-height:22px;">
  												-----<br/>
  												Thank you<br/>
  												{$this->sitename}
  											</div>
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
  							© {$this->year} &nbsp;&nbsp;&nbsp;&bull;&nbsp;&nbsp;&nbsp; <a href="{$this->site_url}" target="_blank" style="border-bottom: dotted 1px #b3bac1;text-decoration: none; color: inherit;">$this->sitename</a>&nbsp;&nbsp;&nbsp;&bull;&nbsp;&nbsp;&nbsp;Version - 1.0.0
  						</div>
  					</td>
  				</tr>
  			</tbody>
  		</table>
  	</div>
  </body>
  </html>
HTML;
return $layout;
}

public function finish_registeration(){

  if(strlen($this->message < 5)){
  $this->message = "<p>To finish your registeration please click the link below</p>";
  }

  $layout = <<<HTML
             <html lang="en">
             <body style="background: #e4e9f0;">
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
    												Finish Registeration
    											</div>
    										</td>
    									</tr>
    									<tr>
    										<td style="font-size:0;padding:0 30px 16px;">
    											<div style="cursor:auto;color:#000000;font-family:Proxima Nova, Arial, Arial, Helvetica, sans-serif;font-size:14px;line-height:22px;">
    												Dear <b>{$this->username}</b>,<br/>
                            {$this->message}
    											</div>
    										</td>
    									</tr>
    									<tr>
    										<td style="font-size:0;padding:0 30px 6px;">
    											<div style="cursor:auto;color:#000000;font-family:Proxima Nova, Arial, Arial, Helvetica, sans-serif;font-size:14px;line-height:22px;">
    											</div>
    										</td>
    									</tr>
    									<tr>
    										<td style="font-size:0;padding:8px 16px 10px;padding-bottom:16px;padding-right:30px;padding-left:30px;">
    											<table style="border:none;border-radius:25px;">
    												<tbody>
    													<tr>
    														<td>
    															<a href="{$this->link}" style="display:inline-block;text-decoration:none;background:#00a8ff;border:1px solid #00a8ff;border-radius:3px;color:white;font-family:Proxima Nova, Arial, Arial, Helvetica, sans-serif;font-size:14px;font-weight:400;padding:8px 12px 9px;" target="_blank">Change Password</a>
    														</td>
                                <td>
                                  <p>Ignore this message if it's not yours</p>
                                </td>
    													</tr>
    												</tbody>
    											</table>
    										</td>
    									</tr>
    									<tr>
    										<td style="font-size:0;padding:0 30px 30px 30px;">
    											<div style="cursor:auto;color:#000000;font-family:Proxima Nova, Arial, Arial, Helvetica, sans-serif;font-size:14px;line-height:22px;">
    												-----<br/>
    												Thank you<br/>
    												{$this->sitename}
    											</div>
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
    							© {$this->year} &nbsp;&nbsp;&nbsp;&bull;&nbsp;&nbsp;&nbsp; <a href="{$this->site_url}" target="_blank" style="border-bottom: dotted 1px #b3bac1;text-decoration: none; color: inherit;">$this->sitename</a>&nbsp;&nbsp;&nbsp;&bull;&nbsp;&nbsp;&nbsp;Version - 1.0.0
    						</div>
    					</td>
    				</tr>
    			</tbody>
    		</table>
    	</div>
    </body>
    </html>
HTML;
return $layout;
}

public function thank_you(){
  if(strlen($this->message < 5)){
  $this->message = "<p>Thank you for joining us</p>";
  }

  $layout = <<<HTML
             <html lang="en">
             <body style="background: #e4e9f0;">
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
    												Thank you
    											</div>
    										</td>
    									</tr>
    									<tr>
    										<td style="font-size:0;padding:0 30px 16px;">
    											<div style="cursor:auto;color:#000000;font-family:Proxima Nova, Arial, Arial, Helvetica, sans-serif;font-size:14px;line-height:22px;">
    												Dear <b>{$this->username}</b>,<br/>
                            {$this->message}
    											</div>
    										</td>
    									</tr>
    									<tr>
    										<td style="font-size:0;padding:0 30px 6px;">
    											<div style="cursor:auto;color:#000000;font-family:Proxima Nova, Arial, Arial, Helvetica, sans-serif;font-size:14px;line-height:22px;">
    											</div>
    										</td>
    									</tr>
    									<tr>
    										<td style="font-size:0;padding:0 30px 30px 30px;">
    											<div style="cursor:auto;color:#000000;font-family:Proxima Nova, Arial, Arial, Helvetica, sans-serif;font-size:14px;line-height:22px;">
    												-----<br/>
    												Thank you<br/>
    												{$this->sitename}
    											</div>
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
    							© {$this->year} &nbsp;&nbsp;&nbsp;&bull;&nbsp;&nbsp;&nbsp; <a href="{$this->site_url}" target="_blank" style="border-bottom: dotted 1px #b3bac1;text-decoration: none; color: inherit;">$this->sitename</a>&nbsp;&nbsp;&nbsp;&bull;&nbsp;&nbsp;&nbsp;
    						</div>
    					</td>
    				</tr>
    			</tbody>
    		</table>
    	</div>
    </body>
    </html>
HTML;
return $layout;
}

}
