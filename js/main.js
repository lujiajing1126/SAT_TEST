function loadtiku(){
	var set= $("input.set").val();
	var section=$("input.section").val();
	var qnumber=$("input.qnumber").val();
	//alert(set);
        $(".questionlistitem").remove();
        $(".questionlistitemselected").remove();
        $("#questiontext").empty();
        $("#passageanalysistext").empty();
        $("#overview").empty();
        $("#number").empty();
        $("#section").empty();
        $("#label11").empty();
        $(".questioncontrol").remove();
        $(".questionlistexp").remove();
        
	$.post("/SAT_TEST/explan/question",{ "set": set,"section":section,"qnumber":qnumber}, 
        function(data){
                //alert(data.question);
        	$.each(data.question,function(i,value){
                        questioncontent=value.question;
        		var qnumber=value.qnumber;
        		var section=value.section;
                        var category=value.category;
                        var questionid=value.questionid;
        	        $("#questiontext").html(questioncontent);
        	        $("#number").html(qnumber); 
        	        $("#section").html(section); 
                        $("#label11").html(category); 
                        $("#returnquestionid").attr("value",questionid);
                        //$("#returnquestionid").text();
                });
                $.each(data.choices,function(i,item){
                        
                        if(item.answer==1){
                        $("#questionanalysis").append(
                                "<div class=\"questionlistitem\" id=\"questionlistitem"+i+"\">"+
                                "<div class=\"questioncorrect\">√</div>"+
                                "<div class=\"questioncontrol\"  id=\"questioncontrol"+i+"1\" onclick=\"questionlistexpand"+i+"1() & resetheight()\" style=\"display:inline;\">+</div>"+
                                "<div class=\"questioncontrol\" id=\"questioncontrol"+i+"2\" onclick=\"questionlistexpand"+i+"2() & resetheight()\" style=\"display:none;\">-</div>"+
                                "<div class=\"questionlisttext\">"+item.choice+"</div>"+
                                "<div class=\"questionlistexp\" id=\"questionlistexp"+i+"\" style=\"height:0px; display:none;\">"+item.explanation+"</div>"+
                                " <div style=\"clear:both;\"></div></div>"
                                );
                        }else{
                        $("#questionanalysis").append(
                                "<div class=\"questionlistitem\" id=\"questionlistitem"+i+"\">"+
                                "<div class=\"questioncontrol\"  id=\"questioncontrol"+i+"1\" onclick=\"questionlistexpand"+i+"1() & resetheight()\" style=\"display:inline;\">+</div>"+
                                "<div class=\"questioncontrol\" id=\"questioncontrol"+i+"2\" onclick=\"questionlistexpand"+i+"2() & resetheight()\" style=\"display:none;\">-</div>"+
                                "<div class=\"questionlisttext\">"+item.choice+"</div>"+
                                "<div class=\"questionlistexp\" id=\"questionlistexp"+i+"\" style=\"height:0px; display:none;\">"+item.explanation+"</div>"+
                                " <div style=\"clear:both;\"></div></div>"
                                );

                        }
                });
                $.each(data.essays,function(i,value){
                        var essaycontent=value.essay;
        		var essayexplan=value.explanation;
        	        $("#overview").html(essaycontent); 
                        $("#passageanalysistext").html(essayexplan); 
                        resetheight();
                });          
                

        },"json");

     
}





