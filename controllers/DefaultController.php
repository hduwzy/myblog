<?php
/**
 * 默认callee
 * @author wzy
 */
class DefaultController
{
	/**
	 * 未找到callee
	 */
	public function calleenotfoundAction()
	{
		echo "Callee not found!";exit;
	}
	
	/**
	 * 未找到action
	 */
	public function actionnotfoundAction()
	{
		echo "Action not fount!";exit;
	}
}