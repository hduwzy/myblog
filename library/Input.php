<?php
/**
 * 输入类
 * @author wzy
 */
class Input
{
	public static $cookie;
	public static $get;
	public static $post;
	public static $request;
	public static $files;
	public static $server;
	public static $env;
	
	/**
	 * 初始化输入
	 */
	public static function init()
	{
		self::$cookie = self::_filter($_COOKIE);
		self::$get = self::_filter($_GET);
		self::$post = self::_filter($_POST);
		self::$request = self::_filter($_COOKIE);
		self::$files = self::_filter($_FILES);
		self::$server = $_SERVER;
		self::$env = $_ENV;
	}
	
	
	/**
	 * 取得参数
	 * @param string $name
	 * @param mix $default
	 * @return mix
	 */
	public static function get($name, $default)
	{
		if (isset($_REQUEST[$name])) {
			return $_REQUEST[$name];
		}
		return $default;
	}
	
	
	/**
	 * 输入过滤函数
	 * @param array $data
	 * @return array
	 */
	private static function _filter($data)
	{
		return $data;
	}
}