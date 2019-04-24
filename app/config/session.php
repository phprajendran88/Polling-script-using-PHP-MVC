
<?php
class Session 
{

	private static $_sessionStarted = false;
	/*
	* To initliaze the session
	*/
	public static function init()
	{
		if(self::$_sessionStarted == false)
		{
			session_start();
			self::$_sessionStarted = true;
		}
	}

	/*
	* To set the session with prefix defined in config.php
	*/
	public static function set($key,$value)
	{
		$_SESSION[SESSION_PREFIX.$key] = $value;
	}

	/*
	* To get the session with prefix defined in config.php
	*/
	public static function get($key,$secondkey = false)
	{
		if($secondkey == true)
		{
			if(isset($_SESSION[SESSION_PREFIX.$key][$secondkey]))
			{
				return $_SESSION[SESSION_PREFIX.$key][$secondkey];
			}
		} 
		else 
		{
			if(isset($_SESSION[SESSION_PREFIX.$key]))
			{
				return $_SESSION[SESSION_PREFIX.$key];
			}
		}
		return false;
	}

	/*
	* To display the session
	*/
	public static function display()
	{
		return $_SESSION;
	}

	/*
	* To destroy the session
	*/
	public static function destroy(){
		if(self::$_sessionStarted == true)
		{
		session_unset();
		session_destroy();
		}
	}
}