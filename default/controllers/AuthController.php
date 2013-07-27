<?php
use PFBC\Form;
use PFBC\Element;
use PFBC\Validation;

require_once 'Zend/Controller/Action.php';
require_once 'Zend/Auth/Adapter/DbTable.php';
require_once APP_PATH.'/default/models/Register.class.php';
//require_once APP_PATH.'/default/models/Index.class.php';
require_once APP_PATH.'/public/PFBC/Form.php';
require_once 'Zend/Log.php';
require_once 'Zend/Log/Writer/Stream.php';
require_once 'Zend/Http/Client.php';


class AuthController extends Zend_Controller_Action  {
public function processAction(){
		$req = $this->getRequest();
		$s = new MySmarty();
		if($req->getParam('user') != Null && $req->getParam('user') != '' && $req->getParam('passwd') != NULL && $req->getParam('passwd') != '')  {
		$db = DbManager::getConnection();
		$reg = new Register();
		$auth = new Zend_Auth_Adapter_DbTable($db, 'user', 'name', 'passwd', 'md5(?)');
		$auth->setIdentity($req->getParam('user'))->setCredential($req->getParam('passwd'));
		$result = $auth->authenticate();
		$s->assign('baseUrl',APP_URL);
		if($result->isValid() && ($reg->authUser($req->getParam('user')) == 1)) {
			$info = $auth->getResultRowObject(NULL, 'passwd');
			$cookie = $reg->setAutologin($req->getParams(),$reg->getUid($req->getParam('user')));
			$sess = new Zend_Session_Namespace('satApp');
			$sess->isLogined = TRUE;
			$sess->uid = $info->uid;
			$sess->roles = $info->roles;
			$sess->name = $info->name;
			$sess->avatar = $info->img;
			$sess->setExpirationSeconds(1800);
			setcookie('autoLoginKey',$cookie,time()+3600,'/','localhost');
			$s->assign('user',$info->name);
			$s->assign('result',TRUE);
			$s->display('auth/process.tpl');
		} else {
			$s->assign('result',FALSE);
			$s->display('auth/process.tpl');
		}
		} else  {
			$s->assign('result',FALSE);
			$s->display('auth/process.tpl');
		}
	}

	public function logoutAction() {
		$sess = new Zend_Session_Namespace('satApp');
		$reg = new Register();
		$reg->delAutologin();
		Zend_Session::destroy();
		$this->_redirect('/');
	}
	
	public function manageAction()  {
		$s = new MySmarty();
		$sess = new Zend_Session_Namespace('satApp');
		if($sess->isLogined)  {
			$s->display('auth/manage.tpl');
		}
	}
	
	public function registerAction()  {
		@session_start();
		$req = $this->getRequest();
		if(isset($_POST['form'])) {
			if(Form::isValid($_POST['form'])) {
				$reg = new Register();
				if ($req->getParam('Password') != $req->getParam('Password_again')) {//验证两次密码是否相同
					Form::setError("register", "Error: Invalid Password, not the same");
					header("Location: ".vAPP_NAME."/auth/register");
					die("两次密码不同！");
				}
				if ($reg->authName($req->getParam('Name'))) {//验证是否重名
					Form::setError("register", "Error: Invalid Name, Please change it!");
					header("Location: ".vAPP_NAME."/auth/register");
					die("有相同的用户名！");
				}	
				$result = $reg->authkey($req->getParam('invcode'));
				if($result == 1)  {//邀请码有效，继续创建用户
					//$reg->setKey($req->getParam('invcode'));
					$reqarray = array(
							"name"=>$req->getParam('Name'),
							"passwd"=>$req->getParam('Password'),
							"email"=>$req->getParam('Email'),
							"sex"=>$req->getParam('Gender'),
							"grade"=>$req->getParam('Grade')
					);
					$reg->regNewUser($reqarray);
					die("邀请码有效！");
				} else {
					Form::setError("register", "Error: Invalid Invitation Code");
					header("Location: ".vAPP_NAME."/auth/register");
					die("邀请码无效！");
				}
			}
		}
		$form = new Form("register");
		$form->configure(array(
				"action" => vAPP_NAME.'/auth/register'
		));
		$genders = array("Male", "Female");
		$grades = array("9","10","11","12",">12");
		$form->addElement(new Element\HTML('<legend>Register</legend>'));
		$form->addElement(new Element\Hidden("form", "register"));
		$form->addElement(new Element\Textbox("Invitation Code:", "invcode", array(
				"required" => 1,
				"longDesc" => "请输入邀请码！"
		)));
		$form->addElement(new Element\Textbox("User Name:", "Name", array(
				"required" => 1,
				"longDesc" => "在此处填写用户名"
		)));
		$form->addElement(new Element\Password("Password:", "Password", array(
				"required" => 1,
				"longDesc" => "在此处填写密码",
				"validation" => new Validation\RegExp("/^[A-Za-z0-9]{8,16}$/", "Error: The %element% must between 8~16"),
		)));
		$form->addElement(new Element\Password("Password Confirm:", "Password_again", array(
				"required" => 1,
				"longDesc" => "请确认密码"
		)));
		$form->addElement(new Element\Email("Email Address:", "Email", array(
				"required" => 1,
				"longDesc" => "在此处填写邮件"
		)));
		$form->addElement(new Element\Radio("Gender:", "Gender", $genders, array(
				"required" => 1
		)));
		$form->addElement(new Element\Select("Grade:", "Grade", $grades,array(
				"required" => 1
		)));
		$form->addElement(new Element\Button("Register","submit"));
		$form->addElement(new Element\Button("Cancel", "button", array(
				"onclick" => "history.go(-1);"
		)));
		
		$form->render();

	}
}
?>