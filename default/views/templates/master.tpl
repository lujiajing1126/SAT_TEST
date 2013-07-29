<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Sachme</title>
<!-- 加载css -->
<link rel="stylesheet" rev="stylesheet" href="/{$APPNAME}/css/main.css" stype="text/css" media="all" />
<link rel="stylesheet" href='http://fonts.googleapis.com/css?family=PT+Sans+Caption:400,700' type='text/css'>
<link rel="stylesheet" href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,300italic,400italic,600italic' type='text/css'>
<link rel="stylesheet" href="/{$APPNAME}/css/common.css">
<link rel="stylesheet" href="/{$APPNAME}/css/animation.css">
<!--[if IE 7]>
<link rel="stylesheet" href="/{$APPNAME}/css/common-ie7.css"><![endif]-->

<!-- 加载jquery库文件和插件 -->
<script type="text/javascript" src="/{$APPNAME}/js/lib/jquery.min.js"></script>
<script type="text/javascript" src="/{$APPNAME}/js/lib/jquery.mpage.js"></script>
<script type="text/javascript" src="/{$APPNAME}/js/lib/jquery.tinyscrollbar.min.js"></script>
<script type="text/javascript" src="/{$APPNAME}/js/lib/require.js" defer async="true" ></script>
<!-- 加载页面js脚本 -->
<script type="text/javascript" src="/{$APPNAME}/js/loading.js"></script>
<script type="text/javascript" src="/{$APPNAME}/js/logincontrol.js"></script>
<script type="text/javascript" src="/{$APPNAME}/js/main.js"></script>
<script type="text/javascript" src="/{$APPNAME}/js/toolbar.js"></script>
<script type="text/javascript" src="/{$APPNAME}/js/ucpcontrol.js"></script>
<script type="text/javascript" src="/{$APPNAME}/js/colheightctrl.js"></script>
<script type="text/javascript" src="/{$APPNAME}/js/ajax.js"></script>
<script>

</script>
<!-- 运行js脚本 -->
<script type="text/javascript">
	$(document).ready(function(){
	$('#textscrollbar').tinyscrollbar();	
	});
        
</script>

<script type="text/javascript">
		$(document).ready(function(){
			$('#archivecontainer').tinyscrollbar();	
		});
</script>

<link rel="icon" type="/image/ico" href="/{$APPNAME}/favicon.ico">
    <script>
      function toggleCodes(on) {
        var obj = document.getElementById('icons');
        
        if (on) {
          obj.className += ' codesOn';
        } else {
          obj.className = obj.className.replace(' codesOn', '');
        }
      }   
    </script>
<script>
function questioncontrol()
{
        if (window.event.keyCode==37)
        {
        prevquestion();
        }
        if(window.event.keyCode==39)
        {
        nextquestion();
        }
}
</script>

</head>

<body onkeydown=questioncontrol()>
<!--<body oncontextmenu="return false" >-->
    <div class="popupbackground" id="popupbg0" style="height:0px;" onclick="extendedreading_ctrl()"></div>
	<div class="popupcontainer" id="popupcontainer0" style="z-index:5; display:none;">
    	<div id="extreadingcontainer">
		<div class="scrollbar" id="scrollbarcon3"><div class="track" id="scrollbartrack3"><div class="thumb"><div class="end"></div></div></div></div>
		<div class="viewport" id="viewport3">
			 <div class="overview" id="overview3">
             
             </div>
        </div>
        </div>
        </div>
    </div>


