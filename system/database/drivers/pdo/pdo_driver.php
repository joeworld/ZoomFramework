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
*
* PDO DATABASE CONNECTION
*
**/

class Zm_pdo_driver extends database
{

  private $user = null, $password = null, $host = null, $db = null, $charset = null, $dsn = null, $driver = null, $persistent = null;

  public $conn = 'null';

  public $errors;

  /**
   * Database driver
   *
   * @var string
   */

  public $dbdriver = 'pdo';

  /**
   * PDO Options
   *
   * @var array
   */

  public $options = array();

  /**
   * Error connecting to the database
   */

  public $dberror = 'An error occurred while connecting to the database';

  public function __construct()
  {

    $thisparent = parent::DbConsent();
    if($thisparent == false){
    return false;
    }else{
    $this->user = $thisparent['user'];
    $this->password = $thisparent['password'];
    $this->host = $thisparent['host'];
    $this->charset = $thisparent['charset'];
    $this->db = $thisparent['db'];
    $this->errors = $thisparent['errors'];
    $this->port = $thisparent['port'];
    $this->dsn = self::Dsn($thisparent['dsn']);
    $this->persistent = db::PESISTENT;
    //start connection
    $this->conn = $this->db_connect();

   }
  }

  // --------------------------------------------------------------------

  public function Dsn($dsn){
     if ($dsn != "") {
       if(strlen($dsn) < 6){
         die("Invalid Dns");
       }
      $return_dsn = $dsn;
    }else{
      $return_dsn = "mysql:host=".$this->host."; dbname=".$this->db."; charset=".$this->charset;
    }
    return $return_dsn;
  }

  // --------------------------------------------------------------------

  /**
   *
   * Database connection
   *
   */

   public function db_connect($persistent = FALSE)
   {
     $newexceptions = new Exceptions();
     if ($this->persistent === TRUE)
     {
       $this->options[PDO::ATTR_PERSISTENT] = TRUE;
     }
     $this->options[PDO::ATTR_ERRMODE] = TRUE;
     $this->options[PDO::ERRMODE_EXCEPTION] = TRUE;
     $this->options[PDO::ATTR_EMULATE_PREPARES] = FALSE;
      try
      {
        return new PDO($this->dsn, $this->user, $this->password, $this->options);
      }
      catch (PDOException $e)
      {
        return $newexceptions->showDbError($this->dberror);
      }

   }


   /**
   * Insert
   * @param string $table A name of table to insert into
   * @param string $data an associative array
  */
   public function insert($table, $data)
   {

    ksort($data);

    $fieldNames = implode('`,  `', array_keys($data));
    $fieldValues = ':' . implode(', :', array_keys($data));

    $sth = $this->conn->prepare("INSERT INTO $table (`$fieldNames`) VALUES ($fieldValues)");


    foreach($data as $key => $value){
      $sth->bindValue(":$key", $value);
    }

    return $sth->execute();


   }


   /**
    * Delete
    * @param string $table A name of table to insert into
    * @param string $data an associative array
    * @param string $where the WHERE query part
   */
   public function update($table, $data, $where)
   {

    ksort($data);

    $fieldDetails = NULL;

    foreach ($data as $key => $value) {
      $fieldDetails .= "`$key` = :$key,";
    }

    $fieldDetails = rtrim($fieldDetails, ',');

    $sth = $this->conn->prepare("UPDATE $table SET $fieldDetails WHERE $where");
    
    foreach($data as $key => $value){
      $sth->bindValue(":$key", $value);
    }

    return $sth->execute();

   }

  /**
    * Delete
    * @param string $table A name of table to insert into
    * @param string $data an associative array
    * @param string $where the WHERE query part
   */
   public function delete($table, $where)
   {
    $sth = $this->conn->prepare("DELETE FROM $table WHERE $where");
    return $sth->execute();
   }


  /**
    * Select All
    * @param string $table A name of table to insert into
    * @param string $data an associative array
    * @param string $where the WHERE query part
    * @param string $attr, other attr like order by, limit etc...
   */
   public function selectAll($table, $data, $where = null, $attr = null)
   {

    if($where != null){
    ksort($where);

    $fieldDetails = NULL;

    foreach ($where as $key => $value) {
      $fieldDetails .= "`$key` = :$key AND";
    }

    $fieldDetails = rtrim($fieldDetails, 'AND');

    if($attr == null){
    $sth = $this->conn->prepare("SELECT $data FROM $table WHERE $fieldDetails");
    }else{
    $sth = $this->conn->prepare("SELECT $data FROM $table WHERE $fieldDetails ".$attr);
    }

    foreach($where as $key => $value){
    $sth->bindValue(":$key", $value);
    }

    $sth->execute();
    return $sth->fetchAll(PDO::FETCH_ASSOC);

    }else{

    if($attr == null){
    $sth = $this->conn->prepare("SELECT $data FROM $table");
    }else{
    $sth = $this->conn->prepare("SELECT $data FROM $table ".$attr);
    }

    $sth->execute();
    return $sth->fetchAll(PDO::FETCH_ASSOC);

    }

   }


