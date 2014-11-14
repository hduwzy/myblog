<?php
/**
 * mysql 操作类
 * @author wzy
 */
class Mysql
{
	/**
	 * 链接句柄
	 * @var resource
	 */
	private static $_handle;
	
	/**
	 * 连接数据库
	 * @return boolean
	 */
	public static function connect($conf = null)
	{
		if (null === self::$_handle) {
			if (null === $conf) {
				$conf = Config::get('blog.mysql.*');
			}
			self::$_handle = mysql_connect(
				$conf['host'], 
				$conf['user'],
				$conf['password']
			);
			if (!self::$_handle) {
				echo self::error();
				return false;
			}
			if (isset($conf['dbname'])) {
				mysql_select_db($conf['dbname'], self::$_handle);
			}
		}
		return true;
	}
	
	/**
	 * 选择数据库
	 * @param string $dbname
	 * @return boolean
	 */
	public static function select_db($dbname)
	{
		return mysql_select_db($dbname, self::$_handle);
	}
	
	/**
	 * 又返回数据的查询
	 * @param string $sql
	 * @return array | null
	 */
	public static function query($sql)
	{
		if (null === self::$_handle && false === self::connect()) {
			return null;
		}
		$result = array();
		$resource = mysql_query($sql, self::$_handle);
		if (!$resource) {
			echo self::error();
			return null;
		}
		while (($temp = mysql_fetch_assoc($resource))) {
			$result[] = $temp;
		}
		return $result;
	}
	
	/**
	 * 没有数据返回的查询
	 * @param string $sql
	 * @return bool | null
	 */
	public static function execute($sql)
	{
		if (null === self::$_handle && false === self::connect()) {
			return null;
		}
		if (mysql_query($sql, self::$_handle)) {
			return true;
		}
		return false;
	}
	
	/**
	 * 上一次查询操作影响到的行数
	 * @return int | null
	 */
	public static function affect_rows()
	{
		if (null === self::$_handle && false === self::connect()) {
			return null;
		}
		return mysql_affected_rows(self::$_handle);
	}
	
	/**
	 * 上次一次插入操作的id
	 * @return int | null
	 */
	public static function insert_id()
	{
		if (null === self::$_handle && false === self::connect()) {
			return null;
		}
		return mysql_insert_id(self::$_handle);
	}
	
	/**
	 * 上一次出错的错误编号
	 * @return int | null
	 */
	public static function errno()
	{
		if (null === self::$_handle && false === self::connect()) {
			return null;
		}
		return mysql_errno(self::$_handle);
	}
	
	/**
	 * 上一次出错的错误信息
	 * @return string
	 */
	public static function error()
	{
		if (null === self::$_handle && false === self::connect()) {
			return null;
		}
		return mysql_error(self::$_handle);
	}
}