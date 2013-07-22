<HTML>
<HEAD>
<TITLE>Processing</TITLE>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<SCRIPT type="text/javascript">
window.setTimeout("window.location='{$baseUrl}/index'",3000); 
</SCRIPT>
</HEAD>
<BODY>
{if $result eq TRUE}
欢迎您，{$user}，将会为您跳转到首页！
{else}
登陆失败，请重新登陆！
{/if}
</BODY>
</HTML>
