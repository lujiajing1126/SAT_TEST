<?php

class Query  {
	private $_db;
	public function __construct()  {
		$this->_db = DbManager::getConnection();
	}
	
	public function __destruct()  {
		$this->_db->closeConnection();
	}
	
	public function getUserinfo($req)  {
		$stt = $this->_db->prepare("SELECT * FROM user WHERE name=:name");
		$stt->bindParam(':name', $req["name"]);
		$stt->execute();
		$result = $stt->fetchAll();
		$json = json_encode($result);
		return $json;
	}
	
	public function getList($req)  {
		switch ($req["order"])  {
			case 'AddTime':
				$order = "myquestion.addtime";
				break;
			case 'Priority':
				$order = "myquestion.priority";
				break;
			case 'Category':
			default:
				$order = "question.category";
		}
		$sqladd = "";
		$list=$req["list"];
		if ($list != null || $list!='') {
			$sqladd = " And myquestion.listid = :list";
		}
		$sql = "SELECT DISTINCT myquestion.userid,myquestion.addtime,myquestion.listid,myquestion.priority,myquestion.questionid,question.questionid,question.essayid,question.question,question.`set`,question.section,question.qnumber,question.category FROM myquestion ,question WHERE myquestion.userid = :name AND question.questionid = myquestion.questionid".$sqladd." ORDER BY :order ASC";
		$stt = $this->_db->prepare($sql);
		$stt->bindParam(':name', $req["name"]);
		$stt->bindParam(':order', $order);
		if ($list != NULL) {
			$stt->bindParam(':list', $list);;
		}
		$stt->execute();
		$result = $stt->fetchAll();
		$json = json_encode($result);
		return $json;
	}
	
	public function getSet()  {
		$sql = "SELECT `set`,section,qnumber FROM question ORDER BY `set` ASC,section ASC,qnumber ASC;";
		$stt = $this->_db->prepare($sql);
		$stt->execute();
		$result = $stt->fetchAll();
		return $result;
	}
}