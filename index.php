<?php
// 定义系统常量
define('ROOTPATH', dirname(__FILE__) . '/');
define('DEBUG', true);

// 开启报错
if (DEBUG) {
	ini_set('display_errors', 'On');
	error_reporting(E_ALL);
} else {
	ini_set('display_errors', 'Off');
}


// 初始化类加载器
if (!file_exists(ROOTPATH . 'library/Loader.php')) {
	die('system down!');
}
include_once ROOTPATH . 'library/Loader.php';
$loader = Loader::getInstance();
$loader->setLibpath(ROOTPATH . 'library/');
$loader->setModelspath(ROOTPATH . 'models/');
spl_autoload_register(array($loader, 'autoload'));


// 初始化配置文件读写类
Config::setRoot(ROOTPATH . 'conf/');

Caller::setActionsuffix('Action');
Caller::setCalleesuffix('Callee');
Caller::setCalleepath(ROOTPATH . 'callees/');

Input::init();
Mysql::connect();

$callinfo = Input::get('do', 'msg-calleenotfound');
Caller::call($callinfo);

// end