function questionlistexpand11() {
var questionlistexp= document.getElementById("questionlistexp1");
var questioncontrol1= document.getElementById("questioncontrol11");
var questioncontrol2= document.getElementById("questioncontrol12");
var questionlistitem= document.getElementById("questionlistitem1");
questionlistexp.style.height="auto";
questionlistexp.style.display="inline";
questioncontrol1.style.display="none";
questioncontrol2.style.display="inline";
questionlistitem.className="questionlistitemselected"
}
function questionlistexpand12() {
var questionlistexp= document.getElementById("questionlistexp1");
var questioncontrol1= document.getElementById("questioncontrol11");
var questioncontrol2= document.getElementById("questioncontrol12");
var questionlistitem= document.getElementById("questionlistitem1");
questionlistexp.style.height="0px";
questionlistexp.style.display="none";
questioncontrol2.style.display="none";
questioncontrol1.style.display="inline";
questionlistitem.className="questionlistitem"
}
function questionlistexpand21() {
var questionlistexp= document.getElementById("questionlistexp2");
var questioncontrol1= document.getElementById("questioncontrol21");
var questioncontrol2= document.getElementById("questioncontrol22");
var questionlistitem= document.getElementById("questionlistitem2");
questionlistexp.style.height="auto";
questionlistexp.style.display="inline";
questioncontrol1.style.display="none";
questioncontrol2.style.display="inline";
questionlistitem.className="questionlistitemselected"
}
function questionlistexpand22() {
var questionlistexp= document.getElementById("questionlistexp2");
var questioncontrol1= document.getElementById("questioncontrol21");
var questioncontrol2= document.getElementById("questioncontrol22");
var questionlistitem= document.getElementById("questionlistitem2");
questionlistexp.style.height="0px";
questionlistexp.style.display="none";
questioncontrol2.style.display="none";
questioncontrol1.style.display="inline";
questionlistitem.className="questionlistitem"
}
function questionlistexpand31() {
var questionlistexp= document.getElementById("questionlistexp3");
var questioncontrol1= document.getElementById("questioncontrol31");
var questioncontrol2= document.getElementById("questioncontrol32");
var questionlistitem= document.getElementById("questionlistitem3");
questionlistexp.style.height="auto";
questionlistexp.style.display="inline";
questioncontrol1.style.display="none";
questioncontrol2.style.display="inline";
questionlistitem.className="questionlistitemselected"
}
function questionlistexpand32() {
var questionlistexp= document.getElementById("questionlistexp3");
var questioncontrol1= document.getElementById("questioncontrol31");
var questioncontrol2= document.getElementById("questioncontrol32");
var questionlistitem= document.getElementById("questionlistitem3");
questionlistexp.style.height="0px";
questionlistexp.style.display="none";
questioncontrol2.style.display="none";
questioncontrol1.style.display="inline";
questionlistitem.className="questionlistitem"
}
function questionlistexpand41() {
var questionlistexp= document.getElementById("questionlistexp4");
var questioncontrol1= document.getElementById("questioncontrol41");
var questioncontrol2= document.getElementById("questioncontrol42");
var questionlistitem= document.getElementById("questionlistitem4");
questionlistexp.style.height="auto";
questionlistexp.style.display="inline";
questioncontrol1.style.display="none";
questioncontrol2.style.display="inline";
questionlistitem.className="questionlistitemselected"
}
function questionlistexpand42() {
var questionlistexp= document.getElementById("questionlistexp4");
var questioncontrol1= document.getElementById("questioncontrol41");
var questioncontrol2= document.getElementById("questioncontrol42");
var questionlistitem= document.getElementById("questionlistitem4");
questionlistexp.style.height="0px";
questionlistexp.style.display="none";
questioncontrol2.style.display="none";
questioncontrol1.style.display="inline";
questionlistitem.className="questionlistitem"
}
function questionlistexpand01() {
var questionlistexp= document.getElementById("questionlistexp0");
var questioncontrol1= document.getElementById("questioncontrol01");
var questioncontrol2= document.getElementById("questioncontrol02");
var questionlistitem= document.getElementById("questionlistitem0");
questionlistexp.style.height="auto";
questionlistexp.style.display="inline";
questioncontrol1.style.display="none";
questioncontrol2.style.display="inline";
questionlistitem.className="questionlistitemselected"
}
function questionlistexpand02() {
var questionlistexp= document.getElementById("questionlistexp0");
var questioncontrol1= document.getElementById("questioncontrol01");
var questioncontrol2= document.getElementById("questioncontrol02");
var questionlistitem= document.getElementById("questionlistitem0");
questionlistexp.style.height="0px";
questionlistexp.style.display="none";
questioncontrol2.style.display="none";
questioncontrol1.style.display="inline";
questionlistitem.className="questionlistitem"
}




