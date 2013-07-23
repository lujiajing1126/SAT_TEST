<?php
require_once  'pdo.class.php';
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


class explTool{
    
    private $set=''; //第set道题目;
    private $section=''; //第几个section;
    private $page='';//第几页;
    private $page_size=1;//每页的数目
    private $message_count;
    private $page_count;
     
    //获取题目
    function   getQuestion($set,$section,$page){
        $sql="select questionid,essayid,question from question where question.set=? and question.section=? ";  
       //得到$pdo对象；
        $pdo=mypdo::getPdo();
        
        $stmt = $pdo->prepare($sql);
        $exeres = $stmt->execute(array($set, $section)); 
        if ($exeres) {
            $this->message_count= $stmt->rowCount();           
            //echo "....". $this->message_count;
            $this->page_count=ceil($this->message_count/$this->page_size);
	    $offset=($page-1)*$this->page_size;
            //echo "....".$page;
           // echo "....".$offset;
            $sql1="select questionid,essayid,question from question where question.set='".$set."' and question.section='".$section."' limit ".$offset.",".$this->page_size."";
      
            $sth = $pdo->prepare($sql1);
            $sth->execute();
            $result = $sth->fetchAll();  
            
            return $result;
            //echo $result;
        }else{
         return ''; 
        }  
   }
   
   //获取总的题目数量
   function getMessageCount(){   
   return $this->message_count;
   }
      
   //获取选项
   function getChoice($questionid){  
       //得到$pdo对象；
       $pdo=mypdo::getPdo();
       $sql="select choice,explanation,answer from choice where choice.questionid=?"; 
       $sth = $pdo->prepare($sql);
       $sth->execute(array($questionid));
       $choice = $sth->fetchAll(); 
       return $choice;
   }
   
   //根据essayid获取题目内容及其解析；
   function getEssayContentExplan($essayid){
       $pdo=mypdo::getPdo();
       $sql="select essay.essay,explanation,extendreading from essay where essay.essayid=?"; 
       $sth = $pdo->prepare($sql);
       $sth->execute(array($essayid));
       $ContentExplan = $sth->fetchAll(); 
       return $ContentExplan;
       
   }
   
   //获取正确的解析
   function getCorrectExlp($questionid,$answer){
       $pdo=mypdo::getPdo();
       $sql="select explanation from choice where choice.questionid=? and answer=?"; 
       $sth = $pdo->prepare($sql);
       $sth->execute(array($questionid,$answer));
       $explanation = $sth->fetchAll(); 
       //print_r($explanation);
       return $explanation; 
   }
   
  
   
   //获取正确解析的选项部分。
      function getCorrectTag($questionid,$answer){
       $pdo=mypdo::getPdo();
       $sql="select choice from choice where choice.questionid=? and answer=?"; 
       $sth = $pdo->prepare($sql);
       $sth->execute(array($questionid,$answer));
       $explanation = $sth->fetchAll();
       //print_r($explanation);
       //echo $explanation[0]['choice'];
       if(count($explanation)){
       $CorrectTag=$explanation['0']['choice'];
       $pos=stristr($CorrectTag,"(")+1;
       $CorrectTag=substr($CorrectTag,$pos,1);
          return $CorrectTag; 
       }else{return '';}
       //print_r($explanation)
   }
   
