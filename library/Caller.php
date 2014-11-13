<?php
/**
 * 调用者类
 * @author wzy
 */
class Caller
{
	private static $_calleesuffix;
	private static $_calleepath;
	private static $_calleelist;
	
	public static function setCalleesuffix($suffix)
	{
		self::$_calleesuffix = $suffix;
	}
	
	public static function getCalleesuffix()
	{
		return self::$_calleesuffix;
	}
	
	public static function setCalleepath($path)
	{
		self::$_calleepath = $path;
	}
	
	public static function getCalleepath()
	{
		return self::$_calleepath;
	}
	
	public static function call($who = '', $params = array())
	{
		
	}
}