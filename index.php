<?php
// 定义系统常量
define('ROOTPATH', dirname(__FILE__) . '/');
define('DEBUG', true);


// 初始化类加载器
if (!file_exists(ROOTPATH . 'library/Loader.php')) {
	die('system down!');
}
include_once ROOTPATH . 'library/Loader.php';
$loader = Loader::getInstance();
$loader->setLibpath(ROOTPATH . 'library/');
$loader->setModelspath(ROOTPATH . 'models/');
$loader->setControllerpath(ROOTPATH . 'controllers/');
spl_autoload_register(array($loader, 'autoload'));

// 初始化配置文件读写类
Config::setRoot(ROOTPATH . 'conf/');


Blog_Base::test();
Router::test();



exit;















