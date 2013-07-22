<?php
/*
 * @name:用户验证插件
 * @author:megrez
 */

require_once 'Zend/Controller/Plugin/Abstract.php';
require_once './default/models/Register.class.php';

class AuthPlugin extends Zend_Controller_Plugin_Abstract  {
	private $_db;
	public function __construct()  {
		$this->_db = DbManager::getConnection();
	}
	public function __destruct()  {
		$this->_db->closeConnection();
	}
	private function getUserid($key)  {
		$uid = $this->_db->fetchOne('SELECT uid FROM autologin WHERE loginkey = ? AND expire > ?',array($key,date('Y-m-d G:i:s')));
		if($uid == Null)  {
			$uid='';
		}else  {
			$stt = $this->_db->prepare('UPDATE user SET lastlogin=:lastlogin WHERE uid=:uid');
			$mydate = date('Y-m-d H:i:s');
			$stt->bindParam(':lastlogin',$mydate);
			$stt->bindParam(':uid', $uid);
			$stt->execute();
		}
		return $uid;
	}

	public function dispatchLoopStartup(Zend_Controller_Request_Abstract $req)  {
		$sess = new Zend_Session_Namespace('satApp');
		if(!$sess->isLogined)  {
			if (isset($_COOKIE["autoLoginKey"]) && $_COOKIE["autoLoginKey"]!='') {
				$uid = $this->getUserid($_COOKIE["autoLoginKey"]);
				if ($uid != '') {
					$sess->isLogined = TRUE;
					$sess->uid = $uid;
				}
			}
		
			$sess->url='http://localhost/SAT_TEST';
		
			if ($req->getControllerName() != 'auth') {
				$sess->currentModule = $req->getModuleName();
				$sess->currentController = $req->getActionName();
				$sess->currentAction  = $req->getActionName();
			}
		}elseif($sess->isLogined) {//如果session已经设置为成功登陆
			if ($sess->uid) {
				$reg = new Register();
				if (!$sess->name || !$sess->avatar || !$sess->roles) {//获取用户信息并设置
					$info = $reg->getInfo($sess->uid);
					$sess->name = $info[0]["name"];
					$sess->roles = $info[0]["roles"];
					$sess->avatar = $info[0]["img"];
				};
				if (!isset($_COOKIE["autoLoginKey"]) || $_COOKIE["autoLoginKey"]=='') {//若没有设置自动登陆key
					$key = $reg->getKey($sess->uid);
					setcookie('autoLoginKey',$key,time()+3600);
				}
			}elseif (isset($_COOKIE["autoLoginKey"]) && $_COOKIE["autoLoginKey"]=='') {//有key也可以认为已经登陆
				$uid = $this->getUserid($_COOKIE["autoLoginKey"]);
				$reg = new Register();
				if ($uid != '') {
					$sess->uid = $uid;
					$info = $reg->getInfo($sess->uid);
					$sess->name = $info[0]["name"];
					$sess->roles = $info[0]["roles"];
					$sess->avatar = $info[0]["img"];
				}//利用key并设置用户
			}else {
				 $sess->isLogined = False;
			}
		}
	}
}
?>