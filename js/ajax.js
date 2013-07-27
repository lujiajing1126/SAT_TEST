function jsTrim(str) 
{
return str.replace(/\ /g,"");
}
/*
 * name: loadctb
 * function desc:不刷新错题本列表获得新的错题列表
 * argument:默认模式加载所有列表中的错题，如给予一个参数，则加载指定listid下的所有错题
 * @author:megrez
 */
function loadctb() {
	var mylist = arguments[0]?$(".ucplistctrlbut li.selected.mylist").attr("id"):"";
	var myorder = $(".ucplistctrlbut.order li.selected").text();
	if (typeof(myorder) == "undefined") { 
		   myorder = "";
	}
	$.post("/SAT_TEST/query/list",
					{
						"order" : jsTrim(myorder),
						"list" : mylist
					},
					function(data) {
						console.log(data);
						$("div.ucprightcol").load('/SAT_TEST/getothers/getctb', {}, function() {
							$("#itemContainer").mpage({},data);
							loadlist();
							resetlabelcolor();
						});
					}, "json");
	showpriority();

}

/*
 * name: loadlist
 * function desc:不刷新获取错题本列表，用于第一次加载错题列表
 * @author:megrez
 */
function loadlist() {
	$(".myuserlist").empty();
	var tlist = "";
	$.post("/SAT_TEST/query/showlist",{},function(data) {
		$.each(data,function(n, value) {
			var trs = "";
			trs += "<li class=\"mylist\" id=\""+value.listid+"\">"+value.listname+"</li>";
			tlist += trs;
		});
		$("div.myuserlist").append(tlist);
		$(".ucpctrlcon li").mousedown(function() {
			$(this).parent().children().removeClass("selected");
			$(this).addClass("selected");
			loadrightcol2(0);
		});
	}, "json");
	showpriority();
}

/*
 * name: loadrightcol
 * function desc:获取右侧用户帐户管理界面，用于左侧切换按钮
 * @author:megrez
 */
function loadrightcol() {
	$("div.ucprightcol").empty();
	$("div.ucprightcol").load('/SAT_TEST/auth/manage', {}, function() {
		$.post("/SAT_TEST/query/getuser", {}, function(data) {
			$("#user").val(data[0].name);
			$("#roles").val(data[0].roles);
		}, "json");
	});
	showpriority();
}

/*
 * name: loadrightcol2
 * function desc:获取右侧错题本错题，但不刷新列表
 * @argument:isChooseAll,若传递参数0，则会根据选中的list获取错题列表 
 * @author:megrez
 */
function loadrightcol2(isChooseAll) {
	$("ul#itemContainer").empty();
	var mylist = "";
	if(!!isChooseAll == false||isChooseAll == "undefined")  {
		mylist = $("li.mylist.selected").attr("id");
	}
	var myorder = $(".ucplistctrlbut.order li.selected").text();
	if (typeof(myorder) == "undefined") { 
		   myorder = "";
	}
	$.post("/SAT_TEST/query/list",
					{
						"order" : jsTrim(myorder),
						"list" : mylist
					},
					function(data) {
						$("#itemContainer").mpage({},data);
						resetlabelcolor();
					},"json");
	showpriority();
}
/*
 * name: loadlist2
 * function desc:获取右侧错题本列表，但不会继续绑定事件，以免多次绑定发生多次请求
 * 加载错题列表一般用这个函数
 * 
 * @author:megrez
 */
function loadlist2() {
	$(".myuserlist").empty();
	var tlist = "";
	$.post("/SAT_TEST/query/showlist",{},function(data) {
		$.each(data,function(n, value) {
			var trs = "";
			trs += "<li class=\"mylist\" id=\""+value.listid+"\">"+value.listname+"</li>";
			tlist += trs;
		});
		$("div.myuserlist").append(tlist);
		$(".myuserlist li").mousedown(function() {
			$(this).parent().children().removeClass("selected");
			$(this).addClass("selected");
			loadrightcol2(0);
		});
	}, "json");
	showpriority();
}
//自动加载
$(document).ready(function() {
	loadctb();
});
