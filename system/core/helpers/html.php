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
* HTML FUNCTIONS
*
**/

class html
{

  /**
    * Base Url
  **/

  private $baseurl;

  /**
    * CSS Folder
  **/

  private $basecss;

  /**
    * JS Folder
  **/

  private $basejs;

  /**
    * IMAGE Folder
  **/

  private $baseimg;

  /**
   * Site Name
  **/

  private $sitename = SITENAME;

  /**
    * External Base Url
  **/

  private $exbaseurl;

  /**
    * External CSS Folder
  **/

  private $exbasecss;

  /**
    * External JS Folder
  **/

  private $exbasejs;

  /**
    * External IMAGE Folder
  **/

  private $exbaseimg;

  /**
  * Constructor
  **/

    public function __construct(){

    $this->baseurl = BASEURL;

    $this->basecss = CSS;

    $this->basejs  = JS;

    $this->baseimg  = IMAGE;

    $this->exbaseurl = EXBASEURL;

    $this->exbasecss = EXCSS;

    $this->exbasejs  = EXJS;

    $this->exbaseimg  = EXIMAGE;

    }

    ////////////////////Include Css Scripts could be array or string/////////////////////

  public function css($file, $dir = null)
  {
   if(!is_array($file)){

   if($dir != null){

     $cssfile = $this->baseurl.$dir.'/'.$file;

     print "<link rel='stylesheet' type='text/css' href='".$cssfile.".css'>";

   }else{

     $cssfile = $this->baseurl.$this->basecss.'/'.$file;

     print "<link rel='stylesheet' type='text/css' href='".$cssfile.".css'>";

     }

     }
     else{

     foreach ($file as $mainfile) {
     if($dir !== null){

     $cssfile = $this->baseurl.$dir.'/'.$mainfile;

     print "<link rel='stylesheet' type='text/css' href='".$cssfile.".css'>";

   }else{

     $cssfile = $this->baseurl.$this->basecss.'/'.$mainfile;

     print "<link rel='stylesheet' type='text/css' href='".$cssfile.".css'>";

     }
     }
     }
    return true;
  }

     ////////////////////Include Js Scripts could be array or string/////////////////////

     public function js($file, $dir = null)
   {
   if(!is_array($file)){

   if($dir != null){

    $jsfile = $this->baseurl.$dir.'/'.$file;

     print "<script type='text/javascript' src='".$jsfile.".js'></script>";

   }else{

     $jsfile = $this->baseurl.$this->basejs.'/'.$file;

     print "<script type='text/javascript' src='".$jsfile.".js'></script>";

     }

     }
     else{

     foreach ($file as $mainfile) {
     if($dir != null){

     $jsfile = $this->baseurl.$dir.'/'.$mainfile;

     print "<script type='text/javascript' src='".$jsfile.".js'></script>";

    }else{

   $jsfile = $this->baseurl.$this->basejs.'/'.$mainfile;

     print "<script type='text/javascript' src='".$jsfile.".js'></script>";

     }
     }
     }

     return true;
     }


    ////////////////////Start Header Tags/////////////////////

  public function h1($text, $attr=array())
    {
      if($attr == null || $attr == '' || !is_array($attr)){
      print("<h1>".$text."</h1>");
      return true;
      }else{
        $em = '<h1';
        foreach ($attr as $k => $v) {
          $em .= ' '.$k.'="'.$v.'"';
        }
        print($em.' >'.$text.'</h1>');
        return true;
      }
  }

    public function h2($text, $attr=array())
    {
      if($attr == null || $attr == '' || !is_array($attr)){
      print("<h2>".$text."</h2>");
      return true;
      }else{
        $em = '<h2';
        foreach ($attr as $k => $v) {
          $em .= ' '.$k.'="'.$v.'"';
        }
        print($em.' >'.$text.'</h2>');
        return true;
      } }