   //获取关键词查询结果
   function getSearchRes($dalei,$keyword){
       $pdo=mypdo::getPdo();
       $result=array();
       if($keyword){
       if($dalei=="题目"){
           $sql1="select questionid,essayid,question from question where question like '%".$keyword."%';";
           $sth = $pdo->prepare($sql1);
           $sth->execute();
           $result = $sth->fetchAll();         
          // print_r($result);
           return $result;
       }else if($dalei=="类别"){
           $sql1="select questionid,essayid,question from question where category like '%".$keyword."%';";
           $sth = $pdo->prepare($sql1);
           $sth->execute();
           $result = $sth->fetchAll();         
           //print_r($result);
           return $result;
       }
       //按照文章搜索不应该在这里！
       //else if($dalei=="文章内容"){
//        $sql1="select questionid,essayid,question from question where catagory like '%".$keyword."%';";
//        $sth = $pdo->prepare($sql1);
//           $sth->execute();
//           $result = $sth->fetchAll();         
//           //print_r($result);
//           return $result;
//       }
       }else 
           $result=array("0"=>array("question"=>null));
           return $result;
       }
       
       
       //将文章存入数据库，并返回文章ID
       function insertPassage($set,$section,$ptag,$pContent,$pAnalysis,$extendreading){
          $pdo=mypdo::getPdo();
          //如果数据库中已经存在该文章和解析，就不执行插入，直接得到这个ID；
          $sql="select essayid from essay where essay.set=? and essay.section=? and essay.ptag=?";
          $sth = $pdo->prepare($sql);
          $sth->execute(array($set,$section,$ptag));
          $essayid = $sth->fetchAll(); //一般来说，id应该只能得到一个，但要要是得到多个
          //print_r($essayid);
          if(count($essayid)){
             return $essayid[0]['essayid']; 
          }else{
              //否则代表数据库中不存在这个id，则将内容插入数据库；
              $sql1=" insert into essay(`set`,`section`,`ptag`,`essay`,`explanation`,`extendreading`) values ('".$set."','".$section."','".$ptag."','".$pContent."','".$pAnalysis."','".$extendreading."');";
              $count=$pdo->exec($sql1); //影响行数；  
              if($count){//插入成功
                  $sql2="select essayid from essay where essay.set=? and essay.section=? and essay.ptag=?";
                  $sth = $pdo->prepare($sql2);
                  $sth->execute(array($set,$section,$ptag));
                  $essayid = $sth->fetchAll(); //一般来说，id应该只能得到一个，但要要是得到多个
                  return $essayid[0]['essayid'];
          }else{
              //插入文章失败；
              return 0;             
          }                     
         }
       }
       
       
       //将题目插到数据库，返回这个题目的id
       function insertQuestion($question,$essayid,$set,$section,$category,$qNo,$type,$words){
          $pdo=mypdo::getPdo();
          //如果数据库中已经存在该文章和解析，就不执行插入，直接得到这个ID；
          $sql="select questionid from question where question.set=? and question.section=? and question.qnumber=?;";        
          $sth = $pdo->prepare($sql);
          $sth->execute(array($set,$section,$qNo));
          $questionid = $sth->fetchAll(); //一般来说，id应该只能得到一个，但要要是得到多个
          if(count($questionid)){
             return $questionid[0]['questionid']; 
             //print_r($questionid);
          }else{
              //否则代表数据库中不存在这个id，则将内容插入数据库；
              $sql1="insert into question(`question`,`essayid`,`set`,`section`,`category`,`qnumber`,`type`,`words`) values('".$question."','".$essayid."','".$set."','".$section."','".$category."','".$qNo."','".$type."','".$words."');";    
              $count=$pdo->exec($sql1); //影响行数；  
              //echo $count;
              if($count){//插入成功
                  $sql2="select questionid from question where question.set=? and question.section=? and question.qnumber=?;";      
                  $sth = $pdo->prepare($sql2);
                  $sth->execute(array($set,$section,$qNo));
//                  $sql2="select questionid from question where question.set=? and question.section=? and question.qnumber=?;";      
//                  $sth = $pdo->prepare($sql2);
//                  $sth->execute(array($set,$section,$qNo));
                  $questionid = $sth->fetchAll(); //一般来说，id应该只能得到一个，但要要是得到多个
                  //print_r($questionid);
                  //if(count($questionid)){
                  //echo $questionid['0']['questionid']; 
                  return $questionid['0']['questionid']; 
                  //}else return 0;
                  
                  }else{
                   //插入文章失败；
                   return 0;                    
                  }                     
         } 
       }
       
       
       