function getlist(){
        $(".favoritelistitem").remove();
     	$.post("/SAT_TEST/List/getlist", 
        function(data){
            $.each(data,function(i,value){
                $("#favoritecontainer").append(
                        "<div style=\"clear:both; height:0px;\"></div>"+
                        "<div class=\"favoritelistitem\" id=\"favoritelistitem"+i+"\">"+
                	"<div class=\"favoritelistitemname\"onclick=\"rateitem"+i+"_1;\"value=\""+value.listid+"\">"+value.listname+"</div>"+
                        "<div class=\"favoritelistitemrate3\" id=\"rateitem"+i+"_3\" onclick=\"rateitem"+i+"_3;\" name=\"favoritelistitemrate\">○</div>"+
                        "<div class=\"favoritelistitemrate2\" id=\"rateitem"+i+"_2\" onclick=\"rateitem"+i+"_2;\" name=\"favoritelistitemrate\">○</div>"+
                        "<div class=\"favoritelistitemrate1\" id=\"rateitem"+i+"_1\" onclick=\"rateitem"+i+"_1;\" name=\"favoritelistitemrate\">○</div>"+
                        "</div>"+
                        "<script>"+
			"var favoritelistitem"+i+"= document.getElementById(\"favoritelistitem"+i+"\");\n"+
			"var rateitem"+i+"x1= document.getElementById(\"rateitem"+i+"_1\");\n"+
			"var rateitem"+i+"x2= document.getElementById(\"rateitem"+i+"_2\");\n"+
			"var rateitem"+i+"x3= document.getElementById(\"rateitem"+i+"_3\");\n"+
			"rateitem"+i+"x1.onclick= function rateitem"+i+"_1() {\n"+
			"clearfavoriteselection();\n"+
			"foldername.value=\""+value.listid+"\";\n"+
			"priority.value= \"1\";\n"+
			"rateitem"+i+"x1.innerHTML= \"●\";\n"+
                        "}\n"+
			"rateitem"+i+"x2.onclick= function rateitem"+i+"_2() {\n"+
			"clearfavoriteselection();\n"+
			"foldername.value=\""+value.listid+"\";\n"+
			"priority.value= \"2\";\n"+
			"rateitem"+i+"x1.innerHTML= \"●\";\n"+
			"rateitem"+i+"x2.innerHTML= \"●\";\n"+
			"}\n"+
			"rateitem"+i+"x3.onclick= function rateitem"+i+"_3() {\n"+
			"clearfavoriteselection();\n"+
			"foldername.value= \""+value.listid+"\";\n"+
			"priority.value= \"3\";\n"+
			"rateitem"+i+"x1.innerHTML= \"●\";\n"+
			"rateitem"+i+"x2.innerHTML= \"●\";\n"+
			"rateitem"+i+"x3.innerHTML= \"●\";\n"+
			"}\n"+
			"</script>"                       
                    );
                //alert(value.listname);
            });
            $("#listname");
        },"json");
}


function insertMyquestion(){
        var list=$("#foldername").val();
        var priority=$("#priority").val();
        var questionid=$("#returnquestionid").attr("value");
     	$.post("/SAT_TEST/Myquestion/addquestion",{"list":list,"priority":priority,"questionid":questionid}, 
        function(data){
            //alert(data);
        },"json");
}


