<?php
require_once 'Zend/Controller/Action.php';

class GetothersController extends Zend_Controller_Action  {
	function getctbAction()  {
		$s = new MySmarty();
		$s->display('default.tpl');
	}
}