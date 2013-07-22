<?php
define('APP_PATH',str_replace('\\','/',realpath(dirname(__FILE__).'/../')));
define('APP_NAME','SAT_TEST');
define('vAPP_NAME','/'.APP_NAME);
define('APP_URL', 'Http://localhost/'.APP_NAME);
$APPNAME = "SAT_TEST";


class aclTables {
	private $acl;
	function __construct()  {
	$this->acl = new Zend_Acl();

	}
	
	function createRoles()  {
	$this->acl->addRole(new Zend_Acl_Role('guest'));
	$this->acl->addRole(new Zend_Acl_Role('user'));
	$this->acl->addRole(new Zend_Acl_Role('supervisor'),'user');
	$this->acl->addRole(new Zend_Acl_Role('admin'));
	}
	
	function defineRes()  {
	$this->acl->add(new Zend_Acl_Resource('Index'))
	->add(new Zend_Acl_Resource('Auth'))
	->add(new Zend_Acl_Resource('Sat'))
	->add(new Zend_Acl_Resource('Admin'));
	}
	
	function grant()  {
		$this->createRoles();
		$this->defineRes();
		$this->acl->allow('guest','Index','view');
		$this->acl->allow('guest','Auth','view');
		$this->acl->allow('user','Sat','view');
		$this->acl->allow('supervisor','Admin','view');
		$this->acl->allow('admin');
		return $this->acl;
	}
}

?>