<div id="loading"><div id="loading-gif"></div></div>
	<div id="itemMenu" style="display: none">
		<table border="1" width="100%" height="100%" bgcolor="#cccccc"
			style="border: thin" cellspacing="0">
			<tr>
				<td style="cursor: default; border: outset 1;" align="center"
					onclick="parent.create()">creat row</td>
			</tr>
			<tr>
				<td style="cursor: default; border: outset 1;" align="center"
					onclick="parent.update();">modify row</td>
			</tr>
			<tr>
				<td style="cursor: default; border: outset 1;" align="center"
					onclick="parent.del();">delete row</td>
			</tr>
		</table>
	</div>
	<section name="header">
	<div class="headercontainer" {if $flg eq TRUE}id="headercon"{else}{/if} >
		<div class="ucpblock" id="ucpblock">
			<div class="container" style="height: 100%;">
				{if $flg eq TRUE}
				<div style="text-align:center;"><span style="text-align:center; cursor:default;">
					Hover to Expand Your Profile Console
				</span></div>
				{else}
				<span style="cursor: pointer" onclick="loginexpand()">Login</span>
				&nbsp | &nbsp
				<span style="cursor: pointer" onclick="loginexpandreg()">Register</span>
				{/if} {if $flg eq TRUE}
				<div class="ucpcontentcon">
					<div class="ucpleftcol">
						<div class="ucpavatar"
							style="background: url(/{$APPNAME}/img/users/{$imgsrc}) center center no-repeat;">
							<div class="ucpusername">{$username}</div>
						</div>
						<div style="padding-top: 210px;">
							<div class="ucpbutton2" onclick="loadctb()"><i class="icon-folder"></i> My Folders</div>
							<div class="ucpbutton" onclick="loadrightcol()"><i class="icon-menu"></i>Manage My Account</div>
						</div>
					</div>

					<div class="ucprightcol">
						<!-- 错题本 -->
					</div>
				</div>
				{/if}
			</div>
		</div>
		<div class="navcontainer" id="navcon">
			<div class="container" style="z-index: 3;">
				<div class="navLogo" onclick="toolbarclear(); showuserguide();">
					<img src="/{$APPNAME}/img/Logo_beta.png" />
				</div>
				<!--调试信息：{$information}-->
                                {if $flg eq TRUE}
				<a href="/{$APPNAME}/auth/logout"><div class="navbut">
					<li style="font-weight: 700;">LOGOUT</li>
				</div></a>
                                    
                                {else}
                                <div class="navbut" onclick="loginexpand()">
					<li style="font-weight: 700;">LOGIN</li>
				</div>
                                {/if}
				<div class="navbut">
					<li>SACH DOCS</li>
				</div>
				<div class="navbut" onclick="toolbarclear(); showuserguide();">
					<li>HOME</li>
				</div>
				<div style="clear: both"></div>
			</div>
		</div>
		<div class="container" style="padding-top: 110px;">
			<div class="logincontainer" id="logincon" style="height: 0px;">
				<div class="logincaption" id="caption0" style="display: inline;"
					onclick="loginhide()">CLOSE</div>
				<div class="loginbox" id="loginbox">
					<div class="container"
						style="width: 80%; padding-top: 80px; line-height: 12px;">
						<form name="login" action="/{$APPNAME}/auth/process" method="post">
							<input class="login" type="text" placeholder="username" name="user" />
							<br>						
							<br>							
							<input class="login" type="password" placeholder="password" name="passwd" />
							<br>
							<br>						
							<input type="hidden" name="persistent" value="1" />
							<input class="buttonsmall" type="submit" value="Login"></input>
						</form>
					</div>
				</div>
				<div class="registerbox" id="registerbox" style="height: 40px;">
					<div class="logincaption" id="caption1" style="display: inline;"
						onclick="registerexpand()">Do not have an account?</div>
					<div class="logincaption" id="caption2" style="display: none;"
						onclick="registerhide()">Already have an account?</div>
					<div class="container"
						style="width: 80%; padding-top: 80px; line-height: 12px;">
						<form name="login" action="/{$APPNAME}/auth/register">
							<input class="buttonsmall" type="submit" value="Register"></input>
						</form>
					</div>
				</div>

			</div>
		</div>
	</div>
	</section>
{if $flg eq TRUE}
<section name="toolbox">
    
    <div style="position:fixed; width:100%; padding-top:160px; z-index:3;"><div class="container">
	<div class="favoritecontainer" id="favoritecon" style="height:0px;">
            <div class="favoritebox" id="favoritebox">
           	

               	<form name="favorite" style="display:none">
	                <input type="text" id="foldername" />
	                <input type="text" id="priority" />                   
                </form>
                <script>
					var rateitem= document.getElementsByName("favoritelistitemrate")
					var i=0;
					function clearfavoriteselection() {
						for (i=0;i<rateitem.length;i++){
							rateitem.item(i).innerHTML= "<i class='icon-star-empty'></i>";
						}
					}
				</script>
                <script>
					var foldername= document.getElementById("foldername");
					var priority= document.getElementById("priority");
				</script>
                <!-- item start -->
                <div class="container" id="favoritecontainer" style="width:80%; padding-top:30px; line-height:22px;">            
                </div>
                <!-- item end -->
                <div class="container" style="width:80%; padding-top:10px; line-height:22px;">
                <div style="clear:both; height:5px;"></div>
                <div class="favoriteadditem">
                	<form id="favoriteadditem" style="display:none;">
                    <input class="favoriteadditeminput" id="favoriteadditeminput" type="text" placeholder="folder name" />
                    <input class="favoriteadditembutton"  type="button" value="Submit" id="favoriteadditemclick" onclick="favoriteadditemaction();addlist();getlist();"/>
                    </form>
                    <span id="favoriteadditemblock" onclick="favoriteadditemaction()">add a New Folder</span>
                    <script>
						var favoriteadditemclick= document.getElementById("favoriteadditemclick");
						var favoriteadditem= document.getElementById("favoriteadditem");
						var favoriteadditemblock= document.getElementById("favoriteadditemblock");
						function favoriteadditemaction() {
							if (favoriteadditem.style.display=="none") {
								favoriteadditem.style.display="block";
								favoriteadditemblock.style.display="none";
							}
							else {
								favoriteadditem.style.display="none";
								favoriteadditemblock.style.display="block";
							}
						}
					</script>
                </div>
                </div>

                <div style="clear:both; height:25px;"></div>
                <input class="buttonsmally" type="button" value="Add to Favorite" onclick="insertMyquestion(); favorite_ctrl(); loadctb();"></input>
                <div style="clear:both; height:30px;"></div>
            </div>
      	</div>
   	</div>
