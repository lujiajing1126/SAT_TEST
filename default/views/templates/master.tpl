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
<!-- 加载页面js脚本 -->
<script type="text/javascript" src="/{$APPNAME}/js/loading.js"></script>
<script type="text/javascript" src="/{$APPNAME}/js/ajax.js"></script>
<script type="text/javascript" src="/{$APPNAME}/js/logincontrol.js"></script>
<script type="text/javascript" src="/{$APPNAME}/js/main.js"></script>
<script type="text/javascript" src="/{$APPNAME}/js/toolbar.js"></script>
<script type="text/javascript" src="/{$APPNAME}/js/ucpcontrol.js"></script>
<script type="text/javascript" src="/{$APPNAME}/js/colheightctrl.js"></script>
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

</head>
    
<body oncontextmenu="return false" >
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
	<div class="headercontainer" id="headercon">
		<div class="ucpblock" id="ucpblock">
			<div class="container" style="height: 100%;">
				{if $flg eq TRUE}
				<span style="cursor: pointer">
					<a href="/{$APPNAME}/auth/logout">Logout</a>
				</span>
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
							<div class="ucpbutton2" onclick="loadctb()">My Error List</div>
							<div class="ucpbutton" onclick="loadrightcol()">Manage My Account</div>
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
				<div class="navLogo">
					<img src="/{$APPNAME}/img/Logo_beta.png" />
				</div>
				<a>调试信息：{$information}</a>
				<div class="navbut" onclick="loginexpand()">
					<li style="font-weight: 700;">LOGIN</li>
				</div>
				<div class="navbut">
					<li>SACH DOCS</li>
				</div>
				<div class="navbut" >
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
						onclick="registerexpand()">Do not have a account?</div>
					<div class="logincaption" id="caption2" style="display: none;"
						onclick="registerhide()">Already have a account?</div>
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
<section name="toolbox">
    
    <div style="position:absolute; width:100%; padding-top:160px;"><div class="container">
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
							rateitem.item(i).innerHTML= "○";
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
		<div class="container" style="width:80%; padding-top:30px; line-height:22px;">
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
                <input class="buttonsmally" type="button" value="Add to Favorite" onclick="insertMyquestion(); favorite_ctrl();"></input>
                <div style="clear:both; height:30px;"></div>
            </div>
      	</div>
   	</div>
</div></div>
<div class="toolboxcon"><div class="container">
        <div class="toolboxbutL" style="background:#c33; color:#fff;"><span style="font-size:22px; font-weight:bold;" id="number">01</span>&nbsp; <span style="font-size:10px">Section </span><span style="font-size:10px;" id="section">1</span>&nbsp; <span style="font-size:10px;" id="label11" > Label 01</span></div>
    <div class="toolboxbutL" onclick="prevquestion()">Prev</div>
    <div class="toolboxbutL" onclick="nextquestion()">Next</div>
    <div class="toolboxbutL" id="originaltextbutton" onclick="originaltext_ctrl();">Original Text</div>
    <div class="toolboxbutR" id="favoritebutton" style="background:#ffdb17; color:#333;" onclick="getlist() & favorite_ctrl();"><span style="font-size:18px;"><i class="icon-plus-circled"></i> Favorite</span></div>
    <div class="toolboxbutR">Extended Reading</div>
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
                var questionval0= 0;
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
       
        
              <div id="textscrollbar" style="display:none;">
		<div class="scrollbar" id="scrollbarcon"><div class="track" id="scrollbartrack"><div class="thumb"><div class="end"></div></div></div></div>
		<div class="viewport" id="viewport">
		<div class="overview" id="overview"></div>               
                </div>
              </div> </div>
        
    	<div class="questionrightcon" id="questionrightcon">
            <div id="questionanalysis">
            <div style="clear:both; height:20px;"></div>
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
<script type="text/javascript">  
$("#loading").fadeOut("slow");
</script>
</body>
                                                        
<!--<div id="script">

</div>-->
                                                        
<script>
window.onload= resetheight() & ucpcontrol() & Navigate();
</script>
                                                        

</html>
