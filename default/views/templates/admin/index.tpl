<HTML>
<HEAD>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<TITLE>Administrator's Control Panel</TITLE>
<link href="/SAT_TEST/css/bootstrap/bootstrap.min.css" rel="stylesheet" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<link href="/SAT_TEST/css/bootstrap/bootstrap-responsive.min.css" rel="stylesheet" />
<link href="/SAT_TEST/css/admin.css" rel="stylesheet" />
<script src="/SAT_TEST/js/lib/jquery.min.js"></script>
<script src="/SAT_TEST/js/lib/bootstrap.js"></script>
<script src="/SAT_TEST/public/tinymce/tinymce.min.js"></script>
</HEAD>
<body>
	<div class="navbar navbar-fixed-top">
		<div class="navbar-inner">
			<div class="container">
				<button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            		<span class="icon-bar"></span>
            		<span class="icon-bar"></span>
            		<span class="icon-bar"></span>
          		</button>
				<a class="brand" href="#">Sachme.com</a>
				<!-- 实现响应式导航条 -->
				<div class="nav-collapse collapse">
				<ul class="nav">
					<li><a href="/SAT_TEST/">网站首页</a></li>
					<li class="divider-vertical"></li>
					<li class="active"><a href="/SAT_TEST/">管理首页</a></li>
					<li class="divider-vertical"></li>
					<li class="dropdown">
   						<a href="#" class="dropdown-toggle" data-toggle="dropdown">添加<b class="caret"></b></a>
    					<ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
    					<li><a href="/SAT_TEST/admin/question">添加题目</a></li>
    					<li><a href="/SAT_TEST/admin/passage">添加文章</a></li>
    					</ul>
  					</li>
  					<li class="divider-vertical"></li>
  					<li class="dropdown">
   						<a href="#" class="dropdown-toggle" data-toggle="dropdown">编辑<b class="caret"></b></a>
    					<ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
    					<li><a href="/SAT_TEST/admin/editessay">编辑文章</a></li>
    					<li><a href="/SAT_TEST/admin/addessay">添加文章</a></li>
    					</ul>
  					</li>
  					<li class="divider-vertical"></li>
  					<li><a>删除</a></li>
				</ul>
				</div>
				<form class="navbar-search pull-right">
					<input type="text" class="fix-input search-query" placeholder="Search">
				</form>
			</div>
		</div>
			
	</div>
	<div class="container-fluid">
		<div class="row-fluid">
		欢迎访问管理首页
		</div>
	</div>
</body>
</HTML>