<?php
define('APPLICATION_PATH',str_replace('\\','/',realpath(dirname(__FILE__).'/../')));
require_once 'Zend/View.php';
require_once  APPLICATION_PATH.'/models/expl.tool.class.php';
require_once  APPLICATION_PATH.'/models/keywordColor.php';

    class ExplanController extends Zend_Controller_Action{

        //解析按照套题和section查询
       function explanAction(){
           $view = new Zend_View();//view对象的建立
           $view->title = "文章解析";
           $tool=new explTool();//获取数据库工具包
           $page_size=1;//页面大小
              
           $view->set=$this->_getParam('set'); //获取set参数
           $view->section=$this->_getParam('section'); //获取section参数
           $view->page=$this->_getParam('page');//获取page参数
           
           //如果page大于0，则进行下一步处理
           if($view->page){
               $view->question=$tool->getQuestion($view->set,$view->section,$view->page);//得到搜索结果数组
               $view->message_count=$tool->getMessageCount();//得到总共的条目
               $view->page_count=ceil($view->message_count/$page_size);//得到总共的页数
               //获取每个题目的选项，解释还有正确的选项；
               for($i=0;$i<count($view->question);$i++)
               {
                   $view->questionid=$view->question[$i]['questionid'];//得到问题的id
                   $view->questioncontent=$view->question[$i]['question'];//得到问题的内容
                   $essayid=$view->question[$i]['essayid'];
                   $view->choice=$tool->getChoice($view->questionid);//得到所有的选项
                  
                   
                   $view->explanation=$tool->getCorrectExlp($view->questionid,1);//得到正确答案的解析
                   $view->CorrectTag=$tool->getCorrectTag($view->questionid,1); //得到正确选项的题标
                   
                   $view->WrongExplan=$tool->getCorrectExlp($view->questionid,0);
                   $view->WrongTag=$tool->getCorrectTag($view->questionid,0);
                   
                   $EssayContentExplan=$tool->getEssayContentExplan($essayid);
                   $view->EssayContent=$EssayContentExplan[$i]['essay'];
                   $view->EssayExplan=$EssayContentExplan[$i]['explanation'];
                   }
             }
             $view->setScriptPath('./application/views/explan');//设置模板显示路径
             echo $view->render('explan.phtml');//转发到explan.phtml模板
       } 
       
       //关键词进行搜索
       function searchAction(){
             $view = new Zend_View();//view对象的建立
             $view->title = "用关键词搜索";
             $tool=new explTool();
               
             $view->dalei=$this->_getParam('dalei');
             $view->keyword=$this->_getParam('keyword');
             $view->searchsubmit=$this->_getParam('searchsubmit');
             
             $view->result=$tool->getSearchRes($view->dalei, $view->keyword);
             
             
             for ($k=0;$k<count($view->result);$k++)
             {
                 $view->result[$k]['question']=keywordColor::setKeywordColor($view->result[$k]['question'],$view->keyword);
             }

             $view->setScriptPath('./application/views/explan');//设置模板显示路径
             echo $view->render('explan.phtml');
       }
       
       
       //给出一个接口，显示所选择的set.section.qnumber的题目；
       function questionAction(){
             $view = new Zend_View();//view对象的建立
             $view->title = "用关键词搜索";
             $tool=new explTool();
             
             $view->set=$this->getRequest()->getParam('set'); //获取set参数
             $view->section=$this->getRequest()->getParam('section'); //获取section参数
             $view->qnumber=$this->getRequest()->getParam('qnumber');//获取page参数
             
             $result=array();
             //根据题目的set.section.qnumber得到题目的所有内容
             $view->question=$tool->getQuestionBySSQ($view->set, $view->section, $view->qnumber);
             
             
             //如果得到这个题目
             if(count($view->question)){
                 $view->questionid=$view->question[0]['questionid'];//得到问题的id
                 $view->questioncontent=$view->question[0]['question'];//得到问题的内容
                 $essayid=$view->question[0]['essayid'];
                 $view->choice=$tool->getChoice($view->questionid);//得到所有的选项
                  
                   
                 $view->explanation=$tool->getCorrectExlp($view->questionid,1);//得到正确答案的解析
                 $view->CorrectTag=$tool->getCorrectTag($view->questionid,1); //得到正确选项的题标
                 
                 $view->WrongExplan=$tool->getCorrectExlp($view->questionid,0);
                 $view->WrongTag=$tool->getCorrectTag($view->questionid,0);
                 
                 $EssayContentExplan=$tool->getEssayContentExplan($essayid);
                 //$view->EssayContent=$EssayContentExplan[0]['essay'];
                // $view->EssayExplan=$EssayContentExplan[0]['explanation'];
                 
                 
                 $result['question']=$view->question;
                
                 $result['essays']=$EssayContentExplan;
                  $result['choices']=$view->choice;
                 
             }else{//输出空
                 $view->result="sorry,this question doesn't exist in our system!";

             }
             
//             $view->setScriptPath('./application/views/explan');//设置模板显示路径
//             echo $view->render('question.phtml');
           // $view->setScriptPath("".$view->baseUrl()."");//设置模板显示路径
             $result_json=  json_encode($result);
             echo $result_json;
       }
       
       
       
    }
?>