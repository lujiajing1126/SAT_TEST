<?php
define('APPLICATION_PATH',str_replace('\\','/',realpath(dirname(__FILE__).'/../')));
require_once 'Zend/View.php';
require_once  APPLICATION_PATH.'/models/expl.tool.class.php';
require_once  APPLICATION_PATH.'/models/words.class.php';

class AdminController extends Zend_Controller_Action{
	function indexAction()  {
		$s = new MySmarty();
		$s->display('admin/index.tpl');
	}
    
    //整个添加管理部分按照这样的套路，添加文章和添加题目，添加题目则分为两个部分
    //首先判断选择的文章存不存在，如果存在则添加题目并添加文章的ID；否则直接添加题目；
    
    function adminAction(){
        $view = new Zend_View();//view对象的建立
        $view->title = "添加题目";     
        
        $view->setScriptPath('./default/views/admin');//设置模板显示路径
        echo $view->render('admin.phtml');//转发到explan.phtml模板 
    }
    
    function passageAction(){
        $view = new Zend_View();//view对象的建立
        $view->title = "添加文章";
        $tool=new explTool();//获取数据库工具包
       
        //首先生成套题号码，并存入数据库
        $view->year=$this->getRequest()->getParam('year');
        $view->month=$this->getRequest()->getParam('month');
        $view->country=$this->getRequest()->getParam('country');
        
        $set=$view->year.".".$view->month.$view->country;
        $view->set=$set;
        $section=$this->getRequest()->getParam('section');
        $view->section=$section;
       
        $view->label="failed!";//用于判断是否插入成功，插入成则返回success，如果失败则返回failed.
        
        //如果有文章就将文章存入数据库表的essay，获取该文章的Id；
        $ptag=$this->getRequest()->getParam('ptag');
        $pContent=$this->getRequest()->getParam('pContent1');
        $pAnalysis=$this->getRequest()->getParam('pAnalysis1');
        $extendreading=$this->getRequest()->getParam('extendreading');
        
        //添加文章进入essay表中；
        if($pContent&&$pAnalysis){ 
            //将文章下面的题目都存入数据库，同时将得到的文章id存入question
            $essayid=$tool->insertPassage($set,$section,$ptag,$pContent, $pAnalysis,$extendreading);
            if($essayid!=0){
                $view->label="Success!";
            }
        }
        
        $view->setScriptPath('./default/views/admin');//设置模板显示路径
        echo $view->render('passage.phtml');//转发到explan.phtml模板   
    }
    
