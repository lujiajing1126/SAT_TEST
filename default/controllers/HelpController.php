<?php
require_once 'Zend/Controller/Action.php';

class HelpController extends Zend_Controller_Action  {
	function indexAction()  {
		$s = new MySmarty();
		$s->display('help.tpl');
	}
}

