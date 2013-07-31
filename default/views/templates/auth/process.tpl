<HTML>
<HEAD>
<title>Lost in the Clouds</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="" />
<meta name="viewport" content="width = 320" />
<meta name="viewport" content="initial-scale=1.0, user-scalable=no" />

<link rel="stylesheet" type="text/css" href="/SAT_TEST/css/auth/reset.css" />	
<link rel="stylesheet" type="text/css" href="/SAT_TEST/css/auth/main.css" />
<link href="http://fonts.googleapis.com/css?family=Inconsolata&amp;v1" rel="stylesheet" type="text/css" />
<link href='http://fonts.googleapis.com/css?family=Candal&amp;v1' rel='stylesheet' type='text/css' />
	
<!-- IE6 fixes are found in styles/ie6.css -->
<!--[if lte IE 6]><link rel="stylesheet" type="text/css" href="styles/ie6.css" /><![endif]-->
	
<script src="/SAT_TEST/js/lib/jquery.min.js" type="text/javascript"></script>
<script src="/SAT_TEST/js/lib/jquery.spritely.js" type="text/javascript"></script>
{literal}
<script type="text/javascript">
(function($) {
	$(document).ready(function() {
		$('#clouds').pan({fps: 30, speed: 0.7, dir: 'left', depth: 10});
		$('#clouds').spRelSpeed(8);
	});
})(jQuery);
</script>
{/literal}
</HEAD>
<BODY>
{if $result eq TRUE}
<script type="text/javascript">
window.location = "/SAT_TEST";
</script>
{else}
<div id="container">
	<div id="stage" class="stage">
		<div id="clouds" class="stage"></div>
	</div>
	<div id="ticket">
		<div id="ticket_left">
			<p class="text1_a">Oops,NOT SACHer!</p>
			<p class="text2_a">User not found</p>
			<p class="text3_a">LOGIN Fail</p>
			<p class="text4_a">Sorry!</p>
			<p class="text5_a">From</p>
			<p class="text6_a">SACHME.COM</p>
			<p class="text7_a">To</p>
			<p class="text8_a">Nowhere</p>			
			<p class="text9_a">Seat</p>
			<p class="text10_a">400</p>
			<p class="text11_a">Currently, SACH is not open to individual users.</p>
			<p class="text12_a"><a href="/SAT_TEST">HOME</a>&nbsp;|&nbsp;<a href="/SAT_TEST/auth/register">Register</a></p>			
		</div>
		<div id="ticket_right">
			<p class="text1_b">First class</p>
			<p class="text2_b">Lost in the clouds</p>
			<p class="text3_b">From</p>
			<p class="text4_b">Somewhere</p>
			<p class="text5_b">To</p>
			<p class="text6_b">Nowhere</p>
			<p class="text7_b">Seat</p>
			<p class="text8_b">400</p>
			<p class="text9_b">1</p>
			<p class="text10_b">103076498</p>
		</div>
	</div>
</div>
{/if}
</BODY>
</HTML>