function addlist(){
        var list=$("#favoriteadditeminput").val();
     	$.post("/SAT_TEST/list/addlist",{"list":list}, 
        function(data){
            //alert(data);
        },"json");
}





    
 function Navigate(){
       //$("#itemnavigate").remove();
    $.post("/SAT_TEST/Nav/set",{}, 
        function(data){
            $.each(data,function(i,value){
                //alert(value.set);
                $("#itemnavigate").append(
                        "<script>"+
			"var iteminfo"+i+"= \""+value.set+"\";"+
                        "var questionlength= \"\";"+
			"</script>"+
             	        "<div class=\"archiveitem\" onclick=\"itemval= iteminfo"+i+"; selectarchiveitem"+i+"();\">"+
                        "<div class=\"archiveiteminfocon\" name=\"archiveiteminfocon\" onclick=\"clearitem(); clearsection(); this.className= 'archiveiteminfoconactive'\">"+
                	"<div class=\"iteminfoDatecon\"></div>"+
                	"<div class=\"iteminfoM\" id=\"archiveiteminfo"+i+"M\"></div>"+
                	"<div class=\"iteminfoY\" id=\"archiveiteminfo"+i+"Y\"></div>"+
                	"<div class=\"iteminfoL\" id=\"archiveiteminfo"+i+"L\"></div>"+
                        "<script>"+
			"var iteminfo"+i+"_M= document.getElementById(\"archiveiteminfo"+i+"M\");"+
			"var iteminfo"+i+"_Y= document.getElementById(\"archiveiteminfo"+i+"Y\");"+
			"var iteminfo"+i+"_L= document.getElementById(\"archiveiteminfo"+i+"L\");"+
			"iteminfo"+i+"_Y.innerHTML= iteminfo"+i+".substring(0,4);"+
			"iteminfo"+i+"_M.innerHTML= iteminfo"+i+".substring(5,8);"+
			"iteminfo"+i+"_L.innerHTML= iteminfo"+i+".substring(9);"+
			"</script></div>"                       +
                        "<div id=\"archiveitem"+i+"\"  name=\"archiveitem\" style=\"position:absolute; bottom:10px; height:0px; overflow:hidden;\">"+
                        "</div>"+
                        "<script>"+
			"var archiveitem"+i+"= document.getElementById(\"archiveitem"+i+"\");"+
			"function selectarchiveitem"+i+"(){"+
			"archiveitem"+i+".style.height= \"auto\";"+
			"archiveitem"+i+".style.overflow= \"visible\";"+
			"inputitemnum.value= itemval;}"+
			"</script></div>"
                    );  
                        
                        $.post("/SAT_TEST/Nav/section",{"set":value.set}, 
                          function(data1){
                              //alert(data1);
                              $.each(data1,function(j,item){
                                   //alert(item.section) ;
                                   //alert("set="+i);
                                   $("#archiveitem"+i).append(
                                   "<div name=\"archiveitemclick\" style=\"height:20px; overflow:hidden;\" onclick=\"clearsection(); this.style.height='auto'\"><div class=\"archivesection\" name=\"archivesection\" onclick=\"sectionval=this.innerHTML; sectionclick()\">Section "+item.section+"</div>"+
                    	          "<div class=\"archivesectioncon\">"+
                        	  "<div class=\"archivequestioncon\"  >"+  
                                  "<div id=\"archivequestioncon"+i+j+"\"></div>"+
                                  "<div id=\"archivesectionscript"+i+j+"\"></div>"+
                                  "<div style=\"clear:both;\"></div></div></div>"                                           
                                       );
                                           
                                 $.post("/SAT_TEST/Nav/qnumber",{"set":value.set,"section":item.section}, 
                                        function(data2){
                                           //alert(data2);
                                        $.each(data2,function(k,item2){
                                                //alert(item2.qnumber) ;
                                               // alert("qnumber="+k);
                                                $("#archivequestioncon"+i+j).append(
                                                     
                                                     "<div class=\"archivequestion\" id=\"questionnumber"+i+j+k+"\" name=\"archivequestion"+i+j+"\" style=\"background:#c33;\" onclick=\"questionval=this.innerHTML; questionclick();loadtiku(); getquestionlength"+i+j+"()\">"+item2.qnumber+"</div>"
                                                    );    
                                                
                                       });  
                                       $("#archivesectionscript"+i+j).append(
                                   "<script>\n"+
                                   "function getquestionlength"+i+j+"() {\n"+
                                   " var archivequestion"+i+j+"= document.getElementsByName(\"archivequestion"+i+j+"\");\n"+
                                   " questionlength= archivequestion"+i+j+".length; \n"+
                                   
                                   " }"+
                                    "</script>"                                           
                                       );
                                     },"json");          
                                 
                                    
                                    
                              });      
                            },"json");
                          
//                      $.each(value.section,function(j,item){  
//                         alert(item.section)
//                          $("#archiveitem").append(
//                                  "<div name=\"archiveitemclick\" style=\"height:20px; overflow:hidden;\" onclick=\"this.style.height='auto'\"><div class=\"archivesection\" name=\"archivesection\" onclick=\"sectionval=this.innerHTML; sectionclick()\">Section 1</div>"+
//                    	          "<div class=\"archivesectioncon\">"+
//                        	  "<div class=\"archivequestioncon\">"+
//                            	  "<div class=\"archivequestion\" name=\"archivequestion\" style=\"background:#c33;\" onclick=\"questionval=this.innerHTML; questionclick()\">1</div>"+
//                                  "<div style=\"clear:both;\"></div></div>"
//                                  );           
//                });
            });
        },"json");
        

}