      public function h3($text, $attr=array())
    {
      if($attr == null || $attr == '' || !is_array($attr)){
      print("<h3>".$text."</h3>");
      return true;
      }else{
        $em = '<h3';
        foreach ($attr as $k => $v) {
          $em .= ' '.$k.'="'.$v.'"';
        }
        print($em.' >'.$text.'</h3>');
        return true;
      }
  }


    public function h4($text, $attr=array())
    {
      if($attr == null || $attr == '' || !is_array($attr)){
      print("<h4>".$text."</h4>");
      return true;
      }else{
        $em = '<h4';
        foreach ($attr as $k => $v) {
          $em .= ' '.$k.'="'.$v.'"';
        }
        print($em.' >'.$text.'</h4>');
        return true;
      }
  }

    public function h5($text, $attr=array())
    {
      if($attr == null || $attr == '' || !is_array($attr)){
      print("<h5>".$text."</h5>");
      return true;
      }else{
        $em = '<h5';
        foreach ($attr as $k => $v) {
          $em .= ' '.$k.'="'.$v.'"';
        }
        print($em.' >'.$text.'</h5>');
        return true;
      }
  }

    public function h6($text, $attr=array())
      {
      if($attr == null || $attr == '' || !is_array($attr)){
      print("<h6>".$text."</h6>");
      return true;
      }else{
        $em = '<h6';
        foreach ($attr as $k => $v) {
          $em .= ' '.$k.'="'.$v.'"';
        }
        print($em.' >'.$text.'</h6>');
        return true;
      }
      }

      ////////////////////End Header Tags/////////////////////

      public function b($text, $attr=array())
      {
      //B tag
      if($attr == null || $attr == '' || !is_array($attr)){
      print("<b>".$text."</b>");
      return true;
      }else{
        $em = '<b';
        foreach ($attr as $k => $v) {
          $em .= ' '.$k.'="'.$v.'"';
        }
        print($em.' >'.$text.'</b>');
        return true;
      }
      }


      public function p($text = '', $attr=array())
      {
      //P tag
      if($attr == null || $attr == '' || !is_array($attr)){
      print("<p>".$text."</p>");
      return true;
      }else{
        $em = '<p';
        foreach ($attr as $k => $v) {
          $em .= ' '.$k.'="'.$v.'"';
        }
        print($em.' >'.$text.'</p>');
        return true;
      }
      }


      public function em($text, $attr=array())
      {
      //Em tag
      if($attr == null || $attr == '' || !is_array($attr)){
      print("<em>".$text."</em>");
      return true;
      }else{
        $em = '<em';
        foreach ($attr as $k => $v) {
          $em .= ' '.$k.'="'.$v.'"';
        }
        print($em.' >'.$text.'</em>');
        return true;
      }
      }

      public function center($text){

      /**
      * Old way of html center
      **/

      print "<center>".$text."</center>";
      return true;

      }

      public function txt($text){
      print($text);
      return true;
      }

      public function img($src){
      //Image tag
      if($src == null || $src == '' || !is_array($src)){
      print("<img src='".$src."' />");
      return true;
      }else{
        $img = '<img';
        foreach ($src as $k => $v) {
          $img .= ' '.$k.'="'.$v.'"';
        }
        print($img.' />');
        return true;
      }
      }


      ////////////////////Include a specified image from the image and attribute part could be array or string/////////////////////

      public function incImg($imagename, $attr = null, $dir = null)
     {

       if($dir !== "null"){
       $imagesource = $this->baseurl.$this->baseimg.'/'.$imagename;
       }else{
       $imagesource = $this->baseurl.$dir.'/'.$imagename;
       }

       $src = "src='".$imagesource."'";

       $img = '<img';

       if($attr != "null" && is_array($attr)){

       foreach ($attr as $k => $v) {
       $img .= ' '.$src.' '.$k.'="'.$v.'"';
       }
       print($img.' />');
       return true;
       }else{

       print($img.' '.$src.' />');

       return true;

      }

       return false;
     }


