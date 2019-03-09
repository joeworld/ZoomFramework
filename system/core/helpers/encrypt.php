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
* ENCRYPTER
*
**/

/**
 *
 */
class encrypt
{

  public $salt = null;

  public function __construct()
  {

  }


  public function _crypt($password, $rounds = 9){
    $this->salt = "";
    $salt_chars = array_merge(range('A', 'Z'), range('a', 'z'), range(0, 9));
    for ($i = 0; $i < 22; $i++){
        $this->salt .= $salt_chars[array_rand($salt_chars)];
    }
    return crypt($password, sprintf('$2y$%02d$', $rounds) . $this->salt);
  }



  public function encryptor($action = 'encrypt', $string) {

    $output = false;
    $encrypt_method = "AES-256-CBC";

    //please set your unique hashing key
    $secret_key = 'zoomhasher';
    $secret_iv = 'zoomhasherstoop123';

    // hash
    $key = hash('sha256', $secret_key);

    // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
    $iv = substr(hash('sha256', $secret_iv), 0, 16);

    //do the encyption given text/string/number
    if( $action == 'encrypt' ) {
        $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
        $output = base64_encode($output);
    }
    else if( $action == 'decrypt' ){
        //decrypt the given text/string/number
        $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
    }

    return $output;
    }


    //Function to encrypt a string
  public function encrypt($incoming, $cryptKey = 'qJB0rGtIn5UB1xG03efyCp') {
    $qEncoded      = base64_encode( mcrypt_encrypt( MCRYPT_RIJNDAEL_256, md5( $cryptKey ), $incoming, MCRYPT_MODE_CBC, md5( md5( $cryptKey ) ) ) );
    return( $qEncoded );
    }

   //Function to dycrypt a string
  public function decrypt($incoming, $cryptKey = 'qJB0rGtIn5UB1xG03efyCp') {
    $qDecoded      = rtrim( mcrypt_decrypt( MCRYPT_RIJNDAEL_256, md5( $cryptKey ), base64_decode( $incoming), MCRYPT_MODE_CBC, md5( md5( $cryptKey ) ) ), "\0");
    return( $qDecoded );
    }

}
