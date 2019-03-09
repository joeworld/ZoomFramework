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

/*
|--------------------------------------------------------------------------
| Base Site URL
|--------------------------------------------------------------------------
|
| URL to your Zoom root. Typically this will be your base URL,
| WITH a trailing slash:
|
| WARNING: You MUST set this value!
|
| If you need to allow multiple domains, remember that this file is still
| a PHP script and you can easily do that on your own.
|
*/

$config['base_url'] = 'http://localhost/stakesite/';


/*
|--------------------------------------------------------------------------
| Site Name
|--------------------------------------------------------------------------
|Ensure You fill in your site name to advoid using zoom as your site name
|
*/

$config['site_name'] = 'Staketime';

/*
|--------------------------------------------------------------------------
| Index File
|--------------------------------------------------------------------------
|
| Typically this will be your index.php file, unless you've renamed it to
| something else.
|
*/

$config['index_page'] = 'index.php';


/*
|--------------------------------------------------------------------------
| Default Controller
|--------------------------------------------------------------------------
|
| This will be the first controller to be loaded
|
|
*/

$config['Default_controller'] = 'home';


/*
|--------------------------------------------------------------------------
| Any Controller
|--------------------------------------------------------------------------
|
| Eg http://localhost/zoom/how-to-set-dynamic-clean-urls. -> The default controller for this slug (how-to-set-dynamic-clean-urls) can be set to any controller
|
|
*/

$config['any_controller'] = 'cms';

/*
|--------------------------------------------------------------------------
| SITE ADMIN EMAIL
|--------------------------------------------------------------------------
|
*/

$config['admin_email'] = 'iamjoestack@gmail.com';


/*
|--------------------------------------------------------------------------
| SITE JS FOLDER
|--------------------------------------------------------------------------
|
*/

$config['site_js'] = 'assets/js';

/*
|--------------------------------------------------------------------------
| SITE CSS FOLDER
|--------------------------------------------------------------------------
|
*/

$config['site_css'] = 'assets/css';


/*
|--------------------------------------------------------------------------
| IMAGE FOLDER
|--------------------------------------------------------------------------
|
*/

$config['site_img'] = 'assets/img';

/*
|--------------------------------------------------------------------------
| External Base Site URL like CDN where your files are located
|--------------------------------------------------------------------------
|
*/

$config['exbase_url'] = '';

/*
|--------------------------------------------------------------------------
| External SITE JS FOLDER
|--------------------------------------------------------------------------
|
*/

$config['exsite_js'] = 'assets/js';

/*
|--------------------------------------------------------------------------
| External SITE CSS FOLDER
|--------------------------------------------------------------------------
|
*/

$config['exsite_css'] = 'assets/css';


/*
|--------------------------------------------------------------------------
| External IMAGE FOLDER
|--------------------------------------------------------------------------
|
*/

$config['exsite_img'] = 'assets/images';

/*
|--------------------------------------------------------------------------
| SITE DESCRIPTION
|--------------------------------------------------------------------------
|
*/

$config['description'] = '';

/*
|--------------------------------------------------------------------------
| SITE KEYWORDS
|--------------------------------------------------------------------------
|
*/

$config['keywords'] = '';

/*
|--------------------------------------------------------------------------
| SITE COPYRIGHT TAG
|--------------------------------------------------------------------------
|
*/

$config['copyright'] = '© '. date('Y') .' '. $config['site_name'] . ' All rights reserved. Powered by <a target="_blank" href="http://iamjoestack.com">JoeStack</a>';

/*
|--------------------------------------------------------------------------
| SITE AUTHOR NAME
|--------------------------------------------------------------------------
|
*/

$config['author_name'] = 'Joseph';

/*
|--------------------------------------------------------------------------
| SITE AUTHOR TOKEN
|--------------------------------------------------------------------------
|
*/

$config['author_token'] = 'yue7yuew782hjg78897';

/*
|--------------------------------------------------------------------------
| SITE JS FOLDER
|--------------------------------------------------------------------------
|
*/
