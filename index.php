<?php
define('APP_INC', './includes');
require_once 'Zend/Controller/Action.php';
require_once 'Zend/Controller/Front.php';
require_once 'Zend/Registry.php';
require_once 'Zend/Session.php';
require_once 'Zend/Cache.php'; 
require_once 'Zend/Controller/Plugin/ErrorHandler.php';
//引用自定义脚本
require_once APP_INC.'/DbManager.class.php';
require_once APP_INC.'/AuthPlugin.class.php';
require_once APP_INC.'/MySmarty.class.php';
require_once APP_INC.'/AclPlugin.class.php';

$front = Zend_Controller_Front::getInstance();
$front->setControllerDirectory('./default/controllers');

//注册插件

$acl = new aclTables();
$rules = $acl->grant(); 
$front->registerPlugin(new Zend_Controller_Plugin_ErrorHandler(array(
    'module'     => 'default',
    'controller' => 'error',
    'action'     => 'error'
)));
$front->registerPlugin(new AuthPlugin());
$front->registerPlugin(new AclPlugin($rules));

$front->setParam('noViewRenderer',TRUE);
$front->dispatch();
?>