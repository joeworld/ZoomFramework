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
* DATE FUNCTIONS
*
**/


// ------------------------------------------------------------------------

if ( ! function_exists('now'))
{
	/**
	 * Get "now" time
	 *
	 * Returns time() based on the timezone parameter or on the
	 * "time_reference" setting
	 *
	 * @param	string
	 * @return	int
	 */
	function now($timezone = NULL)
	{

		if ($timezone === 'local' OR $timezone === date_default_timezone_get())
		{
			return time();
		}

		$datetime = new DateTime('now', new DateTimeZone($timezone));
		sscanf($datetime->format('j-n-Y G:i:s'), '%d-%d-%d %d:%d:%d', $day, $month, $year, $hour, $minute, $second);

		return mktime($hour, $minute, $second, $month, $day, $year);
	}
}

// ------------------------------------------------------------------------

if ( ! function_exists('mdate'))
{
	/**
	 * Convert MySQL Style Datecodes
	 *
	 * This function is identical to PHPs date() function,
	 * except that it allows date codes to be formatted using
	 * the MySQL style, where each code letter is preceded
	 * with a percent sign:  %Y %m %d etc...
	 *
	 * The benefit of doing dates this way is that you don't
	 * have to worry about escaping your text letters that
	 * match the date codes.
	 *
	 * @param	string
	 * @param	int
	 * @return	int
	 */
	function mdate($datestr = '', $time = '')
	{
		if ($datestr === '')
		{
			return '';
		}
		elseif (empty($time))
		{
			$time = now();
		}

		$datestr = str_replace(
			'%\\',
			'',
			preg_replace('/([a-z]+?){1}/i', '\\\\\\1', $datestr)
		);

		return date($datestr, $time);
	}
}

// ------------------------------------------------------------------------

if ( ! function_exists('standard_date'))
{
	/**
	 * Standard Date
	 *
	 * Returns a date formatted according to the submitted standard.
	 *
	 * As of PHP 5.2, the DateTime extension provides constants that
	 * serve for the exact same purpose and are used with date().
	 *
	 * @todo	Remove in version 3.1+.
	 * @deprecated	3.0.0	Use PHP's native date() instead.
	 * @link	http://www.php.net/manual/en/class.datetime.php#datetime.constants.types
	 *
	 * @example	date(DATE_RFC822, now()); // default
	 * @example	date(DATE_W3C, $time); // a different format and time
	 *
	 * @param	string	$fmt = 'DATE_RFC822'	the chosen format
	 * @param	int	$time = NULL		Unix timestamp
	 * @return	string
	 */
	function standard_date($fmt = 'DATE_RFC822', $time = NULL)
	{
		if (empty($time))
		{
			$time = now();
		}

		// Procedural style pre-defined constants from the DateTime extension
		if (strpos($fmt, 'DATE_') !== 0 OR defined($fmt) === FALSE)
		{
			return FALSE;
		}

		return date(constant($fmt), $time);
	}
}

// ------------------------------------------------------------------------

if ( ! function_exists('timeago'))
{
	/**
	 * Time Ago
   * Return values of times ago eg, 4 months ago, 1 minutes ago based on passed date
	 * @return	string
	 */

   function timeago($date)
   {
    if(empty($date))
    {
        return "No date provided";
    }

    $periods = array("second", "minute", "hour", "day", "week", "month", "year", "decade");

    $lengths = array("60","60","24","7","4.35","12","10");

    $now = time();

    $unix_date = strtotime( $date );

    // check validity of date

    if( empty( $unix_date ) )
    {
        return "Bad date";
    }

    // is it future date or past date

    if( $now > $unix_date )
    {
        $difference = $now - $unix_date;
        $tense = "ago";
    }
    else
    {
        $difference = $unix_date - $now;
        $tense = "from now";
    }

    for( $j = 0; $difference >= $lengths[$j] && $j < count($lengths)-1; $j++ )
    {
        $difference /= $lengths[$j];
    }

    $difference = round( $difference );

    if( $difference != 1 )
    {
        $periods[$j].= "s";
    }

    return "$difference $periods[$j] {$tense}";

}

}

if(! function_exists('dateName')){

/**
 * Returns the month in word, day, and year
 */

function dateName($date) {

        $result = "";

        $convert_date = strtotime($date);
        $month = date('F',$convert_date);
        $year = date('Y',$convert_date);
        $name_day = date('l',$convert_date);
        $day = date('j',$convert_date);


        $result = $month . " " . $day . ", " . $year . " - " . $name_day;

        return $result;
    }
}


// ------------------------------------------------------------------------

