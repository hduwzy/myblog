<?php
/**
 * 调用者类
 * @author wzy
 */
class Caller
{
	/**
	 * 被调用者后缀
	 * @var string
	 */
	private static $_calleesuffix;
	
	/**
	 * 被调用者路径
	 * @var string
	 */
	private static $_calleepath;
	
	/**
	 * 被调用者列表
	 * @var array
	 */
	private static $_calleelist;
	
	/**
	 * 操作后缀
	 * @var unknown_type
	 */
	private static $_actionsuffix;
	
	/**
	 * 设置被调用类后缀
	 * @param string $suffix
	 */
	public static function setCalleesuffix($suffix)
	{
		self::$_calleesuffix = $suffix;
	}
	
	/**
	 * 获得被调用类后缀
	 * @return string
	 */
	public static function getCalleesuffix()
	{
		return self::$_calleesuffix;
	}
	
	/**
	 * 设置被调用者根路径
	 * @param string $path
	 */
	public static function setCalleepath($path)
	{
		self::$_calleepath = $path;
	}
	
	/**
	 * 获得被调用者路径
	 * @return string
	 */
	public static function getCalleepath()
	{
		return self::$_calleepath;
	}
	
	/**
	 * 设置操作后缀
	 * @param unknown_type $suffix
	 */
	public static function setActionsuffix($suffix)
	{
		self::$_actionsuffix = $suffix;
	}
	
	/**
	 * 获得操作后缀
	 * @return unknown_type
	 */
	public static function getActionsuffix()
	{
		return self::$_actionsuffix;
	}
	/**
	 * 调用操作
	 * @param string $who
	 * @param array $params
	 */
	public static function call($who = '', $params = array())
	{
		list($calleeinfo, $action) = explode('-', $who);
		$action .= self::getActionsuffix();
		$calleeinfo = explode('.', $calleeinfo);
		$callee = ucfirst(array_pop($calleeinfo)) . self::getCalleesuffix();
		$calleepath = empty($calleeinfo) ? "" : implode('/', $calleeinfo) . "/";
		$calleepath = self::getCalleepath() . $calleepath . "{$callee}.php";
		
		if (!class_exists($callee)) { // 目标类不存在的情况
			if (file_exists($calleepath)) {
				include_once $calleepath;
			} else {
				// 如果没有默认callee该怎么办,写成配置？
				return self::call('msg-calleenotfound');
			}
		}
		$calleeobj = new $callee;
		if (method_exists($calleeobj, $action)) { 
			return call_user_func_array(array($calleeobj, $action), $params);
		} else { // 目标方法不存在的情况
			return self::call('msg-actionnotfound');
		}
	}
}