</div></div>
<div class="toolboxcon"><div class="container">
        <div class="toolboxbutLlabel" id="toolboxbutLlabel" style="background:#3389ca; color:#fff;" name="toolboxquestionlabel" onclick="toolbarclear(); showuserguide();"><div style="position:relative; left:0px; text-align:left; "><span id="labelnull" style="font-size:18px; font-weight:400;">Select a Question</span><span style="font-size:22px; font-weight:bold;" id="number" ></span></div><div style="position:relative; top:-30px; left:30px; line-height:11px; text-align:left; padding-right:30px;"><span style="font-size:10px;" id="section"></span>&nbsp; <br><span style="font-size:10px;" id="label11" ></span></div></div>
    <div class="toolboxbutL" onclick="prevquestion()">Prev</div>
    <div class="toolboxbutL" onclick="nextquestion()">Next</div>
    <div class="toolboxbutL" id="originaltextbutton" onclick="originaltext_ctrl();">Original Text</div>
    <div class="toolboxbutR" id="favoritebutton" style="background:#ffdb17; color:#333;" onclick="getlist() & favorite_ctrl();"><span style="font-size:18px;"><i class='icon-star'></i> Favorite</span></div>
    <div class="toolboxbutR" id="extendedreadingbutton" onclick="extendedreading_ctrl()">Extended Reading</div>
    <div class="toolboxbutR" >Vocabulary</div>
    <div class="toolboxbutR" id="passageanalysisbutton" onclick="passageanalysis_ctrl()">Passage Analysis</div>
</div></div>
</section>
    