      public function a($text, $attr=array())
      {
      //A tag
      if($attr == null || $attr == '' || !is_array($attr)){
      print("<a href='".$text."'>".$text."</a>");
      return true;
      }else{
        $em = '<a';
        foreach ($attr as $k => $v) {
          $em .= ' '.$k.'="'.$v.'"';
        }
        print($em.' >'.$text.'</a>');
        return true;
      }
      }


      public function br($count = 1){
        $return = str_repeat('<br />', $count);
        print($return);
        return true;
      }


      public function hr($count = 1){
        $return = str_repeat('<hr>', $count);
        print($return);
        return true;
      }

      public function nb($count = 1){
        $return = str_repeat('&nbsp;', $count);
        print($return);
        return true;
      }


      public function opendiv($attr=''){
      //Open new div
      if($attr == null || $attr == '' || !is_array($attr)){
      print("<div class='".$attr."' >");
      return true;
      }else{
        $div = '<div';
        foreach ($attr as $k => $v) {
          $div .= ' '.$k.'="'.$v.'"';
        }
        print($div.' >');
        return true;
      }
      }

      public function closediv(){
      //Close a div
      print("</div>");
      return true;
      }


      public function tag($tag, $text = '', $attr = array()){
      //Open & Close a tag
      if($attr == null || $attr == '' || !is_array($attr)){
        print("<".$tag.">".$text."</".$tag.">");
        return true;
      }

      else{
      $returntag = '<'.$tag;
        foreach ($attr as $k => $v) {
          $returntag .= ' '.$k.'="'.$v.'"';
        }

        print($returntag.' >'.$text.'</'.$tag.'>');
        return true;
      }

      }

       public function u($text, $attr=array())
      {
      //U tag
      if($attr == null || $attr == '' || !is_array($attr)){
      print("<u>".$text."</u>");
      return true;
      }else{
        $em = '<u';
        foreach ($attr as $k => $v) {
          $em .= ' '.$k.'="'.$v.'"';
        }
        print($em.' >'.$text.'</u>');
        return true;
      }
      }

      public function otag($tag, $text = '', $attr = array()){

      //Open a new tag

      if($attr == null || $attr == '' || !is_array($attr)){
        print("<".$tag.">".$text);
        return true;
      }
      else{
      $returntag = '<'.$tag;
        foreach ($attr as $k => $v) {
          $returntag .= ' '.$k.'="'.$v.'"';
        }

        print($returntag.' >'.$text);
        return true;
      }
      }

      public function ctag($tag){
      //Close given tag
      print("</".$tag.">");
      }


  public function doctype($type = 'xhtml1-strict')
  {

    static $doctypes;

    if ( ! is_array($doctypes))
    {
      if (file_exists(APPATH.'config/docs.php'))
      {
        include(APPATH.'config/docs.php');
      }

      if (empty($_doctypes) OR ! is_array($_doctypes))
      {
        $doctypes = array();
        return FALSE;
      }

      $doctypes = $_doctypes;
    }

    return isset($doctypes[$type]) ? $doctypes[$type] : FALSE;
  }


 public function meta($name = '', $content = '', $type = 'name', $newline = "\n")
  {
    // Since we allow the data to be passes as a string, a simple array
    // or a multidimensional one, we need to do a little prepping.
    if ( ! is_array($name))
    {
      $name = array(array('name' => $name, 'content' => $content, 'type' => $type, 'newline' => $newline));
    }
    elseif (isset($name['name']))
    {
      // Turn single array into multidimensional
      $name = array($name);
    }

    $str = '';
    foreach ($name as $meta)
    {
      $type   = (isset($meta['type']) && $meta['type'] !== 'name')  ? 'http-equiv' : 'name';
      $name   = isset($meta['name'])          ? $meta['name'] : '';
      $content  = isset($meta['content'])       ? $meta['content'] : '';
      $newline  = isset($meta['newline'])       ? $meta['newline'] : "\n";

      $str .= '<meta '.$type.'="'.$name.'" content="'.$content.'" />'.$newline;
    }

    print($str);
    return;
  }

 public function site(){
  print($this->sitename);
  return;
 }

