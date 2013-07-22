<?php
require_once 'Zend/Mail.php';
require_once 'Zend/Mail/Transport/Smtp.php';
require_once 'Zend/Log.php';
require_once 'Zend/Log/Writer/Stream.php';

class Register  {
	private $_db;
	public function __construct()  {
		$this->_db = DbManager::getConnection();
	}
	
	public function __destruct()  {
		$this->_db->closeConnection();
	}
	
	private function encode($str)  {
		return mb_convert_encoding($str, 'ISO-2022-JP', 'auto');
	}
	
	public function authUser($name){
		$flg = $this->_db->fetchOne('SELECT validflg FROM user WHERE name = ?',array($name));
		return $flg;
	}
	
	public function getUid($name){
		$id = $this->_db->fetchOne('SELECT uid FROM user WHERE name = ?',array($name));
		return $id;
	}
	
	public function getKey($id){
		$uid = $this->_db->fetchOne('SELECT loginkey FROM autologin WHERE uid = ?',array($id));
		return $uid;
	}
	
	public function getInfo($id){
		$info = $this->_db->fetchAll('SELECT * FROM user WHERE uid = ?',array($id));
		return $info;
	}
	
	public function authkey($actkey)  {
		$valid = $this->_db->fetchOne('SELECT isValid FROM invcode WHERE InvitationCode = ?',array($actkey));
		return $valid;
	}
	
	public function setKey($actkey){
		$this->_db->fetchOne('UPDATE invcode SET isValid = 0 WHERE InvitationCode = ?',array($actkey));
	}
	
	public function authName($name)  {
		$uid = $this->_db->fetchOne('SELECT uid FROM user WHERE name = ?',array($name));
		return $uid;
	}
	
	public function setAutologin($data,$uid)  {
		$str = $data["persistent"];
		$sess = new Zend_Session_Namespace('satApp');
		if($str == 1)  {
			session_set_cookie_params(24*3600);//设置session持续时间
			@session_start();
			$count = $this->_db->fetchOne('SELECT count(uid) AS COUNT FROM autologin WHERE trim(uid) = ?',array($uid));
			$key = sha1(uniqid().mt_rand().time());//产生一个随机数key
			$expire = time()+ 3600;//设置cookie到期时间
			//setcookie('autoLoginKey',$key,$expire,'/SAT_TEST','localhost');//设置cookie
			if ($count>0)  {
				$stt = $this->_db->prepare('UPDATE autologin SET loginkey=:key,expire=:expire Where uid=:uid');
				$stt->bindParam(':key', $key);
				$datestamp = date('Y-m-d G:i:s',$expire);
				$stt->bindParam(':expire', $datestamp);
				$stt->bindParam(":uid", $uid);
				$stt->execute();
			}else {
				$stt = $this->_db->prepare('INSERT INTO autologin VALUES(:uid,:key,:expire)');
				$stt->bindParam(':uid', $uid);
				$stt->bindParam(':key', $key);
				$datetmp = date('Y-m-d G:i:s',$expire);
				$stt->bindParam(':expire',$datetmp);
				$stt->execute();
			}
			return $key;
		}else {
			session_set_cookie_params(0);	
		}
	}
	
	public function delAutologin() {
		if (isset($_COOKIE["autoLoginKey"])&&$_COOKIE["autoLoginKey"]!='') {
			$stt = $this->_db->prepare('DELETE FROM autologin WHERE loginkey=:key');
			$stt->bindParam(':key', $_COOKIE["autoLoginKey"]);
			$stt->execute();
			setcookie('autoLoginKey');
			setcookie('autoLoginKey','',time()-60);
		}
	}
	
	public function regNewUser($req)  {
		$stt = $this->_db->prepare('INSERT INTO user (name,passwd,mail,sex,cdate,grade) VALUES(:name,:passwd,:email,:sex,:cdate,:grade)');
		$stt->bindParam(':name', $req["name"]);
		$password = md5($req["passwd"]);
		$stt->bindParam(':passwd',$password);
		$stt->bindParam(':email', $req["email"]);
		$sex = ($req["sex"] == 'Male') ? 0 : 1;
		$stt->bindParam(':sex', $sex);
		$time = date('Y-m-d G:i:s');
		$stt->bindParam(':cdate', $time);
		$stt->bindParam(':grade', $req["grade"]);
		$stt->execute();
		echo "注册成功！";
		$this->delAutologin();
	}
	
}
