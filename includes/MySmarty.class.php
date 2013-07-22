<?php
require_once 'Smarty.class.php';
require_once 'Zend/Log.php';
require_once 'Zend/Log/Writer/Stream.php';

class MySmarty extends Smarty  {
	public function MySmarty()  {
		$this->__construct();
		$this->template_dir = './default/views/templates';
		$this->compile_dir = './default/views/templates_c';
		$this->config_dir = './default/views/config';
		$this->caching = FALSE;
		$this->default_modifiers = 'escape:"html"';
	}
	
	public function simpleDisplay($req,$infos)  {
		$name = $req->getControllerName().'/'.$req->getActionName().'.tpl';
		$this->assign('information',$infos);
		//$this->assign('current', $name);
		//$this->assign('base', $req->getBaseUrl());
		$this->display('master.tpl');
	}
	
}
