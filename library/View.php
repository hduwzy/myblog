<?php
/**
 * 视图类
 * @author wzy
 */
class View
{
	/**
	 * 模板路径
	 * @var string
	 */
	private $_tplpath;
	
	/**
	 * 模板变量
	 * @var unknown_type
	 */
	private $_tplvar;
	
	/**
	 * 初始化 $_tplvar
	 */
	public function __construct()
	{
		$this->_tplvar = array();
	}
	
	/**
	 * 设置模板路径
	 * @param string $path
	 */
	public function setTplpath($path)
	{
		$this->_tplpath = $path;
	}
	
	/**
	 * 取得模板路径
	 * @return string
	 */
	public function getTplpath()
	{
		return $this->_tplpath;
	}
	
	/**
	 * 模板变量赋值
	 * @param string $name
	 * @param mix $val
	 */
	public function assign($name, $val = '')
	{
		if (is_array($name)) {
			foreach ($name as $key => $value) {
				$this->_tplvar[$key] = $value;
			}
		} else {
			$this->$name = $val;
		}
	}
	
	/**
	 * 渲染模板
	 * @param string $tpl
	 * @param bool $echo
	 */
	public function render($tpl = '', $echo = true)
	{
		ob_start();
		include $tpl;
		$content = ob_get_contents();
		ob_end_clean();
		if ($echo) {
			echo $content;
		} else {
			return $content;
		}
	}
	
	/**
	 * json格式输出变量
	 * @param bool $echo
	 */
	public function jsonrender($echo = true)
	{
		if ($echo) {
			echo json_encode($this->_tplvar);
		} else {
			return json_encode($this->_tplvar);
		}
	}
}