    ////////////////////Include Css Scripts could be array or string/////////////////////

  public function excss($file, $dir = null)
  {
   if(!is_array($file)){

   if($dir != null){

     $cssfile = $this->exbaseurl.$dir.'/'.$file;

     print "<link rel='stylesheet' type='text/css' href='".$cssfile.".css'>";

   }else{

     $cssfile = $this->exbaseurl.$this->exbasecss.'/'.$file;

     print "<link rel='stylesheet' type='text/css' href='".$cssfile.".css'>";

     }

     }
     else{

     foreach ($file as $mainfile) {
     if($dir !== null){

     $cssfile = $this->exbaseurl.$dir.'/'.$mainfile;

     print "<link rel='stylesheet' type='text/css' href='".$cssfile.".css'>";

   }else{

     $cssfile = $this->exbaseurl.$this->exbasecss.'/'.$mainfile;

     print "<link rel='stylesheet' type='text/css' href='".$cssfile.".css'>";

     }
     }
     }
    return true;
  }

     ////////////////////Include Js Scripts could be array or string/////////////////////

     public function exjs($file, $dir = null)
   {
   if(!is_array($file)){

   if($dir != null){

    $jsfile = $this->exbaseurl.$dir.'/'.$file;

     print "<script type='text/javascript' src='".$jsfile.".js'></script>";

   }else{

     $jsfile = $this->exbaseurl.$this->exbasejs.'/'.$file;

     print "<script type='text/javascript' src='".$jsfile.".js'></script>";

     }

     }
     else{

     foreach ($file as $mainfile) {
     if($dir != null){

     $jsfile = $this->exbaseurl.$dir.'/'.$mainfile;

     print "<script type='text/javascript' src='".$jsfile.".js'></script>";

    }else{

   $jsfile = $this->exbaseurl.$this->exbasejs.'/'.$mainfile;

     print "<script type='text/javascript' src='".$jsfile.".js'></script>";

     }
     }
     }

     return true;
     }


     public function exImg($imagename, $attr = null, $dir = null)
     {

       if($dir !== "null"){
       $imagesource = $this->exbaseurl.$this->exbaseimg.'/'.$imagename;
       }else{
       $imagesource = $this->exbaseurl.$dir.'/'.$imagename;
       }

       $src = "src='".$imagesource."'";

       $img = '<img';

       if($attr != "null" && is_array($attr)){

       foreach ($attr as $k => $v) {
       $img .= ' '.$src.' '.$k.'="'.$v.'"';
       }
       print($img.' />');
       return true;
       }else{

       print($img.' '.$src.' />');

       return true;

      }

       return false;
     }

}

//BASIC USAGE BELOW

/**if(class_exists('html')){
$html = new html();
$html->css("style.css");
$html->css('style.css');
$html->h1('Hey', array('class' => 'h1', 'id' => 'h1'));
$html->h2('Hey', array('class' => 'h1', 'id' => 'h1'));
$html->h3('Hey', array('class' => 'h1', 'id' => 'h1'));
$html->h4('Hey', array('class' => 'h1', 'id' => 'h1'));
$html->h5('Hey', array('class' => 'h1', 'id' => 'h1'));
$html->h6('Hey', array('class' => 'h1', 'id' => 'h1'));
$html->b('Hey',  array('class' => 'h1', 'id' => 'h1'));
$html->em('Hey');
$html->center('Hey');
$html->img(array('src' => 'img', 'alt' => 'name', 'title' => 'Hey', 'class' => 'img-responsive', 'style' => 'width: 500px' ));
$html->a('Hey', array('style' => 'color: black', 'href' => 'nextpage.php', 'target' => '_blank'));
$html->opendiv('div1');
print("Hey");
$html->closediv();
$html->br(7);
$html->p('hey', array('class' => 'h1', 'id' => 'h1'));
$html->tag('i','hey',array('style' => 'font-size: 30px'));
$html->otag('u','hey',array('style' => 'font-size: 30px'));
$html->ctag('u');
}**/
