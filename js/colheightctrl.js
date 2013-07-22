function resetheight(){
var questionleftcon=document.getElementById("questionleftcon");
var questionrightcon=document.getElementById("questionrightcon");
var viewport=document.getElementById("viewport");
var scrollbarcon=document.getElementById("scrollbarcon");
var scrollbartrack=document.getElementById("scrollbartrack");
viewport.style.height=questionrightcon.offsetHeight-40+"px";
var viewport2=document.getElementById("viewport2");
var scrollbarcon2=document.getElementById("scrollbarcon2");
var scrollbartrack2=document.getElementById("scrollbartrack2");
viewport2.style.height=questionrightcon.offsetHeight-40+"px";
questionleftcon.style.height=questionrightcon.offsetHeight+"px";
var Scrollbar2 = $('#archivecontainer');
Scrollbar2.tinyscrollbar();
Scrollbar2.tinyscrollbar_update();
var Scrollbar1 = $('#textscrollbar');
Scrollbar1.tinyscrollbar();
Scrollbar1.tinyscrollbar_update();
}