    function questionAction(){
        $view = new Zend_View();//view对象的建立
        $view->title = "添加文章";
        $tool=new explTool();//获取数据库工具包
        //
        //首先生成套题号码，并存入数据库
        $view->year=$this->getRequest()->getParam('year');
        $view->month=$this->getRequest()->getParam('month');
        $view->country=$this->getRequest()->getParam('country');
        
        $set=$view->year.".".$view->month.$view->country;
        $view->set=$set;
        $section=$this->getRequest()->getParam('section');
        $view->section=$section;
       
        $view->label="failed!";//用于判断是否插入成功，插入成则返回success，如果失败则返回failed.
        
        //如果有文章就将文章存入数据库表的essay，获取该文章的Id；
        $ptag=$this->getRequest()->getParam('ptag');
        $view->ptag=$ptag;
        
        $words=$this->getRequest()->getParam('words');
        $after_p_words=words::patition($words);
        
        
        //获取页面传过来的题目信息；
        $view->category=$this->getRequest()->getParam('category');
        $category=$view->category[0];
        for($i=1;$i<count($view->category);$i++){
            $category.="|".$view->category[$i];        
        }
        
        $type=$this->getRequest()->getParam("qtype");
        
        $qNo=$this->getRequest()->getParam('qNo');
        $view->qNo=$qNo;
        
        $question=$this->getRequest()->getParam('qContent');
        
        $answer=$this->getRequest()->getParam('answer');
        $choiceA=$this->getRequest()->getParam('choiceA');
        $choiceB=$this->getRequest()->getParam('choiceB');
        $choiceC=$this->getRequest()->getParam('choiceC');
        $choiceD=$this->getRequest()->getParam('choiceD');
        $choiceE=$this->getRequest()->getParam('choiceE');
        
        $Aanalysis=$this->getRequest()->getParam('Aanalysis');
        $Banalysis=$this->getRequest()->getParam('Banalysis');
        $Canalysis=$this->getRequest()->getParam('Canalysis');
        $Danalysis=$this->getRequest()->getParam('Danalysis');
        $Eanalysis=$this->getRequest()->getParam('Eanalysis');     
        
        //首先查看文章类型是否选择，如果没有选择则直接进行题目的插入
        if($ptag!="None"){
            $essayid=$tool->getEssayid($set, $section, $ptag);
        if($essayid!=0){
                //获得了essayid,此时可以插入题目了；
                //将题目内容，题目解析，题目set,section以及题目所对应的文章id存入数据，同时得到题目的id
                $questionid=$tool->insertQuestion($question, $essayid, $set, $section, $category,$qNo, $type,$after_p_words);                
                $count=$tool->checkChoiceNum($questionid);                
                if($count){
                //得到题目之后就将题目的选项全部插入数据库，插入成功就返回success;
                $tool->insertChoices("A", $answer, $choiceA, $Aanalysis, $questionid);
                $tool->insertChoices("B", $answer, $choiceB, $Banalysis, $questionid);
                $tool->insertChoices("C", $answer, $choiceC, $Canalysis, $questionid);
                $tool->insertChoices("D", $answer, $choiceD, $Danalysis, $questionid);
                $tool->insertChoices("E", $answer, $choiceE, $Eanalysis, $questionid);
                
                $view->label="success!";
                //return $label;
                }
                
            }else{//如果没有没有文章，就直接存题目就OK啦；
              $view->label="failed!";
            }
        }else{
              if($question&&$qNo){
                    $questionid=$tool->insertQuestion($question, NULL, $set, $section, $category,$qNo,$type,$after_p_words);
                    $count=$tool->checkChoiceNum($questionid);
                    if($count){//得到题目之后就将题目的选项全部插入数据库，插入成功就返回success;
                        $tool->insertChoices("A", $answer, $choiceA, $Aanalysis, $questionid);
                        $tool->insertChoices("B", $answer, $choiceB, $Banalysis, $questionid);
                        $tool->insertChoices("C", $answer, $choiceC, $Canalysis, $questionid);
                        $tool->insertChoices("D", $answer, $choiceD, $Danalysis, $questionid);
                        $tool->insertChoices("E", $answer, $choiceE, $Eanalysis, $questionid);  
                        $view->label="success!";}
                        else { $view->label="failed!"; }
                        }else{ $view->label="failed!";}
        }
        
        
        
        
        //如果填写了文章，则先获取到文章的id，再进行插入！
       
        $view->setScriptPath('./default/views/admin');//设置模板显示路径
        echo $view->render('question.phtml');//转发到explan.phtml模板   
    }
    
    
    
