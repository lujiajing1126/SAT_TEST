<?php
define('APPLICATION_PATH',str_replace('\\','/',realpath(dirname(__FILE__).'/../')));
require_once  APPLICATION_PATH.'/models/expl.tool.class.php';
require_once 'Zend/View.php';
require_once 'Zend/Json.php';

    class ListController extends Zend_Controller_Action{
      
         function addlistAction(){
             $view = new Zend_View();

             $view->title = "";
             $tool=new explTool();
             
             
             $session = new Zend_Session_Namespace('satApp');  
             $userid=$session->name;
             $view->userid=$userid;
             $view->label="adsa";
             $listname=$this->getRequest()->getParam('list');
             //$listdescription=$this->getRequest()->getParam('listdescription');
               
             if($userid && $listname){
                $res=$tool->createList($userid, $listname);
                $view->label="Create List Failed1!";
               if($res){
                  $view->label="Create List Succeed!";
               }else{
                  $view->label="Create List Failed2!";
               }
            }else{               
                $view->label="Failed!";
            }
            
            $view->listresult=$tool->getListInfo($userid);
            
            $label_json=json_encode($view->label);
            echo $label_json;
         }
        
         
           function getlistAction(){
            $tool=new explTool();
            $sess = new Zend_Session_Namespace('satApp');
            $userid=$sess->name;
            $listresult=$tool->getListInfo($userid);
            $listresult_json=json_encode($listresult);
            echo $listresult_json;
         }
    }

?>
