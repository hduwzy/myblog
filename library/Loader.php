<?php
/**
 * 类文件加载器
 * @author wzy
 */
class Loader
{
	/**
	 * library目录
	 * @var string
	 */
	private $_libpath;
	
	/**
	 * model目录
	 * @var string
	 */
	private $_modelspath;
	
	/**
	 * 控制器目录
	 * @var string
	 */
	private $_controllerpath;
	
	/**
	 * 实例
	 * @var Loader
	 */
	private static $_instance;
	
	/**
	 * @return the $_libpath
	 */
	public function getLibpath()
	{
		return $this->_libpath;
	}

	/**
	 * @return the $_modelspath
	 */
	public function getModelspath()
	{
		return $this->_modelspath;
	}

	/**
	 * @return the $_controllerpath
	 */
	public function getControllerpath()
	{
		return $this->_controllerpath;
	}

	/**
	 * @param string $_libpath
	 */
	public function setLibpath($_libpath)
	{
		$this->_libpath = $_libpath;
	}

	/**
	 * @param string $_modelspath
	 */
	public function setModelspath($_modelspath)
	{
		$this->_modelspath = $_modelspath;
	}

	/**
	 * @param string $_controllerpath
	 */
	public function setControllerpath($_controllerpath)
	{
		$this->_controllerpath = $_controllerpath;
	}

	/**
	 * 加载类库
	 * @param string $lib
	 */
	public function loadLib($lib = '')
	{
		$libpath = $this->getLibpath();
		$lib = ucfirst($lib);
		$filename = $libpath . "{$lib}.php";
		if (file_exists($filename)) {
			include_once $filename;
			return true;
		}
		return false;
	}
	
	/**
	 * 加载model
	 * @param string $model
	 */
	public function loadModel($model = '')
	{
		$modelpath = $this->getModelspath();
		$info = explode('_', $model);
		$filename = $modelpath . implode('/', $info) . '.php';
		if (file_exists($filename)) {
			include_once $filename;
			return true;
		}
		return false;
	}
	
	/**
	 * 加载控制器
	 * @param string $controller
	 */
// 	public function loadController($controller = '')
// 	{
// 		$cpath = $this->getControllerpath();
// 		$controller = ucfirst($controller) . 'Controller';
// 		$filename = $cpath . "$controller.php";
// 		if (file_exists($filename)) {
// 			include_once $filename;
// 			return true;
// 		}
// 		return false;
// 	}
	
	/**
	 * 用于注册spl_autoload_register的自动加载函数
	 * @param string $classname
	 */
	public function autoload($classname)
	{
		if (false !== strpos($classname, '_')) {
			$this->loadModel($classname);
		} else {
			$this->loadLib($classname);
		}
	}
	
	/**
	 * 取得加载器实例
	 */
	public static function getInstance()
	{
		if (null == self::$_instance) {
			self::$_instance = new Loader();
		}
		return self::$_instance;
	}
}