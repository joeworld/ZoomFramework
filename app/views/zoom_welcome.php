<?php

/**
* PAGE CREDIT -> OJO OLUWASEUN JOSEPH, joe.joesst.com
**/

//Welcome page using zoom html helpers

$this->html->otag('html');
$this->html->otag('head');
$this->html->otag('title');
print($this->title);
$this->html->ctag('title');
$this->html->ctag('head');
$this->html->ctag('head');
$this->html->otag('body');
$this->html->hr();
$this->html->otag('center'); //Open center tag
$this->html->h1('Welcome To Zoom', array('style' => 'color: red')); //H1
$this->html->p('Zoom has been successfully Installed'); //P tag
$this->html->p('The view of this page can be found in the application/view folder'); //P tag
$this->html->ctag('center'); //Close center tag
$this->html->hr();
$this->html->otag('footer');
$this->html->otag('center');
$this->html->p('Zoom version is '.zoom_config::ZOOM_VERSION); //Zoom Version
$this->html->p('Your current Environment is '.ENVIRONMENT); //Environment
// Check if its an https connection
$checkHttps = is_https();
if($checkHttps == false){
$con_msg = "Your connection is not secure";
}else{
$con_msg = "Your connection is secure";
}
$this->html->txt('Your current PHP version is '.PHP_VERSION);
$this->html->p($con_msg);
// Check if its loaded through command prompt
if(is_cli() == true){
$_msg = "The page was loaded using command prompt";	
}else{
$_msg = "This page was loaded using a browser";	
}
$this->html->p($_msg);
$this->html->p("Last refreshed ".tt()." on ".dateName(dt()));
$this->html->ctag('center');
$this->html->ctag('footer');
$this->html->ctag('html');

/**
 *
 * YOU KNOW MVC, YOU KNOW ZOOM
 *
**/