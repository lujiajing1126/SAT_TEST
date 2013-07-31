<?php
require_once 'Zend/Controller/Action.php';
require_once 'Zend/Controller/Plugin/ErrorHandler.php';
require_once './default/models/customErrorHandler.php';

class ErrorController extends Zend_Controller_Action  {
    public function errorAction()  {
        $errors = $this->_getParam('error_handler');
        if (!$errors || !$errors instanceof ArrayObject) {
        	$this->view->message = 'You have reached the error page';
        	return;
        }
        //自定义错误类型处理器
        if ($errors->type == Zend_Controller_Plugin_ErrorHandler::EXCEPTION_OTHER) {
        	ob_start();
        	print_r($errors);
        	$file_content = ob_get_contents();
        	ob_end_clean();
        	if (preg_match("/Sat_Acl_Exception/", $file_content)) {
        		$this->getResponse()->setHeader('Content-Type', "text/html;charset=utf-8");
                		// application error
                		$content =<<<EOH
				<h1>Error!</h1>
				<p>你所在的用户组无法没有权限访问该页面</p>
EOH;
                $this->getResponse()->clearBody();
               	$customhandler = new customErrorHandler();
               	$customhandler->customError($content);
        		exit();
        	} elseif (preg_match("/Sat_Reg_Exception/", $file_content))  {
        		$this->getResponse()->setHeader('Content-Type', "text/html;charset=utf-8");
                		// application error
                		$content =<<<EOH
				<h1>Error!</h1>
				<p>您已登录，请不要重复注册！</p>
EOH;
                $this->getResponse()->clearBody();
               	$customhandler = new customErrorHandler();
               	$customhandler->customError($content);
        		exit();
        	}  elseif (preg_match("/Sat_Auth_Exception/", $file_content))  {
        		$this->getResponse()->setHeader('Content-Type', "text/html;charset=utf-8");
                		// application error
                		$content =<<<EOH
				<h1>Error!</h1>
				<p>您已登录，请不要重复登录！</p>
EOH;
                $this->getResponse()->clearBody();
               	$customhandler = new customErrorHandler();
               	$customhandler->customError($content);
        		exit();
        	}
        	
        }
        switch ($errors->type) {
            case Zend_Controller_Plugin_ErrorHandler::EXCEPTION_NO_CONTROLLER:
            case Zend_Controller_Plugin_ErrorHandler::EXCEPTION_NO_ACTION:
                // 404 error -- controller or action not found
                $this->getResponse()->setRawHeader('HTTP/1.1 404 Not Found');
				$this->getResponse()->setHeader('Content-Type', "text/html;charset=utf-8");
                $content =
<<<EOF
<h1>Error!</h1>
<p>The page you requested was not found.</p>
EOF;
                break;
            default:
            	$this->getResponse()->setHeader('Content-Type', "text/html;charset=utf-8");
                // application error
                $content =<<<EOH
				<h1>Error!</h1>
				<p>An unexpected error occurred. Please try again later.</p>
EOH;
                break;
        }
        // Clear previous content
        $this->getResponse()->clearBody();
		$s = new MySmarty();
		$s->assign('content',$content);
		$s->display('error/error.tpl');
    }
}