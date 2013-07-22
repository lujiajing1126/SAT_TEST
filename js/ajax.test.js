function loadctb()  {
	$("div.ucprightcol").load('/SAT_TEST/getothers/getctb');
}

function loadrightcol()  {
	$("div.ucprightcol").empty();
	$("div.ucprightcol").load('/SAT_TEST/auth/manage',{},function()  {
		$.post("/SAT_TEST/query/getuser",{},function(data){
			$("#user").val(data[0].name);
			$("#roles").val(data[0].roles);
		}, "json");
	});
}

$(document).ready(function()  {
	loadctb();
});