<?php
require_once 'Zend/Controller/Action.php';
require_once APP_PATH.'/default/models/Query.class.php';
require_once APP_PATH.'/default/models/expl.tool.class.php';

class QueryController extends Zend_Controller_Action  {
	function getuserAction()  {
		$s = new MySmarty();
		$sess = new Zend_Session_Namespace('satApp');
		if($sess->isLogined)  {
		$query = new Query();
		$name = $sess->name;
		$str = array("name"=>$name);
		$json = $query->getUserinfo($str);
		$s->assign('json_result',$json);
		$s->display('query/result.tpl');
		}
	}
	
	function listAction()  {
		$s = new MySmarty();
		$query = new Query();
		$sess = new Zend_Session_Namespace('satApp');
		$name = $sess->name;
		$order = $this->getRequest()->getParam('order');
		$list = $this->getRequest()->getParam('list');
		$str = array("name"=>$name,"order"=>$order,"list"=>$list);
		$json = $query->getList($str);
		$s->assign('json_result',$json);
		$s->display('query/result.tpl');
	}
	
	function showlistAction(){
		$tool=new explTool();//获取数据库工具包
	
		$session = new Zend_Session_Namespace('satApp');
		//$session->username = $this->getRequest()->getParam('username');
	
		//获取的session的内容
		$username = $session->name;

		//获取到List的内容，如果为空则页面不显示任何内容
		$listresult=$tool->getListInfo($username);
		$list_json=json_encode($listresult);
		//下面这一步只有在list不为空的情况下才做的；
		echo $list_json;
	}
	
	function makexmlAction()  {
		$s = new MySmarty();
		$query = new Query();
		$listarray = $query->getSet();
		$arrayset = array();
		$array2 =array();
		$j = 0;$k = 0;
		$tmp = array();
		for($i=0;$i<count($listarray);$i++)  {
			$arrayset[$j] = $listarray[$i]["set"];
			if ($k == 0) {
				$array2[$arrayset[$j]] = array();
				$k=1;
			}
			$str = "section".$listarray[$i]['section'];
			array_push($tmp,$listarray[$i]['qnumber']);
			$array2[$arrayset[$j]][$str] = $tmp;
			if($i != count($listarray)-1){
				if($listarray[$i+1]["set"] != $listarray[$i]["set"])  {
					$j++;
					$tmp = array();
					$k=0;
				}
				if($listarray[$i+1]['section'] != $listarray[$i]['section']) {
					$tmp = array();
				}
			}
			
		}
		echo json_encode($array2);
		
	}
}

