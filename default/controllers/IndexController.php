<?php
require_once 'Zend/Controller/Action.php';
//require_once APP_PATH.'/default/models/Index.class.php';
require_once 'Zend/Auth.php';
require_once './includes/const.class.php';

class IndexController extends Zend_Controller_Action  {
	public function indexAction()  {
		$s = new MySmarty();
		$sess = new Zend_Session_Namespace('satApp');
		if($sess->isLogined)  {
			$s->assign('username',$sess->name);
			$s->assign('imgsrc',$sess->avatar);
			$s->assign('flg',TRUE);
			$infos = "已登录！".$sess->roles;
			if (isset($_COOKIE["autoLoginKey"])) {
					$infos = $infos."存在cookie";
				
			}else $infos = $infos."不存在cookie";
		}else {
			$s->assign('flg',FALSE);
			$infos = "您需要登录！";
		}
		$req = $this->getRequest();
		$s->assign('APPNAME',"SAT_TEST");
		$s->simpleDisplay($req,$infos);
	}
}