    function addAction(){
        $view = new Zend_View();//view对象的建立
        $view->title = "添加题目";
        $tool=new explTool();//获取数据库工具包
        //
        //首先生成套题号码，并存入数据库
        $view->year=$this->getRequest()->getParam('year');
        $view->month=$this->getRequest()->getParam('month');
        $view->country=$this->getRequest()->getParam('country');
        
        $set=$view->year.".".$view->month.$view->country;
        $view->set=$set;
        $section=$this->getRequest()->getParam('section');
        $view->section=$section;
       
        $view->label="failed!";//用于判断是否插入成功，插入成则返回success，如果失败则返回failed.
        
        //如果有文章就将文章存入数据库表的essay，获取该文章的Id；
        $ptag=$this->getRequest()->getParam('ptag');
        $pContent=$this->getRequest()->getParam('pContent');
        $pAnalysis=$this->getRequest()->getParam('pAnalysis');
        
        $view->category=$this->getRequest()->getParam('category');
        $category='';
        for($i=0;$i<count($view->category);$i++){
            $category.=$view->category[$i].";";        
        }
        
        $qNo=$this->getRequest()->getParam('qNo');
        $view->qNo=$qNo;
        
        $question=$this->getRequest()->getParam('qContent');
        
        $answer=$this->getRequest()->getParam('answer');
        $choiceA=$this->getRequest()->getParam('choiceA');
        $choiceB=$this->getRequest()->getParam('choiceB');
        $choiceC=$this->getRequest()->getParam('choiceC');
        $choiceD=$this->getRequest()->getParam('choiceD');
        $choiceE=$this->getRequest()->getParam('choiceE');
        
        $Aanalysis=$this->getRequest()->getParam('Aanalysis');
        $Banalysis=$this->getRequest()->getParam('Banalysis');
        $Canalysis=$this->getRequest()->getParam('Canalysis');
        $Danalysis=$this->getRequest()->getParam('Danalysis');
        $Eanalysis=$this->getRequest()->getParam('Eanalysis');     
        
        
        
        
        
        if($pContent&&$pAnalysis){ 
          //将文章下面的题目都存入数据库，同时将得到的文章id存入question
            $essayid=$tool->insertPassage($set,$section,$ptag,$pContent, $pAnalysis);
            if($essayid!=0){
                //插入成功，并获得了essayid,此时可以插入题目了；
                //将题目内容，题目解析，题目set,section以及题目所对应的文章id存入数据，同时得到题目的id
                $questionid=$tool->insertQuestion($question, $essayid, $set, $section, $category,$qNo);
                
                $count=$tool->checkChoiceNum($questionid);
                
                if($count){
                //得到题目之后就将题目的选项全部插入数据库，插入成功就返回success;
                $tool->insertChoices("A", $answer, $choiceA, $Aanalysis, $questionid);
                $tool->insertChoices("B", $answer, $choiceB, $Banalysis, $questionid);
                $tool->insertChoices("C", $answer, $choiceC, $Canalysis, $questionid);
                $tool->insertChoices("D", $answer, $choiceD, $Danalysis, $questionid);
                $tool->insertChoices("E", $answer, $choiceE, $Eanalysis, $questionid);
                
                $view->label="success!";
                //return $label;
                }
                
            }else{//文章存入数据库失败     
                $view->label="failed!";
            }          
           //接下来要将文章                
        }else{
          //如果没有没有文章，就直接存题目就OK啦；
          if($question&&$qNo){
          $questionid=$tool->insertQuestion($question, NULL, $set, $section, $category,$qNo);
          
          $count=$tool->checkChoiceNum($questionid);
          
          if($count){
          //得到题目之后就将题目的选项全部插入数据库，插入成功就返回success;
          $tool->insertChoices("A", $answer, $choiceA, $Aanalysis, $questionid);
          $tool->insertChoices("B", $answer, $choiceB, $Banalysis, $questionid);
          $tool->insertChoices("C", $answer, $choiceC, $Canalysis, $questionid);
          $tool->insertChoices("D", $answer, $choiceD, $Danalysis, $questionid);
          $tool->insertChoices("E", $answer, $choiceE, $Eanalysis, $questionid);  
          
          $view->label="success!";}
          else { $view->label="failed!"; }
          
          }else{
              $view->label="failed!";
          }
          $view->label="failed!";
        }
        
        $view->label="failed!";
        $view->setScriptPath('./default/views/admin');//设置模板显示路径
        echo $view->render('add.phtml');//转发到explan.phtml模板  
     
    }
    
