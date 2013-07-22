$(document).ready(function(){
		$("#menu").children("li").hover(
			function(){
				$(this).addClass("li_over");
				$(this).next().addClass("li_next_over");
				$(this).children("div").addClass("div_over");
			},
			function(){
				$(this).removeClass("li_over");
				$(this).next().removeClass("li_next_over");
				$(this).children("div").removeClass("div_over");
			}
		);
	});


function changeDiv(s_id){
for(i=1;i<=8;i++){
   if(i==s_id){
    document.getElementById("i"+i).style.display="block"; //内容的样式
   }
   else
   {
    document.getElementById("i"+i).style.display="none"; //内容不显示
    //document.getElementById("m"+i).className="c_0"; //
   }
}
}



function TestBlack(TagName){
             var obj = document.getElementById(TagName);
             if(obj.style.display===""){
                 obj.style.display="none";
             }else{
                 obj.style.display="";
             }
         }
         
         var k=1; 
         function addQuestion() {
             var objDiv = document.getElementById("addQuestion");
             var objStr = "";
             objStr =  '<input type="text" name="id[]"  />' + k+ '<br/><textarea name="text[]" ></textarea><br>';
             objStr+='题号：<input type="text" name=qNo style="width:25px;"/>&nbsp; <div id="divc">题目内容：<textarea  name="qContent"></textarea>  </div> <br/>';
             //alert(objStr);
             objDiv.innerHTML += objStr;
             k=k+1;      
         } 
         
         function updateQuestion(){
             document.getElementById("qform").action="/sachme_zf/admin/updateq";
             document.getElementById("qform").submit();
         }

