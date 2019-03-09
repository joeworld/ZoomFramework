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
* MYSQL DATABASE CONNECTION
*
**/
class Zm_mysql_driver extends database
{

  private $username = null, $password = null, $hostname = null, $charset = null, $dsn = null, $driver = null;
  public $database = null;
  public $errors;

  protected $select   = array();
  protected $where     = array();
  protected $from      = null;
  protected $groupBy   = null;
  protected $like      = null;

  /**
	 * Database driver
	 *
	 * @var	string
	 */
	public $dbdriver = 'mysql';

	/**
	 * Compression flag
	 *
	 * @var	bool
	 */
	public $compress = FALSE;

	/**
	 * DELETE hack flag
	 *
	 * Whether to use the MySQL "delete hack" which allows the number
	 * of affected rows to be shown. Uses a preg_replace when enabled,
	 * adding a bit more processing to all queries.
	 *
	 * @var	bool
	 */
	public $delete_hack = TRUE;

	/**
	 * Strict ON flag
	 *
	 * Whether we're running in strict SQL mode.
	 *
	 * @var	bool
	 */
	public $stricton;

	// --------------------------------------------------------------------

	/**
	 * Identifier escape character
	 *
	 * @var	string
	 */
	protected $_escape_char = '`';

	// --------------------------------------------------------------------



  public function __construct()
  {
    $thisparent = parent::DbConsent();
    if($thisparent == false){
    return false;
    }else{
    $this->username = $thisparent['user'];
    $this->password = $thisparent['password'];
    $this->hostname = $thisparent['host'];
    $this->charset = $thisparent['charset'];
    $this->database = $thisparent['db'];
    $this->errors = $thisparent['errors'];
    $this->port = $thisparent['port'];
    $this->encrypt = $thisparent['encrypt'];
    $this->persistent = db::PESISTENT;
   }
  }

  // --------------------------------------------------------------------


    /**
    * Non-persistent database connection
    *
    * @param	bool	$persistent
    * @return	resource
    */
    public function db_connect($persistent = FALSE)
    {
      $client_flags = ($this->compress === FALSE) ? 0 : MYSQL_CLIENT_COMPRESS;

      if ($this->encrypt === TRUE)
      {
    $client_flags = $client_flags | MYSQL_CLIENT_SSL;
      }

      // Error suppression is necessary mostly due to PHP 5.5+ issuing E_DEPRECATED messages
      $this->conn_id = ($persistent === TRUE)
     ? mysql_pconnect($this->hostname, $this->username, $this->password, $client_flags)
     : mysql_connect($this->hostname, $this->username, $this->password, TRUE, $client_flags);

     // ----------------------------------------------------------------


     if (isset($this->stricton) && is_resource($this->conn_id))
    {
     if ($this->stricton)
    {
       $this->simple_query('SET SESSION sql_mode = CONCAT(@@sql_mode, ",", "STRICT_ALL_TABLES")');
     }
      else
     {
      $this->simple_query(
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

  return $this->conn_id;
}

// --------------------------------------------------------------------

/**
 * Reconnect
 *
 * Keep / reestablish the db connection if no queries have been
 * sent for a length of time exceeding the server's idle timeout
 *
 * @return	void
 */
public function reconnect()
{
  if (mysql_ping($this->conn_id) === FALSE)
  {
    $this->conn_id = FALSE;
  }
}

// --------------------------------------------------------------------

/**
 * Select the database
 *
 * @param	string	$database
 * @return	bool
 */
public function db_select($database = '')
{
  if ($database === '')
  {
    $database = $this->database;
  }

  if (mysql_select_db($database, $this->conn_id))
  {
    $this->database = $database;
    $this->data_cache = array();
    return TRUE;
  }

  return FALSE;
}

// --------------------------------------------------------------------

/**
 * Set client character set
 *
 * @param	string	$charset
 * @return	bool
 */
protected function _db_set_charset($charset)
{
  return mysql_set_charset($charset, $this->conn_id);
}

// --------------------------------------------------------------------


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