    //更新题目
    function updateqAction(){
         $view = new Zend_View();//view对象的建立
        $view->title = "添加文章";
        $tool=new explTool();//获取数据库工具包
        //
        //首先生成套题号码，并存入数据库
        $view->year=$this->getRequest()->getParam('year');
        $view->month=$this->getRequest()->getParam('month');
        $view->country=$this->getRequest()->getParam('country');
        
        $set=$view->year.".".$view->month.$view->country;
        $view->set=$set;
        $section=$this->getRequest()->getParam('section');
        $view->section=$section;
       
        $view->label="failed!";//用于判断是否插入成功，插入成则返回success，如果失败则返回failed.
        
        //如果有文章就将文章存入数据库表的essay，获取该文章的Id；
        $ptag=$this->getRequest()->getParam('ptag');
        $view->ptag=$ptag;
        
        
        //获取页面传过来的题目信息；
        $view->category=$this->getRequest()->getParam('category');
        $category='';
        for($i=0;$i<count($view->category);$i++){
            $category.=$view->category[$i].";";        
        }
        
        $qNo=$this->getRequest()->getParam('qNo');
        $view->qNo=$qNo;
        
        $question=$this->getRequest()->getParam('qNo').".".$this->getRequest()->getParam('qContent');
        
        $answer=$this->getRequest()->getParam('answer');
        $choiceA=$this->getRequest()->getParam('choiceA');
        $choiceB=$this->getRequest()->getParam('choiceB');
        $choiceC=$this->getRequest()->getParam('choiceC');
        $choiceD=$this->getRequest()->getParam('choiceD');
        $choiceE=$this->getRequest()->getParam('choiceE');
        
        $Aanalysis=$this->getRequest()->getParam('Aanalysis');
        $Banalysis=$this->getRequest()->getParam('Banalysis');
        $Canalysis=$this->getRequest()->getParam('Canalysis');
        $Danalysis=$this->getRequest()->getParam('Danalysis');
        $Eanalysis=$this->getRequest()->getParam('Eanalysis');     
        
        //首先查看文章类型是否选择，如果没有选择则直接进行题目的插入
        if($ptag!="None"){
            $essayid=$tool->getEssayid($set, $section, $ptag);
        if($essayid!=0){
                //获得了essayid,此时可以插入题目了；
                //将题目内容，题目解析，题目set,section以及题目所对应的文章id存入数据，同时得到题目的id
                $questionid=$tool->insertQuestion($question, $essayid, $set, $section, $category,$qNo);                
                $count=$tool->checkChoiceNum($questionid);                
                if($count){
                //得到题目之后就将题目的选项全部插入数据库，插入成功就返回success;
                $tool->insertChoices("A", $answer, $choiceA, $Aanalysis, $questionid);
                $tool->insertChoices("B", $answer, $choiceB, $Banalysis, $questionid);
                $tool->insertChoices("C", $answer, $choiceC, $Canalysis, $questionid);
                $tool->insertChoices("D", $answer, $choiceD, $Danalysis, $questionid);
                $tool->insertChoices("E", $answer, $choiceE, $Eanalysis, $questionid);
                
                $view->label="success!";
                //return $label;
                }
                
            }else{//如果没有没有文章，就直接存题目就OK啦；
              $view->label="failed!";
            }
        }else{
              if($question&&$qNo){
                    $questionid=$tool->insertQuestion($question, NULL, $set, $section, $category,$qNo);
                    $count=$tool->checkChoiceNum($questionid);
                    if($count){//得到题目之后就将题目的选项全部插入数据库，插入成功就返回success;
                        $tool->insertChoices("A", $answer, $choiceA, $Aanalysis, $questionid);
                        $tool->insertChoices("B", $answer, $choiceB, $Banalysis, $questionid);
                        $tool->insertChoices("C", $answer, $choiceC, $Canalysis, $questionid);
                        $tool->insertChoices("D", $answer, $choiceD, $Danalysis, $questionid);
                        $tool->insertChoices("E", $answer, $choiceE, $Eanalysis, $questionid);  
                        $view->label="success!";}
                        else { $view->label="failed!"; }
                        }else{ $view->label="failed!";}
        }         
    }
    
    //更新文章
    function updatepAction(){
        $view = new Zend_View();//view对象的建立
        $view->title = "添加文章";
        $tool=new explTool();//获取数据库工具包
       
        //首先生成套题号码，并存入数据库
        $view->year=$this->getRequest()->getParam('year');
        $view->month=$this->getRequest()->getParam('month');
        $view->country=$this->getRequest()->getParam('country');
        
        $set=$view->year.".".$view->month.$view->country;
        $view->set=$set;
        $section=$this->getRequest()->getParam('section');
        $view->section=$section;
        
        
       
        $label="Update failed!";//用于判断是否插入成功，插入成则返回success，如果失败则返回failed.
        
        //如果有文章就将文章存入数据库表的essay，获取该文章的Id；
        $ptag=$this->getRequest()->getParam('ptag');
        $view->pContent=$this->getRequest()->getParam('pContent');
        $view->pAnalysis=$this->getRequest()->getParam('pAnalysis');
        //添加文章进入essay表中；
        if($view->pContent&&$view->pAnalysis){ 
            //将文章下面的题目都存入数据库，同时将得到的文章id存入question
            $count=$tool->updatePassage($set, $section, $ptag, $view->pContent, $view->pAnalysis);
            
            if($count!=0){
                $label=" Update success!";
            }
        }
        
      echo  $label;         
        
    }
    
    //删除题目
    function deleteqAction(){
        
    }
    
    //删除文章
    function deletepAction(){
        
    }
    
}

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
