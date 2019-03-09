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
* MYSQLI DATABASE CONNECTION
*
**/

class Zm_mysqli_driver extends database
{

 private $user = null, $password = null, $hostname = null, $db = null, $charset = null, $dsn = null, $driver = null;

 public $errors;

 protected $select   = array();
 protected $where     = array();
 protected $from      = null;
 protected $groupBy   = null;
 protected $like      = null;

 /**
  * Database driver
  *
  * @var  string
  */

 public $dbdriver = 'mysqli';

   /**
  * Compression flag
  *
  * @var bool
  */
 public $compress = FALSE;

 /**
  * DELETE hack flag
  *
  * Whether to use the MySQL "delete hack" which allows the number
  * of affected rows to be shown. Uses a preg_replace when enabled,
  * adding a bit more processing to all queries.
  *
  * @var bool
  */
 public $delete_hack = TRUE;

 /**
  * Strict ON flag
  *
  * Whether we're running in strict SQL mode.
  *
  * @var bool
  */
 public $stricton;

 // --------------------------------------------------------------------

 /**
  * Identifier escape character
  *
  * @var string
  */
 protected $_escape_char = '`';

 // --------------------------------------------------------------------

 /**
  * MySQLi object
  *
  * Has to be preserved without being assigned to $conn_id.
  *
  * @var MySQLi
  */
 protected $_mysqli;

 // --------------------------------------------------------------------

 /**
  * Options
  *
  * @var  array
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
   $this->hostname = $thisparent['host'];
   $this->charset = $thisparent['charset'];
   $this->db = $thisparent['db'];
   $this->errors = $thisparent['errors'];
   $this->port = $thisparent['port'];
   //$this->dsn = self::Dsn($thisparent['dsn']);
   $this->persistent = db::PESISTENT;
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
   //Mysqli Driver connect Credit goes to Codeigniter

   // Do we have a socket path?
   if ($this->hostname[0] === '/')
   {
     $hostname = NULL;
     $port = NULL;
     $socket = $this->hostname;
   }
   else
   {
     $hostname = ($persistent === TRUE)
       ? 'p:'.$this->hostname : $this->hostname;
     $port = empty($this->port) ? NULL : $this->port;
     $socket = NULL;
   }

   $client_flags = ($this->compress === TRUE) ? MYSQLI_CLIENT_COMPRESS : 0;
   $this->_mysqli = mysqli_init();

   $this->_mysqli->options(MYSQLI_OPT_CONNECT_TIMEOUT, 10);

   if (isset($this->stricton))
   {
     if ($this->stricton)
     {
       $this->_mysqli->options(MYSQLI_INIT_COMMAND, 'SET SESSION sql_mode = CONCAT(@@sql_mode, ",", "STRICT_ALL_TABLES")');
     }
     else
     {
       $this->_mysqli->options(MYSQLI_INIT_COMMAND,
         'SET SESSION sql_mode =
         REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(
         @@sql_mode,
         "STRICT_ALL_TABLES,", ""),
         ",STRICT_ALL_TABLES", ""),
         "STRICT_ALL_TABLES", ""),
         "STRICT_TRANS_TABLES,", ""),
         ",STRICT_TRANS_TABLES", ""),
         "STRICT_TRANS_TABLES", "")'
       );
     }
   }

   if ($this->_mysqli->real_connect($hostname, $this->user, $this->password, $this->db, $port, $socket, $client_flags))
   {
     // Prior to version 5.7.3, MySQL silently downgrades to an unencrypted connection if SSL setup fails
     if (
       ($client_flags & MYSQLI_CLIENT_SSL)
       && version_compare($this->_mysqli->client_info, '5.7.3', '<=')
       && empty($this->_mysqli->query("SHOW STATUS LIKE 'ssl_cipher'")->fetch_object()->Value)
     )
     {
       $this->_mysqli->close();
       $message = 'MySQLi was configured for an SSL connection, but got an unencrypted connection instead!';
       return $newexceptions->showDbError($message);
     }

     return $this->_mysqli;
   }

   return FALSE;
 }

 /**
  * Reconnect
  * Keep / reestablish the db connection if no queries have been
  * sent for a length of time exceeding the server's idle timeout
  */
 public function reconnect()
 {
   if ($this->conn_id !== FALSE && $this->conn_id->ping() === FALSE)
   {
     $this->conn_id = FALSE;
   }
 }


 // --------------------------------------------------------------------

 /**
  * Platform-dependent string escape
  *
  * @param  string
  * @return string
  */
 protected function _escape_str($str)
 {
   return $this->conn_id->real_escape_string($str);
 }


 /**
  * Close DB Connection
  *
  * @return void
  */
 protected function _close()
 {
   $this->conn_id->close();
 }


 public function select(string $select = "*")
  {
    $query_part = "SELECT ".$select;
    $this->select = $query_part;
    return $this;
  }

  public function from(string $from){
    $query_part = "FROM ".$from;
    $this->from = $query_part;
    return $this;
  }

  public function where(string $where){
    $query_part = "WHERE ".$where;
    $this->where = $query_part;
    return $this;
  }

  public function groupBy(string $group){
    $query_part = "groupBy ".$group;
    $this->groupBy = $query_part;
    return $this;
  }

  public function get(){
    $array = (array)$this;
    $string = implode(" ", $array);
    return $string;
  }

  /**
   *$query = DB::sql()
   *->select()
   *->from("table")
   *->where("table > 300")
   *get();
   */


}
