<?php
class customErrorHandler  {
	public function customError($content) {
		$s = new MySmarty();
		$s->assign('content',$content);
		$s->display('error/error.tpl');
	}
}