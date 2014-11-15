<?php
/**
 * 测试callee
 * @author wzy
 */
class TestCallee
{
	/**
	 * 测试操作
	 */
	public function testAction()
	{
		$view = new View();
		$view->assign('title', 'Test callee');
		$view->assign('content', 'Hello World!');
		$view->render(ROOTPATH . "views/test.phtml");
	}
	
	public function mysqltestAction()
	{
		Mysql::connect(Config::get('blog.test.*'));
// 		Mysql::execute("insert into student values(null, 'Tom', 24)");
// 		Mysql::execute("insert into student values(null, 'Jam', 29)");
// 		$result = Mysql::execute("insert into students values(null, 'Tuto', 21)");
// 		if (!$result) {
// 			echo Mysql::error();
// 			return ;
// 		}
		$result = Mysql::query("select * from student");
		$sql = "delete from student where 1=1";
		if (!Mysql::execute($sql)) {
			echo Mysql::error();
		}
		print_r($result);
	}
}