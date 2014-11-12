<?php
// 定义系统常量
define('ROOTPATH', dirname(__FILE__) . '/');
define('DEBUG', true);

if (!file_exists(ROOTPATH . 'library/Loader.php')) {
	die('system down!');
}
include_once ROOTPATH . 'library/Loader.php';

$loader = Loader::getInstance();
$loader->setLibpath(ROOTPATH . 'library/');
$loader->setModelspath(ROOTPATH . 'models/');
$loader->setControllerpath(ROOTPATH . 'controllers/');

spl_autoload_register(array($loader, 'autoload'));

Blog_Base::test();
Router::test();



exit;















