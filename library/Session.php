<?php
/**
 * session类
 * @author wzy
 */
class Session
{
	/**
	 * session start
	 */
	public static function start()
	{
		session_start();
	}
	
	/**
	 * get session
	 */
	public static function get($key)
	{
		if (isset($_SESSION[$key])) {
			return $_SESSION[$key];
		}
		return null;
	}
	
	/**
	 * destroy session
	 */
	public static function destroy()
	{
		session_destroy();
	}	
}