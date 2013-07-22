<?php
define('APPLICATION_PATH',str_replace('\\','/',realpath(dirname(__FILE__).'/../')));
require_once 'Zend/View.php';
require_once  APPLICATION_PATH.'/models/expl.tool.class.php';

class NavController extends Zend_Controller_Action{
    function setAction(){
        $tool=new explTool();
        //从数据库获取到所有set
        $setinfo=$tool->getSet();
        
        $setinfo_json=json_encode($setinfo);
        echo $setinfo_json;
    }
    
    function sectionAction(){
        $tool=new explTool();
        //从数据库获取到所有section
        $set=$this->getRequest()->getParam('set');

        $section=$tool->getSection($set); 
        $sectionNo=$tool->getSectionNo($set);
        
        $sectioninfo=array();
//        $sectioninfo['section']=$section;
//        $sectioninfo['sectionnumber']=$sectionNo;
//        $sectioninfo_json=json_encode($sectioninfo);
        $sectioninfo_json=json_encode($section);
        echo $sectioninfo_json;
    }
    
    function qnumberAction(){
         $tool=new explTool();
         $set=$this->getRequest()->getParam('set');
         $section=$this->getRequest()->getParam('section');
         $qnumber=$tool->getQnumber($section, $set);
         echo json_encode($qnumber);
    }
    
    
    function getnavAction(){
        $tool=new explTool();
        //从数据库获取到所有section
        $nav=array();
        $nav1=array();
        $nav2=array();
        $nav3=array();
        $set=$tool->getSet();
       // $nav1['set']=$set;
        for($i=0;$i<count($set);$i++){
           // print_r($set);
            $section=$tool->getSection($set[$i]['set']);
           // $nav2['section']=$section;
            for($j=0;$j<count($section);$j++){
                $qnumber=$tool->getQnumber($section[$j]['section'], $set[$i]['set']);
                //$nav3['question']=$qnumber;
//                $nav1['section'][$section[$j]['section']]=$qnumber;
//                $nav['set'][$set[$i]['set']]=$nav1;
                $nav[$set[$i]['set']][$section[$j]['section']]=$qnumber;
                
            } 
        }   
        
        $nav_json=json_encode($nav);
        echo $nav_json;
    }
}
?>
