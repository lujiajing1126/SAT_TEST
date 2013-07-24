<HTML>
<HEAD>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<TITLE>Administrator's Control Panel</TITLE>
<link href="css/bootstrap.min.css" rel="stylesheet" />
<link href="css/bootstrap-responsive.min.css" rel="stylesheet" />
<script src="js/lib/jquery.min.js"></script>
<script src="js/bootstrap.js"></script>
<script type="text/javascript" src="public/tinymce/tinymce.min.js"></script>
<script type="text/javascript">
tinymce.init({
    selector: "textarea",
    theme: "modern",
    plugins: [
        "advlist autolink lists link image charmap print preview hr anchor pagebreak",
        "searchreplace wordcount visualblocks visualchars code fullscreen",
        "insertdatetime media nonbreaking save table contextmenu directionality",
        "emoticons template paste textcolor moxiemanager"
    ],
    toolbar1: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",
    toolbar2: "print preview media | forecolor backcolor emoticons",
    image_advtab: true,
    templates: [
        {title: 'Test template 1', content: 'Test 1'},
        {title: 'Test template 2', content: 'Test 2'}
    ]
});
</script>
</HEAD>
<body>
<div class="container-fluid">
  <div class="row-fluid">
    <div class="span2">
      <!--Sidebar content-->
      <div class="row-fluid">
      <div class="span12">
      <ul class="unstyled">
      <li><a>添加题目</a></li>
      <li><a>添加文章</a></li>
      </ul>
      </div>
      </div>
    </div>
    <div class="span10">
      <!--Body content-->
     
    <form method="post" action="somepage">
    	<textarea name="content" style="width:100%"></textarea>
	</form>
    </div>
  </div>
</div>
</body>
</HTML>