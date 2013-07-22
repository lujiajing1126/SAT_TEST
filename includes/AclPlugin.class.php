<?php
/*
 * @name:用户权限认证
* @author:megrez
*/

require_once 'Zend/Controller/Plugin/Abstract.php';
require_once 'Zend/Acl.php';
require_once 'Zend/Auth.php';

class AclPlugin extends Zend_Controller_Plugin_Abstract  {
	protected $_acl;
	public function __construct(Zend_Acl $acl)  {
		$this->_acl = $acl;
	}
	public function __destruct()  {
	}

	public function dispatchLoopStartup(Zend_Controller_Request_Abstract $req)  {
		$controller = $req->getControllerName();
		$action = $req->getActionName();
		
		$sess = new Zend_Session_Namespace('satApp');
		$resource = ucfirst(strtolower($controller));
		
		if($sess->isLogined)  {
			if($resource == 'Admin'|| $resource == 'Sat')  {
				$role = strtolower($sess->roles);
				if(!($this->_acl->isAllowed($role,$resource,'view')))  {
					die("对不起您没有权限");
				}
				else  {
				}
			}			
		}else  {
			if($resource == 'Admin'||$resource == 'Sat')  {
				$role = 'guest';
				if(!$this->_acl->isAllowed($role,$resource,'view'))  {
					die("对不起来宾，你没有权限！");
				}
			}
		}
	}
}
?>