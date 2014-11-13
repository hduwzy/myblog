<?php
/**
 * 读取配置文件类
 * @author wzy
 */
class Config
{
	/**
	 * 配置文件根目录
	 * @var string
	 */
	private static $_root;
	
	/**
	 * 配置文件缓存，避免重复读入
	 * @var array
	 */
	private static $_ini;
	
	/**
	 * 取得根路径
	 */
	public static function getRoot()
	{
		if (empty(self::$_root)) {
			self::$_root = PROJECT_PATH . '/conf/';
		}
		return self::$_root;
	}
	
	/**
	 * 设置配置文件根目录
	 * @param unknown $_root
	 */
	public static function setRoot($_root)
	{
		self::$_root = $_root;
	}
	
	
	/**
	 * 取具体配置值
	 * @param string $key
	 */
	public static function get($key)
	{
		$keyparse = self::_parsekey($key);
		$filename = $keyparse['filename'];
		$key = $keyparse['key'];
		$filepath = self::getRoot() . $filename;
		if (!isset(self::$_ini[$filename])) {
			if (!file_exists($filepath)) {
				return null;
			}
			self::$_ini[$keyparse['filename']] = include $filepath;
		}
		if ($key === '*') {
			return self::$_ini[$keyparse['filename']];
		}
		return isset(self::$_ini[$filename][$key]) ? self::$_ini[$filename][$key] : null;
	}
	
	/**
	 * 解析配置key
	 * @param string $key
	 */
	private static function _parsekey($key)
	{
		$result = array();
		$keyparts = explode('.', $key);
		$result['key'] = array_pop($keyparts);
		$result['filename'] = implode(DIRECTORY_SEPARATOR, $keyparts) . '.ini.php';
		return $result;
	}
}