<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" >
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<meta http-equiv="Content-Style-Type" content="text/css">
<meta http-equiv="Content-Script-Type" content="text/javascript">
<title>����11111</title>
<meta name="keywords" content="{$smarty.session.myApp.keywords}" />
<meta name="description" content="{$smarty.session.myApp.description}" />
<link rel="stylesheet" type="text/css" href="{$base}/css/entry_base.css"/>
<script type="text/javascript"	src="{$base}/js/CheckUtil.js"></script>
{literal}
<script type="text/javascript"><!--


	function checkCookie(){
		if(!chk()){
			return false;
		}
		if (!navigator.cookieEnabled ) { alert("�뽫�������Cookie����Ϊ��Ч��");return false; }
		document.all.regform.submit();
		return true;
	}
	function chk(){
		var c = new CheckUtil();
		c.requiredCheck(document.fm.uid.value, '�û���');
		c.lengthCheck(document.fm.uid.value,20, '�û���');
		c.regExCheck(document.fm.uid.value,'[0-9a-zA-Z-_&]{3,20}', '�û���');
		c.requiredCheck(document.fm.passwd.value, '����');
		c.regExCheck(document.fm.passwd.value,'[0-9a-zA-Z-_]{5}', '����');

	
		return c.getErrors();
	}
// --></script>
{/literal}
</head>
<body >

<div id="header">
	<div id="logo">
	<h1>Extended</h1>
	</div>
	<div id="search">

		<ul>
		<li >��ӭ<a href="{$base}/{$suserid}" >{$suserid}</a>����/Ůʿ</li>
		{foreach from=$topmenu|smarty:nodefaults item="item"}
		<li ><a href="{$item.url}">{$item.name}</a></li>
		{/foreach}
		</ul>
		<div id="form">
		<form method="POST" action="{$base}/bmsearch">
			<fieldset>
			<input id="s" type="text" name="key" value="" />
			<input type="hidden" name="type" value="key"/>
		    <input type="hidden" name="display" value=0/>
		    <input type="hidden" name="sort" value=newhot/>
			<input id="x" type="submit" value="����" />
			</fieldset>
		</form>
		</div>
	</div>
</div>
<div id="menu">
	<ul>
	<li ><a href="{$base}/">��ҳ</a></li>
	{foreach from=$categorymenu|smarty:nodefaults item="item"}
	<li ><a href="{$item.url}">{$item.name}</a></li>
	{/foreach}
	</ul>
</div>

<div id="page">

{include file=$current}
<div style="clear: both;">&nbsp;</div>
</div>

<div id="footer">
	<p>&copy;Copyright(c) 2009-2010,extended.  All Right Reserved. </p>
</div>
</body>

</html>