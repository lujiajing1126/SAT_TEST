<?php
require_once 'Zend/Controller/Action.php';
require_once 'Zend/Controller/Plugin/ErrorHandler.php';

class ErrorController extends Zend_Controller_Action  {
    public function errorAction()  {
        $errors = $this->_getParam('error_handler');
        if (!$errors || !$errors instanceof ArrayObject) {
        	$this->view->message = 'You have reached the error page';
        	return;
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
                case Zend_Controller_Plugin_ErrorHandler::EXCEPTION_OTHER:
                		$this->getResponse()->setHeader('Content-Type', "text/html;charset=utf-8");
                		// application error
                		$content =<<<EOH
				<h1>Error!</h1>
				<p>你所在的用户组无法没有权限访问该页面</p>
EOH;
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