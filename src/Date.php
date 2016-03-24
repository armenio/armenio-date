<?php
namespace Armenio\Date;

use Zend_Date;
use Zend_Date_Exception;
use Zend_Locale;
use Zend_Locale_Exception;
use Locale;

/**
 * Helper for formatting dates.
 */
class Date extends Zend_Date
{
	const MYSQL_DATE	 = 'YYYY-MM-dd';
	const MYSQL_TIME	 = 'HH:mm:ss';
	const MYSQL_DATETIME = 'YYYY-MM-dd HH:mm:ss';

	/**
	 * Generates the standard date object, could be a unix timestamp, localized date,
	 * string, integer, array and so on. Also parts of dates or time are supported
	 * Always set the default timezone: http://php.net/date_default_timezone_set
	 * For example, in your bootstrap: date_default_timezone_set('America/Los_Angeles');
	 * For detailed instructions please look in the docu.
	 *
	 * @param  string|integer|Zend_Date|array  $date	OPTIONAL Date value or value of date part to set
	 *												 ,depending on $part. If null the actual time is set
	 * @param  string						  $part	OPTIONAL Defines the input format of $date
	 * @param  string|Zend_Locale			  $locale  OPTIONAL Locale for parsing input
	 * @return Zend_Date
	 * @throws Zend_Date_Exception
	 */
	public function __construct($date = null, $part = null, $locale = null, $timezone = null)
	{
		if( $part == 'date' ){
			$part = Zend_Date::DATE_MEDIUM;
		}

		if( $part == 'time' ){
			$part = Zend_Date::TIME_MEDIUM;
		}

		if( $part == 'datetime' ){
			$part = Zend_Date::DATETIME_MEDIUM;
		}

		if ($locale == null) {
			$locale = Locale::getDefault();
		}

		if ($timezone !== null) {
			$this->setTimezone($timezone);
		}

		try{
			parent::__construct($date, $part, $locale);
		}catch(Zend_Date_Exception $e){
			parent::__construct(null, $part, $locale);
		}catch(Zend_Locale_Exception $e2){
			parent::__construct();
		}
	}

	/**
	 * Checks if a string is a valid timestamp.
	 *
	 * @param  string $timestamp Timestamp to validate.
	 * 
	 * @return bool
	 */
	function isTimestamp($timestamp)
	{
		$check = (is_int($timestamp) || is_float($timestamp)) ? $timestamp : (string) (int) $timestamp;
		return  ($check === $timestamp) && ( (int) $timestamp <=  PHP_INT_MAX) && ( (int) $timestamp >= ~PHP_INT_MAX);
	}

	/**
	 * Format a date, like this: 30/06/1986
	 *
	 * @param  string|Zend_Locale $locale
	 * @return string
	 */
	public function formatDate($locale = null)
	{
		if( $locale === null ){
			$locale = $this->getLocale();
		}

		return $this->get(Zend_Date::DATE_MEDIUM, $locale);
	}

	/**
	 * Format a date, like this: 16:45:00
	 *
	 * @param  string|Zend_Locale $locale
	 * @return string
	 */
	public function formatTime($locale = null)
	{
		if( $locale === null ){
			$locale = $this->getLocale();
		}

		return $this->get(Zend_Date::TIME_MEDIUM, $locale);
	}

	/**
	 * Format a date, like this: 30/06/1986 16:45:00
	 *
	 * @param  string|Zend_Locale $locale
	 * @return string
	 */
	public function formatDateTime($locale = null)
	{
		if( $locale === null ){
			$locale = $this->getLocale();
		}

		return $this->get(Zend_Date::DATETIME_MEDIUM, $locale);
	}

	/**
	 * Format a date, like this: 1986-06-30
	 *
	 * @param  string|Zend_Locale $locale
	 * @return string
	 */
	public function formatDbDate($locale = null)
	{
		if( $locale === null ){
			$locale = $this->getLocale();
		}

		return $this->get(self::MYSQL_DATE, $locale);
	}

	/**
	 * Format a date, like this: 16:45:00
	 *
	 * @param  string|Zend_Locale $locale
	 * @return string
	 */
	public function formatDbTime($locale = null)
	{
		if( $locale === null ){
			$locale = $this->getLocale();
		}

		return $this->get(self::MYSQL_TIME, $locale);
	}

	/**
	 * Format a date, like this: 1986-06-30 16:45:00
	 *
	 * @param  string|Zend_Locale $locale
	 * @return string
	 */
	public function formatDbDateTime($locale = null)
	{
		if( $locale === null ){
			$locale = $this->getLocale();
		}

		return $this->get(self::MYSQL_DATETIME, $locale);
	}
}
