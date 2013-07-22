function jsTrim(str) 
{
return str.replace(/\ /g,"");
}

function loadctb() {//不刷新错题本列表获得新的错题列表
	var mylist = $(".ucplistctrlbut li.selected.mylist").attr("id");
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
						});
					}, "json");

}


function loadlist() {//获取错题本列表
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
			loadrightcol2();
		});
	}, "json");
}

function loadrightcol() {//获取用户管理界面
	$("div.ucprightcol").empty();
	$("div.ucprightcol").load('/SAT_TEST/auth/manage', {}, function() {
		$.post("/SAT_TEST/query/getuser", {}, function(data) {
			$("#user").val(data[0].name);
			$("#roles").val(data[0].roles);
		}, "json");
	});
}

function loadrightcol2() {//不刷新列表获得新的错题列表
	$("ul#itemContainer").empty();
	var mylist = $("li.selected.mylist").attr("id");
	var myorder = $(".ucplistctrlbut.order li.selected").text();
	var tbody = "";
	$.post("/SAT_TEST/query/list",
					{
						"order" : jsTrim(myorder),
						"list" : mylist
					},
					function(data) {
						$("#itemContainer").mpage({},data);
					},"json");
	
}

$(document).ready(function() {
	loadctb(1);
});