       //插入选项
       function insertChoices($cTag,$answer,$choice,$analysis,$questionid){
          $pdo=mypdo::getPdo();
          if($answer==$cTag){
              $sql1="insert into choice(`choice`,`questionid`,`explanation`,`answer`) values('".$choice."','".$questionid."','".$analysis."',1);";    
              $count=$pdo->exec($sql1); //影响行数； 
               //echo   $count;                
              }  else {
               $sql2="insert into choice(`choice`,`questionid`,`explanation`,`answer`) values('".$choice."','".$questionid."','".$analysis."',0);";    
               $count=$pdo->exec($sql2); //影响行数； 
               //echo  $count; 
           }                  
       }
       
       //查看已有选项的个数，如果是超过五个则
       function checkChoiceNum($questionid){
            $pdo=mypdo::getPdo();
            $sql="select choiceid from choice where choice.questionid=?;";        
            $sth = $pdo->prepare($sql);
            $sth->execute(array($questionid));
          
            $choiceid = $sth->fetchAll(); //一般来说，id应该只能得到一个，但要要是得到多个
            $count=count($choiceid);
           // echo "已有选项个数：".$count;
            if($count>=5){
                return 0;            
            }else {
                return 1;
            }
       }
       
       
      //通过用户Id得到用户的listid和listname;
       function getListInfo($userid){
            $pdo=mypdo::getPdo();
            $sql="select listid,listname from mylist where mylist.userid=?;";        
            $sth = $pdo->prepare($sql);
            $sth->execute(array($userid));
            
            $listresult=$sth->fetchAll();
            return $listresult;  
       }
       
       
       
        //通过得到的sessionid得到其收藏的题目Id；同时获取一个题目列表。
       function getMyQuestionId($listid,$orderby){
            $pdo=mypdo::getPdo();
            $sql="select questionid,addtime from myquestion where myquestion.listid=? order by ".$orderby.";";        
            $sth = $pdo->prepare($sql);
            $sth->execute(array($listid));
            
            $myquestionid=$sth->fetchAll();
            return $myquestionid;         
       }
       
       //获取收藏夹题目信息；
       function getMyQuestionInfo($myquestionid){
            $pdo=mypdo::getPdo();
            $sql="select questionid,question.set,section,qnumber,category from question where question.questionid=?;";
            //$sql1="select set,section,qnumber,category from question where question.questionid=?;"; 
            $sth = $pdo->prepare($sql);
            $sth->execute(array($myquestionid));
            
            $myquestioninfo=$sth->fetchAll();
            return $myquestioninfo;     
       }
       
       
       //删除收藏夹题目；
       function deleteMyquestion($myquestionid,$userid){
           $pdo=mypdo::getPdo();
           $sql="DELETE FROM myquestion WHERE questionid =? and userid=? ";
           $sth = $pdo->prepare($sql);
           $bool=$sth->execute(array($myquestionid,$userid)); 
           return $bool;
       }
       
       
       //根据set/section/ptag获取到这篇文章的essayid
       function getEssayid($set,$section,$ptag){
           $pdo=mypdo::getPdo();
           $sql="select essayid from essay where essay.set=? and section=? and ptag=?;";  
           $sth = $pdo->prepare($sql);
           $sth->execute(array($set,$section,$ptag));        
           
           $essayid=$sth->fetchAll();
           if(count($essayid)){
               return $essayid[0]['essayid'];
           }else{
               return 0;
           }             
       }
       
