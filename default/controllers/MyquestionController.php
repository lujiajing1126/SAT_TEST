<?php
define('APPLICATION_PATH',str_replace('\\','/',realpath(dirname(__FILE__).'/../')));
require_once 'Zend/View.php';
require_once  APPLICATION_PATH.'/models/expl.tool.class.php';
require_once  APPLICATION_PATH.'/models/keywordColor.php';

    class MyquestionController extends Zend_Controller_Action{
        
        function showAction(){
            $view = new Zend_View();//view对象的建立
            $view->title = "收藏夹题目";
            $tool=new explTool();//获取数据库工具包
            
            $session = new Zend_Session_Namespace('username');
            //$session->username = $this->getRequest()->getParam('username');
            
            //获取的session的内容
            //$view->userid=$session->username;
            $view->userid=$session->username;;
            
            //获取到List的内容，如果为空则页面不显示任何内容
            $view->listresult=$tool->getListInfo($view->userid);
            
            //下面这一步只有在list不为空的情况下才做的；
            if(count($view->listresult)){
                //根据用户名获取到他的list
                $view->listid=$this->getRequest()->getParam('list');
                $view->orderby=$this->getRequest()->getParam('orderby');
                         
                //如果list为空，或者oderby为空的时候,啥也不干              
                if($view->listid&&$view->orderby){
                    //根据List获取到questionid,然后获取该题目的基本信息，例如set/section/qnumber/category
                    $view->myquestionid=$tool->getMyQuestionId($view->listid, $view->orderby);
                
                    //如果myquestionid不为空，则得到了基本的问题信息；

                    //根据获取的questionid得到question的基本信息；
                   $view->myquestioninfo=array();
                   $view->myquestionAddtime=array();
                   for($i=0;$i<count($view->myquestionid);$i++){
                       $view->myquestioninfo[$i]=$tool->getMyQuestionInfo($view->myquestionid[$i]['questionid']);
                       $view->myquestionAddtime[$i]=$view->myquestionid[$i]['addtime'];
                       $view->json = Zend_Json::encode($view->myquestioninfo[$i]);
                   }               
                }                        
            }
            $view->setScriptPath('./application/views/myquestion');
            echo  $view ->render('show.phtml');           
        }
        
        
         function deleteAction(){
            $view = new Zend_View();//view对象的建立
            $view->title = "删除题目";
            $tool=new explTool();//获取数据库工具包
            
            $view->myquestionid=$this->getRequest()->getParam('questionid');
            
            $session = new Zend_Session_Namespace('username');
            $view->userid=$session->username; //"$session->username;"
            
            $res=$tool->deleteMyquestion($view->myquestionid, $view->userid);
            if($res){
                $view->deleteRes="删除成功;";
            }else{
                $view->deleteRes="删除失败;";
            }
            
            $list=$this->getRequest()->getParam('list');
            $orderby=$this->getRequest()->getParam('orderby');
            
           // $view->setScriptPath('./application/views/myquestion');
           // echo  $view ->render('show.phtml');    
            
            $this->_redirect('/Myquestion/show?list='. $list.'&orderby='.$orderby.'');  
         }
         
         
         

         
         //将题目添加到错题本,
         function addquestionAction(){
            //把选择的问题添加到错题本 
            $tool=new explTool();//获取数据库工具包
            
            $session = new Zend_Session_Namespace('satApp');
            $userid=$session->name;  //获取的session的内容   
            
            $listid=$this->getRequest()->getParam('list');
            $priority=$this->getRequest()->getParam("priority");
            $questionid=$this->getRequest()->getParam("questionid");
            $label="";
            
            if($userid&&$listid&&$priority&&$questionid){
                $res=$tool->insertMyquestion($userid, $questionid, $listid, $priority);
               $label="Add to Mylist Failed!";
               if($res){
                  $label="Add to Mylist Succeed!";
               }else{
                  $label="Add to Mylist Failed!";
               }
            }else{               
                $label="Failed!";
            }   
            echo json_encode($label);
         }
        
         
         //edit错题本，修改题目的错题本。
         
         
         
         //将所有选择的题目都加入错题本，一次性的添加，这个时候是添加到默认的错题本default
         function addallAction(){
            $view = new Zend_View();//view对象的建立
            $view->title = "添加题目";
            $tool=new explTool();//获取数据库工具包
            
            $view->set=$this->getRequest()->getParam('set'); //获取set参数
            $view->section=$this->getRequest()->getParam('section'); //获取section参数
            $view->qnumber=$this->getRequest()->getParam('qnumber');//获取qnumber参数
            $session = new Zend_Session_Namespace('username');
            $view->userid=$session->username;  //获取的session的内容    
            
            //首先创建一个default列表，如果存在就不再创建，同时得到listid
            $listname="default";
            $listdescription="This is the default list!";
            if($view->userid){
                $res=$tool->createList($view->userid, $listname, $listdescription);
                $view->Listlabel="Create Default List Failed!";
               if($res){
                  $view->Listlabel="Create Default List Succeed!";
               }else{
                  $view->label="Create Default List Failed!";
               }
            }else{               
                $view->label="Failed!";
            }
   
            //创建完成之后就可以将所有的题目都存入数据库了,先获得questionid和userid
            if($view->userid){
                $list=$tool->getList($view->userid, $listname);
                $listid=$list[0]['listid'];
                for($i=0;$i<count($view->qnumber);$i++){
                    $questionid=$tool->getQuestionBySSQ($view->set, $view->section, $view->qnumber[$i]);
                    if(count($questionid)){
                        $res=$tool->insertMyquestion($view->userid, $questionid[0]['questionid'], $listid, NULL); 
                    }
                }  
            }
            
            $view->setScriptPath('./application/views/myquestion');
            echo  $view ->render('addall.phtml');    
         }
         
         
         function editAction(){
            $view = new Zend_View();//view对象的建立
            $view->title = "编辑题目";
            $tool=new explTool();//获取数据库工具包
            $session = new Zend_Session_Namespace('username');
            $view->userid=$session->username;  //获取的session的内容   
            $view->listresult=$tool->getListInfo($view->userid);//获取到List的内容，如果为空则页面不显示任何内容
                        
            $view->listid=$this->getRequest()->getParam('list');
            $view->priority=$this->getRequest()->getParam("priority");
            $view->questionid=$this->getRequest()->getParam("questionid");
            
            if($view->questionid&&$view->priority&&$view->listid&&$view->userid){
                $res=$tool->updateList($view->questionid, $view->priority, $view->listid,$view->userid);
              if($res){
                $view->deleteRes="编辑成功;";
              }else{
                $view->deleteRes="编辑失败;";
            }
            }
            $view->setScriptPath('./application/views/myquestion');
            echo  $view ->render('edit.phtml'); 
            
             
         }
         
         

         
         
         
         
         
         
        
    }

?>