<section name="question">
<div class="container" style="padding-top:175px;">
<div class="choose" style="display:none;">
第<input type="text" class="set" id="inputitemnum" value="2013.Jan.NorthAmerica"/>套题
SECTION<input type="text" class="section" id="inputsectionnum" value="0"/>
题号<input type="text" class="qnumber" id="inputquestionnum" value="0"/>
<button onclick="loadtiku();"  value="submit" >submit</button>
<input type="hidden" id="returnquestionid" value="" />
</div>
    	<div class="questionleftcon" id="questionleftcon">
		<div id="archivecontainer">
		<div class="scrollbar" id="scrollbarcon2"><div class="track" id="scrollbartrack2"><div class="thumb"><div class="end"></div></div>		</div></div>
		<div class="viewport" id="viewport2">
			<div class="overview" id="overview2">
             	<script>
			 	var inputitemnum= document.getElementById("inputitemnum");
				var archivesection= document.getElementById("archivesection");
				var archivequestion= document.getElementById("archivequestion");
				var iteminfo00= "2013.Jan.North America";
				var itemval= "";
				var sectionval= "";
				var questionval= "";
                                var questionval0= 0
			 </script>
             	<!--item start-->
				<div id="itemnavigate"></div>
             <!--item end-->
                        
             
                         <script>
			 	var inputitemnum= document.getElementById("inputitemnum")
				var inputsectionnum= document.getElementById("inputsectionnum")
				var inputquestionnum= document.getElementById("inputquestionnum")
			 </script>
             <script type="text/javascript" src="/{$APPNAME}/js/archivecontrol.js"></script>
                </div>
                </div>

         
             </div>
       
        
              <div id="textscrollbar" style="display:none; font-family:georgia;">
		<div class="scrollbar" id="scrollbarcon"><div class="track" id="scrollbartrack"><div class="thumb"><div class="end"></div></div></div></div>
		<div class="viewport" id="viewport">
		<div class="overview" id="overview"></div>               
                </div>
              </div> </div>
        
    	<div class="questionrightcon" id="questionrightcon">
            <div id="questionanalysis">
            <ol id="userguide" style="text-align:left; font-size:16px;"><li>Please use <span style="color:rgb(51, 137, 202)"><strong>Chrome Browser</strong> </span>to open this site. The website functions are not guaranteed to be viable by other web browsers.</li><br><li>Please be patient after your first log-in. The website engine requires much resource to process. Restart your browser if slow request respond affects your user experience</li><br><li>Click on <strong>Jan 2013</strong> to start your journey!</li><br><li>Create your personal wrong collections by clicking <span style="color:rgb(255, 215, 0)"><strong>Favorite</strong></span> on top right side. Hover on top blue column to view personal records.</li><br><li>Meet an error? Ask <span style="color:rgb(51, 137, 202)"><strong>info@sachme.com</strong></span> for any support!</li></ol>
            <div id="questiontext" class="questiontext"></div>
            <div style="clear:both; height:20px;"></div>
            </div>
            <div id="passageanalysis" style="display:none;">
            <div style="clear:both; height:20px;"></div>
            <div id="passageanalysistext" class="questiontext" style="font-size:15px; line-height:22px;"></div>
            <div style="clear:both; height:20px;"></div>
            </div>
        </div>
    </div></div></div>
</section>
{else}
<div id="indexbgimg" style="position:absolute; background:url(/{$APPNAME}/img/slider/slider0.jpg) center center no-repeat; background-size:cover; width:100%; height:100%;">
	<div class="container" style="padding-top:15%;">
    	<div style="float:right; width:380px; color:#fff;">
        	<div style="font-size:40px; font-weight:400; line-height:42px; text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.7);">An Integrated <br>SAT Review Platform</div>
            <div style="font-size:20px; font-weight:400; line-height:26px; padding-top:20px; color:#fff; text-shadow: 0.5px 0.5px 3px rgba(0, 0, 0, 0.4);">SACH powers your review process by solving critical needs and providing never-imagined functions.</div>
            <div style="clear:both; height:30px;"></div>
            	<input class="buttonsmall" type="button" style="width:80%; background:#3389ca; -webkit-box-shadow:0px 0px 4px 1px rgba(0,0,0,0.2); -moz-box-shadow:0px 0px 4px 1px rgba(0,0,0,0.2); box-shadow:0px 0px 4px 1px rgba(0,0,0,0.2);" value="Register Now!" onclick="loginexpandreg()" />
			
        </div>
        <div style="clear:both; height:10px"></div>
    </div>
