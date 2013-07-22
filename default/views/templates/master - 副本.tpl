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

<link rel="icon" type="/image/ico" href="/{$APPNAME}/favicon.ico">

</head>
<body oncontextmenu="return false">
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
					<img src="/{$APPNAME}/img/logo_beta.png" />
				</div>
				调试信息：{$information}
				<div class="navbut" onclick="loginexpand()">
					<li style="font-weight: 700;">LOGIN</li>
				</div>
				<div class="navbut">
					<li>SACH DOCS</li>
				</div>
				<div class="navbut">
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
<div class="toolboxcon"><div class="container">
        <div class="toolboxbutL" style="background:#c33; color:#fff;"><span style="font-size:22px; font-weight:bold;" id="number">01</span>&nbsp; <span style="font-size:10px">Section </span><span style="font-size:10px;" id="section">1</span>&nbsp; <span style="font-size:10px;" id="label11" > Label 01</span></div>
    <div class="toolboxbutL">Prev</div>
    <div class="toolboxbutL">Next</div>
    <div class="toolboxbutL" id="originaltextbutton" onclick="originaltext_ctrl()">Original Text</div>
    <div class="toolboxbutR" style="background:#ffdb17; color:#333;"><span style="font-size:18px;"><i class="icon-plus-circled"></i> Favorite</span></div>
    <div class="toolboxbutR">Extended Reading</div>
    <div class="toolboxbutR">Vocabulary</div>
    <div class="toolboxbutR">Passage Analysis</div>
</div></div>
</section>
    
<section name="question">
<div class="container" style="padding-top:175px;">
<div class="choose">
第<input type="text" class="set" value="2013.Jan.NorthAmerica"/>套题
SECTION<input type="text" class="section" value="2"/>
题号<input type="text" class="qnumber" value="7"/>
<button onclick="loadtiku()"  value="submit" >submit</button>
</div>
    	<div class="questionleftcon" id="questionleftcon">
            <div id="archivecontainer" style="display:none;">
		<div class="scrollbar" id="scrollbarcon2"><div class="track" id="scrollbartrack2"><div class="thumb"><div class="end"></div></div></div></div>
		<div class="viewport" id="viewport2">
			 <div class="overview">2test text<br>alskjfkltest text<br>alskjfkltest text<br>alskjfkltest text<br>alskjfkltest text<br>alskjfkltest text<br>alskjfkltest text<br>alskjfkltest text<br>alskjfkltest text<br>alskjfkltest text<br>alskjfkltest text<br>alskjfkltest text<br>alskjfkltest text<br>alskjfkltest text<br>alskjfkltest text<br>alskjfkltest text<br>alskjfkl<br>alskjfkltest text<br>alskjfkltest text<br>alskjfkltest text<br>alskjfkltest text<br>alskjfkltest text<br>alskjfkltest text<br>alskjfkltest text</div>
             </div>
            </div>
              <div id="textscrollbar">
		<div class="scrollbar" id="scrollbarcon"><div class="track" id="scrollbartrack"><div class="thumb"><div class="end"></div></div></div></div>
		<div class="viewport" id="viewport">
		<div class="overview" id="overview"></div>               
                </div>
              </div>
        </div>
    	<div class="questionrightcon" id="questionrightcon">
           
            <div style="clear:both; height:20px;"></div>
            <div class="questiontext"></div>
            <div style="clear:both; height:20px;"></div>

        </div>
    </div>
</section>
<script type="text/javascript">  
$("#loading").fadeOut("slow");
</script>
</body>

<script>
window.onload= resetheight() & ucpcontrol();

</script>
</html>