if ( ! function_exists('days_in_month'))
{
	/**
	 * Number of days in a month
	 *
	 * Takes a month/year as input and returns the number of days
	 * for the given month/year. Takes leap years into consideration.
	 *
	 * @param	int	a numeric month
	 * @param	int	a numeric year
	 * @return	int
	 */
	function days_in_month($month = 0, $year = '')
	{
		if ($month < 1 OR $month > 12)
		{
			return 0;
		}
		elseif ( ! is_numeric($year) OR strlen($year) !== 4)
		{
			$year = date('Y');
		}

		if (defined('CAL_GREGORIAN'))
		{
			return cal_days_in_month(CAL_GREGORIAN, $month, $year);
		}

		if ($year >= 1970)
		{
			return (int) date('t', mktime(12, 0, 0, $month, 1, $year));
		}

		if ($month == 2)
		{
			if ($year % 400 === 0 OR ($year % 4 === 0 && $year % 100 !== 0))
			{
				return 29;
			}
		}

		$days_in_month	= array(31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31);
		return $days_in_month[$month - 1];
	}
}

// ------------------------------------------------------------------------

if ( ! function_exists('mysql_to_unix'))
{
	/**
	 * Converts a MySQL Timestamp to Unix
	 *
	 * @param	int	MySQL timestamp YYYY-MM-DD HH:MM:SS
	 * @return	int	Unix timstamp
	 */
	function mysql_to_unix($time = '')
	{
		// We'll remove certain characters for backward compatibility
		// since the formatting changed with MySQL 4.1
		// YYYY-MM-DD HH:MM:SS

		$time = str_replace(array('-', ':', ' '), '', $time);

		// YYYYMMDDHHMMSS
		return mktime(
			substr($time, 8, 2),
			substr($time, 10, 2),
			substr($time, 12, 2),
			substr($time, 4, 2),
			substr($time, 6, 2),
			substr($time, 0, 4)
		);
	}
}

// --------------------------------------------------------------------------

if ( ! function_exists('unix_to_human'))
{
	/**
	 * Unix to "Human"
	 *
	 * Formats Unix timestamp to the following prototype: 2006-08-21 11:35 PM
	 *
	 * @param	int	Unix timestamp
	 * @param	bool	whether to show seconds
	 * @param	string	format: us or euro
	 * @return	string
	 */
	function unix_to_human($time = '', $seconds = FALSE, $fmt = 'us')
	{
		$r = date('Y', $time).'-'.date('m', $time).'-'.date('d', $time).' ';

		if ($fmt === 'us')
		{
			$r .= date('h', $time).':'.date('i', $time);
		}
		else
		{
			$r .= date('H', $time).':'.date('i', $time);
		}

		if ($seconds)
		{
			$r .= ':'.date('s', $time);
		}

		if ($fmt === 'us')
		{
			return $r.' '.date('A', $time);
		}

		return $r;
	}
}

// ------------------------------------------------------------------------

// ------------------------------------------------------------------------

if ( ! function_exists('human_to_unix'))
{
	/**
	 * Convert "human" date to GMT
	 *
	 * Reverses the above process
	 *
	 * @param	string	format: us or euro
	 * @return	int
	 */
	function human_to_unix($datestr = '')
	{
		if ($datestr === '')
		{
			return FALSE;
		}

		$datestr = preg_replace('/\040+/', ' ', trim($datestr));

		if ( ! preg_match('/^(\d{2}|\d{4})\-[0-9]{1,2}\-[0-9]{1,2}\s[0-9]{1,2}:[0-9]{1,2}(?::[0-9]{1,2})?(?:\s[AP]M)?$/i', $datestr))
		{
			return FALSE;
		}

		sscanf($datestr, '%d-%d-%d %s %s', $year, $month, $day, $time, $ampm);
		sscanf($time, '%d:%d:%d', $hour, $min, $sec);
		isset($sec) OR $sec = 0;

		if (isset($ampm))
		{
			$ampm = strtolower($ampm);

			if ($ampm[0] === 'p' && $hour < 12)
			{
				$hour += 12;
			}
			elseif ($ampm[0] === 'a' && $hour === 12)
			{
				$hour = 0;
			}
		}

		return mktime($hour, $min, $sec, $month, $day, $year);
	}
}

// ------------------------------------------------------------------------

// ------------------------------------------------------------------------

if ( ! function_exists('timezones'))
{
	/**
	 * Timezones
	 *
	 * Returns an array of timezones. This is a helper function
	 * for various other ones in this library
	 *
	 * @param	string	timezone
	 * @return	string
	 */
	function timezones($tz = '')
	{
		// Note: Don't change the order of these even though
		// some items appear to be in the wrong order

		$zones = array(
			'UM12'		=> -12,
			'UM11'		=> -11,
			'UM10'		=> -10,
			'UM95'		=> -9.5,
			'UM9'		=> -9,
			'UM8'		=> -8,
			'UM7'		=> -7,
			'UM6'		=> -6,
			'UM5'		=> -5,
			'UM45'		=> -4.5,
			'UM4'		=> -4,
			'UM35'		=> -3.5,
			'UM3'		=> -3,
			'UM2'		=> -2,
			'UM1'		=> -1,
			'UTC'		=> 0,
			'UP1'		=> +1,
			'UP2'		=> +2,
			'UP3'		=> +3,
			'UP35'		=> +3.5,
			'UP4'		=> +4,
			'UP45'		=> +4.5,
			'UP5'		=> +5,
			'UP55'		=> +5.5,
			'UP575'		=> +5.75,
			'UP6'		=> +6,
			'UP65'		=> +6.5,
			'UP7'		=> +7,
			'UP8'		=> +8,
			'UP875'		=> +8.75,
			'UP9'		=> +9,
			'UP95'		=> +9.5,
			'UP10'		=> +10,
			'UP105'		=> +10.5,
			'UP11'		=> +11,
			'UP115'		=> +11.5,
			'UP12'		=> +12,
			'UP1275'	=> +12.75,
			'UP13'		=> +13,
			'UP14'		=> +14
		);

		if ($tz === '')
		{
			return $zones;
		}

		return isset($zones[$tz]) ? $zones[$tz] : 0;
	}
}