       //向我的错题本里面加入错题
       function insertMyquestion($userid,$questionid,$listid,$priority){
           $pdo=mypdo::getPdo();
           $sql="select userid,questionid,listid from myquestion where myquestion.userid=? and myquestion.questionid=? and myquestion.listid=?";
           $sth = $pdo->prepare($sql);
           $sth->execute(array($userid,$questionid,$listid));
           $res = $sth->fetchAll(); 
           if(count($res)){
               return 0;
           }else{
               $sql2="insert into myquestion(`userid`,`questionid`,`listid`,`priority`) values('".$userid."','".$questionid."','".$listid."','".$priority."');";    
               $count=$pdo->exec($sql2); //影响行数
               return $count;
          }
       }
       
       
       //加入List
       function createList($userid,$listname){
           $pdo=mypdo::getPdo();
           $sql="select userid,listname from mylist where mylist.userid=? and mylist.listname=?;";
           $sth = $pdo->prepare($sql);
           $sth->execute(array($userid,$listname));
           $res = $sth->fetchAll(); 
           if(count($res)){
               return 0;
           }else{
               $sql2="insert into mylist(`userid`,`listname`) values('".$userid."','".$listname."');";  
               $count=$pdo->exec($sql2); //影响行数
               return $count;
           }   
       }
       
       function getList($userid,$listname){
           $pdo=mypdo::getPdo();
           $sql="select userid,listname,listid from mylist where mylist.userid=? and mylist.listname=?;";
           $sth = $pdo->prepare($sql);
           $sth->execute(array($userid,$listname));
           $list= $sth->fetchAll(); 
           return $list;           
       }
       
       
       //根据题目的set.section.qnumber得到题目的所有内容
       function getQuestionBySSQ($set,$section,$qnumber){
           $pdo=mypdo::getPdo();
           $sql="select essayid,questionid,question,qnumber,section,category,words from question where question.set=? and section=? and qnumber=?;";  
           $sth = $pdo->prepare($sql);
           $sth->execute(array($set,$section,$qnumber)); 
           
           $questioninfo=$sth->fetchAll();
           
          // print_r($questioninfo);
           return $questioninfo; 
       }
       
       function updateList($questionid,$listid,$priority,$userid){
           $pdo=mypdo::getPdo();
           $sql="update myquestion set listid='".$listid."',priority='".$priority."'  where questionid='".$questionid."' and userid='".$userid."'";
           $count=$pdo->exec($sql); 
           return $count;         
       }
       
       
       function updatePassage($set,$section,$ptag,$pContent, $pAnalysis){
           $pdo=mypdo::getPdo();
           $sql="update essay set essay.essay='".$pContent."',explanation='".$pAnalysis."' where essay.set='".$set."' and section='".$section."' and ptag='".$ptag."'";
           $count=$pdo->exec($sql); 
           
           //echo $count."<br>";
           return $count;    
       }
       
       
       //获取到set的数目和所有的set的值
       function getSet(){
           $pdo=mypdo::getPdo();
           $sql=" select distinct question.set  from question;";
           $sth = $pdo->prepare($sql);
           $sth->execute();          
           $setinfo=$sth->fetchAll();
           return $setinfo;
       }
       
       function getSection($set){
           $pdo=mypdo::getPdo();
           $sql=" select distinct question.section from question where question.set=?;";
           $sth = $pdo->prepare($sql);
           $sth->execute(array($set));          
           $sectioninfo=$sth->fetchAll();
           return $sectioninfo;
       }
       
       function getQnumber($section,$set){
           $pdo=mypdo::getPdo();
           $sql=" select distinct question.qnumber,question.category from question where question.set=? and question.section=? order by qnumber;  ";
           $sth = $pdo->prepare($sql);
           $sth->execute(array($set,$section));          
           $qinfo=$sth->fetchAll();
           return $qinfo;     
       }
       function getSectionNo($set){
           $pdo=mypdo::getPdo();
           $sql=" select count(distinct question.section) AS sectionnumber from question where question.set=?;";
           $sth = $pdo->prepare($sql);
           $sth->execute(array($set));          
           $sectioninfo=$sth->fetchAll();
           return $sectioninfo;
       }
       
       
       
   }
  
		

?>