   /**
    * Select
    * @param string $table A name of table to insert into
    * @param string $data an associative array
    * @param string $where the WHERE query part
    * @param string $attr, other attr like order by, limit etc...
   */
   public function select($table, $data, $where = null, $attr = null)
   {

    if($where != null){
    ksort($where);

    $fieldDetails = NULL;

    foreach ($where as $key => $value) {
      $fieldDetails .= "`$key` = :$key AND";
    }

    $fieldDetails = rtrim($fieldDetails, 'AND');

    if($attr == null){
    $sth = $this->conn->prepare("SELECT $data FROM $table WHERE $fieldDetails");
    }else{
    $sth = $this->conn->prepare("SELECT $data FROM $table WHERE $fieldDetails ".$attr);
    }

    foreach($where as $key => $value){
    $sth->bindValue(":$key", $value);
    }

    $sth->execute();
    return $sth->fetch(PDO::FETCH_ASSOC);

    }else{

    if($attr == null){
    $sth = $this->conn->prepare("SELECT $data FROM $table");
    }else{
    $sth = $this->conn->prepare("SELECT $data FROM $table ".$attr);
    }

    $sth->execute();
    return $sth->fetch(PDO::FETCH_ASSOC);

    }

   }



   /**
    * SelectOr
    * @param string $table A name of table to insert into
    * @param string $data an associative array
    * @param string $where the WHERE query part
    * @param string $attr, other attr like order by, limit etc...
   */
   public function selectOr($table, $data, $where = null, $attr = null)
   {

    if($where != null){
    ksort($where);

    $fieldDetails = NULL;

    foreach ($where as $key => $value) {
      $fieldDetails .= "`$key` = :$key OR";
    }

    $fieldDetails = rtrim($fieldDetails, 'OR');

    if($attr == null){
    $sth = $this->conn->prepare("SELECT $data FROM $table WHERE $fieldDetails");
    }else{
    $sth = $this->conn->prepare("SELECT $data FROM $table WHERE $fieldDetails ".$attr);
    }

    foreach($where as $key => $value){
    $sth->bindValue(":$key", $value);
    }

    $sth->execute();
    return $sth->fetch(PDO::FETCH_ASSOC);

    }else{

    if($attr == null){
    $sth = $this->conn->prepare("SELECT $data FROM $table");
    }else{
    $sth = $this->conn->prepare("SELECT $data FROM $table ".$attr);
    }

    $sth->execute();
    return $sth->fetch(PDO::FETCH_ASSOC);

    }

   }


  /**
    * SelectAllOr
    * @param string $table A name of table to insert into
    * @param string $data an associative array
    * @param string $where the WHERE query part
    * @param string $attr, other attr like order by, limit etc...
   */
   public function selectAllOr($table, $data, $where = null, $attr = null)
   {

    if($where != null){
    ksort($where);

    $fieldDetails = NULL;

    foreach ($where as $key => $value) {
      $fieldDetails .= "`$key` = :$key AND";
    }

    $fieldDetails = rtrim($fieldDetails, 'AND');

    if($attr == null){
    $sth = $this->conn->prepare("SELECT $data FROM $table WHERE $fieldDetails");
    }else{
    $sth = $this->conn->prepare("SELECT $data FROM $table WHERE $fieldDetails ".$attr);
    }

    foreach($where as $key => $value){
    $sth->bindValue(":$key", $value);
    }

    $sth->execute();
    return $sth->fetchAll(PDO::FETCH_ASSOC);

    }else{

    if($attr == null){
    $sth = $this->conn->prepare("SELECT $data FROM $table");
    }else{
    $sth = $this->conn->prepare("SELECT $data FROM $table ".$attr);
    }

    $sth->execute();
    return $sth->fetchAll(PDO::FETCH_ASSOC);

    }

   }


   /**
    * SelectLike
    * @param string $table A name of table to insert into
    * @param string $data an associative array
    * @param string $where the LIKE query part
    * @param string $attr, other attr like order by, limit etc...
   */
   public function selectLike($table, $data, $where = null, $attr = null)
   {
    
    if($where != null){
    ksort($where);

    $fieldDetails = NULL;

    foreach ($where as $key => $value) {
      $fieldDetails .= "`$key` LIKE :$key OR";
    }

    $fieldDetails = rtrim($fieldDetails, 'OR');

    if($attr == null){
    $sth = $this->conn->prepare("SELECT $data FROM $table WHERE $fieldDetails");
    }else{
    $sth = $this->conn->prepare("SELECT $data FROM $table WHERE $fieldDetails ".$attr);
    }

    foreach($where as $key => $value){
    $sth->bindValue(":$key", "%".$value."%");
    }

    $sth->execute();
    return $sth->fetchAll(PDO::FETCH_ASSOC);

    }else{

    if($attr == null){
    $sth = $this->conn->prepare("SELECT $data FROM $table");
    }else{
    $sth = $this->conn->prepare("SELECT $data FROM $table ".$attr);
    }

    $sth->execute();
    return $sth->fetchAll(PDO::FETCH_ASSOC);

    }

   }


}