// ------------------------------------------------------------------------

if ( ! function_exists('date_range'))
{
	/**
	 * Date range
	 *
	 * Returns a list of dates within a specified period.
	 *
	 * @param	int	unix_start	UNIX timestamp of period start date
	 * @param	int	unix_end|days	UNIX timestamp of period end date
	 *					or interval in days.
	 * @param	mixed	is_unix		Specifies whether the second parameter
	 *					is a UNIX timestamp or a day interval
	 *					 - TRUE or 'unix' for a timestamp
	 *					 - FALSE or 'days' for an interval
	 * @param	string  date_format	Output date format, same as in date()
	 * @return	array
	 */
	function date_range($unix_start = '', $mixed = '', $is_unix = TRUE, $format = 'Y-m-d')
	{
		if ($unix_start == '' OR $mixed == '' OR $format == '')
		{
			return FALSE;
		}

		$is_unix = ! ( ! $is_unix OR $is_unix === 'days');

		// Validate input and try strtotime() on invalid timestamps/intervals, just in case
		if ( ( ! ctype_digit((string) $unix_start) && ($unix_start = @strtotime($unix_start)) === FALSE)
			OR ( ! ctype_digit((string) $mixed) && ($is_unix === FALSE OR ($mixed = @strtotime($mixed)) === FALSE))
			OR ($is_unix === TRUE && $mixed < $unix_start))
		{
			return FALSE;
		}

		if ($is_unix && ($unix_start == $mixed OR date($format, $unix_start) === date($format, $mixed)))
		{
			return array(date($format, $unix_start));
		}

		$range = array();

		$from = new DateTime();
		$from->setTimestamp($unix_start);

		if ($is_unix)
		{
			$arg = new DateTime();
			$arg->setTimestamp($mixed);
		}
		else
		{
			$arg = (int) $mixed;
		}

		$period = new DatePeriod($from, new DateInterval('P1D'), $arg);
		foreach ($period as $date)
		{
			$range[] = $date->format($format);
		}

		/* If a period end date was passed to the DatePeriod constructor, it might not
		 * be in our results. Not sure if this is a bug or it's just possible because
		 * the end date might actually be less than 24 hours away from the previously
		 * generated DateTime object, but either way - we have to append it manually.
		 */
		if ( ! is_int($arg) && $range[count($range) - 1] !== $arg->format($format))
		{
			$range[] = $arg->format($format);
		}

		return $range;
	}
}


if(! function_exists('getDobMonth')){

function getDobMonth($str, $isword = true){

    $array = explode("-", $str);
    $month = $array[1];

   if($isword != true){
     /**
     Get birth month from a normal date field in a number format
     **/
     return $month;
   }

   /**
   Get birth month from a normal date field in a word format
   **/

    if ($month == 1) {
        # code...
        return "January";
    }
    elseif ($month == 2) {
        # code...
        return "Febuary";
    }
    elseif ($month == 3) {
        # code...
        return "March";
    }
    elseif ($month == 4) {
        # code...
        return "April";
    }
    elseif ($month == 5) {
        # code...
        return "May";
    }
    elseif ($month == 6) {
        # code...
        return "June";
    }
    elseif ($month == 7) {
        # code...
        return "July";
    }
    elseif ($month == 8) {
        # code...
        return "August";
    }
    elseif ($month == 9) {
        # code...
        return "September";
    }
    elseif ($month == 10) {
        # code...
        return "October";
    }
    elseif ($month == 11) {
        # code...
        return "November";
    }
    elseif ($month == 12) {
        # code...
        return "December";
    }

    return false;
}

}

if(! function_exists('getDobDate')){

function getDobDate($str){

   /**
   Get birth date from a normal date field
   **/

   $array = explode("-",$str);
   $first = $array[2];

   return $first;
}

}

if(! function_exists('getDobYear')){

function getDobYear($str){

   /**
   Get birth year from a normal date field
   **/

   $array = explode("-",$str);
   $first = $array[0];

   return $first;
}

}


if(! function_exists('dt')){

function dt(){

   /**
   Returns present date and time
   **/

   return date("Y-m-d H:i:s");
}

}


if(! function_exists('d')){

function d(){

   /**
   Returns present date
   **/

   return date("Y-m-d");
}

}


if(! function_exists('t')){

function t(){

   /**
   Returns present time
   **/

   return date("H:i:s");
}

}


if(! function_exists('tt')){

function tt(){

   /**
   Returns present time in AM/PM format
   **/

   return date('h:i A', time());
}

}