</div>
<div style="position:relative;clear:both; height:650px; z-index:-1;"></div>
{/if}
{if $flg eq TRUE}
<section name="footer">
<div style="clear:both; height:10px"></div>
<div class="footer" style="font-size:12px;">
	<div class="container">
		<div style="float:left; width:30%; text-align:center;">
    		<span style="font-size:24px; font-weight:bold; line-height:20px;">SACH<br><br></span><span style="font-size:14px; line-height:24px;">SACH is an integrated SAT review platform that aims to provide essential support, optimize study efficiency and revolutionize preparation method for those who long for excellence.</span>
    	</div>
        <div style="float:right; width:18%; padding:0 2% 0 2%; border-left:1px solid #999; text-align:center;">
    		<span style="font-size:24px; font-weight:bold; line-height:20px;">Join!<br><br></span><span style="font-size:14px; line-height:24px;">Inspired by SACH’s endeavor and hope to join? Enjoy flexible working pace and terrific working environment! Email us at <strong><em>info@sachme.com</em></strong>.</span>
    	</div>
        <div style="float:right; width:18%; padding:0 2% 0 2%; border-left:1px solid #999; text-align:center;">
    		<span style="font-size:24px; font-weight:bold; line-height:20px;">Terms<br><br></span><span style="font-size:14px; line-height:24px;">All content in this site may not be copied, reproduced, republished, distributed, or used for the creation of derivative works without SACH's prior written consent.</span>
    	</div>
        <div style="float:right; width:18%; padding:0 2% 0 2%; border-left:1px solid #999; text-align:center;">
    		<span style="font-size:24px; font-weight:bold; line-height:20px;">Talk to us<br><br></span><span style="font-size:14px; line-height:24px;">Any talk about website content or function? Email us at <strong><em>info@sachme.com</em></strong>.<br><br><br></span>
    	</div>
        
	</div>
</div>
<div class="subfooter">
	<div class="container" style="line-height:35px;">
    	<div style="float:right;">© 2013 SACH. All Rights Reserved.</div>
        <div style="float:left;">info@sachme.com</div>
    </div>
</div>

</section>
{/if}

<script type="text/javascript">  
$("#loading").fadeOut("slow");
</script>

</body>
                                                        
<!--<div id="script">

</div>-->
                                                        
<script>
function ColminHeight() {
	var leftcol= document.getElementById("questionleftcon");
	var rightcol= document.getElementById("questionrightcon");
	var resetminHeight= window.innerHeight-240+"px";
	leftcol.style.minHeight= resetminHeight;
	rightcol.style.minHeight= resetminHeight;
}
function showpriority() {
var itempriority= document.getElementsByName("itempriority");
for (i=0;i<itempriority.length;i++){
	switch (itempriority.item(i).innerHTML) {
		case "1":
			itempriority.item(i).innerHTML= "<i class='icon-star'></i>"; 
		break;
		case "2":
			itempriority.item(i).innerHTML= "<i class='icon-star'></i><i class='icon-star'></i>";
		break;
		case "3":
			itempriority.item(i).innerHTML= "<i class='icon-star'></i><i class='icon-star'></i><i class='icon-star'></i>";
		break;
	}
}
}
function showuserguide() {
	var userguide= document.getElementById("userguide");
	userguide.innerHTML="<li>Please use <span style='color:rgb(51, 137, 202)'><strong>Chrome Browser</strong> </span>to visit this site. The website functions are not guaranteed to be viable by other web browsers.</li><br><li>Please be patient after your first log-in. The website engine requires much resource to process. Restart your browser if slow request respond affects your user experience</li><br><li>Click on <strong>Jan 2013</strong> to start your journey!</li><br><li>Create your personal wrong collections by clicking <span style='color:rgb(255, 215, 0)'><strong>Favorite</strong></span> on top right side. Hover on top blue column to view personal records.</li><br><li>Meet an error? Ask <span style='color:rgb(51, 137, 202)'><strong>info@sachme.com</strong></span> for any support!</li>";
		$(".questionlistitem").remove();
		$(".questionlistitemcor").remove();
        $(".questionlistitemselected").remove();
		$(".questionlistitemcorselected").remove();
        $("#questiontext").empty();
        $("#passageanalysistext").empty();
        $("#overview").empty();
        $("#number").empty();
        $("#section").empty();
        $("#label11").empty();
        $(".questioncontrol").remove();
        $(".questionlistexp").remove();
		toolboxbutLlabel.style.background= "#3389ca";
		$("#number").html("");
		$("#section").html("");
		$("#label11").html("");
		$("#labelnull").html("Select a Question");
	resetheight();
}
window.onload=  ColminHeight() & resetheight() & ucpcontrol() & Navigate(); showuserguide();


</script>
                                                        

</html>
